<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('header');
$course = @$inquiry_data['course'];
$course_arr = explode(',', $course);
$demo_by = $this->session->userdata('user_login');
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Demo Student</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              
              <li class="breadcrumb-item active"><a class="btn btn-primary" href="<?php echo site_url('DemoLecture/my_demo_students/'); ?>">View My Demos</a></li>
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
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Demo Student</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" enctype="multipart/form-data">
                <input type="hidden" name="inq_id" value="<?php echo $inq_id;?>">
                <div class="card-body">

                  <div class="form-group">
                    <label for="exampleInputEmail1">Inquiry Name</label>
                    <input type="text" name="contact" class="form-control" id="exampleInputEmail1" name="contact" placeholder="Enter Contact Number" disabled=""  value="<?php echo $inquiry_data['name']?>" >
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Inquiry Contact</label>
                    <input type="text" name="contact" class="form-control" value="<?php echo $inquiry_data['contact']?>" id="exampleInputEmail1" name="contact" disabled="" placeholder="Enter " >
                  </div>

                  <select class="select2" multiple="multiple" disabled="" name="course[]" data-placeholder="Select a Course" style="width: 100%;">
                  <?php
                    foreach ($course_data as $course_info)
                    {
                  ?>
                    <option value="<?php echo $course_info['id']?>" <?php if(in_array($course_info['id'], $course_arr)){echo 'selected';}?>><?php echo $course_info['course_name']?></option>
                  <?php } ?>
                  </select>

                   <div class="form-group">
                    <label for="exampleInputEmail1">Inquiry By</label>
                    
                    <select class="form-control" disabled="" name="enq_by" id="enq_by">
                        <?php
                        foreach($faculties as $faculty){
                        ?>
                        <option value="<?php echo $faculty['id'];?>" <?php if($inquiry_data['inquiry_by']==$faculty['id']){echo 'selected';}?>><?php echo $faculty['name'];?></option>
                        <?php
                        }
                        ?>
                    </select>
                  </div>
                  <div class="form-group" >
                    <label for="exampleInputEmail1">Demo Faculty Name</label>
                    <select class="form-control" disabled="" name="demo_by" id="demo_by">
                        <?php
                        foreach($faculties as $faculty){
                        ?>
                        <option value="<?php echo $faculty['id'];?>" <?php if($demo_by==$faculty['id']){echo 'selected';}?>><?php echo $faculty['name'];?></option>
                        <?php
                        }
                        ?>
                    </select>
                    
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Batch Time</label>
                    <select class="form-control" name="batch_time">
                        <option>Select Batch Time</option>
                        <option value="8 to 10" <?php if(@$update_data['batch_time']=='8 to 10'){echo 'selected';}?>>8 To 10</option>
                        <option value="10 to 12" <?php if(@$update_data['batch_time']=='10 to 12'){echo 'selected';}?>>10 To 12</option>
                        <option value="12 to 2" <?php if(@$update_data['batch_time']=='12 to 2'){echo 'selected';}?>>12 To 2</option>
                        <option value="2 to 4" <?php if(@$update_data['batch_time']=='2 to 4'){echo 'selected';}?>>2 To 4</option>
                        <option value="4 to 6" <?php if(@$update_data['batch_time']=='4 to 6'){echo 'selected';}?>>4 To 6</option>
                        <option value="6 to 8" <?php if(@$update_data['batch_time']=='6 to 8'){echo 'selected';}?>>6 To 8</option>
                    </select>
                  </div>

                   <div class="form-group">
                    <label for="exampleInputEmail1">Demo Date</label>
                    <input type="date" name="demo_date" class="form-control" value="<?php echo @$update_data['demo_date']?>" id="exampleInputEmail1" name="contact" >
                  </div>
                  <div class="form-group col-3">
                    <label for="exampleInputEmail1" style="<?php if(form_error('sitting')){echo $red;}?>">PC / Laptop*</label>
                    <div class="mt-2">
                      <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimary1" value="pc" <?php echo set_radio('sitting','pc',(@$_POST['sitting']=='pc'));?> name="sitting" >
                        <label for="radioPrimary1" class="mr-3">PC</label>
                      </div>
                      <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimary2" <?php echo set_radio('sitting','laptop',(@$_POST['sitting']=='laptop'));?> value="laptop" name="sitting">
                        <label for="radioPrimary2">Laptop</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-3">
                    <label for="exampleInputEmail1">PC No.*</label>
                    <select class="form-control" disabled="" id="pcno" name="pcno">
                        <option>Select PC No.</option>
                        <?php
                          for ($i=1; $i <= 41; $i++)
                           { 
                        ?>
                        <option value="<?php echo $i;?>"><?php echo $i;?></option>
                      <?php } ?>    
                    </select>
                  </div>  

                  <div class="form-group col-6">
                    <label for="exampleInputEmail1" style="<?php if(form_error('reference')){echo $red;}?>">Running Topic*</label>
                    <input type="text" name="running_topic" value="<?php echo set_value('running_topic'); ?>"  class="form-control" id="other" placeholder="Enter Running Topic" >
                  </div>
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
  $(document).ready(function() {
      

       //Initialize Select2 Elements
    $('.select2').select2({
      theme: 'bootstrap4'
    })

    $('input[name="sitting"]').on('change', function() {
      $('select[name="pcno"]').attr('disabled', this.value != "pc")
    });

  });
</script>
