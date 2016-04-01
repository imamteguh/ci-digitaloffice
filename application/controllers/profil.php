<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//Programmer : Hikmahtiar dan Imam Teguh
//Copyright  : 2014
class Profil extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('supermodel');
		$this->load->model('fungsional');
		$this->load->library('form_validation');
		$this->fungsional->cek_log();
	}

	function index($id=null){
		$merge = $this->fungsional->get_profile();		
		$data['title'] = "Detail Profil";
		$data['konten'] = "profil";

		$data['rows'] = $this->fungsional->rows('*','knj_member a join knj_jabatan b on a.member_jabatan_id=b.jabatan_id where a.member_id = "'.$id.'"');

		$data['kegiatan'] = $this->fungsional->query('*','knj_kegiatan a join knj_kategori b on a.kegiatan_kategori_id=b.kategori_id where a.kegiatan_member = "'.$id.'" order by a.kegiatan_tanggal desc');
		
		$ex = array_merge($data, $merge);
		$this->load->vars($ex);
		$this->load->view('backend/template');
	}

}
?>