<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table            = 'bookings';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'property_id',
        'user_id',
        'check_in',
        'check_out',
        'adults',
        'kids',
        'number_of_nights',
        'price_per_night',
        'cleaning_fee',
        'total_price',
        'status',
        'payment_status',
        'payment_method',
        'transaction_id',
        'special_requests'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * Get all bookings for a specific user with property details
     */
    public function getUserBookingsWithProperty($userId, $status = null)
    {
        $builder = $this->db->table('bookings b');
        $builder->select('b.*, p.name as property_name, p.description as property_description, p.image as property_image');
        $builder->join('properties p', 'p.id = b.property_id', 'left');
        $builder->where('b.user_id', $userId);
        
        if ($status) {
            $builder->where('b.status', $status);
        }
        
        $builder->orderBy('b.created_at', 'DESC');
        
        return $builder->get()->getResultArray();
    }
    /**
     * Get single booking with property details
     */
    public function getBookingWithProperty($bookingId, $userId = null)
    {
        $builder = $this->db->table('bookings b');
        $builder->select('b.*, p.name as property_name, p.description as property_description, p.image as property_image, p.location as property_location');
        $builder->join('properties p', 'p.id = b.property_id', 'left');
        $builder->where('b.id', $bookingId);
        
        if ($userId) {
            $builder->where('b.user_id', $userId);
        }
        
        return $builder->get()->getRowArray();
    }

    // Get upcoming bookings (check-in date is in the future)
    public function getUpcomingBookings($userId)
    {
        $builder = $this->db->table('bookings b');
        $builder->select('b.*, p.name as property_name, p.image as property_image');
        $builder->join('properties p', 'p.id = b.property_id', 'left');
        $builder->where('b.user_id', $userId);
        $builder->where('b.check_in >', date('Y-m-d'));
        $builder->where('b.status', 'confirmed');
        $builder->orderBy('b.check_in', 'ASC');
        
        return $builder->get()->getResultArray();
    }

    //  Get completed bookings (check-out date has passed)
    public function getCompletedBookings($userId)
    {
        $builder = $this->db->table('bookings b');
        $builder->select('b.*, p.name as property_name, p.image as property_image');
        $builder->join('properties p', 'p.id = b.property_id', 'left');
        $builder->where('b.user_id', $userId);
        $builder->where('b.check_out <', date('Y-m-d'));
        $builder->whereIn('b.status', ['confirmed', 'completed']);
        $builder->orderBy('b.check_out', 'DESC');
        
        return $builder->get()->getResultArray();
    }

// get cancelled bookings
    public function getCancelledBookings($userId)
    {
        $builder = $this->db->table('bookings b');
        $builder->select('b.*, p.name as property_name, p.image as property_image');
        $builder->join('properties p', 'p.id = b.property_id', 'left');
        $builder->where('b.user_id', $userId);
        $builder->where('b.status', 'cancelled');
        $builder->orderBy('b.updated_at', 'DESC');
        
        return $builder->get()->getResultArray();
    }

    // Cancel booking with refund calculation
     // Returns: ['success' => bool, 'refund_amount' => float, 'refund_percentage' => int, 'message' => string]
    public function cancelBooking($bookingId, $userId)
    {
        $booking = $this->where('id', $bookingId)
                        ->where('user_id', $userId)
                        ->first();

        if (!$booking) {
            return [
                'success' => false,
                'message' => 'Booking not found'
            ];
        }

        if ($booking['status'] === 'cancelled') {
            return [
                'success' => false,
                'message' => 'Booking is already cancelled'
            ];
        }

        if ($booking['status'] === 'completed') {
            return [
                'success' => false,
                'message' => 'Cannot cancel completed booking'
            ];
        }

        // Calculate refund based on cancellation policy
        $refundData = $this->calculateRefund($booking);

        // Update booking status
        $updateData = [
            'status' => 'cancelled',
            'updated_at' => date('Y-m-d H:i:s')
        ];

        // If there's a refund, update payment status
        if ($refundData['refund_amount'] > 0) {
            $updateData['payment_status'] = 'refunded';
        }

        $this->update($bookingId, $updateData);

        return [
            'success' => true,
            'refund_amount' => $refundData['refund_amount'],
            'refund_percentage' => $refundData['refund_percentage'],
            'message' => $refundData['message']
        ];
    }
   // Calculate refund amount based on cancellation policy
    private function calculateRefund($booking)
    {
        $totalPrice = $booking['total_price'];
        $bookingDate = new \DateTime($booking['created_at']);
        $checkInDate = new \DateTime($booking['check_in']);
        $today = new \DateTime();

        // Calculate hours since booking
        $hoursSinceBooking = $today->diff($bookingDate)->days * 24 + $today->diff($bookingDate)->h;
        
        // Calculate days until check-in
        $daysUntilCheckIn = $today->diff($checkInDate)->days;

        // Full refund within 48 hours of booking
        if ($hoursSinceBooking <= 48) {
            return [
                'refund_amount' => $totalPrice,
                'refund_percentage' => 100,
                'message' => 'Full refund - Cancelled within 48 hours of booking'
            ];
        }

        // 50% refund if 7+ days before check-in
        if ($daysUntilCheckIn >= 7) {
            return [
                'refund_amount' => $totalPrice * 0.5,
                'refund_percentage' => 50,
                'message' => '50% refund - Cancelled 7+ days before check-in'
            ];
        }

        // No refund within 7 days of check-in
        return [
            'refund_amount' => 0,
            'refund_percentage' => 0,
            'message' => 'No refund - Cancelled within 7 days of check-in'
        ];
    } 