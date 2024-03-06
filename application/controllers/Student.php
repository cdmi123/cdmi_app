<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

use \Firebase\JWT\JWT;

class Student extends CI_Controller
{
    var $perpage=50;
    var $faculty_id = 0;
    var $status=1;

    function __construct(){

		parent::__construct();
	}

    function check_number()
    {
        $contact = $this->input->post('contact');

        $this->db->where('contact',$contact);
        $query = $this->db->get('admission');
        $data = $query->result_array();

        $count = $query->num_rows();
        $this->session->set_userdata('student_id',$data[0]['id']);


         return $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'status' => $count
            ]));
    }

    function set_password()
    {
        $password = $this->input->post('password');

        $password_array = array('password'=>$password);

        $this->db->where('id',$this->session->userdata('student_id'));
        $query = $this->db->update('admission',$password_array);

        $this->load->driver('cache');
        $this->session->sess_destroy();
        $this->cache->clean();
        ob_clean();

         return $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'status' => "Account Set successfully"
            ]));
    }

    function login()
    {
        $contact = $this->input->post('contact');
        $password = $this->input->post('password');

        $this->db->where('contact',$contact);
        $this->db->where('password',$password);
        $query = $this->db->get('admission');

            $login_data = $query->result_array();
            $login_count = $query->num_rows();

            if($login_count==1)
            {
                $this->session->set_userdata('student_id',$login_data[0]['id']);

                 return $this->output
                    ->set_status_header(200)
                    ->set_content_type('application/json')
                    ->set_output(json_encode([
                        'status' => "Login successfully"
                    ]));
            }else{
                return $this->output
                    ->set_status_header(200)
                    ->set_content_type('application/json')
                    ->set_output(json_encode([
                        'status' => "Check Your email and password"
                    ]));
            }
    }

    function count_total_days()
    {
        $this->db->where('id',$this->session->userdata('student_id'));
        $student_data = $this->db->get('admission')->result_array();

        $today_date = date("Y-m-d");

        $start_date = $student_data[0]['join_date'];
        $end_date = $student_data[0]['end_date'];

        /* total days counting */
            $startTimeStamp = strtotime($start_date);
            $endTimeStamp = strtotime($end_date);
            $timeDiff = abs($endTimeStamp - $startTimeStamp);
            $numberDays = $timeDiff/86400;  
            $numberDays = intval($numberDays);

            /* pending days counting */
                $startTimeStamp1 = strtotime($start_date);
                $endTimeStamp1 = strtotime($today_date);
                $timeDiff = abs($endTimeStamp1 - $startTimeStamp1);
                $numberDays1 = $timeDiff/86400;  
                $numberDays1 = intval($numberDays1);
                $total_due_days = $numberDays - $numberDays1;

         return $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'Total_Days' => $numberDays,
                'Due_Days' => $total_due_days,

            ]));
    }

    function get_total_leave()
    {
        $this->db->like('absent','"'.$this->session->userdata('student_id').'"');
        $absent_report = $this->db->get('batch_attendence ');
        $absent_days = $absent_report->num_rows();

         return $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'Total_Leave' => $absent_days
            ]));
    }

    function get_leave_remark()
    {
        $this->db->where('regno',$this->session->userdata('student_id'));
        $absent_report = $this->db->get('course_attendence');
        $absent_report = $absent_report->result_array();

         return $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'Total_Leave' => $absent_report
            ]));
    }

     function get_total_present()
    {
        $this->db->like('attendence_data','"'.$this->session->userdata('student_id').'"');
        $present_report = $this->db->get('batch_attendence');
        $present_days = $present_report->num_rows();

         return $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'Total Present' => $present_days
            ]));
    }

    function get_total_complain()
    {
        $this->db->where('regno',$this->session->userdata('student_id'));
        $complain_report = $this->db->get('complian_report');
        $complain_report = $complain_report->num_rows();

         return $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'Total_complain' => $complain_report
            ]));
    }

    function get_complain()
    {
        $this->db->where('regno',$this->session->userdata('student_id'));
        $complain_report = $this->db->get('complian_report')->result_array();

         return $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'complain' => $complain_report
            ]));
    }

    function get_exam_report()
    {
        $this->db->where('regno',$this->session->userdata('student_id'));
        $exam_report = $this->db->get('student_test')->result_array();

         return $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'Exam_report' => $exam_report
            ]));
    }

    function course_subject()
    {
        
    }
}

?>