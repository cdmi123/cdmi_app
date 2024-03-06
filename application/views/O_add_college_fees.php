<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('header');
if(isset($up['reg_no'])){
  $r_no = $up['reg_no'];
}else if(isset($reg_no)){
  $r_no = $reg_no;
}
if(isset($up)){
  $create_by = $up['create_by'];  
}else{
  $create_by = $this->session->userdata('user_login');
}
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add College Fees</h1>
          </div>
          <div class="col-sm-6">
            <div class="row">
              <div class="col-8">
              </div>
              <div class="col-4">
                <a href="<?php echo site_url('College_fees/view_college_fees')?>" class="btn btn-primary btn-block my-1"><i class="fas fa-list"></i> Fees List</a>
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
                <h3 class="card-title">Add College Fees</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">
                    <div class="col-6 form-group">
                      <label for="exampleInputEmail1">Rec No </label>
                      <input type="text" readonly="" name="recno" class="form-control" id="recno" value="<?php if(@$up['rec_no']){ echo $up['rec_no']; } else { echo $rec_no+1; } ?>" placeholder="Enter Course Name" >
                    </div>

                    <div class="col-6 form-group">
                      <label for="exampleInputEmail1">Student Registration No</label>
                      <input type="text" name="regno" value="<?php echo @$r_no;?>" class="form-control" id="regno" placeholder="Enter Registration Number" >
                    </div>

                    <div class="col-12 form-group">
                      <label for="exampleInputEmail1">Student Name</label>
                      <input type="text" name="student_name" readonly="" value="<?php echo @$up['student_name']?>" class="form-control" id="sname" placeholder="Student Name" >
                    </div>

                    <div class="col-6 form-group">
                      <label for="exampleInputEmail1">Course</label>
                      <input type="text" name="course" readonly="" class="form-control" id="course" value="<?php echo @$up['course'];?>" placeholder="Course Name" >
                    </div>

                    <div class="col-6 form-group">
                      <label for="exampleInputEmail1">Installment No</label>
                      <input type="text" name="ins_no" readonly="" class="form-control" id="ins_no" placeholder="Installment Number" value="<?php echo @$up['installment_no']?>" >
                    </div>

                    <div class="col-6 form-group">
                      <label for="exampleInputEmail1">Fees Type</label>
                      <select class="form-control" name="fees_type" id="fees_type" <?php if($action=="update"){echo 'disabled';} ?>>
                          <option value="regular" <?php if(@$up['fees_type']=="regular"){echo 'selected';}?> >Regular Tution Fees</option>
                          <option value="exam" <?php if(@$up['fees_type']=="exam"){echo 'selected';}?>>Exam Fees</option>
                          <option value="certificate" <?php if(@$up['fees_type']=="certificate"){echo 'selected';}?>>Certificate Fees</option>
                      </select>
                    </div>                    

                    <div class="col-6 form-group" >
                      <label for="exampleInputEmail1">Extra Detail*</label>
                      <textarea class="form-control" name="extra_detail" placeholder="Enter Extra Detail" id="other"><?php echo @$up['extra_detail'];?></textarea>
                    </div>

                    <div class="col-6 form-group">
                      <label for="exampleInputEmail1">Payment Mode</label>
                      <select class="form-control" name="pay_mode" id="pay_mode">
                          <option value="CASH" <?php if(@$up['pay_mode']=="CASH"){echo 'selected';}?>>BY CASH</option>
                          <option value="UPI" <?php if(@$up['pay_mode']=="UPI"){echo 'selected';}?>>BY UPI</option>
                          <option value="BANK-TRANSFER" <?php if(@$up['pay_mode']=="BANK-TRANSFER"){echo 'selected';}?>>BY BANK TRANSFER</option>
                          <option value="CHEQUE" <?php if(@$up['pay_mode']=="CHEQUE"){echo 'selected';}?>>BY CHEQUE</option>
                      </select>
                    </div>                    

                    <div class="col-6 form-group" >
                      <label for="exampleInputEmail1">Payment Details</label>
                      <textarea class="form-control" name="payment_detail" placeholder="Enter Payment Detail" id="payment_detail"><?php echo @$up['payment_detail'];?></textarea>
                    </div>

                    <div class="col-6 form-group">
                      <label for="exampleInputEmail1">Fees Amount</label>
                      <input type="text" value="<?php echo @$up['amount'];?>" name="amount"  class="form-control" id="exampleInputEmail1" placeholder="Enter Fees Amount" >
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">GST</label>
                      <select class="form-control" name="gst">
                          <option value="NO" <?php if(@$up['gst']=="NO"){echo "selected";} ?>>Without GST</option>
                          <option value="YES" <?php if(@$up['gst']=="YES"){echo "selected";} ?>>With GST</option>
                      </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tax Amount</label>
                    <input type="text" value="<?php echo @$up['tax_amount'];?>" name="tax_amount"  class="form-control" id="tax_amount" placeholder="Enter Tax Amount" >
                  </div>     
                  <div class="form-group">
                    <label  for="exampleInputEmail1">Payment Account</label>
                    <select class="form-control" name="ac_id">
                      <option value="0">NO ACCOUNT</option>
                      <?php 
                      foreach($accounts as $account){
                      ?>
                      <option value="<?php echo $account['ac_id']; ?>" <?php if(@$up['ac_id']==$account['ac_id']){echo 'selected';}?>><?php echo $account['ac_name']; ?></option>
                      <?php }?>
                    </select>
                  </div>               
                    <div class="col-6 form-group">
                      <label for="exampleInputEmail1">Created By</label>
                      <select class="form-control select2" name="create_by" id="create_by" tabindex="9">
                          <option value="">Select Faculty</option>
                          <?php
                          foreach($faculties as $faculty){
                          ?>
                          <option value="<?php echo $faculty['id'];?>" <?php if(@$create_by==$faculty['id']){echo 'selected';}?>><?php echo $faculty['name'];?></option>
                          <?php
                          }
                          ?>
                      </select>
                    </div>
                    <div class="col-6 form-group">
                      <label for="exampleInputEmail1">Date</label>
                      <input type="date" name="date"  class="form-control" id="mydate" placeholder="Enter Course Name" value="<?php if(!empty($up['date'])){ echo date('Y-m-d',strtotime($up['date'])); } else { echo date("Y-m-d"); }?>">
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
  $('.select2').select2({
    theme: 'bootstrap4'
  })
     setTimeout(function(){
      if(reg_no!="" && action=="add"){
        $('#regno').trigger('blur');
      }
     },300)
    
    $('#regno').blur(function(e){
      var regno = $('#regno').val();
      var fees_type = $('#fees_type').val();
      $.ajax({
        type:"POST",
        url:"<?php echo site_url('College_fees/get_rec');?>",
        data:{regno:regno,fees_type:fees_type},
        dataType:"json",
        success:function(data){
            $('#sname').val(data.student_name);
            var course_name = data.college_course;
            if(data.course_stream != ""){
              course_name+= " "+data.course_stream;
            }
            $('#course').val(course_name);  
            $('#ins_no').val(data.count);
            if(action!="update"){
                $('#recno').val(data.rec_no);
            }
            
        }
      });
    });
    $('#fees_type').change(function(){
      var regno = $('#regno').val();
      var fees_type = $('#fees_type').val();
      $.ajax({
        type:"POST",
        url:"<?php echo site_url('College_fees/get_rec');?>",
        data:{regno:regno,fees_type:fees_type},
        dataType:"json",
        success:function(data){
            $('#sname').val(data.student_name);
            var course_name = data.college_course;
            if(data.course_stream != ""){
              course_name+= " "+data.course_stream;
            }
            $('#course').val(course_name); 
            $('#ins_no').val(data.count);
            if(action!="update"){
                $('#recno').val(data.rec_no);
            }
            
        }
      });
    });
});
</script>