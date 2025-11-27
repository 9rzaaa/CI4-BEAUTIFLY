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
     * Create a new booking (API)
     */
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
            ->setJSON(['success' => false, 'error' => $validation['message']]);
    }


    // Check for conflicts
    if ($this->checkBookingConflict($json['check_in'], $json['check_out'])) {
        return $this->response
            ->setStatusCode(409)
            ->setJSON(['success' => false, 'error' => 'Property is already booked for selected dates']);
    }


    // Get property details from database
    $propertyBuilder = $this->db->table('properties');
    $property = $propertyBuilder->where('id', 1)->get()->getRowArray();


    if (!$property) {
        return $this->response
            ->setStatusCode(404)
            ->setJSON(['success' => false, 'error' => 'Property not found']);
    }


    // Calculate pricing
    $checkIn = new \DateTime($json['check_in']);
    $checkOut = new \DateTime($json['check_out']);
    $nights = $checkOut->diff($checkIn)->days;
    $pricePerNight = $property['price_per_night'];
    $cleaningFee = $property['cleaning_fee'];
    $totalPrice = ($nights * $pricePerNight) + $cleaningFee;


    // Generate transaction ID if not provided
    $transactionId = $json['transaction_id'] ?? 'TXN' . time() . rand(1000, 9999);


    // Determine payment status based on method
    $paymentMethod = $json['payment_method'] ?? null;
    $paymentStatus = 'unpaid'; // Default
   
    // Auto-mark as paid for GCash/Maya since QR was shown
    if (in_array($paymentMethod, ['gcash', 'paymaya'])) {
        $paymentStatus = 'paid';
    }
    // For Visa, mark as pending until confirmed by payment gateway
    elseif ($paymentMethod === 'visa') {
        $paymentStatus = 'pending';
    }


    // Insert booking
    $data = [
        'user_id' => session()->get('user_id') ?? 2,
        'property_id' => 1,
        'check_in' => $json['check_in'],
        'check_out' => $json['check_out'],
        'adults' => $json['adults'],
        'kids' => $json['kids'] ?? 0,
        'number_of_nights' => $nights,
        'price_per_night' => $pricePerNight,
        'total_price' => $totalPrice,
        'status' => 'confirmed', // Booking is confirmed
        'payment_status' => $paymentStatus,
        'payment_method' => $paymentMethod,
        'transaction_id' => $transactionId,
        'special_requests' => $json['special_requests'] ?? null,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ];


    $builder = $this->db->table('bookings');
    $builder->insert($data);
    $bookingId = $this->db->insertID();


    // Log payment transaction (optional - for your records)
    $this->logPaymentTransaction($bookingId, $paymentMethod, $totalPrice, $paymentStatus);


    return $this->response->setJSON([
        'success' => true,
        'booking_id' => $bookingId,
        'total_price' => $totalPrice,
        'price_per_night' => $pricePerNight,
        'cleaning_fee' => $cleaningFee,
        'nights' => $nights,
        'transaction_id' => $transactionId,
        'payment_status' => $paymentStatus,
        'message' => 'Booking created successfully'
    ]);
}

    // log payment transaction (for records)
private function logPaymentTransaction($bookingId, $paymentMethod, $amount, $status)
{
    try {
        $paymentData = [
            'booking_id' => $bookingId,
            'payment_method' => $paymentMethod,
            'amount' => $amount,
            'status' => $status,
            'transaction_date' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s'),
        ];
       
       
    } catch (\Exception $e) {
        // Log error but don't fail the booking
        log_message('error', 'Payment logging failed: ' . $e->getMessage());
    }
}


    // Update booking 
    public function update($id)
    {
        $json = $this->request->getJSON(true);
        // Get existing booking
        $builder = $this->db->table('bookings');
        $booking = $builder->where('id', $id)->get()->getRowArray();
        if (!$booking) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON(['error' => 'Booking not found']);
        }
        // Prepare update data
        $updateData = ['updated_at' => date('Y-m-d H:i:s')];
        $allowedFields = ['check_in', 'check_out', 'adults', 'kids', 'status', 'special_requests'];
        foreach ($allowedFields as $field) {
            if (isset($json[$field])) {
                $updateData[$field] = $json[$field];
            }
        }

        if (count($updateData) === 1) { // Only updated_at
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
            $updateData['total_price'] = $nights * $booking['price_per_night'];
        }

        $builder->where('id', $id)->update($updateData);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Booking updated successfully'
        ]);
    }


    // Cancel/Delete booking
    public function delete($id)
    {
        $builder = $this->db->table('bookings');
        $booking = $builder->where('id', $id)->get()->getRowArray();

        if (!$booking) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON(['error' => 'Booking not found']);
        }

        // Soft delete - update status to cancelled
        $builder->where('id', $id)->update([
            'status' => 'cancelled',
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Booking cancelled successfully'
        ]);
    }

    // get the property details
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
     * Show booking review page
     */
    public function review()
    {
        // Check if user is logged in
        $userId = session()->get('user_id');
       
        if (!$userId) {
            // Store where user wanted to go
            session()->set('redirect_url', current_url());
           
            return redirect()->to('/login')
                ->with('error', 'Please login to continue with your booking');
        }
       
        // Get all booking parameters from URL
        $checkIn = $this->request->getGet('checkIn');
        $checkOut = $this->request->getGet('checkOut');
        $adults = $this->request->getGet('adults');
        $kids = $this->request->getGet('kids');
        $nights = $this->request->getGet('nights');
        $transactionId = $this->request->getGet('transactionId');
        $pricePerNight = $this->request->getGet('pricePerNight');
        $cleaningFee = $this->request->getGet('cleaningFee');
        $totalPrice = $this->request->getGet('totalPrice');
       
        // Validate required parameters
        if (!$checkIn || !$checkOut || !$adults || !$nights) {
            return redirect()->to('/booking')
                ->with('error', 'Invalid booking parameters. Please try again.');
        }
       
        // Pass data to view
        $data = [
            'checkIn' => $checkIn,
            'checkOut' => $checkOut,
            'adults' => $adults,
            'kids' => $kids ?? 0,
            'nights' => $nights,
            'transactionId' => $transactionId,
            'pricePerNight' => $pricePerNight,
            'cleaningFee' => $cleaningFee,
            'totalPrice' => $totalPrice,
            'userId' => $userId
        ];
       
        return view('user/booking_review', $data);
    }


    /**
 * Show booking success page
 */
public function success()
{
    $bookingId = $this->request->getGet('id');
    $transactionId = $this->request->getGet('transaction_id');
    $total = $this->request->getGet('total');
   
    if (!$bookingId) {
        return redirect()->to('/bookings')->with('error', 'Invalid booking');
    }
   
    // Get booking details from database
    $builder = $this->db->table('bookings');
    $booking = $builder->where('id', $bookingId)->get()->getRowArray();
   
    if (!$booking) {
        return redirect()->to('/bookings')->with('error', 'Booking not found');
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
        'created_at' => date('M d, Y h:i A', strtotime($booking['created_at']))
    ];
   
    return view('user/booking_success', $data);
}


    // ============================================
    // PRIVATE HELPER METHODS (MISSING METHODS)
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

        // Validate number of guests
        $adults = (int)$data['adults'];
        $kids = isset($data['kids']) ? (int)$data['kids'] : 0;


        if ($adults < 1) {
            return [
                'valid' => false,
                'message' => 'At least one adult is required'
            ];
        }

        if ($adults > 10) {
            return [
                'valid' => false,
                'message' => 'Maximum 10 adults allowed'
            ];
        }

        if ($kids < 0) {
            return [
                'valid' => false,
                'message' => 'Number of kids cannot be negative'
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
        $builder->whereNotIn('status', ['cancelled', 'rejected']);
        $builder->groupStart()
            ->where("(check_in <= '$checkIn' AND check_out > '$checkIn')")
            ->orWhere("(check_in < '$checkOut' AND check_out >= '$checkOut')")
            ->orWhere("(check_in >= '$checkIn' AND check_out <= '$checkOut')")
            ->groupEnd();


        return $builder->countAllResults() > 0;
    }


    /**
     * Check conflicts excluding specific booking (for updates)
     */
    private function checkBookingConflictExcluding($checkIn, $checkOut, $excludeId)
    {
        $builder = $this->db->table('bookings');
        $builder->where('property_id', 1);
        $builder->where('id !=', $excludeId);
        $builder->whereNotIn('status', ['cancelled', 'rejected']);
        $builder->groupStart()
            ->where("(check_in <= '$checkIn' AND check_out > '$checkIn')")
            ->orWhere("(check_in < '$checkOut' AND check_out >= '$checkOut')")
            ->orWhere("(check_in >= '$checkIn' AND check_out <= '$checkOut')")
            ->groupEnd();


        return $builder->countAllResults() > 0;
    }
}
