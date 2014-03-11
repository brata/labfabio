<?php

/**
 * @author Trias Bratakusuma
 * @copyright 2012
 */

//	echo ! empty($h2_title) ? '<h2>' . $h2_title . '</h2>': '';
	echo ! empty($message) ? '<p class="message">' . $message . '</p>': '';

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
<form name="resetpasswd_form" method="post" action="<?php echo $form_action; ?>">
		
	<p>
		<label for="usrnama">Nama Pengguna :</label>
		<input type="text" class="form_field" name="usrnama" size="16" value="<?php echo set_value('usrnama', isset($default['usrnama']) ? $default['usrnama'] : ''); ?>" />
	</p>
	<?php echo form_error('usrnama', '<p class="field_error">', '</p>');?> 
	
		<p>
		<label for="oldpass">Password Lama :</label>
		<input type="password" class="form_field" name="oldpass" size="16" value="<?php echo set_value('oldpass', isset($default['oldpass']) ? $default['oldpass'] : ''); ?>" />
	</p>
	<?php echo form_error('namawp', '<p class="field_error">', '</p>');?> 
	
	<p>
		<label for="newpass1">Password Baru :</label>
		<input type="password" class="form_field" name="newpass1" size="16" value="<?php echo set_value('newpass1', isset($default['newpass1']) ? $default['newpass1'] : ''); ?>" />
	</p>
	<?php echo form_error('newpass1', '<p class="field_error">', '</p>');?> 
	
	<p>
		<label for="newpass2">Password Baru :</label>
		<input type="password" class="form_field" name="newpass2" size="16" value="<?php echo set_value('newpass2', isset($default['newpass2']) ? $default['newpass2'] : ''); ?>" />
	</p>
	<?php echo form_error('newpass2', '<p class="field_error">', '</p>');?> 
	
		<input type="submit" name="submit" id="submit" value=" Reset Password " />
	</p>
</form>
</body>
