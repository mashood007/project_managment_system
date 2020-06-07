           <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="border-bottom text-center pb-4">
                        <?php $logo =  $product['image']; ?>
                        <img src="<?php echo base_url(!empty($logo)? '/upload/product_image/'.$logo : 'assets/images/product1.jpg'); ?>" alt="Product_Image" class="img-lg rounded-circle mb-3"/>
                        <div class="mb-3">
                          <h3><?php echo $product['product_name']; ?></h3>
                          <p class="text-muted mb-0"><?php echo $product['category_name']; ?>&nbsp;&rarr;&nbsp;<?php echo $product['subcategory_name']; ?></p>
                          <p class="mb-0 text-success font-weight-bold">₹<?php echo $product['sales_price']; ?></p>
                        </div>
                        <p class="w-75 mx-auto mb-3"><?php echo $product['product_description']; ?></p>
                        
                      </div>


                      <div class="border-bottom py-4">
                         
                         <p><font color="grey">Available Stock:&nbsp;</font>
                          <font size="5" color="red"><?php echo $stock['purchase_count'] - $stock['saled_stock']; ?></font>
                          <font color="grey">&nbsp;<?php echo $product['base_unit_name']; ?> (<?php echo $product['convertional_rate']; ?>&nbsp;<?php echo $product['secondary_unit_name']; ?>)</font></p>   

                         <p><font color="grey">Sale Price:&nbsp;</font><font size="2" color="green">₹<?php echo $product['sales_price']; ?></font></p> 

                         <p><font color="grey">Last Purchase Price:&nbsp;</font><font size="2" color="orange">₹<?php echo $last_purchase_price."&nbsp;".$product['base_unit_name'];; ?></font></p>
                      </div>
                      
                     <br>    
                      <button class="btn btn-primary btn-block mb-2">Edit Product</button>
                    </div>
                    <div class="col-lg-8">
                      
                      <div class="mt-4 py-2 border-top border-bottom">
                        <ul class="nav profile-navbar">
                          <li class="nav-item">
                            <a class="nav-link active" href="<?php echo base_url("product/info/".$product["id"]); ?>">
                              <i class="ti-package"></i>
                              Info
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url("product/sales_history/".$product["id"]); ?>">
                              <i class="ti-shopping-cart"></i>
                              Sales History
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url("product/purchase_history/".$product["id"]); ?>">
                              <i class="ti-truck"></i>
                              Purchase History
                            </a>
                          </li>
                        </ul>
                      </div>

                      <div class="profile-feed">
                        <div>
                           <div class="py-4">
                        <p class="clearfix">
                          <span class="float-left">
                            Status
                          </span>
                          <span class="float-right text-muted">
                            <?php if ($product['status'] == 0) {?>
                            <font color="green">Active</font>
                            <?php } else { ?>
                            <font color="red">Inactive</font>
                          <?php } ?>
                          </span>
                        </p>

                        <p class="clearfix">
                          <span class="float-left">
                            HSN/SAC Code
                          </span>
                          <span class="float-right text-muted">
                            <?php  echo $product['hsn_sac']; ?>
                          </span>
                        </p>

                        <p class="clearfix">
                          <span class="float-left">
                            Item Code
                          </span>
                          <span class="float-right text-muted">
                            <?php  echo $product['item_code']; ?>
                          </span>
                        </p>

                        <p class="clearfix">
                          <span class="float-left">
                            Tax Rate
                          </span>
                          <span class="float-right text-muted">
                            <?php echo $product['tax_type']; ?>
                          </span>
                        </p>

                        <p class="clearfix">
                          <span class="float-left">
                            Base Unit
                          </span>
                          <span class="float-right text-muted">
                            <?php echo $product['base_unit_name']; ?>
                          </span>
                        </p>
                        <p class="clearfix">
                          <span class="float-left">
                            Secondary Unit
                          </span>
                          <span class="float-right text-muted">
                            <?php echo $product['secondary_unit_name']; ?>
                          </span>
                        </p>
                         <p class="clearfix">
                          <span class="float-left">
                            Convertional Rate
                          </span>
                          <span class="float-right text-muted">
                            <?php echo $product['convertional_rate']; ?>
                          </span>
                        </p>

                         <p class="clearfix">
                          <span class="float-left">
                            Discount
                          </span>
                          <span class="float-right text-muted">
                            ₹<?php echo $product['discound']; ?>

                          </span>
                        </p><br>

                        <p class="clearfix">
                          <span class="float-left">
                            Total Sold(In Unit)
                          </span>
                          <span class="float-right text-muted">
                            <?php echo $stock['saled_stock']."&nbsp;".$product['base_unit_name']; ?>
                          </span>
                        </p>
                        <p class="clearfix">
                          <span class="float-left">
                            Total Sold (In Price)
                          </span>
                          <span class="float-right text-muted">
                            ₹<?php echo $stock['saled_amount']; ?>
                          </span>
                        </p><br>
                        <p class="clearfix">
                          <span class="float-left">
                            Total Purchased(In Unit)
                          </span>
                          <span class="float-right text-muted">
                            <?php echo $stock['purchase_count']."&nbsp;".$product['base_unit_name']; ?>
                          </span>
                        </p>
                        <p class="clearfix">
                          <span class="float-left">
                            Total Purchased (In Price)
                          </span>
                          <span class="float-right text-muted">
                            ₹<?php echo $stock['purchase_amount']; ?>
                          </span>
                        </p>

                     





                      



                      </div>
                        </div>
                       
                      </div>
                    </div>
                  </div>
                </div>

              </div>
           




        </div>
      </div></div>
