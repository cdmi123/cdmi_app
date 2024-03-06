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
                <a href="<?php echo site_url('admin/index')?>" class="btn btn-primary btn-block my-1"><i class="fas fa-plus"></i>  Add Staff Member</a>
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
            <form method="post" id="search_form" onsubmit="return false;">
              <div class="card-header">
                <div class="small text-muted pagination-holder"><?php //echo $pagination; ?></div>
               
                <div class="row mt-2">
                  <div class="form-group col-2">
                    <select class="form-control select2 filter" name="staff_id" id="staff_id" data-placeholder="By Faculty">
                      <?php 
                      foreach($faculty as $fac){
                      ?>
                      <option value="<?php echo $fac['id'];?>"><?php echo $fac['name'];?></option>
                      <?php }?>
                    </select>
                  </div>
                  
                  <div class="col-2">
                    <select class="form-control filter select2" name="year" id="year" data-placeholder="Search By Year">
                      <option value="">Select year</option>
                      <?php 
                      for($i=START_YEAR;$i<=date("Y");$i++)
                      {
                      ?>
                      <option value="<?php echo $i;?>" <?php if($i==date('Y')){echo 'selected';} ?>><?php echo $i;?></option>
                      <?php 
                      }
                      ?>
                    </select>
                  </div>
                   <div class="col-2">
                    <select class="form-control filter" name="month" id="month">
                      <option value="">Select Month</option>
                      <?php 
                      for($i=1;$i<=12;$i++)
                      {
                      ?>
                      <option value="<?php echo $i;?>" <?php if($i==date('n')){echo 'selected';} ?>><?php echo $i;?></option>
                      <?php 
                      }
                      ?>
                    </select>
                   </div>
                   <div class="col-6 text-center text-bold">
                    
                    <span id="found_results"></span>
                   </div>
                </div>
              </div>
            </form>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Date</th>
                  <th>In-Time</th>
                  <th>Out-Time</th>
                  <th>Work Hours</th>
                </tr>
                </thead>
                <tbody id="example2">
                <?php 
                foreach ($punchData as $info)
                {
                ?>
                <tr>
                  <th><?php echo $info['id']?></th> 
                  <th><?php echo $info['name']?></th>
                  <th><?php echo getSimpleDate($info['date']);?></th>
                  <th><?php echo $info['inTime']?></th>
                  <th><?php echo $info['outTime']?></th>
                  <th><?php echo $info['work_hours'];?></th>
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
 <script type="text/javascript">
  $(document).ready(function(){
    setTimeout(function(){
      $('#staff_id').trigger('change');
    },200)
    $('.filter').change(function(){
      var formData = $('#search_form').serialize();
      $.ajax({
        type:"POST",
        url:"<?php echo site_url('Realtime/ajax_staff_report');?>",
        data:formData,
        beforeSend:function(){
          $('.process-loader').show();
        },
        complete:function(){
          $('.process-loader').hide();
        },
        dataType:"json",
        success:function(data){
          $('#example2').html(data.html);
          $('#found_results').text(data.days_string);
         // $('.pagination-holder').html(data.pagination);
        }
      });
    });
    $('.select2').select2({
      theme: 'bootstrap4'
    })
    
      
    
  })
  
 </script>