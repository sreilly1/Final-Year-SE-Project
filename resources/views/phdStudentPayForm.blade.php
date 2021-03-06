<meta charset="utf-8">

<!-- import the neccessary scripts and CSS as shown at: https://jqueryui.com/datepicker/ -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="blah.js"></script>

@if (isset($error))
	<h2>{{$error}}</h2>
@endif

<form class="form" id="phd-student-pay-form" enctype="multipart/form-data">

	<div data-alert class="alert-box info radius">
 		<p>
 			Select the dates which you want to be used for calculating what the PHD 
 			student should be paid.
 		</p>
	</div>

	<!-- 
		the fields which will allow the user to select a date range for which to calculate
		a phd students pay
	-->
	<div>
		From: <input type="text" class="datepicker" id ="from"> 
	</div>
	<div>
		To: <input type="text" class="datepicker" id ="to">
	</div>

	<button type="submit" id="submitBtn">Submit</button>
</form>

<script>
$(function() {
	//attach the jQueryUI datepicker to all element whose 'class' atttribute is 'datepicker'
	//this is a modification of the source code shown at: https://jqueryui.com/datepicker/
	$( ".datepicker" ).datepicker({
		//the date format will be converted to yyyy-mm-dd when the user selects a date with
		//the datepicker, this is simpler and less code than converting the dates format on the server side
		//to match the format in which it is stored in the database
		dateFormat: 'yy-mm-dd' 
	});
	//bind an event handler to the form with an id of 'phd-student-pay-form', as shown in :https://api.jquery.com/submit/
	$("#phd-student-pay-form").on("submit", function (e) {

			//obtain the value from the field with the id 'from'
			var fromDate = $( "#from" ).val(); 

			// //obtain the value from the field with the id 'to'
			var toDate = $( "#to" ).val();
			
			
			

			//dynamically change the 'action' atribute of the form with the id 'form' so that
			//the url will be in the following format: 
			//'phdStudentExpenditure/idofPHDStudent/fromDate/toDate', where fromDate and toDate represent
			//the date range in which to calculate the pay for the PHD student
            $('#phd-student-pay-form').attr('action', "/phdStudentExpenditure/55/" + fromDate + '/' + toDate);

            //submit the form
            $("#phd-student-pay-form").submit(); 
    });
});
</script>