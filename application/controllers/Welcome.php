<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url', 'form'));
		$this->load->library(array('form_validation', 'session'));
	}

	
	public function index()
	{
		$this->load->view('register_customer');
	}

	
	public function employee()
	{
		$this->load->view('register_employee');
	}

	
	public function register_customer()
	{
		if ($this->input->method() !== 'post') { redirect(''); }

		$this->form_validation->set_rules($this->_common_rules());
		if ($this->form_validation->run() === FALSE) {
			return $this->load->view('register_customer');
		}

		$data = $this->_collect_common();
		

		$this->session->set_flashdata('success', 'Customer account created. You can now log in.');
		redirect('');
	}

	public function register_employee()
	{
		if ($this->input->method() !== 'post') { redirect('welcome/employee'); }

		$rules   = $this->_common_rules();
		$rules[] = array('field' => 'department', 'label' => 'Department', 'rules' => 'required|in_list[Field Operations - Technician,Dispatch,IT,Sales,Administration]');
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run() === FALSE) {
			return $this->load->view('register_employee');
		}

		$data = $this->_collect_common();
		$data['department'] = $this->input->post('department', TRUE);
		

		$this->session->set_flashdata('success', 'Employee account created. You can now log in.');
		redirect('welcome/employee');
	}

	

	private function _common_rules()
	{
		return array(
			array('field' => 'first_name',       'label' => 'First Name',       'rules' => 'trim|required|max_length[50]'),
			array('field' => 'last_name',        'label' => 'Last Name',        'rules' => 'trim|required|max_length[50]'),
			array('field' => 'middle_name',      'label' => 'Middle Name',      'rules' => 'trim|max_length[50]'),
			array('field' => 'birthdate',        'label' => 'Birthdate',        'rules' => 'required'),
			array('field' => 'gender',           'label' => 'Gender',           'rules' => 'required|in_list[Female,Male,Other]'),
			array('field' => 'email',            'label' => 'Email',            'rules' => 'trim|required|valid_email'),
			array('field' => 'phone',            'label' => 'Phone Number',     'rules' => 'trim|required|max_length[20]'),
			array('field' => 'address',          'label' => 'Address',          'rules' => 'trim|required'),
			array('field' => 'username',         'label' => 'Username',         'rules' => 'trim|required|min_length[5]|max_length[30]'),
			array('field' => 'password',         'label' => 'Password',         'rules' => 'required|min_length[8]'),
			array('field' => 'confirm_password', 'label' => 'Confirm Password','rules' => 'required|matches[password]'),
		);
	}

	private function _collect_common()
	{
		return array(
			'first_name'  => $this->input->post('first_name', TRUE),
			'last_name'   => $this->input->post('last_name', TRUE),
			'middle_name' => $this->input->post('middle_name', TRUE),
			'birthdate'   => $this->input->post('birthdate', TRUE),
			'gender'      => $this->input->post('gender', TRUE),
			'email'       => $this->input->post('email', TRUE),
			'phone'       => $this->input->post('phone', TRUE),
			'address'     => $this->input->post('address', TRUE),
			'username'    => $this->input->post('username', TRUE),
			'password'    => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
		);
	}
}
