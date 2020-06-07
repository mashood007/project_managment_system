<?php $photo = $customer['photo'];
 ?>
           <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center">
                    <img src="<?php echo base_url(!empty($photo)? '/upload/customer_photo/'.$photo : 'assets/images/client1.jpg'); ?>" alt="profile" class="img-lg rounded-circle mb-3"/>
                    <div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
                      <h6 class="mb-0"><?php echo $customer['full_name']; ?></h6>
                      <p class="text-muted mb-0"><?php echo $customer['company']."&#44;&nbsp;".$customer['city'];?></p>
                   
                    </div>
                  </div>
                  </div>

                    <div class="col-lg-8">
                      <div class="d-flex justify-content-between">
                        <div>
                         
                          
                          
                        </div>
                      </div>
                      <div class="mt-4 py-2 border-top border-bottom">
                        <ul class="nav profile-navbar">
                          <li class="nav-item">
                            <a class="nav-link " href="<?php echo base_url('customer/profile_info/'.$customer['id']);?>">
                              <i class="ti-user"></i>
                              Info
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link " href="<?php echo base_url('customer/projects/'.$customer['id']);?>">
                              <i class="ti-vector"></i>
                              Projects
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link active" href="<?php echo base_url('customer/payments/'.$customer['id']);?>">
                              <i class="ti-receipt"></i>
                              Payments
                            </a>
                          </li>
                          
                        </ul>
                      </div>


                      <div class="profile-feed">
                        <div>
                           <div class="py-4">

             

                      </div>
                        </div>
                       
                      </div>
                    </div>
                  </div>    


                  <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="display-4">Payment History</h4>
                  <p class="card-description">
                   Your payment information
                  </p>
                  <div class="table-responsive">
                    <table class="table" id="payments">
                      <thead>
                        <tr class="bg-primary text-white">
                          <th>On</th>
                          <th>Amount</th>
                          <th>Transaction</th>
                          <th>Mode</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $balance = 0;
                        foreach ($transactions as $row) { 
                          $balance = $row['payment_reciept'] == 'P' ? ($balance - $row['amount']) : ($balance + $row['amount'] );
                          ?>

                        <tr class="Entries <?php echo $row['payment_reciept'] == 'P' ? 'text-success' : 'text-danger';?>" data-stamp="<?php echo $row['date_time']; ?>">
                          <td data-field-type="date"><?php echo $row['created_at'];?></td>
                          <td>₹<?php echo $row['amount'];?></td>
                          <td><?php echo $row['payment_reciept'] == "P" ? "Recieved" : "Paid";?></td>
                          <td><?php echo $row['mode'];?></td>
                        </tr>
                      <?php }
                      foreach ($invoices as $row) {
                        $balance = $balance + $row['cash_recieved'] - $row['total'];
                       ?>
                        <tr class="Entries text-info" data-stamp="<?php echo $row['date_time']; ?>">
                          <td data-field-type="date"><?php echo $row['created_at'];?></td>
                          <td>₹<?php echo $row['total'];?></td>
                          <td>Invoice#<?php echo $row['id'];?> Generated</td>
                          <td><?php echo $row['mode'];?></td>
                        </tr>
                        <tr class="Entries text-danger" data-stamp="<?php echo $row['date_time']; ?>">
                          <td data-field-type="date"><?php echo $row['created_at'];?></td>
                          <td>₹<?php echo $row['cash_recieved'];?></td>
                          <td>Paid For Invoice#<?php echo $row['id'];?></td>
                          <td><?php echo $row['mode'];?></td>
                        </tr>

                      <?php

                       $sales_return = $this->salesreturn_model->invoiceReturn($row['id']);
                       foreach ($sales_return as $row_1) {
                        ?>
                         <tr class="Entries text-warning" data-stamp="<?php echo $row['date_time']; ?>">
                          <td data-field-type="date"><?php echo $row_1['created_at'];?></td>
                          <td>₹<?php echo $row_1['total'];?></td>
                          <td>DebitNote#<?php echo $row_1['id'];?> Generated</td>
                          <td><?php echo $row_1['mode'];?></td>
                        </tr>
                        <tr class="Entries text-success" data-stamp="<?php echo $row['date_time']; ?>">
                          <td data-field-type="date"><?php echo $row_1['created_at'];?></td>
                          <td>₹<?php echo $row_1['cash_refund'];?></td>
                          <td>Received From DebitNote#<?php echo $row_1['id'];?></td>
                          <td><?php echo $row_1['mode'];?></td>
                        </tr>         
                          <?php
                           $balance = $balance + $row_1['total']  - $row_1['cash_refund'];
                         }

                       } ?>

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

             <p><font color="grey">Account Balance:&nbsp;</font>
              <?php if ($balance < 0){ ?> 
              <font size="5" color="red">₹<?php echo number_format(($balance*-1),2);?></font><font color="grey"> is pending</font>
              <?php } ?>
              <?php if ($balance >= 0){ ?> 
              <font size="5" color="green">₹<?php echo number_format($balance, 2);?></font><font color="grey"> is advance</font>
              <?php } ?>

            </p>               



                </div>



              </div>





        </div>
      </div>
<script type="text/javascript">
  sortTable($('#payments'));
</script>