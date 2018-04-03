$(function() {
	var oTable = $('#datatable').DataTable({
		"oLanguage": {
			"sSearch": "Filter Data"
		},
	});

	$("#datepicker_from").datepicker({
		showOn: "button",
		buttonImage: "datepicker.png",
		buttonImageOnly: false,
		dateFormat: 'yy-mm-dd',
		changeMonth: true,
		changeYear: true,
		"onSelect": function(date) {
			minDateFilter = new Date(date).getTime();
			oTable.Draw();
		}
	}).keyup(function() {
		minDateFilter = new Date(this.value).getTime();
		oTable.Draw();
	});

	$("#datepicker_to").datepicker({
		showOn: "button",
		buttonImage: "datepicker.png",
		buttonImageOnly: false,
		dateFormat: 'yy-mm-dd',
		changeMonth: true,
		changeYear: true,
		"onSelect": function(date) {
			maxDateFilter = new Date(date).getTime();
			oTable.Draw();
		}
	}).keyup(function() {
		maxDateFilter = new Date(this.value).getTime();
		oTable.Draw();
	});

});

// Date range filter
minDateFilter = "";
maxDateFilter = "";

$.fn.dataTableExt.afnFiltering.push(
	function(oSettings, aData, iDataIndex) {
		if (typeof aData._date == 'undefined') {
			aData._date = new Date(aData[0]).getTime();
		}

		if (minDateFilter && !isNaN(minDateFilter)) {
			if (aData._date < minDateFilter) {
				return false;
			}
		}

		if (maxDateFilter && !isNaN(maxDateFilter)) {
			if (aData._date > maxDateFilter) {
				return false;
			}
		}
		return true;
	}
);