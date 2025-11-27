<!DOCTYPE html>
<html lang="en">

<?= view('components/head') ?>

<style>
    .bg-accent { background-color: #73AF6F; }
    .text-accent { color: #73AF6F; }
    .bg-primary-dark { background-color: #2F5233; }
    .bg-secondary-light { background-color: #F8F4E3; }

/* Square logo containers */
.payment-logo-option {
    width: 100%;
    /* Reduced height to make logo area smaller, improving overall balance */
    height: 100px; 
    padding: 10px;
    border: 2px solid #E0DBCF;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.2s;
    display: flex;
    justify-content: center;
    align-items: center;
    background: white;
    /* Added flex column for text/logo stacking */
    flex-direction: column; 
    text-align: center;
}

.payment-logo-option:hover {
    border-color: #73AF6F;
}

.payment-logo-option.selected {
    border-color: #2F5233;
    box-shadow: 0 0 0 3px rgba(47, 82, 51, 0.4);
}

.payment-logo-option img {
    /* Adjusted image size to fit better with text and reduced container height */
    width: 80%;
    max-height: 40px; 
    object-fit: contain;
    margin-bottom: 4px;
}

.payment-logo-option input[type="radio"] {
    display: none;
}

    .btn-pulse:hover {
        animation: pulse-shadow 1.5s infinite;
    }

    @keyframes pulse-shadow {
        0%, 100% { box-shadow: 0 0 0 0 rgba(115, 175, 111, 0.7); }
        50% { box-shadow: 0 0 0 15px rgba(115, 175, 111, 0); }
    }
</style>

<body class="bg-secondary-light min-h-screen text-gray-900">

<div class="bg-accent h-3"></div>

<?= view('components/header', ['active' => 'Home']) ?>

<main class="py-16">
    <div class="w-full max-w-7xl mx-auto bg-white shadow-2xl p-10 rounded-xl">

        <a href="/user/booking-form"
           class="flex items-center mb-6 font-semibold text-accent hover:text-primary-dark transition-all hover:scale-105">
            <svg class="mr-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path
                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Booking
        </a>

        <h3 class="mb-12 pb-3 border-b-2 border-accent font-extrabold text-primary-dark text-4xl text-center">
            Confirm & Pay
        </h3>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

            <div class="w-full space-y-8">

                <div>
                    <h4 class="mb-3 font-bold text-primary-dark text-xl">Reservation Summary</h4>

                    <div class="space-y-4 bg-secondary-light shadow-inner p-5 border rounded-lg">
                        <div class="flex justify-between pb-2 border-b">
                            <span class="font-semibold">Transaction ID:</span>
                            <span id="modalTransactionId" class="font-bold text-red-500"></span>
                        </div>
                        <div class="flex justify-between pb-2 border-b">
                            <span class="font-semibold">Check-in Date:</span>
                            <span id="modalCheckIn" class="font-bold text-primary-dark"></span>
                        </div>
                        <div class="flex justify-between pb-2 border-b">
                            <span class="font-semibold">Check-out Date:</span>
                            <span id="modalCheckOut" class="font-bold text-primary-dark"></span>
                        </div>
                        <div class="flex justify-between pb-2 border-b">
                            <span class="font-semibold">Nights:</span>
                            <span id="modalNights" class="font-bold text-primary-dark"></span>
                        </div>
                        <div class="flex justify-between pb-2 border-b">
                            <span class="font-semibold">Guests:</span>
                            <span id="modalGuests" class="font-bold text-primary-dark"></span>
                        </div>
                        <div class="flex justify-between pb-2 border-b">
                            <span class="font-semibold">Price per night:</span>
                            <span class="font-extrabold text-green-700 text-lg">₱<span id="modalPricePerNight"></span></span>
                        </div>

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

                <div class="mt-10">
                    <h4 class="mb-3 font-bold text-primary-dark text-xl">Special Requests / Notes</h4>
                    <textarea id="specialRequests"
                              class="w-full p-3 border-2 border-gray-300 rounded-lg shadow-sm focus:border-accent focus:ring-accent/50"
                              rows="4"
                              placeholder="Any special requests (optional)..."></textarea>
                </div>

            </div>

            <div class="w-full flex flex-col justify-start">

                <div>
                    <h4 class="mb-3 font-bold text-primary-dark text-xl">Important Policies</h4>

                    <div class="bg-red-50 shadow-md mb-6 p-4 border-t-4 border-red-600 rounded-lg">
                        <p class="mb-2 font-bold text-red-700">Cancellation Policy (Strict)</p>
                        <ul class="ml-6 text-gray-700 text-sm list-disc">
                            <li>Full refund within 48 hours...</li>
                            <li>50% refund 7 days before check-in.</li>
                            <li>No refund within 7 days.</li>
                        </ul>
                    </div>

                    <div class="bg-secondary-light shadow-md p-4 border-t-4 border-accent rounded-lg">
                        <p class="mb-2 font-bold text-primary-dark">Check-in & Check-out Policies</p>
                        <ul class="ml-6 text-gray-700 text-sm list-disc">
                            <li>Check-in: 4:00 PM</li>
                            <li>Check-out: 10:00 AM</li>
                            <li>Self check-in code sent 3:30 PM</li>
                            <li>Early check-in fee: ₱800</li>
                            <li>Late check-out penalty: ₱800 up to 12 PM</li>
                        </ul>
                    </div>
                </div>

                <div class="mt-8"> 
                    <h4 class="mb-2 font-bold text-primary-dark text-xl">Select Payment Method</h4>
                    <div id="payment-logos" class="grid grid-cols-3 gap-3">
                        <label class="payment-logo-option selected" data-value="gcash">
                            <input type="radio" name="paymentMethod" value="gcash" checked>
                            <img src="https://upload.wikimedia.org/wikipedia/en/thumb/5/5a/GCash_logo.svg/1200px-GCash_logo.svg.png">
                            <span class="text-xs font-semibold text-primary-dark">GCash (Recommended)</span>
                        </label>
                        <label class="payment-logo-option" data-value="paymaya">
                            <input type="radio" name="paymentMethod" value="paymaya">
                            <img src="https://www.maya.ph/assets/images/header/maya-logo-2023.svg">
                            <span class="text-xs font-semibold text-primary-dark">Maya (PayMaya)</span>
                        </label>
                        <label class="payment-logo-option" data-value="visa">
                            <input type="radio" name="paymentMethod" value="visa">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg">
                            <span class="text-xs font-semibold text-primary-dark">Credit/Debit Card</span>
                        </label>
                    </div>
                </div>

            </div>
        </div>
        <hr class="border-gray-300 my-8">

        <div class="mt-8 text-center">
            <button id="proceedToPayment"
                    class="btn-pulse bg-accent hover:bg-accent/90 shadow-xl px-12 py-3 rounded-lg font-bold text-white text-lg hover:scale-105 transition-all">
                Proceed to Payment
            </button>
        </div>
    </div>
</main>


    <script>
        // Helper function to format currency (unchanged)
        function formatCurrency(amount) {
            return new Intl.NumberFormat('en-PH', { style: 'decimal', minimumFractionDigits: 2 }).format(amount);
        }

        // Function to extract query parameters (unchanged)
        function getQueryParams() {
            const params = {};
            const queryString = window.location.search.substring(1);
            const regex = /([^&=]+)=([^&]*)/g;
            let m;
            while (m = regex.exec(queryString)) {
                params[decodeURIComponent(m[1])] = decodeURIComponent(m[2]);
            }
            return params;
        }

        // Populate details from URL query parameters (unchanged logic)
        function populateBookingDetails() {
            const params = getQueryParams();
            
            const PRICE_PER_NIGHT = parseFloat(params.pricePerNight) || 0;
            const CLEANING_FEE = parseFloat(params.cleaningFee) || 0;
            const totalPrice = parseFloat(params.totalPrice) || 0;

            const checkIn = params.checkIn;
            const checkOut = params.checkOut;
            const adults = params.adults || '1';
            const kids = params.kids || '0';
            const nights = parseInt(params.nights) || 0;
            
            if (checkIn && checkOut && nights > 0 && totalPrice > 0) {
                
                const checkInDate = new Date(checkIn).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
                const checkOutDate = new Date(checkOut).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });

                // Populate Summary Fields
                document.getElementById("modalTransactionId").textContent = params.transactionId || 'N/A';
                document.getElementById("modalCheckIn").textContent = checkInDate;
                document.getElementById("modalCheckOut").textContent = checkOutDate;
                document.getElementById("modalNights").textContent = `${nights} night${nights > 1 ? 's' : ''}`;
                document.getElementById("modalGuests").textContent = `${adults} Adult${adults > 1 ? 's' : ''}, ${kids} Kid${kids > 1 ? 's' : ''}`;
                
                // Populate Price Fields
                document.getElementById("modalPricePerNight").textContent = formatCurrency(PRICE_PER_NIGHT);
                document.getElementById("modalCleaningFee").textContent = formatCurrency(CLEANING_FEE);
                document.getElementById("modalTotalPrice").textContent = formatCurrency(totalPrice);
                
                // Store core data for payment processing
                document.getElementById("proceedToPayment").dataset.bookingData = JSON.stringify({
                    check_in: checkIn,
                    check_out: checkOut,
                    adults: parseInt(adults),
                    kids: parseInt(kids),
                    transaction_id: params.transactionId,
                    total_amount: totalPrice
                });

            } else {
                alert("Booking details are missing. Redirecting back to the booking page.");
                window.location.href = '/user/booking-form'; 
            }
        }
        
        populateBookingDetails();
        
        document.querySelectorAll('.payment-logo-option').forEach(label => {
            label.addEventListener('click', (event) => {
                document.querySelectorAll('.payment-logo-option').forEach(opt => {
                    opt.classList.remove('selected');
                });
                const currentLabel = event.currentTarget;
                currentLabel.classList.add('selected');
                
                const radioInput = currentLabel.querySelector('input[type="radio"]');
                if (radioInput) {
                    radioInput.checked = true;
                }
            });
        });

        document.getElementById('proceedToPayment').addEventListener('click', async (e) => {
            const btn = e.currentTarget;
            const selectedPayment = document.querySelector('input[name="paymentMethod"]:checked').value;
            let bookingData = JSON.parse(btn.dataset.bookingData);
            
            const specialRequests = document.getElementById('specialRequests').value.trim();
            
            bookingData.payment_method = selectedPayment;
            bookingData.special_requests = specialRequests || null;
            
            btn.disabled = true;
            btn.textContent = 'Processing Booking...';

            try {
                // STEP 1: Create booking
                const bookingResponse = await fetch('/api/bookings/create', { method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify(bookingData) });
                const bookingResult = await bookingResponse.json();

                if (!bookingResponse.ok || !bookingResult.success) { throw new Error(bookingResult.error || 'Booking creation failed'); }

                // STEP 2: Process payment
                btn.textContent = 'Processing Payment...';

                const paymentResponse = await fetch('/api/payments/process', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ booking_id: bookingResult.booking_id, payment_method: selectedPayment, amount: bookingData.total_amount })
                });

                const paymentResult = await paymentResponse.json();

                if (paymentResponse.ok && paymentResult.success) {
                    alert(`Payment Successful! 🎉\n\nBooking ID: ${bookingResult.booking_id}...\n\nYour booking is confirmed!`);
                    window.location.href = '/booking-confirmation?id=' + bookingResult.booking_id;
                } else {
                    alert(`Payment Failed ❌\n\n${paymentResult.error || 'Payment was declined.'}\n\nBooking created but not confirmed.`);
                }
            } catch (error) {
                console.error('Error:', error);
                alert(`Error: ${error.message}\n\nPlease try again or contact support.`);
            } finally {
                btn.disabled = false;
                btn.textContent = 'Proceed to Payment';
            }
        });
    </script>
    
    <?= view('components/footer') ?>

</body>
</html>