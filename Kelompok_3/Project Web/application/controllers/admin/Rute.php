<?php
class Rute extends CI_Controller{
	public function __construct() {
    	parent::__construct();
        $user = $this->session->userdata('auth_admin');
        if(!$user){
            redirect('admin/login');
        }
    }
    public $table='rute'; 
    public $page='rute'; 
    public $primary_key='id_rute'; 
	public function index($action='',$id=''){
		$data['title'] = 'Rute';
		$data['content'] = 'admin/crud_basic';
		$data['tableTitle'] = array('Tanggal Berangkat','Tanggal Tiba','Waktu Berangkat','Waktu Tiba','Asal','Tujuan','Tipe','Transportasi','Harga');
		$data['tableField'] = array('depart_at','arrive_at','depart_time','arrive_time','place_name_from','place_name_to','transportation_type_name','transportation_name','price');
		$data['inputType'] = array(
								array('type'=>'text','label'=>'Tanggal Berangkat','name'=>'depart_at','class'=>'datepicker'),
								array('type'=>'text','label'=>'Waktu Berangkat','name'=>'depart_time','class'=>'timepicker'),
								array('type'=>'text','label'=>'Tanggal Tiba','name'=>'arrive_at','class'=>'datepicker'),
								array('type'=>'text','label'=>'Waktu Tiba','name'=>'arrive_time','class'=>'timepicker'),
								array('type'=>'select','label'=>'Tipe','name'=>'id_transportation_type'
									,'option'=>array('data'=>'database','table'=>'transportation_type','label'=>'transportation_type_name','value'=>'id_transportation_type'),'onchange'=>'pRute()','id'=>'id_transportation_type'),
								array('type'=>'select','label'=>'Asal','name'=>'id_place_from'
									,'option'=>array('data'=>'ajax','table'=>'place','label'=>'place_name','value'=>'id_place'),'onchange'=>'','id'=>'id_place_from'),
								array('type'=>'select','label'=>'Tujuan','name'=>'id_place_to'
									,'option'=>array('data'=>'ajax','table'=>'place','label'=>'place_name','value'=>'id_place'),'onchange'=>'','id'=>'id_place_to'),
								array('type'=>'select','label'=>'Transportasi','name'=>'id_transportation'
									,'option'=>array('data'=>'ajax','table'=>'transportation','label'=>'transportation_name','value'=>'id_transportation'),'onchange'=>'','id'=>'id_transportation'),
								array('type'=>'number','label'=>'Harga','name'=>'price'),
							); 
		$data['data'] = $this->m_admin->gRute();
		$x =0;
		foreach($data['data'] as $d){
			$from = $this->m_general->gDataW('place',array('id_place'=>$d->id_place_from))->row()->place_name;
			$to = $this->m_general->gDataW('place',array('id_place'=>$d->id_place_to))->row()->place_name;
			$data['data'][$x]->place_name_from = $from;
			$data['data'][$x]->place_name_to = $to;
			$x++;
		}
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
			$required = array('depart_at','arrive_at','depart_time','arrive_time','id_place_from','id_place_to','price','id_transportation_type','id_transportation_type');
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
	public function gPlace(){
		$id_type = $_POST['id_type'];
		$get = $this->m_general->gDataW('place',array('id_transportation_type'=>$id_type))->result();
			echo '<option value="">Pilih Tempat</option>';
		foreach($get as $g){
			echo '<option value="'.$g->id_place.'">'.$g->place_name.'</option>';
		}
	}
	public function gTrans(){
		$id_type = $_POST['id_type'];
		$get = $this->m_general->gDataW('transportation',array('id_transportation_type'=>$id_type))->result();
			echo '<option value="">Pilih Transportasi</option>';
		foreach($get as $g){
			echo '<option value="'.$g->id_transportation.'">'.$g->transportation_name.'</option>';
		}
	}
}