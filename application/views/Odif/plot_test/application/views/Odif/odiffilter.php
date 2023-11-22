<div class="right_col odif_page" role="main">
 <h3 class="title text-uppercase"> ODIF Report</h3>
 <span class="pull-right"><a href="<?php echo base_url()?>wbs_list/index/<?php echo $this->uri->segment('3')?>">Back</a></span>
	<div>
  <div class="clearfix"></div>
  <div class="row"><div class="col-md-6 col-xs-6">
        <div class="curve_btn green_btn">
                    <a href="<?php echo base_url()?>odif/excelDownload?projectid=<?php echo $this->uri->segment('3')?>&assigned_person=<?php echo $this->session->userdata('responsible_person');?>">Download ODIF Report</a>
                  </div>
        </div></div>
  <div class="row" style="margin-top:20px;">
  <div class="search_area">
  <form method="post" action="" autocomplete="off" >
    
  <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
        <label>Date Range</label>
        <input type="text" name="date" value="<?php echo $_POST['date']?>" class="form-control" id="datetstarting" placeholder="Select Date Range">
        </div>
	</div>

    <div class="col-md-6 col-sm-6 col-xs-12">        
		<div class="form-group">
        <label>Select Assigned Person</label>
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
	
    <div class="col-md-12 col-sm-12 col-xs-12">
         <div class="curve_btn green_btn text-right">
         <button type="submit" name="odifsort">Filter</button>
         </div>
	</div>  
	
 </form>
 </div>     
    </div>
  <div class="clearfix"></div>
	<div class="clearfix"></div>
		<div class="row" style="margin-top:20px;">
        
        <div class="col-sm-4 col-xs-12">
        	<div class="logo_comp">
            <figure>
            <figcaption><h5 class="ft-24 text-center"><?php echo $project_details['project_name']; ?></h5></figcaption>
            <img class="img-responsive" src="<?php echo base_url();?>project_uploads/<?php echo $project_details['project_logo']; ?>"  alt="" style="height:200px !important;"/> 
            </figure>
            </div>
        
        </div>
        <?php //if($datediff <= 0) { ?>
         <div class="col-sm-8 col-md-7 col-md-offset-1 col-lg-6 col-lg-offset-1  col-xs-12">
         	<div class="row">
            	<div class="col-sm-6 col-xs-12">
                <div class="perform_circle">
                <h5 class="ft-24 text-center">Performance</h5>
                <div class="circle_banja performance"><?php echo count($complete_activity); echo "/"; echo count($total_activity); $total_complete_activity = count($complete_activity); ?></div>
                </div>
                </div>
                
                <div class="col-sm-6 col-xs-12">
                <div class="odif_circle">
                <h5 class="ft-24 text-center">ODIF Score</h5>
                <!-- <?php //echo count($complete_activity);die;?> -->
                <div class="circle_banja score"><?php $cal = round((count($complete_activity)/count($total_activity))*100); ?><?php echo number_format($cal, 2)."%"; ?></div>
                </div>
                </div>
                
                
            </div>         
         </div>
         <?php //} ?>
        
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
                                     <?php if($datediff > 0) { ?>
                                      <th>Start Date & Time</th>
                                      <?php } ?>
                                      <?php if($datediff <= 0) { ?>
                                    <th>Activity</th>
                                    <th>UOM</th>
                                    <th>Planned Quantity</th>
                                    <th>Actual Quantity</th>
                                    <?php } ?>
                                    <th>Assigned Person</th>
                                    <?php if($datediff <= 0) { ?>
                                    <th>Start Date & Time</th>
                                    
									<th>Finish Date & Time</th>
									                 
                                    <th class="col-xs-1">Status</th>
                                    <th class="col-xs-1">Comments</th>
                                    <?php } ?>
                                     <?php if($datediff > 0) { ?>
                                      <th>Planned Activities</th>
                                      <th>Completed actvities</th>
                                      <th>Score</th>
                                    <?php } ?>
								</tr>
							</thead>
							<tbody>
								
									<?php 
									//print_r($odif);	
									
									$this->load->model("odif_model");
                  $sum_total_activity = 0;
				$sl=0; foreach($odif as $value){	
					$sl++; 				
					
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





          if(isset($_POST['odifsort'])){
             $get_id =  $this->uri->segment('3');
              // $datestring=$_POST['date'];	
              $responsilbe_person=$_POST['responsilbe_person'];	
              $start_date = explode(' ',$value['start_date'])[0];
              $end_date = explode(' ',$value['finish_date'])[0];
              
             // if($datestring!=''){
             $start_date = explode("/",$start_date);	
              $sdate=$start_date[2]."-".$start_date[1]."-".$start_date[0];
              
              $end_date = explode("/",$end_date);	
              $edate=$end_date[2]."-".$end_date[1]."-".$end_date[0];
             // }

             //echo $sdate;die;
              $total_activity = $this->odif_model->get_odif_all_filter_range($get_id,$sdate,$edate,$value['assigned_person']);
//  echo "Total".count($total_activity);
             $complete_activity = $this->odif_model->get_odif_completed_filter_range($get_id,$sdate,$edate,$value['assigned_person']);						
             //echo "Complete".count($complete_activity);
              }
			?>
						<tr>
												    <td><?php echo $sl;?></td>
                                                    <td><?php echo $value['mp_name'];?></td>
                                                    <td><?php echo $value['process_name'];?></td>
                                                    <?php if($datediff > 0) { ?>
                                                      <td><?php echo $value['start_date'];?></td>
                                                    <?php } ?>
                                                    <?php if($datediff <= 0) { ?>
                                                    <td><?php echo $value['activity_name'];?></td>
                                                    <td><?php echo $value['uom']?></td>
                                                    <td><?php echo $value['planned_quantity']?></td>
													                          <td><?php echo $value['actually_quantity']?></td>
                                                    <?php } ?>
                                                    <td><?php echo $value['assigned_person'];?></td>
                                                    <?php if($datediff <= 0) { ?>
                                                    <td><?php echo $value['start_date'];?></td>
                                                   
													<td><?php echo $value['finish_date'];?></td>
                          
												<td>
                                                 <?php if($value['activity_name']!=''){?>
                                                  <?php echo $value['activity_status'];?>
                                             <?php } ?>
                                                        <input type="hidden" id="odifid" name="odif_id[<?php echo $sl-1; ?>]" value="<?php echo $value['activity_id'];?>"/>
													</td>
                                                    <td><?php echo $value['comments']?></td>
                                                    <?php } ?>
                                                    <?php if($datediff > 0) { ?>
                                                      <td><?php echo count($total_activity); $sum_total_activity =$sum_total_activity + count($total_activity);?></td>
                                                      <td><?php echo  count($complete_activity); ?></td>
                                                      <td><?php echo round((count($complete_activity) * 100)/count($total_activity),2).'%'; ?></td>
                                                  <?php } ?>
												</tr>
								  <?php } ?>
								
							</tbody>
						</table>
                       
                  
                        </div>
                        
                    
                     </div> 
                     <div class="curve_btn green_btn text-right">
                        <!-- <input type="submit" name="odifsubmit" class="btn-lg" value="Update"> -->
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
<input type="hidden" id="sum_total_activity" name="sum_total_activity" value="<?php echo $sum_total_activity; ?>" />
<input type="hidden" id="total_complete_activity" name="total_complete_activity" value="<?php echo $total_complete_activity;?>" />

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="post" action="<?php echo base_url()?>/wbs_list/share_odif">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
          <h4 class="modal-title" id="myModalLabel">Share ODIF Report</h4>
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
