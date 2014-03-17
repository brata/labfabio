<?php 
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
<form name="bahankimia_form" method="post" action="<?php echo $form_action; ?>">
	<p>
		<label for="noanggota">Kode Bahan Kimia :</label>
		<input type="text" class="form_field" name="idbahankimia" size="16" value="<?php echo set_value('idbahankimia', isset($default['idbahankimia']) ? $default['idbahankimia'] : ''); ?>" />
	</p>
	<?php echo form_error('idbahankimia', '<p class="field_error">', '</p>');?>
	<p>
		<label for="nama">Nama Bahan Kimia :</label>
		<input type="text" class="form_field" name="namabahankimia" size="30" value="<?php echo set_value('namabahankimia', isset($default['namabahankimia']) ? $default['namabahankimia'] : ''); ?>" />
	</p>
	<?php echo form_error('namabahankimia', '<p class="field_error">', '</p>');?>
	<p>
	  <label for="alamat">Nama Latin Bahan Kimia</label>
      <input type="text" class="form_field" name="namalatinbahankimia" size="50" value="<?php echo set_value('alamat', isset($default['alamat']) ? $default['alamat'] : ''); ?>" />
	</p>
	<?php echo form_error('alamat', '<p class="field_error">', '</p>');?>
	<p>
	  <label for="alamat">Rumus Bahan Kimia :</label>
      <input type="text" class="form_field" name="rumusbahankimia" size="50" value="<?php echo set_value('nohp', isset($default['nohp']) ? $default['nohp'] : ''); ?>" />
	</p>
	<?php echo form_error('alamat', '<p class="field_error">', '</p>');?>
	<p>
	  <label for="alamat">Merk Bahan Kimia :</label>
      <input type="text" class="form_field" name="merkbahankimia" size="25" value="<?php echo set_value('email', isset($default['email']) ? $default['email'] : ''); ?>" />
	</p>
	<?php echo form_error('alamat', '<p class="field_error">', '</p>');?>
	<p>
	  <label for="idkec">Packing :</label>
		<input type="text" class="form_field" name="packing" size="25" value="<?php echo set_value('tempatlahir', isset($default['tempatlahir']) ? $default['tempatlahir'] : ''); ?>" />
	</p>
	<?php echo form_error('tempatlahir', '<p class="field_error">', '</p>');?>  
	<p>
	  <label for="idkec">Spesifikasi :</label>
		<input type="text" class="form_field" name="spesifikasi" size="50" value="<?php echo set_value('tempatlahir', isset($default['tempatlahir']) ? $default['tempatlahir'] : ''); ?>" />
	</p>
	<?php echo form_error('tempatlahir', '<p class="field_error">', '</p>');?>  
	<p>
	  <label for="id_jk">Kelompok Bahan Kimia :</label>
      <?php echo form_dropdown('id_jenisbahankimia', $options_jenisbahankimia, isset($default['id_jk']) ? $default['id_jk'] : ''); ?>
	</p>
	<?php echo form_error('id_jk', '<p class="field_error">', '</p>');?>
	<p>
	  <label for="id_agama">Satuan :</label>
      <?php echo form_dropdown('id_satuan', $options_satuan, isset($default['id_agama']) ? $default['id_agama'] : ''); ?> 
	</p>
	<?php echo form_error('id_agama', '<p class="field_error">', '</p>');?>
	<p>
	  <label for="idkec">Stock Kritis :</label>
		<input type="text" class="form_field" name="stockkritis" size="5" value="<?php echo set_value('tempatlahir', isset($default['tempatlahir']) ? $default['tempatlahir'] : ''); ?>" />
	</p>
	<?php echo form_error('stockkritis', '<p class="field_error">', '</p>');?>  
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