<!DOCTYPE html>
<html lang="en">

<?= view('components/head') ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />

<body class="relative bg-cover bg-center bg-fixed min-h-screen text-gray-900" style="background-image: url('/assets/img/bookingbg.jpg');">

    <div class="bg-accent h-3"></div>

    <?= view('components/header', ['active' => 'Home']) ?>

    <!-- HEADER IMAGE -->
    <section class="relative w-full h-96 md:h-[550px] lg:h-[550px]">
        <img src="/assets/img/booking.webp" alt="Booking Header" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/50"></div>
        <div class="absolute inset-0 flex justify-center items-center">
            <h1 class="drop-shadow-lg px-4 font-bold text-white text-4xl md:text-6xl text-center">
                EASY&CO
            </h1>
        </div>
    </section>

    <!-- BOOKING BOX -->
    <section class="z-10 relative bg-white shadow-2xl mx-auto -mt-20 p-8 lg:p-10 border-accent border-t-4 rounded-2xl max-w-4xl">
        <h2 class="mb-6 font-extrabold text-primary-dark text-3xl text-center">Book Now Your Perfect Escape</h2>

        <!-- Server-side Flash Messages -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="bg-red-100 mb-4 px-4 py-3 border border-red-400 rounded text-red-700" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline"><?= session()->getFlashdata('error') ?></span>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="bg-green-100 mb-4 px-4 py-3 border border-green-400 rounded text-green-700" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline"><?= session()->getFlashdata('success') ?></span>
            </div>
        <?php endif; ?>

        <!-- Client-side Error Message (Hidden by default) -->
        <div id="clientErrorMessage" class="hidden bg-red-100 mb-4 px-4 py-3 border border-red-400 rounded text-red-700" role="alert">
            <div class="flex justify-between items-center">
                <div>
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline" id="clientErrorText"></span>
                </div>
                <button onclick="hideError()" class="text-red-700 hover:text-red-900">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        </div>

        <form id="bookingForm" class="items-end gap-4 grid grid-cols-1 md:grid-cols-4">

            <!-- Date Picker -->
            <div class="md:col-span-2">
                <label class="block mb-2 font-bold text-gray-700">🗓️ Check-in & Check-out</label>
                <input type="text" id="dateRange"
                    class="shadow-sm p-3 border-2 border-gray-300 focus:border-accent rounded-lg focus:ring focus:ring-accent/50 w-full transition duration-150"
                    placeholder="Select date range" required readonly>
            </div>

            <!-- Guest Picker -->
            <div class="relative md:col-span-1">
                <label class="block mb-2 font-bold text-gray-700">👨‍👩‍👧 Guests</label>

                <!-- Guest button -->
                <button type="button" id="guestBtn"
                    class="flex justify-between items-center bg-white shadow-sm p-3 border-2 border-gray-300 hover:border-accent focus:border-accent rounded-lg focus:ring focus:ring-accent/50 w-full text-left transition duration-150">
                    <span id="guestSummary" class="font-medium text-primary-dark">1 Adult, 0 Kids</span>
                    <svg class="ml-2 w-5 h-5 text-primary-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <!-- Guest Dropdown -->
                <div id="guestDropdown" class="hidden z-20 absolute bg-white shadow-lg mt-2 p-4 border border-gray-300 rounded-lg w-full">

                    <!-- Adults -->
                    <div class="flex justify-between items-center mb-4">
                        <span class="font-medium text-gray-700">Adults</span>
                        <div class="flex items-center gap-3">
                            <button type="button" id="minusAdults" class="bg-gray-200 px-3 py-1 rounded">−</button>
                            <input type="text" id="adults" value="1" readonly class="border rounded w-10 text-center">
                            <button type="button" id="plusAdults" class="bg-gray-200 px-3 py-1 rounded">+</button>
                        </div>
                    </div>

                    <!-- Kids -->
                    <div class="flex justify-between items-center mb-4">
                        <span class="font-medium text-gray-700">Kids</span>
                        <div class="flex items-center gap-3">
                            <button type="button" id="minusKids" class="bg-gray-200 px-3 py-1 rounded">−</button>
                            <input type="text" id="kids" value="0" readonly class="border rounded w-10 text-center">
                            <button type="button" id="plusKids" class="bg-gray-200 px-3 py-1 rounded">+</button>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Book Now Button -->
            <div class="md:col-span-1">
                <label class="invisible md:visible block mb-2 font-bold text-gray-700">_</label>
                <button
                    type="button"
                    id="reviewBooking"
                    class="bg-[#73AF6F] hover:bg-[#5B9358] shadow-lg py-3 rounded-lg w-full font-bold text-white hover:scale-105 active:scale-100 transition-all duration-300 transform">
                    Book Now
                </button>
            </div>

        </form>
    </section>

    <!-- GALLERY -->
    <section class="mx-auto mt-16 px-4 md:px-0 pb-16 max-w-5xl">
        <h2 class="mb-6 font-bold text-[#73AF6F] text-3xl text-center">Gallery</h2>

        <div class="gap-4 grid grid-cols-2">

            <div class="flex flex-col gap-4">
                <img src="/assets/img/room4.jpg" class="shadow rounded w-full h-80 object-cover hover:scale-105 transition">
                <img src="/assets/img/livingroom.jpg" class="shadow rounded w-full h-64 object-cover hover:scale-105 transition">
            </div>

            <div class="flex flex-col gap-4">
                <img src="/assets/img/kitchen.jpeg" class="shadow rounded w-full h-64 object-cover hover:scale-105 transition">
                <img src="/assets/img/toilet.jpg" class="shadow rounded w-full h-80 object-cover hover:scale-105 transition">
            </div>

        </div>
    </section>

    <?= view('components/footer') ?>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        let selectedDates = [];
        let bookedDates = [];

        // Error message handlers
        function showError(message) {
            const errorDiv = document.getElementById('clientErrorMessage');
            const errorText = document.getElementById('clientErrorText');
            errorText.textContent = message;
            errorDiv.classList.remove('hidden');
            errorDiv.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
            setTimeout(hideError, 5000);
        }

        function hideError() {
            document.getElementById('clientErrorMessage').classList.add('hidden');
        }

        // Fetch and initialize calendar
        async function fetchBookedDates() {
            try {
                const response = await fetch('/booking/get-booked-dates');
                const data = await response.json();

                if (data.success) {
                    bookedDates = data.booked_dates;
                    console.log('📅 Booked dates loaded:', bookedDates);
                } else {
                    console.error('Failed to load booked dates');
                    showError('Unable to load booking calendar. Please refresh the page.');
                }
            } catch (error) {
                console.error('Error fetching booked dates:', error);
                showError('Unable to connect to the server. Please check your internet connection.');
            } finally {
                initializeFlatpickr();
            }
        }

        // Date helper - checks if date is in range
        function isDateInRange(date, from, to) {
            return date >= from && date <= to;
        }

        // Date formatter
        function formatDateLocal(date) {
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        }

        // Initialize flatpickr
        function initializeFlatpickr() {
            flatpickr("#dateRange", {
                mode: "range",
                dateFormat: "Y-m-d",
                minDate: "today",
                disable: bookedDates,
                onChange: (dates) => selectedDates = dates,
                onDayCreate: (dObj, dStr, fp, dayElem) => {
                    const dateStr = formatDateLocal(dayElem.dateObj);
                    for (let range of bookedDates) {
                        if (isDateInRange(dateStr, range.from, range.to)) {
                            dayElem.classList.add('booked-date');
                            dayElem.title = 'Already booked';
                            break;
                        }
                    }
                }
            });
        }

        // Guest picker setup
        const guestBtn = document.getElementById("guestBtn");
        const guestDropdown = document.getElementById("guestDropdown");
        const guestSummary = document.getElementById("guestSummary");
        const adultsInput = document.getElementById("adults");
        const kidsInput = document.getElementById("kids");

        // Toggle dropdown
        guestBtn.addEventListener("click", (e) => {
            e.preventDefault();
            e.stopPropagation();
            guestDropdown.classList.toggle("hidden");
        });

        // Update guest summary
        function updateGuestSummary() {
            const adults = adultsInput.value;
            const kids = kidsInput.value;
            guestSummary.textContent = `${adults} Adult${adults > 1 ? 's' : ''}, ${kids} Kid${kids > 1 ? 's' : ''}`;
        }

        // Guest counter logic
        function adjustGuests(input, change, min = 0) {
            const adults = parseInt(adultsInput.value);
            const kids = parseInt(kidsInput.value);
            const current = parseInt(input.value);
            const newValue = current + change;

            // Check minimum and total guest limit
            if (newValue < min) return;
            if (adults + kids + change > 6) return;

            input.value = newValue;
            updateGuestSummary();
        }

        document.getElementById("plusAdults").addEventListener("click", (e) => {
            e.preventDefault();
            e.stopPropagation();
            adjustGuests(adultsInput, 1, 1);
        });

        document.getElementById("minusAdults").addEventListener("click", (e) => {
            e.preventDefault();
            e.stopPropagation();
            adjustGuests(adultsInput, -1, 1);
        });

        document.getElementById("plusKids").addEventListener("click", (e) => {
            e.preventDefault();
            e.stopPropagation();
            adjustGuests(kidsInput, 1);
        });

        document.getElementById("minusKids").addEventListener("click", (e) => {
            e.preventDefault();
            e.stopPropagation();
            adjustGuests(kidsInput, -1);
        });

        // Close dropdown when clicking outside
        document.addEventListener("click", (e) => {
            if (!guestBtn.contains(e.target) && !guestDropdown.contains(e.target)) {
                guestDropdown.classList.add("hidden");
            }
        });

        // Book Now validation and submission
        document.getElementById("reviewBooking").addEventListener("click", (e) => {
            e.preventDefault();
            hideError();

            if (selectedDates.length !== 2) {
                showError("Please select a check-in and check-out date range.");
                return;
            }

            const [checkInDate, checkOutDate] = selectedDates;
            const adults = parseInt(adultsInput.value);
            const kids = parseInt(kidsInput.value);
            const nights = Math.round((checkOutDate - checkInDate) / (24 * 60 * 60 * 1000));

            // Validations
            if (nights < 1) {
                showError("Minimum stay is 1 night.");
                return;
            }
            if (nights > 30) {
                showError("Maximum stay is 30 nights. Please select a shorter duration.");
                return;
            }
            if (adults < 1) {
                showError("At least 1 adult is required.");
                return;
            }
            if (adults + kids > 6) {
                showError("Maximum 6 guests total allowed (adults + kids combined).");
                return;
            }

            // Redirect to review page
            const checkIn = formatDateLocal(checkInDate);
            const checkOut = formatDateLocal(checkOutDate);
            window.location.href = `/booking/review?checkIn=${checkIn}&checkOut=${checkOut}&adults=${adults}&kids=${kids}`;
        });

        // Initialize on page load
        fetchBookedDates();
    </script>

</body>

</html>