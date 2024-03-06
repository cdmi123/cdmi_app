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
            <h1>View Telecaller Follow - up</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
             
              <li class="breadcrumb-item active"><a class="btn btn-primary" href="<?php echo site_url('schoolinq/add_telecaller_followup/'.$fo_id) ?>">Add Follow up</a></li>
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
                  <th>Inquiry Name</th>
                 
                  <th>Inquiry Contact</th>
                  
                  <th>Follow-Up Reason</th>
                  
                  <th>Follow-Up Date</th>
                  
                </tr>
                </thead>
                <tbody>
                  <?php

                    foreach ($follow as $data) 
                    {
                  ?>
                  <tr>
                    <td><?php echo $data['id']?></td>
                    <td><?php echo $data['s_name']?></td>
                    
                     <td><?php echo $data['contact1']?></td>
                     
                     <td><?php echo $data['followup_reason']?></td>
                      
                      <td><?php echo $data['followup_date']?></td>
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