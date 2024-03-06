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
          <div class="col-sm-6">
            <h1>Absent Report</h1>
          </div>
          <div class="col-sm-6">
            <div class="row">
              <div class="col-7">
              </div>
              <div class="col-5">
                <a href="<?php echo site_url('Batch_attendence/Add_Leave_Reason')?>" class="btn btn-primary  my-1"><i class="fas fa-edit"></i> Add Leave Reason</a>
              </div>
            </div>
          </div>
        </div>
        
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
          <form method="post" id="search_form">
            <div class="card-header">
              <div class="row">
                 <div class="col-3">
                  <select class="form-control filter select2" name="created_by" id="month">
                    <option value="" disabled selected>By Student</option>
                        <option value="Batch_attendence">Regular Student</option>
                        <option value="Collage_attendence">Collage Student</option>
                  </select>
                </div>
              </form>
            </div>
            <!-- /.card-header -->
            <div class="card-body" id="Absent_student_list">
              <table id="example2" class="table table-bordered table-hover table-font">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>REG NO</th>
                    <th style="width: auto;">
                    STUDENT NAME
                  </th>
                    <th>
                    BATCH TIME
                      <div style="border-top: solid 1px black;margin-top: 5px"></div>
                    FACULTY NAME
                  </th>
                    <th>CONTACT NO</th>
                    <th>LEAVE STATUS</th>
                  </tr>
                </thead>
                <tbody id="example3">
                <?php 
                $id=1;
                foreach ($student as $key => $value) {

                
                    foreach ($value as $key => $info) { ?>

                <tr>
                  <td><?php echo $id;?></td>
                  <td><?php echo $info['regno']?></td>
                  <td><?php echo $info['student_name']?></td>
                  <td><?php echo $info['batch_time']?><div style="border-top: solid 1px black;margin-top: 5px"></div><?php echo $info['faculty_name']?></td>
                  <td><h6><?php echo $info['contact']?> / <?php echo $info['father_contact']?></h6></td>
                  <td>
                    <a href="javascript:void(0);" class="btn btn-primary btn-sm m-1 update-status" data-name="<?php echo $info['student_name'];  ?>" data-regno="<?php echo $info['regno']; ?>"><i class="fas fa-edit"></i></a>
                  </td>

                </tr>
                <?php
                }
               $id++;
                }
                ?>
                </tfoot>
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
   <!--  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
           <div class="col-sm-12">
                <div class="card-footer small text-muted pagination-holder">
                  <?php echo @$pagination; ?>
                </div>
          </div>
        </div>
      </div>/.container-fluid -->
    <!-- </section> -->
  </div>

 <?php
  $this->load->view('footer');
 ?>

<!-- student leave model -->

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

<!-- End studnet leave model -->


<div class="modal fade " id="CollageStudentLeaveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Leave Report</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" id="CollageLeaveReportForm">
        
        <div class="modal-body">
          <div id="update-msg-leave"></div>
          <div class="row">
            <div class="form-group col-6">
              <label>Reg No</label>
              <input type="text" name="regno" id="cregno" class="form-control" readonly value="">
            </div>
            <div class="form-group col-6">
              <label>Class</label>
              <input type="text" name="class_name" id="cclass" value="" class="form-control"  readonly>
            </div>
            <div class="form-group col-12">
              <label>Name</label>
              <input type="text" name="name" id="cname" value="" class="form-control"  disabled>
            </div>
            
            <div class="form-group col-12">
              <label>Enter Remark</label>
              <textarea class="form-control" name="note" id="remark" placeholder="Enter Remark"></textarea>
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

/* Regular student */

 $(document).ready(function(){
  $('body').tooltip({selector: '[data-toggle="tooltip"]'});
    $(document).on('click','.update-status',function(){
      var regno = $(this).attr('data-regno');
      var note = $(this).attr('data-note');
      var name = $(this).attr('data-name');
      //$('#note').val(note);
      $('#regno').val(regno);
      $('#name').val(name);
      $('#StudentLeaveModal').modal('show');
    })

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
             window.location.reload();
          }
          else
          {
            $('#update-msg-leave').html(data);
          }
        }
      });
      return false;
    })
 });

 /* End regular studnt*/

 /* Collage Studnet List */

 $(document).ready(function(){
  $('body').tooltip({selector: '[data-toggle="tooltip"]'});
    $(document).on('click','.update-collage-status',function(){
      var regno = $(this).attr('data-regno');
      var note = $(this).attr('data-note');
      var name = $(this).attr('data-name');
      var class_name = $(this).attr('data-classname');
      //$('#note').val(note);
      $('#cregno').val(regno);
      $('#cname').val(name);
      $('#cclass').val(class_name);
      $('#CollageStudentLeaveModal').modal('show');
    })

    $('#CollageLeaveReportForm').submit(function(){
      var formData = $('#CollageLeaveReportForm').serialize();
      $.ajax({
        type:"POST",
        url:"<?php echo site_url('College_attendence/update_status');?>",
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
            $('#CollageStudentLeaveModal').modal('hide');
             window.location.reload();
          }
          else
          {
            $('#update-msg-leave').html(data);
          }
        }
      });
      return false;
    })
 });

 /* End Collage Studnet List */



$(document).ready(function(){

  $('#month').change(function(){

    var search_name = $(this).val();

    if (search_name == "Collage_attendence") {

      $.ajax({
          type:"POST",
          url:"<?php echo site_url('College_attendence/today_absent_ajax');?>",
          success:function(data){
            $('#Absent_student_list').html(data);
          }
      });
    }
    else
    {
        $.ajax({
          type:"POST",
          url:"<?php echo site_url('Batch_attendence/today_absent_ajax');?>",
          success:function(data){
            $('#Absent_student_list').html(data);
          }
      });
    }
  })
})

</script>


