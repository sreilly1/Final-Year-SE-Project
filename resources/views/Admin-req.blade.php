
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
              <li><a href="/Admin">Main Page</a></li>
              <li><a href="/Admin/Requests">View Requests</a></li>
            </ul>
          </li>
        </ul>

        <ul class="left">
            <li><a href="/Admin/{{$user->id}}">Main</a></li>
            <li class="active"><a href="#">Requests</a></li>
        </ul>

      </section>
    </nav>



    <header>
        <h2 class="welcome_text">View Requests</h2>
    </header>

    <!-- ######################## Section ######################## -->





    
    <section class="section_light">

        <div style="width:100%;">
            <div class="row">

                <div class="large-12 medium-12 small-12 columns">
                    
                </div>



                <div class="row">
                    <div class="large-12 medium-12 small-12 columns">
                        <!-- <dl class="sub-nav">
                            <dd class="active"><a href="/Admin/{{$user->id}}/Requests">Pending Requests</a></dd>
                            <dd class="unavailable"><a href="/Admin/{{$user->id}}/Requests/Accepted">Confirmed Requests</a></dd>
                            <dd><a href="/Admin/{{$user->id}}/Requests/Declined">Rejected Requests</a></dd>
                        </dl> -->
                        <ul class="breadcrumbs">
                            <li class="current"><a href="#">Pending Requests</a></li>
                            @if(Session::has('no_accepted'))
                            <li class="unavailable"><a data-tooltip aria-haspopup="true" class="tip-top" title="There are no confirmed requests that you have yet." href="#">Confirmed Requests</a></li>
                            @else
                            <li><a href="/Admin/{{$user->id}}/Requests/Accepted">Confirmed Requests</a></li>
                            @endif
                            @if(Session::has('no_declined'))
                            <li class="unavailable"><a data-tooltip aria-haspopup="true" class="tip-top" title="There are no declined requests that you have yet." href="#">Rejected Requests</a></li>
                            @else
                            <li><a href="/Admin/{{$user->id}}/Requests/Declined">Rejected Requests</a></li>
                            @endif
                        </ul>
                        
                        @if(Session::has('success'))
                        <div class="row">
                            <div class="large-12 medium-12 small-12 columns">
                                <div data-alert class="alert-box success" align="center">
                                    {{ Session::get('success') }}
                                    <a href="#" class="close">&times;</a>
                                </div>
                            </div>
                        </div>
                        @endif
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

                        @if(Session::has('no_requests'))
                        <div class="row">
                            <div class="large-12 medium-12 small-12 columns">
                                <fieldset class="bio">
                                    <legend class="legend"><label class="error">No Requests</label></legend>
                                    <div data-alert class="alert-box secondary" align="center">
                                        <label class="error">{{ Session::get('no_requests') }}</label>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        @else

                            @if(Session::has('no_requests_not_responded'))

                            <div class="row">
                                <div class="large-12 medium-12 small-12 columns">
                                <fieldset class="bio">
                                    <legend class="legend"><label class="error">No Requests</label></legend>
                                    <div data-alert class="alert-box secondary" align="center">
                                        <label class="error">{{ Session::get('no_requests_not_responded') }}</label>
                                    </div>
                                </fieldset>
                                </div>
                            </div>

                            @else
                                
                                <table>
                                    <thead>
                                        <tr>
                                            <th><label><strong>Requests that are still pending:</strong></label></th>
                                        </tr>
                                    </thead>
                                </table>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>PhD Student Name</th>
                                            <th>Support Activity Title</th>
                                            <th>Support Activity Module</th>
                                            <th>Student Supervisor</th>
                                            <th>Supervisor Confirmation</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($not_responded as $not)
                                        <tr>                                                      
                                            <td><a href="#" data-reveal-id="phd-{{$not->phd->user->id}}"><label><strong>{{$not->phd->user->name}}</strong></label></a></td>
                                            <div id="phd-{{$not->phd->user->id}}" class="reveal-modal xlarge" data-reveal>
                                                <h3>Student Details</h3>
                                                <div class="row">
                                                    <div class="large-6 columns">
                                                        <small>User Full Name:</small>
                                                        <h5>{{$not->phd->user->title}}. {{$not->phd->user->name}}</h5>
                                                    </div>
                                                    <div class="large-6 columns">
                                                        <small>Username:</small>
                                                        <h5>{{$not->phd->user->username}}</h5>
                                                    </div>
                                                    <div class="large-4 columns">
                                                        <small>Room number:</small>
                                                        <h5>{{$not->phd->user->room_number}}</h5>
                                                    </div>
                                                    <div class="large-4 columns">
                                                        <small>Email Address:</small>
                                                        <h5>{{$not->phd->user->email}}</h5>
                                                    </div>
                                                    <div class="large-4 columns">
                                                        <small>Phone Number</small>
                                                        <h5>{{$not->phd->user->phone_number}}</h5>
                                                    </div>
                                                </div>
                                                <a class="close-reveal-modal">&#215;</a>
                                            </div>
                                            <td><a target="_blank" href="/Admin/{{$user->id}}/Activities/{{$not->activity->id}}"><label>{{$not->activity->title}}</label></a></td>
                                            <td><a target="_blank" href="/Admin/{{$user->id}}/Modules/{{$not->activity->module->id}}"><label>{{$not->activity->module->module_name}}</label></a></td>                                            
                                            <td><a href="#" data-reveal-id="sup-{{$not->phd->supervisor->id}}"><label style="color:#5F9EA0;">{{$not->phd->supervisor->title}}. {{$not->phd->supervisor->name}}</label></a></td>
                                            <div id="sup-{{$not->phd->supervisor->id}}" class="reveal-modal xlarge" data-reveal>
                                                <h3>Supervisor Details</h3>
                                                <div class="row">
                                                    <div class="large-6 columns">
                                                        <small>User Full Name:</small>
                                                        <h5>{{$not->phd->supervisor->title}}. {{$not->phd->supervisor->name}}</h5>
                                                    </div>
                                                    <div class="large-6 columns">
                                                        <small>Username:</small>
                                                        <h5>{{$not->phd->supervisor->username}}</h5>
                                                    </div>
                                                    <div class="large-4 columns">
                                                        <small>Room number:</small>
                                                        <h5>{{$not->phd->supervisor->room_number}}</h5>
                                                    </div>
                                                    <div class="large-4 columns">
                                                        <small>Email Address:</small>
                                                        <h5>{{$not->phd->supervisor->email}}</h5>
                                                    </div>
                                                    <div class="large-4 columns">
                                                        <small>Phone Number</small>
                                                        <h5>{{$not->phd->supervisor->phone_number}}</h5>
                                                    </div>
                                                </div>
                                                <a class="close-reveal-modal">&#215;</a>
                                            </div>
                                            @if($not->supervisor_confirmation === 'Pending')
                                                <td><span data-tooltip aria-haspopup="true" class="has-tip tip-top" title="Confirmation still not received from: {{$not->phd->supervisor->title}}. {{$not->phd->supervisor->name}}">{{$not->supervisor_confirmation}}</span></td>
                                            @else
                                                @if($not->supervisor_comment === '')
                                                    <td><label class="green">{{$not->supervisor_confirmation}} -  No Comment </label></td>
                                                @else
                                                    @if($not->supervisor_confirmation === 'Confirmed')
                                                    <td><a href="#" data-reveal-id="viewCmnt-{{$not->id}}"><label class="green">{{$not->supervisor_confirmation}} - View Comment</label></a></td>
                                                    @else
                                                    <td><a href="#" data-reveal-id="viewCmnt-{{$not->id}}"><label class="error">{{$not->supervisor_confirmation}} - View Comment</label></a></td>
                                                    @endif
                                                    <div id="viewCmnt-{{$not->id}}" class="reveal-modal xlarge" data-reveal>
                                                        <h3>Comment from: {{$not->phd->supervisor->name}}</h3>
                                                        <!-- Social Dialogue Section -->
                                                        <div class="row">
                                                            <blockquote><h6>{{$not->supervisor_comment}}</h6><cite><strong>{{$not->phd->supervisor->name}}</strong></cite></blockquote>
                                                        </div>
                                                        <a class="close-reveal-modal">&#215;</a>
                                                    </div>
                                                @endif
                                            @endif
                                            <td>
                                                <form action="/Admin/{{$user->id}}/Requests/Confirm{{$not->id}}" role="form" method="post">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" name="status" value="Accepted"/>
                                                    <input style="font-size:1em; display:inline;  margin:0; padding:0; border:0; color:green; cursor:pointer; background-color: rgba(255, 255, 255, 0);" type="submit" value="Accept">
                                                </form>                                                                                                
                                            </td>
                                            <td>
                                                <form action="/Admin/{{$user->id}}/Requests/Reject{{$not->id}}" role="form" method="post">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" name="status" value="Declined"/>
                                                    <input style="font-size:1em; display:inline;  margin:0; padding:0; border:0; color:red; cursor:pointer; background-color: rgba(255, 255, 255, 0);" type="submit" value="Reject">
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
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
    $(document).foundation();
</script>

</body>
</html>
