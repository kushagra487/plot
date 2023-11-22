<div class="right_col odif_page" role="main">
 <h3 class="title text-uppercase">Job Card In - ODIF Report <small>(<?php echo date('dS F Y');?>)</small></h3>
 <span class="pull-right"><a href="<?php echo base_url()?>wbs_list/index/<?php echo $this->uri->segment('3')?>">Back</a></span>
	<div>
	<div class="clearfix"></div>
		<div class="row">
        
        <div class="col-sm-4 col-xs-12">
        	<div class="logo_comp">
            <figure>
            <figcaption><h5 class="ft-24 text-center"><?php echo $project_details['project_name']; ?></h5></figcaption>
            <img class="img-responsive" src="<?php echo base_url();?>project_uploads/<?php echo $project_details['project_logo']; ?>"  alt="" style="height:200px !important;"/> 
            </figure>
            </div>
        
        </div>
         <div class="col-sm-8 col-md-7 col-md-offset-1 col-lg-6 col-lg-offset-1  col-xs-12">
         	<div class="row">
            	<div class="col-sm-6 col-xs-12">
                <div class="perform_circle">
                <h5 class="ft-24 text-center">Performance</h5>
                <div class="circle_banja"><?php echo count($complete_activity); echo "/"; echo count($total_activity); ?></div>
                </div>
                </div>
                
                <div class="col-sm-6 col-xs-12">
                <div class="odif_circle">
                <h5 class="ft-24 text-center">ODIF Score</h5>
                <div class="circle_banja"><?php $cal = round((count($complete_activity)/count($total_activity))*100); ?><?php echo number_format($cal, 2)."%"; ?></div>
                </div>
                </div>
                
                
            </div>         
         </div>
        
           <p class="clearfix"></p>
           <br>
        <hr style="box-shadow:0px 0px 6px #ccc;">
			<div class="col-xs-12">
				<div class="x_panel x_panel1">
					
                    
                   <p style="color:red !important;" id="ajaxmsg"></p>
					<ul class="nav navbar-right panel_toolbox wbs-button pro_page">
                    <li>
                    <div class="curve_btn green_btn">
          <a href="#" class="share btn-lg" title="share" id="import_wbs" data-toggle="modal" data-target="#myModal"><i class="fa fa-share-alt" aria-hidden="true"></i> Share</a></div></li>
                    </ul>
	<p class="clearfix"></p>					

					<div class="x_contents">
                    <form method="post" action="">
                    <div class="overflow_horizon" style="">
                     <div class="clone_to">
           
           </div>
           <div class="clone_from card-box">
                   
						<table id="datatable-responsive datatable-keytable_wrapper" class="table2 table-bordered nowrap" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>S. No.</th>
                                    <th>Mega Process</th>
                                     <th>Process</th>
                                    <th>Activity</th>
                                    <th>Planned Quantity</th>
                                    <th>Actual Quantity</th>
                                    <th>Assigned Person</th>
                                    <th>Start Date & Time</th>
									<th>Finish Date & Time</th>
									<th class="col-xs-1">Status</th>
                                    <th class="col-xs-1">Comments</th>
								</tr>
							</thead>
							<tbody>
								
									<?php 
									//print_r($odif);	
									
									
				$sl=0; foreach($odif as $value){	
								
					
			if($value['dependent_on']!=''){

			$sql_dep_status="SELECT * FROM activity WHERE unique_code='".$value['dependent_on']."' AND project_id='".$value['project_id']."' AND status=0";

			$res_dep_status=$this->db->query($sql_dep_status);
			$result_dep_status=$res_dep_status->row();

			//echo "<br>aaa-->".$result_dep_status->activity_status;

			if($result_dep_status->activity_status==0){
				$disabled_class="disabled";	
				$disabled_class1="readonly";	
			}else{
				$disabled_class="";	
				$disabled_class1='';	
			}
			
					}
			?>
      <?php 
       $pq = $value['planned_quantity'];
       $aq = $value['actually_quantity'];
       $taq = $value['temp_actual_quantity'];
       $job_card_sql = "SELECT * FROM job_card WHERE activity_id='".$value['activity_id']."'";
       $job_card = $this->db->query($job_card_sql)->row(); 
       if($job_card) { 
        $value['planned_quantity']  = $job_card->planned_quantity;
        $value['actually_quantity'] = $job_card->actually_quantity;
        if($value['planned_quantity'] <= 0){
          continue;
        }
       }
       $sl++; 	
      //  echo $project_details['daterange']."<br>";
      //  echo date('m/d/Y',strtotime($value['start_date']))."<br>";
      //  echo date('d/m/Y')."<br>";
      //  echo date('H:i')."<br>"; 
      //  if((date('d/m/Y')==date('m/d/Y',strtotime($value['start_date']))) && ($project_details['daterange'] > date('H:i'))) { echo 'disabled'; }
//echo "gugu".$convertedDate= DateTime::createFromFormat('d/m/Y', $value['start_date'])->format('d/m/Y');
        $original_date = $value['start_date'];
        $datetime = DateTime::createFromFormat('d/m/Y H:i:s', $original_date);
        $new_date = $datetime->format('d/m/Y');

    
//      if((date('d/m/Y')==date('m/d/Y',strtotime($value['start_date']))) && ($project_details['daterange'] > date('H:i'))) { echo 'disabled'; } 
      ?>
						<tr>
												    <td><?php echo $sl;?></td>
                                                    <td><?php echo $value['mp_name'];?></td>
                                                    <td><?php echo $value['process_name'];?></td>
                                                    <td><?php echo $value['activity_name'];?></td>
                                                    <td><input name="planned_quantity[<?php echo $sl-1; ?>]" id="planned_quantity" value="<?=$value['planned_quantity']?>" type="text" disabled></td>
													                          <td><input name="actually_quantity[<?php echo $sl-1; ?>]" id="actually_quantity" value="<?=$value['actually_quantity']?>" type="text" <?php if((date('d/m/Y')==$new_date) && ($project_details['daterange'] > date('H:i'))) { echo 'disabled'; } ?>>
                                                    <!-- <input name="temp_actual_quantity[<?php echo $sl-1; ?>]" id="temp_actual_quantity" value="<?php echo $value['temp_actual_quantity']?>" type="hidden"> --> 

<?php // echo $value['temp_actual_quantity']?></td>
                                                    <td><?php echo $value['assigned_person'];?></td>
                                                    <td><?php echo $value['start_date'];?></td>
													<td><?php echo $value['finish_date'];?></td>
												<td>
                                                 <?php if($value['activity_name']!=''){?>
                                               <select name="odif_status[]" id="odif_status" class="form-control status" tabindex="-1" onChange="check_dependency(<?php echo $value['activity_id'];?>)" <?php echo $disabled_class?>  <?php if((date('d/m/Y')==$new_date) && ($project_details['daterange'] > date('H:i'))) { echo 'disabled'; } ?>>
                         <option  value="">Select</option>                                 
                         <option value="1" <?php if($value['activity_status']==1) echo "selected";?>>1</option>
                         <option value="0" <?php if($value['activity_status']==0) echo "selected";?>>0</option>
                          </select>
						
                                                        <?php } ?>
                                                        <input type="hidden" id="odifid" name="odif_id[<?php echo $sl-1; ?>]" value="<?php echo $value['activity_id'];?>" <?php if((date('d/m/Y')==$new_date) && ($project_details['daterange'] > date('H:i'))) { echo 'disabled'; } ?>/>
													</td>
                                                    <td><input name="odif_comment[<?php echo $sl-1; ?>]" id="odif_comments" value="<?php echo $value['comments']?>" type="text" <?php echo $disabled_class1?> <?php if((date('d/m/Y')==$new_date) && ($project_details['daterange'] > date('H:i'))) { echo 'disabled'; } ?>></td>
												</tr>
								  <?php } ?>
								
							</tbody>
						</table>
                       
                  
                        </div>
                        
                    
                     </div> 
                     <div class="curve_btn green_btn text-right">
                        <input type="submit" name="odifsubmit" class="btn-lg" value="Update">
                        </div>
                           </form>
				</div>
                
             
			</div>
            
            
               <div class="clearfix">
              
        
        </div> 
            
                <p class="clearfix"></p>
  
		</div>
	</div>
    
    
<?php //$current_date = date('d/m/Y'); ?>

        
            
</div>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="post" action="<?php echo base_url()?>/wbs_list/share">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
          <h4 class="modal-title" id="myModalLabel">Share Job Card Report</h4>
        </div>
        <div class="modal-body">
          <input type="text" name="share_emails"  class="form-control" placeholder="Email IDS" />
        </div>
        <div class="modal-body">
          <input type="text" name="share_subject"  class="form-control" placeholder="Subject"  />
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

