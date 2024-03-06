  <?php
defined('BASEPATH') OR exit('No direct script access allowed');
// echo $this->session->userdata('user_role');die;
$this->load->view('header');
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row head-center mb-2">
          <div class="col-sm-6">
            <h1>Admission List</h1>
          </div>
          <div class="col-sm-6">
              <?php
                if($this->session->userdata('user_role')!='5' && $this->session->userdata('user_role')!='2')
                {
              ?>
                <a href="<?php echo site_url('admission/index')?>" class="btn btn-primary btn-block my-1"><i class="fas fa-plus"></i> Add Admission</a>
            <?php } ?>
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
                <div class="small text-muted pagination-holder"><?php echo $pagination; ?></div>
                <div class="row mt-2">   
                <div class=" col-lg-2 col-md-2 col-3 mt-2">           
                  <select class="form-control filter" name="perpage">
                    <option value="10" <?php if($perpage==10){echo 'selected';}?>>10</option>
                    <option value="20" <?php if($perpage==20){echo 'selected';}?>>20</option>
                    <option value="30" <?php if($perpage==30){echo 'selected';}?>>30</option>
                    <option value="40" <?php if($perpage==40){echo 'selected';}?>>40</option>
                    <option value="50" <?php if($perpage==50){echo 'selected';}?>>50</option>
                    <option value="100" <?php if($perpage==100){echo 'selected';}?>>100</option>
                  </select>
                </div>
                <div class="col-lg-4 col-md-4 col-9 mt-2"> 
                  <select class="form-control filter" name="search_by" id="search_by">
                    <option value="byname">Search By Name</option>
                    <option value="byno">Search By No</option>
                    <option value="bycontact">Search By Contact</option>
                  </select>
                </div>
                <div class="col-lg-5 col-md-5 col-10 mt-2">
                  <input  type="text" id="search" name="search_keyword" placeholder="Enter Search Keyword" class="form-control  filter">
                </div>
                  <!-- <a href="<?php //echo site_url('admission/new_data');?>" class="btn btn-primary form-control col-2 ml-2" style="color: white">Search All</a> -->
                  <div class="col-sm-1 col-2 mt-2">
                    <?php
                    if($this->session->userdata('user_role')!='5' && $this->session->userdata('user_role')!='2')
                    {
                    ?>
                   <!-- <a href="<?php //echo site_url('admission/export_data');?>" class="btn btn-primary" style="color: white"><i class="fa fa-file-excel" aria-hidden="true"></i></a> -->
                    <?php } ?>  
                  </div>

                
                  <div class="mt-2 col-lg-2 col-md-4 col-6">
                    <select class="form-control select2 filter" name="faculty[]" multiple="" id="faculty" data-placeholder="By Faculty">
                      <option value="">Select Faculty</option>
                      <?php 
                      foreach($view_faculty as $faculty){
                      ?>
                      <option value="<?php echo $faculty['id'];?>"><?php echo $faculty['name'];?></option>
                      <?php }?>
                    </select>
                  </div>
                  <div class="col-lg-2 mt-2 col-md-4 col-6">
                    <select class="form-control select2 filter" name="batch_time[]" multiple="" id="batch_time" data-placeholder="By Batch">
                      <option value="">Select Batch</option>
                      <?php 
                      foreach($course_batches as $batch){
                      ?>
                      <option value="<?php echo $batch['batch'];?>"><?php echo $batch['batch'];?></option>
                      <?php }?>
                    </select>
                  </div>
                   
                  <div class="col-lg-2 col-md-4 mt-2 col-6">
                    <select class="form-control filter select2" name="course[]" id="course" multiple="multiple" data-placeholder="Search By Course">
                      <option value="">Search By Course</option>
                      <?php 
                      foreach ($view_course as $data)
                      {
                      ?>
                      <option value="<?php echo $data['course_name'];?>"><?php echo $data['course_name']?></option>
                      <?php 
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-lg-2 col-md-4 mt-2 col-6">
                    <select class="form-control filter select2" name="sub_course[]" id="sub_course" multiple="multiple" data-placeholder="Search By Sub Course">
                      <option value="">Search By Sub Course</option>
                      <?php 
                      foreach ($view_course as $data)
                      {
                      ?>
                      <option value="<?php echo $data['course_name'];?>"><?php echo $data['course_name']?></option>
                      <?php 
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-lg-2 col-md-4 mt-2 col-6">
                    <select class="form-control filter" name="year" id="year">
                      <option value="">Year</option>
                        <?php 
                        for($y=date('Y');$y>=START_YEAR;$y--){
                        ?>
                        <option value="<?php echo $y;?>"><?php echo $y;?></option>
                        <?php }?>
                        
                    </select>
                   </div>
                  <div class="col-lg-2 col-md-4 mt-2 col-6">
                    <select class="form-control filter" name="sitting_status" id="sitting">
                      <option value="">By Seating</option>
                        <option value="LAPTOP">Laptop</option>
                        <option value="PC">PC</option>
                    </select>
                   </div>
                   <div class="col-lg-3 col-md-5 mt-2 col-6">
                    <select class="form-control filter" name="course_status" id="status">
                      <option value="">Search By Status</option>
                        <option value="R">Running</option>
                        <option value="C">Completed</option>
                        <option value="D">Dropped</option>
                        <option value="L">On Leave</option>
                        <!-- <option value="S">Suspend</option> -->
                        <option value="J">In Job</option>
                        <option value="P">In Project</option>
                        <option value="T">Branch Transfer</option>
                    </select>
                   </div>
                   <div class="col-lg-3 col-md-5 mt-2 col-6">
                    <select class="form-control filter" name="performance" id="status">
                      <option value="">Search By Performance</option>
                        <option value="All">All</option>
                        <option value="Good">Good</option>
                        <option value="Average">Average</option>
                        <option value="Poor">Poor</option>
                    </select>
                   </div>
                      <div class="col-sm-1 col-2 mt-2">
                    <?php
                    if($this->session->userdata('user_role')!='2')
                    {
                    ?>
                   <a href="javascript:void(0);" class="btn btn-primary" id="exam">Exam</a>
                    <?php } ?>  
                  </div>
                   <div class="col-lg-3 col-md-8 col-12 mt-2 text-center text-bold">
                    Found Results: 
                    <span id="found_results"><?php echo $found_results;?></span>
                   </div>
                </div>
              </div>
            </form>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table  class="table table-bordered table-hover table-font">
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
                    FEES
                  </th>
                  <th>
                    FACULTY 
                    <div style="border-top: solid 1px black;margin-top: 5px"></div>
                    BATCH/PC NO
                  </th>
                  <th>
                    LAST PAID
                   
                  </th>
                  <th>
                    ALLOWANCE
                    <div style="border-top: solid 1px black;margin-top: 5px"></div>
                    REFUND
                  </th>
                  <th>PHOTO</th>
                  <th>STA.</th>
                  <th width="90px">ACTION</th>
                </tr>
                </thead>
                <tbody id="example2">
                  <?php

                    $c_date = date('Y-m-d');
                    foreach ($admission_data as $admission)
                    {
                      $total_fees = preg_replace("/[^0-9]/", "", @$admission['offer_code'] );
                      $total_fees = @$total_fees*10;

                      $paid_allowance = $this->Fees_model->total_allowance_by_student($admission['regno']);
                      $paid_refund = $this->Fees_model->total_refund_by_student($admission['regno']);
                      $performance = $this->Exam_model->get_performance_by_regno($admission['regno']);
                      $exam_count = $this->Exam_model->get_exam_count_by_regno($admission['regno']);
                      $leave_info = $this->Admission_model->get_last_reason($admission['regno']);
                      $fac_ids = explode(",",$admission['faculty_id']);
                      $this->db->where_in('id',$fac_ids);
                      $faculty_info = $this->db->get('admin')->result_array();
                      $fac_names = array();
                      foreach($faculty_info as $fac){
                        $fac_names[] = $fac['name'];
                      }
                      $f_names = implode(", ", $fac_names);
                      
                      $last_data =array();
                      $this->db->order_by('id','desc');
                      $this->db->where('reg_no',$admission['regno']);
                      $last_data[] = $this->db->get('fees',1)->row_array();

                      $this->db->order_by('id','desc');
                      $this->db->where('reg_no',$admission['regno']);
                      $last_data[] = $this->db->get('tbl_dipak',1)->row_array();
                      
                      usort($last_data, 'date_compare');

                      $paid = $this->Admission_model->get_paid_fees($admission['regno']);
                      $paid2 = $this->Admission_model->get_paid_fees2($admission['regno']);
                      
                      // $ad_total_fees = str_replace(',', '', $admission['total_fees']);
                      // $unpaid = (int) ($ad_total_fees) - $paid;
                      if($admission['image']!='')
                      {
                        $img = base_url('upload/student_photo/'.$admission['image']);
                      }else{
                        $img = base_url('assets/users.jpg');
                      }



                      $class = "color:inherit;";
                      if($admission['status']=="C"){
                        $class = "color:green;";
                      }else if($admission['status']=="D"){
                        $class = "color:red;";
                      }else if($admission['status']=="L"){
                        $class = "color:blue;";
                      }else if ($admission['status']=="S") {
                         $class = "color:purple;";
                      }else if ($admission['status']=="T") {
                         $class = "color:#618500;";
                      }else if($admission['status']=="P"){
                        $class = "background-color:rgba(230, 238, 255);";
                      }else if($admission['status']=="J"){
                        $class = "background-color:rgba(204, 255, 255, 0.4);";
                      }else if($admission['end_date']<$c_date){
                         $class = "color:#FF8300;";
                      }
                  ?>
                    <tr style="<?php echo $class;?>">
                      <td><?php echo $admission['regno']?></td>
                      <td>
                        <?php echo $admission['student_name'];?>
                        <div style="border-top: solid 1px black;margin-top: 5px"></div>
                        <?php echo $admission['contact']; ?>
                        <?php echo $admission['father_contact'] ? " / ".$admission['father_contact'] : "";?>
                      </td>
                      <td>
                        <?php echo $admission['course'];
                        if(!empty($admission['sub_course'])){
                          echo ' - ( '.$admission['sub_course'].' )';
                        }
                        ?>
                        <?php if($admission['join_date']!=''){?>
                        <div style="border-top: solid 1px black;margin-top: 5px;word-break: break-all;"></div>
                        <?php echo getSimpleDate($admission['join_date']); } ?>
                      </td>
                      <td>
                        <?php echo $paid;?>/-
                      </td>
                      <td <?php if($admission['laptop_compulsory']=="YES"){ echo "style='color:#CF20C5;'";} ?>>
                        <?php echo $f_names.' / '.$admission['running_topic'];?>  
                        <div style="border-top: solid 1px black;margin-top: 5px"></div>
                        <?php echo $admission['batch_time'].' / '.$admission['sitting'].' / '.$admission['pcno'];?>
                        <?php if($admission['laptop_compulsory']=="YES"){ echo "/ Y";} ?>
                      </td>
                      <td>
                        <?php echo @$last_data[1]['amount']; ?>/-  
                        <div style="border-top: solid 1px black;margin-top: 5px"></div>
                        <?php echo getSimpleDate(@$last_data[1]['date']);?>
                        
                      </td>
                      <td>
                        <?php echo $paid_allowance; ?>/-  
                        <div style="border-top: solid 1px black;margin-top: 5px"></div>
                        <?php echo $paid_refund; ?>/-
                      </td>
                      <td>
                        <img src="<?php echo $img;?>" alt="User profile picture" width="45">
                        <div style="border-top: solid 1px black;margin-top: 5px"></div>
                        <?php echo $performance;?>-<?php echo $exam_count;?>
                      </td>
                      <td>

                        <a href="javascript:void(0);" class="btn  btn-primary btn-xs m-1 update-status" data-status="<?php echo $admission['status'];?>" data-regno="<?php echo $admission['regno'];?>" data-note="<?php echo $admission['status_note'];?>" data-fees="<?php //echo $unpaid;?>" data-toggle="tooltip" data-placement="top" title="<?php echo isset($leave_info['leave_remark']) ? $leave_info['leave_remark'] : $admission['status_note'];?> <?php if($admission['status_date'] !='') { ?>(<?php echo $admission['status_date'];  ?>) <?php } ?>" ><?php echo $admission['status'];?></a>

                        <a href="<?php echo site_url('fees/return_fees/add/'.$admission['regno']);?>" class="btn btn-primary btn-xs m-1">Return</a>

                        <a href="<?php echo site_url('fees/add_allowance/add/'.$admission['regno']);?>" class="btn btn-primary btn-xs m-1">Allowance</a>

                        <a href="https://api.whatsapp.com/send/?phone=91<?php echo $admission['contact'];?>" target="_blank" class="btn btn-success btn-xs m-1"><i class="fab fa-whatsapp" aria-hidden="true"></i></a>
                      </td>
                      <td>

                    <?php if ($admission['status']!="J") { ?>

                        <a href="<?php echo site_url('admission/edit_form/'.$admission['regno']);?>" class="btn btn-primary btn-xs m-1" data-regno="<?php echo $admission['regno'];?>"><i class="fas fa-edit"></i></a>

                        <!-- <a href="javascript:void(0);" class="btn btn-primary btn-xs m-1 job_report_edit" data-regno="<?php echo $admission['regno'];?>"><i class="fas fa-edit"></i></a> -->

                         <a href="<?php echo site_url('Admission/print_regular_admission/'.$admission['id']);?>" class="btn btn-primary btn-action btn-xs m-1" data-toggle="tooltip"  data-placement="top" title="Print"> <i class="fas fa-print" ></i></a>


                        <a href="javascript:void(0);" data-regno="<?php echo $admission['regno'];?>" class="btn btn-primary btn-xs m-1 student-leave btn-action" data-toggle="tooltip"  data-placement="top" title="Leave"><i class="fa fa-clock"></i></a>


                    <?php } else { ?>

                    <?php } ?>
                        <a href="<?php echo site_url('admission/view_student/'.$admission['id']);?>" class="btn btn-action btn-primary btn-xs m-1" data-toggle="tooltip"  data-placement="top" title="View"><i class="fas fa-eye"></i></a>

                      <?php if(($total_fees-$paid2)!=0){ ?> 

                        <a href="<?php echo site_url('fees/index/add/'.$admission['regno']);?>" class="btn btn-primary btn-action btn-xs m-1" data-toggle="tooltip"  data-placement="top" title="Fees"> <i class="fas fa-plus"></i></a>

                      <?php } ?>

                        <a href="javascript:void(0);" data-regno="<?php echo $admission['regno'];?>" class="btn btn-primary btn-action btn-xs m-1 exam-report" data-toggle="tooltip"  data-placement="top" title="Exam"> <i class="fas fa-laptop-code"></i></a>

                        <a href="javascript:void(0);" data-regno="<?php echo $admission['regno'];?>" class="btn btn-action btn-primary btn-xs m-1 complain-report" data-toggle="tooltip"  data-placement="top" title="Complain"><i class="fa fa-list-alt" aria-hidden="true"></i></a>
                        
                        <?php if($admission['status']=="J"){ ?>

                          <a href="javascript:void(0);" class="btn btn-primary btn-xs m-1 job_report" data-toggle="tooltip"  data-placement="top" title="Interview" data-regno="<?php echo $admission['regno'];?>" ><i class="fas fa-user-graduate"></i></a>
                        <?php } ?>
                      </td>
                    </tr>
                    <?php } ?>                
                </tfoot>
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
  <!-- Button trigger modal -->
<div class="modal fade " id="StudentLeaveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Leave Report</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" id="LeaveReportForm">
        <input type="hidden" name="regno" id="regno" value="">
        <div class="modal-body">
          <div id="update-msg-leave"></div>
          <div class="form-group">
            <label>Select Leave Dates</label>
            <input type="text" name="leave_dates"  class="form-control" id="leave_dates" placeholder="Enter Leave Dates"  >
          </div>
          <div class="form-group">
            <label>Enter Remark</label>
            <textarea class="form-control" name="remark" id="remark" placeholder="Enter Remark"></textarea>
          </div>
          <div class="form-group">
            <label>Select Status</label>
            <select class="form-control" name="leave_status" id="leave_status">
              <option value="A" >Absent</option>
              <option value="L" >Leave</option>
              
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
        <input type="hidden" name="cregno" id="regno" value="">
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
              <select class="form-control" name="faculty_name">
                    <option value="0">Select Faculty</option>
                    <?php 
                    foreach ($view_faculty as $fac)
                    {
                      ?>
                    <option value="<?php echo $fac['name'];?>"><?php echo $fac['name'];?></option>
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
        <input type="hidden" name="regno" id="regno" value="">
        <div class="modal-body">
          <div id="update-msg"></div>
          <div class="form-group">
            <label>Select Status</label>
            <select class="form-control" name="status" id="new-status">
              <option value="C">Completed</option>
              <option value="D">Dropped</option>
              <option value="R">Running</option>
              <option value="L">On Leave</option>
              <option value="S">Suspend</option>
              <option value="J">In Job</option>
              <option value="P">In Project</option>
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
        <input type="hidden" name="exam_type" value="course">
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
            <div class="col-md-4 col-12 form-group">
              <label>Exam Topic</label>
              <input type="text" name="exam_topic" class="form-control" id="exam_topic" placeholder="Enter Exam Topic" >
            </div>

            <div class="col-md-4 col-12 form-group">
              <label>Exam Remarks</label>
              <input type="text" name="exam_remark" class="form-control" id="exam_remark" placeholder="Enter Exam Remarks" >
            </div>

            <div class="col-md-4 col-12 form-group">
              <label for="exampleInputEmail1">Total Marks</label>
              <input type="text" name="total_marks" class="form-control" placeholder="Enter Total Marks" value="">
            </div>
            <div class="col-md-4 col-12 form-group">
              <label for="exampleInputEmail1">Obtained Marks</label>
              <input type="text" name="obtained_marks" class="form-control" placeholder="Enter Obtained Marks">
            </div>
            <div class="col-md-4 col-12 form-group">
              <label for="exampleInputEmail1">Exam Date</label>
              <input type="date" name="exam_date" class="form-control" placeholder="Enter email">
            </div>
            <div class="col-md-4 col-12 form-group">
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

<div class="modal fade " id="JobModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Student Job Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" id="UpdateModalForm">
        <input type="hidden" name="regno" id="regno-1" value="">
        <div class="modal-body">
          <div id="update-msg-1"></div>
          <div class="row">
            <div class="form-group col-6">
              <label for="exampleInputEmail1" style="<?php if(form_error('course')){echo $red;}?>">Select Faculty</label>
              <select multiple class="form-control select2" name="faculty_id[]" id="faculty_id">
                <option value="0">Select Faculty</option>
                <?php 
                foreach ($view_faculty as $fac)
                {
                  ?>
                  <option value="<?php echo $fac['id'];?>"><?php echo $fac['name'];?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group col-6">
              <label >Job Status</label>
              <input type="text" name="job_status" class="form-control" id="running_topic" placeholder="Enter Job Status">
            </div>
            <div class="form-group col-5">
              <label >Interview in (Institute)</label>
              <br>
              <input type="checkbox" name="interview[]" style="margin-left: 10px" value="interview-1" > Interview 1<br>
              <input type="checkbox" name="interview[]" style="margin-left: 10px" value="interview-2"> Interview 2
              <br>
              <input type="checkbox" name="interview[]" style="margin-left: 10px" value="interview-3"> Interview 3

            </div>
            <div class="form-group col-6">
              <label >Interview in (Company)</label>
              <br>
              <input type="checkbox" name="interviewc[]" style="margin-left: 10px" value="interview-1" > Interview 1<br>
              <input type="checkbox" name="interviewc[]" style="margin-left: 10px" value="interview-2"> Interview 2
              <br>
              <input type="checkbox" name="interviewc[]" style="margin-left: 10px" value="interview-3"> Interview 3
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

<div class="modal fade " id="JobModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Manage Student Job Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" id="UpdateModalForm">
        <input type="hidden" name="regno" id="regno-1" value="">
        <div class="modal-body">
          <div id="update-msg-1"></div>
          <div class="row">
            <div class="form-group col-6">
              <label for="exampleInputEmail1" style="<?php if(form_error('course')){echo $red;}?>">Select Faculty</label>
              <select multiple class="form-control select2" name="faculty_id[]" id="faculty_id">
                <option value="0">Select Faculty</option>
                <?php 
                foreach ($view_faculty as $fac)
                {
                  ?>
                  <option value="<?php echo $fac['id'];?>"><?php echo $fac['name'];?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group col-6">
              <label >Job Status</label>
              <input type="text" name="job_status" class="form-control" id="running_topic" placeholder="Enter Job Status">
            </div>
            <div class="form-group col-5">
              <label >Interview in (Institute)</label>
              <br>
              <input type="checkbox" name="interview[]" style="margin-left: 10px" value="interview-1" > Interview 1<br>
              <input type="checkbox" name="interview[]" style="margin-left: 10px" value="interview-2"> Interview 2
              <br>
              <input type="checkbox" name="interview[]" style="margin-left: 10px" value="interview-3"> Interview 3

            </div>
            <div class="form-group col-6">
              <label >Interview in (Company)</label>
              <br>
              <input type="checkbox" name="interviewc[]" style="margin-left: 10px" value="interview-1" > Interview 1<br>
              <input type="checkbox" name="interviewc[]" style="margin-left: 10px" value="interview-2"> Interview 2
              <br>
              <input type="checkbox" name="interviewc[]" style="margin-left: 10px" value="interview-3"> Interview 3
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
 <script type="text/javascript">
  $(document).ready(function(){
    $('input[name="leave_dates"]').daterangepicker({
      locale: {
        format: 'MM/DD/YYYY'
      },
      autoApply:true
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
          $('#example2').html(data.data);
          $('#found_results').text(data.found_results);
          $('.pagination-holder').html(data.pagination);
        }
      });
    });

    $('.filter').change(function(){
      var formData = $('#search_form').serialize();
      $.ajax({
        type:"POST",
        url:"<?php echo site_url('admission/ajax_search_students');?>",
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
          $('#found_results').text(data.found_results);
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
            var formData = $('#search_form').serialize();
            typingTimer = setTimeout(function(){
            $.ajax({
              type:"POST",
              url:"<?php echo site_url('admission/ajax_search_students');?>",
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
                $('#found_results').text(data.found_results);
                $('.pagination-holder').html(data.pagination);
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
        var fees_data = $(this).attr('data-fees');
        if(fees_data>0){
          $('#new-status option:contains("In Job")').attr("disabled","disabled");
        }else{
          $('#new-status option:contains("In Job")').removeAttr("disabled");
        }
        $('#new-status').val(status);
        $('#note').val(note);
        $('input[name="regno"]').val(regno);
        $('#ChangeStatusModal').modal('show');
      })
      $('#ChangeStatusForm').submit(function(){
        var formData = $('#ChangeStatusForm').serialize();
        $.ajax({
          type:"POST",
          url:"<?php echo site_url('admission/update_status');?>",
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
      })

      $(document).on('click','.student-leave',function(){
        var regno = $(this).attr('data-regno');
        $('input[name="regno"]').val(regno);
        $('#StudentLeaveModal').modal('show');
        $('input[name="leave_dates"]').daterangepicker({
          locale: {
            format: 'MM/DD/YYYY'
          },
          autoApply:true
        });
      });
      
      $('#LeaveReportForm').submit(function(){
        var formData = $('#LeaveReportForm').serialize();
        $.ajax({
          type:"POST",
          url:"<?php echo site_url('admission/leave_update');?>",
          data:formData,
          beforeSend:function(){
            $('.process-loader').show();
          },
          complete:function(){
            $('.process-loader').hide();
          },
          success:function(data){
            $('#update-msg-leave').html(data);
          }
        });
        return false;
      })
      $('#StudentLeaveModal').on('hidden.bs.modal', function () {
        $('#LeaveReportForm')[0].reset();
      })


      // complain report

        $(document).on('click','.complain-report',function(){
        var regno = $(this).attr('data-regno');
        $('input[name="cregno"]').val(regno);
        $('#StudentComplainModal').modal('show');
      });
      $('#ComplainReportForm').submit(function(){
        var formData = $('#ComplainReportForm').serialize();
        $.ajax({
          type:"POST",
          url:"<?php echo site_url('admission/Complian_update');?>",
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
          url:"<?php echo site_url('admission/get_ajax_student');?>",
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
            $('input[name="course"]').val(data.course);
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
      });


      $(document).on('click','.job_report',function(){
      
        var regno = $(this).attr('data-regno');

        $.ajax({
        type:"POST",
        url:"<?php echo site_url('admission/get_ajax_job');?>",
        data:{regno:regno},
        beforeSend:function(){
          $('.process-loader').show();
        },
        complete:function(){
          $('.process-loader').hide();
        },
        dataType:"json",
        success:function(data){
          $('#regno-1').val(regno);
          var fac_arr = data.faculty_id.split(',')
          $('#faculty_id').select2().val(fac_arr).trigger("change")
          $('#batch_time_2').val(data.batches);  
          $('#batch_time_2').select2({
            theme: 'bootstrap4'
          });
          setTimeout(function(){
            $('#batch_time_2').trigger('change');  
          },300);
          
          $('#stu-status').val(data.status);
         
          $('#JobModal').modal('show');
        }
    });
       
    })

      $(document).on('click','.job_report_edit',function(){
      
        var regno = $(this).attr('data-regno');

        $.ajax({
        type:"POST",
        url:"<?php echo site_url('admission/get_ajax_job');?>",
        data:{regno:regno},
        beforeSend:function(){
          $('.process-loader').show();
        },
        complete:function(){
          $('.process-loader').hide();
        },
        dataType:"json",
        success:function(data){
          $('#regno-1').val(regno);
          var fac_arr = data.faculty_id.split(',')
          $('#faculty_id').select2().val(fac_arr).trigger("change")
          $('#batch_time_2').val(data.batches);  
          $('#batch_time_2').select2({
            theme: 'bootstrap4'
          });
          setTimeout(function(){
            $('#batch_time_2').trigger('change');  
          },300);
          
          $('#stu-status').val(data.status);
         
          $('#JobModalEdit').modal('show');
        }
    });
       
    })

      /* Exam_report ajax */

      $('#exam').click(function(){
      var formData = $('#search_form').serialize();
      $.ajax({
        type:"POST",
        url:"<?php echo site_url('admission/export_exam_data');?>",
        data:formData,
        beforeSend:function(){
          $('.process-loader').show();
        },
        complete:function(){
          $('.process-loader').hide();
        },
        dataType:"json",
        
      });
    });

      $('#ExamModal').on('hidden.bs.modal', function () {
        $('input[name="obtained_marks"]').val('');
        $('#update-msg-exam').html('');
      })
  })
  $(function () {
    //$('[data-toggle="tooltip"]').tooltip()
    $('body').tooltip({selector: '[data-toggle="tooltip"]'});
  })



 </script>