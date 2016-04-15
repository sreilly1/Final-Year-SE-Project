
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
            <li><a href="/Admin/{{$user->id}}/Requests">Requests</a></li>
            <li class="active"><a href="#">Declined</a></li>
        </ul>

      </section>
    </nav>



    <header>
        <h2 class="welcome_text">View 'Rejected' Requests</h2>
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
                            <dd><a href="/Admin/{{$user->id}}/Requests">Pending Requests</a></dd>
                            <dd><a href="/Admin/{{$user->id}}/Requests/Accepted">Confirmed Requests</a></dd>
                            <dd class="active"><a href="#">Rejected Requests</a></dd>
                        </dl> -->
                        <ul class="breadcrumbs">
                            <li><a href="/Admin/{{$user->id}}/Requests/">Pending Requests</a></li>
                            @if(Session::has('no_accepted'))
                            <li class="unavailable"><a data-tooltip aria-haspopup="true" class="tip-top" title="There are no confirmed requests that you have yet." href="#">Confirmed Requests</a></li>
                            @else
                            <li><a href="/Admin/{{$user->id}}/Requests/Accepted">Confirmed Requests</a></li>
                            @endif
                            <li class="current"><a href="#">Rejected Requests</a></li>
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
                                    <div data-alert class="alert-box alert" align="center">
                                        {{ Session::get('no_requests') }}
                                        <a href="#" class="close">&times;</a>
                                    </div>
                                </div>
                            </div>
                        @else

                        <table>
                            <thead>
                                <tr>
                                    <th><label><strong>Rejected Requests</strong></label></th>
                                </tr>
                            </thead>
                        </table>
                        <table>
                            <thead>
                                <tr>
                                    <th>PhD Student Name</th>
                                    <th>Support Activity Title</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dec_requests as $request)
                                <tr>                                                   
                                    <td>{{$request->phd->user->name}}</td>
                                    <td>{{$request->activity->title}}</td>
                                    <td><label class="error">{{$request->status}}</label></td>
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
    $(document).foundation();
</script>

</body>
</html>
