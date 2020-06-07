
                        <?php 
                        $grand_total = 0;
                        $yearly_total = 0;
                        $yearly_invoices = 0;
                        $monthly_invoices = 0;
                        $monthly_total = 0;
                        $slno =0;                        
                        foreach ($purchase_return_invoices as $row) 
                        {
                          $grand_total += $row['total'];
                          $date = date_create($row['date_time']);
                          if (date_format($date,"Y") == date("Y"))
                          {
                            $yearly_total += $row['total'];
                            $yearly_invoices += 1;
                            if (date_format($date,"m") == date("m"))
                            {
                              $monthly_total += $row['total'];
                              $monthly_invoices += 1;
                            }
                          }  

                         $photo = $row['emp_photo'];

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

                         ?>
                          
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['InvoiceNo']; ?></td>
                            <td><?php echo $row['created_at']; ?></td>
                            <td><?php echo $seller_name_and_city; ?></td>
                            <td><?php echo $seller_mobile; ?></td>
                            <td> <div class="d-flex align-items-center">
                             <img src="<?php echo base_url(!empty($photo)? '/upload/employee_photo/'.$photo : 'assets/images/client1.jpg'); ?>" title="<?php echo $row['employee_name']; ?>" ></div></td>
                            <td>
                              <div class="dropdown">
                                    <button class="btn btn-white" type="button" id="dropdownMenuIconButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="ti-more"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton1">
                                  <span class="dropdown-item" onclick="window.location.href = '<?php echo base_url("invoice/purchase/return_info/".$row['id']);?>';">Show</span>

                                  <span class="dropdown-item" onclick="window.location.href = '<?php echo base_url("invoice/purchase/edit/".$row['id']); ?>';">Edit</span>

                                  <div class="dropdown-divider"></div>
                                  <span class="dropdown-item" onclick="deleteSale('<?php echo base_url("invoice/purchase_report/cancel_invoice/".$row['id']); ?>')">
                                    <font color="red">Remove</span>
                                </div>
                              </div>
                            </td>                            
                        </tr>

                        <?php } ?>
<script type="text/javascript">
$('.total_purchase').html("<?php echo $grand_total; ?>")                          
</script>