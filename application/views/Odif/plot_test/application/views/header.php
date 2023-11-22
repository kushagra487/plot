<?php
error_reporting(0);
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PBO + Consulting services</title>
    <!-- Bootstrap -->
    <link href="<?= base_url();?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?= base_url();?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- iCheck -->
	<link href="<?= base_url();?>vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Custom Theme Style -->
	<link href="<?= base_url();?>vendors/select2/dist/css/select2.min.css" rel="stylesheet">
	
	   <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

	<!-- new dashboard stylesheet -->   
    <link rel="stylesheet" href="<?= base_url();?>vendors/assets/css/main.css">
    
  
    <link rel="stylesheet" href="<?= base_url();?>vendors/assets/lib/metismenu/metisMenu.css">
    
   
    <link rel="stylesheet" href="<?= base_url();?>vendors/assets/lib/animate.css/animate.css">
    
<link rel="stylesheet" href="<?= base_url();?>vendors/assets/css/style-switcher.css">
<link rel="stylesheet/less" type="text/css" href="<?= base_url();?>vendors/assets/less/theme.less">

     <!-- new dashboard stylesheet -->  
   <link rel="stylesheet" href="<?= base_url();?>vendors/datetimepicker/css/bootstrap-datetimepicker.min.css"> 
    <link href="<?= base_url();?>build/css/custom.css" rel="stylesheet">
    
    
    <link rel="stylesheet" href="<?= base_url();?>vendors/assets/css/last_custom.css">
     <link href="<?= base_url();?>vendors/assets/css/select/bootstrap-multiselect.css" rel="stylesheet"> 
</head>
<body class="nav-sm">
  
  
  
  
  
  
  
  
  
    <div class="bg-dark dk" id="wrap">
                <div id="top" class="visible-xs">
                    <!-- .navbar -->
                    <nav class="navbar navbar-inverse navbar-static-top">
                        <div class="container-fluid">
                    
                    
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <header class="navbar-header">
                    
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#left">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a href="<?= base_url()?>dashboard/" class="navbar-brand">
                            <img class="img-responsive" src="<?= base_url();?>logo/logo-white.png" alt=""/></a>
                    
                            </header>
                        </div>
                        <!-- /.container-fluid -->
                    </nav>
                    <!-- /.navbar --> 
                        <!-- /.head -->
                </div>
                <!-- /#top -->
                    <div id="left">
                        <div class="media user-media bg-dark dker">
                            <div class="user-media-toggleHover">
                                <span class="fa fa-user"></span>
                            </div>
                            <div class="logo">
                            <a href="<?= base_url()?>dashboard/" class="navbar-brand">
                            <img class="img-responsive" src="<?= base_url();?>logo/logo-white.png" alt=""/></a> <span class="ft-22 text-uppercase">Plot</span>
                            </div>
                            
                            <div class="user-wrapper bg-dark">
                                    <h5 class="media-heading">
                                    <a href="<?= base_url();?>manage_users/edit_users/" style="color:white !important; text-decoration:underline;">Hi, <?php echo $this->session->userdata['name']?></a>  <a href="<?= base_url();?>login/logout" data-toggle="tooltip" title="Logout" data-placement="bottom" class="pull-right"><i class="fa fa-power-off" aria-hidden="true"></i></a>
                                    
                                    </h5>
                            </div>
                        </div>
                        <!-- #menu -->
                        <ul id="menu" class="bg-dark dker">
                                <li class="">
                                    <a href="<?= base_url()?>dashboards/">
                                      <i class="fa fa-dashboard ft-18"></i><span class="link-title"> Dashboard</span>
                                    </a>
                                  </li>
                                  <li class="">
                                    <a href="<?= base_url()?>dashboard/">
                                      <i class="fa fa-line-chart ft-18"></i><span class="link-title"> Performance</span>
                                    </a>
                                  </li>
                                  <li class="">
                                    <a  href="<?= base_url();?>add_project/">
                                      <i class="fa fa-copy ft-18"></i>
                                      <span class="link-title"> My Project</span>
                                    </a>
                                  </li>
                                  
                                  <?php if($this->session->userdata['role']=='Editor' || $this->session->userdata['role']=='Admin' || $this->session->userdata['role']=='Project Manager') {?>
                                   <li>
                                        <a href="<?= base_url();?>add_users/view_users/">
                                          <i class="fa fa-user ft-20" aria-hidden="true"></i> <span class="link-title"> Users</span> </a>
                                      </li>
                                      <?php } ?>
                                                             
                                <li class="">
                                    <a  href="<?= base_url();?>delay_management">
                                      <i class="fa fa-hourglass-end ft-18"></i>
                                      <span class="link-title"> Delay Management</span>
                                    </a>
                                  </li>
                                  <li class="">
                                    <a  href="<?= base_url();?>create_audit">
                                      <i class="fa fa-search ft-18"></i>
                                      <span class="link-title"> Create Audit</span>
                                    </a>
                                  </li>
                                </ul>
                        <!-- /#menu -->
                    </div>
                    <!-- /#left -->
                    
                    
                  <?php if($this->uri->segment('1')=="edit_wbs") { ?>                 
                   <div id="load"></div>   
                 <?php } ?>
                <div id="content">
                    <div class="outer">
                        <div class="inner bg-light lter" style="min-height:400px;">
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
    <div class="container body">
        <div class="main_container">
           
           
           
            <!--<div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="<?= base_url()?>dashboard/" class="site_title">
                            <img class="img-responsive" src="<?= base_url();?>logo/<?php echo $logo['image_name']; ?>" alt=""/>
                        </a>
                    </div>-->

                    <!-- menu profile quick info -->
                    <!--<div class="profile clearfix">
                        <div class="profile_pic">
                            <img src="<?= base_url(); ?>user_uploads/<?php echo $user_detail['image']; ?>" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Welcome
							</span>
                            <h2><?php echo $user_detail['user_id']; ?></h2>
                        </div>
                    </div>-->
                    <!-- /menu profile quick info -->
                   
                   