<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Expense extends CI_Controller {
	function __construct()
	{
		parent::__construct();	
		if(!$this->session->userdata('user_login')){
			redirect('staff-login');
		}
		if($this->session->userdata('user_role')!=1){
			redirect('staff-login');	
		}
	}
	public function index($id=0)
	{
		$this->db->where('id',$id);
		$data['info'] = $this->db->get('exp_category')->row_array();
		//echo '<pre>';print_r($data);die;
		if($this->input->post())
		{
			$name = $this->input->post('category_name');


			$arr = array('category_name'=>$name);
		

			if($id>0)
			{
				$this->db->where('id',$id);
				$this->db->update('exp_category',$arr);
				redirect('Expense/view_exp_category');
			}
			else
			{
				$this->db->insert('exp_category',$arr);
			}
		}
		$this->load->view('add_exp_category',$data);
	}


	function view_exp_category()
	{

		$qry=$this->db->get('exp_category');
		$data['arr'] = $qry->result_array();
		$this->load->view('view_exp_category',$data);
	}

	function delete_data($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('exp_category');
		redirect('Expense/view_exp_category');
	}


	public function add_expense($id=0)
	{

		$this->db->where('id',$id);
		$data['info'] = $this->db->get('course')->row_array();
		$data['expense'] = $this->db->get('exp_category')->result_array();
		$data['faculty'] = $this->db->get('admin')->result_array();

		if($this->input->post())
		{
			$expense_title = $this->input->post('expense_title');
			
			$expense_category = $this->input->post('expense_category');
			$amount = $this->input->post('amount');
			$dept = $this->input->post('dept');
			
			$description = $this->input->post('description');
			$faculty_id = $this->input->post('faculty_id');
			$date = $this->input->post('date');





			$arr = array('expense_category'=>$expense_category,'payment'=>$amount,'department'=>$dept,'description'=>$description,'reference'=>$faculty_id,'date'=>$date);

			if($id>0)
			{
				$this->db->where('id',$id);
				$this->db->update('course',$arr);
			}
			else
			{
				$this->db->insert('expense',$arr);
			}
		}
		$this->load->view('add_expense',$data);
	}


	function expense_report()
	{
		$data = array();
		$this->load->view('expense_report',$data);
	}
}
