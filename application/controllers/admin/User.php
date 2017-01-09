<?php
if(defined('BASEPATH')) exit ('No direct script acces allowed');

class User extends CI_Controller{

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
		$this->load->library('pagination');
		$data['title'] = 'User List';
		$data['user'] = $this->User_model->get(array('status'=>TRUE));
		$data['main'] = 'admin/user/user_view';
		$this->load->view('admin/layout',$data); 
	}
	function add($id = NULL){
		$this->load->library('form_validation');
		if(!$this->input->post('user_id')){
		$this->form_validation->set_rules('user_name','Username','trim|required|xss_clean');
		$this->form_validation->set_rules('user_password','Password','trim|required|xss_clean|min_lenght[6]');
		$this->form_validation->set_rules('passconf','Password Confirmation','trim|required|xss_clean|min_lenght[6]matches[user_password']);
		
	} 
	    $this->form_validation->set_rules('user_full_name','Nama Lengkap','trim|required|xss_clean');
	    $this->form_validation->set_rules('user_email','Email','trim|required|xss_clean|valid_email');
	    $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
	    $data['operation'] = is_null($id) ? 'Tambah' : 'Sunting';
	    if($_POST AND $this->form_validation->run() == TRUE){
	    	if($this->input->post('user_id')){
	    		$params['user_id'] = $this->input->post('user_id');
	    	} else {
	    		$params['user_password'] = sha1($this->input->post('user_password'));
	    		$params['user_input_date'] = date('Y-m-d H:i:s');
	    	}
	    	$params['user_id'] = $this->input->post('user_id');
	    	$params['user_name'] = $this->input->post('user_name');
	    	$params['user_password'] = sha1($this->input->post('user_password'));
	    	$params['user_full_name'] = $this->input->post('user_full_name');
	    	$params['user_email'] = $this->input->post('user_email');
	    	$params['user_description'] = $this->input->post('user_description');
	    	$params['user_last_update'] = date('Y-m-d H:i:s');
	    	$params['user_role_role_id'] =$this->input->post('user_role_role_id');
	    	$status = $this->User_model->add($params);
	    	//proses upload file gambar
	    	if(!empty($_FILES['user_image']['name'])){
	    		$paramsupdate['user_image'] = $this->do_upload($name = 'user_image');
	    	}
	    	if($this->input->post('user_id')){
	    		$paramsupdate['user_id'] = $id;
	    	} else {
	    		$paramsupdate['user_id'] = $status;
	    	}
	    	$this->User_model->add($paramsupdate);
	    	// activity log
	    	$this->Activity_log_model->add(array('log_date'=>date('Y -m-d'),
	    		                                 'user_id'=>$this->session->userdata('user_id'),
	    		                                 'log_module'=> 'User',
	    		                                 'log_action'=> $data['operation'] .'User',
	    		                                 'log_info'=>'ID:'.$status.';Title:'.$this->input->post('user_name')
	    		                                 )
	    	);
	    	$this->session->set_flashdata('success',$data['operation'] . 'Pengguna Berhasil');
	    	redirect('admin/user');
	    } else {
	    	if($this->input->post('user_id')){
	    		redirect('admin/user/edit/'.$this->input->post('user_id'));
	    	}

	    	// mode edit / proses edit
	    	if(!is_null($id)){
	    		if($this->User_model->get(array('id'=>$id)) == NULL){
	    			redirect('admin/user');
	    		} else {
	    			$data['user'] = $this->User_model->get(array('id'=>$id));
	    		}
	    	}
	    	         $data['role'] = $this->User_model->get_role();
	    	         $data['button'] = ($id == $this->session->userdata('user_id')) ? 'Ubah' : 'Reset';
	    	         $data['title'] = $data['operation'] .'Pengguna';
	    	         $data['main'] = 'admin/user/user_add';
	    	         $this->load->view('admin/layout',$data);
	        }
       }
       function detail($id = NULL){
       	if($this->User_model->get(array('id'=>$id)) == NULL){
       		redirect('admin/user');
       	}
       	$data['title'] = 'Detail|Pengguna'
        $data['user'] = $this->User_model->get(array('id'=>$id));
        $data['main'] = 'admin/user/user_view';
        $this->load->view('admin/layout',$data);
        }

        function delete($id = NULL){
        	if($this->User_model->get(array('id'=>$id)) == NULL){
        		redirect('admin/user');
        	}
        	if($_POST){
        		$this->User_model->delete($this->input->post('del_id'));
        		//activity log
        		$this->Activity_log_model->add(array('log_date'=>date('Y-m-d'),
        			'user_id'=>$this->session->userdata('user_id'),
        			'log_module'=>'Pengguna',
        			'log_action'=>'Hapus Pengguna',
        			'log_info'=>'ID:'.$status.';Title:'.$this->input->post('del_id')
        			)
        		);
        		$this->session->set_flashdata('success','Hapus pengguna Berhasil');
        		redirect('admin/user');
        	} elseif (!$_POST) {
        		$this->session->set_flashdata('delete','Delete');
        		redirect('admin/user/'.$id);
        	}
        }
        //reset password
        function rpw($id = NULL){
        	$this->load->library('form_validation');
        	$this->form_validation->set_rules('user_password','Password','trim|required|xss_clean|min_lenght[6]');
        	$this->form_validation->set_rules('passconf','Password Confirmation','trim|required|xss_clean|min_lenght[6]|matches[user_password');
        	$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
        	if($_POST AND $this->form_validation->run() == TRUE){
        		$id = $this->input->post('user_id');
        		$params['user_password'] = sha1($this->input->post('user_password'));
        		$status = $this->User_model->change_password($id,$params);
        		//activity log
        		$this->Activity_log_model->add(array('log_date'=>date('Y-m-d'),
        			'user_id'=>$this->session->userdata('user_id'),
        			'log_module'=>'pengguna',
        			'log_action'=>'reset password',
        			'log_info'=>'ID:'.$status.';Title:'.$this->input->post('user_name')
        			)
        		);
        		$this->session->set_flashdata('success Reset password Berhasil');
        		redirect('admin/user');
        	} else {
        		if($this->User_model->get(array('id'=>$id)) == NULL){
        			redirect('admin/user');
        		}
        		$data['user'] = $this->User_model->get(array('id'=>$id));
        		$data['title'] = 'Reset password';
        		$data['main'] = 'admin/user/change_pass';
        		$this->load->view('admin/layout',$data);
        	}
        }
     // setting file yang akan di upload dan ruang penyimpanan
    function do_upload($name=NULL) {
        $this->load->library('upload');

         $config['upload_path'] = FCPATH . 'uploads/users/';

        /* create directory if not exist */
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, TRUE);
        }

        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = '32000';
        $this->upload->initialize($config);

        if (!$this->upload->do_upload($name)) {
            echo $config['upload_path'];
            $this->session->set_flashdata('success', $this->upload->display_errors(''));
            redirect(uri_string());
        }

        $upload_data = $this->upload->data();

        return $upload_data['file_name'];
    }
}

