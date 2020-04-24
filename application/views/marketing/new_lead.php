          <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="display-4">New Lead</h4>
                <?php echo form_open("marketing/new_lead") ?>
                    <p class="card-description">
                      Client inquiry informations
                    </p>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Client Name</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="client_name" placeholder="Full Name" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Company</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="company" placeholder="Role, Company Name" />
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Place</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="place" placeholder="Location" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Phone</label>
                          <div class="col-sm-9">
                            <input type="phone" name="phone" class="form-control" placeholder="Phone Number" />
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">WhatsApp</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="whatsApp" placeholder="inlude '91'" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Email</label>
                          <div class="col-sm-9">
                            <input type="email" name="email" class="form-control" placeholder="Email Address" />
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                       <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Interested in</label>
                          <div class="col-sm-9">
                            <select class="js-example-basic-multiple w-100" multiple="multiple" name="interested_in[]">
                              <?php
                              foreach($services as $row)
                              {
                              ?>
                              <option value="<?php echo $row['id'];?>"><?php echo $row['service'];?></option>
                            <?php }?>
                             </select>
                          </div>
                        </div>
                      </div>

                        <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Estimated Price</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Price" name="est_price" />
                          </div>
                        </div>
                      </div>
                      
                    </div>


                     <div class="form-group">
                      <label for="exampleTextarea1">About Inquiry</label>
                      <textarea name="about" class="form-control" id="exampleTextarea1" rows="4" placeholder="Project/Event..etc"></textarea>
                    </div>



                     <button type="submit" class="btn btn-success btn-block mb-2">Save</button>
                    <button class="btn btn-light">Cancel</button>
                  <?php echo form_close() ?>
                </div>
              </div>
            </div>
        <!-- content-wrapper ends -->

</div>
