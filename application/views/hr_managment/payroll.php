           <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-4">
                      <?php $photo = $profile_info['photo'];?>
                      <div class="d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center">
                    <img src="<?php echo base_url(!empty($photo)? '/upload/employee_photo/'.$photo : 'assets/images/client1.jpg'); ?>" class="img-lg rounded" alt="profile image">
                    <div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
                      <h6 class="mb-0"><?php echo $profile_info['full_name']; ?></h6>
                      <p class="text-muted mb-1"><?php echo $profile_info['designation']; ?></p>
                   
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
                            <a class="nav-link " href="<?php echo base_url('hrmanagement/employee_profile_info/'.$profile_info['id']);?>">
                              <i class="ti-user"></i>
                              Info
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link " href="<?php echo base_url('hrmanagement/profile_jobs/'.$profile_info['id']);?>">
                              <i class="ti-vector"></i>
                              Jobs
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link active" href="<?php echo base_url('hrmanagement/payroll/'.$profile_info['id']);?>">
                              <i class="ti-receipt"></i>
                              Payroll
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('hrmanagement/sales/'.$profile_info['id']);?>">
                              <i class="ti-briefcase"></i>
                              Sales
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('hrmanagement/salary/'.$profile_info['id']);?>">
                              <i class="ti-money"></i>
                              Salary
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

                  <div class="card">
            <div class="card-body">
              <h4 class="display-4">Payroll Statement</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table table-hover">
                      <thead>
                        <tr class="bg-primary text-white">
                            <th>#</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Mode</th>
                            <th>Paid by</th>
                            <th>Narration</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $slno = 0;
                        $amount = 0;
                        $paid = 0;
                        $received = 0;
                        foreach ($payrolls as $row) {
                          $slno += 1;
                          $photo = $row['emp_photo'];
                          if ($row['payment_reciept'] == "P")
                          {
                            $row_color =  "#cc3131";
                            $paid += $row['amount'];
                          }
                          else
                          {
                            $row_color =  "#54841c" ;
                            $received += $row['amount'];
                          }
                          $amount += $row['amount'];
                         ?>
                        <tr style="color: <?php echo $row_color;?>">
                            <td><?php echo $slno; ?></td>
                            <td><?php echo $row['created_at'];?></td>
                            <td>₹<?php echo $row['amount'];?></td>
                            <td><?php echo $row['mode'];?></td>
                            <td>
                              <div class="d-flex align-items-center">
                                <img src="<?php echo base_url(!empty($photo)? '/upload/employee_photo/'.$photo : 'assets/images/client1.jpg'); ?>" title="<?php echo $row['emp_name'];?>">
                              </div>
                            </td>
                            <td><?php echo $row['description'];?></td>
                        </tr>
                      <?php } ?>

                       
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <h4 > Received: <span class="display-6 text-success">₹<?php echo $received;?></span></h4>
                <h4 > Paid: <span class="display-6 text-danger">₹<?php echo $paid;?></span></h4>
              </div>
            </div>
          </div>
        </div>

                </div>



              </div>





        </div>
      </div>

