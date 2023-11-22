<?php //echo "<pre>"; print_R($pm_list); die(); ?>
<script>
function add123()
	{
		var data = $("input[name=sendpid]:checked").val();
		var url = "<?php echo base_url('add_project/add_project123'); ?>";
		
		window.location.href = url+'/'+data;	
	}
</script>
<div id="preloader">
	<div id="status">&nbsp;</div>
</div>
<div class="right_col" role="main">
	<section>
		<h2 class="page_title">My project</h2>
        <div class="text-right">
         <div class="existing-table-buttons text-left pull-left">
         <div class="btn-group" role="group">
                   <button class="btn btn-default"  type="submit" name="edit" onclick="add123();"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <span>Edit</span></button>
                  <!-- <button class="btn btn-default"  type="submit" name="view"><i class="fa fa-eye" aria-hidden="true"></i> <span>View</span></button>-->
                   <form name="project_delete" method="post" class="">
                   <button class="btn btn-default"  onClick="return doconfirm();" type="submit" name="delete"><i class="fa fa-trash-o" aria-hidden="true"></i> <span>Delete</span></button>
                   <input type="hidden" name="project_deleteid" id="project_deleteid">
                   </form>
                 </div>
                    
        <!-- <a data-toggle="modal" data-target="#myModal<?php echo $i; ?>" href="#" class="edit-existing"><img src="<?= base_url();?>images/add.jpg"/></a>          
                    
                    <a href="<?= base_url(); ?>add_project/edit_project_users/<?php echo $value['project_id']; ?>/" class="edit-existing"><img src="<?= base_url();?>images/edit.jpg"/></a>
                    
                    <a href="<?= base_url();?>add_project/view_assigned_users/<?php echo $value['project_id']; ?>/" class="view-existing"><img src="<?= base_url();?>images/view.jpg"/></a>
                    
				<a onClick="return doconfirm();" href="<?= base_url();?>add_project/delete_projects/<?php echo $value['project_id']; ?>/" class="delete-existing"><img src="<?= base_url();?>images/delete.jpg"/></a>-->
                
                </div>  
        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#create_project">Create Project</button>
        </div>
        <p class="clearfix"></p>
		<div class="existing-project"> 
		           
			<div class="existing">
			
<!--
				<h1>Existing Project</h1>
				<?php echo $message1; ?>
-->

            	<?php echo $message; ?>
                <?php echo $this->session->flashdata('message');?>
				<div id="no-more-tables" class="table_content">
                  <form method="post">
                  <div class="table-responsive">
					<table class="table table-bordered table-condensed cf">

						<thead class="cf text-uppercase">
							<tr>
                            	<th class="col-xs-1"></th>
								<th>Logo</th>
								<th>Project name</th>
                                <th>Time Range</th>
                                <th class="col-xs-1 text-center">Action</th>			
							</tr>
						</thead>

						<tbody class="">
                        
						<?php
							$i = 1;
							if($project_details){
								foreach($project_details as $key => $value){
									$img = base_url().'project_uploads/'.$value['project_logo'];
									?>
									<tr>
									<td><input type="radio" value="<?php echo $value['project_id']; ?>" name="sendpid" required="required"/></td>
										<td><?php echo '<img src="'.$img.'" style="width:50px; " >'; ?></td>
										<td><?php echo $value['project_name']; ?></td>
                                        <td><?php echo $value['daterange']; ?></td>
                                        <td class="text-center"><a href="<?php echo base_url(); ?>wbs_list/index/<?php echo $value['project_id']; ?>/"><i class="fa fa-external-link" aria-hidden="true"></i></a></td>
		
									</tr>
                                  
									<?php
									$i++;
								}
							}else{
								?>
									<tr>
										<td colspan="5" style="color: red;">
											There is no Project.
										</td>
									</tr>
						<?php
							}
						?>
                        
						</tbody>
					</table>
                   </div>
                  
 </form>
					<?php
                    
					//if(isset($_POST['send']))
					//{
						//echo $rvalue = $_REQUEST['sendpid'];	
						//print_r($rvalue) or die();
						//header("Location: http://localhost/pboplus1/dashboard/?$rvalue");
					//}
					?>
				</div>
				<div class="verticalLine"></div>
				           				
			</div>
				  
		</div>
		
	</section>
</div>

<!-- Modal -->
<div id="create_project" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Create Project</h4>
      </div>
      <div class="modal-body">
        <div class="create-project">
			<div class="create">
				
				<form role="form" method="post" action="" enctype="multipart/form-data">
					<div class="form-group">
						<input type="text" name="project_name" class="form-control" placeholder="PROJECT NAME" title="project name" required="required"/>
					</div>
					<div class="form-group">
						<input id="uploadFile" placeholder="Choose File" disabled="disabled" />
						<div class="fileUpload">
							<span>Add Logo</span>
							<input id="uploadBtn" type="file" name="image" class="upload btn btn-primary" />
						</div>
					</div>
					<div class="form-group bottom">
						<input type="submit" id="send" class="btn-sm" name="send" value="Go"/>
					</div>
				</form>
				<div class="verticalLine"></div>
			</div>
		</div>
      </div>
    </div>

  </div>
</div>  
                   
                    
<?php
	$i = 1;
	foreach($project_details as $key => $value){
		$img = base_url().'project_uploads/'.$value['project_logo'];
		?>
		<div id="myModal<?php echo $i; ?>" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Add Users to Project</h4>
					</div>
					<form method="post" action="" name="form1<?php echo $i; ?>" id="form1<?php echo $i; ?>" enctype="multipart/form-data">
						<div class="modal-body">
							<input type="hidden" name="hidden_id" value="<?php echo $value['project_id']; ?>"/>
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
				</div>
			</div>
		</div>
		<?php
		$i++;
	} 
?>
<script>
	function doconfirm() {
		job=confirm("Are you sure to delete this project?");
		if(job!=true) {
			return false;
		}else {
			data = $("input[name=sendpid]:checked").val();
			document.getElementById("project_deleteid").value=data;
			return true;
			
		}
	}
</script>