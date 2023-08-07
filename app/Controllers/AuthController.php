<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;
error_reporting(E_ALL);
ini_set('display_errors', 1);
class AuthController extends Controller
{
    private $validation;
    public function __construct()
    {
        // Load the CodeIgniter validation library
        $this->validation = \Config\Services::validation();

        // Set the validation rules for the login form
        $rules = [
            'username' => 'required|min_length[5]|max_length[50]',
            'password' => 'required|min_length[3]'
            // Add more rules as needed
        ];
        
        $this->validation->setRules($rules);
        
    }

    public function login()
    {
        // Handle the form submission
        if ($this->request->getMethod() === 'post') {
            // Run the validation
            if ($this->validation->withRequest($this->request)->run()) {
                // Validation passed, continue with login process
                // You can access form data using $this->request->getPost('input_name')

                // Example: Get the username and password
                $username = $this->request->getPost('username');
                $password = $this->request->getPost('password');
                 // Load the database and the model (assuming you have created a UserModel)
                 $db = service('db');
                 $userModel = new \App\Models\UserModel();
 
                 // Find the user by username in the database
                 $user = $userModel->where('username', $username)->first();
                 // Check if the user exists and the password is correct
                 if ($user && password_verify($password, $user['password'])) {
                     // Successful login, set a session variable to indicate the user is logged in
                     session()->set('user_id', $user['id']);
 
                     // Redirect to a dashboard or home page after login
                     return redirect()->to('/dashboard_page');
                 } else {
                     // Invalid credentials, show an error message
                     $this->validation->setError('password', 'Invalid username or password.');
                 }
            } else{
                return 'error';
            }
            
        }

        // If it's not a POST request or validation failed, show the login form
        // Validation failed, store the validation object in the session
        session()->setFlashdata('errors', $this->validation->getErrors());
        return view('login_view');
    }
    public function register()
    {
        // Load the CodeIgniter validation library
        $validation = \Config\Services::validation();
        $session = \Config\Services::session();

        // Retrieve user inputs
        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $full_name = $this->request->getPost('full_name');
        $date_of_birth = $this->request->getPost('date_of_birth');

        // Example validation rules (you can customize these based on your requirements)
        $validationRules = [
            'username' => 'required|min_length[4]|max_length[20]',
            'email' => 'required|valid_email',
            'password' => 'required|min_length[8]',
            'full_name' => 'required',
            'date_of_birth' => 'required|valid_date', // You can create a custom validation rule for date_of_birth
        ];

        if (!$validation->run($this->request->getPost(), null)) {
            // If validation fails, handle the errors (e.g., display the form with errors)
            // If validation fails, store the errors in the session flashdata
            $errors = $this->validator->getErrors();
            session()->setFlashdata('errors', $errors);
            return view('register_user');
        } else {
            // Validation passed, proceed with registration logic

            // Create an instance of the UserModel
            $userModel = new \App\Models\UserModel();

            // Hash the password before storing it (optional but recommended for security)
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Prepare the user data array to be inserted into the database
            $userData = [
                'username' => $username,
                'email' => $email,
                'password' => $hashedPassword,
                'full_name' => $full_name,
                'date_of_birth' => $date_of_birth,
            ];

            // Insert the user data into the database
            $userModel->insert($userData);

            // Set a flash message to notify successful registration
            $session->setFlashdata('success_message', 'Registration successful!');

            // Redirect to a success page or any other relevant page
            return redirect()->to('success_page');
        }
    }
}

