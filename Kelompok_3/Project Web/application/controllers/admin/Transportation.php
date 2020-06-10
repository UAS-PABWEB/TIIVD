<?php
class Transportation extends CI_Controller{
	public function __construct() {
    	parent::__construct();
        $user = $this->session->userdata('auth_admin');
        if(!$user){
            redirect('admin/login');
        }
    }
	public function index($action='',$id=''){
		$data['title'] = 'Transportasi';
		$data['content'] = 'admin/crud_basic';
		$data['tableTitle'] = array('Kode Transportasi','Nama Transportasi','Kelas','Tipe','Jumlah Kursi','Perusahaan');
		$data['tableField'] = array('transportation_code','transportation_name','class_name','transportation_type_name','seat_qty','company_name');
		$data['inputType'] = array(
								array('type'=>'text','label'=>'Kode Transportasi','name'=>'transportation_code'),
								array('type'=>'text','label'=>'Nama Transportasi','name'=>'transportation_name'),
								array('type'=>'select','label'=>'Tipe','name'=>'id_transportation_type'
									,'option'=>array('data'=>'database','table'=>'transportation_type','label'=>'transportation_type_name','value'=>'id_transportation_type'),'onchange'=>'pTrans()','id'=>'id_transportation_type'),
								array('type'=>'select','label'=>'Kelas Transportasi','name'=>'id_transportation_class'
									,'option'=>array('data'=>'ajax','table'=>'transportation_class','label'=>'class_name','value'=>'id_transportation_class'),'onchange'=>'','id'=>'id_transportation_class'),
								array('type'=>'select','label'=>'Perusahaan Transportasi','name'=>'id_transportation_company'
									,'option'=>array('data'=>'ajax','table'=>'transportation_company','label'=>'company_name','value'=>'id_transportation_company'),'onchange'=>'','id'=>'id_transportation_company'),
								array('type'=>'number','label'=>'Jumlah Kursi','name'=>'seat_qty'),
							); 
		$data['data'] = $this->m_admin->gTransportation();
		if($action=='edit'&&$id!==''){
           $no=0;
           $getValue = $this->m_general->gDataW('transportation',array('id_transportation'=>$id))->row();
           foreach($data['inputType'] as $z){
			   $name = $z['name'];
                $data['inputType'][$no]['value'] = $getValue->$name;
                $no++;
           }
           $data['aidi'] = $id;
		}
		$data['action'] = $action;
		$data['page'] = 'transportation';
		$data['primary_key'] = 'id_transportation';
		$this->load->view('admin/template',$data);
	}
	public function p($action,$id=''){
		if($action=='insert'){
			$required = array('transportation_code','transportation_name','id_transportation_type','id_transportation_class','seat_qty','id_transportation_company');
			foreach($required as $f){
				if(empty($_POST[$f])){
					$this->session->set_flashdata('pesan','<div class="alert red">Masih ada data yang kosong</div>');
					redirect('admin/transportation/index/add');
				}
			}
			$data = $_POST;
			$this->m_general->iData('transportation',$data);
			$msg = 'Data berhasil ditambahkan';
		}elseif($action=='update'){
			$data = $_POST;
			$this->m_general->uData('transportation',$data,array('id_transportation'=>$id));
			$msg = 'Data berhasil diubah';
		}elseif($action=='delete'){
			$this->m_general->dData('transportation',array('id_transportation'=>$id));
			$msg = 'Data berhasil dihapus';
		}else{
			$msg = '';
		}
		$this->session->set_flashdata('pesan','<div class="alert green">'.$msg.'</div>');
		redirect('admin/transportation');
	}
	public function gClass(){
		$id_type = $_POST['id_type'];
		$get = $this->m_general->gDataW('transportation_class',array('id_transportation_type'=>$id_type))->result();
			echo '<option value="">Pilih Kelas Transportasi</option>';
		foreach($get as $g){
			echo '<option value="'.$g->id_transportation_class.'">'.$g->class_name.'</option>';
		}
	}
	public function gCompany(){
		$id_type = $_POST['id_type'];
		$get = $this->m_general->gDataW('transportation_company',array('id_transportation_type'=>$id_type))->result();
		echo '<option value="">Pilih Perusahaan Transportasi</option>';
		foreach($get as $g){
			echo '<option value="'.$g->id_transportation_company.'">'.$g->company_name.'</option>';
		}
	}

	public function backup(){
        $this->m_admin->eDB('transportation');
    }

    public function export(){
        $this->m_admin->eCSV('transportation');
    }
    public function truncate(){
        $this->m_admin->emDB('transportation');
		$this->session->set_flashdata('pesan','<div class="alert green">Data berhasil dikosongkan</div>');
		redirect('admin/transportation');
    }
}