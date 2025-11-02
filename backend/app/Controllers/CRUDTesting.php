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
}
