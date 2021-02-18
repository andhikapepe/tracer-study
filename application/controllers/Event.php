
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Event extends CI_Controller
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

    //fungsi event
    public function index()
    {
        //tampilkan data hanya di bulan dan tahun ini
        $this->data['table'] = $this->Main_model->read_join_one('event', 'users', 'id_user', 'id', 'MONTH(tanggal_event) = MONTH(CURRENT_DATE()) AND YEAR(tanggal_event) = YEAR(CURRENT_DATE())', 'id_event')->result();

        $this->data['additional_head'] = '<!-- JQuery DataTable Css -->
        <link href="' . base_url('assets/admin-page') . '/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
        <!-- Light Gallery Plugin Css -->
        <link href="' . base_url('assets/admin-page') . '/plugins/light-gallery/css/lightgallery.css" rel="stylesheet">
        ';
        $this->data['additional_body'] = '<!-- Jquery DataTable Plugin Js -->
        <script src="' . base_url('assets/admin-page') . '/plugins/jquery-datatable/jquery.dataTables.js"></script>
        <script src="' . base_url('assets/admin-page') . '/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
        
        <!-- Custom Js -->
        <script src="' . base_url('assets/admin-page') . '/js/pages/tables/jquery-datatable.js"></script>';
        $this->data['content'] = 'backend/modul-event/event';
        $this->template->_render_page('layout/adminPanel', $this->data);
    }

    public function event_detail($id)
    {
        if (!$this->uri->segment(3)) {
            show_404();
        }
        $where = array('event_slug' => $id);
        $row = $this->Main_model->where_data($where, 'event')->row_array();

        if (isset($row['event_slug'])) {
            $email = $this->Main_model->view_join_one('event', 'users', 'id_user', 'id', 'id_event', 'Desc')->row()->email;

            $this->data['event_title']      = set_value('event_title', $row['event_title']);
            $this->data['tanggal_event']    = set_value('tanggal_event', $row['tanggal_event']);
            $this->data['tanggal_posting']  = set_value('tanggal_event', $row['tanggal_posting']);
            $this->data['deskripsi']        = set_value('deskripsi', $row['deskripsi']);
            $this->data['email']            = set_value('email', $email);
            $this->data['gambar']           = set_value('gambar', $row['gambar']);

            $this->data['content'] = 'backend/modul-event/event-detail';
            $this->template->_render_page('layout/adminPanel', $this->data);
        }
    }

    public function event_add()
    {
        $this->form_validation->set_rules('event_title', 'Judul Kegiatan', 'trim|required');
        $this->form_validation->set_rules('deskripsi', 'deskripsi role', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->data['event_title'] = array(
                'id'    => 'event_title',
                'name'  => 'event_title',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('event_title'),
            );
            $this->data['tanggal_event'] = array(
                'id'    => 'tanggal_event',
                'name'  => 'tanggal_event',
                'type'  => 'date',
                'value' => $this->form_validation->set_value('tanggal_event'),
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
            $this->data['additional_body'] = '<script src="' . base_url() . 'assets/admin-page/plugins/ckeditor/ckeditor.js"></script>
            <script src="' . base_url() . 'assets/admin-page/js/pages/forms/editors.js"></script>';
            $this->data['content'] = 'backend/modul-event/event-add';
            $this->template->_render_page('layout/adminPanel', $this->data);
        } else {

            $event_title = $this->input->post('event_title', true);
            $event_slug = slug($this->input->post('event_title', true));
            $deskripsi = $this->input->post('deskripsi', true);
            $tanggal_event = $this->input->post('tanggal_event', true);

            $data = [
                'id_user'       => $this->session->userdata('id_user'),
                'event_title'   => $event_title,
                'deskripsi'     => $deskripsi,
                'event_slug'    => $event_slug,
                'tanggal_event' => $tanggal_event,
            ];
            if (!empty($_FILES['gambar']['name'])) {

                $config['upload_path']          = './uploads/gambar-event/';
                $config['allowed_types']        = 'jpg|png';
                $config['max_size']             = 2000;
                $config['max_width']            = 1024;
                $config['max_height']           = 1024;
                $config['file_name']            = $_FILES['gambar']['name'];

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if (!$this->upload->do_upload('gambar')) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('event/event-add', 'refresh');
                } else {
                    $image_data = $this->upload->data();
                    $data['gambar'] = $image_data['file_name'];
                    if ($this->Main_model->insert_data($data, 'event')) {
                        $this->session->set_flashdata('success', 'Data berhasil ditambahkan!');
                        redirect('event/m-event', 'refresh');
                    }
                }
            } else {
                if ($this->Main_model->insert_data($data, 'event')) {
                    $this->session->set_flashdata('success', 'Data berhasil ditambahkan!');
                    redirect('event/m-event', 'refresh');
                }
            }
        }
    }

    public function event_edit($id)
    {
        if (!$this->uri->segment(3)) {
            show_404();
        }
        $where = array('id_event' => $id);
        $row = $this->Main_model->where_data($where, 'event')->row_array();
        if (isset($row['id_event'])) {

            $this->form_validation->set_rules('event_title', 'Judul Kegiatan', 'trim|required');
            $this->form_validation->set_rules('deskripsi', 'deskripsi role', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $this->data['event_title'] = array(
                    'id'    => 'event_title',
                    'name'  => 'event_title',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('event_title', $row['event_title']),
                );
                $this->data['tanggal_event'] = array(
                    'id'    => 'tanggal_event',
                    'name'  => 'tanggal_event',
                    'type'  => 'date',
                    'value' => $this->form_validation->set_value('tanggal_event', $row['tanggal_event']),
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
                $this->data['id_event'] = array(
                    'id'    => 'id_event',
                    'name'  => 'id_event',
                    'type'  => 'file',
                    'value' => $this->form_validation->set_value('id_event', $row['id_event']),
                );

                $this->data['additional_body'] = '<script src="' . base_url() . 'assets/admin-page/plugins/ckeditor/ckeditor.js"></script>
                <script src="' . base_url() . 'assets/admin-page/js/pages/forms/editors.js"></script>';

                $this->data['content'] = 'backend/modul-event/event-edit';
                $this->template->_render_page('layout/adminPanel', $this->data);
            } else {

                $event_title = $this->input->post('event_title', true);
                $event_slug = slug($this->input->post('event_title', true));
                $deskripsi = $this->input->post('deskripsi', true);
                $tanggal_event = $this->input->post('tanggal_event', true);

                $where = array('id_event' => $row['id_event']);
                $data = [
                    'id_user'       => $this->session->userdata('id_user'),
                    'event_title'   => $event_title,
                    'deskripsi'     => $deskripsi,
                    'event_slug'    => $event_slug,
                    'tanggal_event' => $tanggal_event,
                ];
                if (!empty($_FILES['gambar']['name'])) {

                    $config['upload_path']          = './uploads/gambar-event/';
                    $config['allowed_types']        = 'jpg|png';
                    $config['max_size']             = 2000;
                    $config['max_width']            = 1024;
                    $config['max_height']           = 1024;
                    $config['file_name']            = $_FILES['gambar']['name'];

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('gambar')) {
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                        redirect('event/event-edit/' . $row['id_event'], 'refresh');
                    } else {
                        $image_data = $this->upload->data();
                        $data['gambar'] = $image_data['file_name'];

                        if ($this->Main_model->update_data($where, $data, 'event')) {
                            //hapus gambar lama
                            if (!empty($row['gambar'])) {
                                unlink('./uploads/gambar-event/' . $row['gambar']);
                            }

                            $this->session->set_flashdata('success', 'Data berhasil diubah!');
                            redirect('event/m-event', 'refresh');
                        }
                    }
                } else {

                    if ($this->Main_model->update_data($where, $data, 'event')) {
                        $this->session->set_flashdata('success', 'Data berhasil diubah!');
                        redirect('event/m-event', 'refresh');
                    }
                }
            }
        }
    }
    public function event_delete($id)
    {
        $where = array('id_event' => $id);
        $_id = $this->Main_model->where_data($where, 'event')->row();
        if ($this->Main_model->delete_data($where, 'event')) {
            if ($_id->gambar != '') {
                unlink('./uploads/gambar-event/' . $_id->gambar);
            }
        }
        redirect('event/m-event', 'refresh');
    }

    public function m_event()
    {
        $this->data['title'] = 'Event';
        $this->data['table'] = $this->Main_model->view_join_one('event', 'users', 'id_user', 'id', 'id_event', 'Desc')->result();
        $this->data['additional_head'] = '<!-- JQuery DataTable Css -->
        <link href="' . base_url('assets/admin-page') . '/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
        ';
        $this->data['additional_body'] = '<!-- Jquery DataTable Plugin Js -->
        <script src="' . base_url('assets/admin-page') . '/plugins/jquery-datatable/jquery.dataTables.js"></script>
        <script src="' . base_url('assets/admin-page') . '/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
        
        <!-- Custom Js -->
        <script src="' . base_url('assets/admin-page') . '/js/pages/tables/jquery-datatable.js"></script>   
        ';
        $this->data['content'] = 'backend/modul-event/man-event';
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
