<?php $role = $this->session->userdata['role'];?>
<div class="right_col" role="main">
	<div>
		    			<div class="clearfix"></div>
		<div class="row">
					
                    <div class="col-xs-12">
                                 
   <style>
  
   </style>                 
        <h3 class="title text-uppercase">Project Name</h3>           
                    <div class="x_content">
                                  
                         
                    <form name="wbs_form" id="wbsform" method="post" action="" enctype="multipart/form-data">
                    <input type="hidden" name="project_id" value="<?php echo $project_details['project_id']; ?>" />
                    <input type="hidden" name="status" value="" />
                    
                   <div class="overflow_horizon" style="">
           <div class="clone_to">
           
           </div>
                    
   
             <div class="clone_from card-box">
                    
                    
						<table id="datatable-keytable_wrapper" class="table2 table-bordered nowrap" cellspacing="0" width="100%">
							<thead>
								<tr>
<th><textarea name="col[]" cols="30" rows="1">Mega Process</textarea></th>
                                             
									<th><textarea name="col[]" cols="10" rows="1">Process</textarea><div class="mtn_togg process"><span class="toggle_insert"><i class="fa fa-angle-right"></i></span>
                                    <span class="hover_toggle"><small class="insert_col p">Insert</small><small class="delete_col">Delete</small></span></div></th>
									<th><textarea name="col[]" cols="10" rows="1">Activity</textarea>
                                    <div class="mtn_togg"><span class="toggle_insert"><i class="fa fa-angle-right"></i></span>
                                    <span class="hover_toggle"><small class="insert_col ac">Insert</small><small class="delete_col">Delete</small></span></div>
                                    </th>
									<th><textarea name="col[]" cols="10" rows="1">Planned Quantity</textarea></th>
									<th><textarea name="col[]" cols="10" rows="1">Actual Quantity</textarea></th>
									<th>Start Date</th>
									<th>Finish Date</th>
                                    <th><textarea name="col[]" cols="10" rows="1">Assigned Person</textarea></th>
                                    <th><textarea name="col[]" cols="10" rows="1">Resources</textarea></th>
                                    
                                   <th><textarea name="col[]" cols="10" rows="1"> Dependency</textarea></th>
                                   <th><textarea name="col[]" cols="10" rows="1">Team Name</textarea></th>
                                    <th><textarea name="col[]" cols="10" rows="1">Template Document</textarea></th>
                                    
									<!--<th><textarea name="col[]" cols="10" rows="1">Department</textarea><div class="mtn_togg"><span class="toggle_insert"><i class="fa fa-angle-right"></i></span>
                                    <span class="hover_toggle"><small class="insert_col">Insert</small><small class="delete_col">Delete</small></span></div></th>-->
								
                                    
								</tr>
							</thead>
							<tbody>
								
								<tr>
									<td><textarea name="megaprocess[]"  cols="10" rows="1" class="mpr"></textarea>
                                    <div class="mtn_togg icono"><span class="toggle_insert"><i class="fa fa-angle-right"></i></span>
                                    <span class="hover_toggle"><small class="insert_row mp">Insert</small><small class="delete_row">Delete</small></span></div>
                                    </td>
                                    
									<td><textarea name="process[]"  cols="10" rows="1" class="pr"></textarea></td>
									<td><textarea name="activity[]"  cols="10" rows="1" class="activity_area"></textarea></td>
									
									
				<td><input type="text"  name="planned_quantity[]" class=""  ></td>
				<td><input type="text"  name="actually_quantity[]" class=""  ></td>				
				<td><input type="text"  name="start_date[]" class="stdate" placeholder="dd/mm/YYYY"  ></td>
				<td><input type="text" name="end_date[]" class="endate" placeholder="dd/mm/YYYY"  ></td>
                         
                         <td>
										<select class="form-control assign_person assigned_person" tabindex="-1" name="responsibilities[]" readonly>
                                          <option value="">Select </option>  
											<?php
                                            foreach($tm_details as $key => $value){
                                            ?>
                                            <option value="<?php echo $value['tm_list']; ?>"><?php echo $value['tm_list']; ?></option>
                                            <?php
                                            }
                                            ?>
                                            
                                            <?php
                                            foreach($pm_details as $key => $value){
                                            ?>
                                            <option value="<?php echo $value['pm_list']; ?>"><?php echo $value['pm_list']; ?></option>
                                            <?php
                                            }
                                            ?>
                                            
										</select>
									</td>
									<td><fieldset>
                          <div class="control-group">
                            <div class="controls">
                                <input type="text" name="resources[]" class="form-control single_cal1" id="single_cal3" placeholder="" aria-describedby="inputSuccess2Status">
                                  
                                <span id="inputSuccess2Status" class="sr-only">(success)</span>
                            </div>
                          </div>
                        </fieldset></td>
                        
                        <td><fieldset>
                          <div class="control-group">
                            <div class="controls">
                                <input type="text" disabled name="dependency[]" class="form-control single_cal1" id="single_cal3" placeholder="" aria-describedby="inputSuccess2Status">
                                  
                                <span id="inputSuccess2Status" class="sr-only">(success)</span>
                            </div>
                          </div>
                        </fieldset></td>
                        
                        <td><fieldset>
                          <div class="control-group">
                            <div class="controls">
                                <input type="text" name="template_reference[]" class="form-control single_cal1" id="single_cal3" placeholder="" aria-describedby="inputSuccess2Status">
                                <span id="inputSuccess2Status" class="sr-only">(success)</span>
                            </div>
                          </div>
                        </fieldset></td>
                        
                          <td><fieldset>
                          <div class="control-group">
                            <div class="controls">
                                <input type="file"  name="template_document[]" class="form-control wbsfile" id="single_cal3" placeholder="" aria-describedby="inputSuccess2Status">
                                <span id="inputSuccess2Status" class="sr-only">(success)</span>
                            </div>
                          </div>
                        </fieldset></td>
                     
                               
                         <tr><td colspan="25">&nbsp;</td></tr>
           
								</tr>
                          
							</tbody>
						</table>
 					</div>
				     
                        </div>
                   
                    <p class="clearfix"></p>
                    <input type="hidden" name="is_wbs_submitted" id="is_wbs_submitted">	
                      <input type="hidden" name="project_start_date" id="project_start_date" value="<?php echo date("d/m/Y",strtotime($project_details['start_date']))?>">
                    <input type="hidden" name="project_end_date" id="project_end_date" value="<?php echo date("d/m/Y",strtotime($project_details['end_date']))?>">
                      <?php  if($project_details['status']==0 && ($role=='Admin' || $role=='Project Manager' )) { ?>
                     <button class="btn" value="Save"  type="submit" name="btn_save" style="background: #1d9f75!important;
    padding: 4px 8px;
    color: #fff;
    border: none;
    margin-top: 10px;">Save</button> 
                    <button class="btn" value="Submit" type="submit" name="btn_submit" id="confirmodif" style="background: #1d9f75!important;
    padding: 4px 8px;
    color: #fff;
    border: none;
    margin-top: 10px;" title="Wbs Submit Statement">Submit</button> 
    
      <button class="btn" value="Submit" type="submit" name="btn_clear" id="clearwbs" style="background: #1d9f75!important;
    padding: 4px 8px;
    color: #fff;
    border: none;
    margin-top: 10px;" title="Clear WBS">Clear WBS</button> 
                  
		<?php } ?>				
                        </form>
                    </div>		
            </div>  
            
            
              


     <p class="clearfix"></p>
     <p class="clearfix"></p>
     <br>
     <br>
  
        
      
       
      </div>
      </div>
      <!-- Modal -->
