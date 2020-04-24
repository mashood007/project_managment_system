        <div class="card">
            <div class="card-body">
              <h4 class="display-4">Parties/Companies</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th>#</th>
                            <th>Party</th>
                            <th>Mobile</th>
                            <th>Balance</th>
                            <th>View</th>
                            <th>Manage</th>
                            <th>Access</th>
                            <th>Created by</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>

                      <?php
                      foreach($parties as $row)
                      {
                        $photo = $row['photo'];
                        $employee_photo = $row['employee_photo'];
                      ?>      
                        <tr>
                          <td> <div class="d-flex align-items-center">
                            <img src="<?php echo base_url(!empty($photo)? '/upload/party_photo/'.$photo: 'assets/images/client1.jpg'); ?>" ></div></td>
                            <td><?php echo $row['name'];?></td>
                            <td><?php echo $row['mobile1'];?></td>
                            <td><font color="red">₹150.00</font></td>
                             <td>
                              <button class="btn btn-success btn-md" onclick="window.location.href = 'customer-profile-info.html';">Profile</button>
                            </td>
                             <td>
                              <button class="btn btn-outline-primary">Edit data</button>
                            </td>
                            <td>
                              <button class="btn btn-success btn-md">Active</button>
                            </td>
                            <td> <div class="d-flex align-items-center">
                            <img src="<?php echo base_url(!empty($employee_photo)? '/upload/employee_photo/'.$employee_photo: 'assets/images/client1.jpg'); ?>" ></div></td>
                            <td>
                              <button class="btn btn-outline-danger" onclick="showSwal('warning-message-and-cancel')">Remove</button>
                            </td>
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
