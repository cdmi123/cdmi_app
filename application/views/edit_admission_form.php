<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('header');
$red = "color:red";
$black = "color:black";
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <div class="row">
                  <div class="col-sm-6 head-center">
                    <h3 class="card-title">Update Course Admission</h3>
                  </div>

                  <div class="col-sm-6">
                    <a href="<?php echo site_url('admission/view_admission')?>" class="btn btn-light text-dark font-weight-bold float-right"><i class="fas fa-list"></i> &nbsp;Admission List</a>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" id="admission-form" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">
                   <div class="form-group col-12">
                      <label  class="danger">Registration No (<?php echo $update_data['student_name'];?>)</label>
                      <div class="input-group">
                        <input type="text" name="regno"  class="form-control" id="txtname" placeholder="Enter Registration Number" readonly value="<?php echo @$update_data['regno']; ?>">
                        <div class="input-group-append " id="edit">
                          <span class="input-group-text"><i class="fas fa-edit"></i></span>
                        </div>
                      </div>
                  </div>
                  <style type="text/css">
                  #all_data li
                  {
                    margin-left: 5px;
                  }

                </style>
                <ul class="nav nav-tabs nav-justify col-12" id="all_data">
                  <li class="nav-item ml-0"><a class="nav-link active" data-toggle="tab" href="#personal">Student Information</a></li>
                  <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#educational">Course Information</a></li>
                  <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#faculty">Faculty Information</a></li>
                </ul>
                <div class="tab-content">
                <div id="personal" class="tab-pane fade active show">
                    <div class="row">
                    <div class="col-12">
                        <h4 class="font-weight-bold my-2">Personal Information</h4>
                        <hr class="my-2 pb-3">
                    </div>
                    <div class="form-group col-4">
                      <label >Surname Name*</label>
                      <input type="text" name="fname" class="form-control"  placeholder="Enter SurName" value="<?php echo @$update_data['surname']; ?>">
                    </div>
                    <div class="form-group col-4">
                      <label >Student Name*</label>
                      <input type="text" name="mname" class="form-control"  placeholder="Enter Student Name" value="<?php echo @$update_data['first_name']; ?>">
                    </div>
                    <div class="form-group col-4">
                      <label >Father Name*</label>
                      <input type="text" name="lname" class="form-control"  placeholder="Enter Father Name" value="<?php echo @$update_data['last_name']; ?>">
                    </div>
                    <div class="form-group col-3">
                      <label >Student Contact No.*</label>
                      <input type="text" name="contact" class="form-control"  placeholder="Enter Mobile No." value="<?php echo @$update_data['contact'];?>">
                    </div>
                    <div class="form-group col-3">
                      <label >Student Whatsapp No.*</label>
                      <input type="text" name="whatsapp_no" class="form-control"  placeholder="Enter Whatsapp No" value="<?php echo @$update_data['whatsapp_no'];?>">
                    </div>
                    <div class="form-group col-3">
                      <label   style="<?php if(form_error('father_contact')){echo $red;}?>">Parent Contact No.*</label>
                      <input type="text" name="father_contact" class="form-control"  placeholder="Enter Parent Mobile No." value="<?php echo @$update_data['father_contact']?>">
                    </div>
                    <div class="form-group col-3">
                      <label>Parent Whatsapp No.</label>
                      <input type="text" name="parent_whatsapp_no" class="form-control" placeholder="Enter Parent Whatsapp No." value="<?php echo @$update_data['parent_whatsapp_no']?>">
                    </div>
                    <div class="form-group col-4">
                      <label for="address">Address*</label>
                      <textarea name="address" class="form-control" id="address" placeholder="Enter Address" style="resize: none;"><?php echo $update_data['address']; ?></textarea>
                    </div>
                    <div class="form-group col-3">
                      <label for="birth_date">Birth Date*</label>
                      <input type="date" name="birth_date" class="form-control" id="birth_date" placeholder="Enter Name" value="<?php echo $update_data['birth_date']; ?>">
                    </div>
                    
                    <div class="form-group col-5">
                      <label for="">Image</label>
                      <div class="d-flex">                       
                        <div class="input-group w-75">
                          <div class="custom-file">
                            <input type="file" name="image" class="custom-file-input" id="imgInp">
                            <label class="custom-file-label" for="imgInp">Choose file</label>
                          </div>
                          <div class="input-group-append d-inline-block">
                            <span class="input-group-text" id="">Upload</span>
                          </div>                        
                        </div>
                        <div class="ml-3 clearfix">
                          <?php 
                          if($update_data['image']!='')
                          {
                            $img = base_url('upload/student_photo/'.$update_data['image']);
                          }else{
                            $img = base_url('assets/users.jpg');
                          }
                           ?>
                          <img src="<?php echo $img;?>" width="50" id="img_preview">
                        </div>
                      </div>
                    </div>
                    
                    <div class="form-group col-4">
                      <label  >Qualification*</label>
                      <input type="text" name="qualification" class="form-control"  placeholder="Enter Qualification" value="<?php echo @$update_data['qualification']; ?>">
                    </div>
                    <div class="form-group col-4">
                      <label  style="<?php if(form_error('reference')){echo $red;}?>">Select Reference*</label>
                      <select class="form-control" id="reference" name="reference">
                         <option value="">Select Reference</option>
                            <option value="INTERNET" <?php if($update_data['reference'] == 'INTERNET') { echo "selected"; } ?> >Internet</option>
                            <option value="STUDENT" <?php if($update_data['reference'] == 'STUDENT') { echo "selected"; } ?>>Student</option>  
                            <option value="SEMINAR" <?php if($update_data['reference'] == 'SEMINAR') { echo "selected"; } ?>>Seminar</option> 
                            <option value="STAFF" <?php if($update_data['reference'] == 'STAFF') { echo "selected"; } ?>>Staff</option>  
                            <option value="OTHER" <?php if($update_data['reference'] == 'OTHER') { echo "selected"; } ?>>Other</option>  
                      </select>
                    </div>
                  <div class="form-group col-4">
                    <label >Reference Name*</label>
                    <input type="text" name="reference_name"  class="form-control" id="other" placeholder="Enter Reference Name" value="<?php  echo @$update_data['reference_name']?>" >
                  </div>
                </div>
              </div>
              <div id="educational" class="tab-pane fade">
                <div class="row">
                  <div class="col-12">
                      <h4 class="font-weight-bold my-2">Course Details</h4>
                      <hr class="my-2 pb-3">
                  </div>
                  <div class="form-group col-4">
                    <label  style="<?php if(form_error('course')){echo $red;}?>">Course*</label>
                    <select class="form-control" name="course" id="course">
                        <option value="">Select course</option>
                        <?php 
                            foreach ($course as $data)
                            {
                        ?>
                          <option value="<?php echo $data['course_name']?>" <?php if($data['course_name'] == $update_data['course']) { echo 'selected';} ?>><?php echo $data['course_name']?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group col-4">
                    <label  style="<?php if(form_error('sub_course')){echo $red;}?>">Sub Course</label>
                    <select class="form-control" name="sub_course" id="sub_course">
                        <option value="">Select Sub Course</option>
                        <?php 
                            foreach ($course as $data)
                            {
                        ?>
                          <option value="<?php echo $data['course_name']?>" <?php if($data['course_name'] == $update_data['sub_course']) { echo 'selected';} ?>><?php echo $data['course_name']?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group col-2">
                    <label for="">Course Duration*</label>
                    <input type="text" name="course_duration"  id="course_duration" class="form-control" placeholder=""  value="<?php echo $update_data['course_duration']; ?>">
                  </div>
                  <div class="form-group col-2">
                    <label for="">Daily Time*</label>
                    <select class="form-control" name="daily_time" id="daily_time">
                      <option value="1" <?php if($update_data['daily_time'] == "1") { echo "selected"; } ?>>1</option>
                      <option value="2" <?php if($update_data['daily_time'] == "2") { echo "selected"; } ?>>2</option>
                      <option value="3" <?php if($update_data['daily_time'] == "3") { echo "selected"; } ?>>3</option>
                      <option value="4" <?php if($update_data['daily_time'] == "4") { echo "selected"; } ?>>4</option>
                      <option value="6" <?php if($update_data['daily_time'] == "6") { echo "selected"; } ?>>6</option>
                    </select>
                  </div>
                  <div class="form-group col-12">
                    <label for="course_content">Course Content*</label>
                     <textarea name="course_content" class="form-control" id="course_content" placeholder="Course Content Here..." style="resize: none;"><?php echo $update_data['course_content']; ?></textarea>
                  </div>
                  <div class="form-group col-4">
                    <label  style="<?php if(form_error('total_fees')){echo $red;}?>">Total Fees*</label>
                    <input type="text" name="total_fees" class="form-control"  placeholder="Enter Total Fees" value="<?php echo $update_data['total_fees']; ?>">
                  </div>
                  
                  <div class="form-group col-4">
                    <label  style="<?php if(form_error('join_date')){echo $red;}?>">Joining Date*</label>
                    <input type="date" name="join_date"  class="form-control" id="today" placeholder="Select Joining Date" value="<?php echo $update_data['join_date'] ?>">
                  </div>
                  <div class="form-group col-4">
                    <label  >End Date*</label>
                    <input type="date" name="end_date" class="form-control" id="end_date" placeholder="Select Ending Date" value="<?php echo $update_data['end_date'] ?>">
                  </div>
                  <div class="form-group col-4">
                    <label >Job Responsibility*</label> 
                    <br>
                   <input type="radio" name="job_res" style="margin-left: 10px" value="YES" <?php if($update_data['job_res'] == 'YES') { echo "checked"; } ?>>YES
                    <input type="radio"  name="job_res" style="margin-left: 10px" value="NO"<?php if($update_data['job_res'] == 'NO') { echo "checked"; } ?>>NO
                  </div>
                  <!-- <div class="form-group col-4">
                    <label >is intern?*</label>
                    <br>
                    <input type="radio" name="clg_course" style="margin-left: 10px" value="YES" <?php //if($update_data['college_course'] == 'YES') { echo "checked"; } ?>>YES
                     <input type="radio" name="clg_course" style="margin-left: 10px" value="NO" <?php //if($update_data['college_course'] == 'NO') { echo "checked"; } ?>>NO
                  </div> -->
                  <div class="form-group col-4">
                    <label for="">Course Status*</label>
                    <select class="form-control" name="status" id="status">
                      <option value="C" <?php if($update_data['status'] == "C") { echo "selected"; } ?>>Completed</option>
                      <option value="D" <?php if($update_data['status'] == "D") { echo "selected"; } ?>>Dropped</option>
                      <option value="R" <?php if($update_data['status'] == "R") { echo "selected"; } ?>>Running</option>
                      <option value="L" <?php if($update_data['status'] == "L") { echo "selected"; } ?>>On Leave</option>
                      <option value="T" <?php if($update_data['status'] == "T") { echo "selected"; } ?>>Branch Transfer</option>
                    </select>
                  </div>
                  <div class="input_fields_wrap form-group col-12">
                    <label >Registration Fees*</label>
                    <div class="row more_field">
                      <div class="form-group col-4 px-2">
                        <input type="number" readonly="" value="0" class="form-control" placeholder="Calculated Amount" id="calc_amount" />
                      </div>
                      <div class="form-group col-4 px-2">
                        <input type="number" min="1" value="1" class="form-control" placeholder="Total intallment" id="total_installments" />
                      </div>
                      <div class="form-group col-3 px-2">
                        <a href="#" class="btn btn-primary add_field_button">
                          <i class="fa fa-plus"></i> Add Rows
                        </a>
                      </div>
                      
                    </div>
                    <?php 
                    $total_ins_amount = 0;
                    if(!empty($update_data['installment_detail'])){
                      $ins_data = json_decode($update_data['installment_detail']);

                      foreach ($ins_data as $key => $value)
                      {
                        if($value->amount>0){
                          $total_ins_amount+= $value->amount;
                        }
                        
                     ?>
                     
                     <div class="row more_field">
                      <input type="hidden" name="pay_status[]" value="<?php echo $value->status;?>">
                      <div class="form-group col-5 px-2">
                        <input type="text" placeholder="Enter Amount.." class="form-control w-100" autocomplete="off" <?php echo ($value->status==1) ? "readonly" : "";?> name="price[]" value="<?php echo $value->amount; ?>" />
                      </div>
                      <div class="form-group col-5 px-2">
                        <input type="text" class="form-control w-100 date" autocomplete="off" name="date[]" <?php echo ($value->status==1) ? "readonly" : "";?> value="<?php echo date("m/d/Y",strtotime($value->date)); ?>" />
                      </div>
                      <div class="form-group col-2 px-2">
                        <?php 
                        if($value->status==0){
                        ?>
                        <a href="#" class="btn btn-danger remove_field">
                          <i class="fa fa-trash"></i>
                        </a>
                        <?php }?>
                      </div>
                    </div>
                    <?php 
                      }
                    } else if(!empty($paid_data)){
                      foreach ($paid_data as $key => $value)
                      {
                        $total_ins_amount+= $value['amount'];
                    ?>
                      <div class="row more_field">
                        <input type="hidden" name="pay_status[]" value="1">
                        <div class="form-group col-5 px-2">
                          <input type="text" placeholder="Enter Amount.." class="form-control w-100" autocomplete="off" readonly="" name="price[]" value="<?php echo $value['amount']; ?>" />
                        </div>
                        <div class="form-group col-5 px-2">
                          <input type="text" class="form-control w-100 date" autocomplete="off" name="date[]" readonly="" value="<?php echo date("m/d/Y",strtotime($value['date'])); ?>" />
                        </div>
                        <div class="form-group col-2 px-2">
                          <!-- <a href="#" class="btn btn-danger remove_field">
                            <i class="fa fa-trash"></i>
                          </a> -->
                        </div>
                      </div>
                    <?php 
                      }
                    }
                    ?>
                  </div>
                </div>
              </div>  
              <div id="faculty" class="tab-pane fade">
                  <div class="row">
                    <div class="col-12">
                        <h4 class="font-weight-bold my-2">Faculty Details</h4>
                        <hr class="my-2 pb-3">
                    </div>
                    <div class="form-group col-4">
                      <label  style="<?php if(form_error('course')){echo $red;}?>">Select Faculty</label>
                      <select class="form-control select2" name="faculty_id[]" multiple id="faculty_id">
                        <option value="0">Select Faculty</option>
                        <?php
                        $fac_ids = explode(',',@$update_data['faculty_id']); 
                        foreach ($faculty as $fac)
                        {
                          ?>
                          <option value="<?php echo $fac['id'];?>" <?php if(in_array($fac['id'], $fac_ids)) { echo "selected";}?>><?php echo $fac['name'];?></option>
                        <?php } ?>
                      </select>
                    </div>

                    <div class="form-group col-4">
                      <label for="course_content"  >Batch Time</label>
                      <select class="form-control select2" name="batch_time[]" multiple="" id="batch_time">
                          <option value="0">Select Batch</option>
                          <?php 
                          foreach($course_batches as $batch){
                          ?>
                          <option value="<?php echo $batch['batch'];?>" <?php if(@in_array($batch['batch'], $batch_time)){ echo 'selected';}?>><?php echo $batch['batch'];?></option>
                          <?php }?>
                        </select>
                    </div>
                    
                    <div class="form-group col-4">
                      <label >Running Topic</label>
                      <input type="text" name="running_topic" class="form-control" id="running_topic" placeholder="Enter Running Topic" value="<?php echo @$update_data['running_topic'];?>">
                    </div>
                    <div class="form-group col-4">
                      <label >PC/Laptop</label>
                      <br>
                      <input type="radio" name="sitting" style="margin-left: 10px" value="PC" <?php if(@$update_data['sitting']=="PC") { echo "checked";}?>>PC
                       <input type="radio" name="sitting" style="margin-left: 10px" value="LAPTOP" <?php if(@$update_data['sitting']=="LAPTOP") { echo "checked";}?>>LAPTOP
                    </div>
                    <div class="form-group col-4">
                      <label >PC No.</label>
                      <select name="pcno" class="form-control" id="pcno">
                        <option value="0">PC NO-0</option>  
                      </select>
                      
                    </div>
                    <div class="form-group col-4">
                      <label >Laptop Compulsory</label>
                      <br>
                      <input type="radio" name="laptop_compulsory" style="margin-left: 10px" value="NO"  <?php if(@$update_data['laptop_compulsory']=="NO") { echo "checked";}?>> No
                       <input type="radio" name="laptop_compulsory" style="margin-left: 10px" value="YES" <?php if(@$update_data['laptop_compulsory']=="YES") { echo "checked";}?>> Yes
                    </div>
                    <div class="form-group col-6">
                      <label >Completed Topics</label>
                      <textarea type="text" name="completed_topic" class="form-control" id="completed_topic" placeholder="Enter Completed Topics" ><?php echo @$update_data['completed_topic'];?></textarea>
                    </div>
                    <div class="form-group col-6">
                      <label >Extra Note</label>
                      <textarea type="text" name="extra_note" class="form-control" id="extra_note" placeholder="Enter Extra Notes" ><?php echo @$update_data['extra_note'];?></textarea>
                    </div>
                    <div class="form-group col-12">
                        <label >Reception Note</label>
                        <textarea type="text" name="reception_note" class="form-control" id="reception_note" placeholder="Enter Reception Notes" ><?php echo @$update_data['reception_note'];?></textarea>
                      </div>
                  </div>
                </div>  
                <!-- </div> -->
               
                <div class="offset-4 col-4">
                  <input type="submit" class="btn btn-primary btn-block" name="submit" value="Submit">
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
<script src="<?php echo base_url('assets/plugins/jquery-validation/jquery.validate.min.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/jquery-validation/additional-methods.min.js');?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 <script type="text/javascript">
  var pcno = '<?php echo @$update_data['pcno'];?>';
  setTimeout(function(){
    $('#batch_time').trigger('change');  
  },300);
  $('#calc_amount').val('<?php echo $total_ins_amount;?>');
$(document).ready(function() {
  $('body').on('focus',".date", function(){
     $(this).datepicker({
      weekStart: 1,
      daysOfWeekHighlighted: "6,0",
      autoclose: true,
      todayHighlight: true,
      //setDate: new Date(),
    });
  });

  $(document).on('keyup','input[name="price[]"]',function(){
    var calc_amount = 0;
    $('input[name="price[]"]').each(function(){
      if($(this).val() > 0){
        calc_amount+= parseInt($(this).val());  
      }
      $('#calc_amount').val(calc_amount)
    })
  })

  $('#daily_time').change(function(){
    var daily_time = $('#daily_time').val();
    var course_duration = $('#course_duration').val();
    var join_date = $('#today').val();
    $.ajax({
      type:"POST",
      url:"<?php echo site_url('admission/get_end_date');?>",
      data:{daily_time:daily_time,course_duration:course_duration,join_date:join_date},
      success:function(res){
        var x = res.trim();
        console.log(x);
        var today = moment().format(res);
       // $('#end_date').val(today);
        document.getElementById("end_date").value = x;
       
      }
    });
  });


  $('#edit').click(function(){
      if($('#txtname').prop('readonly'))
      {
          $('#txtname').prop('readonly', false)
      }
      else
      {
          $('#txtname').prop('readonly', true)
      }
  }); 
  $('input[name="sitting"],input[name="laptop_compulsory"]').on('change', function() {
    if($(this).val() == "LAPTOP"){
      $('select[name="pcno"]').prop('disabled', "disabled")  
    }else{
      $('select[name="pcno"]').prop('disabled', "")
    }
  });
  $('#batch_start').change(function(){
    var start_time = $(this).val();
    var daily_time = $('#daily_time').val();
    var end_time = parseInt(start_time)+parseInt(daily_time);
    if(end_time >12){
      end_time-=12;
    }
    $('#batch_end').val(end_time)
  })
  $('.select2').select2({
    theme: 'bootstrap4'
  });
  $('#batch_time').on('change', function (e) { 
    var formData = $('#admission-form').serialize();
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
  $('#admission-form').validate({
    ignore: "",
    rules: {
      fname: {
        required: true,
      },
      mname: {
        required: true,
      },
      lname: {
        required: true,
      },
      contact: {
        required: true,
        number: true,
        rangelength:[10, 10]
      },
      father_contact: {
        required: true,
        number: true,
        rangelength:[10, 10]
      },
      course:{
        required:true
      },
      total_fees: {
        required: true,
      },
      course_content:{
        required:true
      },
      join_date:{
        required: true,
      },
      end_date:{
        required: true,
      },
      reference:{
          required: true,
      },
      'price[]':{
        required:true
      },
      'date[]':{
        required:true
      },
      'batch_time[]':{
        required:true
      },
      'faculty_id[]':{
        required:true
      }
    },
    messages: {
      fname: {
        required: "Please enter a First name",
      },
      mname: {
        required: "Please enter a Middle name",
      },
      lname: {
        required: "Please enter a Last name",
      },
      course: {
        required: "Please Select Course",
      },
      course_content: {
        required: "Please Enter Course Content",
      },
      fees: {
       required: "Please enter a fees",
      },
      join_date: {
       required: "Please enter Join Date",
      },
      end_date: {
       required: "Please Enter End Date",
      },
      contact: {
       required: "Please enter a contact number",
       number: "Please enter a vaild contact number",
       rangelength: "Contact number is 10 Digits",
      },
      father_contact: {
       required: "Please enter a contact number",
       number: "Please enter a vaild contact number",
       rangelength: "Contact number is 10 Digits",
      },
      reference:{
        required: "Please Select reference",
      },
      'price[]': {
        required: "Please Enter Registration Fees",
      },
      'date[]': {
        required: "Please Select Registration Fees Date",
      },
      'batch_time[]':{
        required:"Please Select Batch Time"
      },
      'faculty_id[]':{
        required: "Please Select Faculty"
      }
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
  var max_fields      = 20; //maximum input boxes allowed
  var wrapper       = $(".input_fields_wrap"); //Fields wrapper
  var add_button      = $(".add_field_button"); //Add button ID
  var y = 1; //initlal text box count
  $(add_button).click(function(e){ //on add input button click
    e.preventDefault();
    var total_installments = $('#total_installments').val();
    for(var x=1;x<=total_installments;x++){
      if(y < max_fields){ //max input box allowed
        y++; //text box increment
        var cur_row = '<div class="row more_field"><input type="hidden" name="pay_status[]" value="0"><div class="form-group col-5 px-2"><input type="text" class="form-control w-100" name="price[]" placeholder="Enter Amount.." autocomplete="off"/></div><div class="form-group col-5 px-2"><input type="text" class="form-control w-100 date" name="date[]" autocomplete="off"/></div><div class="form-group col-2 px-2"><a href="#" class="btn btn-danger remove_field"><i class="fa fa-trash"></i></a></div></div>';
        $(wrapper).append(cur_row); //add input box
         //$(wrapper).last('.row').find('.date').datepicker("setDate", new Date() );

      }
    }
  });
  
  $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
    e.preventDefault(); $(this).parents('div.more_field').remove(); x--;
  })
  $("#imgInp").change(function() {
    readURL(this);
  });
});
   function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#img_preview').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
} 
 </script>