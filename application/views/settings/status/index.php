
          <div class="row">
             <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="display-2">Add new Status</h4>
                  <p class="card-description">
                    Enter the status details.
                  </p>
                  <?php echo form_open("settings/status") ?>
                    <div class="form-group">
                      <label for="skill">Status Name</label>
                      <input type="text" class="form-control" id="status" name="status" placeholder="Status Name">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Save</button>
                    <span class="btn btn-light clear-input">Cancel</span>
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
                            <th>Status Name</th>
                            <th>Order Number</th>
                            <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>

                  <?php
                  $slno = 1;
                  foreach($statuses as $row)
                  {
                    ?>                        
                        <tr id="row_<?php echo $row['id'];?>">
                            <td><?php echo $slno;?></td>
                            <td><?php echo $row['status'];?></td>
                            <td><input type="number" onchange="change_order($(this), '<?php echo $row['id'];?>')" value="<?php echo $row['order_number'];?>" class="form-control" style="width: 40%;"></td>
                            <td>
                              <button class="btn btn-outline-danger" onclick="deleteRow('<?php echo base_url('settings/status/delete/'.$row['id']);?>')">Remove</button>
                            </td>
                        </tr>

                       <?php 
                       $slno += 1; 
                     }?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

