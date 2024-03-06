<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Course_cover extends CI_Controller {
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
	public function index($id=0)
	{

		$this->db->where('id',$id);
		$data['info'] = $this->db->get('course')->row_array();
		$data['course'] = $this->db->get('course')->result_array();

		if($this->input->post())
		{
			$course = $this->input->post('course');
			$name = $this->input->post('course_name');

			$arr = array('course_id'=>$course,'course_name'=>$name);

			if($id>0)
			{
				$this->db->where('id',$id);
				$this->db->update('course',$arr);
			}
			else
			{
				$this->db->insert('course_cover',$arr);
			}
		}
		$this->load->view('add_course_cover',$data);
	}


	function view_course()
	{

		$qry=$this->db->get('course_cover');
		$data['arr'] = $qry->result_array();
		$this->load->view('view_course_cover',$data);
	}

	function delete_data($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('course_cover');
		redirect('course/view_course_cover');
	}
}
