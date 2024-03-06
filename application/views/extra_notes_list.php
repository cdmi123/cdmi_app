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
                  <h3 class="card-title ">Extra Notes</h3>
                </div>
                <div class="col-sm-6">
                  
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            
            <div class="card-body">
              <div class="row">                  
                <div class="form-group col-12">
                  <label >Note 1</label>
                  <textarea class="form-control" readonly="" >Rs. ____________ Discount for Festival offer ________________.</textarea>
                </div>
                <div class="form-group col-12">
                  <label >Note 2</label>
                  <textarea class="form-control" readonly="" >Rs. ____________ Discount for Laptop Compulsory.</textarea>
                </div>
                <div class="form-group col-12">
                  <label >Note 3</label>
                  <textarea class="form-control" readonly="" >Rs. ____________ Discount for one shot payment.</textarea>
                </div>
                <div class="form-group col-12">
                  <label >Note 4</label>
                  <textarea class="form-control" readonly="" >Rs. ____________ Discount for Referenced by ____________.</textarea>
                </div>
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
    if($(this).val() == "LAPTOP" || $(this).val() == "YES"){
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