<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
    public function index()
    {
        //$this->load->view('table');
        $this->template->load('template', 'welcome');
    }

    public function form()
    {
        //$this->load->view('table');
        $this->template->load('template', 'form');
    }
}
