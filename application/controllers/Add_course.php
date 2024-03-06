<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Add_course extends CI_Controller {
	function __construct()
	{
		parent::__construct();	
		if(!$this->session->userdata('user_login')){
			redirect('staff-login');
		}
		if($this->session->userdata('user_role')==2){
			redirect('staff-login');	
		}
	}
	public function index()
	{
		if($this->input->post())
		{
			$name = $this->input->post('course_name');

			$arr = array('course_name'=>$name);
			$this->db->insert('course',$arr);
		}
		$this->load->view('add_course');
	}
}
