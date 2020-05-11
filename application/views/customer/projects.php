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
                            <a class="nav-link active" href="<?php echo base_url('customer/projects/'.$customer['id']);?>">
                              <i class="ti-vector"></i>
                              Projects
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('customer/payments/'.$customer['id']);?>">
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
                  <small>Android Application Development&nbsp;in progress:</small>
                   <div class="progress progress-md">
                      <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: 90%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">85% completed</div>
                    </div><br>


                  <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="display-4">Project log</h4>
                  <p class="card-description">
                    Project progress information
                  </p>
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr class="bg-primary text-white">
                          <th>Project</th>
                          <th>Price</th>
                          <th>Status</th>
                          <th>Estimated Time</th>
                          <th>Started on</th>
                          <th>Completed on</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($projects as $row) { 

                        $end_date = new DateTime($row['end_date']);
                        $start_date = new DateTime($row['date_time']);
                        $estimate_time = $start_date->diff($end_date)->format("%R%a Business days");
                        ?>
                         <tr style="cursor: pointer;" onclick="window.location.href='<?php echo base_url('project/discussions/'.$row['id']);?>'">
                          <td><?php echo $row['name']; ?></td>
                          <td>₹<?php echo $row['price']; ?></td>                          
                        <?php
                          if ($row['finished_by'] == 0){
                          ?>
                          <td><label class="badge badge-outline-success badge-pill">In progress</label></td>
                          <td><?php echo $estimate_time; ?></td>
                          <td><?php echo $row['created_at'];?></td>
                          <td>-</td>
                      <?php }
                      else{ ?>
                          <td><label class="badge badge-success badge-pill">Completed</label></td>
                          <td><?php echo $estimate_time; ?></td>
                          <td><?php echo $row['created_at'];?></td>
                          <td><?php echo $row['finished_at'];?></td>
                      <?php }
                      ?>
                       </tr> 
                        <?php }
                       ?>                        
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
