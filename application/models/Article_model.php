<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article_model extends CI_Model {

    public function __construct(){
        $this->load->database();
    }

    // public function get_articles() {
    //     // Joining articles with authors based on the 'title' foreign key
    //     $this->db->select('articles.*, authors.author_name, volume.vol_name');
    //     $this->db->from('articles');
    //     $this->db->join('authors', 'articles.title = authors.title', 'left');
    //     $this->db->join('volume', 'articles.volumeid = volume.volumeid', 'left');

    //     // Perform the query
    //     $query = $this->db->get();

    //     // Return the result as an array
    //     return $query->result_array();
    // }
    public function get_articles($id = null) {
        if ($id === null) {
            $query = $this->db->get('articles');
            return $query->result_array();
        } else {
            $query = $this->db->get_where('articles', array('articleid' => $id));
            return $query->row_array();
        }
    }

    public function get_articles_public() {
        // Joining articles with authors based on the 'title' foreign key
        $this->db->select('articles.*, authors.author_name, volume.vol_name');
        $this->db->from('articles');
        $this->db->join('authors', 'articles.title = authors.title', 'left');
        $this->db->join('volume', 'articles.volumeid = volume.volumeid', 'left');
        // Add condition to check if the article is published
        $this->db->where('articles.published', 1);

        // Perform the query
        $query = $this->db->get();

        // Return the result as an array
        return $query->result_array();
    }

    
    public function add_article($data) {
        // Insert the data into the 'articles' table
        $inserted = $this->db->insert('articles', $data);
        
        // Return TRUE if insertion was successful, FALSE otherwise
        return $inserted;
    }

    public function get_article_by_id($articleid) {
        // Retrieve article data based on article ID
        return $this->db->get_where('articles', array('articleid' => $articleid))->row_array();
    }

    public function update_article($articleid, $data) {
        // Update article data in the database
        $this->db->where('articleid', $articleid);
        return $this->db->update('articles', $data);
    }

    public function delete_article($articleid) {
        // Check if the patient exists
        $this->db->where('articleid', $articleid);
        $query = $this->db->get('articles');

        if ($query->num_rows() > 0) {
            // Patient exists, delete it
            $this->db->where('articleid', $articleid);
            $this->db->delete('articles');
            return true;
        } else {
            // Patient not found
            return false;
        }
    }
   
  
}
