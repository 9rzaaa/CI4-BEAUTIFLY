<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UsersModel;


class CRUDTesting extends BaseController
{
    public function showUsersPage()
    {
        $listOfUser = []; // default empty

        try {
            // Fetch data structure from model
            $model = new UsersModel();

            // Fetch only active and available users, order by ID ascending
            $listOfUser = $model
                ->where('account_status', 1)
                ->orderBy('id', 'ASC')
                ->findAll();
        } catch (\Exception $e) {
            // Feed back in case of DB issue
            $listOfUser = "There is issue in DB: " . $e->getMessage();
        }

        // Send to view
        return view('test/user', ['listOfUser' => $listOfUser]);
    }

    // NEW — show create form
    public function index()
    {
        return view('test/user_create');
    }

    // NEW — show update page
    public function showUpdateForm($id = null)
    {
        helper('form'); // this is needed for old() in the view

        // Check if ID is provided
        if (!$id) {
            $user = "Missing requirements: ID";
            return view('test/user_update', ['user' => $user]);
        }

        // Access the database
        $userModel = new UsersModel();

        // Find the data with error handling
        try {
            $user = $userModel->find($id);

            // Check if user exists
            if (!$user) {
                $user = "User not found with ID: " . $id;
            }
        } catch (\Exception $e) {
            $user = "Server Issue: " . $e->getMessage();
        }

        // Show the page
        return view('test/user_update', ['user' => $user]);
    }

    // NEW — process insert
    public function create()
    {
        $validation = \Config\Services::validation();

        // Validation Rules
        $validation->setRule('first_name', 'First Name', 'required|alpha_space|min_length[2]');
        $validation->setRule('last_name', 'Last Name', 'required|alpha_space|min_length[2]');
        $validation->setRule('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $validation->setRule('password', 'Password', 'required|min_length[6]');
        $validation->setRule('confirm_password', 'Confirm Password', 'required|matches[password]');

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()
                ->back()
                ->withInput() // <-- this brings back set_value()
                ->with('errors', $validation->getErrors());
        }

        // If validation passes — insert user
        $model = new UsersModel();

        $data = [
            'first_name'    => $this->request->getPost('first_name'),
            'middle_name'   => $this->request->getPost('middle_name'),
            'last_name'     => $this->request->getPost('last_name'),
            'email'         => $this->request->getPost('email'),
            'password_hash' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'account_status' => 1,
        ];

        $model->insert($data);

        session()->setFlashdata('success', 'User has been created successfully!');
        return redirect()->to(site_url('test/user'));
    }

    public function processUpdate($id = null)
    {
        // Add session
        $session = session();

        // Check if ID is provided
        if (!$id) {
            $session->setFlashdata('errors', ['ID is required']);
            return redirect()->to(site_url('test/user'));
        }

        // Get POST data
        $post = $this->request->getPost();

        // Use the model
        $userModel = new UsersModel();

        try {
            // Check if the account exists
            $account = $userModel->find($id);

            if (!$account) {
                $session->setFlashdata('errors', ['Account not found']);
                return redirect()->to(site_url('test/user'));
            }

            // Simple validation
            if (empty($post['first_name']) || empty($post['last_name']) || empty($post['email'])) {
                $session->setFlashdata('errors', ['First name, last name, and email are required']);
                return redirect()->to(site_url('test/user'));
            }

            // Validate email format
            if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
                $session->setFlashdata('errors', ['Invalid email format']);
                return redirect()->to(site_url('test/user'));
            }

            // If password is provided, validate it
            if (!empty($post['password'])) {
                if (strlen($post['password']) < 8) {
                    $session->setFlashdata('errors', ['Password must be at least 8 characters']);
                    return redirect()->to(site_url('test/user'));
                }
                if ($post['password'] !== $post['confirm_password']) {
                    $session->setFlashdata('errors', ['Passwords do not match']);
                    return redirect()->to(site_url('test/user'));
                }
            }

            // Prepare data to be updated
            $data = [
                'first_name' => $post['first_name'],
                'middle_name' => $post['middle_name'] ?? null,
                'last_name' => $post['last_name'],
                'email' => $post['email'],
            ];

            // Only add password if it's provided
            if (!empty($post['password'])) {
                $data['password_hash'] = password_hash($post['password'], PASSWORD_DEFAULT);
            }

            // Update using Query Builder directly
            $db = \Config\Database::connect();
            $builder = $db->table('users');
            $builder->where('id', $id);
            $result = $builder->update($data);

            // Check if update was successful
            if ($result && $db->affectedRows() > 0) {
                $session->setFlashdata('success', 'User updated successfully!');
            } else {
                $session->setFlashdata('success', 'No changes were made.');
            }

            return redirect()->to(site_url('test/user'));
        } catch (\Throwable $e) {
            $session->setFlashdata('errors', ['Server error: ' . $e->getMessage()]);
            return redirect()->to(site_url('test/user'));
        }
    }
}
