<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class BanHang extends CI_Controller {

	public function index()
	{
        $this->load->helper('url');
        $this->load->database();
        
        $data["maTaiKhoan"] = $this->input->get("maTaiKhoan");
        
        if (mysqli_more_results($this->db->conn_id)) {
            mysqli_next_result($this->db->conn_id);
        }
        $sql = $this->db->query("call tongSoCuaHangCaNhan(?)", $data["maTaiKhoan"]);
        $data["tongSoCuaHang"] = $sql->row()->tong_so_cua_hang;
        $this->load->view("ban_hang", $data);
	}
    
    public function danhSachCuaHang($maTaiKhoan = null){
        $this->load->helper('url');
        $this->load->database();
        if(isset($_GET['maTaiKhoan'])){
            $maTaiKhoan = $this->input->get('maTaiKhoan');
        }
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
            $config['encrypt_name'] = TRUE;
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
            $config['encrypt_name'] = TRUE;
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
    
    public function trangThemCuaHang(){
        $this->load->helper('url');
        $this->load->database();
        
        $data["danhSachQuanHuyen"] = $this->db->query("call danhSachQuanHuyen(?)", 1);
        $data["maTaiKhoan"] = $this->input->get("maTaiKhoan");
        
        $this->load->view('ban_hang_them_cua_hang', $data);
    }
    
    public function themCuaHang(){
        $this->load->helper('url');
        $this->load->database();
        
        $data["maTaiKhoan"] = $this->input->post("maTaiKhoan");
        $data["tenCuaHang"] = $this->input->post("tenCuaHang");
        $data["diaChi"] = $this->input->post("diaChi");
        $data["soDienThoai"] = $this->input->post("soDienThoai");
        $data["gioMoCua"] = $this->input->post("gioMoCua");
        $data["gioDongCua"] = $this->input->post("gioDongCua");
        $tenQuanHuyen = $this->input->post("quanHuyen");
        if (mysqli_more_results($this->db->conn_id)) {
            mysqli_next_result($this->db->conn_id);
        }
        $sql = $this->db->query("call layMaQuanHuyen(?)", $tenQuanHuyen);
        $data["maQuanHuyen"] = $sql->row()->ma_quan_huyen;
        $data["lat"] = $this->input->post("lat");
        $data["lng"] = $this->input->post("lng");
        //Upload ảnh
        if (!empty($_FILES['picture']['name'])) {
            $config['encrypt_name'] = TRUE;
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
        
        if (mysqli_more_results($this->db->conn_id)) {
            mysqli_next_result($this->db->conn_id);
        }
        $this->db->query("call themCuaHang(?,?,?,?,?,?,?,?,?,?)", $data);
        
        
        $this->danhSachCuaHang($data["maTaiKhoan"]);
    }
    
    public function chiTietCuaHang(){
        $this->load->helper('url');
        $this->load->database();
        
        $maCuaHang = $this->input->get("maCuaHang");
        if (mysqli_more_results($this->db->conn_id)) {
            mysqli_next_result($this->db->conn_id);
        }
        $data["danhSachQuanHuyen"] = $this->db->query("call danhSachQuanHuyen(?)", 1);
        if (mysqli_more_results($this->db->conn_id)) {
            mysqli_next_result($this->db->conn_id);
        }
        $data["cuaHang"] = $this->db->query("call timCuaHangBangMaCuaHang(?)", $maCuaHang);
        $this->load->view("ban_hang_chi_tiet_cua_hang", $data);
    }
    
    public function suaThongTinCuaHang(){
        $this->load->helper('url');
        $this->load->database();
        
        $maTaiKhoan = $this->input->post("maTaiKhoan");
        $data["tenCuaHang"] = $this->input->post("tenCuaHang");
        $data["diaChi"] = $this->input->post("diaChi");
        $data["soDienThoai"] = $this->input->post("soDienThoai");
        $tenQuanHuyen = $this->input->post("quanHuyen");
        if (mysqli_more_results($this->db->conn_id)) {
            mysqli_next_result($this->db->conn_id);
        }
        $sql = $this->db->query("call layMaQuanHuyen(?)", $tenQuanHuyen);
        $data["maQuanHuyen"] = $sql->row()->ma_quan_huyen;
        $data["gioMoCua"] = $this->input->post("gioMoCua");
        $data["gioDongCua"] = $this->input->post("gioDongCua");

        //Upload ảnh
        if (!empty($_FILES['picture']['name'])) {
            $config['encrypt_name'] = TRUE;
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
                $data["image"] = $this->input->post("logo");
            }
        } else {
            //Trường hợp không chọn ảnh
            $data["image"] = $this->input->post("logo");
        }
        $data["lat"] = $this->input->post("lat");
        $data["lng"] = $this->input->post("lng");
        $data["maCuaHang"] = $this->input->post("maCuaHang");
        
        if (mysqli_more_results($this->db->conn_id)) {
            mysqli_next_result($this->db->conn_id);
        }
        $this->db->query("call capNhatCuaHang(?,?,?,?,?,?,?,?,?,?)", $data);
        
        $this->danhSachCuaHang($maTaiKhoan);
    }
    
    public function xoaCuaHang(){
        $this->load->helper('url');
        $this->load->database();
        
        $data['maCuaHang'] = $this->input->post("maCuaHang");
        $maTaiKhoan = $this->input->post("maTaiKhoan");
        $this->db->query("call xoaCuaHang(?)", $data['maCuaHang']);
        
        $this->danhSachCuaHang($maTaiKhoan);
    }
    
    
    
    
}
