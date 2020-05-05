
        <div class="card">
            <div class="card-body">
              <h4 class="display-4">Customers</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer</th>
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
                        <?php foreach ($customers as $row) {
                        $emp_photo = $row['emp_photo'];
                        $photo = $row['photo'];
                        ?>

                        <tr>
                          <td> <img src="<?php echo base_url(!empty($photo)? '/upload/customer_photo/'.$photo : 'assets/images/client1.jpg'); ?>" ></div></td>
                            <td><?php echo $row['full_name']; ?></td>
                            <td><?php echo $row['mobile1']; ?></td>
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
                              <td> <img src="<?php echo base_url(!empty($emp_photo)? '/upload/employee_photo/'.$emp_photo : 'assets/images/client1.jpg'); ?>" ></div></td>
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
