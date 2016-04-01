<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fungsional extends CI_Model {
	
	function cek_log() {
		if($this->session->userdata('user_id')==null):
			$this->session->set_flashdata('valid', '<div class="alert alert-info">Tidak ada akses.</div>');
			redirect('welcome');
		endif;
	}
	
	function get_profile() {
		$get = $this->db->query('select * from knj_member a join knj_dinas b on a.member_dinas_id=b.dinas_id where a.member_nip = "'.$this->session->userdata('username').'"');
		
		foreach($get->result_array() as $us):
			return $us;			
		endforeach;
	}
	function get_profile2() {
		$get = $this->db->query('select*from knj_member a join knj_user b on a.member_id=b.user_id where a.member_nip = "'.$this->session->userdata('username').'"');
		
		foreach($get->result_array() as $us):
			return $us;			
		endforeach;
	}
	
	function uploads($path, $allowed, $maxsize, $filename, $files) {
		$config['upload_path'] = $path;
		$config['allowed_types'] = $allowed;
		$config['max_size']	= $maxsize;
		$config['file_name'] = $filename;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		$this->upload->do_upload($files);
	}
	
	function rows($select, $table) {
		$get = $this->db->query("select $select from $table");
		return $get->row_array();
	}

	function paging($link,$jum,$limit,$uri_segment)
	{
		$config_page['base_url']= site_url($link);
		$config_page['total_rows']= $jum->num_rows();
		$config_page['per_page']= $limit;
		$config_page['uri_segment']= $uri_segment;
		$config_page['full_tag_open'] = '<ul class="pagination right">';
		$config_page['full_tag_close'] = '</ul>';
		$config_page['first_link'] = '&laquo; First';
		$config_page['first_tag_open'] = '<li>';
		$config_page['first_tag_close'] = '</li>';
		
		$config_page['last_link'] = 'Last &raquo;';
		$config_page['last_tag_open'] = '<li>';
		$config_page['last_tag_close'] = '</li>';
		
		$config_page['next_link'] = 'Next';
		$config_page['next_tag_open'] = '<li>';
		$config_page['next_tag_close'] = '</li>';
		
		$config_page['prev_link'] = 'Prev';
		$config_page['prev_tag_open'] = '<li>';
		$config_page['prev_tag_close'] = '</li>';
		
		$config_page['cur_tag_open'] = '<li class="active"><a href="">';
		$config_page['cur_tag_close'] = '</a></li>';
		
		$config_page['num_tag_open'] = '<li>';
		$config_page['num_tag_close'] = '</li>';
		$this->pagination->initialize($config_page);
	}


	function query($select, $table) {
		$get = $this->db->query("select $select from $table");
		return $get->result_array();
	}

	function getKategoriParent($id)
	{
		$this->db->select('kategori_nama');
			$this->db->from('knj_kategori');
			$this->db->where('kategori_id',$id);
			$getData = $this->db->get();
	
			if($getData->num_rows() > 0) 
			{
				$rowData = $getData->result_array();
				return $rowData[0]['kategori_nama'];
			} else {
				return "-";
			}
	}
		
}

?>