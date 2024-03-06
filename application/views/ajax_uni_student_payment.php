<?php 
foreach ($adm_data as $info)
{
  $college_fees = $this->Admin_model->get_total_uni_fees_by_student($info['regno'],'regular');
  $exam_fees = $this->Admin_model->get_total_uni_fees_by_student($info['regno'],'exam');
  $certificate_fees = $this->Admin_model->get_total_uni_fees_by_student($info['regno'],'certificate');
?>
<tr>
  <td><?php echo $info['regno']?></td>
  <td><?php echo $info['student_name']?></td>
  <td><?php echo $info['college_course'];?> <?php echo !empty($info['course_stream']) ? ' - '.$info['course_stream'] : "";?></td>
  <td><?php echo $info['university']?></td>
  <td><?php echo $info['start_session'].'-'.$info['end_session'];?></td>
  <td><?php echo isset($college_fees['total_amount']) ? $college_fees['total_amount'] : 0;?>/-</td>
  <td><?php echo isset($certificate_fees['total_amount']) ? $certificate_fees['total_amount'] : 0;?>/-</td>
  <td><?php echo isset($exam_fees['total_amount']) ? $exam_fees['total_amount'] : 0;?>/-</td>
  <td>
    <a href="<?php echo site_url('College_admission/view_student/'.$info['regno']);?>" class="btn btn-primary btn-xs m-1"><i class="fas fa-eye"></i></a>
    <a href="<?php echo site_url('add-uni-payment/add/'.$info['regno']);?>" class="btn btn-primary btn-xs m-1"> <i class="fas fa-plus"></i></a></td>
</tr>
<?php
}
?>