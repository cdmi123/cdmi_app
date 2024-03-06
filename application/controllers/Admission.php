<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admission extends CI_Controller {

	var $perpage=50;
	var $total_pc_des = TOTAL_PC_DES;
	var $total_pc_dev = TOTAL_PC_DEV;
	var $faculty_id = 0;
	function __construct()
	{
		parent::__construct();	
		if(!$this->session->userdata('user_login')){
			redirect('staff-login');
		}

		$this->load->model('Admission_model');
		$this->load->model('Fees_model');
		$this->load->model('Exam_model');
		$this->load->library('form_validation');	
	}

	public function index($id=0)
	{
		if($this->session->userdata('user_role')==2){
			redirect('staff-login');	
		}
		$arr = array();
		$slug = $this->uri->segment(4);
		if($id>0 && $slug == "offline")
		{
			$this->db->where('id',$id);
			$arr = $this->db->get('inq_offline')->row_array();
		}
		if($id>0 && $slug == "online")
		{
			$this->db->where('id',$id);
			$arr = $this->db->get('inq_online')->row_array();
		}
		$this->db->where('status',1);
		$arr['course'] = $this->Admission_model->get_course();
		//$arr['course_content'] = $this->Admission_model->get_course_content();
		$arr['admin'] = $this->Admission_model->get_admin_data();
		$arr['reg_no'] = $this->db->order_by('regno',"desc")->limit(1)->get('admission') ->row();
		$this->db->where('status',1);
		#$this->db->where_in('role',array(1,2,5));
		$this->db->where('branch_id',$this->session->userdata('branch_id'));
		$arr['faculty'] = $this->db->get('admin')->result_array();
//echo $arr['reg_no']->regno+1;die;
		if($this->input->post())
		{
			//pre($this->input->post());die;
			$create_by = $this->session->userdata('user_login');
			
			$rno =$arr['reg_no']->regno+1; // $this->input->post('regno');
			$inq_no = $this->input->post('inq_no');
			$fname = trim($this->input->post('fname'));
			$mname = trim($this->input->post('mname'));
			$lname = trim($this->input->post('lname'));
			$contact = $this->input->post('contact');
			$whatsapp_no = $this->input->post('whatsapp_no') ? $this->input->post('whatsapp_no') : '';
			$parent_whatsapp_no = $this->input->post('parent_whatsapp_no') ? $this->input->post('parent_whatsapp_no') :'';
			$father_contact = $this->input->post('father_contact');
			$birth_date = date("Y-m-d",strtotime($this->input->post('birth_date')));
			$address = $this->input->post('address');
			$qualification = $this->input->post('qualification');
			$reference = $this->input->post('reference');
			$reference_name = $this->input->post('reference_name');
			$course = $this->input->post('course');
			$sub_course = $this->input->post('sub_course');
			$course_content = $this->input->post('course_content');
			$join_date = date("Y-m-d",strtotime( $this->input->post('join_date')));
			$end_date =date("Y-m-d",strtotime( $this->input->post('end_date')));
			$total_fees = $this->input->post('total_fees');
			$price = $this->input->post('price');
			$date = $this->input->post('date');
			$job_res = $this->input->post('job_res');
			// $clg_course = $this->input->post('clg_course');
			$course_duration = $this->input->post('course_duration');
			$daily_time = $this->input->post('daily_time');
			$faculty_id = implode(",",$this->input->post('faculty_id'));
			//$batch_start = $this->input->post('batch_start');
			//$batch_end = $this->input->post('batch_end');
			$batch_time = implode(",", $this->input->post('batch_time'));
			$running_topic = $this->input->post('running_topic') ? $this->input->post('running_topic') : "";
			$completed_topic = $this->input->post('completed_topic') ? $this->input->post('completed_topic') : "";
			$extra_note = $this->input->post('extra_note') ? $this->input->post('extra_note') : "";
			$reception_note = $this->input->post('reception_note') ? $this->input->post('reception_note') : "";
			$sitting = $this->input->post('sitting');
			$pcno = $this->input->post('pcno') ? $this->input->post('pcno') : 0;
			$laptop_compulsory = $this->input->post('laptop_compulsory');
			
			$temp_arr = str_split($total_fees/10);
			// pre($array);
			$encode_str = "";
			foreach($temp_arr as $k=>$val){
				$encode_str.=getString(rand(1,3));
				$encode_str.=$val;
			}
			$offer_code =  encodeString($encode_str);

			$installent_details =array();
			foreach($price  as $k=>$p){
				$installent_details[$k]['amount'] = $p;
				$installent_details[$k]['date'] = date("Y-m-d",strtotime($date[$k]));
				$installent_details[$k]['status'] = 0;
			}
			$fees_installment_detail = json_encode($installent_details);
			$full_name = $fname.' '.$mname.' '.$lname;
			$data = array(
				'regno'=>$rno,
				'inq_no'=>$inq_no,
				'surname'=>$fname,
				'first_name'=>$mname,
				'last_name'=>$lname,
				'student_name'=>$full_name,
				'course'=>$course,
				'sub_course'=>$sub_course,
				'course_content'=>$course_content,
				// 'total_fees'=>$total_fees,
				'installment_detail'=>$fees_installment_detail,
				'course_duration'=>$course_duration,
				'daily_time'=>$daily_time,
				'join_date'=>$join_date,
				'end_date'=>$end_date,
				'birth_date'=>$birth_date,
				'contact'=>$contact,
				'whatsapp_no'=>$whatsapp_no,
				'parent_whatsapp_no'=>$parent_whatsapp_no,
				'father_contact'=>$father_contact,
				'address'=>$address,
				'qualification'=>$qualification	,
				'reference'=>$reference,
				'reference_name'=>$reference_name,
				'job_res'=>$job_res,
				// 'college_course'=>$clg_course,
				'faculty_id'=>$faculty_id,
				'batch_time'=>$batch_time,
				'running_topic'=>$running_topic,
				'completed_topic'=>$completed_topic,
				'sitting'=>$sitting,
				'pcno'=>$pcno,
				'laptop_compulsory'=>$laptop_compulsory,
				'extra_note'=>$extra_note,
				'reception_note'=>$reception_note,
				'create_by'=>$create_by,
				'offer_code'=>$offer_code
			);
			if(!empty($_FILES['image']['name'])){
				$config['allowed_types'] = 'jpg|png|gif|jpeg';
				$config['upload_path'] = 'upload/student_photo';
				$this->load->library('upload',$config);
				if($this->upload->do_upload('image'))
				{
					$file_data = $this->upload->data();
					$data['image'] = $file_data['file_name'];
				}
			}
			$this->db->insert('admission',$data);
			$adm_no = $this->db->insert_id();
			if($adm_no>0){
				if($id>0 && $slug == "offline")
				{
					$up=array('status'=>'A');
					$this->db->where('id',$id);
					$this->db->update('inq_offline',$up);
				}
				if($id>0 && $slug == "online")
				{
					$up=array('status'=>'A');
					$this->db->where('id',$id);
					$this->db->update('inq_online',$up);
				}
				redirect('Admission/view_admission');
			}
		}
		$arr['course_batches'] = $this->db->get('course_batches')->result_array();
		$this->load->view('admission_form',$arr);
	}

	function view_admission()
	{
		if($this->session->userdata('user_role')==2){
			redirect('staff-login');	
		}
		$admission = array();
		$search_by = "";
		$search_keyword = "";
		$admission['view_course'] = $this->db->get('course')->result_array();
		$this->db->where('status',1);
		#$this->db->where_in('role',array(1,2,5));
		$this->db->where('branch_id',$this->session->userdata('branch_id'));
		$admission['view_faculty'] = $this->db->get('admin')->result_array();
		if($this->input->post('search'))
		{
			$search_by = $this->input->post('search_by');
			$search_keyword = $this->input->post('search_keyword');
		}
		$this->load->library('pagination');
		
		$start=$this->uri->segment(3);
		$total=$this->Admission_model->row_count(); 
		
		$base_url = site_url('admission/ajax_search_students');
		$pagination =pagination_new($total,$this->perpage,$base_url,3);

		$admission['admission_data'] = $this->Admission_model->view_admission_data($this->perpage,$start,$search_by,$search_keyword);
		$admission['pagination'] =$pagination;
		$admission['perpage'] = $this->perpage;
		$admission['found_results'] = $total;
		$admission['course_batches'] = $this->db->get('course_batches')->result_array();
		//echo '<pre>';print_r($admission);die;
		$this->load->view('view_admission',$admission);
	}

	function view_student($id=0)
	{
		$this->db->where('id',$id);
		$student = $this->db->get('admission')->row_array();

		$this->db->where('id',$student['create_by']);
        $create_by_info = $this->db->get('admin')->row_array();

        $this->db->where('id',$student['update_by']);
        $update_by_info = $this->db->get('admin')->row_array();
        if(!empty($create_by_info)){
        	$student['create_by_name'] = $create_by_info['name'];
        }else{
        	$student['create_by_name'] = 'No Name';
        }
         if(!empty($update_by_info)){
        	$student['update_by_name'] = $update_by_info['name'];
        }else{
        	$student['update_by_name'] = 'No Name';
        }
       
		$arr['student'] = $student;


		$this->db->where_in('id',explode(',',$student['faculty_id']));
		$faculty = $this->db->get('admin')->result_array();
		$names = array();
		foreach($faculty as $fac){
			$names[] = $fac['name'];
		}
		$names = empty($names) ? 'Not Assigned' : implode(", ", $names);
		//$arr['faculty'] = isset($faculty['name']) ? $faculty['name'] : "Not Assigned";
		$arr['faculty'] = $names;
		//pre($faculty);die;
		$this->db->where('reg_no',$student['regno']);
		$data1 = $this->db->get('fees')->result_array();

		$this->db->where('reg_no',$student['regno']);
		$data2= $this->db->get('tbl_dipak')->result_array();
		$all_data = array_merge($data1,$data2);
		usort($all_data, 'date_compare');
		$arr['installent'] =$all_data;


		$this->db->where('regno',$student['regno']);
		$arr['leave_report'] = $this->db->get('course_attendence')->result_array();

		$this->db->where('regno',$student['regno']);
		$this->db->select('student_tracking.*,a.name as t_faculty_name,b.name as from_faculty_name , c.name as to_faculty_name');
		$this->db->join('admin a','a.id=student_tracking.transfer_faculty_id','left');
		$this->db->join('admin b','b.id=student_tracking.to_faculty_id','left');
		$this->db->join('admin c','c.id=student_tracking.from_faculty_id','left');
		$arr['student_tracking'] = $this->db->get('student_tracking')->result_array();

		// echo last_query(); die();


		$this->db->where('regno',$student['regno']);
		$this->db->select('student_test.*,admin.name as faculty_name');
		$this->db->join('admin','admin.id=student_test.faculty_id','left');
		$arr['progress_report'] = $this->db->get('student_test')->result_array();


		$this->db->where('regno',$student['regno']);
		$arr['Complain_report'] = $this->db->get('complian_report')->result_array();

		// pre($arr); die();

		$Total_marks = 0;
		$Total_obtained_marks = 0;
		foreach ($arr['progress_report'] as $key => $value) {
			$Total_marks +=  $value['total_marks'];
			$Total_obtained_marks += $value['obtained_marks'];
		}

		if($Total_marks!=0)
		{
			if($Total_obtained_marks!=0)
			{

				$count1 = $Total_obtained_marks / $Total_marks;
				$count2 = $count1 * 100;
				$count = number_format($count2, 0);
			}
			else
			{
				$count=1;
			}

		}
		else
		{
			$count=1;
		}
		
		$arr['Total_progress'] = $count;



		/* Student Attandance Report */

		$this->db->like('absent','"'.$id.'"');
		$absent_report = $this->db->get('batch_attendence ');
		$absent_days = $absent_report->num_rows();

		$arr['absent_days'] = $absent_days;

		$this->db->like('attendence_data','"'.$id.'"');
		$present_report = $this->db->get('batch_attendence ');
		$present_days = $present_report->num_rows();
				

		$arr['present_days'] = $present_days;

		$this->load->view('view_student_detail',$arr);
	}


	function ajax_search_students()
	{
		$perpage=$this->input->post('perpage') ? $this->input->post('perpage') : $this->perpage;
		$start=$this->uri->segment(3);
		//echo '<pre>';print_r($this->input->post());die;
		$year = $this->input->post('year');
		$month = $this->input->post('month');
		$course = $this->input->post('course');
		$sub_course = $this->input->post('sub_course');
		//@$course_arr = implode(',', $course);
		$faculty = $this->input->post('faculty');
		
		$batch_time = $this->input->post('batch_time');
		//$batch_time_arr =  explode(',', $batch_time);
		$course_status = $this->input->post('course_status');
		$sitting_status = $this->input->post('sitting_status');
		$search_by = $this->input->post('search_by');
		$search_keyword = $this->input->post('search_keyword');
		$performance = $this->input->post('performance');


		if($search_by=='byno' && $search_keyword != '')
		{
			$this->db->where('regno',$search_keyword);
		}
		if($search_by=='byname'  && $search_keyword != '')
		{
			$this->db->like('student_name',$search_keyword);
		}
		if($search_by=='bycontact'  && $search_keyword != '')	
		{
			$this->db->group_start();
			$this->db->like('contact',$search_keyword);
			$this->db->or_like('father_contact',$search_keyword);
			$this->db->group_end();
		}
		if($year!='')
		{
			$this->db->like('join_date',$year);
		}
		if($month!='' && $year!='')
		{
			$start_date = $year.'-'.$month.'-01';
			$end_date = date("Y-m-t", strtotime($start_date));

			$this->db->where('(join_date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'")');	
		}
		if(!empty($course))
		{
			$this->db->group_start();
			foreach($course as $cour){
				$this->db->or_like('course',$cour);
			}
			$this->db->group_end();

		}
		if(!empty($sub_course))
		{
			$this->db->group_start();
			foreach($sub_course as $cour){
				$this->db->or_like('sub_course',$cour);
			}
			$this->db->group_end();

		}
		if(!empty($batch_time))
		{
			$this->db->group_start();
			foreach($batch_time as $batch){
				$this->db->or_where('find_in_set("'.$batch.'", batch_time) <> 0');
				//$this->db->or_like('course',$batch);
			}
			$this->db->group_end();
		}
		if(!empty($faculty))
		{
			$this->db->group_start();
			foreach($faculty as $fac){
				$this->db->or_where('find_in_set("'.$fac.'", faculty_id) <> 0');
			}
			$this->db->group_end();
			
		}
		// if($batch_time_arr!='')
		// {
		// 	$batch_data = explode(',',$batch_time_arr);
		// 	$str = [];
		// 	foreach ($batch_data as $value)
		// 	{
		// 		//$this->db->like('batch_time',$value);
		// 		$str [] = " batch_time = '$value' ";
		// 	}
		// 	if(!empty($str)){
		// 		$this->db->where("( ".implode(" or ", $str).")");
		// 	}
		// }
		
		if($this->session->userdata('user_role')==2){
			$this->db->where('find_in_set("'.$this->session->userdata('user_login').'", faculty_id) <> 0');
			//$this->db->where('faculty_id',$this->session->userdata('user_login'));
			if($course_status == ""){
				$this->db->where_in('status',array("L","R"));	
			}else{
				$this->db->like('status',$course_status);	
			}
		}elseif($this->session->userdata('user_role')==5){
			$fac_ids = $this->Admission_model->get_dept_students($this->session->userdata('dept_id'));
			$this->db->group_start();
			foreach($fac_ids as $fac){
				$this->db->or_where('find_in_set("'.$fac.'", faculty_id) <> 0');
			}
			$this->db->group_end();
			//$this->db->where_in('faculty_id',$fac_ids);
			if($course_status == ""){
				$this->db->where_in('status',array("L","R","C","J"));	
			}else{
				$this->db->like('status',$course_status);	
			}

		}else{

			if($course_status)
			{
				$this->db->like('status',$course_status);
			}	
		}
		if($sitting_status != ""){
				$this->db->like('sitting',$sitting_status);
			}
		$this->db->order_by('id','desc');
		$total = $this->db->count_all_results('admission', FALSE);
		$this->db->limit($perpage,$start);
		$data = $this->db->get();
		//echo $this->db->last_query();die;
		$arr['admission_data'] = $data->result_array();
		$base_url = site_url('admission/ajax_search_students');
		$pagination =pagination_new($total,$perpage,$base_url,3);
		if($this->session->userdata('user_role')==2 || $this->session->userdata('user_role')==5){
			$html = $this->load->view('ajax_search_faculty_admission',$arr,true);	
		}else{
			$html = $this->load->view('ajax_search_admission',$arr,true);	
		}
		
		echo json_encode(array('data'=>$html,'pagination'=>$pagination,'found_results'=>$total));
	}



	function update_date()
	{
		$data = array();
		$data = $this->db->get('fees')->result_array();

		foreach ($data as $info)
		 {
			$join_date = $info['date'];
			echo '<br>'.$join_date;
			$date_arr = explode('-', $join_date);
			$new_date = $date_arr[2]."-".$date_arr[1].'-'.$date_arr[0];

			$new_arr = array('date'=>$new_date);

			$this->db->where('date',$join_date);
			$this->db->update('fees',$new_arr);
		
		 }
	}


	function new_data()
	{
		redirect('admission/view_admission');
	}
	function add_excel_data(){
		
	}


	function edit_form($id=0)
	{
		$f_id=0;


		$regno = $id;

		if($this->session->userdata('user_role')==2){
			redirect('staff-login');	
		}
		$arr = array();
		if($id)
		{
			$this->db->where('regno',$id);
			$data1 = $this->db->get('admission')->row_array();
			$this->session->set_userdata('to_faculty_id',$data1['faculty_id']);
			$total_fees = preg_replace('#[^0-9\.]#', "", $data1['offer_code'] );
			$total_fees = $total_fees*10;
			$data1['total_fees']=$total_fees;
			$arr['update_data'] = $data1;
			$old_total = $total_fees;
			$batch_time = ($data1['batch_time']!="") ? explode(",", $data1['batch_time']) : array();
			$arr['batch_time'] = $batch_time;;
			
			$this->db->order_by('id','asc');
			$this->db->where('reg_no',$data1['regno']);
			$qry1 = $this->db->get('fees');
			$paid_data1 = $qry1->result_array();
						

			$this->db->order_by('id','asc');
			$this->db->where('reg_no',$data1['regno']);
			$qry2 = $this->db->get('tbl_dipak');
			$paid_data2 = $qry2->result_array();
			$paid_data = array_merge($paid_data1,$paid_data2);

			usort($paid_data, 'date_compare');
			$arr['paid_data'] = $paid_data;			
			//pre($arr);die;
			$name_arr = explode(' ',$data1['student_name']);
			$arr['fname'] = $name_arr[0];
			$arr['course_content_arr'] = explode(',',$arr['update_data']['course_content']);
		}
		// pre($arr);die;
		$arr['course'] = $this->Admission_model->get_course();
		//$arr['course_content'] = $this->Admission_model->get_course_content();
		$arr['admin'] = $this->Admission_model->get_admin_data();

		$arr['course_batches'] = $this->db->get('course_batches')->result_array();

		if($this->input->post())
		{
			$update_by = $this->session->userdata('user_login');
			$rno = $this->input->post('regno');
			$fname = $this->input->post('fname');
			$mname = $this->input->post('mname');
			$lname = $this->input->post('lname');
			$contact = $this->input->post('contact');
			$whatsapp_no = $this->input->post('whatsapp_no') ? $this->input->post('whatsapp_no') : '';
			$parent_whatsapp_no = $this->input->post('parent_whatsapp_no') ? $this->input->post('parent_whatsapp_no'): '';
			$father_contact = $this->input->post('father_contact');
			$birth_date = date("Y-m-d",strtotime($this->input->post('birth_date')));
			$address = $this->input->post('address');
			$qualification = $this->input->post('qualification');
			$reference = $this->input->post('reference');
			$reference_name = $this->input->post('reference_name');
			$course = $this->input->post('course');
			$sub_course = $this->input->post('sub_course');
			$course_content = $this->input->post('course_content');
			$join_date = date("Y-m-d",strtotime( $this->input->post('join_date')));
			$end_date =date("Y-m-d",strtotime( $this->input->post('end_date')));
			$total_fees = $this->input->post('total_fees');
			$price = $this->input->post('price');
			$date = $this->input->post('date');
			$pay_status = $this->input->post('pay_status');
			$job_res = $this->input->post('job_res');
			// $clg_course = $this->input->post('clg_course');
			$course_duration = $this->input->post('course_duration');
			$daily_time = $this->input->post('daily_time');
			$status = $this->input->post('status');
			//$faculty_id = $this->input->post('faculty_id');
			$faculty_id = implode(",",$this->input->post('faculty_id'));

				$sel_faculty_id = $this->session->userdata('to_faculty_id');
				$login_faculty_id = $this->session->userdata('user_login');



				if($sel_faculty_id!=$faculty_id)
				{
					if($regno!="" && $regno!=0){
						$update_tracking =array(
							'regno'=>$regno,
							'transfer_faculty_id'=>$login_faculty_id,
							'to_faculty_id'=>$sel_faculty_id,
							'from_faculty_id'=>$faculty_id
						);
						$this->db->insert('student_tracking',$update_tracking);	
					}

					// echo $sel_faculty_id.'<br>'.$faculty_id; die();
				}

			$batch_time = implode(",", $this->input->post('batch_time'));
			$running_topic = $this->input->post('running_topic') ? $this->input->post('running_topic') : "";
			$completed_topic = $this->input->post('completed_topic') ? $this->input->post('completed_topic') : "";
			$extra_note = $this->input->post('extra_note') ? $this->input->post('extra_note') : "";
			$reception_note = $this->input->post('reception_note') ? $this->input->post('reception_note') : "";
			$sitting = $this->input->post('sitting');
			$pcno = $this->input->post('pcno');
			$laptop_compulsory = $this->input->post('laptop_compulsory');
			if($laptop_compulsory == "YES" || $sitting=="LAPTOP"){
				$pcno="0";
			}
			if($old_total!= $total_fees){
				$temp_arr = str_split($total_fees/10);
				// pre($array);
				$encode_str = "";
				foreach($temp_arr as $k=>$val){
					$encode_str.=getString(rand(1,3));
					$encode_str.=$val;
				}
				$offer_code =  encodeString($encode_str);
			}else{
				$offer_code = $data1['offer_code'];
			}
			
			$installent_details =array();
			foreach($price  as $k=>$p){
				$installent_details[$k]['amount'] = $p;
				$installent_details[$k]['date'] = date("Y-m-d",strtotime($date[$k]));
				$installent_details[$k]['status'] = $pay_status[$k];
			}
			$fees_installment_detail = json_encode($installent_details);
			$full_name = $fname.' '.$mname.' '.$lname;
			$data = array(
				'regno'=>$rno,
				'inq_no'=>$inq_no,
				'surname'=>$fname,
				'first_name'=>$mname,
				'last_name'=>$lname,
				'student_name'=>$full_name,
				'course'=>$course,
				'sub_course'=>$sub_course,
				'course_content'=>$course_content,
				// 'total_fees'=>$total_fees,
				'installment_detail'=>$fees_installment_detail,
				'course_duration'=>$course_duration,
				'daily_time'=>$daily_time,
				'join_date'=>$join_date,
				'end_date'=>$end_date,
				'birth_date'=>$birth_date,
				'contact'=>$contact,
				'whatsapp_no'=>$whatsapp_no,
				'parent_whatsapp_no'=>$parent_whatsapp_no,
				'father_contact'=>$father_contact,
				'address'=>$address,
				'qualification'=>$qualification	,
				'reference'=>$reference,
				'reference_name'=>$reference_name,
				'job_res'=>$job_res,
				// 'college_course'=>$clg_course,
				'status'=>$status,
				'faculty_id'=>$faculty_id,
				'batch_time'=>$batch_time,
				'running_topic'=>$running_topic,
				'completed_topic'=>$completed_topic,
				'sitting'=>$sitting,
				'pcno'=>$pcno,
				'laptop_compulsory'=>$laptop_compulsory,
				'extra_note'=>$extra_note,
				'offer_code'=>$offer_code,
				'reception_note'=>$reception_note,
				'update_by'=>$update_by
			);
			if(!empty($_FILES['image']['name'])){
				$config['allowed_types'] = 'jpg|png|gif|jpeg';
				$config['upload_path'] = 'upload/student_photo';
				$this->load->library('upload',$config);
				if($this->upload->do_upload('image'))
				{
					$file_data = $this->upload->data();
					$data['image'] = $file_data['file_name'];
				}
			}
			$this->db->where('id',$id);
			$this->db->update('admission',$data);
			redirect('admission/view_admission');
		}
		$this->db->where('branch_id',$this->session->userdata('branch_id'));
		$arr['faculty'] = $this->db->get('admin')->result_array();
		$this->load->view('edit_admission_form',$arr);
	}

	function get_course()
	{
			$course = $this->input->post('course');
			$this->db->where('course_name',$course);
			$res = $this->db->get('course')->row_array();

			echo json_encode($res);

	}
	function get_end_date()
	{
			$daily_time = $this->input->post('daily_time');
			$course_duration = str_replace(array(" MONTHS","MONTH"," months"," month"), "", $this->input->post('course_duration'));
			$join_date = $this->input->post('join_date');
			$months = "0";
			if($daily_time == 2){
				$months = round($course_duration);
			}else if($daily_time == 3){
				$months = round($course_duration);
			}else if($daily_time == 4){
				$months = round($course_duration/2);
			}else if($daily_time == 6){
				$months = round($course_duration/3);
			}else if($daily_time == 1){
				$months = round($course_duration*2);
			}
			$months.= " months"; 
			$effectiveDate = date('m/d/Y', strtotime("+".$months, strtotime($join_date)));
			$arr = array('end_date'=>$effectiveDate,'course_duration'=>$months);
			echo json_encode($arr);

	}

	function remove_comma()
	{
		$res = $this->db->get('admission')->result_array();

		foreach ($res as $value)
		{
			$tot = str_replace(',', '', $value['total_fees']);
			$arr = array('total_fees'=>$tot);
			$this->db->where('id',$value['id']);
			$this->db->update('admission',$arr);
		}

		echo '<pre>';print_r($res);
	}


	function remove_fees_comma()
	{
		$res = $this->db->get('fees')->result_array();

		foreach ($res as $value)
		{
			$tot = str_replace(',', '', $value['amount']);
			$arr = array('amount'=>$tot);
			$this->db->where('id',$value['id']);
			$this->db->update('fees',$arr);
		}

		echo '<pre>';print_r($res);
	}

	function print_regular_admission($id=0)
	{
		$this->db->where('id',$id);
		$admission_info= $this->db->get('admission')->row_array();
		$res['student'] = $admission_info;
		$this->load->view('course_admission_print',$res);
	}

	function update_status(){
		$regno = $this->input->post('regno');
		$status = $this->input->post('status');
		$note = $this->input->post('note');
		$status_date =date("Y-m-d",strtotime( $this->input->post('status_date')));
		if($regno!="" && $regno!=0){

			if($status=="R"){
				$this->db->where('regno',$regno);
				$this->db->order_by('id','desc');
				$qry = $this->db->get('course_attendence');
				$info = $qry->row_array();
				if(!empty($info)){
					$date_arr = explode('-',$info['leave_dates']);
					if(sizeof($date_arr)==2){
						$start_date = date('m/d/Y',strtotime($date_arr[0]));
						$end_date = date('Y-m-d',strtotime($date_arr[1]));
						if($end_date >date('Y-m-d')){
							$new_end = date('m/d/Y');
							$new_dates = $start_date.' - '.$new_end;
							$this->db->where('id',$info['id']);
							$this->db->update('course_attendence',array('leave_dates'=>$new_dates));
						}
					}
				}
			}
			$this->db->where('regno',$regno);
			$this->db->update('admission',array('status'=>$status,'status_note'=>$note,'status_date'=>$status_date));	
			echo 'Successfully Changed.';
		}else{
			echo 'Reg No. Missing';
		}
	}

	function leave_update(){
		$regno = $this->input->post('regno');
		$remark = $this->input->post('remark');
		$leave_dates = $this->input->post('leave_dates');
		$leave_status = $this->input->post('leave_status');
		
		if($regno!="" && $regno!=0){
			$date_arr = explode('-',$leave_dates);
			$start_date = date('Y-m-d',strtotime($date_arr[0]));
			$end_date = date('Y-m-d',strtotime($date_arr[1]));
			$earlier = new DateTime($start_date);
			$later = new DateTime($end_date);

			$abs_diff = $later->diff($earlier)->format("%a");
			if($abs_diff>4){
				$this->db->where('regno',$regno);
				$this->db->update('admission',array('status'=>'L','status_note'=>$remark,'status_date'=>date('Y-m-d')));	
			}
			//pre($abs_diff);die;

			$this->db->where('regno',$regno);
			$this->db->like('created_at',date('Y-m-d'));
			$qry = $this->db->get('course_attendence');
			//echo $qry->num_rows();die;
			if($qry->num_rows()>0){
				$this->db->where('regno',$regno);
				$this->db->like('created_at',date('Y-m-d'));
				$this->db->update('course_attendence',array('leave_status'=>$leave_status,'leave_dates'=>$leave_dates,'leave_remark'=>$remark,'regno'=>$regno));
				echo 'Successfully Updated.';
			}else{
				$this->db->where('regno',$regno);
				$this->db->insert('course_attendence',array('leave_status'=>$leave_status,'leave_dates'=>$leave_dates,'leave_remark'=>$remark,'regno'=>$regno));
				echo 'Successfully Inserted.';
			}
				
			
		}else{
			echo 'Reg No. Missing';
		}
	}
	function ajax_leave_update(){
		$leaveno = $this->input->post('leaveno');
		$regno = $this->input->post('regno');
		$remark = $this->input->post('remark');
		$leave_dates = $this->input->post('leave_dates');
		$leave_status = $this->input->post('leave_status');
		$this->db->where('id',$leaveno);
		$this->db->update('course_attendence',array('leave_status'=>$leave_status,'leave_dates'=>$leave_dates,'leave_remark'=>$remark,'regno'=>$regno));
		echo 'Successfully Updated.';
		
	}

	function ajax_leave_info(){
		$leaveno = $this->input->post('leaveno');
		$this->db->where('id',$leaveno);
		$qry = $this->db->get('course_attendence');
		$row = $qry->row_array();
		$dates = explode('-',$row['leave_dates']);
		$row['start_date'] = trim($dates[0]);
		$row['end_date'] = trim($dates[1]);
		echo json_encode(array('data'=>$row));
	}

	function export_data(){
		if($this->session->userdata('user_role')==2){
			redirect('staff-login');	
		}
		$this->load->library('exportexcel');
		$getdata =$this->db->get('admission')->result();
		$fields = $this->db->list_fields('admission');

		$fields[] = "Paid";
		$fields[] = "Un-Paid";
		$fields[] = "Batch-Group";
		$all_info  = array();
		foreach ($getdata as $key => $value) {
			$reg_no = $value->regno;
			$batch_name = $this->Admission_model->get_batch_name_by_stud($reg_no);
			$paid_fees = $this->Admission_model->get_paid_fees($reg_no);
			$paid = isset($paid_fees['paid']) ? $paid_fees['paid'] : 0;
			$unpaid = $value->total_fees - $paid;
			$value->paid = $paid;
			$value->unpaid = $unpaid;
			$value->batch_name = $batch_name;
			$all_info[] =$value;
		}

		$this->exportexcel->export_data($fields,$all_info,'multimedia_students');
	}

	function update_installment_details(){
		$this->db->order_by('id','desc');
		$all_students = $this->db->get('admission')->result_array();
		foreach ($all_students as $key => $value) {
			$this->db->where('reg_no',$value['regno']);
			$cnt = $this->db->get('fees')->num_rows();
			$installent_details = $value['installment_detail'];
			if(!empty($installent_details)){
				$installments = json_decode($installent_details,true);
				foreach($installments as $k=>$ins){
					$installments[$k]['date'] =  date('Y-m-d', strtotime($ins['date']));
					if($k<$cnt){
						$installments[$k]['status'] =1;
					}
				}	
				$new_installment_detail = json_encode($installments);
				//pre($new_installment_detail);die;
				$save_info = array('installment_detail'=>$new_installment_detail);
				$this->db->where('id',$value['id']);
				$this->db->update('admission',$save_info);
			}
		}
		//pre($all_students);
	}

	function view_faculty_students(){
		
		$admission = array();
		$admission['view_course'] = $this->db->get('course')->result_array();
		// if($this->session->userdata('user_role')==5){
		// 	$this->db->where('dept_id',$this->session->userdata('dept_id'));
		// }
		$this->db->where_in('role',array(1,2,3,5));
		$this->db->where('branch_id',$this->session->userdata('branch_id'));
		$admission['view_faculty'] = $this->db->get('admin')->result_array();
		$start=$this->uri->segment(3);
			
		$total=$this->Admission_model->row_count(); 
		$base_url = site_url('admission/ajax_search_students');
		$pagination =pagination_new($total,$this->perpage,$base_url,3);
		
		$admission['admission_data'] = $this->Admission_model->view_admission_data($this->perpage);
		//echo $this->db->last_query();die;
		$admission['pagination'] =$pagination;
		$admission['perpage'] = $this->perpage;
		$admission['found_results'] = $total;
		$admission['course_batches'] = $this->db->get('course_batches')->result_array();
		$this->load->view('view_faculty_admission',$admission);
	}

	function get_ajax_student()
	{
		$regno = $this->input->post('regno');
		$this->db->where('regno',$regno);
		$student = $this->db->get('admission')->row_array();

		$this->session->set_userdata('to_faculty_id',$student['faculty_id']);


		$batch_time = ($student['batch_time']!="") ? explode(",", $student['batch_time']) : array();
		$student['batches'] = $batch_time;
		echo json_encode($student);
	}
	function update_faculty_student(){

		$regno = $this->input->post('regno');
		//$faculty_id = $this->input->post('faculty_id');
		$faculty_id = implode(",",$this->input->post('faculty_id'));

		$sel_faculty_id = $this->session->userdata('to_faculty_id');
		$login_faculty_id = $this->session->userdata('user_login');


			if( $sel_faculty_id!=$faculty_id)
			{
				if($regno!="" && $regno!=0){
					$update_tracking =array(
						'regno'=>$regno,
						'transfer_faculty_id'=>$login_faculty_id,
						'to_faculty_id'=>$sel_faculty_id,
						'from_faculty_id'=>$faculty_id
					);
					$this->db->insert('student_tracking',$update_tracking);	
				}
			}

		$batch_time = $this->input->post('batch_time') ? implode(",",$this->input->post('batch_time')):"";
		$sitting = $this->input->post('sitting');
		$pcno = $this->input->post('pcno');
		$running_topic = $this->input->post('running_topic');
		$completed_topic = $this->input->post('completed_topic');
		$faculty_note = $this->input->post('faculty_note');
		if($sitting=="LAPTOP"){
			$pcno="0";
		}
		if($regno!="" && $regno!=0){
			$save_info =array(
				'faculty_id'=>$faculty_id,
				'batch_time'=>$batch_time,
				'sitting'=>$sitting,
				'pcno'=>$pcno,
				'running_topic'=>$running_topic,
				'completed_topic'=>$completed_topic,
				'faculty_note'=>$faculty_note,
			);
			$this->db->where('regno',$regno);
			$this->db->update('admission',$save_info);	
			echo 'Successfully Changed.';
		}else{
			echo 'Reg No. Missing';
		}
	}

	function get_ajax_seats(){
		$batch_times = $this->input->post('batch_time');
		$regno = $this->input->post('regno');
		//$batch_arr = explode(",", $batch_times);
		$available_by_batch_des = array();
		$available_by_batch_dev = array();
		if(!empty($batch_times)){
			foreach($batch_times as $time){
				$this->db->select('pcno');
				$this->db->where('status','R');
				$this->db->where('sitting','PC');
				$this->db->where('pcno !=','0');
				$this->db->where("FIND_IN_SET('".$time."',batch_time)");
				$this->db->order_by('pcno');
				if($regno!="" && $regno>0){
					$this->db->where('regno !=',$regno);
				}
				$rec = $this->db->get('admission')->result_array();

				$batch_assigned = array();
				$batch_avail_des = array();
				$batch_avail_dev = array();
				foreach($rec as $row){
					$batch_assigned[] = $row['pcno'];
				}
				
				for($i=1;$i<=$this->total_pc_des;$i++){
					if(!in_array('DES-'.$i, $batch_assigned)){
						$batch_avail_des[] ='DES-'.$i;
					}
				}
				for($j=1;$j<=$this->total_pc_dev;$j++){
					if(!in_array('DEV-'.$j, $batch_assigned)){
						$batch_avail_dev[] ='DEV-'.$j;
					}
				}
				$available_by_batch_des[] = $batch_avail_des;
				$available_by_batch_dev[] = $batch_avail_dev;
				//pre($batch_avail_dev)  ;die;
			}
			//design PC
			if(sizeof($available_by_batch_des)==1){
				$result = $available_by_batch_des[0];
			}else if(sizeof($available_by_batch_des)==2){
				$a1 = $available_by_batch_des[0];
				$a2 = $available_by_batch_des[1];
				$result=array_intersect($a1,$a2);
			}else if(sizeof($available_by_batch_des)==3){
				$a1 = $available_by_batch_des[0];
				$a2 = $available_by_batch_des[1];
				$a3 = $available_by_batch_des[2];
				$result=array_intersect($a1,$a2,$a3);
			}else if(sizeof($available_by_batch_des)==4){
				$a1 = $available_by_batch_des[0];
				$a2 = $available_by_batch_des[1];
				$a3 = $available_by_batch_des[2];
				$a4 = $available_by_batch_des[3];
				$result=array_intersect($a1,$a2,$a3,$a4);
			}else if(sizeof($available_by_batch_des)==5){
				$a1 = $available_by_batch_des[0];
				$a2 = $available_by_batch_des[1];
				$a3 = $available_by_batch_des[2];
				$a4 = $available_by_batch_des[3];
				$a5 = $available_by_batch_des[4];
				$result=array_intersect($a1,$a2,$a3,$a4,$a5);
			}else if(sizeof($available_by_batch_des)==6){
				$a1 = $available_by_batch_des[0];
				$a2 = $available_by_batch_des[1];
				$a3 = $available_by_batch_des[2];
				$a4 = $available_by_batch_des[3];
				$a5 = $available_by_batch_des[4];
				$a6 = $available_by_batch_des[5];
				$result=array_intersect($a1,$a2,$a3,$a4,$a5,$a6);
			}
			//development PC
			if(sizeof($available_by_batch_dev)==1){
				$result2 = $available_by_batch_dev[0];
			}else if(sizeof($available_by_batch_dev)==2){
				$a1 = $available_by_batch_dev[0];
				$a2 = $available_by_batch_dev[1];
				$result2=array_intersect($a1,$a2);
			}else if(sizeof($available_by_batch_dev)==3){
				$a1 = $available_by_batch_dev[0];
				$a2 = $available_by_batch_dev[1];
				$a3 = $available_by_batch_dev[2];
				$result2=array_intersect($a1,$a2,$a3);
			}else if(sizeof($available_by_batch_dev)==4){
				$a1 = $available_by_batch_dev[0];
				$a2 = $available_by_batch_dev[1];
				$a3 = $available_by_batch_dev[2];
				$a4 = $available_by_batch_dev[3];
				$result2=array_intersect($a1,$a2,$a3,$a4);
			}else if(sizeof($available_by_batch_dev)==5){
				$a1 = $available_by_batch_dev[0];
				$a2 = $available_by_batch_dev[1];
				$a3 = $available_by_batch_dev[2];
				$a4 = $available_by_batch_dev[3];
				$a5 = $available_by_batch_dev[4];
				$result2=array_intersect($a1,$a2,$a3,$a4,$a5);
			}else if(sizeof($available_by_batch_dev)==6){
				$a1 = $available_by_batch_dev[0];
				$a2 = $available_by_batch_dev[1];
				$a3 = $available_by_batch_dev[2];
				$a4 = $available_by_batch_dev[3];
				$a5 = $available_by_batch_dev[4];
				$a6 = $available_by_batch_dev[5];
				$result2=array_intersect($a1,$a2,$a3,$a4,$a5,$a6);
			}
			//pre($result2);die;
			$html = '<option value="0">0</option>';
			$html .= '<optgroup label="Design PC">';
			foreach($result as $r){
				$html.= '<option value="'.$r.'">'.$r.'</option>';
			}
			$html .= '</optgroup><optgroup label="Development PC">';
			foreach($result2 as $r){
				$html.= '<option value="'.$r.'">'.$r.'</option>';
			}
			$html.='</optgroup>';
		}else{
			$html = '<option value="0">0</option>';
		}
		echo $html;
	}
	function show_note(){
		$this->load->view('extra_notes_list');
	}

	function create_batch($batch_id=0){
		if($batch_id>0){
			$arr['batch_info'] = $this->db->get_where('student_batches',array('id'=>$batch_id))->row_array();
			$arr['is_update'] = 'yes';
		}
		if($this->input->post('submit')){
			$batch_name = $this->input->post('batch_name');
			$student_ids_arr = $this->input->post('student_ids');
			if(!empty($student_ids_arr))
			{
				$student_ids = implode(",", $student_ids_arr);
			}
			else
			{
				$student_ids = $arr['batch_info']['student_ids'];
			}
			$batch_time = $this->input->post('batch_time');
			$faculty_id = $this->input->post('faculty_id');
			$topic_name = $this->input->post('topic_name');
			$lecture_time_batch = $this->input->post('lecture_time_batch');
			$class_name = $this->input->post('class_name');
			$saveArr = array(
				'faculty_id'=>$faculty_id,
				'batch_time'=>$batch_time,
				'batch_name'=>$batch_name,
				'student_ids'=>$student_ids,
				'topic_name'=>$topic_name,
				'lecture_time'=>$lecture_time_batch,
				'class_name'=>$class_name,
			);

			$student_ids_arr = explode(',', $student_ids);
			$faculty_id_arry = array('faculty_id'=>$faculty_id);

	

			if($topic_name!="" && !empty($student_ids_arr)){
				$this->db->where_in('regno',$student_ids_arr);
				$this->db->update('admission',array('running_topic'=>$topic_name));
			}
			if($batch_id>0){
				$this->db->where('id',$batch_id);
				$this->db->update('student_batches',$saveArr);
			}else{
				$this->db->insert('student_batches',$saveArr);	
			}
			redirect('admission/view_batches');
		}
		
		$this->db->where('status',1);
		$this->db->where_in('role',array(1,2,3,5));
		$this->db->where('branch_id',$this->session->userdata('branch_id'));
		$arr['faculty'] = $this->db->get('admin')->result_array();
		$arr['course_batches'] = $this->db->get('course_batches')->result_array();
		$arr['lecture_batches'] = $this->db->get('lecture_time')->result_array();
		$arr['class_name'] = $this->db->get('lecture_class')->result_array();
		$arr['batches'] = $this->Admission_model->get_batch_names();
		$this->load->view('create_batch',$arr);	
	}

	function view_batches(){

		$arr = array();
		$faculty_id = $this->session->userdata('user_login');
		$this->db->select('student_batches.*,admin.name');
		$this->db->join('admin','admin.id=student_batches.faculty_id','left');
		$arr['batch_data'] = $this->db->get_where('student_batches',array('faculty_id'=>$faculty_id))->result_array();
		$arr['course_batches'] = $this->db->get('course_batches')->result_array();

		//echo last_query(); die();

		$this->db->where('status',1);
		$this->db->where_in('role',array(1,2,3,5));
		$this->db->where('branch_id',$this->session->userdata('branch_id'));
		$arr['faculty'] = $this->db->get('admin')->result_array();
		/* student not assign in batch */

				$student_arry = array();

				$this->db->where('faculty_id',$faculty_id);
				$arr1['student_batch_data'] = $this->db->get('student_batches')->result_array();
				$student_id_no = ""; 
				
				foreach($arr1 as $key => $student_id){
					foreach ($student_id as $key => $student_ids) {
						$student_id_no = $student_id_no.','.$student_ids['student_ids'];	
					}
				}
							
				$student_id_no = substr($student_id_no,1,strlen($student_id_no));
				$stu_arry = explode(',', $student_id_no);

				$student_arry[$faculty_id] = $stu_arry;
		
		$str_id="";

		foreach ($student_arry as $key => $value) {

			$ids = implode(',',$value);
				if($ids!="")
				{
					$str_id = $str_id.','.$ids;
				}
		}

		$batch_ids = substr($str_id,1,strlen($str_id));
		$array_id = explode(',', $batch_ids);
		$this->db->where_not_in('regno', $array_id);
		$this->db->select('regno,student_name,batch_time,faculty_id,course');
		$this->db->where_in('status',array('R','L'));
		$this->db->where('faculty_id',$faculty_id);
		$arr['no_batch'] = $this->db->get('admission')->result_array();

		$today_date = date("Y-m-d");
		$faculty_id = $this->session->userdata('user_login');

        $this->db->select('student_batches.*,admin.name');
        $this->db->join('admin','admin.id=student_batches.faculty_id','left');
        $arr['batch_data'] = $this->db->get_where('student_batches',array('faculty_id'=>$faculty_id))->result_array();
        $arr['course_batches'] = $this->db->get('course_batches')->result_array();


                $student_arry = array();

                $this->db->where('faculty_id',$faculty_id);
                $arr1['student_batch_data'] = $this->db->get('student_batches')->result_array();

                $this->db->where('faculty_id',$faculty_id);
                      $this->db->where_in('status',array('R'));
                $total_student = $this->db->get('admission')->num_rows();

                $student_id_no = ""; 
                 $batch_id = ""; 
                
                foreach($arr1 as $key => $student_id){
                    foreach ($student_id as $key => $student_ids) {
                        $student_id_no = $student_id_no.','.$student_ids['student_ids'];    
                    }
                }
                            
                $student_id_no = substr($student_id_no,1,strlen($student_id_no));
                $stu_arry = explode(',', $student_id_no);

                 foreach($arr1 as $key => $student_id){
                    foreach ($student_id as $key => $batch_ids) {
                        $batch_id = $batch_id.','.$batch_ids['id'];    
                    }
                }
                            
                $student_id_no = substr($student_id_no,0,strlen($student_id_no));
                $stu_arry = explode(',', $student_id_no);

                $batch_id = substr($batch_id,1,strlen($batch_id));
                $batch_id_array = explode(',', $batch_id);

                // $total_student = count($stu_arry);
        
		        $str_id="";

		    $absent_student=0;
		    $present_student=0;
		    $total_attendence=0;
		    $absent_id = array(0);
		    $present_id = array(0);

		 	foreach ($batch_id_array as $key => $batch_id) {

		 		$this->db->where('batch_id',$batch_id);
		 		$this->db->where('attendence_date',$today_date);
		 		$present_info = $this->db->get('batch_attendence')->result_array();

		 		if(!empty($present_info) && !empty($present_info[0]['absent']))
		 		{

		 			$absent_id = json_decode($present_info[0]['absent']);
		 			$total_attendence+=count($absent_id);

		 			foreach ($stu_arry as $key => $value) {
		 				
		 					if(in_array($value,$absent_id)){
		 						$absent_student++;
		 					}
		 			}
		    	}

		    	if(!empty($present_info) && !empty($present_info[0]['attendence_data']))
		 		{
		 			$present_id = json_decode($present_info[0]['attendence_data']);
		 			$total_attendence+=count($present_id);
		 			foreach ($stu_arry as $key => $value) {
		 				
		 					if(in_array($value,$present_id)){
		 						$present_student++;
		 					}
		 			}
		    	}
		    }

		 $arr['total_student'] = $total_student;
		 $arr['absent_student'] = $absent_student;
		 $arr['present_student'] = $present_student;
		 
		$this->load->view('view_batches',$arr);		
	}
	function ajax_get_batches(){
		$by_faculty = $this->input->post('by_faculty');
		$batch_time = $this->input->post('by_batch');
		if($by_faculty!=""){
			$faculty_id = $by_faculty;
		}else{
			$faculty_id = $this->session->userdata('user_login');	
		}
		if($batch_time!=""){
			$this->db->where('batch_time',$batch_time);
		}
		$this->db->select('student_batches.*,admin.name');
		$this->db->join('admin','admin.id=student_batches.faculty_id','left');
		$arr['batch_data'] = $this->db->get_where('student_batches',array('faculty_id'=>$faculty_id))->result_array();
		$arr['course_batches'] = $this->db->get('course_batches')->result_array();

		/* student not assign in batch */

		// $this->db->where('id',$by_faculty);
		// $arr_admin['admin'] = $this->db->get('admin')->result_array();
		// foreach ($arr_admin as $key => $value) {

		// 		$student_arry = array();

		// 	foreach ($value as $key => $data) {

		// 		$this->db->where('faculty_id',$data['id']);
		// 		$arr1['student_batch_data'] = $this->db->get('student_batches')->result_array();
		// 		$student_id_no = ""; 
				
		// 		foreach($arr1 as $key => $student_id){
		// 			foreach ($student_id as $key => $student_ids) {
		// 				$student_id_no = $student_id_no.','.$student_ids['student_ids'];	
		// 			}
		// 		}
							
		// 		$student_id_no = substr($student_id_no,1,strlen($student_id_no));
		// 		$stu_arry = explode(',', $student_id_no);

		// 		$student_arry[$data['id']] = $stu_arry;
		// 	}
		// }

		// $str_id="";

		// foreach ($student_arry as $key => $value) {

		// 	$ids = implode(',',$value);
		// 		if($ids!="")
		// 		{
		// 			$str_id = $str_id.','.$ids;
		// 		}
		// }


		$student_arry = array();

				$this->db->where('faculty_id',$faculty_id);
				$arr1['student_batch_data'] = $this->db->get('student_batches')->result_array();
				$student_id_no = ""; 
				
				foreach($arr1 as $key => $student_id){
					foreach ($student_id as $key => $student_ids) {
						$student_id_no = $student_id_no.','.$student_ids['student_ids'];	
					}
				}
							
				$student_id_no = substr($student_id_no,1,strlen($student_id_no));
				$stu_arry = explode(',', $student_id_no);

				$student_arry[$faculty_id] = $stu_arry;
		
		$str_id="";

		foreach ($student_arry as $key => $value) {

			$ids = implode(',',$value);
				if($ids!="")
				{
					$str_id = $str_id.','.$ids;
				}
		}


		$batch_ids = substr($str_id,1,strlen($str_id));
		$array_id = explode(',', $batch_ids);

		$this->db->where_not_in('regno', $array_id);
		$this->db->select('regno,student_name,batch_time,faculty_id,course');
		$this->db->where('faculty_id',$faculty_id);
		$this->db->where_in('status',array('R','L'));
		if($by_faculty!=""){
			$this->db->where('faculty_id',$by_faculty);
		}
		if($batch_time!=""){
			$this->db->where('batch_time',$batch_time);
		}
		$arr['no_batch'] = $this->db->get('admission')->result_array();
		echo $this->load->view('ajax_view_batches',$arr,true);			
	}
	function get_ajax_batch_students(){
		//pre($_POST);
		$faculty_id = $this->input->post('faculty_id');
		$batch_time = $this->input->post('batch_time');
		$selected_ids = $this->input->post('selected_ids');
		$selected = array();
		if($selected_ids!=""){
			$selected = explode(',',$selected_ids);
		}
		$this->db->where('find_in_set("'.$batch_time.'", batch_time) <> 0');
		$this->db->where_in('status',array("L","R"));
		$this->db->where('find_in_set("'.$faculty_id.'", faculty_id) <> 0');

		//$this->db->where('faculty_id',$this->session->userdata('user_login'));
		$this->db->order_by('id','desc');
		$arr = $this->db->get('admission')->result_array();
		$html =  '<option value="">Select Students</option>';
		foreach($arr as $row){
			if(in_array($row['regno'], $selected))
			{
				$str = "selected";
			}else{
				$str = "";
			}
			$html.= '<option value="'.$row['regno'].'" '.$str.'>'.$row['regno'].'-'.$row['student_name'].'</option>';
		}
		echo $html;
	}
	function delete_batch($batch_id=0){
		if($batch_id==0 || $batch_id==""){
			redirect('admission/view_batches');
		}
		$this->db->where('id',$batch_id);
		$this->db->delete('student_batches');
		redirect('admission/view_batches');
	}
	function topic_update()
	{
		$topic_name = $this->input->post("topic_name");
		$student_id = $this->input->post("student_id");
		$batch_id = $this->input->post("batch_id");

		$students_id = explode(',',$student_id);

		foreach ($students_id as $s_id) {
			
			$this->db->where('id',$s_id);
			$array = $this->db->get("admission")->row_array();

			$last_completed_topic = $array['completed_topic'];

			$last_completed_topic = explode(',', $last_completed_topic);
			
			if (empty($last_completed_topic)) {
				
				$new_com_topic = $topic_name;
			}
			else
			{
				if(!in_array($topic_name,$last_completed_topic))
				{
					array_push($last_completed_topic, $topic_name);
				}
			}

			$new_com_topic = implode(',', $last_completed_topic);

			echo $new_com_topic.'<br>'; 

			$data = array('completed_topic'=>$new_com_topic);
			$this->db->where('id',$s_id);
			$this->db->update('admission',$data);
		}
		echo 'Successfully Changed.';
	}
	function get_student($id)
	{
		$this->db->where('regno',$id);
		$data = $this->db->get('admission')->row_array();
		echo json_encode($data);
	}
	function Change_Batch($batch_id)
	{
		
		if($batch_id>0){

			$arr['batch_info'] = $this->db->get_where('student_batches',array('id'=>$batch_id))->row_array();
			$id = $arr['batch_info']['student_ids'];
			$faculty_id = $arr['batch_info']['faculty_id'];
			$faculty_id1 = $arr['batch_info']['faculty_id'];

			$arr['is_update'] = 'yes';
		}

		if($this->input->post('submit')){

			$batch_name = $this->input->post('batch_name');
			$student_ids_arr = $this->input->post('student_ids');
			if(!empty($student_ids_arr))
			{
				$student_ids = implode(",", $student_ids_arr);
			}
			else
			{
				$student_ids = $arr['batch_info']['student_ids'];
			}

			$batch_time = $this->input->post('batch_time');
			$faculty_id = $this->input->post('faculty_id');
			$topic_name = $this->input->post('topic_name');
			$lecture_time_batch = $this->input->post('lecture_time_batch');
			$class_name = $this->input->post('class_name');

			$saveArr = array(
				'faculty_id'=>$faculty_id,
				'batch_time'=>$batch_time,
				'student_ids'=>$student_ids,
				'topic_name'=>$topic_name,
				'lecture_time'=>$lecture_time_batch,
				'class_name'=>$class_name,
			);

			$student_ids_arr = explode(',', $student_ids);
			$faculty_id_arry = array('faculty_id'=>$faculty_id);

			foreach ($student_ids_arr as $key => $id) {
				
				$this->db->where('regno',$id);
				$this->db->update('admission',$faculty_id_arry);

				//$sel_faculty_id = $this->session->userdata('to_faculty_id');
				$login_faculty_id = $this->session->userdata('user_login');

				if($faculty_id1!=$faculty_id)
				{
					if($id!="" && $id!=0){

						$update_tracking =array(

							'regno'=>$id,
							'transfer_faculty_id'=>$login_faculty_id,
							'to_faculty_id'=>$faculty_id1,
							'from_faculty_id'=>$faculty_id
						);
						$this->db->insert('student_tracking',$update_tracking);	
					}

					// echo $sel_faculty_id.'<br>'.$faculty_id; die();
				}
			}

			if($topic_name!="" && !empty($student_ids_arr)){
				$this->db->where_in('regno',$student_ids_arr);
				$this->db->update('admission',array('running_topic'=>$topic_name));
			}
			if($batch_id>0){
				$this->db->where('id',$batch_id);
				$this->db->update('student_batches',$saveArr);
			}else{
				$this->db->insert('student_batches',$saveArr);	
			}
			redirect('admission/view_batches');
		}
		$this->db->where('status',1);
		$this->db->where_in('role',array(1,2,3,5));
		$this->db->where('branch_id',$this->session->userdata('branch_id'));
		$arr['faculty'] = $this->db->get('admin')->result_array();
		$arr['course_batches'] = $this->db->get('course_batches')->result_array();
		$arr['lecture_batches'] = $this->db->get('lecture_time')->result_array();
		$arr['class_name'] = $this->db->get('lecture_class')->result_array();
		$arr['batches'] = $this->Admission_model->get_batch_names();
		$this->load->view('change_batch',$arr);	
	}

	function get_ajax_class()
	{
		$l_time = $this->input->post('l_time');

		$this->db->where('lecture_time',$l_time);
		$use_class = $this->db->get('student_batches')->result_array();

		$this->db->where('lecture_time',$l_time);
		$use_class_collage = $this->db->get('collage_batch')->result_array();

		$arr = array();
		$id = 0;

		foreach ($use_class as $key => $class_name) {
			if($class_name['class_name']!="" and $class_name['class_name']!=NULL){
				$arr[$id] = $class_name['class_name'];
				$id++;
			}
			
		}

		foreach ($use_class_collage as $key => $class_name) {
			if($class_name['class_name']!="" and $class_name['class_name']!=NULL){
				$arr[$id] = $class_name['class_name'];
				$id++;
			}
		}

		if(!empty($arr))
		{
			$this->db->where_not_in('class_name',$arr);
		}
		$class_name['class_data'] = $this->db->get('lecture_class')->result_array();

		$this->load->view('view_class',$class_name);
	}
	function assign_collage_class()
	{
		$collage_year = $this->input->post('collage_year');
		$lecture_time = $this->input->post('lecture_time');
		$collage_div = $this->input->post('collage_div');
		$class_name = $this->input->post('class_name');

		$saveArr = array('collage_year'=>$collage_year,'division'=>$collage_div,'class_name'=>$class_name,'lecture_time'=>$lecture_time);

		$this->db->insert('collage_batch',$saveArr);

		echo true;
		
	}
	function Remove_collage_class()
	{
		$id = $this->input->post('remove_id');
		$this->db->where('id',$id);
		$this->db->delete("collage_batch");

		echo true;
	}

	function Remove_Regular_class()
	{
		$id = $this->input->post('remove_id');
		$update_value = array('lecture_time'=>"",'class_name'=>"");
		$this->db->where('id',$id);
		$this->db->update('student_batches',$update_value);

		echo true;
	}

		function export_exam_data(){

			
			$faculty = $this->input->post('faculty');
			$batch_time = $this->input->post('batch_time');
			$course = $this->input->post('course');
			$sitting_status = $this->input->post('sitting_status');
			$status = $this->input->post('course_status');



			$this->load->library('exportexcel');
		if($this->session->userdata('user_role')==2){
			redirect('staff-login');	
		}


		if ($faculty!="") {
			$faculty = implode(',', $faculty);
			$this->db->like('faculty_id',$faculty);
		}

		if ($batch_time!="") {
			$batch_time = implode(',', $batch_time);
			$this->db->like('batch_time',$batch_time);
		}

		if ($course!="") {
			$course = implode(',', $course);
			$this->db->where('course',$course);
		}

		if ($sitting_status!="") {
			$this->db->where('sitting',$sitting_status);
		}

		if ($status!="") {
			$this->db->where('status',$status);
		}

		$this->db->select('regno,student_name,course,father_contact');
		$getdata =$this->db->get('admission')->result();

		// echo last_query();
		// echo '<pre>';print_r($getdata); die();

		$fields = array();
		$fields[] = "";
		$fields[] = "Student_name";
		$fields[] = "Course";
		$fields[] = "Father_mobile_no";
		$all_info = array();

		$Exam_array = array();
		foreach ($getdata as $key => $value) {
			$reg_no = $value->regno;

		$this->db->where('regno',$reg_no);
		$this->db->select('exam_topic,total_marks,obtained_marks');
		$get_marks_data =$this->db->get('student_test');

		$Exam_array[$reg_no] = $get_marks_data->num_rows();

			$this->db->where('regno',$reg_no);
			$this->db->select('exam_topic,total_marks,obtained_marks');
			$get_student_marks =$this->db->get('student_test')->result();
				
			// echo last_query(); 

			$id = 0;
			foreach ($get_student_marks as $key => $marks) {
				++$id;
				$value->$id = '';
				++$id;
				$value->$id = $marks->exam_topic;
				++$id;
				$value->$id = $marks->total_marks;
				++$id;
				$value->$id = $marks->obtained_marks;
			}

		$all_info[] = $value;
		}

	
		$this->exportexcel->export_data($fields,$all_info,'multimedia_students');
	}



	/* absent report */


	function absent_report()
	{
		$cur_year = date('Y');
		$cur_month = date('m');
		$cur_date = date('d');
		$telecaller_repo = array();
		$telecaller = array();
		$maxDays=date('t');
		$currentDayOfMonth=date('j');

					

		for($m=$cur_month;$m<=$cur_month;$m++)
		{
			$telecaller_date = array();

			if($m<$cur_month)
			{
				$cur_date = cal_days_in_month(CAL_GREGORIAN, $m, $cur_year);
			}
			else
			{
				$cur_date = date('d');
			}

			$student_data = array();

				$id=0;		

			for ($d=$cur_date; $d>=1 ; $d--) { 

				$date = $cur_year.'-'.$m.'-'.$d;

					$query_student_list = $this->db->query("SELECT absent FROM batch_attendence where attendence_date = '$date'");
					$absent_list = $query_student_list->result_array();

					$student_ids = "";
					$abset_id = "";

					foreach ($absent_list as $key => $value) {
						if($value['absent']!=""){
							$student_ids = json_decode($value['absent']);
							$abset_id = implode(',', $student_ids);
							if($abset_id!="")
							{
								$student_data[$id] = $abset_id;	
								$id++;
							}
						}
						
					}
			}


			$absent_ids = implode(',', $student_data);

			$absent_ids = explode(',',$absent_ids);

			for ($d=$cur_date; $d>=1 ; $d--) { 

				$date = $cur_year.'-'.$m.'-'.$d;

					$query_student_list = $this->db->query("SELECT absent FROM batch_attendence where attendence_date = '$date'");
					$absent_list = $query_student_list->result_array();

					print_r($absent_list);
			}
		}



		die();
		$this->load->view('absent_report');
	}


	function old_absent_report($data_month="")
	{
		$exp = explode('_',$data_month);
		$m = $exp[1];
		$y = $exp[0];
		$start_d = $y.'-'.$m.'-01';
		$lastdate = date("t", strtotime($start_d ));
		$telecaller_repo = array();
		$telecaller = array();

		$query_faculty = $this->db->query("SELECT admin.name,admin.id FROM admin WHERE role='8'");
		$telecall_name = $query_faculty->result_array();

			$telecaller_date = array();

			for ($d=1; $d<=$lastdate ; $d++) { 

				$arr = array();
					foreach ($telecall_name as $key => $value) {

						$id = $value['id'];
						$name = $value['name'];
				
				$query_report =  $this->db->query("SELECT admin.name , COUNT(school_call_followup.followup_by) AS total_count FROM admin  JOIN school_call_followup ON admin.id=school_call_followup.followup_by and admin.role= '8' AND YEAR(school_call_followup.followup_date)='$y' and MONTH(school_call_followup.followup_date) = '$m' and DAY(school_call_followup.followup_date)='$d' AND school_call_followup.followup_by = '$id' ");
				$call_repo = $query_report->result_array();

				$arr[$name] = $call_repo;

				}

				$telecaller_date[$d.'-'.$m.'-'.$y] = $arr;
			}

			$telecaller_repo[$m.'_'.$y] = $telecaller_date;

		$telecaller['tele_repo'] = $telecaller_repo;

		$this->load->view('absent_report',$telecaller);

	}


	/* end absent report*/

	/* complain report */

		function Complian_update()
		{
				$c_regno = $this->input->post('cregno');
				$date = $this->input->post('complain_date');
				$remark = $this->input->post('remark');
				$faculty_name = $this->input->post('faculty_name');

				$complian_report_array = array('regno' => $c_regno,'remark'=>$remark,'complian_date'=>$date,'faculty_id'=>$faculty_name);
				
				$this->db->insert('complian_report',$complian_report_array);
		}


		function remove_complain($id=0,$reg=0)
		{
			$this->db->where('c_id',$id);
			$this->db->delete('complian_report');
			redirect('admission/view_student/'.$reg);
		}

		/* mrg batch */
	public function get_batch_info($batch_id=0,$f_id=0)
	{
		$batch_id = $this->input->get('batch_id');
		$f_id = $this->input->get('f_id');

		$arr = array();
		$faculty_id = $this->session->userdata('user_login');
		$this->db->select('student_batches.batch_name,student_batches.batch_time,admin.name');
		$this->db->join('admin','admin.id=student_batches.faculty_id','left');
		$arr = $this->db->get_where('student_batches',array('faculty_id'=>$f_id))->result_array();

		$arr['course_batches'] = $this->db->get('course_batches')->result_array();

		echo json_encode($arr);
		//print_r($arr);

	}

	function get_ajax_job()
	{
		$regno = $this->input->post('regno');
		$this->db->where('regno',$regno);
		$student = $this->db->get('admission')->row_array();

		$this->session->set_userdata('to_faculty_id',$student['faculty_id']);


		$batch_time = ($student['batch_time']!="") ? explode(",", $student['batch_time']) : array();
		$student['batches'] = $batch_time;
		echo json_encode($student);
	}
	function transfer_students(){
		$this->db->where_in('status',array('R','L'));
		$this->db->where('join_date >=','2022-04-01');
		$data = $this->db->get('admission');
		// last_query();die;
		$rows = $data->result_array();
		//echo '<pre>';print_r($rows);die;
		$cnt = 1;
		$rno = array();
		foreach($rows as $row){
			// $rno[] = $row['regno'];
			// $row['new_rno'] = $cnt;
			// $this->db->insert('c_admission',$row);
			// $adm_no = $this->db->insert_id();
			// if($adm_no>0){

			// }
			// $cnt++;
		}

		$this->db->where_in('reg_no',$rno);
		$qry = $this->db->get('fees');
		$fees_rows = $qry->result_array();
		last_query();die;

	}
	function transfer_students2(){
		$this->db->where_in('status',array('D','J','P','C','T'));
		$data = $this->db->get('admission');
		// last_query();die;
		$rows = $data->result_array();
		// echo '<pre>';print_r($rows);die;
		$cnt = 1;
		$rno = array();
		foreach($rows as $row){
			$rno[] = $row['regno'];
			// $row['new_rno'] = $cnt;
			$this->db->insert('tbl_counselling',$row);
			$adm_no = $this->db->insert_id();
			if($adm_no>0){

			}
			$cnt++;
		}

		$this->db->where_in('reg_no',$rno);
		$qry = $this->db->get('fees');
		$fees_rows = $qry->result_array();
		last_query();die;
	}
	function encode_student(){
		//$this->db->where_in('status',array('D','J','P','C','T'));
		$data = $this->db->get('tbl_counselling');
		// last_query();die;
		$rows = $data->result_array();
		// echo '<pre>';print_r($rows);die;
		$cnt = 1;
		$rno = array();
		foreach($rows as $row){
			$total_fees = $row['total_fees'];			
			$array = str_split($total_fees);
			// pre($array);
			$encode_str = "";
			foreach($array as $k=>$val){
				$encode_str.=getString(rand(1,3));
				$encode_str.=$val;
			}
			$arr_save = array('offer_code'=>encodeString($encode_str));
			$this->db->where('id',$row['id']);
			$this->db->update('tbl_counselling',$arr_save);
			// echo $encode_str;
		  	// die;
		}
	}
	function encode_student2(){
		//$this->db->where_in('status',array('D','J','P','C','T'));
		$data = $this->db->get('admission');
		// last_query();die;
		$rows = $data->result_array();
		// echo '<pre>';print_r($rows);die;
		$cnt = 1;
		$rno = array();
		foreach($rows as $row){
			$total_fees = $row['total_fees']/100;			
			$array = str_split($total_fees);
			
			$encode_str = "";
			foreach($array as $k=>$val){
				$encode_str.=getString(rand(1,3));
				$encode_str.=$val;
			}
			$arr_save = array('offer_code'=>encodeString($encode_str));
			$this->db->where('id',$row['id']);
			$this->db->update('admission',$arr_save);
			
		}
	}

	function update_fees_table(){
		$data = $this->db->get('admission');
		$rows = $data->result_array();
		$cnt = 1;
		$rno = array();
		foreach($rows as $row){
			$old_reg = $row['regno_old'];			
			$new_reg = $row['regno'];			
			$this->db->where('reg_no',$old_reg);
			$this->db->update('fees',array('reg_no'=>$new_reg,'student_name'=>$row['student_name']));
			
			$this->db->where('reg_no',$old_reg);
			$this->db->update('tbl_dipak',array('reg_no'=>$new_reg,'student_name'=>$row['student_name']));
		}
	}

	function update_installments(){
		// $this->db->where_in('regno',array(130));
		$data = $this->db->get('admission');
		$rows = $data->result_array();
		$cnt = 1;
		$rno = array();
		foreach($rows as $row){
			$new_reg = $row['regno'];			
			$this->db->where('reg_no',$new_reg);
			$qry1 = $this->db->get('fees');
			$data1 = $qry1->result_array();

			$this->db->where('reg_no',$new_reg);
			$qry2 = $this->db->get('tbl_dipak');
			$data2 = $qry2->result_array();
			$all_data = array_merge($data1,$data2);

			usort($all_data, 'date_compare');
			$old_installments = json_decode($row['installment_detail'],true);
			//pre($data1);pre($data2);
			// pre($all_data);die;
			// pre($old_installments);
			$new_installment_detail = array();
			foreach($old_installments as $k=>$sub_row){
				if(isset($all_data[$k])){
					$sub_row['amount'] = $all_data[$k]['amount'];
					$sub_row['date'] = $all_data[$k]['date'];
					$sub_row['status'] = 1;
				}else{
					$sub_row['amount'] = $sub_row['amount']/10;
				}
				$new_installment_detail[] = $sub_row;
				// $sub_row = 
			}
			$json =json_encode($new_installment_detail);
			$this->db->where('regno',$new_reg);
			$this->db->update('admission',array('installment_detail'=>$json));
			// pre($new_installment_detail);
			// die;
		}
	}
	function update_exam_leave_table(){
		$data = $this->db->get('admission');
		$rows = $data->result_array();
		$cnt = 1;
		$rno = array();
		foreach($rows as $row){
			$old_reg = $row['regno_old'];			
			$new_reg = $row['regno'];			
			$this->db->where('regno',$old_reg);
			$this->db->where('created_at <=','2023-08-07');
			$this->db->update('course_attendence',array('regno'=>$new_reg));
			
			$this->db->where('regno',$old_reg);
			$this->db->where('exam_date <=','2023-08-07');
			$this->db->update('student_test',array('regno'=>$new_reg));

			$this->db->where('regno',$old_reg);
			$this->db->where('exam_date <=','2023-08-07');
			$this->db->update('student_tracking',array('regno'=>$new_reg));
		}
	}
	function split_students(){
		$this->db->where_not_in('regno',array(3,4,6,10,12,13,15,16,18,19,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,41,42,43,44,46,47,49,50,51,53,55,57,58,59,60,61,62,66,67,68,69,70,71,74,75,76,78,79,81,82,84,85,86,87,88,90,91,92,93,95,96,97,98,99,100,102,103,104,105,106,107,108,109,110,111,113,114,115,118,119,120,121,122,123,124,125,126,127,128,131,132,134,135,136,137,139,140,141,142,143,144,146,147,149,150,151,152,155,156,157,158,159,160,161,162,163,165,166,167,168,169,171,172,174,175,176,177,178,180,181,182,183,184,185,186,187,188,189,190,192,195,197,198,199,200,202,203,204,205,208,209,211,214,215,217,218,219,220,221,222,224,227,228,229,230,231,232,233,234,236,237,238,241,242,243,244,245,249,250,253,257,259,260,262,263,264,265,266,267,268,271,272,273,274,275,276,277,279,284,287,288,289,290,291,292,293,296,301,302,303,304,307,308,309,310,312,313,314,315,319,320,322,325,326,327,329,332,333,334,338,339,340,341,342,343,346,347,350,352,362,364,365,366,367,380,382,383,384,385,387,388,391,569,594,596,599,600,601,603,605,610,613,614,618,621,623,624,627,628,630,636,639,641,642,644,645,646,647,649,650,651,652,654,655,656,658,659,664,665,667,668,673,674,677,679,680,683,686,688,691,693,695,696,698,701,703,710,714,718,721,724,725,727,728,731,733,735,737,739,742,744,745,749,750,751,757,759,760,764,765,770,773,774,776,777,778,780,781,782,784,785,786,788,790,792,794,795,800,801,803,804,805,806,807,808,809,812,813,814,815,816,817,818,820,821,822,823,825,829,831,832,834,835,836,837,838,839,840,841,842,847,848,849,851,856,857,858,860,865,866,867,868,869,870,871,874,875,876,879,881,882,885,886,892,893,899,900,905,906,907,908,909,910,912,916,917,920,923,926,933,936,937,938,939,940,942,945,947,949,950,951,952,954,955,956,958,959,964,965,967,968,971,972,973,976,977,978,979,982,985,988,992,993,997,1001,1003,1011,1013,1014,1015,1016,1022,1023,1029,1030,1032,1035,1042));
		
		$data = $this->db->get('admission');
		// last_query();die;
		$rows = $data->result_array();
		//echo '<pre>';print_r($rows);die;
		$cnt = 1;
		$rno = array();
		foreach($rows as $row){
			$row['id'] = $cnt;
			$this->db->insert('admission_reg',$row);
			$cnt++;
		}
		echo "done";
		
	}
	function split_fees(){
		$this->db->where_in('reg_no',array(3,4,6,10,12,13,15,16,18,19,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,41,42,43,44,46,47,49,50,51,53,55,57,58,59,60,61,62,66,67,68,69,70,71,74,75,76,78,79,81,82,84,85,86,87,88,90,91,92,93,95,96,97,98,99,100,102,103,104,105,106,107,108,109,110,111,113,114,115,118,119,120,121,122,123,124,125,126,127,128,131,132,134,135,136,137,139,140,141,142,143,144,146,147,149,150,151,152,155,156,157,158,159,160,161,162,163,165,166,167,168,169,171,172,174,175,176,177,178,180,181,182,183,184,185,186,187,188,189,190,192,195,197,198,199,200,202,203,204,205,208,209,211,214,215,217,218,219,220,221,222,224,227,228,229,230,231,232,233,234,236,237,238,241,242,243,244,245,249,250,253,257,259,260,262,263,264,265,266,267,268,271,272,273,274,275,276,277,279,284,287,288,289,290,291,292,293,296,301,302,303,304,307,308,309,310,312,313,314,315,319,320,322,325,326,327,329,332,333,334,338,339,340,341,342,343,346,347,350,352,362,364,365,366,367,380,382,383,384,385,387,388,391,569,594,596,599,600,601,603,605,610,613,614,618,621,623,624,627,628,630,636,639,641,642,644,645,646,647,649,650,651,652,654,655,656,658,659,664,665,667,668,673,674,677,679,680,683,686,688,691,693,695,696,698,701,703,710,714,718,721,724,725,727,728,731,733,735,737,739,742,744,745,749,750,751,757,759,760,764,765,770,773,774,776,777,778,780,781,782,784,785,786,788,790,792,794,795,800,801,803,804,805,806,807,808,809,812,813,814,815,816,817,818,820,821,822,823,825,829,831,832,834,835,836,837,838,839,840,841,842,847,848,849,851,856,857,858,860,865,866,867,868,869,870,871,874,875,876,879,881,882,885,886,892,893,899,900,905,906,907,908,909,910,912,916,917,920,923,926,933,936,937,938,939,940,942,945,947,949,950,951,952,954,955,956,958,959,964,965,967,968,971,972,973,976,977,978,979,982,985,988,992,993,997,1001,1003,1011,1013,1014,1015,1016,1022,1023,1029,1030,1032,1035,1042));
		$qry = $this->db->get('tbl_dipak');
		$fees_rows = $qry->result_array();
		$cnt = 1;
		// pre($fees_rows);die;
		foreach($fees_rows as $row){
			$row['id'] = $cnt;
			$this->db->insert('tbl_dipak_hk',$row);
			$cnt++;
		}
		echo "done";
		
	}
	function split_due_fees(){
		$this->db->where_not_in('regno',array(3,4,6,10,12,13,15,16,18,19,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,41,42,43,44,46,47,49,50,51,53,55,57,58,59,60,61,62,66,67,68,69,70,71,74,75,76,78,79,81,82,84,85,86,87,88,90,91,92,93,95,96,97,98,99,100,102,103,104,105,106,107,108,109,110,111,113,114,115,118,119,120,121,122,123,124,125,126,127,128,131,132,134,135,136,137,139,140,141,142,143,144,146,147,149,150,151,152,155,156,157,158,159,160,161,162,163,165,166,167,168,169,171,172,174,175,176,177,178,180,181,182,183,184,185,186,187,188,189,190,192,195,197,198,199,200,202,203,204,205,208,209,211,214,215,217,218,219,220,221,222,224,227,228,229,230,231,232,233,234,236,237,238,241,242,243,244,245,249,250,253,257,259,260,262,263,264,265,266,267,268,271,272,273,274,275,276,277,279,284,287,288,289,290,291,292,293,296,301,302,303,304,307,308,309,310,312,313,314,315,319,320,322,325,326,327,329,332,333,334,338,339,340,341,342,343,346,347,350,352,362,364,365,366,367,380,382,383,384,385,387,388,391,569,594,596,599,600,601,603,605,610,613,614,618,621,623,624,627,628,630,636,639,641,642,644,645,646,647,649,650,651,652,654,655,656,658,659,664,665,667,668,673,674,677,679,680,683,686,688,691,693,695,696,698,701,703,710,714,718,721,724,725,727,728,731,733,735,737,739,742,744,745,749,750,751,757,759,760,764,765,770,773,774,776,777,778,780,781,782,784,785,786,788,790,792,794,795,800,801,803,804,805,806,807,808,809,812,813,814,815,816,817,818,820,821,822,823,825,829,831,832,834,835,836,837,838,839,840,841,842,847,848,849,851,856,857,858,860,865,866,867,868,869,870,871,874,875,876,879,881,882,885,886,892,893,899,900,905,906,907,908,909,910,912,916,917,920,923,926,933,936,937,938,939,940,942,945,947,949,950,951,952,954,955,956,958,959,964,965,967,968,971,972,973,976,977,978,979,982,985,988,992,993,997,1001,1003,1011,1013,1014,1015,1016,1022,1023,1029,1030,1032,1035,1042));
		$qry = $this->db->get('due_payments');
		$fees_rows = $qry->result_array();
		$cnt = 1;
		// pre($fees_rows);die;
		foreach($fees_rows as $row){
			$row['id'] = $cnt;
			$this->db->insert('due_payments_reg',$row);
			$cnt++;
		}
		echo "done";
		
	}
	function update_reg_adm(){
		$data = $this->db->get('admission_reg');
		$rows= $data->result_array();
		foreach($rows as $row){
			$old_no = $row['regno_old'];
			$new_no = $row['regno'];
			// $this->db->where('reg_no_old',$old_no);
			// $this->db->update('fees_reg',array('reg_no'=>$new_no));

			// $this->db->where('reg_no_old',$old_no);
			// $this->db->update('tbl_dipak_reg',array('reg_no'=>$new_no));
			$this->db->where('regno',$old_no);
			$this->db->update('due_payments_reg',array('regno'=>$new_no));
		}
		echo 'Done';
		// pre($rows);die;
	}
	function update_hk_adm(){
		$data = $this->db->get('admission_hk');
		$rows= $data->result_array();
		foreach($rows as $row){
			$old_no = $row['regno_old'];
			$new_no = $row['regno'];
			$this->db->where('reg_no_old',$old_no);
			$this->db->update('fees_hk',array('reg_no'=>$new_no));

			$this->db->where('reg_no_old',$old_no);
			$this->db->update('tbl_dipak_hk',array('reg_no'=>$new_no));

			$this->db->where('regno',$old_no);
			$this->db->update('due_payments_hk',array('regno'=>$new_no));
		}
		echo 'Done';
		// pre($rows);die;
	}


}

