<?php
if(!defined('BASEPATH')) exit ('No direct script access allowed');

class Dashboard extends CI_Controller{
	
	public function __construct()
	{
		parent:: __construct();
		$this->load->helper('url');
		if($this->session->userdata('logged') == NULL){
			header("Location:".site_url('admin/auth/login') . '?location:'.urlencode($_SERVER['REQUEST_URI']));
		}
	}
	public function index()
	{
		$this->load->model(array('User_model','Siswa_model'));
		$data['siswa'] = count($this->Siswa_model->get());
		$data['user'] = count($this->User_model->get());
		$data['title'] = 'admin|dashboard';
		$data['main'] = 'admin/dashboard/dashboard';
		$this->load->view('admin/layout',$data);
	}

}