<?php

namespace App\Controllers;

use App\Models\UsersModels;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    protected $usersModel;

    public function __construct()
    {
        $this->usersModel = new UsersModels();
    }

    public function login()
    {
        if ($this->request->getMethod() === 'post') {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $user = $this->usersModel->where('u_username', $username)->first();

            if ($user && password_verify($password, $user['u_password'])) {
                // Set session data
                $this->session->set('loggedIn', true);
                $this->session->set('userId', $user['u_id']);
                $this->session->set('userRole', $user['u_role']);

                return redirect()->to('/distribution');
            } else {
                return redirect()->back()->with('error', 'Invalid username or password');
            }
        }

        return view('auth/login');
    }

    public function register()
    {
        if ($this->request->getMethod() === 'post') {
            $data = [
                'u_username' => $this->request->getPost('username'),
                'u_password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'u_fullname' => $this->request->getPost('fullname'),
                'u_email' => $this->request->getPost('email'),
                'u_role' => 'agent', // Default role
                'u_create_at' => date('Y-m-d H:i:s')
            ];

            $this->usersModel->insert($data);
            return redirect()->to('/auth/login')->with('success', 'Registration successful, please login.');
        }

        return view('auth/register');
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/auth/login');
    }
}