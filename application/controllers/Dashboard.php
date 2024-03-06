<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('Schoolinq_model');
		 $this->load->helper(array('cookie', 'url')); 
		if(!$this->session->userdata('user_login')){
			redirect('staff-login');
		}	
		if($this->session->userdata('user_role')==2){
			redirect('staff-login');	
		}
		if($this->session->userdata('user_role')==6){
			redirect('college-dashboard');	
		}
	}
	public function index()
	{

			$cur_year = date("Y");
			$cur_month = date("m");
			$cur_date = date("d");

		$date = date('Y-m-d'); 
		$this->db->select('inq_offline.id');
		$this->db->join('admin a','a.id=inq_offline.added_by','left');
		$this->db->join('admin b','b.id=inq_offline.inquiry_by','left');
		$this->db->where('inq_offline.branch_id',$this->session->userdata('branch_id'));
		$this->db->where('demo_date',$date);
		$this->db->where_in('inq_offline.status',array('P','D'));
		$data = $this->db->get('inq_offline');
		$arr['cnt'] = $data->num_rows(); 
		//last_query();die;

		//$this->db->where('branch_id',$this->session->userdata('branch_id'));
		$this->db->where('YEAR(followup_date)',$cur_year);
		$this->db->where('MONTH(followup_date)',$cur_month);
		$this->db->where('day(followup_date)',$cur_date);
		$data = $this->db->get('followup');
		$arr['cnt1'] = $data->num_rows(); 

		$this->db->select('inq_offline.id');
		$this->db->join('admin a','a.id=inq_offline.added_by','left');
		$this->db->join('admin b','b.id=inq_offline.inquiry_by','left');
		$this->db->where('inq_offline.branch_id',$this->session->userdata('branch_id'));
		$this->db->where('demo_date <',$date);
		$this->db->where_in('inq_offline.status',array('P','D'));
		$data = $this->db->get('inq_offline');
		$arr['due_inq'] = $data->num_rows(); 

		if($this->session->userdata('user_role')==8){
			$this->db->join('school_master','school_master.id=school_inq.s_id','left');
			$this->db->where_in('status',array("P","IC"));
			$this->db->where('school_master.caller_id',$this->session->userdata('user_login'));
		}else{
			$this->db->where_in('status',array("V",'D'));
			// $this->db->where_in('school_inq.status',array("V",'D',"IC","P"));
		}
		$this->db->where('expected_date',$date);
		$data = $this->db->get('school_inq');
		$arr['scl_today'] = $data->num_rows(); 

		
		if($this->session->userdata('user_role')==8){
			$this->db->join('school_master','school_master.id=school_inq.s_id','left');
			$this->db->where_in('status',array("P","IC"));
			$this->db->where('school_master.caller_id',$this->session->userdata('user_login'));
		}else{
			$this->db->where_in('status',array("V",'D'));
			//$this->db->where_in('school_inq.status',array("V",'D',"IC","P"));
		}
		$this->db->where('expected_date < ',$date);
		//$this->db->where('expected_date >','2022-10-31');
		//$this->db->join('admin','admin.id=school_inq.inq_by');
		$data = $this->db->get('school_inq');
		$arr['scl_due'] = $data->num_rows(); 
		//echo last_query();die;
		

		$query1 =  $this->db->query("SELECT COUNT(id) as total_admission,DATE(join_date) as today_date FROM admission WHERE DATE(`join_date`) = CURDATE() GROUP BY CURDATE()"); 
		$today_course_adm = $query1->row_array();
		$arr['today_course_adm'] = $today_course_adm;

		// $query1 =  $this->db->query("SELECT COUNT(id) as total_admission,DATE(join_date) as today_date FROM college_admission WHERE DATE(`join_date`) = CURDATE() GROUP BY CURDATE()"); 
		// $today_college_adm = $query1->row_array();
		// $arr['today_college_adm'] = $today_college_adm;

		$arr['batch_times'] = $this->db->get('course_batches')->result_array();
		

		//echo date('d-M-Y',strtotime($info['inquiry_time']));
		if($this->session->userdata('user_role')==8){
			$this->db->select('school_master.*,(SELECT COUNT(id) FROM school_inq WHERE school_inq.s_id=school_master.id) AS total_count');
			$this->db->where('caller_id',$this->session->userdata('user_login'));
			$arr['school_data'] = $this->db->get('school_master')->result_array();

			$this->db->select('COUNT(id) AS total_count');
			$this->db->where('followup_by',$this->session->userdata('user_login'));
			$this->db->like('followup_date',date('Y-m-d'));
			$today_call = $this->db->get('school_call_followup')->row_array();
			// echo last_query();die;
			$arr['today_call'] = isset($today_call['total_count']) ? $today_call['total_count'] :0;
		}

		/* Select Class */

		$class_data = $this->db->get('lecture_class')->result_array();
		$arr['lecture_class'] = $class_data;

		/* select assign class */

		$class_data = $this->db->get('student_batches')->result_array();
		$arr['batch_data'] = $class_data;

		/* lecture time batch */
		$class_data = $this->db->get('lecture_time')->result_array();
		$arr['lecture_time'] = $class_data;

		/* Faculty select */

		$this->db->where('status',1);
		$this->db->where('branch_id',$this->session->userdata('branch_id'));
		$arr['faculty'] = $this->db->get('admin')->result_array();


		/* Select Free Faculty */

		$select = array("8 To 10","10 To 12","12 To 2","2 To 4","4 To 6","6 To 8");

		$this->db->where('status',1);
		//$this->db->where_not_in('role',ADMIN_STAFF);
		//$this->db->where_in('id',RECEPTIONIST_AND_TEACHING);
		$this->db->where_not_in('role',ADMIN_STAFF);
		$arr['faculty_data'] = $this->db->get('admin')->result_array();


		$this->db->where_in('batch',$select);
		$arr['batch_time_data'] = $this->db->get('course_batches')->result_array();

		$all_data = array();
		foreach($arr['faculty_data'] as $key => $value)
		{
			$lecture = array();

			foreach ($arr['batch_time_data'] as $time => $batch) {
				$this->db->where('batch_time',$batch['batch']);
				$this->db->where('faculty_id',$value['id']);
				$total_batch = $this->db->get('student_batches')->result_array();

			$count_batch = 0;	

				foreach ($total_batch as $key => $value1) {
					
						$student_ids = explode(',',$value1['student_ids']);

						$batch_student = count($student_ids);

							$this->db->where_in('regno', $student_ids);
							$this->db->where('status','L');
							$leave_student = $this->db->get('admission')->result_array();

						$total_student = $batch_student - count($leave_student);

						if($total_student==0)
						{
							$count_batch++;
						}

				}
				
					$lecture[$batch['batch']] = array('total_lecture' => count($total_batch) , 'time' => $batch['batch'] , 'Batch_leave'=>$count_batch);
					
				if(!empty($lecture))
				{
					$all_data[$value['name']] = $lecture;
				}
			}

				
		}

		$arr['free_time'] = $all_data;

		// pre($arr['free_time']); die();

		$this->load->view('dashboard',$arr);
	}
	public function inq_rpt(){

		$query =  $this->db->query("SELECT COUNT(id) as count,SUM(amount) as total_amount,DATE(date) as today_date FROM tbl_dipak WHERE payment_mode='CASH' and DATE(`date`) = CURDATE() GROUP BY CURDATE()"); 
		$record = $query->row_array();
		$arr['month_inq'] =  @$record['total_amount'] ? $record['total_amount'] :0;


		$query =  $this->db->query("SELECT COUNT(id) as count,SUM(amount) as total_amount,DATE(date) as today_date FROM fees WHERE payment_mode='CASH' and DATE(`date`) = CURDATE() GROUP BY CURDATE()"); 
		$record = $query->row_array();
		$arr['today_collection_cash'] =  @$record['total_amount'] ? $record['total_amount'] :0; 

		$query =  $this->db->query("SELECT COUNT(id) as count,SUM(amount) as total_amount,DATE(date) as today_date FROM fees WHERE payment_mode!='CASH' and DATE(`date`) = CURDATE() GROUP BY CURDATE()"); 
		$record = $query->row_array();
		$arr['today_collection_online'] = @$record['total_amount'] ? $record['total_amount'] :0; 
		$arr['course_total'] = $arr['today_collection_online']+$arr['today_collection_cash'];
		$this->load->view('inq_temp',$arr);
	}
	public function overview()
	{

		$cur_year = date("Y");
		$cur_month = date("m");
		$cur_date = date("d");

		$date = date('Y-m-d'); 
		$this->db->select('inq_offline.id');
		$this->db->join('admin a','a.id=inq_offline.added_by','left');
		$this->db->join('admin b','b.id=inq_offline.inquiry_by','left');
		$this->db->where('inq_offline.branch_id',$this->session->userdata('branch_id'));
		$this->db->where('demo_date',$date);
		$this->db->where_in('inq_offline.status',array('P','D'));
		$data = $this->db->get('inq_offline');
		$arr['cnt'] = $data->num_rows(); 


		//$this->db->where('branch_id',$this->session->userdata('branch_id'));
		$this->db->where('YEAR(followup_date)',$cur_year);
		$this->db->where('MONTH(followup_date)',$cur_month);
		$this->db->where('day(followup_date)',$cur_date);
		$data = $this->db->get('followup');
		$arr['cnt1'] = $data->num_rows(); 




		$this->db->select('inq_offline.id');
		$this->db->join('admin a','a.id=inq_offline.added_by','left');
		$this->db->join('admin b','b.id=inq_offline.inquiry_by','left');
		$this->db->where('inq_offline.branch_id',$this->session->userdata('branch_id'));
		$this->db->where('demo_date <',$date);
		$this->db->where_in('inq_offline.status',array('P','D'));
		$data = $this->db->get('inq_offline');
		$arr['due_inq'] = $data->num_rows(); 

		$this->db->where('expected_date',$date);
		// $this->db->where('status',"V");
		$this->db->where_in('school_inq.status',array("V",'D'));
		$data = $this->db->get('school_inq');
		$arr['scl_today'] = $data->num_rows(); 

		
		$this->db->where('expected_date < ',$date);
		// $this->db->where('school_inq.status',"V");
		$this->db->where_in('school_inq.status',array("V",'D'));
		$this->db->join('admin','admin.id=school_inq.inq_by');
		$data = $this->db->get('school_inq');
		$arr['scl_due'] = $data->num_rows();

			

		$query =  $this->db->query("SELECT COUNT(id) as count,SUM(amount) as total_amount,DATE(date) as today_date FROM fees WHERE payment_mode='CASH' and DATE(`date`) = CURDATE() GROUP BY CURDATE()"); 
		$record = $query->row_array();
		$arr['today_collection_cash'] =  @$record['total_amount'] ? $record['total_amount'] :0; 

		$query =  $this->db->query("SELECT COUNT(id) as count,SUM(amount) as total_amount,DATE(date) as today_date FROM fees WHERE payment_mode!='CASH' and DATE(`date`) = CURDATE() GROUP BY CURDATE()"); 
		$record = $query->row_array();
		$arr['today_collection_online'] = @$record['total_amount'] ? $record['total_amount'] :0; 
		$arr['course_total'] = $arr['today_collection_online']+$arr['today_collection_cash'];
		// $qry =  $this->db->query("SELECT COUNT(id) as count,SUM(amount) as total_amount,DATE(date) as today_date FROM college_fees WHERE pay_mode='CASH' and DATE(`date`) = CURDATE() GROUP BY CURDATE()"); 
		// $record2 = $qry->row_array();
		// $arr['today_collection_clg_cash'] = @$record2['total_amount'] ? $record2['total_amount'] :0;

		// $qry =  $this->db->query("SELECT COUNT(id) as count,SUM(amount) as total_amount,DATE(date) as today_date FROM college_fees WHERE pay_mode!='CASH' and DATE(`date`) = CURDATE() GROUP BY CURDATE()"); 
		// $record2 = $qry->row_array();
		// $arr['today_collection_clg_online'] = @$record2['total_amount'] ? $record2['total_amount'] :0;
		// $arr['clg_total'] = $arr['today_collection_clg_cash']+$arr['today_collection_clg_online'];
		//pre($arr);die; 

		$query1 =  $this->db->query("SELECT COUNT(id) as total_admission,DATE(join_date) as today_date FROM admission WHERE DATE(`join_date`) = CURDATE() GROUP BY CURDATE()"); 
		$today_course_adm = $query1->row_array();
		$arr['today_course_adm'] = $today_course_adm;

		// $query1 =  $this->db->query("SELECT COUNT(id) as total_admission,DATE(join_date) as today_date FROM college_admission WHERE DATE(`join_date`) = CURDATE() GROUP BY CURDATE()"); 
		// $today_college_adm = $query1->row_array();
		// $arr['today_college_adm'] = $today_college_adm;

		// $qry =  $this->db->query("SELECT COUNT(id) as count,SUM(amount) as total_amount,DATE(date) as today_date FROM exam_fees WHERE pay_mode='CASH' and DATE(`date`) = CURDATE() GROUP BY CURDATE()"); 
		// $record4 = $qry->row_array();
		// $arr['today_collection_exam_cash'] = @$record4['total_amount'] ? $record4['total_amount'] :0;

		// $qry =  $this->db->query("SELECT COUNT(id) as count,SUM(amount) as total_amount,DATE(date) as today_date FROM exam_fees WHERE pay_mode!='CASH' and DATE(`date`) = CURDATE() GROUP BY CURDATE()"); 
		// $record5 = $qry->row_array();
		// $arr['today_collection_exam_online'] = @$record5['total_amount'] ? $record5['total_amount'] :0;
		// $arr['exam_total'] = $arr['today_collection_exam_cash']+$arr['today_collection_exam_online'];

		// $qry =  $this->db->query("SELECT COUNT(id) as count,SUM(amount) as total_amount,DATE(date) as today_date FROM certificate_fees WHERE pay_mode='CASH' and DATE(`date`) = CURDATE() GROUP BY CURDATE()"); 
		// $record6 = $qry->row_array();
		// $arr['today_collection_cert_cash'] = @$record6['total_amount'] ? $record6['total_amount'] :0;

		// $qry =  $this->db->query("SELECT COUNT(id) as count,SUM(amount) as total_amount,DATE(date) as today_date FROM certificate_fees WHERE pay_mode!='CASH' and DATE(`date`) = CURDATE() GROUP BY CURDATE()"); 
		// $record7 = $qry->row_array();
		// $arr['today_collection_cert_online'] = @$record7['total_amount'] ? $record7['total_amount'] :0;
		// $arr['certificate_total'] = $arr['today_collection_cert_cash']+$arr['today_collection_cert_online'];
		
		$arr['batch_times'] = $this->db->get('course_batches')->result_array();
		$this->load->view('dashboard_inner',$arr);
	}

	function seating($batch_id="")
	{
		$batch_time = $this->db->get_where('course_batches',array('id'=>$batch_id))->row_array();
		$time = $batch_time['batch'];
		$data['time'] = $time;
		//design pc query
		$this->db->select('regno,student_name,pcno,course,admin.name as faculty');
		$this->db->where('admission.status','R','P');
		$this->db->where('sitting','PC');
		//$this->db->group_start();
		$this->db->like('pcno','DES','both');
		//$this->db->where('pcno','0');
		//$this->db->group_end();
		$this->db->where("FIND_IN_SET('".$time."',batch_time)");
		$this->db->join('admin','admin.id=admission.faculty_id','left');
		$total_des = $this->db->count_all_results('admission', FALSE);
		$rec_des = $this->db->get()->result_array();

		//pre($rec_des);die;
		$new_arr = array();
		$not_assigned = array();
		foreach($rec_des as $r){
			if($r['pcno']=='0' || isset($new_arr[$r['pcno']])){
				$not_assigned[] = $r;
			}else {
				$new_arr[$r['pcno']] = $r;
			}
		}
		//development pc query
			$select = array('R','J','P');
		$this->db->select('regno,student_name,pcno,course,admin.name as faculty');
		$this->db->where_in('admission.status',$select);
		$this->db->where('sitting','PC');
		$this->db->like('pcno','DEV','both');
		$this->db->where("FIND_IN_SET('".$time."',batch_time)");
		$this->db->join('admin','admin.id=admission.faculty_id','left');
		$total_dev = $this->db->count_all_results('admission', FALSE);
		$rec_dev = $this->db->get()->result_array();
//pre($rec_dev);die;
		$new_arr_dev = array();
		foreach($rec_dev as $r){
			if($r['pcno']=='0' || isset($new_arr_dev[$r['pcno']])){
				$not_assigned[] = $r;
			}else {
				$new_arr_dev[$r['pcno']] = $r;
			}
		}

		//not assigned pc query

		$this->db->select('regno,student_name,pcno,course,admin.name as faculty');
		$this->db->where_in('admission.status',$select);
		$this->db->where('sitting','PC');
		$this->db->where("(pcno='0' or pcno='')");
		$this->db->where("FIND_IN_SET('".$time."',batch_time)");
		$this->db->join('admin','admin.id=admission.faculty_id','left');
		$total_unassigned = $this->db->count_all_results('admission', FALSE);
		$not_assigned = $this->db->get()->result_array();
		//pre($not_assigned);die;

		$data['not_assigned'] = $not_assigned;
		$data['total_pc_des'] = $total_des;
		$data['total_pc_dev'] = $total_dev;
		$data['rec_des'] = $new_arr;
		$data['rec_dev'] = $new_arr_dev;
		$this->db->select('regno,student_name,pcno,course,admin.name as faculty');
		$this->db->where_in('admission.status',$select);
		$this->db->where('sitting','LAPTOP');
		$this->db->where("FIND_IN_SET('".$time."',batch_time)");
		$this->db->join('admin','admin.id=admission.faculty_id','left');
		$laptop = $this->db->get('admission')->result_array();
		$data['laptop_data']  = $laptop;
		// echo '<pre>';print_r($new_arr);die;
		$this->db->where('branch_id',$this->session->userdata('branch_id'));
		$data['view_faculty'] = $this->db->get('admin')->result_array();
		$data['course_batches'] = $this->db->get('course_batches')->result_array();
		$this->load->view('view_seating',$data);
	}

	

}

?>