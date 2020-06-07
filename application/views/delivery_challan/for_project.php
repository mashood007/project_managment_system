<option data-details="" data-type="" value="">-</option>
<?php 
foreach ($projects as $row) {
 ?>
 <option data-details="" data-type="" value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
   <?php
} ?>