 <?php
 if($item_type == 'service')
 {
	  foreach($units as $row)
	 {?>
	  <option  value="<?php echo $row['unit_id'];?>">

	  	<?php
	  	if($row['unit_id'] == 0)
	  	{
	  		echo "Nos";
	  	}
	  	else
	  	{
	  	 	echo $row['unit_name'];

	   }
	  	 ?>	
	  	 </option>
	  	<?php
	   }
}
else
{
	  foreach($units as $row)
	 {?>

	  <option  value="<?php echo $row['base_unit_id'];?>">
	  	<?php
	  	if($row['base_unit_id'] == 0)  {echo "Nos";}
	  	else  {echo $row['base_unit_name'];}?>	
	  </option>
	  
	  <option  value="<?php echo $row['secondary_unit_id'];?>">
	  	<?php
	  	if($row['secondary_unit_id'] == 0)  {echo "Nos";}
	  	else  {echo $row['secondary_unit_name'];}?>	
	  </option>

	  	<?php
	   }	
}	
   ?>

