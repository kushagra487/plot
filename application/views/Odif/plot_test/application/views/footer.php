	
               </div>
                        <!-- /.inner -->
                    </div>
                    <!-- /.outer -->
                </div>
                <!-- /#content -->
            <footer class="Footer bg-dark dker">
                <p>Powered by PBOPlus Consulting services</p>
            </footer>
                </div>
    

	</div>
</div>

   <!-- /#wrap -->
            
            
       </div>     
       <div id="mytimepicker" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Set date</h4>
      </div>
      <div class="modal-body">
        <div class="input-group date Startdatepickerhere" id="Startdatepickerhere">
                      <input type="text" class="form-control" value="<?php echo date("d/m/Y")?>">
                      <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span> </div>
                
        <br>
        <button type="submit" class="btn btn-default">Select</button>
      </div>

    </div>

  </div>
</div>

<div id="myEndtimepicker" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Set date</h4>
      </div>
      <div class="modal-body">
        <div class="input-group date endDatepickerhere" id="">
                      <input type="text" class="form-control" value="<?php echo date("d/m/Y")?>">
                      <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span> </div>
                
        <br>
        <button type="submit" class="btn btn-default">Select</button>
      </div>

    </div>

  </div>
</div>
            <!-- /#footer -->
         <div class="modal fade" id="confirm" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"> Are you sure you want to submit project for ODIF?</h4>
        </div>
        <div class="modal-body text-center curve_btn green_btn">
          <button type="button" data-dismiss="modal" class="btn" id="confirm">Confirm</button>
    <button type="button" data-dismiss="modal" class="btn btn-ank-default">Cancel</button>
        </div>
      </div>
      
    </div>
  </div>   

  <script src="<?= base_url();?>vendors/jquery/dist/jquery.min.js"></script>
<script src="<?= base_url();?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?= base_url();?>vendors/iCheck/icheck.min.js"></script>-->
<script src="<?= base_url();?>js/moment/moment.min.js"></script>
<script src="<?= base_url();?>js/datepicker/daterangepicker.js"></script>
<script src="<?= base_url();?>build/js/custom.js"></script>

<?php if($datediff > 0) { ?>
<script>
	var total_complete_activity =  $('#total_complete_activity').val();
	var sum_total_activity =  $('#sum_total_activity').val();
 // var per = '<?php //echo $total_complete_activity."/".$sum_total_activity;?>';
	var per  = total_complete_activity+'/'+sum_total_activity;
	//var score = "<?php //$cal = round(($total_complete_activity/$sum_total_activity)*100); ?><?php //echo number_format($cal, 2)."%"; ?>";
	
	let cal = 0;
	if (sum_total_activity !== 0) {
		cal = (total_complete_activity / sum_total_activity) * 100;
	}
	let score = cal.toFixed(2) + "%";	
  $(document).ready(function(){
    console.log(<?php echo $total_complete_activity; ?>);
    $('.performance').html(per);
    $('.score').html(score);
  });
</script>
<?php } ?>
<script>
$('[data-toggle="tooltip"]').tooltip();
</script>



<script type="text/javascript">
	
	function check_dependency(aid){
//alert(1);
 $.ajax({
		 url:'<?php echo base_url()."odif/get_dependant_status" ?>',
		 type:'post',
		 data:{'aid':aid},
		 success: function(data){
			 //alert(data);
		$('#ajaxmsg').html(data);	
			 }
		 
		 });
	
}	   
	  
	   $(document).ready(function() {
		   
	
		
	$("#csv_to_upload").change(function() {

    var val = $(this).val();
	var ext=val.substring(val.lastIndexOf('.') + 1).toLowerCase();
	
	//if(ext=="doc" || ext=="docx" || ext=="pdf" || ext=="html" || ext=="rtf" || ext=="doc" )

    switch(val.substring(val.lastIndexOf('.') + 1).toLowerCase()){
        case 'csv': 
           
            break;
        default:
            $(this).val('');
            // error message here
            alert("Please upload a valid CSV file");
            break;
    }
});

	
		   $("#activity_filter").daterangepicker({
			   format:'DD/MM/YYYY'
			});	
			
			
            
             
             });
	

    </script>
          <!-- new dashboard js -->
          <!--  <script src="<?= base_url();?>application/views/assets/lib/metismenu/metisMenu.js"></script>-->
            <!-- Screenfull -->
           <!-- <script src="<?= base_url();?>application/views/assets/lib/screenfull/screenfull.js"></script>-->


            <!-- Metis core scripts -->
            <script src="<?= base_url();?>vendors/assets/js/core.js"></script>
            <!-- Metis demo scripts -->
            <script src="<?= base_url();?>vendors/assets/js/app.js"></script>
            
             <script src="<?php echo base_url();?>js/datepicker/bootstrap-datetimepicker.min.js"></script>
           
              <script src="<?php echo base_url();?>vendors/datetimepicker/js/bootstrap-datetimepicker.min.js">
              </script>
               <script src="<?php echo base_url();?>vendors/datetimepicker/js/moment.js">
              </script>
              <script type="text/javascript" src="<?php echo base_url();?>vendors/select/bootstrap-multiselect.js"></script>
<script>
$('#tmlist').multiselect({ 
         includeSelectAllOption: true,
           enableFiltering:true, 
        enableCaseInsensitiveFiltering: true    
           
     });
$('#start_date').datetimepicker({ format: 'YYYY-MM-DD'});
$('#end_date').datetimepicker({ format: 'YYYY-MM-DD'});

$('#start_date_activity').datetimepicker({ format: 'DD/MM/YYYY'});
$('#end_date_activity').datetimepicker({ format: 'DD/MM/YYYY'});
var disabledTime = $("#daterange").val(); 
if(disabledTime) {
	var enabledHours = []; 
	var disabledHour = parseInt(disabledTime.split(':')[0]); 
	for (let i = 0; i <  disabledHour; i++) {
		enabledHours.push(i);
	} 
	$('#timestartodif').datetimepicker({
		format: 'HH:mm', // Use 'HH:mm' for a 24-hour format or 'hh:mm A' for 12-hour format
		//enabledHours: enabledHours, 
		ignoreReadonly: true
	});
	$("#daterange").val(disabledTime); 	
}


		$(document.body).trigger(".stdate, .endate")
		$(".stdate, .endate").on('click',function(){
			$(this).datetimepicker({
						format: 'DD/MM/YYYY HH:mm:ss'
					}).datetimepicker( "show" );
		});
        // $(".stdate, .endate").datetimepicker({
        //     format: 'DD/MM/YYYY HH:mm:ss'
        // });
     

  $('#timestart').datetimepicker({
			   format: 'HH:mm',  
	  });
 
$('#datepickerhere').datetimepicker({
	    format: 'DD/MM/YYYY'
});

var Wht =  $(window).height();
		   $('#wrap #left').css('min-height',Wht);
		    $('#content>.outer>.inner').css('min-height',Wht-41);
			
  $('#timestart').datetimepicker({
			   format: 'HH:mm',  
	  });

/***************************************** date picker with validation ***********************************/

$('.Startdatepickerhere').datetimepicker({
							format: 'DD/MM/YYYY'
});

$('.endDatepickerhere').datetimepicker({					
							format: 'DD/MM/YYYY'								
							});	

saveTextStart='';						
saveTextEnd='';
savePapa='';
saveEPapa='';

$('.datesel').on('click',function(){
           $('#mytimepicker').modal('show');	   
		   savePapa = $(this);
		   $(savePapa).find('span.magic').remove();
		   $(savePapa).find('input').removeAttr('value');


	
         });

	 
$('#mytimepicker button[type="submit"]').on('click',function(){




 var saveEndDate = $(savePapa).parent().parent().find('.Enddatesel .magic').text();
 saveTextStart= $(this).parents('#mytimepicker').find('input[type="text"]').val();
 
 var pstart=$("#project_start_date").val();
 var pend=$("#project_end_date").val();
 
 var arr = saveEndDate.split('/');
			var Dday = arr[0];
			var Mmonths = arr[1];
			var Yyear = arr[2];
			var TotalDays = Mmonths+' '+Dday+' '+Yyear;
			//alert(TotalDays);
var arr2 =	 saveTextStart.split('/');
			var Dday2 = arr2[0];
			var Mmonths2 = arr2[1];
			var Yyear2 = arr2[2];
			var TotalDays2 = Mmonths2+' '+Dday2+' '+Yyear2;
			
var arr3 =	 pstart.split('/');
			var Dday3 = arr3[0];
			var Mmonths3 = arr3[1];
			var Yyear3 = arr3[2];
			var TotalDays3 = Mmonths3+' '+Dday3+' '+Yyear3;
			
var arr4 =	 pend.split('/');
			var Dday4 = arr4[0];
			var Mmonths4 = arr4[1];
			var Yyear4 = arr4[2];
			var TotalDays4 = Mmonths4+' '+Dday4+' '+Yyear4;			
						
			//alert(TotalDays2);	
var date1 = new Date(Yyear2+','+Mmonths2+','+Dday2);	
var date2 = new Date(Yyear+','+Mmonths+','+Dday);

var date3 = new Date(Yyear3+','+Mmonths3+','+Dday3);		
var date4 = new Date(Yyear4+','+Mmonths4+','+Dday4);	

 if(saveEndDate==''){
	 
	 
	$(savePapa).find('.dateselect').attr('value',saveTextStart);
	$(savePapa).find('span.magic').empty();
	$(savePapa).find('input[type="hidden"]').attr('value',saveTextStart);
	$(savePapa).find('.dateselect').after('<span class="magic">'+saveTextStart+'</span>');
	
	if(date1<date3){
	$(savePapa).find('input').removeAttr('value');
		alert('Activity start date should be greater than Project Start Date');		
}	
 }
 else
 {



		if (date1>date2){
			$(savePapa).find('input').removeAttr('value');
		alert('Start date should be less then Finish Date');		
		}else if(date1<date3){
			$(savePapa).find('input').removeAttr('value');
		alert('Activity start date should be greater than Project Start Date');		
		}
		else
		{
		$(savePapa).find('.dateselect').attr('value',saveTextStart);
		$(savePapa).find('span.magic').empty();
		$(savePapa).find('input[type="hidden"]').attr('value',saveTextStart);
		$(savePapa).find('.dateselect').after('<span class="magic">'+saveTextStart+'</span>');	
				
		} 
 }

 $('#mytimepicker').modal('hide');
 
});





$('.Enddatesel').on('click',function(){

			saveEPapa = $(this);
			$(saveEPapa).find('span.magic').remove();
			$(saveEPapa).find('input').removeAttr('value');
			$('#myEndtimepicker').modal('show');
    		
         });
	

$('#myEndtimepicker button[type="submit"]').on('click',function(){
		var saveStartDate = $(saveEPapa).parent().parent().find('.datesel .magic').text();
			//alert(saveStartDate);
		saveTextEnd= $(this).parents('#myEndtimepicker').find('input[type="text"]').val();
		
		var pstart=$("#project_start_date").val();
 		var pend=$("#project_end_date").val();
 
		 var arr3 = saveStartDate.split('/');
			var Dday3 = arr3[0];
			var Mmonths3 = arr3[1];
			var Yyear3 = arr3[2];
			var TotalDays3 = Mmonths3+' '+Dday3+' '+Yyear3;
			//alert(Dday3);
var arr4 =	 saveTextEnd.split('/');
			var Dday4 = arr4[0];
			var Mmonths4 = arr4[1];
			var Yyear4 = arr4[2];
			var TotalDays4 = Mmonths4+' '+Dday4+' '+Yyear4;
			//alert(TotalDays4);	
			
			
var arr5 =	 pstart.split('/');
			var Dday5 = arr5[0];
			var Mmonths5 = arr5[1];
			var Yyear5 = arr5[2];
			var TotalDays5 = Mmonths5+' '+Dday5+' '+Yyear5;
			
var arr6 =	 pend.split('/');
			var Dday6 = arr6[0];
			var Mmonths6 = arr6[1];
			var Yyear6 = arr6[2];
			var TotalDays6 = Mmonths6+' '+Dday6+' '+Yyear6;	
						
var date3 = new Date(Yyear3+','+Mmonths3+','+Dday3);	
var date4 = new Date(Yyear4+','+Mmonths4+','+Dday4);

var date5 = new Date(Yyear5+','+Mmonths5+','+Dday5);
var date6 = new Date(Yyear6+','+Mmonths6+','+Dday6);	
		
		
		
	if(saveStartDate==null){
		
$(saveEPapa).find('.dateselect').attr('value',saveTextEnd);
$(saveEPapa).find('span.magic').empty();
$(saveEPapa).find('input[type="hidden"]').attr('value',saveTextEnd);
$(saveEPapa).find('.dateselect').after('<span class="magic">'+saveTextEnd+'</span>');
		
		
	}
	else
	{
	
	if(date4>date6) {
		$(saveEPapa).find('input').removeAttr('value');
			alert('Activity end date should be less than Project Finish Date');		
		}
			
else if (date4>=date3){
	$(saveEPapa).find('.dateselect').attr('value',saveTextEnd);
$(saveEPapa).find('span.magic').empty();
$(saveEPapa).find('input[type="hidden"]').attr('value',saveTextEnd);
$(saveEPapa).find('.dateselect').after('<span class="magic">'+saveTextEnd+'</span>');

}
else
{
$(saveEPapa).find('input').removeAttr('value');
alert('End date should be greater then Start Date');	
}
	}


 $('#myEndtimepicker').modal('hide');
 
});

/************************************** date picker with validation End ********************************/  

</script>

 <!-- new dashboard js -->


    <!-- bootstrap-daterangepicker -->
    <script>
      $(document).ready(function() {
        var cb = function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
          $('#reportrange_right span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        };

	
		$('#single_cal2').datetimepicker();

     
        $('#reportrange_right span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));

        $('#reportrange_right').daterangepicker(optionSet1, cb);

        $('#reportrange_right').on('show.daterangepicker', function() {
          console.log("show event fired");
        });
        $('#reportrange_right').on('hide.daterangepicker', function() {
          console.log("hide event fired");
        });
        $('#reportrange_right').on('apply.daterangepicker', function(ev, picker) {
          console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
        });
        $('#reportrange_right').on('cancel.daterangepicker', function(ev, picker) {
          console.log("cancel event fired");
        });

        $('#options1').click(function() {
          $('#reportrange_right').data('daterangepicker').setOptions(optionSet1, cb);
        });

        $('#options2').click(function() {
          $('#reportrange_right').data('daterangepicker').setOptions(optionSet2, cb);
        });

        $('#destroy').click(function() {
          $('#reportrange_right').data('daterangepicker').remove();
        });

      });
    </script>


<script src="<?php echo base_url();?>vendors/raphael/raphael.min.js"></script>
<script src="<?php echo base_url();?>vendors/morris.js/morris.min.js"></script>
  
<script src="<?php echo base_url();?>vendors/validator/validator.js"></script>
<script src="<?php echo base_url();?>js/confirm/jquery.confirm.js"></script>
<!--<script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
<script>
	$(function () {
		CKEDITOR.replace('editor1');
		$(".textarea").wysihtml5();
	});
</script>-->


  
	<script>  
	$("#clearwbs").confirm({
		text: "Are you sure you want clear WBS for this project?",
    	title: "Confirmation required",
		confirm: function() {
		$.ajax({
		 url:'<?php echo base_url()."wbs_list/clearwbs" ?>',
		 type:'post',
		 data:{'pid':'<?php echo $this->uri->segment('3')?>'},
		 success: function(data){
			 //alert(data);
				alert(data);
				location.reload();
			 },
			error: function(){
				alert('testing');
			} 
		 
		 });
		}
	
	});
	
	$(".actiondel").confirm({text: "Are you sure you want to delete this project?",
    title: "Confirmation required",});
	
	
	
	function delet_docu(did){
		
		$(".del_docu").confirm({text: "Are you sure you want to delete this?",
    title: "Confirmation required", confirm: function(button) {
       $.ajax({
		 url:'<?php echo base_url()."add_project/delete_activity" ?>',
		 type:'post',
		 data:{'did':did},
		 success: function(data){
			 //alert(data);
		alert('Document deleted.');
			 }
		 
		 });
    },});
	
		

	}
	
	
    </script>
	
 <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script>
$('textarea').on('paste', function(e){
      var $this = $(this);
      $.each(e.originalEvent.clipboardData.items, function(i, v){
          if (v.type === 'text/plain'){
              v.getAsString(function(text){
                  var x = $this.closest('td').index(),
                      y = $this.closest('tr').index()+1,
                      obj = {};
                  text = text.trim('\r\n');
                  $.each(text.split('\r\n'), function(i2, v2){
                      $.each(v2.split('\t'), function(i3, v3){
                          var row = y+i2, col = x+i3;
                          obj['cell-'+row+'-'+col] = v3;
                          $this.closest('table').find('tr:eq('+row+') td:eq('+col+') textarea').val(v3);
                      });
                  });

              });
          }
      });
      return false;

  });
function PreviewImage() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("uploadBtn1").files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById("uploadPreview").src = oFREvent.target.result;
        };
    };

      
//preloader

	//<![CDATA[
		$(window).load(function() { // makes sure the whole site is loaded
			$('#status').fadeOut(); // will first fade out the loading animation
			/*$('#preloader').delay(350).fadeOut('slow');*/ // will fade out the white DIV that covers the website.
			$('body').delay(350).css({'overflow':'visible'});
		})
	//]]>

$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').focus()
})

     </script>
           <script>	 
		   
		   $('button[name="btn_submit"]').click(function(e){
			   
			document.getElementById('is_wbs_submitted').value  =1; 
		   });
		   
		   $('button[name="btn_save"]').click(function(e){
			document.getElementById('is_wbs_submitted').value   =1;    
			   
			   
		   });
		   $('button[name="btn_submit"]').click(function(e){
			  
			
			 hasError1 = false;
			 re = /^\d{1,2}\/\d{1,2}\/\d{4}$/;
			
			$('.clone_from>#datatable-keytable_wrapper>tbody>tr').not(':last').each(function() {
				 //alert(456);
              var MegaprocessText = $(this).find('.mpr').val();
			  //alert(MegaprocessText);
			  if(MegaprocessText != ''){				
				    var saveIndex=$(this).find('.mpr').parent().parent().index();	
					var Plusone = saveIndex+1;
					//alert(Plusone);	
					var ProcessWalaIndex = Plusone+1;
					var ActivityWalaIndex = Plusone+2;					
					var ProcessText = $('.clone_from #datatable-keytable_wrapper tbody tr:nth-child('+ProcessWalaIndex+')').find('.pr').val();
					var ActivityText = $('.clone_from #datatable-keytable_wrapper tbody tr:nth-child('+ActivityWalaIndex+')').find('.activity_area').val();
					if(ProcessText != ''){
					
					}
					else
					{
						hasError1 = true;
					}
					if(ActivityText != ''){
					//alert(ActivityText);
					}
					else
					{
						hasError1 = true;
					}
					if($(this).find('.mpr').parent().parent().next().is('tr')) {
					//alert('truePR');	
					}
					else
					{
					//alert('falsePR');	
					hasError1 = true;
					}
					if($(this).find('.mpr').parent().parent().next().next().is('tr')) {
				//	alert('trueactivity_area');	
					}
					else
					{
					//alert('falseActivity');	
					hasError1 = true;
					}
					
							  
			  }
			  
			  
			  var mainprocessText = $(this).find('.pr').val();
			  if(mainprocessText != ''){				
				    var saveIndexB=$(this).find('.pr').parent().parent().index();	
					var PlusoneB = saveIndexB+1;
					var ActivityWalaIndexB = PlusoneB+1;					
					var ActivityTextB = $('.clone_from #datatable-keytable_wrapper tbody tr:nth-child('+ActivityWalaIndexB+')').find('.activity_area').val();
					if(ActivityTextB != ''){
					//alert(ActivityText);
					}
					else
					{
						hasError1 = true;
					}
					if($(this).find('.pr').parent().parent().next().is('tr')) {
					//alert('truePR');	
					}
					else
					{
					//alert('falsePR');	
					hasError1 = true;
					}
					
					
							  
			  }
			  
						
            });
			
				var haserror = false;	
				var FormName = $(this).parent();
				$(FormName).find('.clone_from #datatable-keytable_wrapper tbody tr').each(function(index, element) {
					var ActivityArea = $(this).find('.activity_area');
					var Sarea = $(this).find(".assign_person option:selected").text();
					
					var stdate = $(this).find(".stdate").val();
					var endate = $(this).find(".endate").val();
					
					//alert('asd'+Sarea+'sad');
					$(this).find('.assign_person').removeClass('error');
					$(this).find('.stdate').removeClass('error');
					$(this).find('.endate').removeClass('error');
								
						if(Sarea=='Select ' || stdate=='' || endate==''){
							var re = /^\d{2}\/\d{2}\/\d{4}$/;
							var redatetime = /^\d{2}\/\d{2}\/\d{4} \d{2}:\d{2}:\d{2}$/;
							if ($.trim($(ActivityArea).val())) {
							//$(ActivityArea).parent().parent().find('.assign_person').addClass('mandatory');
							if(Sarea=='Select '){
							$(this).find('.assign_person').addClass('error');
							//alert($(this).attr('class'));							
							}
							if(stdate==''){
								
							$(this).find('.stdate').addClass('error');
							}else if(stdate!='' && !(stdate.match(redatetime) || stdate.match(re))){
								
							$(this).find('.stdate').addClass('error');
							}
							if(endate==''){
								$(this).find('.endate').addClass('error');
							}else if(endate!='' && !(endate.match(redatetime) || endate.match(re))){
								$(this).find('.endate').addClass('error');
							}
							haserror = true;
							}
							else
							{
								
						//$(ActivityArea).parent().parent().find('.assign_person').removeClass('mandatory');
						
							}
							 
						}else if(stdate!='' || endate!=''){
							var re = /^\d{2}\/\d{2}\/\d{4}$/;
							var redatetime = /^\d{2}\/\d{2}\/\d{4} \d{2}:\d{2}:\d{2}$/;
							if ($.trim($(ActivityArea).val())) {
								if(stdate!='' && !(stdate.match(redatetime) || stdate.match(re))){
								//alert(1);
								$(this).find('.stdate').addClass('error');
								haserror = true;
								}
								else if(endate!='' && !(endate.match(redatetime) || endate.match(re))){
									//alert(2);
								$(this).find('.endate').addClass('error');
								haserror = true;
								}else{
								haserror = false; }
							}
						}
					
		
				
			});
			if(hasError1==true){
			alert('Please Check all Process and Activity based on Mega Process');	
			return false;	
			}
			else if (haserror==true){
				alert('Please fill Responsibility, Start date and End date for all activities.');
				return false;				
			}
			else{
		
			    var $form=$(this).closest('#wbsform');
    			e.preventDefault();
   				 $('#confirm').modal({ backdrop: 'static', keyboard: false })
    			    .one('click', '#confirm', function (e) {
       		    	 $form.trigger('submit');
     				   });
	
	
			}
			//return true;
			
		   });
		   
		   
		   
		   
		   $('.assign_person').prop('readonly',true);
$('#datatable-keytable_wrapper tbody tr').each(function(index, element) {
	var ActivityArea = $(this).find('.activity_area');
    if (!$.trim($(ActivityArea).val())) {
  $(ActivityArea).parent().parent().find('.assign_person').prop('readonly',true);
  $(ActivityArea).parent().parent().find('.assign_person').parent().addClass('disableChild');
}
else
{
  $(ActivityArea).parent().parent().find('.assign_person').prop('readonly',false);	
  $(ActivityArea).parent().parent().find('.assign_person').parent().removeClass('disableChild');
}
});		   




$(".activity_area").keyup(function(){
if($(this).val()) {
    $(this).parent().parent().find('.assign_person').prop('readonly',false);
	 $(this).parent().parent().find('.assign_person').parent().removeClass('disableChild');
	$(this).parent().parent().find('.assign_person option:first').attr('selected',false);
}
else
{
$(this).parent().parent().find('.assign_person').prop('readonly',true);	
$(this).parent().parent().find('.assign_person').parent().addClass('disableChild');
$(this).parent().parent().find('.assign_person option:first').attr('selected',true);
}
});


$('#datatable-keytable_wrapper tbody tr').each(function(index, element) {
var MPR = $(this).find('.mpr');	
	   if (!$.trim($(MPR).val())) {
	$(MPR).parent().nextAll().removeClass('disableChild');
}
else
{
	
	setTimeout(function(){$(MPR).parent().nextAll().addClass('disableChild');},1000)
	
}
	
	
});

$(".mpr").keyup(function(){
	
if($(this).val()){
	$(this).parent().nextAll().addClass('disableChild');
	$(this).parent().nextAll().children().val('');
	$(this).parent().nextAll().children().find('input').val('');
	$(this).parent().nextAll().children().find('.dateselect').removeAttr('value');
	$(this).parent().nextAll().children().find('.magic').empty();
	$(this).parent().parent().find('.assign_person option:first').attr('selected',false);
}
else
{
	$(this).parent().nextAll().removeClass('disableChild');
	$(this).parent().parent().find('.assign_person option:first').attr('selected',true);
}


		
		
		$('#datatable-keytable_wrapper tbody tr').each(function(index, element) {
	var ActivityArea = $(this).find('.activity_area');
    if (!$.trim($(ActivityArea).val())) {
  $(ActivityArea).parent().parent().find('.assign_person').prop('readonly',true);
  $(ActivityArea).parent().parent().find('.assign_person').parent().addClass('disableChild');
}
else
{
  $(ActivityArea).parent().parent().find('.assign_person').prop('readonly',false);	
  $(ActivityArea).parent().parent().find('.assign_person').parent().removeClass('disableChild');
}
});		


$('#datatable-keytable_wrapper tbody tr').each(function(index, element) {
var MPR = $(this).find('.mpr');	
	   if (!$.trim($(MPR).val())) {
	$(MPR).parent().nextAll().removeClass('disableChild');
}
else
{
	
	setTimeout(function(){$(MPR).parent().nextAll().addClass('disableChild');},1000)
	
}
	
	
});




$('#datatable-keytable_wrapper tbody tr').each(function(index, element) {
var MPR = $(this).find('.pr');	
	   if (!$.trim($(MPR).val())) {
	$(MPR).parent().nextAll().removeClass('disableChild');
}
else
{
		setTimeout(function(){$(MPR).parent().nextAll().addClass('disableChild');},1000);
}
	
	
});

  
	
});





$('#datatable-keytable_wrapper tbody tr').each(function(index, element) {
var MPR = $(this).find('.pr');	
	   if (!$.trim($(MPR).val())) {
	$(MPR).parent().nextAll().removeClass('disableChild');
}
else
{
		setTimeout(function(){$(MPR).parent().nextAll().addClass('disableChild');},1000);
}
	
	
});

$(".pr").keyup(function(){
if($(this).val()){
	$(this).parent().nextAll().addClass('disableChild');
	$(this).parent().nextAll().children().val('');
	$(this).parent().nextAll().children().find('input').val('');
	$(this).parent().nextAll().children().find('.dateselect').val('');
	$(this).parent().nextAll().children().find('.magic').empty();
	$(this).parent().parent().find('.assign_person option:first').attr('selected',false);
}
else
{
	$(this).parent().nextAll().removeClass('disableChild');
	$(this).parent().parent().find('.assign_person option:first').attr('selected',true);
}
});


		   
		   
var TbodyHeight =  $('.clone_from').height()+20;
var saveTbodyHeight= '-'+TbodyHeight+'px';
var theadht =  $('.clone_from thead').height();
$('.clone_to').css('height',theadht);
//$('.clone_from').css('margin-top','-'+theadht+'px');
$('.clone_from table').clone().appendTo('.clone_to');
$('.clone_to textarea').attr('readonly','readonly');
//$('.clone_to').find('tbody>tr:first-child ~tr').remove();
setTimeout(function(){ $('.clone_to textarea').removeAttr('name');
$('.clone_to select').removeAttr('name'); },1000);


$( ".overflow_horizon" ).scroll(function() {
$('.clone_to textarea').removeAttr('name');
$('.clone_to input').removeAttr('name');
var position =$(this).scrollTop();
if(position>theadht){
$('.clone_to').css('top',position);
$('.clone_to').css('opacity',1);
$('.clone_to').css('z-index',9999);
}
else
{
$('.clone_to').css('opacity',0);
$('.clone_to').css('z-index',-1);
}
});

function Emptyclonliness(){
$('.clone_to').empty();	
};
function clonliness(){
$('.clone_from>table').clone().appendTo('.clone_to');
var TbodyHeight =  $('.clone_from').height()+20;
var saveTbodyHeight= '-'+TbodyHeight+'px';
var theadht =  $('.clone_from thead').height();
$('.clone_to').css('height',theadht);
//$('.clone_to').find('tbody>tr:first-child ~ tr').remove();
$('.clone_to textarea').attr('readonly','readonly');
$('.clone_to textarea').removeAttr('name');
$('.clone_to select').removeAttr('name');
$('.clone_to input').removeAttr('name');
};

/*$(".clone_from").keyup(function(){
 Emptyclonliness();
 clonliness();
});*/
	   
		   
		   
		   $('#datatable-keytable_wrapper tr th').each(function(index) {
                    $(this).addClass("cell"+(index+1));
					$(this).find('textarea').removeAttr("name");
					$(this).find('textarea').attr("name","cell[]");
                });
				
				$('#datatable-keytable_wrapper tbody tr').each(function(index) {
					
                    $(this).addClass("row"+(index+1));
					var saveRowindex = index+1;
					$(this).find('td').each(function(index) {
                    $(this).addClass("row"+saveRowindex+"C"+(index+1));
					$(this).find('textarea').removeAttr("name");
					$(this).find('textarea').attr("name","rowC"+(index+1)+"[]");
               
                });
				
                });
				
				
			function setRowCell(){
				$('#datatable-keytable_wrapper tbody tr').each(function(index) {
                    $(this).addClass("row"+(index+1));
					var saveRowindex = index+1;
					$(this).find('td').each(function(index) {
                    $(this).addClass("row"+saveRowindex+"C"+(index+1));
					$(this).find('textarea').removeAttr("name");
					$(this).find('textarea').attr("name","rowC"+(index+1)+"[]");
                });
                });
				
			};
			function emptySetRowCell(){
				$('#datatable-keytable_wrapper tbody tr').each(function(index) {
                    $(this).removeAttr("class");
					//var saveRowindex = index+1;
					$(this).find('td').each(function(index) {
                     $(this).removeAttr("class");
					 $(this).find('textarea').removeAttr("name");
                });
				
                });
			};
			
			function setCell(){
				$('#datatable-keytable_wrapper tr th').each(function(index) {
                    $(this).addClass("cell"+(index+1));
					$(this).find('textarea').removeAttr("name");
					$(this).find('textarea').attr("name","cell[]");
                });  
				};
				
				function emptyCell(){
				$('#datatable-keytable_wrapper tr th').each(function(index) {
                    $(this).removeAttr("class");
					$(this).find('textarea').removeAttr("name");
                }); 
				};
				
				
				var k=0;
		$('body').on('click',".insert_col",function(){
			var colindex = $(this).parents('th').index()+1;
			
		 var list_togg ='<th class="cell'+colindex+'"><textarea name="cell'+colindex+'[]" cols="10" rows="1"></textarea><div class="mtn_togg"><span class="toggle_insert"><i class="fa fa-angle-right"></i></span><span class="hover_toggle"><small class="insert_col">Insert</small><small class="delete_col">Delete</small></span></div></th>';
			
			$(this).parents('th').before(list_togg);
		var saveindex = $('#datatable-keytable_wrapper thead th.cell'+colindex+' textarea').parent().index();
			
			
			var saveindexPlusOne=saveindex+1;
			$('#datatable-keytable_wrapper tbody tr').each(function(index) {
     $(this).find('td:nth-child('+saveindexPlusOne+')').before('<td class="row'+(index+1)+'Cell'+colindex+'"><textarea cols="10" rows="1"></textarea></td>');
            });
			
				
			emptySetRowCell();
			setRowCell();
			//alert(colindex);
			//remove class
			emptyCell();
			//remove class	
			setCell();
			Emptyclonliness();
			clonliness();
			
			
				$('#datatable-keytable_wrapper tbody tr').each(function(index, element) {
				var MPR = $(this).find('.mpr');	
					   if (!$.trim($(MPR).val())) {
					$(MPR).parent().nextAll().removeClass('disableChild');
				}
				else
				{
					//alert(1);
					setTimeout(function(){$(MPR).parent().nextAll().addClass('disableChild');},1000);
				}
					
					
				});
				
				
				$('#datatable-keytable_wrapper tbody tr').each(function(index, element) {
				var MPR1 = $(this).find('.pr');	
					   if (!$.trim($(MPR1).val())) {
					$(MPR1).parent().nextAll().removeClass('disableChild');
				}
				else
				{
					$(MPR1).parent().nextAll().addClass('disableChild');
				}
					
					
				});
			
			
			});
			
			
			$('body').on('click',".delete_col",function(){	
			
					
		$('#datatable-keytable_wrapper tbody tr').each(function(index, element) {
	var ActivityArea = $(this).find('.activity_area');
    if (!$.trim($(ActivityArea).val())) {
  $(ActivityArea).parent().parent().find('.assign_person').prop('readonly',true);
  $(ActivityArea).parent().parent().find('.assign_person').parent().addClass('disableChild');
}
else
{
  $(ActivityArea).parent().parent().find('.assign_person').prop('readonly',false);	
  $(ActivityArea).parent().parent().find('.assign_person').parent().removeClass('disableChild');
}
});		


$('#datatable-keytable_wrapper tbody tr').each(function(index, element) {
var MPR = $(this).find('.mpr');	
	   if (!$.trim($(MPR).val())) {
	$(MPR).parent().nextAll().removeClass('disableChild');
}
else
{
	
	setTimeout(function(){$(MPR).parent().nextAll().addClass('disableChild');},1000)
	
}
	
	
});



$('#datatable-keytable_wrapper tbody tr').each(function(index, element) {
var MPR = $(this).find('.pr');	
	   if (!$.trim($(MPR).val())) {
	$(MPR).parent().nextAll().removeClass('disableChild');
}
else
{
		setTimeout(function(){$(MPR).parent().nextAll().addClass('disableChild');},1000);
}
	
	
});
		
			//$(this).parents('th').remove;
var saveindex = $(this).parents('th').index();
//var onebefore = saveindex-1;
//alert(onebefore);		
			$(this).parents('tr').find('th:nth-child('+saveindex+')').remove();	
			$(this).parents('#datatable-keytable_wrapper').find('tbody tr').each(function() {
                $(this).find('td:nth-child('+saveindex+')').remove();
            });
			
			emptySetRowCell();
			setRowCell();
			
			//remove class
			emptyCell();
			//remove class	
			setCell();
			Emptyclonliness();
			clonliness();
			});
			

	var SaveLengtho = $('.clone_from #datatable-keytable_wrapper tbody tr').length;
	TargetkrChild = SaveLengtho -1;
	Hitagain(TargetkrChild);
	function Hitagain(TargetkrChild){
		
	$('.clone_from #datatable-keytable_wrapper tbody tr:nth-child('+TargetkrChild+')  td textarea').click(function(){
		if($('.clone_from #datatable-keytable_wrapper tbody tr:nth-child('+TargetkrChild+')').attr('id')){
		//alert('mil-gyi');	
		}else
		{		
		$('.clone_from #datatable-keytable_wrapper tbody tr:nth-child('+TargetkrChild+')  .icono .insert_row').trigger("click");
		$('.clone_from #datatable-keytable_wrapper tbody tr:nth-child('+TargetkrChild+')').attr('id','bye-bye');
		}
		
		});
		//alert(TargetChildskar);
	}
	
				
			
// 	$('body').on('click',".icono .insert_row", function(){
	
		
		
// 		$('#datatable-keytable_wrapper tbody tr').each(function(index, element) {
// 	var ActivityArea = $(this).find('.activity_area');
//     if (!$.trim($(ActivityArea).val())) {
//   $(ActivityArea).parent().parent().find('.assign_person').prop('readonly',true);
//   $(ActivityArea).parent().parent().find('.assign_person').parent().addClass('disableChild');
// }
// else
// {
//   $(ActivityArea).parent().parent().find('.assign_person').prop('readonly',false);	
//   $(ActivityArea).parent().parent().find('.assign_person').parent().removeClass('disableChild');
// }
// });		


// $('#datatable-keytable_wrapper tbody tr').each(function(index, element) {
// var MPR = $(this).find('.mpr');	
// 	   if (!$.trim($(MPR).val())) {
// 	$(MPR).parent().nextAll().removeClass('disableChild');
// }
// else
// {
	
// 	setTimeout(function(){$(MPR).parent().nextAll().addClass('disableChild');},1000)
	
// }
	
	
// });



// $('#datatable-keytable_wrapper tbody tr').each(function(index, element) {
// var MPR = $(this).find('.pr');	
// 	   if (!$.trim($(MPR).val())) {
// 	$(MPR).parent().nextAll().removeClass('disableChild');
// }
// else
// {
// 		setTimeout(function(){$(MPR).parent().nextAll().addClass('disableChild');},1000);
// }
	
	
// });

// 		//alert($('this').attr('class'));
// //       $('.table1 tbody').append($(".table1 tbody tr:first").clone());
//         var $curRow = $(this).parents('.icono').closest('tr'),
//         $curRow = $(this).parents('.icono').parent().parent();
//                 $newRow = $curRow.clone(true);
//                 $curRow.after($newRow);
//           //$('.table2 tbody tr td input[type="text"]').val(""); 
		  
// 		     $newRow.find("td textarea, td input[type='text']").val("");
// 			// $newRow.find("td select").prepend("<option selected></option>");
// 			 $newRow.find('span.magic').remove();
// 			 $newRow.find('input[type="hidden"]').attr('value','');
// 			 $newRow.find('input.dateselect').attr('value','');
// 			 	emptySetRowCell();
// 			setRowCell();
// 			Emptyclonliness();
// 			clonliness();
			
// 				var SaveLength = $('.clone_from #datatable-keytable_wrapper tbody tr').length;
// 			TargetChild = SaveLength-1;
// 	//var saveClassKar = $('.clone_from #datatable-keytable_wrapper tbody tr:nth-child('+TargetChild+')').attr('class'); 
// 		//	alert(saveClassKar);
// 			Hitagain(TargetChild);
//     });

$(".increment").on('click',function(){
		var value = parseInt($(this).next('.quantity').val());
		if (value < 50) {
			$(this).next('.quantity').val(value + 1);
		}
	})	
	$(".decrement").on('click',function(){ 
		var value = parseInt($(this).parent().find('.quantity').val());
		if (value > 1 && value <= 50) {
			$(this).parent().find('.quantity').val(value - 1);
		}
	 })	 
	 $('body').on('click', ".icono .insert_row", function () {
		
		 
		var totals = $(this).parent().find('.quantity').val();
		if (totals) {
		var $datatableRows = $('#datatable-keytable_wrapper tbody tr');

		function processInput($input, toggleClass) {
			if (!$.trim($input.val())) {
			$input.closest('tr').find('.assign_person').prop('readonly', true).parent().addClass('disableChild');
			} else {
			$input.closest('tr').find('.assign_person').prop('readonly', false).parent().removeClass('disableChild');
			}
		}

		function processMPR(inputSelector, delay) {
			$datatableRows.each(function (index, element) {
			var $MPR = $(this).find(inputSelector);
			if (!$.trim($MPR.val())) {
				$MPR.parent().nextAll().removeClass('disableChild');
			} else {
				setTimeout(function () {
				$MPR.parent().nextAll().addClass('disableChild');
				}, delay);
			}
			});
		}

		for (let i = 0; i < totals; i++) {
			$datatableRows.each(function (index, element) {
				console.log(element);
				processInput($(this).find('.activity_area'), 1000);
			});

			processMPR('.mpr', 100);
			processMPR('.pr', 100);

			var $curRow = $(this).parents('.icono').closest('tr');
			var $newRow = $curRow.clone(true);
			$curRow.after($newRow);
			$newRow.find("td textarea, td input[type='text']").val("");
			$newRow.find('span.magic').remove();
			$newRow.find('input[type="hidden"]').val('');
			$newRow.find('input.dateselect').val('');
			//$newRow.find('input.stdate').removeClass('hasDatepicker').removeData('datepicker').unbind().datetimepicker({ format: 'DD/MM/YYYY HH:mm:ss' });
			emptySetRowCell();
			setRowCell();
			Emptyclonliness();
			clonliness();

			var SaveLength = $('.clone_from #datatable-keytable_wrapper tbody tr').length;
			var TargetChild = SaveLength - 1;
			Hitagain(TargetChild);
		}
		} else {
			$('#datatable-keytable_wrapper tbody tr').each(function (index, element) {
				var ActivityArea = $(this).find('.activity_area');
				if (!$.trim($(ActivityArea).val())) {
					$(ActivityArea).parent().parent().find('.assign_person').prop('readonly', true);
					$(ActivityArea).parent().parent().find('.assign_person').parent().addClass('disableChild');
				} else {
					$(ActivityArea).parent().parent().find('.assign_person').prop('readonly', false);
					$(ActivityArea).parent().parent().find('.assign_person').parent().removeClass('disableChild');
				}
			});


				$('#datatable-keytable_wrapper tbody tr').each(function (index, element) {
				var MPR = $(this).find('.mpr');
				if (!$.trim($(MPR).val())) {
					$(MPR).parent().nextAll().removeClass('disableChild');
				} else {

					setTimeout(function () {
						$(MPR).parent().nextAll().addClass('disableChild');
					}, 1000)

				}


				});


				$('#datatable-keytable_wrapper tbody tr').each(function (index, element) {
				var MPR = $(this).find('.pr');
				if (!$.trim($(MPR).val())) {
					$(MPR).parent().nextAll().removeClass('disableChild');
				} else {
					setTimeout(function () {
						$(MPR).parent().nextAll().addClass('disableChild');
					}, 1000);
				}


				});

				//alert($('this').attr('class'));
				//       $('.table1 tbody').append($(".table1 tbody tr:first").clone());
				var $curRow = $(this).parents('.icono').closest('tr'),
				$curRow = $(this).parents('.icono').parent().parent();
				$newRow = $curRow.clone(true);
				$curRow.after($newRow);
				//$('.table2 tbody tr td input[type="text"]').val(""); 

				$newRow.find("td textarea, td input[type='text']").val("");
				// $newRow.find("td select").prepend("<option selected></option>");
				$newRow.find('span.magic').remove();
				$newRow.find('input[type="hidden"]').attr('value', '');
				$newRow.find('input.dateselect').attr('value', '');
				emptySetRowCell();
				setRowCell();
				Emptyclonliness();
				clonliness();

				var SaveLength = $('.clone_from #datatable-keytable_wrapper tbody tr').length;
				TargetChild = SaveLength - 1;
				//var saveClassKar = $('.clone_from #datatable-keytable_wrapper tbody tr:nth-child('+TargetChild+')').attr('class'); 
				//	alert(saveClassKar);
				Hitagain(TargetChild);
		}	
		
	});
	
	
	
	$('body').on('click',".icono .delete_row", function(){
		
				
		$('#datatable-keytable_wrapper tbody tr').each(function(index, element) {
	var ActivityArea = $(this).find('.activity_area');
    if (!$.trim($(ActivityArea).val())) {
  $(ActivityArea).parent().parent().find('.assign_person').prop('readonly',true);
  $(ActivityArea).parent().parent().find('.assign_person').parent().addClass('disableChild');
}
else
{
  $(ActivityArea).parent().parent().find('.assign_person').prop('readonly',false);	
  $(ActivityArea).parent().parent().find('.assign_person').parent().removeClass('disableChild');
}
});		


$('#datatable-keytable_wrapper tbody tr').each(function(index, element) {
var MPR = $(this).find('.mpr');	
	   if (!$.trim($(MPR).val())) {
	$(MPR).parent().nextAll().removeClass('disableChild');
}
else
{
	
	setTimeout(function(){$(MPR).parent().nextAll().addClass('disableChild');},1000)
	
}
	
	
});



$('#datatable-keytable_wrapper tbody tr').each(function(index, element) {
var MPR = $(this).find('.pr');	
	   if (!$.trim($(MPR).val())) {
	$(MPR).parent().nextAll().removeClass('disableChild');
}
else
{
		setTimeout(function(){$(MPR).parent().nextAll().addClass('disableChild');},1000);
}
	
	
});


		var saverowindex = $(this).parents('tr').index()+1;
		$('#datatable-keytable_wrapper tbody tr:nth-child('+saverowindex+')').remove();
			emptySetRowCell();
			setRowCell();
			Emptyclonliness();
			clonliness();
		
	});
	

$('#datetstarting').daterangepicker({
  
});




<?php 
if($this->uri->segment('1')=="edit_wbs") {?>
function onReady(callback) {
    var intervalID = window.setInterval(checkReady, 1000);

    function checkReady() {
        if (document.getElementsByTagName('body')[0] !== undefined) {
            window.clearInterval(intervalID);
            callback.call(this);
        }
    }
}

function show(id, value) {
    document.getElementById(id).style.display = value ? 'block' : 'none';
}

onReady(function () {
    show('content', true);
    show('load', false);
});
	<?php } ?>
	
	function validate_date(){
		var start_date=$("#start_date").val();
		var end_date=$("#end_date").val();
		if(start_date!='' && end_date!=''){
			if(Date.parse(start_date)== Date.parse(end_date))
			{
				return true;
			}
			else if(Date.parse(start_date) > Date.parse(end_date))
			{
			alert("Start Date Should be less than end date");
			return false;
			}	
		
	}
	
	}
	
function getUsersList(value){
	
	 $.ajax({
		 url:'<?php echo base_url()."add_project/get_project_users" ?>',
		 type:'post',
		 data:{'pid':value},
		 success: function(data){
			 //alert(data);
		$('#userid').html(data);	
			 }
		 
		 });
}

$("#pfilter").click(function(){ 

	var pstart=$("#project_start_date").val();
	var pend=$("#project_end_date").val();
	
	var d1=$("#start_date_activity").val();
	var d2=$("#end_date_activity").val();
	
	
	 var arr3 = pstart.split('/');
			var Dday3 = arr3[0];
			var Mmonths3 = arr3[1];
			var Yyear3 = arr3[2];
			var TotalDays3 = Mmonths3+' '+Dday3+' '+Yyear3;
			//alert(Dday3);
var arr4 =	 pend.split('/');
			var Dday4 = arr4[0];
			var Mmonths4 = arr4[1];
			var Yyear4 = arr4[2];
			var TotalDays4 = Mmonths4+' '+Dday4+' '+Yyear4;
			//alert(TotalDays4);	
			
			
var arr5 =	 d1.split('/');
			var Dday5 = arr5[0];
			var Mmonths5 = arr5[1];
			var Yyear5 = arr5[2];
			var TotalDays5 = Mmonths5+' '+Dday5+' '+Yyear5;
			
var arr6 =	 d2.split('/');
			var Dday6 = arr6[0];
			var Mmonths6 = arr6[1];
			var Yyear6 = arr6[2];
			var TotalDays6 = Mmonths6+' '+Dday6+' '+Yyear6;	
			
var date3 = new Date(Yyear3+','+Mmonths3+','+Dday3);	
var date4 = new Date(Yyear4+','+Mmonths4+','+Dday4);

var date5 = new Date(Yyear5+','+Mmonths5+','+Dday5);
var date6 = new Date(Yyear6+','+Mmonths6+','+Dday6);	

if(date5 < date3){
	alert("Start Date should be greater than project start date");
	return false;	
}else if(date6 > date4) {
alert("Finish Date should be less than project end date");
	return false;	
	
}

});
<?php 
if($this->uri->segment('1')=="edit_wbs" || $this->uri->segment('1')=="wbs" ) {?>
	$(document).keydown(function(objEvent) {
    if (objEvent.keyCode == 9) {  //tab pressed
        objEvent.preventDefault(); // stops its action
    }
})
<?php } ?>
		</script>
    <!-- Modal -->
<div id="navModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Menu</h4>
      </div>
      <div class="modal-body">

           <div class="col-md-6 col-sm-6 col-xs-12">
           <a href="<?= base_url();?>add_project/"> 
               <div class="icon">
                   <img class="img-responsive" src="<?= base_url()?>images/my-project.png" alt=""/>
                   <p>My Project</p>
               </div>
               </a>
           </div>
           
           <div class="col-md-6 col-sm-6 col-xs-12">
            <a href="<?= base_url();?>add_users/view_users/">
               <div class="icon">
                   <img class="img-responsive" src="<?= base_url()?>images/users.png" alt=""/>
                   <p>Users</p>
               </div>
               </a>
           </div>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <a href="<?= base_url();?>add_project/"> 
               <div class="icon">
                   <img class="img-responsive" src="<?= base_url()?>images/wbs2.png" alt=""/>
                   <p>WBS</p>
               </div>
               </a>
           </div>
           
           <div class="col-md-6 col-sm-6 col-xs-12">
            <a href="<?= base_url();?>add_project/"> 
               <div class="icon">
                   <img class="img-responsive" src="<?= base_url()?>images/performance.png" alt=""/>
                   <p>Performance</p>
               </div>
               </a>
           </div>
           <div class="col-md-6 col-sm-6 col-xs-12">
               <div class="icon">
                   <img class="img-responsive" src="<?= base_url()?>images/loremipsum1.png" alt=""/>
                   <p>Lorem Ipsum</p>
               </div>
           </div>
           
           <div class="col-md-6 col-sm-6 col-xs-12">
               <div class="icon">
                   <img class="img-responsive" src="<?= base_url()?>images/loremipsum2.png" alt=""/>
                   <p>Lorem Ipsum</p>
               </div>
           </div>
                      
      </div>

      <div class="modal-footer">
<!--        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
      </div>

    </div>

  </div>
</div>

</body>
</html>