<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Initial_schema extends CI_Migration {
  
  public function up() {
    
    /**
     * Remove tables if exists
     */
    $this->dbforge->drop_table(TABLE_USERS);
    
    /**
     * Create 'users' table
     */
    $this->dbforge->add_key('user_id', TRUE);
    
    $users = array(
      'user_id' => array(
          'type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE 
      ),
      'full_name' => array(
          'type' => 'VARCHAR', 'constraint' => 255, 'null' => FALSE
      ),
      'email_address' => array(
          'type' => 'VARCHAR', 'constraint' => 100, 'null' => FALSE
      ),
      'status' => array(
          'type' => 'INT', 'constraint' => 1, 'null' => FALSE
      ),
      'is_admin' => array(
          'type' => 'VARCHAR', 'constraint' => 3, 'null' => FALSE
      ),
      'password' => array(
          'type' => 'VARCHAR', 'constraint' => 100, 'null' => TRUE
	  ),
      'date_created' => array(
          'type' => 'VARCHAR', 'constraint' => 50, 'null' => FALSE
	  ),
      'last_updated' => array(
          'type' => 'VARCHAR', 'constraint' => 50, 'null' => FALSE
	  ),
      'date_verified' => array(
          'type' => 'VARCHAR', 'constraint' => 50, 'null' => TRUE
	  )
    );
    
    $this->dbforge->add_field($users);
    $this->dbforge->create_table(TABLE_USERS);
	
	$time = @time();
	
	$default_user = array(
		'full_name' => 'Admin',
		'email_address' => 'ipabelona@gmail.com',
		'status' => '1',
		'is_admin' => 'yes',
		'password' => '0963ac0f9647b260575697bd2ad9560cefc644a5',
		'date_created' => $time,
		'last_updated' => $time,
		'date_verified' => $time
	);
	
	$this->db->insert(TABLE_USERS, $default_user);
	
  }
  
  public function down() {
    $this->dbforge->drop_table(TABLE_USERS);
  }
  
}

/* End of file 001_initial_schema.php */
/* Location: ./application/migrations/001_initial_schema.php */