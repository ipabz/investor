<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model {
	
	public function generate_secure_keys($secret, $text, $return=FALSE)
	{   
		$hash = hash_hmac('ripemd160', $text, $secret);
		
		if ( $return ) {
		  return $hash;
		} else {
		  echo $hash;
		}
	}
	
	public function create_user($full_name, $email_address, $password, $is_admin='no', $status='0')
	{
		$time = @time();
		
		$data['full_name'] = trim($full_name);
		$data['email_address'] = trim($email_address);
		$data['password'] = $this->generate_secure_keys(sha1($data['email_address']), $password, TRUE);
		$data['date_created'] = $time;
		$data['last_updated'] = $time;
		$data['status'] = $status;
		$data['is_admin'] = $is_admin;
		
		$this->db->insert(TABLE_USERS, $data);
	}
	
	public function update_user($user_id, $data)
	{
		$user = $this->get_user($user_id);
		
		$data['password'] = $this->generate_secure_keys(sha1($user['email_address']), $data['password'], TRUE);
		$this->db->where('user_id', $user_id);
		$this->db->update(TABLE_USERS, $data);	
		
		return $user;
	}
	
	public function get_user($user_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->limit(1);
		$query = $this->db->get(TABLE_USERS);
		
		$data = FALSE;
		
		if ($query->num_rows() > 0) {
			$data = $query->row_array();
		}
		
		return $data;
	}
	
	public function get_users($pending=false, $limit=0, $offset=0)
	{
		if ($limit > 0) {
			$this->db->limit($limit, $offset);
		}
		
		if ($pending == true) {
			$this->db->where('status', '0');
		} else {
			$this->db->where('status', '1');
		}
		
		$query = $this->db->get(TABLE_USERS);

		return $query->result_array();
	}
	
	public function delete_user($user_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->delete(TABLE_USERS);	
	}
		
}

/* End of file users_model.php */
/* Location: ./application/models/users_model.php */