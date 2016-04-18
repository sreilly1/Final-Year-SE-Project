
<html>
<head>
    <meta charset="utf-8">
    <title>foundation on laravel</title>    
    <script src="js/foundation-datepicker.js"></script>
    <script src="js/locales/foundation-datepicker.vi.js"></script>
    <link rel="stylesheet" href="css/foundation-datepicker.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
    <script src="{{ asset('js/modernizr.js') }}"> </script>
</head>
<body>

    <nav class="top-bar" data-topbar role="navigation">
      <ul class="title-area">
        <li class="name">
          <h1><a href="#">{{$user->name}}</a></h1>
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
            <li><a href="/Admin/{{$user->id}}">Main</a></li>
            <li class="active has-dropdown">
                <a>Session</a>
                <ul class="dropdown">
                  <li><a href="/Admin/{{$user->id}}/Modules">Modules</a></li>
                  <li><a href="/Admin/{{$user->id}}/Activities">Support Activities</a></li>
                </ul>
            </li>
        </ul>

      </section>
    </nav>




    <header>

       <label><h2 class="welcome_text">Sessions <small>Ordered by Date</small></h2></label>
    </header>

    <!-- ######################## Section ######################## -->





    
    <section class="section_light">

        <div style="width:100%;"> <!-- Main Div -->
            
            @if(Session::has('failed'))
                <div class="large-12 medium-12 small-12 columns">
                    <div data-alert class="alert-box alert" align="center">
                        {{ Session::get('failed') }}
                        <a href="#" class="close">&times;</a>
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="large-12 columns">
                    <dl class="sub-nav">
                      <dd class="active"><a href="/Admin/{{$user->id}}/Activities/Sessions/Add">Add Session</a></dd>
                    </dl>

                    @if(Session::has('module_success'))
                        <div data-alert class="alert-box success" align="center">
                            {{ Session::get('module_success') }}
                            <a href="#" class="close">&times;</a>
                        </div>
                    @endif
                    @if(Session::has('no_leader'))
                        <div data-alert class="alert-box alert" align="center">
                            {{ Session::get('no_leader') }}
                            <a href="#" class="close">&times;</a>
                        </div>
                    @endif
                    @if(Session::has('session_deleted'))
                        <div data-alert class="alert-box success" align="center">
                            {{ Session::get('session_deleted') }}
                            <a href="#" class="close">&times;</a>
                        </div>
                    @endif




                            <div class="row">
                                <div class="large-12 medium-12 small-12 columns scroll">
                                    @if(Session::has('no_sessions'))
                                        <div class="row">
                                            <div class="large-12 medium-12 small-12 columns">
                                                <div data-alert class="alert-box alert" align="center">
                                                    {{ Session::get('no_sessions') }}                                                    
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        @if(Session::has('no_session'))
                                            <div data-alert class="alert-box alert" align="center">
                                                {{ Session::get('no_session') }}                                                    
                                            </div>
                                        @endif
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Title</th>
                                                    <th>Module</th>
                                                    <th>Support Activity</th>
                                                    <th>Date</th>
                                                    <th>Time</th>                                                    
                                                    <th>Location</th>
                                                    <th>View</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($sessions as $session)
                                                <tr>
                                                    <td>{{$session->title}}</td>
                                                    <td>{{$session->activity->module->module_name}}</td>
                                                    <td>{{$session->activity->title}}</td>
                                                    <td>{{date("d-m-Y", strtotime($session->date_of_session))}}</td> 
                                                    <td>{{date("H:i", strtotime($session->start_time))}} - {{date("H:i", strtotime($session->end_time))}}</td> 
                                                    <td>{{$session->location}}</td> 
                                                    <td><a href="/Admin/{{$user->id}}/Activities/Sessions/{{$session->id}}" >View</a></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif
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



        <script src="{{ asset('js/f5_components.js') }}"> </script>
        <script src="{{ asset('js/vendor/jquery.js') }}"></script>
        <script src="{{ asset('js/foundation/foundation.js') }}"></script>
        <script src="{{ asset('js/foundation/foundation.reveal.js') }}"></script>
        <script src="{{ asset('js/foundation/foundation.topbar.js') }}"></script>
        <script>
            $(function () {

                $('#dp1').fdatepicker({
                    format: 'mm-dd-yyyy hh:ii',
                    disableDblClickSelection: true,
                    language: 'vi',
                    pickTime: true
                });

                $('#dp').fdatepicker({
                    initialDate: '????-??-??',
                    format: 'yyyy-mm-dd',
                    disableDblClickSelection: true
                });

                $('#dpE').fdatepicker({
                    format: 'yyyy-mm-dd',
                    disableDblClickSelection: true
                });

                



                // implementation of disabled form fields
                var nowTemp = new Date();
                var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
                var checkin = $('#dpd1').fdatepicker({
                    onRender: function (date) {
                        return date.valueOf() < now.valueOf() ? 'disabled' : '';
                    }
                }).on('changeDate', function (ev) {
                    if (ev.date.valueOf() > checkout.date.valueOf()) {
                        var newDate = new Date(ev.date)
                        newDate.setDate(newDate.getDate() + 1);
                        checkout.update(newDate);
                    }
                    checkin.hide();
                    $('#dpd2')[0].focus();
                }).data('datepicker');
                var checkout = $('#dpd2').fdatepicker({
                    onRender: function (date) {
                        return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
                    }
                }).on('changeDate', function (ev) {
                    checkout.hide();
                }).data('datepicker');
            });
</script>
<script>
    $(document).foundation();
</script>

</body>
</html>
