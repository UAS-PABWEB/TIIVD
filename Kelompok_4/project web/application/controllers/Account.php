<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {
	public function login(){ 
		$this->load->view('src/header');
		$this->load->view('login');
		$this->load->view('src/footer');
	}
	public function register(){ 
		$this->load->view('src/header');
		$this->load->view('register');
		$this->load->view('src/footer');
	}
	public function profile(){ 
		$id_user = $this->session->userdata('id_user');
		if(!empty($this->input->post())){
			$update = $this->input->post();
			if(empty($update['password'])){
				unset($update['password']);
			}else{
				$update['password'] = md5($update['password']);
			}
			$up = $this->m_general->uData('user',$update,array('id_user'=>$id_user));
			if($up){
				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Profil berhasil diupdate</div>');
			}else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Terjadi Kesalahan</div>');
			}
		}
		$data['detail'] = $this->m_general->gDataW('user',array('id_user'=>$id_user))->row();
		$this->load->view('src/header',$data);
		$this->load->view('profile',$data);
		$this->load->view('src/footer');
	}
	public function auth(){ 
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		$login = $this->m_general->login($username,$password);
		// var_dump($login);die;
		if($login){
			$id = $this->m_general->gDataW('user',array('username'=>$username))->row();
			$this->session->set_userdata('id_user',$id->id_user);
			$this->session->set_userdata('level',$id->level);
			redirect(base_url());

		}else{
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Username / Password salah</div>');
			redirect('account/login');
		}
	}
	public function logout(){
		$this->session->unset_userdata('id_user');
		$this->session->unset_userdata('level');
		redirect('account/login');
	}
	public function registerProccess(){
		$nama = $_POST['nama'];
		$alamat = $_POST['alamat'];
		$no_hp = $_POST['no_hp'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$c_password = $_POST['c_password'];
		if($password!==$c_password){
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Konfirmasi Kata Sandi tidak sama</div>');
			redirect('account/register');
		}else{
			$this->m_general->iData('user',array('nama'=>$nama,'alamat'=>$alamat,'no_hp'=>$no_hp,'username'=>$username,'password'=>md5($password),'level'=>'2'));
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Pendaftaran Berhasil, Anda bisa masuk menggunakan akun anda</div>');
			redirect('account/register');
		}
	}
}
