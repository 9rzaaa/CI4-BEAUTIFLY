<!DOCTYPE html>
<html lang="en">

<?= view('components/head') ?>

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

    .text-total-price {
        color: #FFFFFF;
        /* White color for Total Price */
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

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        let selectedDates = [];

        // Initialize flatpickr for date selection
        flatpickr("#dateRange", {
            mode: "range",
            dateFormat: "Y-m-d",
            minDate: "today",
            onChange: function(dates, dateStr, instance) {
                selectedDates = dates;
            }
        });

        // Guest dropdown elements
        const guestBtn = document.getElementById("guestBtn");
        const guestDropdown = document.getElementById("guestDropdown");
        const guestSummary = document.getElementById("guestSummary");
        const guestDone = document.getElementById("guestDone");
        const adultsInput = document.getElementById("adults");
        const kidsInput = document.getElementById("kids");

        // Toggle guest dropdown
        guestBtn.addEventListener("click", () => {
            guestDropdown.classList.toggle("hidden");
        });

        // Close dropdown when "Done" is clicked
        guestDone.addEventListener("click", () => {
            updateGuestSummary();
            guestDropdown.classList.add("hidden");
        });

        // Adults increment/decrement
        document.getElementById("plusAdults").addEventListener("click", (e) => {
            e.stopPropagation();
            if (adultsInput.value < 6) {
                adultsInput.value = parseInt(adultsInput.value) + 1;
                updateGuestSummary();
            }
        });

        document.getElementById("minusAdults").addEventListener("click", (e) => {
            e.stopPropagation();
            if (adultsInput.value > 1) {
                adultsInput.value = parseInt(adultsInput.value) - 1;
                updateGuestSummary();
            }
        });

        // Kids increment/decrement
        document.getElementById("plusKids").addEventListener("click", (e) => {
            e.stopPropagation();
            if (kidsInput.value < 6) {
                kidsInput.value = parseInt(kidsInput.value) + 1;
                updateGuestSummary();
            }
        });

        document.getElementById("minusKids").addEventListener("click", (e) => {
            e.stopPropagation();
            if (kidsInput.value > 0) {
                kidsInput.value = parseInt(kidsInput.value) - 1;
                updateGuestSummary();
            }
        });

        // Update guest summary text
        function updateGuestSummary() {
            const adults = adultsInput.value;
            const kids = kidsInput.value;
            guestSummary.textContent = `${adults} Adult${adults > 1 ? 's' : ''}, ${kids} Kid${kids > 1 ? 's' : ''}`;
        }

        // Close dropdown when clicking outside
        document.addEventListener("click", function(e) {
            if (!guestBtn.contains(e.target) && !guestDropdown.contains(e.target)) {
                guestDropdown.classList.add("hidden");
            }
        });

        // Book Now button - Redirect to review page
        document.getElementById("reviewBooking").addEventListener("click", () => {
            // Validate date selection
            if (selectedDates.length !== 2) {
                alert("Please select a check-in and check-out date range.");
                return;
            }

            // Validate date range
            const checkInDate = selectedDates[0];
            const checkOutDate = selectedDates[1];

            const oneDay = 24 * 60 * 60 * 1000;
            const diffTime = Math.abs(checkOutDate.getTime() - checkInDate.getTime());
            const diffDays = Math.round(diffTime / oneDay);

            if (diffDays <= 0) {
                alert("Check-out date must be after check-in date.");
                return;
            }

            // Validate guest count
            const totalGuests = parseInt(adultsInput.value) + parseInt(kidsInput.value);
            if (totalGuests > 6) {
                alert("Maximum 6 guests allowed.");
                return;
            }

            if (totalGuests === 0) {
                alert("Please select at least one guest.");
                return;
            }

            // Format dates
            const checkIn = checkInDate.toISOString().split('T')[0];
            const checkOut = checkOutDate.toISOString().split('T')[0];

            // Prepare query parameters (no price calculations here)
            const queryParams = new URLSearchParams({
                checkIn: checkIn,
                checkOut: checkOut,
                adults: adultsInput.value,
                kids: kidsInput.value
            }).toString();

            // Redirect to booking review page
            window.location.href = `/user/booking_review?${queryParams}`;
        });
    </script>

</body>

</html>