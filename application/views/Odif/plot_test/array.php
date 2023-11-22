<table width="100%" border="0">
<tbody>
<?php
include("connection.php");
$handle = fopen("excel2.csv", "r");
$i=0;
function tree_process($id,$indent=1) {

	
    $query = "SELECT * FROM `process` WHERE parent_processid= '".$id."'";
    $result = mysql_query($query);
    //if (mysql_num_rows($result) != 0) {
		
	$sql_depth="SELECT count(distinct(p.`parent_processid`)) as count FROM `process` p INNER JOIN `process` p1 ON p.pid=p1.parent_processid INNER JOIN mega_process mp ON mp.mp_id=p.mp_id  ORDER BY `p`.`parent_processid` ASC "; 	
	$res_depth= mysql_query($sql_depth);
	$result_depth=mysql_fetch_row($res_depth);
	//print_r($result_depth);
	$depth_td='';
   
	//echo "<br>aaaa--->".$depth_td;die;
     while ($row = mysql_fetch_array($result)) {
		
		 
         if ($indent ==1){
             echo "<tr><td><input type='textbox' readonly value='" . $row['process_name'] . "'></td>";
			 
			 for($i=0;$i<$result_depth[0];$i++) {
				 
			echo "<td>&nbsp;</td>";	 
			 }
			 
			 echo "</tr>";
			 }
         else
		echo "<br>".$row['process_name'] ."-->indent-->".$indent;
		 echo "<tr>";
		 for($i=1;$i<=$indent;$i++) {
			echo "<td>&nbsp;</td>";
		 }
         echo "<td><input type='textbox' readonly value='" . $row['process_name'] . "'></td>";
		 
		 for($i=0;$i<=$result_depth[0]-$indent;$i++) {
				 
			echo "<td>xccxcx&nbsp;</td>";	 
			 }
			 
			 echo "</tr>";
		 
         tree_process($row['pid'],$indent + 1);
		 
	
     //}
     //echo "</tr>";
	
    }

}

echo tree_process(0,2);die;



function findmykey($array,$key,$position,$upto){
	$values=array();
	for($i=0;$i<$upto;$i++){

	foreach($array[$i][$key] as $value){
		
		if($array[$i][$key][$position]!=''){
		echo array_push($values,$array[$i][$key][$position]);
		break;
		}
	}
	
}	
return $values;	
}


function array_combine_new($keys, $values){
    $result = array();

    foreach ($keys as $i => $k) {
	
     $result[$k][] = $values[$i];
     }

    array_walk($result, function(&$v){
     $v = (count($v) == 1) ? array_pop($v): $v;
     });

    return $result;
}
$header = null;
while ($row = fgetcsv($handle)) {
	//print_r($row);
    if ($header === null) {
        $header = $row;
        continue;
    }

	//$all_rows[]= array_map('foo', $header, $row);	
   $all_rows[] = array_combine_new($header, $row);
}

for($i=0;$i<count($all_rows);$i++){

//$all_rows[$i]['Mega Process'];
if($all_rows[$i]['Mega Process']!=''){
	$sql_ins="INSERT INTO mega_process (mp_name,project_id) VALUES ('".$all_rows[$i]['Mega Process']."','')";	 
	mysql_query( $sql_ins); 
	$autoid_mp=mysql_insert_id();		
}



foreach($all_rows[$i]['Process'] as $key => $value){
	if($value!=''){
	//echo "<br>The value is-->".$value;
	if($key==0){
	$sql_ins="INSERT INTO process (mp_id,process_name,parent_processid) VALUES ('".$autoid_mp."','".$value."','')";	
	mysql_query( $sql_ins); 
	$autoid_process=mysql_insert_id();
	}
	else{
		$sql_ins="INSERT INTO process (mp_id,process_name,parent_processid) VALUES ('".$autoid_mp."','".$value."','')";	
	  mysql_query( $sql_ins); 
	  $autoid_process=mysql_insert_id();
		$values=findmykey($all_rows,'Process',$key-1,$i);
		$parent_value=end($values);
		
		$sql="select pid from process WHERE process_name='".$parent_value."' ORDER BY pid DESC LIMIT 1";
		$res=mysql_query($sql);
		$result=mysql_fetch_row($res);
		
		$sql_update_parent="UPDATE process SET parent_processid='".$result[0]."' WHERE pid='".$autoid_process."'";
		$res_update_parent=mysql_query($sql_update_parent);
		
		
	}
	}
}

foreach($all_rows[$i]['Activity'] as $key => $value){
	if($value!=''){
	//echo "<br>The value is-->".$value;
	if($key==0){
	$sql_ins="INSERT INTO activity (activity_name,process_id,start_date,finish_date,assigned_person,dependent_on,resources) VALUES ('".$value."','".$autoid_process."','".$all_rows[$i]['Start Date']."','".$all_rows[$i]['Finish Date']."','".$all_rows[$i]['Assigned Person']."','','')";	
	mysql_query( $sql_ins); 
	}
	else{
		$sql_ins="INSERT INTO activity (activity_name,process_id,start_date,finish_date,assigned_person,dependent_on,parent_activity_id,resources) VALUES ('".$value."','".$autoid_process."','".$all_rows[$i]['Start Date']."','".$all_rows[$i]['Finish Date']."','','".$all_rows[$i]['Assigned Person']."','','')";	
	  mysql_query( $sql_ins); 
	  $autoid_activity=mysql_insert_id();
		$values=findmykey($all_rows,'Activity',$key-1,$i);
		$parent_value_activity=end($values);
		
		$sql="select activity_id from activity WHERE activity_name='".$parent_value_activity."' ORDER BY activity_id DESC LIMIT 1";
		$res=mysql_query($sql);
		$result=mysql_fetch_row($res);
		
		$sql_update_parent="UPDATE activity SET parent_activity_id='".$result[0]."' WHERE activity_id='".$autoid_activity."'";
		$res_update_parent=mysql_query($sql_update_parent);
		
		
	}
	}
}


}































function tree_process($id,$mp_id ,$indent=1) {

	
    $query = "SELECT * FROM `process` WHERE parent_processid= '".$id."' AND mp_id='".$mp_id."'";
    $result_process = mysql_query($query);
    //if (mysql_num_rows($result) != 0) {
		
	$sql_depth="SELECT count(distinct(p.`parent_processid`)) as count FROM `process` p INNER JOIN `process` p1 ON p.pid=p1.parent_processid INNER JOIN mega_process mp ON mp.mp_id=p.mp_id  ORDER BY `p`.`parent_processid` ASC "; 	
	$res_depth= $this->db->query($sql_depth);
	$result_depth=$res_depth->row();
     foreach ($result_process->result_array() as $row) {
		
		  $query_activity = "SELECT * FROM `activity` WHERE process_id= '".$row['pid']."'";
    	  $this->db->query($query_activity);
		  if ($result_activity->num_rows() !=0) {
    		foreach ($result_activity->result_array() as $row_activity) {
			
			
			$data = array();	
			$levels=checkParentIds($row_activity['activity_id'],$data);
		/*	echo "<br>-->Depth-->". $result_depth[0]."<br>";*/
			//echo "<br>".$row_activity['activity_name']."-->aaa-->". count($data)."<br>";
			
			 for($i=0;$i<count($data);$i++){
				$depth_td.="<td><input type='textbox' readonly value=''></td>";   
    		}
	
			$activity_td="".$depth_td."<td><input type='textbox' readonly 
			value='" . $row_activity['activity_name'] . "'></td>";	
				
			}
			
		  }
		  else {
			$activity_td="";  
			$depth_td='';
		  }
		$depth_td='';
         if ($indent ==1){
             echo "<tr><td><input type='textbox' readonly value='" . $row['process_name'] . "'></td>".$activity_td."";
			 
			  for($i=0;$i<$result_depth[0];$i++) {
				 
			echo "<td><input type='textbox' readonly 
			value=''></td>";	 
			 }
			 
			 echo "".$activity_td."</tr>";
			 
			 }
         else
		//echo "<br>".$row['process_name'] ."-->indent-->".$indent;
		 echo "<tr>";
		 for($i=1;$i<=$indent;$i++) {
			echo "<td>&nbsp;</td>";
		 }
         echo "<td><input type='textbox' readonly value='" . $row['process_name'] . "'></td>";
		 
		 for($i=0;$i<=$result_depth[0]-$indent;$i++) {
				 
			echo "<td><input type='textbox' readonly 
			value=''></td>";	 
			 }
		  echo "".$activity_td."</tr>";
         tree_process($row['pid'],$mp_id, $indent + 1);
		 
	
     //}
     //echo "</tr>";
	
    }

}



































	
$query = "SELECT * FROM `process` WHERE parent_processid= '".$id."' AND mp_id='".$mp_id."'";
    $result_process = $this->db->query($query);
    //if (mysql_num_rows($result) != 0) {
		
	$sql_depth="SELECT count(distinct(p.`parent_processid`)) as count FROM `process` p INNER JOIN `process` p1 ON p.pid=p1.parent_processid INNER JOIN mega_process mp ON mp.mp_id=p.mp_id  ORDER BY `p`.`parent_processid` ASC "; 	
	$res_depth= $this->db->query($sql_depth);
	$result_depth=$res_depth->row();
	
	
     foreach ($result_process->result_array() as $row) {
		 
		
		
		  $query_activity = "SELECT * FROM `activity` WHERE process_id= '".$row['pid']."'";
    	  $result_activity=$this->db->query($query_activity);
		  if ($result_activity->num_rows() !=0) {
    		foreach ($result_activity->result_array() as $row_activity) {
			
			
			$data = array();	
			$levels= $this->checkParentIds($row_activity['activity_id'],$data);
			echo "<br>-->Depth-->". $result_depth[0]."<br>";
			echo "<br>".$row_activity['activity_name']."-->aaa-->". count($data)."<br>";
			
			 for($i=0;$i<count($data);$i++){
				$depth_td.="<td><input type='textbox' readonly value=''></td>";   
    		}
	
			$activity_td="".$depth_td."<td><input type='textbox' readonly 
			value='" . $row_activity['activity_name'] . "'></td>";	
				
			}
			
		  }
		  else {
			$activity_td="";  
			$depth_td='';
		  }
		$depth_td='';
         if ($indent ==1){
             echo "<tr><td><input type='textbox' readonly value='" . $row['process_name'] . "'></td>".$activity_td."";
			 
			  for($i=0;$i<$result_depth->count;$i++) {
				 
			echo "<td><input type='textbox' readonly 
			value=''></td>";	 
			 }
			 
			 echo "".$activity_td."</tr>";
			 
			 }
         else
		//echo "<br>".$row['process_name'] ."-->indent-->".$indent;
		 echo "<tr>";
		 for($i=1;$i<=$indent;$i++) {
			echo "<td>&nbsp;</td>";
		 }
         echo "<td><input type='textbox' readonly value='" . $row['process_name'] . "'></td>";
		 
		 for($i=0;$i<=$result_depth->count-$indent;$i++) {
				 
			echo "<td><input type='textbox' readonly 
			value=''></td>";	 
			 }
		  echo "".$activity_td."</tr>";
		  
		  print_r($row);
         $this->tree_process($row['pid'],$mp_id, $indent + 1);
		 
	
     //}
     //echo "</tr>";
	
    }





?>
