<!-- /page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_content">
						<form class="form-horizontal form-label-left" novalidate method="post" enctype="multipart/form-data">
							<span class="section"><i class="fa fa-dashboard"></i> Dashboard > Edit Projects</span>
							<?php echo $message; ?>
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Project Name <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input id="project_name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="" name="project_name" required="required" type="text" value="<?php echo $project_detail['project_name']; ?>">
								</div>
							</div>
							<div class="item form-group">
								<label for="image" class="control-label col-md-3 col-sm-3 col-xs-12">Image <span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input id="image" type="file" name="image" class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							<div class="item form-group">
								<label for="image" class="control-label col-md-3 col-sm-3 col-xs-12">Image </label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<?php $img = base_url().'project_uploads/'.$project_detail['project_logo'];?>
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
</div>
<!-- /page content -->