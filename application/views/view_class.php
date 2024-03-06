<option value="0" selected>Select Lecture Class</option>
<?php 
foreach($class_data as $class_lecture){
?>
    <option value="<?php echo $class_lecture['class_name'];?>"><?php echo $class_lecture['class_name'];?></option>
<?php }?>