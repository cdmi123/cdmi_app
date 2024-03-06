<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('header');
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Certificate Courses</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <!-- <div class="card-header">
              <h3 class="card-title">DataTable with minimal features & hover style</h3>
            </div> -->
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover table-font">
                <thead>
                  <tr>
                    <th>ID</th>
                    <!-- <th>Branch</th> -->
                    <th>
                      Name
                      <div style="border-top: solid 1px grey;margin-top: 5px"></div>
                      Enrollment
                    </th>
                    
                    <th>Certificate Course</th>
                    <th>
                      Duration
                      <div style="border-top: solid 1px grey;margin-top: 5px"></div>
                      Grade
                    </th>
                    <th width="90px;">
                      Start Date
                      <div style="border-top: solid 1px grey;margin-top: 5px"></div>
                      End Date
                    </th>
                    
                    <th>Certificate Date</th>
                    <th>Execution</th>
                    <!-- <th>PDF Status</th> -->
                    <th width="60px">Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                    if(count($certificate_data) >0){
                                            $i=1;
                    foreach($certificate_data as  $row){
                    ?>
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <!-- <td><?php //echo $row['branch_name'];?></td> -->
                                            <td>
                                              <?php echo $row['surname'].'&nbsp'; echo $row['first_name'].'&nbsp'; echo $row['middle_name'];?>
                                              <div style="border-top: solid 1px grey;margin-top: 5px"></div>
                                              <?php echo $row['enrollment'];?>    
                                            </td>
                                            
                                            <td><?php echo $row['course_name'];?></td>
                                            <td>
                                              <?php echo $row['duration'];?>
                                              <div style="border-top: solid 1px grey;margin-top: 5px"></div>  
                                              <?php echo $row['grade'];?>  
                                            </td>
                                            <td>
                                              <?php echo getSimpleDate($row['start_date']);?>
                                              <div style="border-top: solid 1px grey;margin-top: 5px"></div>
                                              <?php echo getSimpleDate($row['end_date']);?>
                                            </td>
                                            
                                            <td><?php echo getSimpleDate($row['certificate_date']);?></td>
                                            <td>
                                              <!-- <form method="post" action="<?php //echo  site_url('admin/certificate/create_pdf/'.$row['id']); ?>" class="frm_get_certi"><button type="button" class="btn btn-primary get_certificate">Get Certificate</button></form> -->
                                              <?php
                                              if($row['pdf_status']!=''){
                                              ?>
                                                <input type="button" onclick="printDiv('printableArea','<?php echo $row['id']; ?>')" value="Re-print" class="btn btn-primary" />  
                                              <?php
                                              }else{
                                              ?>
                                              <input type="button" onclick="printDiv('printableArea','<?php echo $row['id']; ?>')" value="Print" class="btn btn-primary" />
                                              <?php }?>
                                            </td>
                                            <!-- <td>
                                              <?php //if($row['pdf_status']!=''){echo $row['pdf_status'];}else{ echo '-';} ?>
                                            </td> -->
                                            <td>
                                              <a href="<?php echo site_url('certificate/delete_certificate/'.$row['id']); ?>" onclick="return confirm('Are you sure?');"><i class="fas fa-trash" aria-hidden="true"></i></a> 
                                              || 
                                              <a href="<?php echo site_url('certificate/add_certificate/'.$row['id']);?>">&nbsp;<i class="fas fa-edit" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                        <?php 
                                                $i++;
                                            }
                    }else{
                    ?>
                                        <tr><td colspan="11">No records found.</td></tr>
                                        <?php
                    }
                    ?>
                  </tbody>
                <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Courses Name</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
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
  </div>
 <?php
  $this->load->view('footer');
 ?>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js');?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
 <script>
  $(function () {

    $('#example2').DataTable({
      
    });
  });
</script>
 <script>
                $(document).ready(function(){
                    $('.get_certificate').click(function(){
                        $(this).parents('form').submit();
                    });
                });
                function printDiv(divName,certi_id) {
                    $.ajax({
                        url:"<?php echo site_url('certificate/print_cert/');?>",
                        type:"post",
                        data:{certi_id:certi_id},
                        dataType:"json",
                        success:function(response){
                            document.getElementById(divName).innerHTML = response.retHtml;
                            var printContents = document.getElementById(divName).innerHTML;
                            var printTitle = response.title; 
                             var originalContents = document.body.innerHTML;
                             var originalTitle = document.title;
                             document.title = printTitle;
                             document.body.innerHTML = printContents;

                             //window.print();

                             document.body.innerHTML = originalContents;
                             document.title = originalTitle;
                        }
                    });
                     
                }

                function get_certy_by_class(obj){
                    $('#form').submit();
                }
            </script>

            <div id="printableArea" style="display: none;">

</div>