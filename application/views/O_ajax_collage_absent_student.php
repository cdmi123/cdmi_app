 <table id="example2" class="table table-bordered table-hover table-font">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>REG NO</th>
                    <th style="width: auto;">
                    STUDENT NAME
                  </th>
                    <th>Class Name</th>
                    <th>CONTACT NO</th>
                    <th>LEAVE STATUS</th>
                  </tr>
                </thead>
                <tbody id="example3">
                <?php 
                $id=1;
                foreach ($student as $key => $value) {

                    foreach ($value as $key => $info) { 

                      $cur_month = date("m");
                      $cur_year = date("Y");

                           

                            if($info['start_session'] != $cur_year)
                            {
                                  $start_year =  $cur_year - $info['start_session'];

                                  if ($start_year == 1) {
                                      $year = "SY";
                                      $year_store = "second";
                                  }else if($start_year == 2){
                                      $year = "TY";
                                      $year_store = "third";
                                  }
                            }
                            else
                            {
                                $year = "FY";
                                $year_store = "first";
                            }

                          $dclass_name = $year." - ".$info['class_name'];
                          $class_name = $year_store."-".$info['class_name'];
                  ?>
                <tr>
                  <td><?php echo $id;?></td>
                  <td><?php echo $info['regno'];?></td>
                  <td><?php echo $info['student_name'];?></td>
                  <td><?php echo $dclass_name; ?></td>
                  <td><h6><?php echo $info['personal_mobile_no']?> / <?php echo $info['father_mobile_no']?> / <?php echo $info['home_mobile_no']?></h6></td>
                  <td>
                    <a href="javascript:void(0);" class="btn btn-primary btn-sm m-1 update-collage-status" data-name="<?php echo $info['student_name'];  ?>" data-regno="<?php echo $info['regno']; ?>" data-classname="<?php echo $class_name; ?>"><i class="fas fa-edit"></i></a>
                  </td>

                </tr>
                <?php
                }
               $id++;
                }
                ?>
                </tfoot>
              </table>