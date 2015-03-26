<div class="container">
  <div class="content">

<div class="main-container-admin">

	<nav class="navbar navbar-default">
  <div class="container-fluid"><div class="navbar-header">
      
      <a class="navbar-brand" href="<?php print site_url('admin'); ?>">Admin Panel</a>
    </div></div></nav>

	<div class="left">
    	<?php $this->load->view('pages/admin/nav'); ?>
    </div>
    
    <div class="right">
    	<?php
		if (@$msg != "") {
			print $msg;
		}
		?>
    	<h3><?php print $page_name; ?></h3> <hr />
    
		<div style="padding: 10px 10%">
        
            <?php print form_open('admin/edit_user_ui/'.$user_id, 'class="form-horizontal"'); ?>
            	<div class="form-group">
                <label for="full_name" class="col-sm-2 control-label">Full Name</label>
                <div class="col-sm-10">
                  <input type="text" name="full_name" value="<?php print set_value('full_name', $full_name); ?>" class="form-control" id="full_name" placeholder="Full Name">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                  <input type="email" name="email_address" value="<?php print set_value('email_address', $email_address); ?>" class="form-control" id="inputEmail3" placeholder="Email">
                </div>
              </div>
              <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                  <input type="text" name="password" value="" class="form-control" id="inputPassword3" placeholder="Password">
                  <div class="text-right"><a id="generate_password" href="<?php print site_url('admin/generate_password'); ?>">Generate Password</a></div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="is_admin" <?php print (($is_admin == 'yes') ? "checked" : ""); ?>> Administrator
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10"><br />
                  <button type="submit" class="btn btn-default">Update Account</button>
                </div>
              </div>
            <?php print form_close(); ?>
        
        </div>
    
    </div>

	<div class="clearfix"></div>

</div>
