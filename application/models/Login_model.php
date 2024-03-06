<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login_model extends CI_Model
{
	function check_user()
	{
		$email=$this->input->post('email');
		$password=$this->input->post('password');
		$this->db->where('email',$email);
		$this->db->where('password',md5($password));
		$this->db->select('admin.*,branches.group_id');
		$this->db->join('branches','admin.branch_id=branches.id','left');
		$qry=$this->db->get('admin');
		return $qry;
	}
}
	
?>