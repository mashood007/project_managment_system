

                              <?php
                                if (sizeof($bill) > 0)
                                {
                              $slno = 1;
                              foreach($bill as $row)
                               {
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
<span class="btn btn-outline-danger" onclick="confirm_delete('<?php echo base_url("invoice/temp_sales_return/delete/");?>','<?php echo $row["id"]; ?>')"><i class="ti-trash"></i></span></td>
                                </tr>
                              <?php
                              $slno = $slno + 1;
                               }
                             }
                             else
                             {
                              echo "<tr></tr>";
                             }
                               ?>                        
                             

