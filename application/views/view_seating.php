<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 $this->load->view('header');
$id= $this->session->userdata('user_login');
$this->db->where('id',$id);
$arr = $this->db->get('admin')->row_array();
$view_data['arr'] = $arr;  
  // foreach ($rec as $val)
  // {
  //     echo "<br> pcno = ".$val['pcno'];
  // }

  // die;
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            
            <h1>Seating Format : DESIGN PC - <?php echo $total_pc_des;?> , DEVELOPMENT PC - <?php echo $total_pc_dev;?> , LAPTOP - <?php echo sizeof($laptop_data);?></h1>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
           
            <!-- /.card-header -->
            <div class="card-body p-3 text-center">
              <h3 class="font-weight-bold text-center mb-3">Time : <?php echo $time;?></h3>
              <h3 class="font-weight-bold text-center my-3">Design PC</h3>
              <table id="example2" class="table table-hover">
                <thead>
                <tr>
                  <th>

                    <?php
                      $cnt = 0;
                      for ($i=1; $i<=TOTAL_PC_DES;$i++)
                      { 
                          
                             if(isset($rec_des['DES-'.$i]))
                              {
                                    $cnt=1;

                                    if($i%10==1 && $i!=1)
                                    {
                                        //echo '<br>';
                                    }
                                    if($this->session->userdata('user_role')!=2 && $this->session->userdata('user_role')!=5){
                                      $link = site_url('admission/view_student/'.$rec_des['DES-'.$i]['regno']);
                                    }else{
                                      $link = "javascript:void(0)";
                                    }
                    ?>
                    
                      <label class="seat_manage" style="margin-bottom: 1.5rem;">
                          <a href="<?php echo $link; ?>" data-toggle="tooltip" data-placement="top" title="<?php echo $rec_des['DES-'.$i]['student_name'].' - '.$rec_des['DES-'.$i]['course'].' - '.$rec_des['DES-'.$i]['faculty'] ?>"></a>
                          <input type="checkbox" name="" class="chk_box" checked="">
                          <span class="cust_seat" >

                              <!-- <i class="fas fa-chair seat_icon"></i> -->

                              <i class="fas fa-desktop seat_icon"></i>
                          </span>
                          <span class="pc_no"><?php echo $i; ?></span>
                      </label>
                    <?php }  ?> 

                    <?php if($cnt!=1) { ?>
                       <label class="seat_manage">
                          <input type="checkbox" name="" class="chk_box" >
                          <span class="cust_seat" data-toggle="tooltip" data-placement="top" title="Not Assigned">

                              <i class="fas fa-chair seat_icon"></i>

                              <!-- <i class="fas fa-desktop seat_icon"></i> -->
                          </span>
                          <span class="pc_no"><?php echo $i; ?></span>
                      </label>
                  <?php } $cnt=0; 
                }  ?>

   

                  </th>
                  
                </tr>
                </thead>
                <tbody>
               
                </tfoot>
              </table>
              <h3 class="font-weight-bold text-center my-3">Development PC</h3>
              <table id="example2" class="table table-hover">
                <thead>
                <tr>
                  <th>

                    <?php
                      $cnt = 0;
                      for ($i=1; $i<=TOTAL_PC_DEV;$i++)
                      { 
                          

                              if(isset($rec_dev['DEV-'.$i]))
                              {
                                    $cnt=1;

                                    if($i%10==1 && $i!=1)
                                    {
                                        //echo '<br>';
                                    }
                                    if($this->session->userdata('user_role')!=2 && $this->session->userdata('user_role')!=5){
                                      $link = site_url('admission/view_student/'.$rec_dev['DEV-'.$i]['regno']);
                                    }else{
                                      $link = "javascript:void(0)";
                                    }
                    ?>
                    
                      <label class="seat_manage" style="margin-bottom: 1.5rem;">
                          <a href="<?php echo $link; ?>" data-toggle="tooltip" data-placement="top" title="<?php echo $rec_dev['DEV-'.$i]['student_name'].' - '.$rec_dev['DEV-'.$i]['course'].' - '.$rec_dev['DEV-'.$i]['faculty'] ?>"></a>
                          <input type="checkbox" name="" class="chk_box" checked="">
                          <span class="cust_seat" >

                              <!-- <i class="fas fa-chair seat_icon"></i> -->

                              <i class="fas fa-desktop seat_icon"></i>
                          </span>
                          <span class="pc_no"><?php echo $i; ?></span>
                      </label>
                    <?php }  ?> 

                    <?php if($cnt!=1) { ?>
                       <label class="seat_manage">
                          <input type="checkbox" name="" class="chk_box" >
                          <span class="cust_seat" data-toggle="tooltip" data-placement="top" title="Not Assigned">

                              <i class="fas fa-chair seat_icon"></i>

                              <!-- <i class="fas fa-desktop seat_icon"></i> -->
                          </span>
                          <span class="pc_no"><?php echo $i; ?></span>
                      </label>
                  <?php } $cnt=0; 
                }  ?>

   

                  </th>
                  
                </tr>
                </thead>
                <tbody>
               
                </tfoot>
              </table>

              <h3 class="font-weight-bold text-center my-3">Laptop</h3>
              <table id="example2" class="table table-hover" style="margin-top: 15px">
                <thead>
                <tr>
                  <th>
                      <?php
                          $i=1;
                            foreach ($laptop_data as $lap_val)
                            {
                              if($this->session->userdata('user_role')!=2 && $this->session->userdata('user_role')!=5){
                                $link = site_url('admission/view_student/'.$lap_val['regno']);
                              }else{
                                $link = "javascript:void(0)";
                              }
                      ?>
                      <label class="seat_manage">
                          <a href="<?php echo $link; ?>" data-toggle="tooltip" data-placement="top" title="<?php echo $lap_val['student_name'].' - '.$lap_val['course'].' - '.$lap_val['faculty'] ?>"></a>
                          <input type="checkbox" name="" class="chk_box" checked="">
                          <span class="cust_seat" >

                              <!-- <i class="fas fa-chair seat_icon"></i> -->

                              <i class="fas fa-laptop seat_icon"></i>
                          </span>
                          <span class="pc_no"><?php echo $i++; ?></span>

                      </label>
                    
                      <?php } ?>

                  </th>
                  
                </tr>
                </thead>
                <tbody>
               
                </tfoot>
              </table>
              <table class="table table-hover">
                <tr>
                  <th colspan="5">PC Not Assigned/ Mis-Config</th>
                </tr>
                <tr>
                  <th>REG NO</th>
                  <th>PC NO</th>
                  <th>Student Name</th>
                  <th>Course</th>
                  <th>FACULTY</th>
                  <th></th>
                </tr>
                <?php 
                foreach($not_assigned as $not_a){
                 ?>
                 <tr>
                  <td><?php echo $not_a['regno'];?></td>
                  <td><?php echo $not_a['pcno'];?></td>
                  <td><?php echo $not_a['student_name'];?></td>
                  <td><?php echo $not_a['course'];?></td>
                  <td><?php echo $not_a['faculty'];?></td>
                  <td>
                    <?php 
                    if($arr['role']==1 || $arr['role']==3 ){
                    ?>
                      <a href="<?php echo site_url('admission/edit_form/'.$not_a['regno']);?>" class="btn btn-primary btn-xs m-1"><i class="fas fa-edit"></i></a>
                    <?php }else{?>
                      <a href="javascript:void(0);" class="btn btn-primary btn-xs m-1 update-student" data-regno="<?php echo $not_a['regno'];?>" ><i class="fas fa-edit"></i></a>
                    <?php }?>
                    
                    
                  </td>
                </tr>
                <?php }?>
              </table>
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
 
                 <style type="text/css">
                        .seat_manage
                        {
                          position: relative;
                        }
                        .seat_manage a
                        {
                          display: inline-block;
        
                          height: 70px;
                            width: 70px;
                            position: absolute;
                            z-index: 5;
                            left: 5px;
                            top: 5px;
                        }
                        .chk_box
                        {
                          opacity: 0;
                          margin: 40px;
                        }
                        .cust_seat
                        {
                            position: absolute;
                            left: 0;
                            top: 0;
                            height: 70px;
                            width: 70px;
                            background-color: #f1f1f1;
                            border-radius: 5px;
                            margin: 5px;
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
                          font-size: 25px;
                        }
                        .chk_box:checked + .cust_seat
                        {
                          background-color: #003366;
                        }
                        .chk_box:checked + .cust_seat>.seat_icon
                        {
                          color: #fff;
                        }

                        .pc_no
                        {
                          position: absolute;
                          top: -20px;
                          left: 42%;
                          transform: translateX(-50%);
                          text-align: center;
                          display: block;
                        }

                  </style>

<div class="modal fade " id="UpdateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Student</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" id="UpdateModalForm">
        <input type="hidden" name="regno" id="regno-1" value="">
        <div class="modal-body">
          <div id="update-msg-1"></div>
          <div class="row">
            <div class="form-group col-6">
              <label for="exampleInputEmail1" style="<?php if(form_error('course')){echo $red;}?>">Select Faculty</label>
              <select class="form-control select2" multiple name="faculty_id[]" id="faculty_id">
                <option value="0">Select Faculty</option>
                <?php 
                foreach ($view_faculty as $fac)
                {
                  ?>
                  <option value="<?php echo $fac['id'];?>"><?php echo $fac['name'];?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group col-6">
              <label >Running Topic</label>
              <input type="text" name="running_topic" class="form-control" id="running_topic" placeholder="Enter Running Topic">
            </div>
            <div class="form-group col-4">
              <select class="form-control select2" name="batch_time[]" multiple="" id="batch_time_2" data-placeholder="Batch Time">
                <option value="">Select Batch</option>
                <?php 
                foreach($course_batches as $batch){
                ?>
                <option value="<?php echo $batch['batch'];?>"><?php echo $batch['batch'];?></option>
                <?php }?>
              </select>
            </div>
            <div class="form-group col-4">
              <label for="exampleInputEmail1">PC/Laptop</label>
              <br>
              <input type="radio" name="sitting" style="margin-left: 10px" value="PC" >PC
               <input type="radio" name="sitting" style="margin-left: 10px" value="LAPTOP">LAPTOP
            </div>
            <div class="form-group col-4">
              <label >PC No.</label>
              <select name="pcno" class="form-control" id="pcno">
                <option value="0">PC NO-0</option>  
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
 <?php
  $this->load->view('footer');
 ?>
 <script type="text/javascript">
   $(function () {
    $('.select2').select2({
      theme: 'bootstrap4'
    })
    //$('[data-toggle="tooltip"]').tooltip()
    $('body').tooltip({selector: '[data-toggle="tooltip"]'});

    $(document).on('click','.update-student',function(){
        var regno = $(this).attr('data-regno');
        $.ajax({
        type:"POST",
        url:"<?php echo site_url('admission/get_ajax_student');?>",
        data:{regno:regno},
        beforeSend:function(){
          $('.process-loader').show();
        },
        complete:function(){
          $('.process-loader').hide();
        },
        dataType:"json",
        success:function(data){
          $('#regno-1').val(regno);
          //$('#faculty_id').val(data.faculty_id);
          var fac_arr = data.faculty_id.split(',')
          $('#faculty_id').select2().val(fac_arr).trigger("change")
          $('#batch_time_2').val(data.batches);  
          $('#batch_time_2').select2({
            theme: 'bootstrap4'
          });
          setTimeout(function(){
            $('#batch_time_2').trigger('change');  
          },300);
          

          $('#batch_end').val(data.batch_end);
          $('input[name="sitting"][value="'+ data.sitting +'"]').prop('checked', true);
          pcno = data.pcno;
          //$('#pcno').val(data.pcno);

          $('#running_topic').val(data.running_topic);
          $('#pcno').val(data.pcno);
          $('#stu-status').val(data.status);
          $('#note').val(data.status_note);
          
          $('#UpdateModal').modal('show');
        }
      });
       
    });
    $('#UpdateModalForm').submit(function(){
      var formData = $('#UpdateModalForm').serialize();
      $.ajax({
        type:"POST",
        url:"<?php echo site_url('admission/update_faculty_student');?>",
        data:formData,
        beforeSend:function(){
          $('.process-loader').show();
        },
        complete:function(){
          $('.process-loader').hide();
        },
        success:function(data){
          $('#update-msg-1').html(data);
        }
      });
      return false;
    });
    $('#batch_time_2').on('change', function (e) { 
      var formData = $('#UpdateModalForm').serialize();
      $.ajax({
        type:"POST",
        url:"<?php echo site_url('admission/get_ajax_seats');?>",
        data:formData,
        success:function(res){
          $('#pcno').html(res).after(function(){
            $('#pcno').val(pcno);
          });
        }
      });
    });
  })
 </script>