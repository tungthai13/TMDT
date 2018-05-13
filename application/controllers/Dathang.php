<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dathang extends CI_Controller {
	function __construct()
	{ 
		parent::__construct(); 
		$this->load->model('donhang');

	}
	public function index()
	{
		$data['title'] = "chuan bi dat hang";
		$data['datMon'] = $_POST;  
		$_SESSION['json'] = '';
		$_SESSION['json'] = $_POST['json'];
		$this->load->view('chuanbithanhtoan',$data); 
	}
	public function thanhtoan()
	{ 
		$data['thanhtoan'] = $_POST;  
		$list_sanpham = $_SESSION['json'];
		$data['json'] = json_decode($list_sanpham,true);
		$maCuaHang = $_POST['maCuaHang']; 
		$data['cuaHang'] = $this->donhang->getCuaHang($maCuaHang);  
		$this->load->view('thanhtoan',$data);
	}
	public function saveAll()
	{
		$data['cuaHang'] = $this->donhang->savedonhang();  
		redirect('','refresh');

	}
}

/* End of file DatHang.php */
/* Location: ./application/controllers/DatHang.php */