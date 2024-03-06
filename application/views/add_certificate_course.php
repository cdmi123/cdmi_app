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
            <h1>Add Certificate Course</h1>
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
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Course</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="certificate_course">Certificate Course :</label>
                    <input type="text" class="form-control" name="certificate_course" id="certificate_course" value="<?php echo @$course_info['course_name']; ?>" placeholder="Write Certificate Course">
                  </div>
                  <div class="form-group">
                    <label>Status :</label>
                    <select class="form-control" name="status">
                        <option value="1" <?php if(@$course_info['status']==1){?> selected='selected' <?php } ?>>Active</option>
                        <option value="0" <?php if(@$course_info['status']==0){?> selected='selected' <?php } ?>>In-Active</option>
                    </select>
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