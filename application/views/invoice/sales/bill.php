

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
                              $gross = $price;
                               }
                               ?>
                               <script type="text/javascript">
                                 
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
                             $cess_row = "";
                            if (sizeof($cess) > 0)
                            {
                              $total_cess = 0;
                              foreach ($cess as $row) {
                                $amt = $gross*$row['cess']/100;
                                $total_cess =+ $amt;
                                if ($amt > 0)
                                {
                                  $cess_row = $cess_row."&nbsp;&nbsp;&nbsp;".$row['name']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ₹".$amt."<br>";
                               }
                              }
                              $gross = $gross - $total_cess;
                            }
                            ?>
                            <script>
                              $('#cess_content').html("<?php echo $cess_row ?>");
                              $('#total_amount').html('<?php echo $gross; ?>')
                            </script>
                      
                             

