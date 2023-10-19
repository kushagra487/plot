<script>
function test(pm_list)
{
	var data=0;
	$('input[name="pmchecked"]:checked').each(function() {

	   if(this.value==1)
	   {
		   data = 1;
	   }
	});
	var url = "<?php echo base_url('wbs_list/update_pm_permission');?>";
	$.post(url, {status:data, pm_list:pm_list}, function(){
		
	},'html');
}
</script>

<script>
function tmtest(tm_list)
{
	var tmdata=0;
	$('input[name="tmchecked"]:checked').each(function() {
	   if(this.value==1)
	   {
		   tmdata = 1;
	   }
	});
	var url = "<?php echo base_url('wbs_list/update_tm_permission');?>";
	$.post(url, {tmstatus:tmdata, tm_list:tm_list}, function(){
	},'html');
}
</script>
<div class="right_col" role="main">
		    			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
<!--
					<div class="project_image">
						<p><img class="img-responsive" src="<?= base_url();?>project_uploads/<?php echo $project_details['project_logo']; ?>" style="width: 10%;" alt=""/> <?php echo $project_details['project_name']; ?></p>
					</div>
-->
					<div class="x_title wbs-table">
					<div class="col-md-3 col-sm-3 col-xs-12">
					<div class="col-md-6 col-sm-4 col-xs-12">
					<img class="img-responsive" src="<?= base_url();?>project_uploads/<?php echo $project_details['project_logo']; ?>" style="width: 80px;"/>
                        </div>
                    <div class="col-md-3 col-sm-4 col-xs-12">
                      <h3 class="logo-name" style="color: #fff; font-size: 18px;"><?php echo $project_details['project_name']; ?></h2>
                        </div>
                    <!--<div class="col-md-3 col-sm-4 col-xs-12">      
                      <p class="logo-name">Members</p></div>-->
                    </div>
					
					
					
				</div>
			</div>
		</div>
		<div class="row">
					<!--<div class="col-md-2 col-sm-2 col-xs-12">
                       
                       <div class="project_info">
                       <p>Project info</p>
                         <div style="background-color:#FFF;"><?php echo $project_details['comment']; ?></div>
                         <br />
                        	
							<?php  foreach($getcomment as $key=>$value){?>
                             <div style="background-color:#FFF;">
                             <table><tr><td bgcolor="#CCCCCC"><?php echo $value['name']; ?>&nbsp;</td><td> &nbsp;<?php echo $value['comment']; ?></td></tr></table>
                             
							
                             </div>
                            <?php  } ?><br />
                                        
                       <form method="post">
                           <textarea name="usercomment" id="" col="15" row="6"></textarea>
                           <div class="project-button clearfix">                       
                           <input type="submit" name="ucomment" id="comment" value="Comment"/>
                            </div>
                        </form>
                        
                       
                      </div>                                                 
                    </div>-->
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_contents">
                    <form name="wbs_form" method="post" action="">
                    <input type="hidden" name="project_id" value="<?php echo $project_details['project_id']; ?>" />
                    <input type="hidden" name="status" value="Active" />
                     <div class="overflow_horizon" style="">
           <div class="clone_to">
           
           </div>
                         
                    <div class="clone_from  card-box">
<table width="100%" cellspacing="0" class="table2 table-bordered nowrap" id="datatable-keytable_wrapper">
            
		<thead>
        <tr>
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
        
		<th class="cell13"><textarea rows="1" cols="10" name="cell[]">Process</textarea><div class="mtn_togg"><span class="toggle_insert"><i class="fa fa-angle-right"></i></span>
                                    <span class="hover_toggle"><small class="insert_col">Insert</small><small class="delete_col">Delete</small></span></div></th>
        <?php } for($i=0;$i<$result_depth_activity;$i++){?>
        <th class="cell13"><textarea rows="1" cols="10"  name="cell[]">Activity</textarea>
        <div class="mtn_togg"><span class="toggle_insert"><i class="fa fa-angle-right"></i></span>
                                    <span class="hover_toggle"><small class="insert_col">Insert</small><small class="delete_col">Delete</small></span></div>
        </th>
        <?php } ?>
        <th class="cell13"><textarea rows="1" cols="10">Start Date</textarea></th>
        <th class="cell13"><textarea rows="1" cols="10">End Date</textarea></th>
        <th class="cell13"><textarea rows="1" cols="10">Assigned Person</textarea></th>
        <th class="cell13"><textarea rows="1" cols="10">Resources</textarea></th>
         <th><textarea name="col[]" cols="10" rows="1"> Dependency</textarea></th>
        <th class="cell13"><textarea rows="1" cols="10">Template Reference</textarea></th>
        <th class="cell13"><textarea rows="1" cols="10">Status</textarea></th>
		</tr>
         </thead>
         <tbody>   
            <?php
			
			$sql_mp="SELECT * FROM mega_process WHERE project_id='".$this->uri->segment('3')."'  AND status=0";
			$res_mp=$this->db->query($sql_mp);
			
			//print_r($res_mp->result());

			$mp=0;
			foreach ($res_mp->result() as $result){
			$mp++;
			$sql_process="SELECT * FROM process WHERE mp_id='".$result->mp_id."' AND status=0";
			$res_process=$this->db->query($sql_process);
	
			?>
 			<tr>
      		<td>
            <!--<input type='textbox'  name='mega_process[<?php echo $result->mp_id?>]'  value='<?php echo $result->mp_name?>'>-->
            
            <textarea><?php echo $result->mp_name?></textarea>
            <div class="mtn_togg icono"><span class="toggle_insert"><i class="fa fa-angle-right"></i></span>
                                    <span class="hover_toggle"><small class="insert_row">Insert</small><small class="delete_row">Delete</small></span></div>
            </td>
            
            <?php for($i=0;$i<$result_depth_process;$i++){?>
            
            <td><textarea></textarea></td>
      		<?php } for($i=0;$i<$result_depth_activity;$i++){ ?>
            
            <td><textarea></textarea></td>
            <?php }?>
            <td><div class='controls datesel'>
                                <input value='' class='form-control single_cal1 dateselect' placeholder='' aria-describedby='inputSuccess2Status' type='text'>
                                <span id='inputSuccess2Status' class='sr-only'>(success)</span>
								<span class='magic'></span>
							<input value='' name='start_date[]' type='hidden'>
                            </div></td>
           <td><div class='controls datesel'>
                                <input value='' class='form-control single_cal1 dateselect' placeholder='' aria-describedby='inputSuccess2Status' type='text'>
                                <span id='inputSuccess2Status' class='sr-only'>(success)</span>
								<span class='magic'></span>
							<input value='' name='end_date[]' type='hidden'>
                            </div></td>
           <td><select class='form-control' tabindex='-1' name='responsibilities[]'>
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
           <td><select class='form-control' tabindex='-1' name='activity_status[]'>
             <option value=''>Select </option>
             <?php
			 if($row_activity['activity_status']==1)	{
				
			$selected1="selected";	
			}
			else{
			$selected1="";	
			}
			
			if($row_activity['activity_status']==0)	{
				
			$selected2="selected";	
			}
			else{
			$selected2="";	
			}
			
			echo "<option value='1' ".$selected1.">Complete</option>";
			echo "<option value='0' ".$selected2.">Incomplete</option>";
			 
			 ?>
             
             </select>
             </td>
			</tr>
      
<?php
			echo $this->wbs_list_model->tree_process_edit(0,$result->mp_id,1,$this->uri->segment('3'));

		}
			?>

			</tbody>
			</table>
            </div>
            </div>
 					</div>
                       </div> 
                    <input type="submit" name="wbssubmit" value="Submit" />
						
                    </form>
            

		</div>