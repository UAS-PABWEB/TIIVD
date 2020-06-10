<?php
	class Login extends CI_Controller{
		public function __construct() {
	        parent::__construct();
	        $user = $this->session->userdata('auth_admin');
	        if($user){
	            redirect('admin/dashboard');
	        }
	    }
		public function index(){
			$data['title'] = 'Masuk Administrator';
			$this->load->view('admin/login',$data);
		}
		public function auth(){
			$username = $this->input->post('username');
			$password = md5($this->input->post('password'));
			$login = $this->m_general->auth_login_admin($username,$password);
			if(!empty($_POST['username'])&&!empty($_POST['password'])){
				if($login){
						$user_data = $this->m_general->gDataW('user',array('username'=>$username))->row();
						$user_id = $user_data->id_user;
						$this->session->set_userdata('auth_admin',$user_id);
						$res = json_encode(array('result' => 1, 'redirect' => base_url('admin'), 'content' => 'Berhasil Masuk, mengalihkan ...'));
				}else{
					$res = json_encode(array('result' => 0, 'content' => 'Username atau Kata Sandi Salah'));
				}
			}else{
				$res = json_encode(array('result' => 0, 'content' => 'Masih ada form yang kosong'));
			}
				$this->output->set_content_type('application/json')->set_output($res);
		}
	}