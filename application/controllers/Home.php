<?php
class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->session->set_flashdata('title', 'Home | Inventory');
    }

    public function index()
    {
        $this->load->view('home/home');
    }
}
