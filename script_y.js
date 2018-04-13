$(function() {
	var oTable = $('#datatable').DataTable({
		"sPaginationType": "full_numbers",

	});

	$("#datepicker_from").datepicker({
		showOn: "button",
		buttonImage: "images/calendar.gif",
		buttonImageOnly: false,
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
		buttonImage: "images/calendar.gif",
		buttonImageOnly: false,
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
			aData._date = new Date(aData[1]).getTime();
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