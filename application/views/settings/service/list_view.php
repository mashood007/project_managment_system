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
                        <tr id="row_<?php echo $row['id'];?>">
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
                                    <div class="dropdown">
                                    <button class="btn btn-white" type="button" id="dropdownMenuIconButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="ti-more"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton1">
                                  <a class="dropdown-item" href="<?php echo base_url('settings/service/edit/'.$row['id']);?>" >Edit</a>
                                  <div class="dropdown-divider"></div>
                                  <a class="dropdown-item" href="#" onclick="deleteRow('<?php echo base_url('settings/service/delete/'.$row['id']);?>')"><font color="red">Remove</a>
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