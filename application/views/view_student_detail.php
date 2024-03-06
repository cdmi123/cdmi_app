<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('header');
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
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

              <div class="card-body table-responsive">
                <table class="table table-bordered">
                  <thead> 
                  <tr>
                    <th colspan="2">
                      <div class="progress">
                        <?php if($Total_progress < 25) {
                          $color = "bg-danger";
                        }else if($Total_progress < 50) { 
                          $color = "bg-warning";
                        }else if($Total_progress < 75) {
                          $color = "bg-info";
                        }else {
                          $color = "";
                        }?>

                        <?php $total_days = $present_days + $absent_days;   

                        if($total_days!=0) 
                        { 
                            $avg =  ceil(($present_days / $total_days)*100); 
                        } 
                        else
                        {
                            $avg = 0;
                        }

                       
                        ?>

                        <?php if(@$avg <= 50) {
                          $color1 = "text-danger";
                        }else if(@$avg <= 80) { 
                          $color1 = "text-warning";
                        }else if(@$avg > 80) {
                          $color1 = "text-primary";
                        }?>

                        <div class="progress-bar progress-bar-striped progress-bar-animated <?php echo $color; ?>" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $Total_progress; ?>%"><?php echo $Total_progress; ?>%</div>
                      </div>
                    </th>
                  </tr>                 
                    <tr>
                     
                      <th colspan="2" class="text-center">

                        <table class="table table-bordered m-0">
                          <thead>
                            <tr>
                              <th><h5 class="m-0">REG. NO. <?php echo $student['regno'];?></h5></th>
                              <th><h6 class="m-0">TOTAL DAYS: <b> <?php echo $present_days + $absent_days;?></b> <?php $total_days = $absent_days + $present_days; ?> </h6></th>
                              <th><h6 class="m-0">PRESENT:  <?php echo $present_days; ?></h6></th>
                              <th><h6 class="m-0">ABSENT:  <?php echo $absent_days; ?></h6></th>
                              <th><h6 class="m-0 <?php echo $color1; ?>">Avg: <b> <?php echo @$avg." %";   ?></b></h6></th>
                            </tr>
                          </thead>
                        </table>

                      </th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td colspan="2">
                        <div class="text-center">
                          <?php 

                            if($student['image']!='')
                            {
                          ?>
                          <img class="profile-user-img img-fluid img-circle"
                               src="<?php echo base_url('upload/student_photo/'.$student['image']);?>"
                               alt="User profile picture" style="height: 150px;width: 150px;max-width: 150px;min-width: 150px;max-height: 150px;min-height: 150px;">
                             
                             <?php }
                              else
                              {
                              ?>
                              <img class="profile-user-img img-fluid img-circle"
                               src="<?php echo base_url('assets/users.jpg')?>"
                               alt="User profile picture" style="height: 150px;width: 150px;max-width: 150px;min-width: 150px;max-height: 150px;min-height: 150px;">
                              <?php } ?>
                        </div>
                        <h3 class="profile-username text-center"><?php echo $student['student_name']?></h3>
                        <p class="text-muted text-center"><?php echo $student['course']?></p>
                      </td>
                    </tr>
                    <tr>
                      <th>Contact</th>
                      <td><?php echo $student['contact']?> / <?php echo $student['father_contact']?> </td>        
                    </tr>
                    <tr>
                      <th>Whatsapp No.</th>
                      <td><?php echo $student['whatsapp_no'];?> / <?php echo $student['parent_whatsapp_no'];?> </td>        
                    </tr>
                    <tr>
                      <th>Join Date - End Date</th>
                      <td><?php echo getSimpleDate($student['join_date']);?> to <?php echo getSimpleDate($student['end_date']);?></td>        
                    </tr>
                    <tr>
                      <th>Sub Course</th>
                      <td><?php echo $student['sub_course'];?></td>        
                    </tr>
                    <tr>
                      <th>Course Cover</th>
                      <td><?php echo $student['course_content']?></td>        
                    </tr>
                    <tr>
                      <th>Course Duration</th>
                      <td><?php echo $student['course_duration']?></td>        
                    </tr>
                    <tr>
                      <th>Job Responsibility</th>
                      <td><?php echo $student['job_res']?></td>        
                    </tr>
                    
                    <tr>
                      <th>Birth Date</th>
                      <td><?php echo getSimpleDate($student['birth_date']);?></td>
                    </tr>
                    <tr>
                      <th>Qualification</th>
                      <td><?php echo $student['qualification']?></td>        
                    </tr>
                    <tr>
                      <th>Address</th>
                      <td><?php echo $student['address']?></td>        
                    </tr>
                    <tr>
                      <th>Reference</th>
                      <td><?php echo $student['reference']?> / <?php echo $student['reference_name']?></td>        
                    </tr>
                    <tr>
                      <th>Running Topic / Faculty</th>
                      <td><?php echo $student['running_topic'] ? $student['running_topic']: "Pending";?> / <?php echo $faculty;?></td>        
                    </tr>
                    <tr>
                      <th>Completed Topic</th>
                      <td><?php echo $student['completed_topic']; ?></td>        
                    </tr>
                    <tr>
                      <th>Batch / Sitting / PC No</th>
                      <td><?php echo $student['batch_time'] ? $student['batch_time'] : "Not Given";?> / <?php echo $student['sitting'] ? $student['sitting'] : "Pending";?> / <?php echo $student['pcno'];?></td>        
                    </tr>
                    <tr>
                      <th>Create By:</th>
                      <td><?php echo $student['create_by_name']?></td>        
                    </tr>
                    <tr>
                      <th>Update By:</th>
                      <td><?php echo $student['update_by_name']?></td>        
                    </tr>
                    <?php if($student['faculty_note']!=""){?>
                    <tr>
                      <th>Faculty Note:</th>
                      <td><?php echo $student['faculty_note']; ?></td>
                    </tr>
                    <?php 
                    } ?>
                    <?php if($student['reception_note']!=""){?>
                    <tr>
                      <th>Reception Note:</th>
                      <td><?php echo $student['reception_note']; ?></td>
                    </tr>
                    <?php 
                    } ?>   
                    <?php if($student['extra_note']!=""){
                      $note_arr = explode("|",$student['extra_note']);
                    ?>
                    <tr>
                      <th colspan="2">અગત્યની નોંધઃ</th>
                    </tr>
                    <?php 
                      foreach($note_arr as $note){
                    ?>
                      <tr>
                        <th colspan="2"><?php echo $note; ?></th>
                      </tr>
                    <?php 
                      }
                    } ?>   
                    
                    <?php 
                    if($this->session->userdata('user_role')==1 || $this->session->userdata('user_role')==3 || $this->session->userdata('user_role')==7){
                    ?>
                    <tr>
                      <th>Offer Code:</th>
                      <td><?php echo $student['offer_code']?></td>        
                    </tr>
                    <tr>
                      <th colspan="2">
                        <table width="100%">
                          <tr>
                            <td>Installment Detail</td>
                          </tr>
                          <tr>
                            <td>
                              <table width="100%">
                                <tr>
                                  <th>No.</th>
                                  <th>Fees Amount</th>
                                  <th>Payment Due Date</th>
                                  <th>Status</th>
                                  <th>No.</th>
                                  <th>Fees Amount</th>
                                  <th>Payment Due Date</th>
                                  <th>Status</th>
                                </tr>
                                <tr>
                              <?php
                              if(!empty($student['installment_detail']))
                              {
                                $installment_data = json_decode($student['installment_detail']);
                                foreach ($installment_data as $key => $value)
                                {
                                  $status = ($value->status==1) ? "Paid" : "Pending";
                                  if($key%2 ==0 && $key>0){
                                    echo '</tr></tr>';
                                  }
                              ?>
                                  <td><?php echo $key+1;?></td>
                                  <td><?php echo $value->amount; ?>/-</td>
                                  <td><?php echo getSimpleDate($value->date); ?></td>
                                  <td><?php echo $status; ?></td>
                              <?php 
                                } 
                              }?> 
                              </tr>
                              </table>
                            </td>
                          </tr>
                        </table>
                      </th>
                      
                    </tr>
                    <?php }?>
                  </tbody>
                </table>
              </div>


              <div class="card-body table-responsive border-top">

                <table class="table table-bordered mt-4 border-top">
                  <thead>                  
                    <tr>
                      <th colspan="6" class="text-center"><h4 class="m-0">Paid Installment</h4></th>
                    </tr>
                    <tr>
                      <th>#</th>
                      <th>Amount</th>
                      <!-- <th>Inst. No.</th> -->
                      <th>Payment Mode</th>
                      <th>Payment Details</th>
                      <th>Date</th>
                    </tr>
                    <?php
                    $x=1;
                      foreach($installent as $fees)
                       {
                    ?>
                    <tr>
                        <td><?php echo $x;//$fees['rec_no']?></td>
                        <td><?php echo $fees['amount']?>/-</td>
                        <!-- <td><?php //echo $fees['installment_no']?></td> -->
                        <td><?php echo $fees['payment_mode'];?></td>
                        <td><?php echo $fees['payment_detail'];?></td>
                        <td><?php echo getSimpleDate($fees['date']);?></td>
                    </tr>
                  <?php $x++;} ?>

                  </thead>
                </table>

                 <table class="table table-bordered mt-4 border-top">
                  <thead>                  
                    <tr>
                      <th colspan="9" class="text-center"><h4 class="m-0">Student Tracking</h4></th>
                    </tr>
                    <tr>
                      <th>ID</th>
                      <th>Updated By</th>
                      <th>Assign From</th>
                      <th>Assign To</th>
                      <th>Update Date</th>
                    </tr>
                    <?php
                    $id=1;
                      foreach($student_tracking as $student_tr)
                       {
                          
                    ?>
                    <tr>
                        <td><?php echo $id; ?></td>
                        <td><?php echo $student_tr['t_faculty_name']?></td>
                        <td><?php echo $student_tr['from_faculty_name']?></td>
                        <td><?php echo $student_tr['to_faculty_name'];?></td>
                        <td><?php echo getSimpleDate($student_tr['transfer_date']);?></td>
                    </tr>
                  <?php $id++;} ?>

                  </thead>
                </table>

                

                <table class="table table-bordered mt-4 border-top">
                  <thead>                  
                    <tr>
                      <th colspan="7" class="text-center"><h4 class="m-0">Leave Report</h4></th>
                    </tr>
                    <tr>
                      <th>#</th>
                      <th>Date</th>
                      <th>Topic name</th>
                      <th>Remark</th>
                      <th>Status</th>
                      <th>Updated on</th>
                      <th>Edit</th>
                  
                    </tr>
                    <?php
                    if(!empty($leave_report)){
                      $cnt =1;
                      foreach($leave_report as $leave)
                      {
                        $dates = explode('-',$leave['leave_dates']);
                        $end_date = date('Y-m-d',strtotime($dates[1]));
                        $future_date = date('Y-m-d',strtotime("+2 day"));

                        
                    ?>
                    <tr>
                        <td><?php echo $cnt;?></td>
                        <td><?php echo $leave['leave_dates']?></td>
                        <td><?php echo $leave['topic_name']?></td>
                        <td><?php echo $leave['leave_remark']?></td>
                        <td><?php echo $leave['leave_status'];?></td>
                        <td><?php echo $leave['created_at'];?></td>
                        <td>
                         <?php 
                          //if($end_date<=$future_date){
                          ?> 
                          <a href="javascript:void(0);" data-leave="<?php echo $leave['id'];?>" class="btn btn-primary btn-xs m-1 student-leave"><i class="fa fa-edit"></i></a>
                          <!-- <?php // } ?> -->
                        </td>
                    </tr>
                  <?php $cnt++;} }
                  else{
                    echo '<tr><td colspan="7">No data found</td></tr>';
                  }?>

                  </thead>
                </table>

               

                <table class="table table-bordered mt-4 border-top">
                  <thead>                  
                    <tr>
                      <th colspan="9" class="text-center"><h4 class="m-0">Progress Report</h4></th>
                    </tr>
                    <tr>
                      <th>#</th>
                      <th>Topic</th>
                      <th>Exam remark</th>
                      <th>Total Marks</th>
                      <th>Obtained Marks</th>
                      <th>Grade</th>
                      <th>Faculty</th>
                      <th>Exam Date</th>
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
                        <td><?php echo $progress['exam_remark']?></td>

                        <td><?php echo $progress['total_marks']?></td>
                        <td><?php echo $progress['obtained_marks'];?></td>
                        <td><?php echo $progress['grade'];?></td>
                        <td><?php echo $progress['faculty_name'];?></td>
                        <td><?php echo getSimpleDate($progress['exam_date']);?></td>
                        <td>
                          <a href="<?php echo site_url('test/remove_test/course/'.$progress['id'].'/'.$progress['regno']);?>" class="btn btn-primary btn-xs m-1" onclick="return confirm('are you sure?');"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                  <?php $cnt++;}
                  }else{
                    echo '<tr><td colspan="9">No data found</td></tr>';
                  } ?>

                  </thead>
                </table>

                <table class="table table-bordered mt-4 border-top">
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
                        <td><?php echo $Complain['faculty_id'];?></td>
                        <td>
                          <a href="<?php echo site_url('admission/remove_complain/'.$Complain['c_id'].'/'.$Complain['regno']);?>" class="btn btn-primary btn-xs m-1 delete_complain" onclick="return confirm('are you sure?');"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                  <?php $cnt++;}
                  }else{
                    echo '<tr><td colspan="9">No data found</td></tr>';
                  } ?>

                  </thead>
                </table>

                 <table class="table table-bordered mt-4 border-top">
                  <thead>                  
                    <tr>
                      <th colspan="9" class="text-center"><h4 class="m-0">Lecture Details</h4></th>
                    </tr>
                    <tr>
                      <th>ID</th>
                      <th>Project Name</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                </table>

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
 <div class="modal fade " id="StudentLeaveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Leave Report</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" id="LeaveReportForm">
        <input type="hidden" name="regno" id="regno" value="">
        <input type="hidden" name="leaveno" id="leaveno" value="">
        <div class="modal-body">
          <div id="update-msg-leave"></div>
          <div class="form-group">
            <label>Select Leave Dates</label>
            <input type="text" name="leave_dates"  class="form-control" id="leave_dates" placeholder="Enter Leave Dates"  >
          </div>
          <div class="form-group">
            <label>Leave Remark</label>
            <textarea class="form-control" name="remark" id="remark" placeholder="Enter Remark"></textarea>
          </div>
          <div class="form-group">
            <label>Select Status</label>
            <select class="form-control" name="leave_status" id="leave_status">
              <option value="A" >Absent</option>
              <option value="L" >Leave</option>
              
            </select>
          </div>
          
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','.student-leave',function(){
      var leaveno = $(this).attr('data-leave');
      $.ajax({
        type:"POST",
        url:"<?php echo site_url('admission/ajax_leave_info');?>",
        data:{leaveno:leaveno},
        dataType:'json',
        success:function(data){
          data = data.data
          $('input[name="leave_dates"]').daterangepicker({
            locale: {
              format: 'MM/DD/YYYY'
            },
            autoApply:true,
            "startDate": data.start_date,
            "endDate": data.end_date   
          })
          $('#leaveno').val(data.id);
          $('#remark').val(data.leave_remark);
          $('#leave_status').val(data.leave_status);
          $('#regno').val(data.regno);
          $('#StudentLeaveModal').modal('show');
        }
      });
      return false;
    });
    $('#LeaveReportForm').submit(function(){
      var formData = $('#LeaveReportForm').serialize();
      $.ajax({
        type:"POST",
        url:"<?php echo site_url('admission/ajax_leave_update');?>",
        data:formData,
        beforeSend:function(){
          $('.process-loader').show();
        },
        complete:function(){
          $('.process-loader').hide();
        },
        success:function(data){
          $('#update-msg-leave').html(data);
        }
      });
      return false;
    })
  });

</script>