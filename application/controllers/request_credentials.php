<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Request_credentials extends CI_Controller {
	
	public function index()
	{
		$data['page_title'] = 'Request Credentials';
		$data['current_page'] = 'signup';
		
		$this->load->view('common/header', $data);
		$this->load->view('pages/request_credentials/request_credentials_page');
		$this->load->view('common/footer');
	}
	
}

/* End of file request_credentials.php */
/* Location: ./application/controllers/request_credentials.php */