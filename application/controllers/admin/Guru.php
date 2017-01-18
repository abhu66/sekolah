<?php
if(!defined('BASEPATH')) exit ('No direct script access allowed');

class Guru extends CI_Controller{
	
	public function __construct()
	{
		parent:: __construct();
		$this->load->model('Guru_model');
		$this->load->helper('url');
		if($this->session->userdata('logged') == NULL){
			header('Location:'.site_url('admin/auth/login') . '?location:' .urlencode($_SERVER['REQUEST_URI']));
		}
	}
	public function index($offset = NULL)
		{
		$this->load->library('pagination');
		$data['title'] = 'Guru List';
		$data['guru'] = $this->Guru_model->get(array('status'=>TRUE));
		$data['main'] = 'admin/User/user_view';
		$this->load->view('admin/layout',$data); 
	    
	}
}