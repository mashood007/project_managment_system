          <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="display-4">Edit Lead</h4>
                <?php echo form_open("marketing/update_lead/".$lead['id']) ?>
                    <p class="card-description">
                      Client inquiry informations
                    </p>

                     <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <div class="col-sm-2">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input user_type_radio" name="user_type_radio" value="old" <?php if($lead['customer_type'] !='temp'){ echo 'checked';} ?>>
                                Customer
                              </label>
                            </div>
                          </div>
                          <div class="col-sm-2">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input user_type_radio" name="user_type_radio" value="temp" <?php if($lead['customer_type'] =='temp'){ echo 'checked';} ?>>
                                Temporary User
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  
                    <div class="row" id="local_user"  style="<?php if($lead['customer_type'] =='temp'){ echo "display: none;";}?>">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-md-3 col-form-label">Client Name<font color="red">*</font></label>
                          <div class="col-md-9">
                          <select class="js-example-basic-single form-control w-100 " name="customer_id">
                            <?php foreach ($customers as $row) {
                              ?>
                              <option <?php if ($row['id'] == $lead['customer_id']) {echo "selected";} ?> value="<?php echo $row['id'];?>">
                                <?php echo $row['full_name']." (Ph: ".$row['mobile1'].")";?>
                              </option>
                              <?php
                            }?>
                          </select>
                        </div>
                    </div>
                  </div></div>

                <div id="temp_user" style="<?php if($lead['customer_type'] !='temp'){ echo "display: none;";}?>">
                    <div class="row"  >
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Client Name<font color="red">*</font></label>
                          <div class="col-sm-9">
                            <input   type="text" class="form-control" value="<?php if($lead['customer_type'] =='temp'){ echo $lead['client_name'];}?>" name="client_name" placeholder="Full Name" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Phone<font color="red">*</font></label>
                          <div class="col-sm-9">
                            <input type="phone"  name="phone" value="<?php if($lead['customer_type'] =='temp'){  echo $lead['phone'];}?>" class="form-control" placeholder="Phone Number" />
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">WhatsApp</label>
                          <div class="col-sm-9">
                            <input type="text" value="<?php if($lead['customer_type'] =='temp'){  echo $lead['email'];}?>"  class="form-control" name="whatsapp" placeholder="inlude '91'" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Email</label>
                          <div class="col-sm-9">
                            <input type="email" name="email" value="<?php if($lead['customer_type'] =='temp'){  echo $lead['email'];}?>" class="form-control" placeholder="Email Address" />
                          </div>
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
                                $state = 0;
                                foreach ($lead_services as $key => $value) {
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

                        <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Estimated Price</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="<?php echo $lead['est_price']; ?>"  placeholder="Price" name="est_price" />
                          </div>
                        </div>
                      </div>
                      
                    </div>


                     <div class="form-group">
                      <label for="exampleTextarea1">About Inquiry</label>
                      <textarea name="about" class="form-control" id="exampleTextarea1" rows="4" placeholder="Project/Event..etc"><?php echo $lead['about']; ?></textarea>
                    </div>



                     <button type="submit" class="btn btn-success btn-block mb-2">Save</button>
                    <a href="<?php echo base_url('marketing/lead_info/'.$lead['id']);?>" class="btn btn-light">Cancel</a>
                  <?php echo form_close() ?>
                </div>
              </div>
            </div>
        <!-- content-wrapper ends -->

</div>
