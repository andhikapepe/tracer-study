<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
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
			//redirect('auth/login', 'refresh');
		}
	}
	public function index()
	{
		$this->data['kontak'] = $this->Main_model->get_data('kontak')->row_array();
		$where = array('testimoni.is_tampil' => 'YA');
		$this->data['testimoni'] = $this->Main_model->read_join_two('testimoni', 'users', 'data_diri', 'id_user', 'id', 'id_user', $where, 'id_testimoni');

		$this->data['title'] = 'Landing Page';
		$this->template->_render_page('layout/landingpagePanel', $this->data);
	}
}
