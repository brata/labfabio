<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="<?php echo base_url().'images/fav_icon.png';?>" />
<style type="text/css">@import url("<?php echo base_url() . 'css/style.css'; ?>");</style>
<style type="text/css">@import url("<?php echo base_url() . 'css/lightbox.css'; ?>");</style>
<title><?php echo isset($title) ? $title : ''; ?></title>
</head>

<body id="<?php echo isset($title) ? $title : ''; ?>">
<div id="wrap">

       <div class="header">
       		<div class="logo"></div>            
        <div id="menu">
            <ul>                                                                       
            <li class="selected"><?php echo anchor('home', 'Home');?></li>
            <li><?php echo anchor('master', 'Data Master');?></li>
            <li><?php echo anchor('mutasi', 'Mutasi Bahan Kimia');?></li>
            <li><?php echo anchor('laporan', 'Laporan');?></li>
            <li><?php echo anchor('login/process_logout', 'Logout', array('onclick' => "return confirm('Anda yakin akan logout?')"));?></li>
            </ul>
        </div>     
            
            
       </div> 
       
       
       <div class="center_content">
       	<div class="left_content">
        	
            <div class="title"><span class="title_icon"><img src="<?php echo base_url().'css/images/bullet1.gif';?>" alt="" title="" /></span><?php echo $h2_title;
	echo ! empty($message) ? '<p class="message">' . $message . '</p>': '';
	
	//$flashmessage = $this->session->flashdata('message');
	//echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': '';
?></div>
        
        	<div class="feat_prod_box">
				<?php $this->load->view($main_view); ?>  
            <div class="clear"></div>
            </div>
        </div><!--end of left content-->
        
        <div class="right_content">
        
        <!--Blok Flash Info-->
        	<div class="title"><span class="title_icon"><img src="<?php echo base_url() . 'css/images/bullet5.gif'; ?>" alt="" title="" /></span>Flash Info</div> 
             <div class="about">
             <p>
             <?php echo $flashinfo;?>
             </p>             
             </div>	
             
            <!--Blok Sub Menu-->
                     
             	<div class="title"><span class="title_icon"><img src="<?php echo base_url() . 'css/images/bullet4.gif'; ?>" alt="" title="" /></span>Sub Menu</div> 
                
              <div class="about">
                <?php $this->load->view($left_view);?>
			   </div>    
		     
        <!--Blok Profil Pengguna-->
        
        	 <div class="title"><span class="title_icon"><img src="<?php echo base_url() . 'css/images/bullet6.gif'; ?>" alt="" title="" /></span>Profil Pengguna</div>
			 <div class="about">
             <center><?php echo 'Selamat Datang, ' . anchor('resetpasswd',$user,array('class' => 'reset')); ?></center>
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