           <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center">
                        <img src="<?php echo base_url(!empty($logo)? '/upload/project_logo/'.$logo : 'assets/images/client1.jpg'); ?>" alt="profile" class="img-lg rounded-circle mb-3"/>
                        
                        <div class="mb-3">
                          <h3><?php echo $project['name'];?></h3>
                          <p class="text-muted mb-0">Customer:&nbsp;<a href="#"><?php echo $project['customer_name'];?></a></p>
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
                            <a class="nav-link" href="meterial-order.html">
                              <i class="ti-receipt"></i>
                              Order
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="meterial-delivery.html">
                              <i class="ti-truck"></i>
                              Delivery
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link active" href="meterial-usage.html">
                              <i class="ti-hummer"></i>
                              Usage
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="meterial-return.html">
                              <i class="ti-car"></i>
                              Return 
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
                  


                  <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="display-4">Meterial Usage Status</h4>
                  <p class="card-description">
                  </p>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr class="bg-primary text-white">
                          <th>Status</th>
                          <th>Sumbitted on</th>
                          <th>Submitted by</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                         <?php if ($project['mu_status'] > 0)
                          {?>
                          <td><label class="badge badge-success badge-pill">Verified</label></td>
                          <?php }
                          else { ?>
                          <td><label class="badge badge-danger badge-pill">Pending</label></td>
                        <?php } ?>
                          <td><?php echo $project['mu_submitted_on']; ?></td>
                          <td><?php echo $project['mu_by_name']; ?></td>
                        </tr>

                        
                      </tbody>
                    </table>
                  </div>
                </div>


              </div>


            </div>

                 <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="display-2">Used Meterials</h4>
                    <p class="card-description">
                      For this project setup
                    </p>

                             
                        
                      
          

           <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Used Items</h4>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr class="table-dark">
                          <th>No</th>
                          <th>Item</th>
                          <th>Qty</th>
                          <th>Modify</th>
                        </tr>
                      </thead>
                      <tbody class="used_items">
                      <?php 
                      $slno = 0;
                      foreach ($items as $row) {
                        $slno += 1;
                        ?>
                        <tr>
                          <td><?php echo $slno; ?></td>
                          <td><?php echo $row['product_name']; ?></td>
                          <td><?php echo $row['quantity']." ".$row['unit_name']; ?></td>
                          <td> <spam class="btn btn-outline-primary" onclick="edit_cart('<?php echo $row['id'];?>')">
                          <i class="ti-pencil"></i></span></td>



                        <!-- Start Follow modal-->
                              <div class="modal fade edit_cart" id="edit_cart_modal_<?php echo $row['id'];?>" tabindex="-1" role="dialog" aria-labelledby="assign_modal" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel-2">Edit Item</h5>
                                      <button type="button" class="close close_modal" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                          
                                    <div class="modal-body">

                                    <div class="col-md-12">
                                      <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Qty<font color="red">*</font></label>
                                        <div class="col-sm-8">
                                          <input type="text"  id="quantity" value="<?php echo $row['quantity']; ?>" class="form-control" />
                                        </div>
                                      </div>
                                    </div>

                                    <div class="col-md-12">
                                      <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Unit<font color="red">*</font></label>
                                        <div class="col-sm-8">
                                        <select class="form-control" id="unit_id">
                                          <option value="<?php echo $row['base_unit_id']?>">
                                            <?php echo $row['base_unit_name'];?>
                                          </option>
                                        <option value="<?php echo $row['secondary_unit_id']?>">
                                          <?php echo $row['secondary_unit_name'];?>
                                        </option>                                          

                                        </select>
                                        </div>
                                      </div>
                                    </div>


                                      <div class="col-md-12" style="text-align: right;">
                           <button onclick="update_meterial_qty('<?php echo base_url("projects/meterial_usage/update_qty/");?>', '<?php echo $row['id'];?>')" class="btn btn-success">Save Changes</button>
                                  <button type="button" class="btn btn-light cancel-form" onclick="close_modal()">Cancel</button>
                                    </div>

                                    </div> 
                                  </div>
                                </div>
                              </div>
                        <!-- End Follow modal-->


                        </tr>

                      <?php } ?>


                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

                   
                    

                   <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">


                          <div class="col-sm-6">
                         <?php echo form_open("projects/meterial_usage/update/".$project['id'], array('id' => 'meterial_usage_form')) ?>
                           <div class="form-group">
                            <label for="exampleTextarea1">About Usage</label>
                            <textarea name="about_mu" class="form-control" id="exampleTextarea1" rows="4"><?php echo $project['about_mu']; ?></textarea>
                          </div>
                           <?php echo form_close() ?>
                        </div>
                      </div>
                    </div>
                  </div>


       
                    <button class="btn btn-light"><i class="ti-angle-left"></i> Back</button>
                    <button onclick="$('#meterial_usage_form').submit();" class="btn btn-success mr-2"><i class="ti-save"></i> Submit</button>
                    
                </div>

              </div>
            </div>




                </div>

              </div>

          </div>
        </div>
      </div>
