<?php 
//	echo ! empty($h2_title) ? '<h2>' . $h2_title . '</h2>': '';
	echo ! empty($message) ? '<p class="message">' . $message . '</p>': '';

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
  <?php echo ! empty($pagination) ? '<p id="pagination">' . $pagination . '</p>' : ''; ?>
  <?php echo '<br />';?>
  <?php echo ! empty($table) ? $table : ''; ?>
  <?php echo '<br />';?>
  <?php
if ( ! empty($link))
{
	echo '<p id="bottom_link">';
	foreach($link as $links)
	{
		echo $links . ' ';
	}
	echo '</p>';
}
?>

<form name="cariwp_form" method="post" action="<?php echo $form_action; ?>">
		
	<p>
		<label for="mnpwp"><?php echo form_checkbox('mnpwp_check', '1', FALSE);?>MNPWP :</label>
		<input type="text" class="form_field" name="mnpwp" size="20" value="<?php echo set_value('mnpwp', isset($default['mnpwp']) ? $default['mnpwp'] : ''); ?>" />
	</p>
	<?php echo form_error('npwp', '<p class="field_error">', '</p>');?> 
	
		<p>
		<label for="namawp"><?php echo form_checkbox('namawp_check', '3', FALSE);?>Nama Wajib Pajak :</label>
		<input type="text" class="form_field" name="namawp" size="30" value="<?php echo set_value('namawp', isset($default['namawp']) ? $default['namawp'] : ''); ?>" />
	</p>
	<?php echo form_error('namawp', '<p class="field_error">', '</p>');?> 
	
		<p>
		<label for="alamatwp"><?php echo form_checkbox('alamatwp_check', '5', FALSE);?>Alamat :</label>
		<input type="text" class="form_field" name="alamatwp" size="60" value="<?php echo set_value('alamatwp', isset($default['alamatwp']) ? $default['alamatwp'] : ''); ?>" />
	</p>
	<?php echo form_error('alamatwp', '<p class="field_error">', '</p>');?> 
	
		<input type="submit" name="submit" id="submit" value=" Cari " />
	</p>
</form>
</body>
