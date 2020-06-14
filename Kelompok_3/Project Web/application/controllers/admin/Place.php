<?php
class Place extends CI_Controller{
	public function __construct() {
    	parent::__construct();
        $user = $this->session->userdata('auth_admin');
        if(!$user){
            redirect('admin/login');
        }
    }
    public $table='place'; 
    public $page='place'; 
    public $primary_key='id_place'; 
	public function index($action='',$id=''){
		$data['title'] = 'Bandara / Stasiun';
		$data['content'] = 'admin/crud_basic';
		$data['tableTitle'] = array('Nama','Kode','Tipe Transportasi','Kota');
		$data['tableField'] = array('place_name','place_code','transportation_type_name','city_name');
		$data['inputType'] = array(
								array('type'=>'text','label'=>'Nama','name'=>'place_name'),
								array('type'=>'text','label'=>'Kode','name'=>'place_code'),
								array('type'=>'select','label'=>'Tipe','name'=>'id_transportation_type'
									,'option'=>array('data'=>'database','table'=>'transportation_type','label'=>'transportation_type_name','value'=>'id_transportation_type'),'onchange'=>'','id'=>'id_transportation_type'),
								array('type'=>'select','label'=>'Kota','name'=>'id_city'
									,'option'=>array('data'=>'database','table'=>'city','label'=>'city_name','value'=>'id_city'),'onchange'=>'','id'=>''),
							); 
		$data['data'] = $this->m_admin->gPlace();
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
		if($action=='insert'){
			$required = array('place_name','id_transportation_type','id_city','place_code');
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