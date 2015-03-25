<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Install extends CI_Controller {

    public function __construct() {
      parent::__construct();
      $this->load->helper(array('form', 'url'));
    }
  
	public function index()
	{      
      $this->load->library('migration');
      $success = $this->migration->current();
      
      if ($success) {
		  print 'Successfully installed the database.';
	  } else {
		  print 'An error occured while installing database.';  
	  }
      
	}
    
}

/* End of file install.php */
/* Location: ./application/controllers/install.php */