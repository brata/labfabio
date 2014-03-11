<?php 
//	echo ! empty($h2_title) ? '<h2>' . $h2_title . '</h2>': '';
	//echo ! empty($message) ? '<p class="message">' . $message . '</p>': '';

	$flashmessage = $this->session->flashdata('message');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': '';
?>
<head>
	    <link rel="stylesheet" href="http://localhost/tpt/asset/jquery/jquery-ui.css" type="text/css" media="all" />
		<link rel="stylesheet" href="http://localhost/tpt/asset/jquery/ui.theme.css" type="text/	css" media="all" />
		<script src="http://localhost/tpt/asset/jquery/jquery.min.js" type="text/javascript"></script>
		<script src="http://localhost/tpt/asset/jquery/jquery-ui.min.js" type="text/javascript"></script>
	
    <script type="text/javascript">  
    $(function() {  
        $('#datepicker').datepicker({  
              changeMonth: true,  
              changeYear: true,
              dateFormat: "yy-mm-dd"
            });  
    });  
    
    $(function() {  
        $('#datepicker2').datepicker({  
              changeMonth: true,  
              changeYear: true,
              dateFormat: "yy-mm-dd"  
            });  
    }); 
    </script>  
</head>
<body>
<form name="bernpwp_form" method="post" action="<?php echo $form_action; ?>">
	<p>
		<label for="usrnama">Nama Pengguna :</label>
		<input type="text" class="form_field" name="usrnama" size="16" value="<?php echo set_value('usrnama', isset($default['usrnama']) ? $default['usrnama'] : ''); ?>" />
	</p>
	
	<p>
		<label for="passwd1">Password :</label>
		<input type="text" class="form_field" name="passwd1" size="16" value="<?php echo set_value('passwd1', isset($default['passwd1']) ? $default['passwd1'] : ''); ?>" />
	</p>
	
	<p>
		<label for="passwd2">Password :</label>
		<input type="text" class="form_field" name="passwd2" size="16" value="<?php echo set_value('passwd2', isset($default['passwd2']) ? $default['passwd2'] : ''); ?>" />
	</p>
	<?php echo form_error('passwd2', '<p class="field_error">', '</p>');?> 
	
	<p>
	  <label for="grppengguna">Group Pengguna :</label>
    	<?php
    		echo form_dropdown("grppengguna",$option_grppengguna, isset($default['grppengguna']) ? $default['grppengguna'] : '',"id='grppengguna'");
    	?>
	</p>
		<?php echo form_error('grppengguna', '<p class="field_error">', '</p>');?>
	
	<p>
		<label for="profil">Profil Pengguna :</label>
		<input type="text" class="form_field" name="profil" size="30" value="<?php echo set_value('profil', isset($default['profil']) ? $default['profil'] : ''); ?>" />
	</p>
	<?php echo form_error('perihal', '<p class="field_error">', '</p>');?> 

	<p>
		<label for="tanya">Pertanyaan Pengingat :</label>
		<input type="text" class="form_field" name="tanya" size="30" value="<?php echo set_value('tanya', isset($default['tanya']) ? $default['tanya'] : ''); ?>" />
	</p>
	<?php echo form_error('perihal', '<p class="field_error">', '</p>');?> 
	
	<p>
		<label for="jawab">Jawaban :</label>
		<input type="text" class="form_field" name="jawab" size="50" value="<?php echo set_value('jawab', isset($default['jawab']) ? $default['jawab'] : ''); ?>" />
	</p>
	<?php echo form_error('perihal', '<p class="field_error">', '</p>');?> 
		<input type="submit" name="submit" id="submit" value=" Simpan " />
	</p>
</form>
</body>
</body>