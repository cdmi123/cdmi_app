<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class College_admission extends CI_Controller {
	var $perpage=50;
	function __construct()
	{
		parent::__construct();	
		if(!$this->session->userdata('user_login')){
			redirect('staff-login');
		}
		if($this->session->userdata('user_role')==2){
			redirect('staff-login');	
		}
		$this->load->model('College_admission_model');
		$this->load->model('College_fees_model');
		$this->load->model('Admission_model');
		$this->load->model('Exam_model');
		$this->load->library('form_validation');	
	}
	public function index($id=0)
	{
		$arr = array();
		$arr['college_course'] = $this->db->get('college_course')->result_array();
		$arr['course_streams'] = $this->db->get('course_streams')->result_array();
		$arr['universities'] = $this->db->get('universities')->result_array();
		$arr['institutes'] = $this->db->get('institute_master')->result_array();
		//$arr['course_content'] = $this->Admission_model->get_course_content();
		$arr['admin'] = $this->Admission_model->get_admin_data();
		$arr['reg_no'] = $this->db->order_by('regno',"desc")->limit(1)->get('college_admission') ->row();


		if($this->input->post())
		{
			$create_by = $this->session->userdata('user_login');
			$rno =$arr['reg_no']->regno+1;// $this->input->post('regno');
			$inq_no = $this->input->post('inq_no');
			$roll_no = $this->input->post('roll_no');
			$fname = trim($this->input->post('fname'));
			$mname = trim($this->input->post('mname'));
			$lname = trim($this->input->post('lname'));
			$full_name = $fname.' '.$mname.' '.$lname;

			$mother_name = $this->input->post('mother_name');
			$father_name = $this->input->post('lname');
			$personal_mobile_no = $this->input->post('personal_mobile_no');
			$father_mobile_no = $this->input->post('father_mobile_no');
			$home_mobile_no = $this->input->post('home_mobile_no');
			$whatsapp_no = $this->input->post('whatsapp_no');
			$parent_whatsapp_no = $this->input->post('parent_whatsapp_no');
			$address = $this->input->post('address');
			$email = $this->input->post('email');
			$birth_date = $this->input->post('birth_date');
			$gender = $this->input->post('gender');
			$adhar_no = $this->input->post('adhar_no');
			$religion = $this->input->post('religion');
			$cast_category = $this->input->post('cast_category');
			$cast = $this->input->post('cast');
			$last_edu = $this->input->post('last_edu');

			$school_name = $this->input->post('school_name');
			$passing_year = $this->input->post('passing_year');
			$percentage = $this->input->post('percentage');
			$percentile = $this->input->post('percentile');
			$seat_no = $this->input->post('seat_no');
			$college_course = $this->input->post('college_course');
			$course_stream = $this->input->post('course_stream');
			$college_mode = $this->input->post('college_mode');
			$total_fees = $this->input->post('total_fees');

			$per_sem_fees = $this->input->post('per_sem_fees');
			$start_session = $this->input->post('start_session');
			$end_session = $this->input->post('end_session');
			$class_name = $this->input->post('class_name');
			$university = $this->input->post('university');
			$exam_center = $this->input->post('exam_center');
			$institute_name = $this->input->post('institute_name');
			$reference = $this->input->post('reference');
			$reference_name = $this->input->post('reference_name');
			$join_date = $this->input->post('join_date');
			$enrollment_no = $this->input->post('enrollment_no');
			$multimedia_course = $this->input->post('multimedia_course');
			
			$reference_name = $this->input->post('reference_name') ? $this->input->post('reference_name') : "";
			$doc = $this->input->post('document_list');
			@$document_list = implode(',', $doc);
			$data = array('regno'=>$rno,'inq_no'=>$inq_no,'roll_no'=>$roll_no,'student_name'=>strtoupper($full_name),'father_name'=>strtoupper($father_name),'mother_name'=>strtoupper($mother_name),'personal_mobile_no'=>$personal_mobile_no,'father_mobile_no'=>$father_mobile_no,'home_mobile_no'=>$home_mobile_no,'address'=>strtoupper($address),'email'=>$email,'birth_date'=>$birth_date,'gender'=>strtoupper($gender),'adhar_no'=>$adhar_no,'religion'=>strtoupper($religion),'cast_category'=>strtoupper($cast_category),'cast'=>strtoupper($cast),'last_edu'=>strtoupper($last_edu),'school_name'=>strtoupper($school_name),'passing_year'=>$passing_year,'percentage'=>$percentage,'percentile'=>$percentile,'seat_no'=>$seat_no,'college_course'=>strtoupper($college_course),'course_stream'=>$course_stream,'college_mode'=>strtoupper($college_mode),'total_fees'=>$total_fees,'per_sem_fees'=>$per_sem_fees,'start_session'=>$start_session,'end_session'=>$end_session,'university'=>$university,'exam_center'=>$exam_center,'institute_name'=>$institute_name,'reference'=>$reference,'reference_name'=>strtoupper($reference_name),'join_date'=>$join_date,'document_list'=>$document_list,'status'=>'R','class_name'=>$class_name,'enrollment_no'=>strtoupper($enrollment_no),'whatsapp_no'=>$whatsapp_no,'parent_whatsapp_no'=>$parent_whatsapp_no,'multimedia_course'=>$multimedia_course,'create_by'=>$create_by);
			if(!empty($_FILES['image']['name'])){
				$config['allowed_types'] = 'jpg|png|gif|jpeg';
				$config['upload_path'] = 'upload/college_student_photo';
				$this->load->library('upload',$config);
				if($this->upload->do_upload('image'))
				{
					//echo 'hello';die;
					$file_data = $this->upload->data();
					$data['image'] = $file_data['file_name'];
				}
			}
			$this->db->insert('college_admission',$data);
			$adm_no = $this->db->insert_id();
			if($adm_no>0){
				if($inq_no != "" && $inq_no>0){
					$up=array('status'=>'A');
					$this->db->where('id',$inq_no);
					$this->db->update('inq_offline',$up);
				}
				$cnt_doc_rec = $this->db->get_where('university_docs',array('regno'=>$adm_no))->num_rows();
				//echo $cnt_doc_rec;die;
				if($cnt_doc_rec==0){
					$this->db->insert('university_docs',array('regno'=>$adm_no));
				}
				redirect('College_admission/view_college_admission');
			}
		}
		$this->load->view('college_admission_form',$arr);
	}

	function view_college_admission()
	{
		$admission = array();
		$search_by = "";
		$search_keyword = "";
		$this->db->select('course_name');
		$admission['college_course'] = $this->db->get('college_course')->result_array();

		
		$this->db->select('code');
		$admission['college_university'] = $this->db->get('universities')->result_array();

		$this->db->select('institute_name');
		$admission['college_institutes'] = $this->db->get('institute_master')->result_array();

		$this->db->distinct();
		$this->db->select('start_session');
		$this->db->where("start_session !=","");
		$this->db->order_by('start_session','asc');
		$admission['st_session'] = $this->db->get('college_admission')->result_array();

		$this->db->distinct();
		$this->db->select('end_session');
		$this->db->where("end_session !=","");
		$this->db->order_by('end_session','asc');
		$admission['en_session'] = $this->db->get('college_admission')->result_array();
		
		$search_by = "";
		$search_keyword = "";
		$start=0;
		$total=$this->College_admission_model->row_count(); 
		$base_url = site_url('College_admission/ajax_search_students');
		$pagination =pagination_new($total,$this->perpage,$base_url,3);
		
		$admission['admission_data'] = $this->College_admission_model->view_college_admission_data($search_by,$search_keyword,$this->perpage,$start);
		$admission['pagination'] = $pagination;
		$admission['perpage'] = $this->perpage;
		$admission['found_results'] = $total;

		$this->db->where('status',1);
		$this->db->where('branch_id',$this->session->userdata('branch_id'));
		$admission['view_faculty'] = $this->db->get('admin')->result_array();
	
		$this->load->view('view_college_admission',$admission);
	}


	function view_student($id=0)
	{
		$this->db->where('regno',$id);
		$student = $this->db->get('college_admission')->row_array();

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
        $arr['student'] =$student;
		$this->db->where('reg_no',$id);
		$arr['installent'] = $this->db->get('college_fees')->result_array();
		$this->db->where('reg_no',$id);
		$arr['exam_fees'] = $this->db->get('exam_fees')->result_array();
		$this->db->where('reg_no',$id);
		$arr['certificate_fees'] = $this->db->get('certificate_fees')->result_array();
		$this->db->where('reg_no',$id);
		$arr['payment'] = $this->db->get('university_payment')->result_array();
		
		$this->db->where('regno',$id);
		$arr['leave'] = $this->db->get('attendence_reason')->result_array();

		$this->db->where('regno',$id);
		$this->db->select('college_test.*,admin.name as faculty_name');
		$this->db->join('admin','admin.id=college_test.faculty_id','left');
		$arr['progress_report'] = $this->db->get('college_test')->result_array();

		$this->db->where('regno',$id);
		$this->db->select('collage_student_complain.*,admin.name as faculty_name');
		$this->db->join('admin','admin.id=collage_student_complain.faculty_id','left');
		$arr['Complain_report'] = $this->db->get('collage_student_complain')->result_array();

		$this->load->view('view_college_student_detail',$arr);
	}


	function ajax_search_students()
	{
		$perpage=$this->input->post('perpage') ? $this->input->post('perpage') : $this->perpage;
		$start=$this->uri->segment(3);
		// //echo '<pre>';print_r($this->input->post());die;
		// $year = $this->input->post('year');
		// $month = $this->input->post('month');
		// $course = $this->input->post('course');
		
		$course_status = $this->input->post('course_status');
		$mode = $this->input->post('mode');
		$search_by = $this->input->post('search_by');
		$search_keyword = $this->input->post('search_keyword');
		$college_course = $this->input->post('college_course');
		$university = $this->input->post('university');
		$institute_name = $this->input->post('institute_name');
		$college_year = $this->input->post('college_year');
		$start_session = $this->input->post('start_session');
		$end_session = $this->input->post('end_session');
		$division = $this->input->post('division');
		$gender = $this->input->post('gender');


		//filter by college year
		if($college_year!="all" and $college_year!= ""){
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
			$this->db->like('personal_mobile_no',$search_keyword);
			$this->db->or_like('father_mobile_no',$search_keyword);
			$this->db->or_like('home_mobile_no',$search_keyword);
			$this->db->group_end();
		}
		if($division!='')
		{
			$this->db->where('class_name',$division);
		}
		if($gender!='')
		{
			$this->db->where('gender',$gender);
		}
		if($mode!='')
		{
			$this->db->where('college_mode',$mode);
		}

		if($college_course!='')
		{
			$this->db->where('college_course',$college_course);
		}

		if($university!='')
		{
			$this->db->like('university',$university);
		}
		if($institute_name!='')
		{
			$this->db->where('institute_name',$institute_name);
		}

		if($start_session!='')
		{
			$this->db->where('start_session',$start_session);
		}

		if($end_session!='')
		{
			$this->db->where('end_session',$end_session);
		}
		if($course_status!='')
		{
			$this->db->like('status',$course_status);
		}
		$this->db->order_by('id','desc');
		$total = $this->db->count_all_results('college_admission', FALSE);
		$this->db->limit($perpage,$start);
		$data = $this->db->get();
		$arr['admission_data'] = $data->result_array();

		$base_url = site_url('College_admission/ajax_search_students');
		$pagination =pagination_new($total,$this->perpage,$base_url,3);
		$html = $this->load->view('ajax_search_college_admission',$arr,true);
				//$this->db->where('date');
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
	// function edit_form($id=0)
	// {
	// 	$arr = array();

	// 	if($id)
	// 	{
	// 		$this->db->where('id',$id);
	// 		$data1 = $this->db->get('admission')->row_array();
	// 		$arr['update_data'] = $data1;
		
	// 		$name_arr = explode(' ',$data1['student_name']);
	// 		$arr['fname'] = $name_arr[0];
	// 		$arr['course_content_arr'] = explode(',',$arr['update_data']['course_content']);
	// 		// print_r($course_content_arr);die;
	// 	}

	// 	$arr['course'] = $this->Admission_model->get_course();
	// 	//$arr['course_content'] = $this->Admission_model->get_course_content();
	// 	$arr['admin'] = $this->Admission_model->get_admin_data();


	// 	if($this->input->post())
	// 	{
	// 		//echo '<pre>';print_r($this->input->post());die;

	// 		$rno = $this->input->post('regno');
	// 		$fname = $this->input->post('fname');
	// 		$mname = $this->input->post('mname');
	// 		$lname = $this->input->post('lname');
	// 		$course = $this->input->post('course');
	// 		$course_con = $this->input->post('course_content');
	// 		@$course_content = implode(',', $course_con);
	// 		$total_fees = $this->input->post('total_fees');
			
	// 		$join_date = $this->input->post('join_date');
	// 		$birth_date = $this->input->post('birth_date');
	// 		$contact = $this->input->post('contact');
	// 		$father_contact = $this->input->post('father_contact');
	// 		$address = $this->input->post('father_contact');
	// 		$reference = $this->input->post('reference');
	// 		$reference_name = $this->input->post('reference_name');
	// 		$batch = $this->input->post('batch_time');
	// 		@$batch_time = implode(',', $batch);
	// 		$sitting = $this->input->post('sitting');
	// 		$pcno = $this->input->post('pcno');
	// 		$running_topic = $this->input->post('running_topic');
	// 		$faculty_name = $this->input->post('faculty_name');

	// 		$full_name = $fname.' '.$mname.' '.$lname;

	// 		@$reference_name = "";
	// 		if($reference=='other' || $reference=='student')
	// 		{
	// 			@$reference_name = $_POST['reference_name'];
	// 		}
	// 		else
	// 		{
	// 			@$reference_name = "";
	// 		}
	// 		if($pcno=='')
	// 		{
	// 			$pcno = 0;
	// 		}

	// 		$data = array('regno'=>$rno,'student_name'=>$full_name,'course'=>$course,'course_content'=>$course_content,'total_fees'=>$total_fees,'join_date'=>$join_date,'birth_date'=>$birth_date,'contact'=>$contact,'father_contact'=>$father_contact,'address'=>$address,'reference'=>$reference,'reference_name'=>$reference_name,'batch_time'=>$batch_time,'sitting'=>$sitting,'pcno'=>$pcno,'running_topic'=>$running_topic,'faculty_name'=>$faculty_name);
	// 		$this->form_validation->set_rules('fname','fname','required');
	// 		$this->form_validation->set_rules('mname','mname','required');
	// 		$this->form_validation->set_rules('lname','lname','required');
	// 		$this->form_validation->set_rules('course','course','required');
	// 		$this->form_validation->set_rules('course_content[]','course','required');
	// 		$this->form_validation->set_rules('total_fees','course','required|numeric');
	// 		$this->form_validation->set_rules('join_date','course','required');
	// 		$this->form_validation->set_rules('birth_date','course','required');
	// 		$this->form_validation->set_rules('contact','Contact','required|numeric|exact_length[10]|regex_match[/^[0-9]{10}$/]');
	// 		$this->form_validation->set_rules('father_contact','Contact','required|numeric|exact_length[10]|regex_match[/^[0-9]{10}$/]');
	// 		$this->form_validation->set_rules('address','course','required');
	// 		$this->form_validation->set_rules('reference','course','required');
	// 		$this->form_validation->set_rules('batch_time[]','course','required');
	// 		$this->form_validation->set_rules('sitting','course','required');
	// 		$this->form_validation->set_rules('running_topic','course','required');
	// 		$this->form_validation->set_rules('faculty_name','course','required');

	// 		if ($this->form_validation->run() == FALSE)
	// 		{
	// 			$arr['name'] = set_value('fname');
	// 			$arr['contact'] = set_value('contact');
	// 			$arr['reference'] = set_value('reference');
	// 		}
	// 		else
	// 		{

	// 			$config['allowed_types'] = 'jpg|png|gif|jpeg';
	// 			$config['upload_path'] = 'upload/student_photo';
	// 			$this->load->library('upload',$config);
	// 			if($this->upload->do_upload('image'))
	// 			{
	// 				//echo 'hello';die;
	// 				$file_data = $this->upload->data();
	// 				$data['image'] = $file_data['file_name'];
	// 			}
	// 			$this->Admission_model->insert_admission_data($data);
	// 		}
	// 	}
	// 	$this->load->view('edit_admission_form',$arr);
	// }



	function update_adm($id)
	{
		$this->db->where('id',$id);
		$admission_info = $this->db->get('college_admission')->row_array();
		$res['data'] = $admission_info;
		if($this->input->post())
		{
			$update_by = $this->session->userdata('user_login');
			$roll_no = $this->input->post('roll_no');
			$full_name = $this->input->post('student_name');
			$mother_name = $this->input->post('mother_name');
			$father_name = $this->input->post('lname');
			$personal_mobile_no = $this->input->post('personal_mobile_no');
			$father_mobile_no = $this->input->post('father_mobile_no');
			$home_mobile_no = $this->input->post('home_mobile_no');
			$whatsapp_no = $this->input->post('whatsapp_no') ? $this->input->post('whatsapp_no') : '';
			$parent_whatsapp_no = $this->input->post('parent_whatsapp_no') ? $this->input->post('parent_whatsapp_no') : '';
			$address = $this->input->post('address');
			$email = $this->input->post('email');
			$birth_date = $this->input->post('birth_date');
			$gender = $this->input->post('gender');
			$adhar_no = $this->input->post('adhar_no');
			$religion = $this->input->post('religion');
			$cast_category = $this->input->post('cast_category');
			$cast = $this->input->post('cast');
			$last_edu = $this->input->post('last_edu');

			$school_name = $this->input->post('school_name');
			$passing_year = $this->input->post('passing_year');
			$percentage = $this->input->post('percentage');
			$percentile = $this->input->post('percentile');
			$seat_no = $this->input->post('seat_no');
			$college_course = $this->input->post('college_course');
			$course_stream = $this->input->post('course_stream');
			$college_mode = $this->input->post('college_mode');
			$total_fees = $this->input->post('total_fees');

			$per_sem_fees = $this->input->post('per_sem_fees');
			$start_session = $this->input->post('start_session');
			$end_session = $this->input->post('end_session');
			$class_name = $this->input->post('class_name');
			$university = $this->input->post('university');
			$exam_center = $this->input->post('exam_center');
			$institute_name = $this->input->post('institute_name');
			$reference = $this->input->post('reference');
			$reference_name = $this->input->post('reference_name');
			$join_date = $this->input->post('join_date');
			$enrollment_no = $this->input->post('enrollment_no');
			$reference_name = $this->input->post('reference_name') ? $this->input->post('reference_name') : "";
			$doc = $this->input->post('document_list');
			@$document_list = implode(',', $doc);
			$multimedia_course = $this->input->post('multimedia_course');
			$arr = array(
				'roll_no'=>$roll_no,
				'student_name'=>strtoupper($full_name),
				'father_name'=>strtoupper($father_name),
				'mother_name'=>strtoupper($mother_name),
				'personal_mobile_no'=>$personal_mobile_no,
				'father_mobile_no'=>$father_mobile_no,
				'home_mobile_no'=>$home_mobile_no,
				'address'=>strtoupper($address),
				'email'=>$email,
				'birth_date'=>$birth_date,
				'gender'=>strtoupper($gender),
				'adhar_no'=>$adhar_no,
				'religion'=>strtoupper($religion),
				'cast_category'=>strtoupper($cast_category),
				'cast'=>strtoupper($cast),
				'last_edu'=>strtoupper($last_edu),
				'school_name'=>strtoupper($school_name),
				'passing_year'=>$passing_year,
				'percentage'=>$percentage,
				'percentile'=>$percentile,
				'seat_no'=>$seat_no,
				'college_course'=>strtoupper($college_course),
				'course_stream'=>$course_stream,
				'college_mode'=>strtoupper($college_mode),
				'total_fees'=>$total_fees,
				'per_sem_fees'=>$per_sem_fees,
				'start_session'=>$start_session,
				'end_session'=>$end_session,
				'university'=>$university,
				'exam_center'=>$exam_center,
				'institute_name'=>$institute_name,
				'reference'=>$reference,
				'reference_name'=>strtoupper($reference_name),
				'join_date'=>$join_date,
				'document_list'=>$document_list,
				'status'=>'R',
				'class_name'=>$class_name,
				'enrollment_no'=>strtoupper($enrollment_no),
				'whatsapp_no'=>$whatsapp_no,
				'parent_whatsapp_no'=>$parent_whatsapp_no,
				'multimedia_course'=>$multimedia_course ,
				'update_by'=>$update_by
			);
			if(!empty($_FILES['image']['name'])){
				$config['allowed_types'] = 'jpg|png|gif|jpeg';
				$config['upload_path'] = 'upload/college_student_photo';
				$this->load->library('upload',$config);
				if($this->upload->do_upload('image'))
				{
					$file_data = $this->upload->data();
					$arr['image'] = $file_data['file_name'];
				}else{
					$arr['image'] = $admission_info['image'];
				}
			}else{
				$arr['image'] = $admission_info['image'];
			}
			$this->db->where('regno',$id);
			$this->db->update('college_admission',$arr);
			redirect('College_admission/view_college_admission');

		}
		$res['college_course'] = $this->db->get('college_course')->result_array();
		$res['course_streams'] = $this->db->get('course_streams')->result_array();
		$res['universities'] = $this->db->get('universities')->result_array();
		$res['institutes'] = $this->db->get('institute_master')->result_array();
		$this->load->view('update_college_admission',$res);
	}
	function get_student_info(){
		$regno = $this->input->post('regno');
		$this->db->select('university_docs.*,college_admission.student_name,college_admission.college_course,college_admission.course_stream');
		$this->db->where('college_admission.id',$regno);
		$this->db->join('university_docs','university_docs.regno=college_admission.regno','left');
		$admission_info = $this->db->get('college_admission')->row_array();
		echo json_encode($admission_info);
	}
	function add_uni_docs($regno=0){
		if($this->input->post()){
			$regno = $this->input->post('regno');
			$mode = $this->input->post('mode');
			$marksheets = $this->input->post('marksheets');
			$provisional = $this->input->post('provisional');
			$transfer = $this->input->post('transfer');
			$migration = $this->input->post('migration');
			$degree = $this->input->post('degree');
			$transcript = $this->input->post('transcript');
			$extra_info = $this->input->post('extra_info');
			$moi = $this->input->post('moi');
			$lor = $this->input->post('lor');
			$arr = array('regno'=>$regno,'mode'=>$mode,'marksheets'=>$marksheets,'provisional'=>$provisional,'transfer'=>$transfer,'migration'=>$migration,'degree'=>$degree,'transcript'=>$transcript,'extra_info'=>$extra_info,'moi'=>$moi,'lor'=>$lor);
			$cnt_doc_rec = $this->db->get_where('university_docs',array('regno'=>$regno))->num_rows();
			if($cnt_doc_rec==0){
				$this->db->insert('university_docs',$arr);
			}else{
				$this->db->where('regno',$regno);
				$this->db->update('university_docs',$arr);
			}
			redirect('College_admission/uni_doc_report');
		}
		$data['regno'] = $regno;
		$this->load->view('add_uni_docs',$data);
	}
	function uni_doc_report(){
		$arr = array();
		
		$start=$this->uri->segment(3);

		$total=$this->College_admission_model->count_doc_records(); 
		$base_url=site_url('College_admission/uni_doc_report');
		$pagination =pagination_new($total,$this->perpage,$base_url,3);
		$arr['pagination'] = $pagination;
		$arr['doc_reports'] = $this->College_admission_model->get_doc_records($this->perpage,$start);
		$arr['perpage'] = $this->perpage;
		$this->load->view('uni_doc_report',$arr);	
	}
	function export_data(){
		$this->load->library('exportexcel');
		$getdata =$this->db->get('college_admission')->result();
		$fields = $this->db->list_fields('college_admission');
		$fields[] = "Paid";
		$fields[] = "Un-Paid";
		$all_info  = array();
		foreach ($getdata as $key => $value) {
			$reg_no = $value->regno;
			$paid_fees = $this->College_admission_model->get_paid_fees($reg_no);
			$paid = isset($paid_fees['paid']) ? $paid_fees['paid'] : 0;
			$unpaid = $value->total_fees - $paid;
			$value->paid = $paid;
			$value->unpaid = $unpaid;
			$all_info[] =$value;
		}
		$this->exportexcel->export_data($fields,$all_info,'college_students');
	}
	function print_form($id =0){
		$data =array();
		$this->db->where('id',$id);
		$data['student'] = $this->db->get('college_admission')->row_array();
		
		$this->load->view('print_admission',$data);	
	}
	function print_exam_form($id =0){
		$data =array();
		$this->db->where('id',$id);
		$stud_info = $this->db->get('college_admission')->row_array();
		$data['student'] = $stud_info;
		$cur_month = date("m");
		$cur_year = date("Y");
		$start_ses = $stud_info['start_session'];
		if($cur_month <= 5){
			$dif = $cur_year-$start_ses;			
		}else{
			$dif = ($cur_year-$start_ses)+1;
		}
		if($stud_info['university']=="SRK"){
			if($dif==1){
				$next_year = $start_ses+1;
				$exam_name = $stud_info['college_course']." Sem 1 & 2 (".$start_ses.'-'.$next_year.")";
			}else if($dif==2){
				$next_year = $start_ses+2;
				$exam_name = $stud_info['college_course']." Sem 3 & 4 (".$start_ses.'-'.$next_year.")";
			}else if($dif==3){
				$next_year = $start_ses+3;
				$exam_name = $stud_info['college_course']." Sem 5 & 6 (".$start_ses.'-'.$next_year.")";
			}
			$institute = "FACULTY OF COMPUTER APPLICATION";
		}else if($stud_info['university']=="SSIU"){
			$institute = "SWARRNIM SCHOOL OF BUSINESS";
			if($stud_info['start_session']==2022){
				$dif=2;
			}elseif($stud_info['start_session']==2021){
				$dif=4;
			}else{
				$dif=6;
			}
			
			$exam_name = "BCA Sem-".$dif;
		}else if($stud_info['university']=="SAURASHTRA"){
			$institute = $stud_info['institute_name'];
			if($stud_info['start_session']==2022){
				$dif=2;
			}elseif($stud_info['start_session']==2021){
				$dif=4;
			}else{
				$dif=6;
			}
			$exam_name = $stud_info['college_course'];
			if($stud_info['course_stream']!=""){
				$exam_name .= " ".$stud_info['course_stream'];
			}
			$exam_name .= " SEM-".$dif;
		}
		
		$data['exam_name'] = $exam_name;
		$data['institute_name'] =$institute;
		$this->db->where('sub_year',$dif);
		$this->db->where('university',$stud_info['university']);
		$data['subjects'] = $this->db->get('college_subjects')->result_array();
		//pre($data);die;
		$this->load->view('print_exam_form',$data);	
	}
	function update_status(){
		$regno = $this->input->post('regno');
		$status = $this->input->post('status');
		$note = $this->input->post('note');
		$status_date =date("Y-m-d",strtotime( $this->input->post('status_date')));
		if($regno!="" && $regno!=0){
			$this->db->where('regno',$regno);
			$this->db->update('college_admission',array('status'=>$status,'status_note'=>$note,'status_date'=>$status_date));	
			echo 'Successfully Changed.';
		}else{
			echo 'Reg No. Missing';
		}
	}
	function update_session()
	{
		$a = array();
		$data = $this->db->get('college_admission')->result_array();
		foreach ($data as $value) 
		{
			if($value['start_session']!= ""){
				$session = explode('-', $value['start_session']);
				if(sizeof($session)==2){
					$start_session = $session[0];
					$end_session = $session[1];
					$end_arr = array('start_session' =>$start_session,'end_session'=>$end_session);
					$this->db->where('id',$value['id']);
					$this->db->update('college_admission',$end_arr);
				}
			}
		}		
	}
	function get_ajax_student()
	{
		$regno = $this->input->post('regno');
		$this->db->where('regno',$regno);
		$this->db->select('regno,student_name,college_course');
		$student = $this->db->get('college_admission')->row_array();
		echo json_encode($student);
	}


	function export_Exam_data($college_year="",$class=""){

		$class_name = 'CLASS '.$class;
		$class_name_id = $college_year.'-'.$class_name;
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


		$this->load->library('exportexcel');
		if($start_sess!='')
			{
				$this->db->where('start_session',$start_sess);
			}
		$this->db->where('class_name',$class_name);
		$this->db->where('status','R');
		$this->db->where('college_mode','REG');
		$this->db->select('regno,student_name,personal_mobile_no,father_mobile_no');
		$getdata =$this->db->get('college_admission')->result();
		// echo last_query(); die();

		// $fields = $this->db->list_fields('college_admission');
		$fields = array();
		$fields[] = "";
		$fields[] = "Student_name";
		$fields[] = "Personal_mobile_no";
		$fields[] = "Father_mobile_no";
		$all_info = array();

		$Exam_array = array();
		foreach ($getdata as $key => $value) {
			$reg_no = $value->regno;

		$this->db->where('regno',$reg_no);
		$this->db->select('exam_topic,total_marks,obtained_marks');
		$get_marks_data =$this->db->get('college_test');

		$Exam_array[$reg_no] = $get_marks_data->num_rows();

			$this->db->where('regno',$reg_no);
			$this->db->select('exam_topic,total_marks,obtained_marks');
			$get_student_marks =$this->db->get('college_test')->result();

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
		$this->exportexcel->export_data($fields,$all_info,'college_students');		
	}


	function Complian_update()
	{
		$regno = $this->input->post('regno');
		$remark = $this->input->post('remark');
		$complian_date = $this->input->post('complain_date');
		$faculty_id = $this->input->post('faculty_id');

		$data = array('regno' =>$regno , 'remark'=>$remark,'complian_date'=>$complian_date,'faculty_id'=>$faculty_id);

		$this->db->insert('collage_student_complain',$data);

		echo "success";

	}

	function generate_QR($id=0)
	{
		$this->load->view('generate_qr',$id);
	}

	function college_dashboard(){
		$this->load->view('college_dashboard');
	}


}
