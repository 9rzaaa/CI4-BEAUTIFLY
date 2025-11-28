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

        0%,
        100% {
            box-shadow: 0 0 0 0 rgba(115, 175, 111, 0.7);
        }

        50% {
            box-shadow: 0 0 0 15px rgba(115, 175, 111, 0);
        }
    }
</style>

<body class="bg-secondary-light min-h-screen text-gray-900">

    <div class="bg-accent h-3"></div>

    <?= view('components/header', ['active' => 'Home']) ?>

    <main class="py-16">
        <div class="bg-white shadow-2xl mx-auto p-10 rounded-xl w-full max-w-7xl">

            <a href="/booking"
                class="flex items-center mb-6 font-semibold text-accent hover:text-primary-dark hover:scale-105 transition-all">
                <svg class="mr-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Booking
            </a>

            <h3 class="mb-12 pb-3 border-accent border-b-2 font-extrabold text-primary-dark text-4xl text-center">
                Confirm & Pay
            </h3>

            <div class="gap-10 grid grid-cols-1 lg:grid-cols-2">

                <div class="space-y-8 w-full">

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
                            class="shadow-sm p-3 border-2 border-gray-300 focus:border-accent rounded-lg focus:ring-accent/50 w-full"
                            rows="4"
                            placeholder="Any special requests (optional)..."></textarea>
                    </div>

                </div>

                <div class="flex flex-col justify-start w-full">

                    <div>
                        <h4 class="mb-3 font-bold text-primary-dark text-xl">Important Policies</h4>

                        <div class="bg-red-50 shadow-md mb-6 p-4 border-red-600 border-t-4 rounded-lg">
                            <p class="mb-2 font-bold text-red-700">Cancellation Policy (Strict)</p>
                            <ul class="ml-6 text-gray-700 text-sm list-disc">
                                <li>Full refund within 48 hours...</li>
                                <li>50% refund 7 days before check-in.</li>
                                <li>No refund within 7 days.</li>
                            </ul>
                        </div>

                        <div class="bg-secondary-light shadow-md p-4 border-accent border-t-4 rounded-lg">
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
                        <div id="payment-logos" class="gap-3 grid grid-cols-3">
                            <label class="payment-logo-option selected" data-value="gcash">
                                <input type="radio" name="paymentMethod" value="gcash" checked>
                                <img src="https://upload.wikimedia.org/wikipedia/en/thumb/5/5a/GCash_logo.svg/1200px-GCash_logo.svg.png">
                                <span class="font-semibold text-primary-dark text-xs">GCash (Recommended)</span>
                            </label>
                            <label class="payment-logo-option" data-value="paymaya">
                                <input type="radio" name="paymentMethod" value="paymaya">
                                <img src="https://www.maya.ph/assets/images/header/maya-logo-2023.svg">
                                <span class="font-semibold text-primary-dark text-xs">Maya (PayMaya)</span>
                            </label>
                            <label class="payment-logo-option" data-value="visa">
                                <input type="radio" name="paymentMethod" value="visa">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg">
                                <span class="font-semibold text-primary-dark text-xs">Credit/Debit Card</span>
                            </label>
                        </div>
                    </div>

                </div>
            </div>
            <hr class="my-8 border-gray-300">

            <div class="mt-8 text-center">
                <button id="proceedToPayment"
                    class="bg-accent hover:bg-accent/90 shadow-xl px-12 py-3 rounded-lg font-bold text-white text-lg hover:scale-105 transition-all btn-pulse">
                    Proceed to Payment
                </button>
            </div>
        </div>
    </main>


    <script>
        // Get data passed from PHP controller (already formatted!)
        const bookingData = {
            checkIn: '<?= esc($checkIn) ?>', // Raw for API
            checkOut: '<?= esc($checkOut) ?>', // Raw for API
            checkInFormatted: '<?= esc($checkInFormatted) ?>', // Pre-formatted by PHP
            checkOutFormatted: '<?= esc($checkOutFormatted) ?>', // Pre-formatted by PHP
            adults: <?= (int)$adults ?>,
            kids: <?= (int)$kids ?>,
            nights: <?= (int)$nights ?>,
            transactionId: '<?= esc($transactionId) ?>',
            pricePerNight: '<?= $pricePerNight ?>', // Already formatted with commas
            cleaningFee: '<?= $cleaningFee ?>', // Already formatted
            totalPrice: '<?= $totalPrice ?>' // Already formatted
        };

        // Populate booking details (no formatting needed - PHP did it!)
        function populateBookingDetails() {
            if (!bookingData.checkIn || !bookingData.checkOut || bookingData.nights <= 0) {
                alert("Booking details are missing. Redirecting back to the booking page.");
                window.location.href = '/user/booking';
                return;
            }

            // Use pre-formatted values from PHP
            document.getElementById("modalTransactionId").textContent = bookingData.transactionId;
            document.getElementById("modalCheckIn").textContent = bookingData.checkInFormatted;
            document.getElementById("modalCheckOut").textContent = bookingData.checkOutFormatted;
            document.getElementById("modalNights").textContent = `${bookingData.nights} night${bookingData.nights > 1 ? 's' : ''}`;
            document.getElementById("modalGuests").textContent = `${bookingData.adults} Adult${bookingData.adults > 1 ? 's' : ''}, ${bookingData.kids} Kid${bookingData.kids > 1 ? 's' : ''}`;
            document.getElementById("modalPricePerNight").textContent = bookingData.pricePerNight;
            document.getElementById("modalCleaningFee").textContent = bookingData.cleaningFee;
            document.getElementById("modalTotalPrice").textContent = bookingData.totalPrice;

            // Store booking data for API submission (use raw dates)
            document.getElementById("proceedToPayment").dataset.bookingData = JSON.stringify({
                check_in: bookingData.checkIn,
                check_out: bookingData.checkOut,
                adults: bookingData.adults,
                kids: bookingData.kids,
                transaction_id: bookingData.transactionId,
                total_amount: parseFloat(bookingData.totalPrice.replace(/,/g, ''))
            });
        }

        // Initialize on page load
        populateBookingDetails();

        // Payment method selection
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

        // Function to show QR code modal (GCash/Maya) with Done button
        function showQRModal(paymentMethod, callback) {
            const modalHTML = `
            <div id="qrModal" class="z-50 fixed inset-0 flex justify-center items-center bg-black bg-opacity-70" style="animation: fadeIn 0.3s;">
                <div class="bg-white mx-4 p-8 rounded-2xl w-full max-w-md text-center" style="animation: slideUp 0.3s;">
                    <h3 class="mb-4 font-bold text-2xl" style="color: #2F5233;">Scan to Pay</h3>
                    <p class="mb-6 text-gray-600">Scan this QR code using your ${paymentMethod === 'gcash' ? 'GCash' : 'Maya'} app</p>
                   
                    <div class="bg-gray-100 mb-6 p-6 rounded-xl">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=DUMMY_${paymentMethod.toUpperCase()}_PAYMENT"
                             alt="QR Code" class="mx-auto w-64 h-64">
                    </div>
                   
                    <div class="mb-4">
                        <div class="inline-flex justify-center items-center mb-2 rounded-full w-20 h-20 font-bold text-white text-2xl" style="background-color: #73AF6F;">
                            <span id="qrTimer">40</span>
                        </div>
                        <p class="text-gray-500 text-sm">Seconds remaining</p>
                    </div>
                   
                    <button id="qrDoneButton" 
                        class="bg-accent hover:bg-accent/90 shadow-lg px-8 py-3 rounded-lg w-full font-bold text-white text-lg hover:scale-105 transition-all"
                        style="background-color: #73AF6F;">
                        Done
                    </button>
                   
                    <p class="mt-4 text-gray-400 text-xs">Or wait for automatic processing...</p>
                </div>
            </div>
            <style>
                @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
                @keyframes slideUp { from { transform: translateY(50px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
            </style>
        `;

            document.body.insertAdjacentHTML('beforeend', modalHTML);

            let timeLeft = 40;
            const timerElement = document.getElementById('qrTimer');
            const doneButton = document.getElementById('qrDoneButton');

            const countdown = setInterval(() => {
                timeLeft--;
                timerElement.textContent = timeLeft;

                if (timeLeft <= 0) {
                    clearInterval(countdown);
                    document.getElementById('qrModal').remove();
                    callback();
                }
            }, 1000);

            // Add click handler for Done button
            doneButton.addEventListener('click', () => {
                clearInterval(countdown);
                document.getElementById('qrModal').remove();
                callback();
            });
        }

        // Function to show Visa payment form
        function showVisaPaymentForm(callback) {
            alert('Redirecting to Credit/Debit Card payment form...\n\n(Frontend team will implement the actual form)');

            setTimeout(() => {
                const confirmed = confirm('Payment form submitted. Confirm payment?');
                if (confirmed) {
                    callback();
                }
            }, 3000);
        }

        // Main payment processing
        document.getElementById('proceedToPayment').addEventListener('click', async (e) => {
            const btn = e.currentTarget;
            const selectedPayment = document.querySelector('input[name="paymentMethod"]:checked').value;
            let submissionData = JSON.parse(btn.dataset.bookingData);

            const specialRequests = document.getElementById('specialRequests').value.trim();
            submissionData.payment_method = selectedPayment;
            submissionData.special_requests = specialRequests || null;

            btn.disabled = true;
            btn.textContent = 'Processing...';

            try {
                if (selectedPayment === 'gcash' || selectedPayment === 'paymaya') {
                    showQRModal(selectedPayment, async () => {
                        await createBooking(submissionData, btn);
                    });
                } else if (selectedPayment === 'visa') {
                    showVisaPaymentForm(async () => {
                        await createBooking(submissionData, btn);
                    });
                }
            } catch (error) {
                console.error('Error:', error);
                alert(`Error: ${error.message}\n\nPlease try again or contact support.`);
                btn.disabled = false;
                btn.textContent = 'Proceed to Payment';
            }
        });

        // Function to create booking via API
        async function createBooking(bookingData, btn) {
            try {
                btn.textContent = 'Creating Booking...';

                const bookingResponse = await fetch('/booking/create', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(bookingData)
                });

                const bookingResult = await bookingResponse.json();

                if (!bookingResponse.ok || !bookingResult.success) {
                    throw new Error(bookingResult.error || 'Booking creation failed');
                }

                window.location.href = `/booking/success?id=${bookingResult.booking_id}&transaction_id=${bookingResult.transaction_id}&total=${bookingResult.total_price}`;

            } catch (error) {
                alert(`Error: ${error.message}\n\nPlease try again or contact support.`);
                btn.disabled = false;
                btn.textContent = 'Proceed to Payment';
            }
        }
    </script>

    <?= view('components/footer') ?>

</body>

</html>