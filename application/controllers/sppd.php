<?php
class Sppd extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('supermodel');
		$this->load->model('fungsional');
		$this->load->model('m_kegiatan');
		
		$this->load->library('form_validation');
		
		$this->fungsional->cek_log();
	}

	function index()
	{
		$merge = $this->fungsional->get_profile();
		$data['konten'] = "sppd";

		$thn = $this->input->get('tahun');
		$bln = $this->input->get('bulan');
		if($thn == '')
		{
			$thn = date('Y');
			$bln = date('m');
		}
		$data['thn'] = $thn;
		$data['bln'] = $bln;
		$data['title'] = "Kalender kerja bulan ".bulan($bln)." tahun ".$thn;
		
		$data['user'] = $this->user_model->getData(null,'','',$where=array('m.member_dinas_id'=>$merge['dinas_id']))->result();

		$ex = array_merge($data, $merge);
		$this->load->vars($ex);
		$this->load->view('backend/template');
	}

	function views($aksi=NULL)
	{
		$merge = $this->fungsional->get_profile();
		$data['konten'] = "sppd_view";

		$thn = $this->input->get('tahun');
		$bln = $this->input->get('bulan');
		if($thn == '')
		{
			$thn = date('Y');
			$bln = date('m');
		}
		$data['thn'] = $thn;
		$data['bln'] = $bln;
		$data['title'] = "Kalender kerja bulan ".bulan($bln)." tahun ".$thn;
		
		$data['user'] = $this->user_model->getData(null,'','',$where=array('m.member_dinas_id'=>$merge['dinas_id']))->result();

		$ex = array_merge($data, $merge);
		$this->load->vars($ex);

		if($aksi=='export') {
			$this->load->view('backend/export_sppd');
		} else {
			$this->load->view('backend/template');
		}
		
	}

	function simpan()
	{
		$this->form_validation->set_rules('member','Member','required');
		$this->form_validation->set_rules('kegiatan','Kegiatan','required');
		$this->form_validation->set_rules('tanggal','Tanggal','required');
		if($this->form_validation->run()===TRUE) {
			$member = $this->input->post('member');
			$tanggal = $this->input->post('tanggal');
			$cek = $this->supermodel->getData('absen',array('absen_member'=>$member,'absen_tgl'=>$tanggal));
			if($cek) {
				//$this->session->set_flashdata('error', 'Error, data sudah ada!!');
				//redirect('sppd');
				?>
				<script>
					alert("Error, Pegawai ini telah memiliki jadwal!");
					document.location.href='<?php echo site_url('sppd')?>';
				</script>
				<?php
			} else {
				$inp['absen_member'] = $this->input->post('member');
				$inp['absen_tgl'] = $this->input->post('tanggal');
				$inp['absen_keterangan'] = $this->input->post('kegiatan');
				$inp['penginput'] = $this->input->post('penginput');
				$this->supermodel->insertData('absen',$inp);
				$this->session->set_flashdata('sukses', 'Sekses, data tersimpan!!');
				//redirect('sppd');
				?>
				<script>
					javascript:history.go(-1);
				</script>
				<?php
			}
		}	
	}

	function hapus($id=null)
	{
		if($id==null){
			$this->session->set_flashdata('error', 'Maaf, Tidak dapat menghapus data');
			redirect('sppd');
		} else {
			$merge = $this->fungsional->get_profile();
			$dtabs = $this->db->get_where('knj_absen', array('absen_id'=>$id))->row();
			if($dtabs->penginput==$merge['member_id']) {
				$hapus = $this->supermodel->deleteData('absen','absen_id',$id);
				if($hapus) {
					$this->session->set_flashdata('sukses', 'Sekses, data terhapus!!');
				} else {
					$this->session->set_flashdata('error', 'Gagal, data gagal terhapus!!');
				}
			} else {
				$this->session->set_flashdata('error', 'Gagal, anda tidak dapat menghapus data ini!!');
			}
			
			redirect('sppd');
		}
	}

}
?>