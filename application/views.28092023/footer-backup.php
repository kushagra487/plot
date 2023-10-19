		<!-- footer content -->
<!--
		<footer>
			<div class="pull-right">
				PBO Plus Consulting services
			</div>
			<div class="clearfix"></div>
		</footer>
-->
		<!-- /footer content -->
	</div>
</div>
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

          <!-- new dashboard js -->
            <script src="<?= base_url();?>application/views/assets/lib/metismenu/metisMenu.js"></script>
            <!-- Screenfull -->
            <script src="<?= base_url();?>application/views/assets/lib/screenfull/screenfull.js"></script>


            <!-- Metis core scripts -->
            <script src="<?= base_url();?>application/views/assets/js/core.js"></script>
            <!-- Metis demo scripts -->
            <script src="<?= base_url();?>application/views/assets/js/app.js"></script>


            <script src="<?= base_url();?>application/views/assets/js/style-switcher.js"></script>
 <!-- new dashboard js -->


	<script>
		$(document).ready(function() {
			$(".select2_single").select2({
				placeholder: "Select a state",
				allowClear: true
			});
			$("form .modal-body .select2_group").select2({});
			$("form .modal-body .select2_multiple").select2({
				maximumSelectionLength: 4,
				placeholder: "Add Project Manager",
				allowClear: true
			});
$("form.form-label-left .form-group .select2_multiple").select2({
				maximumSelectionLength: 4,
				placeholder: "Add Project Manager",
				allowClear: true
			});

$("form.form-label-left .select-member .select2_multiple").select2({
				maximumSelectionLength: 4,
				placeholder: "Add Team Member",
				allowClear: true
			});





		});
    </script>
    <!-- bootstrap-daterangepicker -->
    <script>
      $(document).ready(function() {
        var cb = function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
          $('#reportrange_right span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
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
        $('.single_cal1').daterangepicker({
          singleDatePicker: true,
          calender_style: "picker_1"
        }, function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
        });
		
		$('body').on('focus',".single_cal1", function(){
    $('.single_cal1').daterangepicker({
         singleDatePicker: true,
         calender_style: "picker_1"
       }, function(start, end, label) {
         console.log(start.toISOString(), end.toISOString(), label);
       });
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
</body>
</html>
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
			alert("Added a tag: " + tag);
		}
		function onRemoveTag(tag) {
			alert("Removed a tag: " + tag);
		}
		function onChangeTag(input, tag) {
			alert("Changed a tag: " + tag);
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
</script>
<script>

 $(".column1").hide();
 if ($.trim($(".column1 textarea").val())) {	 
  $(".column1").show();
  $("#show-hide1").hide();
 }
 
 $("#show-hide1").click(function(){
 $(".column1").show();
 $("#show-hide1").hide();


	 });
	 



	 
$(".column2").hide();
if ($.trim($(".column2 textarea").val())) {	 
  $(".column2").show();
   $("#show-hide2").hide();
 }
 $("#show-hide2").click(function(){
 $(".column2").show();
 $("#show-hide2").hide();
	 });


 
	 
$(".column3").hide();
if ($.trim($(".column3 textarea").val())) {	 
  $(".column3").show();
   $("#show-hide3").hide();
 }	
 $("#show-hide3").click(function(){
 $(".column3").show();
 $("#show-hide3").hide();
	 });


	 
$(".column4").hide();
if ($.trim($(".column4 textarea").val())) {	 
  $(".column4").show();
   $("#show-hide4").hide();
 }	 
 $("#show-hide4").click(function(){
 $(".column4").show();
 $("#show-hide4").hide();
	 });

 
	 
$(".column5").hide();
if ($.trim($(".column5 textarea").val())) {	 
  $(".column5").show();
  $("#show-hide5").hide();
 }	 	
 $("#show-hide5").click(function(){
 $(".column5").show();
 $("#show-hide5").hide();
	 });


	 
$(".column6").hide();
if ($.trim($(".column6 textarea").val())) {	 
  $(".column6").show();
   $("#show-hide6").hide();
 }	 
 	 
 $("#show-hide6").click(function(){
 $(".column6").show();
 $("#show-hide6").hide();
	 });
	 
	
	 
	 
$(".column7").hide();
if ($.trim($(".column7 textarea").val())) {	 
  $(".column7").show();
   $("#show-hide7").hide();
 }	  

 $("#show-hide7").click(function(){
 $(".column7").show();
 $("#show-hide7").hide();
	 });

	 
	 
$(".column8").hide();

if ($.trim($(".column8 textarea").val())) {	 
  $(".column8").show();
   $("#show-hide8").hide();
 }	 
 
 $("#show-hide8").click(function(){
 $(".column8").show();
 $("#show-hide8").hide();
	 });

	 
$(".column9").hide();
if ($.trim($(".column9 textarea").val())) {	 
  $(".column9").show();
   $("#show-hide9").hide();
 }	 	 

 $("#show-hide9").click(function(){
 $(".column9").show();
 $("#show-hide9").hide();
	 });
	 
	 
	 
$(".column10").hide();
if ($.trim($(".column10 textarea").val())) {	 
  $(".column10").show();
   $("#show-hide10").hide();
 }	 	 

 $("#show-hide10").click(function(){
 $(".column10").show();
 $("#show-hide10").hide();
	 });
	 
	
	 
$(".column11").hide();
 if ($.trim($(".column11 textarea").val())) {	 
  $(".column11").show();
   $("#show-hide11").hide();
 }	 
 $("#show-hide11").click(function(){
 $(".column11").show();
 $("#show-hide11").hide();
	 });
	
	
	 
$(".column12").hide();
 if ($.trim($(".column12 textarea").val())) {	 
  $(".column12").show();
   $("#show-hide12").hide();
 }	 
 $("#show-hide12").click(function(){
 $(".column12").show();
 $("#show-hide12").hide();
	 });
	 
	
	 
$(".column13").hide();

 if ($.trim($(".column13 textarea").val())) {	 
  $(".column13").show();
   $("#show-hide13").hide();
 }	 
 $("#show-hide13").click(function(){
 $(".column13").show();
 $("#show-hide13").hide();
	 });
	 
	
	 
$(".column14").hide();

 if ($.trim($(".column14 textarea").val())) {	 
  $(".column14").show();
   $("#show-hide14").hide();
 }	 
 $("#show-hide14").click(function(){
 $(".column14").show();
 $("#show-hide14").hide();
	 });
	 
		 
	 
$(".column15").hide();

if ($.trim($(".column15 textarea").val())) {	 
  $(".column15").show();
   $("#show-hide15").hide();
 } 
 $("#show-hide15").click(function(){
 $(".column15").show();
 $("#show-hide15").hide();
	 });
	
	
	
	 
$(".column16").hide();

	 if ($.trim($(".column16 textarea").val())) {	 
  $(".column16").show();
   $("#show-hide16").hide();
 } 
 $("#show-hide16").click(function(){
 $(".column16").show();
 $("#show-hide16").hide();
	 });
	
	
	 
$(".column17").hide();
 if ($.trim($(".column17 textarea").val())) {	 
  $(".column17").show();
  $("#show-hide17").hide();
 }	 
 $("#show-hide17").click(function(){
 $(".column17").show();
 $("#show-hide17").hide();
	 });
	 
	 
 	 
$(".column18").hide();
if ($.trim($(".column18 textarea").val())) {	 
  $(".column18").show();
   $("#show-hide18").hide();
 }
 $("#show-hide18").click(function(){
 $(".column18").show();
 $("#show-hide18").hide();
	 });
	
	
	 
$(".column19").hide();
 if ($.trim($(".column19 textarea").val())) {	 
  $(".column19").show();
   $("#show-hide19").hide();
 }	 
 $("#show-hide19").click(function(){
 $(".column19").show();
 $("#show-hide19").hide();
	 });
	 
	 	
 
$(".column20").hide();
 if ($.trim($(".column20 textarea").val())) {	 
  $(".column20").show();
   $("#show-hide20").hide();
 }
 $("#show-hide20").click(function(){
 $(".column20").show();
 $("#show-hide20").hide();
	 });
	 
	 



 </script>
 <script>
   
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
			$('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
			$('body').delay(350).css({'overflow':'visible'});
		})
	//]]>

$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').focus()
})

     </script>
           <script>
		   //alert(1);
			function togg_row_col(){
				var rowCount = $('#datatable-keytable_wrapper tbody tr').length;	  
				};
				
				var k =0;
		$('body').on('click',".insert_col",function(){
		 var list_togg ='<th class="new_insert'+k+'"><textarea name="col[]" cols="10" rows="1"></textarea><div class="mtn_togg"><span class="toggle_insert"><i class="fa fa-angle-right"></i></span><span class="hover_toggle"><small class="insert_col">Insert</small><small class="delete_col">Delete</small></span></div></th>';
			
			$(this).parents('th').before(list_togg);
		var saveindex = $('#datatable-keytable_wrapper thead th.new_insert'+k+' textarea').parent().index();
			
			k++;
			
			$('#datatable-keytable_wrapper tbody tr').each(function() {
                $(this).find('td:nth-child('+saveindex+')').before('<td><textarea cols="10" rows="1"></textarea></td>');
            });
			
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
			
			});
			
		
			
			
	$('body').on('click',".icono .insert_row", function(){
//       $('.table1 tbody').append($(".table1 tbody tr:first").clone());
        var $curRow = $(this).parents('.icono').closest('tr'),
        $curRow = $(this).parents('.icono').parent().parent();
                $newRow = $curRow.clone(true);
                $curRow.after($newRow);
          //$('.table2 tbody tr td input[type="text"]').val(""); 
		  
		     $newRow.find("td textarea, td input[type='text']").val("");
			 $newRow.find("td select").prepend("<option selected></option>");
    });
	$('body').on('click',".icono .delete_row", function(){
		var saverowindex = $(this).parents('tr').index()+1;
		$('#datatable-keytable_wrapper tbody tr:nth-child('+saverowindex+')').remove();
	});
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

