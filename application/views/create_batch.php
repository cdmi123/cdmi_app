<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('header');
if(@$batch_info['faculty_id']){
  $fac_id = $batch_info['faculty_id'];
}else{
  $fac_id =$this->session->userdata('user_login');
}
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create Batch</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <a href="<?php echo site_url('admission/view_batches');?>" class="btn btn-sm btn-primary m-1" ><i class="fas fa-list"></i> View Batches</a>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-10">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Create Batch</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <label >Faculty Name</label>
                  <div class="row">
                    <div class="col-12 form-group">
                      <select class="form-control" name="faculty_id" id="faculty_id" tabindex="9">
                        <?php
                        foreach($faculty as $fac){
                        ?>
                        <option value="<?php echo $fac['id'];?>" <?php if($fac['id']==$fac_id) { echo "selected"; }?>><?php echo $fac['name'];?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </div>
                    <div class="col-md-6 col-12 form-group">
                      <label >Batch Time</label>
                      <select class="form-control" name="batch_time" id="batch_time">
                        <option value="0">Select Batch Time</option>
                        <?php 
                        foreach($course_batches as $batch){
                        ?>
                        <option value="<?php echo $batch['batch'];?>" <?php if(@$batch_info['batch_time']==$batch['batch']){echo 'selected';} ?>><?php echo $batch['batch'];?></option>
                        <?php }?>
                      </select>
                    </div>
                    <div class="col-md-6 col-12 form-group">
                      <label >Lecture Time</label>
                      <select class="form-control" name="lecture_time_batch" id="lecture_time">
                        <option value="0">Select Batch Time</option>
                        <?php 
                        foreach($lecture_batches as $lecture_time){
                        ?>
                        <option value="<?php echo $lecture_time['batch_time'];?>" <?php if(@$batch_info['lecture_time']==$lecture_time['batch_time']){echo 'selected';} ?>><?php echo $lecture_time['batch_time'];?></option>
                        <?php }?>
                      </select>
                    </div>
                    <div class="col-md-6 col-12 form-group">
                      <label >Lecture class</label>
                      <select class="form-control" name="class_name" id="lecture_class">
                        <option value="0" selected>Select Lecture Class</option>
                        <?php if(isset($batch_info)){ ?>
                        <option value="<?php echo $batch_info['class_name']; ?>" selected ><?php echo $batch_info['class_name']; ?></option>
                      <?php } ?>
                      </select>
                    </div>
                    <div class="col-md-6 col-12 form-group">
                      <label >Batch Name</label>
                      <select name="batch_name" class="form-control">
                        <option value="0">Select Batch Name</option>
                        <?php 
                        foreach($batches as $bat){
                        ?>
                        <option value="<?php echo $bat['b_name'];?>" <?php if($bat['b_name']==@$batch_info['batch_name']){echo 'selected';} ?>><?php echo $bat['b_name'];?></option>
                        <?php }?>
                      </select>
                      
                    </div>
                    <div class="col-12 form-group">
                      <label >Running Topic</label>
                      <input type="text" name="topic_name" class="form-control" id="topic_name" placeholder="Topic Name" value="<?php echo @$batch_info['topic_name']; ?>">
                    </div>
                    <div class="col-12 form-group">
                      <label >Select Students</label>
                      <select class="form-control select2" name="student_ids[]" multiple="" id="student_ids">
                        <option value="">Select Students</option>
                      </select>
                    </div>
                  </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                </div>
              </form>
            </div>
          
          </div>
        
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
 <?php
      $this->load->view('footer');
 ?>
<script type="text/javascript">
  var selected_ids = '<?php echo isset($batch_info['student_ids']) ? $batch_info['student_ids'] : "";?>'
  var is_update = '<?php echo @$is_update;?>'
  $(document).ready(function(){
    
    $('#faculty_id,#batch_time').change(function(){
      console.log('eve called')
      var fac_id = $('#faculty_id').val();
      var batch_time = $('#batch_time').val();
      if(fac_id=="" || batch_time==""){
        return;
      }
      $.ajax({
        type:"POST",
        url:"<?php echo site_url('admission/get_ajax_batch_students');?>",
        data:{faculty_id:fac_id,batch_time:batch_time,selected_ids:selected_ids},
        success:function(res){
          $('#student_ids').html(res).after(function(){
            $('.select2').select2({
              theme: 'bootstrap4'
            })
          });
        }
      });
    })
    $('.select2').select2({
      theme: 'bootstrap4'
    })
    if(is_update=='yes'){
      //$('#batch_time').val('8 TO 10')
      $('#faculty_id').trigger('change')  

    }

    $('#lecture_time').change(function(){

      var l_time = $(this).val();

      $.ajax({
        type:"POST",
        url:"<?php echo site_url('admission/get_ajax_class');?>",
        data:{l_time:l_time},
        success:function(res) {
          $('#lecture_class').html(res);
        }
      })

    })
  })
</script>

<style type="text/css">
  
  .select2.select2-container.select2-container--bootstrap4{
    width: 100% !important;
  }

</style>