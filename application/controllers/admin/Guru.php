<?php
if(!defined('BASEPATH')) exit ('No direct script access allowed');

class Guru extends CI_Controller{
	
	public function __construct()
	{
		parent:: __construct();
		$this->load->model(array('Guru_model','Activity_log_model'));
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
		$data['main'] = 'admin/guru/guru_list';
		$this->load->view('admin/layout',$data);   
	}

	function detail($id = NULL){
		if($this->Guru_model->get(array('id')) == NULL){
			redirect('admin/guru');
		}
		$data['title'] = 'Detail Guru';
		$data['guru'] = $this->Guru_model->get(array('id'=>$id));
		$data['main'] = 'admin/guru/guru_view';
		$this->load->view('admin/layout',$data);
	}

	function add($id = NULL){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('guru_nik','NIK','trim|required|xss_clean');
		$this->form_validation->set_rules('guru_name','Name','trim|required|xss_clean');
		$this->form_validation->set_rules('guru_place_birth','Place Birth','trim|required|xss_clean');
		$this->form_validation->set_rules('guru_birth_date','Birth Date','trim|required|xss_clean');
		$this->form_validation->set_rules('guru_gender','Gender','trim|required|xss_clean');
		$this->form_validation->set_rules('guru_religion','Religion','trim|required|xss_clean');
		$this->form_validation->set_rules('guru_address','Address','trim|required|xss_clean');
		$this->form_validation->set_rules('guru_email','Email','trim|required|xss_clean');
		$this->form_validation->set_rules('guru_contact_person','Contact','trim|required|xss_clean');
		$this->form_validation->set_rules('guru_status','status','trim|required|xss_clean');
		if($_POST AND $this->form_validation->run() == TRUE){
			if($this->input->post('guru_id')){
				$params['guru_id'] = $this->input->post('guru_id');
			} else {
				$params['guru_input_date'] = date('Y-m-d H:i:s');
			}
			$params['guru_nik'] = $this->input->post('guru_nik');
		    $params['guru_name'] = $this->input->post('guru_name');
		    $params['guru_place_birth'] = $this->input->post('guru_place_birth');
		    $params['guru_birth_date'] = $this->input->post('guru_birth_date');
		    $params['guru_gender'] = $this->input->post('guru_gender');
		    $params['guru_religion'] = $this->input->post('guru_religion');
		    $params['guru_address'] = $this->input->post('guru_address');
		    $params['guru_email'] = $this->input->post('guru_email');
		    $params['guru_contact_person'] = $this->input->post('guru_contact_person');
		    $params['guru_status'] = $this->input->post('guru_status');
		    $params['matkul_matkul_id'] = $this->input->post('matkul_matkul_id');
		    $params['matkul_matkul_id'] = $this->input->post('guru_nik');
		    $status = $this->Guru_model->add($params);
		    if(!empty($_FILES['guru_image']['name'])){
		    	$uploadimage['guru_image'] = $this->do_upload($name = 'guru_image');
		    }	
		    if($this->input->post('guru_id')){
		    	$uploadimage['guru_id'] = $id;
		    } else {
		    	$uploadimage['guru_id'] = $status;
		    }
		    $this->Guru_model->add($uploadimage);

		    //activity log
		    $this->Activity_log_model->add(array('log_date'=>date('Y-m-d'),
		    	                                 'user_id'=>$this->session->userdata('user_id'),
		    	                                 'log_module'=>'Guru',
		    	                                 'log_action'=>$data['operation'] .'Guru',
		    	                                 'log_info'=>'ID:'.$status.';Title:'.$this->input->post('guru_name')
		    	                                 )
		    );
		    $this->session->set_flasdata('success',$data['operation'] .'guru');
		    redirect('admin/guru');
		} else {
			if($this->input->post('guru_id')){
				redirect('admin/guru/edit/'.$this->input->post('guru_id'));
			}
			//edit mode
			if(!is_null($id)){
				$data['guru'] = $this->Guru_model->get(array('id'=>$id));
			}
			    $data['title'] = $data['operation'] .'guru';
			    $data['main'] = 'admin/guru/guru_add';
			    $this->load->view('admin/layout',$data);
		}
	}

	function delete($id = NULL){
		if($_POST){
			$this->Guru_model->delete($this->input->post('del_id'));
			//activity_log
			$this->Activity_log_model->add(array('log_date'=>date('Y-m-d'),
				                                 'user_id'=>$this->session->userdata('user_id'),
				                                 'log_module'=>'Guru',
				                                 'log_action'=>'Hapus',
				                                 'log_info'=>'ID:'.$this->input->post('del_id').';Title:'.$this->input->post('del_name')
				                                 )
			);
			$this->session->set_flasdata('success','Hapus data guru berhasil');
			redirect('admin/guru');
		} elseif (!$_POST) {
			$this->session->set_flasdata('delete','Delete');
			redirect('admin/guru/edit/',$id);
		}
	}

	function do_upload($name = NULL){
		$this->load->library('upload');
		$config['upload_path'] = FCPATH . 'uploads/guru';
		if(!is_dir($config['upload_path'])){
			mkdir($config['upload_path'], 0777, TRUE);
		}
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size'] = 32000;
		$this->upload->initialize($config);
		if(!$this->upload->do_upload($name)){
			echo $config['upload_path'];
			$this->session->set_flasdata('success',$this->upload->display_errors('error'));
			redirect(uri_string());
		}
		$upload_data = $this->upload->data();
		return $upload_data['file_name'];
	}
}