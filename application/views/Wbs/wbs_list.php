<?php 
ini_set("memory_limit","1000M");
$role = $this->session->userdata['role']; 
$project_id=$this->uri->segment('3');
$powner=$this->projects_model->view_projects_details_id($this->uri->segment('3'));
$sql="select * from project_name where project_id='".$project_id."'";
$query = $this->db->query($sql);
//echo $this->db->last_query();
 $project_data=$query->row_array();
 //condition to check project created by team member and give them permission to edit and import wbs.
 if($this->session->userdata['user_id']==$project_data['user_id']){
  $powner['powner']=$this->session->userdata['user_id'];
 }
//print_r($project_data);die;
// print_r($powner);
// die;
?>
<style>
  @media (min-width: 1280px) {
      .wbs_uploads .col-md-2 {
          width: 13%;
      }
  }
</style>
<div class="right_col" role="main">
<h3 class="title text-uppercase"><?php echo $project_details['project_name']; ?> <img src="<?php echo base_url()?>project_uploads/<?php echo $project_details['project_logo']?>" style="width:50px;height:50px;"> </h3> 
<div>
  <div class="clearfix"></div>
  <div class="">
 
    <div class="row">
      <div class="col-xs-12">
        <?php if ($this->session->flashdata('success') == TRUE): ?>
        <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
        <?php endif; ?>
		        
          <?php if ($this->session->flashdata('headers_empty')): ?>
        <div class="alert alert-error"><?php echo $this->session->flashdata('headers_empty'); ?></div>
        <?php endif; ?>
        <div class="wbs_uploads">
        <div class="row">
        
        	<div class="col-md-4 ">
             <form <?php if($role=="Admin" || $role=="Editor") { echo ""; } else if($this->session->userdata['user_id']!=$powner['powner'] ) { ?> class="disabledbtn" <?php } ?> method="post" enctype="multipart/form-data" action="<?php echo base_url()?>/wbs_list/import">
             <input type="hidden" name="projectid" value="<?php echo $this->uri->segment('3');?>">
            <div class="input-group">
      <input type="file" id="csv_to_upload" class="form-control" placeholder="Search for..." name="csv_to_process">
      <span class="input-group-btn green_btn ">
        <button class="" type="submit"><i class="fa fa-upload" aria-hidden="true"></i> Import</button>
      </span>
    </div>
    </form>
            </div>
        
        <div class="col-md-2 col-xs-6">
        	<div class="curve_btn green_btn">
            <a href="<?php echo  base_url() . 'wbs_list/export_data_in_excel/' . $this->uri->segment('3'); ?>" title="Export" id="export_wbs"><i class="fa fa-download" aria-hidden="true"></i> Export</a>
            </div>
        </div>
         <div class="col-md-2 col-xs-6">
        	<div class="curve_btn green_btn">
            <a href="<?php echo base_url() . 'odif/index/' . $this->uri->segment('3'); ?>" title="Job Card" id="add_member"><i class="fa fa-file-text-o" aria-hidden="true"></i> Job Card</a>
            </div>
        </div>
        <div class="col-md-2 col-xs-6">
        	<div class="curve_btn green_btn">
            <a href="<?php echo base_url() . 'odif/odiffilter/' . $this->uri->segment('3'); ?>" title="odif reports" id="add_member"><i class="fa fa-file-text-o" aria-hidden="true"></i> Odif Reports</a>
            </div>
        </div>
        <div class="col-md-2 col-xs-6">
        	<div class="curve_btn green_btn">
            <a href="<?php echo base_url() . 'wbs_list/share_wbs/' . $this->uri->segment('3'); ?>" title="Share" id="add_member"  data-toggle="modal" data-target="#myModal_share"><i class="fa fa-share-alt" aria-hidden="true"></i> Share</a>
            </div>
        </div>
         
          <?php if($wbs_data==''){?>
          <div class="col-md-2 col-xs-6">
        	<div class="curve_btn red_btn <?php if($role=="Admin" || $role=="Editor") { echo ""; } else if($this->session->userdata['user_id']!=$powner['powner'] ) { ?> disabledbtn <?php } ?>">
            <a href="<?php echo  base_url() . 'wbs/index/' . $this->uri->segment('3'); ?>" title="Add WBS" id="export_wbs"><i class="fa fa-plus" aria-hidden="true"></i> Add WBS</a>
            </div>
        </div>
         
        <?php }
		
		else{ if($project_details['status']==0) {?>
        <div class="col-md-2 col-xs-6">
        	<div class="curve_btn green_btn <?php if($role=="Admin" || $role=="Editor") { echo ""; } else if($this->session->userdata['user_id']!=$powner['powner'] ) { ?> disabledbtn <?php } ?>">
            <a href="<?php echo base_url() . 'edit_wbs/index/' . $this->uri->segment('3'); ?>" title="Edit" id="export_wbs"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>
            </div>
        </div>
         <?php } }  ?>
        
        
        </div>
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
       
           <input type="text" class="form-control customwidth" id="start_date_activity" name="start_date_activity" value="<?php echo $_POST['start_date_activity']; ?>" placeholder="Start Date">
        </div>
      
        </div>
        
        <div class="col-md-2 col-sm-6 col-xs-12">
       
        <div class="form-group">
       
              <input type="text"  class="form-control customwidth" id="end_date_activity" name="end_date_activity" value="<?php echo $_POST['end_date_activity']; ?>"  placeholder="Finish Date">
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
			<button type="submit" style="margin:0;">Filter</button>
        </div>
		</div>
        </div>
             
        </form>
        </div>
        
        
		
        <p class="clearfix"></p>
        <div class="x_contents">
        
         <div class="overflow_horizon" style="">
           <div class="clone_to">
           
           </div>
          <div class="clone_from card-box">
            <table width="100%" cellspacing="0" class="table2 table-bordered nowrap" id="datatable-keytable_wrapper">
        <thead>    
	<tr>
    	<th class="cell12">Unique Code</th>
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
        <th class="cell13"><textarea rows="1" cols="10" name="cell13[]">UOM</textarea></th>
		<th class="cell13"><textarea rows="1" cols="10" name="cell13[]">Planned Quantity</textarea></th>
		
		<th class="cell13"><textarea rows="1" cols="10" name="cell13[]">Actual Quantity</textarea></th>
		
        <th class="cell13"><textarea rows="1" cols="10" name="cell13[]">Start Date & Time</textarea></th>
        <th class="cell13"><textarea rows="1" cols="10" name="cell13[]" style="width:140px !important;">Finish Date & Time</textarea></th>
        <th class="cell13"><textarea rows="1" cols="10" name="cell13[]">Assigned Person</textarea></th>
        <th class="cell13"><textarea rows="1" cols="10" name="cell13[]">Resources</textarea></th>
        <th><textarea name="col[]" cols="10" rows="1"> Dependency</textarea></th>
        <th class="cell13"><textarea rows="1" cols="10" name="cell13[]">Team Name</textarea></th>
        <th class="cell13"><textarea rows="1" cols="10" name="cell13[]">Template Document</textarea></th>
        <th class="cell13"><textarea rows="1" cols="10" name="cell13[]">Status</textarea></th>
      
		</tr>
        </thead>    
            <?php
			if($_POST['search_mp']!=''){
			$query_append="AND mp_id ='".$_POST['search_mp']."'";	
			}
			
		
			if($_POST['search_process']!=''){
			$query_append1="AND process_name LIKE '%".$_POST['search_process']."%'";		
			}
			$sql_mp="SELECT * FROM mega_process WHERE project_id='".$this->uri->segment('3')."' AND status=0 ".$query_append."";
			$res_mp=$this->db->query($sql_mp);
      //print_r($res_mp->result());die;
			
			//print_r($res_mp->result());

			$mp=0;
			foreach ($res_mp->result() as $result){
			$mp++;
			$sql_process="SELECT * FROM process WHERE mp_id='".$result->mp_id."'  AND status=0 ".$query_append1."";
			$res_process=$this->db->query($sql_process);
	
			?>
 			<tr>
            <td><textarea readonly><?php echo $result->unique_code?></textarea></td>
      		<td><textarea  readonly class="mpr"><?php echo $result->mp_name?></textarea></td>
      		
			
            
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
  
    </div>
  </div>
</div>

<!-- Share -->
<div class="modal fade" id="myModal_share" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="post" action="<?php echo base_url()?>/wbs_list/share_wps">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
          <h4 class="modal-title" id="myModalLabel">Share WBS</h4>
        </div>
        <div class="modal-body">
          <input type="text" name="share_emails" required  class="form-control" placeholder="Email IDS" />
        </div>
        <div class="modal-body">
          <input type="text" name="share_subject" required   class="form-control" placeholder="Subject"  />
        </div>
        <div class="modal-body">
          <textarea name="share_message" cols="100" class="form-control" rows="5" placeholder="Message" ></textarea>
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
          <h4 class="modal-title" id="myModalLabel">Final Approve</h4>
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
          <h4 class="modal-title" id="myModalLabel">Reject</h4>
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
