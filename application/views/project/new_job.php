          
          <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="display-4">New Job</h4>
                  <?php echo form_open("project/new_job") ?>
                  <input type="hidden" name="project_id" value="<?php echo $project_id;?>">
                    <p class="card-description">
                      Job informations
                    </p>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">To<font color="red">*</font></label>
                          <div class="col-sm-9">
                            <select class="js-example-basic-single w-100" name="to">
                              <option value="">-</option>
                              <?php foreach($employees as $row)
                              {?>
                              <option value="<?php echo $row['task_to'];?>"><?php echo $row['nick_name'];?></option>
                            <?php }?>
                           </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Job<font color="red">*</font></label>
                          <div class="col-sm-9">
                            <select class="js-example-basic-single w-100" name="job_id">
                              <option value="">-</option>
                              <?php foreach($jobs as $row)
                              {?>
                              <option value="<?php echo $row['id'];?>"><?php echo $row['job'];?></option>
                            <?php }?>
                           </select>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Estimated Time</label>
                          <div class="col-sm-9">
                            <input type="number" class="form-control" placeholder="days" name="est_time" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Revenue</label>
                          <div class="col-sm-9">
                            <input type="text" name="revenue" class="form-control" placeholder="Payment for this job" />
                          </div>
                        </div>
                      </div>
                    </div>
                    

                     <div class="form-group">
                      <label for="exampleTextarea1">Job Description<font color="red">*</font></label>
                      <textarea class="form-control" id="exampleTextarea1" name="description" rows="4" placeholder="Write description here.."></textarea>
                    </div>



                     <button type="submit" class="btn btn-success btn-block mb-2">Submit</button>

                  <?php echo form_close() ?>
    <button class="btn btn-light" onclick="window.location.href = '<?php echo base_url("project/project_info/".$project_id); ?>'">
    Cancel</button>
                </div>
              </div>
            </div>
        <!-- content-wrapper ends -->

</div>
<script type="text/javascript">
  $('.nav-item').hide()
</script>
