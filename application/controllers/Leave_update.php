<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Leave_update extends CI_Controller {
	function __construct()
	{
		parent::__construct();	
			
	}

	public function index()
	{
		$today_date = date('Y-m-d');
		$this->db->select('regno');
		$this->db->where('status', 'L');
		$all_recs = $this->db->get('admission')->result_array();
		$i=0;
		$temp = array();
		foreach($all_recs as $row){
			
			$this->db->select('leave_dates');
			$this->db->where('regno',$row['regno']);
			$last_update = $this->db->get('course_attendence')->row_array();
			$leave_dates = isset($last_update['leave_dates']) ? $last_update['leave_dates'] : '';
			//echo $leave_dates;
			if(!empty($leave_dates)){
				$date_parts = explode('-',$leave_dates);
				if(isset($date_parts[1])){
					$date_arr = explode('/',$date_parts[1]);
					//pre($date_arr);
					$new = trim($date_arr[2]).'-'.trim($date_arr[0]).'-'.trim($date_arr[1]);
					if($new<=$today_date){
						$temp[] = $row['regno'];
						$this->db->where('regno',$row['regno']);
						$this->db->update('admission',array('status'=>'R'));
						$i++;
					}
				}	
			}
		}
		echo "$i leave student updated..<br>".implode(",",$temp);
	}
}
