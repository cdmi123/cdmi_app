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
           <div class="col-sm-12">
                <div class="card-footer small text-muted"><?php echo $this->pagination->create_links(); ?></div>
        
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
            <div class="card-header">
              <div class="row">
                <select class="form-control col-3" name="search_by" id="by_keyword">
              
                  <option value="byrec">Search By Reciept</option>
                  <option value="byreg">Search By Reg No</option>
                </select>
                <div class="col-3"> 
                  <input type="text" id="search" name="search_keyword" class="form-control">
                </div>
             

            
                <div class="col-3">
                  <select class="form-control filter" name="year" id="year">
                    <option value="">Search By Year</option>
                    <option value="2017">2017</option>
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                  </select>
                 </div>
                 <div class="col-3">
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
              
              
              </form>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Recepiet No</th>
                  <th>Reg.No</th>
                  <th>Student Name</th>
                  <th>Course</th>
                  <th>Amount</th>
                  <th>Installment No</th>
                  <th>Fees Type</th>
                  <th>Extra Detail</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody id="example3">
                <?php 
                  foreach ($fees_data as $info)
                   {
                ?>
                <tr>
                  <td><?php echo $info['id']?></td>
                  <td><?php echo $info['rec_no']?></td>
                  <td><?php echo $info['reg_no']?></td>
                  <td><?php echo $info['student_name']?></td>
                  <td><?php echo $info['course']?></td>
                  <td><?php echo $info['amount']?></td>
                  <td><?php echo $info['installment_no']?></td>
                  <td><?php echo $info['fees_type']?></td>
                  <td><?php echo $info['extra_detail']?></td>
                  <td><?php echo $info['date']?></td>

                   <th><a href="<?php echo site_url('Fees/index/'.$info['id']);?>">Edit</a></th>

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

       $('.filter').change(function(){
          var formData = $('#search_form').serialize();
          
        $.ajax({
          type:"POST",
          url:"<?php echo site_url('fees/fees_rec');?>",
          data:formData,
          
          success:function(data){
            $('#example3').html(data);
          }
        });
      });


        var typingTimer;                //timer identifier
        var doneTypingInterval = 1000;
      $('#search').keyup(function(){
          clearTimeout(typingTimer);

          if ($('#search').val) 
          {
              var formData = $('#search_form').serialize();
               typingTimer = setTimeout(function(){

               $.ajax({
                type:"POST",
                url:"<?php echo site_url('fees/fees_rec');?>",
                data:formData,
                success:function(data){
               $('#example3').html(data);
                  
                }
               })

                }, doneTypingInterval); 
          }
        });


   })
</script>