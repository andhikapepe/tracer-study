<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
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
        $this->data['title'] = 'Dashboard';
        $this->data['count_alumni'] = $this->Main_model->count_field('role_active = 2', 'users');
        $this->data['count_data_diri'] = $this->Main_model->count_field('id_data_diri != ""', 'data_diri');
        $this->data['count_event'] = $this->Main_model->count_field('MONTH(tanggal_event) = MONTH(CURRENT_DATE()) AND YEAR(tanggal_event) = YEAR(CURRENT_DATE())', 'event');
        $this->data['count_lowker'] = $this->Main_model->count_field('DATE(akhir_waktu) <= DATE(NOW())', 'lowongan');
        $this->data['count_status'] = $this->Main_model->count_group_by('status,COUNT(status) as result, ROUND((COUNT(status) / (SELECT COUNT(*) FROM data_diri))*100,0) as prosentase,(SELECT COUNT(*) FROM data_diri) as total', 'status', 'data_diri')->result_array();
        $this->data['count_tahun_lulus'] = $this->Main_model->count_group_by('tahun_lulus, COUNT(tahun_lulus) as jumlah', 'tahun_lulus', 'data_diri')->result_array();

        $this->data['content'] = 'backend/modul-dashboard/dashboard';
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
