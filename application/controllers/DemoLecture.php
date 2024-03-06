<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DemoLecture extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('user_login')){
			redirect('staff-login');
		}	
		$this->load->model('Inquiry_model');
		$this->load->model('DemoLectureModel');
	}
	public function add_demo_offline($source="",$id=0)
	{	
		$data =array();
		$data['inq_id'] = $id;
		$data['course_data'] = $this->db->get('course')->result_array();
		$data['faculties'] = $this->db->get('admin')->result_array();
		if($id>0){
			if($source == "offline"){
				$this->db->where('id',$id);
				$inquiry_info = $this->db->get('inq_offline')->row_array();
			}else if($source == "justdial"){
				$this->db->where('id',$id);
				$inquiry_info = $this->db->get('inq_justdial')->row_array();
			}else if($source == "call"){
				$this->db->where('id',$id);
				$inquiry_info = $this->db->get('inq_call')->row_array();
			}else if($source == "website"){
				$this->db->where('id',$id);
				$inquiry_info = $this->db->get('inq_web')->row_array();
			}
			$data['inquiry_data'] = $inquiry_info;
		}
		if($this->input->post())
		{
			
			$inq_id = $this->input->post('inq_id');
			$batch_time = $this->input->post('batch_time');
			$demo_date = $this->input->post('demo_date');
			$status = $this->input->post('status');
			
			$demo_faculty=$this->session->userdata('user_login');
			$sitting_type = $this->input->post('sitting');
			$pcno = ($sitting_type=="pc") ? $this->input->post('pcno') : 0;
			$runnig_topic = $this->input->post('running_topic');
			$arr = array('inq_id'=>$inq_id, 'batch_time'=>$batch_time,'demo_start'=>$demo_date,'sitting_type'=>$sitting_type,'sitting_no'=>$pcno,'faculty_id'=>$demo_faculty,'source'=>$source);
			$this->DemoLectureModel->insert_data($arr);
			$demo_id = $this->db->insert_id();
			if($source == "offline"){
				$this->db->where('id',$id);
				$this->db->update('inq_offline',array('status'=>1));
			}else if($source == "justdial"){
				$this->db->where('id',$id);
				$this->db->update('inq_justdial',array('status'=>1));
			}else if($source == "call"){
				$this->db->where('id',$id);
				$this->db->update('inq_call',array('status'=>1));
			}else if($source == "website"){
				$this->db->where('id',$id);
				$this->db->update('inq_web',array('status'=>1));
			}

			redirect('demolecture/my_demo_students');
		}
		$this->load->view('demo_offline',$data);
	}


	function my_demo_students()
	{

		$search_by = "";
		$search_keyword = "";
		
	    $this->load->library('pagination');
		$perpage=4;
		$start=$this->uri->segment(3);

		$total=$this->DemoLectureModel->row_count($search_by,$search_keyword,$search_by,$search_keyword);
		$config['base_url']=site_url('inquiry/view_inquiry');
		$config['total_rows']=$total;
		$config['per_page']=$perpage;
		$config['full_tag_open']='<div class="pagination">';
		$config['full_tag_close']='</div>';
		$config['cur_tag_open']='<a class="active">';
		$config['cur_tag_close']='</a>';
		$config['next_link']='Next';
		$config['prev_link']='Prev';
		$this->pagination->initialize($config);
		$data['arr']=$this->DemoLectureModel->get_demo_students($perpage,$start,$search_by,$search_keyword);
		//echo '<pre>';print_r($data);die;	
		$this->load->view('view_mydemos',$data);
	}

	function update_status($inq_id,$status)
	{
		$this->load->model('Inquiry_model');
		$arr = array('status'=>$status);
		$this->Inquiry_model->update($inq_id,$arr);	
		redirect('inquiry/view_inquiry');
	}

	 public function userList()
	 {
	 	$this->load->model('Inquiry_model');
    // POST data
    	$postData = $this->input->post();


    // Get data
    		$data = $this->Inquiry_model->getUsers($postData);

    		echo json_encode($data);
  	}


  	function show_all()
  	{
  		
  	}



  	function today_followup()
	{

		$search_by = "";
		$search_keyword = "";

		if($this->input->post('see_all'))
		{
				$this->session->unset_userdata('search_by');
			$this->session->unset_userdata('search_keyword');			
		}
		if($this->input->post('search'))
		{

			//echo '<pre>';print_r($this->input->post());die;
			$search_by = $this->input->post('search_by');
			$search_keyword = $this->input->post('search_keyword');
			$this->session->set_userdata('search_by',$search_by);
			$this->session->set_userdata('search_keyword',$search_keyword);
		}else if($this->session->userdata('search_keyword')){
			$search_by = $this->session->userdata('search_by');
			$search_keyword = $this->session->userdata('search_keyword');
		}

		$this->load->model('Inquiry_model');

	    $this->load->library('pagination');
		$perpage=4;
		$start=$this->uri->segment(3);

		$total=$this->Inquiry_model->row_count($search_by,$search_keyword,$search_by,$search_keyword);
		$config['base_url']=site_url('inquiry/view_inquiry');
		$config['total_rows']=$total;
		$config['per_page']=$perpage;
		$config['full_tag_open']='<div class="pagination">';
		$config['full_tag_close']='</div>';
		$config['cur_tag_open']='<a class="active">';
		$config['cur_tag_close']='</a>';
		$config['next_link']='Next';
		$config['prev_link']='Prev';
		$this->pagination->initialize($config);
		$data['arr']=$this->Inquiry_model->view_data($perpage,$start,$search_by,$search_keyword);	
		$this->load->view('view_inquiry',$data);
	}



	function justdial($id=0)
	{
		$this->load->model('Inquiry_model');

		$course['course_data'] = $this->db->get('course')->result_array();
		if($id>0){
			$this->db->where('id',$id);
			$course['update_data'] = $this->db->get('inq_justdial')->row_array();
		}
		if($this->input->post())
		{
			//echo '<pre>';print_r($this->input->post());die;

			$name = $this->input->post('name');
			$contact = $this->input->post('contact');
			$course = $this->input->post('course');
			@$course_arr = implode(',', $course);
			$visit_date = $this->input->post('visit_date');
			$fees = $this->input->post('fees');
			$location = $this->input->post('location');
			$enq_by = $this->input->post('enq_by');	
		$status = $this->input->post('status');
			$extra_info = $this->input->post('extra_info');
			$demo_faculty_name = $this->input->post('faculty_name');


			$this->load->library('form_validation');
			$this->form_validation->set_rules('name','Name','required');
			$this->form_validation->set_rules('contact','Contact','required|numeric|exact_length[10]|regex_match[/^[0-9]{10}$/]');
			//$this->form_validation->set_rules('course','Course','required');




			$arr = array('name'=>$name,'contact'=>$contact,'course'=>$course_arr,'visiting_date'=>$visit_date,'demo_faculty_name'=>$demo_faculty_name,'fees'=>$fees,'inquiry_by'=>$enq_by,'status'=>$status,'location'=>$location);

			//echo '<pre>';print_r($arr);

			if ($this->form_validation->run() == FALSE)
			{

				//echo validation_errors();
				//$data['name']=set_value('name');
				
				
			}
			else
			{

				if($id>0)
				{
					$this->Inquiry_model->justdial_update($id,$arr);	
				}
				else
				{

				//echo 'hello';die;
					$this->Inquiry_model->justdial_insert_data($arr);
					$inquiry_id = $this->db->insert_id();
					$arr1 = array('inquiry_id'=>$inquiry_id,'followup_reason'=>$extra_info,'followup_by'=>$enq_by);
					$this->Inquiry_model->justdial_followup_data($arr1);
					SMSSend($contact,'Thank you for interest with Creative Multimedia.Visit Again.');
				}
			}
			redirect('inquiry/view_justdial_inquiry');
		}
		$this->load->view('justdial_inquiry',$course);	
	}



	function view_justdial_inquiry()
	{

		$search_by = "";
		$search_keyword = "";

		if($this->input->post('see_all'))
		{
				$this->session->unset_userdata('search_by');
			$this->session->unset_userdata('search_keyword');			
		}
		if($this->input->post('search'))
		{

			//echo '<pre>';print_r($this->input->post());die;
			$search_by = $this->input->post('search_by');
			$search_keyword = $this->input->post('search_keyword');
			$this->session->set_userdata('search_by',$search_by);
			$this->session->set_userdata('search_keyword',$search_keyword);
		}else if($this->session->userdata('search_keyword')){
			$search_by = $this->session->userdata('search_by');
			$search_keyword = $this->session->userdata('search_keyword');
		}

		$this->load->model('Inquiry_model');

	    $this->load->library('pagination');
		$perpage=4;
		$start=$this->uri->segment(3);

		$total=$this->Inquiry_model->justdial_row_count($search_by,$search_keyword,$search_by,$search_keyword);
		$config['base_url']=site_url('inquiry/view_justdial_inquiry');
		$config['total_rows']=$total;
		$config['per_page']=$perpage;
		$config['full_tag_open']='<div class="pagination">';
		$config['full_tag_close']='</div>';
		$config['cur_tag_open']='<a class="active">';
		$config['cur_tag_close']='</a>';
		$config['next_link']='Next';
		$config['prev_link']='Prev';
		$this->pagination->initialize($config);
		$data['arr']=$this->Inquiry_model->justdial_view_data($perpage,$start,$search_by,$search_keyword);	
		$this->load->view('view_justdial_inquiry',$data);
	}




	function call($id=0)
	{
		$this->load->model('Inquiry_model');

		$course['course_data'] = $this->db->get('course')->result_array();
		if($id>0){
			$this->db->where('id',$id);
			$course['update_data'] = $this->db->get('inq_call')->row_array();
		}
		if($this->input->post())
		{
			//echo '<pre>';print_r($this->input->post());die;

			$name = $this->input->post('name');
			$contact = $this->input->post('contact');
			$course = $this->input->post('course');
			@$course_arr = implode(',', $course);
			$visit_date = $this->input->post('visit_date');
			$fees = $this->input->post('fees');
			$location = $this->input->post('location');
			$enq_by = $this->input->post('enq_by');
			$status = $this->input->post('status');
			$extra_info = $this->input->post('extra_info');
			$demo_faculty_name = $this->input->post('faculty_name');


			$this->load->library('form_validation');
			$this->form_validation->set_rules('name','Name','required');
			$this->form_validation->set_rules('contact','Contact','required|numeric|exact_length[10]|regex_match[/^[0-9]{10}$/]');
			//$this->form_validation->set_rules('course','Course','required');




			$arr = array('name'=>$name,'contact'=>$contact,'course'=>$course_arr,'visiting_date'=>$visit_date,'demo_faculty_name'=>$demo_faculty_name,'fees'=>$fees,'inquiry_by'=>$enq_by,'status'=>$status,'location'=>$location);

			//echo '<pre>';print_r($arr);

			if ($this->form_validation->run() == FALSE)
			{

				//echo validation_errors();
				//$data['name']=set_value('name');
				
				
			}
			else
			{

				if($id>0)
				{
					$this->Inquiry_model->call_update($id,$arr);	
				}
				else
				{

				//echo 'hello';die;
					$this->Inquiry_model->call_insert_data($arr);
					$inquiry_id = $this->db->insert_id();
					$arr1 = array('inquiry_id'=>$inquiry_id,'followup_reason'=>$extra_info,'followup_by'=>$enq_by);
					$this->Inquiry_model->call_followup_data($arr1);
					SMSSend($contact,'Thank you for interest with Creative Multimedia.Visit Again.');
				}
			}
			redirect('inquiry/view_call_inquiry');
		}
		$this->load->view('call_inquiry',$course);	
	}



	function view_call_inquiry()
	{

		$search_by = "";
		$search_keyword = "";

		if($this->input->post('see_all'))
		{
				$this->session->unset_userdata('search_by');
			$this->session->unset_userdata('search_keyword');			
		}
		if($this->input->post('search'))
		{

			//echo '<pre>';print_r($this->input->post());die;
			$search_by = $this->input->post('search_by');
			$search_keyword = $this->input->post('search_keyword');
			$this->session->set_userdata('search_by',$search_by);
			$this->session->set_userdata('search_keyword',$search_keyword);
		}else if($this->session->userdata('search_keyword')){
			$search_by = $this->session->userdata('search_by');
			$search_keyword = $this->session->userdata('search_keyword');
		}

		$this->load->model('Inquiry_model');

	    $this->load->library('pagination');
		$perpage=4;
		$start=$this->uri->segment(3);

		$total=$this->Inquiry_model->call_row_count($search_by,$search_keyword,$search_by,$search_keyword);
		$config['base_url']=site_url('inquiry/view_call_inquiry');
		$config['total_rows']=$total;
		$config['per_page']=$perpage;
		$config['full_tag_open']='<div class="pagination">';
		$config['full_tag_close']='</div>';
		$config['cur_tag_open']='<a class="active">';
		$config['cur_tag_close']='</a>';
		$config['next_link']='Next';
		$config['prev_link']='Prev';
		$this->pagination->initialize($config);
		$data['arr']=$this->Inquiry_model->call_view_data($perpage,$start,$search_by,$search_keyword);	
		$this->load->view('view_call_inquiry',$data);
	}


	


	function web($id=0)
	{
		$this->load->model('Inquiry_model');

		$course['course_data'] = $this->db->get('course')->result_array();
		if($id>0){
			$this->db->where('id',$id);
			$course['update_data'] = $this->db->get('inq_web')->row_array();
		}
		if($this->input->post())
		{
			//echo '<pre>';print_r($this->input->post());die;

			$name = $this->input->post('name');
			$contact = $this->input->post('contact');
			$course = $this->input->post('course');
			@$course_arr = implode(',', $course);
			$visit_date = $this->input->post('visit_date');
			$fees = $this->input->post('fees');
			$location = $this->input->post('location');
			$enq_by = $this->input->post('enq_by');
			$status = $this->input->post('status');
			$extra_info = $this->input->post('extra_info');
			$demo_faculty_name = $this->input->post('faculty_name');


			$this->load->library('form_validation');
			$this->form_validation->set_rules('name','Name','required');
			$this->form_validation->set_rules('contact','Contact','required|numeric|exact_length[10]|regex_match[/^[0-9]{10}$/]');
			//$this->form_validation->set_rules('course','Course','required');




			$arr = array('name'=>$name,'contact'=>$contact,'course'=>$course_arr,'visiting_date'=>$visit_date,'demo_faculty_name'=>$demo_faculty_name,'fees'=>$fees,'inquiry_by'=>$enq_by,'status'=>$status,'location'=>$location);

			//echo '<pre>';print_r($arr);

			if ($this->form_validation->run() == FALSE)
			{

				//echo validation_errors();
				//$data['name']=set_value('name');
				
				
			}
			else
			{

				if($id>0)
				{
					$this->Inquiry_model->web_update($id,$arr);	
				}
				else
				{

				//echo 'hello';die;
					$this->Inquiry_model->web_insert_data($arr);
					$inquiry_id = $this->db->insert_id();
					$arr1 = array('inquiry_id'=>$inquiry_id,'followup_reason'=>$extra_info,'followup_by'=>$enq_by);
					$this->Inquiry_model->web_followup_data($arr1);
					SMSSend($contact,'Thank you for interest with Creative Multimedia.Visit Again.');
				}
			}
			redirect('inquiry/view_web_inquiry');
		}
		$this->load->view('web_inquiry',$course);	
	}


	function view_web_inquiry()
	{

		$search_by = "";
		$search_keyword = "";

		if($this->input->post('see_all'))
		{
				$this->session->unset_userdata('search_by');
			$this->session->unset_userdata('search_keyword');			
		}
		if($this->input->post('search'))
		{

			//echo '<pre>';print_r($this->input->post());die;
			$search_by = $this->input->post('search_by');
			$search_keyword = $this->input->post('search_keyword');
			$this->session->set_userdata('search_by',$search_by);
			$this->session->set_userdata('search_keyword',$search_keyword);
		}else if($this->session->userdata('search_keyword')){
			$search_by = $this->session->userdata('search_by');
			$search_keyword = $this->session->userdata('search_keyword');
		}

		$this->load->model('Inquiry_model');

	    $this->load->library('pagination');
		$perpage=4;
		$start=$this->uri->segment(3);

		 $total=$this->Inquiry_model->web_row_count($search_by,$search_keyword,$search_by,$search_keyword);
		$config['base_url']=site_url('inquiry/view_web_inquiry');
		$config['total_rows']=$total;
		$config['per_page']=$perpage;
		$config['full_tag_open']='<div class="pagination">';
		$config['full_tag_close']='</div>';
		$config['cur_tag_open']='<a class="active">';
		$config['cur_tag_close']='</a>';
		$config['next_link']='Next';
		$config['prev_link']='Prev';
		$this->pagination->initialize($config);
		$data['arr']=$this->Inquiry_model->web_view_data($perpage,$start,$search_by,$search_keyword);	
		$this->load->view('view_web_inquiry',$data);
	}









}
