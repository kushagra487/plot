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
<h2 class="page_title">Project Name</h2>
<div>
  <div class="clearfix"></div>
  <div class="">
   <!-- <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel"> 
        
        <div class="x_title wbs-table">
					<div class="col-md-3 col-sm-3 col-xs-12">

                   <div class="wbs-img">
                    <img class="img-responsive" src="<?= base_url();?>project_uploads/<?php echo $project_details['project_logo']; ?>" alt=""/>
                    </div>

                      <h3 class="logo-name" style="color: #fff; font-size: 18px;"><?php echo $project_details['project_name']; ?></h2>
                   
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
    </div>--> 
    <div class="row">
      <div class="col-xs-12">
        <?php if ($this->session->flashdata('success') == TRUE): ?>
        <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
        <?php endif; ?>
		        
          <?php if ($this->session->flashdata('headers_empty')): ?>
        <div class="alert alert-error"><?php echo $this->session->flashdata('headers_empty'); ?></div>
        <?php endif; ?>
		
        
        <ul class="nav navbar-right panel_toolbox wbs-button pro_page">
          <li>
            <form method="post" enctype="multipart/form-data" action="<?php echo base_url()?>/wbs_list/import">
            <input type="file" class="form-control" name="csv_to_process" style="width:auto !important;">&nbsp;
            <input type="hidden" name="projectid" value="<?php echo $this->uri->segment('3');?>">
            <input type="submit" value="Import">
            </form>
          </li>
         
               <li><a href="<?php echo  base_url() . 'wbs_list/export_data_in_excel/' . $this->uri->segment('3'); ?>" title="Final" id="export_wbs"><i class="fa fa-download" aria-hidden="true"></i> Export</a></li>
        
          <!--<li>
          <a href="#" class="share " title="share" id="import_wbs" data-toggle="modal" data-target="#myModal"><i class="fa fa-share-alt" aria-hidden="true"></i> Share</a></li>-->
          <?php if($wbs_data==''){?>
          <li><a href="<?php echo  base_url() . 'wbs/index/' . $this->uri->segment('3'); ?>" title="Final" id="export_wbs"><i class="fa fa-check" aria-hidden="true"></i> Add WBS</a></li>
          <?php }else{ ?>
          <li><a href="<?php echo base_url() . 'edit_wbs/index/' . $this->uri->segment('3'); ?>" title="Edit" id="export_wbs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a></li>
          <?php }  ?>
          <li><a href="<?php echo base_url() . 'odif/index/' . $this->uri->segment('3'); ?>" title="add" id="add_member">ODIF</a></li>
         <!-- <li><a href="#" class="share" title="share" id="import_wbs" data-toggle="modal" data-target="#final_approve"><i class="fa fa-check" aria-hidden="true"></i> Final</a></li>-->
        </ul>
        <p class="clearfix"></p>
        <div class="x_contents">
        
         <div class="overflow_horizon" style="">
           <div class="clone_to">
           
           </div>
          <div class="clone_from card-box">
            <table width="100%" cellspacing="0" class="table2 table-bordered nowrap" 
            id="datatable-keytable_wrapper">
        <thead>    
	<tr>
        <th class="cell12"><textarea rows="1" cols="10" name="cell12[]">Mega Process</textarea></th>
        <?php
      $sql_depth="SELECT process_columns, activity_columns  FROM project_name  WHERE project_id='".$this->uri->segment('3')."'"; 	
	$res_depth= $this->db->query($sql_depth);
	$result_depth=$res_depth->row();
	$result_depth_process=$result_depth->process_columns;
	$result_depth_activity=$result_depth->activity_columns;
	
	
		for($i=0;$i<$result_depth_process;$i++){
		?>
        
		<th class="cell13"><textarea rows="1" cols="10" name="cell13[]">Process</textarea></th>
        <?php } for($i=0;$i<$result_depth_activity;$i++){?>
        <th class="cell13"><textarea rows="1" cols="10" name="cell13[]">Activity</textarea></th>
        <?php } ?>
        <th class="cell13"><textarea rows="1" cols="10" name="cell13[]">Start Date</textarea></th>
        <th class="cell13"><textarea rows="1" cols="10" name="cell13[]">End Date</textarea></th>
        <th class="cell13"><textarea rows="1" cols="10" name="cell13[]">Assigned Person</textarea></th>
        <th class="cell13"><textarea rows="1" cols="10" name="cell13[]">Resources</textarea></th>
         <th><textarea name="col[]" cols="10" rows="1"> Dependency</textarea></th>
        <th class="cell13"><textarea rows="1" cols="10" name="cell13[]">Template Reference</textarea></th>
		</tr>
        </thead>    
            <?php
			
			$sql_mp="SELECT * FROM mega_process WHERE project_id='".$this->uri->segment('3')."' AND status=0";
			$res_mp=$this->db->query($sql_mp);
			
			//print_r($res_mp->result());

			$mp=0;
			foreach ($res_mp->result() as $result){
			$mp++;
			$sql_process="SELECT * FROM process WHERE mp_id='".$result->mp_id."'  AND status=0";
			$res_process=$this->db->query($sql_process);
	
			?>
 			<tr>
      		<td><textarea rows="1" cols="30" name="mp[]" readonly><?php echo $result->mp_name?></textarea></td>
      		
			
            
             <?php for($i=0;$i<$result_depth_process;$i++){?>
            
            <td><textarea readonly></textarea></td>
      		<?php } for($i=0;$i<$result_depth_activity;$i++){ ?>
            
            <td><textarea readonly></textarea></td>
            <?php }?>
             <td>&nbsp;</td>
              <td>&nbsp;</td>
               <td>&nbsp;</td>
                <td>&nbsp;</td>
                 <td>&nbsp;</td>
                   <td>&nbsp;</td>
            </tr>
      
<?php
			echo $this->wbs_list_model->tree_process(0,$result->mp_id,1,$this->uri->segment('3'));

		}
			?>

			</tbody>
			</table>
            
            </div>
            
            </div>
            
          </div>
        </div>
      </div>
      <style>
   li.ui-state-default{
    background:#fff0;
    border:none;
    border-bottom:1px solid #ddd;
    text-align: left;
    padding-bottom: 10px;
}

li.ui-state-default:last-child{
    border-bottom:none;
}

   </style>
   
   <p class="clearfix"></p>
  
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
              <li class="ui-state-default"><?php echo $value['comment']; ?></li>
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
</div>

<!-- Share -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="post" action="<?php echo base_url()?>/wbs_list/share">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
          <h4 class="modal-title" id="myModalLabel">Share (Receipant of the projects are already copied)</h4>
        </div>
        <div class="modal-body">
          <input type="text" name="share_emails" placeholder="Email IDS" />
        </div>
        <div class="modal-body">
          <input type="text" name="share_subject" placeholder="Subject"  />
        </div>
        <div class="modal-body">
          <textarea name="share_message" cols="100" rows="5" placeholder="Message" ></textarea>
        </div>
        <div class="modal-footer">
        <input type="hidden" name="projectid" value="<?php echo $this->uri->segment('3')?>">
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
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
          <h4 class="modal-title" id="myModalLabel">Final Approve (Receipant of the projects are already copied) </h4>
        </div>
        <div class="modal-body">
          <input type="text" name="finaltitle" />
        </div>
        <div class="modal-body">
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
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
          <h4 class="modal-title" id="myModalLabel">Reject (Receipant of the projects are already copied)</h4>
        </div>
        <div class="modal-body">
          <input type="text" name="rejecttitle" />
        </div>
        <div class="modal-body">
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
