<?php 
//	echo ! empty($h2_title) ? '<h2>' . $h2_title . '</h2>': '';
	echo ! empty($message) ? '<p class="message">' . $message . '</p>': '';

	$flashmessage = $this->session->flashdata('message');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': '';
?>
<head>
	    <link rel="stylesheet" href="<?php echo base_url() . '/asset/jquery/jquery-ui.css';?>" type="text/css" media="all" />
		<link rel="stylesheet" href="<?php echo base_url() . '/asset/jquery/ui.theme.css';?>" type="text/css" media="all" />
		<script src="<?php echo base_url() . '/asset/jquery/jquery.min.js';?>" type="text/javascript"></script>
		<script src="<?php echo base_url() . '/asset/jquery/jquery-ui.min.js';?>" type="text/javascript"></script>
	
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
<form name="cetakulang_form" method="post" action="<?php echo $form_action; ?>">

	<p>
		<label for="nobps"><?php echo form_checkbox('nobps_check',1, FALSE);?>No. BPS :</label>
		<input type="text" class="form_field" name="nobps1" size="4" value="BPS-" />
		<input type="text" class="form_field" name="counterbps" size="4" value="<?php echo set_value('counterbps', isset($default['counterbps']) ? $default['counterbps'] : ''); ?>" />
		<input type="text" class="form_field" name="nobps2" size="16" value="/WPJ/32/PPK.05/" />
		<input type="text" class="form_field" name="nobpstahun" size="3" value="<?php echo date("Y") ;?>" />
	</p>
	<?php echo form_error('nobps', '<p class="field_error">', '</p>');?> 
	<p>
	  <label for="tahun"><?php echo form_checkbox('tahun_check',3, FALSE);?>Tahun Terima :</label>
    	<?php
    		echo buildYearDropdown("cbotahun",date('Y'));
    	?>
	</p>
		<?php echo form_error('tahun', '<p class="field_error">', '</p>');?>
		
		<input type="submit" name="submit" id="submit" value=" Cetak " />
	</p>
</form>
</body>
