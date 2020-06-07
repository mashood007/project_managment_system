
         <option value="">-</option>
        <?php
        foreach($subcategories as $row)
         {
         ?>
         <option value="<?php echo $row['id']; ?>"> <?php echo $row['subcategory_name']; ?></option>
        <?php }?>
