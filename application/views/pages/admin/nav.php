<div class="list-group">
    <a href="<?php print site_url('admin'); ?>" class="list-group-item <?php print $pending_verification; ?>">
    	Pending Verification <span class="badge"><?php print $total_pending; ?></span>
    </a>
    <a href="<?php print site_url('admin/users'); ?>" class="list-group-item <?php print $users; ?>">Users</a>
    <a href="<?php print site_url('admin/add_user_ui'); ?>" class="list-group-item <?php print $add_new_user; ?>">Add New User</a>
    <a href="<?php print site_url('admin/logout'); ?>" class="list-group-item"><div class="text-center"><?php print $this->session->userdata('full_name'); ?></div><div class="btn btn-danger" style="width: 100%">Logout</div></a>
</div>