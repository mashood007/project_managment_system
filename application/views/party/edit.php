          <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="display-4">New Party/Company</h4>
                  <?php echo form_open_multipart("party/edit/".$party['id']) ?>
                    <p class="card-description">
                      Company Information
                    </p>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Party/Company Name<font color="red">*</font></label>
                          <div class="col-sm-9">
                            <input type="text" value="<?php echo $party['name'];?>" name="name" required class="form-control" placeholder="Party name" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">GSTIN</label>
                          <div class="col-sm-9">
                            <input type="text" value="<?php echo $party['gstin'];?>" class="form-control" name="gstin" placeholder="GSTIN" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <p class="card-description">
                      Autorised Person
                    </p>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Full Name</label>
                          <div class="col-sm-9">
                            <input type="text" value="<?php echo $party['full_name'];?>" class="form-control" name="full_name" placeholder="Full Name" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Phone</label>
                          <div class="col-sm-9">
                            <input type="text" value="<?php echo $party['phone'];?>" class="form-control" name="phone" placeholder="His personal Phone" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Designation</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="<?php echo $party['designation'];?>" name="designation" placeholder="CEO/Manager/Director..etc" />
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
                            <input name="user_name" value="<?php echo $party['user_name'];?>" type="text" class="form-control" placeholder="customer@xeobrain.com" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Password</label>
                          <div class="col-sm-9">
                            <input type="password" value="<?php echo $party['password'];?>" name="password" class="form-control" placeholder="Login Password" />
                          </div>
                        </div>
                      </div>
                    </div>

                       <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Photo</label>
                          <div class="col-sm-9">
                            <input type="file" name="photo" class="file-upload-default">
                      <div class="input-group col-xs-12">
                        <input type="text" class="form-control file-upload-info" disabled placeholder="200X200 Pixel, jpeg, png">
                        <span class="input-group-append">
                          <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                        </span>
                      </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">ID Proof/Business Card</label>
                          <div class="col-sm-9">
                            <input type="file" name="id_proof" class="file-upload-default">
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
                      Business Address
                    </p>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Address 1</label>
                          <div class="col-sm-9">
                            <input type="text" value="<?php echo $party['address1'];?>" name="address1" class="form-control" placeholder="Door No/Local Area" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">City</label>
                          <div class="col-sm-9">
                            <input type="text" name="city" value="<?php echo $party['city'];?>" class="form-control" placeholder="City/Town" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Address 2</label>
                          <div class="col-sm-9">
                            <input type="text" name="address2" value="<?php echo $party['address2'];?>" class="form-control" placeholder="Village/Municipality/Local Town" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Postcode</label>
                          <div class="col-sm-9">
                            <input type="text" value="<?php echo $party['postcode'];?>" name="postcode" class="form-control" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">State</label>
                          <div class="col-sm-9">
                            <input type="text" value="<?php echo $party['state'];?>" name="state" class="form-control" />
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
                            <input type="text" value="<?php echo $party['mobile1'];?>" name="mobile1" required class="form-control" placeholder="Without country code" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Mobile 2</label>
                          <div class="col-sm-9">
                            <input type="text" value="<?php echo $party['mobile2'];?>" name="mobile2" class="form-control" placeholder="Without country code'" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">WhatsApp</label>
                          <div class="col-sm-9">
                            <input type="text" value="<?php echo $party['whatsapp'];?>" name="whatsapp" class="form-control" placeholder="Must include '91'" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Email</label>
                          <div class="col-sm-9">
                            <input type="text" value="<?php echo $party['email'];?>" name="email" class="form-control" placeholder="Email ID" />
                          </div>
                        </div>
                      </div>
                    </div>

                     <div class="form-group">
                      <label for="exampleTextarea1">About Party/Company</label>
                      <textarea name="about" value="<?php echo $party['about'];?>" class="form-control" id="exampleTextarea1" rows="4"></textarea>
                    </div>



                     <button type="submit" class="btn btn-success mr-2">Update</button>
                 <?php echo form_close(); ?> 
                  <a class="btn btn-light mr-2" href="<?php echo base_url('/party');?>">Cancel</a>

                </div>
              </div>
            </div>
        <!-- content-wrapper ends -->
<script type="text/javascript">
  $('#gender').val("<?php echo $party['gender'];?>")
  $('#country').val("<?php echo $party['country'];?>")

</script>