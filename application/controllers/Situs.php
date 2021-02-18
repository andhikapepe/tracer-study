<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Situs extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper(['url', 'form', 'html', 'slug', 'indonesian_date', 'text']);
        $this->load->library(['template', 'session', 'form_validation']);
        $this->load->model('Main_model');

        //cek login
        if ($this->session->userdata('is_Logged') == FALSE) {
            redirect('auth/login', 'refresh');
        }
        //cek apakah akun aktif
        $this->check_isActive();
    }

    public function index()
    {
        $data_situs = $this->Main_model->get_data('situs')->num_rows();
        if ($data_situs) {
            redirect('situs/main', 'refresh');
        } else {
            $this->form_validation->set_rules('app_name', 'Nama Situs', 'trim|required');
            $this->form_validation->set_rules('app_slogan', 'Slogan / Nama BU', 'trim|required');
            $this->form_validation->set_rules('meta_deskripsi', 'Meta deskripsi', 'trim|required');
            $this->form_validation->set_rules('meta_keyword', 'Meta Keyword', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                $this->data['app_name'] = array(
                    'id'    => 'app_name',
                    'name'  => 'app_name',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('app_name'),
                );
                $this->data['app_slogan'] = array(
                    'id'    => 'app_slogan',
                    'name'  => 'app_slogan',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('app_slogan'),
                );
                $this->data['meta_deskripsi'] = array(
                    'id'    => 'meta_deskripsi',
                    'name'  => 'meta_deskripsi',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('meta_deskripsi'),
                );
                $this->data['meta_keyword'] = array(
                    'id'    => 'meta_keyword',
                    'name'  => 'meta_keyword',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('meta_keyword'),
                );
                $this->data['logo_website'] = array(
                    'id'    => 'logo_website',
                    'name'  => 'logo_website',
                    'type'  => 'file',
                    'value' => $this->form_validation->set_value('logo_website'),
                );

                $this->data['content'] = 'backend/modul-situs/situs';
                $this->template->_render_page('layout/adminPanel', $this->data);
            } else {
                $app_name = $this->input->post('app_name', true);
                $app_slogan = $this->input->post('app_slogan', true);
                $meta_deskripsi = $this->input->post('meta_deskripsi', true);
                $meta_keyword = $this->input->post('meta_keyword', true);

                $data = [
                    'app_name'      => $app_name,
                    'app_slogan'    => $app_slogan,
                    'meta_deskripsi' => $meta_deskripsi,
                    'meta_keyword'  => $meta_keyword,
                ];
                if (!empty($_FILES['logo_website']['name'])) {

                    $config['upload_path']          = './assets/situs/';
                    $config['allowed_types']        = 'jpeg|jpg|png|ico';
                    $config['max_size']             = 1000;
                    $config['max_width']            = 800;
                    $config['max_height']           = 600;
                    $config['file_name']            = $_FILES['logo_website']['name'];

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('logo_website')) {
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                        redirect('situs', 'refresh');
                    } else {
                        $image_data = $this->upload->data();
                        $data['logo_website'] = $image_data['file_name'];
                        if ($this->Main_model->insert_data($data, 'situs')) {
                            $this->session->set_flashdata('success', 'Data berhasil ditambahkan!');
                            redirect('situs', 'refresh');
                        }
                    }
                } else {
                    if ($this->Main_model->insert_data($data, 'situs')) {
                        $this->session->set_flashdata('success', 'Data berhasil ditambahkan!');
                        redirect('situs', 'refresh');
                    }
                }
            }
        }
    }

    public function main()
    {
        $this->data['title'] = 'Situs';
        $where = array('id_situs' => 1);
        $row = $this->Main_model->where_data($where, 'situs')->row_array();
        if (isset($row['id_situs'])) {
            $this->form_validation->set_rules('app_name', 'Nama Situs', 'trim|required');
            $this->form_validation->set_rules('app_slogan', 'Slogan / Nama BU', 'trim|required');
            $this->form_validation->set_rules('meta_deskripsi', 'Meta deskripsi', 'trim|required');
            $this->form_validation->set_rules('meta_keyword', 'Meta Keyword', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $this->data['app_name'] = array(
                    'id'    => 'app_name',
                    'name'  => 'app_name',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('app_name', $row['app_name']),
                );
                $this->data['app_slogan'] = array(
                    'id'    => 'app_slogan',
                    'name'  => 'app_slogan',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('app_slogan', $row['app_slogan']),
                );
                $this->data['meta_deskripsi'] = array(
                    'id'    => 'meta_deskripsi',
                    'name'  => 'meta_deskripsi',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('meta_deskripsi', $row['meta_deskripsi']),
                );
                $this->data['meta_keyword'] = array(
                    'id'    => 'meta_keyword',
                    'name'  => 'meta_keyword',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('meta_keyword', $row['meta_keyword']),
                );
                $this->data['logo_website'] = array(
                    'id'    => 'logo_website',
                    'name'  => 'logo_website',
                    'type'  => 'file',
                    'value' => $this->form_validation->set_value('logo_website', $row['logo_website']),
                );
                $this->data['content'] = 'backend/modul-situs/situs-edit';
                $this->template->_render_page('layout/adminPanel', $this->data);
            } else {
                $app_name = $this->input->post('app_name', true);
                $app_slogan = $this->input->post('app_slogan', true);
                $meta_deskripsi = $this->input->post('meta_deskripsi', true);
                $meta_keyword = $this->input->post('meta_keyword', true);

                $data = [
                    'app_name'      => $app_name,
                    'app_slogan'    => $app_slogan,
                    'meta_deskripsi' => $meta_deskripsi,
                    'meta_keyword'  => $meta_keyword,
                ];
                if (!empty($_FILES['logo_website']['name'])) {

                    $config['upload_path']          = './assets/situs/';
                    $config['allowed_types']        = 'jpeg|jpg|png|ico';
                    $config['max_size']             = 1000;
                    $config['max_width']            = 800;
                    $config['max_height']           = 600;
                    $config['file_name']            = $_FILES['logo_website']['name'];

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('logo_website')) {
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                        redirect('situs', 'refresh');
                    } else {
                        $image_data = $this->upload->data();
                        $data['logo_website'] = $image_data['file_name'];
                        if ($this->Main_model->update_data($where, $data, 'situs')) {
                            //hapus gambar lama
                            if (!empty($row['logo_website'])) {
                                unlink('./assets/situs/' . $row['logo_website']);
                            }

                            $this->session->set_flashdata('success', 'Data berhasil diubah!');
                            redirect('situs', 'refresh');
                        }
                    }
                } else {

                    if ($this->Main_model->update_data($where, $data, 'situs')) {
                        $this->session->set_flashdata('success', 'Data berhasil diubah!');
                        redirect('situs', 'refresh');
                    }
                }
            }
        }
    }

    //fungsi cek aktif pengguna
    public function check_isActive()
    {
        $data = [
            'email' => $this->session->userdata('email'),
        ];
        $query = $this->Main_model->where_data($data, 'users');
        $result = $query->row_array();

        if ($result['is_active'] == 0) {
            $this->session->set_flashdata('warning', 'Akun anda telah kami non-aktifkan, silahkan menghubungi administrator!');
            redirect('auth/login');
        }
    }
}
