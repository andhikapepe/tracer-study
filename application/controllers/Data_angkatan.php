<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_angkatan extends CI_Controller
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

    //fungsi data angkatan
    public function index()
    {
        $this->data['table'] = $this->Main_model->count_group_by('tahun_lulus, COUNT(tahun_lulus) AS jumlah_lulusan', 'tahun_lulus', 'data_diri')->result();
        $this->data['additional_head'] = '<!-- JQuery DataTable Css -->
        <link href="' . base_url('assets/admin-page') . '/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
        ';
        $this->data['additional_body'] = '<!-- Jquery DataTable Plugin Js -->
        <script src="' . base_url('assets/admin-page') . '/plugins/jquery-datatable/jquery.dataTables.js"></script>
        <script src="' . base_url('assets/admin-page') . '/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
        
        <!-- Custom Js -->
        <script src="' . base_url('assets/admin-page') . '/js/pages/tables/jquery-datatable.js"></script>        
        ';
        $this->data['content'] = 'backend/modul-data-angkatan/data-angkatan';
        $this->template->_render_page('layout/adminPanel', $this->data);
    }

    public function data_angkatan_detail($id)
    {
        $this->data['title'] = 'Data Angkatan';
        if (!$this->uri->segment(3)) {
            show_404();
        }
        $where = array('tahun_lulus' => $id);
        $row = $this->Main_model->where_orderby_data('prodi DESC', $where, 'data_diri')->row_array();

        if (isset($row['tahun_lulus'])) {
            $this->data['table'] = $this->Main_model->view_join_one('data_diri', 'users', 'id_user', 'id', 'id_data_diri', 'Desc')->result();
            $this->data['additional_head'] = '<!-- JQuery DataTable Css -->
            <link href="' . base_url('assets/admin-page') . '/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
            ';
            $this->data['additional_body'] = '<!-- Jquery DataTable Plugin Js -->
            <script src="' . base_url('assets/admin-page') . '/plugins/jquery-datatable/jquery.dataTables.js"></script>
            <script src="' . base_url('assets/admin-page') . '/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
            
            <!-- Custom Js -->
            <script src="' . base_url('assets/admin-page') . '/js/pages/tables/jquery-datatable.js"></script>        
            ';
            $this->data['content'] = 'backend/modul-data-angkatan/data-angkatan-detail';
            $this->template->_render_page('layout/adminPanel', $this->data);
        }
    }

    public function data_angkatan_detail_print($id)
    {
        $this->data['title'] = 'Data Angkatan';
        if (!$this->uri->segment(3)) {
            show_404();
        }
        $where = array('tahun_lulus' => $id);
        $row = $this->Main_model->where_orderby_data('prodi DESC', $where, 'data_diri')->row_array();

        if (isset($row['tahun_lulus'])) {
            $this->data['table'] = $this->Main_model->view_join_one('data_diri', 'users', 'id_user', 'id', 'id_data_diri', 'Desc')->result();

            $this->template->_render_page('backend/modul-data-angkatan/data-angkatan-detail-print', $this->data);
        }
    }

    public function data_angkatan_read($id)
    {
        $this->data['title'] = 'Profil Lulusan';
        if (!$this->uri->segment(3)) {
            show_404();
        }
        $where = array('id_data_diri' => $id);
        $row = $this->Main_model->where_data($where, 'data_diri')->row_array();

        if (isset($row['id_user'])) {
            $datadiri = $this->Main_model->view_join_one('data_diri', 'users', 'id_user', 'id', 'id_data_diri', 'Desc')->row_array();

            $this->data['foto']             = set_value('foto', $datadiri['foto']);
            $this->data['username']         = set_value('username', $datadiri['username']);
            $this->data['email']            = set_value('email', $datadiri['email']);
            $this->data['prodi']            = set_value('prodi', $row['prodi']);
            $this->data['jenis_kelamin']    = set_value('jenis_kelamin', $row['jenis_kelamin']);
            $this->data['tempat_lahir']     = set_value('tempat_lahir', $row['tempat_lahir']);
            $this->data['tanggal_lahir']    = set_value('tanggal_lahir', $row['tanggal_lahir']);
            $this->data['nik']              = set_value('nik', $row['nik']);
            $this->data['alamat']           = set_value('alamat', $row['alamat']);
            $this->data['no_telp']          = set_value('no_telp', $row['no_telp']);
            $this->data['nama_ayah']        = set_value('nama_ayah', $row['nama_ayah']);
            $this->data['pekerjaan_ayah']   = set_value('pekerjaan_ayah', $row['pekerjaan_ayah']);
            $this->data['nama_ibu']         = set_value('nama_ibu', $row['nama_ibu']);
            $this->data['pekerjaan_ibu']    = set_value('pekerjaan_ibu', $row['pekerjaan_ibu']);
            $this->data['tahun_masuk']      = set_value('tahun_masuk', $row['tahun_masuk']);
            $this->data['tahun_lulus']      = set_value('tahun_lulus', $row['tahun_lulus']);
            $this->data['no_ijazah']        = set_value('no_ijazah', $row['no_ijazah']);
            $this->data['no_skhun']         = set_value('no_skhun', $row['no_skhun']);
            $this->data['status']           = set_value('status', $row['status']);
            $this->data['deskripsi']        = set_value('deskripsi', $row['deskripsi_status']);
            $this->data['id_data_diri']     = set_value('id_data_diri', $row['id_data_diri']);

            $this->data['content'] = 'backend/modul-data-angkatan/data-angkatan-read';
            $this->template->_render_page('layout/adminPanel', $this->data);
        }
    }

    public function data_angkatan_read_print($id)
    {
        $this->data['title'] = 'Profil Lulusan';
        if (!$this->uri->segment(3)) {
            show_404();
        }
        $where = array('id_data_diri' => $id);
        $row = $this->Main_model->where_data($where, 'data_diri')->row_array();

        if (isset($row['id_user'])) {
            $datadiri = $this->Main_model->view_join_one('data_diri', 'users', 'id_user', 'id', 'id_data_diri', 'Desc')->row_array();

            $this->data['foto']             = set_value('foto', $datadiri['foto']);
            $this->data['username']         = set_value('username', $datadiri['username']);
            $this->data['email']            = set_value('email', $datadiri['email']);
            $this->data['prodi']            = set_value('prodi', $row['prodi']);
            $this->data['jenis_kelamin']    = set_value('jenis_kelamin', $row['jenis_kelamin']);
            $this->data['tempat_lahir']     = set_value('tempat_lahir', $row['tempat_lahir']);
            $this->data['tanggal_lahir']    = set_value('tanggal_lahir', $row['tanggal_lahir']);
            $this->data['nik']              = set_value('nik', $row['nik']);
            $this->data['alamat']           = set_value('alamat', $row['alamat']);
            $this->data['no_telp']          = set_value('no_telp', $row['no_telp']);
            $this->data['nama_ayah']        = set_value('nama_ayah', $row['nama_ayah']);
            $this->data['pekerjaan_ayah']   = set_value('pekerjaan_ayah', $row['pekerjaan_ayah']);
            $this->data['nama_ibu']         = set_value('nama_ibu', $row['nama_ibu']);
            $this->data['pekerjaan_ibu']    = set_value('pekerjaan_ibu', $row['pekerjaan_ibu']);
            $this->data['tahun_masuk']      = set_value('tahun_masuk', $row['tahun_masuk']);
            $this->data['tahun_lulus']      = set_value('tahun_lulus', $row['tahun_lulus']);
            $this->data['no_ijazah']        = set_value('no_ijazah', $row['no_ijazah']);
            $this->data['no_skhun']         = set_value('no_skhun', $row['no_skhun']);
            $this->data['status']           = set_value('status', $row['status']);
            $this->data['deskripsi']        = set_value('deskripsi', $row['deskripsi_status']);
            $this->data['id_data_diri']     = set_value('id_data_diri', $row['id_data_diri']);

            $this->template->_render_page('backend/modul-data-angkatan/data-angkatan-read-print', $this->data);
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
