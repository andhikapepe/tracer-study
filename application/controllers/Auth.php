<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper(['url', 'form', 'html']);
		$this->load->library(['template', 'session', 'form_validation']);
		$this->load->model(['Auth_model', 'Main_model']);
	}

	public function index()
	{
		if ($this->session->userdata('is_Logged') == FALSE) {
			$this->session->set_flashdata('error', 'Kembalilah Ke Jalan Yang Benar!');
			redirect('auth/login', 'refresh');
		} else {
			redirect('dashboard', 'refresh');
		}
	}
	//fungsi registrasi pengguna baru
	public function register_user()
	{
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

		if ($this->form_validation->run() == FALSE) {
			$this->data['username'] = array(
				'id'	=> 'username',
				'name'	=> 'username',
				'type'	=> 'text',
				'value' => $this->form_validation->set_value('username'),
			);
			$this->data['email'] = array(
				'id'	=> 'email',
				'name'	=> 'email',
				'type'	=> 'email',
				'value' => $this->form_validation->set_value('email'),
			);
			$this->data['password'] = array(
				'id'	=> 'password',
				'name'	=> 'password',
				'type'	=> 'password',
				'value' => $this->form_validation->set_value('password'),
			);
			$this->data['passconf'] = array(
				'id'	=> 'passconf',
				'name'	=> 'passconf',
				'type'	=> 'password',
				'value' => $this->form_validation->set_value('passconf'),
			);
			$this->template->_render_page('auth/register', $this->data);
		} else {

			$username = $this->input->post('username', true);
			$email = $this->input->post('email', true);
			$password = $this->input->post('password', true);
			$options = [
				'cost' => 12,
			];
			$data = [
				'username'		=> $username,
				'email' 		=> $email,
				'password' 		=> password_hash($password, PASSWORD_DEFAULT, $options),
				'role_allow'	=> 2,
				'role_active'	=> 2,
				'is_active'		=> 1,
			];

			$this->Auth_model->insert_data($data, 'users');
			$this->session->set_flashdata('success', 'Akun Berhasil Didaftarkan, Silahkan Login!');
			redirect('auth/login');
		}
	}

	//fungsi login
	public function login()
	{
		//cek login
		if ($this->session->userdata('is_Logged') == TRUE) {
			redirect('Dashboard', 'refresh');
		}
		$this->form_validation->set_rules('email', 'Alamat Surel', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			$this->data['email'] = array(
				'id'	=> 'email',
				'name'	=> 'email',
				'type'	=> 'email',
				'value' => $this->form_validation->set_value('email'),
			);
			$this->data['password'] = array(
				'id'	=> 'password',
				'name'	=> 'password',
				'type'	=> 'password',
				'value' => $this->form_validation->set_value('password'),
			);
			$this->template->_render_page('auth/login', $this->data);
		} else {
			$password = $this->input->post('password', true);
			$email = $this->input->post('email', true);
			$data = [
				'email'		=> $email,
			];
			$query = $this->Auth_model->where_data('users', $data);
			$result = $query->row_array();

			if (!empty($result) && password_verify($password, $result['password'])) {
				$data = [
					'is_Logged' 	=> TRUE,
					'email'			=> $result['email'],
					'username'		=> $result['username'],
					'role_active' 	=> $result['role_active'],
					'id_user'		=> $result['id'],
				];
				if ($result['is_admin'] == 1) {
					$data['is_admin']	= TRUE;
				}
				if (!empty($result['foto'])) {
					$data['profilfoto'] = $result['foto'];
				}

				//cek menu aktif untuk role alumni-----------------------------------------
				$where = ['role_active' => 2];
				$row = $this->Main_model->where_data($where, 'users')->row_array();
				if (isset($row['id'])) {
					$where = ['id_user' => $row['id']];
					$get = $this->Main_model->where_data($where, 'data_diri')->row_array();
					if (isset($get['id_user'])) {
						$data['menu_active'] = TRUE;
					} else {
						$data['menu_active'] = FALSE;
					}
				}
				//-------------------------------------------------------------------------

				$this->session->set_userdata($data);
				$this->session->set_flashdata('success', 'Selamat, anda berhasil Login!');
				redirect('dashboard', 'refresh');
			} else {
				$this->session->set_flashdata('warning', 'Akun anda tidak ditemukan!');
				redirect('auth/login', 'refresh');
			}
		}
	}

	//fungsi forgot_password
	public function forgot_password()
	{
		$this->data['title'] = 'Lupa Kata Sandi';
		$this->load->helper('string');

		$this->form_validation->set_rules('email', 'Alamat Surel', 'trim|required|valid_email');
		if ($this->form_validation->run() ==  FALSE) {
			$this->data['email'] = array(
				'id'	=> 'email',
				'name'	=> 'email',
				'type'	=> 'email',
				'value' => $this->form_validation->set_value('email'),
			);
			$this->template->_render_page('auth/forgot-password', $this->data);
		} else {
			$email 			= $this->input->post('email');
			$kode_aktivasi 	= random_string('alnum', 50);
			$where = array('email' => $email);
			$row = $this->Auth_model->where_data('users', $where)->row_array();
			if (isset($row['email'])) {
				$data = array(
					'kode_aktivasi' => $kode_aktivasi,
				);
				if ($this->Main_model->update_data($where, $data, 'users')) {
					$this->_email_reset($email, $kode_aktivasi);
					$this->session->flashdata('success', 'Tautan untuk reset kata sandi telah dikirim.');
					redirect('auth/login', 'refresh');
				}
			}
		}
	}

	//fungsi reset
	public function reset_password()
	{
		$code 	= $this->input->get('code');
		$email 	= $this->input->get('email');

		$this->data['title'] = 'Reset Kata Sandi';

		$this->form_validation->set_rules('password', 'Kata Sandi', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('passconf', 'Konfirmasi Kata Sandi', 'trim|required|matches[password]');

		if ($this->form_validation->run() == FALSE) {
			if (strlen($code) == 50 && !empty($email)) {
				$where = array('email' => $email);
				$row = $this->Auth_model->where_data('users', $where)->row_array();
				if ($row['kode_aktivasi'] == $code) {
					$this->data['password'] = array(
						'id'	=> 'password',
						'name'	=> 'password',
						'type'	=> 'password',
						'value' => $this->form_validation->set_value('password'),
					);
					$this->data['passconf'] = array(
						'id'	=> 'passconf',
						'name'	=> 'passconf',
						'type'	=> 'password',
						'value' => $this->form_validation->set_value('passconf'),
					);
					$this->template->_render_page('auth/reset-password', $this->data);
				} else show_404();
			} else if (empty($code) && empty($email)) {
				show_404();
			} else {
				$this->session->set_flashdata('info', 'Your password reset link is incorrect');
				redirect('auth/forgot-password', 'refresh');
			}
		} else {
			$password = $this->input->post('password', true);
			$where = array('email' => $email);
			$options = [
				'cost' => 12,
			];
			$data = [
				'password' 		=> password_hash($password, PASSWORD_DEFAULT, $options),
				'kode_aktivasi'	=> NULL,
			];

			if ($this->Main_model->update_data($where, $data, 'users')) {
				$this->_email_sukses($email);
				$this->session->set_flashdata('success', 'Your password has been reset');
				redirect('auth/login', 'refresh');
			}
		}
	}

	//set $config untuk proses forgot-password di function _email_reset dan _email_sukses

	//fungsi kirim email reset password
	function _email_reset($email, $kode_aktivasi)
	{
		$config = [
			'mailtype'  	=> 'html',
			'charset'   	=> 'utf-8',
			'protocol'  	=> 'smtp',
			'smtp_host' 	=> 'smtp.gmail.com',
			'smtp_user' 	=> '', // alamat email gmail anda
			'smtp_pass'   	=> '', // password gmail anda
			'smtp_crypto' 	=> 'ssl',
			'smtp_port'   	=> 465,
			'crlf'    		=> "\r\n",
			'newline' 		=> "\r\n"
		];

		$this->load->library('email', $config);
		$this->email->from('gmail@gmail.com', 'Your Name'); //setting data pengirim disini! (email pengirim dan nama pengirim)

		$this->email->to($email);
		$this->email->subject('[Password Reset]');

		$html = '
		<div style="margin-bottom: 20px; font-weight: bold;">Hello ' . $email . ',</div>

		<div>Someone has requested a password reset to our sistem.</div>
		<div style="margin-bottom: 10px;">To reset your password, please click this link and we will redirect you to reset password form: <a href="' . base_url('reset-password?code=' . $kode_aktivasi . '&email=' . $email) . '">Reset my password</a>.
		</div>
		<div>If that link cannot working you can access this URL from your browser</div>
		<div><a href="' . base_url('reset-password?code=' . $kode_aktivasi . '&email=' . $email) . '">' . base_url('reset-password?code=' . $kode_aktivasi . '&email=' . $email) . '</a></div>

		<div style="margin-bottom: 20px; margin-top: 10px;">If you have a question reply this email and we will contact you as soon as possible, thank you!</div>
		';

		$this->email->message($html);
		return $this->email->send();
	}

	//fungsi kirim email jika password berhasil di ubah
	function _email_sukses($email)
	{
		$config = [
			'mailtype'  	=> 'html',
			'charset'   	=> 'utf-8',
			'protocol'  	=> 'smtp',
			'smtp_host' 	=> 'smtp.gmail.com',
			'smtp_user' 	=> '', // alamat email gmail anda
			'smtp_pass'   	=> '', // password gmail anda
			'smtp_crypto' 	=> 'ssl',
			'smtp_port'   	=> 465,
			'crlf'    		=> "\r\n",
			'newline' 		=> "\r\n"
		];

		$this->load->library('email', $config);
		$this->email->from('gmail@gmail.com', 'Your Name'); //setting data pengirim disini! (email pengirim dan nama pengirim)

		$this->email->to($email);
		$this->email->subject('[Password Reset Success]');

		$html = '
		<div style="margin-bottom: 20px; font-weight: bold;">Hello ' . $email . ',</div>

		<div>Your password has been reset at ' . date('Y/m/d h:i:s a') . ', please keep your account secure</div>

		<div style="margin-bottom: 20px; margin-top: 10px;">If you have a question reply this email and we will contact you as soon as possible, thank you!</div>
		';

		$this->email->message($html);
		return $this->email->send();
	}

	//fungsi logout
	public function logout()
	{
		$this->session->sess_destroy();
		$this->session->set_flashdata('success', 'Sampai jumpa lagi!');
		redirect('auth/login', 'refresh');
	}
}
