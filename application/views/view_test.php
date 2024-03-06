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
            <div class="row">
              <div class="col-4">
                <a href="<?php echo site_url('Test/index')?>" class="btn btn-primary btn-block my-1"><i class="fas fa-plus"></i>  Add Exam Marks</a>
              </div>
            </div>
            <h1>Staff List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</l
                i>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
           
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Reg No</th>
                  <th>Exam Date</th>
                  <th>Faculty Name</th>
                  <th>Status</th>
                  <th>Project_detail</th>
                  <th>Viva</th>
                  <th>Theory</th>
                  <th>Practical</th>
                  <th>Subject</th>
                  
                </tr>
                </thead>
                <tbody>
                <?php 
                  foreach ($arr as $info)
                   {
                ?>
                <tr>
                  <td><?php echo $info['id']?></td> 
                  <td><?php echo $info['regno']?></td>
                  <td><?php echo $info['exam_date']?></td>
                  <td><?php echo $info['name']?></td>
                  <td><?php echo $info['status']?></td>
                  <td><?php echo $info['project_detail']?></td>
                  <td><?php echo $info['viva_marks']?></td>
                  <td><?php echo $info['theory_marks']?></td>
                  <td><?php echo $info['practical_marks']?></td>
                  <td><?php echo $info['subject']?></td>





              
                
                

                </tr>
                <?php
                }
                ?>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
 

 <?php
  $this->load->view('footer');
 ?>