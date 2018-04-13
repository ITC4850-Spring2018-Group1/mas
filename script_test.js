$(document).ready(function() {
// Apply DataTable to HTML table with click select, and highlight features
var table = $('#datatable').DataTable({
	"oLanguage": {
		"sSearch": "Filter Data"
	},
	"sPaginationType": "full_numbers",
	"scrollCollapse": false,
	"paging":         true
}
);	
  
// Setup - add a text input to each footer cell
$('#datatable tfoot th').each( function () {
	var title = $(this).text();
	if (title === "Last Updated") {
		$(this).html( '<input type="text" id="datepicker" placeholder="Search '+title+'" />' );
		}
		else {
		$(this).html( '<input type="text" placeholder="Search '+title+'" />' );
		}
} );

// Add a datepicker for date range input boxes
$("#datepicker_from").datepicker({
	showOn: "button",
	buttonImage: "images/calendar.gif",
	buttonImageOnly: false,
	changeMonth:	true,
	changeYear:		true,
	"onSelect": function(date) {
		minDateFilter = new Date(date).getTime();
		oTable.fnDraw();
	}
}).keyup(function() {
	minDateFilter = new Date(this.value).getTime();
	oTable.fnDraw();
});

$("#datepicker_to").datepicker({
	showOn: "button",
	buttonImage: "images/calendar.gif",
	buttonImageOnly: false,
	changeMonth:	true,
	changeYear:		true,
	"onSelect": function(date) {
		maxDateFilter = new Date(date).getTime();
		oTable.fnDraw();
	}
}).keyup(function() {
	maxDateFilter = new Date(this.value).getTime();
	oTable.fnDraw();
});

$('#datatable tbody').on( 'click', 'tr', function () {
	$(this).toggleClass('selected');
	} );

$('#datatable tbody')
	.on( 'mouseenter', 'td', function () {
		var colIdx = table.cell(this).index().column;

		$( table.cells().nodes() ).removeClass( 'highlight' );
		$( table.column( colIdx ).nodes() ).addClass( 'highlight' );
	} );
	
// Apply date range filter based on date picker value entered
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

// Apply the search for each column based on column search input
table.columns().every( function () {
	var that = this;

	$( 'input', this.footer() ).on( 'keyup change', function () {
		if ( that.search() !== this.value ) {
			that
				.search( this.value )
				.draw();
		}
	} );
} );
} );

		

