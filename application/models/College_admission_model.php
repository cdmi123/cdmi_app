<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class tbl_inter_model extends CI_Model
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


	// function insert_admission_data($data = array())
	// {
	// 	$this->db->insert('admission',$data);

	// 	return 1;
	// }


	function view_tbl_inter_data($search_by="",$search_keyword="",$perpage=10,$start=0)
	{
		
		$this->db->limit($perpage,$start);
		$this->db->order_by('id','desc');
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
		if($this->session->userdata('user_role')!=1){
			//$this->db->where('faculty_id',$this->session->userdata('user_login'));
		}
		$arr = $this->db->get('tbl_inter')->result_array();
	//	echo $this->db->last_query();die;
		//echo '<pre>';print_r($arr);
		return $arr;
	}


	function row_count()
	{
		if($this->session->userdata('user_role')!=1){
			//$this->db->where('faculty_id',$this->session->userdata('user_login'));
		}
		$qry=$this->db->get('tbl_inter');
		$num=$qry->num_rows();
		return $num;
	}
	function get_paid_fees($reg_no=0){
		$this->db->select('sum(amount) as paid');
		$this->db->order_by('id','desc');
        $this->db->where('reg_no',$reg_no);
        $this->db->group_by('reg_no');
        $data = $this->db->get('college_fees')->row_array();
        return $data;
	}
	function get_certificate_fees($reg_no=0){
		$this->db->select_sum('amount');
      	$this->db->where('reg_no',$reg_no);
      	$fees_data = $this->db->get('certificate_fees',1)->row_array();
      	return $fees_data;
	}
	function get_doc_records($perpage=20,$start=0){
		$this->db->select('university_docs.*,clg.student_name,clg.college_course,clg.course_stream,clg.university,clg.personal_mobile_no,clg.father_mobile_no,clg.home_mobile_no,clg.start_session,clg.end_session');
		$this->db->join('university_docs','university_docs.regno=clg.regno','left');
		$this->db->limit($perpage,$start);
		$admission_info = $this->db->get('tbl_inter clg')->result_array();
		return $admission_info;
	}
	function count_doc_records(){
		$this->db->select('university_docs.*,tbl_inter.student_name,tbl_inter.college_course,tbl_inter.course_stream,tbl_inter.university');
		$this->db->join('university_docs','university_docs.regno=tbl_inter.regno','left');
		return $admission_info = $this->db->get('tbl_inter')->num_rows();
	}
	//
	function get_attendence_by_date($class_id="",$date=""){
		$this->db->where('class_name',$class_id);
		$this->db->where('attendence_date',$date);
		$qry = $this->db->get('student_attendence');
		$attendence_data_has = $qry->row_array();
		if(!empty($attendence_data_has)){
			$data =json_decode( $attendence_data_has['attendence_data']);

		}else{
			$data= array();
		}
		return $data;
	}
}