<?php
class Order_cancel extends CI_Controller{
	public function __construct() {
    	parent::__construct();
        $user = $this->session->userdata('auth_admin');
        if(!$user){
            redirect('admin/login');
        }
    }
    public $table='order_cancel'; 
    public $page='order_cancel'; 
    public $primary_key='id_order_cancel'; 
	public function index($action='',$id=''){
		$data['title'] = 'Permintaan Pembatalan Pembelian';
		$data['content'] = 'admin/crud_custom3';
		$data['tableTitle'] = array('Pembeli','No Pesanan','Alasan');
		$data['tableField'] = array('buyer_name','id_order','reason');
		$data['data'] = $this->m_general->gOrderC();
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
		if($action=='accept'){			
			$data = $this->m_general->gDataW('order_cancel',array('id_order_cancel'=>$id))->row();
			$this->m_general->uData('order',array('status'=>'Batal'),array('id_order'=>$data->id_order));
			$this->m_general->dData($this->table,array($this->primary_key=>$id));
			$msg = 'Pesanan #'.$data->id_order.' berhasil di batalkan';
		
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