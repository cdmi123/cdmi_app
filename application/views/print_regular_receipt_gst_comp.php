<?php 
if($info['gst']=="YES-IN"){
  $net_amt = $info['amount'];
  $amount = $info['net_amt'];
}else{
  $net_amt = $info['net_amt'];
  $amount = $info['amount'];
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Bill of Supply - CMI</title>
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
      
      body {
               width: 100%;
               height: 100%;
               margin: 0;
               padding: 0;
          }
          * {
               box-sizing: border-box;
               -moz-box-sizing: border-box;

          }
          .page {
               width: 210mm;
               min-height: 297mm;
               padding: 10px;
               margin: 10px auto;
               border: 1px #ccc solid;
               border-radius: 5px;
               background: white;
               box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
               page-break-after: always;
          }
      .receipt-print td, .receipt-print th
      {
        padding: 4px;
        font-family: calibri;
        font-size: 15px;
      }
      .amount_data td, .amount_data th
      {
        border: 1px #aaa solid;
      }
      .myTableBg4:before {
        content: '';
        position: absolute;
        height: 100%;
        width: 100%;
        top: 50%;
        left: 0;
        transform: translateY(-50%);
        opacity: .08; 
        background-image:url('assets/images/logo-square.png');
        background-repeat: no-repeat;
        background-position: center 175px;
        background-size: 500px 500px;
        filter: grayscale();
      }
      .borderB
      {
        border-bottom: 2px #000 solid;
      }
      h5{
        margin: 0;
      }
      .gst_no{
        position: absolute;
        top: 25px;
        right: 0;
        padding: 0px 10px;
        font-weight: bold;
        font-size: 18px;
        text-transform: uppercase;
        background-color: #fff;
      }
      .sac_no{
        position: absolute;
        top: 25px;
        left: 0;
        padding: 0px 10px;
        font-weight: bold;
        font-size: 18px;
        text-transform: uppercase;
        background-color: #fff;
      }
      .subpage {
               position: relative;
               height: 100%;
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
               .subpage {
                    position: relative;
                    height: 360mm;
               }

          }
     
    </style>

    <!-- Main content -->
    <section class="content mb-3 page">
      <div class="subpage">
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
                                <td class="pl-2" align="center">
                                  <img src="<?php echo base_url();?>/assets/images/<?php echo $ac_info['logo'];?>" style="filter: grayscale();" width="380">
                                </td>                            
                              </tr>
                              <tr>
                                <td align="center">
                                  <p class="m-0" style="font-size: 20px;font-weight: bold;">401, 4<sup>th</sup> Floor, City Center, Yogichowk, Surat - 395006.</p>
                                </td>
                              </tr>
                            </table>
                          </th>
                        </tr>                     
                      </thead>
                      <tbody>
                        <tr>
                          <td colspan="3" align="center" class="position-relative">
                            <div class="sac_no" >SAC NO. : 9992</div>
                            <p style="background-color:#fff;display: inline-block;border: 1px #aaa solid; padding: 8px 20px; margin: 5px 5px;  font-size: 24px;font-weight: bold;">Bill of Supply</p>
                            <div class="gst_no" >GST NO. : 24AARFC6196Q1ZH</div>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="2">
                            <table class="table-borderles text-uppercase mb-0" width="100%">
                              <tr>
                                <td width="30%">
                                  <h5 class="profile-username font-weight-bold">Rec. No : <?php echo $info['ac_rec_no'];?></h5>
                                </td>
                                <td width="40%" class="text-center">
                                    <h5 class="profile-username font-weight-bold">GR No. : <?php echo $info['reg_no'];?></h5>
                                </td>
                                <td width="30%" align="right">
                                  <h5 class="profile-username font-weight-bold">Date :  <?php echo date("d-m-Y",strtotime($info['date']));?></h5>
                                </td>
                              </tr>
                              <tr>
                                <td colspan="2">                              
                                    <h5 class="profile-username font-weight-bold">
                                      Student Name : 
                                      <span class="font-weight-normal"><?php echo $info['student_name'];?></span>
                                    </h5>
                                </td>
                                <td width="50%">
                                  <h5 class="profile-username font-weight-bold text-right">
                                   <!--  Installment No. : 
                                    <span class="font-weight-normal"><?php //echo $info['installment_no'];?></span> -->
                                  </h5>
                                </td> 
                              </tr>
                              <tr>
                                <td colspan="3">                              
                                    <h5 class="profile-username font-weight-bold">
                                      Course : 
                                      <span class="font-weight-normal"><?php echo $info['course'];?></span>
                                    </h5>
                                </td>
                              </tr>
                              <tr>
                                <td colspan="3">
                                  <h5 class="profile-username font-weight-bold text-left">
                                    Payment By : 
                                    <span class="font-weight-normal"><?php echo $info['payment_mode'];?> 
                                    <?php if($info['payment_mode']!="CASH"){?> / <?php echo $info['payment_detail'];?>
                                        <?php }?></span>
                                  </h5>
                                </td>    
                              </tr>
                              <tr>
                                <td colspan="3"> 
                                  <table class="table amount_data mb-0" width="100%" style="font-size: 18px;">
                                    <tr>
                                      <th width="70%">Description</th>
                                      <th class="text-right pr-4" width="20%">Amount</th>
                                    </tr>
                                    <tr>
                                      <td>Installment Amount</td>
                                      <td class="text-right pr-4" width="20%">₹ <?php echo number_format($amount);?>/-</td>
                                    </tr>
                                    
                                    
                                    <tr>
                                      <td colspan="2" >
                                        <table class="table mb-0" width="100%">
                                          <tr style="border: none !important;">
                                            <th class="p-0" style="border: none !important;padding-left: 0;">In Words :</th>
                                            <th class="border-0 p-0 text-right" style="border: none !important;"> <?php echo getIndianCurrency($net_amt).' ONLY';?></th>
                                          </tr>
                                        </table>
                                      </td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                              <?php //if(!empty($next_installment)){?>
                              <!-- <tr>
                                <td colspan="3" align="center">
                                  <h5 class="profile-username font-weight-bold">
                                    NEXT INSTALLMENT OF RS. <?php //echo $next_installment['amount'];?> ON <?php //echo date("d-m-Y",strtotime($next_installment['date']));?></h5>
                                    <br><br>
                                </td>                             
                              </tr> -->
                              <?php //}?>
                            </table>                        
                          </td>
                        </tr>  
                        <tr>
                          <td align="left">
                            _______________________________<br> 
                            <h5 class="font-weight-bold ml-4 pl-4">Student's Sign</h5>
                          </td>
                          <td align="right">
                            _______________________________ 
                            <h5 class="font-weight-bold mr-4 pr-4">Receiver's Sign</h5>
                          </td>
                        </tr>  
                        <tr> 
                          <th colspan="2"><h5 class="font-weight-bold">Composition Taxable Person, Not Eligible to Collect Tax on Supplies.</h5></th>
                          
                        </tr>
                        <tr> 
                          <th><h5 class="font-weight-bold">Note : Fees will be not refundable in any cases.</h5></th>
                          <th class="text-right pr-5 text-muted"><h5 class="font-weight-bold">Ref. No : <?php echo $info['rec_no'];?></h5></th>
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
                                <td class="pl-2" align="center">
                                  <img src="<?php echo base_url();?>/assets/images/<?php echo $ac_info['logo'];?>" style="filter: grayscale();" width="380">
                                </td>                            
                              </tr>
                              <tr>
                                <td align="center">
                                  <p class="m-0" style="font-size: 20px;font-weight: bold;">401-404, 4<sup>th</sup> Floor, City Center, Yogichowk, Surat - 395006.</p>
                                </td>
                              </tr>
                            </table>
                          </th>
                        </tr>                     
                      </thead>
                      <tbody>
                        <tr>
                          <td colspan="3" align="center" class="position-relative">
                            <div class="sac_no" >SAC NO. : 9992</div>
                            <p style="background-color:#fff;display: inline-block;border: 1px #aaa solid; padding: 8px 20px; margin: 5px 5px;  font-size: 24px;font-weight: bold;">Bill of Supply</p>
                            <div class="gst_no" >GST NO. : 24AARFC6171F1ZD</div>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="2">
                            <table class="table-borderles text-uppercase mb-0" width="100%">
                              <tr>
                                <td width="30%">
                                  <h5 class="profile-username font-weight-bold">Rec. No : <?php echo $info['ac_rec_no'];?></h5>
                                </td>
                                <td width="40%" class="text-center">
                                    <h5 class="profile-username font-weight-bold">GR No. : <?php echo $info['reg_no'];?></h5>
                                </td>
                                <td width="30%" align="right">
                                  <h5 class="profile-username font-weight-bold">Date :  <?php echo date("d-m-Y",strtotime($info['date']));?></h5>
                                </td>
                              </tr>
                              <tr>
                                <td colspan="2">                              
                                    <h5 class="profile-username font-weight-bold">
                                      Student Name : 
                                      <span class="font-weight-normal"><?php echo $info['student_name'];?></span>
                                    </h5>
                                </td>
                                <td width="50%">
                                  <h5 class="profile-username font-weight-bold text-right">
                                   <!--  Installment No. : 
                                    <span class="font-weight-normal"><?php //echo $info['installment_no'];?></span> -->
                                  </h5>
                                </td> 
                              </tr>
                              <tr>
                                <td colspan="3">                              
                                    <h5 class="profile-username font-weight-bold">
                                      Course : 
                                      <span class="font-weight-normal"><?php echo $info['course'];?></span>
                                    </h5>
                                </td>
                              </tr>
                              <tr>
                                <td colspan="3">
                                  <h5 class="profile-username font-weight-bold text-left">
                                    Payment By : 
                                    <span class="font-weight-normal"><?php echo $info['payment_mode'];?> 
                                    <?php if($info['payment_mode']!="CASH"){?> / <?php echo $info['payment_detail'];?>
                                        <?php }?></span>
                                  </h5>
                                </td>    
                              </tr>
                              <tr>
                                <td colspan="3"> 
                                  <table class="table amount_data mb-0" width="100%" style="font-size: 18px;">
                                    <tr>
                                      <th width="70%">Description</th>
                                      <th class="text-right pr-4" width="20%">Amount</th>
                                    </tr>
                                    <tr>
                                      <td>Installment Amount</td>
                                      <td class="text-right pr-4" width="20%">₹ <?php echo number_format($amount);?>/-</td>
                                    </tr>
                                    
                                    <tr>
                                      <td colspan="2" >
                                        <table class="table mb-0" width="100%">
                                          <tr style="border: none !important;">
                                            <th class="p-0" style="border: none !important;padding-left: 0;">In Words :</th>
                                            <th class="border-0 p-0 text-right" style="border: none !important;"> <?php echo getIndianCurrency($net_amt).' ONLY';?></th>
                                          </tr>
                                        </table>
                                      </td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                              
                            </table>                        
                          </td>
                        </tr>  
                        <tr>
                          <td align="left">
                            _______________________________<br> 
                            <h5 class="font-weight-bold ml-4 pl-4">Student's Sign</h5>
                          </td>
                          <td align="right">
                            _______________________________ 
                            <h5 class="font-weight-bold mr-4 pr-4">Receiver's Sign</h5>
                          </td>
                        </tr>  
                        <tr> 
                          <th colspan="2"><h5 class="font-weight-bold">Composition Taxable Person, Not Eligible to Collect Tax on Supplies.</h5></th>
                          
                        </tr>
                        <tr> 
                          <th><h5 class="font-weight-bold">Note : Fees will be not refundable in any cases.</h5></th>
                          <th class="text-right pr-5 text-muted"><h5 class="font-weight-bold">Ref. No : <?php echo $info['rec_no'];?></h5></th>
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
      </div>
      
      <!-- /.row -->
    </section>
    <!-- /.content -->


  
  
 <script type="text/javascript">
   window.onload=function(){
    window.print();
   }
 </script>