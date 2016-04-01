<?php
class M_kegiatan extends CI_Model {
	
	function getKegiatan($tgl=null,$dinas=null)
	{
		$this->db->select('*');
		$this->db->from('knj_kegiatan kg');
		$this->db->join('knj_kategori kt', 'kg.kegiatan_kategori_id=kt.kategori_id');
		$this->db->join('knj_member m', 'kg.kegiatan_member=m.member_id');
		if($tgl) {
			$this->db->where('kegiatan_tanggal >=', $tgl.' 01:00:00');
			$this->db->where('kegiatan_tanggal <=', $tgl.' 23:00:00');
		}
		$this->db->where('m.member_dinas_id',$dinas);
		$this->db->order_by('kegiatan_tanggal', 'desc');
		$get = $this->db->get();
			
		return $get;
		
	}

	function getDataLaporan($tglawal=null,$tglakhir=null,$dinas=null,$member=null)
	{
		$this->db->select('*');
		$this->db->from('knj_kegiatan kg');
		$this->db->join('knj_kategori kt', 'kg.kegiatan_kategori_id=kt.kategori_id');
		$this->db->join('knj_member m', 'kg.kegiatan_member=m.member_id');
		if($tglawal) {
			$this->db->where('kegiatan_tanggal >=', $tglawal.' 01:00:00');
			$this->db->where('kegiatan_tanggal <=', $tglakhir.' 23:00:00');
		}
		$this->db->where('m.member_dinas_id',$dinas);
		$this->db->where('kg.kegiatan_member',$member);
		$this->db->order_by('kegiatan_tanggal', 'asc');
		$get = $this->db->get();
			
		return $get;
	}

	function getData($where=null,$dinas=null)
	{
		$this->db->select('*');
		$this->db->from('knj_kegiatan kg');
		$this->db->join('knj_kategori kt', 'kg.kegiatan_kategori_id=kt.kategori_id');
		$this->db->join('knj_member m', 'kg.kegiatan_member=m.member_id');
		if($where) {
			$this->db->where($where);
		}
		$this->db->where('m.member_dinas_id',$dinas);
		$this->db->order_by('kegiatan_tanggal', 'desc');
		$get = $this->db->get();
			
		return $get;
	}
	
}
?>