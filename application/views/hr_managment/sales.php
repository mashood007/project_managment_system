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
                            <a class="nav-link " href="<?php echo base_url('hrmanagement/payroll/'.$profile_info['id']);?>">
                              <i class="ti-receipt"></i>
                              Payroll
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link active" href="<?php echo base_url('hrmanagement/sales/'.$profile_info['id']);?>">
                              <i class="ti-briefcase"></i>
                              Sales
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('hrmanagement/salary/'.$profile_info['id']);?>">
                              <i class="ti-microphone-alt "></i>
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
              <h4 class="display-4">Sales Report</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>                      
                        <tr class="bg-primary text-white">
                            <th>#</th>
                            <th>Date</th>
                            <th>Sale</th>
                            <th>Reason</th>
                            <th>Customer</th>
                            <th>Revenue</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $slno = 0;
                        $total = 0;
                        foreach ($revenues as $row) {
                          $slno +=1;
                          $total += $row['amount'];
                          switch ($row['reason']) {
                            case 'marketing_incentive':
                             $reason = "Lead";
                              break;

                            case 'sales_incentive':
                             $reason = "Conversion";
                              break;

                            case 'invoice_incentive':
                             $reason = "Invoice";
                              break;                              
                          }
                          ?>                        
                        <tr>
                            <td><?php echo $slno;?></td>
                            <td><?php echo $row['created_at'];?></td>
                            <td>Invoice#<?php $row['invoice'];?></td>
                            <td><?php echo $reason;?></td>
                            <td><?php echo $row['customer'];?></td>
                            <td>₹<?php echo number_format($row['amount'],2);?></td>
                        </tr>
                      <?php } ?>
                       
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <h4 class="display-6 text-info"> Total: ₹<?php echo number_format($total,2);?></h4>
              </div>
            </div>
          </div>
        </div>

                </div>



              </div>





        </div>
      </div>
