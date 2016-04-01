<?php
class Laporan extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('supermodel');
		$this->load->model('fungsional');
		$this->load->model('m_kegiatan');
		
		$this->load->library('form_validation');
		
		$this->fungsional->cek_log();
	}
	
	function index($hari=null) {
		if($hari==null) {
			$hari = date('d');
		}
		$tahun = $this->uri->segment(4);
		if($tahun==null) {
			$tahun = date('Y');
		}
		$bulan = $this->uri->segment(5);
		if($bulan==null) {
			$bulan = date('m');
		}
		
		$tgl = $tahun.'-'.$bulan.'-'.$hari;
		
		$config['day_type'] = 'long';

		$config['template'] = '
			{table_open}<table class="calendar">{/table_open}
			{heading_previous_cell}<th><a class="btn btn-primary btn-sm" href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
			{heading_title_cell}<th colspan="5"><center><h4>{heading}</h4></center></th>{/heading_title_cell}
			{heading_next_cell}<th><a class="btn btn-primary btn-sm" style="float:right" href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}
			{week_day_cell}<th class="day_header">{week_day}</th>{/week_day_cell}
			{cal_cell_content}<a href="laporan/" class="day_listing">{day}</a>{/cal_cell_content}
			{cal_cell_content_today}<div class="highlight"><a href="{content}">{day}</a></div>{/cal_cell_content_today}
			{cal_cell_no_content}<a href="'.site_url().'/laporan/index/{day}/'.$tahun.'/'.$bulan.'" class="day_listing">{day}</a>{/cal_cell_no_content}
			{cal_cell_no_content_today}<div class="today"><a href="'.site_url().'/laporan/index/{day}/'.$tahun.'/'.$bulan.'" class="day_listing">{day}</a></div>{/cal_cell_no_content_today}
		';

		$config['show_next_prev'] = TRUE;

		$config['next_prev_url'] = base_url().'index.php/laporan/index/'.$hari;
		
		$merge = $this->fungsional->get_profile();
		$kegiatan = $this->m_kegiatan->getKegiatan();
		$this->load->library('calendar',$config);
		
		$data['calendar'] = $this->calendar->generate($tahun, $bulan);
		
		$data['title'] = "Laporan Kegiatan";
		$data['konten'] = "laporan";
		$data['query'] = $this->m_kegiatan->getKegiatan($tgl,$merge['member_dinas_id'])->result_array();
		//$data['query'] = $this->fungsional->query('*', 'knj_kegiatan a join knj_kategori b on a.kegiatan_kategori_id=b.kategori_id join knj_member c on a.kegiatan_member=c.member_id order by a.kegiatan_tanggal desc');
		
		$ex = array_merge($data, $merge);
		$this->load->vars($ex);
		$this->load->view('backend/template');
	}

	function exporttoexcel() {
		$merge = $this->fungsional->get_profile();
		$tgl1 = $this->input->get('tglmulai');
		$tgl2 = $this->input->get('tglakhir');
		header("Content-type: application/vnd.ms-excel");
		header("Content-Disposition: attachment;Filename=laporan.xls");
		$data['tgl1'] = $tgl1;
		$data['tgl2'] = $tgl2;
		if($tgl1==null) {
			$data['tgl1'] = date("Y-m-d");
			$data['tgl2'] = date("Y-m-d");
		}
		$data['title'] = "Laporan Kegiatan";
		$data['listview'] = $this->m_kegiatan->getDataLaporan($tgl1,$tgl2,$merge['member_dinas_id'],$merge['member_id']);
		$vrs = array_merge($merge, $data);
		$this->load->vars($vrs);
		$this->load->view('backend/exportkegiatan');
	}
}
?>