<h2 class="page_title">Edit Project <span class="pull-right">Project Created Date:  <?php echo $project_details['created_date']; ?></span></h2>
<form method="post" action="" name="" enctype="multipart/form-data">
    <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 user_edit_page">
		<input type="hidden" name="hidden_id" value="<?php echo $project_id; ?>"/>
		
		<div class="container-fluid">
               <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
            <label class="ft-16">Project Name</label>
            <input type="text" class="form-control" name="project_name1"  value="<?php echo $project_details['project_name']; ?>"  required/>
            </div>
            
           
            </div>
 <div class="col-sm-6">  <div class="logoimage text-center">
             <div class="mtn_logo_ico">
             <i class="fa fa-upload" aria-hidden="true"></i>
                <?php
                    $img = base_url().'project_uploads/'.$project_details['project_logo'];
                ?>
                <?php echo '<img id="uploadPreview" src="'.$img.'" style="width:120px; " class="img-responsive center-block">'; ?>
                 </div>                <div class="fileUpload1">
            <label style="cursor:pointer;">
          
            <input id="uploadBtn1" onChange="PreviewImage()" type="file" name="image1" class="upload btn btn-primary"/></label>
            </div>
            </div></div>
            </div>
            <p class="clearfix"></p>
        <div class="row">
        
            <div class="col-sm-6">
            <div class="form-group">
            <label>Client Email IDs</label>
            <input type="text" class="form-control" name="client_email" value="<?php echo $project_details['client_emails']; ?>" placeholder="Client Email IDs seperated by comma"/>
            </div>
            </div>
            
            <div class="col-sm-6">
            <div class="form-group">
            <label>ODIF Time</label>
            <!--<input class="form-control" type="text" name="daterange" value="<?php echo $project_details['daterange']; ?>" placeholder="choose Time range" />-->
            <div class="input-group date" id="timestart">
                    <input type="text" class="form-control" name="daterange" value="<?php echo $project_details['daterange']; ?>">
                    <span class="input-group-addon">
                         <i class="fa fa-clock-o" aria-hidden="true"></i>
                    </span>
                </div>
            </div>
            </div>
            
            <div class="col-sm-6">
            <div class="form-group">
            <label>Start Date</label>
           
          
                    <input type="text" class="form-control" id="start_date" name="start_date" value="<?php echo $project_details['start_date']; ?>">
                   
           
            </div>
            </div>
            
            <div class="col-sm-6">
            <div class="form-group">
            <label>Finish Date</label>
            
           
                    <input type="text"  class="form-control" id="end_date" name="end_date" value="<?php echo $project_details['end_date']; ?>">
                   
             
            </div>
            </div>
            
            
            
            <!--<div class="col-sm-6">
            <div class="form-group">
            <label>Undefine Names</label>
            <input type="text" class="form-control" name="undefined_names" value="<?php echo $project_details['undefined_names']; ?>" readonly placeholder="Undefine Names" />
            </div>
            </div>-->
            <div class="col-sm-6">
            <div class="form-group">
            <label>Project Manager</label>
            
            <select class="form-control" name="pm_list[]" required>
               <option value="">Select</option>
			<?php
				foreach($pm_details as $key => $pm_value){
					?>
					<option value="<?php echo $pm_value['user_id'];?>" <?php  if(array_search($pm_value['user_id'], array_column($pm_list, 'pm_list')) !== false) {
    echo 'selected';
} ?>><?php echo $pm_value['user_id'];?></option>
					<?php
				}
			?>
			</select>
            </div>
            </div>
            
            <?php //print_r($tm_list);?>
            <div class="col-sm-6">
            <div class="form-group">
            <label>Team Member</label>
            <?php $combine=array_merge($pm_details,$tm_details);
			//$combine=uasort($combine);
			$combine_array=$this->projects_model->array_qsort2($combine,'user_id', "ASC");
			//print_r($combine);
			
			?>
            <select class="form-control" name="tm_list[]" id="tmlist" multiple required>
             
			<?php
				foreach($combine as $key => $tm_value){
					?>
					<option value="<?php echo $tm_value['user_id'];?>" <?php  if(array_search($tm_value['user_id'], array_column($tm_list, 'tm_list')) !== false) {
    echo 'selected';
}//if(in_multiarray($tm_value['user_id'],$tm_list,'tm_list')) echo "selected";?>><?php echo $tm_value['user_id'];?></option>
					<?php
				}
			?>
            
         
            
		</select>
            </div>
            </div>
            <div class="clearfix"></div>
              <div class="col-sm-6">
            <div class="form-group">
            <label>Project Status</label>
            <select class="form-control" name="project_status" id="project_status">
            <option value="0" <?php if($project_details['status']=='0') echo "selected";?>>In Process</option>    
            <option value="1" <?php if($project_details['status']=='1') echo "selected";?>>Complete</option>            
            </select>
            </div>
            </div>
            
                   
        </div>
        </div>
        
 	
	<div class="text-center">
		<button type="submit" name="update_users" class="edit-existing" onClick="return validate_date()">Submit</button>
		<button type="button" class="delete-existing" data-dismiss="modal" onClick="window.location='<?php echo base_url()?>/add_project'">Close</button>
	</div>
    </div>
</form>