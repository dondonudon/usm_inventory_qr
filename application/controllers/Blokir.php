<?php
class Blokir extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->session->set_flashdata('title', 'Blokir | Inventory');
    }

    function index()
    {
        $this->load->view('auth/blokir_akses');
    }
}
