<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Course extends CI_Controller {
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


		if($this->input->post())
		{
			$name = $this->input->post('course_name');

			$arr = array('course_name'=>$name);

			if($id>0)
			{
				$this->db->where('id',$id);
				$this->db->update('course',$arr);
			}
			else
			{
				$this->db->insert('course',$arr);
			}
		}
		$this->load->view('add_course',$data);
	}


	function view_course()
	{

		$qry=$this->db->get('course');
		$data['arr'] = $qry->result_array();
		$this->load->view('view_course',$data);
	}

	function delete_data($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('course');
		redirect('course/view_course');
	}
}
