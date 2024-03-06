<?php
defined('BASEPATH') OR exit('No direct script access allowed');
foreach ($admission_data as $admission)
{
  $paid_allowance = $this->College_fees_model->total_allowance_by_student($admission['regno']);
  $paid_refund = $this->College_fees_model->total_refund_by_student($admission['regno']);
  $performance = $this->Exam_model->clg_performance_by_regno($admission['regno']);
  $paid_certificate_fees = $this->College_admission_model->get_certificate_fees($admission['regno']);
  $this->db->order_by('id','desc');
  $this->db->where('reg_no',$admission['regno']);
  $data = $this->db->get('college_fees',1)->row_array();

  $this->db->select_sum('amount');
  $this->db->where('reg_no',$admission['regno']);
  $exam_data = $this->db->get('exam_fees',1)->row_array();
                      
  if(!empty($data)){
    $last_amt = $data['amount'];
    $last_date = date("d-m-Y",strtotime($data['date']));
  }else{
    $last_amt = 0;
    $last_date = "00-00-0000";
  }
  $paid_fees = $this->College_admission_model->get_paid_fees($admission['regno']);
  
  if(!empty($paid_fees)){
    $paid = !empty($paid_fees['paid']) ? $paid_fees['paid'] : 0;
  }else{
    $paid = 0;
  }  
  $unpaid = (int) ($admission['total_fees'])- $paid;
  if($admission['image']!='')
  {
    $img = base_url('upload/college_student_photo/'.$admission['image']);
  }else{
    $img = base_url('assets/users.jpg');
  }
  $class = "color:inherit;";
  if($admission['status']=="C"){
    $class = "color:green;";
  }else if($admission['status']=="D"){
    $class = "color:red;";
  }
?>
<tr style="<?php echo $class;?>">
  <td><?php echo $admission['regno']?></td>
  <td>
    <?php echo $admission['student_name']?>
    <div style="border-top: solid 1px black;margin-top: 5px"></div>
    <?php echo $admission['personal_mobile_no'] ;?>
    <?php echo $admission['father_mobile_no'] ? " / ".$admission['father_mobile_no'] : ""; ?>
    <?php echo $admission['home_mobile_no'] ? " / ".$admission['home_mobile_no'] : ""; ?>
  </td>

  <td>
    <?php echo $admission['college_course']?> 
    <?php if($admission['course_stream']!=""){echo $admission['course_stream'];}?> - <?php echo $admission['college_mode']; ?><?php if($admission['join_date']!=''){?>
      <div style="border-top: solid 1px black;margin-top: 5px;word-break: break-all;"></div>
      <?php echo getSimpleDate($admission['join_date']);
      }?>
  </td>
  <td>
    <?php echo $admission['total_fees']?>/-  
    <div style="border-top: solid 1px black;margin-top: 5px"></div>
    <?php echo $paid?>/-
  </td>
  <td>
    <?php echo $unpaid?>/-
    <div style="border-top: solid 1px black;margin-top: 5px"></div>
    <?php echo $exam_data['amount'] ? $exam_data['amount'] : 0;?>/-
    <div style="border-top: solid 1px black;margin-top: 5px"></div>
    <?php echo $paid_certificate_fees['amount'] ? $paid_certificate_fees['amount'] : 0 ?>/-
  </td>
  <td>
    <?php echo $last_amt;?>/-  
    <div style="border-top: solid 1px black;margin-top: 5px"></div>
    <?php echo $last_date;?>
  </td>  
  <td>
    <?php echo $admission['university']; ?>
    <div style="border-top: solid 1px black;margin-top: 5px"></div>
    <?php echo $admission['start_session']; ?> - <?php echo $admission['end_session']; ?>
    <?php if($admission['college_mode']=='REG' && $admission['status']=='R'){?>
    <div style="border-top: solid 1px black;margin-top: 5px"></div>
    <?php echo $admission['class_name']; ?> - <?php echo $admission['roll_no']; ?>
    <?php }?>
  </td>
  <td>
    <?php echo $paid_allowance; ?>/-  
    <div style="border-top: solid 1px black;margin-top: 5px"></div>
    <?php echo $paid_refund; ?>/-
  </td>
  <td>
    <img class="img-fluid" src="<?php echo $img;?>" alt="User profile picture" width="45" />
    <div style="border-top: solid 1px black;margin-top: 5px"></div>
    <?php echo $performance;?>
  </td>
  <td>
    <a href="javascript:void(0);" class="btn btn-primary btn-xs m-1 update-status" data-status="<?php echo $admission['status'];?>" data-regno="<?php echo $admission['regno'];?>" data-note="<?php echo $admission['status_note'];?>" data-toggle="tooltip" data-placement="top" title="<?php echo $admission['status_note'];?>"><?php echo $admission['status'];?></a>
    <a href="<?php echo site_url('college_fees/return_fees/add/'.$admission['regno']);?>" class="btn btn-primary btn-xs m-1">Return</a>
    <a href="<?php echo site_url('college_fees/add_allowance/add/'.$admission['regno']);?>" class="btn btn-primary btn-xs m-1">Allowance</a>
  </td>
  <td>
    <a href="<?php echo site_url('College_admission/update_adm/'.$admission['id'])  ?>" class="btn btn-primary btn-xs m-1"><i class="fas fa-edit"></i></a>
    <a href="<?php echo site_url('College_admission/view_student/'.$admission['regno']);?>" class="btn btn-primary btn-xs m-1"><i class="fas fa-eye"></i></a>
    <a href="<?php echo site_url('College_admission/print_form/'.$admission['id']);?>" class="btn btn-primary btn-xs m-1"> <i class="fas fa-print"></i></a>
    <a href="<?php echo site_url('College_admission/print_exam_form/'.$admission['id']);?>" class="btn btn-primary btn-xs m-1"> <i class="fas fa-graduation-cap"></i></a>
    <a href="<?php echo site_url('College_fees/index/add/'.$admission['regno']);?>" class="btn btn-primary btn-xs m-1"> <i class="fas fa-plus"></i></a> 
    <a href="javascript:void(0);" data-regno="<?php echo $admission['regno'];?>" class="btn btn-primary btn-xs m-1 exam-report"> <i class="fas fa-laptop-code"></i></a>
    <a href="javascript:void(0);" data-regno="<?php echo $admission['regno'];?>" class="btn btn-primary btn-xs m-1 complain-report"><i class="fa fa-list-alt" aria-hidden="true"></i></a>
    <?php if($admission['qr_number']==""){ ?>
    <a href="<?php echo site_url('QR-code/'.$admission['id'])?>" data-regno="<?php echo $admission['regno'];?>" class="btn btn-primary btn-xs m-1 qr-code"><i class="fa fa-qrcode" aria-hidden="true"></i></a>
  <?php } ?>
  </td>
</tr>
<?php } ?>