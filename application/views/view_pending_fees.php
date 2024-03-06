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
            <h1><?php echo ucfirst($type);?> Payment List</h1>
          </div>
          <div class="col-sm-6">
            <div class="row">
              <div class="col-8">
              </div>
              <div class="col-4">
                <?php 
                if($this->session->userdata('user_role')!=2){
                ?>
                <a href="<?php echo site_url('fees/index')?>" class="btn btn-primary btn-block my-1"><i class="fas fa-plus"></i> Add Fees</a>
                <?php }?>
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
            <input type="hidden" name="list_type" value="<?php echo $type;?>">
            <div class="card-header">
              <div class="row">
                <div class="col-1"> 
                  <select class="form-control filter" name="perpage">
                    <option value="10" <?php if($perpage==10){echo 'selected';}?>>10</option>
                    <option value="20" <?php if($perpage==20){echo 'selected';}?>>20</option>
                    <option value="30" <?php if($perpage==30){echo 'selected';}?>>30</option>
                    <option value="40" <?php if($perpage==40){echo 'selected';}?>>40</option>
                    <option value="50" <?php if($perpage==50){echo 'selected';}?>>50</option>
                    <option value="100" <?php if($perpage==100){echo 'selected';}?>>100</option>
                  </select>
                </div>
                <div class="col-2"> 
                  <select class="form-control filter" name="search_by" id="by_keyword">
                    <option value="byname">By Name</option>
                    <option value="byreg">By RegNo</option>
                  </select>
                </div>
                <div class="col-3"> 
                  <input type="text" id="search" placeholder="Type Name or No." name="search_keyword" class="form-control">
                </div>
                <div class="col-2">
                  <select class="form-control filter select2" name="course[]" id="course" multiple="multiple" data-placeholder="Search By Course">
                    <option value="">Select Course</option>
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
                <div class="col-2">
                  <select class="form-control filter select2" name="faculties[]" id="faculties" multiple="multiple" data-placeholder="By Faculty">
                    <option value="">Select Faculty</option>
                    <?php 
                    foreach ($faculties as $fac)
                    {
                    ?>
                    <option value="<?php echo $fac['id'];?>"><?php echo $fac['name']?></option>
                    <?php 
                    }
                    ?>
                  </select>
                </div>
                <div class="col-2">
                  <select class="form-control filter select2" name="batch_time[]" multiple="" id="batch_time" data-placeholder="By Batch">
                    <option value="">By Batch</option>
                    <?php 
                    foreach($course_batches as $batch){
                    ?>
                    <option value="<?php echo $batch['batch'];?>"><?php echo $batch['batch'];?></option>
                    <?php }?>
                    
                  </select>
                </div>
                <div class="col-sm-1 col-2 mt-2">
                <?php
                //if($this->session->userdata('user_role')!='2')
                //{
              ?>
                  <a href="<?php echo site_url('fees/export_due_data/'.$type);?>" class="btn btn-primary" style="color: white"><i class="fa fa-file-excel" aria-hidden="true"></i></a>
                <?php //} ?>  
                  </div>
                <div class="col-2 text-center text-bold mt-2">
                  Found Results: 
                  <span id="found_results"><?php echo $found_results;?></span>
                </div>
              </form>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover table-font">
                <thead>
                  <tr>
                    <th>REG NO</th>
                    <th>
                      STUDENT NAME
                      <div style="border-top: solid 1px black;margin-top: 5px"></div>
                      CONTACT NO.
                    </th>
                    <th>
                      COURSE
                      <div style="border-top: solid 1px black;margin-top: 5px"></div>
                      TOPIC
                      <div style="border-top: solid 1px black;margin-top: 5px"></div>
                      SEATING
                    </th>
                    <th>
                      LAST PAID
                      <div style="border-top: solid 1px black;margin-top: 5px"></div>
                      LAST DATE
                    </th>
                    <th>
                      DUE AMT
                      <div style="border-top: solid 1px black;margin-top: 5px"></div>
                      DUE DATE
                    </th>
                    <th>
                      FACULTY
                      <div style="border-top: solid 1px black;margin-top: 5px"></div>
                      BATCH
                    </th>
                    <th width="200">
                      FOLLOW DATE
                      <div style="border-top: solid 1px black;margin-top: 5px"></div>
                      REMARK
                    </th>
                    <th>FOLLOW BY</th>
                    <th width="90px">ACTION</th>
                  </tr>
                </thead>
                <tbody id="example3">
                <?php 
                foreach ($fees_data as $info)
                {
                  $this->db->where('id',$info['faculty_id']);
                  $faculty = $this->db->get('admin')->row_array();
                  $data = array();
                  
                  $this->db->order_by('id','desc');
                  $this->db->where('reg_no',$info['regno']);
                  $qry1 = $this->db->get('fees',1);
                  $data1 = $qry1->row_array() ? $qry1->row_array() : array();

                  $this->db->reset_query();
                  $this->db->order_by('id','desc');
                  $this->db->where('reg_no',$info['regno']);
                  $qry2 = $this->db->get('tbl_dipak',1);
                  $data2 = $qry2->row_array() ? $qry2->row_array() : array();
                  
                  if(!empty($data1) && !empty($data2)){
                    $data[]= $data1;
                    $data[] = $data2;
                    usort($data, 'date_compare');
                  }else if(!empty($data1)){
                    $data[]= $data1;
                    $data[] = $data1;
                  }else if(!empty($data2)){
                    $data[]= $data2;
                    $data[] = $data2;
                  }
                  
                  if(!isset($data[1])){
                    $data[1]['date'] = '0000-00-00';
                    $data[1]['amount'] = '0';
                  }
                  $class = "color:inherit;";
                  if($info['status']=="C"){
                    $class = "color:green;";
                  }else if($info['status']=="D"){
                    $class = "color:red;";
                  }else if($info['status']=="L"){
                    $class = "color:blue;";
                  }
                ?>
                <tr style="<?php echo $class;?>">
                  <td><?php echo $info['regno']?></td>
                  <td>
                    <?php echo $info['student_name'].'-'.$info['sitting'].'-'.$info['pcno'];?>
                    <div style="border-top: solid 1px black;margin-top: 5px"></div>
                    <?php echo $info['contact'];?>
                    <?php echo $info['father_contact'] ? " / ".$info['father_contact'] : "";?>    
                  </td>
                  <td>
                    <?php echo $info['course']?>
                    <div style="border-top: solid 1px black;margin-top: 5px"></div>
                    <?php echo $info['running_topic'];?>
                    <div style="border-top: solid 1px black;margin-top: 5px"></div>
                    <?php echo $info['sitting'].'-'.$info['pcno'];?>
                  </td>
                  <td>
                    <?php echo $data[1]['amount']; ?>/-  
                    <div style="border-top: solid 1px black;margin-top: 5px"></div>
                    <?php echo date('d-m-Y',strtotime($data[1]['date']));?>
                  </td>
                  <td>
                    <?php echo $info['amount']?>/-
                    <?php 
                    if(!empty($info['due_date'])){
                    ?>
                    <div style="border-top: solid 1px black;margin-top: 5px"></div>
                    <?php echo date("d-m-Y",strtotime($info['due_date']));
                    }?>
                  </td>
                  <td>
                    <?php echo $faculty['name'];?>  
                    <div style="border-top: solid 1px black;margin-top: 5px"></div>
                    <?php echo $info['batch_time'];?>
                  </td>
                  <td>
                   <?php echo ($info['follow_date']!="0000-00-00") ? date("d-m-Y",strtotime($info['follow_date'])): "";?>
                    <?php 
                    if(!empty($info['remark'])){
                    ?>
                    <div style="border-top: solid 1px black;margin-top: 5px"></div>
                    <?php echo $info['remark'];
                    }?>
                  </td>
                  <td><?php echo $info['follow_by'];?></td>
                  <td>
                    <a href="javascript:void(0);" class="btn btn-primary btn-xs m-1 update-status" data-regno="<?php echo $info['regno'];?>"><i class="fas fa-edit"></i></a>
                    <a href="<?php echo site_url('admission/view_student/'.$info['regno']);?>" class="btn btn-primary btn-xs m-1"><i class="fas fa-eye"></i></a>
                    <?php 
                    if($this->session->userdata('user_role')!=2){
                    ?>
                    <a href="<?php echo site_url('delete-due-fees/'.$type.'/'.$info['id']);?>" class="btn btn-primary btn-xs m-1"><i class="fas fa-trash"></i></a>
                    <a href="<?php echo site_url('fees/index/add/'.$info['regno']);?>" class="btn btn-primary btn-xs m-1"> <i class="fas fa-plus"></i></a> <a href="<?php echo site_url('fees-follow-up/'.$info['id']);?>" class="btn btn-primary btn-xs m-1 "><i class="fa fa-list-alt" aria-hidden="true"></i></a>
                    <?php }?>
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
 
<!-- Follow Modal -->
<div class="modal fade " id="ChangeStatusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Follow Up</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" id="ChangeStatusForm">
        <input type="hidden" name="regno" id="regno" value="">
        <div class="modal-body">
          <div id="update-msg"></div>
          <div class="form-group">
            <label>Follow-up By</label>
            <select class="form-control" name="follow_by" id="follow_by" >
              <?php 
              foreach($faculties as $fac){
                ?>
                <option value="<?php echo $fac['name'];?>" ><?php echo $fac['name'];?></option>
                <?php
              }
              ?>
              
            </select>
          </div>
          <div class="form-group">
            <label>Enter Note</label>
            <textarea class="form-control" name="note" id="note" placeholder="Enter Note"></textarea>
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
    $('.select2').select2({
      theme: 'bootstrap4'
    })
    $(document).on('click','.update-status',function(){
        var regno = $(this).attr('data-regno');
        var follow_by = $(this).attr('data-follow_by');
        var note = $(this).attr('data-note');
        //$('#follow_by').val(follow_by);
        $('#note').val(note);
        $('#regno').val(regno);
        $('#ChangeStatusModal').modal('show');
    });
    $('#ChangeStatusForm').submit(function(){
      var formData = $('#ChangeStatusForm').serialize();
      $.ajax({
        type:"POST",
        url:"<?php echo site_url('fees/update_due_followup');?>",
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
          $('#found_results').text(data.found_results);
          $('.pagination-holder').html(data.pagination);
        }
      });
      //return false;
    });
      $('.filter').change(function(){
        var formData = $('#search_form').serialize();
        $.ajax({
          type:"POST",
          url:"<?php echo site_url('fees/ajax_pending_list');?>",
          data:formData,
          dataType:"json",
          success:function(data){
            $('#example3').html(data.data);
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
                url:"<?php echo site_url('fees/ajax_pending_list');?>",
                data:formData,
                dataType:"json",
                success:function(data){
                  $('#example3').html(data.data);
                  $('#found_results').text(data.found_results);
                  $('.pagination-holder').html(data.pagination);
                }
              })
            }, doneTypingInterval); 
          }
        });


   })
</script>