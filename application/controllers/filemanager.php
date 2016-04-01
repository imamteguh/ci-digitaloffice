<?php
class Filemanager extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('supermodel');
		$this->load->model('fungsional');
		$this->load->model('m_kegiatan');
		
		$this->load->library('form_validation');
		
		$this->fungsional->cek_log();

		ini_set('memory_limit', '96M');
		ini_set('post_max_size', '64M');
		ini_set('upload_maz_filesize', '64M');
	}


	function index()
	{
		$parent = $this->input->get('parent');
		if($parent==null) {
			redirect('filemanager/index?parent=0');
			$parent = 0;
		}
		$merge = $this->fungsional->get_profile();		
		$data['title'] = "Pengelola File";
		$data['konten'] = "folder";
		/*
		$data['direktori'] = $this->supermodel->getData('folder',array('folder_dinas'=>$merge['member_dinas_id']));
		$data['folder'] = $this->supermodel->getData('folder',array('folder_dinas'=>$merge['member_dinas_id'],'folder_parent'=>$parent));
		$data['berkas'] = $this->supermodel->getData('file',array('file_dinas'=>$merge['member_dinas_id'],'file_folder'=>$parent));
		*/

		$data['direktori'] = $this->supermodel->getData('folder');
		$data['folder'] = $this->supermodel->getData('folder',array('folder_parent'=>$parent));
		$data['berkas'] = $this->supermodel->getData('file',array('file_folder'=>$parent));
		
		$ex = array_merge($data, $merge);
		$this->load->vars($ex);
		$this->load->view('backend/template');
	}

	function createfolder($aksi=null)
	{
		$name = $this->input->post('folder');
		$parent = $this->input->post('parent');
		$dinas = $this->input->post('dinas');
		if($aksi=="edit") {
			$id = $this->input->post('id');
			$edit = array('folder_nama'=>$name);
			$this->supermodel->updateData('folder','folder_id',$id,$edit);
			redirect('filemanager/index?parent=0');
		}
		if($name=="") {
			$cek = $this->supermodel->getData('folder',array('folder_parent'=>$parent,'folder_dinas'=>$dinas));
			if($cek):
				$jum = count($cek->result()) + 1;
				$name = "New Folder(".$jum.")";
			else:
				$name = "New Folder";
			endif;
		}
		$input = array('folder_nama'=>$name,'folder_parent'=>$parent,'folder_dinas'=>$dinas);
		$this->supermodel->insertData('folder',$input);
		redirect('filemanager/index?parent='.$parent);
	}

	function hapusfolder($id=null)
	{
		$this->supermodel->deleteData('folder','folder_id',$id);
		if($id!=null) {
			$cek = $this->supermodel->getData('folder',array('folder_parent'=>$id));
			if($cek) {
				foreach ($cek->result() as $row) {
					$this->hapusfolder($row->folder_id);
					$this->supermodel->deleteData('folder','folder_id',$row->folder_id);
				}
				redirect('filemanager');
			}
		}
		redirect('filemanager');
	}

	function hapusfile($id=null)
	{
		if($id!=null) {
			$dat = $this->supermodel->getData('file',array('file_id'=>$id));
			if($dat) {
				$row = $dat->row_array();
				$unling = unlink('./uploads/dokumen/'.$row['file_nama']);
				if($unling) {
					$this->supermodel->deleteData('file','file_id',$id);
					?><script>javascript:history.go(-1);</script><?php
				}
			}
		} else {
			?><script>javascript:history.go(-1);</script><?php
		}
	}

	function uploadfile()
	{
		if(!empty($_FILES['lampir']['name'])) {
			
			for($i=0; $i<count($_FILES['lampir']['name']); $i++) {
				//Get the temp file path
				$tmpFilePath = $_FILES['lampir']['tmp_name'][$i];

				  //Make sure we have a filepath
				if ($tmpFilePath != ""){ 
				    //Setup our new file path
				    $newFilePath = "./uploads/dokumen/".$_FILES['lampir']['name'][$i];

				    //Upload the file into the temp dir
				    if(move_uploaded_file($tmpFilePath, $newFilePath)) {

				    	$dt['file_folder'] = $this->input->post('parent');
				    	$dt['file_nama'] = $_FILES['lampir']['name'][$i];
				    	$dt['file_date'] = date("Y-m-d H:i:s");
				    	$dt['file_dinas'] = $this->input->post('dinas');
				    	$dt['file_uploaded'] = $this->input->post('nama');

				    	$this->supermodel->insertData('file',$dt);
				    }
				}
			}
			?><script> javascript:history.go(-1); </script><?php
			

		} else {
			?><script>alert('Tidak ada file upload'); document.location.href='<?php echo site_url("filemanager"); ?>';</script><?php
		}
	}

}
?>