<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function index() {
        $data['articles'] = $this->article_model->get_articles();

        // $this->load->view('template/admin/header');
        $this->load->view('home/index', $data);
        $this->load->view('template/admin/footer');
    }
}
