

                              <?php
                                if (sizeof($bill) > 0)
                                {
                              $slno = 1;
                              $price = 0;
                              $discound = 0;
                              $gst = 0;
                              foreach($bill as $row)
                               {
                                $gst += $row['gst']; 
                                $price += $row['total'];
                                $discound += $row['discound'];
                               ?>
                                <tr>
                                  <td><?php echo $slno; ?></td>
                                  <td><?php echo $row['item'];?></td>
                                  <td><?php echo $row['quantity']." ".$row['unit'];?></td>
                                  <td>₹<?php echo $row['price'];?></td>
                                  <td>₹<?php echo $row['discound'];?></td>
                                  <td>₹<?php echo $row['gst'];?></td>
                                  <td><b>₹<?php echo $row['total'];?></b></td>
                                  <td>
<span class="btn btn-outline-danger" onclick="confirm_delete('<?php echo base_url("invoice/temp_sales/delete/");?>','<?php echo $row["id"]; ?>')"><i class="ti-trash"></i></span></td>
                                </tr>
                              <?php
                              $slno = $slno + 1;
                               }
                               ?>
                               <script type="text/javascript">
                                 $('#total_amount').html('<?php echo $price; ?>')
                                 $('#total_price').html('<?php echo $price+$discound-$gst; ?>')
                                 $('#total_discound').html('<?php echo $discound; ?>')
                                 $('#taxable_val').html('<?php echo $price -$gst;?>')
                                 $('#total_gst').html('<?php echo $gst;?>')
                               </script>
                               <?php
                             }
                             else
                             {
                              echo "<tr></tr>";
                             }
                               ?>                        
                             

