          <div class="card" id ="purchase_report_content" >
            <div class="card-body">
              <h4 class="display-4">Purchase Orders</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr class="bg-dark text-white">
                            <th>Order No</th>
                            <th>Details</th>
                            <th>Created on</th>
                            <th>Convert</th>
                            <th>Seller</th>
                            <th>Phone</th>
                            <th>#</th>
                            <th>Entered by</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>

                  <?php 
                        $slno = 0;
                        $grant_total = 0;
                        $total_paid = 0;
                        foreach ($purchase_orders as $row) {
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
                            <td><?php echo $row['id'];?></td>
                            <td>
                              <button class="btn btn-success btn-md" onclick="window.location.href = '#';">Show</button>
                            </td>
                            <td><?php echo $row['created_at'];?></td>
                            <td>
                              <button class="btn btn-primary btn-md" onclick="window.location.href = '<?php echo base_url("invoice/purchase_order/convert/".$row['id']); ?>';">Convert Purchase</button>
                            </td>
                            <td><?php echo $seller_name_and_city; ?></td>
                            <td><?php echo $seller_mobile; ?></td>
                            <td> <div class="d-flex align-items-center">
                            <img src="<?php echo base_url(!empty($photo)? '/upload/employee_photo/'.$photo : 'assets/images/client1.jpg'); ?>" ></div></td>
                            <td><?php echo $row['created_by_nick_name'];?></td>
                             <td><button class="btn btn-outline-danger" onclick="cancel('<?php echo base_url("invoice/purchase_order/cancel_order/".$row['id']); ?>')">Cancel</button></td>
                        </tr>

                    <?php } ?>    

                     

                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
