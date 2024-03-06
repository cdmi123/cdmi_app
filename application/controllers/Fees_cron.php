<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Fees_cron extends CI_Controller {

	var $perpage=50;
	function __construct()
	{
		parent::__construct();	
			
	}

	public function index()
	{

		$first_day_this_month = date('Y-m-01'); // hard-coded '01' for first day
		$last_day_this_month  = date('Y-m-t');

		//delete rows with other status rather than Regular
		$this->db->select('due_payments.regno,due_payments.id');
		$this->db->where('admission.status !=','R');
		$this->db->join('admission','due_payments.regno=admission.regno');
		$all_recs = $this->db->get('due_payments')->result_array();
		foreach($all_recs as $row){
			$this->db->where('id',$row['id']);
			$this->db->delete('due_payments');
		}
		//pre($all_recs);die;
		$this->db->order_by('id','desc');
		$this->db->where('status','R');
		// $this->db->where('regno',7);
		$all_students = $this->db->get('admission')->result_array();
		foreach ($all_students as $key => $value) {
			$regno = $value['regno'];
			$this->db->where('regno',$regno);
			$due_cnt = $this->db->get('due_payments')->num_rows();
			if($due_cnt == 0){
				$this->db->where('reg_no',$regno);
				$fees_info = $this->db->get('fees');
				

				$this->db->where('reg_no',$regno);
				$fees_info2 = $this->db->get('tbl_dipak');

				$total_fees = preg_replace("/[^0-9]/", "", $value['offer_code'] );
				$total_fees = $total_fees*100;
				$total_paid = 0;
				// echo $total_fees;die;
				//$total_fees = $value['total_fees'];
				foreach($fees_info->result_array() as $fee){
					$total_paid += $fee['amount'];
				}

				foreach($fees_info2->result_array() as $fee){
					$total_paid += $fee['amount']*10;
				}
				// echo $total_paid;die;
				// if($regno==1985){
				// 	echo $total_paid;die;	
				// }
				
				$installent_details = $value['installment_detail'];
				$paid_inst1 = $fees_info->num_rows();
				$paid_inst2 = $fees_info2->num_rows();
				$paid_inst = $paid_inst1+$paid_inst2;
				if(!empty($installent_details) && $total_fees != $total_paid){
					$installments = json_decode($installent_details,true);
					if(isset($installments[$paid_inst])){
						$due_date = $installments[$paid_inst]['date'];

						if($due_date <= $last_day_this_month){
							$due_amount = $installments[$paid_inst]['amount'];
							$stud_name = $value['student_name'];
							$course = $value['course'];

							$save_info=array(
								'regno'=>$regno,
								'amount'=>$due_amount,
								'due_date'=>$due_date,
								// 'installment_no'=>$paid_inst+1,
							);	
							$this->db->insert('due_payments',$save_info);
						}
					}
				}
			}
		}
	}
}
