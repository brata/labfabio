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
<form name="dosen_form" method="post" action="<?php echo $form_action; ?>">
	<p>
		<label for="noanggota">N I P :</label>
		<input type="text" class="form_field" name="idpengambil" size="16" value="<?php echo set_value('idpengambil', isset($default['idpengambil']) ? $default['idpengambil'] : ''); ?>" />
	</p>
	<?php echo form_error('nip', '<p class="field_error">', '</p>');?>
	<p>
		<label for="nama">Nama :</label>
		<input type="text" class="form_field" name="nama" size="30" value="<?php echo set_value('nama', isset($default['nama']) ? $default['nama'] : ''); ?>" />
	</p>
	<?php echo form_error('nama', '<p class="field_error">', '</p>');?>
	<p>
	  <label for="alamat">Alamat :</label>
      <input type="text" class="form_field" name="alamat" size="40" value="<?php echo set_value('alamat', isset($default['alamat']) ? $default['alamat'] : ''); ?>" />
	</p>
	<?php echo form_error('alamat', '<p class="field_error">', '</p>');?>
	<p>
	  <label for="alamat">No. HP :</label>
      <input type="text" class="form_field" name="nohp" size="15" value="<?php echo set_value('nohp', isset($default['nohp']) ? $default['nohp'] : ''); ?>" />
	</p>
	<?php echo form_error('alamat', '<p class="field_error">', '</p>');?>
	<p>
	  <label for="alamat">Email :</label>
      <input type="text" class="form_field" name="email" size="30" value="<?php echo set_value('email', isset($default['email']) ? $default['email'] : ''); ?>" />
	</p>
	<?php echo form_error('alamat', '<p class="field_error">', '</p>');?>
	<p>
	  <label for="idkec">Tempat Lahir :</label>
		<input type="text" class="form_field" name="tempatlahir" size="25" value="<?php echo set_value('tempatlahir', isset($default['tempatlahir']) ? $default['tempatlahir'] : ''); ?>" />
	</p>
	<?php echo form_error('tempatlahir', '<p class="field_error">', '</p>');?>  
	<p>
	  <label for="tglmasuk">Tanggal Lahir :</label>
      <input id="datepicker" type="text" class="form_field" name="tgllahir" size="10" value="<?php echo set_value('tglmasuk', isset($default['tglmasuk']) ? $default['tglmasuk'] : ''); ?>" />
	</p>
	<p>
	  <label for="id_jk">Jenis Kelamin:</label>
      <?php echo form_dropdown('id_jk', $options_jk, isset($default['id_jk']) ? $default['id_jk'] : ''); ?>
	</p>
	<?php echo form_error('id_jk', '<p class="field_error">', '</p>');?>
	<p>
	  <label for="id_agama">Agama:</label>
      <?php echo form_dropdown('id_agama', $options_agama, isset($default['id_agama']) ? $default['id_agama'] : ''); ?> 
	</p>
	<?php echo form_error('id_agama', '<p class="field_error">', '</p>');?>
	<p>
	  <label for="idjurusan">Jurusan :</label>
			<?php
    			echo form_dropdown("idjurusan",$options_jurusan,isset($default['idjurusan']) ? $default['idjurusan'] : '');
    		?>
	</p>
    <?php echo form_error('idjurusan', '<p class="field_error">', '</p>');?>
    <label for="tanggal"></label>
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