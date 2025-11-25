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
