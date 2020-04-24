
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
                        <tr>
                          <td> <div class="d-flex align-items-center">
                            <img src="../../images/client-DP/client1.jpg" alt="profile"/></div></td>
                            <td>Abhilash</td>
                            <td>95394841545</td>
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
                            <img src="../../images/client-DP/client1.jpg" alt="profile"/></div></td>
                            <td>
                              <button class="btn btn-outline-danger" onclick="showSwal('warning-message-and-cancel')">Remove</button>
                            </td>
                        </tr>

                        <tr>
                          <td> <div class="d-flex align-items-center">
                            <img src="../../images/client-DP/client1.jpg" alt="profile"/></div></td>
                            <td>Anandh P Shankar</td>
                            <td>959864759845</td>
                            <td><font color="green">₹50.00</font></td>
                             <td>
                              <button class="btn btn-success btn-md" onclick="window.location.href = '<?php echo base_url('Customer/profile_info') ?>';">Profile</button>
                            </td>
                             <td>
                              <button class="btn btn-outline-primary">Edit data</button>
                            </td>
                            <td>
                              <button class="btn btn-warning btn-md">block</button>
                            </td>
                            <td> <div class="d-flex align-items-center">
                            <img src="../../images/client-DP/client1.jpg" alt="profile"/></div></td>
                            <td>
                              <button class="btn btn-outline-danger" onclick="showSwal('warning-message-and-cancel')">Remove</button>
                            </td>
                        </tr>
                       
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
