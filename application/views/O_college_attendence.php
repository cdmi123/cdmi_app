<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//pre($students);die;
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
            <h1>Student Attendence</h1>
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
          <form method="post" onsubmit="return false;" id="search_form">
            <div class="card-header">
              
              <?php 
              for ($i = -3; $i < 0; $i++){
                $url_month = date('Y_m', strtotime("$i month"));
              ?>
              <a href="<?php echo site_url('old-attendence/'.$class_year.'/'.$class_name.'/'.$url_month);?>" class="btn btn-primary btn-sm"><?php echo date('F-Y', strtotime("$i month"));?></a>
              <?php
                //echo date('M', strtotime("$i month"));
              }
              ?>
              <a href="<?php echo site_url('student-attendence/'.$class_year.'/'.$class_name);?>" class="btn btn-primary btn-sm"><?php echo date('F-Y');?></a>
            </div>
            
          </form>
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
                  <h4>Total Students:<?php echo count($students); ?></h4>
                </div>
                <div class="col-md-3">
                  <?php 
                  if(empty($attendence_data[$today_date])){
                  ?>
                  <h4>Today Present : 0</h4>
                  <?php
                  }else{
                  ?>
                  <h4>Today Present : <?php echo count($attendence_data[$today_date]); ?></h4>
                  <?php }?>
                </div>
                <div class="col-md-3">
                  <?php 
                  if(empty($attendence_data[$today_date])){
                  ?>
                  <h4>Today Absent : <?php echo count($students)-0; ?></h4>
                  <?php
                  }else{
                  ?>
                  <h4>Today Absent : <?php echo count($students)-count($attendence_data[$today_date]); ?></h4>
                  <?php }?>
                </div>
              </div>
              <?php }?>
              <form method="post">
              <table  class="table table-bordered table-hover table-font table-responsive" id="example">
                <thead>
                  <tr>
                    <th colspan="<?php echo $cur_day+3; ?>" style="color:blue;font-size: 18px;">
                      <input type="submit" name="submit" value="Submit" class="btn btn-success" >

                      <input type="button" name="absent" value="Absent" class="btn btn-success" onclick="absent1()">

                      &nbsp;<input type="button" name="present" value="Present" class="btn btn-success" onclick="present1()">
                    </th>
                  </tr>
                  <tr>
                    <th>REG NO</th>
                    <th>ROLL NO</th>
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
                    foreach ($students as $admission)
                    {
                      $regno= $admission['regno'];
                      // $status ="";
                      // $checked ="checked";
                      // if(!empty($attendence_data)){
                      //   $status = in_array($admission['regno'], $attendence_data) ? "Present" : "Absent";
                      //   if($status=="Present"){
                      //     $checked = "checked";
                      //   }else{
                      //     $checked = "";
                      //   }
                      // }else{
                      //   $checked = "checked";
                      // }

                      if($admission['image']!='')
                      {
                        $img = base_url('upload/college_student_photo/'.$admission['image']);
                      }else{
                        $img = base_url('assets/users.jpg');
                      }


                      //  $this->db->where_in('status',array("L","S"));
                      // $sdata = $this->db->get('admission')->row_array();

                      // if(!empty($sdata))
                      // {
                  ?>
                    <tr>
                      <td><?php echo $admission['regno'];?></td>
                      <td><?php echo $admission['roll_no'];?></td>
                      <td>
                        <?php echo $admission['student_name']?>
                        <div style="border-top: solid 1px black;margin-top: 5px"></div>
                        <?php echo $admission['personal_mobile_no'] ;?>
                        <?php echo $admission['father_mobile_no'] ? " / ".$admission['father_mobile_no'] : ""; ?>
                        <?php echo $admission['home_mobile_no'] ? " / ".$admission['home_mobile_no'] : ""; ?>
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
                        if(isset($attendence_data[$temp_date])){
                          if(!empty($attendence_data[$temp_date])){

                              $class_name = "attendence1";

                            if(in_array($regno, $attendence_data[$temp_date])){
                              $checked="checked";
                              $status = "P";
                              $status_class = "btn-success";
                            }else{
                              $checked="";
                              $status = "A";
                            }
                          }else if(!empty($absent_info[$temp_date])){
                            $checked="";
                            $status = "A";
                          }else{
                            $checked="checked";
                            $status = "NA";
                            $status_class = "btn-warning";
                          }
                        }
                        $note="";
                        if(isset($leave_info[$temp_date][$regno])){
                          $note = $leave_info[$temp_date][$regno];
                        }
                        ?>
                        <td>
                          <label class="switch">
                            <input type="checkbox" name="regno[]" <?php echo $disabled; ?> <?php echo $checked; ?> value="<?php echo $admission['regno']; ?>" class="attendence<?php echo $temp_date; ?>" >
                            <span class="slider round"></span>
                          </label>
                          <div>
                            <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="<?php echo $note; ?>" data-note="<?php echo $note; ?>" data-class_name="<?php echo $class_id; ?>" data-regno="<?php echo $regno; ?>" class="btn <?php echo $status_class; ?> btn-xs update-status "><?php echo $status; ?></a>
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
                    <?php  } ?>    
                    <tr>
                      <th colspan="<?php echo $cur_day+3; ?>" style="color:blue;font-size: 18px;">
                        <input type="submit" name="submit" value="Submit" class="btn btn-success">
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
 <div class="modal fade " id="UpdateStatusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Reason</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" id="UpdateStatusForm">
        <input type="hidden" name="regno" id="regno" value="">
        <input type="hidden" name="class_name" id="class_name" value="">
        <div class="modal-body">
          <div id="update-msg"></div>
          <div class="form-group">
            <label>Enter Note</label>
            <textarea class="form-control" name="note" id="note" placeholder="Enter Note"></textarea>
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

 $(document).ready(function(){
  $('body').tooltip({selector: '[data-toggle="tooltip"]'});
    $(document).on('click','.update-status',function(){
      var regno = $(this).attr('data-regno');
      var note = $(this).attr('data-note');
      var class_name = $(this).attr('data-class_name');
      $('#note').val(note);
      $('#regno').val(regno);
      $('#class_name').val(class_name);
      $('#UpdateStatusModal').modal('show');
    })
    $('#UpdateStatusForm').submit(function(){
      var formData = $('#UpdateStatusForm').serialize();
      $.ajax({
        type:"POST",
        url:"<?php echo site_url('college_attendence/update_status');?>",
        data:formData,
        beforeSend:function(){
          $('.process-loader').show();
        },
        complete:function(){
          $('.process-loader').hide();
        },
        success:function(data){
          $('#update-msg').html(data);
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