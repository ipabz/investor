<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	
	public function index()
	{
		$msg = $this->input->get('msg');
		
		if ($this->input->post('email_address')) { 
		$this->load->library('form_validation');
		
		
		$this->form_validation->set_rules('email_address', 'Email Address', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if ($this->form_validation->run() == FALSE) {
			//redirect('login/index/?msg=invalid');
			print validation_errors();
			$msg = 'invalid';
		} else {
			
			$this->load->model('users_model');
			
			if ( $user = $this->users_model->login($this->input->post('email_address', TRUE), $this->input->post('password', TRUE)) ) {
				$this->session->set_userdata($user);
				if ($user['is_admin'] == 'yes') {
					redirect('admin');
				} else {
					redirect('users');
				}
				
			} else {
				$msg = 'invalid';	
			}
			
		}	
		}
		
		
		
		if ($msg == 'invalid') {
			$msg = '<span class="error-msg">Incorrect login details!</span><br />';
		}
		
		$data['msg'] = $msg;
		
		$data['page_title'] = 'Investor Login';
		$data['current_page'] = 'login';
		
		$this->load->view('common/header', $data);
		$this->load->view('pages/request_credentials/request_credentials_page');
		$this->load->view('common/footer');
	}
	
	public function generate_password()
	{
		$this->load->model('users_model');
		$this->users_model->generate_secure_keys(sha1(SALT), 'admin');
	}
	
	
	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */