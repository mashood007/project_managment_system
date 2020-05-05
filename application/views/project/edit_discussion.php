          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">

                    <div class="col-lg-8">
                      <div class="d-flex justify-content-between">
                        <div>
                         
                          
                          
                        </div>
                      </div>




                      <div class="profile-feed">
                        <div>
                           <div class="py-4">

             

                      </div>
                        </div>
                       
                      </div>
                    </div>
                  </div>    



      <?php echo form_open_multipart("project/update_discussion/".$discussion['id'], array('id' => 'discussion_form')) ?>
          <div class="row grid-margin form-group">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="display-4"><i class="ti-comment-alt"></i> Compose</h4>
                  <div id="summernoteExample">
                    <?php print_r($discussion['discussion']); ?>
                  </div><br>

                  <span class="file-upload-browse btn btn-secondary"><i class="ti-clip"></i> Attach</span>
                   <input type="file" multiple="" name="attachments[]" class="file-upload-default">
                     <button onclick="submitDiscussion();" class="btn btn-success mr-2"><i class="mdi mdi-send"></i> Update</button>
                    <a href="<?php echo base_url('project/discussions/'.$discussion['project_id']);?>" class="btn btn-light">Cancel</a>
                </div>
              </div>
            </div>
          </div>
      <?php echo form_close() ?>

       





       
      </div>
    </div>
  </div></div></div>

  

