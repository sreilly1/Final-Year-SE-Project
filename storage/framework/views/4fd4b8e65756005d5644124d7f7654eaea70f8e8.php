<!doctype html>
<html lang="en">
<head>

	<!-- 
		add in the Zurb foundation files like Fahad has done in his part
		of the work
	-->
	<meta charset="utf-8">
    <title>foundation on laravel</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <script src="<?php echo e(asset('js/modernizr.js')); ?>"> </script>


	<!-- 
		import the neccessary scripts and CSS for jQuery's datepicker 
		as shown at: https://jqueryui.com/datepicker/ 
	-->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
</head>
<body>

	<?php if(isset($error)): ?>
		<h2><?php echo e($error); ?></h2>
	<?php endif; ?>

	<nav class="top-bar" data-topbar role="navigation">
      <ul class="title-area">
        <li class="name">
          <h1><a href="#">b</a></h1>
        </li>
         <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
        <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
      </ul>

      <section class="top-bar-section">
        <!-- Right Nav Section -->
        <ul class="right">
          <li class="has-dropdown">
            <a href="#">Redirect</a>
            <ul class="dropdown">
              <li><a href="/Admin">Main Page</a></li>
              <li><a href="/Admin/Requests">View Requests</a></li>
            </ul>
          </li>
        </ul>

        <ul class="left">
            <li><a href="">Main</a></li>
            <li><a href="b">Support Activities</a></li>
            <li class="active"><a href="#">Add</a></li>
        </ul>

      </section>
    </nav>

	<form class="form" id="date-range-form" enctype="multipart/form-data" action="get">

		<div data-alert class="alert-box secondary">
			<p>
				Select the PHD student whose pay you wish to be calculated. 

			</p>
			<p>
				Also select the dates which you want to be used for calculating what the PHD 
				student should be paid. 
			</p>
			<p>
				Please note that when you select the dates they
				will be shown in YYYY-MM-DD format in the textboxes.
			</p>
		</div>

		<div class="large-8 medium-8 small-8 columns">
			PhD Student: <select id = "phdStudent">
				<?php foreach($phdStudents as $phdStudent ): ?>
				<option value="<?php echo e($phdStudent->id); ?>"><?php echo e($phdStudent->name); ?></option>
				<?php endforeach; ?>
			</select>
		</div>

	<!-- 
		the fields which will allow the user to select a date range for which to calculate
		a phd students pay
	-->
	<div class="large-8 medium-8 small-8 columns">
		From: <input type="text" class="datepicker" id ="from"> 
	</div>
	<div class="large-8 medium-8 small-8 columns">
		To: <input type="text" class="datepicker" id ="to">
	</div>

	<div class="large-8 medium-8 small-8 columns">
		<button type="submit" id="submitBtn">Submit</button>
	</div>
	
</form>

<script>
$(function() {

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
		bind an event handler to the form with an id of 'date-range-form', 
		as shown in :https://api.jquery.com/submit/
		*/
		$("#date-range-form").on("submit", function (e) {

			//obtain the value from the field with the id 'from'
			var fromDate = $( "#from" ).val(); 

			//obtain the value from the field with the id 'to'
			var toDate = $( "#to" ).val();

			// //obtain the value from the field with the id 'phdStudent'
			var phdStudentID = $( "#phdStudent" ).val();
			
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
			//'calculatePHDStudentPaymentResults/{idofPHDStudent}/{fromDate}/{toDate}', 
			$('#date-range-form').attr('action', '/calculatePHDStudentPaymentResults/' + phdStudentID + '/' + fromDate + '/' + toDate);

            //submit the form
            $("#date-range-form").submit(); 
        });
});
</script>
</body>
</html>