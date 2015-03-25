<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	public function index()
	{
		$data['page_title'] = 'Admin Page';
		$data['pending_verification'] = 'active';
		$data['users'] = '';
		$data['add_new_user'] = '';
		$data['page_name'] = 'Pending Verifications';
		
		$this->load->model('users_model');
		$data['all_users'] = $this->users_model->get_users(true);
		
		$this->load->view('common/header', $data);
		$this->load->view('pages/admin/admin_page');
		$this->load->view('common/footer');
	}
	
	public function users()
	{
		$data['page_title'] = 'Admin Page';
		$data['pending_verification'] = '';
		$data['users'] = 'active';
		$data['add_new_user'] = '';
		$data['page_name'] = 'Users';
		
		$this->load->model('users_model');
		$data['all_users'] = $this->users_model->get_users(false);
		
		$this->load->view('common/header', $data);
		$this->load->view('pages/admin/admin_page');
		$this->load->view('common/footer');
	}
	
	public function approve($user_id)
	{
		$this->load->model('users_model');
		$time = @time();
		$data['status'] = '1';
		$data['date_verified'] = $time;
		$password = substr( sha1($this->users_model->generate_secure_keys(@time(), rand())), 1, 12);
		$data['password'] = $password;
		
		$user = $this->users_model->update_user($user_id, $data);
		
		if (SEND_EMAIL) {
			
			$this->load->library('email');
				
			$config['mailtype'] = 'html';
			$this->email->initialize($config);

			$this->email->from('info@vitalye.me', 'Investor Login Application');
			$this->email->to($user['email_address']); 
			
			$this->email->subject('Requesteded Credentials: Investor Login Application');
			
			$exp = explode(' ', $user['full_name']);
			
			$msg = "Hi ".ucwords($exp[0]).", <br><br>";
			$msg .= "Your request has been approved. Your password is <br><pre>".$password."</pre><br>";
			$msg .= "You can now login here: <a href='".site_url('login');."'></a><br><br>";
			
			$this->email->message($msg);	
			
			$this->email->send();
			
		}
		
	}
	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */