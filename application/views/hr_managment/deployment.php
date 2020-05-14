
          
          <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="display-4">New Deployment</h4>
                     <?php echo form_open_multipart("hrmanagement/new_deployment"); ?>
                    <p class="card-description">
                      Employee Information
                    </p>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Full Name<font color="red">*</font></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="full_name" id="full_name" placeholder="Full Name" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Nick Name<font color="red">*</font></label>
                          <div class="col-sm-9">
                            <input type="text" name="nick_name" id="nick_name" class="form-control" placeholder="Nick Name" />
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
                              <option>Male</option>
                              <option>Female</option>
                              <option>Transgender</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Date of Birth</label>
                          <div class="col-sm-9">
                            <div id="datepicker-popup" class="input-group date datepicker">
                        <input type="text" name="dob" id="dob" class="form-control" placeholder="dd/mm/yyyy">
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
                            <input type="text" class="form-control" name="user_name" id="user_name" placeholder="employee@xeobrain.com" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Password<font color="red">*</font></label>
                          <div class="col-sm-9">
                            <input type="password" name="user_password" id="user_password" class="form-control" placeholder="Login Password" />
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
                        <input type="text" name="photo" id="user_image_name" class="form-control file-upload-info" disabled placeholder="200X200 Pixel, jpeg, png">
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
                            <input type="text" name="qualifications" id="qualifications" class="form-control" placeholder="Graduate, Post Graduate, PhD..etc" />
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Skills</label>
                          <div class="col-sm-9">
                            <select class="js-example-basic-multiple w-100" multiple="multiple" name="skills[]" id="skills">
                            <?php
                              foreach($skills as $row)
                               {?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['skill']; ?></option>
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
                            <input type="text" class="form-control" placeholder="Door No/Local Area" name="address1" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">City</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control"name="city" id="city"  placeholder="City/Town" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Address 2</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="address2" placeholder="Village/Municipality/Local Town" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Postcode</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="post_code" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">State</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="state" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Country</label>
                          <div class="col-sm-9">
                            <select class="form-control" name="country">
                              <option>United Arab Emirates</option>
                              <option>London</option>
                              <option>United States of America</option>
                              <option>India</option>
                              <option>China</option>
                              <option>Soudi Arebia</option>
                              <option>Oman</option>
                              <option>Qatar</option>
                              <option>Bahrain</option>
                              <option>Russia</option>
                              <option>Japan</option>
                              <option>Kuwait</option>
                              <option>Malaysia</option>
                              <option>Egypt</option>
                              <option>Australia</option>
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
                            <input type="text" class="form-control" name="mobile1" placeholder="Without country code" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Mobile 2</label>
                          <div class="col-sm-9">
                            <input type="text" name="mobile2" class="form-control" placeholder="Without country code'" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">WhatsApp</label>
                          <div class="col-sm-9">
                            <input type="text" name="whatsapp" class="form-control" placeholder="Must include '91'" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Email</label>
                          <div class="col-sm-9">
                            <input type="text" name="email" class="form-control" placeholder="Email ID" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Salary</label>
                          <div class="col-sm-9">
                            <input type="text" name="salary" class="form-control" placeholder="Monthly Salary" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Marketing Incentive %</label>
                          <div class="col-sm-9">
                            <input type="text" name="marketing_incentive" class="form-control" placeholder="%" />
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Sales Incentive %</label>
                          <div class="col-sm-9">
                            <input type="text" name="sales_incentive" class="form-control" placeholder="%" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Invoice Incentive %</label>
                          <div class="col-sm-9">
                            <input type="text" name="invoice_incentive" class="form-control" placeholder="%" />
                          </div>
                        </div>
                      </div>
                    </div>

                     <div class="form-group">
                      <label for="exampleTextarea1">About Employee</label>
                      <textarea class="form-control" id="exampleTextarea1" rows="4"></textarea>
                    </div>



                     <button type="submit" class="btn btn-primary mr-2">Deploy</button>
                    <button class="btn btn-light">Cancel</button>
                   <?php echo form_close() ?>
                </div>
              </div>
            </div>
        <!-- content-wrapper ends -->

<div class="card">
            <div class="card-body">
              <h4 class="display-4">Deployments</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th>Code</th>
                            <th>Role</th>
                            <th>Photo</th>
                            <th>Employee</th>
                            <th>View</th>
                            <th>Network</th>
                            <th>Manage</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Access</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $slno = 1;
                        foreach($deployments as $row)
                        {
                          $photo = $row['photo'];
                          $role = $this->role_model->getRoleDetails($row['role']);
                        ?>
                        <tr>
                            <td>XE<?php echo $row['id'];?></td>
                            <td><?php echo $role['designation'];?></td>
                            <td> <div class="d-flex align-items-center">
                             <img src="<?php echo base_url(!empty($photo)? '/upload/employee_photo/'.$photo : 'assets/images/client1.jpg'); ?>" ></div></td>
                            <td><?php echo $row['full_name'];?></td>
                             <td>
                                <button class="btn btn-success btn-md" onclick="window.location.href = '<?php echo base_url("hrmanagement/employee_profile_info/".$row['id']) ?>';">Profile</button>
                            </td>
                             <td>
                              <button class="btn btn-outline-success" onclick="window.location.href = '<?php echo base_url("hrmanagement/user_connctions/".$row['id']) ?>';">Connection</button>
                            </td>
                             <td>
                              <button class="btn btn-outline-primary">Edit data</button>
                            </td>
                            <td><?php echo $row['user_name'];?></td>
                            <td><?php echo $row['user_password'];?></td>
                            <td>
                              <button class="btn btn-success btn-md">Active</button>
                            </td>
                            <td>
                              <button class="btn btn-outline-danger" onclick="showSwal('warning-message-and-cancel')">Remove</button>
                            </td>
                        </tr>
                      <?php }?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
