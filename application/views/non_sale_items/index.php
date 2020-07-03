                    <div class="row">

                          <div class="col-10 grid-margin">
                          <div class="col-md-10">
                            <div class="form-group row">
                              <div class="col-sm-10">
                               <button type="button" class="btn btn-outline-success btn-icon-text">
                                <i class="ti-package btn-icon-prepend"></i>
                                Product
                              </button>
                               <button type="button" class="btn btn-outline-success btn-icon-text" onclick="window.location.href = '<?php echo base_url("settings/service") ?>';">
                                <i class="ti-briefcase btn-icon-prepend"></i>
                                Service
                              </button>
                               <button type="button" class="btn btn-success btn-icon-text" onclick="window.location.href = '<?php echo base_url("non_sale_items") ?>';">
                                <i class="ti-harddrive btn-icon-prepend"></i>
                                Non-Sale Items
                              </button>
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuIconButton6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="ti-settings"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton6">
                                  <h6 class="dropdown-header"><font color="text-primary">Settings</font></h6>
                                  <a class="dropdown-item" href="<?php echo base_url("product/product_category"); ?>">Category</a>
                                  <a class="dropdown-item" href="<?php echo base_url("settings/unit"); ?>">Units</a>
                                </div>
                            </div>
                            </div>
                          </div>
                          </div>

                     </div>
          
          <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="display-4">New Non-Sale Items</h4>
                  <?php echo form_open("non_sale_items/add_item") ?>
                    <p class="card-description">
                      Item Registration
                    </p>

                  

                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Product Name<font color="red">*</font></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="name" placeholder="Product Name" />
                          </div>
                        </div>
                      </div>
                    </div>
                     <div class="form-group">
                      <label for="exampleTextarea1">Product Description</label>
                      <textarea class="form-control" name="description" rows="4"></textarea>
                    </div>
                     <button type="submit" class="btn btn-success mr-2">Save Item</button>
                    <span class="btn btn-light clear-input">Cancel</span>
                   <?php echo form_close() ?>
                </div>
              </div>
               <div class="card">
            <div class="card-body">
              <h4 class="display-4">Non-Sale Items List</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr class="bg-dark text-white">
                            <th>#</th>
                            <th>Item</th>
                            <th>Total Purchases</th>
                            <th>Discription</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      $slno = 0;
                      foreach($items as $row)
                      {
                        ?>
                        <tr id="row_<?php echo $row['id'];?>">
                            <td><?php echo $slno += 1;?></td>
                            <td><?php echo $row['name'];?></td>
                            <td>5</td>
                            <td><?php echo $row['description'];?></td>
                            <td>
                              <div class="dropdown">
                                <button class="btn btn-white" type="button" id="dropdownMenuIconButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="ti-more"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton1">
                                  <a class="dropdown-item" href="#" onclick="deleteRow('<?php echo base_url('non_sale_items/delete/'.$row['id']);?>')">
                                  <font color="red">Remove</a>
                                </div>
                              </div>
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

          </div>
        <!-- content-wrapper ends -->
