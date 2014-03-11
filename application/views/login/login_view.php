<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
</head>
<style type="text/css">@import url("<?php echo base_url() . 'css/style.css'; ?>");</style>
<style type="text/css">@import url("<?php echo base_url() . 'css/lightbox.css'; ?>");</style>
<link rel="icon" href="<?php echo base_url().'css/images/icon.ico';?>" />
<body>

<body id="<?php echo isset($title) ? $title : ''; ?>">
<div id="wrap">

       <div class="header">

		</div>
		
		<div class="center_content">
       	<div class="left_content">
        
        	<div class="prod_det_box">
        	        	
            <?php
		$attributes = array('name' => 'login_form', 'id' => 'login_form');
		echo form_open('login/process_login', $attributes);
	?>
		
		<?php 
			$message = $this->session->flashdata('message');
			echo $message == '' ? '' : '<p id="message">' . $message . '</p>';
		?>
		
		<p>
			<label for="username">Username:</label>
			<input type="text" name="username" size="20" class="form_field" value="<?php echo set_value('username');?>"/>			
		</p>
		<?php echo form_error('username', '<p class="field_error">', '</p>');?>
		
		<p>
			<label for="password">Password:</label>
			<input type="password" name="password" size="20" class="form_field" value="<?php echo set_value('password');?>"/>			
		</p>
		<?php echo form_error('password', '<p class="field_error">', '</p>');?>
		
		<p>
			<input type="submit" name="submit" id="submit" value="Login" />
		</p>
        	
            <div class="clear"></div>
            </div>
        </div><!--end of left content-->
        
        <div class="right_content">
        
        <!--Blok Flash Info-->
        	<div class="title"><span class="title_icon"></span> </div> 
             <div class="about">
             <p>
               </p>             
             </div>	             
                  
        </div><!--end of right content-->    
       
       <div class="clear"></div>
       </div><!--end of center content-->
		
		<div class="footer">
       		<div class="left_footer">	<?php $this->load->view('footer'); ?></div>
        	<div class="right_footer">
        	<a href="#">help</a>
       		<a href="#">about app</a>
        	<a href="#">contact us</a>       
        </div> 
       
       </div>
</div>

</body>
</html>