<?php 
  foreach ($fees_data as $info)
   {
?>
<tr>
  <td><?php echo $info['id']?></td>
  
  <td><?php echo $info['reg_no']?></td>
  <td><?php echo $info['student_name']?></td>
  <td><?php echo $info['course']?></td>
  <td><?php echo $info['amount']?></td>
  <td><?php echo $info['installment_no']?></td>
  <td><?php echo $info['fees_type']?></td>
  <td><?php echo $info['extra_detail']?></td>
  <td><?php echo $info['date']?></td>

   <th><a href="<?php echo site_url('Fees/index/'.$info['id']);?>">Edit</a></th>

</tr>
<?php
}
?>