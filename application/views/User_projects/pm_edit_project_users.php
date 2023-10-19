<div class="right_col" role="main">
	<div class="">
		<div class="row">
			<div class="x_panel">
				<div class="project_image">
					<p><img class="img-responsive" src="<?= base_url();?>project_uploads/<?php echo $project_details['project_logo']; ?>" style="width: 10%;" alt=""/> <?php echo $project_details['project_name']; ?></p>
				</div>
				<div class="x_content">
					<form class="form-horizontal form-label-left" method="post" novalidate enctype="multipart/form-data" action="">
						<span class="section"><i class="fa fa-edit"></i> Edit info</span>
						<div class="item form-group">
							<div class="col-md-6 col-md-offset-2 col-md-6 col-sm-6 col-sm-offset-2 col-xs-12">       
								<input id="uploadFile" class="view_fileuploading" placeholder="Choose File" disabled="disabled" />
								<div class="fileUpload">
									<span>Add Logo</span>
									<input id="uploadBtn" type="file" name="image1" class="upload btn btn-primary" />
								</div>
							</div>
						</div>
						<div class="item logoedit">
							<div class="col-md-6 col-md-offset-2 col-md-6 col-sm-6 col-sm-offset-2 col-xs-12">
                                                           <div class="logoimage">
								<img src="<?= base_url();?>project_uploads/<?php echo $project_details['project_logo']; ?>" style="width:50px; " class="img-responsive">		</div>
							</div>
						</div>
						<div class="item form-group">
							<div class="col-md-6 col-md-offset-2 col-md-6 col-sm-6 col-sm-offset-2 col-xs-12">             
								<input type="text" class="form-control" name="project_name1" value="<?php echo $project_details['project_name']; ?>"/>
							</div>
						</div>
						<div class="item form-group select-member">
							<div class="col-md-6 col-md-offset-2 col-md-6 col-sm-6 col-sm-offset-2 col-xs-12">
								<select class="select2_multiple form-control" name="tm_list[]" multiple="multiple">
									<?php
										foreach($tm_details as $key => $tm_details_value){
											if($tm_list){
												foreach($tm_list as $key => $tm_value){
													if($tm_details_value['user_id'] == $tm_value['tm_list']){
														?>
															<option value="<?php echo $tm_value['tm_list'];?>" selected><?php echo $tm_value['tm_list'];?></option>
														<?php
													}else{
														?>
															<option value="<?php echo $tm_details_value['user_id'];?>"><?php echo $tm_details_value['user_id'];?></option>
														<?php
													}
												}
											}else{
												?>
													<option value="<?php echo $tm_details_value['user_id'];?>"><?php echo $tm_details_value['user_id'];?></option>
												<?php
											}
										}
									?>
								</select>
							</div>
						</div>
						<div class="ln_solid"></div>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-2">
								<!--<button type="submit" class="btn btn-primary">Cancel</button>-->
								<button id="send" name="send" type="submit" class="btn btn-success">Submit</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>