<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Setting_model extends CI_Model
{
	public function view()
	{
		$qry=$this->db->get('setting');
		$res=$qry->result_array();
		return $res;	
	}
	function get_setting_count(){
		$qry=$this->db->get('setting');
		$res=$qry->num_rows();
		return $res;
	}
	public function setting()
	{
		$qry=$this->db->get('setting');
		$res=$qry->row_array();
		return $res;	
	}

	function get_setting_rows($limit=0,$page=0){
		$this->db->limit($limit,$page);
		$qry=$this->db->get('setting');
		$res=$qry->result_array();
		return $res;
	}

	public function delete($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('setting');
	}
	public function select($id)
	{
		$this->db->where('id',$id);
		$qry=$this->db->get('setting');
		$res=$qry->row_array();
		return $res;	
	}
	public function update($setting = array(),$id)
	{
		$this->db->where('id',$id);
		if($this->db->update('setting',$setting)){
			return true;
		}else{
			return false;
		}
	}
}
?>