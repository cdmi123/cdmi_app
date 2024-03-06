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
            <h1>Exam Fees List</h1>
          </div>
          <div class="col-sm-6">
            <div class="row">
              <div class="col-8">
              </div>
              <div class="col-4">
                <a href="<?php echo site_url('College_fees/index')?>" class="btn btn-primary btn-block my-1"><i class="fas fa-plus"></i> Add Fees</a>
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
            <input type="hidden" name="fees_type" value="exam">
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
                  <option value="byname">Search By Name</option>
                  <option value="byrec">Search By Receipt</option>
                  <option value="byreg">Search By Reg No</option>
                </select>
                <div class="col-3"> 
                  <input type="text" id="search" placeholder="Type here for search..." name="search_keyword" class="form-control">
                </div>
                <div class="col-2">
                  <select class="form-control filter" name="year" id="year">
                    <option value="">Search By Year</option>
                    <option value="2017">2017</option>
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
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
                  <a href="<?php echo site_url('College_fees/export_exam_fees');?>" class="btn btn-primary " style="color: white"><i class="fa fa-file-excel" aria-hidden="true"></i></a>
                </div>
              </form>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover table-font">
                <thead>
                <tr>
                  <th>REC NO</th>
                  <th>REG NO</th>
                  <th>STUDENT NAME</th>
                  <th>COURSE</th>
                  <th>AMOUNT</th>
                  <th>INST NO</th>
                  <th>PAY MODE <div style="border-top: solid 1px black;margin-top: 5px">DETAILS</th>
                  <th>DATE</th>
                  <th>ACTION</th>
                </tr>
                </thead>
                <tbody id="example3">
                <?php 
                foreach ($fees_data as $info)
                {
                ?>
                <tr>
                  <td><?php echo $info['rec_no']?></td>
                  <td><?php echo $info['reg_no']?></td>
                  <td><?php echo $info['student_name']?></td>
                  <td><?php echo $info['course']?></td>
                  <td><?php echo $info['amount']?>/-</td>
                  <td><?php echo $info['installment_no'];?></td>
                  <td><?php echo $info['pay_mode'];?><div style="border-top: solid 1px black;margin-top: 5px"></div><?php echo $info['payment_detail'];?></td>
                  <td><?php echo getSimpleDate( $info['date']);?></td>
                  <td>
                    <a href="<?php echo site_url('College_fees/index/update/'.$info['id'].'/exam');?>" class="btn btn-primary btn-sm m-1"><i class="fas fa-edit"></i></a>
                    <a href="<?php echo site_url('College_fees/print_receipt/'.$info['fees_type'].'/'.$info['id']);?>" class="btn btn-primary btn-sm m-1"><i class="fas fa-print"></i></a>
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
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
           <div class="col-sm-12">
                <div class="card-footer small text-muted pagination-holder">
                  <?php echo $pagination; ?>
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
    $(document).on("click",'.pagination > a',function(e){
      e.preventDefault();
      if($(this).attr('href')=="" || $(this).attr('href') ==null || $(this).attr('href')=="#"){
        return false;
      }
      //console.log($(this).attr('href'));return false;
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
    $('.filter').change(function(){
      var formData = $('#search_form').serialize();
      $.ajax({
        type:"POST",
        url:"<?php echo site_url('College_fees/fees_rec');?>",
        data:formData,
        dataType:"json",
        success:function(data){
            $('#example3').html(data.data);
          $('.pagination-holder').html(data.pagination);
        }
      });
    });
    var typingTimer;                //timer identifier
    var doneTypingInterval = 1000;
    $('#search').keyup(function(){
      clearTimeout(typingTimer);
      
        var formData = $('#search_form').serialize();
        typingTimer = setTimeout(function(){
          $.ajax({
            type:"POST",
            url:"<?php echo site_url('College_fees/fees_rec');?>",
            data:formData,
            dataType:"json",
            success:function(data){
              $('#example3').html(data.data);
              $('.pagination-holder').html(data.pagination);
            }
          })
        }, doneTypingInterval); 
      
    });
  })
</script>