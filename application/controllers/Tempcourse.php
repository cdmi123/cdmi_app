<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tempcourse extends CI_Controller {

	var $perpage=50;
	function __construct()
	{
		parent::__construct();	
	}

	public function index()
	{
		$cur_date = date('d');
		$month_data =array();
		for($i=$cur_date;$i>=1;$i--){
			$date = date('Y-m-'.$i);
			$query =  $this->db->query("SELECT COUNT(id) as count,SUM(amount) as total_amount,DATE(date) as today_date FROM fees WHERE payment_mode!='CASH' and DATE(`date`) = '$date' GROUP BY '$date'"); 
			$record = $query->row_array();
			$arr['column1'] = @$record['total_amount'] ? $record['total_amount'] :0; 

			$query =  $this->db->query("SELECT COUNT(id) as count,SUM(amount) as total_amount,DATE(date) as today_date FROM fees WHERE payment_mode='CASH' and DATE(`date`) = '$date' GROUP BY '$date'"); 
			$record = $query->row_array();
			$arr['column2'] =  @$record['total_amount'] ? $record['total_amount'] :0; 

			$query1 =  $this->db->query("SELECT COUNT(id) as total_admission,DATE(join_date) as today_date FROM admission WHERE DATE(`join_date`) = '$date' GROUP BY '$date'"); 
			$today_course_adm = $query1->row_array();
			$arr['column3'] = @$today_course_adm['total_admission'] ? $today_course_adm['total_admission']:0;

			$month_data[$i] = $arr;
		}
		$data['all_data'] = $month_data;
		// pre($month_data);die;
		$this->load->view('summary_day',$data);
	}
	public function index2()
	{
		$cur_date = date('d');
		$month_data =array();
		for($i=$cur_date;$i>=1;$i--){
			$date = date('Y-m-'.$i);
			$query =  $this->db->query("SELECT COUNT(id) as count,SUM(amount) as total_amount,DATE(date) as today_date FROM tbl_dipak WHERE payment_mode!='CASH' and DATE(`date`) = '$date' GROUP BY '$date'"); 
			$record = $query->row_array();
			$arr['column1'] = @$record['total_amount'] ? $record['total_amount'] :0; 

			$query =  $this->db->query("SELECT COUNT(id) as count,SUM(amount) as total_amount,DATE(date) as today_date FROM tbl_dipak WHERE payment_mode='CASH' and DATE(`date`) = '$date' GROUP BY '$date'"); 
			$record = $query->row_array();
			$arr['column2'] =  @$record['total_amount'] ? $record['total_amount'] :0; 

			$query1 =  $this->db->query("SELECT COUNT(id) as total_admission,DATE(join_date) as today_date FROM admission WHERE DATE(`join_date`) = '$date' GROUP BY '$date'"); 
			$today_course_adm = $query1->row_array();
			$arr['column3'] = @$today_course_adm['total_admission'] ? $today_course_adm['total_admission']:0;

			$month_data[$i] = $arr;
		}
		$data['all_data'] = $month_data;
		// pre($month_data);die;
		$this->load->view('summary_day',$data);
	}
}
