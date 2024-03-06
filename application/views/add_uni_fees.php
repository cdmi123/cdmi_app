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
            <h1>University Fees</h1>
          </div>
          <div class="col-sm-6">
            
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-8 offset-2">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add University Fees</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">
                    <div class="col-6 form-group">
                      <label for="exampleInputEmail1">Student Registration No</label>
                      <input type="text" name="regno" value="<?php echo @$r_no;?>" class="form-control" id="regno" placeholder="Enter Registration Number" >
                    </div>

                    <div class="col-12 form-group">
                      <label for="exampleInputEmail1">Student Name</label>
                      <input type="text" name="student_name" readonly="" value="" class="form-control" id="sname" placeholder="Student Name" >
                    </div>

                    <div class="col-6 form-group">
                      <label for="exampleInputEmail1">Course</label>
                      <input type="text" name="course" readonly="" class="form-control" id="course" value="" placeholder="Course Name" >
                    </div>

                    <div class="col-6 form-group">
                      <label for="exampleInputEmail1">Installment No</label>
                      <input type="text" name="ins_no" readonly="" class="form-control" id="ins_no" placeholder="Installment Number" value="" >
                    </div>

                    <div class="col-6 form-group">
                      <label for="exampleInputEmail1">Fees Type</label>
                      <select class="form-control" name="fees_type" id="fees_type">
                          <option value="regular">College Fees</option>
                          <option value="exam">Exam Fees</option>
                          <option value="certificate">Certificate Fees</option>
                      </select>
                    </div>                    

                    <div class="col-6 form-group" >
                      <label for="exampleInputEmail1">Extra Detail*</label>
                      <textarea class="form-control" name="extra_detail" placeholder="Enter Extra Detail" id="other"></textarea>
                    </div>

                    <div class="col-6 form-group">
                      <label for="exampleInputEmail1">Fees Amount</label>
                      <input type="text" value="" name="amount"  class="form-control" id="exampleInputEmail1" placeholder="Enter Fees Amount" >
                    </div>                    

                    <div class="col-6 form-group">
                      <label for="exampleInputEmail1">Date</label>
                      <input type="date" name="date"  class="form-control" id="mydate" placeholder="Enter Course Name" value="<?php echo date('Y-m-d')?>">
                    </div>
                <!-- /.card-body -->
                </div>

                <div class="text-center">
                  <input type="submit" class="btn btn-primary px-5" name="submit" value="Save">
                  <input type="reset" class="btn btn-default px-5 ml-2" name="">
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
      $('#regno').trigger('keyup');
    }
  },300)
     //$("#mydate").val(new Date());
    $('#regno').keyup(function(e){
      var regno = $('#regno').val();
      var fees_type = $('#fees_type').val();
      $.ajax({
        type:"POST",
        url:"<?php echo site_url('Admin/get_uni_fees_count');?>",
        data:{regno:regno,fees_type:fees_type},
        dataType:"json",
        success:function(data){
            $('#sname').val(data.student_name);
            var course_name = data.college_course;
            if(data.course_stream != ""){
              course_name+= " - "+data.course_stream;
            }
            $('#course').val(course_name);
            $('#ins_no').val(data.count);
        }
      });
    });

    $('#fees_type').change(function(){
      
      var regno = $('#regno').val();
      var fees_type = $('#fees_type').val();
      $.ajax({
        type:"POST",
        url:"<?php echo site_url('Admin/get_uni_fees_count');?>",
        data:{regno:regno,fees_type:fees_type},
        dataType:"json",
        success:function(data){
            $('#sname').val(data.student_name);
            $('#course').val(data.college_course);  
            $('#ins_no').val(data.count);
        }
      });
    });
});
</script>