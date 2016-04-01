<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Supermodel extends CI_Model {
	
	var $knj = 'knj_';
	
	function getData($table, $field=null, $order='', $dasc='desc', $limit='', $offset='') {
		$this->db->select('*');
		$this->db->from($this->knj.$table);

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
		if($get->num_rows()>0):
			return $get;
		endif;
	}
	
	function getDataAll($table, $field, $action="DESC") {
		$db = $this->db->query('select * from "$table" order by "$field_id" "$action"');
		return $db;
	}
	
	function getDataWhereId($table, $field, $where) {
		$db = $this->db->query('select * from "$table" where "$field" = "$where_id"');
		return $db;
	}
	
	function getDataWhereArray($array, $table) {
		$this->db->where($array);
		$db = $this->db->get($table);
		return $db;
	}

	function insertData($table, $data) {
		$this->db->insert($this->knj.$table, $data);
		return TRUE;
	}
	
	function updateData($table, $where, $field, $array) {
		$this->db->where($where,$field);
		$db = $this->db->update($this->knj.$table, $array);
		return $db;
	}
	
	function deleteData($table, $where, $field) {
		$this->db->where($where,$field);
		$db = $this->db->delete($this->knj.$table);
		return $db;		
	}
	
}

?>