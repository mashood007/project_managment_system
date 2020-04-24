                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr class="bg-dark text-white">
                            <th>Invoice No</th>
                            <th>Purchased on</th>
                            <th>Open</th>
                            <th>Party/Seller</th>
                            <th>Phone</th>
                            <th>Amount</th>
                            <th>#</th>
                            <th>Entered by</th>
                            <th>Modify</th>
                            <th>Return</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                  <?php 
                        $slno = 0;
                        $grant_total = 0;
                        $total_paid = 0;
                        foreach ($purchase_invoices as $row) {
                          $photo = $row['photo'];
                          $slno += 1;
                          
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
                            $amount = $this->temp_purchase_model->amount($row['id']);
                            $grant_total += $amount;
                            $total_paid += $row['cash_paid'];
                  ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['created_at'];?></td>
                            <td>
                              <button class="btn btn-success" onclick="window.location.href = 'invoice-info.html';">Open</button>
                            </td>
                            <td><?php echo $seller_name_and_city; ?></td>
                            <td><?php echo $seller_mobile; ?></td>
                            <td>₹<?php echo $amount;?></td>
                            <td> <div class="d-flex align-items-center">
                            <img src="<?php echo base_url(!empty($photo)? '/upload/employee_photo/'.$photo : 'assets/images/client1.jpg'); ?>" ></div></td>
                            <td>Empoyee1</td>

                            <td>
                              <button class="btn btn-outline-warning" onclick="window.location.href = '<?php echo base_url("invoice/purchase/edit/".$row['id']); ?>';">Edit</button>
                            </td>
                            <td>
                              <button class="btn btn-outline-primary" onclick="window.location.href = '<?php echo base_url("invoice/purchase/invoice_return/".$row['id']); ?>';">Return</button>
                            </td>
                            <td><button class="btn btn-outline-danger" onclick="cancel('<?php echo base_url("invoice/purchase_report/cancel_invoice/".$row['id']); ?>')">Cancel</button>Cancel</button></td>
                        </tr>
                      <?php } ?>
                        

                     

                       
                      </tbody>
                    </table>
                  </div>
                  <h4 class="display-4 text-primary"> Total: ₹<?php echo $grant_total; ?></h4>
                  <h4 class="display-6 text-danger"> Paid: ₹<?php echo $total_paid; ?></h4>
                  <h4 class="display-6 text-warning"> Unpaid: ₹<?php echo $grant_total - $total_paid;   ?></h4>