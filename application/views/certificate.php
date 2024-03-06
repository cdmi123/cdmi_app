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
                  <div class="form-group col-md-6">
                    <label for="cer_no"> Certificate No. :</label>
                    <input type="text" class="form-control" name="certificate_no">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="name"> Student Name :</label>
                    <input type="text" class="form-control" name="name">
                  </div>
                  <div class="form-group col-md-6">
                      <label for="course">Certificate Name :</label>
                          <input type="text" class="form-control" name="Certificate_name">
                  </div>
                  <div class="form-group col-md-6">
                      <label for="amount">Amount :</label>
                          <input type="text" class="form-control" name="amount">
                  </div>
                   <div class="form-group col-md-6">
                      <label for="payment_detail">Payment Details :</label>
                          <input type="text" class="form-control" name="payment_detail">
                  </div>
                   <div class="form-group col-md-6">
                      <label for="refby">Ref By :</label>
                          <input type="text" class="form-control" name="ref_by">
                  </div>
                  <div class="form-group col-md-6">
                      <label for="start_date">From Date :</label>
                       <div class="" data-date-format="dd-mm-yyyy">
                          <input type="date" class="form-control" name="from_date">
                      </div>
                  </div>
                  <div class="form-group col-md-6">
                      <label for="start_date">To Date :</label>
                       <div class="" data-date-format="dd-mm-yyyy">
                          <input type="date" class="form-control" name="to_date">
                      </div>
                  </div>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" name="save" class="btn btn-primary" value="save">Submit</button>
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