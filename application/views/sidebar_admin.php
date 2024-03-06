<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
$id= $this->session->userdata('user_login');
$this->db->where('id',$id);
$arr = $this->db->get('admin')->row_array();

$date_for = date('Y-n-d');
$punchData = $this->db->query("SELECT MIN(time) inTime,MAX(time) outTime FROM `tblt_timesheet` where date='$date_for' and punchingcode=".$arr['punchcode'])->row_array();
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo site_url();?>" class="brand-link">
      <img src="<?php echo base_url('assets/dist/img/cdmi.jpg')?>" alt="CDMI Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">CDMI</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url('upload/'.$arr['image'])?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $arr['name']?></a>
          <p class="text-white mb-0">In : <?php echo $punchData['inTime'] ? $punchData['inTime'] : "00:00"; ?><br>Out: <?php echo $punchData['outTime'] ? $punchData['outTime'] : "00:00"; ?></p>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="<?php echo site_url('dashboard/index');?>" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
                Dashboard
            </a>
          </li>
          <?php 
          if($arr['role'] == 5 ){
          ?>
          <li class="nav-item">
            <a href="<?php echo site_url('admission/view_faculty_students'); ?>" class="nav-link">
              <i class="nav-icon fas fa-laptop-code"></i>
              <p>
                IT/Multimedia 
              </p>
            </a>
          </li>
          <?php }?>
          <?php 
          if($arr['role'] == 1 || $arr['role'] == 3 || $arr['role'] == 4 || $arr['role'] == 7){
          ?>
          <!-- <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-question"></i>
              <p>
                Inquiry
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item has-treeview">
                <a href="" class="nav-link">
                  <i class="fas fa-plus nav-icon"></i> Add Inq
                  <i class="fas fa-angle-left right"></i>
                </a>
                <ul class="nav nav-treeview peta_menu">
                    <li class="nav-item">
                      <a href="<?php //echo site_url('inquiry/index');?>" class="nav-link">
                        <i class="fas fa-desktop nav-icon"></i>Regular Inq
                      </a>
                    </li>
                 <li class="nav-item">
                      <a href="<?php //echo site_url('schoolinq/add_school_inquiry'); ?>" class="nav-link">
                        <i class="fas fa-building nav-icon"></i>School Inq
                      </a>
                    </li> 
                </ul>
              </li>

              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="fas fa-eye nav-icon"></i> View Inq
                  <i class="fas fa-angle-left right"></i>
                </a>
                <ul class="nav nav-treeview peta_menu">
                    <li class="nav-item">
                      <a href="<?php echo site_url('inquiry/view_inquiry'); ?>" class="nav-link">
                        <i class="fas fa-desktop nav-icon"></i>Regular Inq
                      </a>
                    </li>
                     <li class="nav-item">
                      <a href="<?php //echo site_url('schoolinq/view_school_inquiry'); ?>" class="nav-link">
                        <i class="fas fa-building nav-icon"></i>School Inq
                      </a>
                    </li> 
                </ul>
              </li>
            </ul>
          </li> -->
          <?php }?>
          <?php 
          if($arr['role'] == 8){
          ?>
          <li class="nav-item">
            <a href="<?php echo site_url('schoolinq/view_school_inquiry');?>" class="nav-link">
              <i class="nav-icon fas fa-question"></i>
                Inquiry
            </a>
          </li>
          <?php }?>
          <?php 
          if($arr['role'] == 1 || $arr['role'] == 3 || $arr['role'] == 7){
          ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-laptop-code"></i>
              <p>
                IT/Multimedia
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('admission/index');?>" class="nav-link">
                  <i class="fas fa-plus nav-icon"></i> Add
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('admission/view_admission'); ?>" class="nav-link">
                  <i class="fas fa-list nav-icon"></i> View
                </a>
              </li>
            </ul>
          </li>
          <!-- <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-graduation-cap"></i>
              <p>
                <?php //echo $this->lang->line('clg'); ?>
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php //echo site_url('add-admission');?>" class="nav-link">
                  <i class="fas fa-plus nav-icon"></i> Add
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php //echo site_url('view-admission'); ?>" class="nav-link">
                  <i class="fas fa-list nav-icon"></i> View
                </a>
              </li>
            </ul>
          </li> -->

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-laptop-code"></i>
              <p>
                Multimedia Fees
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('fees/view_fees'); ?>" class="nav-link">
                  <i class="fas fa-list nav-icon"></i> View
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('fees/view_return_fees'); ?>" class="nav-link">
                  <i class="fas fa-list nav-icon"></i> Return Fees
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('fees/view_allowance'); ?>" class="nav-link">
                  <i class="fas fa-list nav-icon"></i> Allowance
                </a>
              </li>
            </ul>
          </li>
          <!-- <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-graduation-cap"></i>
              <p>
                <?php //echo $this->lang->line('clg_fees'); ?>
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php //echo site_url('College_fees/view_college_fees'); ?>" class="nav-link">
                  <i class="fas fa-list nav-icon"></i> <?php //echo $this->lang->line('clg_fees'); ?>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php //echo site_url('College_fees/view_exam_fees'); ?>" class="nav-link">
                  <i class="fas fa-list nav-icon"></i> <?php //echo $this->lang->line('exam_fees'); ?>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php //echo site_url('College_fees/view_certificate_fees'); ?>" class="nav-link">
                  <i class="fas fa-list nav-icon"></i> <?php //echo $this->lang->line('cert_fees'); ?>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php //echo site_url('college_fees/view_return_fees'); ?>" class="nav-link">
                  <i class="fas fa-list nav-icon"></i> Return Fees
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php //echo site_url('college_fees/view_allowance'); ?>" class="nav-link">
                  <i class="fas fa-list nav-icon"></i> Allowance
                </a>
              </li>
            </ul>
          </li> -->
          <?php 
          if(BRANCH_ID==1 || BRANCH_ID==2){
          ?>
          <!-- <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Certification
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php //echo site_url('certificate/add_certificate_course');?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Certificate Course</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php //echo site_url('certificate/list_certificate_courses'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Certificate Courses</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php //echo site_url('certificate/add_certificate');?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Certificate</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php //echo site_url('certificate/list_certificate'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List Certificates</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php //echo site_url('Cert/add_certificate'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Creat Certificates</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php //echo site_url('Cert/View_certificate'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Certificates</p>
                </a>
              </li>
            </ul>
          </li> -->
          <?php }?>
          <!-- <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-bar"></i>
              <p>
                Reports
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview"> -->
              <?php 
              if($arr['role'] == 1){
              ?>
              <!-- <li class="nav-item">
                <a href="<?php //echo site_url('admission-report-course');?>" class="nav-link">
                  <i class="fas fa-chart-bar nav-icon"></i>
                  <p>Multimedia Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php //echo site_url('admission-report-college');?>" class="nav-link">
                  <i class="fas fa-chart-bar nav-icon"></i>
                  <p><?php //echo $this->lang->line('clg_report'); ?></p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php //echo site_url('certificate-report');?>" class="nav-link">
                  <i class="fas fa-chart-bar nav-icon"></i>
                  <p>Certificate Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php //echo site_url('university-report');?>" class="nav-link">
                  <i class="fas fa-chart-bar nav-icon"></i>
                  <p><?php //echo $this->lang->line('uni_report'); ?></p>
                </a>
              </li> -->
              <?php }?>
              <!-- <li class="nav-item">
                <a href="<?php //echo site_url('inquiry/inq_report');?>" class="nav-link">
                  <i class="fas fa-chart-bar nav-icon"></i>
                  <p>Inquiry Report</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="<?php //echo site_url('inquiry/faculty_inq_month_report');?>" class="nav-link">
                  <i class="fas fa-chart-bar nav-icon"></i>
                  <p>Faculty Inquiry Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php //echo site_url('Schoolinq/scholl_inq_report');?>" class="nav-link">
                  <i class="fas fa-chart-bar nav-icon"></i>
                  <p>Faculty School Inquiry Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php //echo site_url('Inquiry/school_inq_year_report";');?>" class="nav-link">
                  <i class="fas fa-chart-bar nav-icon"></i>
                  <p>All School Inquiry Report</p>
                </a>
              </li> -->
              <!-- <li class="nav-item">
                <a href="<?php //echo site_url('Schoolinq/scholl_report');?>" class="nav-link">
                  <i class="fas fa-chart-bar nav-icon"></i>
                  <p>School Inquiry Report</p>
                </a>
              </li> -->
              
              
            <!-- </ul>
          </li> -->
          
          <?php }?>
          <?php 
          if($arr['role'] ==1 || $arr['role'] ==2|| $arr['role'] ==3 || $arr['role'] ==5||$arr['role'] ==7){
          ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Manage Batches
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('admission/create_batch'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('admission/view_batches'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View</p>
                </a>
              </li>
            </ul>
          </li>
          <?php }
           if($arr['role'] ==1 || $arr['role'] ==5 ||$arr['role'] ==7){
          ?>
           <!-- <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tasks"></i>
              <p>
                Progress Report
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item has-treeview">
                <a href="" class="nav-link">
                  <i class="fas fa-plus nav-icon"></i> Add Progress Report
                  <i class="fas fa-angle-left right"></i>
                </a>
                <ul class="nav nav-treeview peta_menu">
                    <li class="nav-item">
                      <a href="<?php echo site_url('progress_report/index');?>" class="nav-link">
                        <i class="fas fa-circle nav-icon"></i>Progress Report Name
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="<?php echo site_url('progress_report/sub_topic'); ?>" class="nav-link">
                        <i class="fas fa-circle nav-icon"></i>sub Topic
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="<?php echo site_url('progress_report/peta_topic'); ?>" class="nav-link">
                        <i class="fas fa-circle nav-icon"></i>Detailed Topic
                      </a>
                    </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('progress_report/view_report') ?>" class="nav-link">
                  <i class="fas fa-eye nav-icon"></i> View Progress Report
                </a>
              </li>
            </ul>
          </li> -->
          <?php } ?>
          <?php 
          if($arr['role'] == 1 || $arr['role'] == 7){
          ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Manage Staff
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('admin/index');?>" class="nav-link">
                  <i class="fas fa-plus nav-icon"></i> Add
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('admin/view_admin'); ?>" class="nav-link">
                  <i class="fas fa-list nav-icon"></i> View
                </a>
              </li>
              <?php 
              if($_SERVER['HTTP_HOST'] != 'hk.bitatech.in'){
              ?>
              <li class="nav-item">
                <a href="<?php echo site_url('realtime/staff'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Staff TimeList</p>
                </a>
              </li>
              <?php } ?>
              <!-- <li class="nav-item">
                <a href="<?php //echo site_url('Salary/add_salary'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Salary</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php //echo site_url('Salary/view_salary'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Salary</p>
                </a>
              </li> -->
            </ul>
          </li>
          
          <?php 
          }
          if($arr['role'] == 1){
          ?>
          <!-- <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-university"></i>
              <p>
                <?php //echo $this->lang->line('university'); ?>
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php //echo site_url('add-uni-payment');?>" class="nav-link">
                  <i class="fas fa-plus nav-icon"></i> Add
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php //echo site_url('import-uni-payment');?>" class="nav-link">
                  <i class="fas fa-plus nav-icon"></i> Import
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php //echo site_url('view-uni-payment'); ?>" class="nav-link">
                  <i class="fas fa-list nav-icon"></i> View
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php //echo site_url('view-uni-fees-payment'); ?>" class="nav-link">
                  <i class="fas fa-list nav-icon"></i> Regular Fees
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php //echo site_url('view-uni-exam-payment'); ?>" class="nav-link">
                  <i class="fas fa-list nav-icon"></i> Exam Fees
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php //echo site_url('view-uni-certificate-payment'); ?>" class="nav-link">
                  <i class="fas fa-list nav-icon"></i> Certficate Fees
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php //echo site_url('College_admission/uni_doc_report'); ?>" class="nav-link">
                  <i class="fas fa-list nav-icon"></i> Certficate Report
                </a>
              </li>
            </ul>
          </li> -->
          
          <!-- <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Add Expense Category
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php //echo site_url('Expense/index');?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Expense Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php //echo site_url('Expense/view_exp_category'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Expense Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php //echo site_url('Expense/add_expense'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Expense</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php //echo site_url('Expense/view_expense'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Expense</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-laptop-code"></i>
              <p>
                Course
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php //echo site_url('course/index');?>" class="nav-link">
                  <i class="fas fa-plus nav-icon"></i> Add
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php //echo site_url('course/view_course'); ?>" class="nav-link">
                  <i class="fas fa-list nav-icon"></i> View
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php //echo site_url('course_cover/index'); ?>" class="nav-link">
                  <i class="fas fa-plus nav-icon"></i> Add Cover
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php //echo site_url('course_cover/view_course'); ?>" class="nav-link">
                  <i class="fas fa-list nav-icon"></i> View Cover
                </a>
              </li>

            </ul>
          </li> -->
         <!--  <li class="nav-item">
            <a href="<?php //echo site_url('download-backup');?>" class="nav-link">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Download Backup
              </p>
            </a>
          </li> -->
          <?php }?>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <style type="text/css">
    
    .peta_menu{
      margin-left: 20px;
    }

  </style>