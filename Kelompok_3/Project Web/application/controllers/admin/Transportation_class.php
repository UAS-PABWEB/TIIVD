<?php
class Transportation_class extends CI_Controller{
	public function __construct() {
    	parent::__construct();
        $user = $this->session->userdata('auth_admin');
        if(!$user){
            redirect('admin/login');
        }
    }
    public $table='transportation_class'; 
    public $page='transportation_class'; 
    public $primary_key='id_transportation_class'; 
	public function index($action='',$id=''){
		$data['title'] = 'Kelas Transportasi';
		$data['content'] = 'admin/crud_basic';
		$data['tableTitle'] = array('Nama Kelas','Tipe Transportasi');
		$data['tableField'] = array('class_name','transportation_type_name');
		$data['inputType'] = array(
								array('type'=>'text','label'=>'Nama Kelas','name'=>'class_name'),
								array('type'=>'select','label'=>'Tipe','name'=>'id_transportation_type'
									,'option'=>array('data'=>'database','table'=>'transportation_type','label'=>'transportation_type_name','value'=>'id_transportation_type'),'onchange'=>'','id'=>'id_transportation_type'),
							); 
		$data['data'] = $this->m_admin->gTransportationC();
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
			$required = array('class_name','id_transportation_type');
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