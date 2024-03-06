<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Justdial_followup extends CI_Controller {
	function __construct()
	{
		parent::__construct();	
		if(!$this->session->userdata('user_login')){
			redirect('staff-login');
		}	
	}
	function add_followup_data($id)
	{
		$this->db->where('id',$id);
		$arr['inquiry_data'] = $this->db->get('inq_justdial')->row_array();
		$arr['fo_id'] = $id;
		if($this->input->post())
		{
			//echo '<pre>';print_r($this->input->post());die;
			$followup_reason = $this->input->post('followup_reason');
			$followup_by = $this->input->post('followup_by');

			$arr1 = array('inquiry_id'=>$id,'followup_reason'=>$followup_reason,'followup_by'=>$followup_by);
			$this->db->insert('justdial_followup',$arr1);
			redirect('justdial_followup/view_followup/'.$id);
		}

		$this->load->view('add_justdial_followup',$arr);
	}
	function view_followup($id)
	{
		$arr['fo_id'] = $id;
		$this->db->where('justdial_followup.inquiry_id',$id);
		$this->db->join('inq_justdial','inq_justdial.id=justdial_followup.inquiry_id','left');
		$arr['follow'] = $this->db->get('justdial_followup')->result_array();
		$this->load->view('view_justdial_followup',$arr);
	}

}
