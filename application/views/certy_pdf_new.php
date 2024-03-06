<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Creative Multimedia</title> 
<style type="text/css">
    @media print
    {
      body,html{margin:0px;padding: 0px;overflow:hidden !important;}
    }
</style> 
</head>

<body >

   
    <div style="text-align:center;">
        
        <div style="width:590.5px;height:826.75px;margin:auto;position:relative;text-align:center;">
            
            <img src="<?php echo base_url();?>/assets/images/certificate-empty.jpg" height="826.75px" width="590.5px" style="left:118px;transform: rotate(90deg);">         
            <div style="position:absolute;top:690px;right:127px;font-size:15px !important;font-family:verdana; font-style:italic;   width: 166px;text-align: center;transform:rotate(90deg);">
                <?php echo strtoupper($certy_info['enrollment']); ?>
            </div>
            <div style="position:absolute;top:390px;left:-18px;font-size:19px !important;font-family:arial; font-style:italic;   width: 600px;text-align: center;transform:rotate(90deg);">
                <?php echo strtoupper($certy_info['surname']);?>  <?php echo strtoupper($certy_info['first_name']);?>  <?php  echo strtoupper($certy_info['middle_name']);?>
            </div>
            <div style="position:absolute;top:353px;left:-129px;font-size:19px !important;font-family:arial;    width: 680px;text-align: center;font-style:italic;transform:rotate(90deg);">
                <?php echo strtoupper($certy_info['course_name']); ?>
            </div>
            <div style="position:absolute;top:132px;left:145px;font-size:19px !important;font-family:arial;    width: 60px;text-align: center;font-style:italic;transform:rotate(90deg);">
                <?php echo strtoupper($certy_info['grade']); ?>
            </div>
            <div style="position:absolute;top:450px;left:97px;font-size:19px !important;font-family:arial;    width: 160px;text-align: center;font-style:italic;transform:rotate(90deg);">
                <?php echo date_format(date_create($certy_info['start_date']),"d-m-Y"); ?>
            </div>
            <div style="position:absolute;top:660px;left:85px;font-size:19px !important;font-family:arial;    width: 184px;text-align: center;font-style:italic;transform:rotate(90deg);">
                <?php echo date_format(date_create($certy_info['end_date']),"d-m-Y"); ?>
            </div>
            <div style="position:absolute;top:277px;left:-33px;font-size:19px !important;font-family:arial;  font-style:italic;  width: 184px;text-align: center;transform:rotate(90deg);">
                <?php echo date_format(date_create($certy_info['certificate_date']),"d-m-Y"); ?>
            </div>
        </div>
        
        
    </div>
   

</body>
</html>