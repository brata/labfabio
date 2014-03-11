<?php 
//	echo ! empty($h2_title) ? '<h2>' . $h2_title . '</h2>': '';
	//echo ! empty($message) ? '<p class="message">' . $message . '</p>': '';

	$flashmessage = $this->session->flashdata('message');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': '';
?>
<head>
	    <link rel="stylesheet" href="<?php echo base_url() . '/asset/jquery/jquery-ui.css';?>" type="text/css" media="all" />
		<link rel="stylesheet" href="<?php echo base_url() . '/asset/jquery/ui.theme.css';?>" type="text/	css" media="all" />
		<script src="<?php echo base_url() . '/asset/jquery/jquery.min.js';?>" type="text/javascript"></script>
		<script src="<?php echo base_url() . '/asset/jquery/jquery-ui.min.js';?>" type="text/javascript"></script>
	
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
		<input type="hidden"  class="form_field" name="idinfo" size="14" value="<?php echo set_value('idinfo', isset($default['idinfo']) ? $default['idinfo'] : ''); ?>" />
	</p>
	<p>
		<label for="tglawalinfo">Tanggal Awal Info :</label>
		<input type="text" id="datepicker"  class="form_field" name="tglawalinfo" size="14" value="<?php echo set_value('tglawalinfo', isset($default['tglawalinfo']) ? $default['tglawalinfo'] : ''); ?>" />
	</p>
	
	<p>
		<label for="tglakhirinfo">Tanggal Akhir Info :</label>
		<input type="text" id="datepicker2" class="form_field" name="tglakhirinfo" size="14" value="<?php echo set_value('tglakhirinfo', isset($default['tglakhirinfo']) ? $default['tglakhirinfo'] : ''); ?>" />
	</p>
	<?php echo form_error('passwd2', '<p class="field_error">', '</p>');?> 
	
	<p>
		<label for="info">Info :</label>
		<textarea class="form_field" rows="6" cols="40"   name="info"> <?php echo set_value('info', isset($default['info']) ? $default['info'] : ''); ?> </textarea>
	</p>
	<?php echo form_error('perihal', '<p class="field_error">', '</p>');?> 
		<input type="submit" name="submit" id="submit" value=" Simpan " />
	</p>
</form>
</body>
</body>