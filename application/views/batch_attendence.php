<?php

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('header');
?>
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 30px;
  height: 17px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #f10202;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 13px;
  width: 13px;
  left: 2px;
  bottom: 2px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #1e7509;
}

input:focus + .slider {
  box-shadow: 0 0 1px #1e7509;
}

input:checked + .slider:before {
  -webkit-transform: translateX(13px);
  -ms-transform: translateX(13px);
  transform: translateX(13px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 17px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Student Batch Attendence</h1>
          </div>
          <div class="col-sm-6">
            <div class="row">
              <div class="col-6">
              </div>
              <div class="col-6">
               
              </div>
            </div>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-sm-12">
            
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
         <!--  <form method="post" onsubmit="return false;" id="search_form">
            <div class="card-header">
              
              <?php 
              for ($i = -3; $i < 0; $i++){
                $url_month = date('Y_m', strtotime("$i month"));
              ?>
              <a href="<?php echo site_url('old-batch-attendence/'.$Batch_id.'/'.$url_month);?>" class="btn btn-primary btn-sm"><?php echo date('F-Y', strtotime("$i month"));?></a>
              <?php
                //echo date('M', strtotime("$i month"));
              }
              ?>
              <a href="<?php echo site_url('batch-attendence/'.$Batch_id) ?>" class="btn btn-primary btn-sm"><?php echo date('F-Y');?></a>
            </div>
            
          </form> -->
            <!-- /.card-header -->
            <div class="card-body">
              <?php 
              if($is_current==true){
              ?>
              <div class="row" style="color:green">
                <div class="col-md-3">
                  <h4>
                    Today Status: <?php 
                    if(!empty($attendence_data[$today_date])){
                      echo "Done";
                    }else{
                      echo "Pending";
                    }
                    ?>
                  </h4>
                </div>
                <div class="col-md-3">
                  <h4>Total Students:<?php echo count($student); ?></h4>
               
                </div>
                <div class="col-md-3">
                  <h4>Today Present : <?php if(empty($attendence_data[$today_date])) { ?> 0 <?php } else { count($attendence_data[$today_date]); } ?></h4>
                </div>
                <div class="col-md-3">
                  <h4>Today Absent : <?php if(empty($attendence_data[$today_date])) { echo count($student); } else {echo count($student)-count($attendence_data[$today_date]); } ?></h4>
                </div>
              </div>
              <?php }?>
              <form method="post">
              <table  class="table table-bordered table-hover table-font table-responsive" id="example">
                <thead>
                  <tr>
                    <th colspan="<?php echo $cur_day+3; ?>" style="color:blue;font-size: 18px;">
                      <div class="row">
                        <div class="col-auto">
                          <input type="text" name="lecture_name" class="form-control col-auto" placeholder="Lecture Topic" value="<?php echo @$lecture_name; ?>">
                        </div>
                        <div class="col-auto">
                          <input type="submit" name="submit" value="Submit" class="btn btn-success">
                        </div>
                        <div class="col-auto">
                          <a href="<?php echo site_url('admission/view_batches'); ?>" class="btn btn-success">View batch</a>
                        </div>
                        <div class="col-auto">
                           <input type="button" name="absent" value="Absent" class="btn btn-success" onclick="absent1()">
                        </div>
                        <div class="col-auto">
                           <input type="button" name="present" value="Present" class="btn btn-success" onclick="present1()">
                        </div>
                      </div>
                    </th>
                  </tr>
                  <tr>
                    <th>REG NO</th>
                    <th width="250">
                      STUDENT NAME
                      <div style="border-top: solid 1px black;margin-top: 5px"></div>
                      CONTACT NO.
                    </th>
                    <th width="55">
                      Image
                    </th>
                    <?php 
                    for($i=$cur_day;$i>=1;$i--){
                      echo "<th>".$i."-".$cur_month."</th>";
                    }
                    ?>
                  </tr>
                </thead>
                <tbody >
         
                <?php   
                    foreach ($student as $admission)
                    {
                      $regno= $admission['regno'];

                      if($admission['image']!='')
                      {
                        $img = base_url('upload/student_photo/'.$admission['image']);
                      }else{
                        $img = base_url('assets/users.jpg');
                      }

                      $this->db->where('regno',$admission['regno']);
                      $this->db->where('status',"L");
                      $sdata = $this->db->get('admission')->row_array();

                      if(empty($sdata))
                      {
                  ?>
                    <tr>
                      <td><?php echo $admission['regno']?></td>
                      <td>
                        <?php echo $admission['student_name']; ?>
                        <div style="border-top: solid 1px black;margin-top: 5px"></div>
                        <?php echo $admission['contact'];?> /
                        <?php echo $admission['father_contact']; ?>
                      </td>
  
                      <td>
                        <img class="img-fluid" src="<?php echo $img;?>" alt="Student" width="45" />
                      </td>

                      <?php 
                      for($i=$cur_day;$i>=1;$i--){
                        $temp_date = date($cur_year.'-'.$cur_month.'-'.$i);
                        $temp_date = date($cur_year.'-'.$cur_month.'-d',strtotime($temp_date));
                        $checked = "checked";
                        $disabled = "disabled";
                        $status_class = "btn-danger";
                        $status = "";
                        if($temp_date==$today_date){
                          $disabled = "";
                        }

                        if(isset($attendence_data[$temp_date]))
                        {

                          if(!empty($attendence_data[$temp_date]))
                          {
                                   
                            if(in_array($regno, $attendence_data[$temp_date]))
                            {
                              $checked="checked";
                              $status = "P";
                              $status_class = "btn-success";

                            }else{

                              $checked="";
                              $this->db->where('regno',$regno);
                              $this->db->where('DATE(created_at)',$temp_date);
                              $leave_report = $this->db->get('course_attendence')->row_array();
                             

                                if(empty($leave_report))
                                {
                                    $leave_remark="A";
                                }
                                else
                                {
                                    $leave_remark = $leave_report['leave_status'];
                                }
                             


                              if($leave_remark=="A"){
                                $status = "A";
                                $status_class = "btn-danger";
                              }else{
                                $status = "L";
                                $status_class = "btn-primary";
                              }
                            }
                          }else{
                            $checked="checked";
                            $status = "NA";
                            $status_class = "btn-warning";
                          }
                        }else{
                          $status="A";
                          $checked="";
                          $status_class = "btn-danger";
                        }

                        $note="";
                        if(isset($lecture_data[$temp_date][$regno])){
                          $note = $lecture_data[$temp_date][$regno];
                        }
                        ?>
                        <td>
                          <label class="switch">
                            <input type="checkbox" name="regno[]" <?php echo $disabled; ?> <?php echo $checked; ?> value="<?php echo $admission['regno']; ?>" class="attendence<?php echo $temp_date; ?>">
                            <span class="slider round " ></span>
                          </label>
                          <div>
                            <a href="javascript:void(0);" data-toggle="tooltip"  data-placement="top" title="<?php echo $note; ?>" data-note="<?php echo $note; ?>"  data-regno="<?php echo $admission['regno']; ?>" data-stuname="<?php echo $admission['student_name']; ?>" class="btn <?php echo $status_class; ?> btn-xs update-status student-leave"><?php echo $status; ?></a>
                          </div>
                        </td>
                        <?php
                        
                      }
                      ?>
                      <?php  
                      // if($status!=""){

                      
                      //   if($status == "Present"){
                      //       echo '<th style="color:green;">'.$status.'</th>';
                      //   }else{
                      //       echo '<th style="color:red;">'.$status.'</th>';
                      //   }
                      // }  
                       ?>
                    </tr>
                  <?php }  } ?>    
                    <tr>
                      <th colspan="<?php echo $cur_day+3; ?>" style="color:blue;font-size: 18px;">
                        <input type="submit" name="submit" value="Submit" class="btn btn-success">
                        <a href="<?php echo site_url('admission/view_batches'); ?>" class="btn btn-success">View batch</a>
                      </th>
                    </tr>
                               
                </tbody>
              </table>
              </form> 
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
        <h5 class="modal-title" id="exampleModalLabel">Leave Report</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" id="LeaveReportForm">
        
        <div class="modal-body">
          <div id="update-msg-leave"></div>
          <div class="row">
            <div class="form-group col-3">
              <label>Reg No</label>
              <input type="text" name="regno" id="regno" class="form-control" readonly value="">
            </div>
            <div class="form-group col-9">
              <label>Name</label>
              <input type="text" name="name" id="name" value="" class="form-control"  disabled>
            </div>
            <div class="form-group col-12">
              <label>Enter Remark</label>
              <textarea class="form-control" name="remark" id="remark" placeholder="Enter Remark"></textarea>
            </div>
            <div class="form-group col-12">
              <label>Select Status</label>
              <select class="form-control" name="leave_status" id="leave_status">
                <option value="A" >Absent</option>
                <option value="L" >Leave</option>
              </select>
            </div>
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

<script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>

<script type="text/javascript">

   $(document).on('click','.student-leave',function(){
        var regno = $(this).attr('data-regno');
        var name = $(this).attr('data-stuname');
        $('input[name="regno"]').val(regno);
        $('input[name="name"]').val(name);
        $('#StudentLeaveModal').modal('show');
        $('input[name="leave_dates"]').daterangepicker({
          locale: {
            format: 'MM/DD/YYYY'
          },
          autoApply:true
        });
      });

 $(document).ready(function(){
  $('body').tooltip({selector: '[data-toggle="tooltip"]'});
    $('#LeaveReportForm').submit(function(){
      var formData = $('#LeaveReportForm').serialize();
      $.ajax({
        type:"POST",
        url:"<?php echo site_url('Batch_attendence/update_status');?>",
        data:formData,
        beforeSend:function(){
          $('.process-loader').show();
        },
        complete:function(){
          $('.process-loader').hide();
        },
        success:function(data){
          if(data==true)
          { 
            $('#StudentLeaveModal').modal('hide');
          }
          else
          {
            $('#update-msg-leave').html(data);
          }
        }
      });
      return false;
    })
 })

  function absent1() {

    const date = new Date();

    var day = String(date.getDate()).padStart(2, '0');
    var month = String(date.getMonth() + 1).padStart(2, '0');;
    var year = date.getFullYear();

      var currentDate = year+'-'+month+'-'+day;

    var class_name = "attendence"+currentDate;

    var total = document.getElementsByClassName(class_name);
  
      for(var i=0;i<total.length;i++)
      {
        document.getElementsByClassName(class_name)[i].checked = false;
      }

  }

  function present1() {

    const date = new Date();

    var day = String(date.getDate()).padStart(2, '0');
    var month = String(date.getMonth() + 1).padStart(2, '0');;
    var year = date.getFullYear();

      var currentDate = year+'-'+month+'-'+day;

    var class_name = "attendence"+currentDate;

    var total = document.getElementsByClassName(class_name);
  
      for(var i=0;i<total.length;i++)
      {
        document.getElementsByClassName(class_name)[i].checked = true;
      }

  }
</script>