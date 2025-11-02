<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UsersModel;


class CRUDTesting extends BaseController
{
    public function showUsersPage()
    {
        $userModel = new UsersModel();

        try {
            $pageItems = $userModel->findAll(); // Fetch all users

            if (!$pageItems) {
                $pageItems = "No users found in the database";
            }
        } catch (\Exception $e) {
            $pageItems = "Database connection error: " . $e->getMessage();
        }

        return view('test/user', [
            'pageItems' => $pageItems
        ]);
    }
}
