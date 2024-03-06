<?php 
if(isset($topic_name))
{
    $id=1; 
    	foreach($topic_name as $repname) { ?>
    		<tr id="<?php echo $repname['p_s_id']; ?>"> 
    			<td><?php echo $repname['p_s_id'] ?>.</td>
    			<td><?php echo $repname['lecture_name']; ?></td>
    			<td>
    			 <a href="javascript:void(0);" data-update="<?php echo $repname['p_s_id']; ?>" class="btn btn-primary btn-xs m-1 update_topic"><i class="fa fa-list-alt" aria-hidden="true"></i></a>
           <a href="javascript:void(0);" data-delete="<?php echo $repname['p_s_id']; ?>" class="btn btn-danger btn-xs m-1 exam-report delete_sub_topic"> <i class="fa fa-trash"></i></a>
          </td>
    		</tr>
<?php $id++; } 
}
else if(isset($topic_sub_name))
{ ?>

     <option selected disabled>Select Topic Name</option>
    <?php

    foreach ($topic_sub_name as $values) { ?>
        <option value="<?php echo $values['p_s_id']; ?>"><?php echo $values['lecture_name']; ?></option>
    <?php }

}else if(isset($peta_topic_name))
{  
$cnt=1;
foreach ($peta_topic_name as $value) { ?>

        <tr id="<?php echo $value['p_p_id']; ?>">
            <td><?php echo $cnt; ?></td>
            <td><?php echo $value['topic_name'] ?></td>
            <td>
                 <a href="javascript:void(0);" data-update="<?php echo $value['p_p_id']; ?>" class="btn btn-primary btn-xs m-1 update_topic"><i class="fa fa-list-alt" aria-hidden="true"></i></a>
           <a href="javascript:void(0);" data-delete="<?php echo $value['p_p_id']; ?>" class="btn btn-danger btn-xs m-1 exam-report delete_peta_topic"> <i class="fa fa-trash"></i></a>
          </td>
        </tr>

<?php $cnt++; } } ?> 
