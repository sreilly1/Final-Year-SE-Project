<!DOCTYPE html>
<head>
    <meta charset="utf-8" />
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/dataTables.bootstrap.css" rel="stylesheet">

</head>

<body>

    <div class="row">
        <div class="col-sm-12">
            <table id="table_id" class="table table-striped">
                <thead>
                    <tr>
                        <th>Activity</th>    
                        <th>Assigned PHD Student</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($assignmentsMade as $phdStudentName => $activityTitle)
                    <tr>
                        <td>{{$activityTitle}}</td>
                        <td>{{$phdStudentName}}</td>
                    </tr>                 
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script src="/js/jquery-2.1.3.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/3cfcc339e89/integration/bootstrap/3/dataTables.bootstrap.js"></script>
    <!-- Makes sure the document had loaded first -->
    <script type="text/javascript">
    $(document).ready( function () {
        $('#table_id').DataTable();
    } );
    </script>
</body>
</html>
