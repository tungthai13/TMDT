<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class BanHang extends CI_Controller {

	public function index()
	{
        $this->load->helper('url');
		$this->load->view('ban_hang');
	}
    
    public function danhSachCuaHang(){
        $this->load->helper('url');
        $this->load->database();
        $maTaiKhoan = $this->input->get('maTaiKhoan');
        $data['maTaiKhoan'] = $maTaiKhoan;
        $data['cuaHangCaNhan'] = $this->db->query("call danhSachCuaHangCaNhan(?)", $maTaiKhoan);
        $this->load->view('ban_hang_danh_sach_cua_hang', $data);
    }
    
    public function danhSachSanPham(){
        $this->load->helper('url');
        $this->load->database();
        $maTaiKhoan = $this->input->get('maTaiKhoan');
        $maCuaHang = $this->input->get('maCuaHang');

        $data['maTaiKhoan'] = $maTaiKhoan;
        $data['danhSachSanPham'] = $this->db->query("call danhSachSanPham(?)", $maCuaHang);
        $this->load->view('ban_hang_danh_sach_cua_hang', $data);
    }

    public function chiTietSanPham()
    {
        $this->load->helper('url');
        $this->load->database();
        $maTaiKhoan = $this->input->get('maTaiKhoan');
        $maCuaHang = $this->input->get('maCuaHang');

        $data['maTaiKhoan'] = $maTaiKhoan;
        $data['maCuaHang'] = $maCuaHang;
        $data['danhSachSanPham'] = $this->db->query("call danhSachSanPham(?)", $maCuaHang);
        $this->load->view('ban_hang_danh_sach_cua_hang', $data);
        return $this->load;
    }
}
