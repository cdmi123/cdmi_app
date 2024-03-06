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
                <div class="col-md-6">
                  <table class="table table-bordered table-hover ">
                    <tr align="center">
                      <th colspan="5" >Report Followup: <?php echo date('F-Y')?></th>
                    </tr>
                    <tr>
                      <th>Day</th>
                      <th>Col 1</th>
                      <th>Col 2</th>
                      <th>Col 3</th>
                    </tr>
                    <?php 
                    $grand_col1 = 0;
                    $grand_col2 = 0;
                    $grand_col3 = 0;
                    
                    foreach($all_data as $k=>$month){ 
                      $grand_col1 +=$month['column1'];
                      $grand_col2 +=$month['column2'];
                      $grand_col3 +=$month['column3'];
                     
                    ?>
                    <tr>
                      <td><?php echo date($k."-M-Y");?></td>
                      <td><?php echo $month['column1'];?></td>
                      <td><?php echo $month['column2'];?></td>
                      <td><?php echo $month['column3'];?></td>
                     
                    </tr>
                    <?php }?>
                    <tr>
                      <th>Grand Total</th>
                      <th><?php echo $grand_col1;?></th>
                      <th><?php echo $grand_col2;?></th>
                      <th><?php echo $grand_col3;?></th>
                      
                    </tr>
                  </table>
                </div>
               
                 
                 
              
              
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