<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Routes extends BaseConfig
{
    // The default controller to be loaded
    public $defaultController = 'AuthController';
    public $defaultMethod     = 'index';

    // Define the routes for the application
    public function initRoutes()
    {
        // Authentication routes
        $this->get('/', 'AuthController::index');
        $this->get('/login', 'AuthController::login');
        $this->post('/login', 'AuthController::authenticate');
        $this->get('/register', 'AuthController::register');
        $this->post('/register', 'AuthController::create');

        // Distribution routes
        $this->get('/distribution', 'DistributionController::index');
        $this->get('/distribution/plan', 'DistributionController::plan');
        $this->post('/distribution/submit', 'DistributionController::submitPlan');

        // Payment routes
        $this->get('/payment', 'PaymentController::index');
        $this->post('/payment/transaction', 'PaymentController::processTransaction');
        $this->get('/payment/history', 'PaymentController::history');

        // Logout route
        $this->get('/logout', 'AuthController::logout');
    }
}