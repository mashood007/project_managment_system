
<?php 
$logo = $business['company_logo'];
$icon = $business['icon'];
$favicon = $business['favicon'];
$signature = $business['authorised_signature'] ;
?>

                    <div class="row">

                          <div class="col-12 grid-margin">
                          <div class="col-md-12">
                            <div class="form-group row">
                              <div class="col-sm-12">
                           
   


                             
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuIconButton6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="ti-settings"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton6">
                                  <h6 class="dropdown-header"><font color="text-primary">Settings</font></h6>
                                  <a class="dropdown-item" href="<?php echo base_url("settings/business") ?>">Business</a>
                                  <a class="dropdown-item" href="<?php echo base_url("settings/skill") ?>">Skill</a>
                                  <a class="dropdown-item" href="<?php echo base_url("settings/role") ?>">Role</a>
                                  <a class="dropdown-item" href="<?php echo base_url("settings/job") ?>">Job</a>
                                  <a class="dropdown-item" href="<?php echo base_url("settings/account") ?>">Account Book</a>
                                  <a class="dropdown-item" href="<?php echo base_url("settings/unit") ?>">Unit</a>
                                  <a class="dropdown-item" href="<?php echo base_url("settings/tax") ?>">Tax</a>
                                  <a class="dropdown-item" href="<?php echo base_url("settings/cess") ?>">Unit</a>
                                </div>
                                                     

                            </div>
                            </div>
                          </div>
                          </div>

                          


                     </div>
          
          <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="display-4">Business Settings</h4>
                  <?php echo form_open_multipart("settings/business") ?>
                    <p class="card-description">
                      Business Details
                    </p>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Company Name<font color="red">*</font></label>
                          <div class="col-sm-8">
                            <input type="text" value="<?php echo $business['company_name']; ?>" required name="company_name" class="form-control" placeholder="eg: Xeobrain" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Authorised Person</label>
                          <div class="col-sm-8">
                            <input type="text" value="<?php echo $business['authorised_person'];?>" name="authorised_person" class="form-control" placeholder="Name" />
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3">
                        <div class="card">
                          <div class="card-body">
                            <h4 class="card-title d-flex">Company Logo
                              <small class="ml-auto align-self-end">
                              </small>
                            </h4>
                            <input type="file" <?php if (!empty($logo)){ echo "data-default-file= '".base_url('/upload/business/company_logo/'.$logo)."'";} ?> name="company_logo" class="dropify" />
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="card">
                          <div class="card-body">
                            <h4 class="card-title d-flex">Icon
                              <small class="ml-auto align-self-end">
                              </small>
                            </h4>
                              <input type="file" <?php if (!empty($icon)){ echo "data-default-file= '".base_url('/upload/business/icon/'.$icon)."'";} ?> name="icon" class="dropify" />
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="card">
                          <div class="card-body">
                            <h4 class="card-title d-flex">Favicon
                              <small class="ml-auto align-self-end">
                              </small>
                            </h4>
                            <input type="file" <?php if (!empty($favicon)){ echo "data-default-file= '".base_url('/upload/business/favicon/'.$favicon)."'";} ?> name="favicon" class="dropify" />
                          </div>
                        </div>
                      </div>
                       <div class="col-lg-3">
                        <div class="card">
                          <div class="card-body">
                            <h4 class="card-title d-flex">Authorised Signature
                              <small class="ml-auto align-self-end">
                              </small>
                            </h4>
                            <input type="file" <?php if (!empty($signature)){ echo "data-default-file= '".base_url('/upload/business/authorised_signature/'.$signature)."'";} ?> name="authorised_signature" class="dropify" />
                          </div>
                        </div>
                      </div>
                    </div><br>

                      <p class="card-description">
                      Business Contact
                    </p>

                     <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Address 1</label>
                          <div class="col-sm-9">
                            <input type="text" value="<?php echo $business['address1'];?>" name="address1" class="form-control" placeholder="eg: Room, Building" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Address 2</label>
                          <div class="col-sm-9">
                            <input type="text" value="<?php echo $business['address2'];?>" name="address2" class="form-control" placeholder="eg: Location, Pin Code" />
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Email</label>
                          <div class="col-sm-9">
                            <input type="email" value="<?php echo $business['email'];?>" name="email" class="form-control" placeholder="eg: mail@company.com" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Phone 1</label>
                          <div class="col-sm-9">
                            <input type="text" value="<?php echo $business['phone1'];?>" name="phone1" class="form-control" placeholder="Primary Phone Number" />
                          </div>
                        </div>
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Phone 2</label>
                          <div class="col-sm-9">
                            <input type="text" value="<?php echo $business['phone2'];?>" name="phone2" class="form-control" placeholder="eg: mail@company.com" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">WhatsApp</label>
                          <div class="col-sm-9">
                            <input type="text" value="<?php echo $business['whatsapp'];?>" name="whatsapp" class="form-control" placeholder="Primary Phone Number" />
                          </div>
                        </div>
                      </div>
                    </div>
                     <p class="card-description">
                      Tax Details
                    </p>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Enable GST<font color="red"></font></label>
                          <div class="form-check form-check-primary">
                            <label class="form-check-label">
                      <input type="checkbox"  class="form-check-input enable_gst_check_box" onchange="enableGst();" <?php if ($business['enable_gst'] == "yes"){ echo "checked";}?> >
                             (Check for start GST billing)
                             
                            </label>
                            <input type="hidden" value="<?php echo $business['enable_gst'];?>" id="enable_gst" name="enable_gst">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">GSTIN</label>
                          <div class="col-sm-9">
                            <input type="text" value="<?php echo $business['gstin'];?>" name="gstin" class="form-control" placeholder="GST Number" />
                          </div>
                        </div>
                      </div>
                    </div>

                     <p class="card-description">
                      Bank Details
                    </p>

                    <div class="row">
                        <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Bank Name</label>
                          <div class="col-sm-9">
                            <input type="text" value="<?php echo $business['bank_name'];?>" name="bank_name" class="form-control" placeholder="eg: FEDERAL BANK" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Account No</label>
                          <div class="col-sm-9">
                            <input type="text" value="<?php echo $business['account_no'];?>"  name="account_no" class="form-control" placeholder="bank Account Number" />
                          </div>
                        </div>
                      </div>
                    </div>

                       <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Branch</label>
                          <div class="col-sm-9">
                            <input type="text" value="<?php echo $business['branch'];?>" name="branch" class="form-control" placeholder="Account Branch" />
                          </div>
                        </div>
                      </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">IFSC</label>
                          <div class="col-sm-9">
                            <input type="text" value="<?php echo $business['ifsc'];?>" name="ifsc" class="form-control" placeholder="IFSC Code" />
                          </div>
                        </div>
                      </div>
                    </div>
                                     
                     <div class="form-group">
                      <label for="exampleTextarea1">About Company</label>
                      <textarea name="about" class="form-control" id="exampleTextarea1" rows="4">
                        <?php echo $business['about'];?>
                      </textarea>
                    </div>



                     <button type="submit" class="btn btn-success mr-2">Update</button>

                  <?php echo form_close() ?>
                </div>
              </div>
            </div>
          </div>

          <div class="alert alert-success" role="alert">
                    <font size="3"><b>Upload Image Sizes:</b><br></font>
                    <b>Logo: </b>192 Pixel Width and 33 Pixel Hight (SVG)  | 
                    <b>Icon: </b>38 Pixel Width and 38 Pixel Hight (SVG)<br>
                    <b>Favicon: </b>16 Pixel Width and 16 Pixel Hight (SVG/PNG)  | 
                    <b>Signature: </b>200 Pixel Width and 300 Pixel Hight (SVG/PNG)<br>
                  </div>
        <!-- content-wrapper ends -->