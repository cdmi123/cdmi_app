<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('header');
$red = "color:red";
$black = "color:black";
$document_list = explode(",", $data['document_list']);
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
                    <h3 class="card-title">Update College Form</h3>
                  </div>
                  <div class="col-6">
                    <a href="<?php echo site_url('College_admission/view_college_admission')?>" class="btn btn-light text-dark font-weight-bold float-right"><i class="fas fa-list"></i> View Admission</a>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" id="personal_info" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-6">
                      <label class="danger">Registration No</label>
                      <div class="input-group">
                        <input type="text" name="regno" class="form-control" id="txtname" readonly="" placeholder="Enter Registration Number" value="<?php echo $data['regno'] ?>" >
                        <div class="input-group-append" id="edit">
                          <span class="input-group-text"><i class="fas fa-edit"></i></span>
                        </div>
                      </div>
                    </div>
                    <div class="form-group col-6">
                      <label >Roll No.</label>
                      <input type="text" name="roll_no" class="form-control" id="roll_no" placeholder="Enter Roll Number" value="<?php echo $data['roll_no']; ?>">
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
                          <div class="form-group col-4">
                            <label style="<?php if(form_error('fname')){echo $red;}?>">Student Name*</label>
                            <input type="text" name="student_name" class="form-control" value="<?php echo @$data['student_name'] ?>">
                          </div>

                          <div class="form-group col-4">
                            <label style="<?php if(form_error('lname')){echo $red;}?>">Father Name*</label>
                            <input type="text" name="lname" class="form-control" placeholder="Enter Last Name" value="<?php echo @$data['father_name']; ?>">
                          </div>
                          <div class="form-group col-4">
                            <label style="<?php if(form_error('total_fees')){echo $red;}?>">Mother Name*</label>
                            <input type="text" name="mother_name" class="form-control" placeholder="Enter Mother Name" value="<?php echo @$data['mother_name']; ?>">
                          </div>
                          <div class="form-group col-3">
                            <label style="<?php if(form_error('contact')){echo $red;}?>">Student Contact No.*</label>
                            <input type="text" name="personal_mobile_no" class="form-control" placeholder="Student Contact No." value="<?php echo @$data['personal_mobile_no']; ?>">
                          </div>
                          <div class="form-group col-3">
                            <label style="<?php if(form_error('contact')){echo $red;}?>">Student Whatsapp No.*</label>
                            <input type="text" name="whatsapp_no" class="form-control" placeholder="Student Whatsapp No." value="<?php echo @$data['whatsapp_no']; ?>">
                          </div>
                          <div class="form-group col-2">
                            <label  style="<?php if(form_error('father_contact')){echo $red;}?>">Parent Contact No*</label>
                            <input type="text" name="father_mobile_no" class="form-control" placeholder="Father Contact No" value="<?php echo @$data['father_mobile_no']; ?>">
                          </div>
                          <div class="form-group col-2">
                            <label  style="<?php if(form_error('parent_whatsapp_no')){echo $red;}?>">Parent Whatsapp No.</label>
                            <input type="text" name="parent_whatsapp_no" class="form-control" placeholder="Parent Whatsapp No." value="<?php echo @$data['parent_whatsapp_no']; ?>">
                          </div>
                          <div class="form-group col-2">
                            <label style="<?php if(form_error('contact')){echo $red;}?>">Home Contact No.*</label>
                            <input type="text" name="home_mobile_no" class="form-control" placeholder="Home Contact No." value="<?php echo @$data['home_mobile_no']; ?>">
                          </div>
                          <div class="form-group col-4">
                            <label style="<?php if(form_error('address')){echo $red;}?>">Address*</label>
                            <textarea name="address" value="<?php echo set_value('address'); ?>" class="form-control" placeholder="Enter Address" style="resize: none;"><?php echo $data['address']; ?></textarea>
                          </div>
                          <div class="form-group col-3">
                            <label for="exampleInputEmail1">Email*</label>
                            <input type="text" name="email" class="form-control" placeholder="Please Enter Email" value="<?php echo $data['email']; ?>">
                          </div>
                          <div class="form-group col-3">
                            <label style="<?php if(form_error('sitting')){echo $red;}?>">Gender*</label>
                            <div class="mt-2">
                              <div class="icheck-primary d-inline">
                                <input type="radio" id="radioPrimary1" value="MALE" name="gender"  <?php if(strcasecmp($data['gender'],"MALE")==0){echo 'checked';}?>>
                                <label for="radioPrimary1" class="mr-3">Male</label>
                              </div>
                              <div class="icheck-primary d-inline">
                                <input type="radio" id="radioPrimary2" value="FEMALE" name="gender" <?php if(strcasecmp($data['gender'],"FEMALE")==0){echo 'checked';}?>>
                                <label for="radioPrimary2">Female</label>
                              </div>
                            </div>
                          </div>
                          <div class="form-group col-2">
                            <label style="<?php if(form_error('birth_date')){echo $red;}?>">Birth Date*</label>
                            <input type="date" name="birth_date" class="form-control" placeholder="Enter Name" value="<?php echo $data['birth_date']; ?>">
                          </div>
                          <div class="form-group col-4">
                            <label style="<?php if(form_error('contact')){echo $red;}?>">Religion*</label>
                            <input type="text" name="religion" class="form-control" placeholder="Enter Religion" value="<?php echo $data['religion']; ?>">
                          </div>
                          <div class="form-group col-4">
                            <label style="<?php if(form_error('father_contact')){echo $red;}?>">Cast Category *</label>
                            <select class="form-control" name="cast_category">
                                <option value="" disabled="" selected="">Select Community</option>
                                <option value="EWS" <?php if(@$data['cast_category']=="EWS"){echo 'selected';}?>>EWS</option>
                                <option value="GENERAL" <?php if(@$data['cast_category']=="GENERAL"){echo 'selected';}?>>General</option>
                                <option value="OBC" <?php if(@$data['cast_category']=="OBC"){echo 'selected';}?>>OBC</option>
                                <option value="SC" <?php if(@$data['cast_category']=="SC"){echo 'selected';}?>>SC</option>
                                <option value="ST" <?php if(@$data['cast_category']=="ST"){echo 'selected';}?>>ST</option>
                            </select>
                          </div>

                          <div class="form-group col-4">
                            <label style="<?php if(form_error('contact')){echo $red;}?>">Cast*</label>
                            <input type="text" name="cast" class="form-control" placeholder="Enter Cast" value="<?php echo $data['cast']; ?>">
                          </div>
                          <div class="form-group col-4">
                            <label style="<?php if(form_error('total_fees')){echo $red;}?>">Adhar Card Number*</label>
                            <input type="text" name="adhar_no" class="form-control" placeholder="Enter Adhar Card Number" value="<?php echo $data['adhar_no']; ?>">
                          </div>
                          <div class="form-group col-4">
                            <label>Image</label>
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
                                if($data['image']!='')
                                {
                                  $img = base_url('upload/college_student_photo/'.$data['image']);
                                }else{
                                  $img = base_url('assets/users.jpg');
                                }
                                 ?>
                                <img src="<?php echo $img;?>" width="50" id="img_preview">
                              </div>
                            </div>
                          </div>
                          <div class="form-group col-4">
                            <label>Division:</label>
                            <select class="form-control" name="class_name">
                              <option value="">Select Division</option>
                              <option value="CLASS A" <?php if(@$data['class_name']=="CLASS A"){ echo "selected";}; ?>>CLASS A</option>
                              <option value="CLASS B" <?php if(@$data['class_name']=="CLASS B"){ echo "selected";}; ?>>CLASS B</option>
                              <option value="CLASS C" <?php if(@$data['class_name']=="CLASS C"){ echo "selected";}; ?>>CLASS C</option>
                              <option value="CLASS D" <?php if(@$data['class_name']=="CLASS D"){ echo "selected";}; ?>>CLASS D</option>
                              <option value="CLASS E" <?php if(@$data['class_name']=="CLASS E"){ echo "selected";}; ?>>CLASS E</option>
                              <option value="CLASS F" <?php if(@$data['class_name']=="CLASS F"){ echo "selected";}; ?>>CLASS F</option>
                              <option value="CLASS G" <?php if(@$data['class_name']=="CLASS G"){ echo "selected";}; ?>>CLASS G</option>
                              <option value="CLASS H" <?php if(@$data['class_name']=="CLASS H"){ echo "selected";}; ?>>CLASS H</option>
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
                              <option value="SSC" <?php if(@$data['last_edu']=="SSC"){echo 'selected';}?>>SSC</option>
                              <option value="HSC-COMMERCE" <?php if(@$data['last_edu']=="HSC-COMMERCE"){echo 'selected';}?>>HSC-COMMERCE</option>
                              <option value="HSC-ARTS" <?php if(@$data['last_edu']=="HSC-ARTS"){echo 'selected';}?>>HSC-ARTS</option>
                              <option value="HSC-SCIENCE" <?php if(@$data['last_edu']=="HSC-SCIENCE"){echo 'selected';}?>>HSC-SCIENCE</option>
                              <option value="BCA" <?php if(@$data['last_edu']=="BCA"){echo 'selected';}?>>BCA</option>
                              <option value="BBA" <?php if(@$data['last_edu']=="BBA"){echo 'selected';}?>>BBA</option>
                              <option value="B.COM." <?php if(@$data['last_edu']=="B.COM."){echo 'selected';}?>>B.Com</option>
                              <option value="B.SC" <?php if(@$data['last_edu']=="B.SC"){echo 'selected';}?>>B.Sc</option>
                              <option value="BA" <?php if(@$data['last_edu']=="BA"){echo 'selected';}?>>BA</option>
                              <option value="DIPLOMA" <?php if(@$data['last_edu']=="DIPLOMA"){echo 'selected';}?>>Diploma</option>
                            </select>
                          </div>
                          <div class="form-group col-4">
                            <label style="<?php if(form_error('school_name')){echo $red;}?>">School/College Name*</label>
                            <input type="text" name="school_name" class="form-control" placeholder="School/College Name" value="<?php echo $data['school_name']; ?>">
                          </div>
                          <div class="form-group col-4">
                            <label style="<?php if(form_error('seat_no')){echo $red;}?>">Last Exam Seat No*</label>
                            <input type="text" name="seat_no" class="form-control" placeholder="Enter Seat No." value="<?php echo $data['seat_no']; ?>">
                          </div>
                          <div class="form-group col-4">
                            <label style="<?php if(form_error('passing_year')){echo $red;}?>">Passing Year*</label>
                            <input type="month" name="passing_year" class="form-control" id="fname"  value="<?php echo $data['passing_year']; ?>">
                          </div>
                          <div class="form-group col-4">
                            <label style="<?php if(form_error('percentage')){echo $red;}?>">Percentage*</label>
                            <input type="text" name="percentage" class="form-control" placeholder="Enter Percentage" value="<?php echo $data['percentage']; ?>">
                          </div>
                          <div class="form-group col-4">
                            <label style="<?php if(form_error('percentile')){echo $red;}?>">Percentile Rank*</label>
                            <input type="text" name="percentile" class="form-control" placeholder="Enter Percentile Rank" value="<?php echo $data['percentile']; ?>">
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
                                <option value="<?php echo $uni['code']?>" <?php if(@$data['university']==$uni['code']){echo 'selected';}?>><?php echo $uni['uni_name']?></option> 
                                <?php 
                                }
                                ?>
                            </select>
                          </div>
                          <div class="form-group col-4">
                            <label style="<?php if(form_error('course')){echo $red;}?>">Examination Center*</label>
                            <select class="form-control" id="exam_center" name="exam_center">
                              <option value="">Select Examination Center</option>
                              <option value="Any College of Saurashtra University" <?php if(@$data['exam_center']=="Any College of Saurashtra University"){ echo "selected";}; ?>>Any College of Saurashtra University</option>
                              <<!-- option value="Saurashtra University,Rajkot" <?php //if(@$data['exam_center']=="Saurashtra University,Rajkot"){ echo "selected";}; ?>>Saurashtra University,Rajkot</option> -->
                              <option value="SRK University,Bhopal" <?php if(@$data['exam_center']=="SRK University,Bhopal"){ echo "selected";}; ?>>SRK University,Bhopal</option>  
                              <option value="APJ University,Indore" <?php if(@$data['exam_center']=="APJ University,Indore"){ echo "selected";}; ?>>APJ University,Indore</option>  
                              <option value="Anywhere in Surat City" <?php if(@$data['exam_center']=="Anywhere in Surat City"){ echo "selected";}; ?>>Anywhere in Surat City</option>  
                              <option value="Swarrnim Startup & Innovation University,Gandhinagar" <?php if(@$data['exam_center']=="Swarrnim Startup & Innovation University,Gandhinagar"){ echo "selected";}; ?>>Swarrnim Startup & Innovation University,Gandhinagar</option>
                              <option value="Prime Institute of Engineering & Technology, Ubharat" <?php if(@$data['exam_center']=="Prime Institute of Engineering & Technology, Ubharat"){ echo "selected";}; ?>>Prime Institute of Engineering & Technology, Ubharat</option>
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
                                  <option value="<?php echo $inst['institute_name']?>" <?php echo  set_select('institute_name',$inst['institute_name'], (@$data['institute_name']==$inst['institute_name'])); ?>><?php echo $inst['institute_name']?></option>
                              <?php } ?>
                            </select>
                          </div>
                          
                          <div class="form-group col-4">
                            <label style="<?php if(form_error('course')){echo $red;}?>">College Course*</label>
                            <select class="form-control" name="college_course" >
                                <option value="">Select College course</option>
                                <?php 
                                    foreach ($college_course as $clg_course)
                                    {
                                ?>
                                <option value="<?php echo $clg_course['course_name']?>" <?php if(@$data['college_course']==strtoupper($clg_course['course_name'])){echo 'selected';}?>><?php echo $clg_course['course_name']?></option>
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
                                  <option value="<?php echo $stream['stream_name'];?>" <?php if(@$data['course_stream']==$stream['stream_name']){echo 'selected';}?>><?php echo $stream['stream_name']?></option>
                              <?php } ?>
                            </select>
                          </div>
                          <div class="form-group col-4">
                            <label  style="<?php if(form_error('father_contact')){echo $red;}?>">Mode *</label>
                            <select class="form-control" name="college_mode">
                                <option value="" disabled="" selected="">Select Mode</option>
                                <option value="REG" <?php if(@$data['college_mode']=="REG"){ echo "selected";}; ?>>Regular</option>
                                <option value="EX" <?php if(@$data['college_mode']=="EX"){ echo "selected";}; ?>>External</option>
                                <option value="ONLY_CLG" <?php if(@$data['college_mode']=="ONLY_CLG"){ echo "selected";}; ?>>Only College</option>
                            </select>
                          </div>
                          <div class="form-group col-4">
                            <label style="<?php if(form_error('contact')){echo $red;}?>">Total Fees*</label>
                            <input type="number" name="total_fees" class="form-control" placeholder="Enter Total Fess" value="<?php echo $data['total_fees']; ?>">
                          </div>
                          <div class="form-group col-4">
                            <label for="exampleInputEmail1">Per Sem Fees*</label>
                            <input type="text" name="per_sem_fees" class="form-control" placeholder="Enter Total Fess" value="<?php echo $data['per_sem_fees']; ?>">
                          </div>
                          <div class="form-group col-4">
                            <label for="enrollment_no">Uni. Enrollment No:</label>
                            <input type="text" name="enrollment_no" class="form-control" id="enrollment_no" placeholder="Enter Enrollment No." value="<?php echo $data['enrollment_no']; ?>" >
                          </div>
                          <div class="form-group col-2">
                            <label style="<?php if(form_error('fname')){echo $red;}?>">Starting Session*</label>
                            <select class="form-control" name="start_session">
                              <?php 
                              for($i=2012;$i<=date("Y");$i++){
                              ?>
                              <option value="<?php echo $i;?>" <?php if(@$data['start_session']==$i){ echo "selected";}; ?>><?php echo $i;?></option>
                              <?php 
                              }
                              ?>
                            </select>
                          </div>
                          <div class="form-group col-2">
                            <label >Ending Session*</label>
                            <select class="form-control" name="end_session">
                              <?php 
                              for($i=2012;$i<=date("Y")+5;$i++){
                              ?>
                              <option value="<?php echo $i;?>" <?php if(@$data['end_session']==$i){ echo "selected";}; ?>><?php echo $i;?></option>
                              <?php 
                              }
                              ?>
                            </select>
                          </div>
                          <div class="form-group col-4">
                            <label style="<?php if(form_error('reference')){echo $red;}?>">Select Reference*</label>
                            <select class="form-control" id="reference" name="reference">
                                <option value="">Select Reference</option>
                                <option value="INTERNET" <?php if(@$data['reference']=="INTERNET"){ echo "selected";}; ?>>Internet</option>
                                <option value="STUDENT" <?php if(@$data['reference']=="STUDENT"){ echo "selected";}; ?>>Student</option>  
                                <option value="SEMINAR" <?php if(@$data['reference']=="SEMINAR"){ echo "selected";}; ?>>Seminar</option>  
                                <option value="STAFF" <?php if(@$data['reference']=="STAFF"){ echo "selected";}; ?>>Staff</option>  
                                <option value="OTHER" <?php if(@$data['reference']=="OTHER"){ echo "selected";}; ?>>Other</option>  
                            </select>
                          </div>
                          <div class="form-group col-4">
                            <label for="exampleInputEmail1">Reference Name*</label>
                            <input type="text" name="reference_name" class="form-control" id="other" placeholder="Enter Reference Name" value="<?php echo $data['reference_name']; ?>" >
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
                                <option >Select Document List</option>
                                <option <?php if(in_array("10th-Original", $document_list)){ echo "selected";}; ?>>10th-Original</option>
                                <option <?php if(in_array("12th-Original", $document_list)){ echo "selected";}; ?>>12th-Original</option>
                                <option <?php if(in_array("School Leaving Certificate Original", $document_list)){ echo "selected";}; ?>>School Leaving Certificate Original</option>
                                <option <?php if(in_array("Diploma Last 2 Sem Result Original", $document_list)){ echo "selected";}; ?>>Diploma Last 2 Sem Result Original</option>
                                <option <?php if(in_array("Diploma All Result Original", $document_list)){ echo "selected";}; ?>>Diploma All Result Original</option>
                                <option <?php if(in_array("Garduation Last 2 Sem Result Original", $document_list)){ echo "selected";}; ?>>Garduation Last 2 Sem Result Original</option>
                                <option <?php if(in_array("Garduation All Result Original", $document_list)){ echo "selected";}; ?>>Garduation All Result Original</option>    
                                <option <?php if(in_array("12th-Trial Ceertificate Original", $document_list)){ echo "selected";}; ?>>12th-Trial Ceertificate Original</option>
                                <option <?php if(in_array("10th-Trial Ceertificate Original", $document_list)){ echo "selected";}; ?>>10th-Trial Ceertificate Original</option>
                                <option <?php if(in_array("10th-Xerox", $document_list)){ echo "selected";}; ?>>10th-Xerox</option>
                                <option <?php if(in_array("12th-Xerox", $document_list)){ echo "selected";}; ?>>12th-Xerox</option>
                                <option <?php if(in_array("School Leaving Certificate Xerox", $document_list)){ echo "selected";}; ?>>School Leaving Certificate Xerox</option>
                                <option <?php if(in_array("Adharcard Xerox", $document_list)){ echo "selected";}; ?>>Adharcard Xerox</option>
                                <option <?php if(in_array("All Result Xerox", $document_list)){ echo "selected";}; ?>>Diploma All Result Xerox</option>
                                <option <?php if(in_array("Garduation All Sem Result Xerox", $document_list)){ echo "selected";}; ?>>Garduation All Sem Result Xerox</option>
                                <option <?php if(in_array("12th-Trial Ceertificate Xerox", $document_list)){ echo "selected";}; ?>>12th-Trial Ceertificate Xerox</option>    
                                <option <?php if(in_array("10th-Trial Ceertificate Xerox", $document_list)){ echo "selected";}; ?>>10th-Trial Ceertificate Xerox</option>    
                                <option <?php if(in_array("Photos", $document_list)){ echo "selected";}; ?>>Photos</option>
                            </select>
                          </div>
                          <div class="form-group col-4">
                            <label for="exampleInputEmail1">Multimedia Course</label>
                            <br>
                            <input type="radio" name="multimedia_course" <?php if(@$data['multimedia_course']=="YES"){ echo "checked";}; ?> style="margin-left: 10px" value="YES">YES
                            <input type="radio" name="multimedia_course" <?php if(@$data['multimedia_course']=="NO"){ echo "checked";}; ?> style="margin-left: 10px" value="NO">NO
                          </div>
                          <div class="form-group col-4">
                            <label style="<?php if(form_error('join_date')){echo $red;}?>">Joining Date*</label>
                            <input type="date" name="join_date" class="form-control" placeholder="Enter Name" value="<?php echo $data['join_date']; ?>">
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
