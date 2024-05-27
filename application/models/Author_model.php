<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Author_model extends CI_Model {

    public function __construct(){
        $this->load->model('User_model');
        $this->load->model('Author_model');
        $this->load->database();
    }

    public function get_authors() {
        $query = $this->db->get('authors');
        return $query->result_array();
    }


    public function get_author_by_id($auid) {
        $query = $this->db->get_where('authors', array('auid' => $auid));
        return $query->row_array();
    }

    public function get_authors_by_article_id($article_id) {
        $this->db->select('authors.author_name');
        $this->db->from('article_author');
        $this->db->join('authors', 'authors.auid = article_author.auid');
        $this->db->where('article_author.articleid', $article_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function register($enc_password){
        // User data array
        $data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'password' => $enc_password,
        );

        // Insert user
        return $this->db->insert('authors', $data);
    }
    public function update_author($auid, $data) {
        $this->db->where('auid', $auid);
        return $this->db->update('authors', $data);
    }

    public function login($email, $password){
        // Validate
        $this->db->where('email', $email);
        $this->db->where('password', $password);

        $result = $this->db->get('authors');

        if($result->num_rows() == 1){
            return $result->row(0)->id;
        } else {
            return false;
        }
    }
    public function delete_author($auid) {
       
        $this->db->where('auid', $auid);
        $this->db->delete('authors');

        // Check if the deletion was successful
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    // New method to get user data with profile picture
    public function get_authors_with_image($auid) {
        // Adjust 'profile_pic' based on your actual column name for the image
        $this->db->select('auid, author_name, images, email, contact_num, title');
        $query = $this->db->get_where('authors', array('auid' => $auid));

        return $query->row_array();
    }
}