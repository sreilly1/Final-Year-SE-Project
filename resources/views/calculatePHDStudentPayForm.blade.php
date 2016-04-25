<!doctype html>
<html lang="en">
<head>

	<!-- 
		add in the Zurb foundation files like Fahad has done in his part
		of the work
	-->
	<meta charset="utf-8">
    <title>foundation on laravel</title>
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
    <script src="{{ asset('js/modernizr.js') }}"> </script>

	<!-- 
		import the neccessary scripts and CSS for jQuery's datepicker 
		as shown at: https://jqueryui.com/datepicker/ 
	-->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

    <script src="/js/calculation_parameters_form.js"> </script>




</head>
<body>


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

	<form class="form" id="calculation-parameters-form" enctype="multipart/form-data" action="get">

		<div class="large-8 medium-8 small-8 columns">
			@if (isset($errors))
				<div data-alert class="alert-box alert radius" id="errors">
					@foreach($errors as $error )
	  					<h5>{{$error}}</h5>
					@endforeach()
				</div>
			@endif
		</div>
		<div class="large-8 medium-8 small-8 columns">
			PhD Student: <select id = "phdStudent">
				@foreach($phdStudents as $phdStudent )
				<option value="{{$phdStudent->id}}">{{$phdStudent->name}}</option>
				@endforeach
			</select>
		</div>

	<!-- 
		the fields which will allow the user to select a date range for which to calculate
		a phd students pay
	-->
	<div class="large-8 medium-8 small-8 columns">
		From: <input type="text" class="datepicker" id ="from" readonly="readonly"> 
	</div>
	<div class="large-8 medium-8 small-8 columns">
		To: <input type="text" class="datepicker" id ="to" readonly="readonly">
	</div>

	<div class="large-8 medium-8 small-8 columns">
		<button type="submit" id="submitBtn">Submit</button>
	</div>
	
</form>

</body>
</html>