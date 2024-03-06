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
            <h1>Add New Certificate</h1>
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
          <div class="col-md-9">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Certificate</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">
                  <?php
                  if(isset($err)){
                    echo '<div class="alert alert-danger">'.$err.'</div>';  
                  }
                  ?>
                  <div class="form-group col-md-12">
                      <label for="name">Full name :</label>
                        <div class="row">
                          <div class="col-md-4">
                            <input type="text" class="form-control" id="surname" name="surname" placeholder="Surname" value="<?php echo @$get_certificate_row['surname']; ?>" >  
                          </div>
                          <div class="col-md-4">
                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Firstname" value="<?php echo @$get_certificate_row['first_name']; ?>" > 
                          </div>
                          <div class="col-md-4">
                            <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Middlename" value="<?php echo @$get_certificate_row['middle_name']; ?>" > 
                          </div>
                       </div>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="enrollment">Reg No. :</label>
                    <input type="text" class="form-control" name="enrollment" id="enrollment" value="<?php echo @$get_certificate_row['reg_no']; ?>" placeholder="Enter Reg No.">
                  </div>
                  <div class="form-group col-md-9">
                    <label for="course">Certificate Name :</label>
                    <select class="form-control" name="course" id="course">
                        <option value="0">--- Select Course ---</option>
                        <?php foreach($course as $subject){?>
                        <option value="<?php echo $subject['id']; ?>" <?php if(@$get_certificate_row['course']==$subject['id']){?> selected='selected' <?php } ?>><?php echo $subject['course_name']; ?></option>
                        <?php }?>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                      <label for="start_date">Start Date :</label>
                       <div class="" data-date-format="dd-mm-yyyy">
                          <input type="date" class="form-control" name="start_date" value="<?php echo @$get_certificate_row['start_date']; ?>">
                      </div>
                  </div>

                  <div class="form-group col-md-6">
                      <label for="end_date">End Date :</label>
                       <div class="" data-date-format="dd-mm-yyyy">
                          <input type="date" class="form-control" name="end_date" value="<?php echo @$get_certificate_row['end_date']; ?>">
                      </div>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="duration">Duration :</label>
                    <input type="text" placeholder="Duration in months" class="form-control" name="duration" id="duration" value="<?php echo @$get_certificate_row['duration']; ?>">
                  </div>
                  <div class="form-group col-md-3">
                      <label for="grade">Grade :</label>
                       <select class="form-control" name="grade">
                           <option value="A+" <?php if(@$get_certificate_row['grade']=='a+'){?> selected='selected' <?php } ?>>A+</option>
                           <option value="A" <?php if(@$get_certificate_row['grade']=='a'){?> selected='selected' <?php } ?>>A</option>
                           <option value="B+" <?php if(@$get_certificate_row['grade']=='b+'){?> selected='selected' <?php } ?>>B+</option>
                           <option value="B" <?php if(@$get_certificate_row['grade']=='b'){?> selected='selected' <?php } ?>>B</option>
                           <option value="C" <?php if(@$get_certificate_row['grade']=='c'){?> selected='selected' <?php } ?>>C</option>
                       </select>
                  </div>
                  <div class="form-group col-md-6">
                      <label>Certificate Date :</label>
                      <input type="date" class="form-control" name="certificate_date" value="<?php echo @$get_certificate_row['certificate_date']; ?>">
                  </div>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" name="save" class="btn btn-primary">Submit</button>
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