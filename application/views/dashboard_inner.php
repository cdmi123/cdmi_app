<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('header');
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <!-- <div class="col-lg-3 col-6">
            
            <div class="small-box bg-success">
              <div class="inner">
                <h5>Course: <?php //echo $course_total;?>/-</h5>
                <div class="row">
                  <div class="col-6">
                    <small>Cash: <?php //echo @$today_collection_cash;?>/-</small>    
                  </div>
                  <div class="col-6">
                    <small>Other: <?php //echo @$today_collection_online;?>/-</small>   
                  </div>
                </div>
                <hr>
                <h6><?php //echo date('d-m-Y');?></h6>
                <p>Course Collection</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php //echo site_url('fees/view_fees');?>" class="small-box-footer">View Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> -->
          
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <!-- <div class="small-box bg-success">
              <div class="inner">
                <h5>Tution: <?php //echo @$clg_total;?>/-</h5>
                <div class="row">
                  <div class="col-6">
                    <small>Cash: <?php //echo @$today_collection_clg_cash;?>/-</small>    
                  </div>
                  <div class="col-6">
                    <small>Other: <?php //echo @$today_collection_clg_online;?>/-</small>  
                  </div>
                </div>
                <hr>
                <h6><?php //echo date('d-m-Y');?></h6>
                <p>Tution Collection</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="<?php //echo site_url('college_fees/view_college_fees');?>" class="small-box-footer">View Details <i class="fas fa-arrow-circle-right"></i></a>
            </div> -->
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <!-- <div class="small-box bg-success">
              <div class="inner">
                <h5>Exam: <?php //echo $exam_total;?>/-</h5>
                <div class="row">
                  <div class="col-6">
                    <small>Cash: <?php //echo @$today_collection_exam_cash;?>/-</small>    
                  </div>
                  <div class="col-6">
                    <small>Other: <?php //echo @$today_collection_exam_online;?>/-</small>  
                  </div>
                </div>
                <hr>
                <h6><?php //echo date('d-m-Y');?></h6>
                <p>Exam Collection</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="<?php //echo site_url('college_fees/view_exam_fees');?>" class="small-box-footer">View Details <i class="fas fa-arrow-circle-right"></i></a>
            </div> -->
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <!-- <div class="small-box bg-success">
              <div class="inner">
                <h5>Certificate: <?php //echo @$certificate_total;?>/-</h5>
                <div class="row">
                  <div class="col-6">
                    <small>Cash: <?php //echo @$today_collection_cert_cash;?>/-</small>    
                  </div>
                  <div class="col-6">
                    <small>Other: <?php //echo @$today_collection_cert_online;?>/-</small>  
                  </div>
                </div>
                <hr>
                <h6><?php //echo date('d-m-Y');?></h6>
                <p>Certificate Collection</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="<?php //echo site_url('college_fees/view_certificate_fees');?>" class="small-box-footer">View Details <i class="fas fa-arrow-circle-right"></i></a>
            </div> -->
          </div>
        </div>
        <!-- /.row -->
        <div class="row">
          <!-- <div class="col-lg-3 col-6">
            
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo @$cnt;?></h3> 
                <p>Today Course Visit</p>
              </div>
              <div class="icon">
                <i class="ion ion-help"></i>
              </div>
              <a href="<?php echo site_url('inquiry/today_followup')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          <div class="col-lg-3 col-6">
            
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $due_inq;?></h3>
                <p>Due Course Visit</p>
              </div>
              <div class="icon">
                <i class="ion ion-help"></i>
              </div>
              <a href="<?php echo site_url('inquiry/due_followup')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          <div class="col-lg-3 col-6">
            
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $scl_today;?></h3>
                <p>Today School Visit</p>
              </div>
              <div class="icon">
                <i class="ion ion-help"></i>
              </div>
              <a href="<?php echo site_url('schoolinq/today_followup')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          <div class="col-lg-3 col-6">
            
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $scl_due;?></h3>
                <p>Due School Visit</p>
              </div>
              <div class="icon">
                <i class="ion ion-help"></i>
              </div>
              <a href="<?php echo site_url('schoolinq/due_followup')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> -->
          
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
         <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Batchwise Students</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-font">
                  <thead>                  
                    <tr>
                      <th width="40px">#</th>
                      <th>Batch</th>
                      <th>PC</th>
                      <th>Laptop</th>
                      <th>Total</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $pc_total = 0;
                    $lap_total =0;
                    $batch_total=0;
                    foreach($batch_times as $key=>$batch){
                      $qry_pc =  $this->db->query("SELECT COUNT(id) as batch_stds FROM admission WHERE status='R' and sitting='PC' and (pcno like 'DES%' or pcno like 'DEV%' ) and FIND_IN_SET('".$batch['batch']."',batch_time) "); 
                      $pc_stds = $qry_pc->row_array();
                      $qry_lap =  $this->db->query("SELECT COUNT(id) as batch_stds FROM admission WHERE status='R' and sitting='LAPTOP' and FIND_IN_SET('".$batch['batch']."',batch_time) "); 
                      $lap_stds = $qry_lap->row_array();
                      //pre($pc_stds);die;
                      $pc_total += $pc_stds['batch_stds'];
                      $lap_total += $lap_stds['batch_stds'];
                      $batch_total = $pc_stds['batch_stds']+$lap_stds['batch_stds'];
                    ?>
                    <tr>
                      <td><?php echo $key+1;?></td>
                      <td><?php echo $batch['batch'];?></td>
                      <td><?php echo $pc_stds['batch_stds'];?></td>
                      <td><?php echo $lap_stds['batch_stds'];?></td>
                      <td><?php echo $batch_total;?></td>
                      <td><a class="btn btn-xs btn-primary" href="<?php echo site_url('Dashboard/seating/'.$batch['id']);?>"><i class="fas fa-eye"></i></a></td>
                    </tr>
                    <?php }?>
                    <tr>
                      <th width="40px">#</th>
                      <th>Total</th>
                      <th><?php echo $pc_total;?></th>
                      <th><?php echo $lap_total;?></th>
                      <th><?php echo ($pc_total+$lap_total);?></th>
                      <th></th>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
         
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <?php
    $this->load->view('footer');
  ?>