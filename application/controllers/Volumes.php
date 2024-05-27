<?php

class Volumes extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Volume_model');
    }

    public function index(){
        $data['title'] = 'Volume Lists';

        $data['volumes'] = $this->volume_model->get_volumes();
        // print_r($data['volumes']);

        $this->load->view('template/admin/header');
        $this->load->view('volumes/index', $data);
        $this->load->view('template/admin/footer');
    }

    public function edit($volumeid) {
        // Retrieve user data using user ID
        $data['volume'] = $this->Volume_model->get_volume_by_id($volumeid);
    
        // Initialize user data array
        $volumeData = [
            'vol_name' => $this->input->post('vol_name'),
            'description' => $this->input->post('description'),
            // 'pword' => $this->input->post('pword'),
            'profile_pic' => $data['volume']['profile_pic'], // Default to existing profile_pic
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
                    $volumeData['profile_pic'] = $filename;
                } else {
                    // If there was an error during file upload, set a flash error message
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('volumes/edit/' . $volumeid);
                    return;
                }
            }
    
            // Update user data in the database
            $userUpdateResult = $this->Volume_model->update_volume($volumeid, $volumeData);
    
            // Update contact number in the authors table
            // $authorData = ['contact_num' => $contactNum];
            // // $authorUpdateResult = $this->Author_model->update_author($volumeid, $authorData);
    
            // // Handle success and failure cases
            // if ($userUpdateResult && $authorUpdateResult) {
            // 	$this->session->set_flashdata('success', 'User profile updated successfully.');
            // } else {
            // 	$this->session->set_flashdata('error', 'Failed to update user profile.');
            // }
    
            // Redirect to a relevant page
            redirect('volumes');
        }
    
        // Load the view with user data
        $this->load->view('volumes/edit', $data);
    }
    public function add() {
        // Check if the form is submitted
        if ($this->input->post()) {
            // Retrieve form data
            $vol_name = $this->input->post('vol_name');          
            $description = $this->input->post('description');
    
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
                'vol_name' => $vol_name,
                'description' => $description,
                'profile_pic' => $profile_pic, // Assign the unique filename here
            );
    
            // Insert the data into the database
            $inserted = $this->db->insert('volume', $data);
    
            // Check if insertion was successful
            if ($inserted) {
                // Redirect to users page upon success
                redirect('volumes');
            } else {
                // Return error response
                $response = array('status' => 'error', 'message' => 'Failed to add user.');
                // Send JSON response
                echo json_encode($response);
                return;
            }
        }
    
        // Load the add users view
        
        $this->load->view('volumes/add');
    }
    public function delete($volumeid) {
   
        $this->Volume_model->delete_volume($volumeid);
        redirect('volumes');
    }
    public function view($volumeid) {
        // Get user data by user$volumeid
        $data['volume'] = $this->Volume_model->get_volume_by_id($volumeid);
        if (!$data['volume']) {
            show_404(); // Return 404 error if the user is not found
        }
        
        // Set the title
        $data['title'] = 'Volume Profile';

        // Load views
        $this->load->view('volumes/view', $data);
    }
}