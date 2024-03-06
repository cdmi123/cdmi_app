<!DOCTYPE html>
<html>
<head>
     <meta charset="UTF-8">
     <title>Creative Multimedia | Dashboard</title>
     <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
     <meta name="robots" content="noindex,nofollow" />
     <!-- bootstrap 3.0.2 -->
     <link href="<?php echo base_url('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')?>" rel="stylesheet" type="text/css" />
     <!-- Theme style -->
     <link href="<?php echo base_url('assets/dist/css/adminlte.min.css')?>" rel="stylesheet" type="text/css" />
</head>
<body>

     <div class="book">
          <div class="page">
              <div class="subpage">
                    <table class="table table-bordered" width="100%">
                         <tr>
                              <td colspan="6">
                                   <table class="inner-table" width="100%" cellpadding="10">
                                        <?php 
                                        if($student['university']=="SRK"){
                                        ?>
                                        <tr>
                                             <td width="15%">
                                                  <img src="<?php echo base_url('assets/images/'); ?>srkuniversity-circle.png" style="margin-top: 30px;">
                                             </td>
                                             <td width="65%" align="center">
                                                  <font size="5"><b>SARVEPALLI RADHAKRISHNAN<br>UNIVERSITY, BHOPAL</b></font>
                                                  <p style="margin-bottom: 5px;">Under Section M.P. Act No: 17 of 2007 & covered u/s 2 (f) of Act UGC under Act and Approved by AICTE, PCI, DCI, CCH, INC & MCI, NEW DELHI.</p>
                                                  <b>URL : <a href="#">www.srku.edu.in/</a></b><br>
                                                  <b>Pre-Printed Examination Form</b>
                                             </td>
                                             <td width="20%">
                                                  <div style="height: 150px;border: 1px #000 solid;overflow: hidden;background-color: #fff;">
                                                       <img src="<?php echo base_url('upload/college_student_photo/'.$student['image']);?>" width="100%" >
                                                  </div>
                                             </td>
                                        </tr>
                                        <?php
                                        }else if($student['university']=="SSIU"){
                                        ?>
                                        <tr>
                                             <td width="15%">
                                                  <img src="<?php echo base_url('assets/images/'); ?>ssiu.png" style="margin-top: 30px;">
                                             </td>
                                             <td width="65%" align="center">
                                                  <font size="5"><b>Swarrnim Startup & Innovation<br>University, Gandhinagar</b></font>
                                                  <p style="margin-bottom: 5px;">Approved by the Government of Gujarat under the Gujarat Private University Act No. 10 of 2017</p>
                                                  <b>Website : <a href="#">https://www.swarrnim.edu.in</a></b><br>
                                                  <!-- <b>Pre-Printed Examination Form</b> -->
                                                  <b>Enrollment Form</b>
                                             </td>
                                             <td width="20%">
                                                  <div style="height: 150px;border: 1px #000 solid;overflow: hidden;background-color: #fff;">
                                                       <img src="<?php echo base_url('upload/college_student_photo/'.$student['image']);?>" width="100%" >
                                                  </div>
                                             </td>
                                        </tr>
                                        <?php
                                        }else if($student['university']=="SAURASHTRA"){
                                        ?>
                                        <tr>
                                             <td width="15%">
                                                  <img src="<?php echo base_url('assets/images/'); ?>saurashtra.png" style="margin-top: 5px;">
                                             </td>
                                             <td width="65%" align="center">
                                                  <font size="5"><b>SAURASHTRA UNIVERSITY<br>University Campus, Rajkot - 360005 INDIA</b></font>
                                                  <b><a href="https://www.saurashtrauniversity.edu">www.saurashtrauniversity.edu</a></b><br>
                                                  <h3>Enrollment Form</h3>
                                             </td>
                                             <td width="20%">
                                                  <div style="height: 150px;border: 1px #000 solid;overflow: hidden;background-color: #fff;">
                                                       <img src="<?php echo base_url('upload/college_student_photo/'.$student['image']);?>" width="100%" >
                                                  </div>
                                             </td>
                                        </tr>
                                        <?php }?>
                                   </table>
                              </td>
                         </tr>
                         <tr>
                              <th width="150px">Exam Name </th>
                              <td colspan="5"><?php echo $exam_name; ?></td>
                         </tr>
                         <tr>
                              <th width="150px">Collage Name </th>
                              <td colspan="5"><?php echo $institute_name; ?></td>
                         </tr>
                         <tr>
                              <th width="150px">Enrollment No </th>
                              <td colspan="5"><?php echo $student['enrollment_no']; ?></td>
                         </tr>
                         <tr>
                              <th width="150px">Name </th>
                              <td colspan="5"><?php echo $student['student_name']?></td>
                         </tr>
                         <tr>
                              <th width="150px">Gender </th>
                              <td ><?php echo $student['gender']?></td>
                              <th width="150px">Cast </th>
                              <td ><?php echo $student['cast_category']?></td>
                              <th width="150px">PH </th>
                              <td >No</td>
                         </tr>
                         <tr>
                              <th width="150px">Resi. Address </th>
                              <td colspan="5"><?php echo $student['address'];?></td>
                         </tr>
                         <tr>
                              <th width="150px">Exam Type </th>
                              <td colspan="2">Whole</td>
                              <th width="150px">Answering Language</th>
                              <td colspan="2">English</td>
                         </tr>
                         <tr>
                              <td colspan="6">
                                   <input type="checkbox" checked style="position: relative;top: 2px;">
                                   <span style="margin-left: 5px;"><b>I give my consent to send me SMS on my below mentioned mobile number.</b>
                                   </span>
                              </td>
                         </tr>
                         <tr>
                              <th width="150px">Mobile No </th>
                              <td colspan="2"><?php echo $student['personal_mobile_no'];?></td>
                              <th width="150px">Email Address</th>
                              <td colspan="2" style="word-break: break-all;"><?php echo $student['email'];?></td>
                         </tr>
                         <tr>
                              <th width="150px">Subject Group </th>
                              <th colspan="5">Subject Name (Enrollment No - <?php echo $student['enrollment_no']; ?>)</th>
                         </tr>
                         <!-- <tr>
                              <th colspan="6">CORE | (Select 0 course(s) only)</th>
                         </tr> -->
                         <?php 
                         foreach($subjects as $subject){

                         
                          ?>
                         <tr>
                              <th width="150px" class="text-center"><input type="checkbox" checked> </th>
                              <td colspan="5"><?php echo $subject['subject_code'].' - '.$subject['subject_name']; ?></td>
                         </tr>
                         <?php } ?>
                         
                         <!-- <tr>
                              <th width="150px">Subject Group </th>
                              <th colspan="5">Subject Name (Enrollment No - 003203201439)</th>
                         </tr>
                         <tr>
                              <th colspan="6">PRACTICAL | (Select 0 course(s) only)</th>
                         </tr>
                         <tr>
                              <th width="150px" class="text-center"><input type="checkbox" checked> </th>
                              <td colspan="5">CS-01 TECHNICAL COMMUNICATION SKILL</td>
                         </tr>
                         <tr>
                              <th width="150px" class="text-center"><input type="checkbox" checked> </th>
                              <td colspan="5">CS-01 TECHNICAL COMMUNICATION SKILL</td>
                         </tr> -->
                         <tr>
                              <td colspan="6">
                                   <div style="padding: 40px 20px 0;float: left;">
                                        <p style="font-weight: bold;width:200px;text-align:center;padding: 5px 30px;border-top: 1px #000 solid;">Student Sign</p>
                                   </div>
                                   <div style="padding: 40px 20px 0;float: right;">
                                        <p style="font-weight: bold;width:200px;text-align:center;padding: 5px 30px;border-top: 1px #000 solid;">Principal Sign</p>
                                   </div>
                              </td>
                         </tr>
                    </table>
               </div>
          </div>
     </div>

     <style>
          body {
               width: 100%;
               height: 100%;
               margin: 0;
               padding: 0;
               background-color: #FAFAFA;
          }
          * {
               box-sizing: border-box;
               -moz-box-sizing: border-box;

          }
          .page {
               width: 210mm;
               min-height: 297mm;
               padding: 30px;
               margin: 10px auto;
               border: 1px #D3D3D3 solid;
               border-radius: 5px;
               background: white;
               box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
          }
          .subpage {
               padding: 5px;
               height: 257mm;
          }
          .table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td
          {
               padding: 4px 8px;
               border: 1px solid #000;
          }
          
          @page {
               size: A4;
               margin: 0;
          }
          @media print {
               html, body {
                    width: 210mm;
                    height: 297mm;        
               }
               .page {
                    margin: 0;
                    border: initial;
                    border-radius: initial;
                    width: initial;
                    min-height: initial;
                    box-shadow: initial;
                    background: initial;
                    page-break-after: always;
               }
               .inner-table>thead>tr>th, .inner-table>tbody>tr>th, .inner-table>tfoot>tr>th, .inner-table>thead>tr>td, .inner-table>tbody>tr>td, .inner-table>tfoot>tr>td
               {
                    border: none!important;
               }
          }
     </style>

</body>
</html>
 <script type="text/javascript">
   window.onload=function(){
    window.print();
   }
 </script>