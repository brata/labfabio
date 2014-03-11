<?PHP
	echo ! empty($message) ? '<p class="message">' . $message . '</p>': '';

	$flashmessage = $this->session->flashdata('message');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': '';
?>
<p>
Berikut adalah aplikasi yang dapat dipergunakan untuk mengelola data :
<ul>
<li>Mutasi Bahan Kimia</li>
<li>Laporan Bahan Kimia Laboratorium</li>
</ul>
Dan dapat dikelola dengan mudah selanjutnya.
</p>