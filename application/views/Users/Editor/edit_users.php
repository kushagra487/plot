
<?php

$sql="SELECT user_id FROM login WHERE role IN ('Team Member', 'Project Manager')";
$query = $this->db->query($sql);
$pm_tm_data=$query->result();

$user_id=$this->uri->segment(3);
$sql2='select reporting_manager from login where id="'.$user_id.'"';
$query2 = $this->db->query($sql2);
$rm=$query2->result();
$user_rm=$rm['0']->reporting_manager;

?>
<!-- /page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					
						<form class="form-horizontal form-label-left" novalidate method="post" enctype="multipart/form-data" action="<?= base_url();?>add_users/edit_users/<?php echo $user_detail['id'];?>/">
							<span class="section">Edit Users</span>
							<!--<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="user_id">User ID <span class="required" style="color:red !important;">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input id="user_id" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="user_id" required="required" type="text">
								</div>
							</div>-->
							<?php echo $message; ?>
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="user_id">User ID <span class="required" style="color:red !important;">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="email" id="user_id" name="user_id" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $user_detail['user_id'];?>">
								</div>
							</div>
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required" style="color:red !important;">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="name" required="required" type="text"  value="<?php echo $user_detail['name'];?>">
								</div>
							</div>
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="designation">Designation <span class="required" style="color:red !important;">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input id="designation" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="1" name="designation" required="required" type="text"  value="<?php echo $user_detail['designation'];?>">
								</div>
							</div>
							<?php if($role=='Admin'||$role=='Editor'){ ?>
							<div class="item form-group">
								<label for="password" class="control-label col-md-3 col-sm-3 col-xs-12">Password <span class="required" style="color:red !important;">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input id="password" type="text" name="password"  class="form-control col-md-7 col-xs-12" required="required"  value="<?php echo $user_detail['password'];?>">
								</div>
							</div>
							<?php }else{ ?>
							<input id="password" type="hidden" name="password"  class="form-control col-md-7 col-xs-12" required="required"  value="<?php echo $user_detail['password'];?>">
							<?php } ?>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">User's Role <span class="required" style="color:red !important;">*</span> </label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<select class="select2_multiple form-control" name="user_role">
										<option <?php if($user_detail['role'] == 'Editor'){ echo 'selected'; }?> value="Editor">Editor</option>
										<option <?php if($user_detail['role'] == 'Project Manager'){ echo 'selected'; }?> value="Project Manager">Project Manager</option>
										<option <?php if($user_detail['role'] == 'Team Member'){ echo 'selected'; }?> value="Team Member">Team Member</option>
									</select>
								</div>
							</div>
							
							<!-- 20-nov code to assign reporting manager -->

							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Reporting Manager<span class="required" style="color:red !important;">*</span> </label>
								<div class="col-md-6 col-sm-6 col-xs-12">
								<select class="form-control" name="reporting_manager">
								<option value="">Select</option>
									<?php
									// Iterate through the array and generate options
									foreach ($pm_tm_data as $pm_value) {
										?>
										<option value="<?php echo $pm_value->user_id;?>" <?php echo ($user_rm == $pm_value->user_id) ? 'selected' : ''; ?>><?php echo $pm_value->user_id;?></option>
										<?php
									}
									?>
								</select>
								</div>
							</div>

							<!-- assign reporting manager code end -->
							<div class="item form-group">
								<label for="image" class="control-label col-md-3 col-sm-3 col-xs-12">Image </label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input id="image" type="file" name="image" class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							<div class="item form-group">
								<label for="image" class="control-label col-md-3 col-sm-3 col-xs-12">Image </label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<?php $img = base_url().'user_uploads/'.$user_detail['image'];?>
									<?php echo '<img src="'.$img.'" style="width:80px; " >'; ?>
								</div>
							</div>
							<div class="ln_solid"></div>
							<div class="form-group">
								<div class="col-md-6 col-md-offset-3">
									<button type="submit" class="btn btn-primary">Cancel</button>
									<button id="send" name="send" type="submit" class="btn btn-success">Submit</button>
								</div>
							</div>
						</form>
					
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /page content -->