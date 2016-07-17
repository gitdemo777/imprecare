<!DOCTYPE html> 
<html lang="en-US">
<head>
  <title>JangoMoney</title>
  <meta charset="utf-8">
  <link href="<?php echo base_url(); ?>assets/css/admin/global.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="navbar navbar-fixed-top">
	  <div class="navbar-inner">
	    <div class="container">
	      <a class="brand">JangoMoney</a>
	      <ul class="nav">
	        <li <?php if($this->uri->segment(2) == 'users'){echo 'class="active"';}?>>
	          <a href="<?php echo base_url(); ?>admin/users">Users</a>
	        </li>
	        <li <?php if($this->uri->segment(2) == 'challenge'){echo 'class="active"';}?>>
	          <a href="<?php echo base_url(); ?>admin/challenge">Challenge</a>
	        </li>
	        <li <?php if($this->uri->segment(2) == 'country'){echo 'class="active"';}?>>
	          <a href="<?php echo base_url(); ?>admin/country">Country</a>
	        </li>
	        <li <?php if($this->uri->segment(2) == 'earnmore'){echo 'class="active"';}?>>
	          <a href="<?php echo base_url(); ?>admin/earnmore">Earn More</a>
	        </li>
	        <li <?php if($this->uri->segment(2) == 'feedback'){echo 'class="active"';}?>>
	          <a href="<?php echo base_url(); ?>admin/feedback">Feedback</a>
	        </li>
	        <li <?php if($this->uri->segment(2) == 'invitemore'){echo 'class="active"';}?>>
	          <a href="<?php echo base_url(); ?>admin/invitemore">Invite Earn More</a>
	        </li>
	        <li <?php if($this->uri->segment(2) == 'inviteunlimited'){echo 'class="active"';}?>>
	          <a href="<?php echo base_url(); ?>admin/inviteunlimited">Invite Earn Unlimited</a>
	        </li>
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown">System <b class="caret"></b></a>
	          <ul class="dropdown-menu">
	            <li>
	            <a href="<?php echo base_url(); ?>admin/changepassword">Change Password</a>
	              <a href="<?php echo base_url(); ?>admin/logout">Logout</a>
	            </li>
	          </ul>
	        </li>
	      </ul>
	    </div>
	  </div>
	</div>	
