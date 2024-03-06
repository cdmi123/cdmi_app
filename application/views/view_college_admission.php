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
          <div class="col-md-8 head-center">
            <h1><?php echo $this->lang->line('view_clg_admission'); ?></h1>
          </div>
          <div class="col-md-4 col-sm-6 ml-auto">
                <a href="<?php echo site_url('add-admission')?>" class="btn btn-primary btn-block my-1"><i class="fas fa-plus"></i> <?php echo $this->lang->line('add_clg_admission'); ?></a>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
          <form method="post" onsubmit="return false;" id="search_form">
            <div class="card-header">
              <div class=" small text-muted pagination-holder"><?php echo $pagination; ?></div>
              <div class="row mt-3"> 
                <div class="col-lg-1 col-md-2 col-3 mt-2">
                  <select class="form-control filter" name="perpage">
                    <option value="10" <?php if($perpage==10){echo 'selected';}?>>10</option>
                    <option value="20" <?php if($perpage==20){echo 'selected';}?>>20</option>
                    <option value="30" <?php if($perpage==30){echo 'selected';}?>>30</option>
                    <option value="40" <?php if($perpage==40){echo 'selected';}?>>40</option>
                    <option value="50" <?php if($perpage==50){echo 'selected';}?>>50</option>
                    <option value="100" <?php if($perpage==100){echo 'selected';}?>>100</option>
                  </select>  
                </div>   
                <div class="col-lg-4 col-md-3 col-9 mt-2">        
                  <select class="form-control filter" name="search_by">
                    <option value="byname">By Name</option>
                    <option value="byno">By Reg No</option>
                    <option value="bycontact">By Contact</option>
                  </select>
                </div>
                <div class="col-lg-4 col-md-7 col-12 mt-2">
                  <input type="text" id="search" name="search_keyword" placeholder="Enter Search Keyword" class="form-control filter"/>
                </div>
                <div class="col-lg-3 col-md-4 col-4 mt-2">
                  <select class="form-control filter" name="college_year" id="college_year">
                    <option value="all">Year : ALL</option>
                    <option value="first">First Year</option>
                    <option value="second">Second Year</option>
                    <option value="third">Third Year</option>
                    <option value="fourth">Fourth Year</option>
                  </select>
                </div>
                 
                <div class="col-lg-2 col-md-4 col-4 mt-2">
                  <select class="form-control filter" name="mode" id="mode">
                    <option value="">Mode</option>
                    <option value="REG">Regular</option>
                    <option value="EX">External</option>
                    <option value="ONLY_CLG">Only College</option>
                  </select>
                 </div>
                 <div class="col-lg-2 col-md-4 col-4 mt-2">
                  <select class="form-control filter" name="course_status" id="status">
                    <option value="">Status</option>
                      <option value="R">Running</option>
                      <option value="C">Completed</option>
                      <option value="D">Drop</option>
                      <option value="L">On Leave</option>
                      <option value="S">Suspend</option>
                      <option value="T">Branch Transfer</option>
                  </select>
                  
                </div>
                
                <div class="col-lg-2 col-md-4 col-4 mt-2">
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
                <div class="col-lg-3 col-md-4 col-4 mt-2">
                  <select class="form-control filter" name="institute_name" id="institute_name">
                    <option value="">Institute</option>
                      <?php
                      foreach ($college_institutes as $i_data)
                      {
                      ?>
                      <option value="<?php echo $i_data['institute_name']; ?>"><?php echo $i_data['institute_name']; ?></option>
                      <?php
                      }
                      ?>
                  </select>
                </div>
                <div class="col-lg-3 col-md-4 col-4 mt-2">
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
                
                <div class="col-lg-2 col-md-4 col-4 mt-2">
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
                <div class="col-lg-2 col-md-5 col-6 mt-2">
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
                <div class="col-lg-2 col-md-5 col-4 mt-2">
                  <select class="form-control filter" name="gender" id="gender">
                    <option value="">Gender - All</option>
                    <option value="MALE" >MALE</option>
                    <option value="FEMALE" >FEMALE</option>
                  </select>
                </div>
                <div class="col-lg-3 col-md-5 col-4 mt-2">
                  <select class="form-control filter" name="division" id="division">
                    <option value="">Division</option>
                      <option value="CLASS A" >CLASS A</option>
                      <option value="CLASS B" >CLASS B</option>
                      <option value="CLASS C" >CLASS C</option>
                      <option value="CLASS D" >CLASS D</option>
                      <option value="CLASS E" >CLASS E</option>
                      <option value="CLASS F" >CLASS F</option>
                      <option value="CLASS G" >CLASS G</option>
                      <option value="CLASS H" >CLASS H</option>
                  </select>
                </div>
                <div class="col-lg-1 col-md-2 col-2 mt-2 text-center text-bold">
                  <!-- <a href="<?php //echo site_url('College_admission/export_data');?>" class="btn btn-primary" style="color: white"><i class="fa fa-file-excel" aria-hidden="true"></i></a> -->
                </div>
                <div class="col-lg-2 col-12 mt-2 head-center justify-content-center text-center text-bold">
                  Found Results: 
                  <span id="found_results"><?php echo $found_results;?></span>
                </div>
                
              </div>
            </div>
            
          </form>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table  class="table table-bordered table-hover table-font" id="example">
                <thead>
                <tr>
                  <th style="width: 50px;">REG NO</th>
                  <th>
                    STUDENT NAME
                    <div style="border-top: solid 1px black;margin-top: 5px"></div>
                    CONTACT NO.
                  </th>
                  <th style="width: 100px;">
                    COURSE 
                    <div style="border-top: solid 1px black;margin-top: 5px"></div>
                    JOIN DATE
                  </th>
                  <th>
                    TOTAL 
                    <div style="border-top: solid 1px black;margin-top: 5px"></div>
                    PAID FEES
                  </th>
                  <th>
                    UNPAID
                    <div style="border-top: solid 1px black;margin-top: 5px"></div>
                    EXAM FEES
                    <div style="border-top: solid 1px black;margin-top: 5px"></div>
                    CERT. FEES
                  </th>
                  <th>
                    LAST AMT. 
                    <div style="border-top: solid 1px black;margin-top: 5px"></div>
                    LAST DATE
                  </th>
                  <th>
                    UNI.
                    <div style="border-top: solid 1px black;margin-top: 5px"></div>
                    SESSION
                  </th>
                  <th>
                    ALLOWANCE
                    <div style="border-top: solid 1px black;margin-top: 5px"></div>
                    REFUND
                  </th>
                  <th>PHOTO</th>
                  <th>STA</th>
                  <th width="90">ACTION</th>
                </tr>
                </thead>
                <tbody id="example2">
                  <?php
                    foreach ($admission_data as $admission)
                    {
                      $paid_allowance = $this->College_fees_model->total_allowance_by_student($admission['regno']);
                      $paid_refund = $this->College_fees_model->total_refund_by_student($admission['regno']);
                      $performance = $this->Exam_model->clg_performance_by_regno($admission['regno']);

                      $this->db->order_by('id','desc');
                      $this->db->where('reg_no',$admission['regno']);
                      $data = $this->db->get('college_fees',1)->row_array();

                      $this->db->select_sum('amount');
                      $this->db->where('reg_no',$admission['regno']);
                      $exam_data = $this->db->get('exam_fees',1)->row_array();
                      //pre($exam_data);die;
                      if(!empty($data)){
                        $last_amt = $data['amount'];
                        $last_date = getSimpleDate($data['date']);
                      }else{
                        $last_amt = 0;
                        $last_date = "00-00-0000";
                      }
                      $paid_certificate_fees = $this->College_admission_model->get_certificate_fees($admission['regno']);
                      $paid_fees = $this->College_admission_model->get_paid_fees($admission['regno']);
                      if(!empty($paid_fees)){
                        $paid = !empty($paid_fees['paid']) ? $paid_fees['paid'] : 0;
                      }else{
                        $paid = 0;
                      }
                        
                      $unpaid = (int) ($admission['total_fees'])- $paid;
                      if($admission['image']!='')
                      {
                        $img = base_url('upload/college_student_photo/'.$admission['image']);
                      }else{
                        $img = base_url('assets/users.jpg');
                      }
                      $class = "color:inherit;";
                      if($admission['status']=="C"){
                        $class = "color:green;";
                      }else if($admission['status']=="D"){
                        $class = "color:red;";
                      }else if ($admission['status']=="S") {
                         $class = "color:orange;";
                      }
                  ?>
                    <tr style="<?php echo $class;?>">
                      <td><?php echo $admission['regno']?></td>
                      <td>
                        <?php echo $admission['student_name']?>
                        <div style="border-top: solid 1px black;margin-top: 5px"></div>
                        <?php echo $admission['personal_mobile_no'] ;?>
                        <?php echo $admission['father_mobile_no'] ? " / ".$admission['father_mobile_no'] : ""; ?>
                        <?php echo $admission['home_mobile_no'] ? " / ".$admission['home_mobile_no'] : ""; ?>
                      </td>
  
                      <td>
                        <?php echo $admission['college_course']?> 
                        <?php if($admission['course_stream']!=""){echo $admission['course_stream'];}?> - <?php echo $admission['college_mode']; ?><?php if($admission['join_date']!=''){?>
                          <div style="border-top: solid 1px black;margin-top: 5px;word-break: break-all;"></div>
                          <?php echo getSimpleDate($admission['join_date']);
                          }?>
                      </td>
                      <td>
                        <?php echo $admission['total_fees']?>/-  
                        <div style="border-top: solid 1px black;margin-top: 5px"></div>
                        <?php echo $paid?>/-
                      </td>
                      <td>
                        <?php echo $unpaid?>/-
                        <div style="border-top: solid 1px black;margin-top: 5px"></div>
                        <?php echo $exam_data['amount'] ? $exam_data['amount'] : 0;?>/-
                        <div style="border-top: solid 1px black;margin-top: 5px"></div>
                        <?php echo $paid_certificate_fees['amount'] ? $paid_certificate_fees['amount'] : 0 ?>/-
                      </td>
                      <td>
                        <?php echo $last_amt;?>/-  
                        <div style="border-top: solid 1px black;margin-top: 5px"></div>
                        <?php echo $last_date;?>
                      </td>  
                      <td>
                        <?php echo $admission['university']; ?>
                        <div style="border-top: solid 1px black;margin-top: 5px"></div>
                        <?php echo $admission['start_session']; ?> - <?php echo $admission['end_session']; ?>
                        <?php if($admission['college_mode']=='REG' && $admission['status']=='R'){?>
                        <div style="border-top: solid 1px black;margin-top: 5px"></div>
                        <?php echo $admission['class_name']; ?> - <?php echo $admission['roll_no']; ?>
                        <?php }?>
                      </td>
                      <td>
                        <?php echo $paid_allowance; ?>/-  
                        <div style="border-top: solid 1px black;margin-top: 5px"></div>
                        <?php echo $paid_refund; ?>/-
                      </td>
                      <td>
                        <img class="img-fluid" src="<?php echo $img;?>" alt="User profile picture" width="45" />
                        <div style="border-top: solid 1px black;margin-top: 5px"></div>
                        <?php echo $performance;?>
                      </td>
                      <td>
                        <a href="javascript:void(0);" class="btn btn-primary btn-xs m-1 update-status" data-status="<?php echo $admission['status'];?>" data-regno="<?php echo $admission['regno'];?>" data-note="<?php echo $admission['status_note'];?>" data-toggle="tooltip" data-placement="top" title="<?php echo $admission['status_note'];?>"><?php echo $admission['status'];?></a>
                        <a href="<?php echo site_url('college_fees/return_fees/add/'.$admission['regno']);?>" class="btn btn-primary btn-xs m-1">Return</a>
                        <a href="<?php echo site_url('college_fees/add_allowance/add/'.$admission['regno']);?>" class="btn btn-primary btn-xs m-1">Allowance</a>
                      </td>
                      <td>
                        <a href="<?php echo site_url('College_admission/update_adm/'.$admission['id'])  ?>" class="btn btn-primary btn-xs m-1"><i class="fas fa-edit"></i></a>
                        <a href="<?php echo site_url('College_admission/view_student/'.$admission['regno']);?>" class="btn btn-primary btn-xs m-1"><i class="fas fa-eye"></i></a>
                        <a href="<?php echo site_url('College_admission/print_form/'.$admission['id']);?>" class="btn btn-primary btn-xs m-1"> <i class="fas fa-print"></i></a>
                        <a href="<?php echo site_url('College_admission/print_exam_form/'.$admission['id']);?>" class="btn btn-primary btn-xs m-1"> <i class="fas fa-graduation-cap"></i></a>
                        <a href="<?php echo site_url('College_fees/index/add/'.$admission['regno']);?>" class="btn btn-primary btn-xs m-1"> <i class="fas fa-plus"></i></a>
                        <a href="javascript:void(0);" data-regno="<?php echo $admission['regno'];?>" class="btn btn-primary btn-xs m-1 exam-report"> <i class="fas fa-laptop-code"></i></a>
                        <a href="javascript:void(0);" data-regno="<?php echo $admission['regno'];?>" class="btn btn-primary btn-xs m-1 complain-report"><i class="fa fa-list-alt" aria-hidden="true"></i></a>
                         
                        <?php if($admission['qr_number']==""){ ?>
                         <a href="<?php echo site_url('QR-code/'.$admission['id'])?>" data-regno="<?php echo $admission['regno'];?>" class="btn btn-primary btn-xs m-1 qr-code"><i class="fa fa-qrcode" aria-hidden="true"></i></a>
                        <?php } ?>
                      
                      </td>
                    </tr>
                    <?php } ?>                
                </tbody>
              </table>
              
        
            </div>
            <!-- /.card-body -->
            <div class="card-footer small text-muted pagination-holder">
              <?php echo $pagination; ?>
            </div>
          </div>
          <!-- /.card -->

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

  <!-- Student Complian model  -->
<div class="modal fade " id="StudentComplainModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Complain Report</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" id="ComplainReportForm">
        <input type="hidden" name="regno" id="regno" value="">
        <div class="modal-body">
          <div id="update-msg-leave"></div>
          <div class="orm-group">
              <label for="exampleInputEmail1">Complain Date</label>
              <input type="date" name="complain_date" class="form-control">
            </div>
          <div class="form-group">
            <label>Enter Remark</label>
            <textarea class="form-control" name="remark" id="remark" placeholder="Enter Remark"></textarea>
          </div>
           <div class="form-group">
              <label for="exampleInputPassword1">Select Faculty</label>
              <select class="form-control" name="faculty_id">
                    <option value="0">Select Faculty</option>
                    <?php 
                    foreach ($view_faculty as $fac)
                    {
                      ?>
                    <option value="<?php echo $fac['id'];?>"><?php echo $fac['name'];?></option>
                    <?php } ?>
                  </select>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
 
<!-- Status Modal -->
<div class="modal fade " id="ChangeStatusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" id="ChangeStatusForm">
        <input type="hidden" name="regno" id="regno1" value="">
        <div class="modal-body">
          <div id="update-msg"></div>
          <div class="form-group">
            <label>Select Status</label>
            <select class="form-control" name="status" id="new-status">
              <option value="C" >Completed</option>
              <option value="D" >Dropped</option>
              <option value="R" >Running</option>
              <option value="L" >On Leave</option>
              <option value="S" >Suspend</option>
              <option value="T" >Branch Transfer</option>

            </select>
          </div>
          <div class="form-group">
            <label>Enter Note</label>
            <textarea class="form-control" name="note" id="note" placeholder="Enter Note"></textarea>
          </div>
          <div class="form-group">
            <label>Status Date</label>
            <input type="date" name="status_date"  class="form-control" id="status_date" placeholder="Enter Status Date" value="<?php echo date('Y-m-d');?>"  >
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade " id="ExamModal" tabindex="-1" role="dialog" aria-labelledby="ExamModal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Exam Result</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" id="ExamReportForm">
        <input type="hidden" name="exam_type" value="college">
        <div class="modal-body">
          <div id="update-msg-exam"></div>
          <div class="row">
            <div class="col-md-12 col-12 form-group">
              <label>Reg No</label>
              <input type="text" name="regno" class="form-control" placeholder="Enter Regno"/>
            </div>
             <div class="col-md-6 col-12 form-group">
              <label>Student Name</label>
              <input type="text" name="student_name" class="form-control" readonly placeholder="Student Name"/>
            </div>
            <div class="col-md-6 col-12 form-group">
              <label>Course</label>
              <input type="text" name="course" class="form-control" readonly placeholder="Course" >
            </div>
            <div class="col-md-3 col-12 form-group">
              <label>Exam Topic</label>
              <input type="text" name="exam_topic" class="form-control" id="exam_topic" placeholder="Enter Exam Topic" >
            </div>
            <div class="col-md-3 col-12 form-group">
              <label for="exampleInputEmail1">Total Marks</label>
              <input type="text" name="total_marks" class="form-control" placeholder="Enter Total Marks" value="">
            </div>
            <div class="col-md-3 col-12 form-group">
              <label for="exampleInputEmail1">Obtained Marks</label>
              <input type="text" name="obtained_marks" class="form-control" placeholder="Enter Obtained Marks">
            </div>
            <div class="col-md-3 col-12 form-group">
              <label>Exam Remark</label>
              <input type="text" name="exam_remark" class="form-control" id="exam_remark" placeholder="Enter Exam Remark" >
            </div>
            <div class="col-md-6 col-12 form-group">
              <label for="exampleInputEmail1">Exam Date</label>
              <input type="date" name="exam_date" class="form-control" placeholder="Enter email">
            </div>
            <div class="col-md-6 col-12 form-group">
              <label for="exampleInputPassword1">Select Faculty</label>
              <select class="form-control" name="faculty_id">
                    <option value="0">Select Faculty</option>
                    <?php 
                    foreach ($view_faculty as $fac)
                    {
                      ?>
                    <option value="<?php echo $fac['id'];?>"><?php echo $fac['name'];?></option>
                    <?php } ?>
                  </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
 <?php
  $this->load->view('footer');
 ?>
<script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>

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
           $('#found_results').text(data.found_results);
            $('#example2').html(data.data);
            $('.pagination-holder').html(data.pagination);
          }
        });
        //return false;
      });
      $('.filter').change(function(){
          var formData = $('#search_form').serialize();
          
        $.ajax({
          type:"POST",
          url:"<?php echo site_url('College_admission/ajax_search_students');?>",
          data:formData,
          beforeSend:function(){
            $('.process-loader').show();
          },
          complete:function(){
            $('.process-loader').hide();
          },
          dataType:"json",
          success:function(data){
           $('#found_results').text(data.found_results);
            $('#example2').html(data.data);
            $('.pagination-holder').html(data.pagination);
          }
        });
      });

      var typingTimer;                //timer identifier
      var doneTypingInterval = 1000;

      $('#search').keyup(function(){
          clearTimeout(typingTimer);
          if ($('#search').val) 
          {
            typingTimer = setTimeout(function(){
            var formData = $('#search_form').serialize();
            $.ajax({
              type:"POST",
              url:"<?php echo site_url('College_admission/ajax_search_students');?>",
              data:formData,
              beforeSend:function(){
                $('.process-loader').show();
              },
              complete:function(){
                $('.process-loader').hide();
              },
              dataType:"json",
              success:function(data){
                $('#example2').html(data.data);
                $('.pagination-holder').html(data.pagination);
                $('#found_results').text(data.found_results);
              }
            });    
          }, doneTypingInterval);
        } 
      });
      $('.select2').select2({
            theme: 'bootstrap4'
      })
      $(document).on('click','.update-status',function(){
        var regno = $(this).attr('data-regno');
        var status = $(this).attr('data-status');
        var note = $(this).attr('data-note');
        $('#new-status').val(status);
        $('#note').val(note);
        $('#regno1').val(regno);
        $('#ChangeStatusModal').modal('show');
      })
      $('#ChangeStatusForm').submit(function(){
        var formData = $('#ChangeStatusForm').serialize();
        $.ajax({
          type:"POST",
          url:"<?php echo site_url('college_admission/update_status');?>",
          data:formData,
          beforeSend:function(){
            $('.process-loader').show();
          },
          complete:function(){
            $('.process-loader').hide();
          },
          success:function(data){
            $('#update-msg').html(data);
          }
        });
        return false;
      });

        // complain report

        $(document).on('click','.complain-report',function(){
        var regno = $(this).attr('data-regno');
        $('input[name="regno"]').val(regno);
        $('#StudentComplainModal').modal('show');
      });
        
      $('#ComplainReportForm').submit(function(){
        var formData = $('#ComplainReportForm').serialize();
        $.ajax({
          type:"POST",
          url:"<?php echo site_url('College_admission/Complian_update');?>",
          data:formData,
          beforeSend:function(){
            $('.process-loader').show();
          },
          complete:function(){
            $('.process-loader').hide();
          },
          success:function(data){
            $('#StudentComplainModal').modal('hide');
          }
        });
        return false;
      })

      //exam marks modal
      $(document).on('click','.exam-report',function(){
        var regno = $(this).attr('data-regno');
        //$('input[name="regno"]').val(regno);
        $.ajax({
          type:"POST",
          url:"<?php echo site_url('college_admission/get_ajax_student');?>",
          data:{regno:regno},
          beforeSend:function(){
            $('.process-loader').show();
          },
          complete:function(){
            $('.process-loader').hide();
          },
          dataType:"json",
          success:function(data){
            $('input[name="regno"]').val(regno);
            $('input[name="student_name"]').val(data.student_name);
            $('input[name="course"]').val(data.college_course);
            $('#ExamModal').modal('show');
          }
        });
        
      });
      $('#ExamReportForm').submit(function(){
        var formData = $('#ExamReportForm').serialize();
        $.ajax({
          type:"POST",
          url:"<?php echo site_url('test/course_test');?>",
          data:formData,
          beforeSend:function(){
            $('.process-loader').show();
          },
          complete:function(){
            $('.process-loader').hide();
          },
          success:function(data){
            $('#update-msg-exam').html(data);
            $('#ExamModal').modal('hide');
          }
        });
        return false;
      })
      $('#ExamModal').on('hidden.bs.modal', function () {
        $('input[name="obtained_marks"]').val('');
        $('#update-msg-exam').html('');
      })

      $(function () {
        $('body').tooltip({selector: '[data-toggle="tooltip"]'});
      })



   })
 </script>