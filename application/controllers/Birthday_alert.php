<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Birthday_alert extends CI_Controller {
	function __construct()
	{
		parent::__construct();	
			
	}

	public function index()
	{
		$today_date = date('Y-m-d');
		$this->db->select('surname,first_name,birth_date,contact');
		$this->db->where('MONTH(birth_date)', date('m'));
		$this->db->where('DAY(birth_date)', date('d'));
		$all_recs = $this->db->get('admission')->result_array();
		// $name = "Paresh Chauhan";
		// $msg= "Dear $name, Wishing you a day full of laughter and happiness and a year that brings you much success.Wish you very Happy Birthday.Best Regards,Creative Multimedia Institute";
		// 		SMSSend(9033316003,$msg);die;
		//echo last_query();
		//pre($all_recs);die;
		$i=0;
		foreach($all_recs as $row){
			$name = $row['surname'].' '.$row['first_name'];
			$contact = $row['contact'];
			$mobileregex = "/^[6-9][0-9]{9}$/" ;
			if(strlen($contact)==10 && preg_match($mobileregex,$contact)){
				$msg= "Dear $name, Wishing you a day full of laughter and happiness and a year that brings you much success.Wish you very Happy Birthday.Best Regards,Creative Multimedia Institute";
				SMSSend($contact,$msg);
				$i++;
			}
		}
		echo "$i wishes sent..";
	}
}
