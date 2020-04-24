          
          <div class="row">
             <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="display-2">Add new Service</h4>
                  <p class="card-description">
                    Enter the Service details.
                  </p>
                  <?php echo form_open("settings/service") ?>
                    
                    <div class="form-group">
                      <label for="skill">Service Name</label>
                      <input type="text" class="form-control" id="service" name="service" placeholder="Service Name">
                    </div>

                    <div class="form-group">
                      <label for="service">HSN/SAC</label>
                      <input type="text" class="form-control" id="hsn_sac" name="hsn_sac" placeholder="HSN/SAC">
                    </div>


                    <div class="form-group">
                      <label for="service">Tax</label>
                      <input type="number" step="0.01" class="form-control" value="0" id="tax" name="tax" >
                    </div>
                    

                    <div class="form-group">
                      <label for="service">Unit</label>
                      <select class="js-example-basic-multiple w-100" name="unit">
                      <option value="0">Nos</option>
                            <?php 
                            foreach($units as $row)
                            {
                           
                            ?>
                              <option value="<?php echo $row['id'];?>"><?php echo $row['full_name'];?></option>
                            <?php
                            }
                            ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="service">Price</label>
                      <input type="number" step="0.01" class="form-control" id="price" name="price">
                    </div>

                    <div class="form-group">
                      <label for="service">Discound</label>
                      <input type="number" step="0.01" class="form-control" id="discound" name="discound">
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
              <h4 class="display-4">Services</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th>#</th>
                            <th>Service Name</th>
                            <th>HSN/SAC</th>
                            <th>Tax</th>
                            <th>Unit</th>
                            <th>Price</th>
                            <th>Discound</th>
                            <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>

                  <?php
                  $slno = 1;
                  foreach($services as $row)
                  {
                    ?>
                        <tr>
                            <td><?php echo $slno;?></td>
                            <td><?php echo $row['service'];?></td>
                            <td><?php echo $row['hsn_sac'];?></td>
                            <td><?php echo $row['tax'];?></td>
                            <?php if ($row['unit'] == 0)
                            {
                              ?>
                              <td>Nos</td>
                            <?php
                            }
                            else
                            {?>
                            <td><?php echo $row['unit_name'];?></td>
                            <?php } ?>
                            <td><?php echo $row['price'];?></td>
                            <td><?php echo $row['discound'];?></td>
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