<?php 
$id=1; 
	foreach($peta_topic_name as $repname) { ?>
		<tr>
			<td><?php echo $id ?>.</td>
			<td><?php echo $repname['topic_name']; ?></td>
			<td> <a href="javascript:void(0);" data-attr="<?php echo $repname['p_s_id']; ?>" class="btn btn-primary btn-xs m-1 update_topic"><i class="fa fa-list-alt" aria-hidden="true"></i></a>
       <a href="javascript:void(0);" data-attr="<?php echo $repname['p_s_id']; ?>" class="btn btn-danger btn-xs m-1 exam-report delete_sub_topic"> <i class="fa fa-trash"></i></a></td>
		</tr>
<?php $id++; } 

?>

 ?>