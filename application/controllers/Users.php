<?php

class Users extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
    }

    // List users
    public function index() {
        // Get users from the model
		// $data['users'] = $this->User_model->get_users_with_authors();
		$data['users'] = $this->User_model->get_users();

        // Sort users by their complete names alphabetically (A-Z)
        usort($data['users'], function($a, $b) {
            return strcmp($a['complete_name'], $b['complete_name']);
        });

        // Set the title
        $data['title'] = 'User Management';

        // Load views
        $this->load->view('template/admin/header');
        $this->load->view('users/index', $data);
        $this->load->view('template/admin/footer');
    }
    // View user details    
    public function view($userid) {
        // Get user data by user$userid
        $data['user'] = $this->User_model->get_user_by_id($userid);
        if (!$data['user']) {
            show_404(); // Return 404 error if the user is not found
        }
        
        // Set the title
        $data['title'] = 'User Profile';

        // Load views
        $this->load->view('users/view', $data);
    }

    
    public function add() {
			// Check if the form is submitted
			if ($this->input->post()) {
				// Retrieve form data
				$complete_name = $this->input->post('complete_name');          
				$email = $this->input->post('email');
				$pword = $this->input->post('password');
				$role = $this->input->post('role');
		
				// Check if a profile picture is uploaded
				if (!empty($_FILES['profile_pic']['name'])) {
					// Handle file upload for profile picture
					$config['upload_path'] = './assets/users/';
					$config['allowed_types'] = 'jpg|jpeg|png|gif';
					$config['max_size'] = 2048; // 2MB max size
					$config['file_name'] = uniqid(); // Set unique filename
		
					$this->load->library('upload', $config);
		
					if ($this->upload->do_upload('profile_pic')) {
						$data = $this->upload->data();
						$profile_pic = $data['file_name']; // Store the unique filename
					} else {
						// If file upload fails, set a default profile picture or handle the error accordingly
						$profile_pic = 'noimages.jpg'; // Set default profile picture
					}
				} else {
					// If no profile picture is uploaded, set a default profile picture
					$profile_pic = 'noimages.jpg'; // Set default profile picture
				}
		
				// Set status to 1 (active) by default
				$status = 1;
		
				// Prepare data to be inserted into the database
				$data = array(
					'complete_name' => $complete_name,
					'email' => $email,
					'pword' => $pword,
					'role' => $role,
					'profile_pic' => $profile_pic, // Assign the unique filename here
					'status' => $status // Set status to 1 (active) by default
					
				);
		
				// Insert the data into the database
				$inserted = $this->db->insert('users', $data);
		
				// Check if insertion was successful
				if ($inserted) {
					// Redirect to users page upon success
					redirect('users');
				} else {
					// Return error response
					$response = array('status' => 'error', 'message' => 'Failed to add user.');
					// Send JSON response
					echo json_encode($response);
					return;
				}
			}
		
			// Load the add users view
            
			$this->load->view('users/add');
		}
		public function delete($userid) {
			// Get the user ID from the POST data
			// $userid = $this->input->post('userid');
			
			$this->user_model->delete_user($userid);
			redirect('users');
		}

		public function edit($userid) {
			// Retrieve user data using user ID
			$data['user'] = $this->User_model->get_user_by_id($userid);
		
			// Initialize user data array
			$userData = [
				'complete_name' => $this->input->post('complete_name'),
				'email' => $this->input->post('email'),
				'role' => $this->input->post('role'),

				// 'pword' => $this->input->post('pword'),
				'profile_pic' => $data['user']['profile_pic'], // Default to existing profile_pic
			];
		
			// Handle form submission
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$contactNum = $this->input->post('contact_num');
		
				// Handle file upload
				$config['upload_path'] = 'assets/users/'; // Specify the directory where you want to save the images
				$config['allowed_types'] = 'jpg|jpeg|png|gif';
				$config['max_size'] = '2048';
				$config['file_name'] = uniqid(); // Use original file name
		
				$this->load->library('upload', $config);
		
				if ($this->upload->do_upload('profile_pic')) {
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
					if ($this->upload->do_upload('profile_pic')) {
						// Update the user data with the filename
						$userData['profile_pic'] = $filename;
					} else {
						// If there was an error during file upload, set a flash error message
						$this->session->set_flashdata('error', $this->upload->display_errors());
						redirect('users/edit/' . $userid);
						return;
					}
				}
		
				// Update user data in the database
				$userUpdateResult = $this->User_model->update_user($userid, $userData);
		
				// Update contact number in the authors table
				// $authorData = ['contact_num' => $contactNum];
				// // $authorUpdateResult = $this->Author_model->update_author($userid, $authorData);
		
				// // Handle success and failure cases
				// if ($userUpdateResult && $authorUpdateResult) {
				// 	$this->session->set_flashdata('success', 'User profile updated successfully.');
				// } else {
				// 	$this->session->set_flashdata('error', 'Failed to update user profile.');
				// }
		
				// Redirect to a relevant page
				redirect('users');
			}
		
			// Load the view with user data
			$this->load->view('users/edit', $data);
		}
		
		
}