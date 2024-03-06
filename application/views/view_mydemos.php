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
            <h1>My Demo Lectures</h1>
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
                  <th>Demo Id</th>
                  <th>Inquiry Id</th>
                  <th>Inquiry Name</th>
                  <th>Inquiry Course</th>
                  <th>Inquiry Contact</th>
                  <th>Fees</th>
                  <th>Start Date</th>
                  <th>Inquiry By</th>
                  
                </tr>
                </thead>
                <tbody>
                  <?php

                    foreach ($arr as $data) 
                    {
                      $info = $this->DemoLectureModel->get_record_details($data['demo_id'],$data['source']);
                  ?>
                  <tr>
                    <td><?php echo $data['demo_id']?></td>
                    <td><?php echo $data['inq_id']?></td>
                    <td><?php echo $info['inquiry_name']?></td>
                    <td><?php echo $info['course_name']?></td>
                    <td><?php echo $info['contact']?></td>
                    <td><?php echo $info['fees']?>/-</td>
                    <td><?php echo $info['demo_start']?></td>
                    <td><?php echo $info['inquiry_by']?></td>
                  </tr>

                <?php } ?>
                  
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