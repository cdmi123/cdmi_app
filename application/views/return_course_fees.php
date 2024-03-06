<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('header');
if(isset($up['reg_no'])){
  $r_no = $up['reg_no'];
}else if(isset($reg_no)){
  $r_no = $reg_no;
}
 ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Return Course Fees</h1>
          </div>
          <div class="col-sm-6">
            <div class="row">
              <div class="col-8">
              </div>
              <div class="col-4">
                <a href="<?php echo site_url('admission/view_admission')?>" class="btn btn-primary btn-block my-1"><i class="fas fa-list"></i> View Admission</a>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Return Fees</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label id="total_paid" style="width:50%">Total Paid Fees : <?php echo $total_paid;?></label>
                    <label id="allowance_paid">Allowance Paid : <?php echo $allowance_paid; ?></label>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Rec No </label>
                    <input type="text" readonly="" name="recno" class="form-control" id="exampleInputEmail1" value="<?php if(@$up['rec_no']){ echo $up['rec_no']; } else { echo $rec_no+1; } ?>" placeholder="Enter Course Name" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Student Registration No</label>
                    <input type="text" name="regno" value="<?php echo @$r_no;?>" class="form-control" id="regno" placeholder="Enter Registration Number" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Student Name</label>
                    <input type="text" name="student_name" readonly="" value="<?php echo @$up['student_name']?>" class="form-control" id="sname" placeholder="Student Name" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Course</label>
                    <input type="text" name="course" readonly="" class="form-control" id="course" value="<?php echo @$up['course'];?>" placeholder="Course Name" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Return Amount</label>
                    <input type="text" id="amount" value="<?php echo @$up['amount'];?>" name="amount"  class="form-control" id="exampleInputEmail1" placeholder="Enter Fees Amount" >
                  </div>
                  <div class="form-group">
                    <label  for="exampleInputEmail1">Payment Detail</label>
                    <textarea class="form-control" name="payment_detail"><?php echo @$up['details']; ?></textarea>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Date</label>
                    <input type="date" name="date"  class="form-control" id="mydate" placeholder="Enter Course Name" value="<?php if(!empty(@$up['date'])){ echo date('Y-m-d',strtotime(@$up['date'])); } else { echo date("Y-m-d"); }?>">
                  </div>
                
                <!-- /.card-body -->

                <div class="card-footer">
                  <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                </div>
              </form>
            </div>
          
          </div>
        
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

 <?php
      $this->load->view('footer');

 ?>
<script src="<?php echo base_url('assets/jquery-ui.js')?>"></script>
<script>
var reg_no = '<?php echo @$r_no;?>';
var action = '<?php echo @$action;?>';
$(document).ready(function(e) {
  setTimeout(function(){
    if(reg_no!="" && action=="add"){
      $('#regno').trigger('blur');
    }
  },300);
     //$("#mydate").val(new Date());
  $('#regno').blur(function(e){
    var regno = $('#regno').val();
    $.ajax({
      type:"POST",
      url:"<?php echo site_url('fees/ajax_get_student_details');?>",
      data:{regno:regno},
      dataType:"json",
      success:function(data){
        $('#sname').val(data.student_name);
        $('#course').val(data.course);  
        $('#total_paid').text("Total Paid Fees : "+data.total_paid);  
      }
    });
  });
});



</script>