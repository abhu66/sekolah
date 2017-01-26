<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/** 
 * Siswa Model Class
 *
 * @package     SYSTEM APPLICATION INTERNAL
 * @subpackage  Models
 * @category    Models
 * @author      Didi Triawan
 */

class Guru_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

  function get($params = array()){
  	if(isset($params['id'])){
  		$this->db->where('guru.guru_id',$params['id']);
  	}
  	if(isset($params['nik'])){
  		$this->db->where('guru.guru_nik',$params['nik']);
  	}
  	if(isset($params['name'])){
  		$this->db->where('guru.guru_name',$params['name']);
  	}
  	if(isset($params['limit'])){
  		if(!isset($params['offset'])){
  			$params['offset'] = NULL;
  		}
  		$this->db->limit($params['limit'],$params['offset']);
  	}
    if(isset($params['order_by'])){
    	$this->db->order_by($params['order_by'],'desc');
    }
    $this->db->select('guru.guru_id, guru_nik, guru_name,guru_place_birth,guru_birth_date, guru_gender, guru_religion, guru_addres, guru_email, guru_image,guru_telp, guru_status, guru_input_date, guru_last_update');
    $res = $this->db->get('guru');
    if(isset($params['id']) OR isset($params['nik'])){
    	return $res->row_array();
    } else {
    	return $res->result_array();
    }
  }
    function add($data = array()){
    	if(isset($data['guru_id'])){
    		$this->db->set('guru_id',$data['guru_id']);
    	}
    	if(isset($data['guru_nik'])){
    		$this->db->set('guru_nik',$data['guru_nik']);
    	}
    	if(isset($data['guru_name'])){
    		$this->db->set('guru_name',$data['guru_name']);
    	}
    	if(isset($data['guru_place_birth'])){
    		$this->db->set('guru_place_birth',$data['guru_place_birth']);
    	}
    	if(isset($data['guru_birth_date'])){
    		$this->db->set('guru_birth_date',$data['guru_birth_date']);
    	}
    	if(isset($data['guru_gender'])){
    		$this->db->set('guru_gender',$data['guru_gender']);
    	}
    	if(isset($data['guru_religion'])){
    		$this->db->set('guru_religion',$data['guru_religion']);
    	}
    	if(isset($data['guru_addres'])){
    		$this->db->set('guru_addres',$data['guru_addres']);
    	}
    	if(isset($data['guru_email'])){
    		$this->db->set('guru_email',$data['guru_email']);
    	}
    	if(isset($data['guru_image'])){
    		$this->db->set('guru_image',$data['guru_image']);
    	}

    	if(isset($data['guru_telp'])){
    		$this->db->set('guru_telp',$data['guru_telp']);
    	}
    	if(isset($data['guru_status'])){
    		$this->db->set('guru_status',$data['guru_status']);
    	}

    	if(isset($data['guru_input_date'])){
    		$this->db->set('guru_input_date',$data['guru_input_date']);
    	}
    	if(isset($data['guru_last_update'])){
    		$this->db->set('guru_last_update',$data['guru_last_update']);
    	}
        if(isset($data['guru_id'])){
        	$this->db->where('guru_id',$data['guru_id']);
        	$this->db->update('guru');
        	$id = $data['guru_id'];
        } else {
        	$this->db->insert('guru');
        	$id = $this->db->insert_id();
        }
        $status = $this->db->affected_rows()
        return ($status == 0) ? FALSE : $id;	
    }
   function delete($id){
   	$this->db->where('guru_id',$id);
   	$this->db->delete('guru');
   }
}