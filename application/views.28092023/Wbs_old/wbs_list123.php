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
		<div class="">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					
                    <div class="x_title wbs-table">
					<div class="col-md-3 col-sm-3 col-xs-12">
<!--					<div class="col-md-6 col-sm-4 col-xs-12">-->
                   <div class="wbs-img">
                    <img class="img-responsive" src="<?= base_url();?>project_uploads/<?php echo $project_details['project_logo']; ?>" alt=""/>
                    </div>
<!--                        </div>-->
<!--                    <div class="col-md-6 col-sm-4 col-xs-12">-->
                      <h3 class="logo-name" style="color: #fff; font-size: 18px;"><?php echo $project_details['project_name']; ?></h2>
<!--                        </div>-->
                    <!--<div class="col-md-3 col-sm-4 col-xs-12">      
                      <p class="logo-name">Members</p></div>-->
                    </div>
					<div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="project-manager">
					    <h2>Project Manager</h2>
					   <div class="row"> 
					   <form method="post">
                                   <?php
									foreach($assign_pm_list as $key => $value){ 
									$i=1;
									if($i%2){
									?>
                                    <div class="col-md-6 col-sm-6 col-xs-12"> 
                                    <?php if($value['wbs_permission']==0){ ?>
                                    
                                    <p><input class="checked" name="pmchecked" value="1" type="checkbox" onClick="test('<?php echo $value['pm_list']; ?>');"/> <?php echo $value['pm_list']; ?></p> <?php } else{ ?>
                                    <p><input class="checked" name="pmchecked" value="0" checked="checked"  type="checkbox" onClick="test('<?php echo $value['pm_list']; ?>');"/> <?php echo $value['pm_list'];?></p>
                                    <?php } ?>
                                    </div>
									<?php } else{?>	
                                    <div class="col-md-6 col-sm-6 col-xs-12"> 
                                   <?php if($value['wbs_permission']==0){ ?>
                                    
                                    <p><input class="checked" name="pmchecked" value="1" type="checkbox" onClick="test('<?php echo $value['pm_list']; ?>');"/> <?php echo $value['pm_list']; ?></p> <?php } else{ ?>
                                    <p><input class="checked" name="pmchecked" value="0" checked="checked" type="checkbox" onClick="test('<?php echo $value['pm_list']; ?>');"/> <?php echo $value['pm_list'];?></p>
                                    <?php } ?>
                                    </div>
                                    <?php } $i++; } ?>
                                    <br /><br />
                                    
                                   
                                    
                          </form>
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
                                    <div class="col-md-6 col-sm-6 col-xs-12"> 
                                    <?php if($value['wbs_permission']==0){ ?>
                                    
                                    <p><input class="checked" name="tmchecked" value="1"  type="checkbox" onClick="tmtest('<?php echo $value['tm_list']; ?>');"/> <?php echo $value['tm_list']; ?></p> <?php } else{ ?>
                                    <p><input class="checked" name="tmchecked" value="0" checked="checked" type="checkbox" onClick="tmtest('<?php echo $value['tm_list']; ?>');"/> <?php echo $value['tm_list'];?></p>
                                    <?php } ?>
                                    </div>
									<?php } else{?>	
                                    <div class="col-md-6 col-sm-6 col-xs-12"> 
                                   <?php if($value['wbs_permission']==0){ ?>
                                    
                                    <p><input class="checked" name="tmchecked" value="1" type="checkbox" onClick="tmtest('<?php echo $value['tm_list']; ?>');"/> <?php echo $value['tm_list']; ?></p> <?php } else{ ?>
                                    <p><input class="checked" name="tmchecked" value="0" checked="checked" type="checkbox" onClick="tmtest('<?php echo $value['tm_list']; ?>');"/> <?php echo $value['tm_list'];?></p>
                                    <?php } ?>
                                    </div>
                                <?php } $i++; } ?>
                    
                          
                         
                          </form>
                        </div>
                        </div>    
					</div>
					<div class="col-md-3 col-sm-3 col-xs-12">
						
						<p>Mega process <?php echo $megaprocess;?> &#x00A0;&#x00A0;&#x00A0;&#x00A0;&#x00A0;&#x00A0;Activity <?php echo $activity;?></p>
                        <p>Project Start Date : <?php echo $lowest['mindate'];  ?>    Project End Date <?php echo $heighest['maxdate']; ?></p>
						<div class="clearfix"></div>
					</div>
					
				</div>
                	</div>
                </div>
                <div class="row">
                
                <div class="col-md-2 col-sm-2 col-xs-12">
                       
                       <div class="project_info">
                       <p>Project info</p>
                         <div style="background-color:#FFF;"><?php echo $project_details['comment']; ?></div>
                         <br />
                        	
							<?php  foreach($getcomment as $key=>$value){?>
                             <div style="background-color:#FFF;">
							 <?php echo $value['comment']; ?>
                             </div>
                            <?php  } ?><br />
                                        
                       <form method="post"><!--id="ta"-->
                           <textarea name="usercomment" id="" col="15" row="6"></textarea>
                           <div class="project-button clearfix">                       
                           <input type="submit" name="ucomment" id="comment" value="Comment"/>
                            </div>
                        </form>
                        
                       <div class="project-button clearfix">
                        <a href="#" class="share" title="share" id="import_wbs" data-toggle="modal" data-target="#final_approve">Approve</a>
                       </div>
                       <div class="project-button clearfix">
                     <a href="#" class="share" title="share" id="import_wbs" data-toggle="modal" data-target="#reject">Reject</a>
                       </div>
                    
                        </div>                                                 
                    </div>
                   
                    
                    <div class="col-md-10 col-sm-10 col-xs-12">
            <?php if ($this->session->flashdata('success') == TRUE): ?>
                <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
            <?php endif; ?>
                  <ul class="nav navbar-right panel_toolbox wbs-button">
                       
                     <li>
<!--
                      <div class="form-group">
						 <form method="post" enctype="multipart/form-data">
						<input id="uploadFile" placeholder="Choose File" disabled="disabled" />
						<div class="fileUpload">
							<span>Add Logo</span>
							<input id="uploadBtn" type="file" name="image" class="upload btn btn-primary" />
						</div>
                         <input type="submit" id="send" name="upload" value="Import"/>
                          </form>
					</div>
-->
                       <form method="post" enctype="multipart/form-data">
                         <input type="submit" id="send" name="upload" value="Import"/>
                         <input type="button" value="Choose file"/>                        
                         <input id="uploadBtn" type="file" name="csvfile" class="" />

                       </form>
                     </li>
                     <li><form method="post"><input type="submit" id="send" name="export" value="Export"/></form></li>
                     <li><a href="#" class="share " title="share" id="import_wbs" data-toggle="modal" data-target="#myModal"><i class="fa fa-share-alt" aria-hidden="true"></i> Share</a></li>
                    
                      
                      <?php if($column['col1']==''){?>
                     <li><a href="<?= base_url() . 'wbs/index/' . $this->uri->segment('3'); ?>" title="Final" id="export_wbs"><i class="fa fa-check" aria-hidden="true"></i> Add WBS</a></li>
                     <?php }else{ ?>
                     <li><a href="<?= base_url() . 'edit_wbs/index/' . $this->uri->segment('3'); ?>" title="Edit" id="export_wbs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a></li>
                     
                     <?php } ?>
                     <li><a href="<?= base_url() . 'odif/index/' . $this->uri->segment('3'); ?>" title="add" id="add_member">ODIF</a></li>
                    
                     <li><a href="#" class="share" title="share" id="import_wbs" data-toggle="modal" data-target="#final_approve"><i class="fa fa-check" aria-hidden="true"></i> Final</a></li>
                  
                 </ul>
                    
				
						
					
					<div class="x_content">
                     <div class="card-box table-responsive">

						<table id="datatable-responsive" class="table2 table-bordered nowrap" cellspacing="0" width="100%">
							<thead>
								<tr>
                                    <th>Sl no. </th>
									 <?php if($column['col1']!=''){ echo "<th>" . $column['col1'] . "</th>"; } ?>
                                     <?php if($column['col2']!=''){ echo "<th>" . $column['col2'] . "</th>"; } ?>
                                     <?php if($column['col3']!=''){ echo "<th>" . $column['col3'] . "</th>"; } ?>
                                     <?php if($column['col4']!=''){ echo "<th>" . $column['col4'] . "</th>"; } ?>
                                     <?php if($column['col5']!=''){ echo "<th>" . $column['col5'] . "</th>"; } ?>
                                     <?php if($column['col6']!=''){ echo "<th>" . $column['col6'] . "</th>"; } ?>
                                     <?php if($column['col7']!=''){ echo "<th>" . $column['col7'] . "</th>"; } ?>
                                     <?php if($column['col8']!=''){ echo "<th>" . $column['col8'] . "</th>"; } ?>
                                     <?php if($column['col9']!=''){ echo "<th>" . $column['col9'] . "</th>"; } ?>
                                     <?php if($column['col10']!=''){ echo "<th>" . $column['col10'] . "</th>"; } ?>
                                     <?php if($column['col11']!=''){ echo "<th>" . $column['col11'] . "</th>"; } ?>
                                     <?php if($column['col12']!=''){ echo "<th>" . $column['col12'] . "</th>"; } ?>
                                     <?php if($column['col13']!=''){ echo "<th>" . $column['col13'] . "</th>"; } ?>
                                     <?php if($column['col14']!=''){ echo "<th>" . $column['col14'] . "</th>"; } ?>
									<th>Start Date</th>
									<th>Finish Date</th>
                                     <?php if($column['col15']!=''){ echo "<th>" . $column['col15'] . "</th>"; } ?>
                                     <?php if($column['col16']!=''){ echo "<th>" . $column['col16'] . "</th>"; } ?>
                                     <?php if($column['col17']!=''){ echo "<th>" . $column['col17'] . "</th>"; } ?>
                                     <?php if($column['col18']!=''){ echo "<th>" . $column['col18'] . "</th>"; } ?>
                                     <?php if($column['col19']!=''){ echo "<th>" . $column['col19'] . "</th>"; } ?>
                                     <?php if($column['col20']!=''){ echo "<th>" . $column['col20'] . "</th>"; } ?>
                                     <?php if($column['col21']!=''){ echo "<th>" . $column['col21'] . "</th>"; } ?>
                                     <?php if($column['col22']!=''){ echo "<th>" . $column['col22'] . "</th>"; } ?>
                                     <?php if($column['col23']!=''){ echo "<th>" . $column['col23'] . "</th>"; } ?>
                                     <?php if($column['col24']!=''){ echo "<th>" . $column['col24'] . "</th>"; } ?>
								</tr>
							</thead>
							<tbody>
								<?php $i=1; $j=1; $temp=1; foreach ($h->result() as $rowlist) { ?>
								<tr>
                                      <td><?php if($rowlist->mega_process!=''){ echo $i;}
									  else if($rowlist->mega_process==''){ echo $i-$temp .".". "$j"; $j++; } ?></td>
									 <?php if($column['col1']!=''){ echo "<td>" .  $rowlist->mega_process . "</td>"; } ?>
                                     <?php if($column['col2']!=''){ echo "<td>" . $rowlist->activity1 . "</td>"; } ?>
                                     <?php if($column['col3']!=''){ echo "<td>" . $rowlist->activity2 . "</td>"; } ?>
                                     <?php if($column['col4']!=''){ echo "<td>" . $rowlist->activity3 . "</td>"; } ?>
                                     <?php if($column['col5']!=''){ echo "<td>" . $rowlist->activity4 . "</td>"; } ?>
                                     <?php if($column['col6']!=''){ echo "<td>" . $rowlist->activity5 . "</td>"; } ?>
                                     <?php if($column['col7']!=''){ echo "<td>" . $rowlist->activity6 . "</td>"; } ?>
                                     <?php if($column['col8']!=''){ echo "<td>" . $rowlist->activity7 . "</td>"; } ?>
                                     <?php if($column['col9']!=''){ echo "<td>" . $rowlist->activity8 . "</td>"; } ?>
                                     <?php if($column['col10']!=''){ echo "<td>" . $rowlist->activity9 . "</td>"; } ?>
                                     <?php if($column['col11']!=''){ echo "<td>" . $rowlist->activity10 . "</td>"; } ?>
                                    
									 <?php if($column['col12']!=''){ echo "<td>" . $rowlist->process . "</td>"; } ?>
									 <?php if($column['col13']!=''){ echo "<td>" . $rowlist->activity . "</td>"; } ?>
									 <?php if($column['col14']!=''){ echo "<td>" .  $rowlist->responsibility . "</td>"; } ?>
									 <td><?php echo $rowlist->start_date;?></td>
                                     <td><?php echo $rowlist->end_date;?></td>
									 <?php if($column['col15']!=''){ echo "<td>" .  $rowlist->resources . "</td>"; } ?>
									 <?php if($column['col16']!=''){ echo "<td>" . $rowlist->department . "</td>"; } ?>
                                    
                                     <?php if($column['col17']!=''){ echo "<td>" . $rowlist->activity11 . "</td>"; } ?>
                                     <?php if($column['col18']!=''){ echo "<td>" . $rowlist->activity12 . "</td>"; } ?>
                                     <?php if($column['col19']!=''){ echo "<td>" . $rowlist->activity13 . "</td>"; } ?>
                                     <?php if($column['col20']!=''){ echo "<td>" . $rowlist->activity14 . "</td>"; } ?>
                                     <?php if($column['col21']!=''){ echo "<td>" . $rowlist->activity15 . "</td>"; } ?>
                                     <?php if($column['col22']!=''){ echo "<td>" . $rowlist->activity16 . "</td>"; } ?>
                                     <?php if($column['col23']!=''){ echo "<td>" . $rowlist->activity17 . "</td>"; } ?>
                                     <?php if($column['col24']!=''){ echo "<td>" . $rowlist->activity18 . "</td>"; } ?>
                                     <?php if($column['col25']!=''){ echo "<td>" . $rowlist->activity19 . "</td>"; } ?>
                                     <?php if($column['col26']!=''){ echo "<td>" . $rowlist->activity20 . "</td>"; } ?>
								</tr>
                                <?php if($mp = $rowlist->mega_process!=''){$i++;  $j=1; }}  ?>
							</tbody>
						</table>
                     </div>
				</div>
			</div>
		</div>
	</div>
</div></div>



<!-- Share -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog share-modal" role="document">
    <div class="modal-content">
    <form method="post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Share</h4>
      </div>
      <div class="modal-body">
         <input type="hidden" name="sharetitle" value="Share"/>
         <input type="text" name="sharename" placeholder="Subject"/> 
      </div>
      <div class="modal-body">
       
         <textarea name="sharemessage" placeholder="Description" cols="100" rows="5"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" name="sharesend" class="btn btn-primary" value="Send" />
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Final/Approve -->
<div class="modal fade" id="final_approve" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form method="post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Final Approve</h4>
      </div>
      <div class="modal-body">
         <input type="hidden" name="finaltitle" value="Final" />
         <input type="text" name="finalname" /> 
      </div>
      <div class="modal-body">
         <textarea name="finalmessage" cols="100" rows="5"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" name="finalsend" class="btn btn-primary" value="Approve" />
      </div>
      </form>
    </div>
  </div>
</div>


<!-- Reject -->
<div class="modal fade" id="reject" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form method="post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Reject</h4>
      </div>
      <div class="modal-body">
         <input type="hidden" name="rejecttitle" value="Reject" />
         <input type="text" name="rname" /> 
      </div>
      <div class="modal-body">
         <textarea name="rejectmessage" cols="100" rows="5"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" name="rejectsend" class="btn btn-primary" value="Reject" />
      </div>
      </form>
    </div>
  </div>
</div>