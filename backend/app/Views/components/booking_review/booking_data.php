<script>
    const bookingData = {
        checkIn: '<?= esc($checkIn) ?>',
        checkOut: '<?= esc($checkOut) ?>',
        checkInFormatted: '<?= esc($checkInFormatted) ?>',
        checkOutFormatted: '<?= esc($checkOutFormatted) ?>',
        adults: <?= (int)$adults ?>,
        kids: <?= (int)$kids ?>,
        nights: <?= (int)$nights ?>,
        transactionId: '<?= esc($transactionId) ?>',
        pricePerNight: '<?= $pricePerNight ?>',
        cleaningFee: '<?= $cleaningFee ?>',
        totalPrice: '<?= $totalPrice ?>'
    };

    function populateBookingDetails() {
        if (!bookingData.checkIn || !bookingData.checkOut || bookingData.nights <= 0) {
            alert("Booking details are missing. Redirecting back to the booking page.");
            window.location.href = '/booking';
            return;
        }

        document.getElementById("modalTransactionId").textContent = bookingData.transactionId;
        document.getElementById("modalCheckIn").textContent = bookingData.checkInFormatted;
        document.getElementById("modalCheckOut").textContent = bookingData.checkOutFormatted;
        document.getElementById("modalNights").textContent = `${bookingData.nights} night${bookingData.nights > 1 ? 's' : ''}`;
        document.getElementById("modalGuests").textContent = `${bookingData.adults} Adult${bookingData.adults > 1 ? 's' : ''}, ${bookingData.kids} Kid${bookingData.kids > 1 ? 's' : ''}`;
        document.getElementById("modalPricePerNight").textContent = bookingData.pricePerNight;
        document.getElementById("modalCleaningFee").textContent = bookingData.cleaningFee;
        document.getElementById("modalTotalPrice").textContent = bookingData.totalPrice;
    }

    populateBookingDetails();

    // Payment method selection
    document.querySelectorAll('.payment-logo-option').forEach(label => {
        label.addEventListener('click', (event) => {
            document.querySelectorAll('.payment-logo-option').forEach(opt => {
                opt.classList.remove('selected');
            });
            event.currentTarget.classList.add('selected');
            const radioInput = event.currentTarget.querySelector('input[type="radio"]');
            if (radioInput) radioInput.checked = true;
        });
    });
</script>