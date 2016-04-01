<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//Programmer : Hikmahtiar dan Imam Teguh
//Copyright  : 2014
//session_start();
class Welcome extends CI_Controller {
	
	function __construct() { 
		parent::__construct();
		$this->load->model('supermodel');
		$this->load->model('fungsional');
		$this->load->model('login_model');
		$this->load->library('form_validation');
	}
	
	function index() {
		if($this->session->userdata('logged_indg')!=""):
			redirect('admain');
		else:
			$this->load->view('welcome_message');
		endif;
	}
	
	function masuq() {
		$user = mysql_real_escape_string($this->input->post('userx'));
		$pass = mysql_real_escape_string(md5($this->input->post('passx')));
		$kode = mysql_real_escape_string($this->input->post('kode'));
		
		$this->form_validation->set_rules('userx', 'Username', 'required');
		$this->form_validation->set_rules('passx', 'Password', 'required');
		//$this->form_validation->set_rules('kode', 'Captcha', 'callback_cek_aritmatika');
		$this->form_validation->set_message('required',' ');
		
		if($this->form_validation->run() == TRUE):

			$sup = $this->login_model->asupcoy($user, $pass);
			if($sup){
				foreach($sup as $asli){
					if($asli['isactive'] == 0) {
						$this->session->set_flashdata('valid', '<div class="alert alert-warning">Akun anda belum di aktifkan oleh admin.</div>');
						redirect('welcome');
					}else{

						//$_SESSION['masing'] = $asli;
						$lias['logged_indg'] = "yesAigetLogin";
						$lias['username'] = $asli['username'];
						$lias['status'] = $asli['status'];
						$lias['user_id'] = $asli['user_id'];
						$this->session->set_userdata($lias);

						$arraya = array('islogin'=>1);
						$this->supermodel->updateData('user', 'user_id', $asli['user_id'], $arraya);

						inputLast('Login');
						redirect('admain');
					}
				}
			} else {
				$konten = file_get_contents('http://simpeg.kotabogor.go.id/rest/pegawai/get/'.$user);
				$jsondata = json_decode($konten,true);
				foreach ($jsondata as $value)
				{
					if ($value['nip']==NULL) {
						$this->session->set_flashdata('valid', '<div class="alert alert-danger">Username / Password wrong.</div>');
						redirect('welcome');
					} else {
						if($pass==$value['password']) {
							//user
							$u['username'] = $value['nip'];
							$u['password'] = $value['password'];
							$u['status'] = 'member';
							$u['isactive'] = 1;
							$u['islogin'] = 1;
							//member
							$m['member_nip'] = $value['nip'];
							$m['member_nama'] = $value['nama'];
							$m['member_email'] = '-';
							$m['member_tlp'] = '-';
							$m['member_foto'] = 'default-male.jpg';
							$m['member_dinas_id'] = $this->dinas_id($value['unit_kerja']);
							$saveduser = $this->supermodel->insertData('user',$u);
							$savedmember = $this->supermodel->insertData('member',$m);
							if ($savedmember) {
								$iduser = $this->supermodel->getData('user',array('username'=>$u['username']))->row_array();
								$lias['logged_indg'] = "yesAigetLogin";
								$lias['username'] = $u['username'];
								$lias['status'] = $u['status'];
								$lias['user_id'] = $iduser['user_id'];
								$this->session->set_userdata($lias);

								inputLast('Login');
								redirect('admain');
							}
						} else {
							$this->session->set_flashdata('valid', '<div class="alert alert-danger">Username / Password wrong.</div>');
							redirect('welcome');
						}
					}
					
				}

				
			}
		else:
			$this->index();
		endif;
	}
	
	function cek_aritmatika($str) {
		if($str == ""):
			$this->form_validation->set_message('cek_aritmatika', '<div class="alert-danger" style="padding:5px;">Captcha required</div>');
			return FALSE;
		else:
			if($str != $this->session->userdata('ko')):
				$this->form_validation->set_message('cek_aritmatika', '<div class="alert-danger" style="padding:5px;">Hasil yang dimasukkan belum benar</div>');
				return FALSE;
			else:
				return TRUE;
			endif;
		endif;
	}

	private function dinas_id($string) {
		$get = $this->supermodel->getData('dinas',array('dinas_nama'=>$string));
		if($get->num_rows()>0) {
			foreach ($get->result() as $rw) {
				$id = $rw->dinas_id;
			}
		}
		else {
			$id = 0;
		}
		return $id;
	}
}
