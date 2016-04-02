<link href="/css/bootstrap.min.css" rel="stylesheet">
<link href="/css/dataTables.bootstrap.css" rel="stylesheet">
<div class="row">
	<div class="col-sm-12">
		<table id="table_id" class="table table-striped">
	</div>
</div>

PHD Student Name: {{$phdStudent->name}}

<thead>
	<tr>   
		<th>Date</th>
		<th>Start Time</th>
		<th>End Time</th>
	</tr>
</thead>
<tbody>
	@foreach($sessions as $session)
	    <tr>
	        <td>{{$session->date_of_session}}</td>
	        <td>{{$session->start_time}}</td>
	        <td>{{$session->end_time}}</td>
	    </tr>                 
	@endforeach
	<tr>
    <td colspan="2">Sum: $180</td>
	</tr>
</tbody>


<p>Total Hours Worked: $totalHoursWorked</p>
<p>Pay Rate; £8 per hour:</p>
<p>Total Pay: £{{$totalExpenditure}}</p>



<script src="/js/jquery-2.1.3.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/3cfcc339e89/integration/bootstrap/3/dataTables.bootstrap.js"></script>
    <!-- Makes sure the document had loaded first -->
    <script type="text/javascript">
    $(document).ready( function () {
        $('#table_id').DataTable();
    } );
</script>

