
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
      </section>
    </nav>



    <header>

        <h2 class="welcome_text">Admin Panel</h2>
    </header>

    <!-- ######################## Section ######################## -->





    
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
                    @if(Session::has('email_success'))
                        <div data-alert class="alert-box secondary">
                            <label class="green">Email was successfully sent, please click <a data-reveal-id="CretML"><label><strong>here</strong></label></a> if you want to send another one</label>
                            <a href="#" class="close">&times;</a>
                        </div>
                    @endif
                    @if(Session::has('user_email_success'))
                        <div data-alert class="alert-box secondary">
                            <label class="green">Email was successfully sent, please click <a data-reveal-id="ContUsr"><label><strong>here</strong></label></a> if you want to send another one</label>
                            <a href="#" class="close">&times;</a>
                        </div>
                    @endif
                </div>
                <div class="large-4 medium-8 small-12 columns">

                    <fieldset class="bio">

                        <legend class="legend">Modules and Activities</legend>

                        <div class="row">
                            <div class="large-12 medium-12 small-12 columns">
                                <p class="p">

                                </p>
                                <a href="#" data-reveal-id="ModPage"  class="button alert round disabled">View & Edit</a>

                            </div>                              
                        </div>

                        <!-- M & A main -->
                        <div id="ModPage" class="reveal-modal xlarge" data-reveal>
                            <h3>Modules and Activities</h3>
                            <!-- Social Dialogue Section -->
                            <div class="row">
                                <div class="large-12 columns">

                                    <div class="large-12 medium-12 small-12 columns">
                                        <div class="panel">
                                            <a href="/Admin/{{$user->id}}/Modules">Manage Modules</a>
                                        </div>
                                    </div>

                                    <div class="large-12 medium-12 small-12 columns">
                                        <div class="panel">
                                            <a href="/Admin/{{$user->id}}/Activities">Manage Activities</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a class="close-reveal-modal">&#215;</a>
                        </div>
                        <!-- REveal Modals Ends -->                        
                    </fieldset>

                </div>



                <div class="large-4 medium-8 small-12 columns">

                    <fieldset class="bio">

                        <legend class="legend">Users</legend>

                        <div class="row">
                            <div class="large-12 medium-12 small-12 columns">
                                <p class="p">

                                </p>
                                <a href="/Admin/{{$user->id}}/Users" class="button alert round disabled">Manage Users</a>

                            </div>                              
                        </div>
                    </fieldset>
                </div>



                <div class="large-4 medium-8 small-12 columns">

                    <fieldset class="bio">

                        <legend class="legend">Make Connection</legend>

                        <div class="row">
                            <div class="large-12 medium-12 small-12 columns">
                                <p class="p">

                                </p>
                                <a href="#" data-reveal-id="EMailP"  class="button alert round disabled">Make E-MAIL</a>

                            </div>                              
                        </div>

                        <!-- Connection main -->
                        <div id="EMailP" class="reveal-modal xlarge" data-reveal>
                            <h3>Make Connection</h3>
                            <!-- Social Dialogue Section -->
                            <div class="row">
                                <div class="large-12 columns">

                                    <div class="large-6 medium-6 small-6 columns">
                                        <div class="panel">
                                            <a data-reveal-id="CretML">Create E-Mail</a>
                                        </div>
                                    </div>

                                    <div class="large-6 medium-6 small-6 columns">
                                        <div class="panel">
                                            <a data-reveal-id="ContUsr">E-Mail a User</a>
                                        </div>
                                    </div>
                                    <div class="large-12 medium-12 small-12 columns">
                                        <div class="panel">
                                            <a data-reveal-id="archive">View Archive</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a class="close-reveal-modal">&#215;</a>
                        </div>
                        <!-- REveal Modals Ends -->

                        <!-- Create E-mail Section -->
                        <div id="CretML" class="reveal-modal xlarge" data-reveal>
                            <h3>Create Email</h3>
                            <!-- Social Dialogue Section -->
                            <div class="row">

                                <div class="small-12 medium-12 large-12 columns">
                                  <form action="/Admin/{{$user->id}}/email" role="form" method="post">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                      <label>Subject</label>
                                      <!-- <small class="error">Enter Subject</small> -->
                                      <input name="subject" type="text" placeholder="Hello" required>


                                      <label>Send to:</label>
                                      <!-- <small class="error">Name of receiver</small> -->
                                      <input name="getterName" type="text" placeholder="John" required>


                                      <label>Email</label>
                                      <!-- <small class="error">An email address is required.</small> -->
                                      <input name="email" type="email" placeholder="username@address.com" required>

                                      <label>Your Message</label>
                                      <!-- <small class="error">Your message is required.</small> -->
                                      <textarea name="message" placeholder="Enter your message here" required></textarea>

                                      <input type="submit" class="nice blue small radius button">
                                      <a data-reveal-id="EMailP" class="nice small blue radius button">Back</a>
                                  </form>
                              </div>

                              <a class="close-reveal-modal">&#215;</a>
                          </div>
                        <!-- Create E-mail Section Ends -->

                        


                        <!-- Contact User -->
                        <div id="ContUsr" class="reveal-modal xlarge" data-reveal>
                            <h3>E-Mail a User</h3>
                            <!-- Social Dialogue Section -->
                            <div class="row">
                                <div class="small-12 medium-12 large-12 columns">
                                <form action="/Admin/{{$user->id}}/emailUsr" role="form" method="post">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <label>Subject</label>
                                    <!-- <small class="error">Enter Subject</small> -->
                                    <input name="subject" type="text" placeholder="Hello" required>

                                    <label>Name</label>
                                    <!-- <small class="error">Enter Subject</small> -->
                                    <input name="getterName" type="text" placeholder="Dear (...)" required>


                                    <label>Choose User (To initialise Email)</label>
                                    <!-- <small class="error">Name of receiver</small> -->
                                    <select name="email">
                                        @foreach($users as $users)
                                            <option name="email" value="{{$users->email}}" required>{{$users->name}}</option>
                                        @endforeach
                                    </select>

                                    <label>Your Message</label>
                                    <!-- <small class="error">Your message is required.</small> -->
                                    <textarea name="message" placeholder="Enter your message here" required></textarea>
                                    <input type="submit" class="nice blue small radius button">
                                    <a data-reveal-id="EMailP" class="nice small blue radius button">Back</a>
                                </form>
                            </div>
                        </div>
                            <a class="close-reveal-modal">&#215;</a>
                        </div>
                        <!-- Contact User Ends -->



                        <!-- Archive Starts -->
                        <div id="archive" class="reveal-modal xlarge" data-reveal>
                            <h3>Archive of Mails</h3>
                            <!-- Social Dialogue Section -->
                            <div class="row">
                                <div class="large-12 columns">                            
                                    <form>
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Sent To (NAME)</th>
                                                    <th>Sent To (EMAIL-ADDRESS)</th>
                                                    <th>Subject</th>
                                                    <th>Message</th>
                                                    <th>Sent At</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($archive as $arc)
                                                <tr>
                                                    <td>{{$arc->rec_name}}</td>
                                                    <td>{{$arc->rec_email}}</td>
                                                    <td>{{$arc->email_subject}}</td>
                                                    <td>{{$arc->message}}</td>
                                                    <td>{{$arc->sent_at}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                            </div>
                            <a data-reveal-id="EMailP">Back</a>
                            <a class="close-reveal-modal">&#215;</a>
                        </div>
                        <!-- Archive Ends  -->

                        </div> 
                    </fieldset>

                </div>


                <div class="large-12 medium-8 small-12 columns">

                    <fieldset class="bio">

                        <legend class="legend">
                            <ul class="inline-list">
                                @if (App\AddRequest::exists())
                                    <li><strong>Manage PhD Student Job Applications Requests</strong></li>
                                @else
                                    <li><strong style="color: red;">Manage PhD Student Job Applications Requests</strong></li>
                                @endif
                                @if (App\AddRequest::where('status', '=', 'Pending')->exists())
                                    @if ($pending == 1)
                                    <li><label style="color:#778899;" data-tooltip aria-haspopup="true" class="has-tip tip-top" title="You have {{$pending}} 'Job Application' requested that is still pending">Pending(<strong style="color:black;">{{$pending}}</strong>)</label></li>
                                    @else
                                    <li><label style="color:#778899;" data-tooltip aria-haspopup="true" class="has-tip tip-top" title="You have {{$pending}} 'Job Application' requested that are still pending">Pending(<strong style="color:black;">{{$pending}}</strong>)</label></li>
                                    @endif
                                @endif
                            </ul>
                        </legend>

                        @if (App\AddRequest::exists())
                        <div class="row">
                            <div class="large-12 medium-12 small-12 columns">
                                <a href="/Admin/{{$user->id}}/Requests" class="button alert disabled postfix">View & Manage Requests</a>
                            </div>                               
                        </div>
                        @else
                        <div class="row">
                            <div class="large-12 medium-12 small-12 columns">
                                <button class="button secondary disabled postfix"><a href="/Admin/{{$user->id}}/Requests" style="color: red;" data-tooltip aria-haspopup="true" class="has-tip tip-top" title="There are no applications requested by any PhD Studnet yet">View & Manage Requests</a></button>
                            </div>                               
                        </div>
                        @endif

                    </fieldset>

                </div>

                <!-- End of sections -->


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
