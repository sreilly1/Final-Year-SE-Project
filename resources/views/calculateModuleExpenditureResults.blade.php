<!DOCTYPE html>
<!-- from http://zurb.com/playground/responsive-tables -->

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8" />
  
  <!-- Set the viewport width to device width for mobile -->
  <meta name="viewport" content="width=device-width" />
  
  <title>Responsive Tables by ZURB</title>
  
  <!-- Included CSS Files -->
  <!-- Combine and Compress These CSS Files -->
  <link rel="stylesheet" href="/css/Responsive Tables/globals.css">
  <link rel="stylesheet" href="/css/Responsive Tables/typography.css">
  <link rel="stylesheet" href="/css/Responsive Tables/grid.css">
  <link rel="stylesheet" href="/css/Responsive Tables/ui.css">
  <link rel="stylesheet" href="/css/Responsive Tables/forms.css">
  <link rel="stylesheet" href="/css/Responsive Tables/orbit.css">
  <link rel="stylesheet" href="/css/Responsive Tables/reveal.css">
  <link rel="stylesheet" href="/css/Responsive Tables/mobile.css">
  <!-- End Combine and Compress These CSS Files -->
  <link rel="stylesheet" href="/css/Responsive Tables/app.css">
  <link rel="stylesheet" href="responsive-tables.css">
  <script src="/js/Responsive Tables/jquery.min.js"></script>
  <script src="responsive-tables.js"></script>

  <!--[if lt IE 9]>
  <link rel="stylesheet" href="stylesheets/ie.css">
  <![endif]-->
  
  
  <!-- IE Fix for HTML5 Tags -->
  <!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
</head>

<body>
	<!-- container -->
	<div class="container">

		<div class="row">
			<div class="twelve columns">
				<h1>Responsive Tables</h1>
				<h4 class="subhead">A CSS/JS solution for tables that allows them to shrink on small devices without sacrificing the value of tables, comparison of columns.</h4>
				
        <p>Our solution for responsive tables requires two included files (both linked on this page): responsive-tables.css and responsive-tables.js.</p>
        <p>The JS will help us create some new elements on small devices, so we don't have to modify our table markup on the page. The CSS applies the requisite positioning and overflow styles to make the new elements work.</p>
        <h5>Expenditure Breakdown for {{$module->module_name}}</h5>
        <table class="responsive">
          <tbody>
           <tr>
            <th>Support Activity</th>
            <th>Expenditure</th>
          </tr>
        </tbody>
          @foreach($activityCosts as $activityID => $activityCost)
          <tr>
            <td>{{$activityID}}</td>
            <td>£{{$activityCost}}</td>
          </tr> 
          @endforeach
          <tr>
            <td><h5>Pay Rate for 'Demonstrator': £9.00 per hour (per tutor)</h5></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td><h5>Pay Rate for 'Teaching': £8.00 per hour (per tutor)</h5></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td><h5>Total Expenditure: £{{$totalModuleCost}}</h5></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>

        </table>

        <div class="row">
          <div class="six columns">
            <p>In most cases, tables like this are okay at smaller sizes (since they'll break on every small word). However, with this many columns a very small device like a phone would still be a problem.</p>
          </div>
          <div class="six columns">
            <p>By attaching a class of <strong>.responsive</strong> to the table, our JS/CSS will kick in.</p>
          </div>
        </div>
      </div>
    </div>


  </body>
  </html>
