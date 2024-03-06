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
            <h1>Inquiry Monthwise Report</h1>
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
               <?php foreach($summary as $k => $summary_info) { ?>
                <div class="col-md-12">
                      <?php foreach ($summary_info as $month => $month_report) { ?>


                  <table class="table table-bordered table-hover ">
                    <tr align="center">
                      <th colspan="11" >Faculty Report : <?php echo date('F', mktime(0, 0, 0, $month, 10));?>-<?php echo $k; ?></th>
                    </tr>
                    <tr>
                      <th>Faculty Name</th>
                      <th>Total Inquiry</th>
                      
                      <th>Admission</th>
                      <th>Demo</th>
                      <th>Visited</th>
                      <th>Declined</th>
                      <th>Pending</th>
                      <th>Trans.</th>
                      <th>Admission Ratio</th>
                    </tr>

                            <?php foreach($month_report as $facid => $month_reports){

                          $this->db->where('id',$facid);
                          $admin_data = $this->db->get('admin')->row_array();

                          if($month_reports['A']['total_count']==0){
                              $ratio=0;
                             }else{
                              $ratio = round((100 * $month_reports['A']['total_count']) /$month_reports['total_count'],2) ; 
                             }
                          
                      ?>
                          <tr>
                            <td><?php echo isset($admin_data['name'])? $admin_data['name'] :'No Name'.$facid; ?></td>
                           
                             <?php foreach($month_reports as $total_inq => $report) 
                                  { 
                                      if(is_array($report)){ ?>
                                              <td align="center"><?php echo $report['total_count']; ?></td>
                                        <?php } else { ?>
                                            <td align="center"><?php echo $report; ?></td>
                                        <?php } } ?>
                            <td align="center"><?php echo $ratio; ?> %</td>
                          </tr>
                      <?php } } ?>
                  </table>
                </div>
              <?php } ?>
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