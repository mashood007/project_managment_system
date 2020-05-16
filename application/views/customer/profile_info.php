<?php $photo = $customer['photo'];
      $id_proof = $customer['id_proof'];
 ?>
           <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="border-bottom text-center pb-4">
                        <img src="<?php echo base_url(!empty($photo)? '/upload/customer_photo/'.$photo : 'assets/images/client1.jpg'); ?>" alt="profile" class="img-lg rounded-circle mb-3"/>
                        <div class="mb-3">
                          <h3><?php echo $customer['full_name']; ?></h3>
                          <p class="text-muted mb-0"><?php echo $customer['company']."&#44;&nbsp;".$customer['city'];?></p>
                          <p><i class="mdi mdi-phone btn-icon-prepend"></i>&nbsp;<?php echo $customer['mobile1']; ?>&nbsp;&nbsp;|&nbsp;&nbsp;<i class="mdi mdi-whatsapp btn-icon-prepend"></i>&nbsp;<?php echo $customer['whatsapp']; ?><br><i class="mdi mdi-email-open-outline btn-icon-prepend"></i>&nbsp;<?php echo $customer['email']; ?></p>
                        </div>
                        <p class="w-75 mx-auto mb-3"><?php echo $customer['about']; ?> </p>
                        <div class="d-flex justify-content-center">
                          <button class="btn btn-success mr-1 btn-icon-text" onclick="window.location.href='tel:<?php echo $customer['mobile1'];?>'">
                            <i class="mdi mdi-phone btn-icon-prepend"></i>Call</button>

                          <button class="btn btn-success mr-1 btn-icon-text" onclick="window.location.href='https://api.whatsapp.com/send?phone=<?php echo $customer['whatsapp']; ?>&text=Hello'">
                            <i class="mdi mdi-whatsapp btn-icon-prepend"></i>WhatsApp</button>
                          <button class="btn btn-primary btn-icon-text" onclick="window.location.href='mailto:<?php echo $customer['email'];?>'">
                          <i class="mdi mdi-email-open-outline btn-icon-prepend"></i></i>Email</button>
                        </div>
                      </div>
                      <div class="border-bottom py-4">
                        <p><font color="grey">Running Projects</font></p>
                        <div>
                          <?php foreach ($projects as $row) {
                            ?>
                          
                          <label class="badge badge-outline-dark"><?php echo $row['name'];?></label>
                          <?php } ?>
                        </div>      <br>    
                         <p><font color="grey">Account Balance:&nbsp;</font><font size="5" color="red">₹68,000.00</font><font color="grey"> is pending</font></p>                                                 
                      </div>
                      
                     <br>    
                     <?php if (!empty($id_proof)) { ?>
                      <a target="blank" href="<?php echo base_url('/upload/customer_id_proof/'.$id_proof); ?>" class="btn btn-primary btn-block mb-2">Show ID Proof</a>
                    <?php } ?>
                    </div>
                    <div class="col-lg-8">
                      
                      <div class="mt-4 py-2 border-top border-bottom">
                        <ul class="nav profile-navbar">
                          <li class="nav-item">
                            <a class="nav-link active" href="<?php echo base_url('customer/profile_info/'.$customer['id']);?>">
                              <i class="ti-user"></i>
                              Info
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('customer/projects/'.$customer['id']);?>">
                              <i class="ti-vector"></i>
                              Projects
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('customer/payments/'.$customer['id']);?>">
                              <i class="ti-receipt"></i>
                              Payments
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
                            <?php echo  $customer['active'] ? "Active User" : "Inactive User" ;?>
                          </span>
                        </p>

                        <p class="clearfix">
                          <span class="float-left">
                            Company
                          </span>
                          <span class="float-right text-muted">
                            <?php echo $customer['company'];?>
                          </span>
                        </p>

                        <p class="clearfix">
                          <span class="float-left">
                            Designation
                          </span>
                          <span class="float-right text-muted">
                            <?php echo $customer['designation']; ?>
                          </span>
                        </p>

                        <p class="clearfix">
                          <span class="float-left">
                            Gender
                          </span>
                          <span class="float-right text-muted">
                            <?php echo $customer['gender'];?>
                          </span>
                        </p>

                      

                        <p class="clearfix">
                          <span class="float-left">
                            Address
                          </span>
                          <span class="float-right text-muted">
                            <?php echo $customer['address1'];?>
                          </span><br>
                           <span class="float-right text-muted">
                            <?php echo $customer['address2'];?>
                          </span>
                        </p>

                        <p class="clearfix">
                          <span class="float-left">
                            City
                          </span>
                          <span class="float-right text-muted">
                            <?php echo $customer['city'];?>
                          </span>
                        </p>

                        <p class="clearfix">
                          <span class="float-left">
                            Postal Code
                          </span>
                          <span class="float-right text-muted">
                            <?php echo $customer['postcode'];?>
                          </span>
                        </p>

                        <p class="clearfix">
                          <span class="float-left">
                            State
                          </span>
                          <span class="float-right text-muted">
                            <?php echo $customer['state'];?>
                          </span>
                        </p>

                        <p class="clearfix">
                          <span class="float-left">
                            Country
                          </span>
                          <span class="float-right text-muted">
                            <?php echo $customer['country'];?>
                          </span>
                        </p>



                        <p class="clearfix">
                          <span class="float-left">
                            Secondary Phone:
                          </span>
                          <span class="float-right text-muted">
                            <a href="tel:<?php echo $customer['mobile2'];?>"><?php echo $customer['mobile2'];?></a>
                          </span>
                        </p><br>

                          <p class="clearfix">
                          <span class="float-left">
                           Username
                          </span>
                          <span class="float-right text-muted">
                            <?php echo $customer['user_name'];?>
                          </span>
                        </p>

                        <p class="clearfix">
                          <span class="float-left">
                            Password
                          </span>
                          <span class="float-right text-muted">
                            <?php echo $customer['password'];?>
                          </span>
                        </p>

                        <p class="clearfix">
                          <span class="float-left">
                            Registered on
                          </span>
                          <span class="float-right text-muted">
                            <?php echo $customer['created_at'];?>
                          </span>
                        </p>
                      


                      </div>
                        </div>
                       
                      </div>
                    </div>
                  </div>
                </div>

              </div>
