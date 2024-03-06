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
                <a href="<?php echo site_url('Salary/add_salary')?>" class="btn btn-primary btn-block my-1"><i class="fas fa-plus"></i>  Add Salary</a>
              </div>
            </div>
            <h1>Salary List</h1>
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
                  <th>Name</th>
                  <th>Amount</th>
                  <th>Payment Mode</th>
                  <th>Description</th>
                  <th>Tax</th>
                  <th>Deduction</th>
                  <th>Extra Deduction</th>
                  <th>Payble Amount</th>
                  <th>Salary Month</th>
                  <th>Salary Date</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                  foreach ($arr as $info)
                   {
                ?>
                <tr>
                  <td><?php echo $info['id']?></tdtd> 
                  <td><?php echo $info['emp_name']?></td>
                  <td><?php echo $info['total_salary']?></td>
                  <td><?php echo $info['payment_mode']?></td>
                  <td><?php echo $info['description']?></td>
                  <td><?php echo $info['tax']?></td>
                  <td><?php echo $info['deposit']?></td>
                  <td><?php echo $info['extra_deduction']?></td>
                  <td><?php echo $info['payable_salary']?></td>
                  <td><?php echo $info['salary_month']?></td>
                  <td><?php echo $info['date']?></td>
                  <td>
                    <a class="btn btn-primary btn-xs m-1" href="<?php echo site_url('Salary/add_salary/'.$info['id']);?>">
                      <i class="fas fa-edit"></i>
                    </a>
                    <a class="btn btn-primary btn-xs m-1" href="<?php echo site_url('Salary/salary_delete/'.$info['id']);?>" onclick="return confirm('Are you sure?')">
                      <i class="fas fa-trash"></i>
                    </a>
                    <a href="<?php echo site_url('Salary/print_salary/'.$info['id']);?>" class="btn btn-primary btn-xs m-1"> <i class="fas fa-print"></i></a>
                  </td>
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