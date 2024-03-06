<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('header');
$role = $this->session->userdata('user_role');
?>

  <!-- Content Wrapper. Contains page content -->

  <?php if($role==1 || $role==7 ) { ?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Collage Dashboard</h1>
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
        <div class="row row-cols-2 row-cols-lg-6">
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>FY - Class A</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-attendence/first/A'); ?>" class="small-box-footer">More Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>FY - Class B</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-attendence/first/B'); ?>" class="small-box-footer">More Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>FY - Class C</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-attendence/first/C'); ?>" class="small-box-footer">More Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>FY - Class D</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-attendence/first/D'); ?>" class="small-box-footer">More Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>FY - Class E</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-attendence/first/E'); ?>" class="small-box-footer">More Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>FY - Class F</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-attendence/first/F'); ?>" class="small-box-footer">More Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>FY - Class G</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-attendence/pre/G'); ?>" class="small-box-footer">More Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>FY - Class H</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-attendence/pre/H'); ?>" class="small-box-footer">More Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        
        <div class="row row-cols-2 row-cols-lg-5">
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>SY - Class A</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-attendence/second/A'); ?>" class="small-box-footer">More Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>SY - Class B</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-attendence/second/B'); ?>" class="small-box-footer">More Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>SY - Class C</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-attendence/second/C'); ?>" class="small-box-footer">More Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>SY - Class D</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-attendence/second/D'); ?>" class="small-box-footer">More Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>SY - Class E</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-attendence/second/E'); ?>" class="small-box-footer">More Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>SY - Class F</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-attendence/second/F'); ?>" class="small-box-footer">More Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        
        <!-- /.row -->
         <!-- Small boxes (Stat box) -->
        <div class="row row-cols-2 row-cols-lg-5">
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>TY - Class A</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-attendence/third/A'); ?>" class="small-box-footer">More Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>TY - Class B</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-attendence/third/B'); ?>" class="small-box-footer">More Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>TY - Class C</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-attendence/third/C'); ?>" class="small-box-footer">More Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>TY - Class D</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-attendence/third/D'); ?>" class="small-box-footer">More Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>TY - Class E</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-attendence/third/E'); ?>" class="small-box-footer">More Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        
        <!-- /.row -->
       
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <!-- Exam Dashbord Start -->

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Exam Report</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      
        <!-- Small boxes (Stat box) -->
        <div class="row row-cols-2 row-cols-lg-5">
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>FY - Class A</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-Exam-Report/first/A'); ?>" class="small-box-footer">Download Exam Report  <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>FY - Class B</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-Exam-Report/first/B'); ?>" class="small-box-footer">Download Exam Report  <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>FY - Class C</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-Exam-Report/first/C'); ?>" class="small-box-footer">Download Exam Report  <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>FY - Class D</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-Exam-Report/first/D'); ?>" class="small-box-footer">Download Exam Report  <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>FY - Class E</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-Exam-Report/first/E'); ?>" class="small-box-footer">Download Exam Report  <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
            <!-- ./col -->
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>FY - Class F</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-Exam-Report/first/F'); ?>" class="small-box-footer">Download Exam Report  <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>

             <!-- ./col -->
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>FY - Class G</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-Exam-Report/first/G'); ?>" class="small-box-footer">Download Exam Report  <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>

        </div>
        
        <!-- /.row -->
         <!-- Small boxes (Stat box) -->
        <div class="row row-cols-2 row-cols-lg-5">
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>SY - Class A</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-Exam-Report/second/A'); ?>" class="small-box-footer">Download Exam Report  <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>SY - Class B</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-Exam-Report/second/B'); ?>" class="small-box-footer">Download Exam Report  <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>SY - Class C</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-Exam-Report/second/C'); ?>" class="small-box-footer">Download Exam Report  <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>SY - Class D</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-Exam-Report/second/D'); ?>" class="small-box-footer">Download Exam Report  <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>SY - Class E</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-Exam-Report/second/E'); ?>" class="small-box-footer">Download Exam Report  <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
           <!-- ./col -->
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>SY - Class F</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-Exam-Report/second/F'); ?>" class="small-box-footer">Download Exam Report  <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
        </div>
        
        <!-- /.row -->
         <!-- Small boxes (Stat box) -->
        <div class="row row-cols-2 row-cols-lg-5">
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>TY - Class A</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-Exam-Report/third/A'); ?>" class="small-box-footer">Download Exam Report  <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>TY - Class B</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-Exam-Report/third/B'); ?>" class="small-box-footer">Download Exam Report  <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>TY - Class C</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-Exam-Report/third/C'); ?>" class="small-box-footer">Download Exam Report  <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>TY - Class D</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-Exam-Report/third/D'); ?>" class="small-box-footer">Download Exam Report  <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>TY - Class E</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-Exam-Report/third/E'); ?>" class="small-box-footer">Download Exam Report  <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
        </div>
        
        <!-- /.row -->
       
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

  </div>



  <?php } else { ?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">College Dashboard</h1>
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
        <div class="row row-cols-2 row-cols-lg-6">
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>FY - Class A</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-attendence/first/A'); ?>" class="small-box-footer">More Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>FY - Class B</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-attendence/first/B'); ?>" class="small-box-footer">More Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>FY - Class C</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-attendence/first/C'); ?>" class="small-box-footer">More Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>FY - Class D</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-attendence/first/D'); ?>" class="small-box-footer">More Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>FY - Class E</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-attendence/first/E'); ?>" class="small-box-footer">More Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>FY - Class F</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-attendence/first/F'); ?>" class="small-box-footer">More Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>FY - Class G</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-attendence/pre/G'); ?>" class="small-box-footer">More Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>FY - Class H</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-attendence/pre/H'); ?>" class="small-box-footer">More Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        
        <div class="row row-cols-2 row-cols-lg-5">
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>SY - Class A</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-attendence/second/A'); ?>" class="small-box-footer">More Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>SY - Class B</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-attendence/second/B'); ?>" class="small-box-footer">More Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>SY - Class C</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-attendence/second/C'); ?>" class="small-box-footer">More Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>SY - Class D</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-attendence/second/D'); ?>" class="small-box-footer">More Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>SY - Class E</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-attendence/second/E'); ?>" class="small-box-footer">More Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>SY - Class F</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-attendence/second/F'); ?>" class="small-box-footer">More Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        
        <!-- /.row -->
         <!-- Small boxes (Stat box) -->
        <div class="row row-cols-2 row-cols-lg-5">
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>TY - Class A</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-attendence/third/A'); ?>" class="small-box-footer">More Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>TY - Class B</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-attendence/third/B'); ?>" class="small-box-footer">More Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>TY - Class C</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-attendence/third/C'); ?>" class="small-box-footer">More Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>TY - Class D</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-attendence/third/D'); ?>" class="small-box-footer">More Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>TY - Class E</h5>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('student-attendence/third/E'); ?>" class="small-box-footer">More Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        
        <!-- /.row -->
       
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  <?php } ?>

  <?php
    $this->load->view('footer');
  ?>