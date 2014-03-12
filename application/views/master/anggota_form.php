<?php 
	echo ! empty($h2_title) ? '<h2>' . $h2_title . '</h2>': '';
	echo ! empty($message) ? '<p class="message">' . $message . '</p>': '';

	$flashmessage = $this->session->flashdata('message');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': '';
?>
<head>
	    <link rel="stylesheet" href="<?php echo base_url() . 'asset/jquery/jquery-ui.css';?>" type="text/css" media="all" />
		<link rel="stylesheet" href="<?php echo base_url() . 'asset/jquery/ui.theme.css';?>" type="text/	css" media="all" />
		<script src="<?php echo base_url() . 'asset/jquery/jquery.min.js';?>" type="text/javascript"></script>
		<script src="<?php echo base_url() . 'asset/jquery/jquery-ui.min.js';?>" type="text/javascript"></script>

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
<form name="anggota_form" method="post" action="<?php echo $form_action; ?>">
	<p>
		<label for="noanggota">No Anggota :</label>
		<input type="text" class="form_field" name="noanggota" size="6" value="<?php echo set_value('noanggota', isset($default['noanggota']) ? $default['noanggota'] : ''); ?>" />
	</p>
	<?php echo form_error('noanggota', '<p class="field_error">', '</p>');?>
	
	<p>
		<label for="nama">Nama :</label>
		<input type="text" class="form_field" name="nama" size="30" value="<?php echo set_value('nama', isset($default['nama']) ? $default['nama'] : ''); ?>" />
	</p>
	<p><?php echo form_error('nama', '<p class="field_error">', '</p>');?>  </p>
	<p>
	  <label for="alamat">Alamat :</label>
      <input type="text" class="form_field" name="alamat" size="30" value="<?php echo set_value('alamat', isset($default['alamat']) ? $default['alamat'] : ''); ?>" />
</p>
	<p><?php echo form_error('alamat', '<p class="field_error">', '</p>');?></p>
	<p>
	  <label for="idkec">Kecamatan :</label>
    	<?php
    		echo form_dropdown("idkec",$option_kecamatan, isset($default['idkec']) ? $default['idkec'] : '',"id='idkec'");
    	?>
	</p>
	<p><?php echo form_error('idkec', '<p class="field_error">', '</p>');?></p>
	<p>
	  <label for="iddesa">Desa :</label>
		<div id="desadd">
			<?php
    			echo form_dropdown("iddesa",$option_desa,isset($default['iddesa']) ? $default['iddesa'] : '');
    		?>
	  	</div>	  
	</p>
    </p>
    <p><?php echo form_error('iddesa', '<p class="field_error">', '</p>');?></p>
	  <p>
	  <label for="id_jk">Jenis Kelamin:</label>
      <?php echo form_dropdown('id_jk', $options_jk, isset($default['id_jk']) ? $default['id_jk'] : ''); ?> </p>
	<p><?php echo form_error('id_jk', '<p class="field_error">', '</p>');?></p>
	<p>
	  <label for="id_agama">Agama:</label>
      <?php echo form_dropdown('id_agama', $options_agama, isset($default['id_agama']) ? $default['id_agama'] : ''); ?> </p>
	<?php echo form_error('id_agama', '<p class="field_error">', '</p>');?>
	<p>
	  <label for="tglmasuk">Tanggal Masuk :</label>
      <input id="datepicker" type="text" class="form_field" name="tglmasuk" size="10" value="<?php echo set_value('tglmasuk', isset($default['tglmasuk']) ? $default['tglmasuk'] : ''); ?>" />
</p>
	<?php echo form_error('nis', '<p class="field_error">', '</p>');?>
    <label for="tanggal"></label>
<p>
    <label for="id_status">Status Anggota :</label>
        <?php echo form_dropdown('id_status', $options_status, isset($default['id_status']) ? $default['id_status'] : ''); ?> </p>
<?php echo form_error('id_status', '<p class="field_error">', '</p>');?>
<p>
		<input type="submit" name="submit" id="submit" value=" Simpan " />
	</p>
</form>

    <script type="text/javascript">
	  	$("#idkec").change(function(){
	    		var selectValues = $("#idkec").val();
	    		if (selectValues == 0){
	    			var msg = "<select name=\"iddesa\" disabled><option value=\"Pilih Desa\">Pilih Kecamatan Dahulu</option></select>";
	    			$('#desadd').html(msg);
	    		}else{
	    			var idkec = {idkec:$("#idkec").val()};
	    			$('#ididesa').attr("disabled",true);
	    			$.ajax({
							type: "POST",
							url : "<?php echo site_url('anggota/select_desa')?>",
							data: idkec,
							success: function(msg){
								$('#desadd').html(msg);
							}
				  	});
	    		}
	    });
	   </script>
	   
</body>
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