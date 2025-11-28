<!DOCTYPE html>
<html lang="en">

<?= view('components/head') ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />

<body class="relative text-gray-900 bg-cover bg-center bg-fixed min-h-screen" style="background-image: url('/assets/img/bookingbg.jpg');">
  
  <div class="bg-accent h-3"></div>

  <?= view('components/header', ['active' => 'Home']) ?>

  <!-- HEADER IMAGE -->
  <section class="relative w-full h-96 md:h-[550px] lg:h-[550px]">
    <img src="/assets/img/booking.webp" alt="Booking Header" class="w-full h-full object-cover">
    <div class="absolute inset-0 bg-black/50"></div>
    <div class="absolute inset-0 flex items-center justify-center">
      <h1 class="text-white text-4xl md:text-6xl font-bold drop-shadow-lg text-center px-4">
        EASY&CO
      </h1>
    </div>
  </section>

  <!-- BOOKING BOX -->
  <section class="relative -mt-20 max-w-4xl mx-auto bg-white rounded-2xl shadow-2xl z-10 p-8 lg:p-10 border-t-4 border-accent">
      <h2 class="text-3xl font-extrabold mb-6 text-center text-primary-dark">Book Now Your Perfect Escape</h2>

      <form id="bookingForm" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">

        <!-- Date Picker -->
        <div class="md:col-span-2">
          <label class="block mb-2 font-bold text-gray-700">🗓️ Check-in & Check-out</label>
          <input type="text" id="dateRange" 
                 class="w-full border-2 border-gray-300 focus:border-accent focus:ring focus:ring-accent/50 rounded-lg p-3 transition duration-150 shadow-sm" 
                 placeholder="Select date range" required readonly>
        </div>

        <!-- Guest Picker -->
        <div class="relative md:col-span-1">
          <label class="block mb-2 font-bold text-gray-700">👨‍👩‍👧 Guests</label>

          <!-- Guest button -->
          <button type="button" id="guestBtn" 
                  class="w-full border-2 border-gray-300 focus:border-accent focus:ring focus:ring-accent/50 rounded-lg p-3 text-left flex justify-between items-center bg-white transition duration-150 shadow-sm hover:border-accent">
            <span id="guestSummary" class="font-medium text-primary-dark">1 Adult, 0 Kids</span>
            <svg class="w-5 h-5 ml-2 text-primary-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
          </button>

          <!-- Guest Dropdown -->
          <div id="guestDropdown" class="absolute mt-2 w-full bg-white border border-gray-300 shadow-lg rounded-lg p-4 hidden z-20">

              <!-- Adults -->
              <div class="flex items-center justify-between mb-4">
                  <span class="font-medium text-gray-700">Adults</span>
                  <div class="flex items-center gap-3">
                      <button type="button" id="minusAdults" class="px-3 py-1 bg-gray-200 rounded">−</button>
                      <input type="text" id="adults" value="1" readonly class="w-10 text-center border rounded">
                      <button type="button" id="plusAdults" class="px-3 py-1 bg-gray-200 rounded">+</button>
                  </div>
              </div>

              <!-- Kids -->
              <div class="flex items-center justify-between mb-4">
                  <span class="font-medium text-gray-700">Kids</span>
                  <div class="flex items-center gap-3">
                      <button type="button" id="minusKids" class="px-3 py-1 bg-gray-200 rounded">−</button>
                      <input type="text" id="kids" value="0" readonly class="w-10 text-center border rounded">
                      <button type="button" id="plusKids" class="px-3 py-1 bg-gray-200 rounded">+</button>
                  </div>
              </div>

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
                        adultsInput.value = parseInt(adultsInput.value) + 1; ===
                        === =
                        // Adults increment/decrement
                        document.getElementById("plusAdults").addEventListener("click", (e) => {
                                    e.stopPropagation();
                                    if (adultsInput.value < 6) {
                                        adultsInput.value = parseInt(adultsInput.value) + 1; ===
                                        === =
                                        // Adults increment/decrement
                                        document.getElementById("plusAdults").addEventListener("click", (e) => {
                                                    e.stopPropagation();
                                                    if (adultsInput.value < 6) {
                                                        adultsInput.value = parseInt(adultsInput.value) + 1; ===
                                                        === =
                                                        // Adults increment/decrement
                                                        document.getElementById("plusAdults").addEventListener("click", (e) => {
                                                                    e.stopPropagation();
                                                                    if (adultsInput.value < 6) {
                                                                        adultsInput.value = parseInt(adultsInput.value) + 1; <<
                                                                        << << < Updated upstream
                                                                            ===
                                                                            === = ===
                                                                            === =
                                                                            // Adults increment/decrement
                                                                            document.getElementById("plusAdults").addEventListener("click", (e) => {
                                                                                e.stopPropagation();
                                                                                if (adultsInput.value < 6) {
                                                                                    adultsInput.value = parseInt(adultsInput.value) + 1; >>>
                                                                                    >>> > Stashed changes
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
                                                                                        kidsInput.value = parseInt(kidsInput.value) + 1; ===
                                                                                        === =
                                                                                        document.getElementById("minusKids").addEventListener("click", (e) => {
                                                                                            e.stopPropagation();
                                                                                            if (kidsInput.value > 0) {
                                                                                                kidsInput.value = parseInt(kidsInput.value) - 1; >>>
                                                                                                >>> > Stashed changes
                                                                                                updateGuestSummary();
                                                                                            }
                                                                                        });

                                                                                        <<
                                                                                        << << < Updated upstream
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
                                                                                        }); ===
                                                                                        === =
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

                                                                                        // Helper function to format date without timezone issues
                                                                                        function formatDateLocal(date) {
                                                                                            const year = date.getFullYear();
                                                                                            const month = String(date.getMonth() + 1).padStart(2, '0');
                                                                                            const day = String(date.getDate()).padStart(2, '0');
                                                                                            return `${year}-${month}-${day}`;
                                                                                        } >>>
                                                                                        >>> > Stashed changes

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

                                                                                                    <<
                                                                                                    << << < Updated upstream
                                                                                                    // Format dates
                                                                                                    const checkIn = checkInDate.toISOString().split('T')[0];
                                                                                                    const checkOut = checkOutDate.toISOString().split('T')[0]; ===
                                                                                                    === =
                                                                                                    // Format dates without timezone conversion issues
                                                                                                    const checkIn = formatDateLocal(checkInDate);
                                                                                                    const checkOut = formatDateLocal(checkOutDate); >>>
                                                                                                    >>> > Stashed changes

                                                                                                    // Prepare query parameters (no price calculations here)
                                                                                                    const queryParams = new URLSearchParams({
                                                                                                        checkIn: checkIn,
                                                                                                        checkOut: checkOut,
                                                                                                        adults: adultsInput.value,
                                                                                                        kids: kidsInput.value
                                                                                                    }).toString();

                                                                                                    ===
                                                                                                    === =
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

                                                                                                    // Helper function to format date without timezone issues
                                                                                                    function formatDateLocal(date) {
                                                                                                        const year = date.getFullYear();
                                                                                                        const month = String(date.getMonth() + 1).padStart(2, '0');
                                                                                                        const day = String(date.getDate()).padStart(2, '0');
                                                                                                        return `${year}-${month}-${day}`;
                                                                                                    }

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

                                                                                                        // Format dates without timezone conversion issues
                                                                                                        const checkIn = formatDateLocal(checkInDate);
                                                                                                        const checkOut = formatDateLocal(checkOutDate);

                                                                                                        // Prepare query parameters (no price calculations here)
                                                                                                        const queryParams = new URLSearchParams({
                                                                                                            checkIn: checkIn,
                                                                                                            checkOut: checkOut,
                                                                                                            adults: adultsInput.value,
                                                                                                            kids: kidsInput.value
                                                                                                        }).toString();

                                                                                                        >>>
                                                                                                        >>> > Stashed changes
                                                                                                        // Redirect to booking review page
                                                                                                        window.location.href = `/user/booking_review?${queryParams}`;
                                                                                                    });
    </script>

        <!-- Book Now Button -->
        <div class="md:col-span-1">
            <label class="invisible md:visible block mb-2 font-bold text-gray-700">_</label>
            <button 
                type="button" 
                id="reviewBooking"
                class="bg-[#73AF6F] hover:bg-[#5B9358] shadow-lg py-3 rounded-lg w-full font-bold text-white hover:scale-105 active:scale-100 transition-all duration-300 transform"
            >
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

      // Initialize flatpickr for date selection
      flatpickr("#dateRange", {
          mode: "range",
          dateFormat: "Y-m-d",
          minDate: "today",
          onChange: function(dates) {
              selectedDates = dates;
          }
      });

      // Guest dropdown elements
      const guestBtn = document.getElementById("guestBtn");
      const guestDropdown = document.getElementById("guestDropdown");
      const guestSummary = document.getElementById("guestSummary");
      const adultsInput = document.getElementById("adults");
      const kidsInput = document.getElementById("kids");

      // Toggle guest dropdown
      guestBtn.addEventListener("click", () => {
          guestDropdown.classList.toggle("hidden");
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

          const totalGuests = parseInt(adultsInput.value) + parseInt(kidsInput.value);
          if (totalGuests > 6) {
              alert("Maximum 6 guests allowed.");
              return;
          }

          if (totalGuests === 0) {
              alert("Please select at least one guest.");
              return;
          }

          const checkIn = checkInDate.toISOString().split('T')[0];
          const checkOut = checkOutDate.toISOString().split('T')[0];

          const queryParams = new URLSearchParams({
              checkIn: checkIn,
              checkOut: checkOut,
              adults: adultsInput.value,
              kids: kidsInput.value
          }).toString();

          window.location.href = `/user/booking_review?${queryParams}`;
      });
  </script>

</body>
</html>
