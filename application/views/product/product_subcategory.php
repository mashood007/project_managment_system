                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <div class="col-sm-4">
                            <div class="form-check"  onclick="window.location.href = 'product-category-settings.html';">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="membershipRadios" id="membershipRadios1" value="option-1">
                                Category
                              </label>
                            </div>
                          </div>
                          <div class="col-sm-5">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="membershipRadios" id="membershipRadios2" value="" checked>
                                Subcategory
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
          
          <div class="row">
             <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="display-2">Add Product Subcategory</h4>
                  <p class="card-description">
                    Enter the product subcategory details.
                  </p>

                  <?php echo form_open("product/product_subcategory") ?>
                  <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Category</label>
                          <div class="col-sm-9">
                            <select class="js-example-basic-single w-100" name="category_id">
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
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">SubCategory</label>
                          <div class="col-sm-9">
                            <input type="text" name="subcategory_name" class="form-control" placeholder="SubCategory Name" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Save</button>
                    <button class="btn btn-light">Cancel</button>
                  <?php echo form_close() ?>

                </div>
              </div>
            </div>
          </div>
        <!-- content-wrapper ends -->

                  <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Filter by Main Category</label>
                          <div class="col-sm-9">
                            <select class="js-example-basic-single w-100 categories_filter">
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
                    </div>

<div class="card">
            <div class="card-body">
              <h4 class="display-4">Product Subcategories</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th>#</th>
                            <th>Category</th>
                            <th>SubCategory Name</th>
                            <th>Edit</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      $slno = 1;
                      foreach($subcategories as $row)
                      {
                        ?>


                            <tr class="subcategories category_<?php echo $row['category_id']; ?>">
                                <td><?php echo $slno; ?></td>
                                <td><font color="red"><?php echo $row['category_name']; ?></font></td>
                                <td><?php echo $row['subcategory_name']; ?></td>
                                <td><button class="btn btn-outline-primary">Edit</button></td>
                                <td>
                                  <button class="btn btn-outline-danger" onclick="showSwal('warning-message-and-cancel')">Remove</button>
                                </td>
                            </tr>
                        <?php
                        $slno += 1;
                         }?>

                       
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
