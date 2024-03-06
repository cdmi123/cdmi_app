<?php 
$id=1; 
	foreach($report_name as $repname) { ?>
		<tr>
			<td><?php echo $id ?>.</td>
			<td><?php echo $repname['cat_name']; ?></td>
      <td>
			<a href="javascript:void(0);" data-attr="<?php echo $repname['p_id']; ?>" data-cat-name="<?php echo $repname['cat_name']; ?>" class="btn btn-primary btn-xs m-1 update_topic"><i class="fa fa-list-alt" aria-hidden="true"></i></a>
      <a href="javascript:void(0);" data-attr="<?php echo $repname['p_id']; ?>" class="btn btn-danger btn-xs m-1 exam-report delete_topic"> <i class="fa fa-trash"></i></a>
    </td>
		</tr>
<?php $id++; } ?>

<script type="text/javascript">
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
        $('input[name="id"]').val(regno);
        $('input[name="topic_name"]').val(data-cat-name);
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
      });
</script>