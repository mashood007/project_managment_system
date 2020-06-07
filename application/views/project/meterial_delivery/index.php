           <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">

                    <div class="col-lg-4">
                    <div class="border-bottom text-center pb-4">
                        <img src="<?php echo base_url(!empty($logo)? '/upload/project_logo/'.$logo : 'assets/images/client1.jpg'); ?>" alt="profile" class="img-lg rounded-circle mb-3"/>
                        
                        <div class="mb-3">
                          <h3><?php echo $project['name'];?></h3>
                          <p class="text-muted mb-0">Customer:&nbsp;<a href="#"><?php echo $project['customer_name'];?></a></p>
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
                            <a class="nav-link" href="<?php echo base_url("projects/meterial_order/index/".$project['id']);?>">
                              <i class="ti-receipt"></i>
                              Order
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link active" href="<?php echo base_url("projects/meterial_delivery/info/".$project['id']);?>">
                              <i class="ti-truck"></i>
                              Delivery
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url("projects/meterial_usage/index/".$project['id']);?>">
                              <i class="ti-hummer"></i>
                              Usage
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link " href="<?php echo base_url("projects/meterial_return/index/".$project['id']);?>">
                              <i class="ti-car"></i>
                              Return 
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
                  <h4 class="display-4">Meterial Deliveries</h4>
                  <p class="card-description">
                    Based on delivery challans
                  </p>
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr class="bg-primary text-white">
                          <th>DC No</th>
                          <th>Status</th>
                          <th>Send on</th>
                          <th>Delivered on</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php 
                          foreach ($delivery_challan as $row) {
                            ?>
                         <tr onclick="window.location.href = '<?php echo base_url("projects/meterial_delivery/checklist/".$row['id']);?>';">
                          <td >#<?php echo $row['id']; ?></td>
                          <?php if ($row['delivery_status'] == 0) { ?>
                          <td><label class="badge badge-outline-danger badge-pill">Send</label></td> <?php }
                          else{ ?>
                          <td><label class="badge badge-success badge-pill">Delivered</label></td><?php } ?>                          
                          <td><?php echo date("d-M-Y", strtotime($row['delivery_date']));?></td>
                          <td><?php echo $row['delivered_on']; ?></td>
                          
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
      </div>

