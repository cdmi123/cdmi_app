<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('header');
?>

		   <body>
          <div class="book">
               <div class="page">
                    <div class="subpage">
                         <table class="table table-borderless " width="100%" border="0" cellspacing="0">
                              <tr>
                                   <th>
                                        <div class="header_profile">
                                             Student Progress Report
                                        </div>
                                   </th>
                              </tr>
                              <tr>
                                   <td>
                                        <div class="student_detail">
                                             
                                             <div class="pro_name">
                                                  <div class="stu_profile flex">
                                                       <h4>Stu. Name : </h4>
                                                       <div style="margin-left:5px;border-bottom: 2px #000 solid;width: 80%;font-weight: bold;">
                                                            <?php echo @$student['student_name']?>
                                                       </div>
                                                       
                                                  </div>
                                                  <div class="stu_profile flex">
                                                       <h4>Course : </h4>
                                                       <div style="margin-left:5px;border-bottom: 2px #000 solid;width: 84%;font-weight: bold;">
                                                            <?php echo @$student['course']?>
                                                       </div>
                                                  </div>
                                                  <div class="stu_profile flex between ">
                                                       
                                                       <h4>Reg. No. : <u><?php echo @$student['regno'];?></u></h4>
                                                       <h4>Contact No : <u><?php echo @$student['contact']?></u></h4>
                                                       <h4>Join Date : <u><?php echo date("d-m-Y",strtotime(@$student['join_date']));?></u></h4>
                                                  </div>
                                             </div>
                                             <div class="pro_img">
                                                  <!-- <img src="assets/images/team_img_big.jpg" width="100%" /> -->
                                                  <img src="<?php echo base_url('upload/student_photo/'.@$student['image']);?>">
                                             </div>
                                        </div>
                                        <div class="terms">
                                             <p>નોંધ : વિદ્યાર્થી એ  પ્રેક્ટિકલ શીટ માં જે ટોપિક નો લેક્ચર ચાલી ગયો હોય અને Proper સમજાય ગયા પછી જ એ ટોપિક સામે Date સાથે Sign કરવી. </p>
                                        </div>
                                   </td>
                              </tr>
                              <tr>
                                   <td width="100%">
                                        <table class="table table-borderless topic_table" width="100%" cellspacing="0">
                                             <thead>
                                                  <tr>
                                                       <th colspan="5">
                                                            <div class="header_profile software">
                                                                 c language
                                                            </div>
                                                       </th>
                                                  </tr>
                                             </thead>
                                             <tbody>
                                                  <tr>
                                                       <th width="5%">No</th>
                                                       <th>Name</th>
                                                       <th width="12%">Date</th>
                                                       <th width="12%">Stu. Sign</th>
                                                       <th width="12%">Lecturer</th>
                                                  </tr>
                                                  <tr>
                                                       <th><b>1</b></th>
                                                       <th>C Basic / Introduction / printf Function / /n / /t</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>1.1</th>
                                                       <th>Write a Program to Print your Bio-data using Printf Function</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>1.2</th>
                                                       <th>Write a Program to Print your Bio-data using Printf Function</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>2</th>
                                                       <th>Int Data type/Arithmetic Operator</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>2.1</th>
                                                       <th>WAP to declare two variable and calculate (sum/sub/mul/div)using this variable </th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>2.2</th>
                                                       <th>WAP to swap 2 value without using third variable</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>3</th>
                                                       <th>Assignment Operator / Scanf Function </th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>3.1</th>
                                                       <th>WAP to swap 2 value with third variable</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>4</th>
                                                       <th>Data Type ( unsigned/long/Float/double)/Type Casting</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>4.1</th>
                                                       <th>WAP to Calculate Area and Circumference of circle (Area of Circle = PI * R2 / Circumference of Circle = 2 * PI * R)</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>4.2</th>
                                                       <th>WAP to Calculate Area of Square (area = side * side)</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr><tr>
                                                       <th>4.3</th>
                                                       <th>WAP to Calculate Area of Rectangle (area = l * b)</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr><tr>
                                                       <th>4.4</th>
                                                       <th>WAP to find the simple interest (SI = (P*R*N)/100)</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr><tr>
                                                       <th>4.5</th>
                                                       <th>WAP Program to Convert temperature from degree centigrade to Fahrenheit(Fahrenheit = (Celsius * 9 / 5) + 32)</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>5</th>
                                                       <th>Relational Operator / Flow Chart</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                   <tr>
                                                       <th>5.1</th>
                                                       <th>Draw a Flow chart to Find the Maximum/ Minimum number of two value</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr> 
                                                  <tr>
                                                       <th>5.2</th>
                                                       <th>Draw a Flow chart to Find the Maximum/ Minimum number among the three number</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr> 
                                                  <tr>
                                                       <th>5.3</th>
                                                       <th>Draw a Flow chart to Find the Maximum/ Minimum number among the four number</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr> 
                                                  <tr>
                                                       <th>5.4</th>
                                                       <th>Draw a Flow chart to Find the Maximum/ Minimum number among the five number</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr> 
                                                  <tr>
                                                       <th>5.5</th>
                                                       <th>Draw a Flow char to check equal / min / max among the three value </th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                   <tr>
                                                       <th>6</th>
                                                       <th>Control Statement (If else/Nested if)</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr> 
                                                  <tr>
                                                       <th>6.1</th>
                                                       <th>WAP to Find the Maximum/ Minimum number of two value</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr> 
                                                  <tr>
                                                       <th>6.2</th>
                                                       <th>WAP to Find the Maximum/ Minimum number among the three number</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr> <tr>
                                                       <th>6.3</th>
                                                       <th>WAP to Find the Maximum/ Minimum number among the three number</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr> 
                                                  <tr>
                                                       <th>6.4</th>
                                                       <th>WAP to Find the Maximum/ Minimum number among the Five number</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr> 
                                                  <tr>
                                                       <th>6.5</th>
                                                       <th>WAP to check equal / min / max among the three value</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr> 
                                                  <tr>
                                                       <th>6.6</th>
                                                       <th>WAP to check num and print CREATIVE if given num is greater than 10 or print MULTIMEDIA if given num is smallest 10 among three variable without logical operator</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr> 
                                                  <tr>
                                                       <th>6.7</th>
                                                       <th>WAP to program to check whether the given number is positive,negative or zero</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>7</th>
                                                       <th>Ladder if / Logical Operator / Turnery Operator</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>7.1</th>
                                                       <th>WAP to Find the Maximum/ Minimum number among the Five number using Logical operator</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>7.2</th>
                                                       <th>WAP to Find the Maximum/ Minimum number among the Three number Using Turnery Operator</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>7.3</th>
                                                       <th>WAP to print Full Student Result of FIVE sub marks and calculate Total , per , min, max, Result, Grade </th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>7.4</th>
                                                       <th>WAP to input electricity unit charges and calculate total electricity bill according to the given condition: For first 50 units Rs. 0.50/unit /For next 100 units Rs. 0.75/unit /For next 100 units Rs. 1.20/unit / For unit above 250 Rs. 1.50/unit /An additional surcharge of 20% is added to the bill</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>8</th>
                                                       <th>Control statement (switch case ) / Modules</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>8.1</th>
                                                       <th>WAP to program to check whether the given number is positive,negative or zero</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>8.2</th>
                                                       <th>WAP to input week number and print week day</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>8.3</th>
                                                       <th>WAP to input month number and print number of days in that month</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>9</th>
                                                       <th>Loop (While)</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>9.1</th>
                                                       <th>Write a program in C to display the first 10 natural numbers</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>9.2</th>
                                                       <th>Write a C program to print all natural numbers in reverse </th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>9.3</th>
                                                       <th>WAP to find sum of first N natural numbers</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>9.4</th>
                                                       <th>WAP to print Range between two number</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>9.5</th>
                                                       <th>WAP to print Range of ODD num if first num is smallest and Print range of Even num if First num is largest</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>9.6</th>
                                                       <th>WAP to find factorial of a given number</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>9.7</th>
                                                       <th>WAP to print reverse given num</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>9.8</th>
                                                       <th>WAP program to count number of digits in a number</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>10</th>
                                                       <th>Do while loop</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>10.1</th>
                                                       <th>WAP to Display The Multiplication Table of a Given Number</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>10.2</th>
                                                       <th>WAP to display the cube of the number upto given an number</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>10.3</th>
                                                       <th>WAP program to sum of digits in a number</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>10.4</th>
                                                       <th>WAP to find the number and sum of all integer between two user input num which are divisible by given num</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>10.5</th>
                                                       <th>WAP to enter password and check password with entered password, if password is match then print “WELCOME” otherwise ask to give correct password.</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>11</th>
                                                       <th>For loop</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>11.1</th>
                                                       <th>WAP to check given num is Armstrong or not</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>11.2</th>
                                                       <th>WAP to print Fibonacci series in a given range</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>11.3</th>
                                                       <th>WAP to check given num is Palindrome or not</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>11.4</th>
                                                       <th>WAP to check given num is Prime or not</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>11.5</th>
                                                       <th>WAP to print Pattern given by your Faculty (15 pattern)</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>12</th>
                                                       <th>Keywords ( goto / break / continue )</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>12.1</th>
                                                       <th>Program to calculate the sum and average of positive numbers If the user enters a negative number, the sum and average are displayed</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>12.2</th>
                                                       <th>WAP to calculate sum of number if user enter negative num loop terminates (10 num maximum)</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>12.3</th>
                                                       <th>WAP to calculate sum of number is user enter negative it is not added to result (user enter maximum 10 num)</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>

                                             </tbody>
                                             <tfoot>
                                                  <tr>
                                                       <th colspan="5">
                                                            <div class="complete_topic">
                                                                 <div class="flex">
                                                                      <p>Completition Date :</p>
                                                                      <div class="line"></div>
                                                                 </div>
                                                                 <div class="flex">
                                                                      <p>Student Sign :</p>
                                                                      <div class="line"></div>
                                                                 </div>
                                                                 <div class="flex">
                                                                      <p>Lecturer Sign :</p>
                                                                      <div class="line"></div>
                                                                 </div>
                                                            </div>
                                                       </th>
                                                  </tr>
                                             </tfoot>
                                        </table>
                                   </td>
                              </tr>

                             <!--  <tr>
                                   <td width="100%">
                                        <table class="table table-borderless topic_table" width="100%" cellspacing="0">
                                             <thead>
                                                  <tr>
                                                       <th colspan="5">
                                                            <div class="header_profile software">
                                                                 Photoshop
                                                            </div>
                                                       </th>
                                                  </tr>
                                             </thead>
                                             <tbody>
                                                  <tr>
                                                       <th width="5%">No</th>
                                                       <th>Name</th>
                                                       <th width="12%">Date</th>
                                                       <th width="12%">Stu. Sign</th>
                                                       <th width="12%">Lecturer</th>
                                                  </tr>
                                                  <tr>
                                                       <th>1</th>
                                                       <th>Photoshop</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>1</th>
                                                       <th>Photoshop</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>1</th>
                                                       <th>Photoshop</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>1</th>
                                                       <th>Photoshop</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>1</th>
                                                       <th>Photoshop</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>1</th>
                                                       <th>Photoshop</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>1</th>
                                                       <th>Photoshop</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>1</th>
                                                       <th>Photoshop</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>1</th>
                                                       <th>Photoshop</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>1</th>
                                                       <th>Photoshop</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>1</th>
                                                       <th>Photoshop</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>1</th>
                                                       <th>Photoshop</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                             </tbody>
                                             <tfoot>
                                                  <tr>
                                                       <th colspan="5">
                                                            <div class="complete_topic">
                                                                 <div class="flex">
                                                                      <p>Completition Date :</p>
                                                                      <div class="line"></div>
                                                                 </div>
                                                                 <div class="flex">
                                                                      <p>Student Sign :</p>
                                                                      <div class="line"></div>
                                                                 </div>
                                                                 <div class="flex">
                                                                      <p>Lecturer Sign :</p>
                                                                      <div class="line"></div>
                                                                 </div>
                                                            </div>
                                                       </th>
                                                  </tr>
                                             </tfoot>
                                        </table>
                                   </td>
                              </tr>
                              <tr>
                                   <td width="100%">
                                        <table class="table table-borderless topic_table" width="100%" cellspacing="0">
                                             <thead>
                                                  <tr>
                                                       <th colspan="5">
                                                            <div class="header_profile software">
                                                                 Photoshop
                                                            </div>
                                                       </th>
                                                  </tr>
                                             </thead>
                                             <tbody>
                                                  <tr>
                                                       <th width="5%">No</th>
                                                       <th>Name</th>
                                                       <th width="12%">Date</th>
                                                       <th width="12%">Stu. Sign</th>
                                                       <th width="12%">Lecturer</th>
                                                  </tr>
                                                  <tr>
                                                       <th>1</th>
                                                       <th>Photoshop</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>1</th>
                                                       <th>Photoshop</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>1</th>
                                                       <th>Photoshop</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>1</th>
                                                       <th>Photoshop</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>1</th>
                                                       <th>Photoshop</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>1</th>
                                                       <th>Photoshop</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>1</th>
                                                       <th>Photoshop</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                             </tbody>
                                             <tfoot>
                                                  <tr>
                                                       <th colspan="5">
                                                            <div class="complete_topic">
                                                                 <div class="flex">
                                                                      <p>Completition Date :</p>
                                                                      <div class="line"></div>
                                                                 </div>
                                                                 <div class="flex">
                                                                      <p>Student Sign :</p>
                                                                      <div class="line"></div>
                                                                 </div>
                                                                 <div class="flex">
                                                                      <p>Lecturer Sign :</p>
                                                                      <div class="line"></div>
                                                                 </div>
                                                            </div>
                                                       </th>
                                                  </tr>
                                             </tfoot>
                                        </table>
                                   </td>
                              </tr>
                              <tr>
                                   <td width="100%">
                                        <table class="table table-borderless topic_table" width="100%" cellspacing="0">
                                             <thead>
                                                  <tr>
                                                       <th colspan="5">
                                                            <div class="header_profile software">
                                                                 Photoshop
                                                            </div>
                                                       </th>
                                                  </tr>
                                             </thead>
                                             <tbody>
                                                  <tr>
                                                       <th width="5%">No</th>
                                                       <th>Name</th>
                                                       <th width="12%">Date</th>
                                                       <th width="12%">Stu. Sign</th>
                                                       <th width="12%">Lecturer</th>
                                                  </tr>
                                                  <tr>
                                                       <th>1</th>
                                                       <th>Photoshop</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>1</th>
                                                       <th>Photoshop</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>1</th>
                                                       <th>Photoshop</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>1</th>
                                                       <th>Photoshop</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>1</th>
                                                       <th>Photoshop</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>1</th>
                                                       <th>Photoshop</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                                  <tr>
                                                       <th>1</th>
                                                       <th>Photoshop</th>
                                                       <td></td>
                                                       <td></td>
                                                       <td></td>
                                                  </tr>
                                             </tbody>
                                             <tfoot>
                                                  <tr>
                                                       <th colspan="5">
                                                            <div class="complete_topic">
                                                                 <div class="flex">
                                                                      <p>Completition Date :</p>
                                                                      <div class="line"></div>
                                                                 </div>
                                                                 <div class="flex">
                                                                      <p>Student Sign :</p>
                                                                      <div class="line"></div>
                                                                 </div>
                                                                 <div class="flex">
                                                                      <p>Lecturer Sign :</p>
                                                                      <div class="line"></div>
                                                                 </div>
                                                            </div>
                                                       </th>
                                                  </tr>
                                             </tfoot>
                                        </table>
                                   </td>
                              </tr> -->

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
                    background-color: #fff;
                    font-family: roboto;
               }

               * {
                    box-sizing: border-box;
                    -moz-box-sizing: border-box;

               }

               .topic_table tr+tr th:nth-child(2) {
                    text-align: left;
               }

               .page {
                    width: 210mm;
                    min-height: 297mm;
                     padding: 0 20px; 
                    margin: 0 auto;
                    border: 1px #000 solid;
                    border-radius: 5px;
                    background: white;
                    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
               }

               .subpage {
                    position: relative;
                    height: 100%;
                    border: 1px #000 solid;
               }

               .table>thead>tr>th,
               .table>tbody>tr>th,
               .table>tfoot>tr>th,
               .table>thead>tr>td,
               .table>tbody>tr>td,
               .table>tfoot>tr>td {
                    padding: 0px;
               }

               table td,
               table th {
                    border: none !important;
               }

               .flex {
                    display: flex;
                    width: 100%;
               }

               .between {
                    justify-content: space-between;
               }

               .student_detail {
                    display: flex;
                    align-items: center;
                    width: 100%;
                    padding: 5px;
               }

               .header_profile,
               .soft_name {
                    background-color: #fff;
                    font-size: 20px;
                    padding: 5px;
                    text-transform: uppercase;
                    letter-spacing: 1px;
               }
               .header_profile
               {
                    background-color: #eee;
               }

               .software {
                    border-top: 1px #000 solid;
               }

               .topic_table {
                    font-size: 14px;
               }

               .terms {
                    text-align: center;
                    font-size: 13px;
                    font-weight: 600;
               }

               .pro_img {
                    width: 120px;
                    height: 120px;
                    padding: 5px;
                    box-shadow: 0 3px 5px rgba(0, 0, 0, 0.1);
               }

               .pro_img img {
                    height: 100%;
                    width: 100%;
               }

               .pro_name
               {
                    flex-grow: 1;
                    padding: 0 10px;
               }

               .stu_profile u {
                    text-underline-offset: 4px;
                    text-decoration-thickness: 1px;
                    text-transform: uppercase;
                    padding-left: 5px;
                    font-weight: bold;
                    letter-spacing: 0.5px;
               }

               .stu_profile h4 {
                    font-size: 16px;
                    margin: 0;
                    font-weight: 500;
               }

               .stu_profile+.stu_profile {
                    margin-top: 25px;
               }

               .pro_name p {
                    font-style: italic;
                    font-size: 20px;
               }

               .complete_topic {
                    padding: 15px;
                    display: flex;
               }

               .complete_topic .flex {
                    flex-grow: 1;
                    display: flex;
               }

               .complete_topic .flex .line {
                    margin-right: 0;
                    flex-grow: 1;
                    border-bottom: 1px #000 solid;
                    margin: 0 20px 0px 10px;
               }
               .complete_topic .flex:last-child .line
               {
                    margin-right: 0;
               }
               

               .complete_topic p {
                    font-size: 14px;
                    letter-spacing: .7px;
                    margin: 0;
               }

               @page {
                    size: A4;
                    margin: 35px 0;
               }

               @media print {
                    thead {display: table-header-group;}
                    tfoot {display: table-footer-group;}

                    table {
                         -fs-table-paginate: paginate;
                    }

                    thead
                    {
                         display: table-row-group;
                    }
                    tfoot
                    {
                         display: table-row-group;
                    }

                    * {
                         box-sizing: border-box;
                    }

                    .section h3 {
                         font-size: 22px !important;
                    }

                    .subpage {
                         position: relative;
                         border: 1px rgb(0, 0, 0) solid;
                    }
                    .subpage > table > tbody>  tr:first-child th
                    {
                         border-bottom: 1px #000 solid!important;
                    }

                    html,
                    body {
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
                    .topic_table>tbody>tr>th
                    {
                         padding: 5px 10px;
                    }

                    .topic_table tbody tr>th:first-of-type, .topic_table thead tr>th:first-of-type {
                         border-left: none !important;
                         border-top: none !important;
                         border-right: none !important;
                    }

                    .topic_table tbody tr + tr th, .topic_table tbody tr + tr td
                    {
                         border-bottom: 1px #000 solid;
                    }

                    .topic_table tbody tr>td  {
                         border-top: none !important;
                         border-right: none !important;
                    }
                    .topic_table>tbody>tr:first-child td, .topic_table>tbody>tr:first-child th
                    {
                         border-top: 1px #000 solid!important;
                    }
                    .topic_table>tbody>tr>th , .topic_table>tbody>tr>td
                    {
                         border-bottom: 1px solid #000!important;
                    }
                    .topic_table>tbody>tr>th + th  , .topic_table>tbody>tr>td
                    {
                         border-left: 1px solid #000!important;
                    }
               }
          </style>
     </body>

<style>
               body {
                    width: 100%;
                    height: 100%;
                    margin: 0;
                    padding: 0;
                    background-color: #fff;
                    font-family: roboto;
               }

               * {
                    box-sizing: border-box;
                    -moz-box-sizing: border-box;

               }

               .topic_table tr+tr th:nth-child(2) {
                    text-align: left;
               }

               .page {
                    width: 210mm;
                    min-height: 297mm;
                     padding: 0 20px; 
                    margin: 0 auto;
                    border: 1px #000 solid;
                    border-radius: 5px;
                    background: white;
                    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
               }

               .subpage {
                    position: relative;
                    height: 100%;
                    border: 1px #000 solid;
               }

               .table>thead>tr>th,
               .table>tbody>tr>th,
               .table>tfoot>tr>th,
               .table>thead>tr>td,
               .table>tbody>tr>td,
               .table>tfoot>tr>td {
                    padding: 0px;
               }

               table td,
               table th {
                    border: none !important;
               }

               .flex {
                    display: flex;
                    width: 100%;
               }

               .between {
                    justify-content: space-between;
               }

               .student_detail {
                    display: flex;
                    align-items: center;
                    width: 100%;
                    padding: 5px;
               }

               .header_profile,
               .soft_name {
                    background-color: #fff;
                    font-size: 20px;
                    padding: 5px;
                    text-transform: uppercase;
                    letter-spacing: 1px;
               }
               .header_profile
               {
                    background-color: #eee;
               }

               .software {
                    border-top: 1px #000 solid;
               }

               .topic_table {
                    font-size: 14px;
               }

               .terms {
                    text-align: center;
                    font-size: 13px;
                    font-weight: 600;
               }

               .pro_img {
                    width: 120px;
                    height: 120px;
                    padding: 5px;
                    box-shadow: 0 3px 5px rgba(0, 0, 0, 0.1);
               }

               .pro_img img {
                    height: 100%;
                    width: 100%;
               }

               .pro_name
               {
                    flex-grow: 1;
                    padding: 0 10px;
               }

               .stu_profile u {
                    text-underline-offset: 4px;
                    text-decoration-thickness: 1px;
                    text-transform: uppercase;
                    padding-left: 5px;
                    font-weight: bold;
                    letter-spacing: 0.5px;
               }

               .stu_profile h4 {
                    font-size: 16px;
                    margin: 0;
                    font-weight: 500;
               }

               .stu_profile+.stu_profile {
                    margin-top: 25px;
               }

               .pro_name p {
                    font-style: italic;
                    font-size: 20px;
               }

               .complete_topic {
                    padding: 15px;
                    display: flex;
               }

               .complete_topic .flex {
                    flex-grow: 1;
                    display: flex;
               }

               .complete_topic .flex .line {
                    margin-right: 0;
                    flex-grow: 1;
                    border-bottom: 1px #000 solid;
                    margin: 0 20px 0px 10px;
               }
               .complete_topic .flex:last-child .line
               {
                    margin-right: 0;
               }
               

               .complete_topic p {
                    font-size: 14px;
                    letter-spacing: .7px;
                    margin: 0;
               }

               @page {
                    size: A4;
                    margin: 35px 0;
               }

               @media print {
                    thead {display: table-header-group;}
                    tfoot {display: table-footer-group;}

                    table {
                         -fs-table-paginate: paginate;
                    }

                    thead
                    {
                         display: table-row-group;
                    }
                    tfoot
                    {
                         display: table-row-group;
                    }

                    * {
                         box-sizing: border-box;
                    }

                    .section h3 {
                         font-size: 22px !important;
                    }

                    .subpage {
                         position: relative;
                         border: 1px rgb(0, 0, 0) solid;
                    }
                    .subpage > table > tbody>  tr:first-child th
                    {
                         border-bottom: 1px #000 solid!important;
                    }

                    html,
                    body {
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
                    .topic_table>tbody>tr>th
                    {
                         padding: 5px 10px;
                    }

                    .topic_table tbody tr>th:first-of-type, .topic_table thead tr>th:first-of-type {
                         border-left: none !important;
                         border-top: none !important;
                         border-right: none !important;
                    }

                    .topic_table tbody tr + tr th, .topic_table tbody tr + tr td
                    {
                         border-bottom: 1px #000 solid;
                    }

                    .topic_table tbody tr>td  {
                         border-top: none !important;
                         border-right: none !important;
                    }
                    .topic_table>tbody>tr:first-child td, .topic_table>tbody>tr:first-child th
                    {
                         border-top: 1px #000 solid!important;
                    }
                    .topic_table>tbody>tr>th , .topic_table>tbody>tr>td
                    {
                         border-bottom: 1px solid #000!important;
                    }
                    .topic_table>tbody>tr>th + th  , .topic_table>tbody>tr>td
                    {
                         border-left: 1px solid #000!important;
                    }
               }
          </style>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('footer');
?>