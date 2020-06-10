<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$user = $this->session->userdata('id_user');
		$level = $this->session->userdata('level');
		if(!$user&&!$level){
			redirect('account/login');
		}else if($level!=1){
			redirect(base_url());
		}
	}
	public function index(){ 
		$data['list'] = $this->m_general->gDataA('user')->result();
		$this->load->view('src/header',$data);
		$this->load->view('user/index',$data);
		$this->load->view('src/footer');
	}
	public function edit($id_user){ 
		if(!empty($this->input->post())){
			$update = $this->input->post();
			if(empty($update['password'])){
				unset($update['password']);
			}else{
				$update['password'] = md5($update['password']);
			}
			$up = $this->m_general->uData('user',$update,array('id_user'=>$id_user));
			if($up){
				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">User berhasil diupdate</div>');
				redirect('user');
			}else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Terjadi Kesalahan</div>');
			}
		}
		$data['detail'] = $this->m_general->gDataW('user',array('id_user'=>$id_user))->row();
		$this->load->view('src/header',$data);
		$this->load->view('user/edit',$data);
		$this->load->view('src/footer');
	}
	public function delete($id_user){ 
		$del = $this->m_general->dData('user',array('id_user'=>$id_user));
		if($del){
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">User berhasil dihapus</div>');
		}else{
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Terjadi Kesalahan</div>');
		}
		redirect('user');
	}
}
