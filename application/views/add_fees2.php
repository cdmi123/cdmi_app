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
            <h1>Add Course Fees</h1>
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
                <h3 class="card-title">Add Fees</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" enctype="multipart/form-data">
                <div class="card-body">
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
                    <label for="exampleInputEmail1">Installment No</label>
                    <input type="text" name="ins_no" readonly="" class="form-control" id="ins_no" placeholder="Installment Number" value="<?php echo @$up['installment_no']?>" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Fees Amount</label>
                    <input type="text" id="fees_amount" value="<?php echo @$up['amount'];?>" name="amount"  class="form-control" id="exampleInputEmail1" placeholder="Enter Fees Amount" >
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Payment Mode</label>
                      <select class="form-control" name="payment_mode">
                          <option value="CASH" <?php if(@$up['payment_mode']=="CASH"){echo "selected";} ?>>BY CASH</option>
                          <option value="UPI" <?php if(@$up['payment_mode']=="UPI"){echo "selected";} ?>>BY UPI</option>
                          <option value="CHEQUE" <?php if(@$up['payment_mode']=="CHEQUE"){echo "selected";} ?>>BY CHEQUE</option>
                          <option value="BANK-TRANSFER" <?php if(@$up['payment_mode']=="BANK-TRANSFER"){echo "selected";} ?>>BY BANK TRANSFER</option>
                      </select>
                  </div>
                  
                  <div class="form-group">
                       <label  for="exampleInputEmail1">Payment Detail</label>
                       <textarea class="form-control" name="payment_detail"><?php echo @$up['payment_detail']; ?></textarea>
                  </div>

                  <input type="hidden" id="pay_amt" name="payable_amount">
                  <input type="hidden" id="gst" name="NO">

                  <div class="form-group">
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
                  <div class="form-group">
                    <label for="exampleInputEmail1">Date</label>
                    <input type="date" name="date"  class="form-control" id="mydate" placeholder="Enter Course Name" value="<?php if(!empty(@$up['date'])){ echo date('Y-m-d',strtotime(@$up['date'])); } else { echo date("Y-m-d"); }?>">
                  </div>
                  <input type="hidden" name="net_amt" value="" id="net_amt">
                  <!-- <div class="form-group">
                    <label id="next_installment"></label>
                    on date
                    <label id="next_installment_date"></label>
                    <input type="hidden" name="next_amt" id="next_amt">
                    
                    
                  </div> -->
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
   $('.select2').select2({
      theme: 'bootstrap4'
    })
setTimeout(function(){
      if(reg_no!="" && action=="add"){
        $('#regno').trigger('blur');
       
      }
     },300)
     //$("#mydate").val(new Date());
    $('#regno').blur(function(e){
    var regno = $('#regno').val();
        $.ajax({
          type:"POST",
          url:"<?php echo site_url('fees/get_rec');?>",
          data:{regno:regno},
          dataType:"json",
          success:function(data){
              $('#sname').val(data.student_name);
              $('#course').val(data.course);  
              $('#ins_no').val(data.count);
              $('#fees_amount').val(data.payable_amount)
              //$('#net_amt').val(data.payable_amount)
              //$('#pay_amt').val(data.payable_amount)
              // $('#next_installment').text(data.next_amount)
              // $('#next_amt').val(data.next_amount)
              // $('#next_installment_date').text(data.next_date)
              //$('#gst').trigger('change');
          }
        });
    });
     // $('#fees_amount').keyup(function(e){
     //    var payable_amount = $('#pay_amt').val();
     //    var total_amt = $(this).val();
     //    var next_amt = $('#next_amt').val()
     //    //if($(this).val()<=payable_amount)
     //    //{
     //      var fee_amt =  payable_amount - total_amt;
     //      $('#next_installment').text(parseInt(next_amt)+parseInt( fee_amt));
     //    //}
     // });

    $('#gst').change(function(e){
      var amount = $('#fees_amount').val()
      if($(this).val() == "YES-IN"){
        var gst_amount = (amount-(amount*(100/(100+18)))).toFixed(2);
        var net_amount = amount-gst_amount
        $('#tax_amount').val(gst_amount)
        $('#net_amt').val(net_amount)
      }else if($(this).val() == "YES-EX"){
        var gst_amount = ((amount*18)/100).toFixed(2);
        var net_amount = +parseInt(amount)+parseInt( gst_amount)
        $('#tax_amount').val(gst_amount)
        $('#net_amt').val(net_amount)
      }
    });
    $('#fees_amount').keyup(function(e){
      var amount = $('#fees_amount').val()
      if($('#gst').val() == "YES-IN"){
        var gst_amount = (amount-(amount*(100/(100+18)))).toFixed(2);
        var net_amount = amount-gst_amount
        $('#tax_amount').val(gst_amount)
        $('#net_amt').val(net_amount)
      }else if($('#gst').val() == "YES-EX"){
        var gst_amount = ((amount*18)/100).toFixed(2);
        var net_amount = +parseInt(amount)+parseInt( gst_amount)
        $('#tax_amount').val(gst_amount)
        $('#net_amt').val(net_amount)
      }
    });
});



</script>