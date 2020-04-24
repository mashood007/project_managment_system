           <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center">
                        <?php $logo =  $product['image']; ?>
                    <img src="<?php echo base_url(!empty($logo)? '/upload/product_image/'.$logo : 'assets/images/product1.jpg'); ?>" class="img-lg rounded" alt="Product image">
                    <div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
                      <h6 class="mb-0"><?php echo $product['product_name']; ?></h6>
                      <p class="text-muted mb-1"><?php echo $product['category_name']; ?>&nbsp;&rarr;&nbsp;<?php echo $product['subcategory_name']; ?></p>
                      <p class="mb-0 text-success font-weight-bold">₹<?php echo $product['sales_price']; ?></p>
                    </div>
                  </div>
                    </div>



                    <div class="col-lg-8">
                      <div class="d-flex justify-content-between">
                        <div>
                        </div>
                      </div>
                      <div class="mt-4 py-2 border-top border-bottom">
                        <ul class="nav profile-navbar">
                          <li class="nav-item">
                            <a class="nav-link " href="<?php echo base_url("product/info/".$product["id"]); ?>">
                              <i class="ti-package"></i>
                              Info
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link active" href="<?php echo base_url("product/sales_history/".$product["id"]); ?>">
                              <i class="ti-shopping-cart"></i>
                              Sales History
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link " href="<?php echo base_url("product/purchase_history/".$product["id"]); ?>">
                              <i class="ti-truck"></i>
                              Purchase History
                            </a>
                          </li>
                        </ul>
                      </div>


                      <div class="profile-feed">
                        <div>
                           <div class="py-4">

             

                      </div>
                        </div>
                       
                      </div>
                    </div>
                  </div>    


                  <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">

                <div class="col-12 col-xl-12">
                  <div class="d-flex align-items-center justify-content-between flex-wrap">
                    <div class="border-right pr-4 mb-3 mb-xl-0">
                      <p class="text-muted"><i class="mdi mdi-cart"></i> Total Sales</p>
                      <h4 class="mb-0 font-weight-bold"><font size="4">₹<?php echo $sales_stock['saled_amount']; ?></font><br><font color="DodgerBlue" size="2"><?php echo $sales_stock['saled_stock']."&nbsp;".$product['base_unit_name']; ?></font></h4>
                    </div>
                    
                    <div class="border-right pr-4 mb-3 mb-xl-0">
                      <p class="text-muted"><i class="mdi mdi-cart-outline"></i> This Year Sales</p>
                      <h4 class="mb-0 font-weight-bold"><font size="4">₹<?php echo $sales_yearly_stock['saled_amount']; ?></font><br><font color="green" size="2"><?php echo $sales_yearly_stock['saled_stock']."&nbsp;".$product['base_unit_name']; ?></font></h4>
                    </div>
                   
                    <div class="border-right pr-3 mb-3 mb-xl-0">
                      <p class="text-muted"><i class="mdi mdi-cart-plus"></i> This Month Sales</p>
                      <h4 class="mb-0 font-weight-bold"><font size="4">₹<?php echo $sales_monthly_stock['saled_amount']; ?></font><br><font color="orange" size="2"><?php echo $sales_monthly_stock['saled_stock']."&nbsp;".$product['base_unit_name']; ?></font></h4>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">From</label>
                          <div class="col-sm-9">
                            <div id="datepicker-popup" class="input-group date datepicker">
                            <input id="from_date" onchange="history_filter('<?php echo base_url("product/filter_sales_history/".$product['id']);?>')" type="text" class="form-control" placeholder="dd/mm/yyyy">
                             <span class="input-group-addon input-group-append border-left">
                             <span class="ti-calendar input-group-text"></span>
                             </span>
                           </div>
                         </div>
                       </div>
                     </div>




                     <div class="col-md-3">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">To</label>
                          <div class="col-sm-9">
                            <div  class="input-group date datepicker datepicker-popup">
                            <input id="to_date" onchange="history_filter('<?php echo base_url("product/filter_sales_history/".$product['id']);?>')" type="text" class="form-control" placeholder="dd/mm/yyyy">
                             <span class="input-group-addon input-group-append border-left">
                             <span class="ti-calendar input-group-text"></span>
                             </span>
                           </div>
                         </div>
                       </div>
                     </div>
                   
                  </div>
                </div>
              </div>
            </div>
          </div>

                


                  <div class="card">
            <div class="card-body">
              <h4 class="display-4">Sales History</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr class="bg-primary text-white">
                            <th>Sold on</th>
                            <th>Invoice</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>TAX</th>
                            <th>Customer</th>
                            <th>Mobile</th>
                            <th>Sold by</th>
                        </tr>
                      </thead>
                      <tbody id="content_section">
                        <?php 
                        $total = 0;
                        $count = 0;
                        foreach ($sales as $row) {
                          $photo = $row['emp_photo'];
                          $total += $row['total'];
                          if ($row['unit_id'] == $product['base_unit_id'])
                          {
                            $count += $row['quantity'];
                          }
                          else
                          {
                            $count += $row['quantity'] / $product['convertional_rate'];
                          }

                        ?>
                        <tr>
                            
                            <td><?php echo $row['sold_on']; ?></td>
                            <td>#<?php echo $row['invoice_no']; ?></td>
                            <td><?php echo $row['quantity']; ?></td>
                            <td>₹<?php echo $row['price']; ?></td>
                            <td>₹<?php echo $row['discound']; ?></td>
                            <td>₹<?php echo $row['gst']; ?></td>
                            <td><?php echo $row['cust_name']; ?></td>
                            <td><?php echo $row['cust_mobile']; ?></td>
                            <td> <div class="d-flex align-items-center">
                            <a href="single-job.html"><img src="<?php echo base_url(!empty($photo)? '/upload/employee_photo/'.$photo : 'assets/images/client1.jpg'); ?>" ></a></div></td>
                        </tr>
                      <?php } ?>
                       
                       
                       
                      </tbody>
                    </table>
                  </div>
                  <h4 class="display-4 text-primary" id="sales_total"> 
                    Total:&nbsp;₹<?php echo $total."&nbsp;(".$count."&nbsp;".$product['base_unit_name'];?>)
                  </h4>
                </div>
              </div>
            </div>
          </div>
        </div>

                </div>



              </div>





        </div>
      </div>
