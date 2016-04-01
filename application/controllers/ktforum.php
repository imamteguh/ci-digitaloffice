<?php
/**
* Author Imam Teguh
* 2015 Mei
*/
class Ktforum extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('fungsional');
		$this->load->model('supermodel');
		$this->load->library('form_validation');
		if($this->session->userdata('status')!='superadmin' ){redirect('admain');}
	}

	function index($akses=null)
	{
		$merge = $this->fungsional->get_profile();
		$data['ambil'] = array('ktforum_id'=>'','ktforum_judul'=>'','ktforum_keterangan'=>'','ktforum_icon'=>'','ktforum_parent'=>'','ktforum_type'=>'','ktforum_bg'=>'');
		$type = array('Publik','Private');

		$data['title'] = "Kategori Forum";
		$data['konten'] = "ktforum";

		$data['kategori'] = $this->supermodel->getData('ktforum');
		$data['induk'] = $this->supermodel->getData('ktforum',array('ktforum_parent'=>0));
		if($akses=='edit') {
			$id = $this->uri->segment(4);
			$data['ambil'] = $this->supermodel->getData('ktforum',array('ktforum_id'=>$id))->row_array();
		}

		$data['type'] = $type; 
		$data['bg'] = $this->bg();

		$this->form_validation->set_rules('ktforum_judul','Nama Kategori','required');
		$this->form_validation->set_rules('ktforum_keterangan','Keterangan','required');
		if($this->form_validation->run()===TRUE) {
			$ktforum_id = $this->input->post('ktforum_id');
			$in['ktforum_judul'] = $this->input->post('ktforum_judul');
			$in['ktforum_keterangan'] = $this->input->post('ktforum_keterangan');
			$in['ktforum_parent'] = $this->input->post('ktforum_parent');
			$in['ktforum_bg'] = $this->input->post('ktforum_bg');
			if($_FILES['ktforum_icon']['name']) {
				$ext = end(explode(".", $_FILES['ktforum_icon']['name']));
				$namagambar = rand(000000,999999).".".$ext;
				$this->fungsional->uploads('./uploads/forum/icon/','jpg|png|gif|jpeg',1024,$namagambar,'ktforum_icon');
				$in['ktforum_icon'] = $namagambar;
			}

			if($ktforum_id==null) {
				$this->supermodel->insertData('ktforum',$in);
				$this->session->set_flashdata('sukses', 'Sekses, data kategori tersimpan!!');
			} else {
				$this->supermodel->updateData('ktforum','ktforum_id',$ktforum_id,$in);
				$this->session->set_flashdata('sukses', 'Sekses, data kategori terupdate!!');
			}
			redirect('ktforum');

		}
		

		$ex = array_merge($data, $merge);
		$this->load->vars($ex);
		$this->load->view('backend/template');
	}


	function hapus($id=null)
	{
		if($id==null){
			$this->session->set_flashdata('error', 'Maaf, Tidak dapat menghapus data');
			redirect('ktforum');
		} else {
			$dlt = $this->supermodel->deleteData('ktforum','ktforum_id',$id);
			if($dlt) {
				$this->session->set_flashdata('sukses', 'Sekses, data kategori terhapus!!');
			} else {
				$this->session->set_flashdata('error', 'Gagal, data kategori gagal terhapus!!');
			}
			redirect('ktforum');
		}
	}



	private function bg()
	{
		$bg = array('-'=>'',
			'Merah'=>'btn-danger',
			'Orange'=>'btn-warning',
			'Biru Muda'=>'btn-info',
			'Biru Tua'=>'btn-primary',
			'Hijau'=>'btn-success');
		return $bg;
	}
}
?>