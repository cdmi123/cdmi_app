<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Setting extends CI_Controller
{
	function __construct() {
        parent::__construct();
        if(!$this->session->userdata('user_login')){
			redirect('staff-login');
		}
		$this->load->model('admin/setting_model');
		$data = array();
        
    }

	public function index($id=0)
	{

		

		if($id > 0)

		{

			$setting_info = $this->setting_model->select($id);

			$data['setting_info']=$setting_info;

			//pre($data);die;

		}

	

		if($this->input->post())

		{
			$slug_name=$this->input->post('slug_name');

			$slug_value=$this->input->post('slug_value');

			

			$setting=array('slug_name'=>$slug_name,'slug_value'=>$slug_value);

		

			

				if($id > 0)

				{

					if($this->setting_model->update($setting,$id)){

						redirect('admin/setting/view');

					}

				}

			

			}
		$data['main_content']= 'admin/add_setting';
		$this->load->view('admin/template',$data);

		

	}

	public function view($page=0)

	{

		$data=$this->setting_model->setting();
		//pre($arr['id']);die;
		$limit=$data['slug_value'];

		$total_rows = $this->setting_model->get_setting_count();

		$setting_data = $this->setting_model->get_setting_rows($limit,$page);

		

		$base_url = site_url('admin/setting/view');

		$data['pagination']= pagination($total_rows,$limit,$base_url,4,'pull-right');

		$data['setting_info']=$setting_data;

		$data['main_menu']='main_settingsetting';
		$data['sub_menu']='setting_list';
		$data['main_content']= 'admin/list_setting';
		$this->load->view('admin/template',$data);	

		

	}

	public function delete($id)

	{
		//pre($id);die;
		$this->setting_model->delete($id);

		redirect('admin/setting/view');

	}

	



	

}

?>





