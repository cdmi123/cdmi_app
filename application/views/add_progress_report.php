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
            <h1>Progress Report Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Progress Report Form</li>
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
                <h3 class="card-title">Progress Report</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="reportname" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Report Name</label>
                    <input type="text" class="form-control"  placeholder="Enter Report Name" name="report_name" id="language_name">
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
                      <th style="width:15%">Action</th>
                    </tr>
                  </thead>
                  <tbody id="report-topic-name">
                  	<?php $id=1; foreach($report_name as $repname) { ?>
	                    <tr>
	                      <td><?php echo $id ?>.</td>
	                      <td><?php echo $repname['cat_name']; ?></td>
                        <td>
                        <a href="javascript:void(0);" data-attr="<?php echo $repname['p_id']; ?>" data_cat_name="<?php echo $repname['cat_name']; ?>" class="btn btn-primary btn-xs m-1 update_topic"><i class="fa fa-list-alt" aria-hidden="true"></i></a>
                        <a href="javascript:void(0);" data-attr="<?php echo $repname['p_id']; ?>" class="btn btn-danger btn-xs m-1 exam-report delete_topic"> <i class="fa fa-trash"></i></a>
                        </td>
	                    </tr>
               		<?php $id++; } ?>
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


  <!-- Update Model -->

<div class="modal fade " id="categorynameupdateMOdel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Report</h5>
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

	$(document).ready(function(){

		$('#reportname').submit(function(e){

        	e.preventDefault();

        	var language_name = $('#language_name').val();

        	$.ajax({

         		type:"POST",
          		url:"<?php echo site_url('progress_report/add_report');?>",
          		data:{'language_name':language_name},
          		success:function(res)
          		{
            		$('#report-topic-name').html(res);
            		$('#language_name').val("");
          		}
        	})
    	});

      $('.delete_topic').click(function(){

        var delete_id = $(this).attr('data-attr');

          $.ajax({

            type:"POST",
              url:"<?php echo site_url('progress_report/delete_cat');?>",
              data:{'delete_id':delete_id},
              success:function(res)
              {
                $('#report-topic-name').html(res);
              }
          })
      });


      $(document).on('click','.update_topic',function(){
        var regno = $(this).attr('data-attr');
        var topic_name = $(this).attr('data_cat_name');
        $('input[name="id"]').val(regno);
        $('#categorynameupdateMOdel').modal('show');
      });

        $('#updateTopicForm').submit(function(){
        var formData = $('#updateTopicForm').serialize();
        $.ajax({
          type:"POST",
          url:"<?php echo site_url('progress_report/update_Category');?>",
          data:formData,
          success:function(data){
            $('#categorynameupdateMOdel').modal('hide');
            $('#report-topic-name').html(data);
          }
        });
        return false;
      })
   })
</script>