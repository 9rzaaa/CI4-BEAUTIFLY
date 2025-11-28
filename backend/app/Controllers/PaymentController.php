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
        $bookingBuilder = $this->db->table('bookings');
        $booking = $bookingBuilder->where('id', $bookingId)
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
            $bookingBuilder->where('id', $bookingId)->update([
                'status' => 'confirmed',
                'payment_status' => 'paid',
                'payment_method' => $paymentMethod,
                'transaction_id' => $transactionId,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            // ✅ INSERT INTO PAYMENTS TABLE
            $paymentBuilder = $this->db->table('payments');
            $paymentData = [
                'booking_id' => $bookingId,
                'user_id' => $booking['user_id'],
                'transaction_id' => $transactionId,
                'payment_method' => $paymentMethod,
                'amount' => $booking['total_price'],
                'currency' => 'PHP',
                'status' => 'completed',
                'payment_details' => json_encode([
                    'gateway' => 'Dummy Gateway',
                    'method' => $paymentMethod,
                    'processed_at' => date('Y-m-d H:i:s')
                ]),
                'notes' => 'Payment processed successfully',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            $paymentBuilder->insert($paymentData);

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
            $bookingBuilder->where('id', $bookingId)->update([
                'payment_status' => 'failed',
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            // ✅ INSERT FAILED PAYMENT INTO PAYMENTS TABLE
            $paymentBuilder = $this->db->table('payments');
            $paymentData = [
                'booking_id' => $bookingId,
                'user_id' => $booking['user_id'],
                'transaction_id' => $transactionId,
                'payment_method' => $paymentMethod,
                'amount' => $booking['total_price'],
                'currency' => 'PHP',
                'status' => 'failed',
                'payment_details' => json_encode([
                    'error' => 'Payment declined',
                    'error_code' => 'DECLINED_001'
                ]),
                'notes' => 'Payment declined by gateway',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            $paymentBuilder->insert($paymentData);

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
        $builder = $this->db->table('payments');
        $payment = $builder->where('booking_id', $bookingId)
            ->orderBy('created_at', 'DESC')
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
        $bookingBuilder = $this->db->table('bookings');
        $booking = $bookingBuilder->where('id', $bookingId)
            ->where('payment_status', 'paid')
            ->get()
            ->getRowArray();

        if (!$booking) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON(['error' => 'Booking not found or not eligible for refund']);
        }

        // Get original payment
        $paymentBuilder = $this->db->table('payments');
        $payment = $paymentBuilder->where('booking_id', $bookingId)
            ->where('status', 'completed')
            ->get()
            ->getRowArray();

        // Simulate refund processing
        $refundId = 'RFND' . time() . rand(1000, 9999);

        // Update booking
        $bookingBuilder->where('id', $bookingId)->update([
            'payment_status' => 'refunded',
            'status' => 'cancelled',
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // ✅ UPDATE PAYMENT RECORD WITH REFUND INFO
        if ($payment) {
            $paymentBuilder->where('id', $payment['id'])->update([
                'status' => 'refunded',
                'refund_id' => $refundId,
                'refund_amount' => $booking['total_price'],
                'refund_reason' => 'Customer requested cancellation',
                'refunded_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }

        log_message('info', "Refund processed for booking #{$bookingId}, Refund ID: {$refundId}");

        return $this->response->setJSON([
            'success' => true,
            'refund_id' => $refundId,
            'message' => 'Refund processed successfully',
            'amount' => $booking['total_price']
        ]);
    }
}
