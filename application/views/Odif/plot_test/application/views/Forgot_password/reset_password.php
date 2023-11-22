<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title></title>
		<!-- Bootstrap -->
		<link href="<?= base_url();?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
		<!-- Font Awesome -->
		<link href="<?= base_url();?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<!-- NProgress -->
		<link href="<?= base_url();?>vendors/nprogress/nprogress.css" rel="stylesheet">
		<!-- Animate.css -->
		<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet">
   <!-- new dashboard stylesheet -->   
    <link rel="stylesheet" href="<?= base_url();?>vendors/assets/css/main.css">
    
  
    <link rel="stylesheet" href="<?= base_url();?>vendors/assets/lib/metismenu/metisMenu.css">
    
   
    <link rel="stylesheet" href="<?= base_url();?>vendors/assets/lib/animate.css/animate.css">
    
<link rel="stylesheet" href="<?= base_url();?>vendors/assets/css/style-switcher.css">
<link rel="stylesheet/less" type="text/css" href="<?= base_url();?>vendors/assets/less/theme.less">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/less.js/2.7.1/less.js"></script>
     <!-- new dashboard stylesheet -->  
    
		<!-- Custom Theme Style -->
		<link href="<?= base_url();?>build/css/custom.css" rel="stylesheet">
        <link rel="stylesheet" href="<?= base_url();?>vendors/assets/css/last_custom.css">
	</head>
	<body class="login">
	<div class="plotlogo">
	
    </div>
		  <form method="post" action="<?php echo base_url()?>Forgot_password/reset_password">
        <div class="login">
              <div class="form-signin">
  		 <div class="text-center">
       <img class="img-responsive center-block" src="<?= base_url();?>logo/logo-white.png" alt=""/>
     <span class="ft-20">Plot</span>
    </div>
    
    <div class="tab-content">
        <div id="login" class="tab-pane active">
          <?php 
						if($this->session->flashdata('message')){
							echo '<div class="alert alert-danger fade in">					
								<Strong>'.$this->session->flashdata('message').'</Strong>
							</div>';
						}
					?>
                <p class="text-muted text-center">
                   Reset Your Password
                </p>
              
                 <input type="password" name="pwd"  placeholder="New Password" class="form-control bottom" required="required" >
                 
                  <input type="password" name="confirm_pwd"  placeholder="Confirm Password" class="form-control bottom" required="required" >
                  
                   <input type="hidden" name="key" value="<?php echo $_GET['key']?>">
                    <input type="hidden" name="user_current"  value="<?php echo $_GET['userid']?>">
             
                
         
       
             
             <div class="curve_btn green_btn text-center">
                <button class="submit btn-lg" type="submit" name="test">Submit</button>
         </div>
         
       
         
        </div>
        
        
    </div>


  </div>
</div>
</form>
		<div class="powered">Powered by PBOPlus Consulting services</div>
      

        
	</body>
</html>