<?php
class Login_model extends CI_Model {

	var $fir_suf = 'knj_user';

	function __construct() {
		parent::__construct();
	}

	function asupcoy($userx, $passx) {
		$query = $this->db->query('select * from '.$this->fir_suf.' where username = "'.$userx.'" and password = "'.$passx.'"');
		if($query->num_rows()>0) {
			return $query->result_array();
		}
	}
}
?>