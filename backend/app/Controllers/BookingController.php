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
        return view('user/booking');
    }

    /**
     * Show booking review page
     * Calculates prices from database (not from URL parameters)
     */
    public function review()
    {
        // Check if user is logged in
        $userId = session()->get('user_id');

        if (!$userId) {
            session()->set('redirect_url', current_url());
            return redirect()->to('/login')
                ->with('error', 'Please login to continue with your booking');
        }

        // Get booking parameters from URL
        $checkIn = $this->request->getGet('checkIn');
        $checkOut = $this->request->getGet('checkOut');
        $adults = $this->request->getGet('adults');
        $kids = $this->request->getGet('kids') ?? 0;

        // Validate required parameters
        if (!$checkIn || !$checkOut || !$adults) {
            return redirect()->to('/booking')
                ->with('error', 'Invalid booking parameters. Please try again.');
        }

        // Validate booking data
        $validation = $this->validateBooking([
            'check_in' => $checkIn,
            'check_out' => $checkOut,
            'adults' => $adults,
            'kids' => $kids
        ]);

        if (!$validation['valid']) {
            return redirect()->to('/booking')
                ->with('error', $validation['message']);
        }

        // Check for booking conflicts
        if ($this->checkBookingConflict($checkIn, $checkOut)) {
            return redirect()->to('/booking')
                ->with('error', 'Property is already booked for selected dates. Please choose different dates.');
        }

        // Get property details from database
        $property = $this->db->table('properties')
            ->where('id', 1)
            ->get()
            ->getRowArray();

        if (!$property) {
            return redirect()->to('/booking')
                ->with('error', 'Property not available.');
        }

        // Calculate pricing from database
        $checkInDate = new \DateTime($checkIn);
        $checkOutDate = new \DateTime($checkOut);
        $nights = $checkOutDate->diff($checkInDate)->days;

        $pricePerNight = $property['price_per_night'];
        $cleaningFee = $property['cleaning_fee'];
        $subtotal = $nights * $pricePerNight;
        $totalPrice = $subtotal + $cleaningFee;

        // Generate transaction ID server-side
        $transactionId = 'TXN-' . strtoupper(bin2hex(random_bytes(5)));

        // Format dates for display
        $checkInFormatted = $checkInDate->format('M d, Y');
        $checkOutFormatted = $checkOutDate->format('M d, Y');

        // Pass data to view
        $data = [
            'checkIn' => $checkIn,
            'checkOut' => $checkOut,
            'checkInFormatted' => $checkInFormatted,
            'checkOutFormatted' => $checkOutFormatted,
            'adults' => $adults,
            'kids' => $kids,
            'nights' => $nights,
            'transactionId' => $transactionId,
            'pricePerNight' => number_format($pricePerNight, 2),
            'cleaningFee' => number_format($cleaningFee, 2),
            'subtotal' => number_format($subtotal, 2),
            'totalPrice' => number_format($totalPrice, 2),
            'userId' => $userId,
            'propertyName' => $property['title'] ?? 'Garden Resort'
        ];

        return view('user/booking_review', $data);
    }

    /**
     * Create a new booking (API)
     * Creates booking with PENDING status
     * Payment processing happens in PaymentController::processPayment()
     */
    public function create()
    {
        // Get JSON input
        $json = $this->request->getJSON(true);

        // Validate user is logged in
        $userId = session()->get('user_id');
        if (!$userId) {
            return $this->response
                ->setStatusCode(401)
                ->setJSON(['success' => false, 'error' => 'User not authenticated']);
        }

        // Validate input
        $validation = $this->validateBooking($json);
        if (!$validation['valid']) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(['success' => false, 'error' => $validation['message']]);
        }

        // Check for conflicts
        if ($this->checkBookingConflict($json['check_in'], $json['check_out'])) {
            return $this->response
                ->setStatusCode(409)
                ->setJSON(['success' => false, 'error' => 'Property is already booked for selected dates']);
        }

        // Get property details from database
        $property = $this->db->table('properties')
            ->where('id', 1)
            ->get()
            ->getRowArray();

        if (!$property) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON(['success' => false, 'error' => 'Property not found']);
        }

        // Calculate pricing from database
        $checkIn = new \DateTime($json['check_in']);
        $checkOut = new \DateTime($json['check_out']);
        $nights = $checkOut->diff($checkIn)->days;
        $pricePerNight = $property['price_per_night'];
        $cleaningFee = $property['cleaning_fee'];
        $totalPrice = ($nights * $pricePerNight) + $cleaningFee;

        // Validate payment method
        $paymentMethod = $json['payment_method'] ?? null;
        if (!in_array($paymentMethod, ['gcash', 'paymaya', 'visa', 'credit_card'])) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(['success' => false, 'error' => 'Invalid payment method']);
        }

        // Generate transaction ID server-side (if not provided)
        $transactionId = $json['transaction_id'] ?? 'TXN-' . strtoupper(bin2hex(random_bytes(5)));

        // Begin database transaction
        $this->db->transStart();

        try {
            // Insert booking with PENDING status
            $bookingData = [
                'user_id' => $userId,
                'property_id' => 1,
                'check_in' => $json['check_in'],
                'check_out' => $json['check_out'],
                'adults' => $json['adults'],
                'kids' => $json['kids'] ?? 0,
                'number_of_nights' => $nights,
                'price_per_night' => $pricePerNight,
                'cleaning_fee' => $cleaningFee,
                'total_price' => $totalPrice,
                'status' => 'pending',
                'payment_status' => 'unpaid',
                'payment_method' => $paymentMethod,
                'transaction_id' => $transactionId,
                'special_requests' => $json['special_requests'] ?? null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            $builder = $this->db->table('bookings');
            $builder->insert($bookingData);
            $bookingId = $this->db->insertID();

            $this->db->transComplete();

            if ($this->db->transStatus() === false) {
                throw new \Exception('Failed to create booking');
            }

            log_message('info', "Booking #{$bookingId} created with pending status. Payment method: {$paymentMethod}");

            return $this->response->setJSON([
                'success' => true,
                'booking_id' => $bookingId,
                'total_price' => $totalPrice,
                'price_per_night' => $pricePerNight,
                'cleaning_fee' => $cleaningFee,
                'nights' => $nights,
                'transaction_id' => $transactionId,
                'message' => 'Booking created successfully. Please proceed with payment.'
            ]);
        } catch (\Exception $e) {
            $this->db->transRollback();
            log_message('error', 'Booking creation failed: ' . $e->getMessage());

            return $this->response
                ->setStatusCode(500)
                ->setJSON(['success' => false, 'error' => 'Failed to create booking. Please try again.']);
        }
    }

    /**
     * Show user's booking history (My Bookings)
     * Read-only view with option to cancel eligible bookings
     */
    public function myBookings()
    {
        // Check if user is logged in
        $userId = session()->get('user_id');
        
        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Please login to view your bookings');
        }
        
        // Get property details (single property)
        $property = $this->db->table('properties')->where('id', 1)->get()->getRowArray();
        $propertyTitle = $property['title'] ?? 'Garden Resort';
        $propertyCity = $property['city'] ?? '';
        
        // Fetch all bookings for the current user
        $builder = $this->db->table('bookings');
        $bookings = $builder->where('user_id', $userId)
            ->orderBy('created_at', 'DESC')
            ->get()
            ->getResultArray();
        
        // Group bookings by status
        $groupedBookings = [
            'pending' => [],
            'upcoming' => [],
            'completed' => [],
            'cancelled' => []
        ];
        
        $currentDate = date('Y-m-d');
        
        // Process each booking
        foreach ($bookings as &$booking) {
            // Add property information
            $booking['property_title'] = $propertyTitle;
            $booking['property_city'] = $propertyCity;
            
            // Format dates for display
            $booking['check_in_formatted'] = date('M d, Y', strtotime($booking['check_in']));
            $booking['check_out_formatted'] = date('M d, Y', strtotime($booking['check_out']));
            $booking['created_at_formatted'] = date('M d, Y h:i A', strtotime($booking['created_at']));
            
            // Format prices
            $booking['total_price_formatted'] = '₱' . number_format($booking['total_price'], 2);
            
            // Format status for display
            $booking['status_badge'] = ucfirst($booking['status']);
            $booking['payment_status_badge'] = ucfirst($booking['payment_status']);
            
            // Determine if booking can be cancelled
            $booking['can_cancel'] = (
                !in_array($booking['status'], ['cancelled', 'completed']) && 
                $booking['check_in'] >= $currentDate
            );
            
            // Categorize bookings
            if ($booking['status'] === 'cancelled') {
                $groupedBookings['cancelled'][] = $booking;
            } elseif ($booking['status'] === 'pending') {
                $groupedBookings['pending'][] = $booking;
            } elseif ($booking['check_in'] >= $currentDate && $booking['status'] === 'confirmed') {
                $groupedBookings['upcoming'][] = $booking;
            } elseif ($booking['check_out'] < $currentDate) {
                $groupedBookings['completed'][] = $booking;
            } else {
                $groupedBookings['upcoming'][] = $booking;
            }
        }
        
        // Prepare data for view
        $data = [
            'title' => 'My Bookings',
            'bookings' => $bookings,
            'groupedBookings' => $groupedBookings,
            'totalBookings' => count($bookings),
            'pendingCount' => count($groupedBookings['pending']),
            'upcomingCount' => count($groupedBookings['upcoming']),
            'completedCount' => count($groupedBookings['completed']),
            'cancelledCount' => count($groupedBookings['cancelled'])
        ];
        
        return view('user/mybookings', $data);
    }

    /**
     * View single booking details
     * Read-only detailed view of a specific booking
     */
    public function viewBooking($bookingId)
    {
        $userId = session()->get('user_id');
        
        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Please login to view booking details');
        }
        
        // Fetch booking details
        $builder = $this->db->table('bookings');
        $booking = $builder->where('id', $bookingId)
            ->where('user_id', $userId)
            ->get()
            ->getRowArray();
        
        if (!$booking) {
            return redirect()->to('/bookings')->with('error', 'Booking not found');
        }
        
        // Get property details
        $property = $this->db->table('properties')->where('id', $booking['property_id'])->get()->getRowArray();
        
        // Add property information to booking
        $booking['property_title'] = $property['title'] ?? 'Garden Resort';
        $booking['property_address'] = $property['address'] ?? '';
        $booking['property_city'] = $property['city'] ?? '';
        $booking['property_description'] = $property['description'] ?? '';
        $booking['property_type'] = $property['property_type'] ?? '';
        $booking['amenities'] = $property['amenities'] ?? '';
        
        // Format dates for display
        $booking['check_in_formatted'] = date('l, F d, Y', strtotime($booking['check_in']));
        $booking['check_out_formatted'] = date('l, F d, Y', strtotime($booking['check_out']));
        $booking['created_at_formatted'] = date('F d, Y h:i A', strtotime($booking['created_at']));
        
        // Format prices
        $subtotal = $booking['number_of_nights'] * $booking['price_per_night'];
        $booking['total_price_formatted'] = '₱' . number_format($booking['total_price'], 2);
        $booking['price_per_night_formatted'] = '₱' . number_format($booking['price_per_night'], 2);
        $booking['cleaning_fee_formatted'] = '₱' . number_format($booking['cleaning_fee'], 2);
        $booking['subtotal_formatted'] = '₱' . number_format($subtotal, 2);
        
        // Format status badges
        $booking['status_badge'] = ucfirst($booking['status']);
        $booking['payment_status_badge'] = ucfirst($booking['payment_status']);
        
        // Determine if booking can be cancelled
        $currentDate = date('Y-m-d');
        $booking['can_cancel'] = (
            !in_array($booking['status'], ['cancelled', 'completed']) && 
            $booking['check_in'] >= $currentDate
        );
        
        $data = [
            'title' => 'Booking Details',
            'booking' => $booking
        ];
        
        return view('user/booking_details', $data);
    }

    /**
     * Cancel booking (API)
     */
    public function cancel($id)
    {
        // Validate user is logged in
        $userId = session()->get('user_id');
        if (!$userId) {
            return $this->response
                ->setStatusCode(401)
                ->setJSON(['success' => false, 'error' => 'User not authenticated']);
        }

        $builder = $this->db->table('bookings');
        $booking = $builder->where('id', $id)
            ->where('user_id', $userId)
            ->get()
            ->getRowArray();

        if (!$booking) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON(['success' => false, 'error' => 'Booking not found or access denied']);
        }

        // Check if booking can be cancelled
        if (in_array($booking['status'], ['cancelled', 'completed'])) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(['success' => false, 'error' => 'Booking cannot be cancelled']);
        }

        // Update status to cancelled
        $builder->where('id', $id)->update([
            'status' => 'cancelled',
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // If payment was made, log for refund process
        if ($booking['payment_status'] === 'paid') {
            log_message('info', "Booking #{$id} cancelled. Refund may be required.");
        }

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Booking cancelled successfully'
        ]);
    }

    /**
     * Show booking success page
     */
    public function success()
    {
        $bookingId = $this->request->getGet('id');
        $userId = session()->get('user_id');

        if (!$bookingId || !$userId) {
            return redirect()->to('/booking')->with('error', 'Invalid booking');
        }

        // Get booking details from database
        $builder = $this->db->table('bookings');
        $booking = $builder->where('id', $bookingId)
            ->where('user_id', $userId)
            ->get()
            ->getRowArray();

        if (!$booking) {
            return redirect()->to('/booking')->with('error', 'Booking not found');
        }

        // Verify payment was successful
        if ($booking['payment_status'] !== 'paid') {
            return redirect()->to('/booking')
                ->with('error', 'Payment not completed. Please try again.');
        }

        // Format dates
        $checkIn = date('M d, Y', strtotime($booking['check_in']));
        $checkOut = date('M d, Y', strtotime($booking['check_out']));

        $data = [
            'booking_id' => $bookingId,
            'transaction_id' => $booking['transaction_id'],
            'check_in' => $checkIn,
            'check_out' => $checkOut,
            'nights' => $booking['number_of_nights'],
            'adults' => $booking['adults'],
            'kids' => $booking['kids'],
            'total_price' => number_format($booking['total_price'], 2),
            'payment_method' => ucfirst($booking['payment_method']),
            'payment_status' => ucfirst($booking['payment_status']),
            'status' => ucfirst($booking['status']),
            'created_at' => date('M d, Y h:i A', strtotime($booking['created_at']))
        ];

        return view('user/booking_success', $data);
    }

    // ============================================
    // PRIVATE HELPER METHODS
    // ============================================

    /**
     * Validate booking data
     */
    private function validateBooking($data)
    {
        // Check required fields
        if (empty($data['check_in']) || empty($data['check_out']) || empty($data['adults'])) {
            return [
                'valid' => false,
                'message' => 'Check-in date, check-out date, and number of adults are required'
            ];
        }

        // Validate dates
        try {
            $checkIn = new \DateTime($data['check_in']);
            $checkOut = new \DateTime($data['check_out']);
            $today = new \DateTime('today');
        } catch (\Exception $e) {
            return [
                'valid' => false,
                'message' => 'Invalid date format'
            ];
        }

        // Check if check-in is in the past
        if ($checkIn < $today) {
            return [
                'valid' => false,
                'message' => 'Check-in date cannot be in the past'
            ];
        }

        // Check if check-out is after check-in
        if ($checkOut <= $checkIn) {
            return [
                'valid' => false,
                'message' => 'Check-out date must be after check-in date'
            ];
        }

        // Check minimum stay (1 night)
        $nights = $checkOut->diff($checkIn)->days;
        if ($nights < 1) {
            return [
                'valid' => false,
                'message' => 'Minimum stay is 1 night'
            ];
        }

        // Check maximum stay duration
        if ($nights > 30) {
            return [
                'valid' => false,
                'message' => 'Maximum stay is 30 nights'
            ];
        }

        // Get property max guests from database
        $property = $this->db->table('properties')
            ->where('id', 1)
            ->get()
            ->getRowArray();

        if (!$property) {
            return [
                'valid' => false,
                'message' => 'Property not found'
            ];
        }

        $maxGuests = $property['max_guests'] ?? 6;

        // Validate number of guests
        $adults = (int)$data['adults'];
        $kids = isset($data['kids']) ? (int)$data['kids'] : 0;
        $totalGuests = $adults + $kids;

        if ($adults < 1) {
            return [
                'valid' => false,
                'message' => 'At least one adult is required'
            ];
        }

        if ($kids < 0) {
            return [
                'valid' => false,
                'message' => 'Number of kids cannot be negative'
            ];
        }

        if ($totalGuests > $maxGuests) {
            return [
                'valid' => false,
                'message' => "Maximum {$maxGuests} guests total allowed (adults + kids)"
            ];
        }

        // All validations passed
        return ['valid' => true];
    }

    /**
     * Check if property has booking conflicts for given dates
     */
    private function checkBookingConflict($checkIn, $checkOut)
    {
        $builder = $this->db->table('bookings');

        $builder->where('property_id', 1);
        $builder->whereIn('status', ['pending', 'confirmed']);

        $builder->groupStart()
            ->where('check_in <', $checkOut)
            ->where('check_out >', $checkIn)
            ->groupEnd();

        $count = $builder->countAllResults();

        return $count > 0;
    }

    /**
     * Check conflicts excluding specific booking (for updates)
     */
    private function checkBookingConflictExcluding($checkIn, $checkOut, $excludeId)
    {
        $builder = $this->db->table('bookings');

        $builder->where('property_id', 1);
        $builder->where('id !=', $excludeId);
        $builder->whereIn('status', ['pending', 'confirmed']);

        $builder->groupStart()
            ->where('check_in <', $checkOut)
            ->where('check_out >', $checkIn)
            ->groupEnd();

        $count = $builder->countAllResults();

        return $count > 0;
    }

    /**
     * Get booked dates for calendar (API endpoint)
     * Returns date ranges that should be disabled in the date picker
     */
    public function getBookedDates()
    {
        try {
            $builder = $this->db->table('bookings');

            // Get all active bookings (pending and confirmed)
            $bookings = $builder->where('property_id', 1)
                ->whereIn('status', ['pending', 'confirmed'])
                ->select('check_in, check_out')
                ->get()
                ->getResultArray();

            // Format dates for flatpickr
            $bookedDates = [];
            foreach ($bookings as $booking) {
                $bookedDates[] = [
                    'from' => $booking['check_in'],
                    'to' => $booking['check_out']
                ];
            }

            return $this->response->setJSON([
                'success' => true,
                'booked_dates' => $bookedDates
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Failed to fetch booked dates: ' . $e->getMessage());

            return $this->response
                ->setStatusCode(500)
                ->setJSON([
                    'success' => false,
                    'error' => 'Failed to load booked dates',
                    'booked_dates' => []
                ]);
        }
    }
}