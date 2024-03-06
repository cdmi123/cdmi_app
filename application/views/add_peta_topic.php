<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('header');
?>

 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Topic Report Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Topic Report Form</li>
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
                <h3 class="card-title">Add Topic Name</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="reportname" method="post">
                <div class="card-body">
                    <label for="exampleInputEmail1">Select Report</label>
                    <select class="form-control" id="select_report" name="report_id">
                      <option selected disabled>Select Progress Report</option>
                        <?php foreach($report_name as $repname) { ?>
                          <option value="<?php echo $repname['p_id']; ?>"><?php echo $repname['cat_name']; ?></option>
                        <?php } ?> 
                    </select>
                </div>
                <div class="card-body">
                    <label for="exampleInputEmail1">Select Topic Name</label>
                    <select class="form-control" id="select_topic" name="topic_name_id">
                      <option selected disabled>Select Topic Name</option>
                    </select>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Topic Name</label>
                    <input type="text" class="form-control"  placeholder="Enter Report Name" name="sub_topic_name" id="sub_topic_name">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
          <div class="col-md-6">
          	  <div class="card">
               <div class="card-header">
                <h3 class="card-title">Progress Report</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th style="width: 25%">#</th>
                      <th>Report Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="report-topic-name" class="row_position">
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  <div class="modal fade " id="update_peta_cat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Topic</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" id="updateTopicForm">
        <input type="hidden" name="id" id="regno" value="">
        <div class="modal-body">
          <div id="update-msg-leave"></div>
          
          <div class="form-group">
            <label>Enter Remark</label>
            <textarea class="form-control" name="topic_name" id="remark" placeholder="Enter Remark"></textarea>
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

    /* Start Drag and drop function */

   $( ".row_position" ).sortable({
        delay: 150,
        stop: function() {
            var selectedData = new Array();
            var x = localStorage.getItem("progress_report.sub_cat_id");

            $('.row_position>tr').each(function() {
                selectedData.push($(this).attr("id"));
            });
            updateOrder(selectedData,x);
        }
    });

   function updateOrder(data,sub_cat_val) {
        $.ajax({
            url:"<?php echo site_url('progress_report/update_drag_drop_peta_cat');?>",
            type:'post',
            data:{position:data,'sub_cat_id':sub_cat_val},
            success:function(res){
                $('#report-topic-name').html(res);
                alert('your change successfully saved');
            }
        })
    }

    /* End Drag and drop function */

	$(document).ready(function(){

		$('#reportname').submit(function(e){

        	e.preventDefault();

          var formdata = $(this).serialize();

        	$.ajax({

         		type:"POST",
          		url:"<?php echo site_url('progress_report/add_peta_topic');?>",
          		data:formdata,
          		success:function(res)
          		{
            		$('#report-topic-name').html(res);
            		$('#sub_topic_name').val("");
          		}
        	})
    	});

      $('#select_report').change(function(){

          var report_id = $('#select_report').val();

          $.ajax({

            type:"POST",
              url:"<?php echo site_url('progress_report/ajax_get_sub_topic');?>",
              data:{'report_id':report_id},
              success:function(res)
              {
                $('#select_topic').html(res);
              }
          })
      });

       $('#select_topic').change(function(){

         var select_topic_id = $('#select_topic').val();

          localStorage.setItem("progress_report.sub_cat_id",select_topic_id);

          $.ajax({

            type:"POST",
              url:"<?php echo site_url('progress_report/ajax_get_peta_topic');?>",
              data:{'select_topic_id':select_topic_id},
              success:function(res)
              {
                $('#report-topic-name').html(res);
              }
          })
      });
  });


  $(document).on('click','.update_topic',function(){
        var regno = $(this).attr('data-update');
        $('#regno').val(regno);
        $('#update_peta_cat').modal('show');
  });

  $(document).ready(function(){
    $('#updateTopicForm').submit(function(e){
          e.preventDefault();
          var formdata = $(this).serialize();
          $.ajax({
            type:"POST",
              url:"<?php echo site_url('progress_report/update_peta_topic');?>",
              data:formdata,


              success:function(res)
              {
                $('#report-topic-name').html(res);
                $('#sub_topic_name').val("");
                $('#update_peta_cat').modal('hide');
              }
          })
      });
  });

  $(document).on('click','.delete_peta_topic',function(){
        var del_id = $(this).attr('data-delete');
        var x = localStorage.getItem("progress_report.sub_cat_id");

       $.ajax({
            type:"POST",
              url:"<?php echo site_url('progress_report/delete_peta_topic');?>",
              data:{'delete_id':del_id,'sub_cat_id':x},

              success:function(res)
              {
                  $('#report-topic-name').html(res);
              }
          })
  });


</script>