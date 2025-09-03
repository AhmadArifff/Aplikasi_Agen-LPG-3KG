<?php

// Load the CodeIgniter framework
require_once '../vendor/autoload.php';

// Create a new instance of the application
$application = \Config\Services::application();

// Run the application
$application->run();