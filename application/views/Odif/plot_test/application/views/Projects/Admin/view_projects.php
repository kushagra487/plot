<!-- page content -->
<div class="right_col" role="main">
	<div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Project List</h2>
						
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable-responsive" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>S. No.</th>
									<th>Project Name</th>
									<th>Image</th>
									<th>WBS</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$i = 1;
									foreach($details as $key => $value){
										$img = base_url().'project_uploads/'.$value['project_logo'];
										?>
										<tr>
											<td><?php echo $i;?></td>
											<td><a href="<?= base_url();?>add_project/add_project_users/<?php echo $value['project_id']; ?>/"><?php echo $value['project_name'];?></a></td>
											<td><?php echo '<img src="'.$img.'" style="width:50px; " >'; ?></td>
											<td>
												
												<a href="<?= base_url();?>add_project/edit_projects/<?php echo $value['project_id']; ?>/" title="edit">Edit</a>
												<a onClick="alert('Do you want to delete this user?');"  href="<?= base_url();?>add_project/delete_projects/<?php echo $value['project_id']; ?>/" title="delete">Delete</a>
											</td>
										</tr>
										<?php
										$i++;
									}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /page content -->