<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Certificate extends CI_Controller {
	function __construct()
	{
		parent::__construct();	
		if(!$this->session->userdata('user_login')){
			redirect('staff-login');
		}
		if($this->session->userdata('user_role')==2){
			redirect('staff-login');	
		}
		$this->load->model('certificate_model');
	}
  	public function add_certificate($id=0)
	{
		if($id>0){
			$arr['get_certificate_row'] = $this->certificate_model->select($id);
		}
		if($this->input->post())
		{
			$surname = $this->input->post('surname');
			$first_name = $this->input->post('first_name');
			$middle_name = $this->input->post('middle_name');
			$reg_no=$this->input->post('enrollment');
			$course=$this->input->post('course');
			$duration=$this->input->post('duration');
			$start_date=$this->input->post('start_date');
			$end_date=$this->input->post('end_date');
			$grade=$this->input->post('grade');
			$certificate_date=$this->input->post('certificate_date');
			$branch_id=BRANCH_ID;
			$res=$this->certificate_model->get_admin_info($branch_id);
			$branch=$res['username'];
			$b= substr($branch, 0, 1);
			$enrollment_no = 'CDMI'.strtoupper($b).date("Ym",strtotime($start_date)).$reg_no;
			$ins_arr=array('branch_id'=>$branch_id,'surname'=>$surname,'first_name'=>$first_name,'middle_name'=>$middle_name,'enrollment'=>$enrollment_no,'reg_no'=>$reg_no,'course'=>$course,'duration'=>$duration,'start_date'=>$start_date,'end_date'=>$end_date,'grade'=>$grade,'certificate_date'=>$certificate_date);
			//pre($ins_arr);die;
			if($id>0){
				if($this->certificate_model->update($ins_arr,$id)){
					redirect('certificate/list_certificate');	
				}
			}else{
				$cnt_row = $this->certificate_model->check_duplication($reg_no);
				if($cnt_row ==0){
					if($this->certificate_model->insert($ins_arr)){
						$this->certificate_model->update_admission($reg_no);
						redirect('certificate/list_certificate');	
					}
				}else{
					$arr['get_certificate_row'] = $ins_arr;
					$arr['err'] = 'Certificate Already Exist.';					
				}
			}		
		}	
		$arr['course'] = $this->certificate_model->get_course();
		$arr['main_menu']='certificate';
		$arr['sub_menu']='add_certificate';
		//pre($arr);die;
		//$arr['main_content'] = 'admin/add_certificate';
		$this->load->view('add_certificate',$arr);
	}	
	public function list_certificate()
	{
		$arr=$this->certificate_model->setting();
		$branch=100;
		$keyword = $this->input->post('txtSearch') ? $this->input->post('txtSearch') : '';
		// if($this->input->post() || $this->session->userdata('branch')){
		// 	//pre($this->input->post('branch'));die;
		// 	$branch = $this->input->post('branch') ? $this->input->post('branch') : $this->session->userdata('branch');
		// 	if($branch==''){
		// 		$branch=100;
		// 	}
		// 	//echo $branch;die;
		// 	if($branch==2 || $branch==3){
		// 		$this->session->set_userdata('branch',$branch);
		// 	}else{
		// 		$this->session->unset_userdata('branch');
		// 	}
		// }	
		$limit=$arr['slug_value'];
		$total_rows = $this->certificate_model->count($branch);
		$arr['branch'] = $branch;
		$arr['txtSearch'] = $keyword;
		$arr['certificate_data'] = $this->certificate_model->certificate_list($branch);
		$base_url = site_url('admin/certificate/list_certificate');
		$arr['pagination']= pagination($total_rows,$limit,$base_url,4,'pull-right');
		$arr['main_menu']='certificate';
		$arr['sub_menu']='list_certificate';
		//$arr['main_content'] = 'admin/list_certificate';
		$this->load->view('list_certificate',$arr);
	}
	public function add_certificate_course($id=0){
		if($id>0){
			$arr['course_info'] = $this->certificate_model->get_single_course($id);
		}
		if($this->input->post()){
			$certificate_course_name = $this->input->post('certificate_course');
			$status = $this->input->post('status');
			$save = array('course_name'=>$certificate_course_name,'status'=>$status);
			if($id>0){
				$this->certificate_model->update_course($save,$id);
				redirect('certificate/list_certificate_courses');
			}else{
				$this->certificate_model->insert_course($save);	
			}
		}
		$arr['main_menu'] = 'certificate';
		$arr['sub_menu'] = 'add_certificate_course';
		$this->load->view('add_certificate_course',$arr);
	}
	public function list_certificate_courses(){
		$arr['certificate_courses'] = $this->certificate_model->get_course();
		$arr['main_menu'] = 'certificate';
		$arr['sub_menu'] = 'list_certificate_courses';
		$this->load->view('list_certificate_courses',$arr);
	}

	public function delete_certificate_courses($id=''){
		$this->certificate_model->delete_course($id);
		redirect('certificate/list_certificate_courses');
	}

	public function search_student($page=0)
	{
		 $arr=$this->certificate_model->setting();
		//pre($arr['id']);die;
		$limit=$arr['slug_value'];
	   	$search=  $this->input->post('search');
	 	$total_rows = $this->certificate_model->get_stu_count();
		$student_data = $this->certificate_model->get_stu_rows($limit,$page,$search);
		$base_url = site_url('admin/certificate/view');
		$arr['pagination']= pagination($total_rows,$limit,$base_url,4,'pull-right');
		$arr['student_info'] = $student_data;
		$html = $this->load->view('admin/ajax_student_search', $arr,true);	
        echo json_encode (array('retHtml'=>$html));   
	}
	public function delete_certificate($id)
	{
		$this->certificate_model->delete_certificate($id);
		redirect('certificate/list_certificate');	
	}
	public function certificate_list($page=0)
	{
		$arr=$this->certificate_model->setting();
		//pre($arr['id']);die;
		$limit=$arr['slug_value'];
		$total_rows = $this->certificate_model->get_cer_count();
		$certy_data = $this->certificate_model->get_cer_rows($limit,$page);
		$base_url = site_url('admin/certificate/certificate_list');
		$arr['pagination']= pagination($total_rows,$limit,$base_url,4,'pull-right');
		$arr['certy_info']=$certy_data;
		//pre($arr);die;
		$arr['main_menu']='certificate';
		$arr['sub_menu']='list_certificate';
		$this->load->view('admin/certificate_list',@$arr);	
	}
	public function print_cert($certi_id=0){
		//echo $certi_id;
		//$certi_id = $this->input->post('certi_id');
		$arr['certy_info']=$this->certificate_model->certificate_pdf($certi_id);
		$this->certificate_model->update(array('pdf_status'=>'Printed'),$certi_id);
		$this->load->view('certy_pdf_new',$arr);die;
		//pre($arr['certy_info']);die;
		//echo json_encode(array('retHtml'=>$this->load->view('certy_pdf_new',$arr,true),'title'=>$arr['certy_info']['enrollment'].'-'.$arr['certy_info']['course']));
	}
	public function create_pdf($certi_id)
	{
		$data['page_title']='PDF';
		$name = "certificate_".time().".pdf";
		$this->db->where('id',$certi_id);
		$this->db->update('certificate',array('pdf_status'=>$name));
		$pdfFilepath=FCPATH."certificate/".$name;
		$this->load->library('pdf');
		$pdf=$this->pdf->load();
		$arr['certy_info']=$this->certificate_model->certificate_pdf($certi_id);
		$html = $this->load->view('admin/certy_pdf_new',$arr,true);
		$css_path = base_url('assets/css/certificate.css');
		$stylesheet = file_get_contents($css_path);
		$pdf->WriteHTML($stylesheet,1);
		$pdf->WriteHTML($html);
		$pdf->Output($pdfFilepath,'F');
		$pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822));
		$data =  file_get_contents(base_url("certificate/".$name));
		force_download($name, $data,TRUE);
		redirect('certificate/list_certificate');
	}
	function get_duration(){
		$course_id = $this->input->post('course_id');
		$duration = $this->certificate_model->get_duration($course_id);
		echo $duration['duration'];
	}
}