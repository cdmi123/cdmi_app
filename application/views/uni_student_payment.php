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
            <div class="card-header">
              <div class="row">
                <div class="col-2"> 
                  <select class="form-control filter" name="search_by" id="by_keyword">
                    <option value="byname">By Name</option>
                    <option value="byreg">By Reg No</option>
                  </select>
                </div>
                <div class="col-3"> 
                  <input type="text" id="search" placeholder="Type here for search..." name="search_keyword" class="form-control">
                </div>
                <div class="col-2">
                  <select class="form-control filter" name="college_year" id="college_year">
                    <option value="all">Year : ALL</option>
                    <option value="first">First Year</option>
                    <option value="second">Second Year</option>
                    <option value="third">Third Year</option>
                    <option value="fourth">Fourth Year</option>
                  </select>
                </div>
                 
                <div class="col-2">
                  <select class="form-control filter" name="mode" id="mode">
                    <option value="">Mode</option>
                    <option value="REG">Regular</option>
                    <option value="EX">External</option>
                  </select>
                </div>
                <div class="col-2">
                  <select class="form-control filter" name="course_status" id="status">
                    <option value="">Status</option>
                      <option value="R">R</option>
                      <option value="C">C</option>
                      <option value="D">D</option>
                     
                  </select>
                </div>              
                </div>
                <div class="row mt-2">
                  <div class="col-2">
                  <select class="form-control filter" name="college_course" id="college_course">
                    <option value="">Course</option>
                    <?php
                      foreach ($college_course as $c_data)
                      {
                    ?>
                    <option value="<?php echo $c_data['course_name'] ?>"><?php echo $c_data['course_name'] ?></option>
                    <?php
                      }
                    ?>
                  </select>
                </div>
                <div class="col-2">
                  <select class="form-control filter" name="university" id="college_course">
                    <option value="">University</option>
                      <?php
                      foreach ($college_university as $s_data)
                      {
                      ?>
                      <option value="<?php echo $s_data['code']; ?>"><?php echo $s_data['code'] ?></option>
                      <?php
                      }
                      ?>
                  </select>
                </div>
                <div class="col-2">
                  <select class="form-control filter" name="start_session" id="college_course">
                    <option value="">Start Session</option>
                      <?php
                      foreach ($st_session as $s_session)
                      {
                      ?>
                      <option value="<?php echo $s_session['start_session'] ?>"><?php echo $s_session['start_session'] ?></option>
                      <?php
                      }
                      ?>
                  </select>
                </div>

                <div class="col-2">
                  <select class="form-control filter" name="end_session" id="college_course">
                    <option value="">End Session</option>
                      <?php
                      foreach ($en_session as $e_session)
                      {
                      ?>
                      <option value="<?php echo $e_session['end_session'] ?>"><?php echo $e_session['end_session'] ?></option>
                      <?php
                      }
                      ?>
                  </select>
                </div>
                <div class="col-2 text-center text-bold">
                  Found Results: 
                  <span id="found_results"><?php echo $found_results;?></span>
                </div>
                </div>
              </form>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover table-font">
                <thead>
                <tr>
                  <th>REG NO</th>
                  <th>STUDENT NAME</th>
                  <th>COURSE</th>
                  <th>UNI.</th>
                  <th>SESSION</th>
                  <th>COLLEGE FEES</th>
                  <th>CERTIFICATE</th>
                  <th>EXAM</th>
                  <th>ACTION</th>
                </tr>
                </thead>
                <tbody id="example3">
                <?php 
                  foreach ($adm_data as $info)
                  {

                    $college_fees = $this->Admin_model->get_total_uni_fees_by_student($info['regno'],'regular');
                    
                    $exam_fees = $this->Admin_model->get_total_uni_fees_by_student($info['regno'],'exam');
                    $certificate_fees = $this->Admin_model->get_total_uni_fees_by_student($info['regno'],'certificate');
                ?>
                <tr>
                  <td><?php echo $info['regno']?></td>
                  <td><?php echo $info['student_name']?></td>
                  <td><?php echo $info['college_course'];?> <?php echo !empty($info['course_stream']) ? ' - '.$info['course_stream'] : "";?></td>
                  <td><?php echo $info['university']?></td>
                  <td><?php echo $info['start_session'].'-'.$info['end_session'];?></td>
                  <td><?php echo isset($college_fees['total_amount']) ? $college_fees['total_amount'] : 0;?>/-</td>
                  <td><?php echo isset($certificate_fees['total_amount']) ? $certificate_fees['total_amount'] : 0;?>/-</td>
                  <td><?php echo isset($exam_fees['total_amount']) ? $exam_fees['total_amount'] : 0;?>/-</td>
                  <td>
                    <a href="<?php echo site_url('College_admission/view_student/'.$info['regno']);?>" class="btn btn-primary btn-xs m-1"><i class="fas fa-eye"></i></a>
                    <a href="<?php echo site_url('add-uni-payment/add/'.$info['regno']);?>" class="btn btn-primary btn-xs m-1"> <i class="fas fa-plus"></i></a></td>
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
    <section class="content-footer">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div class="card-footer small text-muted pagination-holder"><?php echo $pagination; ?></div>
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
          $('#found_results').text(data.found_results);
        }
      });
      return false;
    });
       $('.filter').change(function(){
          var formData = $('#search_form').serialize();
          
        $.ajax({
          type:"POST",
          url:"<?php echo site_url('Admin/ajax_search_uni_payment');?>",
          data:formData,
          dataType:"json",
          success:function(data){
            $('#example3').html(data.data);
            $('.pagination-holder').html(data.pagination);
            $('#found_results').text(data.found_results);
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
                url:"<?php echo site_url('Admin/ajax_search_uni_payment');?>",
                data:formData,
                dataType:"json",
                success:function(data){
                  $('#example3').html(data.data);
                  $('.pagination-holder').html(data.pagination);
                  $('#found_results').text(data.found_results);
                }
               })

                }, doneTypingInterval); 
          
        });


   })
</script>