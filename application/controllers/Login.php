<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
	function __construct() {
        parent::__construct();
        if ($this->session->userdata('role')=="2") {
            redirect('Welcome'); }

    }
	
	public function index(){
		$this->load->helper('html');
		$show = array(
			'header'=> $this->header(),
			
		);
		
		$this->load->view('V_login',$show);
		
	}
	public function auth() {
		$data = array('username' => $this->input->post('username'),
						'password' => md5($this->input->post('password'))
			);
		$this->load->model('m_login'); // load model_user
		$hasil = $this->m_login->cek_user($data);
		if ($hasil->num_rows() >= 1) {
			foreach ($hasil->result() as $sess) {
				$sess_data['id'] = $sess->id;
				$sess_data['fullname'] = $sess->fullname;
				$sess_data['username'] = $sess->username;			
				$sess_data['role'] = $sess->role;
				$this->session->set_userdata($sess_data);
			}
			if ($this->session->userdata('role')=='2' || $this->session->userdata('role')=='1' ) {
				redirect('Welcome');
			}
				
		}
		else {
			echo "<script>alert('Gagal login: Cek username, password!');history.go(-1);</script>";
		}
	}

	public function logout() {
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('fullname');
		$this->session->unset_userdata('role');
		
		session_destroy();
		redirect('Login');
	}


	public function header(){
		$data = array();
		$show = $this->load->view('component/header',$data,TRUE);
		return $show;
	}


}