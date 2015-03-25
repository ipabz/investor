<div class="container">
  <div class="content">

<div class="main-container-admin">

	<nav class="navbar navbar-default">
  <div class="container-fluid"><div class="navbar-header">
      
      <a class="navbar-brand" href="<?php print site_url('admin'); ?>">Admin Panel</a>
    </div></div></nav>

	<div class="left">
    	<div class="list-group">
          <a href="<?php print site_url('admin'); ?>" class="list-group-item <?php print $pending_verification; ?>">
          	Pending Verification
          </a>
          <a href="<?php print site_url('admin/users'); ?>" class="list-group-item <?php print $users; ?>">Users</a>
          <a href="#" class="list-group-item <?php print $add_new_user; ?>">Add New User</a>
          <a href="#" class="list-group-item"><div class="btn btn-danger" style="width: 100%">Logout</div></a>
        </div>
    </div>
    
    <div class="right">
    
    	<h3><?php print $page_name; ?></h3> <hr />
    
    	<table class="table table-striped">
        	<thead>
            	<tr>
                	<th class="text-center">#</th>
                    <th>Full Name</th>
                    <th>Email Address</th>
                    <th>Status</th>
                    <th>Is Admin</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
			$counter = 1;
			foreach($all_users as $row) {
				extract($row);
			?>
            	<tr>
                	<td class="text-center"><?php print $counter; ?></td>
                    <td><?php print ucwords($full_name); ?></td>
                    <td><?php print $email_address; ?></td>
                    <td>
                    <?php
					if ($status == 0) {
						print 'Not Verified';
					} else {
						print 'Verified';	
					}
					?>
                    </td>
                    <td>
                    <?php
					if ($is_admin == 'no') {
						print '<span class="label label-success">No</span>';
					} else {
						print '<span class="label label-danger">Yes</span>';	
					}
					?>
                    </td>
                    <td>
                    	<?php if ($page_name == 'Pending Verifications') : ?>
                    	<a href="" title="Approve Request" class="btn btn-success"><span class="glyphicon glyphicon-hand-right"></span> Approve</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php
				$counter++;
			}
			?>
            </tbody>
        </table>
    
    </div>

	<div class="clearfix"></div>

</div>
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