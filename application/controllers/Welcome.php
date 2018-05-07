<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
	public function index()
	{
        $this->load->helper('url');
        $this->load->database();
        
        //Lấy danh sách quận huyện từ procedure
        if (mysqli_more_results($this->db->conn_id)) {
            mysqli_next_result($this->db->conn_id);
        }
        $data['danhSachQuanHuyen'] = $this->db->query("call danhSachQuanHuyen(?)", 1);
        
        //Lấy danh sách quận huyện chọn trong phần lọc cửa hàng
        $quanHuyen = $this->input->post("quanHuyen");
        $data["quanHuyen"] = $quanHuyen; 
        $stringMaQuanHuyen = ""; //Chuỗi chứa danh sách mã quận huyện theo dạng "1,5,6,9" để truyền vào trong param của procedure;
        $tenQuanHuyen = []; //Mảng chứa danh sách tên các quận huyện đã chọn trong phần lọc cửa hàng
        
        //Kiểm tra $quanHuyen có phải là mảng không (TH có lọc cửa hàng)
        if (is_array($quanHuyen) || is_object($quanHuyen)){
            foreach ($quanHuyen as $item){
                $stringMaQuanHuyen .= $item.","; //Thêm một mã quận huyện vào chuỗi
                
                //Lặp trong danh sách quận huyện để lấy ra tên quận huyện ứng với mã quận huyện $ỉtem
                foreach ($data['danhSachQuanHuyen']->result() as $row){
                    if($item == $row->ma_quan_huyen){
                        //Đưa tên quận huyện vào mảng $tenQuanHuyen
                        array_push($tenQuanHuyen, $row->ten_quan_huyen);
                        break;
                    }
                }
            } 
            $stringMaQuanHuyen =  substr($stringMaQuanHuyen, 0, -1); //Xóa dấu phẩy cuối cùng trong chuỗi
        }
        
        //Nối các tên quận huyện trong mảng vào biến $data["stringTenQuanHuyen"] theo định dạng: VD "Quận Hà Đông, Quận Thanh Xuân, Quận Hai Bà Trưng" để truyền vào param của procedure
        $data["stringTenQuanHuyen"] = "";
        foreach($tenQuanHuyen as $row){
            $data["stringTenQuanHuyen"] .= $row.", "; //=> sẽ thừa dấu , và dấu cách ở cuối cùng
        }
        $data["stringTenQuanHuyen"] =  substr($data["stringTenQuanHuyen"], 0, -1); //Xóa dấu cách cuối
        $data["stringTenQuanHuyen"] =  substr($data["stringTenQuanHuyen"], 0, -1); //Xóa dấu , cuối
        
        
        if (mysqli_more_results($this->db->conn_id)) {
            mysqli_next_result($this->db->conn_id);
        }
        //Số cửa hàng hiển thị trong 1 trang là 9
        $soPhanTuTrongMotTrang = 9;
        
        //Đếm tổng số lượng cửa hàng trên hệ thống
        $query = $this->db->query("call tongSoCuaHang()");
        $data["tongSoCuaHang"] = $query->row()->tongSoCuaHang;
        
        //Tính toán số lượng trang hiển thị cửa hàng = tổng số cửa hàng / số cửa hàng trên 1 trang
        $data["tongSoTrang"] = $data["tongSoCuaHang"] / $soPhanTuTrongMotTrang;
    
        if ($data["tongSoTrang"] <= 1) {
            $data["tongSoTrang"] = 1;
        } else if ($data["tongSoTrang"] % $soPhanTuTrongMotTrang != 0) {
            $data["tongSoTrang"] += 1;
        }
        
        //Lấy ra trang hiển thị hiện tại
        $trangHienTai = $this->input->get("trangHienTai");
        // Nếu chưa chọn trang thì mặc định hiển thị trang số 1
        if ($trangHienTai == null) {
            $trangHienTai = "1";
        } 
        $data["trangHienTai"] = $trangHienTai;
        
        if (mysqli_more_results($this->db->conn_id)) {
            mysqli_next_result($this->db->conn_id);
        }
        //TH không lọc cửa hàng
        if($stringMaQuanHuyen == ""){
            $array["phanTuBatDau"] = (intval($trangHienTai) - 1)*$soPhanTuTrongMotTrang;
            $array["phanTuTrongMotTrang"] = $soPhanTuTrongMotTrang;     
            
            $data['danhSachCuaHang'] = $this->db->query("call tatCaCuaHang(?,?)", $array);
        } else {
        //TH có lọc cửa hàng
            $array["array"] = $stringMaQuanHuyen;
            $array["phanTuBatDau"] = (intval($trangHienTai) - 1)*$soPhanTuTrongMotTrang;
            $array["phanTuTrongMotTrang"] = $soPhanTuTrongMotTrang;     
            
            $data['danhSachCuaHang'] = $this->db->query("call locCuaHangTheoQuanHuyen(?,?,?)", $array);
        }
        
        //Lấy ra 3 cửa hàng mới nhất trong hệ thống để hiện ra trên slide
        if (mysqli_more_results($this->db->conn_id)) {
            mysqli_next_result($this->db->conn_id);
        }
        $data['danhSachCuaHangSlide'] = $this->db->query("call danhSachCuaHangSlide()");
               
		$this->load->view('welcome_message', $data);
	}
}
