
<?php

$sql="SELECT user_id FROM login WHERE role IN ('Team Member', 'Project Manager')";
$query = $this->db->query($sql);
$pm_tm_data=$query->result();

?>
<!-- /page content -->
<div class="right_col" role="main">
<h3 class="title text-uppercase">Add Users</h3>
	<div class="">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					
						<form class="form-horizontal form-label-left" novalidate method="post" enctype="multipart/form-data">
						
							<?php echo $message; ?>
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="user_id">User ID <span class="required" style="color:red !important;">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="email" id="user_id" name="user_id" required="required" class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required" style="color:red !important;">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="name" required="required" type="text">
								</div>
							</div>
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="designation">Designation <span class="required" style="color:red !important;">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input id="designation" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="1" name="designation" required="required" type="text">
								</div>
							</div>
							<div class="item form-group">
								<label for="password" class="control-label col-md-3 col-sm-3 col-xs-12">Password <span class="required" style="color:red !important;">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input id="password" type="password" name="password"  class="form-control col-md-7 col-xs-12" required="required">
								</div>
							</div>
							<div class="item form-group">
								<label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Repeat Password <span class="required" style="color:red !important;">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input id="password2" type="password" name="password2" data-validate-linked="password" class="form-control col-md-7 col-xs-12" required="required">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">User's Role <span class="required" style="color:red !important;">*</span> </label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<select class="select2_multiple form-control" name="user_role">
										<option value="Team Member">Team Member</option>
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
										<option value="<?php echo $pm_value->user_id;?>"><?php echo $pm_value->user_id;?></option>
										<?php
									}
									?>
								</select>
								</div>
							</div>

							<!-- assign reporting manager code end -->
							<div class="item form-group">
								<label for="image" class="control-label col-md-3 col-sm-3 col-xs-12">Image <span class="required" style="color:red !important;">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input id="image" type="file" name="image" class="form-control col-md-7 col-xs-12" required="required">
								</div>
							</div>
							<div class="ln_solid"></div>
							<div class="form-group">
								<div class="col-md-6 col-md-offset-3">
									<div class="curve_btn red_btn" style="display: inline-block;">
                                    <button type="button" onClick="window.location='<?php echo base_url()?>add_users/view_users/'">Cancel</button>
                                    </div>
                                    <div class="curve_btn green_btn" style="    display: inline-block;
    margin-left: 10px;">
									<button id="send" name="send" type="submit">Submit</button></div>
								</div>
							</div>
						</form>
					
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /page content -->