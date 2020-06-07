                        <div class="form-group row">
                              <div class="col-sm-12">
                                <div class="button">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuIconButton6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Grid View
                                  <i class="ti-menu-alt"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton6">
                                  <a class="dropdown-item" href="<?php echo base_url("product/list_view"); ?>">List View</a>
                              </div>
                          </div>
                        </div>
                      </div>

          <input type="hidden" id="subcategories_url" value="<?php echo base_url("product/subcategories"); ?>">
          <h4 class="display-4">Products</h4>
          <div class="row">
                  <div class="col-md-6 form-group">
                    <label>Category</label>
                    <select class="js-example-basic-single w-100 product_category">
                      <option value="">-</option>
                        <?php
                          foreach($categories as $row)
                           {
                            ?>
                    <option value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?></option>
                      <?php }?>
                    </select>
                  </div>

                    <div class="col-md-6 form-group">
                    <label>Sub Category</label>
                    <select class="js-example-basic-single w-100 subcategories">
                      <option value="">-</option>

                    </select>
                  </div>

          </div>
          
         
         <div class="row">
          <?php
          foreach($products as $row)
            {
              $logo = $row['image'];
          ?>
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center">
                   <a href="<?php echo base_url("product/info/".$row['id']); ?>"> 
                    <img src="<?php echo base_url(!empty($logo)? '/upload/product_image/'.$logo : 'assets/images/product1.jpg'); ?>" class="img-lg rounded" alt="product photo"/>
                  </a>
                    <div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
                      <h6 class="mb-0"> <?php echo $row['product_name']; ?></h6>
                      <p class="text-muted mb-1"><?php echo $row['category_name']; ?></p>
                      <p class="mb-0 text-success font-weight-bold">₹<?php echo $row['sales_price']; ?></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php
            }
            ?>          
          </div>



</div>
