<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Giohang extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Giohangs');
	}
	public function luu()
	{
		 $this->Giohangs->luu();
		 redirect('','refresh');
	}
	

}

/* End of file Giohang.php */
/* Location: ./application/controllers/Giohang.php */