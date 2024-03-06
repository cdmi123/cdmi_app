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
            <h1>Add Salary</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Salary</li>
            </ol>
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
                <h3 class="card-title">Add Salary</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <select class="form-control" name="emp_id" id="faculty_id" tabindex="9">
                      <?php
                      foreach($faculty as $fac){
                      ?>
                      <option value="<?php echo $fac['id'];?>" <?php if($fac['id']==@$update_data['emp_id']) { echo "selected"; }?>><?php echo $fac['name'];?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Employee Full Name</label>
                    <input type="text"  name="emp_name" class="form-control" id="emp_name" placeholder="Employee Name" value="<?php echo @$update_data['emp_name']?>">
                    
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Amount</label>
                    <input type="number" id="amt" name="amount" class="form-control"  placeholder="Enter Salary Amount" value="<?php echo  @$update_data['total_salary']?>">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Payment Mode</label><br>
                    <select class="form-control" name="payment_mode" id="payment_mode">
                          <option value="">Select Payment Mode</option>
                          <option value="BANK-TRANSFER" <?php if(@$update_data['payment_mode']=='BANK-TRANSFER'){ echo "selected"; } ?>>Bank Transfer</option>
                          <option value="CASH" <?php if(@$update_data['payment_mode']=='CASH'){ echo "selected"; } ?>>Cash</option>
                        </select>
                  </div>



                   <div class="form-group">
                    <label for="exampleInputEmail1">Select Department</label><br>
                    <input type="radio" name="dept" class="" id="exampleInputEmail1" value="COLLEGE" <?php if(@$update_data['department']=='COLLEGE') { echo "checked"; }  ?>> College
                    <input type="radio" name="dept" class="" id="exampleInputEmail1" value="MULTIMEDIA"  <?php if(@$update_data['department']=='MULTIMEDIA') { echo "checked"; }  ?>> Multimedia
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Description</label>
                    <input type="text" name="description" class="form-control" id="exampleInputEmail1" placeholder="Description" value="<?php echo @$update_data['description']?>">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Tax</label>
                    <input type="text" name="tax" class="form-control" id="tax" placeholder="Description" value="<?php echo @$update_data['tax']?>">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Deduction</label>
                    <input type="text" name="deduction" class="form-control" id="deduction" placeholder="Description" value="<?php  echo @$update_data['deposit']?>">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Extra Deduction</label>
                    <input type="text" name="extra_deduction" class="form-control" id="extra_deduction" placeholder="Description" value="<?php echo @$update_data['extra_deduction']?>">
                  </div>


                   <div class="form-group">
                    <label for="exampleInputEmail1">Payable Amount</label>
                    <input readonly="" type="text" name="pay_amt" class="form-control" id="pay_amt" placeholder="Description" value="<?php echo @$update_data['payable_salary']?>">
                  </div>

                    <div class="form-group">
                    <label for="exampleInputEmail1">Month</label>
                    <input type="month" name="salary_month" class="form-control" id="exampleInputEmail1" placeholder="" value="<?php echo @$update_data['salary_month']?>">
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
<script type="text/javascript">
  $('#faculty_id').on('change', function (e) { 
    var faculty_id = $('#faculty_id').val();      
    $.ajax({
      type:"POST",
      url:"<?php echo site_url('Salary/get_faculty');?>",
      data:{faculty_id:faculty_id},
      dataType:"json",
      success:function(res){
        var ded = (res.salary/100)*10;
        $('#emp_name').val(res.fullname);
        $('#amt').val(res.salary);
        $("input[name='dept'][value='"+res.department+"']").prop('checked', true);
        $('#payment_mode').val(res.payment_mode);
        $('#tax').val(res.pro_tax);
        $('#deduction').val(ded);
        var payamt = res.salary-res.pro_tax-ded;
        $('#pay_amt').val(payamt);
      }
    });
  });
  $('#extra_deduction').keyup(function(e){
    var tax = $('#tax').val();
    var salary_amt = $('#amt').val();
    var ded = $('#deduction').val()
    var ext_ded = $('#extra_deduction').val()
    var pay_amt =  salary_amt-tax - ded - ext_ded;
    $('#pay_amt').val(pay_amt);
  });
</script>