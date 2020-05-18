          
          <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="display-4">Edit Deployment</h4>
                     <?php echo form_open_multipart("hrmanagement/update/".$employee['id']); ?>
                    <p class="card-description">
                      Employee Information
                    </p>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Full Name<font color="red">*</font></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="<?php echo $employee['full_name'];?>" name="full_name" id="full_name" placeholder="Full Name" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Nick Name<font color="red">*</font></label>
                          <div class="col-sm-9">
                            <input type="text" value="<?php echo $employee['nick_name'];?>" name="nick_name" id="nick_name" class="form-control" placeholder="Nick Name" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Gender</label>
                          <div class="col-sm-9">
                            <select class="form-control" name="gender" id="gender">
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                              <option value="Transgender">Transgender</option>
                            </select>
                          </div>

                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Date of Birth</label>
                          <div class="col-sm-9">
                            <div id="datepicker-popup" class="input-group date datepicker">
                        <input type="text" value="<?php echo $employee['dob'];?>" name="dob" id="dob" class="form-control" placeholder="dd/mm/yyyy">
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
                          <label class="col-sm-3 col-form-label">Role<font color="red">*</font></label>
                          <div class="col-sm-9">
                            <select class="form-control" name="role" id="role">
                            <?php
                              foreach($roles as $row)
                               {?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['designation']; ?></option>
                              <?php }?>
                            </select>

                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Marital Status</label>
                          <div class="col-sm-4">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="marital_status" id="membershipRadios1" value="married" checked>
                                Married
                              </label>
                            </div>
                          </div>
                          <div class="col-sm-5">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="marital_status" id="membershipRadios2" value="single">
                                Single
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Username<font color="red">*</font></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="<?php echo $employee['user_name'];?>" name="user_name" id="user_name" placeholder="employee@xeobrain.com" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Password<font color="red">*</font></label>
                          <div class="col-sm-9">
                            <input type="text" name="user_password" id="user_password" class="form-control" value="<?php echo $employee['user_password'];?>" placeholder="Login Password" />
                          </div>
                        </div>
                      </div>
                    </div>

                       <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Photo<font color="red">*</font></label>
                          <div class="col-sm-9">
                            <input type="file" name="user_image" class="file-upload-default" id="user_image">
                      <div class="input-group col-xs-12">
                        <input type="text"  name="photo" id="user_image_name" class="form-control file-upload-info" disabled placeholder="200X200 Pixel, jpeg, png">
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
                            <input type="file" name="id_proof" id="id_proof_image" class="file-upload-default">
                      <div class="input-group col-xs-12">
                        <input type="text" id="id_proof" class="form-control file-upload-info" disabled placeholder="pdf/jpeg/png">
                        <span class="input-group-append">
                          <button class="file-upload-browse btn btn-primary" type="button">Attach</button>
                        </span>
                      </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Qualifications</label>
                          <div class="col-sm-9">
                            <input type="text" name="qualifications" id="qualifications" class="form-control" value="<?php echo $employee['qualifications'];?>" placeholder="Graduate, Post Graduate, PhD..etc" />
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <?php $emp_skills = unserialize($employee['skills']);
                          ?> 
                          <label class="col-sm-3 col-form-label">Skills</label>
                          <div class="col-sm-9">
                            <select class="js-example-basic-multiple w-100" multiple="multiple" name="skills[]" id="skills">
                            <?php
                              foreach($skills as $row)
                               {
                                $flag = false;
                                foreach ($emp_skills as $key => $value) {
                                  if ($value == $row['id']) {
                                    $flag = true;
                                  }
                                }
                                ?>
                                <option <?php if ($flag){echo "selected"; }?> value="<?php echo $row['id']; ?>"><?php echo $row['skill']; ?></option>
                              <?php }?>
                    </select>
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
                            <input type="text" value="<?php echo $employee['address1'];?>" class="form-control" placeholder="Door No/Local Area" name="address1" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">City</label>
                          <div class="col-sm-9">
                            <input type="text" value="<?php echo $employee['city'];?>" class="form-control"name="city" id="city"  placeholder="City/Town" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Address 2</label>
                          <div class="col-sm-9">
                            <input type="text" value="<?php echo $employee['address2'];?>" class="form-control" name="address2" placeholder="Village/Municipality/Local Town" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Postcode</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="<?php echo $employee['post_code'];?>" name="post_code" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">State</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="<?php echo $employee['state'];?>" name="state" />
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
                            <input type="text" value="<?php echo $employee['mobile1'];?>" class="form-control" name="mobile1" placeholder="Without country code" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Mobile 2</label>
                          <div class="col-sm-9">
                            <input type="text" value="<?php echo $employee['mobile2'];?>" name="mobile2" class="form-control" placeholder="Without country code'" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">WhatsApp</label>
                          <div class="col-sm-9">
                            <input type="text" value="<?php echo $employee['whatsapp'];?>" name="whatsapp" class="form-control" placeholder="Must include '91'" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Email</label>
                          <div class="col-sm-9">
                            <input type="text" name="email" value="<?php echo $employee['email'];?>" class="form-control" placeholder="Email ID" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Salary</label>
                          <div class="col-sm-9">
                            <input type="text" value="<?php echo $employee['salary'];?>" name="salary" class="form-control" placeholder="Monthly Salary" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Salary Day</label>
                          <div class="col-sm-9">
                            <input type="number" value="<?php echo $employee['salary_date'];?>" max="31" min='1' name="salary_date" class="form-control" placeholder="DAY (1 -31)" />
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Sales Incentive %</label>
                          <div class="col-sm-9">
                            <input type="text" value="<?php echo $employee['sales_incentive'];?>" name="sales_incentive" class="form-control" placeholder="%" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Invoice Incentive %</label>
                          <div class="col-sm-9">
                            <input type="text" value="<?php echo $employee['invoice_incentive'];?>" name="invoice_incentive" class="form-control" placeholder="%" />
                          </div>
                        </div>
                      </div>
                    </div>
                      <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Marketing Incentive %</label>
                          <div class="col-sm-9">
                            <input type="text" value="<?php echo $employee['marketing_incentive'];?>" name="marketing_incentive" class="form-control" placeholder="%" />
                          </div>
                        </div>
                      </div>
                      </div>
                     <div class="form-group">
                      <label for="exampleTextarea1">About Employee</label>
                      <textarea class="form-control" name="about"  id="exampleTextarea1" rows="4"><?php echo $employee['about'];?></textarea>
                    </div>



                     <button type="submit" class="btn btn-primary mr-2">Deploy</button>
                    <button class="btn btn-light">Cancel</button>
                   <?php echo form_close() ?>
                </div>
              </div>
            </div>
        <!-- content-wrapper ends -->
</div>
<script type="text/javascript">
  $('#gender').val('<?php echo $employee['gender']; ?>')
  $('#role').val('<?php echo $employee['role']; ?>')
  $('#country').val('<?php echo $employee['country']; ?>')

</script>