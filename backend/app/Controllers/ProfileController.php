<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class ProfileController extends BaseController
{
    /**
     * Display user profile page
     */
    public function index()
    {
        $session = session();
        $userSession = $session->get('user');
        
        if (!$userSession || empty($userSession['id'])) {
            return redirect()->to('/login')->with('error', 'Please login to view your profile');
        }

        // Get fresh user data from database
        $userModel = new UsersModel();
        $user = $userModel->find($userSession['id']);

        if (!$user) {
            return redirect()->to('/login')->with('error', 'User not found');
        }

        // Convert to array if it's an object
        $userArr = is_array($user) ? $user : (method_exists($user, 'toArray') ? $user->toArray() : (array) $user);

        $data = [
            'title' => 'My Profile',
            'user' => $userArr
        ];

        return view('user/myprofile', $data);
    }

    /**
     * Update user profile
     */
    public function update()
    {
        $session = session();
        $request = service('request');
        $validation = \Config\Services::validation();
        
        $userSession = $session->get('user');
        
        if (!$userSession || empty($userSession['id'])) {
            return redirect()->to('/login')->with('error', 'Please login to update your profile');
        }

        $userId = $userSession['id'];
        $userModel = new UsersModel();
        $user = $userModel->find($userId);

        if (!$user) {
            return redirect()->to('/login')->with('error', 'User not found');
        }

        // Convert to array
        $userArr = is_array($user) ? $user : (method_exists($user, 'toArray') ? $user->toArray() : (array) $user);

        // Get form data
        $post = $request->getPost();

        // Validation rules
        $validation->setRule('first_name', 'First Name', 'required|alpha_space|min_length[2]|max_length[50]');
        $validation->setRule('last_name', 'Last Name', 'required|alpha_space|min_length[2]|max_length[50]');
        $validation->setRule('middle_name', 'Middle Name', 'permit_empty|alpha_space|max_length[50]');

        if (!$validation->run($post)) {
            $session->setFlashdata('error', implode(' ', $validation->getErrors()));
            return redirect()->back()->withInput();
        }

        // Prepare update data
        $updateData = [
            'first_name' => $post['first_name'],
            'middle_name' => $post['middle_name'] ?? null,
            'last_name' => $post['last_name'],
        ];

        // Handle password change if requested
        $oldPassword = $request->getPost('old_password');
        $newPassword = $request->getPost('new_password');
        $confirmPassword = $request->getPost('confirm_password');

        if (!empty($oldPassword) || !empty($newPassword) || !empty($confirmPassword)) {
            // Validate all password fields are filled
            if (empty($oldPassword) || empty($newPassword) || empty($confirmPassword)) {
                $session->setFlashdata('error', 'Please fill all password fields to change your password');
                return redirect()->back()->withInput();
            }

            // Verify old password
            if (!password_verify($oldPassword, $userArr['password_hash'] ?? '')) {
                $session->setFlashdata('error', 'Current password is incorrect');
                return redirect()->back()->withInput();
            }

            // Check if new passwords match
            if ($newPassword !== $confirmPassword) {
                $session->setFlashdata('error', 'New passwords do not match');
                return redirect()->back()->withInput();
            }

            // Validate new password strength
            if (strlen($newPassword) < 6) {
                $session->setFlashdata('error', 'New password must be at least 6 characters long');
                return redirect()->back()->withInput();
            }

            // Add password to update data
            $updateData['password_hash'] = password_hash($newPassword, PASSWORD_DEFAULT);
        }

        // Update user in database
        try {
            $updated = $userModel->update($userId, $updateData);

            if (!$updated) {
                $session->setFlashdata('error', 'Failed to update profile. Please try again.');
                return redirect()->back()->withInput();
            }

            // Update session data with new info
            $displayName = trim(
                ($updateData['first_name'][0] ?? '') . ' ' . 
                ($updateData['middle_name'][0] ?? '') . ' ' . 
                ($updateData['last_name'] ?? '')
            );

            $session->set('user', [
                'id' => $userSession['id'],
                'email' => $userSession['email'],
                'first_name' => $updateData['first_name'],
                'last_name' => $updateData['last_name'],
                'type' => $userSession['type'],
                'display_name' => $displayName,
            ]);

            $session->setFlashdata('success', 'Profile updated successfully! 🌿');
            return redirect()->to('/profile');

        } catch (\Exception $e) {
            log_message('error', 'Profile update failed: ' . $e->getMessage());
            $session->setFlashdata('error', 'Failed to update profile. Please try again.');
            return redirect()->back()->withInput();
        }
    }
}