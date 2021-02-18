<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Saran extends CI_Controller
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

    //fungsi saran
    public function index()
    {
        $where = ['id_user' => $this->session->userdata('id_user')];
        $this->data['table'] = $this->Main_model->where_data($where, 'saran')->result();

        $this->data['additional_head'] = '<!-- JQuery DataTable Css -->
        <link href="' . base_url('assets/admin-page') . '/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
        ';
        $this->data['additional_body'] = '<!-- Jquery DataTable Plugin Js -->
        <script src="' . base_url('assets/admin-page') . '/plugins/jquery-datatable/jquery.dataTables.js"></script>
        <script src="' . base_url('assets/admin-page') . '/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
        
        <!-- Custom Js -->
        <script src="' . base_url('assets/admin-page') . '/js/pages/tables/jquery-datatable.js"></script>        
        ';
        $this->data['content'] = 'backend/modul-saran/saran';
        $this->template->_render_page('layout/adminPanel', $this->data);
    }

    public function saran_add()
    {
        $this->data['title'] = 'Saran';
        $this->form_validation->set_rules('saran', 'saran', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->data['saran'] = array(
                'name'  => 'saran',
                'value' => $this->form_validation->set_value('saran'),
            );
            $this->data['additional_body'] = '<script src="' . base_url() . 'assets/admin-page/plugins/ckeditor/ckeditor.js"></script>
            <script src="' . base_url() . 'assets/admin-page/js/pages/forms/editors.js"></script>';
            $this->data['content'] = 'backend/modul-saran/saran-add';
            $this->template->_render_page('layout/adminPanel', $this->data);
        } else {
            $saran = $this->input->post('saran', true);
            $data = [
                'id_user'               => $this->session->userdata('id_user'),
                'saran'                 => $saran,
                'tanggal_posting'       => date('Y-m-d H:i:s'),
            ];
            $this->Main_model->insert_data($data, 'saran');
            $this->session->set_flashdata('success', 'Data berhasil ditambahkan!');

            redirect('saran', 'refresh');
        }
    }

    public function saran_read($id)
    {
        $this->data['title'] = 'Saran';
        if (!$this->uri->segment(3)) {
            show_404();
        }
        $where = array('id_saran' => $id);
        $row = $this->Main_model->where_data($where, 'saran')->row_array();

        if (isset($row['id_saran'])) {
            $this->data['saran']           = set_value('saran', $row['saran']);
            $this->data['tanggal_respon']   = set_value('tanggal_respon', $row['tanggal_respon']);
            $this->data['tanggal_posting']  = set_value('tanggal_posting', $row['tanggal_posting']);
            $this->data['respon']           = set_value('respon', $row['respon']);

            $this->data['content'] = 'backend/modul-saran/saran-read';
            $this->template->_render_page('layout/adminPanel', $this->data);
        }
    }

    public function saran_delete($id)
    {
        $where = array('id_saran' => $id);
        $this->Main_model->delete_data($where, 'saran');
        redirect('saran', 'refresh');
    }

    public function m_saran()
    {
        $this->data['title'] = 'Saran';
        $this->data['table'] = $this->Main_model->view_join_one('users', 'saran', 'id', 'id_user', 'id', 'DESC')->result();
        $this->data['count_belum_ditanggapi'] = $this->Main_model->count_field('tanggal_respon =' . NULL, 'saran');
        $this->data['count_ditanggapi'] = $this->Main_model->count_field('tanggal_respon !=' . NULL, 'saran');
        $this->data['count_alumni'] = $this->Main_model->count_field('role_active = 2', 'users');
        $this->data['count_all'] = $this->Main_model->count_all('saran');

        $this->data['additional_head'] = '<!-- JQuery DataTable Css -->
        <link href="' . base_url('assets/admin-page') . '/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
        ';
        $this->data['additional_body'] = '<!-- Jquery DataTable Plugin Js -->
        <script src="' . base_url('assets/admin-page') . '/plugins/jquery-datatable/jquery.dataTables.js"></script>
        <script src="' . base_url('assets/admin-page') . '/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
        
        <!-- Custom Js -->
        <script src="' . base_url('assets/admin-page') . '/js/pages/tables/jquery-datatable.js"></script>        
        ';
        $this->data['content'] = 'backend/modul-saran/man-saran';
        $this->template->_render_page('layout/adminPanel', $this->data);
    }

    public function tanggapi_saran($id)
    {
        $this->data['title'] = 'Tanggapi saran';
        if (!$this->uri->segment(3)) {
            show_404();
        }
        $where = array('id_saran' => $id);
        $row = $this->Main_model->where_data($where, 'saran')->row_array();

        if (isset($row['id_saran'])) {
            $this->data['saran']           = set_value('saran', $row['saran']);
            $this->data['tanggal_respon']   = set_value('tanggal_respon', $row['tanggal_respon']);
            $this->data['tanggal_posting']  = set_value('tanggal_posting', $row['tanggal_posting']);
            $this->data['respon']           = set_value('respon', $row['respon']);
            $this->data['id_saran']        = set_value('id_saran', $row['id_saran']);

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

                $this->Main_model->update_data($where, $data, 'saran');
                $this->session->set_flashdata('success', 'Data berhasil ditambahkan!');

                redirect('saran/m-saran', 'refresh');
            }
            $this->data['content'] = 'backend/modul-saran/saran-tanggapan';
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
