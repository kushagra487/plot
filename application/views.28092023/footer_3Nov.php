	
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
                      <input type="text" class="form-control">
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
                      <input type="text" class="form-control">
                      <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span> </div>
                
        <br>
        <button type="submit" class="btn btn-default">Select</button>
      </div>

    </div>

  </div>
</div>
            <!-- /#footer -->
<!-- jQuery -->
<script src="<?= base_url();?>vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?= base_url();?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?= base_url();?>vendors/fastclick/lib/fastclick.js"></script>
<!-- iCheck -->
<script src="<?= base_url();?>vendors/iCheck/icheck.min.js"></script>
<!-- Skycons -->
<script src="<?= base_url();?>vendors/skycons/skycons.js"></script>
<script src="<?= base_url();?>vendors/nprogress/nprogress.js"></script>
<script src="<?= base_url();?>vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url();?>vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?= base_url();?>vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url();?>vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="<?= base_url();?>vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="<?= base_url();?>vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url();?>vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url();?>vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="<?= base_url();?>vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="<?= base_url();?>vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url();?>vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="<?= base_url();?>vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>
<script src="<?= base_url();?>vendors/jszip/dist/jszip.min.js"></script>
<script src="<?= base_url();?>vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="<?= base_url();?>vendors/pdfmake/build/vfs_fonts.js"></script>
<script src="<?= base_url();?>vendors/select2/dist/js/select2.full.min.js"></script>

   <!-- bootstrap-daterangepicker -->
    <script src="<?= base_url();?>js/moment/moment.min.js"></script>
    <script src="<?= base_url();?>js/datepicker/daterangepicker.js"></script>
	
    <!-- Custom Theme Scripts -->
	<script src="<?= base_url();?>build/js/nice-scroll.min.js"></script>
    <script src="<?= base_url();?>build/js/custom.js"></script>
    
    
    <script>
	$('[data-toggle="tooltip"]').tooltip();
function check_dependency(aid){

 $.ajax({
		 url:'<?php echo base_url()."odif/get_dependant_status" ?>',
		 type:'post',
		 data:{'aid':aid},
		 success: function(data){
			 //alert(data);
		$('#ajaxmsg').html(data);	
			 }
		 
		 })	
	
}
</script>

	<script type="text/javascript">
	
	
	   $(document).ready(function() {
		   
		   
		   $("#activity_filter").daterangepicker({
			   format:'DD/MM/YYYY'
			});	
			
			
             /* $('.card-box').mousedown(function (event) {
                  $(this)
                      .data('down', true)
                      .data('x', event.clientX)
                      .data('scrollLeft', this.scrollLeft)
                      .addClass("dragging");

                  return false;
              }).mouseup(function (event) {
                  $(this)
                     .data('down', false)
                     .removeClass("dragging");
              }).mousemove(function (event) {
                  if ($(this).data('down') == true) {
                      this.scrollLeft = $(this).data('scrollLeft') + $(this).data('x') - event.clientX;
                  }
              })*/
			  
			  /*.mousewheel(function (event, delta) {
                  this.scrollLeft -= (delta * 30);
              })*/
			  
			  /*.css({
                  'overflow' : 'hidden',
                  'cursor' : '-moz-grab'
              });*/
             
             });
	
	
	
	
	
	
	
	

	
	
		
    </script>
          <!-- new dashboard js -->
            <script src="<?= base_url();?>application/views/assets/lib/metismenu/metisMenu.js"></script>
            <!-- Screenfull -->
            <script src="<?= base_url();?>application/views/assets/lib/screenfull/screenfull.js"></script>


            <!-- Metis core scripts -->
            <script src="<?= base_url();?>vendors/assets/js/core.js"></script>
            <!-- Metis demo scripts -->
            <script src="<?= base_url();?>vendors/assets/js/app.js"></script>
            
             <script src="<?php echo base_url();?>js/datepicker/bootstrap-datetimepicker.min.js"></script>
              <script src="<?php echo base_url();?>js/datepicker/bootstrap-datetimepicker.min.js"></script>
              <script src="<?php echo base_url();?>js/datepicker/bootstrap-datetimepicker.min.js"></script>
              <script src="<?php echo base_url();?>vendors/datetimepicker/js/bootstrap-datetimepicker.min.js">
              </script>
               <script src="<?php echo base_url();?>vendors/datetimepicker/js/moment.js">
              </script>
<script>

$('#start_date').datetimepicker({ format: 'YYYY-MM-DD'});
$('#end_date').datetimepicker({ format: 'YYYY-MM-DD'});

$('#start_date_activity').datetimepicker({ format: 'DD/MM/YYYY'});
$('#end_date_activity').datetimepicker({ format: 'DD/MM/YYYY'});
			
			
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
		   


	
         });

	 
$('#mytimepicker button[type="submit"]').on('click',function(){
 var saveEndDate = $(savePapa).parent().parent().find('.Enddatesel .magic').text();
 saveTextStart= $(this).parents('#mytimepicker').find('input[type="text"]').val();
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
			//alert(TotalDays2);	
var date1 = new Date(Yyear2+','+Mmonths2+','+Dday2);	
var date2 = new Date(Yyear+','+Mmonths+','+Dday);				
 //alert(saveEndDate);
 if(saveEndDate==''){
	 
	$(savePapa).find('.dateselect').attr('value',saveTextStart);
	$(savePapa).find('span.magic').empty();
	$(savePapa).find('input[type="hidden"]').attr('value',saveTextStart);
	$(savePapa).find('.dateselect').after('<span class="magic">'+saveTextStart+'</span>');	
 }
 else
 {

		if (date1>date2){
			$(savePapa).find('input').removeAttr('value');
		alert('Start date should be less then Finish Date');		
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
			$('#myEndtimepicker').modal('show');
    		
         });
	

$('#myEndtimepicker button[type="submit"]').on('click',function(){
		var saveStartDate = $(saveEPapa).parent().parent().find('.datesel .magic').text();
		saveTextEnd= $(this).parents('#myEndtimepicker').find('input[type="text"]').val();
		 var arr3 = saveStartDate.split('/');
			var Dday3 = arr3[0];
			var Mmonths3 = arr3[1];
			var Yyear3 = arr3[2];
			var TotalDays3 = Mmonths3+' '+Dday3+' '+Yyear3;
			//alert(TotalDays);
var arr4 =	 saveTextEnd.split('/');
			var Dday4 = arr4[0];
			var Mmonths4 = arr4[1];
			var Yyear4 = arr4[2];
			var TotalDays4 = Mmonths4+' '+Dday4+' '+Yyear4;
			//alert(TotalDays2);	
var date3 = new Date(Yyear3+','+Mmonths3+','+Dday3);	
var date4 = new Date(Yyear4+','+Mmonths4+','+Dday4);	
		
		
		
	if(saveStartDate==null){
		
$(saveEPapa).find('.dateselect').attr('value',saveTextEnd);
$(saveEPapa).find('span.magic').empty();
$(saveEPapa).find('input[type="hidden"]').attr('value',saveTextEnd);
$(saveEPapa).find('.dateselect').after('<span class="magic">'+saveTextEnd+'</span>');
		
		
	}
	else
	{
		
if (date4>=date3){
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

        var optionSet1 = {
          startDate: moment().subtract(29, 'days'),
          endDate: moment(),
          minDate: '01/01/2012',
          maxDate: '12/31/2015',
          dateLimit: {
            days: 60
          },
          showDropdowns: true,
          showWeekNumbers: true,
          timePicker: false,
          timePickerIncrement: 1,
          timePicker12Hour: true,
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          opens: 'right',
          buttonClasses: ['btn btn-default'],
          applyClass: 'btn-small btn-primary',
          cancelClass: 'btn-small',
          format: 'MM/DD/YYYY',
          separator: ' to ',
          locale: {
            applyLabel: 'Submit',
            cancelLabel: 'Clear',
            fromLabel: 'From',
            toLabel: 'To',
            customRangeLabel: 'Custom',
            daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
            monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            firstDay: 1
          }
        };

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

    <script>
      $(document).ready(function() {
        var cb = function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        };

        var optionSet1 = {
          startDate: moment().subtract(29, 'days'),
          endDate: moment(),
          minDate: '01/01/2012',
          maxDate: '12/31/2015',
          dateLimit: {
            days: 60
          },
          showDropdowns: true,
          showWeekNumbers: true,
          timePicker: false,
          timePickerIncrement: 1,
          timePicker12Hour: true,
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          opens: 'left',
          buttonClasses: ['btn btn-default'],
          applyClass: 'btn-small btn-primary',
          cancelClass: 'btn-small',
          format: 'MM/DD/YYYY',
          separator: ' to ',
          locale: {
            applyLabel: 'Submit',
            cancelLabel: 'Clear',
            fromLabel: 'From',
            toLabel: 'To',
            customRangeLabel: 'Custom',
            daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
            monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            firstDay: 1
          }
        };
        $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
        $('#reportrange').daterangepicker(optionSet1, cb);
        $('#reportrange').on('show.daterangepicker', function() {
          console.log("show event fired");
        });
        $('#reportrange').on('hide.daterangepicker', function() {
          console.log("hide event fired");
        });
        $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
          console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
        });
        $('#reportrange').on('cancel.daterangepicker', function(ev, picker) {
          console.log("cancel event fired");
        });
        $('#options1').click(function() {
          $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
        });
        $('#options2').click(function() {
          $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
        });
        $('#destroy').click(function() {
          $('#reportrange').data('daterangepicker').remove();
        });
      });
    </script>

    <script>
      $(document).ready(function() {
        /*$('.single_cal1').daterangepicker({
          singleDatePicker: true,
          calender_style: "picker_1"
        }, function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
        });
		*/
		$('body').on('focus',".single_cal1", function(){
    $('.single_cal1').daterangepicker({
         singleDatePicker: true,
         calender_style: "picker_1"
       }, function(start, end, label) {
         console.log(start.toISOString(), end.toISOString(), label);
       });
     });
	 
	 $('#single_cal2').daterangepicker({
          singleDatePicker: true,
          calender_style: "picker_2"
        }, function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
        });
        /*$('#single_cal2').daterangepicker({
          singleDatePicker: true,
          calender_style: "picker_2"
        }, function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
        });
        $('#single_cal3').daterangepicker({
          singleDatePicker: true,
          calender_style: "picker_3"
        }, function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
        });
        $('#single_cal4').daterangepicker({
          singleDatePicker: true,
          calender_style: "picker_4"
        }, function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
        });*/
      });
    </script>

    <script>
      $(document).ready(function() {
		  
		
	  
        $('#reservation').daterangepicker(null, function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
        });
      });
    </script>
    <!-- /bootstrap-daterangepicker -->
<script src="<?= base_url();?>vendors/raphael/raphael.min.js"></script>
    <script src="<?= base_url();?>vendors/morris.js/morris.min.js"></script>
    <script>
    $(document).ready(function() {
        Morris.Bar({
          element: 'graph_bar',
          data: [
            {device: 'JAN', geekbench: 1571},
            {device: 'FEB', geekbench: 655},
            {device: 'MAR', geekbench: 2154}
          ],
          xkey: 'device',
          ykeys: ['geekbench'],
          labels: ['Geekbench'],
          barRatio: 0.4,
          barColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
          xLabelAngle: 0,
          hideHover: 'auto',
          resize: true
        });
        
         Morris.Bar({
          element: 'graph_bar1',
          data: [
            {device: 'APR', geekbench: 380},
            {device: 'MAY', geekbench: 655},
            {device: 'JUN', geekbench: 2500}
          ],
          xkey: 'device',
          ykeys: ['geekbench'],
          labels: ['Geekbench'],
          barRatio: 0.4,
          barColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
          xLabelAngle: 0,
          hideHover: 'auto',
          resize: true
        });
  
     });
</script>

<!-- validator -->
<script src="<?= base_url();?>vendors/validator/validator.js"></script>

<!-- validator -->
    <script>
		// initialize the validator function
		validator.message.date = 'not a real date';
		// validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
		$('form')
		.on('blur', 'input[required], input.optional, select.required', validator.checkField)
		.on('change', 'select.required', validator.checkField)
		.on('keypress', 'input[required][pattern]', validator.keypress);

		$('.multi.required').on('keyup blur', 'input', function() {
			validator.checkField.apply($(this).siblings().last()[0]);
		});

		$('form').submit(function(e) {
			e.preventDefault();
			var submit = true;
			// evaluate the form using generic validaing
			if (!validator.checkAll($(this))) {
				submit = false;
			}
			if (submit)
			this.submit();
			return false;
		});
    </script>
<!-- /validator -->
<script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
<script>
	$(function () {
		CKEDITOR.replace('editor1');
		$(".textarea").wysihtml5();
	});
</script>
<script>
    
	$(document).ready(function() {
		var handleDataTableButtons = function() {
			if ($("#datatable-buttons").length) {
				$("#datatable-buttons").DataTable({
					dom: "Bfrtip",
					buttons: [
						{
							extend: "copy",
							className: "btn-sm"
						},
						{
							extend: "csv",
							className: "btn-sm"
						},
						{
							extend: "excel",
							className: "btn-sm"
						},
						{
							extend: "pdfHtml5",
							className: "btn-sm"
						},
						{
							extend: "print",
							className: "btn-sm"
						},
					],
					responsive: true
				});
			}
		};
		TableManageButtons = function() {
			"use strict";
			return {
					init: function() {
					handleDataTableButtons();
				}
			};
		}();
		$('#datatable').dataTable();
		$('#datatable-keytable').DataTable({
			keys: true
		});
		$('#datatable-responsive').DataTable();
		$('#datatable-scroller').DataTable({
			ajax: "js/datatables/json/scroller-demo.json",
			deferRender: true,
			scrollY: 380,
			scrollCollapse: true,
			scroller: true
		});
		var table = $('#datatable-fixed-header').DataTable({
			fixedHeader: true
		});
		TableManageButtons.init();
	});
	</script>
    <!-- Custom Theme Scripts -->
    <!-- validator -->
    <script>
		// initialize the validator function
		validator.message.date = 'not a real date';
		// validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
		$('form')
		.on('blur', 'input[required], input.optional, select.required', validator.checkField)
		.on('change', 'select.required', validator.checkField)
		.on('keypress', 'input[required][pattern]', validator.keypress);

		$('.multi.required').on('keyup blur', 'input', function() {
			validator.checkField.apply($(this).siblings().last()[0]);
		});
		$('form').submit(function(e) {
			e.preventDefault();
			var submit = true;
			// evaluate the form using generic validaing
			if (!validator.checkAll($(this))) {
				submit = false;
			}
			if (submit)
			this.submit();
			return false;
		});
    </script> 
    <!-- Select2 -->   
    <!-- jQuery Tags Input -->
    <script>
		function onAddTag(tag) {
			//alert("Added a tag: " + tag);
		}
		function onRemoveTag(tag) {
			//alert("Removed a tag: " + tag);
		}
		function onChangeTag(input, tag) {
			//alert("Changed a tag: " + tag);
		}
		$(document).ready(function() {
			$('#tags_1').tagsInput({
				width: 'auto'
			});
		});
    </script>
	<script>   
		document.getElementById("uploadBtn1").onchange = function () {
			document.getElementById("uploadFile1").value = this.value;
		};
    </script>
	
 <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script>


	$("tbody.drag_drop").sortable({
		items: "> tr",
		appendTo: "parent",
		helper: "clone"
	}).disableSelection();

	$("#tabs ul li a").droppable({
		hoverClass: "drophover",
		tolerance: "pointer",
		drop: function(e, ui) {
			var tabdiv = $(this).attr("href");
			$(tabdiv + " table tr:last").after("<tr>" + ui.draggable.html() + "</tr>");
			ui.draggable.remove();
		}
	});

   
     $('select.status').children().each(function (){
   
   if($(this).val() == "Complete"){
       $(this).attr('style', 'background-color:green;');
   }
   if($(this).val() == "Incomplete"){
       $(this).attr('style', 'background-color:red;');
	  
   }
   if($(this).val() == "Active"){
       $(this).attr('style', 'background-color:orange;');
   }
});

$('select.status').change(function (){
   var style = $(this).find('option:selected').attr('style');
   $(this).attr('style', style);
    $(this).parent().attr('style', style);
}).change();
       
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
		   
		   $('input[name="wbssubmit"]').click(function(e){
				var haserror = false;	
				var FormName = $(this).parent();
			$(FormName).find('.clone_from #datatable-keytable_wrapper tbody tr').each(function(index, element) {
					var ActivityArea = $(this).find('.activity_area');
					var Sarea = $(this).find(".assign_person option:selected").text();
					
					//alert('asd'+Sarea+'sad');
					
						if(Sarea=='Select '){
							
							if ($.trim($(ActivityArea).val())) {
							$(ActivityArea).parent().parent().find('.assign_person').addClass('mandatory');
							haserror = true;
							}
							else
							{
						$(ActivityArea).parent().parent().find('.assign_person').removeClass('mandatory');
							}
							 
						}
					
		
				
			});
			if (haserror==true){
				alert('please fill all mandatory Fields');
				return false;				
			}
		   });
		   
		   
		   
		   
		   $('.assign_person').prop('readonly',true);
$('#datatable-keytable_wrapper tbody tr').each(function(index, element) {
	var ActivityArea = $(this).find('.activity_area');
    if (!$.trim($(ActivityArea).val())) {
  $(ActivityArea).parent().parent().find('.assign_person').prop('readonly',true);
}
else
{
  $(ActivityArea).parent().parent().find('.assign_person').prop('readonly',false);	
}
});		   




$(".activity_area").keyup(function(){
if($(this).val()) {
    $(this).parent().parent().find('.assign_person').prop('readonly',false);
	$(this).parent().parent().find('.assign_person option:first').attr('selected',false);
}
else
{
$(this).parent().parent().find('.assign_person').prop('readonly',true);	
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
$('.clone_to textarea').removeAttr('name');
$('.clone_to select').removeAttr('name');
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
$('.clone_to textarea').attr('readonly','readonly');
$('.clone_to textarea').removeAttr('name');
$('.clone_to select').removeAttr('name');
$('.clone_to input').removeAttr('name');
};

$(".clone_from").keyup(function(){
 Emptyclonliness();
 clonliness();
});
	   
		   
		   
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
			
			
			});
			
			
			$('body').on('click',".delete_col",function(){			
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
			
		
			
			
	$('body').on('click',".icono .insert_row", function(){
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
			 $newRow.find('input[type="hidden"]').attr('value','');
			 $newRow.find('input.dateselect').attr('value','');
			 	emptySetRowCell();
			setRowCell();
			Emptyclonliness();
			clonliness();
			 
    });
	$('body').on('click',".icono .delete_row", function(){
		var saverowindex = $(this).parents('tr').index()+1;
		$('#datatable-keytable_wrapper tbody tr:nth-child('+saverowindex+')').remove();
			emptySetRowCell();
			setRowCell();
			Emptyclonliness();
			clonliness();
		
	});
	

$('#datetstarting').daterangepicker({
  
});

<?php if($this->uri->segment('1')=="edit_wbs") {?>
document.onreadystatechange = function () {
  var state = document.readyState
  if (state == 'interactive') {
       document.getElementById('content').style.visibility="hidden";
  } else if (state == 'complete') {
      setTimeout(function(){
         document.getElementById('interactive');
         document.getElementById('load').style.visibility="hidden";
         document.getElementById('content').style.visibility="visible";
      },1000);
  }
}
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