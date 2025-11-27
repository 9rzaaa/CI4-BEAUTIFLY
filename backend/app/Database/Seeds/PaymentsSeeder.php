<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PaymentsSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $data = [
            // Payment for booking #1 (Confirmed, Paid)
            [
                'booking_id'        => 1,
                'user_id'           => 2,
                'transaction_id'    => 'TXN001234567890',
                'payment_method'    => 'credit_card',
                'amount'            => 10300.00,
                'currency'          => 'PHP',
                'status'            => 'completed',
                'refund_id'         => null,
                'refund_amount'     => null,
                'refund_reason'     => null,
                'refunded_at'       => null,
                'payment_details'   => json_encode([
                    'card_type' => 'Visa',
                    'last_four' => '4242',
                    'gateway' => 'Stripe'
                ]),
                'notes'             => 'Payment processed successfully',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],

            // Payment for booking #3 (Completed, Paid via GCash)
            [
                'booking_id'        => 3,
                'user_id'           => 2,
                'transaction_id'    => 'GCASH987654321',
                'payment_method'    => 'gcash',
                'amount'            => 8300.00,
                'currency'          => 'PHP',
                'status'            => 'completed',
                'refund_id'         => null,
                'refund_amount'     => null,
                'refund_reason'     => null,
                'refunded_at'       => null,
                'payment_details'   => json_encode([
                    'gcash_number' => '0917*****89',
                    'reference_no' => 'GC123456'
                ]),
                'notes'             => 'GCash payment verified',
                'created_at'        => '2025-10-25 14:35:00',
                'updated_at'        => '2025-11-05 11:00:00',
            ],

            // Payment for booking #4 (Cancelled, Refunded)
            [
                'booking_id'        => 4,
                'user_id'           => 2,
                'transaction_id'    => 'TXN555666777888',
                'payment_method'    => 'credit_card',
                'amount'            => 4300.00,
                'currency'          => 'PHP',
                'status'            => 'refunded',
                'refund_id'         => 'RFND' . time() . '1234',
                'refund_amount'     => 4300.00,
                'refund_reason'     => 'Customer requested cancellation',
                'refunded_at'       => '2025-11-22 10:00:00',
                'payment_details'   => json_encode([
                    'card_type' => 'Mastercard',
                    'last_four' => '5555'
                ]),
                'notes'             => 'Full refund processed',
                'created_at'        => '2025-11-20 10:20:00',
                'updated_at'        => '2025-11-22 10:00:00',
            ],

            // Payment for booking #5 (Confirmed, Paid)
            [
                'booking_id'        => 5,
                'user_id'           => 2,
                'transaction_id'    => 'GCASH123456789',
                'payment_method'    => 'gcash',
                'amount'            => 10800.00,
                'currency'          => 'PHP',
                'status'            => 'completed',
                'refund_id'         => null,
                'refund_amount'     => null,
                'refund_reason'     => null,
                'refunded_at'       => null,
                'payment_details'   => json_encode([
                    'gcash_number' => '0917*****89',
                    'reference_no' => 'GC789012'
                ]),
                'notes'             => 'Peak season booking payment',
                'created_at'        => '2025-11-15 16:50:00',
                'updated_at'        => '2025-11-15 17:00:00',
            ],

            // Failed payment example
            [
                'booking_id'        => 2,
                'user_id'           => 2,
                'transaction_id'    => 'TXN' . time() . '9999',
                'payment_method'    => 'credit_card',
                'amount'            => 4300.00,
                'currency'          => 'PHP',
                'status'            => 'failed',
                'refund_id'         => null,
                'refund_amount'     => null,
                'refund_reason'     => null,
                'refunded_at'       => null,
                'payment_details'   => json_encode([
                    'error' => 'Insufficient funds',
                    'error_code' => 'DECLINED_001'
                ]),
                'notes'             => 'Payment declined - insufficient funds',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
        ];

        $this->db->table('payments')->insertBatch($data);
    }
}
