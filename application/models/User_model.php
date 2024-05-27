<?php
  class User_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function get_users() {
        $query = $this->db->get('users');
        return $query->result_array();
    }

    public function get_user_id($userid) {
        $query = $this->db->get_where('users', array('userid' => $userid));
        return $query->row_array();
    }
    // Get a list of users with authors' contact information
    public function get_users_with_authors() {
        // Fetching users data with authors' information
        $this->db->select('users.userid, users.complete_name, users.email, users.profile_pic, users.status, users.date_created, authors.contact_num');
        $this->db->from('users');
        $this->db->join('authors', 'authors.auid = users.auid', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    // Get user data by userid
    public function get_user_by_id($userid){
		$query = $this->db->get_where('users', array('userid' => $userid));
		return $query->row_array();
	}
    

    public function update_user($userid, $data) {
        $this->db->where('userid', $userid);
        return $this->db->update('users', $data);
    }
    // public function get_user_by_id($userid) {
    //     $query = $this->db->get_where('users', array('userid' => $userid));
    //     return $query->row_array();
    // }
    
    public function delete_user($userid) {
        // Perform the deletion operation in the database
        // Replace 'users' with your actual table name and 'user_id' with the appropriate column name
        $this->db->where('userid', $userid);
        $this->db->delete('users');

        // Check if the deletion was successful
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function register($enc_password){
        // User data array
        $data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'password' => $enc_password,
        );

        // Insert user
        return $this->db->insert('users', $data);
    }
    
    public function get_user_with_image($userid) {
        // Adjust 'profile_pic' based on your actual column name for the image
        $this->db->select('userid, name, email, profile_pic');
        $query = $this->db->get_where('users', array('userid' => $userid));

        return $query->row_array();
    }
}

