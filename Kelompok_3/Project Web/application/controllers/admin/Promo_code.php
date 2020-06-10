<?php
class Promo_code extends CI_Controller{
	public function __construct() {
    	parent::__construct();
        $user = $this->session->userdata('auth_admin');
        if(!$user){
            redirect('admin/login');
        }
    }
    public $table='promo_code'; 
    public $page='promo_code'; 
    public $primary_key='id_promo_code'; 
	public function index($action='',$id=''){
		$data['title'] = 'Kode Promo';
		$data['content'] = 'admin/crud_basic';
		$data['tableTitle'] = array('Kode','Jumlah (%)','Jumlah (Rp)');
		$data['tableField'] = array('promo_code','promo_percentage','promo_price');
		$data['inputType'] = array(
								array('type'=>'text','label'=>'Kode','name'=>'promo_code'),
								array('type'=>'text','label'=>'Jumlah (%)','name'=>'promo_percentage'),
								array('type'=>'text','label'=>'Jumlah (Rp)','name'=>'promo_price'),
							); 
		$data['data'] = $this->m_general->gDataA($this->table)->result();
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
		$data['info'] = 'Jika anda mengisi jumlah dalam persen (%), kosongkan form jumlah dalam nominal (Rp) dan juga sebaliknya.';
		$this->load->view('admin/template',$data);
	}
	public function p($action,$id=''){
		if($action=='insert'){
			$required = array('promo_code');
			foreach($required as $f){
				if(empty($_POST[$f])){
					$this->session->set_flashdata('pesan','<div class="alert red">Masih ada data yang kosong</div>');
					redirect('admin/'.$this->page.'/index/add');
				}
			}
			$data = $_POST;
			$this->m_general->iData($this->table,$data);
			$msg = 'Data berhasil ditambahkan';
		}elseif($action=='update'){
			$data = $_POST;
			$this->m_general->uData($this->table,$data,array($this->primary_key=>$id));
			$msg = 'Data berhasil diubah';
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