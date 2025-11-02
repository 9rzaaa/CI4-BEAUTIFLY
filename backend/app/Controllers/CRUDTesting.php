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
}
