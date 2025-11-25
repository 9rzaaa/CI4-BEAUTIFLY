<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;

class BookingController extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    /**
     * Show booking page
     */
    public function index()
    {
        return view('pages/booking');
    }

    /**
     * Create a new booking (API)
     */
    public function create()
    {
        // Get JSON input
        $json = $this->request->getJSON(true);
        
        // Validate input
        $validation = $this->validateBooking($json);
        if (!$validation['valid']) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(['error' => $validation['message']]);
        }

        // Check for conflicts
        if ($this->checkBookingConflict($json['check_in'], $json['check_out'])) {
            return $this->response
                ->setStatusCode(409)
                ->setJSON(['error' => 'Property is already booked for selected dates']);
        }
        // Calculate pricing
        $checkIn = new \DateTime($json['check_in']);
        $checkOut = new \DateTime($json['check_out']);
        $nights = $checkOut->diff($checkIn)->days;
        $pricePerNight = 100;
        $totalPrice = $nights * $pricePerNight;

        // Insert booking
        $data = [
            'user_id' => session()->get('user_id') ?? 1,
            'property_id' => 1,
            'check_in' => $json['check_in'],
            'check_out' => $json['check_out'],
            'adults' => $json['adults'],
            'kids' => $json['kids'] ?? 0,
            'number_of_nights' => $nights,
            'price_per_night' => $pricePerNight,
            'total_price' => $totalPrice,
            'status' => 'pending',
            'payment_status' => 'unpaid',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $builder = $this->db->table('bookings');
        $builder->insert($data);
        $bookingId = $this->db->insertID();

        return $this->response->setJSON([
            'success' => true,
            'booking_id' => $bookingId,
            'total_price' => $totalPrice,
            'nights' => $nights,
            'message' => 'Booking created successfully'
        ]);
    }
}