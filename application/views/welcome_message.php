<?php
//Programmer : Hikmahtiar dan Imam Teguh
//Copyright  : 2014
?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

<!-- BEGIN HEAD -->
<head>
     <meta charset="UTF-8" />
    <title>Login Page</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
     <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <!-- GLOBAL STYLES -->
     <!-- PAGE LEVEL STYLES -->
     <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/login.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/magic/magic.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/Font-Awesome/css/font-awesome.css" />
    <style type="text/css">
		body{
			/*font-family:calibri;*/
		}
    </style>
     <!-- END PAGE LEVEL STYLES -->
   <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
    <!-- END HEAD -->

    <!-- BEGIN BODY -->
<body >
	<?php 
	//$this->capcay->generatekode();
	//$ko['ko'] = $_SESSION['kode'];
    //echo $_SESSION['kode'];
	//$this->session->set_userdata($ko);
	//echo $this->session->userdata('ko');
	?>
   <!-- PAGE CONTENT --> 
    <div class="container" style="">
    <div class="text-center">
        <div><center><h1><i class="icon-windows"> </i> Digital Office </h1></center></div>
    </div>
    <div class="tab-content">
    	
        <div id="login" class="tab-pane active">
        	<center><span style="background:green;padding:5px;margin-left:-285px;color:#FFF;">BETA</span></center>
            <form method="post" style="border:solid 1px #CCC;" action="<?php echo site_url('welcome/masuq')?>" class="form-signin">
            	
                <?php echo $this->session->flashdata('valid');?>
                
                <div class="form-group">
                	<label><i class="icon-user"> </i>NIP</label>
                    <input type="text" name="userx" value="<?php echo set_value('userx')?>"  autocomplete="off" class="form-control" autofocus/>
                </div>
                
                <?php echo form_error('userx','<div class="alert-danger" style="padding:5px;"> Username required</div>')?>
                
                <div class="form-group">
                	<label><i class="icon-lock"> </i>Password</label>
                    <input type="password" name="passx" value="<?php echo set_value('passx')?>" autocomplete="off" class="form-control" />
                </div>
                
                <?php echo form_error('passx','<div class="alert-danger" style="padding:5px;"> Password required</div>')?>
                
                <!--<div class="form-group">
                	<i class="icon-qrcode"></i>
         			<?php $this->capcay->showcaptcha();?>
                    <input type="text" style="border:1px solid #CCC;width:50px;" name="kode" value="<?php echo set_value('kode')?>">
                    &nbsp;&nbsp;
                    <!--<a style="text-decoration:none;" href="<?php echo site_url()?>"><i class="icon-refresh"></i></a>-->
                    <?php //echo form_error('kode','')?>
                <!--</div>-->
                
                
                
               <!-- <div class="form-group">
                	<div class="checkbox">
                    	<label><input type="checkbox" value="true" name="remember"> Tetap Masuk</label>
                    </div>
                </div>
                -->
                
                <div class="form-group"><center>
                	<button class="btn text-muted text-center btn-success" type="submit">Sign in</button>
                	<button class="btn text-muted text-center btn-default" type="reset">Reset</button>
                </center></div>
                
                
            </form>
        </div>
        
        <!--<div id="forgot" class="tab-pane">
            <form action="index.html" class="form-signin">
                <p class="text-muted text-center btn-block btn btn-primary btn-rect">Enter your valid e-mail</p>
                <input type="email"  required="required" placeholder="Your E-mail"  class="form-control" />
                <br />
                <button class="btn text-muted text-center btn-success" type="submit">Recover Password</button>
            </form>
        </div>
        <div id="signup" class="tab-pane">
            <form action="index.html" class="form-signin">
                <p class="text-muted text-center btn-block btn btn-primary btn-rect">Please Fill Details To Register</p>
                 <input type="text" placeholder="First Name" class="form-control" />
                 <input type="text" placeholder="Last Name" class="form-control" />
                <input type="text" placeholder="Username" class="form-control" />
                <input type="email" placeholder="Your E-mail" class="form-control" />
                <input type="password" placeholder="password" class="form-control" />
                <input type="password" placeholder="Re type password" class="form-control" />
                <button class="btn text-muted text-center btn-success" type="submit">Register</button>
            </form>
        </div>-->
    </div>
    
    <!--<div class="text-center">
        <ul class="list-inline">
            <li><a class="text-muted" href="#login" data-toggle="tab">Login</a></li>
            <li><a class="text-muted" href="#forgot" data-toggle="tab">Forgot Password</a></li>
            <!--<li><a class="text-muted" href="#signup" data-toggle="tab">Signup</a></li>
        </ul>
    </div>-->


</div>

	  <!--END PAGE CONTENT -->     
	      
      <!-- PAGE LEVEL SCRIPTS -->
      <script src="<?php echo base_url()?>assets/plugins/jquery-2.0.3.min.js"></script>
      <script src="<?php echo base_url()?>assets/plugins/bootstrap/js/bootstrap.js"></script>
   	  <script src="<?php echo base_url()?>assets/js/login.js"></script>
      <!--END PAGE LEVEL SCRIPTS -->

</body>
    <!-- END BODY -->
</html>
