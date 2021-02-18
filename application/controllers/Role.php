<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Role extends CI_Controller
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

    //fungsi role
    public function index()
    {
        $this->data['table'] = $this->Main_model->get_data('role')->result();
        $this->data['additional_head'] = '<!-- JQuery DataTable Css -->
        <link href="' . base_url('assets/admin-page') . '/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
        ';
        $this->data['additional_body'] = '<!-- Jquery DataTable Plugin Js -->
        <script src="' . base_url('assets/admin-page') . '/plugins/jquery-datatable/jquery.dataTables.js"></script>
        <script src="' . base_url('assets/admin-page') . '/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
        
        <!-- Custom Js -->
        <script src="' . base_url('assets/admin-page') . '/js/pages/tables/jquery-datatable.js"></script>        
        ';
        $this->data['content'] = 'backend/modul-role/role';
        $this->template->_render_page('layout/adminPanel', $this->data);
    }

    public function role_add()
    {
        $this->form_validation->set_rules('role', 'Role Pengguna', 'trim|required|is_unique[role.role]');
        $this->form_validation->set_rules('deskripsi', 'deskripsi role', 'trim');

        if ($this->form_validation->run() == FALSE) {
            $this->data['role'] = array(
                'id'    => 'role',
                'name'  => 'role',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('role'),
            );
            $this->data['deskripsi'] = array(
                'id'    => 'deskripsi',
                'name'  => 'deskripsi',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('deskripsi'),
            );
            $this->data['content'] = 'backend/modul-role/role-add';
            $this->template->_render_page('layout/adminPanel', $this->data);
        } else {
            $role = $this->input->post('role', true);
            $deskripsi = $this->input->post('deskripsi', true);
            $data = [
                'role' => $role,
                'deskripsi' => $deskripsi,
            ];
            $this->Main_model->insert_data($data, 'role');
            $this->session->set_flashdata('success', 'Data berhasil ditambahkan!');

            redirect('role', 'refresh');
        }
    }

    public function role_edit($id = FALSE)
    {
        if (!$this->uri->segment(3)) {
            show_404();
        }
        $where = array('id_role' => $id);
        $row = $this->Main_model->where_data($where, 'role')->row_array();
        if (isset($row['id_role'])) {
            if ($this->input->post('role') != $row['role']) {
                $is_unique =  '|is_unique[role.role]';
            } else {
                $is_unique =  '';
            }

            $this->form_validation->set_rules('role', 'Role Pengguna', 'trim|required' . $is_unique);
            $this->form_validation->set_rules('deskripsi', 'deskripsi role', 'trim');

            if ($this->form_validation->run() == FALSE) {
                $this->data['role'] = array(
                    'id'    => 'role',
                    'name'  => 'role',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('role', $row['role']),
                );
                $this->data['deskripsi'] = array(
                    'id'    => 'deskripsi',
                    'name'  => 'deskripsi',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('deskripsi', $row['deskripsi']),
                );
                $this->data['id'] = array(
                    'value' => $this->form_validation->set_value('id_role', $row['id_role']),
                );
                $this->data['content'] = 'backend/modul-role/role-edit';
                $this->template->_render_page('layout/adminPanel', $this->data);
            } else {
                $where = array('id_role' => $row['id_role']);
                $data = [
                    'role' => $this->input->post('role', true),
                    'deskripsi' => $this->input->post('deskripsi', true),
                ];
                $this->Main_model->update_data($where, $data, 'role');
                $this->session->set_flashdata('success', 'Data berhasil diubah!');

                redirect('role', 'refresh');
            }
        } else {
            show_error('The group you are trying to edit does not exist.');
        }
    }

    public function role_delete($id)
    {
        $where = array('id_role' => $id);
        $this->Main_model->delete_data($where, 'role');
        redirect('role', 'refresh');
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
