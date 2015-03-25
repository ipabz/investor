<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	
	public function index()
	{
		$data['page_title'] = 'Investor Login';
		$data['current_page'] = 'login';
		
		$this->load->view('common/header', $data);
		$this->load->view('pages/request_credentials/request_credentials_page');
		$this->load->view('common/footer');
	}
	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */