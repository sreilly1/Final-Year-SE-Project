
<html>
<head>
    <meta charset="utf-8">
    <title>foundation on laravel</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <script src="<?php echo e(asset('js/modernizr.js')); ?>"> </script>
</head>
<body>



    <nav class="top-bar" data-topbar role="navigation">
      <ul class="title-area">
        <li class="name">
          <h1><a href="#"><?php echo e($user->title); ?>. <?php echo e($user->name); ?></a></h1>
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
              <li><a href="#">Main Page</a></li>
              <li><a href="#">View Requests</a></li>
            </ul>
          </li>
        </ul>
      </section>
    </nav>








    
    <section class="section_light">

        <div style="width:100%;"> <!-- Main Div -->
            <div class="row">
                <div class="large-12 medium-12 small-12 columns">
                    <?php if(Session::has('ErrMessage')): ?>
                        <div data-alert class="alert-box alert">
                            <?php echo e(Session::get('ErrMessage')); ?>

                            <a href="#" class="close">&times;</a>
                        </div>
                    <?php endif; ?>
                    <?php if(Session::has('success')): ?>
                    <div data-alert class="alert-box success" align="center">
                        <?php echo e(Session::get('success')); ?>

                        <a href="#" class="close">&times;</a>
                    </div>
                    <?php endif; ?>

                    <?php if(Session::has('failed')): ?>
                    <div data-alert class="alert-box alert">
                        <?php echo e(Session::get('failed')); ?>

                        <a href="#" class="close">&times;</a>
                    </div>
                    <?php endif; ?>
                    <?php if(Session::has('error_page')): ?>
                        <div data-alert class="alert-box alert" align="center">
                            <?php echo e(Session::get('error_page')); ?>

                            <a href="#" class="close">&times;</a>
                        </div>
                    <?php endif; ?>

                    <label><h2 class="welcome_text"><label>Dear</label><?php echo e($user->title); ?>. <?php echo e($user->name); ?> <label>Welcome to your panel!</label></h2></label>
                    <hr>
                </div>

                <div class="large-6 medium-12 small-12 columns">

                    <fieldset class="bio">

                        <legend class="legend">View User Details</legend>

                        <div class="row">
                            <div class="large-12 medium-12 small-12 columns">
                                <a href="#" data-reveal-id="MangUsrInf"  class="Small button alert round disabled">Manage</a>
                            </div>                              
                        </div>

                        <div id="MangUsrInf" class="reveal-modal large" data-reveal>
                            <fieldset class="bio">
                                <legend class="legend">
                                    <ul class="inline-list">
                                        <li><strong>Your Current Details</strong></li>
                                        <li><a href="#" data-reveal-id="EditInf">Edit</a></li>
                                    </ul>
                                </legend>
                                
                                
                                <div class="row">
                                    <div class="large-2 small-4 columns">
                                        <small>Title:</small>
                                        <h6><?php echo e($user->title); ?></h6>
                                    </div>
                                    <div class="large-2 small-4 columns">
                                        <small>Full Name:</small>
                                        <h6><?php echo e($user->name); ?></h6>
                                    </div>                                
                                    <div class="large-2 small-4 columns">
                                        <small>Username:</small>
                                        <h6><?php echo e($user->username); ?></h6>
                                    </div>
                                    <div class="large-2 small-5 columns">
                                        <small>Email Address:</small>
                                        <h6><?php echo e($user->email); ?></h6>
                                    </div>
                                    <div class="large-2 small-4 columns">
                                        <small>Phone Number</small>
                                        <h6><?php echo e($user->phone_number); ?></h6>
                                    </div>
                                    <div class="large-2 small-3 columns">
                                        <small>Room number:</small>
                                        <h6><?php echo e($user->room_number); ?></h6>
                                    </div>
                                </div>
                                <a class="close-reveal-modal">&#215;</a>
                            </fieldset>
                        </div>

                        <div id="EditInf" class="reveal-modal large" data-reveal>
                                <h3>Editing Details</h3>                                
                                <form action="/Lecturer/<?php echo e($user->id); ?>/updateInfo" role="form" method="post">
                                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                    <div class="large-2 columns">
                                        <label>Title</label>
                                        <select name="title">
                                            <option name="title" value="<?php echo e($user->title); ?>" selected="<?php echo e($user->title); ?>"><?php echo e($user->title); ?></option>
                                            <option name="title" value="Professor">Professor</option>
                                            <option name="title" value="Dr">Dr</option>
                                            <option name="title" value="Mr">Mr</option>
                                            <option name="title" value="Mrs">Mrs</option>
                                            <option name="title" value="Miss">Miss</option>
                                            <option name="title" value="Ms">Ms</option>
                                        </select>
                                    </div>
                                    <div class="large-3 columns">
                                        <label>Full Name</label>
                                        <input type="text" name="name" value="<?php echo e($user->name); ?>" />
                                    </div>
                                    <div class="large-3 columns">
                                        <label>Username</label>
                                        <input type="text" name="username" value="<?php echo e($user->username); ?>" />
                                    </div>
                                    <div class="large-2 columns">
                                        <label>Phone Number</label>
                                        <input type="text" name="phone_number" value="<?php echo e($user->phone_number); ?>" />
                                    </div>
                                    <div class="large-2 columns">
                                        <label>Room Number</label>
                                        <input type="text" name="room_number" value="<?php echo e($user->room_number); ?>" />
                                    </div>

                                    <div class="large-6 columns">
                                        <label>Email Address</label>
                                        <input type="text" name="email" value="<?php echo e($user->email); ?>" />
                                    </div>
                                    <div class="large-6 columns">
                                        <label>Account Password</label>
                                        <input type="text" name="password" value="<?php echo e($user->password); ?>" />
                                    </div>

                                    <div class="large-12 columns">
                                        <input type="submit" value="Update Details" class="nice tiny blue radius button">
                                        <a href="#" data-reveal-id="MangUsrInf" class="nice tiny blue radius button">Beck</a>
                                    </div>                
                                </form>
                                
                                <a class="close-reveal-modal">&#215;</a>
                        </div>

                    </div>




                <div class="large-6 medium-12 small-12 columns">

                    <fieldset class="bio">

                        <legend class="legend">Make Connection</legend>

                        <div class="row">
                            <div class="large-12 medium-12 small-12 columns">

                                <a href="#" data-reveal-id="ContUsr"  class="Small button alert round disabled">Email now</a>

                                <div id="ContUsr" class="reveal-modal xlarge" data-reveal>
                                    <h3>Contacting Existed User</h3>
                                    <!-- Social Dialogue Section -->
                                    <div class="row">
                                        <div class="small-12 medium-12 large-12 columns" id="listScroll">
                                            <h5><strong>List of users:</strong></h5>
                                            <div class="panel">
                                                <ul class="no-bullet">
                                                    <?php if(Session::has('no_admins')): ?>
                                                    <?php else: ?>                                                
                                                        <li><strong>Administrators and Support Team:</strong></li>
                                                        <ul class="no-bullet">
                                                        <?php foreach($admins as $admin): ?>
                                                          <li>- <a href="mailto:<?php echo e($admin->email); ?>"><?php echo e($admin->name); ?></a></li>
                                                        <?php endforeach; ?>
                                                        </ul>
                                                    <?php endif; ?>
                                                    <hr>
                                                    <?php if(Session::has('no_phds')): ?>
                                                    <?php else: ?>
                                                        <li><strong>Supervised PhD Students:</strong></li>
                                                        <ul class="no-bullet">
                                                        <?php foreach($sup_ppl as $phd): ?>
                                                          <li>- <a href="mailto:<?php echo e($phd->user->email); ?>"><?php echo e($phd->user->name); ?></a></li>
                                                        <?php endforeach; ?>
                                                        </ul>
                                                    <?php endif; ?>
                                                </ul>
                                            </div>                                                
                                        </div>
                                    </div>
                                    <a class="close-reveal-modal">&#215;</a>
                                </div>
                            </div>                              
                        </div>
                    </fieldset>

                </div>



                

                <div class="large-6 medium-12 small-12 columns">

                    <fieldset class="bio">

                        <legend class="legend">Modules and Activities</legend>

                        <div class="row">
                            <div class="large-12 medium-12 small-12 columns">                                
                                <a href="/Lecturer/<?php echo e($user->id); ?>/Modules"  class="Small button alert round disabled">Manage</a>
                            </div>                              
                        </div>

                        <div id="ModPage" class="reveal-modal xlarge" data-reveal>
                            <div class="row">
                                <div class="large-12 columns">

                                    <div class="large-12 medium-12 small-12 columns">
                                        <div class="panel">
                                            <a href="/Lecturer/<?php echo e($user->id); ?>/Modules">Manage Modules</a>
                                        </div>
                                    </div>

                                    <div class="large-12 medium-12 small-12 columns">
                                        <div class="panel">
                                            <a href="#">Manage Activities</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a class="close-reveal-modal">&#215;</a>
                        </div>



                    </fieldset>

                </div>



                


                <div class="large-6 medium-12 small-12 columns">

                    <fieldset class="bio">

                        <legend class="legend">Supervision</legend>

                        <a href="/Lecturer/<?php echo e($user->id); ?>/Sup" class="Small button alert round disabled">View</a>                    
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



        <script src="<?php echo e(asset('js/f5_components.js')); ?>"> </script>
        <script src="<?php echo e(asset('js/vendor/jquery.js')); ?>"></script>
        <script src="<?php echo e(asset('js/foundation/foundation.js')); ?>"></script>
        <script src="<?php echo e(asset('js/foundation/foundation.reveal.js')); ?>"></script>
        <script src="<?php echo e(asset('js/foundation/foundation.topbar.js')); ?>"></script>
        <script src="<?php echo e(asset('js/foundation/foundation.alert.js')); ?>"></script>
<script>
    $(document).foundation();
</script>

</body>
</html>
