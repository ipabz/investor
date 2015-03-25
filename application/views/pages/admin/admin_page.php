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
			
			if (!$all_users) {
			?>
            	<tr>
                	<td colspan="6" class="text-center"><?php print $page_name." empty!" ?></td>
                </tr>
            <?php
			}
			
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
                    	<a href="<?php print site_url('admin/approve/'.$user_id); ?>" title="Approve Request" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-hand-right"></span> Approve</a>
                        <?php endif; ?>
                        
                        <?php if ($page_name == 'Users') : ?>
                    	<a href="<?php print site_url('admin/edit_user_ui/'.$user_id); ?>" title="Edit User" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-pencil"></span></a>
                        <a href="<?php print site_url('admin/delete_user/'.$user_id); ?>" title="Delete User" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-remove"></span></a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php
				$counter++;
			}
			?>
            </tbody>
        </table>
        
        <div><?php print $this->pagination->create_links(); ?></div>
    
    </div>

	<div class="clearfix"></div>

</div>