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
        
        if (mysqli_more_results($this->db->conn_id)) {
            mysqli_next_result($this->db->conn_id);
        }
        
        $soPhanTuTrongMotTrang = 9;
        
        $query = $this->db->query("call tongSoCuaHang()");
        $data["tongSoCuaHang"] = $query->row()->tongSoCuaHang;
        $data["tongSoTrang"] = $data["tongSoCuaHang"] / $soPhanTuTrongMotTrang;
        if ($data["tongSoTrang"] <= 1) {
            $data["tongSoTrang"] = 1;
        } else if ($data["tongSoTrang"] % $soPhanTuTrongMotTrang != 0) {
            $data["tongSoTrang"] += 1;
        }
        
        $trangHienTai = $this->input->get("trangHienTai");
        if ($trangHienTai == null) {
            $trangHienTai = "1";
        } 
        $data["trangHienTai"] = $trangHienTai;
        if (mysqli_more_results($this->db->conn_id)) {
            mysqli_next_result($this->db->conn_id);
        }
        
        $arr["phanTuBatDau"] = (intval($trangHienTai) - 1)*$soPhanTuTrongMotTrang;
        $arr["phanTuTrongMotTrang"] = $soPhanTuTrongMotTrang;     
        
        $data['danhSachCuaHang'] = $this->db->query("call tatCaCuaHang(?,?)", $arr);
        
        if (mysqli_more_results($this->db->conn_id)) {
            mysqli_next_result($this->db->conn_id);
        }
        $data['danhSachCuaHangSlide'] = $this->db->query("call danhSachCuaHangSlide()");
        
        
		$this->load->view('welcome_message', $data);
	}
}
