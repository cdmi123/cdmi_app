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

    function check_number()
    {
        $contact_no = $this->input->post('contact_no');
        $query = $this->db->get('admission')->where("contact LIKE '%$contact_no%'")->row_array();
        $find_contact = $query->count();
        echo $find_contact; die();
    }
}

?>