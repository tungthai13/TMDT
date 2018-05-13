<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DatMon extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */ 
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
        $this->load->database();
		$this->load->model('Giohangs');
		
	}
	public function index()
	{ 
		if(isset($_SESSION['user'])){$data['maTaiKhoan'] = $_SESSION['user'][0]['ma_khach_hang'];

		 } else { $data['maTaiKhoan'] = 0;}  
        
        $data['maCuaHang'] = $this->input->get('maCuaHang');  
        $data['maGioHang']  = $this->Giohangs->getMaGioHang($data['maTaiKhoan']);
        if (mysqli_more_results($this->db->conn_id)) {
            mysqli_next_result($this->db->conn_id);
        }
        $data['cuaHang'] = $this->db->query("call timCuaHangBangMaCuaHang(?)", $data['maCuaHang']);
        $data['lat'] = $data['cuaHang']->row()->lat;
        $data['lng'] = $data['cuaHang']->row()->lng;
        if (mysqli_more_results($this->db->conn_id)) {
            mysqli_next_result($this->db->conn_id);
        }
        $data['sanPham'] = $this->db->query("call danhSachSanPham(?)", $data['maCuaHang']);

        if (mysqli_more_results($this->db->conn_id)) {
            mysqli_next_result($this->db->conn_id);
        }
        $array['maTaiKhoan'] = $data['maTaiKhoan'];
        $array['maCuaHang'] = $data['maCuaHang'];
        $chiTietGioHang = $this->db->query("call layChiTietGioHang(?,?)", $array);

        $resultSet = Array();
		    foreach($chiTietGioHang->result() as $result) {
		    	$result1 = Array();
		    	$result1['maSanPham'] = $result->ma_san_pham;
		    	$result1['tenSanPham'] = $result->ten_san_pham;
		    	$result1['soLuong'] = intval($result->so_luong);
		    	$result1['donGia'] = $result->don_gia;
		       $resultSet[] = $result1;
		    }
		$data['chiTietGioHang'] = json_encode($resultSet);
		$data['a'] = $resultSet;
        
        $this->load->view('dat_mon', $data);
	}
}
