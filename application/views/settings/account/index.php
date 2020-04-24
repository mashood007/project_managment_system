          <div class="row">
             <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="display-2">Add new Account</h4>
                  <p class="card-description">
                    Enter the account details.
                  </p>
                  <?php echo form_open("settings/account") ?>
                    <div class="form-group">
                      <label for="account">Account Name</label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="Job Name">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Save</button>
                    <button class="btn btn-light">Cancel</button>
                  <?php echo form_close() ?>
                </div>
              </div>
            </div>
          </div>
        <!-- content-wrapper ends -->

<div class="card">
            <div class="card-body">
              <h4 class="display-4">Jobs</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th>#</th>
                            <th>Account Name</th>
                            <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                  <?php
                  $slno = 1;
                  foreach($accounts as $row)
                  {
                    ?>


                        <tr>
                            <td>1</td>
                            <td><?php echo $row['name']; ?></td>
                            <td>
                              <button class="btn btn-outline-danger" onclick="showSwal('warning-message-and-cancel')">Remove</button>
                            </td>
                        </tr>
                    <?php }?>
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
