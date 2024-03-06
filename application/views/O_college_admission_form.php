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
                  <div class="col-6 head-center">
                    <h3 class="card-title"><?php echo $this->lang->line('add_clg_admission'); ?></h3>
                  </div>
                  <div class="col-6">
                    <a href="<?php echo site_url('view-admission')?>" class="btn btn-light text-dark font-weight-bold float-right"><i class="fas fa-list"></i> <?php echo $this->lang->line('view_clg_admission'); ?></a>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" id="personal_info" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-4">
                      <label class="danger">Registration No</label>
                      <div class="input-group">
                        <input type="text" name="regno" class="form-control" id="txtname" readonly="" placeholder="Enter Registration Number" value="<?php echo @$reg_no->regno+1;?>" >
                        <div class="input-group-append" id="edit">
                          <span class="input-group-text"><i class="fas fa-edit"></i></span>
                        </div>
                      </div>
                    </div>
                    <div class="form-group col-4">
                      <label >Roll No.</label>
                      <input type="text" name="roll_no" class="form-control" id="roll_no" placeholder="Enter Roll Number" >
                    </div>
                    <div class="form-group col-4">
                      <label >Inquiry No</label>
                      <input type="text" name="inq_no" class="form-control" id="inq_no" placeholder="Enter Inquiry Number" >
                    </div>
                  </div>
                  <style type="text/css">
                    #all_data li
                    {
                      margin-left: 5px;
                    }

                  </style>
                  <ul class="nav nav-tabs" id="all_data">
                    <li class="nav-item ml-0"><a class="nav-link active" data-toggle="tab" href="#personal">Personal Info</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#educational">Academic Detail</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#admission">Admission Detail</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#documents">Document List</a></li>
                  </ul>

                    <div class="tab-content">
                      <div id="personal" class="tab-pane fade active show">
                        <div class="row">
                          <div class="col-12">
                            <h4 class="font-weight-bold my-2">Personal Information</h4>
                            <hr class="my-2 pb-3">
                          </div>
                          <div class="form-group col-3">
                            <label style="<?php if(form_error('fname')){echo $red;}?>">Surname*</label>
                            <input type="text" name="fname" class="form-control" id="fname" placeholder="Enter First Name" value="<?php echo @$name; ?>">
                          </div>


                          <div class="form-group col-3">
                            <label style="<?php if(form_error('mname')){echo $red;}?>">Student Name*</label>
                            <input type="text" name="mname" class="form-control" placeholder="Enter Middle Name" value="<?php echo set_value('mname'); ?>">
                          </div>
                          <div class="form-group col-3">
                            <label style="<?php if(form_error('lname')){echo $red;}?>">Father Name*</label>
                            <input type="text" name="lname" class="form-control" placeholder="Enter Last Name" value="<?php echo set_value('lname'); ?>">
                          </div>
                          <div class="form-group col-3">
                            <label style="<?php if(form_error('total_fees')){echo $red;}?>">Mother Name*</label>
                            <input type="text" name="mother_name" class="form-control" placeholder="Enter Mother Full Name" value="<?php echo set_value('total_fees'); ?>">
                          </div>
                          <div class="form-group col-3">
                            <label style="<?php if(form_error('contact')){echo $red;}?>">Student Contact No.*</label>
                            <input type="text" name="personal_mobile_no" class="form-control" placeholder="Student Mobile No" value="<?php echo @$contact; ?>">
                          </div>
                          <div class="form-group col-3">
                            <label style="<?php if(form_error('contact')){echo $red;}?>">Student Whatsapp No.*</label>
                            <input type="text" name="whatsapp_no" class="form-control" placeholder="Student Whatsapp No." value="<?php echo @$contact; ?>">
                          </div>
                          <div class="form-group col-2">
                            <label  style="<?php if(form_error('father_contact')){echo $red;}?>">Parent Contact No.*</label>
                            <input type="text" name="father_mobile_no" class="form-control" placeholder="Parent Mobile No" value="<?php echo set_value('father_contact'); ?>">
                          </div>
                          <div class="form-group col-2">
                            <label  style="<?php if(form_error('parent_whatsapp_no')){echo $red;}?>">Parent Whatsapp No.</label>
                            <input type="text" name="parent_whatsapp_no" class="form-control" placeholder="Parent Whatsapp No." value="<?php echo set_value('parent_whatsapp_no'); ?>">
                          </div>
                          <div class="form-group col-2">
                            <label style="<?php if(form_error('contact')){echo $red;}?>">Home Contact No.*</label>
                            <input type="text" name="home_mobile_no" class="form-control" placeholder="Home Contact No." value="<?php echo @$contact; ?>">
                          </div>
                          <div class="form-group col-4">
                            <label style="<?php if(form_error('address')){echo $red;}?>">Address*</label>
                            <textarea name="address" value="<?php echo set_value('address'); ?>" class="form-control" placeholder="Enter Address" style="resize: none;"></textarea>
                          </div>

                          <div class="form-group col-3">
                            <label style="<?php if(form_error('total_fees')){echo $red;}?>">Email*</label>
                            <input type="text" name="email" class="form-control" placeholder="Enter Email Address" value="<?php echo set_value('total_fees'); ?>">
                          </div>
                          <div class="form-group col-3">
                            <label style="<?php if(form_error('sitting')){echo $red;}?>">Gender*</label>
                            <div class="mt-2">
                              <div class="icheck-primary d-inline">
                                <input type="radio" id="radioPrimary1" value="male" name="gender" >
                                <label for="radioPrimary1" class="mr-3">Male</label>
                              </div>
                              <div class="icheck-primary d-inline">
                                <input type="radio" id="radioPrimary2" value="female" name="gender">
                                <label for="radioPrimary2">Female</label>
                              </div>
                            </div>
                          </div>
                          <div class="form-group col-2">
                            <label style="<?php if(form_error('birth_date')){echo $red;}?>">Date of Birth*</label>
                            <input type="date" name="birth_date" class="form-control" placeholder="Enter Name" value="<?php echo set_value('birth_date'); ?>">
                          </div>
                          
                          <div class="form-group col-4">
                            <label style="<?php if(form_error('contact')){echo $red;}?>">Religion*</label>
                            <input type="text" name="religion" class="form-control" placeholder="Enter Religion" value="<?php echo @$contact; ?>">
                          </div>
                          <div class="form-group col-4">
                            <label style="<?php if(form_error('father_contact')){echo $red;}?>">Cast Category *</label>
                            <select class="form-control" name="cast_category">
                                <option value="" disabled="" selected="">Select Community</option>
                                <option value="EWS">EWS</option>
                                <option value="GENERAL">General</option>
                                <option value="OBC">OBC</option>
                                <option value="SC">SC</option>
                                <option value="ST">ST</option>
                            </select>
                          </div>

                          <div class="form-group col-4">
                            <label style="<?php if(form_error('contact')){echo $red;}?>">Cast*</label>
                            <input type="text" name="cast" class="form-control" placeholder="Enter Cast" value="<?php echo @$contact; ?>">
                          </div>
                          <div class="form-group col-4">
                            <label style="<?php if(form_error('total_fees')){echo $red;}?>">Adhar Card No.*</label>
                            <input type="text" name="adhar_no" class="form-control" placeholder="Enter Adhar No." value="">
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
                            <label>Division:</label>
                            <select class="form-control" name="class_name">
                              <option value="">Select Division</option>
                              <option value="CLASS A">CLASS A</option>
                              <option value="CLASS B">CLASS B</option>
                              <option value="CLASS C">CLASS C</option>
                              <option value="CLASS D">CLASS D</option>
                              <option value="CLASS E">CLASS E</option>
                              <option value="CLASS F">CLASS F</option>
                              <option value="CLASS G">CLASS G</option>
                              <option value="CLASS H">CLASS H</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div id="educational" class="tab-pane fade">
                        <div class="row">
                          <div class="col-12">
                            <h4 class="font-weight-bold my-2">Educational Detail</h4>
                            <hr class="my-2 pb-3">
                          </div>
                          <div class="form-group col-4">
                            <label  style="<?php if(form_error('father_contact')){echo $red;}?>">Last Education *</label>
                            <select class="form-control" name="last_edu">
                              <option value="" disabled="" selected="">Select Education</option>
                              <option value="SSC">SSC</option>
                              <option value="HSC-COMMERCE">HSC-COMMERCE</option>
                              <option value="HSC-ARTS">HSC-ARTS</option>
                              <option value="HSC-SCIENCE">HSC-SCIENCE</option>
                              <option value="BCA">BCA</option>
                              <option value="BBA">BBA</option>
                              <option value="B.COM.">B.Com</option>
                              <option value="B.SC">B.Sc</option>
                              <option value="BA">BA</option>
                              <option value="DIPLOMA">Diploma</option>
                            </select>
                          </div>
                          <div class="form-group col-4">
                            <label style="<?php if(form_error('contact')){echo $red;}?>">School/College Name*</label>
                            <input type="text" name="school_name" class="form-control" placeholder="School/College Name" value="<?php echo @$contact; ?>">
                          </div>
                          <div class="form-group col-4">
                            <label style="<?php if(form_error('lname')){echo $red;}?>">Last Exam Seat No*</label>
                            <input type="text" name="seat_no" class="form-control" placeholder="Enter Seat No." value="">
                          </div>
                          <div class="form-group col-4">
                            <label style="<?php if(form_error('fname')){echo $red;}?>">Passing Year*</label>
                            <input type="month" name="passing_year" class="form-control" id="fname"  value="<?php echo @$name; ?>">
                          </div>
                          <div class="form-group col-4">
                            <label style="<?php if(form_error('mname')){echo $red;}?>">Percentage*</label>
                            <input type="text" name="percentage" class="form-control" placeholder="Enter Percentage" value="<?php echo set_value('mname'); ?>">
                          </div>
                          <div class="form-group col-4">
                            <label style="<?php if(form_error('lname')){echo $red;}?>">Percentile Rank*</label>
                            <input type="text" name="percentile" class="form-control" placeholder="Enter Percentile Rank" value="<?php echo set_value('lname'); ?>">
                          </div>
                          
                        </div>
                      </div>
                      <div id="admission" class="tab-pane fade">
                        <div class="row">
                          <div class="col-12">
                            <h4 class="font-weight-bold my-2">Admission Detail</h4>
                            <hr class="my-2 pb-3">
                          </div>
                          <div class="form-group col-4">
                            <label  style="<?php if(form_error('father_contact')){echo $red;}?>">University *</label>
                            <select class="form-control" name="university">
                                <?php 
                                foreach($universities as $uni){
                                ?>
                                <option value="<?php echo $uni['code']?>"><?php echo $uni['uni_name']?></option> 
                                <?php 
                                }
                                ?>

                            </select>
                          </div>
                          <div class="form-group col-4">
                            <label style="<?php if(form_error('course')){echo $red;}?>">Examination Center*</label>
                            
                            <select class="form-control" id="exam_center" name="exam_center">
                                <option value="">Select Examination Center</option>
                                <option value="Any College of Saurashtra University">Any College of Saurashtra University</option>
                                <option value="SRK University,Bhopal">SRK University,Bhopal</option> 
                                <option value="Swami Vivekanand University,Bhopal">Swami Vivekanand University,Bhopal</option>   
                                <option value="APJ University,Indore">APJ University,Indore</option>  
                                <option value="Anywhere in Surat City">Anywhere in Surat City</option>  
                                <option value="Swarrnim Startup & Innovation University,Gandhinagar">Swarrnim Startup & Innovation University,Gandhinagar</option>
                                <option value="Prime Institute of Engineering & Technology, Ubharat">Prime Institute of Engineering & Technology, Ubharat</option>  
                            </select>
                          </div>
                          <div class="form-group col-4">
                            <label style="<?php if(form_error('institute_name')){echo $red;}?>">Institute Name</label>
                            <select class="form-control" name="institute_name" >
                                <option value="">Select Institute</option>
                                <?php 
                                    foreach ($institutes as $inst)
                                    {
                                ?>
                                  <option value="<?php echo $inst['institute_name']?>" <?php echo  set_select('institute_name',$inst['institute_name'], (@$_POST['institute_name']==$inst['institute_name'])); ?>><?php echo $inst['institute_name']?></option>
                              <?php } ?>
                            </select>
                          </div>
                          
                          <div class="form-group col-4">
                            <label style="<?php if(form_error('college_course')){echo $red;}?>">College Course*</label>
                            <select class="form-control" name="college_course" >
                                <option value="">Select College course</option>
                                <?php 
                                    foreach ($college_course as $data)
                                    {
                                ?>
                                  <option value="<?php echo $data['course_name']?>" <?php echo  set_select('course',$data['course_name'], (@$_POST['course']==$data['course_name'])); ?>><?php echo $data['course_name']?></option>
                              <?php } ?>
                            </select>
                          </div>
                          <div class="form-group col-4">
                            <label for="" style="<?php if(form_error('course')){echo $red;}?>">Course Stream</label>
                            <select class="form-control" name="course_stream" >
                                <option value="">Course Stream</option>
                                <?php 
                                    foreach ($course_streams as $stream)
                                    {
                                ?>
                                  <option value="<?php echo $stream['stream_name'];?>" <?php echo  set_select('course_stream',$stream['stream_name'], (@$_POST['course_stream']==$stream['stream_name'])); ?>><?php echo $stream['stream_name']?></option>
                              <?php } ?>
                            </select>
                          </div>
                          <div class="form-group col-4">
                            <label  style="<?php if(form_error('father_contact')){echo $red;}?>">Mode *</label>
                            <select class="form-control" name="college_mode">
                                <option value="" disabled="" selected="">Select Mode</option>
                                <option value="REG">Regular</option>
                                <option value="EX">External</option>
                                <option value="ONLY_CLG">Only College</option>
                            </select>
                          </div>

                          <div class="form-group col-4">
                            <label style="<?php if(form_error('contact')){echo $red;}?>">Total Fees*</label>
                            <input type="number" name="total_fees" class="form-control" placeholder="Enter Total Fess" value="<?php echo @$contact; ?>">
                          </div>

                          <div class="form-group col-4">
                            <label for="exampleInputEmail1">Per Sem Fees*</label>
                            <input type="text" name="per_sem_fees" class="form-control" placeholder="Enter Total Fess">
                          </div>
                          <div class="form-group col-4">
                            <label for="enrollment_no">Uni. Enrollment No:</label>
                            <input type="text" name="enrollment_no" class="form-control" id="enrollment_no" placeholder="Enter Enrollment No." >
                          </div>
                          <div class="form-group col-2">
                            <label style="<?php if(form_error('fname')){echo $red;}?>">Starting Session*</label>
                            <!-- <input type="month" name="start_session" class="form-control" id="fname"  value="<?php //echo @$name; ?>"> -->
                            <select class="form-control" name="start_session">
                              <?php 
                              for($i=START_YEAR-2;$i<=date("Y");$i++){
                              ?>
                              <option value="<?php echo $i;?>"><?php echo $i;?></option>
                              <?php 
                              }
                              ?>
                              
                            </select>
                          </div>

                          <div class="form-group col-2">
                            <label style="<?php if(form_error('fname')){echo $red;}?>">Ending Session*</label>
                            <select class="form-control" name="end_session">
                              <?php 
                              for($i=START_YEAR;$i<=date("Y")+5;$i++){
                              ?>
                              <option value="<?php echo $i;?>"><?php echo $i;?></option>
                              <?php 
                              }
                              ?>
                            </select>
                          </div>
                          <div class="form-group col-4">
                            <label style="<?php if(form_error('reference')){echo $red;}?>">Select Reference*</label>
                            <select class="form-control" id="reference" name="reference">
                                <option value="">Select Reference</option>
                                <option value="INTERNET">Internet</option>
                                <option value="STUDENT">Student</option>  
                                <option value="SEMINAR">Seminar</option>  
                                <option value="STAFF">Staff</option>  
                                <option value="OTHER">Other</option>  
                            </select>
                          </div>
                          <div class="form-group col-4">
                            <label for="exampleInputEmail1">Reference Name*</label>
                            <input type="text" name="reference_name" class="form-control" id="other" placeholder="Enter Reference Name" >
                          </div>
                          
                        </div>
                      </div>
                      <div id="documents" class="tab-pane fade">
                        <div class="row">
                          <div class="col-12">
                            <h4 class="font-weight-bold my-2">Document List</h4>
                            <hr class="my-2 pb-3">
                          </div>
                          <div class="form-group col-8">
                            <label  style="<?php if(form_error('document_list[]')){echo $red;}?>">Document List*</label>
                             <select class="select2" multiple="multiple" name="document_list[]" data-placeholder="Select Document List"
                                  style="width: 100%;">
                                <option>Select Document List</option>
                                <option>10th-Original</option>
                                <option>12th-Original</option>
                                <option>School Leaving Certificate Original</option>
                                <option>Diploma Last 2 Sem Result Original</option>
                                <option>Diploma All Result Original</option>
                                <option>Garduation Last 2 Sem Result Original</option>
                                <option>Garduation All Result Original</option>    
                                <option>12th-Trial Ceertificate Original</option>
                                <option>10th-Trial Ceertificate Original</option>
                                <option>10th-Xerox</option>
                                <option>12th-Xerox</option>
                                <option>School Leaving Certificate Xerox</option>
                                <option>Adharcard Xerox</option>
                                <option>Diploma All Result Xerox</option>
                                <option>Garduation All Sem Result Xerox</option>
                                <option>12th-Trial Ceertificate Xerox</option>    
                                <option>10th-Trial Ceertificate Xerox</option>    
                                <option>Photos</option>
                            </select>
                          </div>
                          <div class="form-group col-4">
                            <label for="exampleInputEmail1">Multimedia Course*</label>
                            <br>
                            <input type="radio" name="multimedia_course" style="margin-left: 10px" value="YES">YES
                            <input type="radio" name="multimedia_course" checked="" style="margin-left: 10px" value="NO">NO
                          </div>
                          <div class="form-group col-4">
                            <label style="<?php if(form_error('join_date')){echo $red;}?>">Joining Date*</label>
                            <input type="date" name="join_date" class="form-control" placeholder="Enter Name" value="<?php echo set_value('join_date') ? set_value('join_date') : date('Y-m-d'); ?>">
                          </div>
                        </div>
                        <div class="offset-4 col-4 mb-4" >
                          <input type="submit" class="btn btn-primary btn-block" name="submit" value="Submit">
                        </div>
                      </div>
                    </div>
                </div>

                

            </form>              
              <!--   <div class="offset-4 col-4">
                  <input type="submit" class="btn btn-primary btn-block" name="submit" value="Submit">
                </div> -->
              
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
 <script type="text/javascript">
     $(document).ready(function() {
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


        //$('#reference').change(function(){
        //alert('hello'); 
          // if($('#reference').val() == 'other' || $('#reference').val() == 'student') 
          // {
          //     $('#other').prop('disabled', false) 
          // }
          // else
          // {
          //     $('#other').prop('disabled', true)
          // }

        //});


        $('input[name="sitting"]').on('change', function() {
             $('select[name="pcno"]').attr('disabled', this.value != "pc")

        });

         $('.select2').select2({
            theme: 'bootstrap4'
    })


             $.validator.setDefaults({
      //submitHandler: function () {
        //alert( "Form successful submitted!" );
      //}
    });
    $('#personal_info').validate({
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
        // mother_name: {
        //   required: true,
        // },
        personal_mobile_no: {
           required: true,
           number: true,
           rangelength:[10, 10]
        },
        father_mobile_no: {
          required: true,
          number: true,
          rangelength:[10, 10]
        },
        home_mobile_no: {
          required: true,
           number: true,
          rangelength:[10, 10]
        },
        // email:{
        //   required:true
        // },
        birth_date:{
          required: true,
        },
        gender:{
          required: true,
        },
        adhar_no: {
          required: true,
        },
        religion:{
          required: true,
        },
      
        cast_category:{
           required: true,
         },
        // 'course_content[]':{
        //   required:true
        // },
        // join_date:{
        //   required: true,
        // },
        
       
        cast:{
          required: true,
        },
         address:{
          required: true,
        },
        last_edu:{
           required: true,
        },
        school_name:{
           required: true,
        },
        passing_year:{
           required: true,
        },
        // percentage:{
        //    required: true,
        // },
        // percentile:{
        //    required: true,
        // },
        college_course:{
           required: true,
        },
        college_mode:{
          required: true,
        },
        total_fees:{
          required: true,
        },
        per_sem_fees:{
          required: true,
        },
        admission_session:{
          required: true,
        },
        university:{
          required: true,
        },
        exam_center:{
          required: true,
        },
        reference:{
          required: true,
        },
       
        join_date:{
          required: true,
        },
        'document_list[]':{
           required:true
        },



      },
      messages: {
        fname: {
          required: "Please enter a Surname",
        },
        mname: {
          required: "Please enter a Student Name",
        },
        lname: {
          required: "Please enter a Father name",
        },
        // mother_name: {
        //   required: "Please Enter Mother Name",
        // },
        // 'course_content[]': {
        //   required: "Please select course content",
        // },
         personal_mobile_no: {
           required: "Please enter a Personal Mobile No",
           number: "Please enter a vaild contact number",
           rangelength: "Contact number must be 10 Digits",

         },
         father_mobile_no: {
           required: "Please enter a Father Mobile No",
            number: "Please enter a vaild contact number",
           rangelength: "Contact number must be 10 Digits",
         },
         home_mobile_no: {
           required: "Please enter a Personal Mobile No",
            number: "Please enter a vaild contact number",
           rangelength: "Contact number must be 10 Digits",
         },
         // email: {
         //   required: "Please enter a Personal Mobile No",
         // },
         birth_date: {
           required: "Please enter Birth Date",
         },
         gender: {
           required: "Please enter Gender",
         },
         adhar_no: {
            required: "Please Enter Aadhar card Number",
         },
         address: {
           required: "Please enter Address",
         },
          religion: {
           required: "Please enter religion",
         },cast_category: {
           required: "Please Select Cast Category",
         }, cast: {
           required: "Please enter cast",
         },
         last_edu: {
            required: "Please Select Last Education",
         },
         school_name: {
            required: "Please Enter School/College Name"
         },
         passing_year: {
            required: "Please Enter Passing Year"
         },
         // percentage: {
         //    required: "Please Enter Percentage"
         // },
         // percentile: {
         //    required: "Please Enter Percentile"
         // },
         college_course: {
            required: "Please Select College Course"
         },
         college_mode: {
            required: "Please Select College Mode"
         },
         total_fees: {
            required: "Please Enter Total Fees"
         },
         per_sem_fees: {
            required: "Please Enter Per Sem Fees"
         },
         admission_session: {
            required: "Please Enter Admission Session"
         },
         university: {
            required: "Please Select University"
         },
         exam_center: {
            required: "Please Select Examination Center"
         },
         reference: {
            required: "Please Select Reference"
         },
         join_date: {
            required: "Please Select Join Date"
         },'document_list[]': {
            required: "Please select Document",
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
      },
      // onSuccess : function(form) {
      //      e.preventDefault();
      //     $('#all_data li a[href="#admission"]').tab('show');
      // }
    });

    $("#imgInp").change(function() {
      readURL(this);
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


    });
    
 </script>
