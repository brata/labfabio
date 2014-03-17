<?php
/* 	echo ! empty($h2_title) ? '<h2>' . $h2_title . '</h2>': '';
	echo ! empty($message) ? '<p class="message">' . $message . '</p>': ''; */
	
	$flashmessage = $this->session->flashdata('message');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': '';
?>

<form name="transaksi_form" method="post" action="<?php echo $form_action; ?>">
  <table width="100%" border="0">
    <tr>
      <td width="47%" height="70">
	  <p>Cari Dosen Berdasarkan : </p>
      <p> Nama Atau  Kode Bahan Kimia
          <input name="kriteria" type="text" class="form_field" id="kriteria" value="<?php echo set_value('nip'); ?>" size="30"/>
          <input type="submit" name="submit" id="submit" value=" O K " />
      </p>
      </td>
    </tr>
  </table>
  <label> <?php echo form_error('id_kelas', '<p class="field_error">', '</p>');?><br/>
  </label>
  <label for="kriteria"></label>
</form>
<p>
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
}?>
</p>
