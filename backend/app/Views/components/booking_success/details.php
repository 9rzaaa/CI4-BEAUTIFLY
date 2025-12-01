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
