          <div class="card">
            <div class="card-body">
              <h4 class="display-4">Delivery Challans</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr class="bg-dark text-white">
                            <th>DC No</th>
                            <th>Details</th>
                            <th>Created on</th>
                            <th>To/From</th>
                            <th>Reason</th>
                            <th>#</th>
                            <th>Entered by</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        
                         foreach ($record as $row) { 
                          $photo = $row['photo'];

                          switch ($row['for_type']) {
                            case 'indivitual':
                              if ($row['for_cat'] == 'cutomer')
                              {
                                $project = $this->customer_model->fullName($row['delivery_for']);
                              }
                              else
                              {
                                $project = $this->party_model->Name($row['delivery_for']);                              
                              }
                              break;
                            
                            case 'project':
                               $project = $this->Project_model->Name($row['delivery_for']);
                              break;
                          }

                          ?>
                          
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td>
                              <a class="btn btn-success btn-md" href="<?php echo base_url("delivery_challan/show/".$row['id']); ?>" >Show</a>
                            </td>
                            <td><?php echo $row['created_at'];?></td>
                            <td><?php echo $project."&#44;&nbsp;".$row['location'];?></td>
                            <td><?php echo $row['reason'];?></td>
                            <td> <img src="<?php echo base_url(!empty($photo)? '/upload/employee_photo/'.$photo : 'assets/images/client1.jpg'); ?>" ></div></td>
                            <td><?php echo $row['emp_name'];?></td>
                            <td>
        <button class="btn btn-outline-danger" onclick="removeDeliveryChallan('<?php echo base_url("delivery_challan/destroy/".$row['id']); ?>');">
                      Remove</button></td>
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
