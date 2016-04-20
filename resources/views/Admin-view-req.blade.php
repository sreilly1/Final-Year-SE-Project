
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
          <h1><a href="#">Hello [Admin's Name]</a></h1>
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
      </section>
    </nav>



    <header>
        @foreach($phd_name as $user)
            <h2 class="welcome_text">Requests done by {{$user->name}}</h2>
        @endforeach
    </header>

    <!-- ######################## Section ######################## -->





    
    <section class="section_light">

        <div style="width:100%;">
            @if(Session::has('failed'))
                <div class="large-12 medium-12 small-12 columns">
                    <div data-alert class="alert-box alert" align="center">
                        {{ Session::get('failed') }}
                        <a href="#" class="close">&times;</a>
                    </div>
                </div>
            @endif
            
            <div class="row">
                <div class="large-12 medium-8 small-12 columns">
                    <fieldset class="bio">

                        <div class="large-12 medium-12 small-12 columns">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Module</th>
                                        <th>Activity Title</th>
                                        <th>Role Type</th>
                                        <th>Supervisor Confirmation</th>
                                        <th>Supervisor Comment</th>
                                        <th>Current Status</th>
                                        <th>Make an Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach($requests as $phd_request)
                                    <tr id="{{$phd_request->id}}">
                                        
                                        <td>{{$phd_request->activity->module->module_name}}</td>
                                        <td>{{$phd_request->activity->title}}</td>
                                        <td>{{$phd_request->activity->role_type}}</td>
                                        <td>{{$phd_request->supervisor_confirmation}}</td>
                                        @if($phd_request->supervisor_comment === '')
                                            <td><strong><label class="error">No Comment Left</label></strong></td>
                                        @else
                                            <td><a href="#" data-reveal-id="comment{{$phd_request->id}}"  class="disabled">View</a></td>
                                        @endif
                                        
                                        <td><strong>{{$phd_request->status}}</strong></td>
                                        <td>
                                        
                                        <form action="reqAction/{{$phd_request->id}}" role="form" method="post">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="status" value="Pending"/>
                                            <input type="submit" value="Pending" class="button tiny">
                                        </form>
                                        <form action="reqAction/{{$phd_request->id}}" role="form" method="post">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="status" value="Accepted"/>
                                            <input type="submit" value="Accept" class="button tiny">
                                        </form>
                                        <form action="reqAction/{{$phd_request->id}}" role="form" method="post">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="status" value="Declined"/>
                                            <input type="submit" value="Decline" class="button tiny">
                                        </form>
                                        </td>
                                        
                                    </tr>
                                    <div id="comment{{$phd_request->id}}" class="reveal-modal xlarge" data-reveal>
                                        <div class="row">
                                            <div class="large-12 columns">
                                                <fieldset class="bio">
                                                    <legend class="legend">Supervisor Comment</legend>                                                                                                                                
                                                    <p>{{$phd_request->supervisor_comment}}</p>
                                                </fieldset>                                                
                                            </div>
                                        </div>
                                        <a class="close-reveal-modal">&#215;</a>
                                    </div>
                                    @endforeach                                
                                </tbody>
                            </table>
                        </div>  
                    </fieldset>
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
