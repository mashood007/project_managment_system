          <div class="row">
             <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="display-2">Edit Product Subcategory</h4>
                  <p class="card-description">
                    Enter the product subcategory details.
                  </p>

                  <?php echo form_open("product_category/edit_subcategory/".$subcategory['id']) ?>
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
                                if ($row['id'] == $subcategory['category_id'])
                                {
                                  ?>
                              <option selected value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?></option>
                               <?php
                                }
                                else
                                {
                                ?>
                              <option value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?></option>
                            <?php
                             }
                             }?>
                           </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">SubCategory</label>
                          <div class="col-sm-9">
                            <input type="text" value="<?php echo $subcategory['subcategory_name']; ?>" name="subcategory_name" class="form-control" placeholder="SubCategory Name" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                    <span class="btn btn-light clear-input">Cancel</span>
                  <?php echo form_close() ?>

                </div>
              </div>
            </div>
          </div>
