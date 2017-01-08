<?php
if(defined('BASEPATH')) exit ('No direct script acces allowed');

class Profile extends CI_Controller{

	public function __construct()
	{
		parent:: __construct();
		$this->load->model('User_model');
		$this->load->helper('url');
		if($this->session->userdata('logged') == NULL){
			header('Location:'.site_url('admin/auth/login') . '?location:'.urlencode($_SERVER['REQUEST_URI']));
		}
	public function index($offset = NULL)
	{
		$id = ($this->session->userdata('user_id'));
		if($this->session->userdata('user_id') == NULL){
			redirect('admin/user')
		}
		$data['title'] = 'Profile';
		$data['user'] = $this->User_model->get(array('id' => $id));
		$data['main'] = 'admin/profile/view';
		$this->load->view('admin/layout',$data);


	}



}

