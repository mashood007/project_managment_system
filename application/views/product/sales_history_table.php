                        <?php 
                        $total = 0;
                        $count = 0;
                        foreach ($sales as $row) {
                          $photo = $row['emp_photo'];
                          $total += $row['total'];
                          if ($row['unit_id'] == $product['base_unit_id'])
                          {
                            $count += $row['quantity'];
                          }
                          else
                          {
                            $count += $row['quantity'] / $product['convertional_rate'];
                          }

                        ?>
                        <tr>
                            
                            <td><?php echo $row['sold_on']; ?></td>
                            <td>#<?php echo $row['invoice_no']; ?></td>
                            <td><?php echo $row['quantity']; ?></td>
                            <td>₹<?php echo $row['price']; ?></td>
                            <td>₹<?php echo $row['discound']; ?></td>
                            <td>₹<?php echo $row['gst']; ?></td>
                            <td><?php echo $row['cust_name']; ?></td>
                            <td><?php echo $row['cust_mobile']; ?></td>
                            <td> <div class="d-flex align-items-center">
                            <a href="single-job.html"><img src="<?php echo base_url(!empty($photo)? '/upload/employee_photo/'.$photo : 'assets/images/client1.jpg'); ?>" ></a></div></td>
                        </tr>
                      <?php } ?>
                      <script type="text/javascript">
                          $('#sales_total').text("<?php echo "Total: ₹".$total." (".$count." ".$product['base_unit_name'].")"; ?>")

                      </script>