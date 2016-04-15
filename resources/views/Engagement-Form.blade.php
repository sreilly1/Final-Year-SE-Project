
<html>
<head>
	<meta charset="utf-8">
	<title>foundation on laravel</title>
	<link rel="stylesheet" href="{{ asset('css/app.css')}}">
	<link rel="stylesheet" href="{{ asset('css/style.css')}}">
	<script src="{{ asset('js/modernizr.js') }}"> </script>
</head>
<body>


	<header>

		<h2 class="welcome_text">Engagement Form</h2>
	</header>

	<!-- ######################## Section ######################## -->




	
	<section class="section_light">

		<div style="width:100%;"> <!-- Main Div -->
			<div class="row">
				<div class="large-12">

					<div class="row">	

						<div id="Page1">
							<div class="large-12 medium-12 small-12 columns">
								<h1 href="#" onclick="return show('Page3','Page1','Page2');"> Please click here to Start</h1>
							</div>
						</div>

					</div>

					<div id="Page3" style="display:none">

					


							<div class="large-12 medium-12 small-12 columns">
									<h2>Please complete the following form by choosing which module and type of job you're looking for:</h2>
								</div>

								<div class="large-12 medium-12 small-12 columns">
									
									<form>
										@foreach($module as $modules)
										<table>
											<thead>
												<tr>
													<th>Module Name:</th>
													<th>{{$modules->module_name}}</th>
													<th></th>
													<th></th>
													<th></th>
												</tr>
												<tr>
													<td>Activity Title</td>
													<td>Role Type</td>
													<th>Date</th>
													<th>Time</th>
													<th>Choose</th>
												</tr>
											</thead>
											<tbody>
												@foreach($modules->activities as $modul)
												<tr>
													<td>{{$modul->title}}</td>
													<td>{{$modul->role_type}}</td>
													<td>{{$modul->activity_time}}</td>
													<td>{{$modul->activity_date}}</td>
													<td><input type="checkbox" /></td>
												</tr>
												@endforeach
											</tbody>
										</table>
										@endforeach
									</form>
									
								</div>
								<div class="large-3 columns">
								<a href="#" class="button round">Send Request</a>
								</div>
							</div>





				</div>
			</div>
		</section>

		<footer>

			<div class="row">

				<div class="twelve columns footer">
					<div class="small-12 medium-12 large-12 columns">
						<p style="text-align: center;">
							Support Activity System
							<br>Designed and Supported by <a href="#"> Support Activity Team</a> 
						</p>
					</div>
				</div>

			</div>

		</footer>

		<script src="{{ asset('js/show.js') }}"> </script>

		<script src="{{ asset('js/f5_vendors.js') }}"> </script>
		<script src="{{ asset('js/f5_components.js') }}"> </script>
		<script>
			$(document).foundation();
		</script>

	</body>
	</html>
