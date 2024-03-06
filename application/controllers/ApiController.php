<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

use \Firebase\JWT\JWT;

class ApiController extends CI_Controller
{
    var $perpage=50;
    var $faculty_id = 0;
    var $status=1;

    function __construct(){

		parent::__construct();
        $this->load->model('Login_model');  
		$this->load->model('Admission_model');
		$this->load->model('Fees_model');
		$this->load->model('Exam_model');
		$this->load->library('form_validation');
        $this->load->helper('cookie');

        $tokens=apache_request_headers();

        if(isset($tokens['access_token']))
        {
            $jwt=$tokens['access_token'];
            $check_token = explode('.',$jwt);
            $token = $this->input->cookie('token',true);

            if($token!=$jwt && $token==""){
                $this->status = 0;}
        }
	}


    function Login()
    {
            $qry=$this->Login_model->check_user(); 
            $res=$qry->row_array(); 
            $num=$qry->num_rows();
            
            if($num==1)
            {
                $arr=$qry->row_array();

                $key = TOKEN_KEY;
                $iat = time(); // current timestamp value
                $exp = $iat + 3600;
      
                $payload = array(
                    "iss" => "Issuer of the JWT",
                    "aud" => "Audience that the JWT",
                    "sub" => "Subject of the JWT",
                    "iat" => $iat, //Time the JWT issued at
                    "exp" => $exp, // Expiration time of token
                    "email" => $arr['email'],
                );
          
                     $token = JWT::encode($payload, $key, 'HS256');

                if($arr['status'] == 1){

                    $admin_id=$arr['id'];
                    $this->session->set_userdata('user_login',$admin_id);
                    $this->session->set_userdata('user_role',$arr['role']);
                    $this->session->set_userdata('branch_id',$arr['branch_id']);
                    $this->session->set_userdata('dept_id',$arr['dept_id']);

                    $arr['token'] = $token;
                    
                    $cookie = array(
                            'name'   => 'token',
                            'value'  => $token,
                            'expire' => '60',
                    );

                    $this->input->set_cookie($cookie);

                    if($arr['role'] ==2){
                        return $this->output
                        ->set_status_header(200)
                        ->set_content_type('application/json')
                        ->set_output(json_encode($arr));
                    }else{
                        return $this->output
                        ->set_status_header(200)
                        ->set_content_type('application/json')
                        ->set_output(json_encode($arr));
                    }
                    
                }else if($arr['status'] == 0){
                    return $this->output
                        ->set_status_header(404)
                        ->set_content_type('application/json')
                        ->set_output(json_encode([
                        'error' => 'Your user is not activated.please contact to administrator.'
                    ]));
                }else if($arr['status'] == 2){
                    return $this->output
                        ->set_status_header(404)
                        ->set_content_type('application/json')
                        ->set_output(json_encode([
                        'error' => 'Your user is blocked.please contact to administrator.'
                    ]));
                }

            }else
            {
                 return $this->output
                ->set_status_header(404)
                ->set_content_type('application/json')
                ->set_output(json_encode([
                'error' => "Check your email and password",
                ]));
            }    
    }

    function student_details($qr_number)
    {
        $this->db->where('qr_number',$qr_number);

		$student = $this->db->get('college_admission')->row_array();

        if(!empty($student))
        {
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
            $this->db->where('reg_no',$student['regno']);
            $arr['installent'] = $this->db->get('college_fees')->result_array();
            $this->db->where('reg_no',$student['regno']);
            $arr['exam_fees'] = $this->db->get('exam_fees')->result_array();
            $this->db->where('reg_no',$student['regno']);
            $arr['certificate_fees'] = $this->db->get('certificate_fees')->result_array();
            $this->db->where('reg_no',$student['regno']);
            $arr['payment'] = $this->db->get('university_payment')->result_array();
            
            $this->db->where('regno',$student['regno']);
            $arr['leave'] = $this->db->get('attendence_reason')->result_array();

            $this->db->where('regno',$student['regno']);
            $this->db->select('college_test.*,admin.name as faculty_name');
            $this->db->join('admin','admin.id=college_test.faculty_id','left');
            $arr['progress_report'] = $this->db->get('college_test')->result_array();

            $this->db->where('regno',$student['regno']);
            $this->db->select('collage_student_complain.*,admin.name as faculty_name');
            $this->db->join('admin','admin.id=collage_student_complain.faculty_id','left');
            $arr['Complain_report'] = $this->db->get('collage_student_complain')->result_array();

            return $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode($arr));

        }else{
            
            return $this->output
            ->set_status_header(404)
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'error' => 'QR Not Found'
            ]));
        }
    }

    function student_complain($qr_number)
    {
        $this->db->where('qr_number',$qr_number);
		$student = $this->db->get('college_admission')->row_array();

        if(!empty($student))
        {
            $regno = $student['regno'];
          
            $remark = $this->input->post('remark');
		    $complian_date = $this->input->post('complain_date');
		    $faculty_id = $this->session->set_userdata('user_login');

		    $data = array('regno' =>$regno , 'remark'=>$remark,'complian_date'=>$complian_date,'faculty_id'=>$faculty_id);

            $this->db->insert('collage_student_complain',$data);

            return $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'status' => 'Complain Add Successfully'
            ]));
        }else{
            return $this->output
            ->set_status_header(404)
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'error' => 'QR Not Found'
            ]));
        }
    }

    function student_attendence($qr_number)
    {

        $cur_month = date("m");
        $cur_year = date("Y");

            $this->db->where('qr_number',$qr_number);
            $this->db->where('status','R');
            $this->db->where('college_mode','REG');
            $student_Data = $this->db->get('college_admission')->result_array();

            $start_session = $student_Data[0]['start_session'];
            $class_name = $student_Data[0]['class_name'];

        if($start_session == $cur_year){
            $college_year = "first";
        }else if($start_session+1 == $cur_year){
            $college_year = "second";
        }else if($start_session+2 == $cur_year){
            $college_year = "third";
        }else if($start_session+3 == $cur_year){
            $college_year = "fourth";
        }
                //echo $college_year; die();

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

            $class_name_id = $college_year.'-'.$class_name;

            if($start_sess!=''){
                $this->db->where('start_session',$start_sess);
            }

            $this->db->where('class_name',$class_name);
            $this->db->where('status','R');
            $this->db->where('college_mode','REG');
            $student_Data = $this->db->get('college_admission')->result_array();

            foreach ($student_Data as $key => $value){
                if($value['qr_number']==$qr_number){
                    $present_regno = $value['regno'];
                }
            }

                $date = date('Y-m-d');
                $this->db->where('class_name',$class_name_id);
                $this->db->where('attendence_date',$date);
                $qry = $this->db->get('student_attendence');

                $attendence_data = $qry->result_array();

                if($qry->num_rows()==0){

                    $present_data = array();

                    foreach($student_Data as $key => $value) {
                            $absent_data[] = $value['regno'];
                    }

                    foreach ($absent_data as $key => $value) {
                        
                            if($present_regno==$value){
                                 unset($absent_data[$key]);
                            }
                    }

                }else{

                    $absent_data = $attendence_data[0]['absent']; 
                    $absent_data = json_decode($absent_data);

                        if (is_object($absent_data)) {
                            $absent_data = get_object_vars($absent_data);
                        }

                        if(array_search($present_regno,$absent_data))
                        {

                            foreach ($absent_data as $key => $value) {

                                if($present_regno==$value)
                                {
                                    unset($absent_data[$key]);
                                }
                            }

                            $present_data =  json_decode($attendence_data[0]['attendence_data']);
                        }
                        else
                        {
                            return $this->output
                                ->set_status_header(200)
                                ->set_content_type('application/json')
                                ->set_output(json_encode([
                                    'status' => 'Student All Ready Present'
                            ]));
                        }
                }

                $absent_ids = $absent_data;

                array_push($present_data,$present_regno);

                $absent_data = json_encode($absent_ids);

                $present_data = json_encode($present_data);
                
                $saveArr = array(
                    'class_name'=>$class_name_id,
                    'attendence_date'=>$date,
                    'attendence_data'=>$present_data,   
                    'absent'=>$absent_data
                );

                if($qry->num_rows()>0){

                    $this->db->where('class_name',$class_name_id);
                    $this->db->where('attendence_date',$date);
                    $this->db->update('student_attendence',$saveArr);

                    return $this->output
                        ->set_status_header(200)
                        ->set_content_type('application/json')
                        ->set_output(json_encode([
                            'status' => 'Present'
                    ]));

                }else{

                    $this->db->insert('student_attendence',$saveArr);   

                        return $this->output
                            ->set_status_header(200)
                            ->set_content_type('application/json')
                            ->set_output(json_encode([
                                'status' => 'Present'
                        ]));
                }
    }

    // CPC App API

    function student_info($reg_no)
    {

        if($this->status==1)
        {
            $login_user = $this->session->userdata('user_login');
            $arr = array();
            $this->db->select('regno,student_name,image,course,course_content,join_date,end_date,contact,father_contact,batch_time,faculty_id,course_duration');
            $this->db->where('regno',$reg_no);
            
            $student = $this->db->get('admission')->row_array();

            if(!empty($student))
            {
                $this->db->select('regno,student_name,image,course,course_content,join_date,end_date,contact,father_contact,batch_time,faculty_id,course_duration,status');
                $this->db->where('regno',$reg_no);
                $student = $this->db->get('admission')->row_array();
           
            $arr['student'] = $student;


            $this->db->where_in('id',explode(',',$student['faculty_id']));
            $faculty = $this->db->get('admin')->result_array();
            $names = array();
            foreach($faculty as $fac){
                $names[] = $fac['name'];
            }
            $names = empty($names) ? 'Not Assigned' : implode(", ", $names);
            $arr['faculty'] = $names;

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

            $this->db->like('absent','"'.$reg_no.'"');
            $absent_report = $this->db->get('batch_attendence ');
            $absent_days = $absent_report->num_rows();

            $arr['absent_days'] = $absent_days;
            $arr['login_user'] = $login_user;

            $this->db->like('attendence_data','"'.$reg_no.'"');
            $present_report = $this->db->get('batch_attendence ');
            $present_days = $present_report->num_rows();
                    

            $arr['present_days'] = $present_days;

                return $this->output
                ->set_status_header(200)
                ->set_content_type('application/json')
                ->set_output(json_encode($arr));

            }else{
                
                return $this->output
                ->set_status_header(404)
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'error' => 'Reg_no Not Found'
                ]));
            }
        }else{
             return $this->output
                ->set_status_header(200)
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => 'Plzz Login User'
            ]));
        }
    }

    function view_stduent()
    {
        if($this->status==1)
        {
            $admission = array();
            $search_by = "";
            $search_keyword = "";
            
            $start=$this->uri->segment(3);
            $total=$this->Admission_model->row_count(); 
            
        
            $this->db->select('regno,student_name,image,course,course_content,join_date,contact,father_contact,batch_time,faculty_id,course_duration,status');
            $admission['admission_data'] = $this->Admission_model->view_admission_data($this->perpage,$start,$search_by,$search_keyword);
          
            $admission['found_results'] = $total;
                return $this->output
                ->set_status_header(200)
                ->set_content_type('application/json')
                ->set_output(json_encode($admission));
        }else{
             return $this->output
                ->set_status_header(200)
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => 'Plzz Login User'
            ]));
        }
    }

    function faculty_batch($faculty_id){
        
        if($this->status==1)
        { 
            
        $arr = array();
        $this->db->select('student_batches.*,admin.name');
        $this->db->join('admin','admin.id=student_batches.faculty_id','left');
        $arr['batch_data'] = $this->db->get_where('student_batches',array('faculty_id'=>$faculty_id))->result_array();
        $arr['course_batches'] = $this->db->get('course_batches')->result_array();

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

       
            return $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode($arr));

        }else{
             return $this->output
                ->set_status_header(200)
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => 'Plzz Login User'
            ]));
        }
    }


    /* Attendence API */

    function view_batches(){
        
        if($this->status==1)
        {
           $arr = array();
           $arr['student_batches'] = $this->db->get('student_batches')->result_array();
                   
                return $this->output
                ->set_status_header(200)
                ->set_content_type('application/json')
                ->set_output(json_encode($arr));
        }else{
             return $this->output
                ->set_status_header(200)
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => 'Plzz Login User'
            ]));
        }
    }

    function single_batch($batch_id)
    {
        if($this->status==1)
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

             return $this->output
                ->set_status_header(200)
                ->set_content_type('application/json')
                ->set_output(json_encode($arr));
        }else{
             return $this->output
                ->set_status_header(200)
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => 'Plzz Login User'
            ]));
        }
    }

    function regular_attendence($batch_id="")
    {
        if($this->status==1)
        {
            $date = date('Y-m-d');
            $this->db->where('id',$batch_id);
            $student_Batch = $this->db->get('student_batches')->row_array();

            $student_ids = explode(',', $student_Batch['student_ids']);

            $this->db->where('batch_id',$batch_id);
            $this->db->where('attendence_date',$date);
            $qry = $this->db->get('batch_attendence');

            $this->db->where('batch_id',$batch_id);
            $this->db->where('lecture_date',$date);
            $qry_lect_report = $this->db->get('lecture_report');
            
            $regno = $this->input->post('regno') ? $this->input->post('regno'):array();
            $regno = explode(',',$regno);
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

            return $this->output
                ->set_status_header(200)
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => 'present'
            ]));
        }else{
            return $this->output
                ->set_status_header(200)
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => 'Plzz Login User'
            ]));
        }
    }

    function student_marks($batch_id)
    {
        if($this->status==0)
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

             return $this->output
                ->set_status_header(200)
                ->set_content_type('application/json')
                ->set_output(json_encode($arr));
        }else{
             return $this->output
                ->set_status_header(200)
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => 'Plzz Login User'
            ]));
        }
    }
}

?>