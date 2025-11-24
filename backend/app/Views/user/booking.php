<!DOCTYPE html>
<html lang="en">

<?= view('components/head') ?>

<!-- Include Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />

<body class="relative text-gray-900 bg-cover bg-center bg-fixed min-h-screen" style="background-image: url('/assets/img/bookingbg.jpg');">


  <!-- Decorative Top Bar -->
  <div class="bg-accent h-3"></div>

  <!-- Header -->
  <?= view('components/header', ['active' => 'Home']) ?>

  <!-- Hero Image -->
  <section class="relative w-full h-64 md:h-96 lg:h-[500px]">
    <img src="/assets/img/booking.webp" alt="Booking Header" class="w-full h-full object-cover">
    <div class="absolute inset-0 bg-black/50"></div>
    <div class="absolute inset-0 flex items-center justify-center">
      <h1 class="text-white text-4xl md:text-6xl font-bold drop-shadow-lg text-center px-4">
       EASY&CO
      </h1>
    </div>
  </section>

<!-- Booking Section -->
<section class="relative -mt-20 max-w-2xl mx-auto bg-white rounded-xl shadow-xl z-10 p-6 pb-8">
    <h2 class="text-xl md:text-2xl font-bold mb-4 text-center">Reserve Your Stay</h2>

    <form id="bookingForm" class="flex flex-col md:flex-row items-center gap-4">

      <!-- Date Range Picker -->
      <div class="flex-1 min-w-[200px]">
        <label class="block mb-1 font-semibold">Date Range</label>
        <input type="text" id="dateRange" class="w-full border rounded p-2" placeholder="Select date range" required readonly>
      </div>

      <!-- Guests Dropdown -->
      <div class="relative flex-1 min-w-[180px]">
        <label class="block mb-1 font-semibold">Guests</label>
        <div>
          <button type="button" id="guestBtn" class="w-full border rounded p-2 text-left flex justify-between items-center">
            <span id="guestSummary">1 Adult, 0 Kids</span>
            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M19 9l-7 7-7-7"></path>
            </svg>
          </button>
        </div>

        <!-- Dropdown Panel -->
        <div id="guestDropdown" class="hidden absolute left-0 mt-1 w-full bg-white border rounded shadow-lg z-20 p-4">
          <!-- Adults -->
          <div class="flex items-center justify-between mb-3">
            <span class="font-medium">Adults</span>
            <div class="flex items-center border rounded">
              <button type="button" id="minusAdults" class="px-2 py-1 text-lg">-</button>
              <input type="number" id="adults" value="1" min="1" max="10" class="w-12 text-center p-1" readonly>
              <button type="button" id="plusAdults" class="px-2 py-1 text-lg">+</button>
            </div>
          </div>
          <!-- Kids -->
          <div class="flex items-center justify-between mb-3">
            <span class="font-medium">Kids</span>
            <div class="flex items-center border rounded">
              <button type="button" id="minusKids" class="px-2 py-1 text-lg">-</button>
              <input type="number" id="kids" value="0" min="0" max="10" class="w-12 text-center p-1" readonly>
              <button type="button" id="plusKids" class="px-2 py-1 text-lg">+</button>
            </div>
          </div>
          <div class="text-right">
            <button type="button" id="guestDone" class="px-4 py-1 bg-accent text-white rounded">Done</button>
          </div>
        </div>
      </div>

<!-- Book Button -->
<div class="flex-1 md:flex-none">
  <button type="button" id="reviewBooking" 
          class="w-full bg-accent text-white py-3 px-8 rounded-lg font-semibold shadow-md hover:bg-accent/90 transition-colors duration-300">
    Book Now
  </button>
</div>


    </form>
  </section>

  <!-- Gallery Section -->
<section class="max-w-5xl mx-auto mt-16 px-4 md:px-0 pb-16">
<h2 class="text-3xl font-bold mb-6 text-center text-[#73AF6F]">Gallery</h2>

    <div class="grid grid-cols-2 gap-4">

        <!-- Left Column -->
        <div class="flex flex-col gap-4">
            <!-- Upper Left - Rectangle -->
            <img src="/assets/img/room4.jpg" alt="Room" class="rounded shadow object-cover w-full h-80 hover:scale-105 transition">
            <!-- Lower Left - Square -->
            <img src="/assets/img/livingroom.jpg" alt="Living Room" class="rounded shadow object-cover w-full h-64 hover:scale-105 transition">
        </div>

        <!-- Right Column -->
        <div class="flex flex-col gap-4">
            <!-- Upper Right - Square -->
            <img src="/assets/img/kitchen.jpeg" alt="Kitchen" class="rounded shadow object-cover w-full h-64 hover:scale-105 transition">
            <!-- Lower Right - Rectangle -->
            <img src="/assets/img/toilet.jpg" alt="Toilet" class="rounded shadow object-cover w-full h-80 hover:scale-105 transition">
        </div>

    </div>
</section>

  <!-- Footer -->
  <?= view('components/footer') ?>

  <!-- JS -->
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script>
    // Initialize flatpickr as date range picker
    flatpickr("#dateRange", {
      mode: "range",
      dateFormat: "Y-m-d",
      minDate: "today",
      onChange: function(selectedDates, dateStr, instance) {
        // dateStr will be like "2025-11-24 to 2025-11-27"
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

    // Adults plus / minus
    const adultsInput = document.getElementById("adults");
    document.getElementById("plusAdults").addEventListener("click", () => {
      if (adultsInput.value < 10) adultsInput.value = parseInt(adultsInput.value) + 1;
    });
    document.getElementById("minusAdults").addEventListener("click", () => {
      if (adultsInput.value > 1) adultsInput.value = parseInt(adultsInput.value) - 1;
    });

    // Kids plus / minus
    const kidsInput = document.getElementById("kids");
    document.getElementById("plusKids").addEventListener("click", () => {
      if (kidsInput.value < 10) kidsInput.value = parseInt(kidsInput.value) + 1;
    });
    document.getElementById("minusKids").addEventListener("click", () => {
      if (kidsInput.value > 0) kidsInput.value = parseInt(kidsInput.value) - 1;
    });

    function updateGuestSummary() {
      const adults = adultsInput.value;
      const kids = kidsInput.value;
      guestSummary.textContent = `${adults} Adult${adults > 1 ? 's' : ''}, ${kids} Kid${kids > 1 ? 's' : ''}`;
    }

    // Book button review
    document.getElementById("reviewBooking").addEventListener("click", () => {
      const dateRange = document.getElementById("dateRange").value;
      const adults = adultsInput.value;
      const kids = kidsInput.value;
      alert(`Booking: ${dateRange}\nAdults: ${adults}\nKids: ${kids}`);
      // You can replace this with real form submission logic
    });

    // Close dropdown when clicking outside
    document.addEventListener("click", function(e) {
      if (!guestBtn.contains(e.target) && !guestDropdown.contains(e.target)) {
        guestDropdown.classList.add("hidden");
      }
    });
  </script>
</body>
</html>
