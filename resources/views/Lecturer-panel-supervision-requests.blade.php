
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
          <h1><a href="#">{{$user->title}}. {{$user->name}}</a></h1>
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
              <li><a href="/Lecturer/{{$user->id}}">Main Page</a></li>              
            </ul>
          </li>
        </ul>

        <ul class="left">
            <li><a href="/Lecturer/{{$user->id}}">Main</a></li>
            <li class="active"><a href="#">Supervision</a></li>
        </ul>

      </section>
    </nav>




    <header>

        <h4 class="welcome_text">Current PhD Students {{$user->title}}. {{$user->name}} is Supervisor of</h4>
    </header>

    <!-- ######################## Section ######################## -->





    
    <section class="section_light">

        <div style="width:100%;"> <!-- Main Div -->
            

            <div class="row">
                <div class="large-12 columns">


                    @if(Session::has('error_page'))
                        <div data-alert class="alert-box alert" align="center">
                            {{ Session::get('error_page') }}
                            <a href="#" class="close">&times;</a>
                        </div>
                    @endif

                    @if(Session::has('success'))
                        <div data-alert class="alert-box success" align="center">
                            {{ Session::get('success') }}
                            <a href="#" class="close">&times;</a>
                        </div>
                    @endif



                            <div class="row">
                                <div class="large-12 medium-12 small-12 columns">
                                    @if(Session::has('no_requests'))
                                        <div class="row">
                                            <div class="large-12 medium-12 small-12 columns">
                                            <fieldset class="bio">
                                                <legend class="legend"><label class="error">No Requests</label></legend>
                                                <dl class="sub-nav">
                                                    <dd><a href="/Lecturer/{{$user->id}}/Sup">PhD Students</a></dd>
                                                    <dd class="active"><a href="#">Confirmation Requests</a></dd>
                                                </dl>
                                                <div data-alert class="alert-box secondary" align="center">
                                                    <label class="error">{{ Session::get('no_requests') }}</label>
                                                </div>
                                            </fieldset>
                                            </div>
                                        </div>
                                    @else
                                    <fieldset class="bio">
                                        <legend class="legend"><label>PhD Students' Requests</label></legend>
                                        <dl class="sub-nav">
                                            <dd><a href="/Lecturer/{{$user->id}}/Sup">PhD Students</a></dd>
                                            <dd class="active"><a href="#">Confirmation Requests</a></dd>
                                        </dl>
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Ref#</th>
                                                    <th>PhD Student Name</th>
                                                    <th>Support Activity Title</th>
                                                    <th>Support Activity Module</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($requests as $request)
                                                <tr>
                                                    <td>{{$request->id}}</td>
                                                    <td><a href="#" data-reveal-id="phd-{{$request->phd->user->id}}"><label><strong>{{$request->phd->user->name}}</strong></label></a></td>
                                                    <div id="phd-{{$request->phd->user->id}}" class="reveal-modal xlarge" data-reveal>
                                                        <h3>Student Details</h3>
                                                        <div class="row">
                                                            <div class="large-6 columns">
                                                                <small>User Full Name:</small>
                                                                <h5>{{$request->phd->user->title}}. {{$request->phd->user->name}}</h5>
                                                            </div>
                                                            <div class="large-6 columns">
                                                                <small>Username:</small>
                                                                <h5>{{$request->phd->user->username}}</h5>
                                                            </div>
                                                            <div class="large-4 columns">
                                                                <small>Room number:</small>
                                                                <h5>{{$request->phd->user->room_number}}</h5>
                                                            </div>
                                                            <div class="large-4 columns">
                                                                <small>Email Address:</small>
                                                                <h5>{{$request->phd->user->email}}</h5>
                                                            </div>
                                                            <div class="large-4 columns">
                                                                <small>Phone Number</small>
                                                                <h5>{{$request->phd->user->phone_number}}</h5>
                                                            </div>
                                                        </div>
                                                        <a class="close-reveal-modal">&#215;</a>
                                                    </div>
                                                    <td>{{$request->activity->title}}</td>
                                                    <td>{{$request->activity->module->module_name}}</td>
                                                    <td>
                                                        <ul class="inline-list">
                                                          <li><a href="#" data-reveal-id="Accept{{$request->id}}"><label class="green">Accept</label></a></li>
                                                          <li><a href="#" data-reveal-id="Reject{{$request->id}}"><label class="error">Reject</label></a></li> 
                                                        </ul>
                                                    </td>
                                                    <div id="" class="reveal-modal large" data-reveal>
                                                        <div class="row">
                                                            <div class="large-12 columns">
                                                                <form action="" role="form" method="post">
                                                                </form>  
                                                            </div>
                                                        </div>
                                                        <a class="close-reveal-modal">&#215;</a>
                                                    </div>

                                                    <div id="Reject{{$request->id}}" class="reveal-modal large" data-reveal>
                                                        <div class="row">
                                                            <h3>Rejecting Application</h3>
                                                            <h6><label class="error">Please provide comment specifying reasons of rejection then click on the "Confirm" button</label></h6>

                                                            <div class="large-12 columns">
                                                                <form action="/Lecturer/{{$user->id}}/Sup/Stu{{$request->phd->user->id}}/rejectReq{{$request->id}}" role="form" method="post" id="rejecting{{$request->id}}">
                                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                    <div class="row">
                                                                        <div class="large-4 columns">
                                                                            <label>Module Name</label>
                                                                            <h6>{{$request->activity->module->module_name}}</h6>
                                                                        </div>
                                                                        <div class="large-4 columns">
                                                                            <label>Support Activity Title</label>
                                                                            <h6>{{$request->activity->title}}</h6>
                                                                        </div>
                                                                        <div class="large-4 columns">
                                                                            <label>Student Name</label>
                                                                            <h6>{{$request->user->title}}. {{$request->user->name}}</h6>
                                                                        </div>
                                                                        <div class="large-12 columns">
                                                                            <label>Please provide reasons or comments
                                                                                <textarea name="supervisor_comment" form="rejecting{{$request->id}}"></textarea>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <input type="submit" value="Confirm" class="button postfix">
                                                                </form>  
                                                            </div>
                                                        </div>
                                                        <a class="close-reveal-modal">&#215;</a>
                                                    </div>


                                                    <div id="Accept{{$request->id}}" class="reveal-modal xlarge" data-reveal>
                                                        <h3>Accepting Application</h3>
                                                        <h6><label class="green">Please provide comment if possible then click on the "Confirm" button</label></h6>
                                                        <!-- Social Dialogue Section -->
                                                        <div class="row">
                                                            <div class="large-12 columns">
                                                                <form action="/Lecturer/{{$user->id}}/Sup/Stu{{$request->phd->user->id}}/confirmReq{{$request->id}}" role="form" method="post" id="accepting{{$request->id}}">
                                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                    <div class="row">
                                                                        <div class="large-4 columns">
                                                                            <label>Module Name</label>
                                                                            <h6>{{$request->activity->module->module_name}}</h6>
                                                                        </div>
                                                                        <div class="large-4 columns">
                                                                            <label>Support Activity Title</label>
                                                                            <h6>{{$request->activity->title}}</h6>
                                                                        </div>
                                                                        <div class="large-4 columns">
                                                                            <label>Student Name</label>
                                                                            <h6>{{$request->user->title}}. {{$request->user->name}}</h6>
                                                                        </div>
                                                                        <div class="large-12 columns">
                                                                          <label>Please provide note or comment if possible
                                                                            <textarea name="supervisor_comment" form="accepting{{$request->id}}"></textarea>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <input type="submit" value="Confirm" class="button postfix">
                                                            </form>    
                                                        </div>
                                                    </div>
                                                    <a class="close-reveal-modal">&#215;</a>
                                                </div>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        </fieldset>
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
