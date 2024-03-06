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
        <div class="col-md-12 ">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header ">
              <div class="row">
                <div class="col-sm-6 head-center">
                  <h3 class="card-title ">New Course Admission</h3>
                </div>
                <div class="col-sm-6">
                  <a href="<?php echo site_url('admission/view_admission')?>" class="btn btn-light text-dark font-weight-bold float-right"><i class="fas fa-list"></i>Admission List</a>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" method="post" id="admission-form" enctype="multipart/form-data">
              <div>
                <label style="float: right;margin-right: 240px;"><?php echo @$name;?></label>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="form-group col-6">
                    <label class="danger">Registration No</label>
                    <div class="input-group">
                      <input type="text" name="regno"  class="form-control" id="txtname" placeholder="Enter Registration Number" value="<?php echo @$reg_no->regno+1;?>" readonly>
                      <div class="input-group-append" id="edit">
                        <span class="input-group-text"><i class="fas fa-edit"></i></span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-4">
                    <label>Inquiry Number</label>
                    <input type="text" name="inq_no" class="form-control" id="inq_no" placeholder="Enter Inquiry Number" value="<?php echo @$id;?>">
                  </div>

                <style type="text/css">
                  #all_data li
                  {
                    margin-left:5px;
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
                        <label for="exampleInputEmail1">SurName*</label>
                        <input type="text" name="fname" class="form-control" id="fname" placeholder="Enter First Name" value="<?php echo @$name; ?>">
                      </div>


                      <div class="form-group col-4">
                        <label style="<?php if(form_error('mname')){echo $red;}?>">Student Name*</label>
                        <input type="text" name="mname" class="form-control" placeholder="Enter Middle Name" value="<?php echo set_value('mname'); ?>">
                      </div>


                      <div class="form-group col-4">
                        <label style="<?php if(form_error('lname')){echo $red;}?>">Father Name*</label>
                        <input type="text" name="lname" class="form-control" placeholder="Enter Last Name" value="<?php echo set_value('lname'); ?>">
                      </div>



                      <div class="form-group col-3">
                        <label style="<?php if(form_error('contact')){echo $red;}?>">Student Contact No*</label>
                        <input type="text" name="contact" class="form-control" placeholder="Enter Mobile No." value="<?php echo @$contact; ?>">
                      </div>

                      <div class="form-group col-3">
                        <label  style="<?php if(form_error('whatsapp_no')){echo $red;}?>">Whatsapp No*</label>
                        <input type="text" name="whatsapp_no" class="form-control" placeholder="Whatsapp No." value="<?php echo set_value('whatsapp_no'); ?>">
                      </div>

                      <div class="form-group col-3">
                        <label for=""  style="<?php if(form_error('father_contact')){echo $red;}?>">Parent Contact No*</label>
                        <input type="text" name="father_contact" class="form-control"  placeholder="Parent Contact No." value="<?php echo set_value('father_contact'); ?>">
                      </div>
                      <div class="form-group col-3">
                        <label for=""  style="<?php if(form_error('parent_whatsapp_no')){echo $red;}?>">Parent Whatsapp No*</label>
                        <input type="text" name="parent_whatsapp_no" class="form-control"  placeholder="Parent Whatsapp No." value="<?php echo set_value('parent_whatsapp_no'); ?>">
                      </div>
                      <div class="form-group col-4">
                        <label style="<?php if(form_error('address')){echo $red;}?>">Address*</label>
                        <textarea name="address" value="<?php echo set_value('address'); ?>" class="form-control" placeholder="Enter Address" style="resize: none;"></textarea>
                      </div>
                      <div class="form-group col-4">
                        <label style="<?php if(form_error('birth_date')){echo $red;}?>">Birth Date*</label>
                        <input type="date" name="birth_date" class="form-control" placeholder="Enter Name" value="<?php echo set_value('birth_date'); ?>">
                      </div>
                      <div class="form-group col-4">
                        <label for="exampleInputFile">Image</label>
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
                            <img src="" width="50" id="img_preview">
                          </div>
                        </div>
                      </div>
                      <div class="form-group col-4">
                        <label >Qualification*</label>
                        <input type="text" name="qualification" class="form-control" placeholder="Enter Qualification" value="<?php echo set_value('father_contact'); ?>">
                      </div>

                      <div class="form-group col-4">
                        <label style="<?php if(form_error('reference')){echo $red;}?>">Select Reference*</label>
                        <select class="form-control" id="reference" name="reference">
                          <option value="">Select Reference</option>
                          <option value="INTERNET" <?php echo  set_select('reference', 'internet', (@$_POST['reference']=='internet')); ?>>Internet</option>
                          <option value="STUDENT" <?php echo  set_select('reference', 'STUDENT', (@$_POST['reference']=='STUDENT')); ?>>Student</option>  
                          <option value="SEMINAR" <?php echo  set_select('reference', 'SEMINAR', (@$_POST['reference']=='SEMINAR')); ?>>Seminar</option> 
                          <option value="STAFF" <?php echo  set_select('reference', 'STAFF', (@$_POST['reference']=='STAFF')); ?>>Staff</option>  
                          <option value="OTHER" <?php echo  set_select('reference', 'OTHER', (@$_POST['reference']=='OTHER')); ?>>Other</option>  
                        </select>
                      </div>

                      <div class="form-group col-4">
                        <label for="exampleInputEmail1">Reference Name*</label>
                        <input type="text" name="reference_name"  class="form-control" id="other" placeholder="Enter Reference Name" >
                      </div>
                    </div>
                  </div>
                  <div id="educational" class="tab-pane fade">
                    <div class="row">
                      <div class="col-12">
                          <h4 class="font-weight-bold my-2">Course Detail</h4>
                          <hr class="my-2 pb-3">
                      </div>
                      <div class="form-group col-4">
                        <label style="<?php if(form_error('course')){echo $red;}?>">Course*</label>
                        <select class="form-control" name="course" id="course">
                          <option value="">Select course</option>
                          <?php 
                          foreach ($course as $data)
                          {
                            ?>
                            <option value="<?php echo $data['course_name']?>" <?php echo  set_select('course',$data['course_name'], (@$_POST['course']==$data['course_name'])); ?>><?php echo $data['course_name']?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="form-group col-4">
                        <label style="<?php if(form_error('sub_course')){echo $red;}?>">Sub Course</label>
                        <select class="form-control" name="sub_course" id="sub_course">
                          <option value="">Select Sub-course</option>
                          <?php 
                          foreach ($course as $data)
                          {
                            ?>
                            <option value="<?php echo $data['course_name']?>" <?php echo  set_select('sub_course',$data['course_name'], (@$_POST['sub_course']==$data['course_name'])); ?>><?php echo $data['course_name']?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="form-group col-2">
                        <label for="">Course Duration*</label>
                        <input type="text" name="course_duration"  id="course_duration" class="form-control" placeholder="Course Duration" value="">
                      </div>


                      <div class="form-group col-2">
                        <label for="">Daily Time*</label>
                        <select class="form-control" name="daily_time" id="daily_time">
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="6">6</option>
                        </select>
                      </div>
                      <div class="form-group col-12">
                        <label for="course_content"  >Course Content*</label>
                        <textarea name="course_content" class="form-control" id="course_content" placeholder="Course Content Here..." style="resize: none;"></textarea>
                      </div>

                      <div class="form-group col-4">
                        <label style="<?php if(form_error('total_fees')){echo $red;}?>">Total Fees*</label>
                        <input type="text" name="total_fees" class="form-control" id="total_fees" placeholder="Enter Total Fees" value="<?php echo set_value('total_fees'); ?>">
                      </div>

                      <div class="form-group col-4">
                        <label>Joining Date*</label>
                        <input type="text" name="join_date"  class="form-control date" id="today" placeholder="Enter Join Date"   >
                      </div>
                      <div class="form-group col-4">
                        <label >Ending Date*</label>
                        <input type="text" name="end_date" class="form-control date" id="end_date"  placeholder="Enter End Date" >
                      </div>

                      

                      <div class="form-group col-6">
                        <label for="exampleInputEmail1">Job Responsbility*</label>
                        <br>
                        <input type="radio" name="job_res" style="margin-left: 10px" value="YES">YES
                         <input type="radio" name="job_res" style="margin-left: 10px" value="NO">NO
                      </div>
                      <!-- <div class="form-group col-6">
                        <label for="exampleInputEmail1">Is Intern?*</label>
                        <br>
                        <input type="radio" name="clg_course" style="margin-left: 10px" value="YES">YES
                        <input type="radio" name="clg_course" checked="" style="margin-left: 10px" value="NO">NO
                      </div> -->
                      <div class="input_fields_wrap form-group col-12">
                        <label for="exampleInputEmail1">
                         Installment Details*
                        </label>
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
                        <div class="row more_field">
                          <div class="form-group col-5 px-2">
                            <input type="text" placeholder="Enter Amount.." class="form-control w-100" autocomplete="off" name="price[]"/>
                          </div>
                          <div class="form-group col-5 px-2">
                            <input type="text" class="form-control w-100 date" autocomplete="off" name="date[]" />
                          </div>
                          <div class="form-group col-2 px-2">
                            <a href="#" class="btn btn-danger remove_field">
                              <i class="fa fa-trash"></i>
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="offset-4 col-4">
                     <input type="submit" class="btn btn-primary btn-block" name="submit" value="Submit">
                    </div>
                  </div>
                  <div id="faculty" class="tab-pane fade">
                    <div class="row">
                      <div class="col-12">
                          <h4 class="font-weight-bold my-2">Faculty Details</h4>
                          <hr class="my-2 pb-3">
                      </div>
                      <div class="form-group col-4">
                        <label style="<?php if(form_error('course')){echo $red;}?>">Select Faculty</label>
                        <select class="form-control select2" multiple name="faculty_id[]" id="faculty_id">
                          <option value="0">Select Faculty</option>
                          <?php 
                          foreach ($faculty as $fac)
                          {
                            ?>
                            <option value="<?php echo $fac['id'];?>"><?php echo $fac['name'];?></option>
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
                          <option value="<?php echo $batch['batch'];?>"><?php echo $batch['batch'];?></option>
                          <?php }?>
                        </select>
                      </div>
                      
                      <div class="form-group col-4">
                        <label >Running Topic</label>
                        <input type="text" name="running_topic" class="form-control" id="running_topic" placeholder="Enter Running Topic">
                      </div>
                      <div class="form-group col-3">
                        <label for="exampleInputEmail1">PC/Laptop</label>
                        <br>
                        <input type="radio" name="sitting" style="margin-left: 10px" value="PC" checked=""> PC
                        <input type="radio" name="sitting" style="margin-left: 10px" value="LAPTOP"> LAPTOP
                      </div>
                      <div class="form-group col-3">
                        <label >PC No.</label>
                        <select name="pcno" class="form-control" id="pcno">
                          <option value="0">PC NO-0</option>  
                        </select>
                        
                      </div>
                      <div class="form-group col-3">
                        <label for="exampleInputEmail1">Laptop Compulsory</label>
                        <br>
                        <input type="radio" name="laptop_compulsory" style="margin-left: 10px" value="NO" checked=""> No
                         <input type="radio" name="laptop_compulsory" style="margin-left: 10px" value="YES"> Yes
                      </div>
                      <!-- <div class="form-group col-3">
                        <label for="exampleInputEmail1">GST</label>
                        <br>
                        <input type="radio" name="gst" style="margin-left: 10px" value="NO" checked=""> No
                        <input type="radio" name="gst" style="margin-left: 10px" value="YES"> Yes
                      </div> -->
                      <div class="form-group col-12">
                        <label >Extra Note</label>
                        <textarea type="text" name="extra_note" class="form-control" id="extra_note" placeholder="Enter Extra Notes" ></textarea>
                      </div>
                      <div class="form-group col-12">
                        <label >Reception Note</label>
                        <textarea type="text" name="reception_note" class="form-control" id="reception_note" placeholder="Enter Reception Notes" ></textarea>
                      </div>
                    </div>
                    <div class="offset-4 col-4">
                     <input type="submit" class="btn btn-primary btn-block" name="submit" value="Submit">
                    </div>
                  </div>
                </div>


              </form>

            </div>

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
  
  //document.querySelector("#today").valueAsDate = new Date();

  var duration = '';
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
  $('#today').datepicker("setDate", new Date() );

  $(document).on('blur','input[name="price[]"]',function(){
    var calc_amount = 0;
    $('input[name="price[]"]').each(function(){
      if($(this).val() > 0){
        calc_amount+= parseInt($(this).val());  
      }
      $('#calc_amount').val(calc_amount)
    })
  })
  
  $('#course').change(function(){
    var course = $('#course').val();
    $.ajax({
      type:"POST",
      url:"<?php echo site_url('admission/get_course');?>",
      data:{course:course},
      dataType:"json",
      success:function(data){
        duration = data.duration;
       $('#course_duration').val(data.duration);
       $('#course_content').val(data.course_cover);
       $('#daily_time').val(data.daily_time);
       $("input[name='job_res'][value='"+data.job+"']").prop('checked', true);
       $('#total_fees').val(data.fees);
       setTimeout(function(){
        $('#daily_time').trigger('change');
       },300)
      }
    });
  });
  $('#daily_time').change(function(){
    var daily_time = $('#daily_time').val();
    var course_duration = duration;//$('#course_duration').val();
    var join_date = $('#today').val();
    $.ajax({
      type:"POST",
      url:"<?php echo site_url('admission/get_end_date');?>",
      data:{daily_time:daily_time,course_duration:course_duration,join_date:join_date},
      dataType:'json',
      success:function(res){
        //var x = res.trim();
       // console.log(x);
        var today = moment().format(res.end_date);
        $('#end_date').val(today);
        $('#course_duration').val(res.course_duration);
        document.getElementById("end_date").value = res.end_date;
       
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

  $('#batch_time').on('change', function (e) { 
      console.log('select event');
      var formData = $('#admission-form').serialize();
      $.ajax({
        type:"POST",
        url:"<?php echo site_url('admission/get_ajax_seats');?>",
        data:formData,
        success:function(res){
          $('#pcno').html(res);
        }
      });
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
  })


  //$.validator.setDefaults({
      //submitHandler: function () {
        //alert( "Form successful submitted!" );
      //}
    //});
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
      qualification:{
        required:true
      },
      total_fees: {
        required: true,
      },
      extra_info:{
        required: true,
      },
      course_content:{
        required:true
      },
      end_date:{
        required: true,
      },
      birth_date:{
        required: true,
      },
      address:{
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
     end_date: {
       required: "Please enter Join Date",
     },
     birth_date: {
       required: "Please enter Birth Date",
     },
     qualification: {
       required: "Please enter Qualification",
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
     address: {
       required: "Please enter Address",
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
         //,'course[]': {
        //   required: "Please select course",
        // },
        // fees: {
        //   required: "Please enter a fees",
        // },
        // extra_info:{
        //   required: "Please enter an Extra Information",
        // }
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


  $(document).ready(function() {
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
        var cur_row = '<div class="row more_field"><div class="form-group col-5 px-2"><input type="text" class="form-control w-100" name="price[]" placeholder="Enter Amount.." autocomplete="off"/></div><div class="form-group col-5 px-2"><input type="text" class="form-control w-100 date" name="date[]" autocomplete="off"/></div><div class="form-group col-2 px-2"><a href="#" class="btn btn-danger remove_field"><i class="fa fa-trash"></i></a></div></div>';
        $(wrapper).append(cur_row); //add input box
         //$(wrapper).last('.row').find('.date').datepicker("setDate", new Date() );

      }
    }
    
  });
  
  $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
    e.preventDefault(); $(this).parents('div.more_field').remove(); y--;
  })
});


 


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