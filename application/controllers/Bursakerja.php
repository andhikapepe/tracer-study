<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bursakerja extends CI_Controller
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
        $this->data['title'] = 'Bursa Kerja';
        $this->data['table'] = $this->Main_model->read_join_one('lowongan', 'users', 'id_user', 'id', 'DATE(akhir_waktu) >= DATE(NOW())', 'id_lowongan')->result();
        //$this->data['table'] = $this->Main_model->where_data('DATE(akhir_waktu) <= DATE(NOW())', 'lowongan')->result();
        $this->data['additional_head'] = '<!-- JQuery DataTable Css -->
        <link href="' . base_url('assets/admin-page') . '/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
        ';
        $this->data['additional_body'] = '<!-- Jquery DataTable Plugin Js -->
        <script src="' . base_url('assets/admin-page') . '/plugins/jquery-datatable/jquery.dataTables.js"></script>
        <script src="' . base_url('assets/admin-page') . '/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
        
        <!-- Custom Js -->
        <script src="' . base_url('assets/admin-page') . '/js/pages/tables/jquery-datatable.js"></script>        
        ';
        $this->data['content'] = 'backend/modul-bursakerja/bursa-kerja';
        $this->template->_render_page('layout/adminPanel', $this->data);
    }

    public function bursakerja_detail($id)
    {
        if (!$this->uri->segment(3)) {
            show_404();
        }
        $where = array('job_slug' => $id);
        $row = $this->Main_model->where_data($where, 'lowongan')->row_array();

        if (isset($row['job_slug'])) {
            $email = $this->Main_model->view_join_one('lowongan', 'users', 'id_user', 'id', 'id_lowongan', 'Desc')->row()->email;

            $this->data['job_title']        = set_value('job_title', $row['job_title']);
            $this->data['akhir_waktu']      = set_value('akhir_waktu', $row['akhir_waktu']);
            $this->data['tanggal_posting']  = set_value('tanggal_posting', $row['tanggal_posting']);
            $this->data['deskripsi']        = set_value('deskripsi', $row['deskripsi']);
            $this->data['email']            = set_value('email', $email);
            $this->data['gambar']           = set_value('gambar', $row['gambar']);

            $this->data['content'] = 'backend/modul-bursakerja/bursakerja-detail';
            $this->template->_render_page('layout/adminPanel', $this->data);
        }
    }

    public function m_bursakerja()
    {
        $this->data['title'] = 'Bursa Kerja';
        $this->data['table'] = $this->Main_model->get_data('lowongan')->result();
        $this->data['additional_head'] = '<!-- JQuery DataTable Css -->
        <link href="' . base_url('assets/admin-page') . '/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
        ';
        $this->data['additional_body'] = '<!-- Jquery DataTable Plugin Js -->
        <script src="' . base_url('assets/admin-page') . '/plugins/jquery-datatable/jquery.dataTables.js"></script>
        <script src="' . base_url('assets/admin-page') . '/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
        
        <!-- Custom Js -->
        <script src="' . base_url('assets/admin-page') . '/js/pages/tables/jquery-datatable.js"></script>        
        ';
        $this->data['content'] = 'backend/modul-bursakerja/man-bursakerja';
        $this->template->_render_page('layout/adminPanel', $this->data);
    }

    public function bursakerja_add()
    {
        $this->form_validation->set_rules('nama_perusahaan', 'Nama Perusahaan', 'trim|required');
        $this->form_validation->set_rules('bidang_usaha', 'Bidang Usaha', 'trim|required');
        $this->form_validation->set_rules('job_title', 'Judul Lowongan', 'trim|required');
        $this->form_validation->set_rules('deskripsi', 'deskripsi role', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->data['nama_perusahaan'] = array(
                'id'    => 'nama_perusahaan',
                'name'  => 'nama_perusahaan',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('nama_perusahaan'),
            );
            $this->data['bidang_usaha'] = array(
                'id'    => 'bidang_usaha',
                'name'  => 'bidang_usaha',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('bidang_usaha'),
            );
            $this->data['job_title'] = array(
                'id'    => 'job_title',
                'name'  => 'job_title',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('job_title'),
            );
            $this->data['akhir_waktu'] = array(
                'id'    => 'akhir_waktu',
                'name'  => 'akhir_waktu',
                'type'  => 'date',
                'value' => $this->form_validation->set_value('akhir_waktu'),
            );
            $this->data['is_tampil'] = array(
                'id'    => 'is_tampil',
                'name'  => 'is_tampil',
                'selected' => $this->form_validation->set_value('is_tampil'),
            );
            $this->data['deskripsi'] = array(
                'name'  => 'deskripsi',
                'value' => $this->form_validation->set_value('deskripsi'),
            );
            $this->data['gambar'] = array(
                'id'    => 'gambar',
                'name'  => 'gambar',
                'type'  => 'file',
                'value' => $this->form_validation->set_value('gambar'),
            );
            $this->data['additional_head'] = '<!-- Bootstrap Select Css -->
            <link href="' . base_url() . 'assets/admin-page/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />';
            $this->data['additional_body'] = '<script src="' . base_url() . 'assets/admin-page/plugins/ckeditor/ckeditor.js"></script>
            <script src="' . base_url() . 'assets/admin-page/js/pages/forms/editors.js"></script>
            <!-- Select Plugin Js -->
            <script src="' . base_url() . 'assets/admin-page/plugins/bootstrap-select/js/bootstrap-select.js"></script>
            ';
            $this->data['content'] = 'backend/modul-bursakerja/bursakerja-add';
            $this->template->_render_page('layout/adminPanel', $this->data);
        } else {
            $nama_perusahaan = $this->input->post('nama_perusahaan', true);
            $bidang_usaha = $this->input->post('bidang_usaha', true);
            $job_title = $this->input->post('job_title', true);
            $job_slug = slug($this->input->post('job_title', true));
            $deskripsi = $this->input->post('deskripsi', true);
            $akhir_waktu = $this->input->post('akhir_waktu', true);
            $is_tampil = $this->input->post('is_tampil', true);

            $data = [
                'id_user'           => $this->session->userdata('id_user'),
                'nama_perusahaan'   => $nama_perusahaan,
                'bidang_usaha'      => $bidang_usaha,
                'job_title'         => $job_title,
                'deskripsi'         => $deskripsi,
                'job_slug'          => $job_slug,
                'akhir_waktu'       => $akhir_waktu,
            ];
            if ($this->session->userdata('role_active') == 1) {
                $data['is_tampil']  = $is_tampil;
            }
            if (!empty($_FILES['gambar']['name'])) {

                $config['upload_path']          = './uploads/gambar-lowongan/';
                $config['allowed_types']        = 'jpg|png';
                $config['max_size']             = 2000;
                $config['max_width']            = 1024;
                $config['max_height']           = 1024;
                $config['file_name']            = $_FILES['gambar']['name'];

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if (!$this->upload->do_upload('gambar')) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('bursakerja/bursakerja-add', 'refresh');
                } else {
                    $image_data = $this->upload->data();
                    $data['gambar'] = $image_data['file_name'];
                    if ($this->Main_model->insert_data($data, 'lowongan')) {
                        $this->session->set_flashdata('success', 'Data berhasil ditambahkan!');
                        redirect('bursakerja/m-bursakerja', 'refresh');
                    }
                }
            } else {
                if ($this->Main_model->insert_data($data, 'lowongan')) {
                    $this->session->set_flashdata('success', 'Data berhasil ditambahkan!');
                    redirect('bursakerja/m-bursakerja', 'refresh');
                }
            }
        }
    }
    public function bursakerja_edit($id)
    {
        if (!$this->uri->segment(3)) {
            show_404();
        }
        $where = array('id_lowongan' => $id);
        $row = $this->Main_model->where_data($where, 'lowongan')->row_array();
        if (isset($row['id_lowongan'])) {

            $this->form_validation->set_rules('nama_perusahaan', 'Nama Perusahaan', 'trim|required');
            $this->form_validation->set_rules('bidang_usaha', 'Bidang Usaha', 'trim|required');
            $this->form_validation->set_rules('job_title', 'Judul Lowongan', 'trim|required');
            $this->form_validation->set_rules('deskripsi', 'deskripsi role', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $this->data['nama_perusahaan'] = array(
                    'id'    => 'nama_perusahaan',
                    'name'  => 'nama_perusahaan',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('nama_perusahaan', $row['nama_perusahaan']),
                );
                $this->data['bidang_usaha'] = array(
                    'id'    => 'bidang_usaha',
                    'name'  => 'bidang_usaha',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('bidang_usaha', $row['bidang_usaha']),
                );
                $this->data['job_title'] = array(
                    'id'    => 'job_title',
                    'name'  => 'job_title',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('job_title', $row['job_title']),
                );
                $this->data['akhir_waktu'] = array(
                    'id'    => 'akhir_waktu',
                    'name'  => 'akhir_waktu',
                    'type'  => 'date',
                    'value' => $this->form_validation->set_value('akhir_waktu', $row['akhir_waktu']),
                );
                $this->data['is_tampil'] = array(
                    'id'    => 'is_tampil',
                    'name'  => 'is_tampil',
                    'selected' => $this->form_validation->set_value('is_tampil', $row['is_tampil']),
                );
                $this->data['deskripsi'] = array(
                    'name'  => 'deskripsi',
                    'value' => $this->form_validation->set_value('deskripsi', $row['deskripsi']),
                );
                $this->data['gambar'] = array(
                    'id'    => 'gambar',
                    'name'  => 'gambar',
                    'type'  => 'file',
                    'value' => $this->form_validation->set_value('gambar', $row['gambar']),
                );
                $this->data['id_lowongan'] = array(
                    'value' => $this->form_validation->set_value('id_lowongan', $row['id_lowongan']),
                );

                $this->data['additional_head'] = '<!-- Bootstrap Select Css -->
                <link href="' . base_url() . 'assets/admin-page/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />';
                $this->data['additional_body'] = '<script src="' . base_url() . 'assets/admin-page/plugins/ckeditor/ckeditor.js"></script>
                <script src="' . base_url() . 'assets/admin-page/js/pages/forms/editors.js"></script>
                <!-- Select Plugin Js -->
                <script src="' . base_url() . 'assets/admin-page/plugins/bootstrap-select/js/bootstrap-select.js"></script>
                ';

                $this->data['content'] = 'backend/modul-bursakerja/bursakerja-edit';
                $this->template->_render_page('layout/adminPanel', $this->data);
            } else {

                $nama_perusahaan = $this->input->post('nama_perusahaan', true);
                $bidang_usaha = $this->input->post('bidang_usaha', true);
                $job_title = $this->input->post('job_title', true);
                $job_slug = slug($this->input->post('job_title', true));
                $deskripsi = $this->input->post('deskripsi', true);
                $akhir_waktu = $this->input->post('akhir_waktu', true);
                $is_tampil = $this->input->post('is_tampil', true);

                $data = [
                    'id_user'           => $this->session->userdata('id_user'),
                    'nama_perusahaan'   => $nama_perusahaan,
                    'bidang_usaha'      => $bidang_usaha,
                    'job_title'         => $job_title,
                    'deskripsi'         => $deskripsi,
                    'job_slug'          => $job_slug,
                    'akhir_waktu'       => $akhir_waktu,
                ];

                if ($this->session->userdata('role_active') == 1) {
                    $data['is_tampil'] = $is_tampil;
                }

                $where = array('id_lowongan' => $row['id_lowongan']);

                if (!empty($_FILES['gambar']['name'])) {

                    $config['upload_path']          = './uploads/gambar-lowongan/';
                    $config['allowed_types']        = 'jpg|png';
                    $config['max_size']             = 2000;
                    $config['max_width']            = 1024;
                    $config['max_height']           = 1024;
                    $config['file_name']            = $_FILES['gambar']['name'];

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('gambar')) {
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                        redirect('bursakerja/bursakerja-edit/' . $row['id_lowongan'], 'refresh');
                    } else {
                        $image_data = $this->upload->data();
                        $data['gambar'] = $image_data['file_name'];

                        if ($this->Main_model->update_data($where, $data, 'lowongan')) {
                            //hapus gambar lama
                            if (!empty($row['gambar'])) {
                                unlink('./uploads/gambar-lowongan/' . $row['gambar']);
                            }

                            $this->session->set_flashdata('success', 'Data berhasil diubah!');
                            redirect('bursakerja/m-bursakerja', 'refresh');
                        }
                    }
                } else {

                    if ($this->Main_model->update_data($where, $data, 'lowongan')) {
                        $this->session->set_flashdata('success', 'Data berhasil diubah!');
                        redirect('bursakerja/m-bursakerja', 'refresh');
                    }
                }
            }
        }
    }
    public function bursakerja_delete($id)
    {
        $where = array('id_lowongan' => $id);
        $_id = $this->Main_model->where_data($where, 'lowongan')->row();
        if ($this->Main_model->delete_data($where, 'lowongan')) {
            if ($_id->gambar != '') {
                unlink('./uploads/gambar-lowongan/' . $_id->gambar);
            }
        }
        redirect('bursakerja/m-bursakerja', 'refresh');
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
