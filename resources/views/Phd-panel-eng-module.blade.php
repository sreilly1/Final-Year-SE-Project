
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
            <a href="#">Redirect</a>
            <ul class="dropdown">
              <li><a href="/Phd">Main Page</a></li>
              <li><a href="#">View Requests</a></li>
            </ul>
          </li>
        </ul>

        <ul class="left">
            <li><a href="/Phd/{{$user->id}}">Main</a></li>
            <li><a href="/Phd/{{$user->id}}/Engagement-Form">Apply</a></li>
            <li class="active"><a href="#">{{$module->module_name}}</a></li>
        </ul>
      </section>
    </nav>



    <header>
        <h2 class="welcome_text">Available Support Activity of {{$module->module_name}}</h2>
    </header>


    
    <section class="section_light">

        <div style="width:100%;"> <!-- Main Div -->
            <div class="row">
                <div class="large-12 medium-12 small-12 columns">
                    @if(Session::has('ErrMessage'))
                    <div data-alert class="alert-box alert">
                      {{ Session::get('ErrMessage') }}
                      <a href="#" class="close">&times;</a>
                  </div>
                  @endif

                  @if (Session::has('message'))
                  <div data-alert class="alert-box success">
                      {{ Session::get('message') }}
                      <a href="#" class="close">&times;</a>
                  </div>
                  @endif
              </div>




              <div class="large-12 medium-12 small-12 columns">

                <table>
                    <thead>
                        <tr>
                            <td>Activity Title</td>
                            <td>Role Type</td>
                            <th>Choose</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($activities as $activity)
                            @if (App\AddRequest::where('user_id', $user->id)->where('activity_id', $activity->id)->where('status', '=', 'Pending')->exists() or App\AddRequest::where('user_id', $user->id)->where('activity_id', $activity->id)->where('status', '=', 'Accepted')->exists() )
                                <tr>
                                    <td>{{$activity->title}}</td>
                                    <td>{{$activity->role_type}}</td>
                                    <td><label class="error" data-tooltip aria-haspopup="true" class="has-tip tip-top" title="Looks like you already have requested this activity before">Requested</label></td>
                                </tr>
                            @else                          
                            <form action="/Phd/{{$user->id}}/Engagement-Form/{{$module->id}}/ReqAct" role="form" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="activity_id" value="{{$activity->id}}"/>
                                <input type="hidden" name="user_id" value="{{$user->id}}"/>
                                <input type="hidden" name="supervisor" value="{{$phd->supervisor->email}}"/>
                                <input type="hidden" name="status" value="Pending"/>
                                <tr>
                                    <td>{{$activity->title}}</td>
                                    <td>{{$activity->role_type}}</td>
                                    <td>
                                        <input style="font-size:0.9em; display:inline;  margin:0; padding:0; border:0; color:green; cursor:pointer; background-color: rgba(255, 255, 255, 0);" type="submit" value="Apply">
                                    </td>
                                </tr>
                            </form>
                            @endif
                        @endforeach
                    </tbody>
                </table>
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
    $(document).foundation();
</script>

</body>
</html>
