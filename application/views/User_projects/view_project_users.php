<!-- page content -->

<div class="right_col" role="main">

	<div>

		<div class="clearfix"></div>

		<div class="row">

			<div class="col-md-12 col-sm-12 col-xs-12">

				<div class="x_panel">

					<div class="x_title">

						<h2 class="page_title">User's List</h2>

						<div class="clearfix"></div>

					</div>

					<div class="x_content">

						<table id="datatable-responsive" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

							<thead>

								<tr>

									<th>S. No.</th>

									<th>Team Member</th>

									<th>Action</th>

								</tr>

							</thead>

							<tbody>

								<?php

									$i = 1;
									foreach($tm_list as $key => $value){
										?>
										<tr>
											<td><?php echo $i;?></td>
											<td><?php echo $value['tm_list'];?></td>
											<td>
												<a onClick="return doconfirm();"  href="<?= base_url();?>add_project/delete_tm_projects/<?php echo $value['project_id']; ?>/<?php echo $value['id']; ?>/" title="delete">Delete</a>
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

			<div class="col-md-12 col-sm-12 col-xs-12">

				<div class="x_panel">

					<div class="x_content">

						<table id="datatable-responsive" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

							<thead>

								<tr>

									<th>S. No.</th>

									<th>Project Manager</th>

									<th>Action</th>

								</tr>

							</thead>

							<tbody>

								<?php

									$i = 1;

									foreach($pm_list as $key => $value){

										

										?>

										<tr>

											<td><?php echo $i;?></td>

											<td><?php echo $value['pm_list'];?></td>

											<td>

												<a onClick="return doconfirm();"  href="<?= base_url();?>add_project/delete_pm_projects/<?php echo $value['project_id']; ?>/<?php echo $value['id']; ?>/" title="delete">Delete</a>

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

<script>

	function doconfirm() {

		job=confirm("Are you sure to delete this user?");

		if(job!=true) {

			return false;

		}

	}

</script>