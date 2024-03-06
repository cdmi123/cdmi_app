<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Batch_attendence extends CI_Controller {
	var $perpage=100;
	function __construct()
	{
		parent::__construct();	
		 $this->load->helper(array('cookie', 'url')); 
		if(!$this->session->userdata('user_login')){
			redirect('staff-login');
		}
		else
		{
			$s_faculty_id = $this->session->userdata('user_login');
		}
		// if($this->session->userdata('user_role')==2 || $this->session->userdata('user_role')==3 || $this->session->userdata('user_role')==4 || $this->session->userdata('user_role')==5){
		// 	redirect('staff-login');	
		// }
		
	}

	public function index($batch_id="")
	{
		$arr = array();
		$this->db->where('id',$batch_id);
		$student_Batch = $this->db->get('student_batches')->row_array();

		$student_ids = explode(',', $student_Batch['student_ids']);

		$this->db->where_in('regno', $student_ids);
		$this->db->select('regno,student_name,batch_time,faculty_id,course,image,contact,father_contact');
		$this->db->where_in('status',array('R','L'));
		$batch_details = $this->db->get('admission')->result_array();

		$arr['student'] = $batch_details;

		$arr['batch_details'] = $batch_details;

		$search_by="";
		$search_keyword="";
		$start=0;
		$arr['Batch_id'] = $batch_id;
		$date = date('Y-m-d');
		$arr['today_date']=$date;

		if($this->input->post('submit')){

			$this->db->where('batch_id',$batch_id);
			$this->db->where('attendence_date',$date);
			$qry = $this->db->get('batch_attendence');

			$this->db->where('batch_id',$batch_id);
			$this->db->where('lecture_date',$date);
			$qry_lect_report = $this->db->get('lecture_report');

			// echo last_query(); die();
			
			$regno = $this->input->post('regno') ? $this->input->post('regno') :array();
			$lecture_name = $this->input->post('lecture_name');


			$absent_array=array();
			foreach ($student_ids as $key => $value) {
				
				if(!in_array($value, $regno))
				{
					  $this->db->where('regno',$value);
                      $this->db->where('status',"L");
                      $ALdata = $this->db->get('admission')->row_array();

                     	if(empty($ALdata))
                     	{
							$absent_array[] =$value;
					 	}
				}
			}

			if(!empty($absent_array))
			{
				$absent_data = json_encode($absent_array);
			}
			else
			{
				$absent_data = "";
			}

			if(!empty($regno))
			{
				$present_data = json_encode($regno);
			}
			else
			{
				$present_data = "";
			}


			$saveArr = array(
				'batch_id'=>$batch_id,
				'attendence_date'=>$date,
				'attendence_data'=>$present_data,
				'absent'=>$absent_data
			);

			$saveLecture = array(
				'batch_id'=>$batch_id,
				'topic_name'=>$lecture_name,
				'lecture_date'=>$date,
				'attendence_data'=>$present_data,
				'absent_id'=>$absent_data,
			);

			if($qry->num_rows()>0){
				$this->db->where('batch_id',$batch_id);
				$this->db->where('attendence_date',$date);
				$this->db->update('batch_attendence',$saveArr);

			}else{
				$this->db->insert('batch_attendence',$saveArr);	
			}


			if($qry_lect_report->num_rows()>0)
			{
				$this->db->where('batch_id',$batch_id);
				$this->db->where('lecture_date',$date);
				$this->db->update('lecture_report',$saveLecture);
			}
			else
			{
				$this->db->insert('lecture_report',$saveLecture);	
			}
			
		}

		$lecture_info = array();
		$maxDays=date('t');
		$currentDayOfMonth=date('j');
		$arr['cur_day'] = $currentDayOfMonth;
		$arr['cur_month'] = date('m');
		$arr['cur_year'] = date('Y');
		$full_attendence = array();
		$leave_info = array();
		for($i=1;$i<=$currentDayOfMonth;$i++){
			$a_date = date('Y-m-'.$i);
			$a_date = date('Y-m-d',strtotime($a_date));
			$this->db->where('batch_id',$batch_id);
			$this->db->where('attendence_date',$a_date);
			$qry = $this->db->get('batch_attendence');
			$attendence_data_has = $qry->row_array();
			if(!empty($attendence_data_has)){
				if($attendence_data_has['attendence_data']!= "null"){
					$data =json_decode( $attendence_data_has['attendence_data']);
				}else{
					$data =array();
				}
				
			}else{
				$data= array();
			}
			$full_attendence[$a_date] = $data;




		/* GET Lecture Detais */

			$this->db->where('batch_id',$batch_id);
			$this->db->where('lecture_date',$a_date);
			$qry = $this->db->get('lecture_report');
			$lecture_data_day = $qry->result_array();
			$lecture_data =array();

				if(!empty($lecture_data_day))
				{
					$arr1 = $lecture_data_day[0]['absent_id'];
					$arr2 = $lecture_data_day[0]['attendence_data'];
					
					$arr3 = json_decode($arr2);
					$arr1 = json_decode($arr1);

					$present_data = array();
					if(!empty($arr3))
					{
						foreach ($arr3 as $key) {
							
							array_push($present_data,$key);
						}
					}
					if(!empty($arr1))
					{	
						foreach ($arr1 as $key) {
						
							array_push($present_data,$key);
						}
					}

					$index=0;

					if(!empty($present_data))
					{
						foreach($present_data as $single)
						{
							$lecture_data[$present_data[$index]] =  $lecture_data_day[0]['topic_name'];

							$index++ ; 
						}
							$lecture_info[$a_date] = $lecture_data;

						$arr['lecture_name'] = $lecture_data_day[0]['topic_name'];
					}
				}
	/* End Lecture Details */	
		}
		// print_r($lecture_info);
		// die();
	
		$arr['attendence_data'] =$full_attendence;
		$arr['leave_info'] =$leave_info;
		$arr['is_current'] = true;	 
		$arr['lecture_data'] = $lecture_info;
		$this->load->view('batch_attendence',$arr);
	}


	function update_status(){

		$regno = $this->input->post('regno');
		$remark = $this->input->post('remark');
		$leave_status = $this->input->post('leave_status');
		$status_date =date("d/m/Y - d/m/Y");
		$lecture_date =date("Y-m-d");

		$this->db->where('regno',$regno);
		$this->db->where('leave_dates',$status_date);
		$leave = $this->db->get('course_attendence')->result_array();
		$leave_count = count($leave);
		
		if($regno!="" && $regno!=0 ){


			$this->db->where('regno',$regno);
			$student_data = $this->db->get('admission')->result_array();
			$faculty_id = $student_data[0]['faculty_id'];


			$this->db->where('faculty_id',$faculty_id);
			$batch_details = $this->db->get('student_batches')->result_array();

			foreach ($batch_details as $key => $batch) {
				
				$student_ids = explode(',',$batch['student_ids']);

				if(in_array($regno,$student_ids))
				{
					$batch_id = $batch['id'];
					break;
				}
			}

			$this->db->where('batch_id',$batch_id);
			$this->db->where('lecture_date',$lecture_date);
			$lecture_details = $this->db->get('lecture_report')->result_array();

			$lecture_name = $lecture_details[0]['topic_name'];

				if($leave_count==0)
				{
					$this->db->insert('course_attendence',array('regno'=>$regno,'leave_dates'=>$status_date,'leave_remark'=>$remark,'leave_status '=>$leave_status,'topic_name'=>$lecture_name));	
					echo true;
				}
				else
				{
					$leave_data = array('leave_remark'=>$remark,'leave_status '=>$leave_status,'topic_name'=>$lecture_name);
					$this->db->where('regno',$regno);
					$this->db->where('leave_dates',$status_date);
					$this->db->update('course_attendence',$leave_data);
					echo true;
				}
		}else{
			echo 'Reg No. Missing';
		}
	}

	// public function old_attendence($college_year="",$class="",$data_month="")
	// {
	// 	//$data_month = "2021_12";
	// 	$exp = explode('_',$data_month);
	// 	$m = $exp[1];
	// 	$y = $exp[0];
	// 	$start_d = $y.'-'.$m.'-01';
	// 	$lastdate = date("t", strtotime($start_d ));
		
	// 	$arr = array();
	// 	$search_by="";
	// 	$search_keyword="";
	// 	$start=0;
	// 	$class_name = 'CLASS '.$class;
	// 	$class_name_id = $college_year.'-'.$class_name;
	// 	$arr['class_id'] = $class_name_id;
	// 	$arr['class_name'] = $class;
	// 	$arr['class_year'] = $college_year;
	// 	$date = date('Y-m-d');
	// 	$arr['today_date']=$date;
		
	
		
	// 	$this->db->select('regno,student_name,personal_mobile_no,home_mobile_no,father_mobile_no,image');
	// 	$this->db->where('class_name',$class_name);
	// 	$this->db->where('status','R');
	// 	$this->db->where('college_mode','REG');
	// 	$students = $this->College_admission_model->view_college_admission_data($search_by,$search_keyword,$this->perpage,$start);
	// 	//echo '<pre>';print_r($students);
	// 	$arr['students'] = $students;

	// 	$maxDays=date('t');
	// 	$currentDayOfMonth=date('j');
	// 	$arr['cur_day'] = $lastdate;
	// 	$arr['cur_month'] = $m;
	// 	$arr['cur_year'] = $y;
	// 	$full_attendence = array();
	// 	$leave_info = array();
	// 	for($i=1;$i<=$lastdate;$i++){
	// 		$a_date = date($y.'-'.$m.'-'.$i);
			
	// 		//$a_date = date('Y-m-d',strtotime($a_date));
	// 		$this->db->where('batch_id',$batch_id);
	// 		$this->db->where('attendence_date',$a_date);
	// 		$qry = $this->db->get('batch_attendence');
	// 		$attendence_data_has = $qry->row_array();
	// 		if(!empty($attendence_data_has)){
	// 			if($attendence_data_has['attendence_data']!= "null"){
	// 				$data =json_decode( $attendence_data_has['attendence_data']);
	// 			}else{
	// 				$data =array();
	// 			}
				
	// 		}else{
	// 			$data= array();
	// 		}
	// 		$full_attendence[$a_date] = $data;

	// 		//leave details:
	// 		$this->db->where('class_name',$class_name_id);
	// 		$this->db->where('DATE(`followup_time`)',$a_date);
	// 		$qry = $this->db->get('attendence_reason');
	// 		$leave_data_day = $qry->result_array();
	// 		$temp_data =array();
	// 		foreach($leave_data_day as $single){

	// 			$temp_data[$single['regno']] =  $single['note'];
	// 		}
	// 		$leave_info[$a_date] = $temp_data;
			
	// 	}
	// 	//pre($leave_info);
	// 	//die;
	// 	$arr['attendence_data'] =$full_attendence;
	// 	$arr['leave_info'] =$leave_info;
	// 	$arr['is_current'] = false;
	// 	//$arr['is_current'] = false;
	// 	//pre($arr);die;
	// 	$this->load->view('batch_attendence',$arr);
	// }

	public function today_absent()
	{
		/* Add Leave reasion */
		
		//$yesterday_date =date("d/m/Y",strtotime("-1 days"));

		$today_date = date("d/m/Y");
		$a_date = date('Y-m-d');
		date_default_timezone_set('Asia/Kolkata');
		$time = date("h");
		$this->db->where('date',$today_date);
		$this->db->select('regno,student_name,batch_time');
		$this->db->join('admission','absent_ids.a_id=admission.regno');
		$absent_student = $this->db->get('absent_ids')->result_array();
		$status_date = $today_date.' - '.$today_date;


		/* End */

	
		$arr = array();
		
		$query = $this->db->query('SELECT * FROM `batch_attendence` WHERE DATE(`attendence_time`) = CURDATE() and absent != ""');
		// echo last_query($query); die();
		$data = $query->result_array();
		// last_query();
		// pre($data); 
		$absent_data = array();
		$chek_status_id = array();
		$absent_details = array();
		foreach ($data as $key => $absent_array) {
			$absent_id = json_decode($absent_array['absent'],true);				
			$chek_status_id = array_merge($chek_status_id,$absent_id);
		}

		foreach ($chek_status_id as $key => $value) {
			
			$query_select = $this->db->query("SELECT * FROM `course_attendence` WHERE DATE(`created_at`) = CURDATE() and regno='".$value."'");
			$data = $query_select->row_array();
				

				if(empty($data))
				{

					$this->db->where('regno', $value);
					
					$this->db->select('regno,student_name,batch_time,admin.name as faculty_name,course,contact,father_contact,admission.image');
					$this->db->where_in('admission.status',array('R','L'));
					$this->db->join('admin','admin.id=admission.faculty_id');
					$absent_details = $this->db->get('admission')->result_array();
					$absent_data[$value] = $absent_details;
				}
			}
				
		$arr['student'] = $absent_data;

		// echo "<pre>";
		// print_r($arr); die();

			foreach ($absent_data as $key => $abs_details) {
					
					foreach ($abs_details as $index => $details) {

							$this->db->where('a_id',$details['regno']);
							$abs_check = count($this->db->get('absent_ids')->result_array());

						if($abs_check==0)
						{
							$this->db->insert('absent_ids',array('date'=>$today_date,'a_id'=>$details['regno']));

						}
					}

			}
		
		$this->load->view('absent_student',$arr);
	}


	public function today_absent_ajax()
	{
		$arr = array();
		$today_date =date("d-m-Y");
		$query = $this->db->query('SELECT * FROM `batch_attendence` WHERE DATE(`attendence_time`) = CURDATE() and absent != ""');
		// echo last_query($query); die();
		$data = $query->result_array();
		// last_query();
		// pre($data); 
		$absent_data = array();
		$chek_status_id = array();
		$absent_details = array();
		foreach ($data as $key => $absent_array) {
			$absent_id = json_decode($absent_array['absent'],true);				
			$chek_status_id = array_merge($chek_status_id,$absent_id);
		}
	


		foreach ($chek_status_id as $key => $value) {
			
			$query_select = $this->db->query("SELECT * FROM `course_attendence` WHERE DATE(`created_at`) = CURDATE() and regno='".$value."'");
			$data = $query_select->row_array();
				

				if(empty($data))
				{

					$this->db->where('regno', $value);
					
					$this->db->select('regno,student_name,batch_time,admin.name as faculty_name,course,contact,father_contact,admission.image');
					$this->db->where_in('admission.status',array('R','L'));
					$this->db->join('admin','admin.id=admission.faculty_id');
					$absent_details = $this->db->get('admission')->result_array();
					$absent_data[$value] = $absent_details;
				}
			}
				
		$arr['student'] = $absent_data;

		// pre($arr['student']);  die();
		
		echo $this->load->view('ajax_absent_student',$arr,true);
	}

	public function Add_Leave_Reason()
	{

		/* Add Leave reasion */
		
		//$yesterday_date =date("d/m/Y",strtotime("-1 days"));
		
		$today_date = date("d/m/Y");
		$a_date = date('Y-m-d');
		date_default_timezone_set('Asia/Kolkata');
		$time = date("h");
		$this->db->where('date',$today_date);
		$this->db->select('regno,student_name,batch_time,faculty_id');
		$this->db->join('admission','absent_ids.a_id=admission.regno');
		$absent_student = $this->db->get('absent_ids')->result_array();
		$status_date = $today_date.' - '.$today_date;

		// echo "<pre>";
		// print_r($absent_student); die();

		if(!empty($absent_student)){
			
			foreach ($absent_student as $key => $student_time) {
				
				$arr = explode(" ",$student_time['batch_time']);

				$this->db->where('lecture_date',$a_date);
				$this->db->like('absent_id',$student_time['regno']);
				$qry_lect_report = $this->db->get('lecture_report');
				$lecture_data_day = $qry_lect_report->result_array();

				if(!empty($lecture_data_day)){

					$topic_name = $lecture_data_day[0]['topic_name'];

						$faculty_id = explode(",",$student_time['faculty_id']);

						if(in_array($this->session->userdata('user_login'), $faculty_id))
						{

							// echo "Hello"; die();
							$this->db->where('DATE(`created_at`)',$today_date);
							$this->db->where('regno',$student_time['regno']);
							$absent_student = $this->db->get('course_attendence')->result_array();
							// echo sizeof($absent_student);
							// print_r($absent_student); die();
							if(sizeof($absent_student)==0)
							{
								$this->db->insert('course_attendence',array('regno'=>$student_time['regno'],'topic_name'=>$topic_name,'leave_dates'=>$status_date,'leave_remark'=>"Not Inform",'leave_status '=>"A"));
								
								$this->db->delete('absent_ids',array('a_id'=>$student_time['regno'])); 
							}
						}
					
				}
				
			}
		}
		redirect('today-absent');
		/* End */
	}	
}
