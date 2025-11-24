<!DOCTYPE html>
<html lang="en">

<?= view('components/head') ?>

<body class="bg-primary text-gray-900">

    <!-- Decorative Top Bar -->
    <div class="bg-accent h-3"></div>

    <!-- Header -->
    <?= view('components/header', ['active' => 'Home']) ?>

        <!-- Hero Image -->
    <section class="relative w-full h-64 md:h-80 lg:h-96">
        <!-- Background Image -->
        <img src="/assets/img/condo.jpg" 
             alt="Booking Header" 
             class="w-full h-full object-cover">

        <!-- Dark Overlay -->
        <div class="absolute inset-0 bg-black/50"></div>

        <!-- Text on Image -->
        <div class="absolute inset-0 flex items-center justify-center">
            <h1 class="text-white text-4xl md:text-5xl font-bold drop-shadow-lg">
                Book Your Stay
            </h1>
        </div>
    </section>


    <!-- Booking Section -->
    <section class="max-w-3xl mx-auto mt-10 mb-24 p-6 bg-white rounded-xl shadow-lg">
        <h2 class="text-2xl font-bold mb-6">Book Your Stay</h2>

        <!-- Form Container -->
        <form id="bookingForm" class="space-y-6">

            <!-- Dates -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block mb-1 font-semibold">Check-In Date</label>
                    <input type="date" id="checkIn" class="w-full border rounded p-3" required>
                </div>

                <div>
                    <label class="block mb-1 font-semibold">Check-Out Date</label>
                    <input type="date" id="checkOut" class="w-full border rounded p-3" required>
                </div>
            </div>

            <!-- Guests -->
            <div>
                <label class="block mb-1 font-semibold">Number of Guests</label>
                <select id="guests" class="w-full border rounded p-3" required>
                    <option value="1">1 Guest</option>
                    <option value="2">2 Guests</option>
                    <option value="3">3 Guests</option>
                    <option value="4">4 Guests</option>
                </select>
            </div>

            <!-- Price Summary -->
            <div class="bg-gray-50 p-4 rounded border">
                <p class="font-semibold mb-2">Price Breakdown</p>

                <div class="flex justify-between">
                    <span>₱3,000 / night</span>
                    <span id="nightCount">0 nights</span>
                </div>

                <hr class="my-2">

                <div class="flex justify-between font-bold text-lg">
                    <span>Total</span>
                    <span id="totalAmount">₱0</span>
                </div>
            </div>

            <!-- Button -->
            <button type="button" id="reviewBooking"
                class="w-full bg-accent text-white py-3 rounded-lg font-semibold hover:bg-accent/90 transition">
                Review Booking
            </button>

        </form>
    </section>

    <!-- Footer -->
    <?= view('components/footer') ?>


    <!-- Booking JS -->
    <script>
        const nightlyRate = 3000;

        function calculateBooking() {
            const checkIn = new Date(document.getElementById("checkIn").value);
            const checkOut = new Date(document.getElementById("checkOut").value);

            let nightCount = 0;

            if (checkIn && checkOut && checkOut > checkIn) {
                const diff = checkOut - checkIn;
                nightCount = diff / (1000 * 60 * 60 * 24);
            }

            document.getElementById("nightCount").innerText = nightCount + " night" + (nightCount === 1 ? "" : "s");
            document.getElementById("totalAmount").innerText = "₱" + (nightCount * nightlyRate).toLocaleString();
        }

        document.getElementById("checkIn").addEventListener("change", calculateBooking);
        document.getElementById("checkOut").addEventListener("change", calculateBooking);

        document.getElementById("reviewBooking").addEventListener("click", () => {
            alert("Review your booking before proceeding!");
        });
    </script>

</body>
</html>
