          
          <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="display-4">Edit Project</h4>
                <?php echo form_open_multipart("project/update/".$project['id']."/".$prev_page) ?>
                    <p class="card-description">
                      Project Informations
                    </p>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Project Name<font color="red">*</font></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="<?php echo $project['name'];?>" name="name" placeholder="Project Name" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Services</label>
                          <div class="col-sm-9">
                            <select class="js-example-basic-multiple w-100" name="services[]" multiple="multiple">
                                <?php
                                foreach($services as $row)
                                {
                                  $state = 0;
                                  foreach ($project_services as $key => $value) {
                                    if ($value == $row['id']){$state = 1;}
                                  }
                                  if ($state == 1)
                                  {
                                ?>
                                <option selected value="<?php echo $row['id'];?>"><?php echo $row['service'];?></option>
                              <?php 
                              }
                              else{
                              ?>
                              <option value="<?php echo $row['id'];?>"><?php echo $row['service'];?></option>
                            <?php
                            }
                            }?>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Customer<font color="red">*</font></label>
                          <div class="col-sm-9">
                            <select class="js-example-basic-single w-100" id="customer_id" name="customer_id">
                              <option value="">-</option>
                            <?php 
                            foreach($customers as $row)
                            {
                           
                            ?>
                              <option value="<?php echo $row['id'];?>"><?php echo $row['full_name'];?></option>
                            <?php
                            }
                            ?>
                           </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Must end on</label>
                          <div class="col-sm-9">
                            <div id="datepicker-popup" class="input-group date datepicker">
                        <input type="text" class="form-control" name="end_date" value="<?php echo $project['end_date'];?>" placeholder="dd/mm/yyyy">
                        <span class="input-group-addon input-group-append border-left">
                          <span class="ti-calendar input-group-text"></span>
                        </span>
                      </div></div>
                        </div>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Price<font color="red">*</font></label>
                          <div class="col-sm-9">
                            <input type="text" value="<?php echo $project['price'];?>" class="form-control" name="price" placeholder="Estimated Value" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="row" >
                          <div class="col-sm-3"></div>
                          <div class="col-sm-9" >
                           <small>
                          <font color="red" >If you want to change the logo then upload again!!
                          </font>
                          </small>
                          </div>
                        </div>
                        <div class="form-group row">

                          <label class="col-sm-3 col-form-label">Logo</label>
                          <div class="col-sm-9">
                            <input type="file" name="logo" class="file-upload-default">
                              <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled placeholder="200X200 Pixel, jpeg, png">
                                <span class="input-group-append">
                                  <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                </span>
                              </div>
                          </div>
                        </div>
                      </div>
                    </div>


                     <div class="form-group">
                      <label for="exampleTextarea1">About Project</label>
                      <textarea class="form-control" id="exampleTextarea1" rows="4" name="about"><?php echo $project['about']; ?></textarea>
                    </div>

                     <button class="btn btn-primary mr-2" type="submit">Update</button>
                    <a href="<?php echo base_url($prev_page=='master_list'? 'project/master_list' : 'project');?>" class="btn btn-light">Cancel</a>
                  <?php echo form_close() ?>
                </div>
              </div>
            </div>
        <!-- content-wrapper ends -->
</div>

<script type="text/javascript">
  $('#customer_id').val("<?php echo $project['customer_id'];?>")
</script>