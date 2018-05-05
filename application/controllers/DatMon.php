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
	public function index()
	{
        $this->load->helper('url');
        $this->load->database();
        $data['maTaiKhoan'] = $this->input->post('maTaiKhoan'); 
        $data['maCuaHang'] = $this->input->get('maCuaHang');  
        
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
        
        $this->load->view('dat_mon', $data);
	}
}
