
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
            <li><a href="/Admin/{{$user->id}}/Activities">Activities</a></li>
            <li><a href="/Admin/{{$user->id}}/Activities/Sessions">Session</a></li>
            <li class="active"><a href="#">Edit: {{$session->activity->title}}'s Session ID#: {{$session->id}}</a></li>
        </ul>

      </section>
    </nav>

    <header>

        <h2 class="welcome_text">{{$session->title}}</h2>
    </header>

    <!-- ######################## Section ######################## -->





    
    <section class="section_light">


            <div class="row">
                <div class="large-12 medium-12 small-12 columns">
                    @if(Session::has('success'))
                    <div data-alert class="alert-box success" align="center">
                        {{ Session::get('success') }}
                        <a href="#" class="close">&times;</a>
                    </div>
                    @endif

                    @if (Session::has('failed'))
                    <div data-alert class="alert-box alert">
                        {{ Session::get('failed') }}
                        <a href="#" class="close">&times;</a>
                    </div>
                    @endif
                </div>
                <div class="large-12 medium-12 small-12 columns">

                    <fieldset class="bio">

                        <legend class="legend">Session Details</legend>
                            <form action="/Admin/{{$user->id}}/Activities/Sessions/{{$session->id}}/Update" role="form" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="row">
                                    <div class="large-4 columns">
                                        <label>Date:</label>
                                        <input type="text" name="date_of_session" value="{{$session->date_of_session}}" id="dp">
                                    </div>
                                    <div class="large-4 columns">
                                    <label>Session Start Time:</label>
                                        <input type="text" name="start_time" value="{{date("H:i", strtotime($session->start_time))}}"/>
                                    </div>
                                    <div class="large-4 columns">
                                        <label>Session End Time:</label>
                                        <input type="text" name="end_time" value="{{date("H:i", strtotime($session->end_time))}}"/>
                                    </div>
                                    <div class="large-4 columns">
                                        <label>Session Location:</label>
                                        <input type="text" name="location" value="{{$session->location}}"/>
                                    </div>

                                    <div class="large-4 columns">
                                        <label>Update</label>
                                        <input type="submit" value="Update" class="nice tiny blue radius button">
                                    </div>                
                                
                                    <div class="large-4 columns">
                                        <label class="error">Delete</label>
                                        <a href="/Admin/Activity/Session/Delete/{{$session->id}}" class="nice tiny alert radius button">Delete</a>
                                    </div> 
                                </div>
                            </form>
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
                            initialDate: '{{date("d-m-Y", strtotime($session->date_of_session))}}',
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
