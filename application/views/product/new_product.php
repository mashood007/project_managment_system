              <input type="hidden" id="subcategories_url" value="<?php echo base_url("product/subcategories"); ?>">
                    <div class="row">

                          <div class="col-10 grid-margin">
                          <div class="col-md-10">
                            <div class="form-group row">
                              <div class="col-sm-10">
                               <button type="button" class="btn btn-success btn-icon-text">
                                <i class="ti-package btn-icon-prepend"></i>
                                Product
                              </button>
                               <button type="button" class="btn btn-outline-success btn-icon-text" onclick="window.location.href = 'new-service.html';">
                                <i class="ti-briefcase btn-icon-prepend"></i>
                                Service
                              </button>

                             
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuIconButton6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="ti-settings"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton6">
                                  <h6 class="dropdown-header"><font color="text-primary">Settings</font></h6>
                                  <a class="dropdown-item" href="product-category-settings.html">Category</a>
                                  <a class="dropdown-item" href="unit-settings.html">Units</a>
                                </div>
                             
             
                        

                            </div>
                            </div>
                          </div>
                          </div>

                          


                     </div>
          
          <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="display-4">New Product</h4>
                    <?php echo form_open_multipart("product/new_product") ?>

                    <p class="card-description">
                      Product Registration
                    </p>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Main Category<font color="red">*</font></label>
                          <div class="col-sm-9">
                            <select class="js-example-basic-single w-100 product_category" name="category_id">
                              <option value="">-</option>
                              <?php
                              foreach($categories as $row)
                              {
                                ?>
                              <option value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?></option>
                            <?php }?>
                           </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6 ">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Subcategory</label>
                          <div class="col-sm-9">
                            <select name="subcategory_id" class="js-example-basic-single w-100 subcategories">
                              <option>-</option>
                           </select>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Product Name<font color="red">*</font></label>
                          <div class="col-sm-9">
                            <input name="product_name" type="text" class="form-control" placeholder="Product Name" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">HSN/SAC</label>
                          <div class="col-sm-9">
                            <input name="hsn_sac" type="text" class="form-control" placeholder="Item HSN/SAC Code" />
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Item Code</label>
                          <div class="col-sm-9">
                            <input name="item_code" type="text" class="form-control" placeholder="Item Code" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Image</label>
                          <div class="col-sm-9">
                            <input type="file" name="image" class="file-upload-default">
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

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Sale Price<font color="red">*</font></label>
                          <div class="col-sm-5">
                            <input name="sales_price" type="text" class="form-control" placeholder="₹" />
                          </div>
                           <div class="col-sm-4">
                            <select class="form-control" name="sales_tax_ex_in">
                              <option value="ex" >Tax Exluded</option>
                              <option value="in">Tax Included</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Purchase Price<font color="red">*</font></label>
                          <div class="col-sm-5">
                            <input type="text" name="purchase_price" class="form-control" placeholder="₹" />
                          </div>
                          <div class="col-sm-4">
                            <select class="form-control" name="purchase_tax_ex_in">
                              <option value="ex">Tax Exluded</option>
                              <option value="in">Tax Included</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Tax Rate</label>
                          <div class="col-sm-9">
                            <select class="js-example-basic-single w-100" name="tax_id">
                              <option value="">None</option>
                              <?php
                              foreach($tax as $row)
                               {
                               ?>
                               <option value="<?php echo $row['id']; ?>"> 
                                <?php echo $row['name'];?>
                                  
                                </option>
                              <?php }?>
                           </select>
                          </div>
                        </div>
                      </div>
                       <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Opening Stock </label>
                          <div class="col-sm-9">
                            <input name="opening_stock" type="text" class="form-control" placeholder="Opening Stock In Base Unit" />
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Base Unit<font color="red">*</font></label>
                          <div class="col-sm-9">
                            <select class="js-example-basic-single w-100" name="base_unit_id" id="base_unit_id">                              
                               <option value="">-</option>
                              <?php
                              foreach($units as $row)
                               {
                               ?>
                               <option value="<?php echo $row['id']; ?>"> 
                                <?php echo $row['full_name'];?> (<?php echo $row['short_name'];?>)
                                  
                                </option>
                              <?php }?>
                           </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Secondary Unit</label>
                          <div class="col-sm-9">
                            <select class="js-example-basic-single w-100" name="secondary_unit_id" id="secondary_unit_id">
                               <option value="">-</option>
                              <?php
                              foreach($units as $row)
                               {
                               ?>
                               <option value="<?php echo $row['id']; ?>"> 
                                <?php echo $row['full_name'];?> (<?php echo $row['short_name'];?>)
                                  
                                </option>
                              <?php }?>
                           </select>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Convertional Rate</label>
                          <div class="col-sm-9">
                            <input type="text" name="convertional_rate" id="convertional_rate" class="form-control" placeholder="0" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group row">
                          <label class="col-sm-12 col-form-label" id="convertional_rate_label"><font color="red" size="4">1&nbsp;Kilograme&nbsp;=&nbsp;20&nbsp;Meter</font></label>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Discount</label>
                          <div class="col-sm-9">
                            <input name="discound" type="text" class="form-control" placeholder="₹" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Minimum Stock</label>
                          <div class="col-sm-9">
                            <input name="minimum_stock" type="text" class="form-control" placeholder="In Base Unit" />
                          </div>
                        </div>
                      </div>
                    </div>

                     <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Item Location</label>
                          <div class="col-sm-10">
                            <input name="item_location" type="text" class="form-control" placeholder="Area/Warehouse..etc" />
                          </div>
                        </div>
                      </div>
                    </div>

                    

                   
                   
                     <div class="form-group">
                      <label for="exampleTextarea1">Product Description</label>
                      <textarea name="product_description" class="form-control" id="exampleTextarea1" rows="4"></textarea>
                    </div>



                     <button type="submit" class="btn btn-success mr-2">Save Product</button>
                    <button class="btn btn-light">Cancel</button>
                   <?php echo form_close() ?>

                </div>
              </div>
            </div>
          </div>
        <!-- content-wrapper ends -->

