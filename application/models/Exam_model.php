<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Exam_model extends CI_Model
{
	
	function get_performance_by_regno($regno = 0)
	{
		$this->db->select_avg('percentage');
		$this->db->where('regno',$regno);
		$arr = $this->db->get('student_test')->row_array();
		$grade = $arr['percentage'] ? $arr['percentage'] :0;
		if($arr['percentage']!=""){
			if($grade>50)
			{
				$final_grade = "Good";
			}
			else if($grade>30)
			{
				$final_grade = "Average";
			}
			else
			{
				$final_grade = "Poor";
			}
		}else{
			$final_grade = "NA";
		}
		return $final_grade;
	}
	function get_exam_count_by_regno($regno = 0)
	{
		$this->db->select('percentage');
		$this->db->where('regno',$regno);
		$arr = $this->db->get('student_test')->num_rows();
		return $arr;
	}
	function clg_exam_count_by_regno($regno = 0)
	{
		$this->db->select_avg('percentage');
		$this->db->where('regno',$regno);
		$arr = $this->db->get('college_test')->num_rows();
		return $arr;
	}
	function clg_performance_by_regno($regno = 0)
	{
		$this->db->select_avg('percentage');
		$this->db->where('regno',$regno);
		$arr = $this->db->get('college_test')->row_array();
		$grade = $arr['percentage'] ? $arr['percentage'] :0;
		if($arr['percentage']!=""){
			if($grade>50)
			{
				$final_grade = "Good";
			}
			else if($grade>30)
			{
				$final_grade = "Average";
			}
			else
			{
				$final_grade = "Poor";
			}
		}else{
			$final_grade = "NA";
		}
		return $final_grade;
	}
}
?>