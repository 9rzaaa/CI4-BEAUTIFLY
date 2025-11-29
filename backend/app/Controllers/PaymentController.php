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
     * Process payment (improved implementation)
     */
    public function processPayment()
    {
        $json = $this->request->getJSON(true);

        $bookingId = $json['booking_id'] ?? null;
        $paymentMethod = $json['payment_method'] ?? 'gcash';

        // Validate input
        if (!$bookingId) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(['success' => false, 'error' => 'Booking ID is required']);
        }

        if (!in_array($paymentMethod, ['gcash', 'paymaya', 'qrph'])) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(['success' => false, 'error' => 'Invalid payment method']);
        }

        // Get booking details
        $bookingBuilder = $this->db->table('bookings');
        $booking = $bookingBuilder->where('id', $bookingId)
            ->where('status', 'pending')
            ->get()
            ->getRowArray();

        if (!$booking) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON(['success' => false, 'error' => 'Booking not found or already processed']);
        }

        // Check for existing payment attempt
        $paymentBuilder = $this->db->table('payments');
        $existingPayment = $paymentBuilder->where('booking_id', $bookingId)
            ->where('status', 'completed')
            ->get()
            ->getRowArray();

        if ($existingPayment) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(['success' => false, 'error' => 'Payment already processed for this booking']);
        }

        // Generate transaction ID
        $transactionId = $this->generateTransactionId($paymentMethod);

        // Simulate payment processing delay (remove in production)
        sleep(1);

        // Simulate payment gateway response (95% success rate for demo)
        $paymentSuccess = $this->simulatePaymentGateway($paymentMethod, $booking['total_price']);

        if ($paymentSuccess) {
            // Begin transaction
            $this->db->transStart();

            try {
                // Update booking status
                $bookingBuilder->where('id', $bookingId)->update([
                    'status' => 'confirmed',
                    'payment_status' => 'paid',
                    'payment_method' => $paymentMethod,
                    'transaction_id' => $transactionId,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

                // Insert payment record
                $paymentData = [
                    'booking_id' => $bookingId,
                    'user_id' => $booking['user_id'],
                    'transaction_id' => $transactionId,
                    'payment_method' => $paymentMethod,
                    'amount' => $booking['total_price'],
                    'currency' => 'PHP',
                    'status' => 'completed',
                    'payment_details' => json_encode([
                        'gateway' => $this->getGatewayName($paymentMethod),
                        'method' => $paymentMethod,
                        'processed_at' => date('Y-m-d H:i:s'),
                        'ip_address' => $this->request->getIPAddress()
                    ]),
                    'notes' => 'Payment processed successfully',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                $paymentBuilder->insert($paymentData);

                // Complete transaction
                $this->db->transComplete();

                if ($this->db->transStatus() === false) {
                    throw new \Exception('Database transaction failed');
                }

                log_message('info', "Payment successful for booking #{$bookingId}, Transaction: {$transactionId}");

                return $this->response->setJSON([
                    'success' => true,
                    'transaction_id' => $transactionId,
                    'message' => 'Payment processed successfully',
                    'booking_id' => $bookingId,
                    'amount' => $booking['total_price'],
                    'payment_method' => $paymentMethod
                ]);
            } catch (\Exception $e) {
                $this->db->transRollback();
                log_message('error', "Payment transaction error: " . $e->getMessage());

                return $this->response
                    ->setStatusCode(500)
                    ->setJSON(['success' => false, 'error' => 'Payment processing error. Please try again.']);
            }
        } else {
            // Payment failed
            $errorCode = 'DECLINED_' . rand(100, 999);
            $errorMessage = $this->getPaymentErrorMessage($paymentMethod);

            // Update booking payment status
            $bookingBuilder->where('id', $bookingId)->update([
                'payment_status' => 'failed',
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            // Record failed payment
            $paymentData = [
                'booking_id' => $bookingId,
                'user_id' => $booking['user_id'],
                'transaction_id' => $transactionId,
                'payment_method' => $paymentMethod,
                'amount' => $booking['total_price'],
                'currency' => 'PHP',
                'status' => 'failed',
                'payment_details' => json_encode([
                    'error' => $errorMessage,
                    'error_code' => $errorCode,
                    'gateway' => $this->getGatewayName($paymentMethod),
                    'failed_at' => date('Y-m-d H:i:s')
                ]),
                'notes' => 'Payment declined by gateway',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            $paymentBuilder->insert($paymentData);

            log_message('error', "Payment failed for booking #{$bookingId}, Error: {$errorCode}");

            return $this->response
                ->setStatusCode(402)
                ->setJSON([
                    'success' => false,
                    'error' => $errorMessage,
                    'error_code' => $errorCode
                ]);
        }
    }

    /**
     * Get payment details by booking ID
     */
    public function getPaymentDetails($bookingId)
    {
        if (!$bookingId) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(['error' => 'Booking ID is required']);
        }

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

        // Decode JSON fields
        $payment['payment_details'] = json_decode($payment['payment_details'], true);

        return $this->response->setJSON(['success' => true, 'payment' => $payment]);
    }

    /**
     * Refund payment
     */
    public function refundPayment($bookingId = null)
    {
        if (!$bookingId) {
            $json = $this->request->getJSON(true);
            $bookingId = $json['booking_id'] ?? null;
        }

        if (!$bookingId) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(['success' => false, 'error' => 'Booking ID is required']);
        }

        // Get booking
        $bookingBuilder = $this->db->table('bookings');
        $booking = $bookingBuilder->where('id', $bookingId)
            ->where('payment_status', 'paid')
            ->get()
            ->getRowArray();

        if (!$booking) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON(['success' => false, 'error' => 'Booking not found or not eligible for refund']);
        }

        // Get original payment
        $paymentBuilder = $this->db->table('payments');
        $payment = $paymentBuilder->where('booking_id', $bookingId)
            ->where('status', 'completed')
            ->get()
            ->getRowArray();

        if (!$payment) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON(['success' => false, 'error' => 'Payment record not found']);
        }

        // Check if already refunded
        if ($payment['status'] === 'refunded') {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(['success' => false, 'error' => 'Payment already refunded']);
        }

        // Generate refund ID
        $refundId = 'RFND' . time() . rand(1000, 9999);

        // Begin transaction
        $this->db->transStart();

        try {
            // Update booking
            $bookingBuilder->where('id', $bookingId)->update([
                'payment_status' => 'refunded',
                'status' => 'cancelled',
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            // Update payment record
            $paymentBuilder->where('id', $payment['id'])->update([
                'status' => 'refunded',
                'refund_id' => $refundId,
                'refund_amount' => $booking['total_price'],
                'refund_reason' => 'Customer requested cancellation',
                'refunded_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            $this->db->transComplete();

            if ($this->db->transStatus() === false) {
                throw new \Exception('Refund transaction failed');
            }

            log_message('info', "Refund processed for booking #{$bookingId}, Refund ID: {$refundId}");

            return $this->response->setJSON([
                'success' => true,
                'refund_id' => $refundId,
                'message' => 'Refund processed successfully',
                'amount' => $booking['total_price']
            ]);
        } catch (\Exception $e) {
            $this->db->transRollback();
            log_message('error', "Refund error: " . $e->getMessage());

            return $this->response
                ->setStatusCode(500)
                ->setJSON(['success' => false, 'error' => 'Refund processing failed']);
        }
    }

    /**
     * Generate unique transaction ID
     */
    private function generateTransactionId($paymentMethod)
    {
        $prefix = [
            'gcash' => 'GC',
            'paymaya' => 'PM',
            'qrph' => 'QR'
        ];

        return ($prefix[$paymentMethod] ?? 'TXN') . time() . rand(1000, 9999);
    }

    /**
     * Simulate payment gateway (for demo purposes)
     * In production, replace with actual gateway integration
     */
    private function simulatePaymentGateway($method, $amount)
    {
        // 95% success rate for demo
        return rand(1, 100) <= 95;
    }

    /**
     * Get gateway name based on payment method
     */
    private function getGatewayName($method)
    {
        $gateways = [
            'gcash' => 'GCash Payment Gateway',
            'paymaya' => 'Maya Payment Gateway',
            'qrph' => 'QR Ph Payment Gateway'
        ];

        return $gateways[$method] ?? 'Payment Gateway';
    }

    /**
     * Get user-friendly error message
     */
    private function getPaymentErrorMessage($method)
    {
        $messages = [
            'gcash' => 'GCash payment was declined. Please check your account balance and try again.',
            'paymaya' => 'Maya payment failed. Please verify your account and try again.',
            'qrph' => 'QR Ph payment was declined. Please check your QR Ph account and try again.'
        ];

        return $messages[$method] ?? 'Payment was declined. Please try again or use a different payment method.';
    }
}
