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
            <h1>Add Course Test Marks</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">General Form</li>
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
            <div class="row">
              <div class="col-3">
                <a href="<?php echo site_url('Test/view_exam')?>" class="btn btn-primary btn-block my-1"><i class="fas fa-list"></i> Test List</a>
              </div>
            </div>
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Course Test Marks</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Reg No</label>
                    <input type="text" name="regno" class="form-control" id="exampleInputEmail1" placeholder="Enter Regno" value="<?php echo $student['regno'];?>">
                  </div>
                   <div class="form-group">
                    <label for="exampleInputEmail1">Student Name</label>
                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter Regno" value="<?php echo $student['student_name'];?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Course</label>
                    <input type="text" name="course" class="form-control" id="exampleInputEmail1" placeholder="Enter Regno" value="<?php echo $student['course'];?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Exam Topic</label>
                    <input type="text" name="exam_topic" class="form-control" id="exam_topic" placeholder="Enter Exam Topic" value="">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Total Marks</label>
                    <input type="text" name="total_marks" class="form-control" id="exampleInputEmail1" placeholder="Enter Total Marks" value="">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Obtained Marks</label>
                    <input type="text" name="obtained_marks" class="form-control" id="exampleInputEmail1" placeholder="Enter Obtained Marks" value="">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Exam Date</label>
                    <input type="date" name="exam_date" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="<?php echo date("Y-m-d");?>">
                  </div>
                  
                   <div class="form-group">
                    <label for="exampleInputPassword1">Select Faculty</label>
                   
                    <select class="form-control" name="faculty_id" id="faculty_id">
                          <option value="0">Select Faculty</option>
                          <?php 
                          foreach ($faculty as $fac)
                          {
                            ?>
                            <option value="<?php echo $fac['id'];?>" <?php if($fac['id']==$this->session->userdata('user_login')){echo 'selected';}?>><?php echo $fac['name'];?></option>
                          <?php } ?>
                        </select>
                  </div>




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