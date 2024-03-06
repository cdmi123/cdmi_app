<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
foreach ($fees_data as $info)
{
?>
<tr>
  <td><?php echo $info['rec_no']?></td>
  <td><?php echo $info['reg_no']?></td>
  <td><?php echo $info['student_name']?></td>
  <td><?php echo $info['course']?></td>
  <td><?php echo $info['amount']?>/-</td>
  <td><?php echo $info['details'];?></td>
  <td><?php echo date("d-m-Y",strtotime($info['date']));?></td>
  <td>
    <a href="<?php echo site_url('fees/return_fees/update/'.$info['id']);?>" class="btn btn-primary btn-sm m-1"><i class="fas fa-edit"></i></a>
  </td>
</tr>
<?php
}
?>