<?php
class Flight extends CI_Controller{
	public function index(){

	}
	public function search(){
		$this->session->set_userdata('cart',array());
		$from = $_GET['from'];
		$to = $_GET['to'];
		$date_g = $_GET['date_g'];
		$date_b = $_GET['date_b'];
		$ps = $_GET['ps'];
		$data['date_g'] = $_GET['date_g'];
		if(empty($date_g)){
			redirect('home');
		}
		$data['date_b'] = $_GET['date_b'];
		$data['ps'] = $_GET['ps'];
		$c = $_GET['class'];
		if(!empty($c)){
			$gClass = $this->m_general->gDataW('transportation_class',array('id_transportation_class'=>$c))->row();
			$class = $gClass->class_name;
		}else{
			$class = 'Semua Kelas';
		}
		$data['class'] = $class;
		$data['from'] = $this->m_general->gPlaceW(array('id_place'=>$from))->row();
		$data['to'] = $this->m_general->gPlaceW(array('id_place'=>$to))->row();

		$data['berangkat'] = $this->m_general->searchFlight($date_g,$from,$to,$c);
		if(!empty($date_b)){
			$data['pulang'] = $this->m_general->searchFlight($date_b,$to,$from,$c);
		}
		$data['title'] = 'Pencarian Pesawat';
		$data['content'] = 'flight/search';
		$this->load->view('template',$data);
	}
}