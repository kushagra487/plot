<?php //echo "<pre>"; print_R($pm_list); die(); ?>
<div class="right_col" role="main">
	<section>
		<div class="existing-project"> 
			<div class="existing">
				<p>Existing Project</p>
				<?php echo $message1; ?>
				<div id="no-more-tables">
					<table class="col-md-12 table-bordered table-condensed cf">
						<thead class="cf">
							<tr>
								<th>Logo</th>
								<th>project name</th>					
							</tr>
						</thead>
						<tbody>
						<?php
							$i = 1;
							if($admin_editor_assigned_project_details){
								foreach($admin_editor_assigned_project_details as $key => $value2){
									$img = base_url().'project_uploads/'.$value2['project_logo'];
									?>
									<tr>
										<td><a href="<?= base_url(); ?>wbs_list/index/<?php echo $value2['project_id']; ?>/"><?php echo '<img src="'.$img.'" style="width:50px; " >'; ?></a></td>
										<td><?php echo $value2['project_name']; ?></td>
									</tr>
									<?php
									$i++;
								}
							}else{
								?>
									<tr>
										<td colspan="3" style="color: red;">
											There is no Project.
										</td>
									</tr>
								<?php
							}
						?>
						</tbody>
					</table>
				</div>
				<div class="verticalLine"></div>
			</div>	  
		</div>  
	</section>
</div>
<script>
	function doconfirm() {
		job=confirm("Are you sure to delete this user?");
		if(job!=true) {
			return false;
		}
	}
</script>