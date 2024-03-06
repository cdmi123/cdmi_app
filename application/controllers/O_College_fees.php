<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class College_fees extends CI_Controller {
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
		$this->load->model('College_fees_model');
	}

	function index($action="add",$id='',$fees_type="")
	{
		$data = array();
		$data['accounts'] = $this->db->get('bank_accounts')->result_array();
		$this->db->where('branch_id',$this->session->userdata('branch_id'));
		$data['faculties'] = $this->db->get('admin')->result_array();
		if($action == "update"){
			if($fees_type=="regular"){
				$this->db->where('id',$id);
				$data['up'] = $this->db->get('college_fees')->row_array();
			}else if($fees_type=="exam"){
				$this->db->where('id',$id);
				$data['up'] = $this->db->get('exam_fees')->row_array();
			}else if($fees_type=="certificate"){
				$this->db->where('id',$id);
				$data['up'] = $this->db->get('certificate_fees')->row_array();
			}
		}else if($action == "add"){
			$data['reg_no'] = $id;	
		}
		$data['action'] = $action;
		
		$data['rec_no']  = $this->db->get('college_fees')->num_rows();
		if($this->input->post()) 
		{
			$regno = $this->input->post('regno');
			$student_name = $this->input->post('student_name');
			$course = $this->input->post('course');
			$ins_no = $this->input->post('ins_no');
			$amount = $this->input->post('amount');
			$date = $this->input->post('date');
			
			$extra_detail = $this->input->post('extra_detail');
			$pay_mode = $this->input->post('pay_mode');
			$payment_detail = $this->input->post('payment_detail');
			$create_by = $this->input->post('create_by');
			$gst = $this->input->post('gst');
			$tax_amount = $this->input->post('tax_amount');
			$ac_id = $this->input->post('ac_id');

			if($action == "update"){
				$recno = $this->input->post('recno');
			}else{
				$fees_type = $this->input->post('fees_type');
				if($fees_type=="regular"){
					$this->db->select_max('rec_no');
					$max_no  = $this->db->get('college_fees')->row_array();
					$recno  =isset($max_no['rec_no']) ? $max_no['rec_no']+1 : 1;

					$ac_rec_no = $this->db->get_where('college_fees',array('ac_id'=>$ac_id))->num_rows();
					$ac_rec_no+=1;
				}else if($fees_type=="exam"){
					$this->db->select_max('rec_no');
					$max_no  = $this->db->get('exam_fees')->row_array();
					$recno  =isset($max_no['rec_no']) ? $max_no['rec_no']+1 : 1;
				}else if($fees_type=="certificate"){
					$this->db->select_max('rec_no');
					$max_no  = $this->db->get('certificate_fees')->row_array();
					$recno  =isset($max_no['rec_no']) ? $max_no['rec_no']+1 : 1;
				}
			}

			$arr = array('rec_no'=>$recno,'reg_no'=>$regno,'student_name'=>strtoupper( $student_name),'course'=>strtoupper($course),'amount'=>$amount,'fees_type'=>$fees_type,'extra_detail'=>strtoupper($extra_detail),'pay_mode'=>$pay_mode,'payment_detail'=>strtoupper($payment_detail),'installment_no'=>$ins_no,'date'=>$date,'create_by'=>$create_by);
			if($fees_type=="regular"){
				$arr['ac_id']=$ac_id;
				$arr['ac_rec_no']=$ac_rec_no;
				$arr['gst']=$gst;
				$arr['tax_amount']=$tax_amount;
			}
			if($id > 0 && $action =="update")
			{
				if($fees_type == 'regular')
				{
					$this->db->where('id',$id);
					$this->db->update('college_fees',$arr);
					redirect('College_fees/view_college_fees');
				}elseif($fees_type == 'exam')
				{
					$this->db->where('id',$id);
					$this->db->update('exam_fees',$arr);
					redirect('College_fees/view_exam_fees');
				}
				elseif($fees_type == 'certificate')
				{
					$this->db->where('id',$id);
					$this->db->update('certificate_fees',$arr);
					redirect('College_fees/view_certificate_fees');
				}
			}
			else
			{
				if($fees_type == 'regular')
				{
					$this->db->insert('college_fees',$arr);
					redirect('College_fees/view_college_fees');
				}
				elseif($fees_type == 'exam')
				{
					$this->db->insert('exam_fees',$arr);
					redirect('College_fees/view_exam_fees');
				}
				elseif($fees_type == 'certificate')
				{
					$this->db->insert('certificate_fees',$arr);
					redirect('College_fees/view_certificate_fees');
				}
			}
			
		}
		$this->load->view('add_college_fees',$data);
	}

	function get_rec()
	{
		$data = array();
		$regno = $this->input->post('regno');
		$fees_type = $this->input->post('fees_type');
		$this->db->where('regno',$regno);
		$data = $this->db->get('college_admission')->row_array();
		if($fees_type=="regular"){
			$this->db->where('reg_no',$regno);
			$cnt = $this->db->get('college_fees')->num_rows();
			$data['count'] = $cnt+1;
			$this->db->select_max('rec_no');
			$max_no  = $this->db->get('college_fees')->row_array();
			$data['rec_no']  =isset($max_no['rec_no']) ? $max_no['rec_no']+1 : 1;
		}else if($fees_type=="exam"){
			$this->db->where('reg_no',$regno);
			$cnt = $this->db->get('exam_fees')->num_rows();
			$data['count'] = $cnt+1;
			$this->db->select_max('rec_no');
			$max_no  = $this->db->get('exam_fees')->row_array();
			$data['rec_no']  =isset($max_no['rec_no']) ? $max_no['rec_no']+1 : 1;
		}else if($fees_type=="certificate"){
			$this->db->where('reg_no',$regno);
			$cnt = $this->db->get('certificate_fees')->num_rows();
			$data['count'] = $cnt+1;

			$this->db->select_max('rec_no');
			$max_no  = $this->db->get('certificate_fees')->row_array();
			$data['rec_no']  =isset($max_no['rec_no']) ? $max_no['rec_no']+1 : 1;
		}
		echo json_encode($data);
	}


	function view_college_fees()
	{
		$arr = array();

		$year = "";
		$month = "";
		if($this->input->post())
		{
			$year = $this->input->post('year');
			$month = $this->input->post('month');
		}

		$this->load->library('pagination');
		
		$start=$this->uri->segment(3);

		$total=$this->College_fees_model->row_count(); 
		$base_url=site_url('College_fees/fees_rec');
		$pagination =pagination_new($total,$this->perpage,$base_url,3);
		$arr['pagination'] = $pagination;
		$arr['fees_data'] = $this->College_fees_model->view_fees_data($this->perpage,$start,$year,$month);
		$arr['perpage'] = $this->perpage;
		//echo $this->db->last_query();die;
		$this->db->where('branch_id',$this->session->userdata('branch_id'));
		$arr['faculties'] = $this->db->get('admin')->result_array();
		$this->load->view('view_college_fees',$arr);
	}

	function view_exam_fees()
	{
		$arr = array();
		$year = "";
		$month = "";
		if($this->input->post())
		{
			$year = $this->input->post('year');
			$month = $this->input->post('month');
		}
		$start=$this->uri->segment(3);
		$total=$this->College_fees_model->exam_row_count(); 
		$base_url=site_url('College_fees/fees_rec');
		$pagination =pagination_new($total,$this->perpage,$base_url,3);
		$arr['fees_data'] = $this->College_fees_model->view_exam_fees_data($this->perpage,$start,$year,$month);
		$arr['pagination'] = $pagination;
		$arr['perpage'] = $this->perpage;
		//echo $this->db->last_query();die;
		$this->load->view('view_exam_fees',$arr);
	}

	function view_certificate_fees()
	{
		$arr = array();

		$year = "";
		$month = "";
		if($this->input->post())
		{
			$year = $this->input->post('year');
			$month = $this->input->post('month');
		}

		
		$start=$this->uri->segment(3);
		$total=$this->College_fees_model->certificate_row_count(); 
		$base_url=site_url('College_fees/fees_rec');
		$pagination =pagination_new($total,$this->perpage,$base_url,3);
		$arr['fees_data'] = $this->College_fees_model->view_certificate_fees_data($this->perpage,$start,$year,$month);
		$arr['pagination'] = $pagination;
		$arr['perpage'] = $this->perpage;
		//echo $this->db->last_query();die;
		$this->load->view('view_certificate_fees',$arr);
	}


	function fees_rec()
	{
		$perpage = $this->input->post('perpage') ? $this->input->post('perpage') : $this->perpage;
		$start=$this->uri->segment(3);
		$search_by = $this->input->post('search_by');
		$search_keyword = $this->input->post('search_keyword');
		$fees_type = $this->input->post('fees_type') ? $this->input->post('fees_type') : "regular";
		$created_by = $this->input->post('created_by');
		$pay_mode = $this->input->post('mode');
		$year = $this->input->post('year');
		$month = $this->input->post('month');
		if($fees_type == "exam"){
			$table = "exam_fees";
		}else if($fees_type == "certificate"){
			$table = "certificate_fees";
		}else{
			$table = "college_fees";
		}
		
		if($search_by!=""){
			if($search_by=='byrec')
			{
				$this->db->where('rec_no',$search_keyword);
			}
			if($search_by=='byname')
			{
				$this->db->like('student_name',$search_keyword);
			}
			if($search_by=='byreg')
			{
				$this->db->where('reg_no',$search_keyword);
			}
			if($search_by=='bydetails' && $search_keyword!='')
			{
				$this->db->like($table.'.payment_detail',$search_keyword);
			}
		}
		if($pay_mode!='')
		{
			$this->db->like($table.'.pay_mode',$pay_mode);
		}
		if($created_by != '')
		{
			$this->db->where('create_by',$created_by);
		}
		if($year!='')
		{
			$this->db->like('date',$year);
		}
		$this->db->select($table.'.*,admin.name as create_by');
		$this->db->join('admin','admin.id='.$table.'.create_by','left');
		$total = $this->db->count_all_results($table, FALSE);
		$this->db->limit($perpage,$start);
		$this->db->order_by($table.'.id','desc');
		$data['fees_data'] = $this->db->get()->result_array();
		$data['fees_type'] = $fees_type;
		$base_url = site_url('College_fees/fees_rec');
		$pagination =pagination_new($total,$perpage,$base_url,3);
		$html = $this->load->view('ajax_search_college_fees',$data,true);
		echo json_encode(array('data'=>$html,'pagination'=>$pagination));
	}
	function print_receipt($fees_type="regular",$id =0){
		//echo getIndianCurrency(10000.57);die;
		$data =array();
		if($fees_type=="regular"){
			$this->db->where('id',$id);
			$data['info'] = $this->db->get('college_fees')->row_array();

			if($data['info']['ac_id']>0){
				$this->db->where('ac_id',$data['info']['ac_id']);
				$ac_info = $this->db->get('bank_accounts')->row_array();
				$data['ac_info'] = $ac_info;
			}
		}else if($fees_type=="exam"){
			$this->db->where('id',$id);
			$data['info'] = $this->db->get('exam_fees')->row_array();
		}else if($fees_type=="certificate"){
			$this->db->where('id',$id);
			$data['info'] = $this->db->get('certificate_fees')->row_array();
		}
		
		//pre($data);die;
		$this->load->view('print_receipt',$data);	
	}
	function export_college_fees(){
		$this->load->library('exportexcel');
		$getdata =$this->db->get('college_fees')->result();
		$fields = $this->db->list_fields('college_fees');
		$this->exportexcel->export_data($fields,$getdata);
	}
	function export_exam_fees(){
		$this->load->library('exportexcel');
		$this->db->select('exam_fees.*,college_admission.university,college_admission.start_session');
		$this->db->join('college_admission','college_admission.regno=exam_fees.reg_no');
		$this->db->order_by('exam_fees.id','asc');
		$getdata =$this->db->get('exam_fees')->result();
		//pre($getdata);die;
		$fields = $this->db->list_fields('exam_fees');
		$this->exportexcel->export_data($fields,$getdata);
	}
	function export_cert_fees(){
		$this->load->library('exportexcel');
		$getdata =$this->db->get('certificate_fees')->result();
		$fields = $this->db->list_fields('certificate_fees');
		$this->exportexcel->export_data($fields,$getdata);
	}
	function update_fee_date(){
		$data = $this->db->get('college_fees')->result_array();
		foreach($data as $row){
			$date = explode("/",$row['date']);
			$arr = array('date'=>$date[2].'-'.$date[0].'-'.$date[0]);
			$this->db->where('id',$row['id']);
			$this->db->update('college_fees',$arr);
		}
	}
	function update_join_date(){
		$data = $this->db->get('college_admission')->result_array();
		foreach($data as $row){
			$date = explode("/",$row['join_date']);
			$arr = array('join_date'=>$date[2].'-'.$date[0].'-'.$date[0]);
			
			$this->db->where('id',$row['id']);
			$this->db->update('college_admission',$arr);
		}
	}

	function ajax_get_student_details(){
		$data = array();
		$regno = $this->input->post('regno');
		$this->db->where('regno',$regno);
		$data = $this->db->get('college_admission')->row_array();
		$data['total_paid'] = $this->College_fees_model->total_paid_fees($regno);
		echo json_encode($data);
	}
	function return_fees($action="update",$id=''){
		if($this->session->userdata('user_role')==2){
			redirect('staff-login');	
		}
		$data = array();
		if($action == "update"){
			$this->db->where('id',$id);
			$data['up'] = $this->db->get('college_return')->row_array();
			$r_no = $data['up']['reg_no'];
		}else if("add"){
			$data['reg_no'] = $id;	
			$r_no = $id;
		}
		$data['total_paid']  = $this->College_fees_model->total_paid_fees($r_no);
		$data['allowance_paid']  = $this->College_fees_model->total_paid_allowance($r_no);
		$data['action'] = $action;
		$data['rec_no']  = $this->db->get('college_return')->num_rows();
		
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
				$this->db->update('college_return',$arr);
			}
			else
			{
				$this->db->insert('college_return',$arr);
			}
			redirect('college_fees/view_return_fees');
		}
		$this->load->view('return_college_fees',$data);
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
		$total=$this->College_fees_model->row_count_return(); 
		$base_url = site_url('college_fees/return_fees_rec');
		$pagination =pagination_new($total,$this->perpage,$base_url,3);
		$arr['fees_data'] = $this->College_fees_model->view_return_data($this->perpage,$start);
		$arr['pagination'] = $pagination;
		$arr['perpage'] = $this->perpage;
		$this->load->view('view_clg_return_fees',$arr);
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
		$total = $this->db->count_all_results('college_return', FALSE);
		$this->db->limit($perpage,$start);
		$this->db->order_by('id','desc');
		$data['fees_data'] = $this->db->get()->result_array();
		$base_url = site_url('college_fees/return_fees_rec');
		$pagination =pagination_new($total,$perpage,$base_url,3);
		$html = $this->load->view('ajax_return_college_fees',$data,true);
		echo json_encode(array('data'=>$html,'pagination'=>$pagination));
	}
	function add_allowance($action="update",$id=''){
		if($this->session->userdata('user_role')==2){
			redirect('staff-login');	
		}
		$data = array();
		if($action == "update"){
			$this->db->where('id',$id);
			$data['up'] = $this->db->get('college_allowance')->row_array();
		}else if("add"){
			$data['reg_no'] = $id;	
		}
		$data['action'] = $action;
		$data['rec_no']  = $this->db->get('college_allowance')->num_rows();
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
				$this->db->update('college_allowance',$arr);
			}
			else
			{
				$this->db->insert('college_allowance',$arr);
			}
			redirect('college_fees/view_allowance');
		}
		$this->load->view('add_clg_allowance',$data);
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
		$total=$this->College_fees_model->row_count_allowance(); 
		$base_url = site_url('college_fees/ajax_view_allowance');
		$pagination =pagination_new($total,$this->perpage,$base_url,3);
		$arr['fees_data'] = $this->College_fees_model->view_allowance_data($this->perpage,$start);
		$arr['pagination'] = $pagination;
		$arr['perpage'] = $this->perpage;
		$this->load->view('view_clg_allowance',$arr);
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
		$total = $this->db->count_all_results('college_allowance', FALSE);
		$this->db->limit($perpage,$start);
		$this->db->order_by('id','desc');
		$data['fees_data'] = $this->db->get()->result_array();
		$base_url = site_url('college_fees/ajax_view_allowance');
		$pagination =pagination_new($total,$perpage,$base_url,3);
		$html = $this->load->view('ajax_course_allowance',$data,true);
		echo json_encode(array('data'=>$html,'pagination'=>$pagination));
	}
}