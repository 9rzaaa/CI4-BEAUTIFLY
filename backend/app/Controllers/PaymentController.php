<?php

namespace App\Controllers;

class PaymentController extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    /**
     * Process payment (dummy implementation)
     */
    public function processPayment()
    {
        $json = $this->request->getJSON(true);

        $bookingId = $json['booking_id'] ?? null;
        $paymentMethod = $json['payment_method'] ?? 'credit_card';

        if (!$bookingId) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(['error' => 'Booking ID is required']);
        }

        // Get booking
        $builder = $this->db->table('bookings');
        $booking = $builder->where('id', $bookingId)
            ->where('status', 'pending')
            ->get()
            ->getRowArray();

        if (!$booking) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON(['error' => 'Booking not found or already processed']);
        }

        // Simulate payment processing delay
        sleep(1);

        // Generate dummy transaction ID
        $transactionId = 'TXN' . time() . rand(1000, 9999);

        // Simulate 95% success rate (dummy payment)
        $paymentSuccess = rand(1, 100) <= 95;

        if ($paymentSuccess) {
            // Update booking to confirmed
            $builder->where('id', $bookingId)->update([
                'status' => 'confirmed',
                'payment_status' => 'paid',
                'payment_method' => $paymentMethod,
                'transaction_id' => $transactionId,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            // Log successful payment
            log_message('info', "Payment successful for booking #{$bookingId}, Transaction: {$transactionId}");

            return $this->response->setJSON([
                'success' => true,
                'transaction_id' => $transactionId,
                'message' => 'Payment processed successfully',
                'booking_id' => $bookingId,
                'amount' => $booking['total_price']
            ]);
        } else {
            // Payment failed
            $builder->where('id', $bookingId)->update([
                'payment_status' => 'failed',
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            log_message('error', "Payment failed for booking #{$bookingId}");

            return $this->response
                ->setStatusCode(402)
                ->setJSON([
                    'success' => false,
                    'error' => 'Payment declined. Please check your card details and try again.'
                ]);
        }
    }

    /**
     * Get payment details
     */
    public function getPaymentDetails($bookingId)
    {
        $builder = $this->db->table('bookings');
        $payment = $builder->select('id, transaction_id, payment_method, payment_status, total_price')
            ->where('id', $bookingId)
            ->get()
            ->getRowArray();

        if (!$payment) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON(['error' => 'Payment not found']);
        }

        return $this->response->setJSON(['payment' => $payment]);
    }

    /**
     * Refund payment (dummy)
     */
    public function refundPayment($bookingId)
    {
        $builder = $this->db->table('bookings');
        $booking = $builder->where('id', $bookingId)
            ->where('payment_status', 'paid')
            ->get()
            ->getRowArray();

        if (!$booking) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON(['error' => 'Booking not found or not eligible for refund']);
        }

        // Simulate refund processing
        $refundId = 'RFND' . time() . rand(1000, 9999);

        $builder->where('id', $bookingId)->update([
            'payment_status' => 'refunded',
            'status' => 'cancelled',
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        log_message('info', "Refund processed for booking #{$bookingId}, Refund ID: {$refundId}");

        return $this->response->setJSON([
            'success' => true,
            'refund_id' => $refundId,
            'message' => 'Refund processed successfully',
            'amount' => $booking['total_price']
        ]);
    }
}