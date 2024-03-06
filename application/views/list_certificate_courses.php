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
            <h1>Certificate Courses</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
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
            <!-- <div class="card-header">
              <h3 class="card-title">DataTable with minimal features & hover style</h3>
            </div> -->
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Courses Name</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                    if(count($certificate_courses) >0){
                      foreach($certificate_courses as  $course){
                    ?>
                      <tr>
                        <td><?php echo $course['id'];?></td>
                        <td><?php echo $course['course_name'];?></td>
                        <td><?php if($course['status']==1){echo 'Active';}else{echo 'In-Active';}?></td>
                        <td>
                          <a href="<?php echo site_url('certificate/delete_certificate_courses/'.$course['id']); ?>" onclick="return confirm('Are you sure?');"><i class="fas fa-trash" aria-hidden="true"></i></a> 
                          || 
                          <a href="<?php echo site_url('certificate/add_certificate_courses/'.$course['id']);?>">&nbsp;<i class="fas fa-edit" aria-hidden="true"></i></a>
                        </td>
                      </tr>
                    <?php 
                      }
                    }else{
                    ?>
                      <tr><td colspan="9">No records found.</td></tr>
                    <?php
                    }
                    ?>
                  </tbody>
                <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Courses Name</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
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
<script type="text/javascript" src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js');?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
 <script>
  $(function () {

    $('#example2').DataTable({
      
    });
  });
</script>
 