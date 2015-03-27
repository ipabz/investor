<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Request_credentials extends CI_Controller {
	
	public function index($error="")
	{
		$data['page_title'] = 'Request Credentials';
		$data['current_page'] = 'signup';
		
		$this->load->view('common/header', $data);
		$this->load->view('pages/request_credentials/request_credentials_page');
		$this->load->view('common/footer');
	}
	
	public function do_action()
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('full_name', 'Full Name', 'required');
		$this->form_validation->set_rules('email_address', 'Email Address', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if ($this->form_validation->run() == FALSE) {
			$error = validation_errors();
			$this->index($error);
		} else {
			
			$this->load->model('users_model');
			$password = $this->input->post('password', TRUE);
			
			$this->users_model->create_user(
				$this->input->post('full_name', TRUE),
				$this->input->post('email_address', TRUE),
				$password,
				'no',
				'1'
			);
			
			if (SEND_EMAIL) {
				
				$this->load->library('email');
				
				$config['mailtype'] = 'html';
				$this->email->initialize($config);

				$this->email->from('noreply@vitalyze.me', 'Investor Login Application');
				$this->email->to(REQUEST_CREDENTIALS_SEND_TO_EMAIL); 
				
				$this->email->subject('Request Credentials: Investor Login Application');
				
				$msg = "Someone has requested login credentials. Please login to the <a href='".site_url('login')."'>admin panel</a>. <br><br><strong>Person Details</strong><br><br>";
				$msg .= "Full Name: ".ucwords($this->input->post('full_name', TRUE));
				$msg .= "<br>Email Address: ".$this->input->post('email_address', TRUE);
				
				$this->email->message($msg);	
				
				$this->email->send();
				
				$this->email->clear();
				
				$this->email->from('noreply@vitalyze.me', 'Investor Login Application');
				$this->email->to($this->input->post('email_address', TRUE)); 
				
				$this->email->subject('Requesteded Credentials: Investor Login Application');
				
				$exp = explode(' ', $this->input->post('full_name', TRUE));
				
				$msg = "Hi ".ucwords($exp[0]).", <br><br>";
				$msg .= "Your request has been approved. Your password is <br><pre>".$password."</pre><br>";
				$msg .= "You can now login here: <a href='".site_url('login')."'>Login Page</a><br><br>";
				
				$this->email->message($msg);	
				
				$this->email->send();
				
			}
			
			redirect('confirmation/success');
			
			
		}
	}
	
	public function success()
	{
		$data['page_title'] = 'Request Credentials';
		
		$this->load->view('common/header', $data);
		$this->load->view('pages/request_credentials/success_page');
		$this->load->view('common/footer');
	}
	
}

/* End of file request_credentials.php */
/* Location: ./application/controllers/request_credentials.php */