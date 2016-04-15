
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



                            <div class="row">
                                <div class="large-12 medium-12 small-12 columns">
                                    @if(Session::has('no_students'))
                                        <div class="row">
                                            <div class="large-12 medium-12 small-12 columns">
                                            <fieldset class="bio">
                                                <legend class="legend"><label class="error">No Students</label></legend>
                                                <div data-alert class="alert-box alert" align="center">
                                                    {{ Session::get('no_students') }}                                                    
                                                </div>
                                            </fieldset>
                                            </div>
                                        </div>
                                    @else
                                    <fieldset class="bio">
                                        <legend class="legend"><label>PhD Students</label></legend>
                                        <dl class="sub-nav">
                                            <dd class="active"><a href="#">PhD Students</a></dd>
                                            <dd><a href="/Lecturer/{{$user->id}}/Sup/Requests">Confirmation Requests</a></dd>
                                        </dl>
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Student Name</th>
                                                    <th>Student ID#</th>
                                                    <th>Year of Study</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($users as $phd)
                                                <tr>
                                                    <td>{{$phd->user->title}}. {{$phd->user->name}}</td>
                                                    <td>{{$phd->user->username}}</td>  
                                                    <td>{{$phd->year_of_study}}</td>                                                                                           
                                                    <td><a href="/Lecturer/{{$user->id}}/Sup/Stu{{$phd->user_id}}">View</a></td>
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
