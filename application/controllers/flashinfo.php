<?php

/**
 * @author Trias Bratakusuma
 * @copyright 2012
 */

//echo("Pengumuman penting dengar hey dengar");
class Flashinfo extends CI_Controller {
	/**
	 * Constructor
	 */
	function flashinfo()
	{
		parent::__Construct();
	}

	function index()
	{
		$dataflash = $this->Info_model->get_flashinfo();
		$dataflashbaris = $dataflash->row();
		
		echo $dataflashbaris->info;
	}
}
?>