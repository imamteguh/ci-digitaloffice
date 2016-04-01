<?php
/**
* 
*/
class Kategori extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('fungsional');
		$this->load->model('supermodel');
		$this->load->library('form_validation');
		if($this->session->userdata('status')!='admin'){redirect('admain');}
		error_reporting(0);
	}

	function index($akses=null)
	{
		$merge = $this->fungsional->get_profile();		
		$data['title'] = "Kategori";
		$data['konten'] = "kategori";
		$data['kategori'] = $this->supermodel->getData($table='kategori',array('dinas_id'=>$merge['member_dinas_id']));
		$data['datKate'] = $this->supermodel->getData('kategori', array('kategori_parent'=>0,'dinas_id'=>$merge['member_dinas_id']),'kategori_nama','asc');
		if($akses=='edit') {
			$id = $this->uri->segment(4);
			$data['getData'] = $this->supermodel->getData('kategori', array('kategori_id'=>$id))->result_array();
		}

		$this->form_validation->set_rules('kegiatan','Kegiatan','required');
		if($this->form_validation->run()===TRUE)
		{
			$id = $this->input->post('kegiatan_id');
			$inp['kategori_nama'] = $this->input->post('kegiatan');
			$inp['kategori_parent'] = $this->input->post('kategori');
			$inp['dinas_id'] = $merge['member_dinas_id'];
			if($id) {
				inputLast('Merubah Kategori Kegiatan '.$inp['kategori_nama']);
				$saved = $this->supermodel->updateData('kategori','kategori_id',$id,$inp);
			} else {
				inputLast('Menambahkan Kategori Kegiatan '.$inp['kategori_nama']);
				$saved = $this->supermodel->insertData('kategori',$inp);
			}
			
			$this->session->set_flashdata('sukses', 'Sekses, data kategori kegiatan tersimpan!!');
			redirect('kategori');
		}

		$ex = array_merge($data, $merge);
		$this->load->vars($ex);
		$this->load->view('backend/template');
	}

	function hapus($id=null)
	{
		if($id==null){
			$this->session->set_flashdata('error', 'Maaf, Tidak dapat menghapus data');
			redirect('kategori');
		} else {
			$hapus = $this->supermodel->deleteData('kategori','kategori_id',$id);
			if($hapus) {
				inputLast('Hapus Kategori Kegiatan');
				$this->session->set_flashdata('sukses', 'Sekses, data Kategori terhapus!!');
			} else {
				$this->session->set_flashdata('error', 'Gagal, data Kategori gagal terhapus!!');
			}
			redirect('kategori');
		}
	}

}
?>