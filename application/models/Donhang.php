<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Donhang extends CI_Model {
	public function __construct()
	{
		parent::__construct(); 
		$this->load->database();
	} 
	public function getCuaHang($maCuaHang)
	{
		$this->db->select('*');
        $this->db->where('ma_cua_hang', $maCuaHang);  
        $this->db->from('cua_hang');
        $query=$this->db->get();
		return $query->result_array();

	}
	public function savedonhang()
	{ 
		$maCuaHang = $this->input->post('maCuaHang');	
		$tongTienThanhToan = $this->input->post('tongTienThanhToan');	
		$diaChiCuaHang = $this->input->post('diaChiCuaHang');	
		$address = $this->input->post('address');	
		$lat = $this->input->post('lat');	
		$lng = $this->input->post('lng');	
		$maTaiKhoan = $this->input->post('maTaiKhoan');	
		$ngay = $this->input->post('ngay');	
		$gio = $this->input->post('gio');	
		$soDT = $this->input->post('soDT');	
		$ghiChu = $this->input->post('ghiChu');	
		$data = array(
			'ma_cua_hang'=> $maCuaHang,
			'ma_khach_hang' => $maTaiKhoan,
			'so_dien_thoai' => $soDT,
			'dia_chi' => $address,
			'ngay_tao_don_hang' => $ngay,
			'ngay_giao_hang' => $ngay,
			'gio_giao_hang' => $gio ,
			'tong_chi_phi_van_chuyen' =>50,
			'tong_tien_thanh_toan' => $tongTienThanhToan,
			'ma_phuong_thuc_thanh_toan' =>1,
			'trang_thai_don_hang' =>1,
			'ghi_chu' => $ghiChu,
			'ma_van_chuyen' =>1, 
		);

		$this->db->insert('don_hang',$data);
	}


}

/* End of file Dathang.php */
/* Location: ./application/models/Donhang.php */