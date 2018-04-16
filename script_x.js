	$(document).ready(function() {
		$( function() {
	   	 $( "#datepicker" ).datepicker(
		{
			changeMonth:	true,
			changeYear:		true,
			dateFormat: 'yy-mm-dd'
		}
	);
	  	} );
	  
// Setup - add a datepicker for From and To fields
$("#datepicker_from").datepicker({
	showOn: "button",
	buttonImage: "images/calendar.gif",
	buttonImageOnly: false,
	changeMonth:	true,
	changeYear:		true,
	dateFormat: 'yy-mm-dd',
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
	changeMonth:	true,
	changeYear:		true,
	dateFormat: 'yy-mm-dd',
	"onSelect": function(date) {
		maxDateFilter = new Date(date).getTime();
		oTable.Draw();
	}
}).keyup(function() {
	maxDateFilter = new Date(this.value).getTime();
	oTable.Draw();
});
	
// Setup - add a datepicker to 'Start date' else add a text input to each footer cell
		$('#datatable tfoot th').each( function () {
			var title = $(this).text();
			if (title === "Start date") {
				$(this).html( '<input type="text" id="datepicker" placeholder="Search '+title+'" />' );
				}
				else {
				$(this).html( '<input type="text" placeholder="Search '+title+'" />' );
				}
		} );

// DataTable script
		var table = $('#datatable').DataTable({ 
			"scrollCollapse": false,
			"paging":         true
		}
		);

// Clicking on table body selects and highlights the row
		$('#datatable tbody').on( 'click', 'tr', function () {
		$(this).toggleClass('selected');
		} );

		 $('#datatable tbody')
			.on( 'mouseenter', 'td', function () {
				var colIdx = table.cell(this).index().column;

				$( table.cells().nodes() ).removeClass( 'highlight' );
				$( table.column( colIdx ).nodes() ).addClass( 'highlight' );
			} );

// Alert message that "x" amount of rows were selected
		$('#button').click( function () {
			alert( table.rows('.selected').data().length +' row(s) selected' );
		} );

// Apply the search for each column
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
	
// Apply the date searches for the To and From fields
	minDateFilter = "";
	maxDateFilter = "";

	$.fn.dataTableExt.afnFiltering.push(
		function(oSettings, aData, iDataIndex) {
			if (typeof aData._date == 'undefined') {
				aData._date = new Date(aData[4]).getTime();
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

