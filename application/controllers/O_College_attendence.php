<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class College_attendence extends CI_Controller {
	var $perpage=100;
	function __construct()
	{
		parent::__construct();	
		if(!$this->session->userdata('user_login')){
			redirect('staff-login');
		}

		if($this->session->userdata('user_role')==2 || $this->session->userdata('user_role')==4 ){
			redirect('staff-login');	
		}
		
		$this->load->model('College_admission_model');
		
	}
	public function index($college_year="",$class="")
	{

		if($college_year!= ""){
			$cur_month = date("m");
			$cur_year = date("Y");

			if($cur_month <= 5){
				
				if($college_year == "first"){
					$start_sess = $cur_year-1;
				}else if($college_year == "second"){
					$start_sess = $cur_year-2;
				}else if($college_year == "third"){
					$start_sess = $cur_year-3;
				}else if($college_year == "fourth"){
					$start_sess = $cur_year-4;
				}else if($college_year == "pre"){
					$start_sess = $cur_year;
				}
				
			}else{

				if($college_year == "first"){
					$start_sess = $cur_year;
				}else if($college_year == "second"){
					$start_sess = $cur_year-1;
				}else if($college_year == "third"){
					$start_sess = $cur_year-2;
				}else if($college_year == "fourth"){
					$start_sess = $cur_year-3;
				}else if($college_year == "pre"){
					$start_sess = $cur_year;
				}
			}
			//echo $start_sess;die;
			
		}

		$class_name = 'CLASS '.$class;
		$class_name_id = $college_year.'-'.$class_name;

		if($start_sess!='')
			{
				$this->db->where('start_session',$start_sess);
			}
		$this->db->where('class_name',$class_name);
		$this->db->where('status','R');
		// $this->db->where('college_mode','REG');
		$this->db->where_in('college_mode',array('REG','ONLY_CLG'));
		$student_Data = $this->db->get('college_admission')->result_array();

		$student_regno = array();

		foreach ($student_Data as $key => $value) {
			$student_regno[] = $value['regno'];
		}
	
// pre($student_regno);die;
		
		$arr = array();
		$search_by="";
		$search_keyword="";
		$start=0;
		
		$arr['class_id'] = $class_name_id;
		$arr['class_name'] = $class;
		$arr['class_year'] = $college_year;
		$date = date('Y-m-d');
		$arr['today_date']=$date;

		if($this->input->post('submit')){

			$this->db->where('class_name',$class_name_id);
			$this->db->where('attendence_date',$date);
			$qry = $this->db->get('student_attendence');

			$regno = $this->input->post('regno') ? $this->input->post('regno') : array();

			$absent_array=array();
			foreach ($student_regno as $key => $value) {
				
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
				$absent_data = "[]";
			}

			if(!empty($regno))
			{
				$present_data = json_encode($regno);
			}
			else
			{
				$present_data = "[]";
			}

			$saveArr = array(
				'class_name'=>$class_name_id,
				'attendence_date'=>$date,
				'attendence_data'=>$present_data,	
				'absent'=>$absent_data
			);
			
			// pre($saveArr);die;
			if($qry->num_rows()>0){

				$this->db->where('class_name',$class_name_id);
				$this->db->where('attendence_date',$date);
				$this->db->update('student_attendence',$saveArr);
			}else{
				$this->db->insert('student_attendence',$saveArr);	
			}
			//echo '<pre>';print_r($this->input->post());die;
		}

		// $this->db->where('class_name',$class_name_id);
		// $this->db->where('attendence_date',$date);
		// $qry = $this->db->get('student_attendence');
		// $attendence_data_has = $qry->row_array();
		// if(!empty($attendence_data_has)){
		// 	$data =json_decode( $attendence_data_has['attendence_data']);

		// }else{
		// 	$data= array();
		// }
		// $arr['attendence_data'] = $data;

		if($college_year!= ""){
			$cur_month = date("m");
			$cur_year = date("Y");

			if($cur_month <= 5){
				if($college_year == "first"){
					$start_sess = $cur_year-1;
				}else if($college_year == "second"){
					$start_sess = $cur_year-2;
				}else if($college_year == "third"){
					$start_sess = $cur_year-3;
				}else if($college_year == "fourth"){
					$start_sess = $cur_year-4;
				}else if($college_year == "pre"){
					$start_sess = $cur_year;
				}
			}else{
				if($college_year == "first"){
					$start_sess = $cur_year;
				}else if($college_year == "second"){
					$start_sess = $cur_year-1;
				}else if($college_year == "third"){
					$start_sess = $cur_year-2;
				}else if($college_year == "fourth"){
					$start_sess = $cur_year-3;
				}else if($college_year == "pre"){
					$start_sess = $cur_year;
				}
			}
			//echo $start_sess;die;
			if($start_sess!='')
			{
				$this->db->where('start_session',$start_sess);
			}
		}
		
		$this->db->select('regno,student_name,personal_mobile_no,home_mobile_no,father_mobile_no,image,roll_no');
		$this->db->where('class_name',$class_name);
		$this->db->where('status','R');
		// $this->db->where('college_mode','REG');
		$this->db->where_in('college_mode',array('REG','ONLY_CLG'));
		// $this->db->order_by('roll_no','asc');
		$this->db->order_by("roll_no ASC, student_name ASC");
		$students =$this->db->get('college_admission')->result_array();
		// echo last_query(); die();
		$arr['students'] = $students;

		$maxDays=date('t');
		$currentDayOfMonth=date('j');
		$arr['cur_day'] = $currentDayOfMonth;
		$arr['cur_month'] = date('m');
		$arr['cur_year'] = date('Y');
		$full_attendence = array();
		$leave_info = array();
		$absent_info = array();
		for($i=1;$i<=$currentDayOfMonth;$i++){
			$a_date = date('Y-m-'.$i);
			$a_date = date('Y-m-d',strtotime($a_date));
			$this->db->where('class_name',$class_name_id);
			$this->db->where('attendence_date',$a_date);
			$qry = $this->db->get('student_attendence');

			$attendence_data_has = $qry->row_array();
			if(!empty($attendence_data_has)){
				if($attendence_data_has['attendence_data']!= "null"){
					$data =json_decode( $attendence_data_has['attendence_data']);
				}else{
					$data =array();
				}
				if($attendence_data_has['absent']!= "null"){
					$ab_data = json_decode( $attendence_data_has['absent']);
				}else{
					$ab_data =array();
				}
			}else{
				$data= array();
				$ab_data =array();
			}
			$full_attendence[$a_date] = $data;
			$absent_info[$a_date] = $ab_data;

			//leave details:
			$this->db->where('class_name',$class_name_id);
			$this->db->where('DATE(`followup_time`)',$a_date);
			$qry = $this->db->get('attendence_reason');
			$leave_data_day = $qry->result_array();
			$temp_data =array();
			foreach($leave_data_day as $single){

				$temp_data[$single['regno']] =  $single['note'];
			}
			$leave_info[$a_date] = $temp_data;
			
		}
		// pre($leave_info);
		// die;
		$arr['attendence_data'] =$full_attendence;
		$arr['leave_info'] =$leave_info;
		$arr['absent_info'] =$absent_info;
		$arr['is_current'] = true;
		//pre($arr);die;
		$this->load->view('college_attendence',$arr);
	}
	function update_status(){

		$regno = $this->input->post('regno');
		$note = $this->input->post('note');
		$class_name = $this->input->post('class_name');
		$status_date =date("Y-m-d H:i:s");
		if($regno!="" && $regno!=0){
			$this->db->insert('attendence_reason',array('regno'=>$regno,'class_name'=>$class_name,'note'=>$note,'followup_time'=>$status_date));	
			echo true;;
		}else{
			echo 'Reg No. Missing';
		}
	}

	public function old_attendence($college_year="",$class="",$data_month="")
	{
		//$data_month = "2021_12";
		$exp = explode('_',$data_month);
		$m = $exp[1];
		$y = $exp[0];
		$start_d = $y.'-'.$m.'-01';
		$lastdate = date("t", strtotime($start_d ));
		
		$arr = array();
		$search_by="";
		$search_keyword="";
		$start=0;
		$class_name = 'CLASS '.$class;
		$class_name_id = $college_year.'-'.$class_name;
		$arr['class_id'] = $class_name_id;
		$arr['class_name'] = $class;
		$arr['class_year'] = $college_year;
		$date = date('Y-m-d');
		$arr['today_date']=$date;
		
		if($college_year!= ""){
			$cur_month = date("m");
			$cur_year = date("Y");
			if($cur_month <= 5){
				if($college_year == "first"){
					$start_sess = $cur_year-1;
				}else if($college_year == "second"){
					$start_sess = $cur_year-2;
				}else if($college_year == "third"){
					$start_sess = $cur_year-3;
				}else if($college_year == "fourth"){
					$start_sess = $cur_year-4;
				}
				
			}else{
				if($college_year == "first"){
					$start_sess = $cur_year;
				}else if($college_year == "second"){
					$start_sess = $cur_year-1;
				}else if($college_year == "third"){
					$start_sess = $cur_year-2;
				}else if($college_year == "fourth"){
					$start_sess = $cur_year-3;
				}
			}
			//echo $start_sess;die;
			if($start_sess!='')
			{
				$this->db->where('start_session',$start_sess);
			}
		}
		
		$this->db->select('regno,student_name,personal_mobile_no,home_mobile_no,father_mobile_no,image,roll_no');
		$this->db->where('class_name',$class_name);
		$this->db->where('status','R');
		// $this->db->where('college_mode','REG');
		$this->db->where_in('college_mode',array('REG','ONLY_CLG'));
		$students = $this->College_admission_model->view_college_admission_data($search_by,$search_keyword,$this->perpage,$start);
		//echo '<pre>';print_r($students);
		$arr['students'] = $students;

		$maxDays=date('t');
		$currentDayOfMonth=date('j');
		$arr['cur_day'] = $lastdate;
		$arr['cur_month'] = $m;
		$arr['cur_year'] = $y;
		$full_attendence = array();
		$leave_info = array();
		for($i=1;$i<=$lastdate;$i++){
			$a_date = date($y.'-'.$m.'-'.$i);
			//$a_date = date('Y-m-d',strtotime($a_date));
			$this->db->where('class_name',$class_name_id);
			$this->db->where('attendence_date',$a_date);
			$qry = $this->db->get('student_attendence');
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

			//leave details:
			$this->db->where('class_name',$class_name_id);
			$this->db->where('DATE(`followup_time`)',$a_date);
			$qry = $this->db->get('attendence_reason');
			$leave_data_day = $qry->result_array();
			$temp_data =array();
			foreach($leave_data_day as $single){

				$temp_data[$single['regno']] =  $single['note'];
			}
			$leave_info[$a_date] = $temp_data;
			
		}
		//pre($leave_info);
		//die;
		$arr['attendence_data'] =$full_attendence;
		$arr['leave_info'] =$leave_info;
		$arr['is_current'] = false;
		//$arr['is_current'] = false;
		//pre($arr);die;
		$this->load->view('college_attendence',$arr);
	}

	// public function today_absent()
	// {
	// 	$arr = array();
	// 	$today_date =date("d-m-Y");
	// 	$query = $this->db->query('SELECT * FROM `student_attendence` WHERE DATE(`attendence_time`) = CURDATE() and absent != ""');
	// 	// echo last_query($query); die();
	// 	$data = $query->result_array();
	// 	// last_query();
	// 	// pre($data); 
	// 	$absent_data = array();
	// 	$chek_status_id = array();
	// 	$absent_details = array();
	// 	foreach ($data as $key => $absent_array) {
	// 		$absent_id = json_decode($absent_array['absent'],true);				
	// 		$chek_status_id = array_merge($chek_status_id,$absent_id);
	// 	}

	// 	foreach ($chek_status_id as $key => $value) {
			
	// 		$query_select = $this->db->query("SELECT * FROM `student_attendence` WHERE DATE(`created_at`) = CURDATE() and regno='".$value."'");
	// 		$data = $query_select->row_array();
				

	// 			if(empty($data))
	// 			{

	// 				$this->db->where('regno', $value);
					
	// 				$this->db->select('regno,student_name,personal_mobile_no,home_mobile_no,class_name');
	// 				$this->db->where_in('admission.status',array('R','L'));
	// 				//$this->db->join('admin','admin.id=admission.faculty_id');
	// 				$absent_details = $this->db->get('college_admission')->result_array();
	// 				$absent_data[$value] = $absent_details;
	// 			}
	// 		}
				
		
	// 	$arr['student'] = $absent_data;

	// 	// pre($arr['student']);  die();
		
	// 	$this->load->view('absent_student',$arr);
	// }

	public function today_absent_ajax()
	{
		$arr = array();
		$today_date =date("d-m-Y");
		$query = $this->db->query('SELECT * FROM `student_attendence` WHERE DATE(`attendence_time`) = CURDATE() and absent != ""');
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
			
			$query_select = $this->db->query("SELECT * FROM `attendence_reason` WHERE DATE(`followup_time`) = CURDATE() and regno='".$value."'");
			$data = $query_select->row_array();
				

				if(empty($data))
				{

					$this->db->where('regno', $value);
					
					$this->db->select('regno,student_name,personal_mobile_no,home_mobile_no,class_name,father_mobile_no,start_session');
					//$this->db->where_in('admission.status',array('R','L'));
					//$this->db->join('admin','admin.id=admission.faculty_id');
					$absent_details = $this->db->get('college_admission')->result_array();
					$absent_data[$value] = $absent_details;
				}
			}
				
		
		$arr['student'] = $absent_data;

		// pre($arr['student']);  die();
		
		echo $this->load->view('ajax_collage_absent_student',$arr,true);
	}
}
