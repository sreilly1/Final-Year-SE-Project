<meta charset="utf-8">

<!-- import the neccessary scripts and CSS as shown at: https://jqueryui.com/datepicker/ -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">


<?php if('error'): ?>
	<h2><?php echo e($error); ?></h2>
<?php endif; ?>




<form class="form" id="date-range-form" enctype="multipart/form-data" action="get">
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
	//bind an event handler to the form with an id of 'date-range-form', as shown in :https://api.jquery.com/submit/
	$("#date-range-form").on("submit", function (e) {

			//obtain the value from the field with the id 'from'
			var fromDate = $( "#from" ).val(); 

			// //obtain the value from the field with the id 'to'
			var toDate = $( "#to" ).val();
			
			// if the user has provided an invalid range then they are informed with a JavaScript alert with this
			// and the forms default action is prevented, i.e. the form is not submitted as there is no need to process
			// the HTTP request on the server side if it is known to be invalid on the client side
			if (new Date(fromDate).getTime() > new Date(toDate).getTime() ) {
				alert("the date range entered is invalid, please make sure the 'from' date is earlier than the 'to' date");
				e.preventDefault();
				//returning false will stop execution of the JavaScript function so that the user will not
				//continually get JavaScript alerts till they tell the browser that they do not want 
				//additional dialogue boxes
				return false;
			}

			//dynamically change the 'action' atribute of the form with the id 'form' so that
			//the url will be in the following format: 
			//'phdStudentExpenditure/idofPHDStudent/fromDate/toDate', where fromDate and toDate represent
			//the date range in which to calculate the pay for the PHD student
            $('#date-range-form').attr('action', "/phdStudentExpenditure/55/" + fromDate + '/' + toDate);

            //submit the form
            $("#date-range-form").submit(); 
    });
});
</script>