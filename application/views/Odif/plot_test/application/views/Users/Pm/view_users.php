<!-- page content -->
<div class="right_col" role="main">
	<div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
            <h2 class="page_title">Members List</h2>
				<div class="x_panel">
				   <ul class="text-right list-unstyled">
                   
							<li>
                              <form name="f1" method="post" class="pull-left col-md-4 col-sm-6" style="padding:0;"> <div class="">
                        <div id="custom-search-input">
                            <div class="input-group col-md-12">
                                <input type="text" name="uname" class="  search-query form-control" placeholder="Search" />
                                <span class="input-group-btn">
                                    <button class="btn btn-danger" type="submit" value="Search" class="form-control" value="<?php echo $_POST['uname']?>">
                                        <span class=" glyphicon glyphicon-search"></span>
                                    </button>
                                </span>
                            </div>
                        </div>
                        </div></form>
                        
                            
                            <a class="btn btn-success btn-sm" href="<?= base_url();?>add_users" title="add" id="add_member">Add User</a></li>
					</ul>
					<div class="x_content">
						<table id="datatable-responsive" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>S. No.</th>
									<th>User ID</th>
									<th>Name</th>
									<!--<th>Password</th>-->
									<th>Image</th>
									<th>User's Role</th>
									<th>Designation</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody class="drag_drop">
								<?php 
									$i = 1;
									foreach($details as $key => $value){
										$img = base_url().'user_uploads/'.$value['image'];
										if($value['role'] == 'Team Member'){
											?>
											<tr>
												<td><?php echo $i;?></td>
												<td><?php echo $value['user_id'];?></td>
												<td><?php echo $value['name'];?></td>
												<!--<td><?php echo $value['password'];?></td>-->
												<td><?php echo '<img src="'.$img.'" style="width:50px; " >'; ?></td>
												<td><?php echo $value['role'];?></td>
												<td><?php echo $value['designation'];?></td>
												<td>
													<a href="<?= base_url();?>add_users/edit_users/<?php echo $value['id']; ?>/" title="edit">Edit</a>
													
												</td>
											</tr>
											<?php
											$i++;
										}
									}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /page content -->