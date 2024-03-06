  <div class="card-body">
              <div class="table-responsive">
                <table id="example2" class="table table-bordered table-hover table-font">
                  <thead>
                    <tr>
                      <th>SR NO.</th>
                      <th width="100px">BATCH NAME</th>
                      <th>STUDENT NAME</th>
                      <th>TIME</th>
                      <th>FACULTY</th>
                      <th>RUNNING TOPIC</th>
                      <th>ACTION</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                  foreach ($batch_data as $k=>$info)
                  {
                    $std_ids = explode(',',$info['student_ids']);
                    $stud_info = $this->Admission_model->get_stud_info($std_ids);
                      $id =$info['id'];
                      $query = $this->db->query('SELECT * FROM `batch_attendence` WHERE DATE(`attendence_time`) = CURDATE() and batch_id ='.$id);
                      $data = $query->result_array();
                      
                      $count = count($data);

                      if($count!=0)
                      {
                          $check_class = "fa fa-check text-primary";
                      }
                      else
                      {
                          $check_class = "";
                      }
                  ?>
                  <tr>
                    <td><?php echo $k+1;?></td>
                    <td align="center"><?php echo $info['batch_name'];?><br><br> <i class="<?php echo @$check_class; ?>"></i></td>
                    <td>
                      <div class="table-responsive">
                      <table class="table" width="100%">
                        <!-- <tr>
                          <th>RegNo</th>
                          <th>Name</th>
                          <th>Course</th>
                        </tr> -->
                      <?php 
                      foreach($stud_info as $row){
                        ?>
                        <tr>
                          <td><?php echo $row['regno'];?></td>
                          <td><?php echo $row['student_name'];?></td>
                          <td><?php echo $row['course'];?></td>
                          <td>
                             <a href="<?php echo site_url('admission/view_student/'.$row['regno']);?>" class="btn btn-primary btn-xs m-1"><i class="fas fa-eye"></i></a>
                              <a href="<?php echo site_url('admission/progress_report/'.$row['regno']);?>" class="btn btn-primary btn-xs m-1"><i class="fa fa-print" aria-hidden="true"></i></a>
                          </td>
                        </tr>
                      <?php } ?>
                      </table>
                      </div>
                    </td>
                    <td><?php echo $info['batch_time']?></td>
                    <td><?php echo $info['name']?></td>
                    <td><?php echo $info['topic_name']?></td>
                      <td>
                          <a href="<?php echo site_url('admission/create_batch/'.$info['id']);?>" class="btn btn-action btn-primary btn-sm m-1" data-toggle="tooltip"  data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
                      
                          <a href="<?php echo site_url('admission/delete_batch/'.$info['id']);?>" onclick="return confirm('are you sure?');" data-toggle="tooltip"  data-placement="top" title="Delete" class="btn btn-action btn-primary btn-sm m-1"><i class="fas fa-trash"></i>

                          <a href="javascript:void(0);" class="btn btn-primary btn-sm m-1 update-status" data-batch="<?php echo $info['id'] ?>" data-toggle="tooltip"  data-placement="top" title="Completed Topic" data-student-id="<?php echo $info['student_ids']; ?>"><i class="fas fa-plus"></i>

                          <a href="<?php echo site_url('Batch-attendence/'.$info['id']); ?>" class="btn btn-primary btn-sm m-1 " data-batch="<?php echo $info['id'] ?>" data-toggle="tooltip"  data-placement="top" title="Attendence" data-student-id="<?php echo $info['student_ids']; ?>"><i class="fas fa-user"></i>

                          <a href="<?php echo site_url('Change_Batch/'.$info['id']); ?>" class="btn btn-action btn-primary btn-sm m-1 " data-batch="<?php echo $info['id'] ?>" data-toggle="tooltip"  data-placement="top" title="Batch Transfer" data-student-id="<?php echo $info['student_ids']; ?>"><i class="fas fa-angle-double-right"></i>

                          <a href="javascript:void(0);" class="btn btn-action btn-primary btn-sm m-1 merge_batch" data-toggle="tooltip"  data-placement="top" title="Merge Batch" data-batch="<?php echo $info['id'] ?>" data-f_id="<?php echo $info['faculty_id']; ?>"><i class="fas fa-code-branch"></i>
                    </td> 
                    </td> 

                  </tr>
                  <?php
                  }
                  ?>
                  </tbody>
                </table>
              </div>
                <br>
              <div class="table-responsive">
                <table class="table table-hover">
                  <tr>
                    <th colspan="5" class="text-center">Batch Not Assigned/ Mis-Config</th>
                  </tr>
                  <tr>
                    <th>REG NO</th>
                    <th>Student Name</th>
                    <th>Batch Time</th>
                      <th>Course</th>
                    <th>FACULTY</th>
                  </tr>
                  <?php 
                  foreach($no_batch as $not_a_batch){

                    $this->db->where('id',$not_a_batch['faculty_id']);
                    $faculty = $this->db->get('admin')->row_array();

                   ?>
                   <tr>
                    <td><?php echo $not_a_batch['regno'];?></td>
                    <td><?php echo $not_a_batch['student_name'];?></td>
                    <td><?php echo $not_a_batch['batch_time'];?></td>
                    <td><?php echo $not_a_batch['course'];?></td>
                    <td><?php if($faculty!=""){ echo $faculty['name']; } else { echo ""; }?></td>
                  </tr>
                  <?php }?>
                </table>
              </div>
            </div>