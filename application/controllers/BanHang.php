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
    
    public function danhSachSanPham($maCuaHang = null){
        $this->load->helper('url');
        $this->load->database();
        if(isset($_GET['maCuaHang'])){
            $maCuaHang = $this->input->get('maCuaHang');
        }
        $data['maCuaHang'] = $maCuaHang;
        $data['danhSachSanPham'] = $this->db->query("call danhSachSanPham(?)", $maCuaHang);
        $this->load->view('ban_hang_danh_sach_san_pham', $data);
    }

    public function chiTietSanPham()
    {
        $this->load->helper('url');
        $this->load->database();
        
        $maCuaHang = $this->input->get('maCuaHang');
        $maSanPham = $this->input->get('maSanPham');
        $data['maCuaHang'] = $maCuaHang;
        $data['sanPham'] = $this->db->query("call chiTietSanPham(?)", $maSanPham);
        $this->load->view('ban_hang_chi_tiet_san_pham', $data);
    }
    
    public function suaThongTinSanPham(){
        $this->load->helper('url');
        $this->load->database();
        
        //Upload ảnh
        if (!empty($_FILES['picture']['name'])) {
            $config['upload_path'] = 'image';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['picture']['name'];

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('picture')) {
                //Trường hợp upload thành công
                $uploadData = $this->upload->data();
                $data["image"] = $uploadData['file_name'];
            } else {
                //Trường hợp upload lỗi
                $data["image"] = $this->input->post('anhMinhHoa');
            }
        } else {
            //Trường hợp không chọn ảnh
            $data["image"] = $this->input->post('anhMinhHoa');
        }

        $data['maCuaHang'] = $this->input->post('maCuaHang');
        
        $arr['maSanPham'] = $this->input->post('maSanPham');
        $arr['tenSanPham'] = $this->input->post('tenSanPham');
        $arr['donGia'] = $this->input->post('donGia');
        $arr['tenNhomSanPham'] = $this->input->post('tenNhomSanPham');
        $arr['trangThaiSanPham'] = $this->input->post('trangThaiSanPham');
        $arr['anhMinhHoa'] = $data["image"];
        
        $this->db->query("call capNhatSanPham(?,?,?,?,?,?)", $arr);
        
        $this->danhSachSanPham($data['maCuaHang']);
    }
    
    public function trangThemSanPham(){
        $this->load->helper('url');
        $data['maCuaHang'] = $this->input->get('maCuaHang');
        $this->load->view('ban_hang_them_san_pham', $data);
    }
    
    public function themSanPham(){
        $this->load->helper('url');
        $this->load->database();
        
        //Upload ảnh
        if (!empty($_FILES['picture']['name'])) {
            $config['upload_path'] = 'image';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['picture']['name'];

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('picture')) {
                //Trường hợp upload thành công
                $uploadData = $this->upload->data();
                $data["image"] = $uploadData['file_name'];
            } else {
                //Trường hợp upload lỗi
                $data["image"] = 'logo-default.jpg';
            }
        } else {
            //Trường hợp không chọn ảnh
            $data["image"] = 'logo-default.jpg';
        }

        $data['maCuaHang'] = $this->input->post('maCuaHang');
        $arr['maCuaHang'] = $data['maCuaHang'];
        $arr['tenSanPham'] = $this->input->post('tenSanPham');
        $arr['donGia'] = $this->input->post('donGia');
        $arr['soLanDat'] = $this->input->post('soLanDat');
        $arr['tenNhomSanPham'] = $this->input->post('tenNhomSanPham');
        $arr['trangThaiSanPham'] = $this->input->post('trangThaiSanPham');
        $arr['anhMinhHoa'] = $data["image"];
        
        $this->db->query("call themSanPham(?,?,?,?,?,?,?)", $arr);
        
        $this->danhSachSanPham($data['maCuaHang']);
    }
    
    public function xoaSanPham(){
        $this->load->helper('url');
        $this->load->database();
        
        $data['maCuaHang'] = $this->input->post('maCuaHang');
        $data['maSanPham'] = $this->input->post('maSanPham');
        $this->db->query("call xoaSanPham(?)", $data['maSanPham']);
        $this->danhSachSanPham($data['maCuaHang']);
    }
    
}
