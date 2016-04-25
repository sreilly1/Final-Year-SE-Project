$(document).ready(function () {

		/*
		attach the jQueryUI datepicker to all element whose 'class' atttribute is 'datepicker'
		this is a modification of the source code shown at: https://jqueryui.com/datepicker/
		*/
		$( ".datepicker" ).datepicker({
			/*
				the date format will be converted to yyyy-mm-dd when the user selects a date with
				the datepicker, this is simpler and less code than converting the dates format on 
				the server side to match the format in which it is stored in the database
			*/
			dateFormat: 'yy-mm-dd' 
		});
		/*
		bind an event handler to the form with an id of 'calculation-parameters-form', 
		as shown in :https://api.jquery.com/submit/
		*/
		$("#calculation-parameters-form").on("submit", function (e) {

			//obtain the value from the field with the id 'from'
			var fromDate = $( "#from" ).val(); 

			//obtain the value from the field with the id 'to'
			var toDate = $( "#to" ).val();

			//obtain the value from the field with the id 'phdStudent'
			var phdStudentID = $( "#phdStudent" ).val();

			var errorMessages = [];
			
			//check whether user has filled in the 'from' and 'to' fields 
			if ( (!fromDate) || (!toDate) ) {
				errorMessages.push("Please ensure that a 'from' and a to' date are specified");
			}

			if (new Date(fromDate).getTime() > new Date(toDate).getTime() ) {
				errorMessages.push("Please make sure the 'from' date is earlier than the 'to' date");
			}

			if (errorMessages.length >0 ) {
				//prevent the form being submitted
				e.preventDefault();
				alert(errorMessages.toString());

				//returning false will stop execution of the JavaScript function so that the 
				//user will not continually get JavaScript alerts till they tell the browser 
				//that they do not want additional dialogue boxes
				return false;
			}

			//dynamically change the 'action' atribute of the form with the id 'form' so that
			//the url will be in the following format: 
			//'calculatePHDStudentPaymentResults/{idofPHDStudent}/{fromDate}/{toDate}', 
			$('#calculation-parameters-form').attr('action', '/calculatePHDStudentPaymentResults/' + phdStudentID + '/' + fromDate + '/' + toDate);

            //submit the form
            $("#calculation-parameters-form").submit(); 
        });
});

//checks that 'fromDate' comes before 'toDate' chronologically
function checkDateRangeValidity (fromDate, toDate) {

	var valid = false;

	if (!new Date(fromDate).getTime() > new Date(toDate).getTime() ) {
		var valid = true;
	} else {
		alert("the date range entered is invalid, please make sure the 'from' date is earlier than the 'to' date");
	}

	return valid;
}