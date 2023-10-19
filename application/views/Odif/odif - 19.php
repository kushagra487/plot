<div class="right_col" role="main">
	<div>
	<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel x_panel1">
					
					<div class="row tile_count">
						
						
						<div class="x_panel">
				
                    <div class="x_title wbs-table">
					<div class="col-md-3 col-sm-3 col-xs-12">
					<div class="col-md-6 col-sm-4 col-xs-12">
                    <img class="img-responsive" src="<?= base_url();?>project_uploads/<?php echo $project_details['project_logo']; ?>" style="width: 80px;" alt=""/>
                        </div>
                    <div class="col-md-3 col-sm-4 col-xs-12">
                      <h3 class="logo-name" style="color: #fff; font-size: 18px;"><?php echo $project_details['project_name']; ?></h2>
                        </div>
                    <!--<div class="col-md-3 col-sm-4 col-xs-12">      
                      <p class="logo-name">Members</p></div>-->
                    </div>
					<div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="project-manager">
					    <h2>Project Manager</h2>
					   <div class="row"> 
					   
                                   <?php
									foreach($assign_pm_list as $key => $value){ 
									$i=1;
									if($i%2){
									?>
                                    <div class="col-md-6 col-sm-6 col-xs-12"> 
                                    <?php if($value['wbs_permission']==0){ ?>
                                    
                                    <p><input class="checked" name="checked" value="0" checked="checked" type="checkbox" onClick="getId(this.value);"/> <?php echo $value['pm_list']; ?></p> <?php } else{ ?>
                                    <p><input class="checked" name="checked" value="1" type="checkbox" onClick="getId(this.value);"/> <?php echo $value['pm_list'];?></p>
                                    <?php } ?>
                                    </div>
									<?php } else{?>	
                                    <div class="col-md-6 col-sm-6 col-xs-12"> 
                                   <?php if($value['wbs_permission']){ ?>
                                    
                                    <p><input class="checked" name="checked" value="0" checked="checked" type="checkbox" onClick="getId(this.value);"/> <?php echo $value['pm_list']; ?></p> <?php } else{ ?>
                                    <p><input class="checked" name="checked" value="1" type="checkbox" onClick="getId(this.value);"/> <?php echo $value['pm_list'];?></p>
                                    <?php } ?>
                                    </div>
                                    <?php } $i++; } ?>
                  
                        </div>  
					</div>
                        </div>
					<div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="team-member">
					    <h2>Team Member</h2>
					    <div class="row">
                        <?php       
									foreach($assign_tm_list as $key => $value){ 
									$i=1;
									if($i%2){
									?>
                        
					   <div class="col-md-6 col-sm-12 col-xs-12"> 
					    <p><input checked="checked" type="checkbox"/> <?php echo $value['tm_list'];?></p>
                        </div>
                        <?php } else{?>
                        <div class="col-md-6 col-sm-12 col-xs-12"> 
					    <p><input checked="checked" type="checkbox"/> <?php echo $value['tm_list'];?></p>
                        </div>
                          <?php } $i++; }  ?>
                        </div>
                        </div>    
					</div>
					<div class="col-md-3 col-sm-3 col-xs-12">
					
					<!--<h2>Add Megaprocess</h2>
						<ul class="nav navbar-right panel_toolbox">
							<li><a href="#" title="add" id="add_member">Add Mega Process</a></li>
							<li><a href="#" title="add" id="add_member">Download</a></li>
							<li><a href="#" title="add" id="add_member">Add Member</a></li>
						</ul>-->
						
						<p>Mega process <?php echo $megaprocess;?> &#x00A0;&#x00A0;&#x00A0;&#x00A0;&#x00A0;&#x00A0;Activity <?php echo $activity;?></p>
                        <p>Project Start Date : <?php echo $lowest['mindate'];  ?>    Project End Date <?php echo $heighest['maxdate']; ?></p>
						<div class="clearfix"></div>
					</div>
					
				</div>
                
                	</div>
                     
					</div>
					
					<h2>One Day In Full - ODIF Report</h2>
                    
                   
					<ul class="nav navbar-right panel_toolbox wbs-button">
                     <li><a href="#" title="import" id="import_wbs"><i class="fa fa-upload" aria-hidden="true"></i> Import WBS</a></li>
                     <li><a href="#" title="export" id="export_wbs"><i class="fa fa-download" aria-hidden="true"></i> Export WBS</a></li>
                     <li><a href="#" class="share" title="share" id="import_wbs"><i class="fa fa-share-alt" aria-hidden="true"></i> Share</a></li>
                     <li><form method="post"><input type="submit" name="share" value="Share" /></form></li>
                     <li><a href="#" title="Final" id="export_wbs"><i class="fa fa-check" aria-hidden="true"></i> Final</a></li>
                      <!--<li><form method="post"><input type="submit" name="final" value="Final" /></form></li>-->
                    </ul>
						
					<form method="post"><input type="date" name="sdate" style="width:200px !important;" />&nbsp;<input type="date" name="edate" style="width:200px !important;" />&nbsp;<input type="submit" name="odifsort" value="Filter" style="width:100px !important;" /></form> 
					<div class="x_content">
                    <form method="post" action="">
						<table id="datatable-responsive" class="table2 table-bordered nowrap" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Mega Process (L1)</th>
                                    <th>Process (L1)</th>
                                    <th>Activity</th>
									<th>Finish Date</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								
									<?php
								
									 foreach($odif->result() as $value){	?>
												<tr>
													<td><?php echo $value->mega_process;?></td>
                                                    <td><?php echo $value->process;?></td>
                                                    <td><?php echo $value->activity;?></td>
													<td><?php echo $value->end_date;?></td>
													<td>
                                         <?php if($value->activity!=''){?>
                                       <select name="odif_status[]" class="form-control status" tabindex="-1">
                                       <option  value="<?php echo $value->status; ?>"><?php echo $value->status; ?></option>
																
																<option value="Complete">Complete</option>
																<option value="Incomplete">Incomplete</option>
                                                                </select>
														<input type="hidden" name="odif_id[]" value="<?php echo $value->id;?>"/>
                                                        <?php } ?>
													</td>
												</tr>
								  <?php } 	?>
								
							</tbody>
						</table>
                        </div>
                        <input type="submit" name="odifsubmit" value="Update" />
                        </form>
				</div>
			</div>
		</div>
	</div>
    
    
<?php //$current_date = date('d/m/Y'); ?>

        <div class="clearfix">
        <div class="col-md-12 col-sm-12 col-xs-12">                    
           <div class="row pull-left">
          
             <div class="performance-box clearfix">  
                <div class="performance-box_img text-center">
                    <img class="img-responsive" src="<?= base_url();?>project_uploads/<?php echo $project_details['project_logo']; ?>" style="width: 100px;" alt=""/> 
                </div>
                <div class="performance-box_txt">
                    <h2><?php echo $project_details['project_name']; ?></h2>
                </div>
            </div>    
           
          </div>
          
           <div class="row pull-right">
           
             <div class="performance-box clearfix">  
                <div class="performance-box_img text-center">
                    <p><?php echo $complete; echo "/"; echo $activity; ?></p>
                </div>
                <div class="performance-box_txt">
                    <h2>Performance</h2>
                </div>
            </div>    
          
             
                <div class="performance-box clearfix">  
                <div class="performance-box_img text-center">
                    <p><?php echo $incomplete; ?></p>
                </div>
                <div class="performance-box_txt">
                    <h2>Tomorrow</h2>
                </div>
            </div>   
             
                <div class="performance-box clearfix">  
                <div class="performance-box_img text-center">
                    <?php $cal = ($complete/$activity)*100; ?>
                     <p><?php echo round($cal)."%"; ?></p>
                </div>
                <div class="performance-box_txt">
                    <h2>ODIF Score</h2>
                </div>
            </div>   
        
          </div>
    </div>
        </div>    
            
</div>