                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <div class="col-sm-4">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="membershipRadios" id="membershipRadios1" value="" checked>
                                Category
                              </label>
                            </div>
                          </div>
                          <div class="col-sm-5">
                            <div class="form-check">
                              <label class="form-check-label" onclick="window.location.href = '<?php echo base_url("product/product_subcategory"); ?>';">
                                <input type="radio" class="form-check-input" name="membershipRadios" id="membershipRadios2" value="option2">
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
                  <h4 class="display-2">Add Product Category</h4>
                  <p class="card-description">
                    Enter the product category details.
                  </p>
                    <?php echo form_open("product/product_category") ?>

                    <div class="form-group">
                      <label for="skill">Product Category Name</label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="product category name">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Save</button>
                    <button class="btn btn-light">Cancel</button>
                    
                  <?php echo form_close() ?>
                </div>
              </div>
            </div>
          </div>
        <!-- content-wrapper ends -->

<div class="card">
            <div class="card-body">
              <h4 class="display-4">Product Categories</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th>#</th>
                            <th>Category Name</th>
                            <th>Edit</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      $slno = 1;
                      foreach($categories as $row)
                      {
                        ?>


                            <tr>
                                <td><?php echo $slno; ?></td>
                                <td><?php echo $row['name']; ?></td>
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

