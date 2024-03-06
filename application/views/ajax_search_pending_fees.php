<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

foreach ($fees_data as $info)
{
  $this->db->where('id',$info['faculty_id']);
  $faculty = $this->db->get('admin')->row_array();  
  
  $data = array();
                  
  $this->db->order_by('id','desc');
  $this->db->where('reg_no',$info['regno']);
  $qry1 = $this->db->get('fees',1);
  $data1 = $qry1->row_array() ? $qry1->row_array() : array();

  $this->db->reset_query();
  $this->db->order_by('id','desc');
  $this->db->where('reg_no',$info['regno']);
  $qry2 = $this->db->get('tbl_dipak',1);
  $data2 = $qry2->row_array() ? $qry2->row_array() : array();
  
  if(!empty($data1) && !empty($data2)){
    $data[]= $data1;
    $data[] = $data2;
    usort($data, 'date_compare');
  }else if(!empty($data1)){
    $data[]= $data1;
    $data[] = $data1;
  }else if(!empty($data2)){
    $data[]= $data2;
    $data[] = $data2;
  }
  if(!isset($data[1])){
    $data[1]['date'] = '0000-00-00';
    $data[1]['amount'] = '0';
  }
  $class = "color:inherit;";
  if($info['status']=="C"){
    $class = "color:green;";
  }else if($info['status']=="D"){
    $class = "color:red;";
  }else if($info['status']=="L"){
    $class = "color:blue;";
  }
?>
<tr style="<?php echo $class;?>">
  <td><?php echo $info['regno']?></td>
  <td>
    <?php echo $info['student_name'].'-'.$info['sitting'].'-'.$info['pcno'];?>
    <div style="border-top: solid 1px black;margin-top: 5px"></div>
    <?php echo $info['contact'];?>
    <?php echo $info['father_contact'] ? " / ".$info['father_contact'] : "";?>    
  </td>
  <td>
    <?php echo $info['course']?>
    <div style="border-top: solid 1px black;margin-top: 5px"></div>
    <?php echo $info['running_topic'];?>
    <div style="border-top: solid 1px black;margin-top: 5px"></div>
    <?php echo $info['sitting'].'-'.$info['pcno'];?>
  </td>
  <td>
    <?php echo $data[1]['amount']; ?>/-  
    <div style="border-top: solid 1px black;margin-top: 5px"></div>
    <?php echo date('d-m-Y',strtotime($data[1]['date']));?>
  </td>
  <td>
    <?php echo $info['amount']?>/-
    <?php 
    if(!empty($info['due_date'])){
    ?>
    <div style="border-top: solid 1px black;margin-top: 5px"></div>
    <?php echo date("d-m-Y",strtotime($info['due_date']));
    }?>
  </td>
  <td>
    <?php echo $faculty['name'];?>  
    <div style="border-top: solid 1px black;margin-top: 5px"></div>
    <?php echo $info['batch_time'];?>
  </td>
  <td>
    <?php echo ($info['follow_date']!="0000-00-00") ? date("d-m-Y",strtotime($info['follow_date'])): "";?>
    <?php 
    if(!empty($info['remark'])){
    ?>
    <div style="border-top: solid 1px black;margin-top: 5px"></div>
    <?php echo $info['remark'];
    }?>
  </td>
  <td><?php echo $info['follow_by'];?></td>
  <td>
    <a href="javascript:void(0);" class="btn btn-primary btn-xs m-1 update-status" data-regno="<?php echo $info['regno'];?>"><i class="fas fa-edit"></i></a>
    <a href="<?php echo site_url('admission/view_student/'.$info['regno']);?>" class="btn btn-primary btn-xs m-1"><i class="fas fa-eye"></i></a>
    <?php 
    if($this->session->userdata('user_role')!=2){
    ?>
    <a href="<?php echo site_url('delete-due-fees/'.$type.'/'.$info['id']);?>" class="btn btn-primary btn-xs m-1"><i class="fas fa-trash"></i></a>
    <a href="<?php echo site_url('fees/index/add/'.$info['regno']);?>" class="btn btn-primary btn-xs m-1"> <i class="fas fa-plus"></i></a>
    <?php }?>
  </td>

</tr>
<?php
}
?>