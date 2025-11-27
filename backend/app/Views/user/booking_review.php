<!DOCTYPE html>
<html lang="en">

<?= view('components/head') ?>

<style>
    /* ... (CSS Styles for colors, buttons, and payment selection remain the same) ... */
    .bg-accent { background-color: #73AF6F; }
    .text-accent { color: #73AF6F; }
    .bg-primary-dark { background-color: #2F5233; }
    .bg-secondary-light { background-color: #F8F4E3; }
    
    /* Custom style for payment selection */
    .payment-logo-option {
        padding: 5px;
        border: 2px solid #E0DBCF;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .payment-logo-option:hover {
        border-color: #73AF6F;
    }

    .payment-logo-option.selected {
        border-color: #2F5233;
        box-shadow: 0 0 0 3px rgba(47, 82, 51, 0.5);
    }
    
    .payment-logo-option input[type="radio"] {
        display: none;
    }

    /* Animation for the Proceed button */
    .btn-pulse:hover {
        animation: pulse-shadow 1.5s infinite;
    }

    @keyframes pulse-shadow {
        0%, 100% { box-shadow: 0 0 0 0 rgba(115, 175, 111, 0.7); }
        50% { box-shadow: 0 0 0 15px rgba(115, 175, 111, 0); }
    }
</style>

<body class="bg-secondary-light min-h-screen text-gray-900 transition duration-500">

    <div class="bg-accent h-3"></div>

    <?= view('components/header', ['active' => 'Home']) ?>

    <main class="py-16">
        <div class="shadow-2xl p-8 rounded-xl w-full bg-white transition duration-500 hover:shadow-2xl">

            <a href="/user/booking-form" class="flex items-center mb-6 font-semibold text-accent hover:text-primary-dark transition-colors duration-300 transform hover:scale-105">
                <svg class="mr-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back to Booking
            </a>

            <h3 class="mb-8 pb-3 border-accent border-b-2 font-extrabold text-primary-dark text-4xl text-center">Confirm & Pay</h3>

            <div class="mb-8 max-w-5xl lg:max-w-7xl xl:max-w-full mx-auto">
                <h4 class="mb-3 font-bold text-primary-dark text-xl">Reservation Summary</h4>
                <div class="space-y-4 bg-secondary-light shadow-inner p-5 border border-secondary-light rounded-lg transition duration-300 hover:bg-white/80">
                    <div class="flex justify-between items-center pb-2 border-gray-200 border-b"><span class="font-semibold text-gray-700">Transaction ID:</span><span id="modalTransactionId" class="font-bold text-red-500"></span></div>
                    <div class="flex justify-between items-center pb-2 border-gray-200 border-b"><span class="font-semibold text-gray-700">Check-in Date:</span><span id="modalCheckIn" class="font-bold text-primary-dark"></span></div>
                    <div class="flex justify-between items-center pb-2 border-gray-200 border-b"><span class="font-semibold text-gray-700">Check-out Date:</span><span id="modalCheckOut" class="font-bold text-primary-dark"></span></div>
                    <div class="flex justify-between items-center pb-2 border-gray-200 border-b"><span class="font-semibold text-gray-700">Nights:</span><span id="modalNights" class="font-bold text-primary-dark"></span></div>
                    <div class="flex justify-between items-center pb-2 border-gray-200 border-b"><span class="font-semibold text-gray-700">Guests:</span><span id="modalGuests" class="font-bold text-primary-dark"></span></div>
                    <div class="flex justify-between items-center pb-2 border-gray-200 border-b pt-2"><span class="font-semibold text-gray-700">Price per night:</span><span class="font-extrabold text-green-700 text-lg">₱<span id="modalPricePerNight">0.00</span></span></div>
                    
                    <div class="flex justify-between items-center pt-2"><span class="font-semibold text-gray-700">Cleaning Fee:</span><span class="font-extrabold text-green-700 text-lg">₱<span id="modalCleaningFee">0.00</span></span></div>
                    
                </div>
                
                <div class="flex justify-between items-center bg-primary-dark shadow-lg mt-4 p-4 rounded-lg text-white transition duration-300 transform hover:scale-[1.005]">
                    <span class="font-bold text-xl">Total Payable:</span>
                    <span class="font-extrabold text-total-price text-3xl">₱<span id="modalTotalPrice">0.00</span></span>
                </div>
            </div>

            <hr class="border-gray-300 my-8">

            <div class="mb-8 max-w-3xl mx-auto">
                <h4 class="mb-3 font-bold text-primary-dark text-xl">Select Payment Method</h4>
                <div id="payment-logos" class="gap-3 grid grid-cols-3">
                    <label class="payment-logo-option selected" data-value="gcash">
                        <input type="radio" name="paymentMethod" value="gcash" checked>
                        <img src="https://upload.wikimedia.org/wikipedia/en/thumb/5/5a/GCash_logo.svg/1200px-GCash_logo.svg.png" alt="GCash" class="w-auto h-8 md:h-10 object-contain">
                    </label>
                    <label class="payment-logo-option" data-value="paymaya">
                        <input type="radio" name="paymentMethod" value="paymaya">
                        <img src="https://www.maya.ph/assets/images/header/maya-logo-2023.svg" alt="Maya" class="w-auto h-8 md:h-10 object-contain">
                    </label>
                    <label class="payment-logo-option" data-value="visa">
                        <input type="radio" name="paymentMethod" value="visa">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5e/Visa_Inc._logo.svg/1280px-Visa_Inc._logo.svg.png" alt="Visa" class="w-auto h-8 md:h-10 object-contain">
                    </label>
                </div>
            </div>

            <hr class="border-gray-300 my-8">

            <div class="mb-8 max-w-5xl mx-auto">
                <h4 class="mb-3 font-bold text-primary-dark text-xl">Important Policies</h4>

                <div class="bg-red-50 shadow-md mb-6 p-4 border-red-500 border-t-4 rounded-lg transition duration-300 hover:shadow-lg">
                    <p class="flex items-center mb-2 font-bold text-red-700 text-base">
                        <svg class="mr-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.3 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        Cancellation Policy (Strict)
                    </p>
                    <ul class="space-y-1 ml-7 text-gray-600 text-sm list-disc">
                        <li>**Full refund** for cancellations made within 48 hours of booking, if the check-in date is at least 14 days away.</li>
                        <li>**50% refund** for cancellations made at least 7 days before check-in.</li>
                        <li>**No refund** for cancellations made within 7 days of check-in.</li>
                    </ul>
                </div>

                <div class="bg-secondary-light shadow-md p-4 border-accent border-t-4 rounded-lg transition duration-300 hover:shadow-lg">
                    <p class="flex items-center mb-2 font-bold text-primary-dark text-base">
                        <svg class="mr-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        Check-in & Check-out Policies
                    </p>
                    <ul class="space-y-2 ml-7 text-gray-700 text-sm list-disc">
                        <li>**Standard Check-in:** **4:00 PM** (16:00) onwards.</li>
                        <li>**Standard Check-out:** **10:00 AM** (10:00) **sharp**.</li>
                        <li>**Access:** Self check-in via keypad/lockbox. Code sent at 3:30 PM.</li>
                        <li>**Early Check-in (12:00 PM):** Not guaranteed. Fee: **₱800.00**.</li>
                        <li>**Late Check-out (after 10 AM):** Penalty of **₱800.00** up to 12 PM. After 12 PM, a full night's rate applies.</li>
                    </ul>
                </div>
            </div>
            
            <hr class="border-gray-300 my-8">

            <div class="mb-8 max-w-5xl mx-auto">
                <h4 class="mb-3 font-bold text-primary-dark text-xl">Special Requests / Notes</h4>
                <textarea id="specialRequests" rows="4" 
                    class="shadow-sm p-3 border-2 border-gray-300 focus:border-accent rounded-lg focus:ring focus:ring-accent/50 w-full transition duration-150"
                    placeholder="E.g., Early check-in request, dietary restrictions, need extra towels, etc. (Optional)"></textarea>
            </div>

            <div class="mt-8 text-center">
                <button type="button" id="proceedToPayment" class="btn-pulse bg-accent hover:bg-accent/90 shadow-xl px-12 py-3 rounded-lg font-bold text-white text-lg hover:scale-105 transition-all duration-300 transform">
                    Proceed to Payment
                </button>
            </div>

        </div>
    </main>

    <?= view('components/footer') ?>

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