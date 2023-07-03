<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Model
{
	private $users = "users";
	private $abstracts = "abstracts";
	private $abstractsBase = "ABSTRACT_BASE";
	private $abstractsAffiliation = "ABSTRACT_AFFILIATION";
	private $abstractsAuthor = "ABSTRACT_AUTHOR";
	private $upload_file = "upload_file";
	
	public function get_users(){
		return $this->db->get($this->users)->result_array();
	}

	public function get_users_time(){
        $query = $this->db->query("SELECT *, time_format(b.duration,'%H시간 %i분') as d_format from users a LEFT JOIN( SELECT phone as qr_phone, MAX(time) as maxtime, MIN(time) as mintime, TIMEDIFF(MAX(time), MIN(time)) as duration from access GROUP by phone )b on a.phone = b.qr_phone ORDER BY a.id ASC");
		return $query->result_array();
	}
	
	public function get_abstracts_users(){
        $query = $this->db->query("select ab.*, uf.* from abstracts as ab left join upload_file as uf on ab.file_no = uf.idx");

		return $query->result_array();
	}


	public function get_user_check($userId){
		$this->db->where_in('id', $userId);
		$this->db->order_by('nick_name');
		return $this->db->get($this->users)->result_array();
	}

	public function get_users_order($order_by, $where){
		$this->db->where($where);
		$this->db->order_by($order_by);
		return $this->db->get($this->users)->result_array();
	}

	public function get_user($where){
		$this->db->where($where);
		return $this->db->get($this->users)->row_array();
	}

	public function add_user($info){
  		$this->db->insert($this->users, $info);
        
        $id = $this->db->insert_id();
        $registration_no = 'A2023-' . str_pad($id, 5, '0', STR_PAD_LEFT);
        $this->db->where('id', $id);
        $this->db->update($this->users, array('registration_no' => $registration_no));
	}

	public function del_user($info){
		$this->db->delete($this->users, $info);
	}

    public function num_row($info){
		$this->db->where($info);
        return $this->db->get($this->users)->num_rows();
    }

	public function update_sub_time($info, $where){
		$this->db->where($where);
		$this->db->update($this->users, $info);
	}

	public function update_deposit_status($info, $where){
		$this->db->where($where);
		$this->db->update($this->users, $info);
	}

	public function update_qr_status($info, $where){
		$this->db->where($where);
		$this->db->update($this->users, $info);
	}

	public function update_user($info, $where){
		$this->db->where($where);
		$ret = $this->db->update($this->users, $info);
        return $ret;
	}
 
    public function save_upload($data){
        $result= $this->db->insert($this->abstracts,$data);
        return $result;
    }
 
    public function insert_file_upload($data2){
        $result= $this->db->insert($this->upload_file,$data2);
        return $result;
    }

	public function get_file_upload($where){
		$this->db->where($where);
		return $this->db->get($this->upload_file)->row_array();
	}

    
    public function save_upload_abstract_base($data){
        $result= $this->db->insert($this->abstractsBase,$data);
        return $this->db->insert_id();
    }
    
    public function update_abstract_base($id, $data){
        $this->db->where($id);
        $result = $this->db->update($this->abstractsBase, $data);
        return $result;
    }

    public function get_last_index_abstract_base(){
        $query = $this->db->query("SELECT AUTO_INCREMENT AS NEXT_IDX FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'lecture-kscp2023s' AND TABLE_NAME = 'ABSTRACT_BASE'");
		return $query->result();
	}

    public function get_upload_abstract_base($idx){
		$this->db->where_in('idx', $idx);
		return $this->db->get($this->abstractsBase)->result_array();
	}
	
	public function get_new_abstracts_users(){
        $query = $this->db->query("select * from ABSTRACT_BASE");

		return $query->result_array();
	}
	
	public function get_abstract_base($where){
		$this->db->where($where);
		return $this->db->get($this->abstractsBase)->row_array();
	}
}

?>