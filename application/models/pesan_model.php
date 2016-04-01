<?php
/**
* 
*/
class Pesan_model extends CI_Model
{
	

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function getData($table,$field=null, $id=null) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->join('knj_member m', $table.'.pesan_member=m.member_nip');
		if($id!=null) {
			$this->db->where($table.'.'.$field, $id);
		}
		$this->db->order_by('pesan_tanggal', 'DESC');
		$getData = $this->db->get();
		return $getData;
	}
}
?>