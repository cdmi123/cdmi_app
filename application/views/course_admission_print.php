<?php  defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Creative Multimedia - Admission</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<style type="text/css">

	body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #FFF;
    }
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }
    .page {
        width: 210mm;
        min-height: 297mm;
        padding: 5px;
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
        .table td, .table th
        {
        	padding: 6px 8px;
        }
    }
	</style>

</head>
<body>
	<div class="book">
	    <div class="page">
	        <div class="subpage">
				<table class="table">
					<tr>
						<td align="center" colspan="2" class="border-top-0">
							<img src="<?php echo base_url('assets/images/creative-logo-blue.svg');?>" width="30%">
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<table width="100%" class="border-bottom">
								<tr>
									<td width="80%" class="border-top-0 pt-0">
										<table class="table-borderless" width="100%">
											<tr>
												<td colspan="3" class="border-top-0"><h3 class="text-uppercase"><?php echo strtoupper($student['student_name']);?></h3></td>
											</tr>
											<tr>
												<th width="200px">Course</th>
												<td width="20px" align="center">:</td>
												<td><?php echo strtoupper($student['course']);?></td>
											</tr>
											<tr>
												<th width="200px">Course Content</th>
												<td width="20px" align="center">:</td>
												<td><?php echo strtoupper($student['course_content']); ?></td>
											</tr>
											
											<tr>
												<th width="200px">Admission Code</th>
												<td width="20px" align="center">:</td>
												<td><?php echo $student['offer_code']?></td>
											</tr>
										</table>
									</td>
									<td width="20%" align="center" class="border-top-0">
										<!-- <h5 class=" text-uppercase">Reg. No. - <?php //echo $student['regno'];?></h5> -->
										<div class="border p-1 mt-3" style="width: 150px;height: 200px;">
											<?php 
						                    if($student['image']!='')
						                    {
						                    	$img = base_url('upload/student_photo/'.$student['image']);
						                    }else{
						                    	$img = base_url('upload/users.jpg');
						                    }
						                    ?>
											<img src="<?php echo $img;?>" width="100%" height="100%" style="object-fit: cover;">
										</div>
									</td>	
								</tr>
							</table>
							<br>
							<table width="100%" class="table table-borderless p-10">
						        <tr>
						          <th>
						            ક્રિએટિવ સંસ્થાના વિદ્યાર્થી તેમજ વાલી માટેના નિયમો :
						          </th>
						        </tr>
						        <tr>
						          <td>1)વિદ્યાર્થી એ ઈન્સ્ટિટ્યૂટ દ્વારા આપેલા ટાઈમ પર સમયસર આવવાનું રહેશે, જો કોઈ કારણસર આવવામાં મોડું થાય અથવા રજા જોતી હોય તો એક દિવસ પહેલા ફેકલ્ટીને જાણ કરવી.જો તમે અગાઉ જાણ કર્યા વગર રજા પાડશો તો જતા રહેલા લેક્ચર ફરીથી લેવામાં આવશે નહિ.</td>
						        </tr>
						        <tr>
						          <td>2)સંસ્થામાં મોબાઈલ વાપરવા પર પ્રતિબંધ છે.લેબ માં કોઈ પણ ડીવાઈસ કોમ્પ્યુટરમાં લગાવવું નહીં,જો લગાવો તો સંસ્થા એના માટે જવાબદાર રહેશે નહિ.</td>
						        </tr>
						         <td>3)સંસ્થાની કોઈપણ પ્રોપર્ટીને નુકશાન કરવું નહિ, તેમજ કોઈપણ સ્ટાફ સાથે ગેરવર્તન કરવું નહિ, જો આવું કરશો તો એડમિશન રદ કરી નાખવામાં આવશે અને ભરેલી ફી પરત મળશે નહિ.સંસ્થામાં દાખલ થયા પછી કંઈ પણ ચીજ વસ્તુ ખાતા પકડાશો તો પ્રેક્ટિકલમાં બેસવા દેવામા આવશે નહિ.</td>
						        </tr>
						        <tr>
						          <td>4)કોર્ષનો સમયગાળો અંદાજિત હોય છે જે વિદ્યાર્થીની યાદશક્તિ તેમજ તેમના પ્રેક્ટિકલ પર આધારિત હોય છે જેથી કોર્ષનો સમય વધી કે ઘટી પણ શકે છે.</td>
						        </tr>
						        <tr>
						          <td>5)વિદ્યાર્થી ને કોઈ કારણ થી કોર્ષ કેન્સલ કરવાનો થાય તો  કોર્ષની ફી રીટર્ન મળશે નહિ, </td>
						        </tr>
						        <tr>
						        	<td>6)ક્રિએટિવ સંસ્થા દ્વારા રાખવામાં આવતી Test માં તમારું પરફોર્મન્સ Average કરતા ઓછું હશે તો સંસ્થા તરફથી બીજો Course Suggest કરવામાં આવશે, જો તે કોર્ષ તમે Select નહિ કરો તો કોર્ષ શીખવા માટે ક્રિએટિવ સંસ્થા જવાબદાર રહેશે નહિ</td>
						        </tr>
						       
						        <tr>
						          <td>7) તમારા કોર્ષ ના સમયગાળા દરમિયાન તમે વધુ માં વધુ એક જ મહિના ની રજા લઈ શકો, એના કરતા વધુ રજા મળી શકશે નહિ તેમજ કોર્ષ દરમિયાન વિદ્યાર્થી ની Attendence (હાજરી) 90% કે તેનાથી વધુ ફરજીયાત હોવી જરૂરી છે.</td>
						        </tr>
						        
						        <tr>
						            <td>8) કોર્ષ શરુ થયા બાદ PC / LAPTOP ફરજીયાત લેવાનું રહેશે. ઈન્સ્ટિટ્યૂટ તરફથી આપવામાં આવેલા પ્રોજેક્ટ વર્કમાંથી ઓછામાં ઓછા 20 પ્રોજેક્ટ વર્ક ફરજીયાત ઘરેથી બનાવીને સબમિટ કરવાના રહેશે. </td>
						        </tr>
						        <tr>
						          	<td>9)કોર્ષ પૂરો થયા પછી આખા કોર્ષ નું રીવીઝન કરવાનું રહેશે અને પહેલા 5 ઇન્ટરવ્યૂ ઇન્સ્ટિટ્યૂટમાં થશે તેમાં પાસ થયા પછી જ કંપનીમાં ઇન્ટરવ્યૂ કરાવવામાં આવશે.</td>
						        </tr>
						        <tr>
						          	<td>10) ક્રિએટિવ સંસ્થા તરફથી કંપનીમાં 3 ઇન્ટરવ્યૂ કરાવવામાં આવશે, તે પાસ કરવાની જવાબદારી વિદ્યાર્થીની રહેશે ત્યાર બાદ ક્રિએટિવ સંસ્થાની જવાબદારી રહેશે નહિ.</td>
						        </tr>
						        <tr>
						            <td>11) ક્રિએટિવ સંસ્થા  ફક્ત ઇન્ટરવ્યૂ કરાવવા માટે જવાબદાર છે, નોકરી ની જવાબદારી વિધાર્થી ની પોતાની રહેશે,  અને તેના આવડત પર આધારિત છે, ક્રિએટિવ સંસ્થા  તેના માટે જવાબદાર રહેશે નહિ.</td>
						        </tr>
						        <tr>
						        	<td>12) ક્રિએટિવ સંસ્થા તરફ થી ઇન્ટરવ્યૂ  કરાવવામાં આવે  ત્યારે  તમે ઇન્ટરવ્યૂ માં ના જઈ શકો તો, ત્યાર પછી થી સંસ્થા તરફ થી કોઈ  ઇન્ટરવ્યૂ  કરાવવામાં આવશે નહિ.</td>
						        </tr>
						        <tr>
						        	<td>13)વિદ્યાર્થીએ Domain & Hosting તેમજ Playstore / AppStore Account purchase કરવાનું થાય તો તેનો ચાર્જ વિદ્યાર્થીનો રહેશે.</td>
						        </tr>

						        <tr>
						            <td>14)સંસ્થાના નિયમ મુજબ  વિધાર્થીને એક દિવસ  લેકચર અને બીજા દિવસે તેનુ પ્રેકટીકલ કરવાનું રહેશે, (વીક માં 3 દિવસ લેકચર  આવશે અને 3 દિવસ પ્રેકટીકલ  આવશે).</td>
						        </tr>
						        <tr>
						            <td>15)વિદ્યાર્થીએ કોર્ષ પૂર્ણ થયા પછી કોઈ પણ કામ કે એરર  સોલ્વ કે પ્રોજેક્ટ માટે સંસ્થામા આવવાનું થાય તો જે તે ફેકલ્ટીને જાણ કરી ને આવવું.</td>
						        </tr>
						        <tr>
						        	<td>16)કોર્ષ ની ફી તેમજ કોર્ષનો EMI એડમિશન ટાઈમ પર  જે ફાઇનલ કરેલ હોય તેમાં પાછળથી કોઈ ફેરફાર થશે નહિ.</td>
						        </tr>
							
						    
						        <!-- <tr>
						        	<td>
						        		<table width="100%" class="table-borderless">
						                	<tr>
						                  		<th>Registration Date </th>
						                  		<th>વિદ્યાર્થી ની સહી  </th>
						                  		<th>વાલી ની સહી  </th>
						                	</tr>
						                	<tr>
						                		<th><?php echo date('d-m-Y');?></th>
						                  		<td>_____________________________</td>
						                  		<td>_____________________________</td>
						                	</tr>
						              	</table>
						        	</td>
						        </tr> -->
						        
						    </table>
						</td>			
					</tr>
					
					<?php 
					// $z=1;
					// if($student['extra_note']!=""){
			    	// 	$note_arr = explode("|",$student['extra_note']);
			    	 ?>
			         <?php 
			        // 	foreach($note_arr as $note){
			         ?>
			    	 <!-- <tr>
			        // 	<th><?php //echo $z;?>)<?php //echo $note; ?>સહી  _______________</th>
			        // </tr> -->
			    	 <?php	
			    	// 	$z++;
			    	// 	}
			    	// } 
			    	?>
			    	
					<tr>
			           <th>સંસ્થાના બધા નિયમો મેં બરાબર વાંચી તમેજ સમજીને આ નિયમ સાથે સહમત થયા પછી જ મેં સંસ્થામાં એડમિશન લીધેલ છે અને પછી જ સહી કરેલ છે. _____________________</th>
			        </tr>
					<tr>
						<td colspan="2">
							<table width="100%" class="table-borderless">
			                	<tr>
			                  		<th>Registration Date </th>
			                  		<th>Student Sign </th>
			                  		<th>Instructor Sign </th>
			                	</tr>
			                	<tr>
			                		<th><?php echo date('d-m-Y');?></th>
			                  		<td>_____________________________</td>
			                  		<td>_____________________________</td>
			                	</tr>
			              	</table>
						</td>
					</tr>
				</table>
	        </div>    
	    </div>
	    <!-- <div class="page">
	        <div class="subpage">
	        	<table width="100%" class="table table-borderless p-10">
			        <tr>
			          <th>
			            ક્રિએટિવ સંસ્થા ના વિદ્યાર્થી તેમજ વાલી માટે ના નિયમો :
			          </th>
			        </tr>
			        <tr>
			          <td>1)વિદ્યાર્થી એ ઈન્સ્ટિટ્યૂટ દ્વારા આપેલા ટાઈમ પર સમયસર આવવાનું રહેશે, જો કોઈ કારણસર આવવામાં મોડું થાય અથવા રજા જોતી હોય તો એક દિવસ પહેલા ફેકલ્ટીને જાણ કરવી.જો તમે અગાઉ જાણ કર્યા વગર રજા પાડશો તો જતા રહેલા લેક્ચર ફરીથી લેવામાં આવશે નહિ.</td>
			        </tr>
			        <tr>
			          <td>2)સંસ્થામાં મોબાઈલ વાપરવા પર પ્રતિબંધ છે.લેબ માં કોઈ પણ ડીવાઈસ કોમ્પ્યુટરમાં લગાવવું નહીં,જો લગાવો તો સંસ્થા એના માટે જવાબદાર રહેશે નહિ.</td>
			        </tr>
			         <td>3)સંસ્થાની કોઈપણ પ્રોપર્ટીને નુકશાન કરવું નહિ, તેમજ કોઈપણ સ્ટાફ સાથે ગેરવર્તન કરવું નહિ, જો આવું કરશો તો એડમિશન રદ કરી નાખવામાં આવશે અને ભરેલી ફી પરત મળશે નહિ.સંસ્થામાં દાખલ થયા પછી કંઈ પણ ચીજ વસ્તુ ખાતા પકડાશો તો પ્રેક્ટિકલમાં બેસવા દેવામા આવશે નહિ.</td>
			        </tr>
			        <tr>
			          <td>4)કોર્ષનો સમયગાળો અંદાજિત હોય છે જે વિદ્યાર્થી ના યાદ શક્તિ તેમજ તેમના પ્રેક્ટિકલ પર આધારિત હોય છે જેથી કોર્ષનો સમય વધી કે ઘટી પણ શકે છે.</td>
			        </tr>
			        <tr>
			          <td>5)વિદ્યાર્થી ને કોઈ કારણ થી કોર્ષ કેન્સલ કરવાનો થાય તો  કોર્ષની ફી રીટર્ન મળશે નહિ, </td>
			        </tr>
			        <tr>
			        	<td>6)ક્રિએટિવ સંસ્થા દ્વારા રાખવામાં આવતી Test માં તમારું પરફોર્મન્સ Average કરતા ઓછું હશે તો સંસ્થા તરફથી બીજો Course Suggest કરવામાં આવશે, જો તે કોર્ષ તમે Select નહિ કરો તો કોર્ષ શીખવા માટે ક્રિએટિવ સંસ્થા જવાબદાર રહેશે નહિ</td>
			        </tr>
			       
			        <tr>
			          <td>7) તમારા કોર્ષ ના સમયગાળા દરમિયાન તમે વધુ માં વધુ એક જ મહિના ની રજા લઈ શકો, એના કરતા વધુ રજા મળી શકશે નહિ તેમજ કોર્ષ દરમિયાન વિદ્યાર્થી ની Attendence (હાજરી) 90% કે તેનાથી વધુ ફરજીયાત હોવી જરૂરી છે.</td>
			        </tr>
			        <?php 
			        //if(strtoupper($student['job_res'])=="YES"){
			        ?>
			        <tr>
			            <td>8) કોર્ષ શરુ થયા બાદ PC / LAPTOP ફરજીયાત લેવાનું રહેશે. ઈન્સ્ટિટ્યૂટ તરફથી આપવામાં આવેલા પ્રોજેક્ટ વર્કમાંથી ઓછામાં ઓછા 20 પ્રોજેક્ટ વર્ક ફરજીયાત ઘરેથી બનાવીને સબમિટ કરવાના રહેશે. </td>
			        </tr>
			        <tr>
			          	<td>9)કોર્ષ પૂરો થયા પછી આખા કોર્ષ નું રીવીઝન કરવાનું રહેશે અને પહેલા 5 ઇન્ટરવ્યૂ ઇન્સ્ટિટ્યૂટમાં થશે તેમાં પાસ થયા પછી જ કંપનીમાં ઇન્ટરવ્યૂ કરાવવામાં આવશે.</td>
			        </tr>
			        <tr>
			            <td>10) ક્રિએટિવ સંસ્થા  ફક્ત ઇન્ટરવ્યૂ કરાવવા માટે જવાબદાર છે, નોકરી ની જવાબદારી વિધાર્થી ની પોતાની રહેશે,  અને તેના આવડત પર આધારિત છે, ક્રિએટિવ સંસ્થા  તેના માટે જવાબદાર રહેશે નહિ.</td>
			        </tr>
			        <tr>
			        	<td>11) ક્રિએટિવ સંસ્થા તરફ થી ઇન્ટરવ્યૂ  કરાવવામાં આવે  ત્યારે  તમે ઇન્ટરવ્યૂ માં ના જઈ શકો તો, ત્યાર પછી થી સંસ્થા તરફ થી કોઈ  ઇન્ટરવ્યૂ  કરાવવામાં આવશે નહિ.</td>
			        </tr>
			        <tr>
			        	<td>12)વિદ્યાર્થીએ Domain & Hosting તેમજ Playstore / AppStore Account purchase કરવાનું થાય તો તેનો ચાર્જ વિદ્યાર્થી નો રહેશે.</td>
			        </tr>
			        
			        <tr>
			            <td>13)વિદ્યાર્થીએ Domain & Hosting તેમજ Playstore / AppStore Account purchase કરવાનું થાય તો તેનો ચાર્જ વિદ્યાર્થી નો રહેશે.</td>
			        </tr>
			        <tr>
			            <td>14)સંસ્થા  ના નિયમ મુજબ  વિધાર્થી  ને એક દિવસ  લેકચર અને બીજા દિવસે તેની પ્રેકટીકલ કરવાનું રહેશે, (વીક માં 3 દિવસ લેકચર  આવશે અને 3 દિવસ પ્રેકટીકલ  આવશે).</td>
			        </tr>
			        <tr>
			            <td>15)વિદ્યાર્થીએ કોર્ષ પૂર્ણ થયા પછી કોઈ પણ કામ કે એરર  સોલ્વ કે પ્રોજેક્ટ માટે સંસ્થામા આવવાનું થાય તો જે તે ફેકલ્ટીને જાણ કરી ને આવવું.</td>
			        </tr>
			        <tr>
			        	<td>16)કોર્ષ ની ફી તેમજ કોર્ષનો EMI એડમિશન ટાઈમ પર  જે ફાઇનલ કરેલ હોય તેમાં પાછળથી કોઈ ફેરફાર થશે નહિ.</td>
			        </tr>
					
			        <tr>
			            <th>
			            	કોર્ષની ફી અને EMI તેમજ સંસ્થા ના બધા નિયમો  મેં બરાબર વાંચી તમેજ સમજી ને આ નિયમ સાથે સહમત થયા પછી જ મેં સંસ્થા માં એડમિશન લીધેલ છે અને પછી જ સહી કરેલ છે _____________________
			        	</th>
			        </tr>
			    	<?php //} ?>
			    
			        <tr>
			        	<td>
			        		<table width="100%" class="table-borderless">
			                	<tr>
			                  		<th>Registration Date </th>
			                  		<th>વિદ્યાર્થી ની સહી  </th>
			                  		<th>વાલી ની સહી  </th>
			                	</tr>
			                	<tr>
			                		<th><?php echo date('d-m-Y');?></th>
			                  		<td>_____________________________</td>
			                  		<td>_____________________________</td>
			                	</tr>
			              	</table>
			        	</td>
			        </tr>
			        
			    </table>
				
	        </div>    
	    </div> -->
	</div>
	
 <script type="text/javascript">
   window.onload=function(){
    window.print();
   }
 </script>
</body>
</html>