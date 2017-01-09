<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/** 
 * Siswa Model Class
 *
 * @package     SYSTEM APPLICATION INTERNAL
 * @subpackage  Models
 * @category    Models
 * @author      Didi Triawan
 */

class Siswa_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }


  function get($params = array()){
   if(isset($params['id'])){
   	$this->db->where('siswa.siswa_id',$params['id']);
   }
   if(isset($params['name'])){
   	$this->db->where('siswa_name',$params['name']);
   }
   if(isset($params['date'])){
   	$this->db->where('siswa_input_date',$params['date']);
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
   $this->db->select('siswa.siswa_id, siswa_nik, siswa_name, siswa_place_birth,siswa_birth_date, siswa_gender,siswa_religion, siswa_address, siswa_email, siswa_image, siswa_hp,siswa_status,siswa_input_date,siswa_last_update,jurusan_jurusan_id,jurusan.jurusan_name')
   $this->db->join('siswa','jurusan.jurusan_id = siswa.jurusan_jurusan_id','left');
   $res = $this->db->get('siswa');
   if(isset($params['id']) OR isset($params['name'])){
     return $res->row_array();
   } else {
     return $res->result_array();
   }
 }

 function add($data = array()){
  if(isset($data['siswa_id'])){
   $this->db->set('siswa_id',$data['siswa_id']);
 }
 if(isset($data['siswa_nik'])){
   $this->db->set('siswa_nik',$data['siswa_nik']);
 }
 if(isset($data['siswa_name'])){
   $this->db->set('siswa_name',$data['siswa_name']);
 }
 if(isset($data['siswa_place_birth'])){
   $this->db->set('siswa_place_birth',$data['siswa_place_birth']);
 }
 if(isset($data['siswa_birth_date'])){
   $this->db->set('siswa_birth_date',$data['siswa_birth_date']);
 }
 if(isset($data['siswa_gender'])){
   $this->db->set('siswa_gender',$data['siswa_gender']);
 }
 if(isset($data['siswa_religion'])){
   $this->db->set('siswa_religion',$data['siswa_religion']);
 }
 if(isset($data['siswa_addres'])){
   $this->db->set('siswa_addres',$data['siswa_addres']);
 }	
 if(isset($data['siswa_email'])){
   $this->db->set('siswa_email',$data['siswa_email']);
 }	
 if(isset($data['siswa_image'])){
   $this->db->set('siswa_image',$data['siswa_image']);
 }	
 if(isset($data['siswa_hp'])){
   $this->db->set('siswa_hp',$data['siswa_hp']);
 }	
 if(isset($data['siswa_status'])){
   $this->db->set('siswa_status',$data['siswa_status']);
 }	
 if(isset($data['siswa_input_date'])){
   $this->db->set('siswa_input_date',$data['siswa_input_date']);
 }	
 if(isset($data['siswa_last_update'])){
   $this->db->set('siswa_last_update',$data['siswa_last_update']);
 }
 if(isset($data['jurusan_id'])){
   $this->db->set('jurusan_jurusan_id')
 }
 if(isset($data['siswa_id'])){
  $this->db->where('siswa_id',$data['siswa_id']);
  $this->db->update('siswa');
  $id = $data['siswa_id'];
} else {
  $this->db->insert('siswa');
  $id = $this->db->insert_id();
}
$status = $this->db->affected_rows();
return ($status == 0) ? FALSE : $id;
}

function delete($id){
  $this->db->where('siswa_id',$id);
  $this->db->delete('siswa');
}
}