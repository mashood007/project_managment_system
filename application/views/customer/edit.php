          <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="display-4">Edit Customer</h4>
                  <?php echo form_open_multipart("customer/update/".$customer['id']) ?>
                    <p class="card-description">
                      Customer Informations
                    </p>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Full Name<font color="red">*</font></label>
                          <div class="col-sm-9">
                            <input type="text" name="full_name" value="<?php echo $customer['full_name']; ?>" class="form-control" placeholder="Full Name" required />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Company</label>
                          <div class="col-sm-9">
                            <input type="text" value="<?php echo $customer['comapny']; ?>" name="company"class="form-control" placeholder="CEO/Manager of Company" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Designation</label>
                          <div class="col-sm-9">
                            <input type="text" value="<?php echo $customer['designation']; ?>" name="designation" class="form-control" placeholder="CEO/Manager/Director..etc" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Gender</label>
                          <div class="col-sm-9">
                            <select class="form-control" id="gender" name="gender">
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                              <optio value="Transgender">Transgender</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                   
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Username</label>
                          <div class="col-sm-9">
                            <input type="text" value="<?php echo $customer['user_name']; ?>" name="user_name" class="form-control" placeholder="customer@xeobrain.com" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Password</label>
                          <div class="col-sm-9">
                            <input type="password" value="<?php echo $customer['password']; ?>" name="password" class="form-control" placeholder="Login Password" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row" >
                    <small>
                          <font color="red" >
                            If you want to change the image / id proof then upload again!!
                          </font>
                    </small>
                    </div>
                    <br>
                       <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Photo</label>
                          <div class="col-sm-9">
                           <input type="file" name="user_image" id="user_image" class="file-upload-default">
                      <div class="input-group col-xs-12">
                        <input type="text" id="user_image_name" class="form-control file-upload-info" disabled placeholder="200X200 Pixel, jpeg, png">
                        <span class="input-group-append">
                          <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                        </span>
                      </div>
                          </div>
                        </div>

                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">ID Proof</label>
                          <div class="col-sm-9">
                            <input type="file" name="id_proof" id="id_proof" class="file-upload-default">
                      <div class="input-group col-xs-12">
                        <input type="text" class="form-control file-upload-info" disabled placeholder="pdf/jpeg/png">
                        <span class="input-group-append">
                          <button class="file-upload-browse btn btn-primary" type="button">Attach</button>
                        </span>
                      </div>
                          </div>
                        </div>
                      </div>
                    </div>

            


                    <p class="card-description">
                      Address
                    </p>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Address 1</label>
                          <div class="col-sm-9">
                            <input type="text" value="<?php echo $customer['address1']; ?>" name="address1" class="form-control" placeholder="Door No/Local Area" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">City</label>
                          <div class="col-sm-9">
                            <input type="text" name="city" value="<?php echo $customer['city']; ?>" class="form-control" placeholder="City/Town" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Address 2</label>
                          <div class="col-sm-9">
                            <input type="text" name="address2" value="<?php echo $customer['address2']; ?>" class="form-control" placeholder="Village/Municipality/Local Town" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Postcode</label>
                          <div class="col-sm-9">
                            <input type="text" value="<?php echo $customer['postcode']; ?>" name="postcode" class="form-control" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">State</label>
                          <div class="col-sm-9">
                            <input type="text" value="<?php echo $customer['state']; ?>" name="state" class="form-control" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Country</label>
                          <div class="col-sm-9">
                            <select class="form-control" id="country" name="country">
                              <option value="United Arab Emirates">United Arab Emirates</option>
                              <option value="London">London</option>
                              <option value="United States of America">United States of America</option>
                              <option value="India">India</option>
                              <option value="China">China</option>
                              <option value="Soudi Arebia">Soudi Arebia</option>
                              <option value="Oman">Oman</option>
                              <option value="Qatar">Qatar</option>
                              <option value="Bahrain">Bahrain</option>
                              <option value="Russia">Russia</option>
                              <option value="Japan">Japan</option>
                              <option value="Kuwait">Kuwait</option>
                              <option value="Malaysia">Malaysia</option>
                              <option value="Egypt">Egypt</option>
                              <option value="Australia">Australia</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>

                     <p class="card-description">
                      Contact Information
                    </p>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Mobile 1<font color="red">*</font></label>
                          <div class="col-sm-9">
                            <input type="text" value="<?php echo $customer['mobile1']; ?>" class="form-control" name="mobile1" placeholder="Without country code" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Mobile 2</label>
                          <div class="col-sm-9">
                            <input type="text" value="<?php echo $customer['mobile2']; ?>" name="mobile2" class="form-control" placeholder="Without country code'" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">WhatsApp</label>
                          <div class="col-sm-9">
                            <input type="text" value="<?php echo $customer['whatsapp']; ?>" name="whatsapp" class="form-control" placeholder="Must include '91'" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Email</label>
                          <div class="col-sm-9">
                            <input type="text" value="<?php echo $customer['email']; ?>" name="email" class="form-control" placeholder="Email ID" />
                          </div>
                        </div>
                      </div>
                    </div>

                     <div class="form-group">
                      <label for="exampleTextarea1">About Customer</label>
                      <textarea name="about" value="<?php echo $customer['about']; ?>" class="form-control" id="exampleTextarea1" rows="4"></textarea>
                    </div>



                     <button type="submit" class="btn btn-success mr-2">Update customer</button>
                    <span onclick="window.location.href = '<?php echo base_url('/customer');?>'" class="btn btn-light">Cancel</span>
                 <?php echo form_close(); ?> 
                </div>
              </div>
            </div>
        <!-- content-wrapper ends -->
<script type="text/javascript">
  $('#gender').val("<?php echo $customer['gender'];?>")
  $('#country').val("<?php echo $customer['country'];?>")

</script>