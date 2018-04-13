/* Custom filtering function which will filter data in column four between two values */ 
$.fn.dataTableExt.afnFiltering.push( 
	function( oSettings, aData, iDataIndex ) { 
		var iMin = document.getElementById('min').value * 1; 
		var iMax = document.getElementById('max').value * 1; 
		var iVersion = aData[1] == "-" ? 0 : aData[1]*1; 
		if ( iMin === "" && iMax === "" ) { 
			return true; 
		} else if ( iMin === "" && iVersion < iMax ) { 
			return true; 
		} else if ( iMin < iVersion && "" === iMax ) { 
			return true; 
		} else if ( iMin < iVersion && iVersion < iMax ) { 
			return true; 
		} 
		return false; 
	});  
	
	$(document).ready(function() { 
		/* Initialise datatables */ 
		var oTable = $('#datatable').dataTable(); 
		/* Add event listeners to the two range filtering inputs */ 
		$('#min').keyup( function() { oTable.fnDraw(); }); 
		$('#max').keyup( function() { oTable.fnDraw(); }); 
	});