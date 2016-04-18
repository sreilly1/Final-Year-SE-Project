
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
            <li class="active"><a href="#">Apply</a></li>
        </ul>
      </section>
    </nav>



    <header>

        <h2 class="welcome_text">Apply for Support Activity</h2>
    </header>






    
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
                                        <td>Code & Module Title</td>
                                        <th>Available Jobs  -  <strong data-tooltip aria-haspopup="true" class="has-tip tip-top" title="View all available jobs of the module stated">?</strong></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($module as $module)
                                        @if (App\Activity::where('module_id', $module->id)->exists())
                                            <tr>
                                                @if($module->description === '')
                                                <td><label data-tooltip aria-haspopup="true" class="tip-top" title="Unfortunately this module has no description, please contact system coordinator to get further details.">{{$module->module_code}} - {{$module->module_name}}</label></td>
                                                @else
                                                <td><label>{{$module->module_code}} - {{$module->module_name}}  -  <strong data-reveal-id="ModDesc-{{$module->id}}" data-tooltip aria-haspopup="true" class="has-tip tip-top" title="Click here to view module's description">?</strong></label></td>
                                                @endif
                                                <td><a href="/Phd/{{$user->id}}/Engagement-Form/Mod-{{$module->id}}">View</a></td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td><label class="error" data-tooltip aria-haspopup="true" class="tip-top" title="This module is not available at the moment, Sorry!">{{$module->module_code}} - {{$module->module_name}}</label></td>
                                                <td><label class="error" data-tooltip aria-haspopup="true" class="has-tip tip-top" title="This module is not available at the moment, Sorry!">Not Available</label></td>
                                            </tr>
                                        @endif
                                        <div id="ModDesc-{{$module->id}}" class="reveal-modal xlarge" data-reveal>
                                            <h3>Description of {{$module->module_name}}</h3>
                                            <!-- Social Dialogue Section -->
                                            <div class="row">
                                                <div class="large-12 columns">
                                                    <textarea readonly="readonly" style="resize: none; min-height:150px;">{{$module->description}}</textarea>
                                                </div>
                                            </div>
                                            <a class="close-reveal-modal">&#215;</a>
                                        </div>
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
        <script src="{{ asset('js/foundation/foundation.alert.js') }}"></script>
<script>
    $(document).foundation();
</script>

</body>
</html>
