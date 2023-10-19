<form method="post" action="" name="" enctype="multipart/form-data">
						<div class="modal-body">
							<input type="hidden" name="hidden_id" value="<?php echo $project_id; ?>"/>
							<input id="uploadFile1" placeholder="Choose File" disabled="disabled" />
							<div class="fileUpload1">
								<span>Add Logo</span>
								<input id="uploadBtn1" type="file" name="image1" class="upload btn btn-primary" />
							</div>
							<div class="logoimage">
								<?php echo '<img src="'.$img.'" style="width:50px; " class="img-responsive">'; ?>
							</div>
							<input type="text" class="form-control" name="project_name1" value="<?php echo $value['project_name']; ?>"/>
							<select class="select2_multiple form-control" name="pm_list[]" multiple="multiple">
								<?php
									foreach($pm_details as $key => $pm_value){
										?>
										<option value="<?php echo $pm_value['user_id'];?>"><?php echo $pm_value['user_id'];?></option>
										<?php
									}
								?>
							</select>
							<select class="select2_multiple form-control" name="tm_list[]" multiple="multiple">
								<?php
									foreach($tm_details as $key => $tm_value){
										?>
										<option value="<?php echo $tm_value['user_id'];?>"><?php echo $tm_value['user_id'];?></option>
										<?php
									}
								?>
							</select>
						</div>
						<div class="modal-footer">
							<button type="submit" name="update_users" class="edit-existing">Submit</button>
							<button type="button" class="delete-existing" data-dismiss="modal">Close</button>
						</div>
					</form>