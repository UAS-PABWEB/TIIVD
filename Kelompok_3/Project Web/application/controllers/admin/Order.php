<?php
class Order extends CI_Controller{
	public function __construct() {
    	parent::__construct();
        $user = $this->session->userdata('auth_admin');
        if(!$user){
            redirect('admin/login');
        }
    }
    public $table='order'; 
    public $page='order'; 
    public $primary_key='id_order'; 
	public function index($action='',$id=''){
		$data['title'] = 'Pesanan';
		$data['content'] = 'admin/crud_custom2';
		$data['tableTitle'] = array('Pembeli','Waktu','Harga','Status');
		$data['tableField'] = array('buyer_name','time','price','pay_status');
		$data['data'] = $this->m_general->gOrderA();
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
			$data = $this->m_general->gDataW('order',array('id_order'=>$id))->row();
			$this->m_general->uData('order',array('status'=>'Terbayar'),array('id_order'=>$id));
			$msg = 'Pesanan #'.$data->id_order.' berhasil di terima';
		
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
    	public function rec(){
            $this->load->library("PHPExcel");
            $objPHPExcel = new PHPExcel();
            $objPHPExcel = PHPExcel_IOFactory::load("./template/excelA4.xlsx");
            $start = $_POST['start'];
            $end = $_POST['end'];
            $baris  = 6;
            $order = $this->m_general->gOrderDate($start,$end);
            $no=1;

            foreach ($order as $frow){
                $styleArray = array(
                  'borders' => array(
                    'allborders' => array(
                      'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                  )
                );
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue("A".$baris, $no);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue("B".$baris, $frow->buyer_name); 
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue("C".$baris, $frow->time); 
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue("D".$baris, $frow->price); 
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue("E".$baris, $frow->status);  

                $objPHPExcel->getActiveSheet()->getStyle('A'.$baris)->applyFromArray($styleArray);
                $objPHPExcel->getActiveSheet()->getStyle('B'.$baris)->applyFromArray($styleArray);
                $objPHPExcel->getActiveSheet()->getStyle('C'.$baris)->applyFromArray($styleArray);
                $objPHPExcel->getActiveSheet()->getStyle('D'.$baris)->applyFromArray($styleArray);
                $objPHPExcel->getActiveSheet()->getStyle('E'.$baris)->applyFromArray($styleArray);
                 
                $baris++;
                $no++;
            }
             $objPHPExcel->setActiveSheetIndex(0)
                                        ->setCellValue('A3', ''.tgl_indo($start).' Sampai '.tgl_indo($end));
            $objPHPExcel->getActiveSheet()->setTitle('Data');   
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $filename = 'Rekap Order Dari '.tgl_indo($start).' Sampai '.tgl_indo($end).'.xlsx';
            header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
            header("Cache-Control: no-store, no-cache, must-revalidate");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="'.$filename.'"');
            $objWriter->save("php://output");
	}
}