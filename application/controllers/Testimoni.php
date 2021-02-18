<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Testimoni extends CI_Controller
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
    //fungsi testimoni
    public function index()
    {
        $where = array('id_user' => $this->session->userdata('id_user'));
        $row = $this->Main_model->where_data($where, 'testimoni')->row_array();

        $this->form_validation->set_rules('testimoni', 'testimoni', 'trim|required');

        if (isset($row['id_user'])) {
            $this->data['testimoni'] = array(
                'id'    => 'testimoni',
                'name'    => 'testimoni',
                'type'    => 'text',
                'value' => $this->form_validation->set_value('testimoni', $row['testimoni']),
            );
            $this->data['content'] = 'backend/modul-testimoni/testimoni-view';
            $this->template->_render_page('layout/adminPanel', $this->data);
        } else {
            if ($this->form_validation->run() == FALSE) {
                $this->data['testimoni'] = array(
                    'id'    => 'testimoni',
                    'name'    => 'testimoni',
                    'type'    => 'text',
                    'value' => $this->form_validation->set_value('testimoni'),
                );
                $this->data['content'] = 'backend/modul-testimoni/testimoni';
                $this->template->_render_page('layout/adminPanel', $this->data);
            } else {
                $testimoni = $this->input->post('testimoni', true);
                $data = [
                    'testimoni'      => $testimoni,
                    'id_user'        => $this->session->userdata('id_user'),
                ];
                $this->Main_model->insert_data($data, 'testimoni');
                $this->session->set_flashdata('success', 'Data berhasil ditambahkan!');
                redirect('testimoni', 'refresh');
            }
        }
    }

    public function testimoni_activate($id = FALSE)
    {
        $where = ['id_testimoni' => $id];
        $row = $this->Main_model->where_data($where, 'testimoni')->row_array();
        if (!empty($row['id_testimoni']) && ($row['is_tampil'] == 'TIDAK')) {
            $data['is_tampil'] = 'YA';
        } else {
            $data['is_tampil'] = 'TIDAK';
        }
        $this->Main_model->update_data($where, $data, 'testimoni');
        $this->session->set_flashdata('success', 'Data berhasil diubah!');
        redirect('testimoni/m-testimoni', 'refresh');
    }

    public function testimoni_delete($id)
    {
        $where = array('id_user' => $id);
        $this->Main_model->delete_data($where, 'testimoni');
        redirect('testimoni', 'refresh');
    }

    public function m_testimoni()
    {
        $this->data['title'] = 'Testimoni';
        //$this->data['table'] = $this->Main_model->get_data('testimoni')->result();
        $this->data['table'] = $this->Main_model->view_join_one('testimoni', 'users', 'id_user', 'id', 'id_testimoni', 'Desc')->result();

        $this->data['additional_head'] = '<!-- JQuery DataTable Css -->
        <link href="' . base_url('assets/admin-page') . '/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
        ';
        $this->data['additional_body'] = '<!-- Jquery DataTable Plugin Js -->
        <script src="' . base_url('assets/admin-page') . '/plugins/jquery-datatable/jquery.dataTables.js"></script>
        <script src="' . base_url('assets/admin-page') . '/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
        
        <!-- Custom Js -->
        <script src="' . base_url('assets/admin-page') . '/js/pages/tables/jquery-datatable.js"></script>        
        ';
        $this->data['content'] = 'backend/modul-testimoni/man-testimoni';
        $this->template->_render_page('layout/adminPanel', $this->data);
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
