<option data-details="" data-type="" value="">-</option>
<?php 
foreach ($parties as $row) {
    ?>
 <option data-type="party" data-details="<?php echo $row['city'].', '.$row['mobile1'].', GSTIN: '.$row['gstin'];?>" value="<?php echo $row['id'];?>"><?php echo $row['name'];?> (party)</option>
   <?php
}

foreach ($customers as $row) {
   ?>
  <option data-type="customer" data-details="<?php echo $row['city'].', '.$row['mobile1'];?>" value="<?php echo $row['id'];?>"><?php echo $row['full_name'];?>
   (customer)
    </option>
    <?php
}
 ?>