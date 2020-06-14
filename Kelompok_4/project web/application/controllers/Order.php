<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {
	public function apartements()
	{ 
		if(isset($_GET['id_kota'])){
			$data['list'] = $this->m_general->gDataJW('apartemen','kota','id_kota',array('apartemen.id_kota'=>$_GET['id_kota']))->result();
		}else{

			$data['list'] = $this->m_general->gDataJ('apartemen','kota','id_kota')->result();
		}
		$data['kota'] = $this->m_general->gDataA('kota')->result();
		$this->load->view('src/header',$data);
		$this->load->view('apartements',$data);
		$this->load->view('src/footer');
	}
	public function make($id_apartemen){
		$user = $this->session->userdata('id_user');
		$level = $this->session->userdata('level');
		if(!$user&&!$level){
			redirect('account/login');
		}
		$data['detail'] = $this->m_general->gDataJW('apartemen','kota','id_kota',array('id_apartemen'=>$id_apartemen))->row();
		$this->load->view('src/header',$data);
		$this->load->view('make',$data);
		$this->load->view('src/footer');
	}
	function processOrder($id_apartemen){
		$user = $this->session->userdata('id_user');
		$level = $this->session->userdata('level');
		if(!$user&&!$level){
			redirect('account/login');
		}
		if(!empty($this->input->post())){
			$insert = $this->input->post();
			$insert['id_user'] = $this->session->userdata('id_user');
			$insert['id_apartemen'] = $id_apartemen;
			$paket = $this->input->post('paket');
			$jumlah = $this->input->post('jumlah_paket');
			$detail = $this->m_general->gDataJW('apartemen','kota','id_kota',array('id_apartemen'=>$id_apartemen))->row();
			if($paket=='harian'){
				$hari = 1;
				$harga = $detail->harga;
			}elseif($paket=='bulanan'){
				$hari = 30;
				$harga = $detail->harga_bulan;
			}else{
				$hari = 365;
				$harga = $detail->harga_tahun;
			}
			$total_hari = $jumlah * $hari;
			$insert['hari'] = $total_hari;
			$insert['total_bayar'] = $jumlah * $harga;
			$insert['tgl_pesan'] = date('Y-m-d');
			$in = $this->m_general->iData('pesanan',$insert);
			if($in){
				$kode_booking = "BK-".str_pad($in, 4, "0", STR_PAD_LEFT );
			$up = $this->m_general->uData('pesanan',array('kode_booking'=>$kode_booking),array('id_pesanan'=>$in));
				redirect('order/payment/'.$in);
			}else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Terjadi Kesalahan</div>');
				redirect('order/make/'.$id_apartemen);
			}
		}
	}
	public function payment($id_pesanan){
		$user = $this->session->userdata('id_user');
		$level = $this->session->userdata('level');
		if(!$user&&!$level){
			redirect('account/login');
		}
		$data['detail'] = $this->m_general->gDataW('pesanan',array('id_pesanan'=>$id_pesanan))->row();
		$this->load->view('src/header',$data);
		$this->load->view('payment',$data);
		$this->load->view('src/footer');
	}
	public function my(){
		$user = $this->session->userdata('id_user');
		$level = $this->session->userdata('level');
		if(!$user&&!$level){
			redirect('account/login');
		}
		$id_user = $this->session->userdata('id_user');
		$data['list'] = $this->m_general->gDataJW('pesanan','apartemen','id_apartemen',array('id_user'=>$id_user),'id_pesanan')->result();
		$this->load->view('src/header',$data);
		$this->load->view('myorder',$data);
		$this->load->view('src/footer');
	}
	public function detail($id_pesanan){
		$user = $this->session->userdata('id_user');
		$level = $this->session->userdata('level');
		if(!$user&&!$level){
			redirect('account/login');
		}
		if(isset($_FILES['bukti_transfer']['name'])){
			$bukti_transfer = $_FILES['bukti_transfer']['name'];
			if(!empty($bukti_transfer)){
				if ($bukti_transfer !== ""){
					$path = 'assets/images/bukti_transfer/';
					if (!file_exists($path)) {
						mkdir($path, 0777, true);
					}
					$config['upload_path'] = $path;   
					$config['allowed_types'] = 'jpg|png|jpeg';
					$config['max_size'] = '0';          
					$config['overwrite'] = false;
					$this->load->library('upload', $config);
					$this->upload->do_upload('bukti_transfer');
					$upload_data = $this->upload->data();
					$update['bukti_transfer'] = $upload_data['file_name'];
					$update['status_pembayaran'] = 'proses_verifikasi';
					$up = $this->m_general->uData('pesanan',$update,array('id_pesanan'=>$id_pesanan));
				}
			}
		}
		$data['detail'] = $this->m_general->gPesanan($id_pesanan)->row();
		if($data['detail']->paket=='harian'){
			$data['paket'] = 'hari';
		}elseif($data['detail']->paket=='bulanan'){
			$data['paket'] = 'bulan';
		}else{
			$data['paket'] = 'tahun';
		}
		$data['checkout'] = date('Y-m-d', strtotime("+".$data['detail']->hari." day", strtotime($data['detail']->checkin)));
		$this->load->view('src/header',$data);
		$this->load->view('detail_order',$data);
		$this->load->view('src/footer');
	}
	public function verification(){
		$user = $this->session->userdata('id_user');
		$level = $this->session->userdata('level');
		if(!$user&&!$level){
			redirect('account/login');
		}else if($level!=1){
			redirect(base_url());
		}
		$data['list'] = $this->m_general->gListPesanan('id_pesanan')->result();
		$this->load->view('src/header',$data);
		$this->load->view('order_verification',$data);
		$this->load->view('src/footer');
	}
	public function verification_detail($id_pesanan,$status=''){
		$user = $this->session->userdata('id_user');
		$level = $this->session->userdata('level');
		if(!$user&&!$level){
			redirect('account/login');
		}else if($level!=1){
			redirect(base_url());
		}
		if($status!==''){
			if($status=='accept'){
				$update['status_pembayaran'] = 'sudah_dibayar';
				$update['nomor_kamar'] = $this->input->post('nomor_kamar');
			}else{
				$update['status_pembayaran'] = 'ditolak';
			}
			$up = $this->m_general->uData('pesanan',$update,array('id_pesanan'=>$id_pesanan));
			if($up){
				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Pembayaran berhasil diverifikasi</div>');
				redirect('order/verification');
			}else{

				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Terjadi Kesalahan</div>');
			}
		}
		$data['detail'] = $this->m_general->gPesanan($id_pesanan)->row();
		if($data['detail']->paket=='harian'){
			$data['paket'] = 'hari';
		}elseif($data['detail']->paket=='bulanan'){
			$data['paket'] = 'bulan';
		}else{
			$data['paket'] = 'tahun';
		}
		$data['checkout'] = date('Y-m-d', strtotime("+".$data['detail']->hari." day", strtotime($data['detail']->checkin)));
		$this->load->view('src/header',$data);
		$this->load->view('verification_detail',$data);
		$this->load->view('src/footer');
	}
}
