<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BookingModel;
use App\Models\UsersModel;
use CodeIgniter\HTTP\ResponseInterface;

class AdminController extends BaseController
{
    protected $bookingModel;
    protected $usersModel;

    public function __construct()
    {
        $this->bookingModel = new BookingModel();
        $this->usersModel = new UsersModel();

        // Check if user is admin
        $session = session();
        $user = $session->get('user');

        if (!$user || strtolower($user['type'] ?? '') !== 'admin') {
            $session->set('redirect_url', current_url());
            return redirect()->to('/login')->with('error', 'Please login as admin to access this page.')->send();
            exit;
        }
    }

    public function dashboard()
    {
        $data = [
            'title' => 'Admin Dashboard',
            'stats' => $this->getDashboardStats()
        ];

        return view('admin/dashboard', $data);
    }

    private function getDashboardStats()
    {
        // 1. ALL EARNINGS - Total from completed bookings
        $earningsQuery = $this->bookingModel->builder();
        $earningsQuery->selectSum('total_price');
        $earningsQuery->where('status', 'completed');
        $totalEarnings = $earningsQuery->get()->getRowArray()['total_price'] ?? 0;

        // Calculate last month's earnings for comparison
        $lastMonthEarnings = $this->bookingModel->builder();
        $lastMonthEarnings->selectSum('total_price');
        $lastMonthEarnings->where('status', 'completed');
        $lastMonthEarnings->where('MONTH(created_at)', date('m', strtotime('-1 month')));
        $lastMonthEarnings->where('YEAR(created_at)', date('Y', strtotime('-1 month')));
        $lastMonthEarningsValue = $lastMonthEarnings->get()->getRowArray()['total_price'] ?? 0;

        // Calculate earnings growth percentage
        $earningsGrowth = 0;
        if ($lastMonthEarningsValue > 0) {
            $currentMonthEarnings = $this->bookingModel->builder();
            $currentMonthEarnings->selectSum('total_price');
            $currentMonthEarnings->where('status', 'completed');
            $currentMonthEarnings->where('MONTH(created_at)', date('m'));
            $currentMonthEarnings->where('YEAR(created_at)', date('Y'));
            $currentMonthEarningsValue = $currentMonthEarnings->get()->getRowArray()['total_price'] ?? 0;

            $earningsGrowth = (($currentMonthEarningsValue - $lastMonthEarningsValue) / $lastMonthEarningsValue) * 100;
        }

        // 2. ACTIVE BOOKINGS - Confirmed bookings
        $activeBookings = $this->bookingModel->builder();
        $activeBookings->where('status', 'confirmed');
        $activeBookingsCount = $activeBookings->countAllResults();

        // Calculate total bookings for performance percentage
        $totalBookings = $this->bookingModel->countAllResults();
        $bookingPerformance = $totalBookings > 0 ? round(($activeBookingsCount / $totalBookings) * 100) : 0;

        // 3. TOTAL USERS - All registered users
        $totalUsers = $this->usersModel->countAllResults();

        // Calculate new users this month
        $newUsersThisMonth = $this->usersModel->builder();
        $newUsersThisMonth->where('MONTH(created_at)', date('m'));
        $newUsersThisMonth->where('YEAR(created_at)', date('Y'));
        $newUsersCount = $newUsersThisMonth->countAllResults();

        // 4. MONTHLY GROWTH - Booking growth percentage
        $currentMonthBookings = $this->bookingModel->builder();
        $currentMonthBookings->where('MONTH(created_at)', date('m'));
        $currentMonthBookings->where('YEAR(created_at)', date('Y'));
        $currentMonthBookingsCount = $currentMonthBookings->countAllResults();

        $lastMonthBookings = $this->bookingModel->builder();
        $lastMonthBookings->where('MONTH(created_at)', date('m', strtotime('-1 month')));
        $lastMonthBookings->where('YEAR(created_at)', date('Y', strtotime('-1 month')));
        $lastMonthBookingsCount = $lastMonthBookings->countAllResults();

        $monthlyGrowth = 0;
        if ($lastMonthBookingsCount > 0) {
            $monthlyGrowth = (($currentMonthBookingsCount - $lastMonthBookingsCount) / $lastMonthBookingsCount) * 100;
        }

        return [
            [
                'title' => 'All Earnings',
                'value' => '₱' . number_format($totalEarnings, 2),
                'icon' => '💰',
                'subtitle' => round($earningsGrowth, 1) . '% ' . ($earningsGrowth >= 0 ? 'increase' : 'decrease') . ' from last month',
                'trend' => $earningsGrowth >= 0 ? 'up' : 'down'
            ],
            [
                'title' => 'Active Bookings',
                'value' => $activeBookingsCount,
                'icon' => '📅',
                'subtitle' => $bookingPerformance . '% of total bookings',
                'trend' => 'neutral'
            ],
            [
                'title' => 'Total Users',
                'value' => number_format($totalUsers),
                'icon' => '👤',
                'subtitle' => $newUsersCount . ' new ' . ($newUsersCount == 1 ? 'registration' : 'registrations') . ' this month',
                'trend' => 'neutral'
            ],
            [
                'title' => 'Monthly Growth',
                'value' => round(abs($monthlyGrowth), 1) . '%',
                'icon' => '📈',
                'subtitle' => abs($currentMonthBookingsCount - $lastMonthBookingsCount) . ' booking ' . ($monthlyGrowth >= 0 ? 'increase' : 'decrease') . ' this month',
                'trend' => $monthlyGrowth >= 0 ? 'up' : 'down'
            ]
        ];
    }
}
