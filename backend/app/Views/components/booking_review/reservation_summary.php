<div>
    <h4 class="mb-3 font-bold text-primary-dark text-xl">Reservation Summary</h4>

    <div class="space-y-4 bg-secondary-light shadow-inner p-5 border rounded-lg">
        <?php
        $summaryItems = [
            ['label' => 'Transaction ID:', 'id' => 'modalTransactionId', 'class' => 'text-red-500'],
            ['label' => 'Check-in Date:', 'id' => 'modalCheckIn', 'class' => 'text-primary-dark'],
            ['label' => 'Check-out Date:', 'id' => 'modalCheckOut', 'class' => 'text-primary-dark'],
            ['label' => 'Nights:', 'id' => 'modalNights', 'class' => 'text-primary-dark'],
            ['label' => 'Guests:', 'id' => 'modalGuests', 'class' => 'text-primary-dark'],
            ['label' => 'Price per night:', 'id' => 'modalPricePerNight', 'prefix' => '₱', 'class' => 'text-green-700 text-lg'],
        ];

        foreach ($summaryItems as $item): ?>
            <div class="flex justify-between pb-2 border-b">
                <span class="font-semibold"><?= $item['label'] ?></span>
                <span id="<?= $item['id'] ?>" class="font-bold <?= $item['class'] ?>">
                    <?= $item['prefix'] ?? '' ?>
                </span>
            </div>
        <?php endforeach; ?>

        <div class="flex justify-between">
            <span class="font-semibold">Cleaning Fee:</span>
            <span class="font-extrabold text-green-700 text-lg">₱<span id="modalCleaningFee"></span></span>
        </div>
    </div>
</div>

<div class="flex justify-between bg-primary-dark shadow-xl mt-4 p-5 rounded-lg text-white">
    <span class="font-bold text-xl">Total Payable:</span>
    <span class="font-extrabold text-3xl">₱<span id="modalTotalPrice"></span></span>
</div>