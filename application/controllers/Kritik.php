<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kritik extends CI_Controller
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

    //fungsi kritik
    public function index()
    {
        $where = ['id_user' => $this->session->userdata('id_user')];
        $this->data['table'] = $this->Main_model->where_data($where, 'kritik')->result();

        $this->data['additional_head'] = '<!-- JQuery DataTable Css -->
        <link href="' . base_url('assets/admin-page') . '/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
        ';
        $this->data['additional_body'] = '<!-- Jquery DataTable Plugin Js -->
        <script src="' . base_url('assets/admin-page') . '/plugins/jquery-datatable/jquery.dataTables.js"></script>
        <script src="' . base_url('assets/admin-page') . '/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
        
        <!-- Custom Js -->
        <script src="' . base_url('assets/admin-page') . '/js/pages/tables/jquery-datatable.js"></script>        
        ';
        $this->data['content'] = 'backend/modul-kritik/kritik';
        $this->template->_render_page('layout/adminPanel', $this->data);
    }

    public function kritik_add()
    {
        $this->data['title'] = 'kritik';
        $this->form_validation->set_rules('kritik', 'Kritik', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->data['kritik'] = array(
                'name'  => 'kritik',
                'value' => $this->form_validation->set_value('kritik'),
            );
            $this->data['additional_body'] = '<script src="' . base_url() . 'assets/admin-page/plugins/ckeditor/ckeditor.js"></script>
            <script src="' . base_url() . 'assets/admin-page/js/pages/forms/editors.js"></script>';
            $this->data['content'] = 'backend/modul-kritik/kritik-add';
            $this->template->_render_page('layout/adminPanel', $this->data);
        } else {
            $kritik = $this->input->post('kritik', true);
            $data = [
                'id_user'               => $this->session->userdata('id_user'),
                'kritik'                => $kritik,
                'tanggal_posting'       => date('Y-m-d H:i:s'),
            ];
            $this->Main_model->insert_data($data, 'kritik');
            $this->session->set_flashdata('success', 'Data berhasil ditambahkan!');

            redirect('kritik', 'refresh');
        }
    }

    public function kritik_read($id)
    {
        $this->data['title'] = 'kritik';
        if (!$this->uri->segment(3)) {
            show_404();
        }
        $where = array('id_kritik' => $id);
        $row = $this->Main_model->where_data($where, 'kritik')->row_array();

        if (isset($row['id_kritik'])) {
            $this->data['kritik']           = set_value('kritik', $row['kritik']);
            $this->data['tanggal_respon']   = set_value('tanggal_respon', $row['tanggal_respon']);
            $this->data['tanggal_posting']  = set_value('tanggal_posting', $row['tanggal_posting']);
            $this->data['respon']           = set_value('respon', $row['respon']);

            $this->data['content'] = 'backend/modul-kritik/kritik-read';
            $this->template->_render_page('layout/adminPanel', $this->data);
        }
    }

    public function kritik_delete($id)
    {
        $where = array('id_kritik' => $id);
        $this->Main_model->delete_data($where, 'kritik');
        redirect('kritik', 'refresh');
    }

    public function m_kritik()
    {
        $this->data['title']    = 'Kritik';
        $this->data['table'] = $this->Main_model->view_join_one('kritik', 'users', 'id_user', 'id', 'id', 'DESC')->result();
        $this->data['count_belum_ditanggapi'] = $this->Main_model->count_field('tanggal_respon =' . NULL, 'kritik');
        $this->data['count_ditanggapi'] = $this->Main_model->count_field('tanggal_respon !=' . NULL, 'kritik');
        $this->data['count_alumni'] = $this->Main_model->count_field('role_active = 2', 'users');
        $this->data['count_all'] = $this->Main_model->count_all('kritik');

        $this->data['additional_head'] = '<!-- JQuery DataTable Css -->
        <link href="' . base_url('assets/admin-page') . '/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
        ';
        $this->data['additional_body'] = '<!-- Jquery DataTable Plugin Js -->
        <script src="' . base_url('assets/admin-page') . '/plugins/jquery-datatable/jquery.dataTables.js"></script>
        <script src="' . base_url('assets/admin-page') . '/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
        
        <!-- Custom Js -->
        <script src="' . base_url('assets/admin-page') . '/js/pages/tables/jquery-datatable.js"></script>        
        ';
        $this->data['content'] = 'backend/modul-kritik/man-kritik';
        $this->template->_render_page('layout/adminPanel', $this->data);
    }

    public function tanggapi_kritik($id)
    {
        $this->data['title'] = 'Tanggapi kritik';
        if (!$this->uri->segment(3)) {
            show_404();
        }
        $where = array('id_kritik' => $id);
        $row = $this->Main_model->where_data($where, 'kritik')->row_array();

        if (isset($row['id_kritik'])) {
            $this->data['kritik']           = set_value('kritik', $row['kritik']);
            $this->data['tanggal_respon']   = set_value('tanggal_respon', $row['tanggal_respon']);
            $this->data['tanggal_posting']  = set_value('tanggal_posting', $row['tanggal_posting']);
            $this->data['respon']           = set_value('role', $row['kritik']);
            $this->data['id_kritik']        = set_value('id_kritik', $row['id_kritik']);

            $this->form_validation->set_rules('tanggapan', 'tanggapan', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                $this->data['tanggapan'] = array(
                    'name'  => 'tanggapan',
                    'value' => $this->form_validation->set_value('tanggapan', $row['respon']),
                );
                $this->data['additional_body'] = '<script src="' . base_url() . 'assets/admin-page/plugins/ckeditor/ckeditor.js"></script>
                <script src="' . base_url() . 'assets/admin-page/js/pages/forms/editors.js"></script>';
            } else {
                $tanggapan = $this->input->post('tanggapan', true);

                $data = [
                    'tanggal_respon'    => date('Y-m-d H:i:s'),
                    'respon'            => $tanggapan,
                ];

                $this->Main_model->update_data($where, $data, 'kritik');
                $this->session->set_flashdata('success', 'Data berhasil ditambahkan!');

                redirect('kritik/m-kritik', 'refresh');
            }
            $this->data['content'] = 'backend/modul-kritik/kritik-tanggapan';
            $this->template->_render_page('layout/adminPanel', $this->data);
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
