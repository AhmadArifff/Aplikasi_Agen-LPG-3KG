<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class BaseController extends Controller
{
    protected $helpers = ['form', 'url'];

    public function __construct()
    {
        // Common functionalities can be initialized here
    }

    protected function renderView($view, $data = [])
    {
        echo view('templates/header', $data);
        echo view($view, $data);
        echo view('templates/footer', $data);
    }
}