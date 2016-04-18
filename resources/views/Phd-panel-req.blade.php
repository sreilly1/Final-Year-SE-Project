
<html>
<head>
    <meta charset="utf-8">
    <title>foundation on laravel</title>
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
            <a href="#">Notification</a>
            <ul class="dropdown">
              <li><a href="/Phd">Main Page</a></li>
            </ul>
          </li>
        </ul>

        <ul class="left">
            <li><a href="/Phd/{{$user->id}}">Main</a></li>
            <li class="active"><a href="#">Requests</a></li>
        </ul>

      </section>
    </nav>



    <header>
        <h2 class="welcome_text">Your Ongoing Applications</h2>
    </header>




    
    <section class="section_light">

        <div style="width:100%;">
            <div class="row">

                <div class="large-12 medium-12 small-12 columns">
                    
                </div>



                <div class="row">
                    <div class="large-12 medium-12 small-12 columns">

                        @if(Session::has('failed'))
                        <div class="row">
                            <div class="large-12 medium-12 small-12 columns">
                                <div data-alert class="alert-box alert" align="center">
                                    {{ Session::get('failed') }}
                                    <a href="#" class="close">&times;</a>
                                </div>
                            </div>
                        </div>
                        @endif


                        <fieldset>
                            <legend>Requests</legend>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Request ID#</th>
                                        <th>Support Activity Title</th>
                                        <th>Support Activity Module</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($requests as $request)
                                    <tr>
                                        <td>{{$request->id}}</td>
                                        <td>{{$request->activity->title}}</td>
                                        <td>{{$request->activity->module->module_name}}</td>
                                        @if($request->status === 'Pending')
                                            <td><a style="color:#8FBC8F;" data-tooltip aria-haspopup="true" class="has-tip tip-top" title="This requested application is still not either accepted or rejected by the system co-ordinator, you should receive email when application status has changed">{{$request->status}}</a></td>
                                        @elseif($request->status === 'Accepted')
                                            <td><a style="color:green;">{{$request->status}}</a></td>
                                        @else
                                            <td><a style="color:red;" data-tooltip aria-haspopup="true" class="has-tip tip-top" title="Unfortunately, your request for this activity was rejected">Rejected</a></td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </fieldset>
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
        <script src="{{ asset('js/foundation/foundation.alert.js') }}"></script>
<script>
    $(document).foundation();
</script>

</body>
</html>