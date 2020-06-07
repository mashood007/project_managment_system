                  <?php 
                        $slno = 0;
                        $grant_total = 0;
                        $total_paid = 0;
                        $yearly_total = 0;
                        $yearly_invoices = 0;
                        $monthly_invoices = 0;
                        $monthly_total = 0;
                        foreach ($purchase_invoices as $row) {
                        $amount = $row['total'];
                        $grant_total += $amount;
                          $photo = $row['photo'];
                          $slno += 1;
                          $date = date_create($row['date_time']);
                          if (date_format($date,"Y") == date("Y"))
                          {
                            $yearly_total += $amount;
                            $yearly_invoices += 1;
                            if (date_format($date,"m") == date("m"))
                            {
                              $monthly_total += $amount;
                              $monthly_invoices += 1;
                            }
                          }                          
                            switch ($row['selled_by']) {
                              case 'party':
                                $seller = $this->party_model->getDetails($row['party_id']);
                                $seller_mobile = $seller['mobile1'];
                                $seller_name_and_city = $seller['name']."&#44;&nbsp;".$seller['city']; 
                                break;
                              case 'temp_party':
                                $seller = $this->temp_party_model->getDetails($row['party_id']);
                                $seller_name_and_city = $seller['name'];
                                $seller_mobile = $seller['phone'];
                                break;
                              case 'customer':
                                $seller = $this->customer_model->getDetails($row['party_id']);
                                $seller_mobile = $seller['mobile1'];
                                $seller_name_and_city = $seller['full_name']."&#44;&nbsp;".$seller['city']; 
                                break;
                            }

                            $total_paid += $row['cash_paid'];
                  ?>
                        <tr id="sales_invoice_row_<?php echo $row['id'];?>">
                            <td><?php echo $row['no']; ?></td>
                            <td><?php echo date("d-M-Y", strtotime($row['purchase_date']));?></td>
                            <td><?php echo $seller_name_and_city; ?></td>
                            <td><?php echo $seller_mobile; ?></td>
                            <td>₹<?php echo $amount;?></td>
                            <td> <div class="d-flex align-items-center">
                            <img src="<?php echo base_url(!empty($photo)? '/upload/employee_photo/'.$photo : 'assets/images/client1.jpg'); ?>" ></div></td>
                            <td><?php echo $row['created_by_nick_name'];?></td>



                            <td>
                              <div class="dropdown">
                                    <button class="btn btn-white" type="button" id="dropdownMenuIconButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="ti-more"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton1">
                                  <span class="dropdown-item" onclick="window.location.href = '<?php echo base_url("invoice/purchase/invoice_info/".$row['id']);?>';">Show</span>

                                </div>
                              </div>
                            </td>                            
                        </tr>
                      <?php } ?>

<script type="text/javascript">
  $('.total_purchase').html('<?php echo number_format($grant_total, 2);?>')
  $('.paid').html('<?php echo number_format($total_paid,2);?>')
  $('.unpaid').html('<?php echo number_format($grant_total - $total_paid, 2);?>')

</script>