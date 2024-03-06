<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class College_fees_model extends CI_Model
{
	function row_count()
	{
		$qry=$this->db->get('college_fees');
		$num=$qry->num_rows();
		return $num;
	}

	function view_fees_data($perpage=40,$start=0)
	{
		$this->db->select('college_fees.*,admin.name as create_by');
		$this->db->join('admin','admin.id=college_fees.create_by','left');
		$this->db->limit($perpage,$start);
		//$this->db->like('date',$year);
		//$this->db->like('date',$month);
		$this->db->order_by('college_fees.id','desc');
		$arr = $this->db->get('college_fees')->result_array();
		return $arr;
	}

	function exam_row_count()
	{
		$qry=$this->db->get('exam_fees');
		$num=$qry->num_rows();
		return $num;
	}

	function view_exam_fees_data($perpage=40,$start=0)
	{

		$this->db->limit($perpage,$start);
		//$this->db->like('date',$year);
		//$this->db->like('date',$month);
		$this->db->order_by('id','desc');
		$arr = $this->db->get('exam_fees')->result_array();
		return $arr;
	}

	function certificate_row_count()
	{
		$qry=$this->db->get('certificate_fees');
		$num=$qry->num_rows();
		return $num;
	}

	function view_certificate_fees_data($perpage=40,$start=0)
	{

		$this->db->limit($perpage,$start);
		//$this->db->like('date',$year);
		//$this->db->like('date',$month);
		$this->db->order_by('id','desc');
		$arr = $this->db->get('certificate_fees')->result_array();
		return $arr;
	}

	function total_paid_fees($regno=0){
		$this->db->select_sum('amount');
	    $this->db->from('college_fees');
	    $this->db->where('reg_no',$regno);
	    $query = $this->db->get();
	    return $query->row()->amount;
	}
	function total_paid_allowance($regno=0){
		$this->db->select_sum('amount');
	    $this->db->from('college_allowance');
	    $this->db->where('reg_no',$regno);
	    $query = $this->db->get();
	    return $query->row()->amount;
	}
	function row_count_return()
	{
		$qry=$this->db->get('college_return');
		$num=$qry->num_rows();
		return $num;
	}

	function view_return_data($perpage=40,$start=0)
	{

		$this->db->limit($perpage,$start);
		$this->db->order_by('rec_no','desc');
		$arr = $this->db->get('college_return')->result_array();
		return $arr;
	}
	function row_count_allowance()
	{
		$qry=$this->db->get('college_allowance');
		$num=$qry->num_rows();
		return $num;
	}

	function view_allowance_data($perpage=40,$start=0)
	{

		$this->db->limit($perpage,$start);
		$this->db->order_by('rec_no','desc');
		$arr = $this->db->get('college_allowance')->result_array();
		return $arr;
	}
	function total_allowance_by_student($regno = 0)
	{
		$this->db->select_sum('amount');
		$this->db->where('reg_no',$regno);
		$arr = $this->db->get('college_allowance')->row_array();
		return $arr['amount'] ? $arr['amount'] :0;
	}
	function total_refund_by_student($regno = 0)
	{
		$this->db->select('amount');
		$this->db->where('reg_no',$regno);
		$arr = $this->db->get('college_return')->row_array();
		return isset($arr['amount']) ? $arr['amount'] :0;
	}
}
?>