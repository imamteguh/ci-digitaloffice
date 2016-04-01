<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

<!-- BEGIN HEAD-->
<head>
   
     <meta charset="UTF-8" />
    <title>Halaman <?php echo ucfirst($this->session->userdata('status'))?></title>
     <meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
     <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <!-- GLOBAL STYLES -->
    <!-- GLOBAL STYLES -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/main.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/dashboard.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/theme.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/MoneAdmin.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/Font-Awesome/css/font-awesome.css" />
    <!--END GLOBAL STYLES -->
	<link href="<?php echo base_url()?>assets/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES -->
    
    <link href="<?php echo base_url()?>assets/css/jquery-ui.css" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/uniform/themes/default/css/uniform.default.css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/inputlimiter/jquery.inputlimiter.1.0.css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/chosen/chosen.min.css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/colorpicker/css/colorpicker.css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/tagsinput/jquery.tagsinput.css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/daterangepicker/daterangepicker-bs3.css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datepicker/css/datepicker.css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/timepicker/css/bootstrap-timepicker.min.css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/switch/static/stylesheets/bootstrap-switch.css" />


 <script src="<?php echo base_url()?>assets/plugins/jquery-2.0.3.min.js"></script>
    
        <!-- END PAGE LEVEL  STYLES -->
       <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
    <!-- END  HEAD-->
    <!-- BEGIN BODY-->
<body class="padTop53 " >

     <!-- MAIN WRAPPER -->
    <div id="wrap">


         <!-- HEADER SECTION -->
        <div id="top">

            <nav class="navbar navbar-inverse navbar-fixed-top " style="padding-top: 10px;">
                <a data-original-title="Show/Hide Menu" data-placement="bottom" data-tooltip="tooltip" class="accordion-toggle btn btn-primary btn-sm visible-xs" data-toggle="collapse" href="#menu" id="menu-toggle">
                    <i class="icon-align-justify"></i>
                </a>
                <!-- LOGO SECTION -->
                <header class="navbar-header">
					<b style="font-size:20px;"><i class="icon-shield"></i>  Halaman <?php echo ucfirst($this->session->userdata('status'))?></b>
                </header>
                <!-- END LOGO SECTION -->
                <ul class="nav navbar-top-links navbar-right">
                <li><span style="background:green;padding:5px;color:#FFF;">BETA</span></li>
                    <?php echo pesan_baru() ?>
                    <!--<li><a href="<?php echo site_url('forum')?>"> <i class="icon-comments-alt"></i> Forum Diskusi </a></li> -->
                    <!--ADMIN SETTINGS SECTIONS -->
                    <li><a href="<?php echo site_url('admain/editp/'.$member_nip)?>"> <i class="icon-user"></i> Edit Profile </a></li>
					<li><a href="<?php echo site_url('admain/out')?>"><i class="icon-signout"></i> Logout </a></li>
                    
                    <!--END ADMIN SETTINGS -->
                </ul>

            </nav>

        </div>
        <!-- END HEADER SECTION -->



        <!-- MENU SECTION -->
       <div id="left">
            <div class="media user-media well-small">
                <a class="user-link" href="#">
                    <img width="70" class="media-object img-thumbnail user-img" alt="User Picture" src="<?php echo base_url('uploads/images/'.$member_foto)?>" />
                </a>
                
                <br />
                
                <div class="media-body">
                    <h5 class="media-heading" style="padding-bottom:3px; margin-bottom:0px; border-bottom:1px dotted #000;"> <?php echo $member_nama?></h5>
                    <span style="font-size:12px;color:#999"><?php echo $dinas_nama ?></span>
                </div>
                <br />
                
            </div>

            <ul id="menu" class="collapse">

                <?php if($this->session->userdata('status')=="member"):?>
                    <li class=""><a href="<?php echo site_url('admain')?>" ><i class="icon-windows"></i> Dashboard</a></li>
                    <li><a href="<?php echo site_url('kegiatan')?>"><i class="icon-calendar-empty"></i> Kegiatan Saya </a></li>
                    <li><a href="<?php echo site_url('laporan')?>"><i class="icon-desktop"></i> Laporan </a></li>
                    <li><a href="<?php echo site_url('sppd/views')?>"><i class="icon-calendar"></i> Kalender Kerja </a></li>
                    <li><a href="<?php echo site_url('filemanager')?>"><i class="icon-folder-open"></i> Pengelola File </a></li>
                    <li><a href="<?php echo site_url('forum')?>"> <i class="icon-comments-alt"></i> Forum Dialog DIgital </a></li>
                <?php elseif($this->session->userdata('status')=="superadmin"):?>
                    <li>KONFIGURASI</li>
                	<li><a href="<?php echo site_url('admain')?>" ><i class="icon-windows"></i> Dashboard</a></li>
                    <li><a href="<?php echo site_url('user')?>"><i class="icon-user"></i> User</a></li>
                    <li><a href="<?php echo site_url('instansi')?>"><i class="icon-table"></i> Data Master Instansi</a></li>
                    <li><a href="<?php echo site_url('ktforum')?>"> <i class="icon-gear"></i> Kategori Forum </a></li>
                    <li>MAIN MENU</li>
                    <li><a href="<?php echo site_url('kegiatan')?>"><i class="icon-calendar-empty"></i> Kegiatan Saya </a></li>
                    <li><a href="<?php echo site_url('laporan')?>"><i class="icon-desktop"></i> Laporan </a></li>
                    <li><a href="<?php echo site_url('filemanager')?>"><i class="icon-folder-open"></i> Pengelola File </a></li>
                    <li><a href="<?php echo site_url('forum')?>"> <i class="icon-comments-alt"></i> Forum Dialog Digital </a></li>
                <?php else: ?>
                    <li class=""><a href="<?php echo site_url('admain')?>" ><i class="icon-windows"></i> Dashboard</a></li>
                    <li><a href="<?php echo site_url('kegiatan')?>"><i class="icon-calendar-empty"></i> Kegiatan Saya </a></li>
                    <li><a href="<?php echo site_url('user_admin')?>"><i class="icon-user"></i> User</a></li>
                    <li><a href="<?php echo site_url('laporan')?>"><i class="icon-desktop"></i> Laporan </a></li>
                    <li><a href="<?php echo site_url('filemanager')?>"><i class="icon-folder-open"></i> Pengelola File </a></li>
                    <li><a href="<?php echo site_url('sppd')?>"><i class="icon-calendar"></i> Kalender Kerja </a></li>
                    <li><a href="<?php echo site_url('kategori')?>"><i class="icon-file"></i> Kategori Kagiatan</a></li>
                    <li><a href="<?php echo site_url('forum')?>"> <i class="icon-comments-alt"></i> Forum Dialog Digital </a></li>
				<?php endif;?>
            </ul>
        </div>
        <!--END MENU SECTION -->


        <!--PAGE CONTENT -->
        <div id="content">

            <div class="inner" style="min-height:1200px;">
                <div class="row">
                    <div class="col-lg-12">
                        <h2><?php echo $title?></h2>
                    </div>
                </div>

                <hr />
				<div class="row">
                <?php
					if(empty($konten)):
						$this->load->view('backend/blank');
					else:
						$this->load->view('backend/'.$konten);
					endif;
				?>
                </div>
            </div>




        </div>
       <!--END PAGE CONTENT -->


    </div>

     <!--END MAIN WRAPPER -->

   <!-- FOOTER -->
    <div id="footer">
        <p>Copyright &copy; 2014. Kominfo Kota Bogor. Allright Reserved.</p>
    </div>
    <!--END FOOTER -->
     <!-- GLOBAL SCRIPTS -->
    
     <script src="<?php echo base_url()?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url()?>assets/plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    
    <script src="<?php echo base_url()?>assets/js/notifications.js"></script>
  	<script>
      $(function () { Notifications(); });
    </script> 
    
    <script src="<?php echo base_url()?>assets/js/jquery-ui.min.js"></script>
 <script src="<?php echo base_url()?>assets/plugins/uniform/jquery.uniform.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/inputlimiter/jquery.inputlimiter.1.3.1.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/chosen/chosen.jquery.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/colorpicker/js/bootstrap-colorpicker.js"></script>
<script src="<?php echo base_url()?>assets/plugins/tagsinput/jquery.tagsinput.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/validVal/js/jquery.validVal.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<script src="<?php echo base_url()?>assets/plugins/daterangepicker/moment.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url()?>assets/plugins/timepicker/js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/switch/static/js/bootstrap-switch.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/jquery.dualListbox-1.3/jquery.dualListBox-1.3.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/autosize/jquery.autosize.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/jasny/js/bootstrap-inputmask.js"></script>
       <script src="<?php echo base_url()?>assets/js/formsInit.js"></script>
        <script>
            $(function () { formInit(); });
        </script>

    
    <script src="<?php echo base_url()?>assets/plugins/dataTables/jquery.dataTables.js"></script>
	<script src="<?php echo base_url()?>assets/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script>
     $(document).ready(function () {
         $('#dataTables-example').dataTable();
     });
    </script>
    
    
    
    
    
    
    
    
    <!-- END GLOBAL SCRIPTS -->
</body>
    <!-- END BODY-->
    
</html>
