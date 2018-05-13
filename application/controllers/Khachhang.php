<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Khachhang extends CI_Controller {
 	function __construct()
 	{
 		parent::__construct();
 		$this->load->model('users');
 	} 
	public function login()
	{ 

		
		$data['user'] = $this->users->login();
		if ($data['user'] == false) {
			redirect('/khachhang/login_error','refresh');
		}else{
			$this->session->set_userdata('user',$data['user']); 
			redirect('','refresh');
			
		}

	}
	public function logout() {
        $this->session->sess_destroy();
        redirect(base_url());
    }
    public function dangki()
    {
    	$password = $this->input->post('password'); 
        $password_again = $this->input->post('password_again'); 
    	$username = $this->input->post('username'); 
    	if ($password == $password_again) {
    		$this->users->dangki(); 
            $array['username'] = $username;
            $array['password'] = $password;

            $sql = $this->db->query("call layMaTaiKhoan(?,?)", $array);
            $maTaiKhoan = $sql->row()->ma_khach_hang;
            if (mysqli_more_results($this->db->conn_id)) {
                mysqli_next_result($this->db->conn_id);
            }
            $this->db->query("call themGioHang(?)", $maTaiKhoan);
    		redirect('','refresh');
    	}else{
    		redirect('','refresh');
    	}
    	
    }

}

/* End of file Khachhang.php */
/* Location: ./application/controllers/Khachhang.php */
?>