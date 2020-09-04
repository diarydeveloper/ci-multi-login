<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller 
{
	public function __construct() 
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->model('users');
	}

	/*
		Action : Index 
		Route  : /welcome
		Method : GET
		Params : null
	*/
	public function index()
	{
		$this->load->view('index');
	}

	/*
		Action : Check login 
		Route  : cek_login
		Method : GET
		Params : null
	*/
	private function cek_login()
	{
		if ($this->session->userdata('is_login') != true) {
			redirect('welcome/login');
		}
	}

	/*
		Action : Is login 
		Route  : is_login
		Method : GET
		Params : null
	*/
	private function is_login()
	{
		if ($this->session->userdata('is_login') == true) {
			redirect('welcome/dashboard');
		}
	}

	/*
		Action : Login 
		Route  : /welcome/login
		Method : GET
		Params : email, pass
	*/
	public function login() 
	{
		$this->load->view('form/signin');
	}

	/*
		Action : Login action
		Route  : /welcome/login_action
		Method : POST
		Params : email, pass
	*/
	public function login_action()
	{
		$this->is_login();
		if($_POST) {
			$this->form_validation->set_rules('email', 'email', 'required|trim|valid_email|callback_check_email_exists');
			$this->form_validation->set_rules('password', 'password', 'required|trim');
			if($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error', form_error('email', '<div>', '</div>'));
				redirect('welcome/login');
			} else {
				$data['email'] = $this->input->post('email');
				$data['pass'] = $this->input->post('password');
				$query = $this->users->cek_login($data);
				if ($query) {
					$user = $this->users->get_users($data['email']);
					$session['email'] = $user['email'];
					$session['name'] = $user['name'];
					if($user['role'] == 0):
						$session['role'] = 'Admin';
					elseif($user['role'] == 1):
						$session['role'] = 'Teacher';
					elseif($user['role'] == 2):
						$session['role'] = 'Student';
					endif;
					$session['is_login'] = true;
					$this->session->set_userdata($session);
					$this->session->set_flashdata('success', 'Login success');
					redirect('welcome/dashboard');
				} else {
					$this->session->set_flashdata('error', 'Password not match');
					redirect('welcome/login');
				}
			}
		} else {
			echo 'Method not found';
		}
	}

	/*
		Action : Check email exists 
		Route  : check_email_exists
		Method : GET
		Params : email
	*/
	public function check_email_exists($email) 
	{
		if ($this->users->cek_email_exists($email)) {
			return true;
		} else {
			$this->form_validation->set_message('check_email_exists', 'Email not registered');
			return false;
		}
	}

	/*
		Action : View dashboard
		Route  : welcome/dashboard
		Method : GET
		Params : email
	*/
	public function dashboard()
	{
		$this->cek_login();
		if($this->session->userdata('role') == 'Admin') {
			$this->load->view('users/admin/dashboard');
		} elseif($this->session->userdata('role') == 'Teacher') {
			$this->load->view('users/teacher/dashboard');
		} elseif($this->session->userdata('role') == 'Student') {
			$this->load->view('users/student/dashboard');
		} 
	} 

	/*
		Action : Logout 
		Route  : /welcome/logout
		Method : GET
		Params : null
	*/
	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('name');
		$this->session->unset_userdata('is_login');
		$this->session->unset_userdata('role');
		redirect('welcome/login');
	}
}
