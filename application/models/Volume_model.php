<?php
    class Volume_model extends CI_Model{

         public function __construct(){
            $this->load->database();
    }

    public function get_volumess() {
        $this->db->select('*');
        $this->db->from('volume');
        $this->db->where('status', 1); // Filter volumes with status 1
        $this->db->order_by('vol_name', 'ASC'); // Order volumes by name in ascending order

        $query = $this->db->get();
        $volumes = $query->result_array();

        // Fetch articles for each volume
        foreach ($volumes as &$volume) {
            $volume['articles'] = $this->get_articles_by_volume_id($volume['volumeid']);
        }

        return $volumes;
    }
    public function get_articles_by_volume_id($id) {
        $this->db->select('authors.*, articles.*');
        $this->db->from('article_author');
        $this->db->join('articles', 'article_author.articleid = articles.articleid', 'inner');
        $this->db->join('authors', 'article_author.auid = authors.auid', 'inner');
        $this->db->where('articles.volumeid', $id);
        $this->db->order_by('articles.date_published', 'DESC');

        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_volumes() {
        $query = $this->db->get('volume');
        return $query->result_array();
    }
    public function add_volume($data) {
        $inserted = $this->db->insert('volume', $data);
        return $inserted;
    }

    public function get_volume_by_id($volumeid) {
        return $this->db->get_where('volume', array('volumeid' => $volumeid))->row_array();
    }

    public function update_volume($volumeid, $data) {
        $this->db->where('volumeid', $volumeid);
        return $this->db->update('volume', $data);
    }

    public function delete_volume($volumeid) {
        $this->db->where('volumeid', $volumeid);
        $query = $this->db->get('volume');

        if ($query->num_rows() > 0) {
            $this->db->where('volumeid', $volumeid);
            $this->db->delete('volume');
            return true;
        } else {
            return false;
        }
    }
    public function get_volume_with_image($volumeid) {
        // Adjust 'profile_pic' based on your actual column name for the image
        $this->db->select('volumeid, profile_pic, vol_name, description');
        $query = $this->db->get_where('volumes', array('volumeid' => $volumeid));

        return $query->row_array();
    }
    public function add($data) {
        return $this->db->insert('volumes', $data);
    }

}
