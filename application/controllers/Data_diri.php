<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_diri extends CI_Controller
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
        //cek apakah sudah mengisi data diri
        $where = ['id_user' => $this->session->userdata('id_user')];
        $row = $this->Main_model->where_data($where, 'data_diri')->row_array();
        if (!empty($row['id_user'])) {
            redirect('data-diri/data', 'refresh');
        } else {
            $this->form_validation->set_rules('prodi', 'Program Studi', 'trim|required');
            $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required');
            $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim|required');
            $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'trim|required');
            $this->form_validation->set_rules('nik', 'Nomor NIK', 'trim|required|exact_length[16]|numeric');
            $this->form_validation->set_rules('alamat', 'Alamat Domisili', 'trim|required');
            $this->form_validation->set_rules('no_telp', 'Nomor Telp/Handphone Aktif', 'trim|required|min_length[6]|max_length[12]|numeric');
            $this->form_validation->set_rules('nama_ayah', 'Nama Ayah', 'trim|required');
            $this->form_validation->set_rules('pekerjaan_ayah', 'Pekerjaan Ayah', 'trim|required');
            $this->form_validation->set_rules('nama_ibu', 'Nama Ibu', 'trim|required');
            $this->form_validation->set_rules('pekerjaan_ibu', 'Pekerjaan Ibu', 'trim|required');
            $this->form_validation->set_rules('tahun_masuk', 'Tahun Masuk', 'trim|required|exact_length[4]|numeric');
            $this->form_validation->set_rules('tahun_lulus', 'Tahun Lulus', 'trim|required|exact_length[4]|numeric');
            $this->form_validation->set_rules('no_ijazah', 'Nomor Ijazah', 'trim');
            $this->form_validation->set_rules('no_skhun', 'Nomor SKHUN', 'trim');
            $this->form_validation->set_rules('status', 'Status', 'trim|required');
            $this->form_validation->set_rules('deskripsi_status', 'Deskripsi', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $data_ = ['id' => $this->session->userdata('id_user')];
                $data_akun = $this->Main_model->where_data($data_, 'users')->row_array();
                if ($data_akun['id']) {
                    $this->data['nama'] = array(
                        'id'    => 'nama',
                        'name'  => 'nama',
                        'type'  => 'text',
                        'value' => set_value('nama', $data_akun['username']),
                    );
                    $this->data['email'] = array(
                        'id'    => 'email',
                        'name'  => 'email',
                        'type'  => 'text',
                        'value' => set_value('email', $data_akun['email']),
                    );
                }
                $this->data['prodi'] = array(
                    'id'    => 'prodi',
                    'name'  => 'prodi',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('prodi'),
                );
                $this->data['jenis_kelamin'] = array(
                    'id'    => 'jenis_kelamin',
                    'name'  => 'jenis_kelamin',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('jenis_kelamin'),
                );
                $this->data['tempat_lahir'] = array(
                    'id'    => 'tempat_lahir',
                    'name'  => 'tempat_lahir',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('tempat_lahir'),
                );
                $this->data['tanggal_lahir'] = array(
                    'id'    => 'tanggal_lahir',
                    'name'  => 'tanggal_lahir',
                    'type'  => 'date',
                    'value' => $this->form_validation->set_value('tanggal_lahir'),
                );
                $this->data['nik'] = array(
                    'id'    => 'nik',
                    'name'  => 'nik',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('nik'),
                );
                $this->data['alamat'] = array(
                    'id'    => 'alamat',
                    'name'  => 'alamat',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('alamat'),
                );
                $this->data['no_telp'] = array(
                    'id'    => 'no_telp',
                    'name'  => 'no_telp',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('no_telp'),
                );
                $this->data['nama_ayah'] = array(
                    'id'    => 'nama_ayah',
                    'name'  => 'nama_ayah',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('nama_ayah'),
                );
                $this->data['pekerjaan_ayah'] = array(
                    'id'    => 'pekerjaan_ayah',
                    'name'  => 'pekerjaan_ayah',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('pekerjaan_ayah'),
                );
                $this->data['nama_ibu'] = array(
                    'id'    => 'nama_ibu',
                    'name'  => 'nama_ibu',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('nama_ibu'),
                );
                $this->data['pekerjaan_ibu'] = array(
                    'id'    => 'pekerjaan_ibu',
                    'name'  => 'pekerjaan_ibu',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('pekerjaan_ibu'),
                );
                $this->data['tahun_masuk'] = array(
                    'id'    => 'tahun_masuk',
                    'name'  => 'tahun_masuk',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('tahun_masuk'),
                );
                $this->data['tahun_lulus'] = array(
                    'id'    => 'tahun_lulus',
                    'name'  => 'tahun_lulus',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('tahun_lulus'),
                );
                $this->data['no_ijazah'] = array(
                    'id'    => 'no_ijazah',
                    'name'  => 'no_ijazah',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('no_ijazah'),
                );
                $this->data['no_skhun'] = array(
                    'id'    => 'no_skhun',
                    'name'  => 'no_skhun',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('no_skhun'),
                );
                $this->data['status'] = array(
                    'id'    => 'status',
                    'name'  => 'status',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('status'),
                );
                $this->data['deskripsi_status'] = array(
                    'id'    => 'deskripsi_status',
                    'name'  => 'deskripsi_status',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('deskripsi_status'),
                );
                $this->data['additional_head'] = ' <!-- Bootstrap Select Css -->
                <link href="' . base_url('assets/admin-page') . '/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />';
                $this->data['additional_body'] = '<!-- Select Plugin Js -->
                <script src="' . base_url('assets/admin-page') . '/plugins/bootstrap-select/js/bootstrap-select.js"></script>';
                $this->data['content'] = 'backend/modul-data-diri/data-diri';
                $this->template->_render_page('layout/adminPanel', $this->data);
            } else {
                $prodi              = $this->input->post('prodi', TRUE);
                $jenis_kelamin      = $this->input->post('jenis_kelamin', TRUE);
                $tempat_lahir       = $this->input->post('tempat_lahir', TRUE);
                $tanggal_lahir      = $this->input->post('tanggal_lahir', TRUE);
                $nik                = $this->input->post('nik', TRUE);
                $alamat             = $this->input->post('alamat', TRUE);
                $no_telp            = $this->input->post('no_telp', TRUE);
                $nama_ayah          = $this->input->post('nama_ayah', TRUE);
                $pekerjaan_ayah     = $this->input->post('pekerjaan_ayah', TRUE);
                $nama_ibu           = $this->input->post('nama_ibu', TRUE);
                $pekerjaan_ibu      = $this->input->post('pekerjaan_ibu', TRUE);
                $tahun_masuk        = $this->input->post('tahun_masuk', TRUE);
                $tahun_lulus        = $this->input->post('tahun_lulus', TRUE);
                $no_ijazah          = $this->input->post('no_ijazah', TRUE);
                $no_skhun           = $this->input->post('no_skhun', TRUE);
                $status             = $this->input->post('status', TRUE);
                $deskripsi_status   = $this->input->post('deskripsi_status', TRUE);

                $data = [
                    'id_user'           => $this->session->userdata('id_user'),
                    'prodi'             => $prodi,
                    'jenis_kelamin'     => $jenis_kelamin,
                    'tempat_lahir'      => $tempat_lahir,
                    'tanggal_lahir'     => $tanggal_lahir,
                    'nik'               => $nik,
                    'alamat'            => $alamat,
                    'no_telp'           => $no_telp,
                    'nama_ayah'         => $nama_ayah,
                    'pekerjaan_ayah'    => $pekerjaan_ayah,
                    'nama_ibu'          => $nama_ibu,
                    'pekerjaan_ibu'     => $pekerjaan_ibu,
                    'tahun_masuk'       => $tahun_masuk,
                    'tahun_lulus'       => $tahun_lulus,
                    'no_ijazah'         => $no_ijazah,
                    'no_skhun'          => $no_skhun,
                    'status'            => $status,
                    'deskripsi_status'  => $deskripsi_status,
                ];
                $this->Main_model->insert_data($data, 'data_diri');
                $this->session->set_flashdata('success', 'Data berhasil ditambahkan!');
                $this->session->set_userdata('menu_active', TRUE);
                redirect('data-diri', 'refresh');
            }
        }
    }

    public function data()
    {
        $where = ['id_user' => $this->session->userdata('id_user')];
        $row = $this->Main_model->where_data($where, 'data_diri')->row_array();
        if ($row['id_user']) {
            $this->form_validation->set_rules('prodi', 'Program Studi', 'trim|required');
            $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required');
            $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim|required');
            $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'trim|required');
            $this->form_validation->set_rules('nik', 'Nomor NIK', 'trim|required|exact_length[16]|numeric');
            $this->form_validation->set_rules('alamat', 'Alamat Domisili', 'trim|required');
            $this->form_validation->set_rules('no_telp', 'Nomor Telp/Handphone Aktif', 'trim|required|min_length[6]|max_length[12]|numeric');
            $this->form_validation->set_rules('nama_ayah', 'Nama Ayah', 'trim|required');
            $this->form_validation->set_rules('pekerjaan_ayah', 'Pekerjaan Ayah', 'trim|required');
            $this->form_validation->set_rules('nama_ibu', 'Nama Ibu', 'trim|required');
            $this->form_validation->set_rules('pekerjaan_ibu', 'Pekerjaan Ibu', 'trim|required');
            $this->form_validation->set_rules('tahun_masuk', 'Tahun Masuk', 'trim|required|exact_length[4]|numeric');
            $this->form_validation->set_rules('tahun_lulus', 'Tahun Lulus', 'trim|required|exact_length[4]|numeric');
            $this->form_validation->set_rules('no_ijazah', 'Nomor Ijazah', 'trim');
            $this->form_validation->set_rules('no_skhun', 'Nomor SKHUN', 'trim');
            $this->form_validation->set_rules('status', 'Status', 'trim|required');
            $this->form_validation->set_rules('deskripsi_status', 'Deskripsi', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $data_ = ['id' => $this->session->userdata('id_user')];
                $data_akun = $this->Main_model->where_data($data_, 'users')->row_array();
                if ($data_akun['id']) {
                    $this->data['nama'] = array(
                        'id'    => 'nama',
                        'name'  => 'nama',
                        'type'  => 'text',
                        'value' => set_value('nama', $data_akun['username']),
                    );
                    $this->data['email'] = array(
                        'id'    => 'email',
                        'name'  => 'email',
                        'type'  => 'text',
                        'value' => set_value('email', $data_akun['email']),
                    );
                }
                $this->data['prodi'] = array(
                    'id'    => 'prodi',
                    'name'  => 'prodi',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('prodi', $row['prodi']),
                );
                $this->data['jenis_kelamin'] = array(
                    'id'    => 'jenis_kelamin',
                    'name'  => 'jenis_kelamin',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('jenis_kelamin', $row['jenis_kelamin']),
                );
                $this->data['tempat_lahir'] = array(
                    'id'    => 'tempat_lahir',
                    'name'  => 'tempat_lahir',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('tempat_lahir', $row['tempat_lahir']),
                );
                $this->data['tanggal_lahir'] = array(
                    'id'    => 'tanggal_lahir',
                    'name'  => 'tanggal_lahir',
                    'type'  => 'date',
                    'value' => $this->form_validation->set_value('tanggal_lahir', $row['tanggal_lahir']),
                );
                $this->data['nik'] = array(
                    'id'    => 'nik',
                    'name'  => 'nik',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('nik', $row['nik']),
                );
                $this->data['alamat'] = array(
                    'id'    => 'alamat',
                    'name'  => 'alamat',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('alamat', $row['alamat']),
                );
                $this->data['no_telp'] = array(
                    'id'    => 'no_telp',
                    'name'  => 'no_telp',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('no_telp', $row['no_telp']),
                );
                $this->data['nama_ayah'] = array(
                    'id'    => 'nama_ayah',
                    'name'  => 'nama_ayah',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('nama_ayah', $row['nama_ayah']),
                );
                $this->data['pekerjaan_ayah'] = array(
                    'id'    => 'pekerjaan_ayah',
                    'name'  => 'pekerjaan_ayah',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('pekerjaan_ayah', $row['pekerjaan_ayah']),
                );
                $this->data['nama_ibu'] = array(
                    'id'    => 'nama_ibu',
                    'name'  => 'nama_ibu',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('nama_ibu', $row['nama_ibu']),
                );
                $this->data['pekerjaan_ibu'] = array(
                    'id'    => 'pekerjaan_ibu',
                    'name'  => 'pekerjaan_ibu',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('pekerjaan_ibu', $row['pekerjaan_ibu']),
                );
                $this->data['tahun_masuk'] = array(
                    'id'    => 'tahun_masuk',
                    'name'  => 'tahun_masuk',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('tahun_masuk', $row['tahun_masuk']),
                );
                $this->data['tahun_lulus'] = array(
                    'id'    => 'tahun_lulus',
                    'name'  => 'tahun_lulus',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('tahun_lulus', $row['tahun_lulus']),
                );
                $this->data['no_ijazah'] = array(
                    'id'    => 'no_ijazah',
                    'name'  => 'no_ijazah',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('no_ijazah', $row['no_ijazah']),
                );
                $this->data['no_skhun'] = array(
                    'id'    => 'no_skhun',
                    'name'  => 'no_skhun',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('no_skhun', $row['no_skhun']),
                );
                $this->data['status'] = array(
                    'id'    => 'status',
                    'name'  => 'status',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('status', $row['status']),
                );
                $this->data['deskripsi_status'] = array(
                    'id'    => 'deskripsi_status',
                    'name'  => 'deskripsi_status',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('deskripsi_status', $row['deskripsi_status']),
                );
                $this->data['additional_head'] = ' <!-- Bootstrap Select Css -->
                <link href="' . base_url('assets/admin-page') . '/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />';
                $this->data['additional_body'] = '<!-- Select Plugin Js -->
                <script src="' . base_url('assets/admin-page') . '/plugins/bootstrap-select/js/bootstrap-select.js"></script>';

                $this->data['content'] = 'backend/modul-data-diri/data-diri-view';
                $this->template->_render_page('layout/adminPanel', $this->data);
            } else {
                $prodi              = $this->input->post('prodi', TRUE);
                $jenis_kelamin      = $this->input->post('jenis_kelamin', TRUE);
                $tempat_lahir       = $this->input->post('tempat_lahir', TRUE);
                $tanggal_lahir      = $this->input->post('tanggal_lahir', TRUE);
                $nik                = $this->input->post('nik', TRUE);
                $alamat             = $this->input->post('alamat', TRUE);
                $no_telp            = $this->input->post('no_telp', TRUE);
                $nama_ayah          = $this->input->post('nama_ayah', TRUE);
                $pekerjaan_ayah     = $this->input->post('pekerjaan_ayah', TRUE);
                $nama_ibu           = $this->input->post('nama_ibu', TRUE);
                $pekerjaan_ibu      = $this->input->post('pekerjaan_ibu', TRUE);
                $tahun_masuk        = $this->input->post('tahun_masuk', TRUE);
                $tahun_lulus        = $this->input->post('tahun_lulus', TRUE);
                $no_ijazah          = $this->input->post('no_ijazah', TRUE);
                $no_skhun           = $this->input->post('no_skhun', TRUE);
                $status             = $this->input->post('status', TRUE);
                $deskripsi_status   = $this->input->post('deskripsi_status', TRUE);

                $data = [
                    'id_user'           => $this->session->userdata('id_user'),
                    'prodi'             => $prodi,
                    'jenis_kelamin'     => $jenis_kelamin,
                    'tempat_lahir'      => $tempat_lahir,
                    'tanggal_lahir'     => $tanggal_lahir,
                    'nik'               => $nik,
                    'alamat'            => $alamat,
                    'no_telp'           => $no_telp,
                    'nama_ayah'         => $nama_ayah,
                    'pekerjaan_ayah'    => $pekerjaan_ayah,
                    'nama_ibu'          => $nama_ibu,
                    'pekerjaan_ibu'     => $pekerjaan_ibu,
                    'tahun_masuk'       => $tahun_masuk,
                    'tahun_lulus'       => $tahun_lulus,
                    'no_ijazah'         => $no_ijazah,
                    'no_skhun'          => $no_skhun,
                    'status'            => $status,
                    'deskripsi_status'  => $deskripsi_status,
                ];
                $this->Main_model->update_data($where, $data, 'data_diri');
                $this->session->set_flashdata('success', 'Data berhasil diubah!');

                redirect('data-diri/data', 'refresh');
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
