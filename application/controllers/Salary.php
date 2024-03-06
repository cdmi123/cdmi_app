<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Salary extends CI_Controller {
	function __construct()
	{
		parent::__construct();	
		if(!$this->session->userdata('user_login')){
			redirect('staff-login');
		}
		if($this->session->userdata('user_role')!=1 && $this->session->userdata('user_role')!=7){
			redirect('staff-login');	
		}
	}
	function print_salary($id=0)
	{
		$this->db->where('id',$id);
		$sal_info = $this->db->get('salary')->row_array();
		$res['sal_info'] = $sal_info;
		//pre($res);die;
		$this->db->where('id',$sal_info['emp_id']);
		$emp_info = $this->db->get('admin')->row_array();
		$res['emp_info'] = $emp_info;
		$this->load->view('salary_slip',$res);
	}
	function add_salary($id=0)
	{
		$this->db->where('id',$id);
		$data['update_data'] = $this->db->get('salary')->row_array();
		$data['faculty'] = $this->db->get('admin')->result_array();
		if($this->input->post())
		{
			$emp_id = $this->input->post('emp_id');
			$emp_name = $this->input->post('emp_name');
			$amount = $this->input->post('amount');
			$payment_mode = $this->input->post('payment_mode');
			$dept = $this->input->post('dept');
			$description = $this->input->post('description');
			$tax = $this->input->post('tax');
			$deduction = $this->input->post('deduction');
			$extra_deduction = $this->input->post('extra_deduction');
			$date = $this->input->post('date');
			$salary_month = $this->input->post('salary_month');
			$payable_salary = $this->input->post('pay_amt');
			$arr = array('emp_id'=>$emp_id,'emp_name'=>$emp_name,'total_salary'=>$amount,'payment_mode'=>$payment_mode,'description'=>$description,'department'=>$dept,'tax'=>$tax,'deposit'=>$deduction,'extra_deduction'=>$extra_deduction,'salary_month'=>$salary_month,'payable_salary'=>$payable_salary,'date'=>$date);
			if($id>0)
			{
				$this->db->where('id',$id);
				$this->db->update('salary',$arr);
			}
			else
			{
				$this->db->insert('salary',$arr);
			}
			redirect('salary/view_salary');
		}
		$this->load->view('add_salary',$data);
	}
	function get_faculty()
	{
		$fac_id =  $this->input->post('faculty_id');
		$this->db->where('id',$fac_id);
		$data = $this->db->get('admin')->row_array();
		echo json_encode($data);
	}
	function view_salary()
	{	
		$data['arr'] = $this->db->get('salary')->result_array();	
		$this->load->view('view_salary',$data);
	}
	function salary_delete($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('salary');
		redirect('Salary/view_salary');
	}
}
