<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class RealTime extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('RealtimeModel');
		if(!$this->session->userdata('user_login')){
			redirect('staff-login');
		}
	}
	function index(){
		$punchData = $this->RealtimeModel->get_data('today');
		pre($punchData);
	}

	function staff(){
		$month = date('n');
		$year = date('Y');
		$days = findWorkDays($month,$year);

		$this->load->model('Admin_model');
		$AllStaff=$this->Admin_model->view_data();
		//pre($AllStaff);die;
		$report = array();
		//$punchData = $this->RealtimeModel->get_data_staff('today');
		foreach($days as $day){
			foreach($AllStaff as $member){
				$punchData = array();
				$date_for = $year.'-'.$month.'-'.$day;
				$punchData = $this->db->query("SELECT admin.id,name,punchcode,date,MIN(time) inTime,MAX(time) outTime FROM `tblt_timesheet` left join admin  on tblt_timesheet.punchingcode=admin.punchcode where date='$date_for' and punchingcode=".$member['punchcode'])->row_array();
				
				
				if(scan_array($punchData)){
					$punchData['id'] = $member['id'];
					$punchData['name'] = $member['name'];
					$punchData['punchcode'] = $member['punchcode'];
					$punchData['date'] = $date_for;
					$punchData['inTime'] = 'No Data';
					$punchData['outTime'] = 'No Data';
					$punchData['work_hours'] = 0;
				}else{
					$datetime1 = $date_for.' '.$punchData['inTime'];
					$datetime2 = $date_for.' '.$punchData['outTime'];	
					$punchData['work_hours'] = getTimeDiff($datetime1,$datetime2);
				}
				//pre($punchData);
				$report[] = $punchData;
			}
			//die;
		}
		
		$data['punchData'] = $report;
		$this->db->where('branch_id',$this->session->userdata('branch_id'));
		$data['faculty'] = $this->db->get('admin')->result_array();

		$this->load->view('view_stafftime',$data);
	}

	function staff_report($staff_id=0){
		$month = date('n');
		$year = date('Y');
		$days = findWorkDays($month,$year);

		$this->load->model('Admin_model');
		$member=$this->Admin_model->get_single_record($staff_id);
		//pre($AllStaff);die;
		$report = array();
		//$punchData = $this->RealtimeModel->get_data_staff('today');
		foreach($days as $day){
			$date_for = $year.'-'.$month.'-'.$day;
			$punchData = $this->db->query("SELECT admin.id,name,punchcode,date,MIN(time) inTime,MAX(time) outTime FROM `tblt_timesheet` left join admin  on tblt_timesheet.punchingcode=admin.punchcode where date='$date_for' and punchingcode=".$member['punchcode'])->row_array();
			
			if(scan_array($punchData)){
				$punchData['id'] = $member['id'];
				$punchData['name'] = $member['name'];
				$punchData['punchcode'] = $member['punchcode'];
				$punchData['date'] = $date_for;
				$punchData['inTime'] = 'No Data';
				$punchData['outTime'] = 'No Data';
				$punchData['work_hours'] = 0;
			}else{
				$datetime1 = $date_for.' '.$punchData['inTime'];
				$datetime2 = $date_for.' '.$punchData['outTime'];	
				$punchData['work_hours'] = getTimeDiff($datetime1,$datetime2);
			}
			//pre($punchData);
			$report[] = $punchData;
		
			//die;
		}
		
		$data['punchData'] = $report;
		$this->load->view('view_stafftime',$data);
	}

	function ajax_staff_report(){
		$month = $this->input->post('month') ? $this->input->post('month'):date('n');
		$year = $this->input->post('year') ? $this->input->post('year'):date('Y');
		$staff_id = $this->input->post('staff_id');
		$days = findWorkDays($month,$year);

		$this->load->model('Admin_model');
		$member=$this->Admin_model->get_single_record($staff_id);
		//pre($AllStaff);die;
		$report = array();
		//$punchData = $this->RealtimeModel->get_data_staff('today');
		$leave = 0;
		$missed = 0;
		$total_days = count($days);
		$times=array();
		foreach($days as $day){
			$date_for = $year.'-'.$month.'-'.$day;
			$punchData = $this->db->query("SELECT admin.id,name,punchcode,date,MIN(time) inTime,MAX(time) outTime FROM `tblt_timesheet` left join admin  on tblt_timesheet.punchingcode=admin.punchcode where date='$date_for' and punchingcode=".$member['punchcode'])->row_array();
			
			if(scan_array($punchData)){
				$punchData['id'] = $member['id'];
				$punchData['name'] = $member['name'];
				$punchData['punchcode'] = $member['punchcode'];
				$punchData['date'] = $date_for;
				$punchData['inTime'] = 'No Data';
				$punchData['outTime'] = 'No Data';
				$punchData['work_hours'] = 0;
				$leave++;
			}else{
				if($punchData['inTime'] ==$punchData['outTime']){
					$missed++;
				}
				$datetime1 = $date_for.' '.$punchData['inTime'];
				$datetime2 = $date_for.' '.$punchData['outTime'];	
				$punchData['work_hours'] = getTimeDiff($datetime1,$datetime2);
				$times[] = $punchData['work_hours'];
			}
			//pre($punchData);
			$report[] = $punchData;
		}
		$data['punchData'] = $report;
		$total_hours = AddWorkingHours($times);
		//$data['total_days'] = $days;
		//$data['leave_days'] = $days-$leave;
		
		$html = $this->load->view('ajax_view_stafftime',$data,true);
		echo json_encode(array('html'=>$html,'days_string'=>"Total Working Days: $total_days, Leave Days: $leave,Missed: $missed, Total Hours: $total_hours"));
	}
}
?>
