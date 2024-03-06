<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Call_followup extends CI_Controller {
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
		$arr['inquiry_data'] = $this->db->get('inq_call')->row_array();
		$arr['fo_id'] = $id;


		if($this->input->post())
		{
			//echo '<pre>';print_r($this->input->post());die;
			$followup_reason = $this->input->post('followup_reason');
			$followup_by = $this->input->post('followup_by');

			$arr1 = array('inquiry_id'=>$id,'followup_reason'=>$followup_reason,'followup_by'=>$followup_by);
			$this->db->insert('call_followup',$arr1);

			$followup_time = date("Y-m-d");
			$f_arr = array('followup_time'=>$followup_time);
			$this->db->where('id',$id);
			$this->db->update('inq_call',$f_arr);

			redirect('call_followup/view_followup/'.$id);
		}

		$this->load->view('add_call_followup',$arr);
	}


	function view_followup($id)
	{
		$this->load->model('Inquiry_model');
		$arr['fo_id'] = $id;

		$this->db->where('call_followup.inquiry_id',$id);

		$this->db->join('inq_call','inq_call.id=call_followup.inquiry_id','left');
		$arr['follow'] = $this->db->get('call_followup')->result_array();
	
		//echo $this->db->last_query();die;

		//echo '<pre>';print_r($arr);die;
		$this->load->view('view_call_followup',$arr);
	}


}
