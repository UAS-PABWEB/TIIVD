<?php
class User extends CI_Controller{
	public function __construct() {
        parent::__construct();
        $user = $this->session->userdata('auth_user');
        if(!$user){
        	$this->session->set_flashdata('pesan','<div class="alert red">Anda harus masuk dulu</div>');
            redirect('home');
        }
    }
	public function profile(){
		$data['info'] = $this->m_general->usrInfo($this->session->userdata('auth_user'));
		$data['title'] = 'Pengaturan Akun';
		$data['content'] = 'user/profile';
		$this->load->view('template',$data);
	}
	public function order(){
		$data['info'] = $this->m_general->usrInfo($this->session->userdata('auth_user'));
		$data['list'] = $this->m_general->gDataW('order',array('id_costumer'=>$this->session->userdata('auth_user')))->result();
		$data['title'] = 'Pembelian';
		$data['content'] = 'user/order';
		$this->load->view('template',$data);
	}
	public function order_detail($id_order=''){
		$data['o'] = $this->m_general->gOrder($id_order);
		$data['res'] = $this->m_general->gDataW('reservation',array('id_order'=>$id_order))->result();
		$data['title'] = 'Detail Pembelian';
		$data['content'] = 'user/order_detail';
		$this->load->view('template',$data);
	}
	public function order_cancel($id_order=''){
		$data['o'] = $this->m_general->gOrder($id_order);
		$data['res'] = $this->m_general->gDataW('reservation',array('id_order'=>$id_order))->result();
		$data['title'] = 'Pembatalan Pemesanan';
		$data['content'] = 'user/order_cancel';
		$data['id_order'] = $id_order;
		$this->load->view('template',$data);
	}
	public function p_cancel(){
		$data = $_POST;
		$this->m_general->iData('order_cancel',$data);
		$this->session->set_flashdata('pesan','<div class="alert orange">Permintaan pembatalan anda telah terkirim, apabila sudah diterima maka pesanan ini akan otomatis dibatalkan</div>');
		redirect('user/order_detail/'.$data['id_order'].'');
	}
	public function p_profile(){
		$data = $_POST;
		$this->m_general->uData('costumer',$data,array('id_costumer'=>$this->session->userdata('auth_user')));
        	$this->session->set_flashdata('pesan','<div class="alert green">Data berhasil disimpan</div>');
		redirect('user/profile');
	}
    public function e_ticket($id_order){   
		$data['o'] = $this->m_general->gOrder($id_order);
		$data['res'] = $this->m_general->gDataW('reservation',array('id_order'=>$id_order))->result();     
		$data['ps'] = $this->m_general->gDataW('passenger',array('id_order'=>$id_order))->result();     
        $this->load->library('pdfgenerator');
        $data['a'] = 'asw';
        $html = $this->load->view('user/e_ticket',$data,true);   
        $this->pdfgenerator->generate($html,'E - Ticket '.$data['o']->buyer_name.'_'.time()); 
    }
	public function p_password(){
		$o = md5($_POST['o_password']);
		$p = md5($_POST['password']);
		$n = md5($_POST['c_password']);
		$cek = $this->m_general->usrInfo($this->session->userdata('auth_user'));
		$id_user = $cek->id_user;
		if($cek->password !== $o){
			$this->session->set_flashdata('pesan','<div class="alert red">Kata sandi lama salah</div>');
			redirect('user/profile');
		}elseif($p !== $n){
			$this->session->set_flashdata('pesan','<div class="alert red">Konfirmasi kata sandi tidak sama</div>');
			redirect('user/profile');
		}else{
			$this->m_general->uData('user',array('password'=>$n),array('id_user'=>$id_user));
			$this->session->set_flashdata('pesan','<div class="alert green">Data berhasil disimpan</div>');
			redirect('user/profile');
		}
	}
}