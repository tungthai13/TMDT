<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Giohangs extends CI_Model {

	public function __construct()
	{ 
		parent::__construct();
		$this->load->database();
	}
	public function getMaGioHang($maKhachHang)
	{
		// $query = $this->db->get('gio_hang');
		// $query = $this->db->where('ma_khach_hang',$maKhachHang);
		$query = $this->db->get_where('gio_hang', array('ma_khach_hang' => $maKhachHang));

		return $query->row_array();
	}
	public function luu()
	{ 
		$list_sanpham = $this->input->post("json");
		$maGioHang = $this->input->post('ma_gio_hang');
		$maCuaHang = $this->input->post('ma_cua_hang');
   
		$list_sanpham = json_decode($list_sanpham,true); 
		// var_dump($list_sanpham); die();
		$array = null ;
		foreach ($list_sanpham as $sanpham) { 
			$maSanPham =(int)$sanpham['maSanPham']; 
			$this->db->where('ma_san_pham',$maSanPham);
			$this->db->delete('chi_tiet_gio_hang');
			
		}  
		foreach ($list_sanpham as $sanpham) { 
			$maSanPham =(int)$sanpham['maSanPham'];
			$array  = array( 
				'ma_gio_hang' => $maGioHang,
				'ma_cua_hang' => $maCuaHang,
				'ma_san_pham' => $maSanPham,
				'so_luong' => $sanpham['soLuong'] 
			); 
			$this->db->insert('chi_tiet_gio_hang',$array);
			
		}
		
		
	}

}

/* End of file Giohang.php */
/* Location: ./application/models/Giohang.php */