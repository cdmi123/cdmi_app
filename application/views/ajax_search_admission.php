<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$c_date = date('Y-m-d');
foreach ($admission_data as $admission)
{
  $total_fees = preg_replace("/[^0-9]/", "", $admission['offer_code'] );
  $total_fees = $total_fees*10;

  $paid_allowance = $this->Fees_model->total_allowance_by_student($admission['regno']);
  $paid_refund = $this->Fees_model->total_refund_by_student($admission['regno']);
  $performance = $this->Exam_model->get_performance_by_regno($admission['regno']);
  $exam_count = $this->Exam_model->get_exam_count_by_regno($admission['regno']);
  // $this->db->where('id',$admission['faculty_id']);
  // $faculty = $this->db->get('admin')->row_array();
  $fac_ids = explode(",",$admission['faculty_id']);
  $this->db->where_in('id',$fac_ids);
  $faculty_info = $this->db->get('admin')->result_array();
  $fac_names = array();
  foreach($faculty_info as $fac){
    $fac_names[] = $fac['name'];
  }
  $f_names = implode(", ", $fac_names);

  $last_data =array();
  $this->db->order_by('id','desc');
  $this->db->where('reg_no',$admission['regno']);
  $last_data[] = $this->db->get('fees',1)->row_array();

  $this->db->order_by('id','desc');
  $this->db->where('reg_no',$admission['regno']);
  $last_data[] = $this->db->get('tbl_dipak',1)->row_array();
  
  usort($last_data, 'date_compare');

  $paid = $this->Admission_model->get_paid_fees($admission['regno']);
  $paid2 = $this->Admission_model->get_paid_fees2($admission['regno']);

  // $ad_total_fees = str_replace(',', '', $admission['total_fees']);
  // $unpaid = (int) ($ad_total_fees) - $paid;
  if($admission['image']!='')
  {
    $img = base_url('upload/student_photo/'.$admission['image']);
  }else{
    $img = base_url('assets/users.jpg');
  }
  $class = "color:inherit;";
  if($admission['status']=="C"){
    $class = "color:green;";
  }else if($admission['status']=="D"){
    $class = "color:red;";
  }else if($admission['status']=="L"){
    $class = "color:blue;";
  }else if ($admission['status']=="S") {
     $class = "color:purple;";
  }else if ($admission['status']=="T") {
     $class = "color:#618500;";
  }else if($admission['status']=="J"){
      $class = "background-color:rgba(204, 255, 255, 0.4);";
  }else if($admission['status']=="P"){
      $class = "background-color:rgba(230, 238, 255);";
  }else if($admission['end_date']<$c_date){
     $class = "color:#FF8300;";
  }
?>
<tr style="<?php echo $class;?>">
  <td><?php echo $admission['regno']?></td>
  <td>
    <?php echo $admission['student_name'];?>
    <div style="border-top: solid 1px black;margin-top: 5px"></div>
    <?php echo $admission['contact'];?>
    <?php echo $admission['father_contact'] ? " / ".$admission['father_contact'] : "";?>
  </td>
  <td>
    <?php echo $admission['course'];
    if(!empty($admission['sub_course'])){
      echo ' - ( '.$admission['sub_course'].' )';
    }
    ?>
    <?php if($admission['join_date']!=''){?>
    <div style="border-top: solid 1px black;margin-top: 5px;word-break: break-all;"></div>
    <?php echo getSimpleDate($admission['join_date']); } ?>
  </td>
  <td>
    <?php echo @$paid?>/-
  </td>
  <td <?php if($admission['laptop_compulsory']=="YES"){ echo "style='color:#CF20C5;'";} ?>>
    <?php echo $f_names.' / '.$admission['running_topic'];?>  
    <div style="border-top: solid 1px black;margin-top: 5px"></div>
    <?php echo $admission['batch_time'].' / '.$admission['sitting'].' / '.$admission['pcno'];?>
    <?php if($admission['laptop_compulsory']=="YES"){ echo "/ Y";} ?>
  </td>
  <td>
    <?php echo @$last_data[1]['amount']; ?>/-  
    <div style="border-top: solid 1px black;margin-top: 5px"></div>
    <?php echo getSimpleDate(@$last_data[1]['date']);?>
  </td>
  <td>
    <?php echo $paid_allowance; ?>/-  
    <div style="border-top: solid 1px black;margin-top: 5px"></div>
    <?php echo $paid_refund; ?>/-
  </td>
  <td>
    <img src="<?php echo $img;?>" alt="User profile picture" width="45">
    <div style="border-top: solid 1px black;margin-top: 5px"></div>
    <?php echo $performance;?>-<?php echo $exam_count;?>
  </td>
  <td>
     <a href="javascript:void(0);" class="btn btn-primary btn-xs m-1 update-status" data-status="<?php echo $admission['status'];?>" data-regno="<?php echo $admission['regno'];?>" data-note="<?php echo $admission['status_note'];?>" data-fees="<?php //echo $unpaid;?>" data-toggle="tooltip" data-placement="top" title="<?php echo $admission['status_note'];?> <?php if($admission['status_date'] !='') { ?>(<?php echo $admission['status_date'];  ?>) <?php } ?>"><?php echo $admission['status'];?></a>
    <a href="<?php echo site_url('fees/return_fees/add/'.$admission['regno']);?>" class="btn btn-primary btn-xs m-1">Return</a>
    <a href="<?php echo site_url('fees/add_allowance/add/'.$admission['regno']);?>" class="btn btn-primary btn-xs m-1">Allowance</a>
    <a href="https://api.whatsapp.com/send/?phone=91<?php echo $admission['contact'];?>" target="_blank" class="btn btn-success btn-xs m-1"><i class="fab fa-whatsapp" aria-hidden="true"></i></a>
  </td>
  <td>

   
    <a href="<?php echo site_url('Admission/edit_form/'.$admission['id'])  ?>" class="btn btn-primary btn-xs m-1"><i class="fas fa-edit"></i></a>

    <a href="<?php echo site_url('admission/view_student/'.$admission['id']);?>" class="btn btn-primary btn-xs m-1"><i class="fas fa-eye"></i></a>
    <a href="<?php echo site_url('Admission/print_regular_admission/'.$admission['id']);?>" class="btn btn-primary btn-xs m-1"> <i class="fas fa-print"></i></a>
    
    <?php if(($total_fees-$paid2)!=0){ ?> 

      <a href="<?php echo site_url('fees/index/add/'.$admission['regno']);?>" class="btn btn-primary btn-action btn-xs m-1" data-toggle="tooltip"  data-placement="top" title="Fees"> <i class="fas fa-plus"></i></a>

    <?php } ?>
    <a href="javascript:void(0);" data-regno="<?php echo $admission['regno'];?>" class="btn btn-primary btn-xs m-1 student-leave"><i class="fa fa-clock"></i></a>
    <a href="javascript:void(0);" data-regno="<?php echo $admission['regno'];?>" class="btn btn-primary btn-xs m-1 exam-report"> <i class="fas fa-laptop-code"></i></a>
    <a href="javascript:void(0);" data-regno="<?php echo $admission['regno'];?>" class="btn btn-primary btn-xs m-1 complain-report"><i class="fa fa-list-alt" aria-hidden="true"></i></a>
    
    <?php if($admission['status']=="J"){ ?>
<a href="javascript:void(0);" class="btn btn-primary btn-xs m-1 job_report" data-toggle="tooltip"  data-placement="top" title="Interview" data-regno="<?php echo $admission['regno'];?>" ><i class="fas fa-user-graduate"></i></a>
<?php } ?>
  </td>
</tr>
<?php } ?>