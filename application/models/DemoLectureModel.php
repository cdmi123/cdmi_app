<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class DemoLectureModel extends CI_Model
{
	function insert_data($arr=array())
	{
		//oecho "<pre>";print_r($arr);die;
		$this->db->insert('demo_lectures',$arr);
	}
	function row_count(){
		if($this->session->userdata('user_role')!=1){
			$this->db->where('faculty_id',$this->session->userdata('user_login'));
		}
		$qry = $this->db->get('demo_lectures');
		return $qry->num_rows();
	}
	function get_demo_students(){
		if($this->session->userdata('user_role')!=1){
			$this->db->where('faculty_id',$this->session->userdata('user_login'));
		}
		//$this->db->select('inq_offline.name as inquiry_name,demo_lectures.*');
		//$this->db->join('inq_offline','demo_lectures.inq_id=inq_offline.id');
		//$this->db->where ('course',' find_in_set(inq_offline.course,course.id)','left');
		$this->db->order_by('demo_id','desc');
		$qry = $this->db->get('demo_lectures');
		
		return $qry->result_array();
	}

	function get_record_details($demo_id=0,$source=""){
		if($source =="offline"){
			$qry = $this->db->query("SELECT  demo_lectures.*,a.name as faculty,b.name as inquiry_by,contact,fees,inq_offline.name as inquiry_name,GROUP_CONCAT(course.course_name ORDER BY course.id) as course_name  FROM demo_lectures left join inq_offline on demo_lectures.inq_id=inq_offline.id left join admin as a on a.id=demo_lectures.faculty_id left join admin as b on b.id=inq_offline.inquiry_by inner JOIN course ON FIND_IN_SET( course.id,inq_offline.course) > 0 where demo_id=$demo_id GROUP BY demo_lectures.demo_id order by demo_lectures.demo_id desc");
		}else if($source =="justdial"){
			$qry = $this->db->query("SELECT  demo_lectures.*,a.name as faculty,b.name as inquiry_by,contact,fees,inq_justdial.name as inquiry_name,GROUP_CONCAT(course.course_name ORDER BY course.id) as course_name  FROM demo_lectures left join inq_justdial on demo_lectures.inq_id=inq_justdial.id left join admin as a on a.id=demo_lectures.faculty_id left join admin as b on b.id=inq_justdial.inquiry_by inner JOIN course ON FIND_IN_SET( course.id,inq_justdial.course) > 0 where demo_id=$demo_id GROUP BY demo_lectures.demo_id order by demo_lectures.demo_id desc");
		}else if($source =="call"){
			$qry = $this->db->query("SELECT  demo_lectures.*,a.name as faculty,b.name as inquiry_by,contact,fees,inq_call.name as inquiry_name,GROUP_CONCAT(course.course_name ORDER BY course.id) as course_name  FROM demo_lectures left join inq_call on demo_lectures.inq_id=inq_call.id left join admin as a on a.id=demo_lectures.faculty_id left join admin as b on b.id=inq_call.inquiry_by inner JOIN course ON FIND_IN_SET( course.id,inq_call.course) > 0 where demo_id=$demo_id GROUP BY demo_lectures.demo_id order by demo_lectures.demo_id desc");
		}else if($source =="website"){
			$qry = $this->db->query("SELECT  demo_lectures.*,a.name as faculty,b.name as inquiry_by,contact,fees,inq_web.name as inquiry_name,GROUP_CONCAT(course.course_name ORDER BY course.id) as course_name  FROM demo_lectures left join inq_web on demo_lectures.inq_id=inq_web.id left join admin as a on a.id=demo_lectures.faculty_id left join admin as b on b.id=inq_web.inquiry_by inner JOIN course ON FIND_IN_SET( course.id,inq_web.course) > 0 where demo_id=$demo_id GROUP BY demo_lectures.demo_id order by demo_lectures.demo_id desc");
		}
		return $qry->row_array();
	}
	
}