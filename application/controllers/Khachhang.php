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

}

/* End of file Khachhang.php */
/* Location: ./application/controllers/Khachhang.php */
?>