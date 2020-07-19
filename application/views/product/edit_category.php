
          
          <div class="row">
             <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="display-2">Edit Product Category</h4>
                  <p class="card-description">
                    Enter the product category details.
                  </p>
                    <?php echo form_open("product_category/edit_category/".$category['id']) ?>

                    <div class="form-group">
                      <label for="skill">Product Category Name</label>
                      <input type="text" value="<?php echo $category['name'];?>" class="form-control" id="name" name="name" placeholder="product category name">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                    <span class="btn btn-light clear-input">Cancel</span>
                    
                  <?php echo form_close() ?>
                </div>
              </div>
            </div>
          </div>
        <!-- content-wrapper ends -->


        </div>

