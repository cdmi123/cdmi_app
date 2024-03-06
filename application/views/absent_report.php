<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('header');
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Telecaller Report</h1><br>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Telecaller Report</li>
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
                <div class="card-header">
                   <?php for ($i = -2; $i < 0; $i++){
                $url_month = date('Y_m', strtotime("$i month"));
              ?>
            <a href="<?php echo site_url('old-tele-report/'.$url_month);?>" class="btn btn-primary btn-sm"><?php echo date('F-Y', strtotime("$i month")); ?></a>
          <?php } ?>
          <a href="<?php echo site_url('Schoolinq/telecaller_report');?>" class="btn btn-primary btn-sm"><?php echo date('F-Y');?></a>
                </div>
              <table id="example2" class="table table-bordered table-hover">
                <?php foreach ($tele_repo as $month => $all_date) { $month_year = explode('_',$month); ?>
                <tr>
                  <td colspan="2" align="center"><b><?php echo date("F", mktime(0, 0, 0, $month_year[0], 10));?>-<?php echo $month_year[1]; ?></b></td>
                </tr>
                  <?php foreach ($all_date as $date => $telecall_data) { ?>
                  <tr>
                    <td align="center"><?php echo $date; ?></td>
                    <td>
                    <table align="center" class="col-sm-12">
                      <th>No</th>
                      <th>Student Name</th>
                      <th>Course / Collage</th>

                      <?php $id=1; foreach ($telecall_data as $telecaller_name => $data) { ?>
                        <tr>
                          <td><?php echo $id; ?></td>
                          <td><?php echo $telecaller_name; ?></td>
                          <?php foreach ($data as $key => $value) { ?>
                            <td><?php echo $value['total_count']; ?></td>
                         <?php } ?>
                        </tr>
                      <?php $id++; } ?>
                    </table>
                    </td>
                  </tr>
                <?php } ?>
                </thead>
              </table>
              </div>
            <?php  }  ?>
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