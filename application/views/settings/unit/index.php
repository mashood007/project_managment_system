          <div class="row">
             <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="display-2">Add Unit</h4>
                  <p class="card-description">
                    Enter the unit details.
                  </p>
                  <?php echo form_open("settings/unit") ?>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Full Name<font color="red">*</font></label>
                          <div class="col-sm-9">
                            <input type="text" name="full_name" class="form-control" placeholder="eg: Kilograme" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Short Name<font color="red">*</font></label>
                          <div class="col-sm-9">
                            <input type="text" name="short_name" class="form-control" placeholder="eg: KG " />
                          </div>
                        </div>
                      </div>
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
              <h4 class="display-4"> Units</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th>#</th>
                            <th>Unit Full Name</th>
                            <th>Short Name</th>
                            <th>Edit</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>

                  <?php
                  $slno = 1;
                  foreach($units as $row)
                  {
                    ?>
                        <tr>
                            <td>1</td>
                            <td><?php echo $row['full_name']; ?></td>
                            <td><?php echo $row['short_name']; ?></td>
                            <td><button class="btn btn-outline-primary">Edit</button></td>
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

