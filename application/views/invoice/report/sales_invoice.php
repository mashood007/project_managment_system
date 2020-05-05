                              <?php
                                if (sizeof($sales_invoice) > 0)
                                {
                              
                              foreach($sales_invoice as $row)
                               {
                                $photo = $row['photo'];
                                $invoice_total = $this->tempsales_model->invoiceTotal($row['id']);
                               ?>
                        <tr id="sales_invoice_row_<?php echo $row['id'];?>">
                            <td><?php echo $row['id'];?></td>
                            <td><?php echo $row['created_at'];?></td>
                            <td>
                          <button class="btn btn-dark btn-md" onclick="window.location.href = '<?php echo base_url("invoice/report/invoice_pdf/".$row['id']);?>';">Print</button>
                            </td>
                            <td>
                              <button class="btn btn-success" onclick="window.location.href = 'invoice-info.html';">Show</button>
                            </td>
                            <td><?php echo $row['full_name']."&#44;&nbsp;".$row['city'];?></td>
                            <td><?php echo $row['mobile1'];?></td>
                            <td>₹<?php  print_r($invoice_total['sum_of']);?></td>
                            <td> <div class="d-flex align-items-center">
                            <img src="<?php echo base_url(!empty($photo)? '/upload/employee_photo/'.$photo : 'assets/images/client1.jpg'); ?>" >
                          </div></td>
                            <td><?php echo $row['created_by_nick_name'];?></td>

                            <td>
                              <button class="btn btn-outline-warning" onclick="window.location.href = '<?php echo base_url("invoice/sales/edit/".$row['id']);?>';">Edit</button>
                            </td>
                            <td>
                              <button class="btn btn-outline-primary" onclick="window.location.href = '<?php echo base_url("invoice/report/invoice_return/".$row['id']);?>';">Return</button>
                            </td>
                            <td><button class="btn btn-outline-danger" onclick="deleteSale('<?php echo base_url("invoice/report/delete_invoice/".$row['id']);?>')">Cancel</button></td>
                        </tr>

                        
                              <?php
                              
                               }
                             }
                             else
                             {
                              echo "<tr></tr>";
                             }
                               ?> 