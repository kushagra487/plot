

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
	<div>
		    			<div class="clearfix"></div>
		<div class="row">
					
                    <div class="col-xs-12">
                                      <!--<ul class="nav navbar-right panel_toolbox wbs-button">
                     <li><a href="#" title="import" id="import_wbs"><i class="fa fa-upload" aria-hidden="true"></i> Import WBS</a></li>
                     <li><a href="#" title="export" id="export_wbs"><i class="fa fa-download" aria-hidden="true"></i> Export WBS</a></li>
                      <li><a href="#" title="share" id="import_wbs"><i class="fa fa-share-alt" aria-hidden="true"></i> Share</a></li>
                    
                     <li><a href="#" title="Final" id="export_wbs"><i class="fa fa-check" aria-hidden="true"></i> Final</a></li>
                    </ul>-->
                    
   <style>
  
   </style>                 
         <h2 class="page_title">Project Name</h2>           
                    <div class="x_content">
                                  
                         
                    <form name="wbs_form" method="post" action="">
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
									<th><textarea name="col[]" cols="10" rows="1">Responsibility</textarea></th>
									<th>Start Date</th>
									<th>Finish Date</th>
                                    <th><textarea name="col[]" cols="10" rows="1">Resources</textarea></th>
                                    
                                   <th><textarea name="col[]" cols="10" rows="1"> Dependency</textarea></th>
                                      <th><textarea name="col[]" cols="10" rows="1">Template Reference</textarea></th>
									<!--<th><textarea name="col[]" cols="10" rows="1">Department</textarea><div class="mtn_togg"><span class="toggle_insert"><i class="fa fa-angle-right"></i></span>
                                    <span class="hover_toggle"><small class="insert_col">Insert</small><small class="delete_col">Delete</small></span></div></th>-->
								
                                    
								</tr>
							</thead>
							<tbody>
								
								<tr>
									<td><textarea name="megaprocess[]"  cols="10" rows="1"></textarea>
                                    <div class="mtn_togg icono"><span class="toggle_insert"><i class="fa fa-angle-right"></i></span>
                                    <span class="hover_toggle"><small class="insert_row mp">Insert</small><small class="delete_row">Delete</small></span></div>
                                    </td>
                                    
									<td><textarea name="process[]"  cols="10" rows="1"></textarea></td>
									<td><textarea name="activity[]"  cols="10" rows="1"></textarea></td>
									<td>
										<select class="form-control" tabindex="-1" name="responsibilities[]">
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
                            
                                <input type="text" class="form-control single_cal1 dateselect" placeholder="" aria-describedby="inputSuccess2Status">
                                <input type="hidden"  name="start_date[]" >
                                <span id="inputSuccess2Status" class="sr-only">(success)</span>
                            </div>
                          </div>
                        </fieldset></td>
									<td><fieldset>
                          <div class="control-group">
                            <div class="controls">
                                <input type="text" class="form-control single_cal1 dateselect"  placeholder="" aria-describedby="inputSuccess2Status">
                                <input type="hidden" name="end_date[]" >
                                <span id="inputSuccess2Status" class="sr-only">(success)</span>
                            </div>
                          </div>
                        </fieldset></td>
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
                                <input type="text" name="dependency[]" class="form-control single_cal1" id="single_cal3" placeholder="" aria-describedby="inputSuccess2Status">
                                  
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
								<!--	<td><textarea  name="department[]"  cols="10" rows="1"></textarea></td>-->
                                    
                                   
                               
                                    
								</tr>
							</tbody>
						</table>
 					</div>
				     
                        </div>
                    </div>		
                    <p class="clearfix"></p>
                    <input type="submit" name="wbssubmit" value="Submit" />
						
                        </form>
                   
            </div>  
            
            
              


     <p class="clearfix"></p>
     <p class="clearfix"></p>
     <br>
     <br>
  
      <!--<div class="comment_block">
       <hr>
        <div class="col-lg-6 col-md-8 col-lg-offset-3 col-md-offset-2 col-sm-12 text-center">
        
          <div class="well">
            <h4>What is on your mind?</h4>
              <form method="post">
            <div class="comment_area">
              <textarea type="text" id="userComment" name="usercomment" class="form-control input-sm chat-input" placeholder="Write your message here..." ></textarea>
              <p class="clearfix"></p>
              <div class="text-right">
                <input type="submit" class="btn-success btn-sm" name="ucomment" id="comment" value="Comment"/>
            </div>
               </div>
               </form>
            <hr data-brackets-id="12673">
            <ul data-brackets-id="12674" id="sortable" class="list-unstyled ui-sortable">
            <?php  foreach($getcomment as $key=>$value){?>
              <strong class="pull-left primary-font"><?php echo $value['name']; ?></strong> </br>
              <li class="ui-state-default text-left"><?php echo $value['comment']; ?></li>
              </br>
              <?php  } ?>
            </ul>
          </div>
          
          
          
          <div class="project_info">
            <p>Project info</p>
           
          
            <div class="project-button clearfix"> <a href="#" class="share" title="share" id="import_wbs" data-toggle="modal" data-target="#final_approve">Approve</a> </div>
            <div class="project-button clearfix"> <a href="#" class="share" title="share" id="import_wbs" data-toggle="modal" data-target="#reject">Reject</a> </div>
          </div>
        </div>
      </div>--> 
      
      
      
       
      </div>
      </div>
      <!-- Modal -->
