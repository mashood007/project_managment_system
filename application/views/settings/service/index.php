          
          <div class="row">
             <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="display-2">Add new Service</h4>
                  <p class="card-description">
                    Enter the Service details.
                  </p>
                  <?php echo form_open("settings/service") ?>
                    <div class="row">
                    <div class="form-group col-sm-6">
                      <label for="skill">Service Name</label>
                      <input type="text" class="form-control" id="service" name="service" placeholder="Service Name">
                    </div>

                    <div class="form-group col-sm-6">
                      <label for="service">HSN/SAC</label>
                      <input type="text" class="form-control" id="hsn_sac" name="hsn_sac" placeholder="HSN/SAC">
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-sm-6">
                      <label for="service">Tax</label>
                      <input type="number" step="0.01" class="form-control" value="0" id="tax" name="tax" >
                    </div>
                    

                    <div class="form-group col-sm-6">
                      <label for="service">Unit</label>
                      <select class="js-example-basic-multiple w-100" name="unit">
                      <option value="0">Nos</option>
                            <?php 
                            foreach($units as $row)
                            {
                           
                            ?>
                              <option value="<?php echo $row['id'];?>"><?php echo $row['full_name'];?></option>
                            <?php
                            }
                            ?>
                      </select>
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-sm-6">
                      <label for="service">Price</label>
                      <input type="number" step="0.01" class="form-control" id="price" name="price">
                    </div>

                    <div class="form-group col-sm-6">
                      <label for="service">Discound</label>
                      <input type="number" step="0.01" class="form-control" id="discound" name="discound">
                    </div>
                  </div>

                    <button type="submit" class="btn btn-primary mr-2">Save</button>
                    <a class="btn btn-light"  href="<?php echo base_url("settings/service/list_view"); ?>">Cancel</a>
                  <?php echo form_close() ?>
                </div>
              </div>
            </div>
          </div>
        <!-- content-wrapper ends -->


        </div>