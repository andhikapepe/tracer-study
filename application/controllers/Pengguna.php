<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna extends CI_Controller
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
    //fungsi pengguna
    public function index()
    {
        //$this->data['table'] = $this->Main_model->get_data('users')->result();
        $this->data['table'] = $this->Main_model->view_join_one('users', 'role', 'role_active', 'id_role', 'id', 'DESC')->result();
        $this->data['additional_head'] = '<!-- JQuery DataTable Css -->
        <link href="' . base_url('assets/admin-page') . '/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
        ';
        $this->data['additional_body'] = '<!-- Jquery DataTable Plugin Js -->
        <script src="' . base_url('assets/admin-page') . '/plugins/jquery-datatable/jquery.dataTables.js"></script>
        <script src="' . base_url('assets/admin-page') . '/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
        
        <!-- Custom Js -->
        <script src="' . base_url('assets/admin-page') . '/js/pages/tables/jquery-datatable.js"></script>        
        ';
        $this->data['content'] = 'backend/modul-pengguna/pengguna';
        $this->template->_render_page('layout/adminPanel', $this->data);
    }

    public function pengguna_activate($id = FALSE)
    {
        $where = ['id' => $id];
        $row = $this->Main_model->where_data($where, 'users')->row_array();
        if (!empty($row['id']) && ($row['is_active'] == 0)) {
            $data['is_active'] = 1;
        } else {
            $data['is_active'] = 0;
        }
        $this->Main_model->update_data($where, $data, 'users');
        $this->session->set_flashdata('success', 'Data berhasil diubah!');
        redirect('pengguna', 'refresh');
    }

    public function pengguna_add()
    {
        $this->data['role'] = $this->Main_model->get_data('role')->result();

        $this->form_validation->set_rules('username', 'Nama', 'trim|required');
        $this->form_validation->set_rules('email', 'Alamat Surel', 'trim|required|is_unique[users.email]|min_length[5]');
        $this->form_validation->set_rules(
            'password',
            'Kata Sandi',
            'required|min_length[5]',
            array(
                'required' => 'You must provide a %s.',
            )
        );
        $this->form_validation->set_rules('passconf', 'Konfirmasi Kata Sandi', 'trim|required|matches[password]');
        $this->form_validation->set_rules('role_allow[]', 'Role yang Diijinkan', 'trim');
        $this->form_validation->set_rules('role_active', 'Role active', 'trim');

        if ($this->form_validation->run() == FALSE) {
            $this->data['username'] = array(
                'id'        => 'username',
                'name'      => 'username',
                'type'      => 'text',
                'value'     => $this->form_validation->set_value('username'),
            );
            $this->data['email'] = array(
                'id'        => 'email',
                'name'      => 'email',
                'type'      => 'email',
                'value'     => $this->form_validation->set_value('email'),
            );
            $this->data['password'] = array(
                'id'        => 'password',
                'name'      => 'password',
                'type'      => 'password',
                'value'     => $this->form_validation->set_value('password'),
            );
            $this->data['passconf'] = array(
                'id'        => 'passconf',
                'name'      => 'passconf',
                'type'      => 'password',
                'value'     => $this->form_validation->set_value('passconf'),
            );
            $this->data['role_allow'] = array(
                'name'      => 'role_allow[]',
                'value'     => $this->form_validation->set_value('role_allow'),
            );
            $this->data['role_active'] = array(
                'name'      => 'role_active',
                'value'     => $this->form_validation->set_value('role_active'),
            );

            $this->data['additional_head'] = '<!-- Bootstrap Select Css -->
                <link href="' . base_url() . 'assets/admin-page/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />';
            $this->data['additional_body'] = '<!-- Select Plugin Js -->
                <script src="' . base_url() . 'assets/admin-page/plugins/bootstrap-select/js/bootstrap-select.js"></script>
                ';
            $this->data['content'] = 'backend/modul-pengguna/pengguna-add';
            $this->template->_render_page('layout/adminPanel', $this->data);
        } else {

            $username       = $this->input->post('username', true);
            $email          = $this->input->post('email', true);
            $password       = $this->input->post('password', true);
            $role_allow     = implode(',', $this->input->post('role_allow', true));
            $role_active    = $this->input->post('role_active', true);
            $options = [
                'cost' => 12,
            ];
            $data = [
                'username'          => $username,
                'email'             => $email,
                'password'          => password_hash($password, PASSWORD_DEFAULT, $options),
                'role_allow'        => $role_allow,
                'role_active'       => $role_active,
                'is_active'         => 1,
            ];

            $this->Main_model->insert_data($data, 'users');
            $this->session->set_flashdata('success', 'Akun Berhasil Dibuat!');
            redirect('pengguna');
        }
    }

    public function pengguna_edit($id)
    {
        $this->data['role'] = $this->Main_model->get_data('role')->result();
        if (!$this->uri->segment(3)) {
            show_404();
        }
        $where = array('id' => $id);
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
            $this->form_validation->set_rules('role_allow[]', 'Role yang Diijinkan', 'trim');
            $this->form_validation->set_rules('role_active', 'Role active', 'trim');

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
                $this->data['role_allow'] = array(
                    'name'      => 'role_allow[]',
                    'value'     => $this->form_validation->set_value('role_allow', $row['role_allow']),
                );
                $this->data['role_active'] = array(
                    'name'      => 'role_active',
                    'value'     => $this->form_validation->set_value('role_active', $row['role_active']),
                );
                $this->data['id'] = array(
                    'name'      => 'id',
                    'value'     => $this->form_validation->set_value('id', $row['id']),
                );
                $this->data['additional_head'] = '<!-- Bootstrap Select Css -->
                <link href="' . base_url() . 'assets/admin-page/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />';
                $this->data['additional_body'] = '<!-- Select Plugin Js -->
                <script src="' . base_url() . 'assets/admin-page/plugins/bootstrap-select/js/bootstrap-select.js"></script>
                ';
                $this->data['content'] = 'backend/modul-pengguna/pengguna-edit';
                $this->template->_render_page('layout/adminPanel', $this->data);
            } else {
                $username = $this->input->post('username', true);
                $email = $this->input->post('email', true);
                $password = $this->input->post('password', true);
                $role_allow     = implode(',', $this->input->post('role_allow', true));
                $role_active    = $this->input->post('role_active', true);
                $options = [
                    'cost' => 12,
                ];
                $where = array('id' => $row['id']);
                $data = [
                    'username'      => $username,
                    'email'         => $email,
                    'role_allow'    => $role_allow,
                    'role_active'   => $role_active,
                ];

                if ($password) {
                    $data['password'] = password_hash($password, PASSWORD_DEFAULT, $options);
                }

                $this->Main_model->update_data($where, $data, 'users');
                $this->session->set_flashdata('success', 'Data berhasil diubah!');
                redirect('pengguna', 'refresh');
            }
        } else {
            show_error('The group you are trying to edit does not exist.');
        }
    }

    public function pengguna_delete($id)
    {
        if ($this->session->userdata('is_admin') == TRUE) {
            $this->session->set_flashdata('error', 'Kembalilah ke jalan yang benar!');
            redirect('pengguna', 'refresh');
        } else {
            $where = array('id' => $id);
            $id_user = array('id_user' => $id);
            //hapus data diri
            $data_diri = $this->Main_model->where_data($id_user, 'data_diri')->row_array();
            if (isset($data_diri['id_user'])) {
                $this->Main_model->delete_data($id_user, 'data_diri');
            }
            //hapus data testimoni
            $data_testimoni = $this->Main_model->where_data($id_user, 'testimoni')->row_array();
            if (isset($data_testimoni['id_user'])) {
                $this->Main_model->delete_data($id_user, 'testimoni');
            }
            //hapus data kritik
            $data_kritik = $this->Main_model->where_data($id_user, 'kritik')->row_array();
            if (isset($data_kritik['id_user'])) {
                $this->Main_model->delete_data($id_user, 'kritik');
            }
            //hapus data saran
            $data_saran = $this->Main_model->where_data($id_user, 'saran')->row_array();
            if (isset($data_saran['id_user'])) {
                $this->Main_model->delete_data($id_user, 'saran');
            }
            //hapus data lowongan            
            $data_lowongan = $this->Main_model->where_data($id_user, 'lowongan')->row_array();
            if (isset($data_lowongan['id_user'])) {
                if ($this->Main_model->delete_data($id_user, 'lowongan')) {
                    if ($data_lowongan['gambar'] != '') {
                        unlink('./uploads/gambar-lowongan/' . $data_lowongan['gambar']);
                    }
                }
            }
            $this->Main_model->delete_data($where, 'users');
            redirect('pengguna', 'refresh');
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
