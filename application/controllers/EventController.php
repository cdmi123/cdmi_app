<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class ApiController extends CI_Controller
{
    function __construct(){

		parent::__construct(); 
		$this->load->model('Admission_model');
		$this->load->model('Fees_model');
		$this->load->model('Exam_model');
		$this->load->library('form_validation');
        ob_start();
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

}

?>