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
        log_message('info', '==================== REVIEW METHOD STARTED ====================');

        // Check if user is logged in
        $userId = session()->get('user_id');
        log_message('info', 'User ID from session: ' . ($userId ?? 'NULL'));

        if (!$userId) {
            log_message('info', 'REDIRECT: User not logged in');
            session()->set('redirect_url', current_url());
            return redirect()->to('/login')
                ->with('error', 'Please login to continue with your booking');
        }

        // Get booking parameters from URL
        $checkIn = $this->request->getGet('checkIn');
        $checkOut = $this->request->getGet('checkOut');
        $adults = $this->request->getGet('adults');
        $kids = $this->request->getGet('kids') ?? 0;

        log_message('info', 'GET Parameters:');
        log_message('info', '  checkIn: ' . ($checkIn ?? 'NULL'));
        log_message('info', '  checkOut: ' . ($checkOut ?? 'NULL'));
        log_message('info', '  adults: ' . ($adults ?? 'NULL'));
        log_message('info', '  kids: ' . $kids);

        // Validate required parameters
        if (!$checkIn || !$checkOut || !$adults) {
            log_message('info', 'REDIRECT: Missing required parameters');
            return redirect()->to('/booking')
                ->with('error', 'Invalid booking parameters. Please try again.');
        }

        // Validate dates before proceeding
        $validation = $this->validateBooking([
            'check_in' => $checkIn,
            'check_out' => $checkOut,
            'adults' => $adults,
            'kids' => $kids
        ]);

        log_message('info', 'Validation result: ' . json_encode($validation));

        if (!$validation['valid']) {
            log_message('info', 'REDIRECT: Validation failed - ' . $validation['message']);
            return redirect()->to('/booking')
                ->with('error', $validation['message']);
        }

        // Check for booking conflicts
        $hasConflict = $this->checkBookingConflict($checkIn, $checkOut);
        log_message('info', 'Booking conflict check: ' . ($hasConflict ? 'YES' : 'NO'));

        if ($hasConflict) {
            log_message('info', 'REDIRECT: Booking conflict detected');
            return redirect()->to('/booking')
                ->with('error', 'Property is already booked for selected dates. Please choose different dates.');
        }

        // Get property details from database
        $property = $this->db->table('properties')
            ->where('id', 1)
            ->get()
            ->getRowArray();

        log_message('info', 'Property found: ' . ($property ? 'YES' : 'NO'));

        if (!$property) {
            log_message('info', 'REDIRECT: Property not found');
            return redirect()->to('/booking')
                ->with('error', 'Property not available.');
        }

        log_message('info', 'SUCCESS: All checks passed, rendering view');

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
            'propertyName' => $property['name'] ?? 'Garden Resort'
        ];

        log_message('info', 'Rendering view: user/booking_review');
        log_message('info', '==================== REVIEW METHOD ENDED ====================');

        return view('user/booking_review', $data);
    }

    /**
     * Calculate price (AJAX endpoint)
     */
    public function calculatePrice()
    {
        $checkIn = $this->request->getGet('checkIn');
        $checkOut = $this->request->getGet('checkOut');

        if (!$checkIn || !$checkOut) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(['error' => 'Check-in and check-out dates required']);
        }

        // Get property pricing from database
        $property = $this->db->table('properties')
            ->where('id', 1)
            ->get()
            ->getRowArray();

        if (!$property) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON(['error' => 'Property not found']);
        }

        $checkInDate = new \DateTime($checkIn);
        $checkOutDate = new \DateTime($checkOut);
        $nights = $checkOutDate->diff($checkInDate)->days;

        $pricePerNight = $property['price_per_night'];
        $cleaningFee = $property['cleaning_fee'];
        $subtotal = $nights * $pricePerNight;
        $total = $subtotal + $cleaningFee;

        return $this->response->setJSON([
            'nights' => $nights,
            'pricePerNight' => $pricePerNight,
            'cleaningFee' => $cleaningFee,
            'subtotal' => $subtotal,
            'total' => $total
        ]);
    }

    /**
     * Create a new booking (API)
     * ⚠️ IMPORTANT: Creates booking with PENDING status
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
            // Payment will be processed separately by PaymentController
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
                'status' => 'pending', // ✅ Changed from 'confirmed' to 'pending'
                'payment_status' => 'unpaid', // ✅ Will be updated by PaymentController
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
     * Update booking
     */
    public function update($id)
    {
        $json = $this->request->getJSON(true);

        // Validate user is logged in
        $userId = session()->get('user_id');
        if (!$userId) {
            return $this->response
                ->setStatusCode(401)
                ->setJSON(['error' => 'User not authenticated']);
        }

        // Get existing booking
        $builder = $this->db->table('bookings');
        $booking = $builder->where('id', $id)
            ->where('user_id', $userId) // ✅ Ensure user owns the booking
            ->get()
            ->getRowArray();

        if (!$booking) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON(['error' => 'Booking not found or access denied']);
        }

        // Don't allow updates to confirmed/paid bookings without admin approval
        if ($booking['payment_status'] === 'paid') {
            return $this->response
                ->setStatusCode(403)
                ->setJSON(['error' => 'Cannot modify paid bookings. Please contact support.']);
        }

        // Prepare update data
        $updateData = ['updated_at' => date('Y-m-d H:i:s')];
        $allowedFields = ['check_in', 'check_out', 'adults', 'kids', 'special_requests'];

        foreach ($allowedFields as $field) {
            if (isset($json[$field])) {
                $updateData[$field] = $json[$field];
            }
        }

        if (count($updateData) === 1) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(['error' => 'No fields to update']);
        }

        // If dates changed, validate and check conflicts
        if (isset($json['check_in']) || isset($json['check_out'])) {
            $newCheckIn = $json['check_in'] ?? $booking['check_in'];
            $newCheckOut = $json['check_out'] ?? $booking['check_out'];

            $validation = $this->validateBooking([
                'check_in' => $newCheckIn,
                'check_out' => $newCheckOut,
                'adults' => $json['adults'] ?? $booking['adults'],
                'kids' => $json['kids'] ?? $booking['kids']
            ]);

            if (!$validation['valid']) {
                return $this->response
                    ->setStatusCode(400)
                    ->setJSON(['error' => $validation['message']]);
            }

            // Check conflicts (excluding current booking)
            if ($this->checkBookingConflictExcluding($newCheckIn, $newCheckOut, $id)) {
                return $this->response
                    ->setStatusCode(409)
                    ->setJSON(['error' => 'Property is already booked for selected dates']);
            }

            // Recalculate price
            $checkIn = new \DateTime($newCheckIn);
            $checkOut = new \DateTime($newCheckOut);
            $nights = $checkOut->diff($checkIn)->days;
            $updateData['number_of_nights'] = $nights;
            $updateData['total_price'] = ($nights * $booking['price_per_night']) + $booking['cleaning_fee'];
        }

        $builder->where('id', $id)->update($updateData);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Booking updated successfully'
        ]);
    }

    /**
     * Cancel booking
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

        // Soft delete - update status to cancelled
        $builder->where('id', $id)->update([
            'status' => 'cancelled',
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // If payment was made, trigger refund process
        if ($booking['payment_status'] === 'paid') {
            log_message('info', "Booking #{$id} cancelled. Refund may be required.");
            // You can call PaymentController::refundPayment() here if needed
        }

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Booking cancelled successfully'
        ]);
    }

    /**
     * Delete booking (for compatibility - redirects to cancel)
     */
    public function delete($id)
    {
        return $this->cancel($id);
    }

    /**
     * Get booking details
     */
    public function getBooking($id)
    {
        $userId = session()->get('user_id');
        if (!$userId) {
            return $this->response
                ->setStatusCode(401)
                ->setJSON(['error' => 'User not authenticated']);
        }

        $builder = $this->db->table('bookings');
        $booking = $builder->where('id', $id)
            ->where('user_id', $userId)
            ->get()
            ->getRowArray();

        if (!$booking) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON(['error' => 'Booking not found or access denied']);
        }

        return $this->response->setJSON(['success' => true, 'booking' => $booking]);
    }

    /**
     * Get property details
     */
    public function getProperty($id = 1)
    {
        $builder = $this->db->table('properties');
        $property = $builder->where('id', $id)->get()->getRowArray();

        if (!$property) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON(['error' => 'Property not found']);
        }

        return $this->response->setJSON(['property' => $property]);
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

        // Validate number of guests
        $adults = (int)$data['adults'];
        $kids = isset($data['kids']) ? (int)$data['kids'] : 0;

        if ($adults < 1) {
            return [
                'valid' => false,
                'message' => 'At least one adult is required'
            ];
        }

        if ($adults > 6) {
            return [
                'valid' => false,
                'message' => 'Maximum 6 adults allowed'
            ];
        }

        if ($kids < 0) {
            return [
                'valid' => false,
                'message' => 'Number of kids cannot be negative'
            ];
        }

        if ($kids > 6) {
            return [
                'valid' => false,
                'message' => 'Maximum 6 kids allowed'
            ];
        }

        if (($adults + $kids) > 12) {
            return [
                'valid' => false,
                'message' => 'Maximum 12 guests total'
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

        // Only check active bookings (not cancelled/rejected)
        $builder->where('property_id', 1);
        $builder->whereIn('status', ['pending', 'confirmed']);

        // Date overlap logic:
        // Conflict if: new_start < existing_end AND new_end > existing_start
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
}
