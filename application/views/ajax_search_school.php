<?php 
foreach ($arr as $info){
  $today_call = $this->Schoolinq_model->count_call_by_school($info['id'],$info['caller_id']);
  if($info['caller_id'] !=0)
  {
    $this->db->where('id',$info['caller_id']);
    $data = $this->db->get('admin')->row_array();
    $name = isset($data['name']) ?$data['name']:"No Name";
  }
  else
  {
    $name = "Not Assign";
  }
?>
<tr>
  <th><?php echo $info['id'];?></th>
  <th><?php echo $info['school_name'];?></th>
  <th><?php echo $info['total_count'];?></th>
  <th><?php echo $today_call;?></th>
  <th><?php echo $name; ?></th>
  <th><a href="<?php echo site_url('schoolinq/add_school/'.$info['id']);?>">Edit</a>
   <!-- || <a href="<?php //echo site_url('schoolinq/delete_data/'.$info['id']);?>">Delete</a> -->
  </th>
</tr>
<?php
}
?>