<?php 
//print_r($this->session->userdata['user_id']);
$role = $this->session->userdata['role']; ?>

<div id="preloader">
	<div id="status">&nbsp;</div>
</div>
<div class="right_col" role="main">
	<section>
		<h3 class="title text-uppercase">My project</h3>
          <?php if($role=="Project Manager" || $role=="Admin"){?>
        <div class="curve_btn red_btn text-right">
        <a href="<?php echo base_url()?>add_project/add_new_project">Add New</a>
        </div>
        <?php } ?>
        <p class="clearfix"></p><br>
        <?php echo $message; ?>
        <?php echo $this->session->flashdata('message');?>
        <div class="add_pro_list">
        <div class="row">
        <?php
							$i = 1;
							if($project_details){
								foreach($project_details as $key => $value){
									
									//print_r($value);
									$img = base_url().'project_uploads/'.$value['project_logo'];
									?>
        		<div class="col-sm-6 col-md-6 col-lg-3">
                	<div class="proj_desc">
                        <div class="row">
                        <figure>
                        <div class="col-sm-5 col-xs-6">
                                 <div class="img">      
                        <?php echo '<img src="'.$img.'" class="img-responsive">'; ?>
                        </div>
                        </div>
                        <div class="col-sm-7 col-xs-6">
                        <figcaption>
                        <span class="title">Project</span>
                        <span class="title_name"><?php echo $value['project_name']; ?></span>
                        </figcaption>
                        </div>
                        </figure>
                        
                        <div class="col-sm-4 col-xs-4">
                        <div class="owner_name">
                        <span class="title">Owner</span>
                        <span class="title_name"><?php 
						
						if(strlen($value['name']) >8 ) 
						echo substr($value['name'],0,8)."."; 
						else echo $value['name']; 
						
						?>
						
						</span>
                        </div>
                        </div>
                        <div class="col-sm-8 col-xs-8">
                        <span class="pull-left direct_main_link">
                        <a href="<?php echo base_url(); ?>wbs_list/index/<?php echo $value['project_id']; ?>/" data-toggle="tooltip" title="WBS"><img src="<?php echo  base_url();?>images/wbs_icon.png" alt=""/></a>
                        <a href="<?php echo base_url(); ?>odif/index/<?php echo $value['project_id']; ?>/" class="action_odif" data-toggle="tooltip" title="Job Card"><img src="<?php echo  base_url();?>images/wbs_icon_old.png" alt=""/></a>
						<a href="<?php echo base_url(); ?>odif/odiffilter/<?php echo $value['project_id']; ?>/"" style="margin-left:7px;" class="action_odif" data-toggle="tooltip" title="ODIF"><img src="<?php echo  base_url();?>images/odif_icon.png" alt=""/></a>
                        </span>
                         <?php if($this->session->userdata['user_id']==$value['powner'] || $role=="Admin" || $role=="Editor"){?>
                        <span class="pull-right">
                        
                        <a href="<?php echo base_url(); ?>add_project/add_project123/<?php echo $value['project_id']; ?>" class="action " title="Edit">
                        <i class="fa fa-edit" aria-hidden="true"></i>
                        </a>
                        <a href="<?php echo base_url(); ?>add_project/delete_projects/<?php echo $value['project_id']; ?>" class="action actiondel" id="simpleConfirm" title="Delete">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                        </a>
                        </span>
                        <?php } ?>
                        </div>
                        <div class="col-xs-12">
                        <p class="clearfix"></p>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="start_date">
                            <span class="title">Start Date</span>
                            <span class="title_name"><?php if($value['start_date']!='0000-00-00') echo $value['start_date']?></span>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="end_date">
                            <span class="title">Finish Date</span>
                            <span class="title_name"><?php if($value['end_date']!='0000-00-00') echo $value['end_date']?></span>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-8 col-xs-8">
                        <div class="odif_time">
                        <span class="title" <?php if($value['is_wbs_submitted']==0) { ?> style="color:#1d9f75 !important;font-weight:bold;" <?php }?>>ODIF Time</span>
                        <span class="title_name"><?php if($value['is_wbs_submitted']==1) { echo $value['daterange'];} else { echo "WBS is not submitted."; } ?></span>
                        </div>
                        </div>
                        
                        </div>
                        
                    
                    </div>
                </div>
                  	<?php } } ?>
        
        </div>
        </div>
        
        
        
        
        
        
      <!--  <div class="text-right">
         <div class="existing-table-buttons text-left pull-left">
         
         <div class="btn-group" role="group">
                   <button class="btn btn-default"  type="submit" name="edit" onclick="add123();"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <span>Edit</span></button>
                               
                   <form name="project_delete" method="post" class="">
                   <button class="btn btn-default"  onClick="return doconfirm();" type="submit" name="delete"><i class="fa fa-trash-o" aria-hidden="true"></i> <span>Delete</span></button>
                   <input type="hidden" name="project_deleteid" id="project_deleteid">
                   </form>
                 
                 </div>
              
     
                
                </div>  
             
        <button type="button" class="btn btn-success btn-sm">Create Project</button>
     
        </div>-->
      
		<!--
                        
					
                        
						</tbody>
					</table>
                   </div>
                  
 </form>
					
				</div>
				<div class="verticalLine"></div>
				           				
			</div>
				  
		</div>-->
		
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
      <p class="clearfix"></p>
      <div class="modal-body">
        <div class="create-project">
			<div class="create">
				
				<form role="form" method="post" action="" enctype="multipart/form-data">
					<div class="form-group">
						<input type="text" name="project_name" class="form-control" placeholder="Project Name" title="project name" required="required"/>
					</div>
					<div class="form-group">
						<input id="uploadFile" placeholder="Choose File" disabled="disabled" />
						<div class="fileUpload">
							<span>Add Logo</span>
							<input id="uploadBtn" type="file" name="image" class="upload btn btn-primary" />
						</div>
					</div>
					<div class="form-group bottom">
                    <div class="curve_btn green_btn text-center">
                    <button type="submit" id="send" name="send">Save</button>
                    </div>
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