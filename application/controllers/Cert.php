<?php  
defined('BASEPATH') OR exit('No direct script access allowed');
class Cert extends CI_Controller
{
	var $perpage=50;
	function add_certificate()
	{
			if($this->input->post('save'))
			{
				$cer_no = $this->input->post('certificate_no');
				$name = $this->input->post('name');
				$course = $this->input->post('Certificate_name');
				$amount = $this->input->post('amount');
				$payment_detail = $this->input->post('payment_detail');
				$ref_by = $this->input->post('ref_by');
				$from_date = $this->input->post('from_date');
				$to_date = $this->input->post('to_date');

				$arr = array('certificate_no' => $cer_no , 'student_name' => $name , 'certificate_name' => $course ,'amount'=>$amount ,'payment_detail'=>$payment_detail,'ref_by'=>$ref_by,'from_date'=>$from_date,'to_date'=>$to_date);

				$this->db->insert('certificate',$arr);


			}

			$this->load->view('certificate');
	}

	function View_certificate()
	{
		$certi_data = array();

		$start=$this->uri->segment(3);
		$perpage=$this->input->post('perpage') ? $this->input->post('perpage') : $this->perpage;
		$certi_data['perpage'] = $perpage;
		$this->db->order_by('id','desc');
		$total = $this->db->count_all_results('certificate', FALSE);
		$this->db->limit($perpage,$start);
		$data = $this->db->get();
		$certi_data['certi_data'] = $data->result_array();
		$base_url = site_url('Cert/search_data');
		$pagination =pagination_new($total,$perpage,$base_url,3);
		$certi_data['pagination'] = $pagination;
		//$certi_data['certi_data'] = $this->db->order_by('id','desc')->get('certificate')->result_array();
		$this->load->view('view_certificate',$certi_data);
	}

	function search_data()
	{
		$certi_data = array();
		$start=$this->uri->segment(3);
		$perpage=$this->input->post('perpage') ? $this->input->post('perpage') : $this->perpage;
		$search_keyword = $this->input->post('search_keyword');
		$search_by = $this->input->post('search_by');
		$month = $this->input->post('month');
		$year = $this->input->post('year');

		if($search_keyword!="")
		{
			$this->db->like($search_by,$search_keyword);
		}

		if($month!="")
		{
			$this->db->where('MONTH(created_date)',$month);
		}
		if($year!="")
		{
			$this->db->where('YEAR(created_date)',$year);
		}
		$this->db->order_by('id','desc');
		$total = $this->db->count_all_results('certificate', FALSE);
		$this->db->limit($perpage,$start);
		$data = $this->db->get();
		$certi_data['certi_data'] = $data->result_array();
		$base_url = site_url('Cert/search_data');
		$pagination =pagination_new($total,$perpage,$base_url,3);
		$certi_data['pagination'] = $pagination;
		//$certi_data['certi_data'] = $this->db->get('certificate')->result_array();
		
		$html = $this->load->view('ajax_view_certificate',$certi_data,true);	

		//echo json_encode(array('data'=>$html));
		echo json_encode(array('data'=>$html,'pagination'=>$pagination,'found_results'=>$total));
	}

}