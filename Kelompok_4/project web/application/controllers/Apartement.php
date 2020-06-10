<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apartement extends CI_Controller {
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
		$data['list'] = $this->m_general->gDataJ('apartemen','kota','id_kota')->result();
		$this->load->view('src/header',$data);
		$this->load->view('apartement/index',$data);
		$this->load->view('src/footer');
	}
	public function add(){ 
		$data['title'] = "Tambah Apartemen";
		if(!empty($this->input->post())){
			$insert = $this->input->post();
			$foto = $_FILES['foto']['name'];
			if ($foto !== ""){
				$path = 'assets/images/apartement/';
				if (!file_exists($path)) {
					mkdir($path, 0777, true);
				}
				$config['upload_path'] = $path;   
				$config['allowed_types'] = 'jpg|png|jpeg';
				$config['max_size'] = '0';          
				$config['overwrite'] = false;
				$this->load->library('upload', $config);
				$this->upload->do_upload('foto');
				$upload_data = $this->upload->data();
				$insert['foto'] = $upload_data['file_name'];
			}else{
				$insert['foto'] = 'default.png';
			}
			$in = $this->m_general->iData('apartemen',$insert);
			if($in){
				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Apartemen berhasil ditambahkan</div>');
				redirect('apartement');
			}else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Terjadi Kesalahan</div>');
			}
		}
		$data['kota'] = $this->m_general->gDataA('kota')->result();
		$this->load->view('src/header',$data);
		$this->load->view('apartement/add',$data);
		$this->load->view('src/footer');
	}
	public function edit($id_apartemen){ 
		$data['title'] = "Edit Apartemen";
		if(!empty($this->input->post())){
			$update = $this->input->post();
			$foto = $_FILES['foto']['name'];
			if(!empty($foto)){
				if ($foto !== ""){
					$path = 'assets/images/apartement/';
					if (!file_exists($path)) {
						mkdir($path, 0777, true);
					}
					$config['upload_path'] = $path;   
					$config['allowed_types'] = 'jpg|png|jpeg';
					$config['max_size'] = '0';          
					$config['overwrite'] = false;
					$this->load->library('upload', $config);
					$this->upload->do_upload('foto');
					$upload_data = $this->upload->data();
					$update['foto'] = $upload_data['file_name'];
				}else{
					$update['foto'] = 'default.png';
				}
			}
			$up = $this->m_general->uData('apartemen',$update,array('id_apartemen'=>$id_apartemen));
			if($up){
				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Apartemen berhasil diupdate</div>');
				redirect('apartement');
			}else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Terjadi Kesalahan</div>');
			}
		}
		$data['kota'] = $this->m_general->gDataA('kota')->result();
		$data['detail'] = $this->m_general->gDataW('apartemen',array('id_apartemen'=>$id_apartemen))->row();
		$this->load->view('src/header',$data);
		$this->load->view('apartement/edit',$data);
		$this->load->view('src/footer');
	}
	public function delete($id_apartemen){ 
		$del = $this->m_general->dData('apartemen',array('id_apartemen'=>$id_apartemen));
		if($del){
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Apartemen berhasil dihapus</div>');
		}else{
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Terjadi Kesalahan</div>');
		}
		redirect('apartement');
	}
}
