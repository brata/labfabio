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
		<script src="<?php echo base_url() . '/tpt/asset/jquery/jquery-ui.min.js';?>" type="text/javascript"></script>
	
 </head>
<body>
<form name="rekapreg_form" method="post" action="<?php echo $form_action; ?>" target="_blank">

	<p>
	  <label for="tglterima"><?php echo form_checkbox('tglterima_check', '1', FALSE);?>Tanggal Terima :</label>
    	<?php
    		echo buildDayDropdown("cbotgl",date('j'));
    	?>
	</p>
		<?php echo form_error('tglterima', '<p class="field_error">', '</p>');?>
	
	<p>
	  <label for="bulanterima"><?php echo form_checkbox('bulanterima_check', '3', FALSE);?>Bulan Terima :</label>
    	<?php
    		echo buildMonthDropdown("cbobulan",date('n'));
    	?>
	</p>
		<?php echo form_error('bulanterima', '<p class="field_error">', '</p>');?>
		
	<p>
	  <label for="tahunterima"><?php echo form_checkbox('tahunterima_check', '5', FALSE);?>Tahun Terima :</label>
    	<?php
    		echo buildYearDropdown("cbotahun",date('Y'));
    	?>
	</p>
		<?php echo form_error('tahunterima', '<p class="field_error">', '</p>');?>
		
		<input type="submit" name="submit" id="submit" value=" Proses " />
	</p>
</form>
</body>
