<?php
function replies($id)
{
	$ci =& get_instance();
	$get = $ci->db->query("select count(*) as jml from knj_diskusi where ktforum_id='".$id."' ")->row();
	return $get->jml;
}

function konbul($stringbulan)
{
	$bulan_angka=array('01','02','03','04','05','06','07','08','09','10','11','12');
	$bulankite=array('Januari','Febuari','Maret','April','Mei','Juni','Juli','Agustus',
					  'September','Oktober','November','Desember');
	$konversi=str_replace($bulan_angka,$bulankite,$stringbulan);
	return $konversi;
}

function inputLast($keg) {
	$CI =& get_instance();
	$s = $CI->db->query("select*from knj_member where member_nip= '".$CI->session->userdata('username')."'")->row_array();
	$aa = array('log_id'=>NULL, 'aktivitas'=>$keg, 'tanggal'=>gmdate('Y-m-d H:i:s', time()+60*60*7), 'nama'=>$s['member_nama']);
	$CI->db->insert('knj_log_aktivitas', $aa);
} 

function pesan_baru() {
	$CI =& get_instance();
	$CI->load->model('pesan_model');
	$email = $CI->db->query('select member_email from knj_member where member_nip = "'.$CI->session->userdata('username').'" ')->row_array();
	$inbox = $CI->db->query("select * from knj_pesan where pesan_to ='".$email['member_email']."' and pesan_status='0' ")->result();
	echo '
                    <li class="dropdown">
                        <a href="'.site_url('pesan').'">
                            <span class="label label-success">'.count($inbox).'</span>    <i class="icon-envelope-alt"></i> Pesan
                        </a>

                    </li>
                    <!--END MESSAGES SECTION -->';
}

function jmlpesan()
{
	$CI =& get_instance();
	$CI->load->model('pesan_model');
	$email = $CI->db->query('select member_email from knj_member where member_nip = "'.$CI->session->userdata('username').'" ')->row_array();
	$inbox = $CI->db->query("select * from knj_pesan where pesan_to ='".$email['member_email']."' and pesan_status='0' ")->result();
	echo count($inbox);
}

function induk($id=null)
	{
		$CI =& get_instance();
		$CI->load->model('supermodel');
		$induk = $CI->supermodel->getData('ktforum',array('ktforum_id'=>$id));
		if($induk) {
			$induk = $induk->row();
			return $induk->ktforum_judul;
		} else {
			return $t = "-";
		}
		
	}


function load_data_kategori() {
	$CI =& get_instance();
	$ktg = $CI->db->query('select SQL_CALC_FOUND_ROWS * from knj_kategori where kategori_parent = 0 order by kategori_nama asc limit 0,7')->result_array();
	$no=1;
	
	foreach($ktg as $ket){
		echo '<div style="padding:10px;font-size:20px;font-weight:bold;">'.' '.$ket['kategori_nama'].'</div>';
		$son = $CI->db->query('select SQL_CALC_FOUND_ROWS * from knj_kategori where kategori_parent = '.$ket['kategori_id'].' order by kategori_nama asc')->result_array();
		$noo=1;
		foreach($son as $kat){
			echo '<h5 style="margin-left:100px;padding:0px;">'.$noo.'. '.$kat['kategori_nama'].'<h5><br>';
		$noo++;
		}
	$no++;
	}
}

function ajax_load($function) {
	?>
    <script type="text/javascript">
		(function($) {
			$.fn.scrollPagination = function(options) {
				
				var settings = { 
					nop     : 10, // The number of posts per scroll to be loaded
					offset  : 0, // Initial offset, begins at 0 in this case
					error   : 'No More Posts!', // When the user reaches the end this is the message that is
												// displayed. You can change this if you want.
					delay   : 500, // When you scroll down the posts will load after a delayed amount of time.
								   // This is mainly for usability concerns. You can alter this as you see fit
					scroll  : true // The main bit, if set to false posts will not load as the user scrolls. 
								   // but will still load if the user clicks.
				}
				
				// Extend the options so they work with the plugin
				if(options) {
					$.extend(settings, options);
				}
				
				// For each so that we keep chainability.
				return this.each(function() {		
					
					// Some variables 
					$this = $(this);
					$settings = settings;
					var offset = $settings.offset;
					var busy = false; // Checks if the scroll action is happening 
									  // so we don't run it multiple times
					
					// Custom messages based on settings
					if($settings.scroll == true) $initmessage = 'Scroll for more';
					else $initmessage = 'Click for more';
					
					// Append custom messages and extra UI
					$this.append('<div class="a"></div><div id="more">'+$initmessage+'</div>');
					
					function getData() {
						
						// Post data to ajax.php
						$.post('<?php echo site_url($function)?>', {
								
							action        : 'scrollpagination',
							number        : $settings.nop,
							offset        : offset,
								
						}, function(data) {
								
							// Change loading bar content (it may have been altered)
							$this.find('#more').html($initmessage);
								
							// If there is no data returned, there are no more posts to be shown. Show error
							if(data == "") { 
								$this.find('#more').html($settings.error);	
							}
							else {
								
								// Offset increases
								offset = offset+$settings.nop; 
									
								// Append the data to the content div
								$this.find('.a').append(data);
								
								// No longer busy!	
								busy = false;
							}	
								
						});
							
					}	
					
					getData(); // Run function initially
					
					// If scrolling is enabled
					if($settings.scroll == true) {
						// .. and the user is scrolling
						$(window).scroll(function() {
							
							// Check the user is at the bottom of the element
							if($(window).scrollTop() + $(window).height() > $this.height() && !busy) {
								
								// Now we are working, so busy is true
								busy = true;
								
								// Tell the user we're loading posts
								$this.find('#more').html('Loading Posts');
								
								// Run the function to fetch the data inside a delay
								// This is useful if you have content in a footer you
								// want the user to see.
								setTimeout(function() {
									
									getData();
									
								}, $settings.delay);
									
							}	
						});
					}
					
					// Also content can be loaded by clicking the loading bar/
					$this.find('#more').click(function() {
					
						if(busy == false) {
							busy = true;
							getData();
						}
					
					});
					
				});
			}
		
		})(jQuery);
    </script>
    <style type="text/css">
	#more{
		background: none repeat scroll 0 0 #666;
		color: #fff;
		font-size:10px;
		font-weight: bold;
		padding: 5px;
		position: fixed;
		bottom: 0;
		z-index: 99999;
	}
	</style>
    <?php
}


function getTotalDays($month, $year)
{
	$days_in_month	= array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

	if ($month < 1 OR $month > 12)
	{
		return 0;
	}

	// Is the year a leap year?
	if ($month == 2)
	{
		if ($year % 400 == 0 OR ($year % 4 == 0 AND $year % 100 != 0))
		{
			return 29;
		}
	}

	return $days_in_month[$month - 1];
}

function bulan($i) {
	$bulan = array(
			"01"=>"Januari",
			"02"=>"Februari",
			"03"=>"Maret",
			"04"=>"April",
			"05"=>"Mei",
			"06"=>"Juni",
			"07"=>"Juli",
			"08"=>"Agustus",
			"09"=>"September",
			"10"=>"Oktober",
			"11"=>"November",
			"12"=>"Dessember"
			);
	return $bulan[$i];
}

function convert_tanggal($tgl)
{
	$bulan = array(
		"01"=>"Januari",
			"02"=>"Februari",
			"03"=>"Maret",
			"04"=>"April",
			"05"=>"Mei",
			"06"=>"Juni",
			"07"=>"Juli",
			"08"=>"Agustus",
			"09"=>"September",
			"10"=>"Oktober",
			"11"=>"November",
			"12"=>"Dessember",);
	$ex = explode("-", $tgl);
	$d = substr($ex[2], 0,2);
	$y = $ex[0];
	$m = $bulan[$ex[1]];

	return $cetak = $d.' '.$m.' '.$y;
}


function getAbsen($thn,$bln,$i,$member)
{
	$tgl = $thn.'-'.$bln.'-'.$i;
	$ci =& get_instance();
	$ci->db->where('absen_tgl',$tgl);
	$ci->db->where('absen_member',$member);
	$get = $ci->db->get('knj_absen');
	if($get->num_rows==1) {
		$row = $get->row_array();
		return $text = '<a href="'.site_url('sppd/hapus/'.$row['absen_id']).'" onclick="return confirm(\' Hapus data ini??? \')" data-toggle="tooltip" data-placement="top" title="'.$row['absen_keterangan'].'"><i class="icon-ok"></i></a>';
	} else {
		return $text =  '';
	}
}

function getAbsenData($thn,$bln,$i,$member)
{
	$tgl = $thn.'-'.$bln.'-'.$i;
	$ci =& get_instance();
	$ci->db->where('absen_tgl',$tgl);
	$ci->db->where('absen_member',$member);
	$get = $ci->db->get('knj_absen');
	if($get->num_rows==1) {
		$row = $get->row_array();
		return $text = '<a href="#" data-toggle="tooltip" data-placement="top" title="'.$row['absen_keterangan'].'"><i class="icon-ok"></i></a>';
	} else {
		return $text =  '';
	}
}

function getAbsenDataExport($thn,$bln,$i,$member)
{
	$tgl = $thn.'-'.$bln.'-'.$i;
	$ci =& get_instance();
	$ci->db->where('absen_tgl',$tgl);
	$ci->db->where('absen_member',$member);
	$get = $ci->db->get('knj_absen');
	if($get->num_rows==1) {
		$row = $get->row_array();
		return $text = $row['absen_keterangan'];
	} else {
		return $text =  '';
	}
}

function get_menu($data, $parent=0)
{
	static $i = 1;
	$tab = str_repeat("\t\t", $i);
	if (isset($data[$parent])) {
		$html = "<ul>";
		$i++;
		foreach ($data[$parent] as $v) {
			$child = get_menu($data, $v->folder_id);
			$html .= "<li>";
			$html .= '<a href="'.site_url('filemanager/index?parent='.$v->folder_id).'">'.$v->folder_nama.'</a>';
			if ($child) {
				$i--;
				$html .= $child;
			}
			$html .= '</li>';
		}
		$html .= "</ul>";
		return $html;
	} else {
		return false;
	}
}

function get_komen($id)
{
	$ci =& get_instance();
	$ci->db->select('*');
	$ci->db->from('knj_komen k');
	$ci->db->join('knj_member m', 'k.member_id=m.member_id');
	$ci->db->where('diskusi_id',$id);
	$ci->db->order_by('tanggal', 'asc');
	$get = $ci->db->get();
	return $get;
}

function nama_user($member)
{
	$ci =& get_instance();
	$ci->db->where('member_nip',$member);
	$get = $ci->db->get('knj_member');
	if($get->num_rows==1) {
		$row = $get->row_array();
		return $text = $row['member_nama'];
	} else {
		return $text =  '-';
	}
}

function last_coment($idkategori)
{
	$ci =& get_instance();
	$ci->db->where('ktforum_id',$idkategori);
	$ci->db->order_by('tanggal','desc');
	$ci->db->limit('1','0');
	$ci->db->join('knj_member m','d.member_id=m.member_id');
	$get = $ci->db->get('knj_diskusi d');
	if($get->num_rows>0) {
		$row = $get->row_array();
		$text = '<div class="kanan">
            <p>'.substr($row['posting'], 0,100).'</p>
            <p>'.convert_tanggal($row['tanggal']).', By '.$row['member_nama'].'</p>
        </div>';
        return $text;
	} else {
		return $text =  '-';
	}
}
?>