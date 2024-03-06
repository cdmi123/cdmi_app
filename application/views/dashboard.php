<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('header');
$role = $this->session->userdata('user_role');

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <?php 
          if($role==1||$role==3||$role==7){
          ?>
          <!-- <div class="col-lg-3 col-6">
            
            <div class="small-box bg-success">
              <div class="inner">
                <h5>Course : <?php //echo @$today_course_adm['total_admission'] ? $today_course_adm['total_admission'] : 0;?></h5>
                <h5>Tution : <?php //echo @$today_college_adm['total_admission'] ? $today_college_adm['total_admission'] : 0;?></h5>
                <h6><?php //echo date("d-m-Y");?></h6>
                <p>Today Admission</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="" class="small-box-footer">View Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> -->
          <?php }?>
          
          <?php 
          if($role==1||$role==3||$role==7||$role==4||$role==8){
          ?>
          <!-- <div class="col-lg-3 col-6">
            
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php //echo @$cnt;?></h3> 
                <p>Today Course Visit</p>
              </div>
              <div class="icon">
                <i class="ion ion-help"></i>
              </div>
              <a href="<?php //echo site_url('inquiry/today_followup')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>    -->       
          <!-- <div class="col-lg-2 col-6">
            
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php //echo $due_inq;?></h3>
                <p>Due Course Visit</p>
              </div>
              <div class="icon">
                <i class="ion ion-help"></i>
              </div>
              <a href="<?php //echo site_url('inquiry/due_followup')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> -->
          <?php }?>
          
          <?php 
          if($role==1||$role==3||$role==7||$role==4||$role==8){
          ?>
          <!-- <div class="col-lg-2 col-6">
            
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php //echo $scl_today;?></h3>
                <p>Today School Visit</p>
              </div>
              <div class="icon">
                <i class="ion ion-help"></i>
              </div>
              <a href="<?php //echo site_url('schoolinq/today_followup')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> -->
          
          <!-- <div class="col-lg-2 col-6">
            
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php //echo $scl_due;?></h3>
                <p>Due School Visit</p>
              </div>
              <div class="icon">
                <i class="ion ion-help"></i>
              </div>
              <a href="<?php //echo site_url('schoolinq/due_followup')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> -->
          <?php }?>
          <!-- ./col -->
        </div>
        
        <!-- /.row -->

        <!-- Main row -->
        <div class="row">
          <?php 
          if($role==1 || $role==2 || $role==3 || $role==5 || $role==7){          
          ?>
          <div class="col-md-5">
            <div class="card">
              <div class="card-header ">
                <h3 class="card-title">Batchwise Students</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table class="table table-bordered border-top table-font text-center">
                  <thead>                  
                    <tr>
                      <th width="40px">#</th>
                      <th>Batch</th>
                      <th>PC</th>
                      <th>Laptop</th>
                      <th>Total</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $pc_total = 0;
                    $lap_total =0;
                    foreach($batch_times as $key=>$batch){
                      $qry_pc =  $this->db->query("SELECT COUNT(id) as batch_stds FROM admission WHERE status='R' and sitting='PC' and (pcno like 'DES%' or pcno like 'DEV%' ) and FIND_IN_SET('".$batch['batch']."',batch_time) "); 
                      $pc_stds = $qry_pc->row_array();
                      $qry_lap =  $this->db->query("SELECT COUNT(id) as batch_stds FROM admission WHERE status='R' and sitting='LAPTOP' and FIND_IN_SET('".$batch['batch']."',batch_time) "); 
                      $lap_stds = $qry_lap->row_array();
                      //pre($pc_stds);die;
                      $pc_total += $pc_stds['batch_stds'];
                      $lap_total += $lap_stds['batch_stds'];
                      $batch_total = $pc_stds['batch_stds']+$lap_stds['batch_stds'];
                    ?>
                    <tr>
                      <td><?php echo $key+1;?></td>
                      <td><?php echo $batch['batch'];?></td>
                      <td><?php echo $pc_stds['batch_stds'];?></td>
                      <td><?php echo $lap_stds['batch_stds'];?></td>
                      <td><?php echo $batch_total;?></td>
                      <td><a class="btn btn-xs btn-primary" href="<?php echo site_url('Dashboard/seating/'.$batch['id']);?>"><i class="fas fa-eye"></i></a></td>
                    </tr>
                    <?php }?>
                    <tr>
                      <th width="40px">#</th>
                      <th>Total</th>
                      <th><?php echo $pc_total;?></th>
                      <th><?php echo $lap_total;?></th>
                      <th><?php echo ($pc_total+$lap_total);?></th>
                      <th></th>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>

       

            <!-- /.card -->
          </div>

           <div class="col-md-7">
            <div class="card">
              <div class="card-header ">
                <h3 class="card-title">Staff Time Table</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table class="table table-bordered border-top table-font table-center">
                  <thead>                  
                    <tr>
                      <th>Id</th>
                      <th>Name</th>
                      <th>8 to 10 / LB</th>
                      <th>10 to 12 / LB</th>
                      <th>12 to 2 / LB</th>
                      <th>2 to 4 / LB</th>
                      <th>4 to 6 / LB</th>
                      <th>6 to 8 / LB</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php $Id = 1; foreach ($free_time as $Index => $value) { ?> 
                        <tr>
                           <td><?php echo $Id; ?></td>
                           <td><?php echo $Index; ?></td>
                           <?php foreach($value as $key => $value1) { 

                            if($value1['total_lecture']>=3) { ?>
                           <td align="center" class="bg-danger h5"><?php echo $value1['total_lecture'];?> <?php if($value1['Batch_leave']>0) { ?> / <?php echo $value1['Batch_leave']; } ?></td>

                           <?php } else if($value1['total_lecture']>=1) { ?>
                            <td align="center" class="bg-warning h5"><?php echo $value1['total_lecture'];?> <?php if($value1['Batch_leave']>0) { ?> / <?php echo $value1['Batch_leave']; } ?></td> 
                          <?php } else  { ?>
                            <td align="center" class="bg-success h5"><?php echo $value1['total_lecture'];?> <?php if($value1['Batch_leave']>0) { ?> / <?php echo $value1['Batch_leave']; } ?> </td><?php } } ?>
                        </tr>
                      <?php $Id++; }  ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <?php } ?>
          <?php 
          if($role==8){          
          ?>
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">School Report : (Today Call:<?php echo $today_call;?>)</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table class="table table-bordered border-top table-font">
                  <thead>                  
                    <tr>
                      <th width="40px">#</th>
                      <th>School</th>
                      <th>Total</th>
                      <th>Pending</th>
                      <th>Calling</th>
                      <th>Visited</th>
                      <th>Admission</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    foreach($school_data as $key=>$school){
                      $visited = $this->Schoolinq_model->count_inq_by_status($school['id'],'V');
                      $pending = $this->Schoolinq_model->count_inq_by_status($school['id'],'P');
                      $admission = $this->Schoolinq_model->count_inq_by_status($school['id'],'A');
                      $calling = $this->Schoolinq_model->count_inq_by_status($school['id'],'IC');
                    ?>
                    <tr>
                      <td><?php echo $key+1;?></td>
                      <td><?php echo $school['school_name'];?></td>
                      <td><?php echo $school['total_count'];?></td>
                      <td><?php echo $pending;?></td>
                      <td><?php echo $calling;?></td>
                      <td><?php echo $visited;?></td>
                      <td><?php echo $admission;?></td>
                    </tr>
                    <?php }?>
                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <?php }?>
          <!-- /.col -->
        </div>
        <!-- /.row (main row) -->

          <!-- Main row -->
   
        <!-- /.row (main row) -->


      </div><!-- /.container-fluid -->

      <?php if($role==1 || $role==3 || $role==5 || $role==7) { ?>

  <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Class Time Table</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive lecture_time">
                <table class="table table-bordered border-top table-font text-center">
                  <thead>                  
                    <tr>
                      <th width="70px">#</th>
                      <?php foreach($lecture_time as $lecture_batch) { ?>
                      <th><?php echo $lecture_batch['batch_time']; ?></th>
                      <?php } ?>
                    </tr>
                  </thead>
                  <tbody>     

                      <?php
                      $a=1;
                      foreach($lecture_class as $lc){ $title = "";?>
                          <tr>
                            <th><?php echo $lc['class_name']; ?></th>
                        <?php 
                          foreach($lecture_time as $batch_name) {

                            $time = $batch_name['batch_time'];
                            $class_name = $lc['class_name'];

                            $sql = $this->db->query("select * from student_batches where lecture_time = '$time'  and class_name = '$class_name'"); 
                            $data = $sql->row_array();



                            // if(empty($data))
                            // {
                            //      $sql = $this->db->query("select * from collage_batch where lecture_time = '$time'  and class_name = '$class_name'"); 
                            //     $data1 = $sql->row_array();
                            // }

                             // if(!empty($data))
                             // {
                             //    $faculty_id = $data['faculty_id'];
                             //    $collage_div_id = $data['id'];

                             //      $this->db->where('id',$faculty_id);
                             //      $faculty_data = $this->db->get('admin')->row_array();

                             //    $check = "checked";
                             //    $class_name = "remove-course";
                             //    $title = $faculty_data['name'];


                             // } else if(!empty($data1)){

                             //   $batch_id = $data1['id'];

                             //      $this->db->where('id',$batch_id);
                             //      $collage_batch = $this->db->get('collage_batch')->row_array();

                             //    $check = "checked";
                             //    if( $role==1 || $role==5 || $role==6 || $role==7 ) {

                             //    $class_name = "remove-class";

                             //    }
                             //    $title = "( ".$collage_batch['collage_year']." ) ".$collage_batch['division'];
                             //  $collage_div_id = $collage_batch['id'];

                             // }else if(empty($data) || empty($data1)) {
                             //     $check = "";
                             //    if($role==1 || $role==5 || $role==6 || $role==7 ) {
                             //    $class_name = "assign-class";
                             //    }
                             //    $title = ""; 
                             // }
                             
                          ?>
                            <td>
          <label class="seat_manage <?php echo $class_name; ?>" data-lecture="<?php echo $lc['class_name']; ?>" data-lecture-time="<?php echo $time; ?>" data-collage-batch-id="<?php echo @$collage_div_id;
           ?>" data-class-name="<?php echo @$title; ?>">      
          <input type="checkbox" name="" disabled class="chk_box" <?php echo @$check; ?>  value="<?php echo $lc['id']; ?>" >
           <span class="cust_seat" title="<?php echo $title; ?>">
          <i class="fas fa-chalkboard-teacher seat_icon <?php echo $class_name; ?>" data-lecture="<?php echo $lc['class_name']; ?>" data-lecture-time="<?php echo $time; ?>"></i>
          </span>

                              </label>
                            </td>
                        <?php }  ?>
                          </tr>
                      <?php $a++; } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          
          <!-- /.col -->
        </div>
      <?php } ?>
    </section>
    <!-- /.content -->               
  </div>

                     

  <?php
    $this->load->view('footer');
  ?>



<style type="text/css">
        .lecture_time table tr td{
          padding:5px !important;
        }
      .seat_manage
      {
        position: relative;
        margin-bottom:0;
      }
      .chk_box
      {
        opacity: 0;
        position: absolute;
        /* margin: 40px; */
      }
      .cust_seat
      {
          /* position: absolute;
          left: 0;
          top: 0; */
          display:block;
          height: 40px;
          width: 40px;
          background-color: #f1f1f1;
          border-radius: 5px;
          /* margin: 5px; */
          cursor: pointer;
      }
      .cust_seat:hover
      {
        background-color: #e5e5e5;
      }
      .seat_icon
      {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 16px;
      }
      .chk_box:checked + .cust_seat
      {
        background-color: #003366;
      }
      .chk_box:checked + .cust_seat>.seat_icon
      {
        color: #fff;
      }

</style>

<!-- Class assign model -->

<div class="modal fade " id="AssignClassModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Assign Collage Class</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" id="AssignClassform">
        <!-- <input type="hidden" name="lc_id" id="lc_id" value=""> -->
        <div class="modal-body">
          <label>Select Collage Year</label>
          <div class="form-group">
            <select class="form-control" name="collage_year" tabindex="9">
              <option disabled selected>Select Collage Year</option>
              <option value="FY">First Year (FY)</option>
              <option value="SY">Second Year (SY)</option>
              <option value="TY">Third Year (TY)</option>
            </select>
          </div>

          <label>Select Division</label>
          <div class="form-group">
            <select class="form-control" name="collage_div" tabindex="9">
              <option disabled selected>Select Division</option>
              <option value="Div A">Div A</option>
              <option value="Div B">Div B</option>
              <option value="Div C">Div C</option>
              <option value="Div D">Div D</option>
              <option value="Div E">Div E</option>
              <option value="Div F">Div F</option>
              <option value="Div G">Div G</option>  
            </select>
          </div>

          <label>Lecture Class</label>
          <div class="form-group">
            <input type="text" name="class_name" id="class_name" class="form-control">
          </div>

           <label>Lecture Time</label>
          <div class="form-group">
            <input type="text" name="lecture_time" id="lecture_time" class="form-control">
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

<!-- End class assign model -->

<!-- Remove Class model -->

<div class="modal fade" id="RemoveClassModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Remove Collage Class</h5>
        <form id="RemoveClassform">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label>Class Name:</label>
        <input type="text" id="remove_class_name" class="form-control" readonly>
      </div>
      <div class="modal-body">
        <input type="hidden" id="class_id" class="form-control" name="remove_id">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Remove Collage Class</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- End Remove Class Model -->

<!-- Remove model -->

<div class="modal fade" id="RemoveClass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Remove Regular Class</h5>
        <form id="RemoveCourse">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label>Class Name:</label>
        <input type="text" id="remove_class_course" class="form-control" readonly>
      </div>
      <div class="modal-body">
        <input type="hidden" id="class_course_id" class="form-control" name="remove_id">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Remove Class</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- End Remove Class Model -->

<script type="text/javascript">
 $(document).on('click','.assign-class',function(){

        var class_name = $(this).attr('data-lecture');
        var lecture_time = $(this).attr('data-lecture-time');
        $('#class_name').val(class_name);
        $('#lecture_time').val(lecture_time);
        $('#AssignClassModel').modal('show');
        
      });

      $('#AssignClassform').submit(function(){
        var formData = $('#AssignClassform').serialize();
        $.ajax({
          type:"POST",
          url:"<?php echo site_url('admission/assign_collage_class');?>",
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
            $('#AssignClassModel').modal('hide');
          }
          }
        });
        return false;
      });

      $(document).on('click','.remove-class',function(){

        var class_name = $(this).attr('data-class-name');
        var class_id = $(this).attr('data-collage-batch-id');
       
        $('#remove_class_name').val(class_name);
        $('#class_id').val(class_id);
       
        $('#RemoveClassModel').modal('show');
        
      });

      $('#RemoveClassform').submit(function(){
        var formData = $('#RemoveClassform').serialize();
        $.ajax({
          type:"POST",
          url:"<?php echo site_url('admission/Remove_collage_class');?>",
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
            $('#RemoveClassModel').modal('hide');
            window.location.reload();
          }
          }
        });
        return false;
      })



      $(document).on('click','.remove-course',function(){

        var class_name = $(this).attr('data-class-name');
        var class_id = $(this).attr('data-collage-batch-id');
       
        $('#remove_class_course').val(class_name);
        $('#class_course_id').val(class_id);
       
        $('#RemoveClass').modal('show');
        
      });

      $('#RemoveCourse').submit(function(){
        var formData = $('#RemoveCourse').serialize();
        $.ajax({
          type:"POST",
          url:"<?php echo site_url('admission/Remove_Regular_class');?>",
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
            $('#RemoveClass').modal('hide');
            window.location.reload();
          }
          }
        });
        return false;
      })
 


</script>