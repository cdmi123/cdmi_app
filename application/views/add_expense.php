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
            <h1>Add Expense</h1>
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
                <h3 class="card-title">Add Expense</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" enctype="multipart/form-data">
                <div class="card-body">

                  <div class="form-group">
                    <label for="exampleInputEmail1">Expense Title</label>
                    <input type="text" required name="expense_title" class="form-control" id="exampleInputEmail1" placeholder="Description" value="<?php echo @$info['category_name']?>">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Select Expense Category</label>
                    <select class="form-control" required name="expense_category">
                        <option>Select Expense Category</option>
                        <?php
                          foreach ($expense as $expense_data) 
                          {
                        ?>
                        <option value="<?php echo $expense_data['id']?>"><?php echo $expense_data['category_name']?></option>
                      <?php } ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Amount</label>
                    <input type="number" required name="amount" class="form-control" placeholder="Enter Expense Amount" value="<?php echo $info['course_name']?>">
                  </div>

                   <div class="form-group">
                    <label for="exampleInputEmail1">Select Department</label><br>
                    <input type="radio" name="dept" class="" value="Multimedia" checked> Multimedia 
                    <input type="radio" name="dept" class="" value="College"> College
                    
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Description</label>
                    <input type="text" required name="description" class="form-control" id="exampleInputEmail1" placeholder="Description" value="<?php echo @$info['category_name'];?>">
                  </div>

                   <div class="form-group">
                        <label for="exampleInputEmail1">Select Faculty</label>
                        <select class="form-control" required name="faculty_id" id="faculty_id">
                          <option value="0">Select Faculty</option>
                          <?php 
                          foreach ($faculty as $fac)
                          {
                            ?>
                            <option value="<?php echo $fac['id'];?>" <?php if($this->session->userdata('user_login')==$fac['id']){echo 'selected';}?>><?php echo $fac['name'];?></option>
                          <?php } ?>
                        </select>
                      </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Date</label>
                    <input type="date" name="date" required class="form-control" placeholder="Date" value="<?php echo date("Y-m-d");?>">
                  </div>
                <!-- /.card-body -->

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
 ?>s