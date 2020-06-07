<?php $photo = $party['photo'];
      $id_proof = $party['id_proof'];
 ?>
           <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="border-bottom text-center pb-4">
                        <img src="<?php echo base_url(!empty($photo)? '/upload/party_photo/'.$photo : 'assets/images/client1.jpg'); ?>" alt="profile" class="img-lg rounded-circle mb-3"/>
                        <div class="mb-3">
                          <h3><?php echo $party['full_name']; ?></h3>
                          <p class="text-muted mb-0"><?php echo $party['city'];?></p>
                          <p><i class="mdi mdi-phone btn-icon-prepend"></i>&nbsp;<?php echo $party['mobile1']; ?>&nbsp;&nbsp;|&nbsp;&nbsp;<i class="mdi mdi-whatsapp btn-icon-prepend"></i>&nbsp;<?php echo $party['whatsapp']; ?><br><i class="mdi mdi-email-open-outline btn-icon-prepend"></i>&nbsp;<?php echo $party['email']; ?></p>
                        </div>
                        <p class="w-75 mx-auto mb-3"><?php echo $party['about']; ?> </p>
                        <div class="d-flex justify-content-center">
                          <button class="btn btn-success mr-1 btn-icon-text" onclick="window.location.href='tel:<?php echo $party['mobile1'];?>'">
                            <i class="mdi mdi-phone btn-icon-prepend"></i>Call</button>

                          <button class="btn btn-success mr-1 btn-icon-text" onclick="window.location.href='https://api.whatsapp.com/send?phone=<?php echo $party['whatsapp']; ?>&text=Hello'">
                            <i class="mdi mdi-whatsapp btn-icon-prepend"></i>WhatsApp</button>
                          <button class="btn btn-primary btn-icon-text" onclick="window.location.href='mailto:<?php echo $party['email'];?>'">
                          <i class="mdi mdi-email-open-outline btn-icon-prepend"></i></i>Email</button>
                        </div>
                      </div>
                      <div class="border-bottom py-4">
                        
                       <p><font color="grey">Account Balance:&nbsp;</font>
                        <?php if ($balance < 0){ ?> 
                        <font size="5" color="red">₹<?php echo number_format(($balance*-1),2);?></font><font color="grey"> is pending</font>
                        <?php } ?>
                        <?php if ($balance >= 0){ ?> 
                        <font size="5" color="green">₹<?php echo number_format($balance, 2);?></font><font color="grey"> is advance</font>
                        <?php } ?>

                      </p>   

                      </div>
                      
                     <br>    
                     <?php if (!empty($id_proof)) { ?>
                      <a target="blank" href="<?php echo base_url('/upload/party_id_proof/'.$id_proof); ?>" class="btn btn-primary btn-block mb-2">Show ID Proof</a>
                    <?php } ?>
                    </div>
                    <div class="col-lg-8">
                      


                      <div class="profile-feed">
                        <div>
                           <div class="py-4">


                        <p class="clearfix">
                          <span class="float-left">
                            Designation
                          </span>
                          <span class="float-right text-muted">
                            <?php echo $party['designation']; ?>
                          </span>
                        </p>

                        <p class="clearfix">
                          <span class="float-left">
                            Gender
                          </span>
                          <span class="float-right text-muted">
                            <?php echo $party['gender'];?>
                          </span>
                        </p>

                      

                        <p class="clearfix">
                          <span class="float-left">
                            Address
                          </span>
                          <span class="float-right text-muted">
                            <?php echo $party['address1'];?>
                          </span><br>
                           <span class="float-right text-muted">
                            <?php echo $party['address2'];?>
                          </span>
                        </p>

                        <p class="clearfix">
                          <span class="float-left">
                            City
                          </span>
                          <span class="float-right text-muted">
                            <?php echo $party['city'];?>
                          </span>
                        </p>

                        <p class="clearfix">
                          <span class="float-left">
                            Postal Code
                          </span>
                          <span class="float-right text-muted">
                            <?php echo $party['postcode'];?>
                          </span>
                        </p>

                        <p class="clearfix">
                          <span class="float-left">
                            State
                          </span>
                          <span class="float-right text-muted">
                            <?php echo $party['state'];?>
                          </span>
                        </p>

                        <p class="clearfix">
                          <span class="float-left">
                            Country
                          </span>
                          <span class="float-right text-muted">
                            <?php echo $party['country'];?>
                          </span>
                        </p>



                        <p class="clearfix">
                          <span class="float-left">
                            Secondary Phone:
                          </span>
                          <span class="float-right text-muted">
                            <a href="tel:<?php echo $party['mobile2'];?>"><?php echo $party['mobile2'];?></a>
                          </span>
                        </p><br>

                          <p class="clearfix">
                          <span class="float-left">
                           Username
                          </span>
                          <span class="float-right text-muted">
                            <?php echo $party['user_name'];?>
                          </span>
                        </p>

                        <p class="clearfix">
                          <span class="float-left">
                            Password
                          </span>
                          <span class="float-right text-muted">
                            <?php echo $party['password'];?>
                          </span>
                        </p>

                        <p class="clearfix">
                          <span class="float-left">
                            Registered on
                          </span>
                          <span class="float-right text-muted">
                            <?php echo $party['created_at'];?>
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
</div>
</div>

