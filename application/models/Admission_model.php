<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admission_model extends CI_Model
{
	function get_course()
	{
		$data = $this->db->get('course')->result_array();
		return $data;
	}

	function get_course_content()
	{
		$data = $this->db->get('course_cover')->result_array();
		return $data;
	}


	function get_admin_data()
	{
		
		$data1 = $this->db->get('admin')->result_array();
		return $data1;
	}


	function insert_admission_data($data = array())
	{
		$this->db->insert('admission',$data);

		return 1;
	}


	function view_admission_data($perpage=40,$start=0,$search_by="",$search_keyword="")
	{
		

		// $this->db->limit($perpage,$start);
		// $this->db->order_by('id','desc');
		//$this->db->where('status',"R");
		if($search_by=="byno")
		{
			$this->db->where('regno',$search_keyword);
		}
		else if($search_by=="byname")
		{
			$this->db->like('student_name',$search_keyword);	
		}
		else if($search_by=="bycontact")
		{
			$this->db->like('contact',$search_keyword);	
		}
		if($this->session->userdata('user_role')==2){
			$this->db->where_in('status',array("L","R","J","P"));
			//$this->db->where('faculty_id',$this->session->userdata('user_login'));
			$this->db->where('find_in_set("'.$this->session->userdata('user_login').'", faculty_id) <> 0');
		}else if($this->session->userdata('user_role')==5){
			$this->db->where_in('status',array("L","R","C","J","P"));
			$fac_ids = $this->get_dept_students($this->session->userdata('dept_id'));
			//$this->db->where_in('faculty_id',$fac_ids);
			$this->db->group_start();
			foreach($fac_ids as $fac){
				$this->db->or_where('find_in_set("'.$fac.'", faculty_id) <> 0');
			}
			$this->db->group_end();
		}

		$this->db->limit($perpage,$start);
		$this->db->order_by('id','desc');
		$arr = $this->db->get('admission')->result_array();
		//echo $this->db->last_query();die;
		
		//echo '<pre>';print_r($arr);
		return $arr;
	}

	function get_dept_students($dept_id=0){
		
		$faculties = $this->db->query('select id from admin where dept_id = '.$dept_id)->result_array();
		
		$fac_ids = array();
		foreach ($faculties as $key => $value) {
			$fac_ids[] = $value['id'];
		}
		//pre($fac_ids);die;
		// $this->db->select('id');
		// $this->db->where_in('faculty_id',$fac_ids);
		// $stds = $this->db->get('admission')->result_array();
		// $stds_ids = array();
		// foreach ($stds as $k => $val) {
		// 	$stds_ids[] = $val['id'];
		// }
		// //echo $this->db->last_query();die;
		
		return $fac_ids;
	}
	function row_count()
	{
		if($this->session->userdata('user_role')==2){
			$this->db->where_in('status',array("L","R"));
			$this->db->where('find_in_set("'.$this->session->userdata('user_login').'", faculty_id) <> 0');
			//$this->db->where('faculty_id',$this->session->userdata('user_login'));
		}else if($this->session->userdata('user_role')==5){
			$this->db->where_in('status',array("L","R","C"));
			$fac_ids = $this->get_dept_students($this->session->userdata('dept_id'));
			//$this->db->where_in('faculty_id',$fac_ids);
			$this->db->group_start();
			foreach($fac_ids as $fac){
				$this->db->or_where('find_in_set("'.$fac.'", faculty_id) <> 0');
			}
			$this->db->group_end();
		}
		$qry=$this->db->get('admission');
		$num=$qry->num_rows();
		return $num;
	}
	function get_paid_fees($reg_no=0){
		$this->db->select('sum(amount) as paid');
		$this->db->order_by('id','desc');
        $this->db->where('reg_no',$reg_no);
        $this->db->group_by('reg_no');
        $data = $this->db->get('fees')->row_array();
        if(!empty($data)){
	        $paid = !empty($data['paid']) ? $data['paid'] : 0;
	    }else{
	        $paid = 0;
	    }
        $this->db->select('sum(amount) as paid');
		$this->db->order_by('id','desc');
        $this->db->where('reg_no',$reg_no);
        $this->db->group_by('reg_no');
        $data1 = $this->db->get('tbl_dipak')->row_array();
        if(!empty($data1)){
	        $paid1 = !empty($data1['paid']) ? $data1['paid'] : 0;
	    }else{
	        $paid1 = 0;
	    }
        return $paid+$paid1;
	}
	function get_paid_fees2($reg_no=0){
		$this->db->select('sum(amount) as paid');
		$this->db->order_by('id','desc');
        $this->db->where('reg_no',$reg_no);
        $this->db->group_by('reg_no');
        $data = $this->db->get('fees')->row_array();
        if(!empty($data)){
	        $paid = !empty($data['paid']) ? $data['paid'] : 0;
	    }else{
	        $paid = 0;
	    }
        $this->db->select('sum(amount) as paid');
		$this->db->order_by('id','desc');
        $this->db->where('reg_no',$reg_no);
        $this->db->group_by('reg_no');
        $data1 = $this->db->get('tbl_dipak')->row_array();
        if(!empty($data1)){
	        $paid1 = !empty($data1['paid']) ? $data1['paid'] : 0;
	    }else{
	        $paid1 = 0;
	    }
        return $paid+($paid1*10);
	}
	function get_stud_info($stud_ids = array()){
		$this->db->select('student_name,regno,course');
		$this->db->where_in('regno',$stud_ids);
		$this->db->order_by('id','desc');
		$arr = $this->db->get('admission')->result_array();		
		return $arr;
	}
	function get_last_reason($regno = 0){
		$this->db->select('leave_remark,created_at');
		$this->db->where_in('regno',$regno);
		$this->db->order_by('id','desc');
		$arr = $this->db->get('course_attendence')->row_array();		
		return $arr;
	}
	function get_batch_names(){
		$this->db->order_by('b_id','asc');
		$arr = $this->db->get('batch_master')->result_array();		
		return $arr;	
	}
	function get_batch_name_by_stud($regno=0){
		$this->db->where("find_in_set($regno, student_ids)");
		$arr = $this->db->get('student_batches')->row_array();		
		return $arr['batch_name'] ? $arr['batch_name'] : "";	
	}
}