<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		
		if ($this->session->userdata('user_id') === FALSE OR $this->session->userdata('is_admin') == 'no') {
			redirect('login');
		}	
	}
	
	public function index($offset=0)
	{
		$this->load->library('pagination');
		$this->load->model('users_model');
		
		$config['base_url'] = site_url('admin/index/');
		$config['total_rows'] = count($this->users_model->get_users(true));
		$config['per_page'] = 25; 
		$config['uri_segment'] = 3;
		$config['full_tag_open'] = '<nav class="pull-left"><ul class="pagination pagination-sm">';
		$config['full_tag_close'] = '</ul></nav>';
		$config['first_link'] = '';
		$config['first_tag_open'] = '';
		$config['first_tag_close'] = '';
		$config['last_link'] = '';
		$config['last_tag_open'] = '';
		$config['last_tag_close'] = '';
		$config['next_link'] = '&raquo;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</a></li>';
		$config['prev_link'] = '&laquo;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="">';
		$config['cur_tag_close'] = '</a></li>';
		
		$data['page_title'] = 'Admin Page';
		$data['pending_verification'] = 'active';
		$data['users'] = '';
		$data['add_new_user'] = '';
		$data['page_name'] = 'Pending Verifications';
		$data['total_pending'] = count($this->users_model->get_users(true));
		
		$msg = $this->input->get('msg');
		
		if ($msg == 'approve_success') {
			$msg = '<div class="alert alert-success text-center" role="alert">User account request has been successfully approved. An email was sent to the user as notification of the status of his/her request.</div><br />';
		}
		
		$data['msg'] = $msg;
		
		$data['all_users'] = $this->users_model->get_users(true, $config['per_page'], $offset);
		$this->pagination->initialize($config); 
		
		$this->load->view('common/header', $data);
		$this->load->view('pages/admin/admin_page');
		$this->load->view('common/footer');
	}
	
	public function users($offset=0)
	{
		$this->load->library('pagination');
		$this->load->model('users_model');
		
		$config['base_url'] = site_url('admin/users/');
		$config['total_rows'] = count($this->users_model->get_users());
		$config['per_page'] = 25; 
		$config['uri_segment'] = 3;
		$config['full_tag_open'] = '<nav class="pull-left"><ul class="pagination pagination-sm">';
		$config['full_tag_close'] = '</ul></nav>';
		$config['first_link'] = '';
		$config['first_tag_open'] = '';
		$config['first_tag_close'] = '';
		$config['last_link'] = '';
		$config['last_tag_open'] = '';
		$config['last_tag_close'] = '';
		$config['next_link'] = '&raquo;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</a></li>';
		$config['prev_link'] = '&laquo;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="">';
		$config['cur_tag_close'] = '</a></li>';
		
		$data['page_title'] = 'Admin Page';
		$data['pending_verification'] = '';
		$data['users'] = 'active';
		$data['add_new_user'] = '';
		$data['page_name'] = 'Users';
		$data['total_pending'] = count($this->users_model->get_users(true));
		
		$data['all_users'] = $this->users_model->get_users(false, $config['per_page'], $offset);
		
		$this->pagination->initialize($config); 
		
		$msg = $this->input->get('msg');
		
		if ($msg == 'delete_success') {
			$msg = '<div class="alert alert-success text-center" role="alert">User account successfully deleted.</div><br />';
		}
		
		if ($msg == 'user_created') {
			$msg = '<div class="alert alert-success text-center" role="alert">User account successfully created.</div><br />';
		}
		
		if ($msg == 'user_edited') {
			$msg = '<div class="alert alert-success text-center" role="alert">User account successfully edited.</div><br />';
		}
		
		$data['msg'] = $msg;
		
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
			$msg .= "You can now login here: <a href='".site_url('login')."'></a><br><br>";
			
			$this->email->message($msg);	
			
			$this->email->send();
			
		}
		
		redirect('admin/index/?msg=approve_success');
		
	}
	
	public function delete_user($user_id)
	{
		$this->load->model('users_model');
		$this->users_model->delete_user($user_id);
		redirect('admin/users/?msg=delete_success');
	}
	
	public function add_user_ui()
	{
		$this->load->model('users_model');
		$msg = "";
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('full_name', 'Full Name', 'required');
		$this->form_validation->set_rules('email_address', 'Email Address', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if ($this->form_validation->run() == FALSE) {
			$error = trim(validation_errors());
			if ($error) {
				$msg = '<div class="alert alert-warning" role="alert">'.$error.'</div><br />';
			}
			
		} else {
			
			$data['is_admin'] = 'no';
			$data['full_name'] = $this->input->post('full_name', TRUE);
			$data['email_address'] = $this->input->post('email_address', TRUE);
			$data['status'] = '1';
			$data['password'] = $this->input->post('password', TRUE);
			
			if (isset($_POST['is_admin'])) {
				$data['is_admin'] = 'yes';
			}
			
			$this->users_model->create_user(
				$data['full_name'],
				$data['email_address'],
				$data['password'],
				$data['is_admin'],
				$data['status']
			);
			
			if (SEND_EMAIL) {
			
				$this->load->library('email');
					
				$config['mailtype'] = 'html';
				$this->email->initialize($config);
	
				$this->email->from('info@vitalye.me', 'Investor Login Application');
				$this->email->to($data['email_address']); 
				
				$this->email->subject('Requesteded Credentials: Investor Login Application');
				
				$exp = explode(' ', $data['full_name']);
				
				$msg = "Hi ".ucwords($exp[0]).", <br><br>";
				$msg .= "Your account has been created. Your password is <br><pre>".$data['password']."</pre><br>";
				$msg .= "You can now login here: <a href='".site_url('login')."'></a><br><br>";
				
				$this->email->message($msg);	
				
				$this->email->send();
				
			}
			
			redirect('admin/users/?msg=user_created');
			
		}
		
		$data['page_title'] = 'Admin Page';
		$data['pending_verification'] = '';
		$data['users'] = '';
		$data['add_new_user'] = 'active';
		$data['page_name'] = 'Add User';
		$data['total_pending'] = count($this->users_model->get_users(true));
		
		$data['msg'] = $msg;
		
		$this->load->view('common/header', $data);
		$this->load->view('pages/admin/add_user');
		$this->load->view('common/footer');
	}
	
	
	public function edit_user_ui($user_id="")
	{
		$this->load->model('users_model');
		$msg = "";
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('full_name', 'Full Name', 'required');
		$this->form_validation->set_rules('email_address', 'Email Address', 'required|valid_email');
		
		if ($this->form_validation->run() == FALSE) {
			$error = trim(validation_errors());
			if ($error) {
				$msg = '<div class="alert alert-warning" role="alert">'.$error.'</div><br />';
			}
			
		} else {
			
			$data['is_admin'] = 'no';
			$data['full_name'] = $this->input->post('full_name', TRUE);
			$data['email_address'] = $this->input->post('email_address', TRUE);
			$data['status'] = '1';
			$data['password'] = $this->input->post('password', TRUE);
			
			if (isset($_POST['is_admin'])) {
				$data['is_admin'] = 'yes';
			}
			
			
			$this->users_model->update_user(
				$user_id,
				$data
			);
			
			
			
			redirect('admin/users/?msg=user_edited');
			
		}
		
		$data['page_title'] = 'Admin Page';
		$data['pending_verification'] = '';
		$data['users'] = 'active';
		$data['add_new_user'] = '';
		$data['page_name'] = 'Edit User';
		$data['total_pending'] = count($this->users_model->get_users(true));
		
		$data['msg'] = $msg;
		
		$data['user_id'] = $user_id;
		$user = $this->users_model->get_user($user_id);
		$data['full_name'] = $user['full_name'];
		$data['email_address'] = $user['email_address'];
		$data['is_admin'] = $user['is_admin'];
		
		$this->load->view('common/header', $data);
		$this->load->view('pages/admin/edit_user');
		$this->load->view('common/footer');
	}
	
	public function generate_password()
	{
		$this->load->model('users_model');
		$pass = substr($this->users_model->generate_secure_keys(sha1(@time), rand(), true), 1, 12);
		print $pass;	
	}
	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */