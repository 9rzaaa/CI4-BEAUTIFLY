<!DOCTYPE html>
<html lang="en">

<?= view('components/head') ?>

<body class="bg-secondary-light min-h-screen text-gray-900">
    <div class="bg-accent h-3"></div>
    <?= view('components/header', ['active' => 'Home']) ?>

    <main class="py-16">
        <div class="bg-white shadow-2xl mx-auto p-10 rounded-xl w-full max-w-7xl">

            <?= view('components/booking_review/back_button') ?>
            <?= view('components/booking_review/page_header') ?>

            <div class="gap-10 grid grid-cols-1 lg:grid-cols-2">
                <!-- Left Column: Booking Summary -->
                <div class="space-y-8 w-full">
                    <?= view('components/booking_review/reservation_summary', [
                        'transactionId' => $transactionId,
                        'checkInFormatted' => $checkInFormatted,
                        'checkOutFormatted' => $checkOutFormatted,
                        'nights' => $nights,
                        'pricePerNight' => $pricePerNight,
                        'cleaningFee' => $cleaningFee,
                        'totalPrice' => $totalPrice
                    ]) ?>

                    <?= view('components/booking_review/special_requests') ?>
                </div>

                <!-- Right Column: Policies & Payment -->
                <div class="flex flex-col justify-start w-full">
                    <?= view('components/booking_review/policies') ?>
                    <?= view('components/booking_review/payment_methods') ?>
                </div>
            </div>

            <hr class="my-8 border-gray-300">
            <?= view('components/booking_review/payment_button') ?>
        </div>
    </main>

    <?= view('components/booking_review/booking_data', [
        'checkIn' => $checkIn,
        'checkOut' => $checkOut,
        'checkInFormatted' => $checkInFormatted,
        'checkOutFormatted' => $checkOutFormatted,
        'adults' => $adults,
        'kids' => $kids,
        'nights' => $nights,
        'transactionId' => $transactionId,
        'pricePerNight' => $pricePerNight,
        'cleaningFee' => $cleaningFee,
        'totalPrice' => $totalPrice
    ]) ?>
    <?= view('components/booking_review/payment_handler') ?>

    <?= view('components/footer') ?>
</body>

</html>