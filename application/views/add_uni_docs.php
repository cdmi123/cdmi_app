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
            <h1>Student Uni. Documents</h1>
          </div>
          <div class="col-sm-6">
            <div class="row">
              <div class="col-8">
              </div>
              <div class="col-4">
                <a href="<?php echo site_url('College_fees/view_college_fees')?>" class="btn btn-primary btn-block my-1"><i class="fas fa-list"></i> Documents List</a>
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
          <div class="col-md-8 offset-2">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update Student Docs.</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">
                    <div class="col-6 form-group">
                      <label for="exampleInputEmail1">Student Reg. No</label>
                      <input type="text" name="regno" value="<?php echo @$regno;?>" class="form-control" id="regno" placeholder="Enter Registration Number" >
                    </div>

                    <div class="col-6 form-group">
                      <label for="exampleInputEmail1">Student Name</label>
                      <input type="text" name="student_name" readonly="" value="<?php echo @$up['student_name']?>" class="form-control" id="sname" placeholder="Student Name" >
                    </div>

                    <div class="col-4 form-group">
                      <label for="exampleInputEmail1">Course</label>
                      <input type="text" name="course" readonly="" class="form-control" id="course" value="<?php echo @$up['course'];?>" placeholder="Course Name" >
                    </div>

                    <div class="col-4 form-group">
                      <label for="exampleInputEmail1">Year/Semester</label>
                      <select class="form-control" name="mode" id="mode">
                        <option value="Y">Yearly</option>
                        <option value="S">Semester Wise</option>
                      </select>
                    </div>
                    <div class="col-4 form-group">
                      <label for="exampleInputEmail1">Marksheets</label>
                      <input type="text" name="marksheets" class="form-control" id="marksheets" value="" placeholder="Enter Marksheets..." >
                    </div>
                    <div class="col-4 form-group">
                      <label for="exampleInputEmail1">Provisional</label>
                      <select class="form-control" name="provisional" id="provisional">
                        <option value="">No</option>
                        <option value="Y">Yes</option>
                        <option value="A">Applied</option>
                        <option value="NA">NA</option>
                      </select>
                    </div>
                    <div class="col-4 form-group">
                      <label for="exampleInputEmail1">Degree/Diploma Cert.</label>
                      <select class="form-control" name="degree" id="degree">
                        <option value="">No</option>
                        <option value="Y">Yes</option>
                        <option value="A">Applied</option>
                        <option value="NA">NA</option>
                      </select>
                    </div>
                    <div class="col-4 form-group">
                      <label for="exampleInputEmail1">Migration</label>
                      <select class="form-control" name="migration" id="migration">
                        <option value="">No</option>
                        <option value="Y">Yes</option>
                        <option value="A">Applied</option>
                        <option value="NA">NA</option>
                      </select>
                    </div>
                    <div class="col-4 form-group">
                      <label for="exampleInputEmail1">Transfer Certificate</label>
                      <select class="form-control" name="transfer" id="transfer">
                        <option value="">No</option>
                        <option value="Y">Yes</option>
                        <option value="A">Applied</option>
                        <option value="NA">NA</option>
                      </select>
                    </div>
                    <div class="col-4 form-group">
                      <label for="exampleInputEmail1">Transcript</label>
                      <select class="form-control" name="transcript" id="transcript">
                        <option value="">No</option>
                        <option value="Y">Yes</option>
                        <option value="A">Applied</option>
                        <option value="NA">NA</option>
                      </select>
                    </div>
                    <div class="col-4 form-group">
                      <label for="exampleInputEmail1">MOI</label>
                      <select class="form-control" name="moi" id="moi">
                        <option value="">No</option>
                        <option value="Y">Yes</option>
                        <option value="A">Applied</option>
                        <option value="NA">NA</option>
                      </select>
                    </div>
                    <div class="col-4 form-group">
                      <label for="exampleInputEmail1">LOR</label>
                      <select class="form-control" name="lor" id="lor">
                        <option value="">No</option>
                        <option value="Y">Yes</option>
                        <option value="A">Applied</option>
                        <option value="NA">NA</option>
                      </select>
                    </div>
                    <div class="col-4 form-group">
                      <label for="exampleInputEmail1">Extra Info.</label>
                      <textarea class="form-control" name="extra_info" placeholder="Enter Extra Info.." id="extra_info"></textarea> 
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
var regno = '<?php echo @$regno;?>';


$(document).ready(function(e) {
     setTimeout(function(){
      if(regno!=""){
        $('#regno').trigger('blur');
      }
     },300)
    
    $('#regno').blur(function(e){
      var regno = $('#regno').val();
      $.ajax({
        type:"POST",
        url:"<?php echo site_url('College_admission/get_student_info');?>",
        data:{regno:regno},
        dataType:"json",
        success:function(data){
            $('#sname').val(data.student_name);
            var course_name = data.college_course;
            if(data.course_stream != ""){
              course_name+= " "+data.course_stream;
            }
            $('#course').val(course_name);  
            $('#mode').val(data.mode);  
            $('#marksheets').val(data.marksheets);  
            $('#provisional').val(data.provisional);  
            $('#transfer').val(data.transfer);  
            $('#migration').val(data.migration);  
            $('#degree').val(data.degree);  
            $('#transcript').val(data.transcript);  
            $('#moi').val(data.moi);  
            $('#lor').val(data.lor);  
            $('#extra_info').val(data.extra_info);  
            
        }
      });
    });
    
});
</script>