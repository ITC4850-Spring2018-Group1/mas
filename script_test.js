$(document).ready(function() {
	$( function() {
   	 $( "#datepicker" ).datepicker(
	{
		dateFormat: 'yy-mm-dd',
		changeMonth:	true,
		changeYear:		true
	}
);
  	} );
  
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

// DataTable
var table = $('#datatable').DataTable({
	"scrollCollapse": false,
	"paging":         true
}
);

$('#datatable tbody').on( 'click', 'tr', function () {
	$(this).toggleClass('selected');
	} );

$('#datatable tbody')
	.on( 'mouseenter', 'td', function () {
		var colIdx = table.cell(this).index().column;

		$( table.cells().nodes() ).removeClass( 'highlight' );
		$( table.column( colIdx ).nodes() ).addClass( 'highlight' );
	} );

$('#button').click( function () {
	alert( table.rows('.selected').data().length +' row(s) selected' );
} );

// Apply the search
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

