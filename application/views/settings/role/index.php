
          
          <div class="row">
             <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="display-2">Add new</h4>
                  <p class="card-description">
                    Enter the Technical Designation details.
                  </p>
                  <?php echo form_open("settings/role") ?>
                    <div class="form-group">
                      <label for="role">Role</label>
                      <input type="text" class="form-control" id="role" name="designation" placeholder="Designation">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2" onclick="showSwal('success-message')">Save</button>
                    <button class="btn btn-light">Cancel</button>
                  <?php echo form_close() ?>
                </div>
              </div>
            </div>
          </div>
        <!-- content-wrapper ends -->
<!--                   <div class="col-md-4 col-sm-6 d-flex justify-content-center">
                    <div class="card-body">
                      <div class="wrapper text-center">
                        <h4 class="card-title">Alerts Popups</h4>
                        <p class="card-description">A success message!!!!!!!</p>
                        <button class="btn btn-outline-success" onclick="showSwal('success-message')">Click here!</button>
                      </div>
                    </div>
                  </div> -->

<div class="card">
            <div class="card-body">
              <h4 class="display-4">Roles</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th>#</th>
                            <th>Role</th>
                            <th>Employees</th>
                            <th>Settings</th>
                            <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>

                  <?php
                  $slno = 1;
                  foreach($roles as $row)
                  {
                    ?>
                        <tr>
                            <td><?php echo $slno;?></td>
                            <td><?php echo $row['designation']?></td>
                            <td>3</td>
                            <td>
                              <button class="btn btn-outline-primary" onclick="window.location.href = 'role-permission.html';">Permission</button>
                            </td>
                            <td>
                              <button class="btn btn-outline-danger" onclick="showSwal('warning-message-and-cancel')">Remove</button>
                            </td>
                        </tr>                    
                    
                    <?php
                    $slno = $slno +1;
                  }
                  $slno = 1;           ?>

                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
