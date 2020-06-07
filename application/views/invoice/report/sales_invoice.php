                              <?php
                              $total_sale = 0;
                                if (sizeof($sales_invoice) > 0)
                                {
                              
                              foreach($sales_invoice as $row)
                               {
                                $photo = $row['photo'];
                                $invoice_total = $this->tempsales_model->invoiceTotal($row['id']);
                                $total_sale += $invoice_total['sum_of'];
                               ?>
                        <tr id="sales_invoice_row_<?php echo $row['id'];?>">
                            <td><?php echo $row['no'];?></td>
                            <td><?php echo $row['created_at'];?></td>
                            <td><?php echo $row['full_name']."&#44;&nbsp;".$row['city'];?></td>
                            <td><?php echo $row['mobile1'];?></td>
                            <td>₹ <?php  echo number_format($invoice_total['sum_of'], 2);?> </td>
                            <td> <div class="d-flex align-items-center">
                            <img src="<?php echo base_url(!empty($photo)? '/upload/employee_photo/'.$photo : 'assets/images/client1.jpg'); ?>" >
                          </div></td>
                            <td><?php echo $row['created_by_nick_name'];?></td>

                            <td>
                              <div class="dropdown">
                                    <button class="btn btn-white" type="button" id="dropdownMenuIconButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="ti-more"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton1">
                                  <span class="dropdown-item" onclick="window.location.href = '<?php echo base_url("invoice/sales/invoice_info/".$row['id']);?>';">Show</span>

                                  <span class="dropdown-item" onclick="window.location.href = '<?php echo base_url("invoice/report/invoice_pdf/".$row['id']);?>';">Print</span>
                                  <span class="dropdown-item" onclick="window.location.href = '<?php echo base_url("invoice/report/download_pdf/".$row['id']);?>';">Download PDF</span>

                                  <span class="dropdown-item" onclick="window.location.href = '<?php echo base_url("invoice/sales/edit/".$row['id']);?>';">Edit</span>

                                  <span class="dropdown-item" onclick="window.location.href = '<?php echo base_url("invoice/report/invoice_return/".$row['id']);?>';">Return</span>
                                  
                                  <div class="dropdown-divider"></div>
                                  <a class="dropdown-item" href="#" onclick="deleteSale('<?php echo base_url("invoice/report/delete_invoice/".$row['id']);?>')">
                                    <font color="red">Remove</a>
                                </div>
                              </div>
                            </td>
                        </tr>

                        
                              <?php
                              
                               }
                             }
                             else
                             {
                              echo "<tr></tr>";
                             }
                               ?> 
<script>
  $('.total_sale').html("<?php echo number_format($total_sale,2);?>")
</script>                               