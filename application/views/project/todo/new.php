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
                            <a class="nav-link" href="single-project.html">
                              <i class="ti-home"></i>
                              Project Home
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link active" href="project-todo.html">
                              <i class="ti-pin2"></i>
                              Todo
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="discussions.html">
                              <i class="ti-comment-alt"></i>
                              Discussion
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="meterial.html">
                              <i class="ti-package"></i>
                              Meterial
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
             <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="display-2">Add new Todo List</h4>
                  <p class="card-description">
                    Enter the Todo list details.
                  </p>
                  <?php echo form_open("project/new_todo/".$project['id']) ?>
                    <div class="form-group">
                      <label for="skill">Todo List Name</label>
                      <input type="text" class="form-control" name="name" placeholder="Todo List Name">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Save</button>
                    <span class="btn btn-light clear-input">Cancel</span>
                  <?php echo form_close() ?>
                </div>
              </div>
            </div>
          </div> 







          <div class="row">
            <div class="col-lg-12">

            

           <div class="card">
            <div class="card-body">
              <h4 class="display-4">Todo Lists</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th>#</th>
                            <th>Todo List Name</th>
                            <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $slno = 0;
                         foreach ($todo_list as $row) {
                          $slono =+ 1;
                          ?>
                        <tr>
                            <td><?php echo $slno;?></td>
                            <td><?php print_r($row['todo_name']);?></td>
                            <td>
                              <span class="btn btn-outline-danger" onclick="removeDeliveryChallan('<?php echo base_url("project/remove_todo/".$row['todo_id']);?>')">Remove</span>
                            </td>
                        </tr>
                      <?php } ?>
                       
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>


            </div>
          </div>
        








</div>
