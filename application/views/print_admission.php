<?php  defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admission Form</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/fontawesome-free/css/all.min.css')?>">
  <!-- Ionicons -->
  <!--<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">-->
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')?>">
<!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/select2/css/select2.min.css')?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')?>">
  
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/jqvmap/jqvmap.min.css')?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/adminlte.min.css')?>">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')?>">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/daterangepicker/daterangepicker.css')?>">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/summernote/summernote-bs4.css')?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<style type="text/css">
page {
  background: white;
  display: block;
  margin: 0 auto;
  margin-bottom: 0.5cm;
  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
}
page[size="A4"] {  
  width: 21cm;
  height: 29.7cm; 
}
@media print {
  body, page {
    margin: 0;
    box-shadow: 0;
  }
}
</style>

<div class="wrapper">

 
<?php
// echo '<pre>';print_r($student);die;
$this->db->select('sum(amount) as paid');
// $this->db->order_by('id','desc');
$this->db->where('reg_no',$student['regno']);
// $this->db->group_by('reg_no');
$data = $this->db->get('college_fees')->row_array();
?>

  <!-- Content Wrapper. Contains page content -->
 
    <!-- Content Header (Page header) -->
    

    <!-- Main content -->
    <section class="content" >
      <div class="row">
        <div class="col-12 ">
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">

              <div class="card-body">
                <table class="table">
                  <thead>
                    <tr>
                      <th colspan="2" class="text-center">
                        <img src="<?php echo base_url('assets/images/creative-logo-blue.svg');?>" width="380">
                      </th>
                    </tr>                  
                    
                  </thead>
                  <tbody>
                    <tr>
                      <td colspan="2">
                        <table class="table-borderless" width="100%">
                          <tr>
                            <td width="30%">
                              <div class="text-center mt-3">
                                <h4 class="mb-2 font-weight-bold">Reg. No. <?php echo $student['regno'];?></h4>
                                <?php 

                                  if($student['image']!='')
                                  {
                                ?>
                                <img class="profile-user-img img-fluid"
                                     src="<?php echo base_url('upload/college_student_photo/'.$student['image']);?>"
                                     alt="User profile picture" style="height: 200px;width: 150px;max-width: 150px;min-width: 150px;max-height: 200px;min-height: 200px;">
                                   
                                   <?php }
                                    else
                                    {
                                    ?>

                                    <img class="profile-user-img img-fluid"
                                     src="<?php echo base_url('assets/users.jpg')?>"
                                     alt="User profile picture" style="height: 200px;width: 150px;max-width: 150px;min-width: 150px;max-height: 200px;min-height: 200px;">                                

                                    <?php } ?>
                              </div>
                            </td>
                            <td>                              
                                <h3 class="profile-username font-weight-bold"><?php echo $student['student_name']?></h3>
                                <table width="100%" class="table-borderless">
                                  <tr>
                                    <th style="width: 125px">Father Name</td>
                                    <td>:</td>
                                    <td><?php echo $student['father_name']?></td>
                                  </tr>
                                  <tr>
                                    <th style="width: 125px">Mother Name</td>
                                    <td>:</td>
                                    <td><?php echo $student['mother_name']?></td>
                                  </tr>
                                  
                                  <tr>
                                    <th style="width: 125px">Course</td>
                                    <td>:</td>
                                    <td><?php echo $student['college_course']?> <?php if($student['course_stream']!=""){echo $student['course_stream'];}?> - <?php echo $student['college_mode'] ?></td>
                                  </tr>
                                  <tr>
                                    <th style="width: 125px">University</td>
                                    <td>:</td>
                                    <td><?php echo $student['university'] ?> </td>
                                  </tr>
                                  <tr>
                                    <th style="width: 125px">Examination Center</td>
                                    <td>:</td>
                                    <td><?php echo $student['exam_center']; ?> </td>
                                  </tr>
                                  <tr>
                                    <th style="width: 125px">Birth Date</td>
                                    <td>:</td>
                                    <td><?php echo date("d-m-Y",strtotime($student['birth_date'])); ?></td>
                                  </tr>
                                  <tr>
                                    <th style="width: 125px">Contact No.</td>
                                    <td>:</td>
                                    <td><?php echo $student['personal_mobile_no']?> / <?php echo $student['father_mobile_no']?> / <?php echo $student['home_mobile_no']?></td>
                                  </tr>
                                </table>                                
                            </td>
                          </tr>
                        </table>                       

                        
                      </td>
                    </tr>
                    
                    <tr>
                      <th>Fees Details</th>
                      <td>
                        <table class="table-borderless table-sm" width="100%">
                          <tr>
                            <td>Total Fees</td>
                            <td>:</td>
                            <td><?php echo $student['total_fees'];?>/-</td>
                          </tr>
                          <tr>
                            <td>Fees Per Semester</td>
                            <td>:</td>
                            <td><?php echo $student['per_sem_fees'];?></td>
                          </tr>
                        </table>     
                    </tr>
                    <tr>
                      <th>Admission Session</th>
                      <td><?php echo $student['start_session']."-".$student['end_session'];?></td>        
                    </tr>
                    <tr>
                      <th>Join Date</th>
                      <td> <?php echo date("d-m-Y",strtotime($student['join_date'])); ?></td>
                    </tr>
                    <tr>
                      <th>Academic Details</th>
                      <td>
                        <table class="table-borderless table-sm" width="100%">
                          <tr>
                            <td>School/College Name</td>
                            <td>:</td>
                            <td><?php echo $student['school_name'];?></td>
                          </tr>
                           <tr>
                            <td>Passing Year</td>
                            <td>:</td>
                            <td><?php echo date("M-Y",strtotime($student['passing_year']));?></td>
                          </tr>
                          <tr>
                            <td>Percentage</td>
                            <td>:</td>
                            <td><?php echo $student['percentage'];?></td>
                          </tr>
                          <tr>
                            <td>Percentile Rank</td>
                            <td>:</td>
                            <td><?php echo $student['percentile'];?></td>
                          </tr>
                          <tr>
                            <td>Seat No</td>
                            <td>:</td>
                            <td><?php echo $student['seat_no'];?></td>
                          </tr>
                        </table>
                    </tr>
                    <tr>
                      <th>Address</th>
                      <td><?php echo $student['address'];?></td>        
                    </tr>
                    <tr>
                      <th>Category</th>
                      <td><?php echo $student['cast_category'];?></td>        
                    </tr>
                    <tr>
                      <th>Cast</th>
                      <td><?php echo $student['religion']." ".$student['cast'];?></td>        
                    </tr>
                    <tr>
                      <th>Email</th>
                      <td><?php echo $student['email']?></td>        
                    </tr>
                    <tr>
                      <th>Reference</th>
                      <td><?php echo $student['reference']?> / <?php echo $student['reference_name']?></td>        
                    </tr>
                  </tbody>
                </table>
                <table class="table table-borderless">
                  <tr>
                    <th>Student Sign </th>
                    <th>Parent Sign </th>
                    <th>Instructor Sign </th>
                  </tr>
                  <tr>
                    <td>
                      _____________________________
                    </td>
                    <td>
                      _____________________________
                    </td>
                    <td>
                      _____________________________
                    </td>
                  </tr>
                  <tr>
                    <th colspan="3">
                     &nbsp;
                    </th>
                  </tr>
                  <tr>
                    <th colspan="3">
                     &nbsp;
                    </th>
                  </tr>
                  <tr>
                    <th colspan="3">
                     &nbsp;
                    </th>
                  </tr>
                  <tr>
                    <th colspan="3">
                     &nbsp;
                    </th>
                  </tr>
                  <tr>
                    <th colspan="3">
                     &nbsp;
                    </th>
                  </tr>

                  <tr>
                    <th colspan="3">
                     Rules & Regulations:
                    </th>
                  </tr>
                  <tr>
                    <td colspan="3">
                     1) તમારું એડમિશન <b><?php echo $student['university'];?></b> યુનિવર્સિટીમાં <b><?php echo $student['college_course'];?> <?php if($student['course_stream']!=""){echo $student['course_stream'];}?></b> કોર્ષ માં થયેલ છે, CREATIVE INSTITUTE એ STUDY CENTER છે તેમાં તમારે અભ્યાસ માટે આવવાનું રહેશે.RESULT તેમજ તમામ ઓરીજીનલ ડોક્યુમેન્ટ્સ યુનિવર્સિટીમાંથી જ આવશે.

                    </td>
                  </tr>
                  <tr>
                    <td colspan="3">
                     2) સેમેસ્ટરની EXAM તેમજ પ્રોજેક્ટ સબમિશન માટે વિદ્યાર્થીને યુનિવર્સિટી દ્વારા નક્કી કરાયેલ CENTER પર સંસ્થા દ્વારા લઈ જવામાં આવશે, પણ CENTER પર જવા-આવવાનો તેમજ ત્યાં રહેવા અને  જમવાનો ખર્ચ વિધાર્થીનો પોતાનો રહેશે.
                    </td>
                  </tr>
                  <tr>
                    <td colspan="3">
                     3) સરકાર શ્રી તરફ થી મળતી સકોલરશીપ ની તમામ કામગીરી વિદ્યાર્થીએ જાતે કરવાની રહેશે. સ્કોલરશીપ ની તમામ જવાબદારી વિદ્યાર્થીની પોતાની રહેશે,સંસ્થા તેના માટે જવાબદાર રહેશે નહિ.
                    </td>
                  </tr>
                  <tr>
                    <td colspan="3">
                     4) વિધાર્થી જો લેકચરમાં ગેરહાજર રહેશે અને જાણ કરેલ નહિ હોય તો વિધાર્થી ના વાલીએ સંસ્થાને જાણ કરવાની રહેશે પછી જ વિધાર્થીને લેકચરમાં બેસવા દેવામાં આવશે.
                    </td>
                  </tr>
                  
                  <tr>
                    <td colspan="3">
                     5) સંસ્થામાં મોબાઈલ પર પ્રતિબંધ હોવાથી જો મોબાઈલ સાથે લાવો તો બંધ(સ્વિચ ઓફ) કરી ને રાખવો. જો ઉપયોગ કરતા પકડાશો તો મોબાઈલ 7 દિવસ માટે જમા કરી લેવામાં આવશે,જેમાં વાલીએ સહમત થવાનું રહેશે.
                    </td>
                  </tr>
                  <tr>
                    <td colspan="3">
                     6) સંસ્થાની પ્રોપર્ટીને નુકશાન કરતા અથવા કોઈ પણ સ્ટાફ કે વિદ્યાર્થી સાથે ગેર વર્તણૂંક કરશે તો એડમિશન રદ કરી નાખવામાં આવશે અને ફી રીટર્ન મળશે નહિ.
                    </td>
                  </tr>
                  <tr>
                    <td colspan="3">
                     7) સંસ્થાની અંદર કંઈપણ વસ્તુ ખાતા પકડાશે તો 1 Week અભ્યાસ માટે આવવા દેવામાં આવશે નહિ.
                    </td>
                  </tr>
                  <tr>
                    <td colspan="3">
                     8) Form Registration Fee તેમજ સેમેસ્ટરની ફી Non Refundable રહેશે.
                    </td>
                  </tr>
                  <tr>
                    <td colspan="3">
                     9) સંસ્થા દ્વારા નક્કી કરેલ યુનિફોર્મ ફરજીયાત પહેરીને આવવાનું રહેશે. 
                    </td>
                  </tr>
                  <tr>
                    <td colspan="3">
                     10) દરેક સેમેસ્ટરની EXAMINATION FEE તેમજ કોઈ પણ ઓરિજિનલ ડોક્યુમેન્ટ નો ચાર્જ અલગથી યુનિવર્સીટી દ્વારા નક્કી થયેલ હોય તે Extra આપવાના રહેશે.
                    </td>
                  </tr>
                  <tr>
                    <td colspan="3">
                     11) વિદ્યાર્થીના અભ્યાસ તેમજ તેમના પર્ફોમન્સનો રિપોર્ટ વાલીને સંસ્થા તરફથી રાખવામાં આવતી વાલી મિટિંગ માં જ આપવામાં આવશે અને તે માટે વાલીએ મિટિંગ માં ફરજીયાત આવવાનું રહેશે.
                    </td>
                  </tr>
                  <tr>
                    <td colspan="3">
                     12) સેમેસ્ટરની Exam માટે જવાનું થાય ત્યારે કોઈ કારણસર જાનહાની કે અકસ્માત થાય તો તેના માટે સંસ્થા જવાબદાર રહેશે નહિ. 
                    </td>
                  </tr>
                  <tr>
                    <td colspan="3">
                     13) Exam આપવા માટે જવાનું થાય ત્યારે જો સંસ્થા તરફથી નક્કી કરેલ બસ અને રહેવાનું હોય તો મોબાઈલ પર પ્રતિબંધ છે જો મોબાઈલ સાથે રાખવો હોય તો વિદ્યાર્થીએ પોતાની રીતે જવાનું તેમજ રહેવાનું રહેશે.
                    </td>
                  </tr>
                  <?php if($student['university']=="SSIU"){ ?>
                  <!-- <tr>
                    <td colspan="3">
                     15) 3000/- યુનિવર્સિટી દ્વારા જે ડિપોઝિટ લેવામાં આવે છે તે કોલેજ પૂરી થયા પછી Degree Certificate લેવા આવે ત્યારે મળશે તે પહેલા મળશે નહિ .
                    </td>
                  </tr> -->
                    <?php } ?>
                  <tr>
                    <td colspan="3">
                     <b>નોંધઃ ઉપરનાં બધાં નિયમો મેં બરાબર વાંચેલાં છે અને આ બધા નિયમો સાથે હું સહમત છું અને બધાં નિયમો સમજીને પછી જ મેં એડમિશન મેળવેલ છે.</b> 
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <b>તારીખ</b>
                    </td>
                    <td>
                      <b>વાલીની સહી</b>
                    </td>
                    <td>
                      <b>વિદ્યાર્થીની સહી </b>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <b><?php echo date("d-m-Y");?></b>
                    </td>
                    <td>
                      _____________________________
                    </td>
                    <td>
                      _____________________________
                    </td>
                  </tr>
                  <?php 
                  if($student['document_list']!= "" && strpos($student['document_list'], "Original") !== false){
                    $documents_list = explode(",", $student['document_list']);
                  ?>
                  <tr>
                    <th colspan="3">
                     Received Documents:
                    </th>
                  </tr>
                  <tr>
                    <th>Document</th>
                    <th>Returned Date</th>
                    <th>Signature</th>
                  </tr>
                  <?php 
                  $k=1;
                    foreach($documents_list as $doc){
                      if(strpos($doc, "Original") !== false){
                  ?>
                    <tr>
                      <th><?php echo $k.") ".$doc;?></th>
                      <td>_____________________________</td>
                      <td>_____________________________</td>
                    </tr>
                  <?php 
                      $k++;
                      }
                    }

                  }
                  ?>
                  <tr>
                    <td>_____________________________</td>
                    <td>_____________________________</td>
                    <td>_____________________________</td>
                  </tr>
                  <tr>
                    <td>_____________________________</td>
                    <td>_____________________________</td>
                    <td>_____________________________</td>
                  </tr>
                  <tr>
                    <td>_____________________________</td>
                    <td>_____________________________</td>
                    <td>_____________________________</td>
                  </tr>
                </table>
              </div>
             </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  
 <script type="text/javascript">
   window.onload=function(){
    window.print();
   }
 </script>