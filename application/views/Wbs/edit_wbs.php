<?php
//print_r($project_details);
ini_set("memory_limit","1000M");
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<div class="right_col" role="main">
<h3 class="title text-uppercase"> <?php echo $project_details['project_name']; ?> <img src="<?php echo base_url()?>project_uploads/<?php echo $project_details['project_logo']?>" style="width:50px;height:50px;"> </h3>
		    			<div class="col-md-12 col-sm-12 col-xs-12">
				
		</div>
        <p class="clearfix"></p>
        <div class="wbs_filter_form">
        <form method="post" action="" class="date_filter_form">
          
           <div class="col-md-2 col-sm-6 col-xs-12">
       
        <div class="form-group">
       
        <select class="form-control customwidth" name="search_mp">
       	<option value="">Select Mega Process</option>
        <?php foreach($all_mp as $all_mp) {?>
        <option value="<?php echo $all_mp['mp_id']?>" <?php if($_POST['search_mp']==$all_mp['mp_id']) echo "selected";?>><?php echo $all_mp['mp_name']?></option>
        <?php }?>
        </select>
        </div>
      
        </div>
        
        <div class="col-md-2 col-sm-6 col-xs-12">
       
        <div class="form-group">
      
         <select class="form-control customwidth" name="search_process">
       	<option value="">Select Process</option>
        <?php foreach($all_process as $all_process) {?>
        <option value="<?php echo $all_process['pid']?>" <?php if($_POST['search_process']==$all_process['pid']) echo "selected";?>><?php echo $all_process['process_name']?></option>
        <?php }?>
        </select>
        </div>
      
        </div>
         <div class="col-md-2 col-sm-6 col-xs-12">
       
        <div class="form-group">
       
           <input type="text" class="form-control customwidth" id="start_date_activity" name="start_date_activity" value="<?php echo $_POST['start_date_activity']?$_POST['start_date_activity']:date("d/m/Y",strtotime($project_details['start_date'])); ?>" placeholder="Start Date">
        </div>
      
        </div>
        
        <div class="col-md-2 col-sm-6 col-xs-12">
       
        <div class="form-group">
       
              <input type="text"  class="form-control customwidth" id="end_date_activity" name="end_date_activity" value="<?php echo $_POST['end_date_activity']?$_POST['end_date_activity']:date("d/m/Y",strtotime($project_details['end_date'])); ?>"  placeholder="Finish Date">
        </div>
      
        </div>
        
         <div class="col-md-2 col-lg-3 col-sm-6 col-xs-12">
        <div class="form-group">
        <select name="responsilbe_person"  class="form-control">
        <option value="">Select Assigned Person</option>
        <?php foreach($responsible_person as $responsible_person) {
		if($responsible_person['assigned_person']!='') {	
		?>
        <option value="<?php echo $responsible_person['assigned_person']?>" <?php if($_POST['responsilbe_person']==$responsible_person['assigned_person']) echo "selected";?>><?php echo $responsible_person['assigned_person']?></option>
        <?php }}?>
        </select>
        </div>
        </div>
        
        <div class="col-md-2 col-lg-1 col-sm-6 col-xs-12">
		<div class="form-group">
        
        <div class="curve_btn green_btn">
			<button type="submit" id="pfilter" style="margin:0;">Filter</button>
        </div>
		</div>
        </div>
        
              
        </form>
        </div>
        
        
		<div class="row">
                       <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_contents">
                    <form name="wbs_form" id="wbsform" method="post" action="" enctype="multipart/form-data">
                    <input type="hidden" name="project_id" value="<?php echo $project_details['project_id']; ?>" />
                    <input type="hidden" name="status" value="Active" />
                     <div class="overflow_horizon" style="">
           <div class="clone_to">
           
           </div>
                         
                    <div class="clone_from  card-box">
<table width="100%" cellspacing="0" class="table2 table-bordered nowrap" id="datatable-keytable_wrapper">
            
		<thead>
        <tr>
        <th class="cell12">Unique Code</th>
        <th class="cell12"><textarea rows="1" cols="10"  name="cell[]">Mega Process</textarea></th>
        <?php
      $sql_depth="SELECT process_columns, activity_columns FROM project_name  WHERE project_id='".$this->uri->segment('3')."'"; 	
	$res_depth= $this->db->query($sql_depth);
	$result_depth=$res_depth->row();
	$result_depth_process=$result_depth->process_columns;
	$result_depth_activity=$result_depth->activity_columns;
	//print_r($result_depth_activity);
		for($i=0;$i<$result_depth_process;$i++){
		?>
        
		<th class="cell13"><textarea rows="1" cols="10" name="cell[]">Process</textarea>
    <!-- <div class="mtn_togg"><span class="toggle_insert"><i class="fa fa-angle-right"></i></span>
                                    <span class="hover_toggle"><small class="insert_col">Insert</small><small class="delete_col">Delete</small></span></div> -->
                                  </th>
        <?php } for($i=0;$i<$result_depth_activity;$i++){?>
        <th class="cell13"><textarea rows="1" cols="10"  name="cell[]">Activity</textarea>
        
        </th>
        <?php } ?>
        <th class="cell13"><textarea rows="1" cols="10">UOM</textarea></th>
		<th class="cell13"><textarea rows="1" cols="10">Planned Quantity</textarea></th>
		<th class="cell13"><textarea rows="1" cols="10">Actual Quantity</textarea></th>
        <th class="cell13"><textarea rows="1" cols="10">Start Date & Time</textarea></th>
        <th class="cell13"><textarea rows="1" cols="10" style="width:138px !important;">Finish Date & Time</textarea></th>
        <th class="cell13"><textarea rows="1" cols="10">Assigned Person</textarea></th>
        <th class="cell13"><textarea rows="1" cols="10">Resources</textarea></th>
         <th><textarea name="col[]" cols="10" rows="1"> Dependency</textarea>
         <div class="mtn_togg"><span class="toggle_insert"><i class="fa fa-angle-right"></i></span>
                                    <span class="hover_toggle"><small class="insert_col">Insert</small><small class="delete_col">Delete</small></span></div>
                                  </th>
        <th class="cell13"><textarea rows="1" cols="10">Team Name</textarea>
        <div class="mtn_togg"><span class="toggle_insert"><i class="fa fa-angle-right"></i></span>
                                    <span class="hover_toggle"><small class="insert_col">Insert</small><small class="delete_col">Delete</small></span></div>
                                  </th>
        <th class="cell13"><textarea rows="1" cols="10">Template Document</textarea>     
        <div class="mtn_togg"><span class="toggle_insert"><i class="fa fa-angle-right"></i></span>
                                    <span class="hover_toggle"><small class="insert_col">Insert</small><small class="delete_col">Delete</small></span></div>
                                  </th>
        <th class="cell13"><textarea rows="1" cols="10">Status</textarea>
        <div class="mtn_togg"><span class="toggle_insert"><i class="fa fa-angle-right"></i></span>
                                    <span class="hover_toggle"><small class="insert_col">Insert</small><small class="delete_col">Delete</small></span></div>
      </th>
      	</tr>
         </thead>
         <tbody id="table">   
            <?php
			if($_POST['search_mp']!=''){
			$query_append="AND mp_id ='".$_POST['search_mp']."'";	
			}
			if($_POST['search_process']!=''){
			$query_append1="AND process_name LIKE '%".$_POST['search_process']."%'";		
			}
			$sql_mp="SELECT mp_id,mp_name,unique_code FROM mega_process WHERE project_id='".$this->uri->segment('3')."'  AND status=0 ".$query_append."";
			$res_mp=$this->db->query($sql_mp);
			
			//print_r($res_mp->result());

			$mp=0;
			foreach ($res_mp->result() as $result){
			$mp++;
			$sql_process="SELECT pid,process_name,unique_code FROM process WHERE mp_id='".$result->mp_id."' AND status=0 ".$query_append1."";
			$res_process=$this->db->query($sql_process);
	
			?>
 			<tr>
            <td><?php echo $result->unique_code?></td>
      		<td>
             <textarea class="mpr"><?php echo $result->mp_name?></textarea>
            <div class="mtn_togg icono"><span class="toggle_insert"><i class="fa fa-angle-right"></i></span>
                                    <span class="hover_toggle"><small class="insert_row">Insert</small><small class="delete_row">Delete</small></span></div>
            </td>
            
            <?php for($i=0;$i<$result_depth_process;$i++){?>
            
            <td><textarea class="pr"></textarea></td>
      		<?php } for($i=0;$i<$result_depth_activity;$i++){ ?>
            
            <td class="disableChild"><textarea class="activity_area"></textarea></td>
            <?php }?>
            <td> <input type="text"  name="uom[]"  ></td>
			<td> <input type="text"  name="planned_quantity[]"  ></td>
			<td> <input type="text"  name="actually_quantity[]" ></td>
            <td> <input type="text"  name="start_date[]" class="stdate" placeholder="dd/mm/YYYY"  ></td>
           <td>   <input type="text" name="end_date[]" class="endate" placeholder="dd/mm/YYYY"  ></td>
           <td><select class='form-control assign_person' tabindex='-1' name='responsibilities[]' readonly>
             <option value=''>Select </option>
              <?php
			  foreach($tm_details as $key => $value){
			if($row_activity['assigned_person']==$value['tm_list'])	{
				
			$selected="selected";	
			}
			else{
			$selected="";	
			}
			echo "<option value=".$value['tm_list']." ".$selected.">".$value['tm_list']."</option>";	 
			 }
			 
			  foreach($pm_details as $key => $value){
				  
				  if($row_activity['assigned_person']==$value['pm_list'])	{
				
			$selected="selected";	
			}
			else{
			$selected="";	
			}
				 
			echo "<option value=".$value['pm_list']." ".$selected.">".$value['pm_list']."</option>";	 
			 }
			 
			 ?>
              </select>
           </td>
           <td><input value="" name="resources[]" type="hidden"></td>
           <td><input value="" name="dependency[]" type="hidden"></td>
           <td><input value="" name="template_reference[]" type="hidden"></td>
            <td><input type='hidden' name='previous_document[]' value=''><input value="" name="template_document[]" type="file">
           </td>
           <td>
           <input type="text"  name='activity_status[]' readonly value="0">  
           <input type='hidden' name='activity_status_modified[]' value=''>
           <input type='hidden' name='comments[]' value=''>
            </td>
          
			</tr>
      
<?php
			echo $this->wbs_list_model->tree_process_edit(0,$result->mp_id,1,$this->uri->segment('3'));

		}
		
		
			?>
<tr><td colspan="25">&nbsp;</td></tr>
			</tbody>
			</table>
            </div>
            </div>
 				<input type="hidden" name="is_wbs_submitted" id="is_wbs_submitted">	
                  <input type="hidden" name="project_start_date" id="project_start_date" value="<?php echo date("d/m/Y",strtotime($project_details['start_date']))?>">
                    <input type="hidden" name="project_end_date" id="project_end_date" value="<?php echo date("d/m/Y",strtotime($project_details['end_date']))?>">
                  <?php  if($project_details['status']==0) { ?>
                     <button class="btn" value="Save"  type="submit" name="btn_save" style="background: #1d9f75!important;
    padding: 4px 8px;
    color: #fff;
    border: none;
    margin-top: 10px;">Save</button> 
                    <button class="btn" value="Submit" type="submit" name="btn_submit" id="confirmodif"  style="background: #1d9f75!important;
    padding: 4px 8px;
    color: #fff;
    border: none;
    margin-top: 10px;" >Submit</button> 
    
     <button class="btn" value="Submit" type="submit" name="btn_clear" id="clearwbs" style="background: #1d9f75!important;
    padding: 4px 8px;
    color: #fff;
    border: none;
    margin-top: 10px;" title="Clear WBS">Clear WBS</button> 
                  
		<?php } ?>				
                    </form>
                    </div>
                       </div> 
            

		</div>
