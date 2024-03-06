<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php 
foreach ($punchData as $info)
{
?>
<tr>
  <th><?php echo $info['id']?></th> 
  <th><?php echo $info['name']?></th>
  <th><?php echo getSimpleDate($info['date']);?></th>
  <th><?php echo $info['inTime']?></th>
  <th><?php echo $info['outTime']?></th>
  <th><?php echo $info['work_hours'];?></th>
</tr>
<?php
}
?>
