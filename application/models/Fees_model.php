<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Fees_model extends CI_Model
{
	function row_count()
	{
		$qry=$this->db->get('fees');
		$num=$qry->num_rows();
		return $num;
	}

	function view_fees_data($perpage=40,$start=0,$year=0,$month=0)
	{
		$this->db->select('fees.*,admin.name as create_by');
		$this->db->limit($perpage,$start);
		$this->db->like('date',$year);
		$this->db->like('date',$month);
		$this->db->join('admin','admin.id=fees.create_by','left');
		$this->db->order_by('rec_no','desc');
		$arr = $this->db->get('fees')->result_array();
		return $arr;
	}
	function view_fees_data2($perpage=40,$start=0,$year=0,$month=0)
	{
		$this->db->select('tbl_dipak.*,admin.name as create_by');
		$this->db->limit($perpage,$start);
		$this->db->like('date',$year);
		$this->db->like('date',$month);
		$this->db->join('admin','admin.id=tbl_dipak.create_by','left');
		$this->db->order_by('rec_no','desc');
		$arr = $this->db->get('tbl_dipak')->result_array();
		return $arr;
	}
	function total_paid_fees($regno=0){
		$this->db->select_sum('amount');
	    $this->db->from('fees');
	    $this->db->where('reg_no',$regno);
	    $query = $this->db->get();
	    return $query->row()->amount;
	}
	function total_paid_allowance($regno=0){
		$this->db->select_sum('amount');
	    $this->db->from('allowance');
	    $this->db->where('reg_no',$regno);
	    $query = $this->db->get();
	    return $query->row()->amount;
	}
	function row_count_return()
	{
		$qry=$this->db->get('course_return');
		$num=$qry->num_rows();
		return $num;
	}

	function view_return_data($perpage=40,$start=0)
	{

		$this->db->limit($perpage,$start);
		$this->db->order_by('rec_no','desc');
		$arr = $this->db->get('course_return')->result_array();
		return $arr;
	}
	function row_count_allowance()
	{
		$qry=$this->db->get('allowance');
		$num=$qry->num_rows();
		return $num;
	}

	function view_allowance_data($perpage=40,$start=0)
	{

		$this->db->limit($perpage,$start);
		$this->db->order_by('rec_no','desc');
		$arr = $this->db->get('allowance')->result_array();
		return $arr;
	}
	function total_allowance_by_student($regno = 0)
	{
		$this->db->select_sum('amount');
		$this->db->where('reg_no',$regno);
		$arr = $this->db->get('allowance')->row_array();
		return $arr['amount'] ? $arr['amount'] :0;
	}
	function total_refund_by_student($regno = 0)
	{
		$this->db->select_sum('amount');
		$this->db->where('reg_no',$regno);
		$arr = $this->db->get('course_return')->row_array();
		return isset($arr['amount']) ? $arr['amount'] :0;
	}
	function get_ac_info($ac_id = 0)
	{
		if($ac_id==0){
			return 'Not Mentioned';
		}
		$this->db->where('ac_id',$ac_id);
		$arr = $this->db->get('bank_accounts')->row_array();
		return isset($arr['ac_name']) ? $arr['ac_name'] :'Not Mentioned';
	}
}
?>