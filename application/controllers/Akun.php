<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Akun extends CI_Controller
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
    //fungsi akun
    public function index()
    {
        $where = array('id' => $this->session->userdata('id_user'));
        $row = $this->Main_model->where_data($where, 'users')->row_array();
        if (isset($row['id'])) {
            if ($this->input->post('email') != $row['email']) {
                $is_unique =  '|is_unique[users.email]';
            } else {
                $is_unique =  '';
            }
            $this->form_validation->set_rules('username', 'Nama', 'trim|required');
            $this->form_validation->set_rules('email', 'Alamat Surel', 'trim|required|min_length[5]' . $is_unique);
            $this->form_validation->set_rules('password', 'Kata Sandi', 'trim');
            $this->form_validation->set_rules('passconf', 'Konfirmasi Kata Sandi', 'trim|matches[password]');

            if ($this->form_validation->run() == FALSE) {
                $this->data['username'] = array(
                    'id'    => 'username',
                    'name'    => 'username',
                    'type'    => 'text',
                    'value' => $this->form_validation->set_value('username', $row['username']),
                );
                $this->data['email'] = array(
                    'id'    => 'email',
                    'name'    => 'email',
                    'type'    => 'email',
                    'value' => $this->form_validation->set_value('email', $row['email']),
                );
                $this->data['password'] = array(
                    'id'    => 'password',
                    'name'    => 'password',
                    'type'    => 'password',
                    'value' => $this->form_validation->set_value('password'),
                );
                $this->data['passconf'] = array(
                    'id'    => 'passconf',
                    'name'    => 'passconf',
                    'type'    => 'password',
                    'value' => $this->form_validation->set_value('passconf'),
                );
                $this->data['foto'] = array(
                    'id'    => 'foto',
                    'name'    => 'foto',
                    'type'    => 'file',
                    'value' => $this->form_validation->set_value('foto', $row['foto']),
                );
                $this->data['content'] = 'backend/modul-akun/akun';
                $this->template->_render_page('layout/adminPanel', $this->data);
            } else {
                $username = $this->input->post('username', true);
                $email = $this->input->post('email', true);
                $password = $this->input->post('password', true);
                $options = [
                    'cost' => 12,
                ];
                $where = array('id' => $row['id']);
                $data = [
                    'username'      => $username,
                    'email'         => $email,
                ];

                if ($password) {
                    $data['password'] = password_hash($password, PASSWORD_DEFAULT, $options);
                }

                if (!empty($_FILES['foto']['name'])) {

                    $config['upload_path']          = './uploads/foto-profil/';
                    $config['allowed_types']        = 'jpg|png';
                    $config['max_size']             = 2000;
                    $config['max_width']            = 1024;
                    $config['max_height']           = 1024;
                    $config['file_name']            = $_FILES['foto']['name'];

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('foto')) {
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                        redirect('akun', 'refresh');
                    } else {
                        $image_data = $this->upload->data();
                        $data['foto'] = $image_data['file_name'];

                        if ($this->Main_model->update_data($where, $data, 'users')) {
                            //hapus foto lama
                            if (!empty($row['foto'])) {
                                unlink('./uploads/foto-profil/' . $row['foto']);
                            }

                            $this->session->set_flashdata('success', 'Data berhasil diubah!');
                            $this->session->set_userdata(array(
                                'username'      => $username,
                                'email'         => $email,
                                'profilfoto'    => $image_data['file_name'],
                            ));
                            redirect('akun', 'refresh');
                        }
                    }
                } else {

                    if ($this->Main_model->update_data($where, $data, 'users')) {
                        $this->session->set_flashdata('success', 'Data berhasil diubah!');
                        $this->session->set_userdata(array(
                            'username'      => $username,
                            'email'         => $email,
                        ));
                        redirect('akun', 'refresh');
                    }
                }
            }
        } else {
            show_error('The group you are trying to edit does not exist.');
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
