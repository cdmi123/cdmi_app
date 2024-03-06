<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
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
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
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
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <style type="text/css">
      
      .receipt-print td
      {
        padding: 7px;
      }
      .myTableBg4:before {
        content: '';
        position: absolute;
        height: 100%;
        width: 100%;
        top: 0;
        left: 0;
        opacity: .10; 
        background-image:url('<?php echo base_url('assets/images/logo-square.png');?>');
        background-repeat: no-repeat;
        background-position: center 175px;
        filter: grayscale();
      }
    </style>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12 ">
          <div class="card shadow-none m-4">
            <!-- /.card-header -->
              <div class="card-body px-4 py-2 border border-secondary myTableBg4">
                <table class="table table-borderless receipt-print" style="">
                  <thead class="border-bottom">
                    <tr> 
                      <th colspan="3" class="text-center p-1"><h2 class="font-weight-bold">Fees Receipt</h2> </th>
                    </tr>
                    <tr>
                      <th  class="text-left pl-4">
                        <?php 
                        if(isset($ac_info)){
                          $logo = $ac_info['logo'];
                        }else{
                          $logo = 'creative-logo-blue.svg';
                        }
                        ?>
                        <img src="<?php echo base_url('assets/images/'.$logo);?>" width="380">
                      </th>
                      <td valign="middle" class="pt-4">
                          <i class="fa fa-phone fa-rotate-90"></i>&nbsp;&nbsp;
                          <b class="py-1 d-inline-block">90333 16003</b><br>
                          <i class="fa fa-envelope"></i>&nbsp;&nbsp;
                          <b class="py-1 d-inline-block">info@cdmi.in</b><br>
                          <i class="fa fa-globe"></i>&nbsp;&nbsp;
                          <b class="py-1 d-inline-block">www.cdmi.in</b><br>
                      </td>
                    </tr>                  
                    
                  </thead>
                  <tbody>
                    <tr>
                      <td colspan="2">
                        <table class="table-borderless text-uppercase" width="100%">
                          <tr>
                            <td width="30%">
                              <h3 class="profile-username font-weight-bold">Rec. No : <?php 
                              // if($info['ac_rec_no']>0){
                              //   echo $info['ac_rec_no'];
                              // }else{
                                echo $info['rec_no'];  
                              // }
                              ?></h3>
                            </td>
                            <td width="40%" class="text-center">
                                <h3 class="profile-username font-weight-bold">GR No. : <?php echo $info['reg_no'];?></h3>
                            </td>
                            <td width="30%">
                              <h3 class="profile-username font-weight-bold">Date : <?php echo date("d-m-Y",strtotime($info['date']));?></h3>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="3">                              
                                <h3 class="profile-username font-weight-bold">Student Name : <?php echo $info['student_name'];?></h3>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="2">                              
                                <h3 class="profile-username font-weight-bold">Course : <?php echo $info['course'];?></h3>
                            </td> 
                            <td width="30%">
                              <!-- <h3 class="profile-username font-weight-bold">Installment No : <?php //echo $info['installment_no'];?></h3> -->
                            </td>                           
                          </tr>
                          
                          <tr>
                            <td width="70%" colspan="2">
                              
                            
                              <h3 class="profile-username font-weight-bold">
                               Payment By : <?php echo $info['payment_mode'];?> <?php if($info['payment_mode']!="CASH"){
                                      ?>
                                   <?php echo $info['payment_detail'];?>
                                    <?php }?>
                              </h3>
                            </td>
                            <td width="30%">
                              <h3 class="profile-username font-weight-bold">Amount : <?php echo $info['amount']*10;?>/-</h3>
                            </td>
                            
                            
                          </tr>
                          <tr>
                            <td colspan="3" width="70%">
                              <h3 class="profile-username font-weight-bold">
                                Amount in Words : <?php echo getIndianCurrency($info['amount']*10).' ONLY';?>
                              </h3>
                            </td>                            
                          </tr>
                          <?php if(!empty($next_installment)){?>
                          <!-- <tr>
                            <td colspan="3" width="70%">
                              <h3 class="profile-username font-weight-bold">
                                NEXT INSTALLMENT OF RS. <?php //echo $next_installment['amount'];?> ON <?php //echo date("d-m-Y",strtotime($next_installment['date']));?>
                              </h3>
                            </td>                            
                          </tr> -->
                          <?php }?>
                          <tr>
                            <td>
                              <h3 class="profile-username font-weight-bold">Student Sign </h3>
                            </td>
                            <td>
                               <h3 class="profile-username font-weight-bold">Create By: <?php echo $info['create_by_name'];?> </h3>
                            </td>
                            <td>
                              <h3 class="profile-username font-weight-bold">Receiver's Sign </h3>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              _____________________________
                            </td>
                            <td>
                              
                            </td>
                            <td>
                              _____________________________
                            </td>
                          </tr>
                          <tr> 
                              <th colspan="2">Note : Fees will be not refundable in any cases.</th>
                              <!-- <th>
                                <?php 
                                //if($info['ac_rec_no']>0){
                                ?>
                                Ref. No. : <?php //echo $info['ac_rec_no'];?>
                                <?php //}?>
                              </th> -->
                          </tr>
                        </table>                       

                        
                      </td>
                    </tr>
                    
                  </tbody>
                </table>
                
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