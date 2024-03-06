<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Salary Slip</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <style type="text/css">
      
      .receipt-print td, .receipt-print th
      {
        padding: 5px;
      }
      .myTableBg4:before {
        content: '';
        position: absolute;
        height: 100%;
        width: 100%;
        top: 0;
        left: 0;
        opacity: .08; 
        background-image:url('assets/images/logo-square.png');
        background-repeat: no-repeat;
        background-position: center 175px;
        background-size: 500px 500px;
        filter: grayscale();
      }
      .borderB
      {
        border-bottom: 1px #aaa solid;
      }
     
    </style>

    <!-- Main content -->
    <section class="content mb-4">
      <div class="row">
        <div class="col-12 ">
          <div class="card shadow-none m-3">
            <!-- /.card-header -->
              <div class="card-body px-4 py-2 border border-secondary myTableBg4">
                <table class="table table-borderless receipt-print mb-0" >
                  <thead class="borderB">
                    <tr>
                      <th colspan="3">
                        <table width="100%">
                          <tr>
                            <td class="text-left pl-2 w-50" align="center">
                              <img src="<?php echo base_url('assets/images/creative-logo-blue.svg');?>" width="380">
                            </td>
                            <td class="text-left">
                              <p class="m-0 mt-2 float-right" style="font-size: 20px;font-weight: bold;">Office Address:<br> <span style="font-weight: normal;">401, 4<sup>th</sup> Floor, City Center, Yogichowk,<br> Surat - 395006.</span></p>
                            </td>
                          </tr>
                        </table>
                      </th>

                    </tr>               
                    
                  </thead>
                  <tbody>
                    <tr>
                      <td colspan="3" align="center">
                        <p style="display: inline-block;border: 1px #aaa solid; padding: 8px 20px; margin: 10px 5px;  font-size: 24px;font-weight: bold;">Salary slip for the Month of <?php echo date('F-Y',strtotime($sal_info['salary_month']));?></p>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="2">
                        <table class="table-borderles text-uppercase mb-0" width="100%">
                          <tr>
                            <td colspan="2">                              
                                <h5 class="profile-username font-weight-bold">
                                  Name : 
                                  <span class="font-weight-normal"><?php echo $emp_info['fullname'];?></span>
                                </h5>
                            </td>
                            <td width="50%">
                              <h5 class="profile-username font-weight-bold text-right">
                                Mobile No. : 
                                <span class="font-weight-normal">+91-<?php echo $emp_info['mobile'];?></span>
                              </h5>
                            </td> 
                          </tr>
                          <tr>
                            <td colspan="3">                              
                                <h5 class="profile-username font-weight-bold">
                                  Designation : 
                                  <span class="font-weight-normal"><?php echo $emp_info['designation'];?></span>
                                </h5>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="2">                              
                                <h5 class="profile-username font-weight-bold">
                                  Date : 
                                  <span class="font-weight-normal"><?php echo date('d-M-Y',strtotime($sal_info['date']));?></span>
                                </h5>
                            </td> 
                            <td width="50%">
                              <h5 class="profile-username font-weight-bold text-right">
                                Payment Mode : 
                                <span class="font-weight-normal">By <?php echo $sal_info['payment_mode'];?></span>
                              </h5>
                            </td>                           
                          </tr>
                          <tr>
                            <td colspan="3"> 
                              <table class="table table-bordered mb-0 borderColor" width="100%" style="font-size: 18px;">
                                <tr>
                                  <th width="70%">Description</th>
                                  <th class="text-right pr-4" width="20%">Amount</th>
                                </tr>
                                <tr>
                                  <td>Basic Salary</td>
                                  <td class="text-right pr-4" width="20%">₹ <?php echo $sal_info['total_salary'];?>/-</td>
                                </tr>
                                <?php 
                                if($sal_info['tax'] > 0){
                                ?>
                                <tr>
                                  <td>Professional Tax</td>
                                  <td class="text-right pr-4" width="20%">₹ <?php echo $sal_info['tax'];?>/-</td>
                                </tr>
                                <?php }?>
                                <?php 
                                if($sal_info['extra_deduction'] > 0){
                                ?>
                                <tr>
                                  <td>Leave Details - <?php echo $sal_info['description'];?></td>
                                  <td class="text-right pr-4" width="20%">₹ <?php echo $sal_info['extra_deduction']?>/-</td>
                                </tr>
                                <?php }?>
                                <?php 
                                if($sal_info['deposit'] > 0){
                                ?>
                                <tr>
                                  <td>Deposit Amount (10%)</td>
                                  <td class="text-right pr-4" width="20%">₹ <?php echo $sal_info['deposit'];?>/-</td>
                                </tr>
                                <?php }?>
                                <tr>
                                  <th>Net Payment</th>
                                  <th class="text-right pr-4" width="20%">₹ <?php echo $sal_info['payable_salary'];?>/-</th>
                                </tr>
                                <tr>                                  
                                  <th colspan="2">In Words : <?php echo getIndianCurrency($sal_info['payable_salary']).' ONLY';?></th> 
                                </tr>
                              </table>
                            </td>
                          </tr>
                        </table>                        
                      </td>
                    </tr>  
                    <tr>
                      <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="left">
                        <h5 class="font-weight-bold">Employee's Sign _________________________</h5>  
                      </td>
                      <td align="right">
                        <h5 class="font-weight-bold">Authorised Sign _________________________</h5> 
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

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12 ">
          <div class="card shadow-none m-3">
            <!-- /.card-header -->
              <div class="card-body px-4 py-2 border border-secondary myTableBg4">
                <table class="table table-borderless receipt-print mb-0" >
                  <thead class="borderB">
                    <tr>
                      <th colspan="3">
                        <table width="100%">
                          <tr>
                            <td class="text-left pl-2 w-50" align="center">
                              <img src="<?php echo base_url('assets/images/creative-logo-blue.svg');?>" width="380">
                            </td>
                            <td class="text-left">
                              <p class="m-0 mt-2 float-right" style="font-size: 20px;font-weight: bold;">Office Address:<br> <span style="font-weight: normal;">401, 4<sup>th</sup> Floor, City Center, Yogichowk,<br> Surat - 395006.</span></p>
                            </td>
                          </tr>
                        </table>
                      </th>

                    </tr>               
                    
                  </thead>
                  <tbody>
                    <tr>
                      <td colspan="3" align="center">
                        <p style="display: inline-block;border: 1px #aaa solid; padding: 8px 20px; margin: 10px 5px;  font-size: 24px;font-weight: bold;">Salary slip for the Month of <?php echo date('F-Y',strtotime($sal_info['salary_month']));?></p>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="2">
                        <table class="table-borderles text-uppercase mb-0" width="100%">
                          <tr>
                            <td colspan="2">                              
                                <h5 class="profile-username font-weight-bold">
                                  Name : 
                                  <span class="font-weight-normal"><?php echo $emp_info['fullname'];?></span>
                                </h5>
                            </td>
                            <td width="50%">
                              <h5 class="profile-username font-weight-bold text-right">
                                Mobile No. : 
                                <span class="font-weight-normal">+91-<?php echo $emp_info['mobile'];?></span>
                              </h5>
                            </td> 
                          </tr>
                          <tr>
                            <td colspan="3">                              
                                <h5 class="profile-username font-weight-bold">
                                  Designation : 
                                  <span class="font-weight-normal"><?php echo $emp_info['designation'];?></span>
                                </h5>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="2">                              
                                <h5 class="profile-username font-weight-bold">
                                  Date : 
                                  <span class="font-weight-normal"><?php echo date('d-M-Y',strtotime($sal_info['date']));?></span>
                                </h5>
                            </td> 
                            <td width="50%">
                              <h5 class="profile-username font-weight-bold text-right">
                                Payment Mode : 
                                <span class="font-weight-normal">By <?php echo $sal_info['payment_mode'];?></span>
                              </h5>
                            </td>                           
                          </tr>
                          <tr>
                            <td colspan="3"> 
                              <table class="table table-bordered mb-0 borderColor" width="100%" style="font-size: 18px;">
                                <tr>
                                  <th width="70%">Description</th>
                                  <th class="text-right pr-4" width="20%">Amount</th>
                                </tr>
                                <tr>
                                  <td>Basic Salary</td>
                                  <td class="text-right pr-4" width="20%">₹ <?php echo $sal_info['total_salary'];?>/-</td>
                                </tr>
                                <?php 
                                if($sal_info['tax'] > 0){
                                ?>
                                <tr>
                                  <td>Professional Tax</td>
                                  <td class="text-right pr-4" width="20%">₹ <?php echo $sal_info['tax'];?>/-</td>
                                </tr>
                                <?php }?>
                                <?php 
                                if($sal_info['extra_deduction'] > 0){
                                ?>
                                <tr>
                                  <td>Leave Details - <?php echo $sal_info['description'];?></td>
                                  <td class="text-right pr-4" width="20%">₹ <?php echo $sal_info['extra_deduction']?>/-</td>
                                </tr>
                                <?php }?>
                                <?php 
                                if($sal_info['deposit'] > 0){
                                ?>
                                <tr>
                                  <td>Deposit Amount (10%)</td>
                                  <td class="text-right pr-4" width="20%">₹ <?php echo $sal_info['deposit'];?>/-</td>
                                </tr>
                                <?php }?>
                                <tr>
                                  <th>Net Payment</th>
                                  <th class="text-right pr-4" width="20%">₹ <?php echo $sal_info['payable_salary'];?>/-</th>
                                </tr>
                                <tr>                                  
                                  <th colspan="2">In Words : <?php echo getIndianCurrency($sal_info['payable_salary']).' ONLY';?></th> 
                                </tr>
                              </table>
                            </td>
                          </tr>
                        </table>                        
                      </td>
                    </tr>  
                    <tr>
                      <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="left">
                        <h5 class="font-weight-bold">Employee's Sign _________________________</h5>  
                      </td>
                      <td align="right">
                        <h5 class="font-weight-bold">Authorised Sign _________________________</h5> 
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