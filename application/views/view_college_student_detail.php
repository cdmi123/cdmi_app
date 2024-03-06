<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('header');
// echo '<pre>';print_r($student);die;
$this->db->select('sum(amount) as paid');
// $this->db->order_by('id','desc');
$this->db->where('reg_no',$student['regno']);
// $this->db->group_by('reg_no');
$data = $this->db->get('college_fees')->row_array();
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class=""></h1>
          </div>
          <div class="col-sm-12">
            <h1 class="text-center">Student Detail</h1>
          </div>

        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-10 offset-1">
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">

              <div class="card-body">
                <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th colspan="2" class="text-center"><h4 class="m-0">Regi. No. <?php echo $student['regno'];?></h4></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td colspan="2">
                        <table class="table-borderless" width="100%">
                          <tr>
                            <td width="30%">
                              <div class="text-center mt-3">
                                <?php 
                                  if($student['image']!='')
                                  {
                                    $img = base_url('upload/college_student_photo/'.$student['image']);
                                  }else{
                                    $img = base_url('assets/users.jpg');
                                  }

                                  if($student['qr_number']!='')
                                  {
                                    $qr_img = base_url('assets/media/qrcode/'.$student['qr_number']);
                                  }else{
                                    $qr_img = base_url('assets/users.jpg');
                                  }
                                ?>
                                <img class="profile-user-img img-fluid" src="<?php echo $img;?>" alt="User profile picture" style="height: 200px;width: 150px;max-width: 150px;min-width: 150px;max-height: 200px;min-height: 200px;object-fit: cover;">
                              </div>
                              <div class="text-center mt-3">
                                <div>

                                  <img class="profile-user-img img-fluid" src="<?php echo $qr_img.'.jpg';?>" alt="User profile picture" style="height: 150px;width: 150px;object-fit: cover;">

                                </div>
                              </div>
                            </td>
                            <td>                              
                                <h3 class="profile-username font-weight-bold"><?php echo $student['student_name']?></h3>
                                <table width="100%" class="border-0">
                                  <tr>
                                    <th style="width: 125px">Course</td>
                                    <td>:</td>
                                    <td><?php echo $student['college_course']?> - <?php echo $student['college_mode'] ?></td>
                                  </tr>
                                  <tr>
                                    <th style="width: 125px">UNIVERSITY</td>
                                    <td>:</td>
                                    <td><?php echo $student['university'];?></td>
                                  </tr>
                                  <tr>
                                    <th style="width: 125px">MOTHER NAME</td>
                                    <td>:</td>
                                    <td><?php echo $student['mother_name']; ?> </td>
                                  </tr>
                                  <tr>
                                    <th style="width: 125px">Birth Date</td>
                                    <td>:</td>
                                    <td><?php echo date("d-m-Y",strtotime($student['birth_date']));?></td>
                                  </tr>
                                  <tr>
                                    <th style="width: 125px">GENDER</td>
                                    <td>:</td>
                                    <td><?php echo $student['gender'];?></td>
                                  </tr>
                                  <tr>
                                    <th style="width: 125px">Contact No.</td>
                                    <td>:</td>
                                    <td><?php echo $student['personal_mobile_no'];?> / <?php echo $student['father_mobile_no'];?> / <?php echo $student['home_mobile_no'];?></td>
                                  </tr>
                                  <tr>
                                    <th style="width: 125px">Whatsapp No.</td>
                                    <td>:</td>
                                    <td><?php echo $student['whatsapp_no'];?> / <?php echo $student['parent_whatsapp_no'];?></td>
                                  </tr>
                                  <tr>
                                    <th style="width: 125px">Multimedia Course</td>
                                    <td>:</td>
                                    <td><?php echo $student['multimedia_course'];?></td>
                                  </tr>
                                  <tr>
                                    <th style="width: 125px">Email</td>
                                    <td>:</td>
                                    <td><?php echo $student['email'];?></td>
                                  </tr>
                                  <tr>
                                    <th style="width: 125px;">Adhar No.</td>
                                    <td>:</td>
                                    <td><?php echo $student['adhar_no'];?></td>
                                  </tr>
                                  <tr>
                                    <th style="width: 125px;">Address</th>
                                    <td>:</td>
                                    <td><?php echo $student['address'];?></td>        
                                  </tr>
                                  
                                </table>                                
                            </td>
                          </tr>
                        </table>                     
                      </td>
                    </tr>
                    <tr>
                      <td colspan="2">
                        <h5><b>Fee Details :</b></h5>
                        <table width="100%" class="table-bordered mt-2">
                          <tr>
                            <th >
                              <h4>Total Fees : <b>RS. <?php echo $student['total_fees']?>/-</b></h4>
                            </th>
                            <th>
                              Fees Per Sem: <?php echo $student['per_sem_fees'];?>
                            </th>

                          </tr>
                        </table>
                      </td>
                    </tr>
                    
                    <tr>
                      <th>Admission Session</th>
                      <td><?php echo $student['start_session'].'-'.$student['end_session'];?></td>        
                    </tr>
                    <tr>
                      <th>Enrollment No.</th>
                      <td><?php echo $student['enrollment_no'];?></td>        
                    </tr>
                    <tr>
                      <th>Institute Name</th>
                      <td><?php echo @$student['institute_name'];?></td>        
                    </tr>
                    <tr>
                      <th>Class</th>
                      <td><?php echo $student['class_name'];?></td>        
                    </tr>
                    <tr>
                      <th>Join Date</th>
                      <td><?php echo date("d-m-Y",strtotime($student['join_date']));?></td>
                    </tr>
                    <tr>
                      <th>Acadamic Detail </th>
                      <td>
                        <table class="table-borderless table-sm" width="100%">
                          <tr>
                            <td>School Name</td>
                            <td>:</td>
                            <td><?php echo $student['school_name']?></td>
                          </tr>
                           <tr>
                            <td>Passing Year</td>
                            <td>:</td>
                            <td><?php echo date("M-Y",strtotime($student['passing_year']));?></td>
                          </tr>
                          <tr>
                            <td>Percentage</td>
                            <td>:</td>
                            <td><?php echo $student['percentage'];?></td>
                          </tr>
                          <tr>
                            <td>Percentiles</td>
                            <td>:</td>
                            <td><?php echo $student['percentile'];?></td>
                          </tr>
                        </table>
                    </tr>
                    
                    <tr>
                      <th>Reference</th>
                      <td><?php echo $student['reference'];?> / <?php echo $student['reference_name'];?></td>        
                    </tr>
                    <tr>
                      <th>Create By</th>
                      <td><?php echo $student['create_by_name']?></td>        
                    </tr>
                    <tr>
                      <th>Update By</th>
                      <td><?php echo $student['update_by_name']?></td>        
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th colspan="6" class="text-center"><h4 class="m-0">PAID INSTALLMENT</h4></th>
                    </tr>
                    <tr>
                      <th>REC NO</th>
                      <th>AMOUNT</th>
                      <th>PAYMENT MODE</th>
                      <th>PAYMENT INFO</th>
                      <th>INST. NO.</th>
                      <th>DATE</th>
                    </tr>
                    <?php
                      foreach($installent as $fees)
                       {
                    ?>
                    <tr>
                        <td><?php echo $fees['rec_no'];?></td>
                        <td><?php echo $fees['amount'];?>/-</td>
                        <td><?php echo $fees['pay_mode'];?></td>
                        <td><?php echo $fees['payment_detail'];?></td>
                        <td><?php echo $fees['installment_no'];?></td>
                        <td><?php echo date("d-m-Y",strtotime($fees['date']));?></td>
                    </tr>
                  <?php } ?>

                  </thead>
                </table>
                <?php 
                if(count($exam_fees)>0){
                ?>
                <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th colspan="6" class="text-center"><h4 class="m-0">Paid Exam Fees</h4></th>
                    </tr>
                    <tr>
                      <th>REC NO</th>
                      <th>AMOUNT</th>
                      <th>PAYMENT INFO</th>
                      <th>INST. NO.</th>
                      <th>DESC</th>
                      <th>DATE</th>
                    </tr>
                    <?php
                      foreach($exam_fees as $exam)
                       {
                    ?>
                    <tr>
                        <td><?php echo $exam['rec_no'];?></td>
                        <td><?php echo $exam['amount'];?>/-</td>
                        <td><?php echo $exam['pay_mode'].' / '.$exam['payment_detail'] ;?></td>
                        <td><?php echo $exam['installment_no'];?></td>
                        <td><?php echo $exam['extra_detail'];?></td>
                        <td><?php echo date("d-m-Y",strtotime($exam['date']));?></td>
                    </tr>
                  <?php } ?>

                  </thead>
                </table>
                <?php } ?>
                <?php 
                if(count($certificate_fees)>0){
                 ?>

                <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th colspan="6" class="text-center"><h4 class="m-0">Paid Certificate Fees</h4></th>
                    </tr>
                    <tr>
                      <th>REC NO</th>
                      <th>AMOUNT</th>
                      <th>PAYMENT INFO</th>
                      <th>INST. NO.</th>
                      <th>DESC</th>
                      <th>DATE</th>
                    </tr>
                    <?php
                      foreach($certificate_fees as $certificate)
                       {
                    ?>
                    <tr>
                        <td><?php echo $certificate['rec_no'];?></td>
                        <td><?php echo $certificate['amount'];?>/-</td>
                        <td><?php echo $certificate['pay_mode'].' / '.$certificate['payment_detail'] ;?></td>
                        <td><?php echo $certificate['installment_no'];?></td>
                        <td><?php echo $certificate['extra_detail'];?></td>
                        <td><?php echo date("d-m-Y",strtotime($certificate['date']));?></td>
                    </tr>
                  <?php } ?>

                  </thead>
                </table>
              <?php } ?>
              </div>
            <div class="card-body">
              <?php 
              if($this->session->userdata('user_role')==1 && count($payment)>0){
              ?>
              
                <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th colspan="7" class="text-center"><h4 class="m-0">PAYMENT</h4></th>
                    </tr>
                    <tr>
                      <th>#</th>
                      <th>AMOUNT</th>
                      <th>INST. NO.</th>
                      <th>DETAILS</th>
                      <th>TYPE</th>
                      <th>DATE</th>
                    </tr>
                    <?php
                    $cnt=1;
                    foreach($payment as $pay)
                    {
                    ?>
                    <tr>
                        <td><?php echo $cnt;?></td>
                        <td><?php echo $pay['amount'];?>/-</td>
                        <td><?php echo $pay['installment_no'];?></td>
                        <td><?php echo $pay['extra_detail'];?></td>
                        <td><?php echo $pay['fees_type'];?></td>
                        <td><?php echo date("d-m-Y",strtotime($pay['date']));?></td>
                    </tr>
                    <?php 
                      $cnt++;
                    } 
                    ?>

                  </thead>
                </table>
              
              <?php }?>

              <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th colspan="9" class="text-center"><h4 class="m-0">Leave Report</h4></th>
                    </tr>
                    <tr>
                      <th>#</th>
                      <th>Date</th>
                      <th>Remark</th>
                    </tr>
                    <?php
                    if(!empty($leave)){
                      $cnt =1;
                      foreach($leave as $leave_data)
                      {
                    ?>
                    <tr>
                        <td><?php echo $cnt;?></td>
                        <td><?php echo date('d-m-Y', strtotime($leave_data['followup_time']));?></td>
                        <td><?php echo $leave_data['note'];?></td>
                    </tr>
                  <?php $cnt++;}
                  }else{
                    echo '<tr><td colspan="7">No data found</td></tr>';
                  } ?>

                  </thead>
              </table>

              <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th colspan="9" class="text-center"><h4 class="m-0">Progress Report</h4></th>
                    </tr>
                    <tr>
                      <th>#</th>
                      <th>Topic</th>
                      <th>Total Marks</th>
                      <th>Obtained Marks</th>
                      <th>Grade</th>
                      <th>Faculty</th>
                      <th>Exam Date</th>
                      <th>Exam Remark</th>
                      <th>Action</th>
                    </tr>
                    <?php
                    if(!empty($progress_report)){
                      $cnt =1;
                      foreach($progress_report as $progress)
                      {
                    ?>
                    <tr>
                        <td><?php echo $cnt;?></td>
                        <td><?php echo $progress['exam_topic']?></td>
                        <td><?php echo $progress['total_marks']?></td>
                        <td><?php echo $progress['obtained_marks'];?></td>
                        <td><?php echo $progress['grade'];?></td>
                        <td><?php echo $progress['faculty_name'];?></td>
                        <td><?php echo getSimpleDate($progress['exam_date']);?></td>
                        <td><?php echo $progress['exam_remark'];?></td>
                        <td>
                          <a href="<?php echo site_url('test/remove_test/college/'.$progress['id'].'/'.$progress['regno']);?>" class="btn btn-primary btn-xs m-1" onclick="return confirm('are you sure?');"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                  <?php $cnt++;}
                  }else{
                    echo '<tr><td colspan="7">No data found</td></tr>';
                  } ?>

                  </thead>
              </table>

              <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th colspan="9" class="text-center"><h4 class="m-0">Complain Report</h4></th>
                    </tr>
                    <tr>
                      <th>#</th>
                      <th>Date</th>
                      <th>Complain</th>
                      <th>Faculty</th>
                      <th>Action</th>
                    </tr>
                    <?php
                    if(!empty($Complain_report)){
                      $cnt =1;
                      foreach($Complain_report as $Complain)
                      {
                    ?>
                    <tr>
                        <td><?php echo $cnt;?></td>
                        <td><?php echo $Complain['complian_date']?></td>
                        <td><?php echo $Complain['remark'];?></td>
                        <td><?php echo $Complain['faculty_name'];?></td>
                        <td>
                          <a href="<?php echo site_url('test/remove_test/course/'.$Complain['c_id'].'/'.$Complain['regno']);?>" class="btn btn-primary btn-xs m-1" onclick="return confirm('are you sure?');"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                  <?php $cnt++;}
                  }else{
                    echo '<tr><td colspan="9">No data found</td></tr>';
                  } ?>

                  </thead>
                </table>

            </div>

                
                </div>
             </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
 

 <?php
  $this->load->view('footer');
 ?>