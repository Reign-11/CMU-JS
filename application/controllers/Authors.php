<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authors extends CI_Controller {

    public function index() {
        // Get users from the model
        $data['authors'] = $this->author_model->get_authors();
		
    
        // Sort users by their complete names alphabetically (A-Z)
        usort($data['authors'], function($a, $b) {
            return strcmp($a['author_name'], $b['author_name']);
        });
    
        // Set the title
        $data['title'] = 'Author Management';
    
        // Load views
        $this->load->view('template/admin/header');
        $this->load->view('authors/index', $data);
        $this->load->view('template/admin/footer');
    }

        // VIEW PROFILE
		public function view($auid) {
			// Retrieve userid from the URL
			$auid = $this->uri->segment(3); // Assuming it's the third segment in the URL

			// Load user data based on userid
			$data['author'] = $this->author_model->get_author_by_id($auid);
			$data['title'] = 'View Profile'; // Change the title as needed

			// Load views
			$this->load->view('authors/view', $data); // Fixed the parameter here
		}  

		// UPDATE
		public function edit($auid) {
			// Retrieve author data using author ID
			$data['author'] = $this->Author_model->get_author_by_id($auid);
			
			// Initialize author data array
			$authorData = [
				'author_name' => $this->input->post('author_name'),
                'title'=> $this->input->post('title'),
				'email' => $this->input->post('email'),
				'contact_num' => $this->input->post('contact_num'), // Update contact number
				'images' => $data['author']['images'], // Default to existing image
			];
			
			// Handle form submission
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				// Handle file upload
				$config['upload_path'] = 'assets/users/'; // Specify the directory where you want to save the images
				$config['allowed_types'] = 'jpg|jpeg|png|gif';
				$config['max_size'] = '2048';
				$config['file_name'] = uniqid(); // Use original file name
				
				$this->load->library('upload', $config);
				
				if ($this->upload->do_upload('images')) {
					// Get file data
					$fileData = $this->upload->data();
					$filename = $fileData['file_name'];
					$filePath = $config['upload_path'] . $filename;
					
					// Check if a file with the same filename exists
					if (file_exists($filePath)) {
						// Remove the existing file
						unlink($filePath);
					}
					
					// Move the uploaded file to the specified directory
					if ($this->upload->do_upload('images')) {
						// Update the author data with the filename
						$authorData['images'] = $filename;
					} else {
						// If there was an error during file upload, set a flash error message
						$this->session->set_flashdata('error', $this->upload->display_errors());
						redirect('authors/edit/' . $auid);
						return;
					}
				}
				
				// Update author data in the database
				$authorUpdateResult = $this->Author_model->update_author($auid, $authorData);
				
				// Handle success and failure cases
				if ($authorUpdateResult) {
					$this->session->set_flashdata('success', 'Author profile updated successfully.');
				} else {
					$this->session->set_flashdata('error', 'Failed to update author profile.');
				}
				
				// Redirect to a relevant page
				redirect('authors');
			}
			
			// Load the view with author data
			$this->load->view('authors/edit', $data);
		}
		

		// ADD
		public function add() {
			// Check if the form is submitted
			if ($this->input->post()) {
				// Retrieve form data
				$author_name = $this->input->post('author_name');
                $title = $this->input->post('title');
				$email = $this->input->post('email');
				$contact_num = $this->input->post('contact_num');
		
				// Check if a profile picture is uploaded
				if (!empty($_FILES['images']['name'])) {
					// Handle file upload for profile picture
					$config['upload_path'] = './assets/users/';
					$config['allowed_types'] = 'jpg|jpeg|png|gif';
					$config['max_size'] = 2048; // 2MB max size
					$config['file_name'] = uniqid(); // Set unique filename
		
					$this->load->library('upload', $config);
		
					if ($this->upload->do_upload('images')) {
						$data = $this->upload->data();
						$images = $data['file_name']; // Store the unique filename
					} else {
						// If file upload fails, set a default profile picture or handle the error accordingly
						$images = 'noimages.jpg'; // Set default profile picture
					}
				} else {
					// If no profile picture is uploaded, set a default profile picture
					$images = 'noimages.jpg'; // Set default profile picture
				}
		
				// Set status to 1 (active) by default
				$status = 1;
		
				// Prepare data to be inserted into the database
				$data = array(
					'author_name' => $author_name,
                    'title'=> $title,
					'email' => $email,
					'contact_num' => $contact_num,
					'images' => $images,
					
					// 'title' => $title
				);
		
				// Insert the data into the database
				$inserted = $this->db->insert('authors', $data);
		
				// Check if insertion was successful
				if ($inserted) {
					// Redirect to users page upon success
					redirect('authors');
				} else {
					// Return error response
					$response = array('status' => 'error', 'message' => 'Failed to add user.');
					// Send JSON response
					echo json_encode($response);
					return;
				}
			}
		
			// Load the add users view
			$this->load->view('authors/add');
		}
		
		// DELETE
		public function delete($auid) {
			
			$this->author_model->delete_author($auid);
			redirect('authors');
		}	
}