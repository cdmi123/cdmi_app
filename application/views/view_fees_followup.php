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
            <h1>View Follow - up</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"><a class="btn btn-primary" href="<?php echo site_url('followup/add_followup_data/') ?>">Add Follow up</a></li>
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
                  <th>Student Name</th>
                  <th>Follow-Up Reason</th>
                  <th>Follow-up by</th>
                  <th>Follow-Up Date</th>
                  
                </tr>
                </thead>
                <tbody>
               <?php   $id=1; foreach ($fees_data as $index => $fees_info) { 

                       $Remark = array_reverse(explode(',',$fees_info['remark']));
                       $follow_up_by =array_reverse(explode(',',$fees_info['follow_by']));
                       $follow_date = array_reverse(explode(',',$fees_info['follow_date']));



                       $key=0;

                       foreach ($Remark as $remark) { ?>
                          <tr>
                                <td><?php echo $id; ?></td>
                                <td><?php echo $fees_info['student_name']; ?></td>
                                <td><?php echo $remark; ?></td>
                                <td><?php if(array_key_exists($key,$follow_up_by)) { echo $follow_up_by[$key]; } else { echo "No Date"; } ?></td>
                                <td><?php if(array_key_exists($key,$follow_date)) { echo $follow_date[$key]; }else{ echo "No Date"; } ?></td>
                          </tr>
               <?php $id++; $key++;} } ?>
                  
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