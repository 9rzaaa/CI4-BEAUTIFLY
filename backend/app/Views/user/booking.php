<!DOCTYPE html>
<html lang="en">

<?= view('components/head') ?>

<!-- Include Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />

<style>
    /* Custom Accent Color - Main Garden Green */
    .bg-accent {
        background-color: #73AF6F;
        /* Original Green */
    }

    .hover\:bg-accent\/90:hover {
        background-color: #629c5e;
        /* Slightly darker hover green */
    }

    .text-accent {
        color: #73AF6F;
    }

    .border-accent {
        border-color: #73AF6F;
    }

    /* New Garden Theme Colors */
    .bg-primary-dark {
        background-color: #2F5233;
        /* Deep Forest Green */
    }

    .text-primary-dark {
        color: #2F5233;
    }

    .bg-secondary-light {
        background-color: #F8F4E3;
        /* Soft Light Beige/Cream - like dry grass or sand */
    }

    .border-secondary-light {
        border-color: #E0DBCF;
        /* Slightly darker beige border */
    }

    /* Updated styling for logo selection */
    .payment-logo-option {
        display: flex;
        align-items: center;
        justify-content: center;
        border: 3px solid #E0DBCF;
        /* Default border */
        border-radius: 8px;
        cursor: pointer;
        padding: 1rem;
        transition: all 0.2s ease-in-out;
        height: 80px;
        /* Standard height for logos */
        background-color: white;
    }

    .payment-logo-option:hover {
        border-color: #73AF6F;
        /* Accent border on hover */
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.06);
    }

    .payment-logo-option.selected {
        border-color: #73AF6F;
        /* Highlight selected item with accent green */
        box-shadow: 0 0 0 4px #D4EDDA;
        /* Inner glow effect */
        background-color: #D4EDDA;
        /* Light green background */
    }

    /* Hide the actual radio button, but keep its functionality */
    .payment-logo-option input[type="radio"] {
        opacity: 0;
        width: 0;
        height: 0;
        margin: 0;
        padding: 0;
        pointer-events: none;
    }

    .payment-logo-option img {
        max-height: 100%;
        max-width: 100%;
        object-fit: contain;
    }

    .text-total-price {
        color: #FFFFFF;
        /* White color for Total Price */
    }

    /* Modal Animation - unchanged */
    @keyframes fadeInScale {
        from {
            opacity: 0;
            transform: scale(0.9);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    @keyframes fadeOutScale {
        from {
            opacity: 1;
            transform: scale(1);
        }

        to {
            opacity: 0;
            transform: scale(0.9);
        }
    }

    .modal-enter {
        animation: fadeInScale 0.3s ease-out forwards;
    }

    .modal-exit {
        animation: fadeOutScale 0.3s ease-in forwards;
    }

    /* Ensure flex column layout for small screens in modal - unchanged */
    @media (max-width: 768px) {
        .modal-grid-layout {
            grid-template-columns: 1fr;
        }
    }
</style>

<body class="relative bg-cover bg-center bg-fixed min-h-screen text-gray-900" style="background-image: url('/assets/img/bookingbg.jpg');">


    <div class="bg-accent h-3"></div>

    <?= view('components/header', ['active' => 'Home']) ?>

    <section class="relative w-full h-64 md:h-96 lg:h-[500px]">
        <img src="/assets/img/booking.webp" alt="Booking Header" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/50"></div>
        <div class="absolute inset-0 flex justify-center items-center">
            <h1 class="drop-shadow-lg px-4 font-bold text-white text-4xl md:text-6xl text-center">
                EASY&CO
            </h1>
        </div>
    </section>

    <section class="z-10 relative bg-white shadow-2xl mx-auto -mt-20 p-8 lg:p-10 border-accent border-t-4 rounded-2xl max-w-4xl">
        <h2 class="mb-6 font-extrabold text-primary-dark text-3xl text-center">Book Now Your Perfect Escape</h2>

        <form id="bookingForm" class="items-end gap-4 grid grid-cols-1 md:grid-cols-4">

            <div class="md:col-span-2">
                <label class="block mb-2 font-bold text-gray-700">🗓️ Check-in & Check-out</label>
                <input type="text" id="dateRange"
                    class="shadow-sm p-3 border-2 border-gray-300 focus:border-accent rounded-lg focus:ring focus:ring-accent/50 w-full transition duration-150"
                    placeholder="Select date range" required readonly>
            </div>

            <div class="relative md:col-span-1">
                <label class="block mb-2 font-bold text-gray-700">👨‍👩‍👧 Guests</label>
                <div>
                    <button type="button" id="guestBtn"
                        class="flex justify-between items-center bg-white shadow-sm p-3 border-2 border-gray-300 hover:border-accent focus:border-accent rounded-lg focus:ring focus:ring-accent/50 w-full text-left transition duration-150">
                        <span id="guestSummary" class="font-medium text-primary-dark">1 Adult, 0 Kids</span>
                        <svg class="ml-2 w-5 h-5 text-primary-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                </div>

                <div id="guestDropdown" class="hidden right-0 left-0 z-20 absolute space-y-4 bg-white shadow-2xl mt-2 p-4 border border-gray-200 rounded-xl w-full">

                    <div class="flex justify-between items-center py-1">
                        <span class="font-semibold text-gray-800">Adults</span>
                        <div class="flex items-center space-x-1">
                            <button type="button" id="minusAdults" class="flex justify-center items-center hover:bg-accent border border-accent rounded-full focus:outline-none focus:ring-2 focus:ring-accent/50 focus:ring-offset-1 w-8 h-8 font-bold text-accent hover:text-white text-lg transition" aria-label="Subtract Adult">&minus;</button>
                            <input type="number" id="adults" value="1" min="1" max="10" class="bg-transparent p-1 focus:outline-none w-10 font-extrabold text-primary-dark text-xl text-center" readonly>
                            <button type="button" id="plusAdults" class="flex justify-center items-center bg-accent hover:bg-accent/90 rounded-full focus:outline-none focus:ring-2 focus:ring-accent/50 focus:ring-offset-1 w-8 h-8 font-bold text-white text-lg transition" aria-label="Add Adult">&plus;</button>
                        </div>
                    </div>

                    <div class="flex justify-between items-center py-1">
                        <span class="font-semibold text-gray-800">Kids <span class="text-gray-500 text-sm">(Under 12)</span></span>
                        <div class="flex items-center space-x-1">
                            <button type="button" id="minusKids" class="flex justify-center items-center hover:bg-accent border border-accent rounded-full focus:outline-none focus:ring-2 focus:ring-accent/50 focus:ring-offset-1 w-8 h-8 font-bold text-accent hover:text-white text-lg transition" aria-label="Subtract Kid">&minus;</button>
                            <input type="number" id="kids" value="0" min="0" max="10" class="bg-transparent p-1 focus:outline-none w-10 font-extrabold text-primary-dark text-xl text-center" readonly>
                            <button type="button" id="plusKids" class="flex justify-center items-center bg-accent hover:bg-accent/90 rounded-full focus:outline-none focus:ring-2 focus:ring-accent/50 focus:ring-offset-1 w-8 h-8 font-bold text-white text-lg transition" aria-label="Add Kid">&plus;</button>
                        </div>
                    </div>

                    <div class="pt-3 border-gray-100 border-t text-right">
                        <button type="button" id="guestDone" class="bg-primary-dark hover:bg-[#1E3722] shadow-lg px-5 py-2 rounded-full font-semibold text-white transition-colors duration-300">Done</button>
                    </div>
                </div>

            </div>

            <div class="md:col-span-1">
                <label class="invisible md:visible block mb-2 font-bold text-gray-700">_</label>
                <button type="button" id="reviewBooking"
                    class="bg-primary-dark hover:bg-[#1E3722] shadow-lg py-3 rounded-lg w-full font-bold text-white hover:scale-105 active:scale-100 transition-colors duration-300 transform">
                    Book Now
                </button>
            </div>


        </form>
    </section>

    <section class="mx-auto mt-16 px-4 md:px-0 pb-16 max-w-5xl">
        <h2 class="mb-6 font-bold text-[#73AF6F] text-3xl text-center">Gallery</h2>

        <div class="gap-4 grid grid-cols-2">

            <div class="flex flex-col gap-4">
                <img src="/assets/img/room4.jpg" alt="Room" class="shadow rounded w-full h-80 object-cover hover:scale-105 transition">
                <img src="/assets/img/livingroom.jpg" alt="Living Room" class="shadow rounded w-full h-64 object-cover hover:scale-105 transition">
            </div>

            <div class="flex flex-col gap-4">
                <img src="/assets/img/kitchen.jpeg" alt="Kitchen" class="shadow rounded w-full h-64 object-cover hover:scale-105 transition">
                <img src="/assets/img/toilet.jpg" alt="Toilet" class="shadow rounded w-full h-80 object-cover hover:scale-105 transition">
            </div>

        </div>
    </section>

    <?= view('components/footer') ?>

    <div id="bookingModal" class="hidden z-50 fixed inset-0 flex justify-center items-center bg-black bg-opacity-70 p-4 transition-opacity duration-300">
        <div class="relative bg-white opacity-0 shadow-3xl p-8 rounded-xl w-full max-w-4xl scale-95 transition-all duration-300 ease-out transform">

            <button id="closeModal" class="top-4 left-4 absolute font-bold text-gray-400 hover:text-gray-800 text-3xl hover:rotate-90 transition-transform duration-300">&times;</button>

            <h3 class="mb-6 pb-3 border-accent border-b-2 font-extrabold text-primary-dark text-3xl text-center">Confirm Your Booking</h3>

            <div class="grid md:grid-cols-2 modal-grid-layout">

                <div class="md:pr-4 pb-4 md:pb-0">
                    <h4 class="mb-3 font-bold text-primary-dark text-xl">Select Payment Method</h4>

                    <div id="payment-logos" class="gap-3 grid grid-cols-3 mb-5">

                        <label class="payment-logo-option selected" data-value="gcash">
                            <input type="radio" name="paymentMethod" value="gcash" checked>
                            <img src="https://upload.wikimedia.org/wikipedia/en/thumb/5/5a/GCash_logo.svg/1200px-GCash_logo.svg.png" alt="GCash" class="h-8 md:h-10">
                        </label>

                        <label class="payment-logo-option" data-value="paymaya">
                            <input type="radio" name="paymentMethod" value="paymaya">
                            <img src="https://www.maya.ph/assets/images/header/maya-logo-2023.svg" alt="Maya" class="h-8 md:h-10">
                        </label>

                        <label class="payment-logo-option" data-value="visa">
                            <input type="radio" name="paymentMethod" value="visa">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5e/Visa_Inc._logo.svg/1280px-Visa_Inc._logo.svg.png" alt="Visa" class="w-12 md:w-16 h-8 md:h-10">
                        </label>

                    </div>

                    <div class="bg-red-50 shadow-md mt-4 p-4 border-red-500 border-t-4 rounded-lg">
                        <p class="flex items-center mb-2 font-bold text-red-700 text-base">
                            <svg class="mr-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            Cancellation Policy
                        </p>
                        <ul class="space-y-1 ml-7 text-gray-600 text-sm list-disc">
                            <li>**Strict:** Full refund for cancellations made within 48 hours of booking, if the check-in date is at least 14 days away.</li>
                            <li>50% refund for cancellations made at least 7 days before check-in. **No refund** thereafter.</li>
                            <li>Changing dates is subject to host approval and availability.</li>
                            <li>Bookings made within 7 days of check-in are non-refundable.</li>
                        </ul>
                    </div>
                </div>

                <div class="md:pl-4">
                    <h4 class="mb-3 font-bold text-primary-dark text-xl">Reservation Summary</h4>
                    <div class="space-y-4 bg-secondary-light shadow-inner p-5 border border-secondary-light rounded-lg">
                        <div class="flex justify-between items-center pb-2 border-gray-200 border-b">
                            <span class="font-semibold text-gray-700">Transaction ID:</span>
                            <span id="modalTransactionId" class="font-bold text-red-500"></span>
                        </div>

                        <div class="flex justify-between items-center pb-2 border-gray-200 border-b">
                            <span class="font-semibold text-gray-700">Check-in Date:</span>
                            <span id="modalCheckIn" class="font-bold text-primary-dark"></span>
                        </div>
                        <div class="flex justify-between items-center pb-2 border-gray-200 border-b">
                            <span class="font-semibold text-gray-700">Check-out Date:</span>
                            <span id="modalCheckOut" class="font-bold text-primary-dark"></span>
                        </div>
                        <div class="flex justify-between items-center pb-2 border-gray-200 border-b">
                            <span class="font-semibold text-gray-700">Nights:</span>
                            <span id="modalNights" class="font-bold text-primary-dark"></span>
                        </div>
                        <div class="flex justify-between items-center pt-2">
                            <span class="font-semibold text-gray-700">Price per night:</span>
                            <span class="font-extrabold text-green-700 text-lg">₱<span id="modalPricePerNight">2,500</span></span>
                        </div>
                    </div>

                    <div class="flex justify-between items-center bg-primary-dark shadow-lg mt-4 p-4 rounded-lg text-white">
                        <span class="font-bold text-xl">Total Payable:</span>
                        <span class="font-extrabold text-total-price text-3xl">₱<span id="modalTotalPrice">0.00</span></span>
                    </div>
                </div>

            </div>
            <div class="mt-8 text-center">
                <button type="button" id="proceedToPayment" class="bg-accent hover:bg-accent/90 shadow-xl px-12 py-3 rounded-lg font-bold text-white text-lg hover:scale-105 transition-all duration-300 transform">
                    Proceed to Payment
                </button>
            </div>

        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        let selectedDates = [];
        let PRICE_PER_NIGHT = 2000; // Default, will be updated from server
        let CLEANING_FEE = 300; // Default, will be updated from server

        // Function to generate a random alphanumeric ID
        function generateTransactionId(length = 10) {
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            let result = '';
            for (let i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * characters.length));
            }
            return 'TXN-' + result;
        }

        // Fetch property details on page load
        async function fetchPropertyDetails() {
            try {
                const response = await fetch('/api/bookings/property/1'); // Get property ID 1
                if (response.ok) {
                    const data = await response.json();
                    PRICE_PER_NIGHT = parseFloat(data.property.price_per_night);
                    CLEANING_FEE = parseFloat(data.property.cleaning_fee);
                    document.getElementById("modalPricePerNight").textContent = formatCurrency(PRICE_PER_NIGHT);
                }
            } catch (error) {
                console.error('Error fetching property details:', error);
            }
        }

        // Call on page load
        fetchPropertyDetails();

        // Initialize flatpickr
        flatpickr("#dateRange", {
            mode: "range",
            dateFormat: "Y-m-d",
            minDate: "today",
            onChange: function(dates, dateStr, instance) {
                selectedDates = dates; // Store the selected dates
            }
        });

        // Guest dropdown toggle
        const guestBtn = document.getElementById("guestBtn");
        const guestDropdown = document.getElementById("guestDropdown");
        const guestSummary = document.getElementById("guestSummary");
        const guestDone = document.getElementById("guestDone");

        guestBtn.addEventListener("click", () => {
            guestDropdown.classList.toggle("hidden");
        });

        guestDone.addEventListener("click", () => {
            updateGuestSummary();
            guestDropdown.classList.add("hidden");
        });

        // Adults plus/minus
        const adultsInput = document.getElementById("adults");
        document.getElementById("plusAdults").addEventListener("click", (e) => {
            e.stopPropagation();
            if (adultsInput.value < 6) adultsInput.value = parseInt(adultsInput.value) + 1;
            updateGuestSummary();
        });
        document.getElementById("minusAdults").addEventListener("click", (e) => {
            e.stopPropagation();
            if (adultsInput.value > 1) adultsInput.value = parseInt(adultsInput.value) - 1;
            updateGuestSummary();
        });

        // Kids plus/minus
        const kidsInput = document.getElementById("kids");
        document.getElementById("plusKids").addEventListener("click", (e) => {
            e.stopPropagation();
            if (kidsInput.value < 6) kidsInput.value = parseInt(kidsInput.value) + 1;
            updateGuestSummary();
        });
        document.getElementById("minusKids").addEventListener("click", (e) => {
            e.stopPropagation();
            if (kidsInput.value > 0) kidsInput.value = parseInt(kidsInput.value) - 1;
            updateGuestSummary();
        });

        function updateGuestSummary() {
            const adults = adultsInput.value;
            const kids = kidsInput.value;
            guestSummary.textContent = `${adults} Adult${adults > 1 ? 's' : ''}, ${kids} Kid${kids > 1 ? 's' : ''}`;
        }

        // Modal elements
        const bookingModal = document.getElementById("bookingModal");
        const modalContent = bookingModal.querySelector('div:first-child');
        const closeModalBtn = document.getElementById("closeModal");
        const proceedToPaymentBtn = document.getElementById("proceedToPayment");
        const modalCheckIn = document.getElementById("modalCheckIn");
        const modalCheckOut = document.getElementById("modalCheckOut");
        const modalNights = document.getElementById("modalNights");
        const modalPricePerNight = document.getElementById("modalPricePerNight");
        const modalTotalPrice = document.getElementById("modalTotalPrice");
        const modalTransactionId = document.getElementById("modalTransactionId");

        // Helper function to format currency
        function formatCurrency(amount) {
            return new Intl.NumberFormat('en-PH', {
                style: 'decimal',
                minimumFractionDigits: 2
            }).format(amount);
        }

        // Show/hide modal
        function showModal() {
            bookingModal.classList.remove("hidden");
            void bookingModal.offsetWidth;
            bookingModal.classList.add("opacity-100");
            modalContent.classList.add("modal-enter");
            modalContent.classList.remove("opacity-0", "scale-95");
        }

        function hideModal() {
            bookingModal.classList.remove("opacity-100");
            modalContent.classList.remove("modal-enter");
            modalContent.classList.add("modal-exit");
            modalContent.classList.add("opacity-0", "scale-95");

            modalContent.addEventListener('animationend', function handler() {
                bookingModal.classList.add("hidden");
                modalContent.classList.remove("modal-exit");
                modalContent.removeEventListener('animationend', handler);
            }, {
                once: true
            });
        }

        // Review booking button
        document.getElementById("reviewBooking").addEventListener("click", () => {
            if (selectedDates.length !== 2) {
                alert("Please select a check-in and check-out date range.");
                return;
            }

            const checkInDate = selectedDates[0];
            const checkOutDate = selectedDates[1];

            const oneDay = 24 * 60 * 60 * 1000;
            const diffTime = Math.abs(checkOutDate.getTime() - checkInDate.getTime());
            const diffDays = Math.round(diffTime / oneDay);

            if (diffDays <= 0) {
                alert("Check-out date must be after check-in date.");
                return;
            }

            // Check guest count
            const totalGuests = parseInt(adultsInput.value) + parseInt(kidsInput.value);
            if (totalGuests > 6) {
                alert("Maximum 6 guests allowed.");
                return;
            }

            const totalPrice = (diffDays * PRICE_PER_NIGHT) + CLEANING_FEE;

            // Populate Modal
            modalTransactionId.textContent = generateTransactionId();
            modalCheckIn.textContent = checkInDate.toLocaleDateString('en-US', {
                month: 'short',
                day: 'numeric',
                year: 'numeric'
            });
            modalCheckOut.textContent = checkOutDate.toLocaleDateString('en-US', {
                month: 'short',
                day: 'numeric',
                year: 'numeric'
            });
            modalNights.textContent = `${diffDays} night${diffDays > 1 ? 's' : ''}`;

            modalPricePerNight.textContent = formatCurrency(PRICE_PER_NIGHT);
            modalTotalPrice.textContent = formatCurrency(totalPrice);

            showModal();
        });

        // Close Modal
        closeModalBtn.addEventListener("click", hideModal);
        bookingModal.addEventListener('click', (e) => {
            if (e.target === bookingModal) {
                hideModal();
            }
        });

        // Proceed to Payment - CREATE BOOKING THEN PROCESS PAYMENT
        proceedToPaymentBtn.addEventListener('click', async () => {
            const selectedPayment = document.querySelector('input[name="paymentMethod"]:checked').value;
            const transactionId = modalTransactionId.textContent;

            // Prepare booking data
            const bookingData = {
                check_in: selectedDates[0].toISOString().split('T')[0],
                check_out: selectedDates[1].toISOString().split('T')[0],
                adults: parseInt(adultsInput.value),
                kids: parseInt(kidsInput.value),
                payment_method: selectedPayment,
                transaction_id: transactionId,
                special_requests: null
            };

            // Show loading state
            proceedToPaymentBtn.disabled = true;
            proceedToPaymentBtn.textContent = 'Processing Booking...';

            try {
                // STEP 1: Create booking
                const bookingResponse = await fetch('/api/bookings/create', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(bookingData)
                });

                const bookingResult = await bookingResponse.json();

                if (!bookingResponse.ok || !bookingResult.success) {
                    throw new Error(bookingResult.error || 'Booking creation failed');
                }

                // STEP 2: Process payment
                proceedToPaymentBtn.textContent = 'Processing Payment...';

                const paymentResponse = await fetch('/api/payments/process', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        booking_id: bookingResult.booking_id,
                        payment_method: selectedPayment
                    })
                });

                const paymentResult = await paymentResponse.json();

                if (paymentResponse.ok && paymentResult.success) {
                    // SUCCESS!
                    alert(`Payment Successful! 🎉\n\nBooking ID: ${bookingResult.booking_id}\nTransaction ID: ${paymentResult.transaction_id}\nAmount Paid: ₱${formatCurrency(paymentResult.amount)}\n\nYour booking is confirmed!`);
                    hideModal();

                    // Optional: Redirect to confirmation page or bookings page
                    // window.location.href = '/booking-confirmation?id=' + bookingResult.booking_id;
                    // Or refresh the page
                    // window.location.reload();
                } else {
                    // PAYMENT FAILED
                    alert(`Payment Failed ❌\n\n${paymentResult.error || 'Payment was declined.'}\n\nBooking created but not confirmed. Please try again or contact support.\n\nBooking ID: ${bookingResult.booking_id}`);
                }
            } catch (error) {
                console.error('Error:', error);
                alert(`Error: ${error.message}\n\nPlease try again or contact support.`);
            } finally {
                // Reset button
                proceedToPaymentBtn.disabled = false;
                proceedToPaymentBtn.textContent = 'Proceed to Payment';
            }
        });

        // Close dropdown when clicking outside
        document.addEventListener("click", function(e) {
            if (!guestBtn.contains(e.target) && !guestDropdown.contains(e.target) && !modalContent.contains(e.target)) {
                guestDropdown.classList.add("hidden");
            }
        });

        // Payment option selection
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

        // Set initial checked radio
        const initiallyCheckedRadio = document.querySelector('input[name="paymentMethod"]:checked');
        if (initiallyCheckedRadio) {
            initiallyCheckedRadio.closest('.payment-logo-option').classList.add('selected');
        }
    </script>

</body>

</html>