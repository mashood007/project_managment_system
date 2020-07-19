                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                              <div class="col-sm-12">
                                <div class="button">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuIconButton6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">List View
                                  <i class="ti-menu-alt"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton6">
                                  <a class="dropdown-item" href="<?php echo base_url("product/"); ?>">Grid View</a>
                              </div>
                          </div>
                        </div>
                      </div>
          
   <input type="hidden" id="subcategories_url" value="<?php echo base_url("product/subcategories"); ?>">

        <div class="card">
            <div class="card-body">
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
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Availability</th>
                            <th>Stock in amount</th>
                            <th>Categories</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>

                         <?php
                        foreach($products as $row)
                          {
                            $logo = $row['image'];
                            $status = $row['status'] == 0? "active-client" : "inactive-client" ;
                        ?>                       
                        <tr id="row_<?php echo $row['id'];?>">
                          <td> 
                            <div class="profile">
                            <img src="<?php echo base_url(!empty($logo)? '/upload/product_image/'.$logo : 'assets/images/product1.jpg'); ?>" alt="Image"/>
                            <div class="client-status <?php echo $status; ?>">
                          </div></td>
                            <td><?php echo $row['product_name']; ?></td>
                            <td>₹150.00</td>
                            <td><font class="text-success">5&nbsp;Kilogram</font></td>
                            <td>₹<?php echo $row['sales_price']; ?></td>
                            <td><?php echo $row['category_name']."&nbsp;&rarr;&nbsp;".$row['subcategory_name']; ?></td>
                            <td>
                                    <div class="dropdown">
                                    <button class="btn btn-white" type="button" id="dropdownMenuIconButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="ti-more"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton1">
                                  <a class="dropdown-item" href="<?php echo base_url("product/status/".$row["id"]."/".$row["status"]); ?>">
                                    <?php if ($row["status"] == '0'){ ?> 
                                      Inactive
                                    <?php } else {
                                      ?>
                                      Active 
                                    <?php } ?>
                                  </a>
                                  <a class="dropdown-item" href="<?php echo base_url("product/edit/".$product["id"]); ?>">Edit</a>
                                  
                                  <div class="dropdown-divider"></div>
                                  <a class="dropdown-item" href="#" onclick="deleteRow('<?php echo base_url('product/delete/'.$row['id']);?>')">
                                    <font color="red">Remove</a>
                                </div>
                              </div>
                            </td>
                        </tr>
                         <?php
                          }
                          ?>   

                      
                       
                       
                      </tbody>
                    </table>
                  </div>
                  <h4 class="display-4 text-primary"> Total stock in amount: ₹28693.00</h4>
                </div>
              </div>
            </div>
          </div>
        </div>

