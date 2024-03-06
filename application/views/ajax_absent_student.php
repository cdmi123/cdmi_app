 <table id="example2" class="table table-bordered table-hover table-font">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>REG NO</th>
                    <th style="width: auto;">
                    STUDENT NAME
                  </th>
                    <th>
                    BATCH TIME
                      <div style="border-top: solid 1px black;margin-top: 5px"></div>
                    FACULTY NAME
                  </th>
                    <th>CONTACT NO</th>
                    <th>LEAVE STATUS</th>
                  </tr>
                </thead>
                <tbody id="example3">
                <?php 
                $id=1;
                foreach ($student as $key => $value) {

                
                    foreach ($value as $key => $info) { ?>

                <tr>
                  <td><?php echo $id;?></td>
                  <td><?php echo $info['regno']?></td>
                  <td><?php echo $info['student_name']?></td>
                  <td><?php echo $info['batch_time']?><div style="border-top: solid 1px black;margin-top: 5px"></div><?php echo $info['faculty_name']?></td>
                  <td><h6><?php echo $info['contact']?> / <?php echo $info['father_contact']?></h6></td>
                  <td>
                    <a href="javascript:void(0);" class="btn btn-primary btn-sm m-1 update-status" data-name="<?php echo $info['student_name'];  ?>" data-regno="<?php echo $info['regno']; ?>"><i class="fas fa-edit"></i></a>
                  </td>

                </tr>
                <?php
                }
               $id++;
                }
                ?>
                </tfoot>
              </table>