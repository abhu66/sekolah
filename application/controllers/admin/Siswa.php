<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Siswa controllers class
 *
 * @package     SYSTEM Application Internal
 * @subpackage  Controllers
 * @category    Controllers
 * @author      Didi Triawan
 */
class Siswa extends CI_Controller {

	function __construct(){
		parent::__construct();
		if($this->session->userdata('logged') == NULL){
			header("Location:".site_url('admin/auth/login') . '?location:'.urlencode($_SERVER['REQUEST_URI']));
		}
		$this->load->model(array('Activity_log_model','Siswa_model'));
		$this->load->helper(array('url','file'));
	}
	
	 public function index($offset = NULL){
	 	$this->load->library('pagination');
	 	$data['siswa'] = $this->Siswa_model->get(array('status'=>TRUE));
	 	$data['title'] = 'Siswa List';
	 	$data['main'] = 'admin/siswa/siswa_list';
	 	$this->load->view('admin/layout',$data);
	 }

	 public function detail($id = NULL){
	 	if($this->Siswa_model->get(array('id'=>$id)) == NULL){
	 		redirect('admin/siswa');
	 	}
	 	$data['title'] = 'Detail Siswa';
	 	$data['siswa'] = $this->Siswa_model->get(array('id'=>$id));
	 	$data['main'] = 'admin/siswa/siswa_view';
	 	$this->load->view('admin/layout',$data);
	 }

	 public function add($id = NULL){
	 	$this->load->library('form_validation');
	 	$this->form_validation->set_rules('siswa_nik','No Induk Pelajar','trim|required|xss_clean');
	 	$this->form_validation->set_rules('siswa_name','Nama Pelajar','trim|required|xss_clean');
	 	$this->form_validation->set_rules('siswa_place_birth','Tempat Lahir','trim|required|xss_clean');
	 	$this->form_validation->set_rules('siswa_birth_date','Tanggal Lahir','trim|required|xss_clean');
	 	$this->form_validation->set_rules('siswa_gender','Umur Pelajar','trim|required|xss_clean');
	 	$this->form_validation->set_rules('siswa_religion','Agama Pelajar','trim|required|xss_clean');
	 	$this->form_validation->set_rules('siswa_email','Email Pelajar','trim|required|xss_clean');
	 	$this->form_validation->set_rules('siswa_hp','No Telepon','trim|required|xss_clean');
	 	$this->form_validation->set_rules('siswa_status','Status Pelajar','trim|required|xss_clean');
	 	$this->form_validation->set_rules('siswa_address','Alamat Pelajar','trim|required|xss_clean');
	 	$this->form_validation->set_error_delimiters('');
	 	$data['operation'] = is_null($id) ? 'Tambah' : 'Sunting';
	 	if($_POST AND $this->form_validation->run() == TRUE){
	 		if($this->input->post('siswa_id')){
	 			$params['siswa_id'] = $this->input->post('siswa_id');
	 		} else {
	 			$params['siswa_input_date'] = date('Y-m-d H:i:s');
	 		}
	 		$params['siswa_nik'] = $this->input->post('siswa_nik');
	 		$params['siswa_name'] = $this->input->post('siswa_name');
	 		$params['siswa_place_birth'] = $this->input->post('siswa_place_birth');
	 		$params['siswa_birth_date'] = $this->input->post('siswa_birth_date');
	 		$params['siswa_gender'] = $this->input->post('siswa_gender');
	 		$params['siswa_religion'] = $this->input->post('siswa_religion');
	 		$params['siswa_email'] = $this->input->post('siswa_email');
	 		$params['siswa_hp'] = $this->input->post('siswa_hp');
	 		$params['siswa_status'] = $this->input->post('siswa_status');
	 		$params['siswa_address'] = $this->input->post('siswa_address');
	 		$params['siswa_last_update'] = $this->input->post('siswa_last_update');
	 		$params['jurusan_jurusan_Id'] = $this->input->post('jurusan_jurusan_Id');
	 		$params['krs_krs_id'] = $this->input->post('krs_krs_id');
	 		$params['kelas_kelas_id'] = $this->input->post('kelas_kelas_id');
	 		$status = $this->Siswa_model->add($params);
	 		if(!empty($_FILES['siswa_image']['name'])){
	 			$paramsup['siswa_image'] = $this->do_upload($name = 'siswa_image');
	 		}
	 		 if($this->input->post('siswa_id')){
	 		 	$paramsup['siswa_id'] = $id;
	 		 } else {
	 		 	$paramsup['siswa_id'] = $status;
	 		 }
	 		 $this->Siswa_model->add($paramsup);

	 		//activity log
	 		 $this->Activity_log_model->add(array('log_date'=>date('Y-m-d'),
	 		 	                                  'user_id'=>$this->session->userdata('user_id'),
	 		 	                                  'log_module'=>'siswa',
	 		 	                                  'log_action'=>$data['operation'] . 'siswa',
	 		 	                                  'log_info'=>'ID:'.$status.';Title:'.$this->input->post('siswa_name')
	 		 	                                  )
	 		 );
	 		 $this->session->set_flashdata('success',$data['operation'] . 'Siswa berhasil');
	 		 redirect('admin/siswa');
        } else {
        	if($this->input->post('siswa_id')){
        		redirect('admin/siswa/edit/'.$this->input->post('siswa_id'));
        	}
        	//edit siswa
        	if(!is_null($id)){
        		$data['siswa'] = $this->Siswa_model->get(array('id'=>$id));
        	} 
        	    $data['title'] = $data['operation'] . 'siswa';
        	    $data['main'] = 'admin/siswa/siswa_add';
        	    $this->load->view('admin/layout',$data);
        }
	 }
	 function delete($id = NULL){
	 	if($_POST){
	 		$this->Siswa_model->delete($this->input->post('del_id'));
	 		//activity log
	 		$this->Activity_log_model->add(array('log_date'=>date('Y-m-d'),
	 			                                 'user_id'=>$this->session->userdata('user_id'),
	 			                                 'log_module'=>'siswa',
	 			                                 'log_action'=> 'hapus',
	 			                                 'log_info'=>'ID:'.$this->input->post('del_id').';Title:'.$this->input->post('del_name')
	 			                                 )
	 		);
	 		$this->session->set_flashdata('success','Hapus data siswa berhasil');
	 		redirect('admin/siswa');
	 	} elseif (!$_POST) {
	 		$this->session->set_flashdata('delete','Delete');
	 		redirect('admin/siswa/edit/',$id);
	 	}
	 }

	 function do_upload($name = NULL){
	 	$this->load->library('upload');
	 	$config['upload_path'] = FCPATH . 'uploads/siswas';
	 	if(!is_dir($config['upload_path'])){
	 		echo mkdir($config['upload_path'],0777,TRUE);
	 	}
	 	$config['allwoed_types'] = 'gif|jpg|jpeg|png';
	 	$config['max_size'] = '32000';
	 	$this->upload->initialize($config);
	 	if(!$this->upload->do_upload($name)){
            echo $config['upload_path'];
            $this->session->set_flashdata('success',$this->upload->display_errors(''));
            redirect(uri_string());
	 	}
	 	$upload = $this->upload->data();
	 	return $upload['file_name'];
	 }
}