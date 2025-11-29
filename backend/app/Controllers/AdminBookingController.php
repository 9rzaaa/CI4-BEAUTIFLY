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
        // Store the attempted URL for redirect after login
        $session->set('redirect_url', current_url());
        // Redirect to login with error message
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


    // Get bookings list with filters and pagination (
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
            users.email as user_email
        ");
        $builder->join('users', 'users.id = bookings.user_id', 'left');
        $builder->join('properties', 'properties.id = bookings.property_id', 'left');