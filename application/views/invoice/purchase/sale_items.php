                              <option value="">-</option>

                              <?php
                             
                              foreach($products as $row)
                              {
                                ?>
                              <option data-discound = "<?php echo $row['discound'];?>" data-tax_ex_in="<?php echo $row['sales_tax_ex_in'];?>" data-type="product" data-price="<?php echo $row['purchase_price'];?>" value="<?php echo $row['id'];?>"><?php echo $row['product_name'];?></option>
                            <?php } ?>