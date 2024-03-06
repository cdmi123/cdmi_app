<?php  
defined('BASEPATH') OR exit('No direct script access allowed');
class Test extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->model('Admin_model');
		if(!$this->session->userdata('user_login')){
			redirect('staff-login');
		}
	}
	function index($id=0)
	{

		// $res=array();
		// $res['data1']=$this->Admin_model->get_single_record($id);
		$this->db->where('regno',$id);
		$student = $this->db->get('admission')->row_array();
		$res['student'] = $student;
		$res['faculty'] = $this->db->get('admin')->result_array();
		if($this->input->post('submit'))
		{
			//echo '<pre>';print_r($this->input->post());die;
			//$faculty_id = $this->session->userdata('user_login');
			$regno=$this->input->post('regno');	
			$name=$this->input->post('name');
			$course=$this->input->post('course');
			$total_marks=$this->input->post('total_marks');
			$obtained_marks=$this->input->post('obtained_marks');
			$exam_date=$this->input->post('exam_date');
			$faculty_id=$this->input->post('faculty_id');
			$exam_topic=$this->input->post('exam_topic');
			$grade = ($obtained_marks / $total_marks) * 100;

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

			$arr=array('regno'=>$regno,'total_marks'=>$total_marks,'obtained_marks'=>$obtained_marks,'exam_date'=>$exam_date,'faculty_id'=>$faculty_id,'grade'=>$final_grade,'percentage'=>$grade,'exam_topic'=>$exam_topic);
			$this->db->insert('student_test',$arr);
		}
		$this->load->view('add_test',$res);
	}
			
	function course_test()
	{

		if($this->input->post('regno'))
		{
			$regno=$this->input->post('regno');	
			$exam_type=$this->input->post('exam_type');	
			$total_marks=$this->input->post('total_marks');
			$obtained_marks=$this->input->post('obtained_marks');
			$exam_date=$this->input->post('exam_date');
			$exam_remark=$this->input->post('exam_remark');

			$faculty_id=$this->input->post('faculty_id');
			$exam_topic=$this->input->post('exam_topic');
			$grade = ($obtained_marks / $total_marks) * 100;

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
			$arr=array('regno'=>$regno,'total_marks'=>$total_marks,'obtained_marks'=>$obtained_marks,'exam_date'=>$exam_date,'faculty_id'=>$faculty_id,'grade'=>$final_grade,'percentage'=>$grade,'exam_topic'=>$exam_topic,'exam_remark'=>$exam_remark);
			if($exam_type=="course"){
				$this->db->where('regno',$regno);
				$this->db->where('exam_topic',$exam_topic);
				$this->db->where('exam_date',date('Y-m-d'));
				$qry = $this->db->get('student_test');
				if($qry->num_rows()>0){
					$this->db->where('regno',$regno);
					$this->db->where('exam_topic',$exam_topic);
					$this->db->where('exam_date',date('Y-m-d'));
					$this->db->update('student_test',$arr);	
				}else{
					$this->db->insert('student_test',$arr);	
				}
				
			}else{
				$this->db->where('regno',$regno);
				$this->db->where('exam_topic',$exam_topic);
				$this->db->where('exam_date',date('Y-m-d'));
				$qry = $this->db->get('college_test');
				if($qry->num_rows()>0){
					$this->db->where('regno',$regno);
					$this->db->where('exam_topic',$exam_topic);
					$this->db->where('exam_date',date('Y-m-d'));
					$this->db->update('college_test',$arr);	
				}else{
					$this->db->insert('college_test',$arr);
				}
			}
			echo 'Successfully Submitted';
		}else{
			echo 'Reg No is missing.';
		}
		
	}
	function clg_test($id=0)
	{
		$this->db->where('regno',$id);
		$student = $this->db->get('college_admission')->row_array();
		$res['student'] = $student;
		$res['faculty'] = $this->db->get('admin')->result_array();
		if($this->input->post('submit'))
		{
			$regno=$this->input->post('regno');	
			$name=$this->input->post('name');
			$course=$this->input->post('course');
			$total_marks=$this->input->post('total_marks');
			$obtained_marks=$this->input->post('obtained_marks');
			$exam_date=$this->input->post('exam_date');
			$faculty_id=$this->input->post('faculty_id');
			$exam_topic=$this->input->post('exam_topic');
			$grade = ($obtained_marks / $total_marks) * 100;

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
			$arr=array('regno'=>$regno,'total_marks'=>$total_marks,'obtained_marks'=>$obtained_marks,'exam_date'=>$exam_date,'faculty_id'=>$faculty_id,'grade'=>$final_grade,'percentage'=>$grade,'exam_topic'=>$exam_topic);
			$this->db->insert('college_test',$arr);
		}
		$this->load->view('clg_test',$res);
	}
		

	function remove_test($type="course",$test_id=0,$regno=0){
		if($test_id>0){
			if($type=="course"){
				$this->db->where('id',$test_id);
				$this->db->delete('student_test');
				redirect('admission/view_student/'.$regno);
			}else{
				$this->db->where('id',$test_id);
				$this->db->delete('college_test');
				redirect('College_admission/view_student/'.$regno);
			}
		}
	}

	function view_exam()
	{
		
		// $this->load->model('Admin_model');
		$this->db->select('student_test.*,admin.name');
		$this->db->join('admin','admin.id =student_test.faculty_id');
		$data['arr']=$this->db->get('student_test')->result_array();
		$this->load->view('view_test',$data);
	}

	// function delete_data($id='')
	// {
	// 	$this->load->model('Admin_model');
	// 	$this->Admin_model->delete($id);
	// }



	// function demo()
	// {
	// 	$this->load->model('Admin_model');
	// 	$data['info'] = $this->Admin_model->get_page();
	// 	$this->load->view('demo1',$data);
	// }
	// function backup_db(){
	// 	$this->load->dbutil();
	// 	$prefs = array(     
	// 	    'format'      => 'zip',             
	// 	    'filename'    => 'management-'.date("Y-m-d-H-i-s").'.sql',
	// 	    'foreign_key_checks'=>FALSE
	// 	);
	// 	$backup =& $this->dbutil->backup($prefs); 
	// 	$db_name = 'backup-on-'. date("Y-m-d-H-i-s") .'.zip';
	// 	$save = 'backup/'.$db_name;
	// 	$this->load->helper('file');
	// 	write_file($save, $backup); 
	// 	$this->load->helper('download');
	// 	force_download($db_name, $backup);
	// }
	// function monthly_report_course(){
	// 	$output = [];
	// 	for($i=date("Y");$i>=2017;$i--){
	// 		$year = [];
	// 		for($j=1;$j<=12;$j++){
	// 			$query =  $this->db->query("SELECT COUNT(id) as count,SUM(amount) as total_amount,MONTHNAME(date) as month_name FROM fees WHERE YEAR(date) = '" . $i . "' and MONTH(date) = '" . $j . "' GROUP BY YEAR(date),MONTH(date)"); 
	// 			$record = $query->row_array();
	// 			if(empty($record)){
	// 				$record = array('total_amount'=>0,'month_name'=>date("F", strtotime($i."-".$j.'-1')),'count'=>0 );
	// 			}
	// 			$query1 =  $this->db->query("SELECT COUNT(id) as total_admission,MONTHNAME(join_date) as month_name FROM admission WHERE YEAR(join_date) = '" . $i . "' and MONTH(join_date) = '" . $j . "' GROUP BY YEAR(join_date),MONTH(join_date)"); 
	// 			$record1 = $query1->row_array();
	// 			if(!empty($record1)){
	// 				$record['total_admission'] = $record1['total_admission'];
	// 			}else{
	// 				$record['total_admission'] = 0;
	// 			}
				
				
	// 			$year[$j] = $record;
				
	// 		}
	// 		$output[$i] = $year;
			
	// 	}
	// 	$data['summary'] = $output;
	// 	//pre($data);die;
	// 	$this->load->view('view_summary',$data);
	// }	
	// function monthly_report(){
	// 	$output = [];
	// 	for($i=date("Y");$i>=2018;$i--){
	// 		$year = [];
	// 		for($j=1;$j<=12;$j++){
	// 			$query =  $this->db->query("SELECT COUNT(id) as count,SUM(amount) as total_amount,MONTHNAME(date) as month_name FROM college_fees WHERE YEAR(date) = '" . $i . "' and MONTH(date) = '" . $j . "' GROUP BY YEAR(date),MONTH(date)"); 
	// 			$record = $query->row_array();
	// 			if(empty($record)){
	// 				$record = array('total_amount'=>0,'month_name'=>date("F", strtotime($i."-".$j.'-1')),'count'=>0 );
	// 			}
	// 			$query1 =  $this->db->query("SELECT COUNT(id) as total_admission,MONTHNAME(join_date) as month_name FROM college_admission WHERE YEAR(join_date) = '" . $i . "' and MONTH(join_date) = '" . $j . "' GROUP BY YEAR(join_date),MONTH(join_date)"); 
	// 			$record1 = $query1->row_array();
	// 			if(!empty($record1)){
	// 				$record['total_admission'] = $record1['total_admission'];
	// 			}else{
	// 				$record['total_admission'] = 0;
	// 			}
				
				
	// 			$year[$j] = $record;
				
	// 		}
	// 		$output[$i] = $year;
			
	// 	}
		

	// 	$data['summary'] = $output;
	// 	$this->load->view('view_summary',$data);
	// }	
	// function get_uni_fees_count()
	// {
	// 	$data = array();
	// 	$regno = $this->input->post('regno');
	// 	$fees_type = $this->input->post('fees_type');
	// 	$this->db->where('regno',$regno);
	// 	$data = $this->db->get('college_admission')->row_array();

	// 	$this->db->where('reg_no',$regno);
	// 	$this->db->where('fees_type',$fees_type);
	// 	$cnt = $this->db->get('university_payment')->num_rows();

	// 	$data['count'] = $cnt+1;
	// 	echo json_encode($data);
	// }
	// function add_uni_fees($id=0){
	// 	$data=array();
	// 	$this->db->where('id',$id);
	// 	$data['up'] = $this->db->get('university_payment')->row_array();
	// 	$data['rec_no']  = $this->db->get('university_payment')->num_rows();
	// 	if($this->input->post()) 
	// 	{
	// 		$regno = $this->input->post('regno');
	// 		$student_name = $this->input->post('student_name');
	// 		$course = $this->input->post('course');
	// 		$ins_no = $this->input->post('ins_no');
	// 		$amount = $this->input->post('amount');
	// 		$date = $this->input->post('date');
	// 		$fees_type = $this->input->post('fees_type');
	// 		@$extra_detail = $this->input->post('extra_detail') ? $this->input->post('extra_detail') : "";

	// 		$arr = array('reg_no'=>$regno,'student_name'=>$student_name,'course'=>$course,'amount'=>$amount,'installment_no'=>$ins_no,'date'=>$date,'fees_type'=>$fees_type,'extra_detail'=>$extra_detail);
			
	// 		if($id)
	// 		{
	// 			$this->db->where('id',$id);
	// 			$this->db->update('university_payment',$arr);
	// 		}
	// 		else
	// 		{
					
	// 			$this->db->insert('university_payment',$arr);
	// 		}
	// 	}
	// 	$this->load->view('add_uni_fees',$data);
	// }
	// function view_uni_payment()
	// {
	// 	$arr = array();
	// 	$year = "";
	// 	$month = "";
	// 	$type = "college_fees";
	// 	if($this->input->post())
	// 	{
	// 		$year = $this->input->post('year');
	// 		$month = $this->input->post('month');
	// 	}
	// 	$this->load->library('pagination');
	// 	$perpage=40;
	// 	$start=$this->uri->segment(3);
	// 	$total=$this->Admin_model->uni_row_count($type); 
	// 	$config['base_url']=site_url('Admin/view_uni_payment');
	// 	$config['total_rows']=$total;
	// 	$config['per_page']=$perpage;
	// 	$config['full_tag_open']='<div class="pagination">';
	// 	$config['full_tag_close']='</div>';
	// 	$config['cur_tag_open']='<a class="active">';
	// 	$config['cur_tag_close']='</a>';
	// 	$config['next_link']='Next';
	// 	$config['prev_link']='Prev';
	// 	$this->pagination->initialize($config);
	// 	$arr['fees_data'] = $this->Admin_model->get_uni_payments($type,$perpage,$start,$year,$month);
	// 	$this->load->view('view_uni_payment',$arr);
	// }
	// function view_certi_payment()
	// {
	// 	$arr = array();
	// 	$year = "";
	// 	$month = "";
	// 	$type = "certificate_fees";
	// 	if($this->input->post())
	// 	{
	// 		$year = $this->input->post('year');
	// 		$month = $this->input->post('month');
	// 	}
	// 	$this->load->library('pagination');
	// 	$perpage=40;
	// 	$start=$this->uri->segment(3);
	// 	$total=$this->Admin_model->uni_row_count($type); 
	// 	$config['base_url']=site_url('Admin/view_uni_payment');
	// 	$config['total_rows']=$total;
	// 	$config['per_page']=$perpage;
	// 	$config['full_tag_open']='<div class="pagination">';
	// 	$config['full_tag_close']='</div>';
	// 	$config['cur_tag_open']='<a class="active">';
	// 	$config['cur_tag_close']='</a>';
	// 	$config['next_link']='Next';
	// 	$config['prev_link']='Prev';
	// 	$this->pagination->initialize($config);
	// 	$arr['fees_data'] = $this->Admin_model->get_uni_payments($type,$perpage,$start,$year,$month);
	// 	$this->load->view('view_uni_payment',$arr);
	// }
	// function view_exam_payment()
	// {
	// 	$arr = array();
	// 	$year = "";
	// 	$month = "";
	// 	$type = "exam_fees";
	// 	if($this->input->post())
	// 	{
	// 		$year = $this->input->post('year');
	// 		$month = $this->input->post('month');
	// 	}
	// 	$this->load->library('pagination');
	// 	$perpage=40;
	// 	$start=$this->uri->segment(3);
	// 	$total=$this->Admin_model->uni_row_count($type); 
	// 	$config['base_url']=site_url('Admin/view_uni_payment');
	// 	$config['total_rows']=$total;
	// 	$config['per_page']=$perpage;
	// 	$config['full_tag_open']='<div class="pagination">';
	// 	$config['full_tag_close']='</div>';
	// 	$config['cur_tag_open']='<a class="active">';
	// 	$config['cur_tag_close']='</a>';
	// 	$config['next_link']='Next';
	// 	$config['prev_link']='Prev';
	// 	$this->pagination->initialize($config);
	// 	$arr['fees_data'] = $this->Admin_model->get_uni_payments($type,$perpage,$start,$year,$month);
	// 	$this->load->view('view_uni_payment',$arr);
	// }
	// function uni_student_payment()
	// {
	// 	$arr = array();
	// 	$year = "";
	// 	$month = "";
	// 	$type = "exam_fees";
	// 	if($this->input->post())
	// 	{
	// 		$year = $this->input->post('year');
	// 		$month = $this->input->post('month');
	// 	}
	// 	$this->load->library('pagination');
	// 	$perpage=20;
	// 	$start=$this->uri->segment(3);
	// 	$total=$this->Admin_model->uni_row_count_student(); 
	// 	$config['base_url']=site_url('Admin/uni_student_payment');
	// 	$config['total_rows']=$total;
	// 	$config['per_page']=$perpage;
	// 	$config['full_tag_open']='<div class="pagination">';
	// 	$config['full_tag_close']='</div>';
	// 	$config['cur_tag_open']='<a class="active">';
	// 	$config['cur_tag_close']='</a>';
	// 	$config['next_link']='Next';
	// 	$config['prev_link']='Prev';
	// 	$this->pagination->initialize($config);
	// 	$arr['adm_data'] = $this->Admin_model->get_uni_student_payments($perpage,$start,$year,$month);	
	// 	$arr['pagination'] = $this->pagination->create_links();
	// 	$this->load->view('uni_student_payment',$arr);
	// }
}

?>