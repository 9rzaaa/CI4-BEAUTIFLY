<!DOCTYPE html>
<html lang="en">


<?= view('components/head') ?>


<style>
    .bg-accent {
        background-color: #73AF6F;
    }


    .text-accent {
        color: #73AF6F;
    }


    .bg-primary-dark {
        background-color: #2F5233;
    }


    .bg-secondary-light {
        background-color: #F8F4E3;
    }


    .success-checkmark {
        width: 80px;
        height: 80px;
        margin: 0 auto;
    }


    .checkmark-circle {
        stroke-dasharray: 166;
        stroke-dashoffset: 166;
        stroke-width: 2;
        stroke-miterlimit: 10;
        stroke: #73AF6F;
        fill: none;
        animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
    }


    .checkmark-check {
        transform-origin: 50% 50%;
        stroke-dasharray: 48;
        stroke-dashoffset: 48;
        stroke: #73AF6F;
        animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
    }


    @keyframes stroke {
        100% {
            stroke-dashoffset: 0;
        }
    }


    @keyframes scale {


        0%,
        100% {
            transform: none;
        }


        50% {
            transform: scale3d(1.1, 1.1, 1);
        }
    }


    @keyframes fill {
        100% {
            box-shadow: inset 0px 0px 0px 30px #73AF6F;
        }
    }


    .fade-in {
        animation: fadeIn 0.6s ease-in;
    }


    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }


        to {
            opacity: 1;
            transform: translateY(0);
        }
    }


    @media print {
        .no-print {
            display: none;
        }


        body {
            background: white !important;
        }
    }
</style>


<body class="bg-secondary-light min-h-screen text-gray-900">


    <div class="bg-accent h-3 no-print"></div>


    <?= view('components/header', ['active' => 'Home']) ?>


    <main class="py-16">
        <div class="mx-auto px-4 max-w-4xl">


            <!-- Success Card -->
            <div class="bg-white shadow-2xl p-8 md:p-12 rounded-2xl text-center fade-in">


                <!-- Animated Checkmark -->
                <div class="mb-6 success-checkmark">
                    <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                        <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none" />
                        <path class="checkmark-check" fill="none" stroke-width="3" stroke-linecap="round" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
                    </svg>
                </div>


                <!-- Success Message -->
                <h1 class="mb-3 font-extrabold text-primary-dark text-4xl md:text-5xl">
                    Booking Confirmed! 🎉
                </h1>
                <p class="mb-2 text-gray-600 text-lg">
                    Your reservation has been successfully confirmed.
                </p>
                <p class="mb-8 text-gray-500">
                    A confirmation email has been sent to your registered email address.
                </p>


                <!-- Transaction ID Badge -->
                <div class="inline-block bg-accent/10 mb-8 px-6 py-3 border-2 border-accent rounded-lg">
                    <p class="mb-1 text-gray-600 text-sm">Transaction ID</p>
                    <p class="font-bold text-accent text-2xl"><?= esc($transaction_id) ?></p>
                </div>


                <!-- Booking Details -->
                <div class="bg-secondary-light mb-8 p-6 rounded-xl text-left">
                    <h3 class="mb-4 font-bold text-primary-dark text-xl text-center">Reservation Details</h3>


                    <div class="gap-4 grid grid-cols-1 md:grid-cols-2">
                        <div class="flex justify-between pb-3 border-gray-300 border-b">
                            <span class="font-semibold text-gray-700">Check-in:</span>
                            <span class="font-bold text-primary-dark"><?= esc($check_in) ?></span>
                        </div>


                        <div class="flex justify-between pb-3 border-gray-300 border-b">
                            <span class="font-semibold text-gray-700">Check-out:</span>
                            <span class="font-bold text-primary-dark"><?= esc($check_out) ?></span>
                        </div>


                        <div class="flex justify-between pb-3 border-gray-300 border-b">
                            <span class="font-semibold text-gray-700">Nights:</span>
                            <span class="font-bold text-primary-dark"><?= esc($nights) ?> night<?= $nights > 1 ? 's' : '' ?></span>
                        </div>


                        <div class="flex justify-between pb-3 border-gray-300 border-b">
                            <span class="font-semibold text-gray-700">Guests:</span>
                            <span class="font-bold text-primary-dark"><?= esc($adults) ?> Adult<?= $adults > 1 ? 's' : '' ?>, <?= esc($kids) ?> Kid<?= $kids > 1 ? 's' : '' ?></span>
                        </div>


                        <div class="flex justify-between pb-3 border-gray-300 border-b">
                            <span class="font-semibold text-gray-700">Payment Method:</span>
                            <span class="font-bold text-primary-dark"><?= esc($payment_method) ?></span>
                        </div>


                        <div class="flex justify-between pb-3 border-gray-300 border-b">
                            <span class="font-semibold text-gray-700">Booked On:</span>
                            <span class="font-bold text-primary-dark"><?= esc($created_at) ?></span>
                        </div>
                    </div>


                    <!-- Total Amount -->
                    <div class="mt-6 pt-4 border-accent border-t-2">
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-gray-700 text-xl">Total Amount Paid:</span>
                            <span class="font-extrabold text-accent text-3xl">₱<?= esc($total_price) ?></span>
                        </div>
                    </div>
                </div>


                <!-- Important Information -->
                <div class="bg-blue-50 mb-8 p-5 border-blue-500 border-l-4 rounded-lg text-left">
                    <h4 class="flex items-center mb-3 font-bold text-blue-900">
                        <svg class="mr-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                        Important Reminders
                    </h4>
                    <ul class="space-y-2 text-gray-700 text-sm">
                        <li>✓ Check-in time: <strong>4:00 PM</strong></li>
                        <li>✓ Check-out time: <strong>10:00 AM</strong></li>
                        <li>✓ Self check-in code will be sent at <strong>3:30 PM</strong> on your check-in date</li>
                        <li>✓ Please bring a valid ID for verification</li>
                        <li>✓ For any changes or cancellations, contact us at least 48 hours in advance</li>
                    </ul>
                </div>


                <!-- Action Buttons -->
                <div class="flex md:flex-row flex-col justify-center gap-4 no-print">
                    <button onclick="window.print()" class="flex justify-center items-center bg-primary-dark hover:bg-[#1E3722] shadow-lg px-8 py-3 rounded-lg font-bold text-white hover:scale-105 transition-all">
                        <svg class="mr-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                        </svg>
                        Print Confirmation
                    </button>


                    <a href="/user/my-bookings" class="flex justify-center items-center bg-accent hover:bg-accent/90 shadow-lg px-8 py-3 rounded-lg font-bold text-white hover:scale-105 transition-all">
                        <svg class="mr-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        View My Bookings
                    </a>


                    <a href="/" class="flex justify-center items-center bg-gray-200 hover:bg-gray-300 shadow-lg px-8 py-3 rounded-lg font-bold text-gray-700 hover:scale-105 transition-all">
                        <svg class="mr-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Back to Home
                    </a>
                </div>


                <!-- Contact Support -->
                <div class="mt-8 pt-6 border-gray-200 border-t text-center no-print">
                    <p class="mb-2 text-gray-600 text-sm">Need help with your booking?</p>
                    <a href="/contact" class="font-semibold text-accent hover:text-primary-dark underline">
                        Contact Support
                    </a>
                </div>


            </div>


        </div>
    </main>


    <div class="no-print">
        <?= view('components/footer') ?>
    </div>


</body>


</html>
