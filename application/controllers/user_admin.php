<?php
/**
* 
*/
class User_admin extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('fungsional');
		$this->load->model('supermodel');
		$this->load->library('form_validation');
		if($this->session->userdata('status')!='admin'){redirect('admain');}
		error_reporting(0);
	}
	
	function index($akses=null)
	{
		$merge = $this->fungsional->get_profile();
		$data['title'] = "User";
		$data['konten'] = "user_admin";
		$data['jabatan'] = $this->supermodel->getData($table='dinas', null,$order='dinas_nama', $dasc='ASC', $limit='', $offset='')->result();
		$data['user'] = $this->user_model->getData(null,'','',$where=array('m.member_dinas_id'=>$merge['member_dinas_id'],'status'=>'member'));

		if($akses=='edit') {
			$id = $this->uri->segment(4);
			$data['getData'] = $this->user_model->getData($id,1)->result_array();
		}
		
		$this->form_validation->set_rules('username','NIP','required');
		$this->form_validation->set_rules('member_nama','Nama Lengkap','required');
		$this->form_validation->set_rules('member_email','Alamat Email','required|valid_email');
		$this->form_validation->set_message('reuired', '');

		if($this->form_validation->run()===TRUE) {
			
			//Input User
			$user_id = $this->input->post('user_id');
			$username = $this->input->post('username');
			if($this->input->post('password')) {
				$password = md5($this->input->post('password'));
			}
			$isactive = $this->input->post('isactive');
			$status = $this->input->post('status');
			//Input Member
			$member_nip = $this->input->post('username');
			$member_nama = $this->input->post('member_nama');
			$member_email = $this->input->post('member_email');
			$member_tlp = $this->input->post('member_tlp');
			$member_dinas_id = $merge['dinas_id'];
			$member_foto = 'default-male.jpg';
			
			$inpMember = array(
						'member_nip'=>$member_nip,'member_nama'=>$member_nama,'member_email'=>$member_email,
						'member_tlp'=>$member_tlp,'member_foto'=>$member_foto,'member_dinas_id'=>$member_dinas_id
						);
			if($user_id=='') {
				$inpUser = array(
							'username'=>$username,'password'=>$password,'isactive'=>$isactive,'status'=>$status
							);
				$saveduser = $this->supermodel->insertData('user',$inpUser);
				$savedmember = $this->supermodel->insertData('member',$inpMember);
			} else {
				if($password):
				$inpUser = array(
							'username'=>$username,'password'=>$password,'isactive'=>$isactive,'status'=>$status
							);
				else:
				$inpUser = array(
							'username'=>$username,'isactive'=>$isactive,'status'=>$status
							);
				endif;
				$inpMember = array(
						'member_nip'=>$member_nip,'member_nama'=>$member_nama,'member_email'=>$member_email,
						'member_tlp'=>$member_tlp,'member_dinas_id'=>$member_dinas_id
						);
				$saveduser = $this->supermodel->updateData('user','user_id',$user_id,$inpUser);
				$savedmember = $this->supermodel->updateData('member','member_nip',$member_nip,$inpMember);
			}

			if($saveduser && $savedmember) {
				$this->session->set_flashdata('sukses', 'Sekses, data user tersimpan!!');
			} else {
				$this->session->set_flashdata('error', 'Gagal, data user gagal tersimpan!!');
			}

			redirect('user_admin');
		}
				
		$ex = array_merge($data, $merge);
		$this->load->vars($ex);
		$this->load->view('backend/template');
	}

	function hapus($nip=null)
	{
		if($nip==null){
			$this->session->set_flashdata('error', 'Maaf, Tidak dapat menghapus data');
			redirect('user_admin');
		} else {
			$getData = $this->user_model->getData($nip,1)->row_array();
			if('default-male.jpg'!==$getData['member_foto']) {
				@unlink('uploads/images/'.$getData['member_foto']);
			}
			$dltuser = $this->supermodel->deleteData('user','user_id',$getData['user_id']);
			$dltmember = $this->supermodel->deleteData('member','member_id',$getData['member_id']);
			if($dltmember && $dltuser) {
				$this->session->set_flashdata('sukses', 'Sekses, data user terhapus!!');
			} else {
				$this->session->set_flashdata('error', 'Gagal, data user gagal terhapus!!');
			}
			redirect('user_admin');
		}
	}

	function detail($nip=null)
	{
		if($nip==null){
			$this->session->set_flashdata('error', 'Maaf, Data yang anda inginkan tidak ada');
			redirect('user_admin');
		}
		$merge = $this->fungsional->get_profile();		
		$data['title'] = "User";
		$data['konten'] = "detail_user";
		$data['user'] = $this->user_model->getData($nip,1)->row_array();
		$ex = array_merge($data, $merge);
		$this->load->vars($ex);
		$this->load->view('backend/template');
	}
}
?>