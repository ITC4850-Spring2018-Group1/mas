// The plugin function for adding a new filtering routine
			$.fn.dataTableExt.afnFiltering.push(
			function(oSettings, aData, iDataIndex){
				var dateStart = parseDateValue($("#min").val());
				var dateEnd = parseDateValue($("#max").val());
				
// aData represents the table structure as an array of columns, so the script accesses the date value 
// in the second column of the table via aData[1]
				var evalDate= parseDateValue(aData[1]);

				if (evalDate >= dateStart && evalDate <= dateEnd) {
					return true;
				}
				else {
					return false;
				}
			});

			$(document).ready(function(){			
				var oTable = $('#datatable').dataTable({
			
				});
				
				$('#min,#max').datepicker({
					dateFormat: "yy-mm-dd",
					showOn: "button",
					buttonImageOnly: "true",
					buttonImage: "datepicker.png",
					weekStart: 1,
					changeMonth: "true",
					changeYear: "true",
					daysOfWeekHighlighted: "0",
					autoclose: true,
					todayHighlight: true
				});
				
// Add event listeners to the two range filtering inputs
				$('#min,#max').change(function(){ oTable.fnDraw(); });
			});
