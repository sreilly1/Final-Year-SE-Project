
<html>
<head>
    <meta charset="utf-8">
    <title>foundation on laravel</title>
    <link rel="stylesheet" href="{{ asset('css/foundation-datepicker.min.css') }}">
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
            <li><a href="/Admin/{{$user->id}}/Activities">Support Activities</a></li>
            <li><a href="/Admin/{{$user->id}}/Activities/Sessions">Sessions</a></li>
            <li class="active"><a href="#">Add</a></li>
        </ul>

      </section>
    </nav>


    <header>

        <h2 class="welcome_text">Add Session</h2>
    </header>

    <!-- ######################## Section ######################## -->





    
    <section class="section_light">

        <div style="width:100%;"> <!-- Main Div -->
            <div class="row">
                @if(Session::has('session_success'))
                    <div class="large-12 medium-12 small-12 columns">
                        <div data-alert class="alert-box success" align="center">
                            {{ Session::get('session_success') }}
                            <a href="#" class="close">&times;</a>
                        </div>
                    </div>
                @endif
                @if(Session::has('failed'))
                    <div class="large-12 medium-12 small-12 columns">
                        <div data-alert class="alert-box alert" align="center">
                            {{ Session::get('failed') }}
                            <a href="#" class="close">&times;</a>
                        </div>
                    </div>
                @endif

                <div class="large-12 medium-12 small-12 columns">

                    <fieldset class="bio">

                        <legend class="legend">Please enter new session details</legend>

                            <div class="row">
                                
                                <div class="large-12 columns">
                                    <form action="/Admin/{{$user->id}}/Activities/Sessions/Add/Action" role="form" method="post">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="row">

                                            <div class="large-4 columns">
                                                <label>Session Title</label>
                                                <input type="text" name="title" placeholder="Please enter session title">
                                            </div>
                                            <div class="large-6 columns">
                                                <label>Activity</label>
                                                <select name="activity_id">
                                                    <option name="activity_id" value="null" selected="NULL">- Please Select -</option>
                                                    @foreach($activities as $activity)
                                                    <option name="activity_id" value="{{$activity->id}}">{{$activity->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="large-2 columns">
                                                <label>Date</label>
                                                <input type="text" name="date_of_session" id="dp">
                                            </div>
                                            <div class="large-3 columns">
                                                <label>Session Starting Time</label>
                                                <input type="text" name="start_time" placeholder="hh:mm"/>
                                            </div>
                                            <div class="large-3 columns">
                                                <label>Session Ending Time</label>
                                                <input type="text" name="end_time" placeholder="hh:mm"/>
                                            </div>
                                            <div class="large-3 columns">
                                                <label>Session Location</label>
                                                <input type="text" name="location" placeholder="E.g T2.09"/>
                                            </div>
                                            <div class="large-3 columns">
                                                <label class="green">Confirm & Add</label>
                                                <input type="submit" value="add" class="button postfix">
                                            </div>
                                        </div>
                                    </form>    
                                </div>
                            </div>
                    </fieldset>

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
        <script src="{{ asset('js/foundation/foundation.alert.js') }}"></script>
        <script src="{{ asset('js/foundation-datepicker.js') }}"></script>
        <script src="{{ asset('js/locales/foundation-datepicker.vi.js') }}"></script>
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
                    format: 'dd-mm-yyyy',
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
