<?php
class Forum extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('supermodel');
		$this->load->model('fungsional');
		$this->load->model('diskusi_model');
		$this->load->library('form_validation');
		
		$this->fungsional->cek_log();
	}


	function index()
	{
		$merge = $this->fungsional->get_profile();		
		$data['title'] = "Forum Dialog Digital";
		$data['konten'] = "kategoriforum";

		$data['kategori'] = $this->supermodel->getData('ktforum',array('ktforum_parent'=>0,'ktforum_type'=>0),'ktforum_id','asc');

		$ex = array_merge($data, $merge);
		$this->load->vars($ex);
		$this->load->view('backend/template');
	}

	function kategori($id=null)
	{
		if($id!=null) {
			$merge = $this->fungsional->get_profile();		
			$data['title'] = "Forum Dialog Digital";
			$data['konten'] = "treadforum";

			$data['kategori'] = $this->supermodel->getData('ktforum',array('ktforum_id'=>$id))->row_array();

			$data['subkategori'] = $this->supermodel->getData('ktforum',array('ktforum_parent'=>$id,'ktforum_type'=>0));
			if(!$data['subkategori']) {
				redirect('forum/tread/'.$id);
			}

			$ex = array_merge($data, $merge);
			$this->load->vars($ex);
			$this->load->view('backend/template');
		}
	}

	function addview($id)
	{
		$abl = $this->supermodel->getData('ktforum',array('ktforum_id'=>$id))->row();
		$in['ktforum_view'] = $abl->ktforum_view + 1;
		$save = $this->supermodel->updateData('ktforum','ktforum_id',$id,$in);
		redirect('forum/tread/'.$id);
	}

	function tread($id=null)
	{
		$merge = $this->fungsional->get_profile();		
		$data['title'] = "Forum Dialog Digital";
		$data['konten'] = "forum";

		$data['kategori'] = $this->supermodel->getData('ktforum',array('ktforum_id'=>$id))->row_array();

		$link = 'forum/tread/'.$id.'/';
		$limit= 10;
		$uri_segment = 4;
		$offset= $this->uri->segment($uri_segment);
		$jum = $this->diskusi_model->getData('diskusi',array('ktforum_id'=>$id));

		$data['listview'] = $this->diskusi_model->getData('diskusi',array('ktforum_id'=>$id),'tanggal','desc',$limit,$offset);
		$this->fungsional->paging($link,$jum,$limit,$uri_segment);

		$ex = array_merge($data, $merge);
		$this->load->vars($ex); 
		$this->load->view('backend/template');
	}

	function post()
	{
		$ktforum = $this->input->post('ktforum_id');
		$this->form_validation->set_rules('posting','Posting','required');
		if($this->form_validation->run()===TRUE) {
			$in['posting'] = $this->input->post('posting');
			$in['member_id'] = $this->input->post('member_id');
			$in['ktforum_id'] = $ktforum;
			$in['tanggal'] = date('Y-m-d H:i:s');
			if($_FILES['gambar']['name']) {
				$ext = end(explode(".", $_FILES['gambar']['name']));
				$namagambar = rand(000000,999999).".".$ext;
				$this->fungsional->uploads('./uploads/forum/','jpg|png|gif|jpeg',2024,$namagambar,'gambar');
				$in['gambar'] = $namagambar;
			}

			$save = $this->supermodel->insertData('diskusi',$in);
			if($save) {
				redirect('forum/tread/'.$ktforum);
			}
		} else {
			redirect('forum/tread/'.$ktforum);
		}

	}

	function comment($id=null)
	{
		$diskusi_id = $this->input->post('diskusi_id');
		$this->form_validation->set_rules('komentar','komentar','required');
		if($this->form_validation->run()===TRUE) {
			$in['komentar'] = $this->input->post('komentar');
			$in['member_id'] = $this->input->post('member_id');
			$in['diskusi_id'] = $diskusi_id;
			$in['tanggal'] = date('Y-m-d H:i:s');
			if($_FILES['gambar']['name']) {
				$ext = end(explode(".", $_FILES['gambar']['name']));
				$namagambar = rand(000000,999999).".".$ext;
				$this->fungsional->uploads('./uploads/forum/','jpg|png|gif|jpeg',2024,$namagambar,'gambar');
				$in['gambar'] = $namagambar;
			}

			$save = $this->supermodel->insertData('komen',$in);
			if($save) {
				redirect('forum/tread/'.$id);
			}
		} else {
			redirect('forum/tread/'.$id);
		}

	}	

	function delete($id=null)
	{
		$ktforum = "";
		$merge = $this->fungsional->get_profile();
		if(md5($merge['member_id'])==$this->uri->segment(4)) {
			$cek = $this->supermodel->getData('diskusi',array('diskusi_id'=>$id));
			if($cek) {
				foreach ($cek->result() as $kk) {
					$img = $kk->gambar;
					$ktforum = $kk->ktforum_id;
				}
				if($img!="") {
					@unlink("./uploads/forum/".$img);
				}
			}
			$this->supermodel->deleteData('diskusi','diskusi_id',$id);
			redirect('forum/tread/'.$ktforum);
		}
	}

	function deletekomen($id=null)
	{
		$ktforum = $this->uri->segment(5);
		$merge = $this->fungsional->get_profile();
		$cek = $this->supermodel->getData('komen',array('komen_id'=>$id));
		if($cek) {
			foreach ($cek->result() as $kk) {
				$img = $kk->gambar;
			}
			if($img!="") {
				@unlink("./uploads/forum/".$img);
			}
		}
		$this->supermodel->deleteData('komen','komen_id',$id);
		redirect('forum/tread/'.$ktforum);
	}

}
?>