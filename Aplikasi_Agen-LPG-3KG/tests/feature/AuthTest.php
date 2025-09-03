<?php

namespace Tests\Feature;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestCase;

class AuthTest extends FeatureTestCase
{
    public function testLoginPageIsAccessible()
    {
        $this->get('/auth/login')
             ->assertStatus(200)
             ->assertSee('Login');
    }

    public function testRegistrationPageIsAccessible()
    {
        $this->get('/auth/register')
             ->assertStatus(200)
             ->assertSee('Register');
    }

    public function testUserCanRegister()
    {
        $this->post('/auth/register', [
            'u_username' => 'testuser',
            'u_password' => 'password123',
            'u_fullname' => 'Test User',
            'u_email'    => 'testuser@example.com',
        ])
        ->assertStatus(302)
        ->assertRedirect('/auth/login');

        $this->seeInDatabase('tb_user', [
            'u_username' => 'testuser',
            'u_email'    => 'testuser@example.com',
        ]);
    }

    public function testUserCanLogin()
    {
        // First, register the user
        $this->post('/auth/register', [
            'u_username' => 'testuser',
            'u_password' => 'password123',
            'u_fullname' => 'Test User',
            'u_email'    => 'testuser@example.com',
        ]);

        // Now, attempt to log in
        $this->post('/auth/login', [
            'u_username' => 'testuser',
            'u_password' => 'password123',
        ])
        ->assertStatus(302)
        ->assertRedirect('/distribution/index');
    }

    public function testUserCannotLoginWithInvalidCredentials()
    {
        $this->post('/auth/login', [
            'u_username' => 'invaliduser',
            'u_password' => 'wrongpassword',
        ])
        ->assertStatus(302)
        ->assertRedirect('/auth/login')
        ->assertSessionHas('error', 'Invalid login credentials');
    }
}