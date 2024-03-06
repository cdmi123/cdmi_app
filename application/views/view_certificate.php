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
            <h1>Certificate List</h1>
          </div>
          <div class="col-sm-6">
            <div class="row">
              <div class="col-8">
              </div>
              <div class="col-4">
                <a href="<?php echo site_url('Cert/add_certificate')?>" class="btn btn-primary btn-block my-1"><i class="fas fa-plus"></i> Add Certificate</a>
              </div>
            </div>
          </div>
        </div>
        <div class="row mb-2">
           <div class="col-sm-12">
              <div class="card-footer small text-muted pagination-holder"><?php echo $pagination; ?></div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
          <form method="post" id="search_form">
            <input type="hidden" name="fees_type" value="certificate">
            <div class="card-header">
              <div class="row">
                <select class="form-control col-1 filter" name="perpage">
                  <option value="10" <?php if($perpage==10){echo 'selected';}?>>10</option>
                  <option value="20" <?php if($perpage==20){echo 'selected';}?>>20</option>
                  <option value="30" <?php if($perpage==30){echo 'selected';}?>>30</option>
                  <option value="40" <?php if($perpage==40){echo 'selected';}?>>40</option>
                  <option value="50" <?php if($perpage==50){echo 'selected';}?>>50</option>
                  <option value="100" <?php if($perpage==100){echo 'selected';}?>>100</option>
                </select>
                <select class="form-control col-2 filter" name="search_by" id="by_keyword">
                  <option value="student_name">Search By Name</option>
                  <option value="certificate_no">Search By Certificate_no</option>
                  <option value="ref_by">Search By Ref Name</option>
                </select>
                <div class="col-3"> 
                  <input type="text" id="search" placeholder="Type here for search..." name="search_keyword" class="form-control">
                </div>
                <div class="col-2">
                  <select class="form-control filter" name="year" id="year">
                    <option value="">Search By Year</option>
                    <?php 
                    $c_year = date('Y');
                    for($y=$c_year;$y>=2017;$y--){
                    ?>
                    <option value="<?php echo $y; ?>"><?php echo $y; ?></option>
                    <?php }?>
                  </select>
                 </div>
                 <div class="col-2">
                  <select class="form-control filter" name="month" id="month">
                    <option value="">Search By Month</option>
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                  </select>
                 </div>
                <div class="col-2">
                  <a href="<?php echo site_url('College_fees/export_cert_fees');?>" class="btn btn-primary " style="color: white"><i class="fa fa-file-excel" aria-hidden="true"></i></a>
                </div>
              
              </form>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover table-font">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>certificate_no</th>
                  <th>STUDENT NAME</th>
                  <th>certificate_name</th>
                  <th>AMOUNT</th>
                  <th>payment_detail</th>
                  <th>ref_by</th>
                  <th>from_date</th>
                  <th>to_date</th>
                  <th>created_date</th>
                </tr>
                </thead>
                <tbody id="example3">
                    <?php foreach ($certi_data as $Data) { ?>
                    <tr>
                      <td><?php echo $Data['id']; ?></td>
                      <td><?php echo $Data['certificate_no']; ?></td>
                      <td><?php echo $Data['student_name']; ?></td>
                      <td><?php echo $Data['certificate_name']; ?></td>
                      <td><?php echo $Data['amount']; ?></td>
                      <td><?php echo $Data['payment_detail']; ?></td>
                      <td><?php echo $Data['ref_by']; ?></td>
                      <td><?php echo getSimpleDate($Data['from_date']); ?></td>
                      <td><?php echo getSimpleDate($Data['to_date']); ?></td>
                      <td><?php echo getSimpleDate($Data['created_date']); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
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
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
           <div class="col-sm-12">
                <div class="card-footer small text-muted pagination-holder">
                  <?php echo @$pagination; ?>
                </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
  </div>
 

 <?php
  $this->load->view('footer');
 ?>


<script type="text/javascript">
  $(document).ready(function(){

    var typingTimer;                //timer identifier
    var doneTypingInterval = 1000;

    $('#month,#year').change(function(){
      clearTimeout(typingTimer);
        var formData = $('#search_form').serialize();
        typingTimer = setTimeout(function(){
          $.ajax({
            type:"POST",
            url:"<?php echo site_url('Cert/search_data');?>",
            data:formData,
            dataType:"json",
            success:function(data){
              $('#example3').html(data.data);
              $('.pagination-holder').html(data.pagination);
            }
          })
        }, doneTypingInterval); 

    });

    
    $('#search').keyup(function(){
      clearTimeout(typingTimer);
        var formData = $('#search_form').serialize();
        typingTimer = setTimeout(function(){
          $.ajax({
            type:"POST",
            url:"<?php echo site_url('Cert/search_data');?>",
            data:formData,
            dataType:"json",
            success:function(data){
              $('#example3').html(data.data);
              $('.pagination-holder').html(data.pagination);
            }
          })
        }, doneTypingInterval); 
    });

    $(document).on("click",'.pagination > a',function(e){
      e.preventDefault();
      if($(this).attr('href')=="" || $(this).attr('href') ==null || $(this).attr('href')=="#"){
        return false;
      }
      
      var formData = $('#search_form').serialize();
      $.ajax({
        type:"POST",
        url:$(this).attr('href'),
        data:formData,
        beforeSend:function(){
          $('.process-loader').show();
        },
        complete:function(){
          $('.process-loader').hide();
        },
        dataType:"json",
        success:function(data){         
          $('#example3').html(data.data);
          $('.pagination-holder').html(data.pagination);
        }
      });
      //return false;
    });
  })
 
</script>