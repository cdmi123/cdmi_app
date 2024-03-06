<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class RealtimeModel extends CI_Model
{
	function get_data($type="today"){
		// if($type=="today"){
		// 	$this->db->where('date',date('Y-m-d'));	
		// }
		
		$this->db->order_by('time','asc');
		$qry = $this->db->get('tblt_timesheet');
		return $qry->result_array();
	}

	function get_data_staff($type="today",$staff=""){
		// if($type=="today"){
		// 	$this->db->where('date',date('Y-m-d'));	
		// }
		$this->db->join('admin','admin.punchcode=tblt_timesheet.punchingcode');
		$this->db->order_by('timesheetid','desc');
		$qry = $this->db->get('tblt_timesheet');
		return $qry->result_array();
	}

}
?>