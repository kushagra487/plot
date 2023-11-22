<?php
include("connection.php");
function fetch_children($parent,$process_id) {
	

  $result = mysql_query('SELECT * FROM activity WHERE parent_activity_id = "'.(int)$parent.'" AND process_id="'.$process_id.'"' );
  $list = array();
  while($row = mysql_fetch_assoc($result)) {

    $list[] = (int)$row['activity_id'];


    $list = array_merge($list, fetch_children($row['activity_id'],$process_id));
  }
  return $list;
}

$children_ids = fetch_children(0,$pid);



print_r($children_ids);



<select class='form-control' tabindex='-1' name='responsibilities[]'>
                                          <option value=''>Select </option>  
											<?php
                                            foreach($tm_details as $key => $value){
                                            ?>
                                            <option value='<?php echo $value['tm_list']; ?>'><?php echo $value['tm_list']; ?></option>
                                            <?php
                                            }
                                            ?>
                                            
                                            <?php
                                            foreach($pm_details as $key => $value){
                                            ?>
                                            <option value='<?php echo $value['tm_list']; ?>'><?php echo $value['tm_list']; ?></option>
                                            <?php
                                            }
                                            ?>
                                            
										</select>


			

?>