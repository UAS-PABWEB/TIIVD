<?php
class Costumer extends CI_Controller{
	public function __construct() {
		parent::__construct();
		$user = $this->session->userdata('auth_admin');
		if(!$user){
			redirect('admin/login');
		}
	}
	public $table='costumer'; 
	public $page='costumer'; 
	public $primary_key='id_costumer'; 
	public function index($action='',$id=''){
		$data['title'] = 'Pengguna';
		$data['content'] = 'admin/crud_custom';
		$data['tableTitle'] = array('Nama','Email','No. HP','Alamat');
		$data['tableField'] = array('full_name','email','phone','address');
		$data['data'] = $this->m_general->gCostumer();
		if($action=='edit'&&$id!==''){
			$no=0;
			$getValue = $this->m_general->gDataW($this->table,array($this->primary_key=>$id))->row();
			foreach($data['inputType'] as $z){
				$name = $z['name'];
				 $data['inputType'][$no]['value'] = $getValue->$name;
				$no++;
			}
			$data['aidi'] = $id;
		}
		$data['action'] = $action;
		$data['page'] = $this->page;
		$data['primary_key'] = $this->primary_key;
		$this->load->view('admin/template',$data);
	}
	public function p($action,$id=''){
		if($action=='reset'){			
			$data = $this->m_general->gDataW('costumer',array('id_costumer'=>$id))->row();
			$id_user = $data->id_user;
			$pass = substr(md5(rand(0,202020)),20);
			$password = md5($pass);
			$this->m_general->uData('user',array('password'=>$password),array('id_user'=>$id_user));
			$msg = 'User '.$data->email.' berhasil di reset kata sandi menjadi : '.$pass.'';
			
		}elseif($action=='delete'){
			$this->m_general->dData($this->table,array($this->primary_key=>$id));
			$msg = 'Data berhasil dihapus';
		}else{
			$msg = '';
		}
		$this->session->set_flashdata('pesan','<div class="alert green">'.$msg.'</div>');
		redirect('admin/'.$this->page.'');
	}
	public function backup(){
		$this->m_admin->eDB($this->table);
	}

	public function export(){
		$this->m_admin->eCSV($this->table);
	}
	public function truncate(){
		$this->m_admin->emDB($this->table);
		$this->session->set_flashdata('pesan','<div class="alert green">Data berhasil dikosongkan</div>');
		redirect('admin/'.$this->page.'');
	}
}