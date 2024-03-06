<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Fees extends CI_Controller {
	var $perpage=50;
	function __construct()
	{
		parent::__construct();		
		if(!$this->session->userdata('user_login')){
			redirect('staff-login');
		}
		
		$this->load->model('Fees_model');
	}
	
	function index($action="update",$id='')
	{
		if($this->session->userdata('user_role')==2){
			redirect('staff-login');	
		}
		$data = array();
		
		$data['accounts'] = $this->db->get('bank_accounts')->result_array();
		$this->db->where('branch_id',$this->session->userdata('branch_id'));
		$data['faculties'] = $this->db->get('admin')->result_array();
		if($action == "update"){
			$this->db->where('id',$id);
			$data['up'] = $this->db->get('fees')->row_array();
		}else if("add"){
			$data['reg_no'] = $id;	
		}
		$data['action'] = $action;
		$data['rec_no']  = $this->db->get('fees')->num_rows();
		if($this->input->post())
		{
			//pre($this->input->post());die;
			$regno = $this->input->post('regno');
			$student_name = $this->input->post('student_name');
			$course = $this->input->post('course');
			$amount = $this->input->post('amount');
			$payment_mode = $this->input->post('payment_mode');
			$payment_detail = $this->input->post('payment_detail');
			$payable_amount = $this->input->post('payable_amount');
			$next_amount = $this->input->post('next_amt');
			$create_by = $this->input->post('create_by');
			$gst = $this->input->post('gst');
			$tax_amount = $this->input->post('tax_amount');
			$net_amt = $this->input->post('net_amt');
			$ac_id = $this->input->post('ac_id');

			if($action == "update"){
				$recno = $this->input->post('recno');
				$ins_no =$this->input->post('ins_no');
			}else{
				$ac_rec_no = $this->db->get_where('fees',array('ac_id'=>$ac_id))->num_rows();
				$ac_rec_no+=1;
				$recno = $data['rec_no'] +1;
				$this->db->where('reg_no',$regno);
				$qry1 = $this->db->get('fees');
				$cnt = $qry1->num_rows();

				$this->db->where('reg_no',$regno);
				$qry2 = $this->db->get('tbl_dipak');
				$cnt1 = $qry2->num_rows();
				
				$ins_no =$cnt+$cnt1+1;

				$this->db->where('regno',$regno);
				$qry3 = $this->db->get('admission');
				$admission = $qry3->row_array();

				$installment_info = json_decode($admission['installment_detail'],true);
				$installment_info[$ins_no-1]['amount'] = $amount;
				$installment_info[$ins_no-1]['date'] = date('Y-m-d');
				$installment_info[$ins_no-1]['status'] = 1;

				$this->db->where('regno',$regno);
				$this->db->update('admission',array('installment_detail'=>json_encode($installment_info)));
			}
			
			
			//echo $payable_amount.'-'.$amount;die;
			// if($action!="update"){
			// 	if($payable_amount != $amount){
			// 		if($amount <$payable_amount){
			// 			$next_amount += $payable_amount-$amount;
			// 		}else {
			// 			$next_amount -= ($amount - $payable_amount);
			// 		}
					
			// 		if(isset($installment_info[$ins_no]) ){

			// 			$installment_info[$ins_no]['amount']= $next_amount;
			// 			//echo $regno;
			// 			//pre($installment_info);die;
			// 			$this->db->where('regno',$regno);
			// 			$this->db->update('admission',array('installment_detail'=>json_encode($installment_info)));
			// 		}else{
			// 			$next_date = date('Y-m-d', strtotime("+1 months", strtotime(date('Y-m-d'))));
			// 			$installment_info[$ins_no]['amount'] = $next_amount;
			// 			$installment_info[$ins_no]['date'] = $next_date;
			// 			$installment_info[$ins_no]['status'] = 0;
			// 			$this->db->where('regno',$regno);
			// 			$this->db->update('admission',array('installment_detail'=>json_encode($installment_info)));
			// 			//pre($installment_info);die;
			// 		}
			// 	}else if($amount > 0){
			// 		$installment_info[$ins_no-1]['amount'] = $amount;
			// 		$installment_info[$ins_no-1]['date'] = date('Y-m-d');
			// 		$installment_info[$ins_no-1]['status'] = 1;
			// 		$this->db->where('regno',$regno);
			// 		$this->db->update('admission',array('installment_detail'=>json_encode($installment_info)));
			// 	}
			// }
			//echo 'test';die;
			$date = $this->input->post('date');
			$arr = array('rec_no'=>$recno,'reg_no'=>$regno,'student_name'=>$student_name,'course'=>$course,'amount'=>$amount,'payment_mode'=>$payment_mode,'payment_detail'=>$payment_detail,'create_by'=>$create_by,'date'=>$date,'ac_id'=>$ac_id,'ac_rec_no'=>$ac_rec_no,'gst'=>$gst,'tax_amount'=>$tax_amount,'net_amt'=>$net_amt);

			if($id>0 && $action =="update")
			{
				$this->db->where('id',$id);
				$this->db->update('fees',$arr);
			}
			else
			{
				//delete due payment entry
				$this->db->where('regno',$regno);
				$this->db->delete('due_payments');

				$this->db->insert('fees',$arr);
			}
			redirect('fees/view_fees');
		}
		$this->load->view('add_fees',$data);
	}
	function index2($action="update",$id='')
	{
		if($this->session->userdata('user_role')==2){
			redirect('staff-login');	
		}
		$data = array();
		
		$data['accounts'] = $this->db->get('bank_accounts')->result_array();
		$this->db->where('branch_id',$this->session->userdata('branch_id'));
		$data['faculties'] = $this->db->get('admin')->result_array();
		if($action == "update"){
			$this->db->where('id',$id);
			$data['up'] = $this->db->get('tbl_dipak')->row_array();
		}else if("add"){
			$data['reg_no'] = $id;	
		}
		$data['action'] = $action;
		$data['rec_no']  = $this->db->get('tbl_dipak')->num_rows();
		if($this->input->post())
		{
			//pre($this->input->post());die;
			$regno = $this->input->post('regno');
			$student_name = $this->input->post('student_name');
			$course = $this->input->post('course');
			$amount = $this->input->post('amount');
			$payment_mode = $this->input->post('payment_mode');
			$payment_detail = $this->input->post('payment_detail');
			$payable_amount = $this->input->post('payable_amount') ? $this->input->post('payable_amount') : 0;
			$next_amount = $this->input->post('next_amt') ? $this->input->post('next_amt') : 0;
			$create_by = $this->input->post('create_by');
			$gst = $this->input->post('gst');
			$tax_amount = $this->input->post('tax_amount') ? $this->input->post('tax_amount') : 0;
			$net_amt = $this->input->post('net_amt') ? $this->input->post('net_amt') :0;
			$ac_id = $this->input->post('ac_id') ? $this->input->post('ac_id') : 0;

			if($action == "update"){
				$recno = $this->input->post('recno');
				$ins_no =$this->input->post('ins_no');
			}else{
				// $ac_rec_no = $this->db->get_where('tbl_dipak',array('ac_id'=>$ac_id))->num_rows();
				// $ac_rec_no+=1;
				$recno = $data['rec_no'] +1;
				$this->db->where('reg_no',$regno);
				$cnt = $this->db->get('tbl_dipak')->num_rows();
				//$ins_no =$cnt+1;

				$this->db->where('reg_no',$regno);
				$qry1 = $this->db->get('fees');
				$cnt = $qry1->num_rows();

				$this->db->where('reg_no',$regno);
				$qry2 = $this->db->get('tbl_dipak');
				$cnt1 = $qry2->num_rows();
				
				$ins_no =$cnt+$cnt1+1;

				$this->db->where('regno',$regno);
				$qry3 = $this->db->get('admission');
				$admission = $qry3->row_array();

				$installment_info = json_decode($admission['installment_detail'],true);
				$installment_info[$ins_no-1]['amount'] = $amount/10;
				$installment_info[$ins_no-1]['date'] = date('Y-m-d');
				$installment_info[$ins_no-1]['status'] = 1;

				$this->db->where('regno',$regno);
				$this->db->update('admission',array('installment_detail'=>json_encode($installment_info)));
			}
			// $this->db->where('regno',$regno);
			// $admission = $this->db->get('admission')->row_array();

			
			$date = $this->input->post('date');


			$arr = array('rec_no'=>$recno,'reg_no'=>$regno,'student_name'=>$student_name,'course'=>$course,'amount'=>$amount/10,'payment_mode'=>$payment_mode,'payment_detail'=>$payment_detail,'create_by'=>$create_by,'date'=>$date);

			if($id>0 && $action =="update")
			{
				$this->db->where('id',$id);
				$this->db->update('tbl_dipak',$arr);
			}
			else
			{
				//delete due payment entry
				$this->db->where('regno',$regno);
				$this->db->delete('due_payments');

				$this->db->insert('tbl_dipak',$arr);
			}
			redirect('fees/view_fees2');
		}
		$this->load->view('add_fees2',$data);
	}
	function get_rec()
	{
		$data = array();
		$regno = $this->input->post('regno');
		$this->db->where('regno',$regno);
		$data = $this->db->get('admission')->row_array();

		$installment_info = json_decode($data['installment_detail'],true);

		//pre($installment_info);die;
		$this->db->where('reg_no',$regno);
		$cnt = $this->db->get('fees')->num_rows();

		$this->db->where('reg_no',$regno);
		$cnt2 = $this->db->get('tbl_dipak')->num_rows();

		$data['payable_amount'] = $installment_info[$cnt+$cnt2]['amount'];
		// if(isset( $installment_info[$cnt+1])){
		// 	$data['next_amount'] = $installment_info[$cnt+1]['amount'];
		// 	$data['next_date'] = date("d-m-Y",strtotime($installment_info[$cnt+1]['date']));
		// }else{
		// 	$data['next_amount'] = 0;
		// 	$data['next_date'] = date('d-m-Y', strtotime("+1 months", strtotime(date('Y-m-d'))));
		// }
		$data['count'] = $cnt+$cnt2+1;
		echo json_encode($data);
	}


	function view_fees()
	{
		if($this->session->userdata('user_role')==2){
			redirect('staff-login');	
		}

		$arr = array();
		$arr['faculties'] = $this->db->get('admin')->result_array();
		$year = "";
		$month = "";

		if($this->input->post())
		{
			$year = $this->input->post('year');
			$month = $this->input->post('month');
		}
		
		
		$start=$this->uri->segment(3);
		$total=$this->Fees_model->row_count(); 
		$base_url = site_url('fees/fees_rec');
		$pagination =pagination_new($total,$this->perpage,$base_url,3);
		$arr['fees_data'] = $this->Fees_model->view_fees_data($this->perpage,$start,$year,$month);
		$arr['pagination'] = $pagination;
		$arr['perpage'] = $this->perpage;
		$this->load->view('view_fees',$arr);
	}
	function view_fees2()
	{
		if($this->session->userdata('user_role')==2){
			redirect('staff-login');	
		}

		$arr = array();
		$arr['faculties'] = $this->db->get('admin')->result_array();
		$year = "";
		$month = "";

		if($this->input->post())
		{
			$year = $this->input->post('year');
			$month = $this->input->post('month');
		}
		
		
		$start=$this->uri->segment(3);
		$total=$this->Fees_model->row_count(); 
		$base_url = site_url('fees/fees_rec2');
		$pagination =pagination_new($total,$this->perpage,$base_url,3);
		$arr['fees_data'] = $this->Fees_model->view_fees_data2($this->perpage,$start,$year,$month);
		$arr['pagination'] = $pagination;
		$arr['perpage'] = $this->perpage;
		$this->load->view('view_fees2',$arr);
	}

	function fees_rec()
	{
		$perpage=$this->input->post('perpage') ? $this->input->post('perpage') : $this->perpage;
		$start=$this->uri->segment(3);
		$search_by = $this->input->post('search_by');
		$search_keyword = $this->input->post('search_keyword');
		$created_by = $this->input->post('created_by');
		$year = $this->input->post('year');
		$pay_mode = $this->input->post('mode');
		$month = $this->input->post('month');
		if($search_by!=""){
			if($search_by=='byname')
			{
				$this->db->like('student_name',$search_keyword);
			}
			if($search_by=='byrec' && $search_keyword != '')
			{
				$this->db->where('rec_no',$search_keyword);
			}

			if($search_by=='byreg' && $search_keyword != '')
			{
				$this->db->where('reg_no',$search_keyword);
			}

			if($search_by=='bydetails' && $search_keyword!='')
			{
				$this->db->like('fees.payment_detail',$search_keyword);
			}
		}
		if($pay_mode!='')
		{
			$this->db->like('fees.payment_mode',$pay_mode);
		}
		if($created_by != '')
		{
			$this->db->where('create_by',$created_by);
		}
		if($year!='')
		{
			$this->db->like('date',$year);
		}
		if($month!='' && $year!='')
		{
			$start_date = $year.'-'.$month.'-01';
			$end_date = date("Y-m-t", strtotime($start_date));
			$this->db->where('(date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'")');	
		}
		$this->db->select('fees.*,admin.name as create_by');
		$this->db->join('admin','admin.id=fees.create_by','left');
		$total = $this->db->count_all_results('fees', FALSE);
		$this->db->limit($perpage,$start);
		$this->db->order_by('id','desc');
		$data['fees_data'] = $this->db->get()->result_array();
		$base_url = site_url('fees/fees_rec');
		$pagination =pagination_new($total,$perpage,$base_url,3);
		$html = $this->load->view('ajax_search_fees',$data,true);
		echo json_encode(array('data'=>$html,'pagination'=>$pagination));
	}
	function fees_rec2()
	{
		$perpage=$this->input->post('perpage') ? $this->input->post('perpage') : $this->perpage;
		$start=$this->uri->segment(3);
		$search_by = $this->input->post('search_by');
		$search_keyword = $this->input->post('search_keyword');
		$created_by = $this->input->post('created_by');
		$year = $this->input->post('year');
		$pay_mode = $this->input->post('mode');
		$month = $this->input->post('month');
		if($search_by!=""){
			if($search_by=='byname')
			{
				$this->db->like('student_name',$search_keyword);
			}
			if($search_by=='byrec' && $search_keyword != '')
			{
				$this->db->where('rec_no',$search_keyword);
			}

			if($search_by=='byreg' && $search_keyword != '')
			{
				$this->db->where('reg_no',$search_keyword);
			}

			if($search_by=='bydetails' && $search_keyword!='')
			{
				$this->db->like('tbl_dipak.payment_detail',$search_keyword);
			}
		}
		if($pay_mode!='')
		{
			$this->db->like('tbl_dipak.payment_mode',$pay_mode);
		}
		if($created_by != '')
		{
			$this->db->where('create_by',$created_by);
		}
		if($year!='')
		{
			$this->db->like('date',$year);
		}
		if($month!='' && $year!='')
		{
			$start_date = $year.'-'.$month.'-01';
			$end_date = date("Y-m-t", strtotime($start_date));
			$this->db->where('(date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'")');	
		}
		$this->db->select('tbl_dipak.*,admin.name as create_by');
		$this->db->join('admin','admin.id=tbl_dipak.create_by','left');
		$total = $this->db->count_all_results('tbl_dipak', FALSE);
		$this->db->limit($perpage,$start);
		$this->db->order_by('id','desc');
		$data['fees_data'] = $this->db->get()->result_array();
		$base_url = site_url('fees/fees_rec2');
		$pagination =pagination_new($total,$perpage,$base_url,3);
		$html = $this->load->view('ajax_search_fees2',$data,true);
		echo json_encode(array('data'=>$html,'pagination'=>$pagination));
	}
	function print_receipt($id=0)
	{
		$this->db->where('id',$id);
		$fees_info = $this->db->get('fees')->row_array();

		$this->db->where('id',$fees_info['create_by']);
        $faculty_data = $this->db->get('admin')->row_array();

        $fees_info['create_by_name'] = $faculty_data['name'];

		$res['info'] = $fees_info;

		
		if($fees_info['ac_id']>0){
			$this->db->where('ac_id',$fees_info['ac_id']);
			$ac_info = $this->db->get('bank_accounts')->row_array();
			$res['ac_info'] = $ac_info;
		}
		$this->db->where('regno',$fees_info['reg_no']);
		$stud_info = $this->db->get('admission')->row_array();
		$installment_info = json_decode($stud_info['installment_detail'],true);
		// if(isset($installment_info[$fees_info['installment_no']])){
		// 	$next_installment = $installment_info[$fees_info['installment_no']];
		// }else{
		// 	$next_installment = array();
		// }
		// $res['next_installment'] = $next_installment;
		//pre($res);die;
		if($fees_info['gst']=="YES-IN" || $fees_info['gst']=="YES-EX"){
			$this->load->view('print_regular_receipt_gst',$res);
		}else{
			$this->load->view('print_regular_receipt_gst_comp',$res);
		}
		
	}
	function print_receipt2($id=0)
	{
		$this->db->where('id',$id);
		$fees_info = $this->db->get('tbl_dipak')->row_array();

		$this->db->where('id',$id);
		$this->db->update('tbl_dipak',array('status'=>1));

		$this->db->where('id',$fees_info['create_by']);
        $faculty_data = $this->db->get('admin')->row_array();

        $fees_info['create_by_name'] = $faculty_data['name'];

		$res['info'] = $fees_info;

		
		// if($fees_info['ac_id']>0){
		// 	$this->db->where('ac_id',$fees_info['ac_id']);
		// 	$ac_info = $this->db->get('bank_accounts')->row_array();
		// 	$res['ac_info'] = $ac_info;
		// }
		$this->db->where('regno',$fees_info['reg_no']);
		$stud_info = $this->db->get('admission')->row_array();
		$installment_info = json_decode($stud_info['installment_detail'],true);
		// if(isset($installment_info[$fees_info['installment_no']])){
		// 	$next_installment = $installment_info[$fees_info['installment_no']];
		// }else{
		// 	$next_installment = array();
		// }
		// $res['next_installment'] = $next_installment;
		//pre($res);die;
		// if($fees_info['gst']=="YES-IN" || $fees_info['gst']=="YES-EX"){
		// 	$this->load->view('print_regular_receipt_gst',$res);
		// }else{
			$this->load->view('print_regular_receipt',$res);
		// }
		
	}
	function pending_list(){
		$cur_date = date('Y-m-d');
		$this->db->select('due_payments.*,admission.contact,admission.father_contact,admission.running_topic,admission.batch_time,admission.student_name,admission.course,admission.faculty_id');
		$this->db->join('admission','admission.regno=due_payments.regno');
		if($this->session->userdata('user_role')==2){
			$this->db->where('find_in_set("'.$this->session->userdata('user_login').'", faculty_id) <> 0');
			//$this->db->where('faculty_id',$this->session->userdata('user_login'));
		}
		$this->db->where('due_date <=',$cur_date);
		$total = $this->db->get('due_payments')->num_rows();
		$base_url = site_url('fees/ajax_pending_list');
		$pagination =pagination_new($total,$this->perpage,$base_url,3);

		$this->db->order_by('due_date','asc');
		$this->db->select('due_payments.*,admission.contact,admission.father_contact,admission.running_topic,admission.batch_time,admission.student_name,admission.course,admission.faculty_id,admission.pcno,admission.sitting,admission.status,admission.status_note');
		$this->db->join('admission','admission.regno=due_payments.regno');
		if($this->session->userdata('user_role')==2){
			//$this->db->where('faculty_id',$this->session->userdata('user_login'));
			$this->db->where('find_in_set("'.$this->session->userdata('user_login').'", faculty_id) <> 0');
		}
		$this->db->where('due_date <=',$cur_date);
		$this->db->limit($this->perpage,0);
		$arr['fees_data'] = $this->db->get('due_payments')->result_array();
		$arr['pagination'] = $pagination;
		$arr['perpage'] = $this->perpage;
		$arr['type'] = "due";
		if($this->session->userdata('user_role')==2){
			$this->db->where('find_in_set("'.$this->session->userdata('user_login').'", id) <> 0');
			//$this->db->where('id',$this->session->userdata('user_login'));
		}
		$this->db->where('status',1);
		#$this->db->where_in('role',array(1,2,5));
		$this->db->where('branch_id',$this->session->userdata('branch_id'));
		$arr['faculties'] = $this->db->get('admin')->result_array();
		$arr['course_batches'] = $this->db->get('course_batches')->result_array();
		$arr['view_course'] = $this->db->get('course')->result_array();
		$arr['found_results'] = $total;
		$this->load->view('view_pending_fees',$arr);
	}
	function upcoming_due_list(){
		$cur_date = date('Y-m-d');
		$this->db->where('due_date >',$cur_date);
		$this->db->select('due_payments.*,admission.contact,admission.father_contact,admission.running_topic,admission.batch_time,admission.student_name,admission.course,admission.faculty_id');
		if($this->session->userdata('user_role')==2){
			//$this->db->where('faculty_id',$this->session->userdata('user_login'));
			$this->db->where('find_in_set("'.$this->session->userdata('user_login').'", faculty_id) <> 0');
		}
		$this->db->join('admission','admission.regno=due_payments.regno');
		$total = $this->db->get('due_payments')->num_rows();
		$base_url = site_url('fees/ajax_pending_list');
		$pagination =pagination_new($total,$this->perpage,$base_url,3);
		$this->db->order_by('due_date','asc');
		$this->db->select('due_payments.*,admission.contact,admission.father_contact,admission.running_topic,admission.batch_time,admission.student_name,admission.course,admission.faculty_id,admission.pcno,admission.sitting,admission.status,admission.status_note');
		$this->db->join('admission','admission.regno=due_payments.regno');
		if($this->session->userdata('user_role')==2){
			//$this->db->where('faculty_id',$this->session->userdata('user_login'));
			$this->db->where('find_in_set("'.$this->session->userdata('user_login').'", faculty_id) <> 0');
		}
		$this->db->where('due_date >',$cur_date);
		$this->db->limit($this->perpage,0);
		$arr['fees_data'] = $this->db->get('due_payments')->result_array();
		$arr['pagination'] = $pagination;
		$arr['perpage'] = $this->perpage;
		$arr['type'] = "upcoming";
		if($this->session->userdata('user_role')==2){
			//$this->db->where('id',$this->session->userdata('user_login'));
			$this->db->where('find_in_set("'.$this->session->userdata('user_login').'", id) <> 0');
		}
		$this->db->where('status',1);
		#$this->db->where_in('role',array(1,2,5));
		$this->db->where('branch_id',$this->session->userdata('branch_id'));
		$arr['faculties'] = $this->db->get('admin')->result_array();
		$arr['course_batches'] = $this->db->get('course_batches')->result_array();
		$arr['view_course'] = $this->db->get('course')->result_array();
		$arr['found_results'] = $total;
		$this->load->view('view_pending_fees',$arr);
	}
	function ajax_pending_list(){
		$cur_date = date('Y-m-d');
		$perpage=$this->input->post('perpage') ? $this->input->post('perpage') : $this->perpage;
		$start=$this->uri->segment(3);
		$search_by = $this->input->post('search_by');
		$search_keyword = $this->input->post('search_keyword');
		$list_type = $this->input->post('list_type');
		$batch_time = $this->input->post('batch_time');
		$faculties = $this->input->post('faculties');
		$course = $this->input->post('course');
		if(!empty($course))
		{
			$this->db->group_start();
			foreach($course as $cour){
				$this->db->or_like('admission.course',$cour);
			}
			$this->db->group_end();

		}
		if($search_by=='byreg' && $search_keyword != '')
		{
			$this->db->where('reg_no',$search_keyword);
		}
		if($search_by=='byname' && $search_keyword != '')
		{
			$this->db->like('student_name',$search_keyword);
		}
		if(!empty($batch_time))
		{
			$this->db->group_start();
			foreach($batch_time as $batch){
				$this->db->or_where('find_in_set("'.$batch.'", admission.batch_time) <> 0');
				//$this->db->or_like('course',$batch);
			}
			$this->db->group_end();
		}
		if(!empty($faculties))
		{
			$this->db->group_start();
			foreach($faculties as $fac){
				//$this->db->or_where('admission.faculty_id',$fac);
				$this->db->or_where('find_in_set("'.$fac.'", faculty_id) <> 0');
			}
			$this->db->group_end();
		}
		if($list_type == "due"){
			$this->db->where('due_date <=',$cur_date);
		}else if($list_type == "upcoming"){
			$this->db->where('due_date >',$cur_date);
		}

		$this->db->select('due_payments.*,admission.contact,admission.father_contact,admission.running_topic,admission.batch_time,admission.student_name,admission.course,admission.faculty_id,admission.pcno,admission.sitting,admission.status,admission.status_note');
		$this->db->join('admission','admission.regno=due_payments.regno');
		if($this->session->userdata('user_role')==2){
			//$this->db->where('faculty_id',$this->session->userdata('user_login'));
			$this->db->where('find_in_set("'.$fac.'", faculty_id) <> 0');
		}
		$total = $this->db->count_all_results('due_payments', FALSE);
		
		$this->db->order_by('due_date','asc');
		$this->db->limit($perpage,$start);
		$data['fees_data'] = $this->db->get()->result_array();
		$data['type'] = $list_type;
		$base_url = site_url('fees/ajax_pending_list');
		$pagination =pagination_new($total,$perpage,$base_url,3);
		$data['found_results'] = $total;
		$html = $this->load->view('ajax_search_pending_fees',$data,true);
		echo json_encode(array('data'=>$html,'pagination'=>$pagination,'found_results'=>$total));
	}
	function update_due_followup(){
		$regno = $this->input->post('regno');
		$follow_by = $this->input->post('follow_by');
		$note = $this->input->post('note');
		$new_date = date('Y-m-d'); 
		if($regno!="" && $regno!=0){
			$this->db->where('regno',$regno);
			$query = $this->db->get("due_payments")->result_array();
			$this->db->where('regno',$regno);
			$this->db->update('due_payments',array('follow_by'=>$follow_by,'follow_date'=>$new_date,'remark'=>$note));	
			echo 'Successfully Changed.';
		}else{
			echo 'Reg No. Missing';
		}
	}
	function due_delete_rows($type="due",$id=0){
		
		$this->db->where('id',$id);
		$this->db->delete('due_payments');
		if($type =="due"){
			redirect('due-fees');
		}else{
			redirect('upcoming-fees');
		}
	}
	function export_fees(){
		$this->load->library('exportexcel');
		$getdata =$this->db->get('fees')->result();
		$fields = $this->db->list_fields('fees');
		$this->exportexcel->export_data($fields,$getdata);
	}
	function export_due_data($type="due"){
		$cur_date = date('Y-m-d');
		$this->load->library('exportexcel');
		$this->db->select('due_payments.regno,admission.student_name,admission.contact,admission.father_contact,admission.batch_time,due_payments.amount,due_payments.due_date,admission.course,admin.name as faculty_name');
		$this->db->join('admission','admission.regno=due_payments.regno');
		$this->db->join('admin','admission.faculty_id=admin.id');
		if($this->session->userdata('user_role')==2){
			$this->db->where('find_in_set("'.$this->session->userdata('user_login').'", faculty_id) <> 0');
		}
		if($type=="due"){
			$this->db->where('due_date <=',$cur_date);
		}else{
			$this->db->where('due_date >',$cur_date);
		}
		$qry = $this->db->get('due_payments');
		$getdata = $qry->result();
		$fields = $qry->list_fields();
		$this->exportexcel->export_data($fields,$getdata);	
	}
	function ajax_get_student_details(){
		$data = array();
		$regno = $this->input->post('regno');
		$this->db->where('regno',$regno);
		$data = $this->db->get('admission')->row_array();
		$data['total_paid'] = $this->Fees_model->total_paid_fees($regno);
		echo json_encode($data);
	}
	function return_fees($action="update",$id=''){
		if($this->session->userdata('user_role')==2){
			redirect('staff-login');	
		}
		$data = array();
		if($action == "update"){
			$this->db->where('id',$id);
			$data['up'] = $this->db->get('course_return')->row_array();
			$r_no = $data['up']['reg_no'];
		}else if("add"){
			$data['reg_no'] = $id;	
			$r_no = $id;
		}
		$data['total_paid']  = $this->Fees_model->total_paid_fees($r_no);
		$data['allowance_paid']  = $this->Fees_model->total_paid_allowance($r_no);
		$data['action'] = $action;
		$data['rec_no']  = $this->db->get('course_return')->num_rows();
		
		if($this->input->post())
		{
			$regno = $this->input->post('regno');
			if($action == "update"){
				$recno = $this->input->post('recno');
			}else{
				$recno = $data['rec_no'] +1;
			}
			$student_name = $this->input->post('student_name');
			$course = $this->input->post('course');
			$amount = $this->input->post('amount');
			$payment_detail = $this->input->post('payment_detail');
			$payable_amount = $this->input->post('payable_amount');
			$next_amount = $this->input->post('next_amt');
			$date = $this->input->post('date');
			$arr = array('rec_no'=>$recno,'reg_no'=>$regno,'student_name'=>$student_name,'course'=>$course,'amount'=>$amount,'details'=>$payment_detail,'date'=>$date);
			if($id>0 && $action =="update")
			{
				$this->db->where('id',$id);
				$this->db->update('course_return',$arr);
			}
			else
			{
				$this->db->insert('course_return',$arr);
			}
			redirect('fees/view_return_fees');
		}
		$this->load->view('return_course_fees',$data);
	}
	function view_return_fees()
	{
		if($this->session->userdata('user_role')==2){
			redirect('staff-login');	
		}
		$arr = array();
		$year = "";
		$month = "";
		if($this->input->post())
		{
			$year = $this->input->post('year');
			$month = $this->input->post('month');
		}
		$start=$this->uri->segment(3);
		$total=$this->Fees_model->row_count_return(); 
		$base_url = site_url('fees/return_fees_rec');
		$pagination =pagination_new($total,$this->perpage,$base_url,3);
		$arr['fees_data'] = $this->Fees_model->view_return_data($this->perpage,$start);
		$arr['pagination'] = $pagination;
		$arr['perpage'] = $this->perpage;
		$this->load->view('view_return_fees',$arr);
	}
	function return_fees_rec()
	{
		$perpage=$this->input->post('perpage') ? $this->input->post('perpage') : $this->perpage;
		$start=$this->uri->segment(3);
		$search_by = $this->input->post('search_by');
		$search_keyword = $this->input->post('search_keyword');
		$year = $this->input->post('year');
		$month = $this->input->post('month');
		if($search_by=='byname')
		{
			$this->db->like('student_name',$search_keyword);
		}
		if($search_by=='byrec' && $search_keyword != '')
		{
			$this->db->where('rec_no',$search_keyword);
		}
		if($search_by=='byreg' && $search_keyword != '')
		{
			$this->db->where('reg_no',$search_keyword);
		}
		if($year!='')
		{
			$this->db->like('date',$year);
		}
		if($month!='' && $year!='')
		{
			$start_date = $year.'-'.$month.'-01';
			$end_date = date("Y-m-t", strtotime($start_date));

			$this->db->where('(date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'")');	
		}
		$total = $this->db->count_all_results('course_return', FALSE);
		$this->db->limit($perpage,$start);
		$this->db->order_by('id','desc');
		$data['fees_data'] = $this->db->get()->result_array();
		$base_url = site_url('fees/return_fees_rec');
		$pagination =pagination_new($total,$perpage,$base_url,3);
		$html = $this->load->view('ajax_return_course_fees',$data,true);
		echo json_encode(array('data'=>$html,'pagination'=>$pagination));
	}
	function add_allowance($action="update",$id=''){
		if($this->session->userdata('user_role')==2){
			redirect('staff-login');	
		}
		$data = array();
		if($action == "update"){
			$this->db->where('id',$id);
			$data['up'] = $this->db->get('allowance')->row_array();
		}else if("add"){
			$data['reg_no'] = $id;	
		}
		$data['action'] = $action;
		$data['rec_no']  = $this->db->get('allowance')->num_rows();
		if($this->input->post())
		{
			$regno = $this->input->post('regno');
			if($action == "update"){
				$recno = $this->input->post('recno');
			}else{
				$recno = $data['rec_no'] +1;
			}
			$student_name = $this->input->post('student_name');
			$course = $this->input->post('course');
			$amount = $this->input->post('amount');
			$payment_detail = $this->input->post('payment_detail');
			$payable_amount = $this->input->post('payable_amount');
			$pay_to = $this->input->post('pay_to');
			
			$date = $this->input->post('date');
			$arr = array('rec_no'=>$recno,'reg_no'=>$regno,'student_name'=>$student_name,'course'=>$course,'amount'=>$amount,'pay_to'=>$pay_to, 'details'=>$payment_detail,'date'=>$date);
			if($id>0 && $action =="update")
			{
				$this->db->where('id',$id);
				$this->db->update('allowance',$arr);
			}
			else
			{
				$this->db->insert('allowance',$arr);
			}
			redirect('fees/view_allowance');
		}
		$this->load->view('add_allowance',$data);
	}

	function view_allowance()
	{
		if($this->session->userdata('user_role')==2){
			redirect('staff-login');	
		}
		$arr = array();
		$year = "";
		$month = "";
		if($this->input->post())
		{
			$year = $this->input->post('year');
			$month = $this->input->post('month');
		}
		$start=$this->uri->segment(3);
		$total=$this->Fees_model->row_count_allowance(); 
		$base_url = site_url('fees/ajax_view_allowance');
		$pagination =pagination_new($total,$this->perpage,$base_url,3);
		$arr['fees_data'] = $this->Fees_model->view_allowance_data($this->perpage,$start);
		$arr['pagination'] = $pagination;
		$arr['perpage'] = $this->perpage;
		$this->load->view('view_allowance',$arr);
	}
	function ajax_view_allowance()
	{
		$perpage=$this->input->post('perpage') ? $this->input->post('perpage') : $this->perpage;
		$start=$this->uri->segment(3);
		$search_by = $this->input->post('search_by');
		$search_keyword = $this->input->post('search_keyword');
		$year = $this->input->post('year');
		$month = $this->input->post('month');
		if($search_by=='byname')
		{
			$this->db->like('student_name',$search_keyword);
		}
		if($search_by=='byrec' && $search_keyword != '')
		{
			$this->db->where('rec_no',$search_keyword);
		}
		if($search_by=='byreg' && $search_keyword != '')
		{
			$this->db->where('reg_no',$search_keyword);
		}
		if($year!='')
		{
			$this->db->like('date',$year);
		}
		if($month!='' && $year!='')
		{
			$start_date = $year.'-'.$month.'-01';
			$end_date = date("Y-m-t", strtotime($start_date));

			$this->db->where('(date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'")');	
		}
		$total = $this->db->count_all_results('allowance', FALSE);
		$this->db->limit($perpage,$start);
		$this->db->order_by('id','desc');
		$data['fees_data'] = $this->db->get()->result_array();
		$base_url = site_url('fees/ajax_view_allowance');
		$pagination =pagination_new($total,$perpage,$base_url,3);
		$html = $this->load->view('ajax_course_allowance',$data,true);
		echo json_encode(array('data'=>$html,'pagination'=>$pagination));
	}


	function fees_followup($id=0)
	{
		$this->db->where('due_payments.id',$id);
		$this->db->select('due_payments.*,admission.student_name as student_name');
		$this->db->join('admission','admission.regno=due_payments.regno','left');
		$query["fees_data"] = $this->db->get("due_payments")->result_array();

		$this->load->view('view_fees_followup',$query);
	}
}