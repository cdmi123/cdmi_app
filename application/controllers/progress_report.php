<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Progress_report extends CI_Controller {
	var $perpage=100;
	function __construct()
	{
		parent::__construct();	
		if(!$this->session->userdata('user_login')){
			redirect('staff-login');
		}
		// if($this->session->userdata('user_role')==2 || $this->session->userdata('user_role')==3 || $this->session->userdata('user_role')==4 || $this->session->userdata('user_role')==5){
		// 	redirect('staff-login');	
		// }
		
	}


	function index()
	{

		$arr['report_name'] = $this->db->get('progress_report_cat')->result_array();

		$this->load->view('add_progress_report',$arr);
	}

	function add_report()
	{
		$language_name = $this->input->post("language_name");
	
			$data = array('cat_name'=>$language_name);
			$this->db->insert('progress_report_cat',$data);
		
		$arr['report_name'] = $this->db->get('progress_report_cat')->result_array();

		echo $this->load->view('ajax_view_report',$arr,true);
		
	}

	function sub_topic()
	{
		$arr['report_name'] = $this->db->get('progress_report_cat')->result_array();

		$this->load->view('add_sub_topic',$arr);
	}

	function peta_topic()
	{
		$arr['report_name'] = $this->db->get('progress_report_cat')->result_array();

		$this->load->view('add_peta_topic',$arr);
	}

	function ajax_sub_topic()
	{
		$report_id = $this->input->post("report_id");

		$_SESSION['sub_cat_id'] = $report_id;

		$this->db->where('p_id',$report_id);
		$arr['topic_name'] = $this->db->get('progress_report_sub_cat')->result_array();

		echo $this->load->view('ajax_sub_topic',$arr,true);
	}

	function add_sub_topic()
	{
		$report_id = $this->input->post("report_id");
		$topic_name = $this->input->post("sub_topic_name");

		$data = array('p_id'=>$report_id,'lecture_name'=>$topic_name);
		$this->db->insert('progress_report_sub_cat',$data);

		$this->db->where('p_id',$report_id);
		$arr['topic_name'] = $this->db->get('progress_report_sub_cat')->result_array();

		echo $this->load->view('ajax_sub_topic',$arr,true);
	}

	function ajax_get_sub_topic()
	{

		$report_id = $this->input->post("report_id");

		$this->db->where('p_id',$report_id);

		$arr['topic_sub_name'] = $this->db->get('progress_report_sub_cat')->result_array();

		echo $this->load->view('ajax_sub_topic',$arr,true);
	}

	function ajax_get_peta_topic()
	{
		$select_topic_id = $this->input->post("select_topic_id");

		$_SESSION['peta_cat_id'] = $select_topic_id;

		$this->db->where('p_s_id',$select_topic_id);
		$this->db->order_by("sort_id", "asc");
		$arr['peta_topic_name'] = $this->db->get('progress_report_peta_cat')->result_array();

		echo $this->load->view('ajax_sub_topic',$arr,true);
	}

	function add_peta_topic()
	{
		$sub_report_id = $this->input->post("topic_name_id");
		$topic_name = $this->input->post("sub_topic_name");

		$data = array('p_s_id'=>$sub_report_id,'topic_name'=>$topic_name);
		$this->db->insert('progress_report_peta_cat',$data);

		$this->db->where('p_s_id',$sub_report_id);
		$arr['peta_topic_name'] = $this->db->get('progress_report_peta_cat')->result_array();



		echo $this->load->view('ajax_sub_topic',$arr,true);

	}

	function delete_peta_topic()
	{
		$id = $this->input->post('delete_id');
		$sub_report_id = $this->input->post("sub_cat_id");

		$this->db->where('p_p_id',$id);
		$this->db->delete('progress_report_peta_cat');

		$this->db->where('p_s_id',$sub_report_id);
		$arr['peta_topic_name'] = $this->db->get('progress_report_peta_cat')->result_array();

		echo $this->load->view('ajax_sub_topic',$arr,true);
	}


	function delete_sub_topic()
	{

		$id = $this->input->post('delete_id');
		$sub_report_id = $this->input->post("sub_cat_id");

		$this->db->where('p_s_id',$id);
		$this->db->delete('progress_report_sub_cat');

		$this->db->where('p_id',$sub_report_id);
		$arr['topic_name'] = $this->db->get('progress_report_sub_cat')->result_array();

		echo $this->load->view('ajax_sub_topic',$arr,true);	
	}

	function delete_cat()
	{
		$id = $this->input->post('delete_id');

		$this->db->where('p_id',$id);
		$this->db->delete('progress_report_cat');

		$arr['report_name'] = $this->db->get('progress_report_cat')->result_array();

		echo $this->load->view('ajax_view_report',$arr,true);


	}

	function update_Category()
	{
		$id = $this->input->post('id');
		$tpoic_name = $this->input->post('topic_name');

		$data = array('cat_name'=>$tpoic_name);

		$this->db->where('p_id',$id);
		$this->db->update('progress_report_cat',$data);

		$arr['report_name'] = $this->db->get('progress_report_cat')->result_array();

		echo $this->load->view('ajax_view_report',$arr,true);
	}

	function update_topic()
	{
		$id = $this->input->post('id');

		$tpoic_name = $this->input->post('topic_name');

		$data = array('lecture_name' => $tpoic_name);

		$this->db->where('p_s_id',$id);
		$this->db->update('progress_report_sub_cat',$data);

		$cat_id = $this->session->userdata('sub_cat_id');
		$this->db->where('p_id',$cat_id);

		$arr['topic_name'] = $this->db->get('progress_report_sub_cat')->result_array();

		echo $this->load->view('ajax_sub_topic',$arr,true);
	}

	function update_peta_topic()
	{
		$id = $this->input->post('id');
		$tpoic_name = $this->input->post('topic_name');
		$cat_id = $this->session->userdata('peta_cat_id');

		$data = array('topic_name'=>$tpoic_name);
		
		$this->db->where('p_p_id',$id);
		$this->db->update('progress_report_peta_cat',$data);

		$this->db->where('p_s_id',$cat_id);
		$arr['peta_topic_name'] = $this->db->get('progress_report_peta_cat')->result_array();

		echo $this->load->view('ajax_sub_topic',$arr,true);
	}

	function update_drag_drop_peta_cat()
	{
		$position = $this->input->post("position");
		$sub_report_id = $this->input->post("sub_cat_id");
 
		$i=1;
		foreach($position as $k => $v){

    		$data = ['sort_id' => $i.$sub_report_id];
			$this->db->where('p_p_id', $v);
			$this->db->update('progress_report_peta_cat', $data);
    		$i++;
		}

		$this->db->where('p_s_id',$sub_report_id);
		$this->db->order_by("sort_id", "asc");
		$arr['peta_topic_name'] = $this->db->get('progress_report_peta_cat')->result_array();

		echo $this->load->view('ajax_sub_topic',$arr,true);
	}

	function view_report()
	{
		$this->load->view('view_progress_report');
	}

}

?>