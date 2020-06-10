<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About_us extends CI_Controller {
	public function index()
	{ 
		$this->load->view('src/header');
		$this->load->view('about_us');
		$this->load->view('src/footer');
	}
}
