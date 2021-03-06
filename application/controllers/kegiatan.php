<?php
//Programmer : Hikmahtiar dan Imam Teguh
//Copyright  : 2014
class Kegiatan extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('supermodel');
		$this->load->model('fungsional');
		$this->load->library('form_validation');
		$this->fungsional->cek_log();
	}
	
	function index($id=null) {
		$merge = $this->fungsional->get_profile();		
		$data['title'] = "Kegiatan ".$merge['member_nama'];
		$data['konten'] = "kegiatan-instan";

		$data['tgl1'] = date("Y-m-d");
		$data['tgl2'] = date("Y-m-d");

		
		//$data['query'] = $this->fungsional->query('*', 'knj_kegiatan a join knj_kategori b on a.kegiatan_kategori_id=b.kategori_id where a.kegiatan_member= "'.$merge['member_id'].'" order by a.kegiatan_tanggal desc ');
		$data['query'] = $this->fungsional->query('*', 'knj_kegiatan where kegiatan_member= "'.$merge['member_id'].'" order by kegiatan_tanggal desc ');
		
		$data['ktg'] = $this->fungsional->query('*', 'knj_kategori where kategori_parent="0" and dinas_id="'.$merge['member_dinas_id'].'" order by kategori_nama asc');
		
		if(!empty($id)):
			$data['row'] = $this->fungsional->rows('*', "knj_kegiatan where kegiatan_id='$id'");
		else:
			$data['row'] = array('kegiatan_id'=>NULL, 'kegiatan_kategori_id'=>NULL, 'kegiatan_rincian'=>NULL, 'kegiatan_tanggal'=>gmdate('Y-m-d H:i:s', time()+60*60), 'kegiatan_hari'=>NULL, 'kegiatan_keterangan'=>NULL, 'kegiatan_member'=>NULL);
		endif;
		
		$idid = $this->input->post('idid');
		$hari = $this->input->post('hari');
		$tanggal = $this->input->post('tanggal');
		$jam = $this->input->post('jam');
		$kategori = $this->input->post('kategori');
		$detail = $this->input->post('kategorix');
		$lainnya = $this->input->post('lain');
		$keterangan = $this->input->post('keterangan');
		
		$this->form_validation->set_rules('hari','Hari','callback_cek_hari');
		$this->form_validation->set_rules('kategori','Kategori','callback_cek_kategori');
		//$this->form_validation->set_rules('keterangan','Kegiatam Keterangan','required');
		$this->form_validation->set_message('required', ' ');
		if($this->form_validation->run() == TRUE):
			if(!empty($lainnya)):
				$nya = $lainnya;
			else:
				$nya = $detail;
			endif;
			
			if($idid==''){
				$aray = array('kegiatan_id'=>NULL, 'kegiatan_kategori_id'=>$kategori, 'kegiatan_rincian'=>$nya, 'kegiatan_tanggal'=>$tanggal.' '.$jam, 'kegiatan_hari'=>$hari, 'kegiatan_keterangan'=>$keterangan, 'kegiatan_member'=>$merge['member_id']);
				$this->supermodel->insertData('kegiatan', $aray);
				inputLast('Menambah Kegiatan '.$nya);
				$this->session->set_flashdata('v','<div class="alert alert-success">Kegiatan berhasil ditambah.</div>');
			}else{
				$aray = array('kegiatan_kategori_id'=>$kategori, 'kegiatan_rincian'=>$nya, 'kegiatan_tanggal'=>$tanggal.' '.$jam, 'kegiatan_hari'=>$hari, 'kegiatan_keterangan'=>$keterangan, 'kegiatan_member'=>$merge['member_id']);
				$this->supermodel->updateData('kegiatan', 'kegiatan_id', $idid, $aray);
				inputLast('Merubah Kegiatan '.$nya);
				$this->session->set_flashdata('v','<div class="alert alert-success">Kegiatan berhasil dirubah.</div>');
			}
			redirect('kegiatan/index');	
		endif;
		
		$ex = array_merge($data, $merge);
		$this->load->vars($ex);
		$this->load->view('backend/template');
	}
	
	function cek_hari($str) {
		if($str == "") {
			$this->form_validation->set_message('cek_hari', '<div class="alert alert-danger">Hari belum dipilih.</div>');
			return FALSE;
		}else {
			return TRUE;
		}
	}
	
	function cek_kategori($str) {
		if($str == "") {
			$this->form_validation->set_message('cek_kategori', '<div class="alert alert-danger">Kategori Kegiatan belum dipilih.</div>');
			return FALSE;
		}else {
			return TRUE;
		}
	}
	
	function getkategori() {
		$get = $this->fungsional->query('*', 'knj_kategori where kategori_parent = "'.$_GET['kode'].'"');
		echo '
			<label>Detail Kegiatan</label>
			<select class="form-control chzn-select" name="kategorix">';
				echo '<option value="">- Pilih -</option>';
		foreach($get as $gt):
			if($gt['kategori_nama'] == $this->session->userdata('rincian')):
				echo '<option selected="selected">'.$gt['kategori_nama'].'</option>';
			else:
				echo '<option>'.$gt['kategori_nama'].'</option>';
			endif;
		endforeach;
		echo'</select>';
		
		$lainn = $this->fungsional->rows('*', 'knj_kategori where kategori_nama="'.$this->session->userdata('rincian').'"');
		if($lainn){
			$lain = '';
		}else{
			$lain = $this->session->userdata('rincian');
		}
		
		echo'
			<br>
			<label>Lainnya</label> <small><i style="color:red">*isi jika kegiatan yg dilakukan tidak ada di <b>detail kegiatan</b></i></small>
			<input type="text" name="lain" value="'.$lain.'" class="form-control">
			';
		//echo $this->session->userdata('rincian');
	}
	
	function blank() {
		echo "";
	}
	
	function delete($id=null) {
		$get = $this->fungsional->rows('*', 'knj_kegiatan where kegiatan_id ="$id"');
		inputLast('Menghapus Kegiatan '.$get['kegiatan_rincian']);
		$this->supermodel->deleteData('kegiatan', 'kegiatan_id', $id);
		$this->session->set_flashdata('v', '<div class="alert alert-success">Kegiatan berhasil dihapus.</div>');
		redirect('kegiatan/index');
	}

	function short()
	{

		$merge = $this->fungsional->get_profile();		
		$data['title'] = "Kegiatan ".$merge['member_nama'];
		$data['konten'] = "kegiatan-instan";
		$tgl1 = $this->input->post('tgl1');
		$tgl2 = $this->input->post('tgl2');
		$data['tgl1'] = $tgl1;
		$data['tgl2'] = $tgl2;
		if($tgl1==null) {
			$data['tgl1'] = date("Y-m-d");
			$data['tgl2'] = date("Y-m-d");
		}
		$this->session->set_flashdata('v','<div class="alert alert-info">Menampilkan data kegiatan dari tanggal '.$tgl1.' sampai '.$tgl2.'</div>');
		$this->load->model('m_kegiatan');

		$data['query'] = $this->m_kegiatan->getDataLaporan($tgl1,$tgl2,$merge['member_dinas_id'],$merge['member_id'])->result_array();
		
		//$data['query'] = $this->fungsional->query('*', 'knj_kegiatan a join knj_kategori b on a.kegiatan_kategori_id=b.kategori_id where a.kegiatan_member= "'.$merge['member_id'].'" order by a.kegiatan_tanggal desc ');
		
		$data['ktg'] = $this->fungsional->query('*', 'knj_kategori where kategori_parent="0" order by kategori_nama asc');
		
		if(!empty($id)):
			$data['row'] = $this->fungsional->rows('*', "knj_kegiatan where kegiatan_id='$id'");
		else:
			$data['row'] = array('kegiatan_id'=>NULL, 'kegiatan_kategori_id'=>NULL, 'kegiatan_rincian'=>NULL, 'kegiatan_tanggal'=>gmdate('Y-m-d H:i:s', time()+60*60), 'kegiatan_hari'=>NULL, 'kegiatan_keterangan'=>NULL, 'kegiatan_member'=>NULL);
		endif;

		$ex = array_merge($data, $merge);
		$this->load->vars($ex);
		$this->load->view('backend/template');
	}
}
?>