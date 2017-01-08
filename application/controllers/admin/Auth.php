<?php
if(!defined('BASEPATH')) exit ('Non direct script access allowed');

class Auth extends CI_Controller{
	
	public function __construct(){
		parent:: __construct();
		$this->load->helper('url');
		$this->load->model('User_model');
		$this->load->helper('string');
		$this->load->library('form_validation');
    }
	function index(){
		redirect('admin/Auth/login');
	}
	function login(){
		if($this->session->userdata('logged')) {
			redirect('admin');
		}
		$data['title'] = 'FORM LOGIN';
		$this->form_validation->set_rules('username','Username','trim|required');
		$this->form_validation->set_rules('password','Password','trim|required');
		if($_POST AND $this->form_validation->run() == TRUE) {
			if($this->input->post('location')){
			$lokasi = $this->input->post('location');
		} else {
			$lokasi = NULL;
		}
		$this->proccess_login($lokasi);
	} else {
		$this->load->view('admin/login',$data);
	}
}

function proccess_login($lokasi = ''){
	$this->load->library('form_validation');
	$this->form_validation->set_rules('username','Username','required');
	$this->form_validation->set_rules('password','Password','required');

	if($this->form_validation->run() == TRUE) {
		$username = $this->input->post('username',TRUE);
		$password = $this->input->post('password',TRUE);
		$this->db->from('user');
		$this->db->where('user_name',$username);
		$this->db->where('user_password',sha1($password));
		$this->db->where('user_is_deleted',FALSE);
		$query = $this->db->get();
			if($query->num_rows() > 0) {
				$this->session->set_userdata('logged',TRUE);
				$this->session->set_userdata('user_id',$query->row('user_id'));
				$this->session->set_userdata('user_name',$query->row('user_name'));
				$this->session->set_userdata('user_role',$query->row('user_role'));
				$this->session->set_userdata('user_email',$query->row('user_email'));
				$this->session->set_userdata('user_full_name',$query->row('user_full_name'));

				if($lokasi != ''){
					header("Loaction:" .htmlspecialchars($lokasi));
				} else {
					$this->session->set_flashdata('failed','Sorry username or password is Wrong');
					redirect('admin/auth/login');
				}
			}
		}else {
			$this->session->set_flashdata('failed','Sory, username or password not complete');
			redirect('admin/auth/login');
		}
	}

	#proses Logout
	function logout(){
		$this->session->sess_destroy();
		redirect('admin/auth');
	}
}
