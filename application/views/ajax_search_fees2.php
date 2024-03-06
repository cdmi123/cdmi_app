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
  <!-- <td><?php //echo $info['installment_no']?></td> -->
  <td>
    <?php echo $info['payment_mode'];?>
    <?php 
    if(!empty($info['payment_detail'])){
    ?>
    <div style="border-top: solid 1px black;margin-top: 5px"></div>
    <?php echo $info['payment_detail'];
    }?>
  </td>
  <td><?php echo $info['create_by'] ? $info['create_by'] : 'No Name';?></td>
  <td>
    <?php echo date("d-m-Y",strtotime($info['date']));?>
    <div style="border-top: solid 1px black;margin-top: 5px"></div>
    <?php echo getDateTime($info['created_at']);?>
  </td>
  <td>
    <a href="<?php echo site_url('fees/index2/update/'.$info['id']);?>" class="btn btn-primary btn-sm m-1"><i class="fas fa-edit"></i></a>
    <a href="<?php echo site_url('fees/print_receipt2/'.$info['id']);?>" class="btn btn-primary btn-sm m-1"><i class="fas fa-print"></i></a>   
  </td>
</tr>
<?php
}
?>