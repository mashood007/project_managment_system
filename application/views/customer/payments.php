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
                    <table class="table">
                      <thead>
                        <tr class="bg-primary text-white">
                          <th>Project</th>
                          <th>Amount</th>
                          <th>Transaction</th>
                          <th>Mode</th>
                          <th>On</th>
                          <th>by</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($transactions as $row) { ?>

                        <tr>
                          <td><?php echo $row['project_name'];?></td>
                          <td>₹<?php echo $row['amount'];?></td>
                          <td><?php echo $row['payment_reciept'] == "P" ? "Paid" : "Recieved";?></td>
                          <td><?php echo $row['mode'];?></td>
                          <td><?php echo $row['created_at'];?></td>
                          <td><?php echo $row['emp_name']."&nbsp;(".$row['role_title'].")";?></td>
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





        </div>
      </div>
