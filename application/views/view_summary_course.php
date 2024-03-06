<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('header');
?>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Summary Report</h1>
          </div>
          <div class="col-sm-6">
            
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Content Header (Page header) -->
    

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
        
            <div class="card-header">
              <div class="row">
                
             
                <?php 
                foreach($summary as $key=>$year){
                ?>
                <div class="col-md-6">
                  <table class="table table-bordered table-hover ">
                    <tr align="center">
                      <th colspan="5" >Report-<?php echo $key;?></th>
                    </tr>
                    <tr>
                      <th>Month</th>
                      <th>Amount</th>
                      <th>Refund</th>
                      <th>Allowance</th>
                      <th>Adm</th>
                      <th>Drop</th>
                    </tr>
                    <?php 
                    $grand_amount = 0;
                    $grand_refund = 0;
                    $grand_allowance = 0;
                    $grand_admission = 0;
                    $grand_drop = 0;
                    foreach($year as $k=>$month){ 
                      $grand_amount +=$month['total_amount'];
                      $grand_admission +=$month['total_admission'];
                      $grand_refund +=$month['total_refund'];
                      $grand_allowance +=$month['total_allowance'];
                      $grand_drop +=$month['total_drop'];
                    ?>
                    <tr>
                      <td><?php echo date("F", strtotime($key."-".$k.'-1'));?></td>
                      <td><?php echo $month['total_amount'];?></td>
                      <td><?php echo $month['total_refund'];?></td>
                      <td><?php echo $month['total_allowance'];?></td>
                      <td><?php echo $month['total_admission'];?></td>
                      <td><?php echo $month['total_drop'];?></td>
                    </tr>
                    <?php }?>
                    <tr>
                      <th>Grand Total</th>
                      <th><?php echo $grand_amount;?></th>
                      <th><?php echo $grand_refund;?></th>
                      <th><?php echo $grand_allowance;?></th>
                      <th><?php echo $grand_admission;?></th>
                      <th><?php echo $grand_drop;?></th>
                    </tr>
                  </table>
                </div>
                <?php 
                }
                ?>
                 
                 
              
              
              </div>
            </div>
            </div>
            <!-- /.card-header -->
            
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