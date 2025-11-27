boc
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

        // Get property details from database
        $propertyBuilder = $this->db->table('properties');
        $property = $propertyBuilder->where('id', 1)->get()->getRowArray();

        if (!$property) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON(['error' => 'Property not found']);
        }

        // Calculate pricing
        $checkIn = new \DateTime($json['check_in']);
        $checkOut = new \DateTime($json['check_out']);
        $nights = $checkOut->diff($checkIn)->days;
        $pricePerNight = $property['price_per_night']; // From database
        $cleaningFee = $property['cleaning_fee']; // From database
        $totalPrice = ($nights * $pricePerNight) + $cleaningFee;

        // Generate transaction ID
        $transactionId = $json['transaction_id'] ?? 'TXN' . time() . rand(1000, 9999);

        // Insert booking
        $data = [
            'user_id' => session()->get('user_id') ?? 2, // Default to guest user
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
            'payment_method' => $json['payment_method'] ?? null,
            'transaction_id' => $transactionId,
            'special_requests' => $json['special_requests'] ?? null,
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
            'price_per_night' => $pricePerNight,
            'cleaning_fee' => $cleaningFee,
            'nights' => $nights,
            'transaction_id' => $transactionId,
            'message' => 'Booking created successfully'
        ]);
    }

    /** Update booking */
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

    // Check conflicts excluding specific booking
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
} 
