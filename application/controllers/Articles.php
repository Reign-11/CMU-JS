<?php

class Articles extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("Article_model");
    }

    public function index(){
        $data['title'] = 'Latest Article';
        $data['articles'] = $this->Article_model-> get_articles();

        $this->load->view('template/admin/header', $data);
        $this->load->view('articles/index', $data);
        $this->load->view('template/admin/footer', $data);
    }
    
    public function add() {
        // Check if the form is submitted
        if ($this->input->post()) {
            // Retrieve form data
            $title = $this->input->post('title');
            $keywords = $this->input->post('keywords');
            $abstract = $this->input->post('abstract');
            // $published = $this->input->post('published');
            $doi = $this->input->post('doi');
            $volumeid = $this->input->post('volumeid');
    
            // Check if a file is uploaded
            if ($_FILES['filename']['name']) {
                // File upload configuration
                $config['upload_path'] = './assets/users/';
                $config['allowed_types'] = 'pdf';
                // $config['max_size'] = 2048;
                $filename = uniqid(); // Generate unique identifier for filename
                $config['file_name'] = $filename . '.pdf'; // Add .pdf extension
                $this->load->library('upload', $config);
    
                // Try to upload the file
                if ($this->upload->do_upload('filename')) {
                    // File uploaded successfully
                    // Retrieve file data
                    $file_data = $this->upload->data();
                } else {
                    // File upload failed, return error response
                    $response = array('status' => 'error', 'message' => $this->upload->display_errors());
                    echo json_encode($response);
                    return;
                }
            } else {
                // No file uploaded, handle accordingly
                // $filename = 'nobook.jpg';
            }
            $published = 0;
            // Prepare data to be inserted into the database
            $data = array(
                'title' => $title,
                'keywords' => $keywords,
                'abstract' => $abstract,
                'published' => $published,
                'filename' => $filename . '.pdf', // Use the same unique identifier for filename with .pdf extension
                'doi' => $doi,
                'volumeid' => $volumeid
            );
    
            // Insert the data into the database
            $inserted = $this->Article_model->add_article($data);
    
            // Check if insertion was successful
            if ($inserted) {
                // Set success message
                $this->session->set_flashdata('success_message', 'Article added successfully');
            } else {
                // Set error message
                $this->session->set_flashdata('error_message', 'Failed to add article');
            }
    
            // Redirect to articles page
            redirect('articles');
            return;
        }
    
        // Load the add article view
        $this->load->view('articles/add');
    }
    public function download($filename) {
		$file_path = FCPATH . './assets/users/' . $filename;
	
		// Check if file exists
		if (file_exists($file_path)) {
			// Load the download helper
			$this->load->helper('download');
	
			// Set the file MIME type
			$mime = mime_content_type($file_path);
	
			// Generate the server response for the file download
			force_download($filename, file_get_contents($file_path), $mime);
		} else {
			// File not found, handle the error
			echo "File not found!";
		}
	}  public function delete($articleid) {
       
        $this->Article_model->delete_article($articleid);
        redirect('articles');
    }
    public function edit($articleid) {
        // Retrieve article data using article ID
        $data['article'] = $this->Article_model->get_article_by_id($articleid);
    
        // Initialize article data array
        $articleData = [
            'title' => $this->input->post('title'),
            'keywords' => $this->input->post('keywords'),
            'abstract' => $this->input->post('abstract'),           
            // 'published' => $this->input->post('published'),
            'doi' => $this->input->post('doi'),
            'volumeid' => $this->input->post('volumeid'),
            'filename' => $data['article']['filename'] // Default to existing filename
        ];
    
        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Check if a file is uploaded
            if ($_FILES['filename']['name']) {
                // File upload configuration
                $config['upload_path'] = './assets/users/';
                $config['allowed_types'] = 'pdf';
                // $config['max_size'] = 2048;
                $filename = uniqid(); // Generate unique identifier for filename
                $config['file_name'] = $filename . '.pdf'; // Add .pdf extension
                $this->load->library('upload', $config);
    
                // Try to upload the file
                if ($this->upload->do_upload('filename')) {
                    // File uploaded successfully
                    // Retrieve file data
                    $file_data = $this->upload->data();
                    // Update the article data with the new filename
                    $articleData['filename'] = $filename . '.pdf';
                } else {
                    // File upload failed, set a flash error message
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('articles/edit/' . $articleid);
                    return;
                }
            }
            
            // Update article data in the database
            $articleUpdateResult = $this->Article_model->update_article($articleid, $articleData);
    
            // Handle success and failure cases
            if ($articleUpdateResult) {
                $this->session->set_flashdata('success', 'Article updated successfully.');
            } else {
                $this->session->set_flashdata('error', 'Failed to update article.');
            }
    
            // Redirect to a relevant page
            redirect('articles');
        }
    
        // Load the view with article data
        $this->load->view('articles/edit', $data);
    }


    public function toggle_archive($articleid) {
        $article = $this->Article_model->get_articles($articleid);
        $new_status = $article['archive'] ? 0 : 1;
        $this->Article_model->update_article($articleid, ['archive' => $new_status]);
        redirect('articles');
    }

    public function toggle_publish($articleid) {
        $article = $this->Article_model->get_articles($articleid);
        $new_status = $article['published'] ? 0 : 1;
        $this->Article_model->update_article($articleid, ['published' => $new_status]);
        redirect('articles');
    }
    
   
    public function add_volume() {
        $data['volumes'] = $this->volume_model->get_volumes();
        $this->load->view('articles/add', $data);
    }

}