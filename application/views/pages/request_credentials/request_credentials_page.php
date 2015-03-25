<div class="container">
  <div class="content">
    <div class="row" style="height: 600px;"> 
      
      <!-- Left Column / Login Logo -->
      <div class="col-lg-8 col-md-7 col-sm-12" style="margin-top: 14%;">
        <div class="login-logo" style="text-align: center;"> <img src="assets/images/login-logo.png" style="height: auto; width: 100%;max-width:600px;" alt="Vitalyze.Me" /> </div>
      </div>
      <!-- /.col-lg-6 --> 
      
      <!-- Right Column / Login / Register Form -->
      <div class="col-lg-4 col-md-5 col-sm-12" style="margin-top: 10%;">
        <div role="tabpanel"> 
          
          <!-- Nav tabs -->
          <ul class="nav nav-tabs" style="margin-bottom: -10px;" role="tablist">
            <li id="signup-tab" role="presentation" style="height:60px !important; background:#fff;box-shadow: -5px 0 0 #1274cd; font-size: 20px;width:60%; text-align: center;" class="<?php print (($current_page == 'signup') ? "active" : ""); ?>"> <a style="border:none !important;" href="#signup" aria-controls="signup" role="tab" data-toggle="tab">Request Credentials</a> </li>
            <li id="login-tab" role="presentation" style="height:60px !important; background: #28a8ee !important;float: right; font-size: 20px;width: 40%; text-align: center;" class="<?php print (($current_page == 'login') ? "active" : ""); ?>"> <a href="#login" style="color: #fff;background: #28a8ee !important;border:none !important;" aria-controls="login" role="tab" data-toggle="tab">Login</a> </li>
          </ul>
          
          <!-- Tab panes -->
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in <?php print (($current_page == 'signup') ? "active" : ""); ?>" id="signup">
              <div class="registration-form">
                <!--<form id="reg-form" class="form-horizontal" action="register" role="form" method="POST">-->
                <?php print form_open('request_credentials/do_action', 'id="reg-form" class="form-horizontal" role="form"'); ?>
                  <div class="form-group has-feedback home-fix">
                    <div class="col-md-12">
                      <input type="text" name="full_name" id="full_name" value="" required placeholder="Full Name" class="login-input" />
                      <span class="glyphicon form-control-feedback home-icon" id="full_name1"></span> </div>
                  </div>
                  <div class="form-group has-feedback home-fix">
                    <div class="col-md-12">
                      <input type="email" name="email_address" id="email_address" value="" required placeholder="Email Address" class="login-input" />
                      <span class="glyphicon form-control-feedback home-icon" id="email_address1"></span> </div>
                  </div>


                  <br />
                  <div style="float: right;">
                    <button class="join-button">Request Credentials</button>
                  </div>
                <?php print form_close(); ?>
                <div class="clearfix cf"></div>
              </div>
            </div>
            <div role="tabpanel" class="tab-pane  <?php print (($current_page == 'login') ? "active" : "fade"); ?>" id="login">
              <div class="login-form">
                <?php print form_open('login', 'id="login-form" class="form-horizontal" role="form"'); ?>
                  <?php
				  if (@$msg !== '') {
					  print @$msg;
				  }
				  ?>
                  <div class="form-group has-feedback home-fix">
                    <div class="col-md-12">
                      <input type="email" name="email_address" value="<?php print set_value('email_adddress'); ?>" id="username" required placeholder="Email Address" class="login-input" />
                      <span class="glyphicon form-control-feedback home-icon" id="username1"></span> </div>
                  </div>
                  <div class="form-group has-feedback home-fix">
                    <div class="col-md-12">
                      <input type="password" name="password" id="login_password" required placeholder="Password" class="login-input" />
                      <span class="glyphicon form-control-feedback home-icon" id="login_password1"></span> </div>
                  </div>
                  <div>
                    <div class="remember-me">
                      <input type="checkbox" value="1" name="remember_me" checked style="margin-top: 2px;">
                      Remember Me </div>
                    <div class="forgot-pw"> <!--<a href="#">Forgot Password?</a>--> </div>
                  </div>
                  <div class="login-button-container" style="float: right;">
                    <button class="login-button">Login</button>
                  </div>
                <?php print form_close(); ?>
                <div class="clearfix cf"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.col-lg-6 --> 
      
    </div>
    <!-- /.row --> 
    
    <div class="clearfix cf"></div>
    
    <!-- Footer Links -->
    <div class="row" style="margin-top: -10px;">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <ul class="footer-links">
          <li> <a href="http://www.vitalyze.me/about-us" target="_blank">About</a> </li>
          <li> <a href="http://www.vitalyze.me/questions" target="_blank">Help</a> </li>
          <li> <a href="#" data-toggle="modal" data-target="#terms">Terms</a> </li>
          <li> <a href="#" data-toggle="modal" data-target="#privacy">Privacy</a> </li>
          <li> <a href="http://www.vitalyze.me" target="_blank">Contact Us</a> </li>
        </ul>
        <div class="text-right" style="color:#ffffff;">&copy; 2015 Vitalyze.Me</div>
      </div>
    </div>
    <br />
    <br />
    <div class="clearfix cf"></div>
  </div>
  <!-- /.content --> 
</div>
<!-- /.container --> 

