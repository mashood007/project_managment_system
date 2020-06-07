          <div class="row">
             <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="display-2">Add new Job</h4>
                  <p class="card-description">
                    Enter the job details.
                  </p>
                  <?php echo form_open("settings/job") ?>
                    <div class="form-group">
                      <label for="skill">Job Name</label>
                      <input type="text" class="form-control" id="job" name="job" placeholder="Job Name">
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
                            <th>Job Name</th>
                            <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>

                  <?php
                  $slno = 1;
                  foreach($jobs as $row)
                  {
                    ?>                        
                        <tr id="row_<?php echo $row['id'];?>">
                            <td><?php echo $slno;?></td>
                            <td><?php echo $row['job'];?></td>
                            <td>
                              <button class="btn btn-outline-danger" onclick="deleteRow('<?php echo base_url('settings/job/delete/'.$row['id']);?>')">Remove</button>
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

