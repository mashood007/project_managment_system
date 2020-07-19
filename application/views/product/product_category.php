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
                    <span class="btn btn-light clear-input">Cancel</span>
                    
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
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      $slno = 1;
                      foreach($categories as $row)
                      {
                        ?>


                            <tr id="row_<?php echo $row['id'];?>">
                                <td><?php echo $slno; ?></td>
                                <td><?php echo $row['name']; ?></td>

                            <td>
                                    <div class="dropdown">
                                    <button class="btn btn-white" type="button" id="dropdownMenuIconButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="ti-more"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton1">
                                  <a class="dropdown-item" href="<?php echo base_url("product_category/edit_category/".$row['id']); ?>">Edit</a>
                                  
                                  <div class="dropdown-divider"></div>
                                  <a class="dropdown-item" href="#" onclick="deleteRow('<?php echo base_url('product_category/delete_category/'.$row['id']);?>')">
                                    <font color="red">Remove</a>
                                </div>
                              </div>
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

