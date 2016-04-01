<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Diskusi_model extends CI_Model {
	
	var $knj = 'knj_';
	
	function getData($table, $field, $order='', $dasc='desc', $limit='', $offset='') {
		$this->db->select('*');
		$this->db->from($this->knj.$table);
		$this->db->join('knj_member',$this->knj.$table.'.member_id=knj_member.member_id');
		$this->db->join('knj_dinas','knj_member.member_dinas_id=knj_dinas.dinas_id');

		if(!empty($field)) {
			$this->db->where($field);
		}
		
		if(empty($order)):
			$this->db->order_by($table.'_id', $dasc);
		else:
			$this->db->order_by($order, $dasc);
		endif;
		
		if(!empty($limit)):
			$this->db->limit($limit,$offset);
		endif;
		
		$get = $this->db->get();
		
		return $get;
	}
}
?>