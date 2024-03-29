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
            <h1>Add Followup</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              
              <li class="breadcrumb-item active"><a class="btn btn-primary" href="<?php echo site_url('followup/view_followup/'.$fo_id) ?>">View Follow up</a></li>
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
                <h3 class="card-title">Add Follow-up</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" enctype="multipart/form-data">
                <div class="card-body">

                  <div class="form-group">
                    <label for="exampleInputEmail1">Inquiry Name</label>
                    <input type="text" name="contact" class="form-control" id="exampleInputEmail1" name="contact" placeholder="Enter Contact Number" disabled=""  value="<?php echo $inquiry_data['name']?>" >
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Inquiry Contact</label>
                    <input type="text" name="contact" class="form-control" value="<?php echo $inquiry_data['contact']?>" id="exampleInputEmail1" name="contact" disabled="" placeholder="Enter " >
                  </div>

                   <div class="form-group">
                    <label for="exampleInputEmail1">Inquiry Course</label>
                    <input type="text" name="contact" class="form-control" value="<?php echo $inquiry_data['course']?>" id="exampleInputEmail1" name="contact" disabled="" placeholder="Enter " >
                  </div>

                   <div class="form-group">
                    <label for="exampleInputEmail1">Inquiry By</label>
                    <input type="text" name="contact" class="form-control" value="<?php echo $inquiry_data['inquiry_by']?>" id="exampleInputEmail1" name="contact" disabled="" placeholder="Enter " >
                  </div>




                  <div class="form-group">
                    <label for="exampleInputEmail1">Followup Reason</label>
                    <textarea name="followup_reason" class="form-control"  placeholder="Enter Follow-up Reason" ></textarea>
                  </div>

                    <div class="form-group">
                    <label for="exampleInputEmail1">Follow- Up By Name</label>
                    <input type="text" name="followup_by" class="form-control" id="exampleInputEmail1" name="contact" placeholder="Enter followup_by_name"  >
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