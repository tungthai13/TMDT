<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function login()
	{
		$username = $this->input->post('username'); 
		$password = $this->input->post('password'); 
		$this->db->select('*');
        $this->db->where('ten_khach_hang', $username); 
        $this->db->where('mat_khau', $password);  
        $this->db->from('khach_hang');
        $query=$this->db->get();
        if ($query->num_rows() == 0)
            return false;
        else
            return $query->result_array(); 
	}
	public function logout() {
        $this->session->sess_destroy();
        redirect('','refresh');
    }

}



/* End of file Khachhang.php */
/* Location: ./application/models/Khachhang.php */