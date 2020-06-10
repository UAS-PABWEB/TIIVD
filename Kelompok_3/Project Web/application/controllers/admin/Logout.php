<?php
	class Logout extends CI_Controller{
		public function index(){
			$this->session->unset_userdata('auth_admin');
			redirect('admin/login');
		}
	}