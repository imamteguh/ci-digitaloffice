<?php
/**
* 
*/
class User_model extends CI_Model
{
	
	var $table = 'knj_user';

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function getData($id=null, $limit=null, $offset=0,$where=null) {
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('knj_member m', $this->table.'.username=m.member_nip');
		$this->db->join('knj_dinas d', 'm.member_dinas_id=d.dinas_id');
		if($id!=null) {
			$this->db->where($this->table.'.username', $id);
			$this->db->limit($limit,$offset);
		}
		if($where!=null) {
			$this->db->where($where);
		}
		$this->db->order_by('m.member_nama', 'ASC');
		$getData = $this->db->get();
		if($getData->num_rows()>0) {
			return $getData;
		}
	}
}
?>