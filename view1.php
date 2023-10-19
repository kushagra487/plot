<table width="100%" border="0">
<tbody>
<?php
include("connection.php");
function checkParentIds($id, &$data) {
	
    $parent = mysql_query("SELECT parent_activity_id FROM activity WHERE activity_id = '$id'");
    $parent_query = mysql_fetch_assoc($parent);
    if ($parent_query['parent_activity_id'] > 0) {
		   $data[] = $parent_query['parent_activity_id'];
			checkParentIds($parent_query['parent_activity_id'], $data);
		
    } 
 return array($data);   
}

function tree_process($id,$mp_id ,$indent=1) {

	
    echo $query = "SELECT * FROM `process` WHERE parent_processid= '".$id."' AND mp_id='".$mp_id."'";
    $result = mysql_query($query);
    //if (mysql_num_rows($result) != 0) {
		
	$sql_depth="SELECT count(distinct(p.`parent_processid`)) as count FROM `process` p WHERE p.project_id='91' ORDER BY `p`.`parent_processid` ASC "; 	
	$res_depth= mysql_query($sql_depth);
	$result_depth=mysql_fetch_row($res_depth);
	//print_r($result_depth);
		
	$sql_depth_activity="select count(distinct(a.parent_activity_id)) as cnt from  activity a WHERE a.project_id='91'"; 
	$res_depth_activity= mysql_query($sql_depth_activity);
	$result_depth_activity=mysql_fetch_row($res_depth_activity);
	
	$act1='';
	$depth_td='';
	//echo "<br>aaaa--->".$depth_td;die;
     while ($row = mysql_fetch_array($result)) {
		 
		
		$activity_td=tree_activity($id,$indent,$row['pid']);
		
		  echo "<tr>";
		 for($i=0;$i<$indent;$i++) {
			echo "<td size='10' >&nbsp;</td>";
		 }
         echo "<td><input type='textbox'  size='10' readonly value='" . $row['process_name'] . "'></td>";
		 //echo "<br>".$result_depth[0] ."-->indent-->".$indent;
		 for($i=0;$i<=$result_depth[0]+1-$indent;$i++) {
				 
			echo "<td><input type='textbox'  size='10' readonly 
			value=''></td>";	 
			 }
		 echo "".$depth_td.$activity_td."</tr>";
		  tree_process($row['pid'],$mp_id, $indent + 1);
		
		 }
		 
		 
		 
			
			
    }
	
	



function tree_activity($id,$indent=1,$pid) {
	
	
	$sql_depth="SELECT count(distinct(p.`parent_processid`)) as count FROM `process` p WHERE p.project_id='91' ORDER BY `p`.`parent_processid` ASC "; 	
	$res_depth= mysql_query($sql_depth);
	$result_depth=mysql_fetch_row($res_depth);
	//print_r($result_depth);
		
	$sql_depth_activity="select count(distinct(a.parent_activity_id)) as cnt from  activity a WHERE a.project_id='91'"; 
	$res_depth_activity= mysql_query($sql_depth_activity);
	$result_depth_activity=mysql_fetch_row($res_depth_activity);
	
	$act1='';
	$depth_td='';
$activity_td='';
  echo $query = "SELECT * FROM `activity` WHERE parent_activity_id= '".$id."' and process_id='".$pid."'  AND project_id=91";
    $result = mysql_query($query);
    if (mysql_num_rows($result) != 0) {
   
     while ($row = mysql_fetch_array($result)) {
		
		 for($i=0;$i<$indent;$i++) {
			$activity_td.="<td>&nbsp;</td>";
		 }
		$activity_td.="<td><input type='textbox' readonly value='" . $row['activity_name'] . "'></td>";
         tree_activity($row['activity_id'],$indent + 1,$pid);
		
		//echo $indent."";
	
     }
     //echo "</tr>";
	
    }
return $activity_td;
}

//echo tree_activity(0,2);

//tree(0,1,2);

//die;
$sql_mp="SELECT * FROM mega_process where project_id=91";
$res_mp=mysql_query($sql_mp);

while($result=mysql_fetch_object($res_mp)){
	
$sql_process="SELECT * FROM process WHERE mp_id='".$result->mp_id."'";
$res_process=mysql_query($sql_process);
	
?>
 <tr>
      <td><input type="text" readonly value="<?php echo $result->mp_name?>"></td>
      
</tr>
      
<?php
echo tree_process(0,$result->mp_id,2);

}
?>
</tbody>
</table>