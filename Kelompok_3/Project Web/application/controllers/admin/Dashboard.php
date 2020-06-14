<?php
class Dashboard extends CI_Controller{
	public function __construct() {
    	parent::__construct();
        $user = $this->session->userdata('auth_admin');
        if(!$user){
            redirect('admin/login');
        }
    }
	public function index(){
		$data['title'] = 'Dasbor';
		$data['a_user'] = $this->m_general->gDataA('costumer')->num_rows();
		$data['b_user'] = $this->m_general->gDataW('costumer',array('reg_date'=>date('Y-m-d')))->num_rows();
		$data['a_order'] = $this->m_general->gDataA('order')->num_rows();
		$data['b_order'] = $this->m_general->gDataW('order',array('order_date'=>date('Y-m-d')))->num_rows();
		$a_in = $this->m_general->gDataA('order')->result();
		$total=0;
		foreach($a_in as $a){
			$total = $total+$a->final_price;
		}
		$data['a_in'] = $total;
		$b_in = $this->m_general->gDataW('order',array('order_date'=>date('Y-m-d')))->result();
		$totall=0;
		foreach($b_in as $b){
			$totall = $totall+$b->final_price;
		}
		$data['b_in'] = $totall;
		$data['content'] = 'admin/dashboard';
		$this->load->view('admin/template',$data);
	}
	public function tes(){
            $this->load->library("PHPExcel");
            $objPHPExcel = new PHPExcel();
            $objPHPExcel = PHPExcel_IOFactory::load("./template/excelA4.xlsx");
            $start = '2018-02-10';
            $end = '2018-02-17';
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