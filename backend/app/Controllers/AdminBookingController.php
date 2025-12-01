<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BookingModel;
use CodeIgniter\HTTP\ResponseInterface;

class AdminBookingController extends BaseController
{
    protected $bookingModel;

    public function __construct()
    {
        $this->bookingModel = new BookingModel();

        // Check if user is admin
        $session = session();
        $user = $session->get('user');

        if (!$user || strtolower($user['type'] ?? '') !== 'admin') {
            $session->set('redirect_url', current_url());
            return redirect()->to('/login')->with('error', 'Please login as admin to access this page.')->send();
            exit;
        }
    }

    // Display bookings management page
    public function index()
    {
        $data = [
            'title' => 'Booking Management'
        ];

        return view('admin/unitbookings', $data);
    }

    // Get bookings list with filters and pagination
    public function list()
    {
        $page = (int)$this->request->getGet('page') ?: 1;
        $perPage = (int)$this->request->getGet('per_page') ?: 10;
        $search = $this->request->getGet('search');
        $status = $this->request->getGet('status');
        $dateFrom = $this->request->getGet('date_from');
        $dateTo = $this->request->getGet('date_to');

        $builder = $this->bookingModel->builder();

        // Join with users and properties tables
        $builder->select("
            bookings.id,
            bookings.check_in,
            bookings.check_out,
            bookings.adults,
            bookings.kids,
            bookings.number_of_nights,
            bookings.price_per_night,
            bookings.cleaning_fee,
            bookings.total_price,
            bookings.status,
            bookings.payment_status,
            bookings.payment_method,
            bookings.special_requests,
            bookings.created_at,
            users.id as user_id,
            CONCAT(users.first_name, ' ', users.last_name) as user_name,
            users.email as user_email,
            properties.id as property_id,
            properties.title as property_name,
            CONCAT(properties.city, ', ', properties.address) as property_location
        ");
        $builder->join('users', 'users.id = bookings.user_id', 'left');
        $builder->join('properties', 'properties.id = bookings.property_id', 'left');

        // Apply filters
        if (!empty($search)) {
            $builder->groupStart();
            $builder->like('CONCAT(users.first_name, " ", users.last_name)', $search);
            $builder->orLike('users.email', $search);
            $builder->orLike('properties.title', $search);
            $builder->orLike('properties.city', $search);
            $builder->orLike('properties.address', $search);
            $builder->orLike('bookings.id', $search);
            $builder->groupEnd();
        }

        if (!empty($status)) {
            $builder->where('bookings.status', $status);
        }

        if (!empty($dateFrom)) {
            $builder->where('bookings.check_in >=', $dateFrom);
        }

        if (!empty($dateTo)) {
            $builder->where('bookings.check_out <=', $dateTo);
        }

        // Get total count before pagination
        $total = $builder->countAllResults(false);

        // Apply pagination
        $offset = ($page - 1) * $perPage;
        $builder->orderBy('bookings.created_at', 'DESC');
        $builder->limit($perPage, $offset);

        $bookings = $builder->get()->getResultArray();

        // Format data - MOVED FROM VIEW
        foreach ($bookings as &$booking) {
            // Calculate total guests
            $booking['guests'] = $booking['adults'] + $booking['kids'];

            // Format prices
            $booking['total_price_formatted'] = number_format($booking['total_price'], 2);
            $booking['price_per_night_formatted'] = number_format($booking['price_per_night'], 2);
            $booking['cleaning_fee_formatted'] = number_format($booking['cleaning_fee'], 2);

            // Generate status badge HTML
            $booking['status_badge'] = $this->getStatusBadge($booking['status']);
        }

        // Calculate pagination
        $totalPages = ceil($total / $perPage);
        $from = $total > 0 ? $offset + 1 : 0;
        $to = min($offset + $perPage, $total);

        return $this->response->setJSON([
            'success' => true,
            'bookings' => $bookings,
            'pagination' => [
                'current_page' => $page,
                'per_page' => $perPage,
                'total' => $total,
                'total_pages' => $totalPages,
                'from' => $from,
                'to' => $to
            ]
        ]);
    }

    // MOVED FROM VIEW: Generate status badge HTML
    private function getStatusBadge($status)
    {
        $badges = [
            'pending' => '<span class="inline-flex bg-yellow-100 px-2 py-1 rounded-full font-semibold text-yellow-800 text-xs leading-5">Pending</span>',
            'confirmed' => '<span class="inline-flex bg-green-100 px-2 py-1 rounded-full font-semibold text-green-800 text-xs leading-5">Confirmed</span>',
            'cancelled' => '<span class="inline-flex bg-red-100 px-2 py-1 rounded-full font-semibold text-red-800 text-xs leading-5">Cancelled</span>',
            'completed' => '<span class="inline-flex bg-blue-100 px-2 py-1 rounded-full font-semibold text-blue-800 text-xs leading-5">Completed</span>',
            'rejected' => '<span class="inline-flex bg-gray-100 px-2 py-1 rounded-full font-semibold text-gray-800 text-xs leading-5">Rejected</span>'
        ];

        return $badges[$status] ?? '<span class="inline-flex bg-gray-100 px-2 py-1 rounded-full font-semibold text-gray-800 text-xs leading-5">' . ucfirst($status) . '</span>';
    }

    // View single booking details
    public function view($id = null)
    {
        if (!$id) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Booking ID is required'
            ]);
        }

        $builder = $this->bookingModel->builder();
        $builder->select('
            bookings.*,
            users.id as user_id,
            CONCAT(users.first_name, " ", users.last_name) as user_name,
            users.email as user_email,
            properties.id as property_id,
            properties.title as property_name,
            CONCAT(properties.city, ", ", properties.address) as property_location
        ');
        $builder->join('users', 'users.id = bookings.user_id', 'left');
        $builder->join('properties', 'properties.id = bookings.property_id', 'left');
        $builder->where('bookings.id', $id);

        $booking = $builder->get()->getRowArray();

        if (!$booking) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Booking not found'
            ]);
        }

        // Format data - MOVED FROM VIEW
        $booking['guests'] = $booking['adults'] + $booking['kids'];
        $booking['status_badge'] = $this->getStatusBadge($booking['status']);
        $booking['total_price_formatted'] = number_format($booking['total_price'], 2);
        $booking['price_per_night_formatted'] = number_format($booking['price_per_night'], 2);
        $booking['cleaning_fee_formatted'] = number_format($booking['cleaning_fee'], 2);

        return $this->response->setJSON([
            'success' => true,
            'booking' => $booking
        ]);
    }

    // Update booking
    public function update()
    {
        $json = $this->request->getJSON(true);

        // Validation rules
        $validation = \Config\Services::validation();
        $validation->setRules([
            'id' => 'required|numeric',
            'check_in' => 'required|valid_date',
            'check_out' => 'required|valid_date',
            'adults' => 'required|numeric|greater_than[0]',
            'kids' => 'required|numeric',
            'status' => 'required|in_list[pending,confirmed,cancelled,completed,rejected]'
        ]);

        if (!$validation->run($json)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => implode(', ', $validation->getErrors())
            ]);
        }

        // Validate dates
        $checkIn = strtotime($json['check_in']);
        $checkOut = strtotime($json['check_out']);

        if ($checkOut <= $checkIn) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Check-out date must be after check-in date'
            ]);
        }

        // Check if booking exists
        $booking = $this->bookingModel->find($json['id']);
        if (!$booking) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Booking not found'
            ]);
        }

        // Calculate number of nights
        $numberOfNights = ceil(($checkOut - $checkIn) / (60 * 60 * 24));

        // Prepare update data
        $updateData = [
            'check_in' => $json['check_in'],
            'check_out' => $json['check_out'],
            'adults' => $json['adults'],
            'kids' => $json['kids'],
            'number_of_nights' => $numberOfNights,
            'status' => $json['status'],
            'special_requests' => $json['special_requests'] ?? ''
        ];

        // Recalculate total price if nights changed
        if ($numberOfNights != $booking['number_of_nights']) {
            $updateData['total_price'] = ($booking['price_per_night'] * $numberOfNights) + $booking['cleaning_fee'];
        }

        // Update booking
        $result = $this->bookingModel->update($json['id'], $updateData);

        if ($result) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Booking updated successfully'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to update booking'
            ]);
        }
    }

    // Delete booking 
    public function delete($id = null)
    {
        if (!$id) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Booking ID is required'
            ]);
        }

        // Check if booking exists
        $booking = $this->bookingModel->find($id);
        if (!$booking) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Booking not found'
            ]);
        }

        // Delete booking
        $result = $this->bookingModel->delete($id);

        if ($result) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Booking deleted successfully'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to delete booking'
            ]);
        }
    }

    // Get booking statistics 
    public function statistics()
    {
        $builder = $this->bookingModel->builder();

        // Total bookings
        $totalBookings = $builder->countAllResults();

        // Bookings by status
        $builder = $this->bookingModel->builder();
        $builder->select('status, COUNT(*) as count');
        $builder->groupBy('status');
        $byStatus = $builder->get()->getResultArray();

        // Total revenue (completed bookings)
        $builder = $this->bookingModel->builder();
        $builder->selectSum('total_price');
        $builder->where('status', 'completed');
        $revenue = $builder->get()->getRowArray();
        $totalRevenue = $revenue['total_price'] ?? 0;

        // This month's bookings
        $builder = $this->bookingModel->builder();
        $builder->where('MONTH(created_at)', date('m'));
        $builder->where('YEAR(created_at)', date('Y'));
        $thisMonth = $builder->countAllResults();

        return $this->response->setJSON([
            'success' => true,
            'statistics' => [
                'total_bookings' => $totalBookings,
                'by_status' => $byStatus,
                'total_revenue' => number_format($totalRevenue, 2),
                'this_month' => $thisMonth
            ]
        ]);
    }
}
