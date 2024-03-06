<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Certificate_model extends CI_Model {
   var $cdmi_db;
   function __construct()
   {
       parent::__construct();
       $this->cdmi_db = $this->load->database('cdmi_db', TRUE);
   }
   public function insert($arr=array())
   {
      if($this->cdmi_db->insert('certificate',$arr)){
         return true;
      }else{ 
         return false;
      }
   }
   public function setting()
   {
      $qry=$this->cdmi_db->get('setting');
      $res=$qry->row_array();
      return $res;  
   }
   public function delete_certificate($id)
   {
      $this->cdmi_db->where('id',$id);
      $this->cdmi_db->delete('certificate');
   }
   public function update($arr,$id){
      $this->cdmi_db->where('id',$id);
      $this->cdmi_db->update('certificate',$arr);
      return true;
   }
   public function certificate_list($branch=100)
   {
      $this->cdmi_db->select('certificate.*,certificate_courses.course_name,cdmi_admin.name as branch_name');
      // if($this->session->userdata('log_type')=='branch'){
      //    $this->cdmi_db->where('branch_id',$this->session->userdata('cdmi_admin'));
      // }
      $this->cdmi_db->join('certificate_courses','certificate_courses.id=certificate.course','left');
      $this->cdmi_db->join('cdmi_admin','cdmi_admin.id=certificate.branch_id','left');
      
      $this->cdmi_db->where('branch_id',BRANCH_ID);
      
      // if($keyword!=''){
      //    $this->cdmi_db->where('reg_no',$keyword);
      // }
      $this->cdmi_db->order_by('certificate.id','desc');
      //$this->cdmi_db->limit($limit,$page);
      $qry=$this->cdmi_db->get('certificate');
      //echo last_query();die; 
      $res=$qry->result_array();
      return $res;
   }
   public function certificate_pdf($certi_id)
   {
      $this->cdmi_db->join('certificate_courses','certificate_courses.id = certificate.course');
      $this->cdmi_db->where('certificate.id',$certi_id);
      $qry=$this->cdmi_db->get('certificate');
      $res=$qry->row_array();
      return $res;
   }
   public function get_course(){
      return $this->cdmi_db->get('certificate_courses')->result_array();
   }
   public function select($id){
      return $this->cdmi_db->get_where('certificate',array('id'=>$id))->row_array();
   }
   public function count($branch=100){
      // if($this->session->userdata('log_type')=='branch'){
      //    $this->cdmi_db->where('branch_id',$this->session->userdata('cdmi_admin'));
      // }
      
      $this->cdmi_db->where('branch_id',BRANCH_ID);
      // if($keyword!=''){
      //    $this->cdmi_db->where('reg_no',$keyword);
      // }
      $qry=$this->cdmi_db->get('certificate');
      $res=$qry->num_rows();
      return $res;
   }
   public function check_duplication($regno=0){
      return $this->cdmi_db->get_where('certificate',array('reg_no'=>$regno,'branch_id'=>BRANCH_ID))->num_rows();
   }
   public function update_admission($regno=0){
      $this->db->where('regno',$regno);
      $this->db->update('admission',array('certificate'=>'YES'));

   }
   public function get_single_course($id=0){
      return $this->cdmi_db->get_where('certificate_courses',array('id'=>$id))->row_array();
   }
   public function insert_course($arr=array())
   {
      if($this->cdmi_db->insert('certificate_courses',$arr)){
         return $this->cdmi_db->insert_id();
      }else{ 
         return false;
      }
   }
   public function update_course($arr,$id){
      $this->cdmi_db->where('id',$id);
      $this->cdmi_db->update('certificate_courses',$arr);
      return true;
   }
   public function delete_course($id)
   {
      $this->cdmi_db->where('id',$id);
      $this->cdmi_db->delete('certificate_courses');

   }
   public function get_admin_info($id=0){
      return $this->cdmi_db->get_where('cdmi_admin',array('id'=>$id))->row_array();
   }
}