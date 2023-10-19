<?php
class Wbs_list_model extends CI_Model{

	public function findmykey($array,$key,$position,$upto){

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

	public function findmykey1($array,$key,$upto){

		

		//echo "<br>upto-->".$upto;

		$values=array();

		for($i=0;$i<$upto;$i++){

	

			//echo "PValue--->".$array[$i][$key];

				if($array[$i][$key]!=''){

				array_push($values,$array[$i][$key]);

				break;

				}

		

		

		}	

		return $values;	

	}

	

	

	function findme($array1,$upto)	{	

	

		$values=array();

		for($i=0;$i<=$upto;$i++){

		//print_r($array);

		if($array1[$i]!=''){

		array_push($values,$array1[$i]);

		

		}



	}

	return $values;	

	}

	

	public function array_combine_new($keys, $values){

    $result = array();

	

	//print_r($keys);

	//print_r($values);



    foreach ($keys as $i => $k) {

	

     $result[$k][] = $values[$i];

     }



    array_walk($result, function(&$v){

     $v = (count($v) == 1) ? array_pop($v): $v;

     });



    return $result;

	

	//print_r($result);

	}

	

	public function checkParentIds($id, &$data) {

	

	//echo "SELECT parent_activity_id FROM activity WHERE activity_id = '$id'";

    $parent = $this->db->query("SELECT parent_activity_id FROM activity WHERE activity_id = '$id'  AND status=0");

    $parent_query =$parent->row();

	

	//print_r($parent_query);

	//echo $parent_query->parent_activity_id

    if ($parent_query->parent_activity_id > 0) {

		//$data = array();

        $data[] = $parent_query->parent_activity_id;

		

		//print_r($data);

       $this->checkParentIds($parent_query->parent_activity_id, $data);

		

    } 

 	return array($data);   

	}

	

	

	public function fetch_children($parent,$process_id) {

	$result=array();

	

	if($_POST['responsilbe_person']!=''){

		$rp_query="AND assigned_person='".$_POST['responsilbe_person']."'";	

	}

	

	if($_POST['start_date_activity']!=''){

		$rp_query1="AND start_date='".$_POST['start_date_activity']."'";	

	}

	

	if($_POST['end_date_activity']!=''){

		$rp_query2="AND finish_date='".$_POST['end_date_activity']."'";	

	}

	

	

	/*if(isset($_POST['activity_filter']) && $_POST['activity_filter']!='')

	{

	     $filter_value= $this->input->post('activity_filter');

		 $date=explode('-',$filter_value);//print_r($date);exit;

		 $start_date=$date[0];//var_dump($start_date);

		 $finish_date=$date[1];//echo $start_date.' '.$finish_date;exit;

		 

	     $result = $this->db->query('SELECT * FROM activity WHERE parent_activity_id =

		 "'.(int)$parent.'" AND process_id="'.$process_id.'" AND status=0 AND STR_TO_DATE(start_date,"%d/%m/%Y") >= STR_TO_DATE("'.$start_date.'","%d/%m/%Y") AND STR_TO_DATE(finish_date,"%d/%m/%Y") <= STR_TO_DATE("'.$finish_date.'","%d/%m/%Y") '.$rp_query.'');

          echo "<br>".$this->db->last_query();	    

		//print_r($result->result_array());

	}

	else

	{*/

	

	$result = $this->db->query('SELECT * FROM activity WHERE parent_activity_id = "'.(int)$parent.'" AND process_id="'.$process_id.'" AND status=0 '.$rp_query.' '.$rp_query1.' '.$rp_query2.'' );

	/*}*/

	$list = array();

  

 

	foreach ($result->result_array() as $row) {

 

    $list[] = (int)$row['activity_id'];





    $list = array_merge($list, $this->fetch_children($row['activity_id'],$process_id));

	}

  

  

   //print_r($list);

  return $list;

}

	

	

	public function tree_process($id,$mp_id ,$indent=1,$projectid) {

		

	//print_r($_POST);

	if($_POST['search_process']!=''){

		$query_append1="AND pid ='".$_POST['search_process']."'";		

	}

	if($_POST['responsilbe_person']!=''){

		$rp_query="AND assigned_person='".$_POST['responsilbe_person']."'";	

	}

	

	if($_POST['start_date_activity']!=''){

		$rp_query1="AND start_date='".$_POST['start_date_activity']."'";	

	}

	

	if($_POST['end_date_activity']!=''){

		$rp_query2="AND finish_date='".$_POST['end_date_activity']."'";	

	}

	

	

	

	$query = "SELECT * FROM `process` WHERE parent_processid= '".$id."' AND mp_id='".$mp_id."'  AND status=0  ".$query_append1."";

    $result_process = $this->db->query($query);

		//print_r($_POST);

	$tm_details = $this->wbs_model->get_assiged_tm_details($projectid);

	$pm_details = $this->wbs_model->get_assiged_pm_details($projectid);

	  

	 $sql_depth="SELECT process_columns, activity_columns FROM project_name WHERE project_id='".$this->uri->segment('3')."'"; 	

	$res_depth= $this->db->query($sql_depth);

	$result_depth=$res_depth->row();

	$result_depth_process=$result_depth->process_columns;

	$result_depth_activity=$result_depth->activity_columns;

	

	$activity_td1="";  

	$activity_td2="";  

	$activity_td3="";  

	$loop_prccess=0;	

     foreach ($result_process->result_array() as $row_process) {

		 

		 

		  echo "<tr class='first'><td>".$row_process['unique_code']."</td>";

		  for($i=0;$i<$indent;$i++) {

			echo "<td><textarea  class='mpr' readonly></textarea></td></td>";

		  }

          echo "<td><textarea class='pr' readonly>";

		// if($row_activity['parent_activity_id']==0) { 

		  echo $row_process['process_name']; 

		// } 

		// else { echo "dffdfdf"; }

		 

		echo "</textarea></td>";

		 

		 for($i=0;$i<$result_depth_process-$indent;$i++) {

				 

			echo "<td><textarea readonly></textarea></td>";	 

		}

			 

			 for($i=0;$i<$result_depth_activity;$i++){

				echo "<td><textarea readonly></textarea></td>";   

    		}

			

			

		  echo "<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";

		  

		 //echo "<br>aaa-->".$row_process['pid'];

		 $children_ids = $this->fetch_children(0,$row_process['pid']);

		 

		

		if(count($children_ids) >0) {

			//for($mi=0;$mi<count($children_ids);$mi++){

			

		$aids=implode(",",$children_ids);

		

		  $query_activity = "SELECT * FROM `activity` WHERE activity_id IN ( ".$aids." ) AND status=0 ".$rp_query." ".$rp_query1." ".$rp_query2." ";

		  

		 /* }*/

		  

    	  $result_activity=$this->db->query($query_activity);

		 

		  if ($result_activity->num_rows() !=0) {

    		foreach ($result_activity->result_array() as $row_activity) {

			$current_date=date("d/m/Y");

			if($current_date==$row_activity['finish_date']){

			$color="danger";	

			}

			else{

			$color='';	

			}

			

			$data = array();	

			$levels= $this->checkParentIds($row_activity['activity_id'],$data);

			//echo "<br>-->Depth-->". $result_depth[0]."<br>";

			//echo "<br>".$row_activity['activity_name']."-->aaa-->". count($data)."<br>";

			echo "<tr class='".$color."'><td>".$row_activity['unique_code']."</td><td></td>";

			

			for($i=0;$i<$result_depth_process;$i++){

				echo "<td><textarea class='pr' readonly></textarea></td>";   

    		}

			

			 for($i=0;$i<count($data);$i++){

				echo "<td><textarea readonly></textarea></td>";   

    		}

	

			echo "<td><textarea readonly class='activity_area'>" . $row_activity['activity_name'] . "</textarea></td>";

			

			//echo "<br>aaa-->".$result_depth_activity;

			//echo "<br>bbb-->".count($data);

			

			 for($i=0;$i<$result_depth_activity-count($data)-1;$i++){

				echo "<td><textarea readonly></textarea></td>";   

    		}

			

			echo "<td><textarea readonly>" . $row_activity['planned_quantity'] . "</textarea></td>
			
			<td><textarea readonly>" . $row_activity['temp_actual_quantity'] . "</textarea></td>
			
			<td><textarea readonly>" . $row_activity['start_date'] . "</textarea></td>

			<td><textarea readonly>" . $row_activity['finish_date'] . "</textarea> </td>

			<td><textarea readonly class='assign_person'>" . $row_activity['assigned_person'] . "</textarea></td>

			<td><textarea readonly>".$row_activity['resources']."</textarea></td>

			<td><textarea readonly>".$row_activity['dependent_on']."</textarea></td>

			<td><textarea readonly>".$row_activity['template_reference']."</textarea></td>";

			if($row_activity['template_document']!='') { 

			

			$ext = strtolower(pathinfo($row_activity['template_document'], PATHINFO_EXTENSION));

			

			if($ext=="png" || $ext=="jpg" || $ext=="gif" || $ext=="jpeg"){

				$file_class="fa-file-image-o";	

			}else if($ext=="pdf"){

				$file_class="fa-file-pdf-o";	

			}else if($ext=="xlsx" || $ext=="xls" || $ext=="csv"){

				$file_class="fa-file-excel-o";	

			}else if($ext=="doc" || $ext=="docx"){

				$file_class="fa-file-word-o";		

			}else{

				$file_class="fa-file";		

			}

			

			

			echo "<td><input type='hidden' name='previous_document[]' value=''><a href='".base_url()."template_document/".$row_activity['project_id']."/".$row_activity['template_document']."' target='_blank' style='display:block'><i class='fa ".$file_class." fa-6' aria-hidden='true' style='display:block'></i><span> ".$row_activity['template_document']."</span></a>

				</a>

			

			</td>  ";

			}else {

			echo "<td>&nbsp;</td>";

			}

			

			echo "<td><textarea readonly>". $row_activity['activity_status'] . "</textarea></td>

			

			</tr>";

					

		  

		 // $row_process['process_name']='';

		

		 	$row_activity['activity_name']='';		

			}

			

			

			

		  }	

	

		

		//}

		

		}else{

		

		

		 $query_activity = "SELECT * FROM `activity` WHERE process_id= '".$row_process['pid']."'  AND status=0 ".$rp_query." ".$rp_query1." ".$rp_query2."";

		/*  }*/

    	  $result_activity=$this->db->query($query_activity);

		 

		  if ($result_activity->num_rows() !=0) {

    		foreach ($result_activity->result_array() as $row_activity) {

			

			$current_date=date("d/m/Y");

			if($current_date==$row_activity['finish_date']){

			$color="danger";	

			}

			else{

			$color='';	

			}

			$data = array();	

			//$levels= $this->checkParentIds($row_activity['activity_id'],$data);

			//echo "<br>-->Depth-->". $result_depth[0]."<br>";

			//echo "<br>".$row_activity['activity_name']."-->aaa-->". count($data)."<br>";

			

			 echo "<tr class='".$color."'><td>".$row_activity['unique_code']."</td><td></td>";

			

			for($i=0;$i<$result_depth_process;$i++){

				echo "<td><textarea class='pr' readonly></textarea></td>";   

    		}

			

			 for($i=0;$i<count($data);$i++){

				echo "<td><textarea readonly></textarea></td>";   

    		}

	

			echo "<td><textarea readonly class='activity_area'>" . $row_activity['activity_name'] . "</textarea></td>";

			

			 for($i=0;$i<$result_depth_activity-count($data)-1;$i++){

				echo "<td><textarea></textarea></td>";   

    		}

			

			echo "<td><textarea readonly>" . $row_activity['planned_quantity'] . "</textarea></td>
			
			<td><textarea readonly>" . $row_activity['actually_quantity'] . "</textarea></td>
			
			<td><textarea readonly>" . $row_activity['start_date'] . "</textarea></td>

			<td><textarea readonly>" . $row_activity['finish_date'] . "</textarea> </td>

			<td><textarea readonly class='assign_person'>" . $row_activity['assigned_person'] . "</textarea></td>

			<td><textarea readonly>" . $row_activity['resources'] . "</textarea></td>

			<td><textarea readonly>" . $row_activity['dependent_on'] . "</textarea></td>

			<td><textarea readonly>" . $row_activity['template_reference'] . "</textarea></td>";

			if($row_activity['template_document']!='') { 

			

			$ext = strtolower(pathinfo($row_activity['template_document'], PATHINFO_EXTENSION));

			

			if($ext=="png" || $ext=="jpg" || $ext=="gif" || $ext=="jpeg"){

				$file_class="fa-file-image-o";	

			}else if($ext=="pdf"){

				$file_class="fa-file-pdf-o";	

			}else if($ext=="xlsx" || $ext=="xls" || $ext=="csv"){

				$file_class="fa-file-excel-o";	

			}else if($ext=="doc" || $ext=="docx"){

				$file_class="fa-file-word-o";		

			}else{

				$file_class="fa-file";		

			}

			

			

			

			echo "<td><a href='".base_url()."template_document/".$row_activity['project_id']."/".$row_activity['template_document']."' target='_blank'><i class='fa ".$file_class." fa-6' aria-hidden='true' style='display:block'></i> <span style='display:block'>".$row_activity['template_document']."</span></a>

			

			</td>";

			}else {

			echo "<td>&nbsp;</td>";

			}

			

			echo "<td><textarea readonly>". $row_activity['activity_status'] . "</textarea></td>

			

			</tr>";		  

		  

			}

			

			

			

		  }	

		  

		  else {

		  

		  

		  }

		 		

			

			

			

		}

		

         $this->tree_process($row_process['pid'],$mp_id, $indent + 1,$projectid);

	

	

    }

}





public function find_value_from_array($key,$array){

	$my_value='';

	

	//print_r($array);

	foreach($array as $my_array){

	

		if($my_array[$key]!=""){

		 $my_value= $my_array[$key];

		 break;

		}

}

	return $my_value;

}	



//------------------------Edit all node in treee--------------------------

public function tree_process_edit($id,$mp_id ,$indent=1,$projectid) {

	if($_POST['search_process']!=''){
		$query_append1="AND pid ='".$_POST['search_process']."'";		
	}

	if($_POST['start_date_activity']!=''){

		$rp_query1="AND start_date='".$_POST['start_date_activity']."'";	

	}

	if($_POST['end_date_activity']!=''){



		$rp_query2="AND finish_date='".$_POST['end_date_activity']."'";	



	}

	if($_POST['responsilbe_person']!=''){
		$rp_query="AND assigned_person='".$_POST['responsilbe_person']."'";	

	}


	$query = "SELECT * FROM `process` WHERE parent_processid= '".$id."' AND mp_id='".$mp_id."' AND project_id='".$projectid."'  AND status=0 ".$query_append1."";

    $result_process = $this->db->query($query);

	$tm_details = $this->wbs_model->get_assiged_tm_details($projectid);

	$pm_details = $this->wbs_model->get_assiged_pm_details($projectid);

	$sql_depth="SELECT process_columns, activity_columns  FROM project_name  WHERE 
	 project_id='".$this->uri->segment('3')."'"; 	

	$res_depth= $this->db->query($sql_depth);


	$result_depth=$res_depth->row();



	$result_depth_process=$result_depth->process_columns;



	$result_depth_activity=$result_depth->activity_columns;



	



	$activity_td1="";  



	$activity_td2="";  



	$activity_td3="";  



	$loop_prccess=0;	



	$file_counter=1;



	//print_r($data);



     foreach ($result_process->result_array() as $row_process) {



		 



		 



		  echo "<tr><td>".$row_process['unique_code']."</td>";



		 for($i=0;$i<$indent;$i++) {



			 if($i==0){$row_inser="<div class='mtn_togg icono'><span class='toggle_insert'><i class='fa fa-angle-right'></i></span>



                                    <span class='hover_toggle'><small class='insert_row mp'>Insert</small><small class='delete_row'>Delete</small></span></div>"; }



			else { $row_inser='';}



			echo "<td><textarea  class='mpr' autocomplete='off' autocorrect='off' autocapitalize='off' spellcheck='false' ></textarea>".$row_inser."  



			



			</td>";



		 }



         echo "



		 <td><textarea class='pr' autocomplete='off' autocorrect='off' autocapitalize='off' spellcheck='false'>";



		 /*if($row_activity['parent_activity_id']==0) 



		 {*/ 



		 



		 echo $row_process['process_name']; 



		 



		// } 



		// else { echo ""; }



		 



		echo "</textarea></td>";



		 



		 for($i=0;$i<$result_depth_process-$indent;$i++) {



				 



			echo "<td><textarea autocomplete='off' autocorrect='off' autocapitalize='off' spellcheck='false' ></textarea></td>";	 



			 }



	 for($i=0;$i<$result_depth_activity;$i++){



				echo "<td class='disableChild'><textarea  class='activity_area' autocomplete='off' autocorrect='off' autocapitalize='off' spellcheck='false'></textarea></td>";   



    		}




			



			



		  echo "<td><input value='' name='planned_quantity[]'></td>

                <td><input value='' name='actually_quantity[]'></td>

		  <td>	<input value='' placeholder='dd/mm/YYYY'  class='stdate' name='start_date[]' type='text'></td>



           <td>	<input value='' placeholder='dd/mm/YYYY'  class='endate' name='end_date[]' type='text'></td>



           <td><select class='form-control assign_person' tabindex='-1' name='responsibilities[]'>



             <option value=''>Select </option>";  



			 foreach($tm_details as $key => $value){



			if($row_activity['assigned_person']==$value['tm_list'])	{


			$selected="selected";	



			}



			else{



			$selected="";	



			}



			echo "<option value=".$value['tm_list']." ".$selected.">".$value['tm_list']."</option>";	 



			 }



			



			echo "</select></td>



           <td><input value='' name='resources[]'></td>



           <td><input value='' name='dependency[]'></td>



           <td><input value='' name='template_reference[]'></td>



		    <td><input value='' name='template_document[]' type='file'>



			<input type='hidden' name='previous_document[]' value=''></td>



		   <td>



		   <input type='text' name='activity_status[]' value='".$row_activity['activity_status']."' readonly>



		   



		    <input type='hidden' name='activity_status_modified[]' value='".$row_activity['activity_status_modified']."' readonly>



			 <input type='hidden' name='comments[]' value='".$row_activity['comments']."' readonly>



		  </td> 



		  



		  </tr>";



		  



		 



		 $children_ids = $this->fetch_children(0,$row_process['pid']);



		 



		// print_r($children_ids);



		if(count($children_ids)>0) { 	



			for($mi=0;$mi<count($children_ids);$mi++){ 



		$query_activity = "SELECT *,activity_id as myid,(SELECT GROUP_CONCAT(unique_code) FROM activity WHERE status=0 AND project_id='".$projectid."'  AND activity_id < '".$children_ids[$mi]."') uniquecode FROM `activity` WHERE activity_id= '".$children_ids[$mi]."' AND project_id='".$projectid."' AND status=0 ".$rp_query." ".$rp_query1." ".$rp_query2."";



		/* }*/



    	  $result_activity=$this->db->query($query_activity);

		  if ($result_activity->num_rows() !=0) {

    		foreach ($result_activity->result_array() as $row_activity) {

			
			$uniquecode =explode(",",$row_activity['uniquecode']);
			$uniquecode =array_filter($uniquecode, create_function('$value', 'return $value !== "";'));
			//print_r($uniquecode);

			$current_date=date("d/m/Y");



			if($current_date==$row_activity['finish_date']){



			$color="danger";	



			}



			else{



			$color='';	



			}



			



			$data = array();	



			$levels= $this->checkParentIds($row_activity['activity_id'],$data);



			//echo "<br>-->Depth-->". $result_depth[0]."<br>";



			//echo "<br>".$row_activity['activity_name']."-->aaa-->". count($data)."<br>";



			echo "<tr class='".$color."'><td>".$row_activity['unique_code']."</td><td><textarea  class='mpr'></textarea><div class='mtn_togg icono'><span class='toggle_insert'><i class='fa fa-angle-right'></i></span>



                                    <span class='hover_toggle'><small class='insert_row mp'>Insert</small><small class='delete_row'>Delete</small></span></div></td>";



			



			for($i=0;$i<$result_depth_process;$i++){



			echo "<td><textarea  class='pr' autocomplete='off' autocorrect='off' autocapitalize='off' spellcheck='false' ></textarea></td>";	



				



			}



			



			 for($i=0;$i<count($data);$i++){



				echo "<td><textarea autocomplete='off' autocorrect='off' autocapitalize='off' spellcheck='false' ></textarea></td>";   



    		}



	



			echo "<td><textarea  class='activity_area' autocomplete='off' autocorrect='off' autocapitalize='off' spellcheck='false' >" . $row_activity['activity_name'] . "</textarea></td>";



			



			//echo "<br>aaa-->".$result_depth_activity;



			//echo "<br>bbb-->".count($data);



			



			 for($i=0;$i<$result_depth_activity-count($data)-1;$i++){



				echo "<td><textarea  class='activity_area' autocomplete='off' autocorrect='off' autocapitalize='off' spellcheck='false' ></textarea></td>";   



    		}



			



			echo "<td><input type='text' value='" . $row_activity['planned_quantity'] . "' class=''  name='planned_quantity[]' ></td>
			
			<td><input type='text' value='" . $row_activity['actually_quantity'] . "' class=''  name='actually_quantity[]' ></td>
			
			
			<td><input type='text' value='" . $row_activity['start_date'] . "' class='stdate' placeholder='dd/mm/YYYY'  name='start_date[]' ></td>



			<td><input type='text' value='" . $row_activity['finish_date'] . "' class='endate' name='end_date[]' placeholder='dd/mm/YYYY' ></td>



			<td>



			<select class='form-control assign_person' tabindex='-1' name='responsibilities[]'>



             <option value=''>Select </option>"; 



			 //print_r($tm_details); 



			 foreach($tm_details as $key => $value){



			if($row_activity['assigned_person']==$value['tm_list'])	{



				



			$selected="selected";	



			}



			else{



			$selected="";	



			}



			echo "<option value=".$value['tm_list']." ".$selected.">".$value['tm_list']."</option>";	 



			 }



			 



			  foreach($pm_details as $key => $value){



			if($row_activity['assigned_person']==$value['pm_list'])	{



				



			$selected="selected";	



			}



			else{



			$selected="";	



			}



			echo "<option value=".$value['pm_list']." ".$selected.">".$value['pm_list']."</option>";	 



			 }

			echo "</select></td>



			<td><input type='textbox'  name='resources[]' value='" . $row_activity['resources'] . "'></td>



			<td>



			<select class='form-control' tabindex='-1' name='dependency[]'>



             <option value=''>Select </option>";



			// print_r($unique_code);



			 for($i=0;$i<count($uniquecode);$i++) {



			 if($row_activity['dependent_on']==$uniquecode[$i])	{



				



			$selected="selected";	



			}



			else{



			$selected="";	



			}



				 



			echo "<option value=".$uniquecode[$i]." ".$selected.">".$uniquecode[$i]."</option>";		 



				 



			 }



			 



			 echo "</select> 



			



			</td>



			<td><input type='textbox'  name='template_reference[]' value='" . $row_activity['template_reference'] . "'></td>";



			



			if($row_activity['template_document']!='') { 



			



			$ext = strtolower(pathinfo($row_activity['template_document'], PATHINFO_EXTENSION));



			



			if($ext=="png" || $ext=="jpg" || $ext=="gif" || $ext=="jpeg"){



				$file_class="fa-file-image-o";	



			}else if($ext=="pdf"){



				$file_class="fa-file-pdf-o";	



			}else if($ext=="xlsx" || $ext=="xls" || $ext=="csv"){



				$file_class="fa-file-excel-o";	



			}else if($ext=="doc" || $ext=="docx"){



				$file_class="fa-file-word-o";		



			}else{



				$file_class="fa-file";		



			}



			



			



			echo "<td><span><input type='hidden' name='previous_document[]' value='".$row_activity['template_document']."'>";



			



			echo "<input type='file'  name='template_document[]'><span><a href='".base_url()."template_document/".$row_activity['project_id']."/".$row_activity['template_document']."' target='_blank' style='display:block'><i class='fa ".$file_class." fa-6' aria-hidden='true' style='display:block'></i><span>".$row_activity['template_document']."</span></a>



			<a href='javascript:void(0)' class='del_docu' style='display:block'>



			<i class='fa fa-close' aria-hidden='true' onClick='delet_docu(".$row_activity['activity_id'].")'></i></a>



			</td>";



			}else {



			echo "<td><input type='hidden' name='previous_document[]' value=''>



			<input type='file'  name='template_document[]'></td>";



			}



			$file_counter++;



			echo "<td>



			 <input type='text' name='activity_status[]' value='".$row_activity['activity_status']."' readonly>



			   <input type='hidden' name='activity_status_modified[]' value='".$row_activity['activity_status_modified']."' readonly>



			   <input type='hidden' name='comments[]' value='".$row_activity['comments']."' readonly>



			</td>";



			



			echo "</tr>";	



			



			$row_process['process_name']='';	



			$row_activity['activity_name']='';



			}



			



			



			



		  }	



		 



		}



		}else{

		$query_activity = "SELECT * FROM `activity` WHERE process_id= '".$row_process['pid']."' AND status=0 ".$rp_query." ".$rp_query1." ".$rp_query2."";



		/*  }*/



    	  $result_activity=$this->db->query($query_activity);



		 



		  if ($result_activity->num_rows() !=0) {



    		foreach ($result_activity->result_array() as $row_activity) {
			$uniquecode = $this->wbs_model->get_unique_code($projectid,$row_activity['activity_id']);


			$current_date=date("d/m/Y");



			if($current_date==$row_activity['finish_date']){



			$color="danger";	




			}



			else{



			$color='';	



			}



			$data = array();	

			echo "<tr class='".$color."'><td>".$row_activity['unique_code']."</td><td><textarea  class='mpr'></textarea><div class='mtn_togg icono'><span class='toggle_insert'><i class='fa fa-angle-right'></i></span>



                                    <span class='hover_toggle'><small class='insert_row mp'>Insert</small><small class='delete_row'>Delete</small></span></div></td>";



			



			for($i=0;$i<$result_depth_process;$i++){



			echo "<td><textarea  class='pr' autocomplete='off' autocorrect='off' autocapitalize='off' spellcheck='false' ></textarea></td>";	



				



			}



			



			



			 for($i=0;$i<count($data);$i++){



				echo "<td><textarea autocomplete='off' autocorrect='off' autocapitalize='off' spellcheck='false' ></textarea></td>";   



    		}



	



			echo "<td><textarea class='activity_area' autocomplete='off' autocorrect='off' autocapitalize='off' spellcheck='false' >" . $row_activity['activity_name'] . "</textarea></td>";



			



			//echo "<br>aaa-->".$result_depth_activity;



			//echo "<br>bbb-->".count($data);



			



			 for($i=0;$i<$result_depth_activity-count($data)-1;$i++){



				echo "<td><textarea></textarea></td>";   



    		}



			



			echo "<td>
	<input type='text' value='" . $row_activity['planned_quantity'] . "' name='planned_quantity[]' >
			</td>
			
			<td>
	<input type='text' value='" . $row_activity['actually_quantity'] . "' name='actually_quantity[]' >
			</td>
				
			
			<td>
	<input type='text' placeholder='dd/mm/YYYY' class='stdate'   value='" . $row_activity['start_date'] . "' name='start_date[]' >
			</td>



			<td>
	<input type='text' placeholder='dd/mm/YYYY'  class='endate' value='" . $row_activity['finish_date'] . "' name='end_date[]' >
			</td>



			<td>



			<select class='form-control assign_person' tabindex='-1' name='responsibilities[]'>



             <option value=''>Select </option>";  


			 foreach($tm_details as $key => $value){



			if($row_activity['assigned_person']==$value['tm_list'])	{



				



			$selected="selected";	



			}



			else{



			$selected="";	



			}



			echo "<option value=".$value['tm_list']." ".$selected.">".$value['tm_list']."</option>";	 



			 }



		



		



		  foreach($pm_details as $key => $value){



			if($row_activity['assigned_person']==$value['pm_list'])	{



				



			$selected="selected";	



			}



			else{



			$selected="";	



			}



			echo "<option value=".$value['pm_list']." ".$selected.">".$value['pm_list']."</option>";	 



			 }



			echo "</select></td>



			<td><input type='textbox'  name='resources[]' value='" . $row_activity['resources'] . "'></td>



			<td>



			<select class='form-control' tabindex='-1' name='dependency[]'>



             <option value=''>Select </option>";



			// print_r($unique_code);



			 foreach($uniquecode as $unique_code) {



			 if($row_activity['dependent_on']==$unique_code['unique_code'])	{



				



			$selected="selected";	



			}



			else{



			$selected="";	



			}



				 



			echo "<option value=".$unique_code['unique_code']." ".$selected.">".$unique_code['unique_code']."</option>";		 



				 



			 }



			 



			 echo "</select> 



			



			</td>



			<td><input type='textbox'  name='template_reference[]' value='" . $row_activity['template_reference'] . "'></td>";



			



			



			if($row_activity['template_document']!='') { 



			



			



			$ext = strtolower(pathinfo($row_activity['template_document'], PATHINFO_EXTENSION));



			



			if($ext=="png" || $ext=="jpg" || $ext=="gif" || $ext=="jpeg"){



				$file_class="fa-file-image-o";	



			}else if($ext=="pdf"){



				$file_class="fa-file-pdf-o";	



			}else if($ext=="xlsx" || $ext=="xls" || $ext=="csv"){



				$file_class="fa-file-excel-o";	



			}else if($ext=="doc" || $ext=="docx"){


				$file_class="fa-file-word-o";		



			}else{



				$file_class="fa-file";		



			}



			



			



			echo "<td><span>



			<input type='hidden' name='previous_document[]' value='".$row_activity['template_document']."'>";



			



			



			echo "<input type='file'  name='template_document[]'></span><a href='".base_url()."template_document/".$row_activity['project_id']."/".$row_activity['template_document']."' target='_blank' style='display:block'><i class='fa ".$file_class." fa-6' aria-hidden='true' style='display:block'></i><span>".$row_activity['template_document']."</span></a>



			<a href='javascript:void(0)' class='del_docu' style='display:block'>



			<i class='fa fa-close' aria-hidden='true' onClick='delet_docu(".$row_activity['activity_id'].")'></i></a>



			</td>";



			}else {



			echo "<td><input type='hidden' name='previous_document[]' value=''>



			<input type='file'  name='template_document[]'></td>";



			}



			



			echo "<td> <input type='text' name='activity_status[]' value='".$row_activity['activity_status']."' readonly>  <input type='hidden' name='activity_status_modified[]' value='".$row_activity['activity_status_modified']."' readonly>



			<input type='hidden' name='comments[]' value='".$row_activity['comments']."' readonly>



			</td>";



			



			



			echo "</tr>";



		   $row_process['process_name']='';



		 



			$depth_td='';



			$row_activity['activity_name']='';	



			}



			



			



			



		  }	



					



		}



         



		//echo "<br>".$result_depth_process ."-->indent-->".$indent;



		



		  



		  //print_r($row);



         $this->tree_process_edit($row_process['pid'],$mp_id, $indent + 1,$projectid);



	$activity_td1="";  



			$activity_td2="";  



			$activity_td3="";  



			$depth_td='';



			$row_process['unique_code']='';



	



    }





}



//-------------------Exporting all element in to excel -------------------

public function tree_process_export($id,$mp_id ,$indent=1,$projectid) {

	

	$query = "SELECT * FROM `process` WHERE parent_processid= '".$id."' AND mp_id='".$mp_id."'  AND status=0";

    $result_process = $this->db->query($query);

	

	

	$tm_details = $this->wbs_model->get_assiged_tm_details($projectid);

	$pm_details = $this->wbs_model->get_assiged_pm_details($projectid);

	

	

	//print_r($unique_code)	;

   

	  $sql_depth="SELECT process_columns, activity_columns  FROM project_name  WHERE project_id='".$projectid."'"; 	

	$res_depth= $this->db->query($sql_depth);

	$result_depth=$res_depth->row();

	$result_depth_process=$result_depth->process_columns;

	$result_depth_activity=$result_depth->activity_columns;

	

	$activity_td1="";  

	$activity_td2="";  

	$activity_td3="";  

	$loop_prccess=0;	

     foreach ($result_process->result_array() as $row_process) {

		 	echo "<tr><td align='left'>".$row_process['unique_code']."</td>";

			

			for($i=0;$i<$indent;$i++) {

			echo "<td>&nbsp;</td>";

		 	}

		 echo "<td  align='left'>";

		 if($row_activity['parent_activity_id']==0){ 

			echo $row_process['process_name']; 

		 

		 }else { echo ""; }

		 

		echo "</td>";

		 

		 for($i=0;$i<$result_depth_process-$indent;$i++) {

				 

			echo "<td  align='left'>&nbsp;</td>";	 

		}

		  echo "".$depth_td.$activity_td1.$activity_td2.$activity_td3."</tr>";

		 

		 $children_ids = $this->fetch_children(0,$row_process['pid']);

		 

		// print_r($children_ids);

		if(count($children_ids)>0) { 	

			for($mi=0;$mi<count($children_ids);$mi++){ 

		

		  $query_activity = "SELECT * FROM `activity` WHERE activity_id= '".$children_ids[$mi]."'  AND status=0";

    	  $result_activity=$this->db->query($query_activity);

		  

		  $uniquecode = $this->wbs_model->get_unique_code($projectid,$children_ids[$mi]);	

		 

		  if ($result_activity->num_rows() !=0) {

    		foreach ($result_activity->result_array() as $row_activity) {

			

			$data = array();	

			//$levels= $this->checkParentIds($row_activity['activity_id'],$data);

			//echo "<br>-->Depth-->". $result_depth[0]."<br>";

			//echo "<br>".$row_activity['activity_name']."-->aaa-->". count($data)."<br>";

			

			echo "<tr><td  align='left'>".$row_activity['unique_code']."</td><td></td>";

			

			for($i=0;$i<$result_depth_process;$i++){

				echo "<td></td>";   

    		}

			

			 for($i=0;$i<count($data);$i++){

				echo "<td>&nbsp;</td>";   

    		}

	

			echo "<td  align='left'>" . $row_activity['activity_name'] . "</td>";

			

			//echo "<br>aaa-->".$result_depth_activity;

			//echo "<br>bbb-->".count($data);

			

			 for($i=0;$i<$result_depth_activity-count($data)-1;$i++){

				echo "<td  align='left'>&nbsp;</td>";   

    		}

			

			echo "<td  align='left'>" . $row_activity['planned_quantity'] . "</td>
			
			<td  align='left'>" . $row_activity['actually_quantity'] . "</td>
			
			<td  align='left'>" . $row_activity['start_date'] . "</td>

			<td  align='left'>" . $row_activity['finish_date'] . " 

			</td><td  align='left'>".$row_activity['assigned_person'];  

			

			 

			echo "</td>

			<td  align='left'>" . $row_activity['resources'] . "</td>

			<td  align='left'>" . $row_activity['dependent_on'] . "</td>

			<td  align='left'>" . $row_activity['template_reference'] . "</td>

			<td  align='left'>" . $row_activity['template_document'] . "</td>

			<td  align='left'>" . $row_activity['activity_status'] . "</td>

			";

			

		

			echo "</tr>"	;

			

			

			}

			

		  }	

		 

		}

		}else{

		

		  $query_activity = "SELECT * FROM `activity` WHERE process_id= '".$row_process['pid']."'  AND status=0";

    	  $result_activity=$this->db->query($query_activity);

		 

		  if ($result_activity->num_rows() !=0) {

    		foreach ($result_activity->result_array() as $row_activity) {

			

			

			$data = array();	

			//$levels= $this->checkParentIds($row_activity['activity_id'],$data);

			//echo "<br>-->Depth-->". $result_depth[0]."<br>";

			//echo "<br>".$row_activity['activity_name']."-->aaa-->". count($data)."<br>";

			

			echo "<tr><td  align='left'>".$row_activity['unique_code']."</td><td></td>";

			

			for($i=0;$i<$result_depth_process;$i++){

				echo "<td></td>";   

    		}

			

			

			 for($i=0;$i<count($data);$i++){

				echo "<td>&nbsp;</td>";   

    		}

	

			echo "

			<td  align='left'>" . $row_activity['activity_name'] . "</td>";

			

			//echo "<br>aaa-->".$result_depth_activity;

			//echo "<br>bbb-->".count($data);

			

			 for($i=0;$i<$result_depth_activity-count($data)-1;$i++){

				$activity_td2.="<td>&nbsp;</td>";   

    		}

			

			echo "<td  align='left'>

		" . $row_activity['start_date'] . "

			</td>

			<td  align='left'>

		" . $row_activity['finish_date'] . " 

			</td>

			<td  align='left'>

			".$row_activity['assigned_person'];  

	

			 

			echo "</td>

			<td  align='left'>" . $row_activity['resources'] . "</td>

			<td  align='left'>" . $row_activity['template_reference'] . "</td>

			<td  align='left'>" . $row_activity['template_document'] . "</td>

			<td  align='left'>" . $row_activity['activity_status'] . "</td>";

			

			echo "</tr>";

				

			}

			

			

			

		  }	

		  else {

			

			 for($i=0;$i<$result_depth_activity;$i++){

				$activity_td1.="<td>&nbsp;</td>";   

    		}

			

			$activity_td3.="

			<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>

			";

			

			

			 echo "<tr>";

		 for($i=0;$i<$indent;$i++) {

			echo "<td>&nbsp;</td>";

		 }

         echo "

		 <td  align='left'>";

		 if($row_activity['parent_activity_id']==0) 

		 { 

		 

		 echo $row_process['process_name']; 

		 

		 } 

		 else { echo "&nbsp;"; }

		 

		echo "</td>";

		 

		 for($i=0;$i<$result_depth_process-$indent;$i++) {

				 

			echo "<td>&nbsp;</td>";	 

			 }

		  echo "".$depth_td.$activity_td1.$activity_td2.$activity_td3."</tr>";

		  

		 			

			$activity_td2="";  

			$activity_td3="";  

			$depth_td='';

		  }

		

			

			

		}

         

		//echo "<br>".$result_depth_process ."-->indent-->".$indent;

		

		  

		  //print_r($row);

         $this->tree_process_export($row_process['pid'],$mp_id, $indent + 1,$projectid);

	$activity_td1="";  

			$activity_td2="";  

			$activity_td3="";  

			$depth_td='';

	

    }

}



public function get_wbs_data($projectid){

 			$this->db->select('*');

			$this->db->from('mega_process');

			$this->db->where('project_id', $projectid);

			$query = $this->db->get();

			return $query->row_array();	

	

}





/*--------------------------------Developed by Samar Jeet Singh-------------------------------------------*/

	public function getData($table,$columnName,$columnValue)

	{

			    $this->db->select('*');

				$this->db->from($table);

				$this->db->where($columnName, $columnValue);

				$result = $this->db->get()->result_array();

				return $result;

	}

	public function getRequiredActivity($startDate,$endDate)

	{

	        $sql= "SELECT * FROM activity WHERE CAST(start_date AS DATE) >=CAST('2016-10-15' AS DATE) AND CAST(finish_date AS DATE) <=CAST('2016-10-24' AS DATE)";

            $result= $this->db->query($sql)->result_array();

			$activity_level=0;

			$finalData=array();//print_r($result);exit;	

			foreach($result as $row)

			{

			     if($row['parent_activity_id']==0)

				 {

					 $processArr = $this->getData('process','pid',$row['process_id']);

					// print_r($processArr);exit;

                       foreach($processArr as $processRow)

                       {

					       if($processRow['parent_processid']==0)

						   {

						        $megaProcess = $this->getData('mega_process','mp_id',$processRow['mp_id']);

								// print_r($megaProcess);exit;

								//$finalData=

						   }

					   }					   

					 

				 }

				 else

				 {

				   

				 }

				 

				 

			}

	

	}

	

/*---------------------------------End Samar Jeet Singh----------------------------------------------------*/



	

	 public function select($get_id)  

      {  

		    $this->db->select('*');

			$this->db->from('wbs');

			$this->db->where('project_id', $get_id);

			$query = $this->db->get();

			return $query;

      }

	  

	  

	

	    public function activity($get_id) {

			$query = $this->db->query("SELECT `activity` FROM `wbs` WHERE project_id='$get_id' AND activity!=''");

			$query = $query->num_rows();

			//echo $this->db->last_query();

		    return $query;

			

	    }

		public function user_comment($get_id,$user_id,$uname,$usercomment) {

			$this->db->query("INSERT INTO `project_comment`(`userid`, `projectid`, `name`, `comment`) VALUES ('$user_id','$get_id','$uname','$usercomment')"); 

			//echo $this->db->last_query();

			return $query;	

	    }

	

	  public function get_comment($get_id){		

			$this->db->select('comment,name');

			$this->db->from('project_comment');

			$this->db->where('projectid', $get_id);

			$this->db->order_by("id", "DESC");

			$query = $this->db->get();

			//echo $this->db->last_query();

			return $query->result_array();

			

		}

		

		//CSV Import

		

		 function insert_csv($insert_data) {

          $this->db->insert('wbs', $insert_data);

		  //echo $this->db->last_query();

        }

		//CSV Export

		

	/*	public function export_wbs($get_id)  

      {  

		    $this->db->select('*');

			$this->db->from('wbs');

			$this->db->where('project_id', $get_id);

			$query = $this->db->get();

			return $query;

      }*/

		 /*public function update_pm_per($get_id,$pmchecked,$count){

			 

			 for($x = 0; $x < $count; $x++){

				 $uc = implode(',',$pmchecked);

			$this->db->query("UPDATE `pm_project` SET `wbs_permission`='$uc[$x]' WHERE `project_id`='$get_id'");

			 }

			echo $this->db->last_query();

		}*/

		

		function update_pm($per,$pm_list)

		{

			$this->db->where('pm_list', $pm_list);

			$this->db->update('pm_project', array('wbs_permission'=>$per));

			//echo $this->db->last_query();

		}

		function update_tm($tmper,$tm_list)

		{

			$this->db->where('tm_list', $tm_list);

			$this->db->update('tm_project', array('wbs_permission'=>$tmper));

			//echo $this->db->last_query();

		}

		//pm wbs permission delete

		function delete_pm_permission($get_id,$pmid)

		{

			$this->db->query("UPDATE `pm_project` SET `wbs_permission`='0' WHERE `pm_list`='$pmid'");

		}

		function delete_tm_permission($get_id,$tmid)

		{

			$this->db->query("UPDATE `tm_project` SET `wbs_permission`='0' WHERE `tm_list`='$tmid'");

		}

		

		function wbs_edit_pm($user_id)

		{

			$this->db->select('wbs_permission');

			$this->db->from('pm_project');

			$this->db->where('pm_list', $user_id);

			$query = $this->db->get();

			return $query->row_array();

			

		}

		function wbs_edit_tm($user_id)

		{

			$this->db->select('wbs_permission');

			$this->db->from('tm_project');

			$this->db->where('tm_list', $user_id);

			$query = $this->db->get();

			return $query->row_array();

		}

		

		public function get_all_mega_process($projectid){

		$sql="SELECT * FROM mega_process WHERE project_id='".$projectid."' AND status=0 AND mp_name!=''";	

		$res=$this->db->query($sql);

		return $res->result_array();	

			

		}

		

		public function get_all_process($projectid){

		$sql="SELECT * FROM process WHERE project_id='".$projectid."'  AND status=0 AND mp_id!=0  AND process_name!=''";	

		$res=$this->db->query($sql);

		return $res->result_array();	

		}

		

		

		

		

}



?>