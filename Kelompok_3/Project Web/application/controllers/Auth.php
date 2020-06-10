<?php
class Auth extends CI_Controller{
	public function register(){
		$data = $_POST;
		$this->form_validation->set_rules('full_name','Nama Lengkap','required');
		$this->form_validation->set_rules('email','Alamat Email','required|valid_email|is_unique[costumer.email]');
		$this->form_validation->set_rules('password','Kata Sandi','required|min_length[6]');
		$this->form_validation->set_rules('confirm_password','Konfirmasi Kata Sandi','required|matches[password]');
		$this->form_validation->set_message('required','{field} belum diisi');
		$this->form_validation->set_message('is_unique','{field} sudah digunakan');
		$this->form_validation->set_message('matches','{field} tidak sama');
		$this->form_validation->set_message('valid_email','Harap masukkan email yang benar');
		$this->form_validation->set_message('min_length','{field} harus lebih dari {param} huruf');
		if($this->form_validation->run() == false){
			$errors = validation_errors();
        	$res = json_encode(array('result' => 0, 'content' => $errors));
		}else{
			$in = $this->m_general->iData('user',array('username'=>$_POST['email'],'password'=>md5($_POST['password']),'level_id'=>2));
			$in_cos = $this->m_general->iData('costumer',array('email'=>$_POST['email'],'full_name'=>$_POST['full_name'],'id_user'=>$in,'reg_date'=>date('Y-m-d')));
			$id_costumer = $this->m_general->gIDCostumer($_POST['email']);
			$this->session->set_userdata('auth_user',$id_costumer);
        	$res = json_encode(array('result' => 1, 'content' => 'Registrasi Berhasil, anda akan dialihkan ...'));
		}
		$this->output->set_content_type('application/json')->set_output($res);
	}
	public function login(){
		$data = $_POST;
		$login = $this->m_general->auth_login($_POST['email'],md5($_POST['password']));
		if($login){
			$id_costumer = $this->m_general->gIDCostumer($_POST['email']);
			$this->session->set_userdata('auth_user',$id_costumer);
        	$res = json_encode(array('result' => 1, 'content' => 'Login berhasil, mengalihkan ...'));
		}else{
        	$res = json_encode(array('result' => 0, 'content' => 'Email / Kata Sandi salah'));
		}
		$this->output->set_content_type('application/json')->set_output($res);
	}
	public function logout(){
		$this->session->unset_userdata('auth_user');
		redirect('account/login');
	}
}