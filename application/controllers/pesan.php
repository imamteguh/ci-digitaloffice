<?php
/**
* 
*/
class Pesan extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('pesan_model');
		$this->load->model('supermodel');
		$this->load->model('fungsional');
		$this->load->library('form_validation');
		$this->load->helper('form','url');
		$this->fungsional->cek_log();
	}

	function index()
	{
		$merge = $this->fungsional->get_profile();		
		$data['title'] = "Kelola Pesan";
		$data['konten'] = "pesan";

		$email = $this->db->query('select member_email from knj_member where member_nip = "'.$this->session->userdata('username').'" ')->row_array();

		$data['terkirim'] = $this->pesan_model->getData('knj_pesan_out','pesan_member', $this->session->userdata('username'))->result();
		$data['inbox'] = $this->pesan_model->getData('knj_pesan','pesan_to', $email['member_email'])->result();

		$data['member'] = $this->supermodel->getData($table='member', '', $order='member_nama', $dasc='asc')->result_array();

		$this->form_validation->set_rules('email_to', 'email', 'required');
		if($this->form_validation->run()===TRUE)
		{
			$nip = $this->session->userdata('username');
			$pesan_detail = $this->input->post('pesan_detail');
			$tgl = gmdate("Y-m-d H:i:s", time()+60*60);
			$email = $this->input->post('email_to');
			$lampiran = '';
			if(!empty($_FILES['lampiran']['name'])) {
				$ex = end(explode('.', $_FILES['lampiran']['name']));
				$lampiran = $nip.date('d').date('s').date('i').'.'.$ex;
				move_uploaded_file($_FILES['lampiran']['tmp_name'], './uploads/lampiran/'.$lampiran);
			}

			$savedin = array('pesan_member'=>$nip,'pesan_detail'=>$pesan_detail,'pesan_lampiran'=>$lampiran,'pesan_to'=>$email,'pesan_tanggal'=>$tgl,'pesan_status'=>0);
			$savedout = array('pesan_member'=>$nip,'pesan_detail'=>$pesan_detail,'pesan_lampiran'=>$lampiran,'pesan_to'=>$email,'pesan_tanggal'=>$tgl,'pesan_status'=>0);
			$this->supermodel->insertData('pesan',$savedin);
			$this->supermodel->insertData('pesan_out',$savedout);
			$this->session->set_flashdata('sukses', 'Sukses, pesan terkirim');
			redirect('pesan');
		}
				
		$ex = array_merge($data, $merge);
		$this->load->vars($ex);
		$this->load->view('backend/template');
	}

	function detail($kode=null)
	{
		$id = $this->uri->segment(4);
		$merge = $this->fungsional->get_profile();		
		$data['title'] = "Kelola Pesan";
		$data['konten'] = "detail_pesan";

		if('inbox'==$kode) {
			$upd = array('pesan_status'=>1);
			$this->supermodel->updateData('pesan','pesan_id',$id,$upd);
			$data['row'] = $this->pesan_model->getData('knj_pesan','pesan_id', $id)->row_array();
		} else {
			$data['row'] = $this->pesan_model->getData('knj_pesan','pesan_id', $id)->row_array();
		}
		

		$ex = array_merge($data, $merge);
		$this->load->vars($ex);
		$this->load->view('backend/template');
	}

	function hapus($id=null)
	{
		if($id==null){
			$this->session->set_flashdata('error', 'Maaf, Tidak dapat menghapus data');
			redirect('pesan');
		} else {
			$table = $this->uri->segment(4);
			$hapus = $this->supermodel->deleteData($table,'pesan_id',$id);
			if($hapus) {
				inputLast('Hapus Kategori Kegiatan');
				$this->session->set_flashdata('sukses', 'Sekses, data pesan terhapus!!');
			} else {
				$this->session->set_flashdata('error', 'Gagal, data pesan gagal terhapus!!');
			}
			redirect('pesan');
		}
	}

}
?>