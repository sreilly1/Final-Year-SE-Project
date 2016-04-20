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
        <h2>Payment Breakdown for <?php echo e($phdStudent->name); ?></h2>
        <table class="responsive">
          <tbody>
           <tr>
            <th>Support Activity</th>
            <th>Date</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Role Undertaken</th>
          </tr>
        </tbody>
        <?php foreach($sessions as $session): ?>
        <tr>
          <td><?php echo e($session->activity->title); ?></td>
          <td><?php echo e($session->date_of_session); ?></td>
          <td><?php echo e($session->start_time); ?></td>
          <td><?php echo e($session->end_time); ?></td>
          <td><?php echo e($session->activity->role_type); ?></td>
        </tr>                 
        <?php endforeach; ?>
        <tr>
          <td><h5>Total Hours Worked as 'Demonstrator': <?php echo e($demonstratorHours); ?></h5></td>
          <td></td>
          <td></td>
        </tr>
         <tr>
          <td><h5>Total Hours Worked as 'Teaching': <?php echo e($teachingHours); ?></h5></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td><h5>Pay Rate for 'Demonstrator': £12.21 per hour</h5></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td><h5>Pay Rate for 'Teaching': £10.58 per hour</h5></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td><h5>Total Payment: £<?php echo e($totalPayment); ?></h5></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
      </table>
    </div>


  </body>
  </html>
