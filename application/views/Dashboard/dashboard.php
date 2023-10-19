<?php
$role = $this->session->userdata['role'];
//print_r($project_per);
if($donut_graph->delay==''){
$delay=0;	
}
else{
$delay=$donut_graph->delay;	
}
if($donut_graph->ontime==''){
$ontime=0;	
}
else{
$ontime=$donut_graph->ontime;	
}
if($donut_graph->total==''){
$total_p=0;	
}
else{
$total_p=$donut_graph->total;	
}

if($donut_graph->completed==''){
$completed=0;	
}

$ontime=ceil(($ontime/$total_p)*100);
$delay=ceil(($delay/$total_p)*100);
$completed=ceil(($completed/$total_p)*100);
//print_r($_POST);
//echo $project_names;
?>
<h3 class="title text-uppercase"> Performance </h3>
<!-- page content -->
<div class="right_col dashboard row" role="main">
<div class="col-md-4 col-sm-4 col-xs-12">
<form name="filter" method="post">
	<div class="search_area">
    <div class="form-group">
    <label>Project</label>
   <?php //print_r($project_data);?>
    <select class="form-control" name="project_filterid" id="project_filterid" onChange="getUsersList(this.value)">
    	<option value="">Select Project</option>
        <?php foreach($project_data as $project_data){ ?>
        <option value="<?php echo $project_data['project_id']?>" <?php if($project_data['project_id']==$_POST['project_filterid']) echo "selected";?>><?php echo $project_data['project_name']?></option>
        <?php } ?>
    </select>
    </div>
    <?php if($role == 'Admin' || $role == 'Editor' || $role == 'Project Manager') {?>
     <div class="form-group">
    <label>Select User</label>
   <?php //print_r($project_data);?>
    <select class="form-control" name="userid" id="userid">
    	<option value="">Select User</option>
        <?php foreach($all_users as $all_users){ ?>
        <option value="<?php echo $all_users['user_id']?>" <?php if($all_users['user_id']==$_POST['userid']) echo "selected";?>><?php echo $all_users['name']?></option>
        <?php } ?>
    </select>
    </div>
    <?php } ?>
    <div class="form-group">
    <label>Date Range</label>
    <input type="text" name="date" value="<?php echo $_POST['date']?>" class="form-control" id="datetstarting" placeholder="Select Date Range">
    </div>
    
    <div class="curve_btn green_btn text-right">
    <button type="submit">Filter</button>
    </div>
    
    </div>
   </form> 
    <div class="x_panel">
    
     <div class="x_content2">
     <span style="font-weight:bold;">Total Projects :<?php echo $donut_graph->total?></span>
                  <div id="graph_donut" style="width:100%; height:300px;"></div>
                </div>
                </div>
</div>

<div class="col-md-8 col-sm-8 col-xs-12">
<div class="x_panel">
<div class="x_content Pro_bar">
 <h4 style="margin-bottom:0;">Project Performance</h4>
 					<?php if(count($project_data) >0) { ?>
                  <div id="mybarChart" style="height:350px;width:100%;"></div>
				  <?php } ?>
                </div>
  </div>
  
 <div class="x_panel">               
    <div class="x_content line_chart">
    <h4>User Performance</h4>
    <div style="padding:30px;">
    			<?php //if($employee_performance) { ?>
                  <canvas id="lineChart"></canvas>
                  <?php //} ?>
 </div>               </div>   
 </div>             
</div>

<!--<div class="col-md-8 col-sm-8 col-xs-12">
<div class="project_progress_info">
	<div class="table-responsive">
		<table class="table table-striped">
    <thead>
      <tr>
        <th class="col-xs-2">Project Name</th>
        <th>Project Progress</th>
        <th class="text-center">Delay</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach($project_data as $project_data){
	$data=$this->dashboard_model->get_finish_date_project($project_data['project_id']);	
	$data1=$this->dashboard_model->get_start_date_project($project_data['project_id']);	
	
	$start_date=$data1->start_date;
	$finish_date=$data->finish_date;
	
	if($data->delay==0 ||  $data->delay < 0) {
		$delay_data=0;	
	}else{
		$delay_data=$data->delay;	
	}
	
	$total_time_project=$this->dashboard_model->get_total_time_in_days($finish_date,$start_date,$project_data['project_id']);
	
	$delay_percentage=ceil(($delay_data/$total_time_project)*100);
	
	
	//echo "<br>Project name-->".$project_data['project_name'];
	$completed_activity=$this->dashboard_model->get_completed_activity($project_data['project_id']);
	$incomplete_activity=$this->dashboard_model->get_incompleted_activity($project_data['project_id']);
	$total_activity=$this->dashboard_model->get_total_activity($project_data['project_id']);
	
	$percentage = ($completed_activity/$total_activity)*100;
	
	if($total_activity==0){
	$project_status="Not started yet";			
	}
	elseif($incomplete_activity>0){
		$project_status="In Progress";	
	}else if($incomplete_activity==0){
		$project_status="Complete";		
	}
	
	
	?>
      <tr>
        <td><?php echo $project_data['project_name']?></td>
        <td><div class="progress">
  <div class="progress-bar progress-bar-success  progress-bar-striped active" role="progressbar" style="width:<?php echo $percentage?>%">
    <?php echo $project_status;?>
  </div>
  <?php if($data->delay>0) { ?>
  <div class="progress-bar progress-bar-danger progress-bar-striped " role="progressbar" style="width:<?php echo $delay_percentage?>%">
    Delay
  </div>
 <?php } ?>
</div></td>
		 <?php if($data->delay==0 ||  $data->delay < 0) { ?>	
        <td class="text-center">0 Days</td>
         <?php } else { ?>
         <td class="text-center"><?php echo $data->delay?> Days</td>
          <?php } ?>
      </tr>
      <?php } ?>
   
    </tbody>
  </table>
	</div>
</div>
</div>-->
	<!-- top tiles -->
<!--
	
-->
	<!-- /top tiles -->
	<br />
<!--
	
	
	
-->



        <!--
                 
                
                 <?php /* <div class="">
                    <div id="graph_bar" style="width:100%; height: 600px; max-height:100%;"></div>
                  </div>
           */ ?>
        
                </div>
            </div>
          
          
           
      
        
        </div>-->
</div>
<!-- /page content -->

<script src="<?php echo base_url();?>vendors/jquery/dist/jquery.min.js"></script>
<script src="<?php echo  base_url();?>vendors/echart/echarts-all.js"></script>
<script src="<?php echo  base_url();?>vendors/echart/green.js"></script>
 <script src="<?php echo  base_url();?>vendors/echart/chart.min.js"></script>
  <script src="<?php echo  base_url();?>vendors/echart/moris/raphael-min.js"></script>
  <script src="<?php echo  base_url();?>vendors/echart/moris/morris.min.js"></script>
  <script>
  
  $(document).ready(function(){
Chart.defaults.global.legend = {
      enabled: false
    };



   var ctx = document.getElementById("lineChart");
    var lineChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: [<?php echo $employee_performance?>],
        datasets: [{
          label: "Score in % ",
          backgroundColor: "rgba(3, 88, 106, 0.3)",
          borderColor: "rgba(3, 88, 106, 0.70)",
          pointBorderColor: "rgba(3, 88, 106, 0.70)",
          pointBackgroundColor: "rgba(3, 88, 106, 0.70)",
          pointHoverBackgroundColor: "#fff",
          pointHoverBorderColor: "rgba(220,220,220,1)",
          pointBorderWidth: 1,
          data: [<?php echo $per?>]
        }]
      },
    });

    Morris.Donut({
        element: 'graph_donut',
        data: [
            {label: 'Delay', value: <?php echo $delay?>},
            {label: 'Completed', value: <?php echo $completed?>},
            {label: 'On Time', value: <?php echo $ontime?>},
        ],
        colors: ['#26B99A', '#34495E', '#ACADAC'],
        formatter: function (y) {
            return y + "%"
        }
    });




  var myChart9 = echarts.init(document.getElementById('mybarChart'), theme);
    myChart9.setOption({ 
	
		tooltip : {         // Option config. Can be overwrited by series or data
        trigger: 'axis',
        //show: true,   //default true
        showDelay: 0,
        hideDelay: 50,
        transitionDuration:0,
        backgroundColor : '#eee',
        borderColor : '#ccc',
        borderRadius : 8,
        borderWidth: 2,
        padding:5,    // [5, 10, 15, 20]
        position : function(p) {
            // console.log && console.log(p);
            return [p[0] + 10, p[1] - 10];
        },
        textStyle : {
            color: '#333',
            decoration: 'none',
            fontSize: 15,
            fontWeight: 'normal'
        },
        formatter: function (params,ticket,callback) {}
     
    },
	 title : {
        text: '',
        subtext: 'In Months'
    },
	legend: {
        data: ['Actual Graph','Current Progress Graph']
      },
	  
    toolbox: {
        show : true,
      
    },
    calculable : true,
    xAxis :  [{
        type: 'category',
        data: [<?php echo $project_names ?>],
		 axisLabel : {
                show:true,
                interval: 'auto',    // {number}
                rotate:50,
                margin:2,
     textStyle: {
                    fontSize: 10,
                    fontWeight: 'normal'
                }
            }
      }],
    yAxis : {
        type : 'value'
    },
    series : [
        {
            name:'Actual Graph',
            type:'bar',
			 tooltip: {
          trigger: 'item',
           formatter: function(params,ticket,callback) {
			   
			   console.log(params);
			 res='';  
			var startDate = '<?php echo $project_sdate?>';
			var endDate = '<?php echo $project_edate?>';
			var performance='<?php echo $performance?>';
			var pnames='<?php echo $project_names1?>';
			
			 //console.log(params);
			var index = ticket.replace("axis:", "");
					//alert(params[dataIndex]);
           	//var res1 = params[0].series.name;
			var myindex=params.dataIndex;
			//alert(params[0].dataIndex);
			var result1 = startDate.split(',');
			var result2 = endDate.split(',');
			var result3 = performance.split(',');
			
			var result44 = pnames.split(',');
			
			res+='Project:'+result44[myindex]+'<br/>Start Date:'+result1[myindex]+'<br/>Finish Date:'+result2[myindex] + '<br/>';
			   
            if (params.value.length > 1) {
              return res;
            } else {
              return res;
            }
          }
        },
            data:[
                <?php echo $project_months?>
            ]
        },
        {
            name:'Current Progress Graph',
            type:'bar',
			 tooltip: {
          trigger: 'item',
           formatter: function(params,ticket,callback) {
			  res1=''; 
			 var performance='<?php echo $performance?>';
			 
			 var remainig_days='<?php echo $remainig_days?>';
			  var end_days='<?php echo $end_days?>';
			  var delayvalue='<?php echo $delayvalue?>';
			  var pnames='<?php echo $project_names1?>';
			 var myindex=params.dataIndex;
			  
			  var result3 = performance.split(',');
			  var result4 = remainig_days.split(',');
			  var result5 = delayvalue.split(',');
			  
			   var result6 = end_days.split(',');
			   
			     var result7 = pnames.split(',');
			   
           res1+='Project :'+result7[myindex] +'<br/> Performance :'+result3[myindex] +'<br/> Total Days :'+result4[myindex]+'<br/>Remaining Days:'+result6[myindex]+'<br> Delay :'+result5[myindex] + ' Days';	
		      
            if (params.value.length > 1) {
              return res1;
            } else {
				//params.seriesName + ' <br/>' + params.seriesName + ' : ' + params.value + ' ';	
              return res1;
            }
          }
        },
            data:[<?php echo $project_per?>]
        }
    ]});



$('.applyBtn').click(function(){
	
	setTimeout(function(){
						  
	 $.ajax({
		 url:'<?php echo base_url()."dashboard/get_employee_performance" ?>',
		 type:'post',
		 data:{'date':$('#datetstarting').val()},
		 success: function(data){
			 //alert(data);
		$('body').append(data);	
			 }
		 
		 })
                  
    //alert($('#datetstarting').val());
  },1000); 
 
/*var datevalue=setTimeout(function() {
                        $('#datetstarting').val();
                    }, 2500);

alert(datevalue);*/
});



 var myChart = echarts.init(document.getElementById('echart_bar_horizontal'), theme);
    myChart.setOption({
      tooltip: {
        trigger: 'axis'
      },
      legend: {
        data: ['Percentage']
      },
      toolbox: {
        show: false,
        feature: {
          saveAsImage: {
            show: true
          }
        }
      },
      calculable: true,
      xAxis: [{
        type: 'value',
		data:[20, 40, 60, 80, 100]
      }],
      yAxis: [{
        type: 'category',
        data: [<?php echo $employee_performance;?>]
      }],
      series: [{
        name: 'Percentage',
        type: 'bar',
        data: [<?php echo $per;?>]
      }]
    });




           

  });
		
	

 </script>