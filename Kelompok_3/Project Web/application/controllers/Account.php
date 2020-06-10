<?php
class Account extends CI_Controller{
	public function __construct() {
		parent::__construct();
		$user = $this->session->userdata('auth_user');
		if($user){
			redirect('home');
		}
	}
	public function login(){
		$data['title'] = 'Masuk';
		$data['content'] = 'account/login';
		$this->load->view('template',$data);
	}
	public function register(){
		$data['title'] = 'Register';
		$data['content'] = 'account/register';
		$this->load->view('template',$data);
	}
	public function export_excel(){
		// load excel library
		// $this->load->library('PHPExcel');

		// load excel library
        require_once APPPATH.'third_party/PHPExcel.php';
        // $this->excel = new PHPExcel(); 

		$spreadsheet = new PHPExcel();
		$spreadsheet->setActiveSheetIndex(0);
		$worksheet = $spreadsheet->getActiveSheet();
		$worksheet->SetCellValueByColumnAndRow(0, 1, 'Hello World');

		$writer = new PHPExcel_Writer_Excel2007($spreadsheet);
		$writer->save('hello-world.xlsx');
	}
}