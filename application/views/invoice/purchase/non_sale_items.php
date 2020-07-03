 <option value="">-</option>
 <?php
                             
foreach($products as $row)
 {
?>
   <option data-type="non_sale" value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
<?php } ?>