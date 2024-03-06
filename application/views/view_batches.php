<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('header');
$role = $this->session->userdata('user_role');
$group_id = $this->session->userdata('group_id');


?>
  <!-- Content Wrapper. Contains page content -->

<er id="absent_report" class="d-none">
  <?php echo "Total   Students : *".$total_student.'*<br>';
        echo "Absent Student  : *".$absent_student.'*<br>';
        echo "Present Student : *".$present_student.'*';
   ?>
</er>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>View Batches</h1>
          </div>
          <div class="col-sm-6">
            <div class="row">
              <div class="col-8">
              </div>
              <div class="col-4">
                
              </div>
            </div>
          </div>
        </div>
        <!-- <div class="row mb-2">
           <div class="col-sm-12">
                <div class="card-footer small text-muted pagination-holder"><?php //echo $pagination; ?></div>
        
          </div>

        </div> -->
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
          <form method="post" id="search_form">
            <div class="card-header px-2">
              <div class="row gx-3">
                <?php if($role!=2 && $role!=8 && $role!=6){ ?>
                <div class="col-md-3 col-4">
                  <select class="form-control filter" name="by_faculty" id="by_faculty" > 
                    <option value="">Select Faculty</option>
                    <?php 
                    foreach($faculty as $fac){
                      ?>
                    <option value="<?php echo $fac['id']; ?>" <?php if($fac['id']==$this->session->userdata('user_login')){echo 'selected';} ?>><?php echo $fac['name']; ?></option>
                      <?php
                    }
                    ?>
                  </select>
                 </div>
               <?php } ?>
                 <div class="col-md-3 col-4">
                  <select class="form-control filter" name="by_batch" id="by_batch">
                    <option value="">Select Batch Time</option>
                    <?php 
                    foreach($course_batches as $batch){
                      ?>
                    <option value="<?php echo $batch['batch']; ?>"><?php echo $batch['batch']; ?></option>
                      <?php
                    }
                    ?>
                  </select>
                  </div>
                  <div class="ml-auto col-md-5 col-5 text-right d-flex justify-content-end">
                     <a href="javascript:void(0)" class="btn btn-primary"  onclick="copyToClipboard('er#absent_report')"> <i class="fa fa-paper-plane"></i> Copy Report </a>&nbsp;
                    <a href="whatsapp://chat?code=<?php echo $group_id;?>" class="btn btn-primary" ><i class="fa fa-paper-plane"></i> Send Report</a>&nbsp;
                      <a href="<?php echo site_url('admission/create_batch');?>" class="btn btn-primary" ><i class="fas fa-plus"></i> Add Batch</a>
                 </div>
              </form>
            </div>
            <!-- /.card-header -->
        <div id="example3">
            <div class="card-body px-0">
              <div class="table-responsive">
                <table id="example2" class="table table-bordered table-hover table-font">
                  <thead>
                    <tr>
                      <th>SR NO.</th>
                      <th width="100px">BATCH NAME</th>
                      <th>STUDENT NAME</th>
                      <th>TIME</th>
                      <th>FACULTY</th>
                      <th>RUNNING TOPIC</th>
                      <th>ACTION</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                  foreach ($batch_data as $k=>$info)
                  {
                    $std_ids = explode(',',$info['student_ids']);
                    
                    $stud_info = $this->Admission_model->get_stud_info($std_ids);
                      $id =$info['id'];

                      $query = $this->db->query('SELECT * FROM `batch_attendence` WHERE DATE(`attendence_time`) = CURDATE() and batch_id ='.$id);
                      $data = $query->result_array();
                      
                      $count = count($data);

                      if($count!=0)
                      {
                          $check_class = "fa fa-check text-primary";
                      }
                      else
                      {
                          $check_class = "";
                      }
                  ?>
                  <tr>
                    <td><?php echo $k+1;?></td>
                    <td align="center"><?php echo $info['batch_name'];?><br><br><i class="<?php echo @$check_class; ?>"></i></td>
                    <td>
                      <div class="table-responsive">
                      <table class="table" width="100%">
                        <!-- <tr>
                          <th>RegNo</th>
                          <th>Name</th>
                          <th>Course</th>
                        </tr> -->
                      <?php 
                      foreach($stud_info as $row){
                        ?>
                        <tr>
                          <td><?php echo $row['regno'];?></td>
                          <td><?php echo $row['student_name'];?></td>
                          <td><?php echo $row['course'];?></td>
                          <td>
                             <a href="<?php echo site_url('admission/view_student/'.$row['regno']);?>" class="btn btn-primary btn-xs m-1"><i class="fas fa-eye"></i></a>
                             <a href="<?php echo site_url('admission/progress_report/'.$row['regno']);?>" class="btn btn-primary btn-xs m-1"><i class="fa fa-print" aria-hidden="true"></i></a>
                          </td>
                        </tr>
                      <?php } ?>
                      </table>
                      </div>
                    </td>
                    <td><?php echo $info['batch_time']?></td>
                    <td><?php echo $info['name']?></td>
                    <td><?php echo $info['topic_name']?></td>
                    <td>
                          <a href="<?php echo site_url('admission/create_batch/'.$info['id']);?>" class="btn btn-action btn-primary btn-sm m-1" data-toggle="tooltip"  data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
                      
                          <a href="<?php echo site_url('admission/delete_batch/'.$info['id']);?>" onclick="return confirm('are you sure?');" data-toggle="tooltip"  data-placement="top" title="Delete" class="btn btn-action btn-primary btn-sm m-1"><i class="fas fa-trash"></i>

                          <a href="javascript:void(0);" class="btn btn-primary btn-sm m-1 update-status" data-batch="<?php echo $info['id'] ?>" data-toggle="tooltip"  data-placement="top" title="Completed Topic" data-student-id="<?php echo $info['student_ids']; ?>"><i class="fas fa-plus"></i>

                          <a href="<?php echo site_url('Batch-attendence/'.$info['id']); ?>" class="btn btn-primary btn-sm m-1 " data-batch="<?php echo $info['id'] ?>" data-toggle="tooltip"  data-placement="top" title="Attendence" data-student-id="<?php echo $info['student_ids']; ?>"><i class="fas fa-user"></i>

                          <a href="<?php echo site_url('Change_Batch/'.$info['id']); ?>" class="btn btn-action btn-primary btn-sm m-1 " data-batch="<?php echo $info['id'] ?>" data-toggle="tooltip"  data-placement="top" title="Batch Transfer" data-student-id="<?php echo $info['student_ids']; ?>"><i class="fas fa-angle-double-right"></i>

                          <a href="javascript:void(0);" class="btn btn-action btn-primary btn-sm m-1 merge_batch" data-toggle="tooltip"  data-placement="top" title="Merge Batch" data-batch="<?php echo $info['id'] ?>" data-f_id="<?php echo $info['faculty_id']; ?>"><i class="fas fa-code-branch"></i>
                    </td> 

                  </tr>
                  <?php
                  }
                  ?>
                  </tbody>
                </table>
              </div>
                <br>
              <div class="table-responsive">
                <table class="table table-hover">
                  <tr>
                    <th colspan="5" class="text-center">Batch Not Assigned/ Mis-Config</th>
                  </tr>
                  <tr>
                    <th>REG NO</th>
                    <th>Student Name</th>
                    <th>Batch Time</th>
                      <th>Course</th>
                    <th>FACULTY</th>
                  </tr>
                  <?php 
                  foreach($no_batch as $not_a_batch){

                    $this->db->where('id',$not_a_batch['faculty_id']);
                    $faculty = $this->db->get('admin')->row_array();

                   ?>
                   <tr>
                    <td><?php echo $not_a_batch['regno'];?></td>
                    <td><?php echo $not_a_batch['student_name'];?></td>
                    <td><?php echo $not_a_batch['batch_time'];?></td>
                    <td><?php echo $not_a_batch['course'];?></td>
                    <td><?php if($faculty!=""){ echo $faculty['name']; } else { echo ""; }?></td>
                  </tr>
                  <?php }?>
                </table>
              </div>
            </div>
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
                  <?php //echo $pagination; ?>
                </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
  </div>

  <div class="modal fade " id="CompletedTopic_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Topic</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" id="CompletedTopicForm">
        <div class="modal-body">
          <div id="update-topic-msg"></div>
          <div class="form-group">
            <label>Enter Topic</label>
            <textarea class="form-control" name="update_topic" id="topic_name" placeholder="Enter Completed Topic"></textarea>
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

  <div class="modal fade " id="merge_batch" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Merge Batch</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" id="CompletedTopicForm">
        <div class="modal-body">
          <div id="update-topic-msg"></div>
          <div class="form-group">
            <label>Select Batch</label>
            <select class="form-control" name="merge_batch" id="batch_names">
              <option>Select Batch</option>
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
 <style type="text/css">
   
   .btn-action{
      height: 30px !important;
      width: 30px !important;
   }

 </style>

 <?php
  $this->load->view('footer');
 ?>


 <script type="text/javascript">
   $(document).ready(function(){
    $('body').tooltip({selector: '[data-toggle="tooltip"]'});
    var student_id,batch_id;
       $('.filter').change(function(){
        var formData = $('#search_form').serialize();
        var fac_id = $(this).val();
        localStorage.faculty_name = fac_id;
        $.ajax({
          type:"POST",
          url:"<?php echo site_url('admission/ajax_get_batches');?>",
          data:formData,
          //dataType:"json",
          success:function(data){
            $('#example3').html(data);
            //$('.pagination-holder').html(data.pagination);
          }
        });
      });


        var typingTimer;                //timer identifier
        var doneTypingInterval = 1000;
      $('#search').keyup(function(){
          clearTimeout(typingTimer);

          if ($('#search').val()) 
          {
              var formData = $('#search_form').serialize();
               typingTimer = setTimeout(function(){

               $.ajax({
                type:"POST",
                url:"<?php echo site_url('fees/ajax_view_allowance');?>",
                data:formData,
                dataType:"json",
                success:function(data){
                  $('#example3').html(data.data);
                  $('.pagination-holder').html(data.pagination);
                  
                }
               })

                }, doneTypingInterval); 
          }
        });


      $(document).on('click','.update-status',function(){

        student_id = $(this).attr('data-student-id');
        batch_id = $(this).attr('data-batch');

        $('#CompletedTopic_model').modal('show');
     });

      $('#CompletedTopicForm').submit(function(e){

        e.preventDefault();

        var topic_name = $('#topic_name').val();

        $.ajax({
          type:"POST",
          url:"<?php echo site_url('Admission/topic_update');?>",
          data:{'topic_name':topic_name,'student_id':student_id,'batch_id':batch_id},
          success:function(res)
          {
            $('#update-topic-msg').html(res);
            $('#CompletedTopic_model').modal('hide');
          }

        })
     
    })


      /* mrg batch*/


      $(document).on('click','.merge_batch',function(){

        batch_id = $(this).attr('data-batch');
        f_id = $(this).attr('data-f_id');
        var toAppend = '';

        $.ajax({

          type:"GET",
          url:"get_batch_info",
          datatype:"json",
          data:{"batch_id":batch_id,"f_id":f_id},

          success: function(data){

            var toAppend = "";

                    $.each(JSON.parse(data), function(key, value) {
                                    toAppend += '<option value="'+ key +'">'+value.batch_name+'</option>';
                                });
                
            $('#batch_names').append(toAppend); 
        }
          
        })

        $('#merge_batch').modal('show');
     });


      $('#CompletedTopicForm').submit(function(e){

        e.preventDefault();

        var topic_name = $('#topic_name').val();

        $.ajax({
          type:"POST",
          url:"<?php echo site_url('Admission/topic_update');?>",
          data:{'topic_name':topic_name,'student_id':student_id,'batch_id':batch_id},
          success:function(res)
          {
            $('#update-topic-msg').html(res);
            $('#CompletedTopic_model').modal('hide');
          }

        })
     
    })
   })

// document.getElementById("clickCopy").onclick = function() {
//   alert();
//   copyToClipboard(document.getElementById("absent_report"));
// }

function copyToClipboard(element) {


  var $temp = $("<textarea>");
  var brRegex = /<br\s*[\/]?>/gi;
  $("body").append($temp);
  $temp.val($(element).html().replace(brRegex, "\r\n")).select();
  document.execCommand("copy");
  $temp.remove();


    // var tempItem = document.createElement('input');

    // tempItem.setAttribute('type','text');
    // tempItem.setAttribute('display','none');
    
    // let content = e;
    // if (e instanceof HTMLElement) {
    //     content = e.innerHTML;
    // }
    
    // tempItem.setAttribute('value',content);
    // document.body.appendChild(tempItem);
    
    // tempItem.select();
    // document.execCommand('Copy');

    // tempItem.parentElement.removeChild(tempItem);
}

</script>