<?php 
$role = $this->session->userdata('user_role');
                  foreach ($arr as $info)
                  {
                    $cnt = 0;
                    if($role==8){
                      $this->db->where('inquiry_id',$info['id']);
                      $this->db->order_by('id','desc');
                      $last_followup = $this->db->get('school_call_followup',1)->row_array();

                      $this->db->where('inquiry_id',$info['id']);
                      $cnt  = $this->db->get('school_call_followup')->num_rows();
                    }else{
                      $this->db->where('inquiry_id',$info['id']);
                      $this->db->order_by('id','desc');
                      $last_followup = $this->db->get('school_followup',1)->row_array();

                      $this->db->where('inquiry_id',$info['id']);
                      $cnt  = $this->db->get('school_followup')->num_rows();
                      if(empty($last_followup)){
                        $this->db->where('inquiry_id',$info['id']);
                        $this->db->order_by('id','desc');
                        $last_followup = $this->db->get('school_call_followup',1)->row_array();

                        $this->db->where('inquiry_id',$info['id']);
                        $cnt  = $this->db->get('school_call_followup')->num_rows();
                      }
                    }
                    

                    if(empty($last_followup))
                    {
                      if($info['extra_info']!= '')
                      {
                        $follow_detail = $info['extra_info'];
                        $follow_date = getSimpleDate($info['updated_at']);
                      }
                      else
                      {
                        $follow_detail = 'NA';
                        $follow_date = 'NA';
                      }
                    }
                    else
                    {
                        $follow_detail = $last_followup['followup_reason'];
                        $follow_date = getSimpleDate($last_followup['followup_date']);
                    }

                    // $this->db->where('inquiry_id',$info['id']);
                    // $cnt = $this->db->get('followup')->num_rows();
                     $class = "color:inherit;";
                      $status = $info['status'];
                     if($info['status']=="A"){
                      $class = "color:green;";
                      $status = "Admission";
                    }else if($info['status']=="DP"){
                      $class = "color:red;";
                      $status = "Drop";
                    }
                    else if($info['status']=="V"){
                      $class = "color:#b014c4;";
                      
                      $status = "Visited";
                    }
                    else if($info['status']=="P"){
                      $status = "Pending";
                    }
                    else if($info['status']=="NV"){
                      $status = "Not Visited";
                    }
                    else if($info['status']=="D"){
                      $class = "color:blue;";
                      $status = "Demo";
                    }else if($info['status']=="DC"){
                      $class = "color:#660000";
                      $status = "Declined";
                    }else if($info['status']=="CD"){
                      $class = "color:#660000";
                      $status = "Call Declined";
                    }else if($info['status']=="IC"){
                      $status = "In Calling";
                    }
                    $staff_info = $this->CommonModel->get_staff_info($info['inq_by']);
                    // $demo_details = $this->Inquiry_model->get_inquiry_demo($info['id'],'offline');
                ?> 
                <tr style="<?php echo $class;?>">
                  <td><?php echo $info['id'];?></td>
                  <td>
                    <?php 
                    if(($info['status']=='V' || $info['status']=='D')&& $info['visit_date']!="") { 
                      echo getSimpleDate($info['visit_date']); 
                    }else if($info['status']!='P'){
                      echo getSimpleDate($info['updated_at']); 
                    } ?>
                    
                  </td>
                  <td>
                    <?php echo $info['s_name'];?>
                    <div style="border-top: solid 1px black;margin-top: 5px"></div>
                    <?php echo $info['contact1'];?>
                    <div style="border-top: solid 1px black;margin-top: 5px"></div>
                    <?php echo $info['contact2'];?>
                    <div style="border-top: solid 1px black;margin-top: 5px"></div>
                    <?php echo $info['contact3'];?>
                  </td>
                  <?php 
                  if($role==1||$role==3||$role==4){
                  ?>
                  <td> 
                    <?php echo $info['course'] ?> 
                  
                  </td>
                  <td>
                    <?php echo $info['reference'];?> 
                    <div style="border-top: solid 1px black;margin-top: 5px"></div>
                    <?php echo $info['reference_name'];?>
                  </td>
                  <?php }?>
                  <td>
                      <?php echo $info['expected_date']; ?>
                  </td>
                  <td>
                    <?php echo $info['school_name'];?>
                    <div style="border-top: solid 1px black;margin-top: 5px"></div>
                    <?php echo $info['standard'];?>
                  </td>
                 <td>
                    
                    <?php echo $follow_detail;?>
                    <div style="border-top: solid 1px black;margin-top: 5px"></div>
                    <?php echo $follow_date;?>
                   
                  </td>
                  <td>
                    <?php echo !empty($info['added_by_name']) ? $info['added_by_name'] : 'No Name';?>
                    <div style="border-top: solid 1px black;margin-top: 5px"></div>
                    <?php echo isset($staff_info['name']) ? $staff_info['name'] : 'No Name';?>
                    <div style="border-top: solid 1px black;margin-top: 5px"></div>
                     <?php echo $status; ?>
                  </td>
                  <td align="center">
                    
                    <?php 

                       $user_role =  $this->session->userdata('user_role');

                        if($user_role != 8)
                        {
                     ?>
                    <a class="btn btn-primary btn-xs m-1" href="<?php echo site_url('schoolinq/add_school_inquiry/'.$info['id']);?>"><div class="fas fa-edit"></div></a>

                  <?php } ?>

               
                    <?php 
                    //if($this->session->userdata('user_role')!=3){
                    ?>
                    <!-- <a class="btn btn-primary btn-xs m-1" href="<?php //echo site_url('/demolecture/add_demo_offline/offline/'.$info['id']);?>"><div class="fas fa-clock"></div></a> -->
                    <?php //}?>
                    <!-- <span class="badge badge-warning"><?php //echo $cnt-1;?></span> -->
                    <?php 

                       $user_role =  $this->session->userdata('user_role');

                        if($user_role != 8)
                        {
                     ?>

                        <a class="btn btn-primary btn-xs m-1" href="<?php echo site_url('schoolinq/view_college_followup/'.$info['id']);?>"><div class="fas fa-eye"></div></a>

                    <a class="btn btn-primary btn-xs m-1" href="<?php echo site_url('schoolinq/add_followup_data/'.$info['id']); ?>"><div class="fas fa-plus"></div></a>

                  <?php } else { ?>

                     <a class="btn btn-primary btn-xs m-1" href="<?php echo site_url('schoolinq/view_call_followup/'.$info['id']);?>"><div class="fas fa-eye"></div></a>

                    <a class="btn btn-primary btn-xs m-1" href="<?php echo site_url('schoolinq/add_telecaller_followup/'.$info['id']); ?>"><div class="fas fa-plus"></div></a>

                  <?php 
                  } 
                  ?>
                    <?php if($info['status'] != "A") {  ?>
                    <!-- <a class="btn btn-primary btn-xs m-1" href="<?php //echo site_url('admission/index/'.$info['id'].'/offline') ?>" class="badge badge-success">Admission</a> -->
                    <?php } ?>
                  </td>
                </tr>
              <?php } ?>