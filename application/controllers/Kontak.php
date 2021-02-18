<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kontak extends CI_Controller
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
        $data_kontak = $this->Main_model->get_data('kontak')->num_rows();
        if ($data_kontak) {
            redirect('kontak/main', 'refresh');
        } else {
            $this->form_validation->set_rules('alamat', 'Alamat Badan Usaha', 'trim|required');
            $this->form_validation->set_rules('no_telp', 'No. Telp. BU', 'trim|required|min_length[6]');
            $this->form_validation->set_rules('no_fax', 'No. Fax BU', 'trim|min_length[6]');
            $this->form_validation->set_rules('email', 'Alamat Surel BU', 'trim|required|valid_email');
            $this->form_validation->set_rules('maps_iframe', 'iframe Maps', 'trim');
            $this->form_validation->set_rules('livechat_api', 'Livechat API', 'trim');
            $this->form_validation->set_rules('whatsapp_number', 'Nomor whatsapp', 'trim|numeric|min_length[11]|max_length[13]');
            $this->form_validation->set_rules('facebook_url', 'Facebook URL', 'trim|valid_url');
            $this->form_validation->set_rules('instagram_url', 'Instagram URL', 'trim|valid_url');
            $this->form_validation->set_rules('twitter_url', 'Twitter URL', 'trim|valid_url');
            if ($this->form_validation->run() == FALSE) {
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
                $this->data['no_fax'] = array(
                    'id'    => 'no_fax',
                    'name'  => 'no_fax',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('no_fax'),
                );
                $this->data['email'] = array(
                    'id'    => 'email',
                    'name'  => 'email',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('email'),
                );
                $this->data['maps_iframe'] = array(
                    'id'    => 'maps_iframe',
                    'name'  => 'maps_iframe',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('maps_iframe'),
                );
                $this->data['livechat_api'] = array(
                    'id'    => 'livechat_api',
                    'name'  => 'livechat_api',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('livechat_api'),
                );
                $this->data['whatsapp_number'] = array(
                    'id'    => 'whatsapp_number',
                    'name'  => 'whatsapp_number',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('whatsapp_number'),
                );
                $this->data['facebook_url'] = array(
                    'id'    => 'facebook_url',
                    'name'  => 'facebook_url',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('facebook_url'),
                );
                $this->data['instagram_url'] = array(
                    'id'    => 'instagram_url',
                    'name'  => 'instagram_url',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('instagram_url'),
                );
                $this->data['twitter_url'] = array(
                    'id'    => 'twitter_url',
                    'name'  => 'twitter_url',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('twitter_url'),
                );

                $this->data['content'] = 'backend/modul-kontak/kontak';
                $this->template->_render_page('layout/adminPanel', $this->data);
            } else {
                $alamat         = $this->input->post('alamat', true);
                $no_telp        = $this->input->post('no_telp', true);
                $no_fax         = $this->input->post('no_fax', true);
                $email          = $this->input->post('email', true);
                $maps_iframe    = $this->input->post('maps_iframe', true);
                $livechat_api   = $this->input->post('livechat_api', true);
                $whatsapp_number   = $this->input->post('whatsapp_number', true);
                $facebook_url   = $this->input->post('facebook_url', true);
                $instagram_url  = $this->input->post('instagram_url', true);
                $twitter_url    = $this->input->post('twitter_url', true);

                $data = [
                    'alamat'        => $alamat,
                    'no_telp'       => $no_telp,
                    'no_fax'        => $no_fax,
                    'email'         => $email,
                    'maps_iframe'   => $maps_iframe,
                    'livechat_api'  => $livechat_api,
                    'whatsapp_number'  => $whatsapp_number,
                    'facebook_url'  => $facebook_url,
                    'instagram_url' => $instagram_url,
                    'twitter_url'   => $twitter_url,
                ];

                if ($this->Main_model->insert_data($data, 'kontak')) {
                    $this->session->set_flashdata('success', 'Data berhasil ditambahkan!');
                    redirect('kontak', 'refresh');
                }
            }
        }
    }

    public function main()
    {
        $this->data['title'] = 'Kontak';
        $where = array('id_kontak' => 1);
        $row = $this->Main_model->where_data($where, 'kontak')->row_array();
        if (isset($row['id_kontak'])) {
            $this->form_validation->set_rules('alamat', 'Alamat Badan Usaha', 'trim|required');
            $this->form_validation->set_rules('no_telp', 'No. Telp. BU', 'trim|required|min_length[6]');
            $this->form_validation->set_rules('no_fax', 'No. Fax BU', 'trim|min_length[6]');
            $this->form_validation->set_rules('email', 'Alamat Surel BU', 'trim|required|valid_email');
            $this->form_validation->set_rules('maps_iframe', 'iframe Maps', 'trim');
            $this->form_validation->set_rules('livechat_api', 'Livechat API', 'trim');
            $this->form_validation->set_rules('whatsapp_number', 'Nomor whatsapp', 'trim|numeric|min_length[11]|max_length[13]');
            $this->form_validation->set_rules('facebook_url', 'Facebook URL', 'trim|valid_url');
            $this->form_validation->set_rules('instagram_url', 'Instagram URL', 'trim|valid_url');
            $this->form_validation->set_rules('twitter_url', 'Twitter URL', 'trim|valid_url');
            if ($this->form_validation->run() == FALSE) {
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
                $this->data['no_fax'] = array(
                    'id'    => 'no_fax',
                    'name'  => 'no_fax',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('no_fax', $row['no_fax']),
                );
                $this->data['email'] = array(
                    'id'    => 'email',
                    'name'  => 'email',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('email', $row['email']),
                );
                $this->data['maps_iframe'] = array(
                    'id'    => 'maps_iframe',
                    'name'  => 'maps_iframe',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('maps_iframe', $row['maps_iframe']),
                );
                $this->data['livechat_api'] = array(
                    'id'    => 'livechat_api',
                    'name'  => 'livechat_api',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('livechat_api', $row['livechat_api']),
                );
                $this->data['whatsapp_number'] = array(
                    'id'    => 'whatsapp_number',
                    'name'  => 'whatsapp_number',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('whatsapp_number', $row['whatsapp_number']),
                );
                $this->data['facebook_url'] = array(
                    'id'    => 'facebook_url',
                    'name'  => 'facebook_url',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('facebook_url', $row['facebook_url']),
                );
                $this->data['instagram_url'] = array(
                    'id'    => 'instagram_url',
                    'name'  => 'instagram_url',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('instagram_url', $row['instagram_url']),
                );
                $this->data['twitter_url'] = array(
                    'id'    => 'twitter_url',
                    'name'  => 'twitter_url',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('twitter_url', $row['twitter_url']),
                );
                $this->data['content'] = 'backend/modul-kontak/kontak-edit';
                $this->template->_render_page('layout/adminPanel', $this->data);
            } else {
                $alamat         = $this->input->post('alamat', true);
                $no_telp        = $this->input->post('no_telp', true);
                $no_fax         = $this->input->post('no_fax', true);
                $email          = $this->input->post('email', true);
                $maps_iframe    = $this->input->post('maps_iframe', true);
                $livechat_api   = $this->input->post('livechat_api', true);
                $whatsapp_number   = $this->input->post('whatsapp_number', true);
                $facebook_url   = $this->input->post('facebook_url', true);
                $instagram_url  = $this->input->post('instagram_url', true);
                $twitter_url    = $this->input->post('twitter_url', true);

                $data = [
                    'alamat'        => $alamat,
                    'no_telp'       => $no_telp,
                    'no_fax'        => $no_fax,
                    'email'         => $email,
                    'maps_iframe'   => $maps_iframe,
                    'livechat_api'  => $livechat_api,
                    'whatsapp_number'  => $whatsapp_number,
                    'facebook_url'  => $facebook_url,
                    'instagram_url' => $instagram_url,
                    'twitter_url'   => $twitter_url,
                ];


                if ($this->Main_model->update_data($where, $data, 'kontak')) {
                    $this->session->set_flashdata('success', 'Data berhasil diubah!');
                    redirect('kontak', 'refresh');
                }
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
