<?php
/**
* 
*/
class Instansi extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('fungsional');
		$this->load->model('supermodel');
		$this->load->library('form_validation');
		if($this->session->userdata('status')!='superadmin'){redirect('admain');}
		error_reporting(0);
	}

	function index($akses=null)
	{
		$merge = $this->fungsional->get_profile();		
		$data['title'] = "Data Master Instansi";
		$data['konten'] = "jabatan";
		$data['jabatan'] = $this->supermodel->getData($table='dinas')->result();
		if($akses=='edit') {
			$id = $this->uri->segment(4);
			$data['getData'] = $this->supermodel->getData('dinas', array('dinas_id'=>$id))->result_array();
		}

		$this->form_validation->set_rules('jabatan_nama','Nama Instansi','required');
		if($this->form_validation->run()===TRUE)
		{
			$id = $this->input->post('jabatan_id');
			$inp['dinas_nama'] = $this->input->post('jabatan_nama');

			if($id) {
				$saved = $this->supermodel->updateData('dinas','dinas_id',$id,$inp);
			} else {
				$saved = $this->supermodel->insertData('dinas',$inp);
			}
			$this->session->set_flashdata('sukses', 'Sekses, data instansi tersimpan!!');
			redirect('instansi');
		}

		$ex = array_merge($data, $merge);
		$this->load->vars($ex);
		$this->load->view('backend/template');
	}

	function hapus($id=null)
	{
		if($id==null){
			$this->session->set_flashdata('error', 'Maaf, Tidak dapat menghapus data');
			redirect('instansi');
		} else {
			$hapus = $this->supermodel->deleteData('dinas','dinas_id',$id);
			if($hapus) {
				$this->session->set_flashdata('sukses', 'Sekses, data dinas terhapus!!');
			} else {
				$this->session->set_flashdata('error', 'Gagal, data dinas gagal terhapus!!');
			}
			redirect('instansi');
		}
	}

}
?>