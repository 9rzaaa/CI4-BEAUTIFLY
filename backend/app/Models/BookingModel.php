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
    // Get single booking with property details
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
