        <?php 
                       $count = 0;
                       $total = 0;
                        foreach ($purchases as $row) {
                          $total += $row['total'];
                          if ($row['unit_id'] == $product['base_unit_id'])
                          {
                            $count += $row['quantity'];
                          }
                          else
                          {
                            $count += $row['quantity'] / $product['convertional_rate'];
                          }

                          $photo = $row['emp_photo'];
                          switch ($row['selled_by']) {
                              case 'party':
                                $seller = $this->party_model->getDetails($row['party_id']);
                                $seller_mobile = $seller['mobile1'];
                                $seller_name = $seller['name']; 
                                break;
                              case 'temp_party':
                                $seller = $this->temp_party_model->getDetails($row['party_id']);
                                $seller_name = $seller['name'];
                                $seller_mobile = $seller['phone'];
                                break;
                              case 'customer':
                                $seller = $this->customer_model->getDetails($row['party_id']);
                                $seller_mobile = $seller['mobile1'];
                                $seller_name = $seller['full_name']; 
                                break;
                            }
                       ?> 
                        <tr>                          
                            <td><?php echo date("d-M-Y", strtotime($row['purchased_on'])); ?></td>
                            <td>#<?php echo $row['invoice_no']; ?></td>
                            <td><?php echo $row['quantity']; ?></td>
                            <td>₹<?php echo $row['price']; ?></td>
                            <td><?php echo $seller_name; ?></td>
                            <td><?php  echo $seller_mobile; ?></td>
                            <td> <div class="d-flex align-items-center">
                            <a href="single-job.html">
                              <img src="<?php echo base_url(!empty($photo)? '/upload/employee_photo/'.$photo : 'assets/images/client1.jpg'); ?>" >
                            </a></div></td>
                        </tr>
                       <?php } ?>
                                   <script type="text/javascript">
                          $('#purchase_total').text("<?php echo "Total: ₹".$total." (".$count." ".$product['base_unit_name'].")"; ?>")

                      </script>