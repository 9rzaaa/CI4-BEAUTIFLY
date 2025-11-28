<!DOCTYPE html>
<html lang="en">

<?= view('components/head') ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />


<body class="relative text-gray-900 bg-cover bg-center bg-fixed min-h-screen" style="background-image: url('/assets/img/bookingbg.jpg');">


  <div class="bg-accent h-3"></div>

  <?= view('components/header', ['active' => 'Home']) ?>

<section class="relative w-full h-96 md:h-[550px] lg:h-[550px]">
  <img src="/assets/img/booking.webp" alt="Booking Header" class="w-full h-full object-cover">
  <div class="absolute inset-0 bg-black/50"></div>
  <div class="absolute inset-0 flex items-center justify-center">
    <h1 class="text-white text-4xl md:text-6xl font-bold drop-shadow-lg text-center px-4">
      EASY&CO
    </h1>
  </div>
</section>


<section class="relative -mt-20 max-w-4xl mx-auto bg-white rounded-2xl shadow-2xl z-10 p-8 lg:p-10 border-t-4 border-accent">
    <h2 class="text-3xl font-extrabold mb-6 text-center text-primary-dark">Book Now Your Perfect Escape</h2>

    <form id="bookingForm" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">

      <div class="md:col-span-2">
        <label class="block mb-2 font-bold text-gray-700">🗓️ Check-in & Check-out</label>
        <input type="text" id="dateRange" 
               class="w-full border-2 border-gray-300 focus:border-accent focus:ring focus:ring-accent/50 rounded-lg p-3 transition duration-150 shadow-sm" 
               placeholder="Select date range" required readonly>
      </div>

      <div class="relative md:col-span-1">
        <label class="block mb-2 font-bold text-gray-700">👨‍👩‍👧 Guests</label>
        <div>
          <button type="button" id="guestBtn" 
                  class="w-full border-2 border-gray-300 focus:border-accent focus:ring focus:ring-accent/50 rounded-lg p-3 text-left flex justify-between items-center bg-white transition duration-150 shadow-sm hover:border-accent">
            <span id="guestSummary" class="font-medium text-primary-dark">1 Adult, 0 Kids</span>
            <svg class="w-5 h-5 ml-2 text-primary-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M19 9l-7 7-7-7"></path>
            </svg>
          </button>
        </div>

<div id="guestDropdown" class="hidden absolute left-0 right-0 mt-2 w-full bg-white border border-gray-200 rounded-xl shadow-2xl z-20 p-4 space-y-4">
          
          <div class="flex items-center justify-between py-1">
            <span class="font-semibold text-gray-800">Adults</span>
            <div class="flex items-center space-x-1">
              <button type="button" id="minusAdults" class="w-8 h-8 flex items-center justify-center border border-accent text-accent rounded-full text-lg font-bold hover:bg-accent hover:text-white transition focus:outline-none focus:ring-2 focus:ring-accent/50 focus:ring-offset-1" aria-label="Subtract Adult">&minus;</button>
              <input type="number" id="adults" value="1" min="1" max="10" class="w-10 text-center p-1 text-xl text-primary-dark font-extrabold bg-transparent focus:outline-none" readonly>
              <button type="button" id="plusAdults" class="w-8 h-8 flex items-center justify-center bg-accent text-white rounded-full text-lg font-bold hover:bg-accent/90 transition focus:outline-none focus:ring-2 focus:ring-accent/50 focus:ring-offset-1" aria-label="Add Adult">&plus;</button>
            </div>
          </div>
          
          <div class="flex items-center justify-between py-1">
            <span class="font-semibold text-gray-800">Kids <span class="text-sm text-gray-500">(Under 12)</span></span>
            <div class="flex items-center space-x-1">
              <button type="button" id="minusKids" class="w-8 h-8 flex items-center justify-center border border-accent text-accent rounded-full text-lg font-bold hover:bg-accent hover:text-white transition focus:outline-none focus:ring-2 focus:ring-accent/50 focus:ring-offset-1" aria-label="Subtract Kid">&minus;</button>
              <input type="number" id="kids" value="0" min="0" max="10" class="w-10 text-center p-1 text-xl text-primary-dark font-extrabold bg-transparent focus:outline-none" readonly>
              <button type="button" id="plusKids" class="w-8 h-8 flex items-center justify-center bg-accent text-white rounded-full text-lg font-bold hover:bg-accent/90 transition focus:outline-none focus:ring-2 focus:ring-accent/50 focus:ring-offset-1" aria-label="Add Kid">&plus;</button>
            </div>
          </div>
          
          <div class="pt-3 text-right border-t border-gray-100">
            <button type="button" id="guestDone" class="px-5 py-2 bg-primary-dark text-white rounded-full font-semibold shadow-lg hover:bg-[#1E3722] transition-colors duration-300">Done</button>
          </div>
</div>

      </div>

      <div class="md:col-span-1">
        <label class="block mb-2 font-bold text-gray-700 invisible md:visible">_</label>
        <button type="button" id="reviewBooking" 
                class="w-full bg-primary-dark text-white py-3 rounded-lg font-bold shadow-lg hover:bg-[#1E3722] transition-colors duration-300 transform hover:scale-105 active:scale-100">
          Book Now
        </button>
      </div>


    </form>
  </section>

  <section class="max-w-5xl mx-auto mt-16 px-4 md:px-0 pb-16">
<h2 class="text-3xl font-bold mb-6 text-center text-[#73AF6F]">Gallery</h2>

    <div class="grid grid-cols-2 gap-4">

        <div class="flex flex-col gap-4">
            <img src="/assets/img/room4.jpg" alt="Room" class="rounded shadow object-cover w-full h-80 hover:scale-105 transition">
            <img src="/assets/img/livingroom.jpg" alt="Living Room" class="rounded shadow object-cover w-full h-64 hover:scale-105 transition">
        </div>

        <div class="flex flex-col gap-4">
            <img src="/assets/img/kitchen.jpeg" alt="Kitchen" class="rounded shadow object-cover w-full h-64 hover:scale-105 transition">
            <img src="/assets/img/toilet.jpg" alt="Toilet" class="rounded shadow object-cover w-full h-80 hover:scale-105 transition">
        </div>

    </div>
</section>

  <?= view('components/footer') ?>

<div id="bookingModal" class="hidden fixed inset-0 bg-black bg-opacity-70 z-50 flex justify-center items-center p-4 transition-opacity duration-300">
    <div class="bg-white rounded-xl shadow-3xl w-full max-w-4xl p-8 relative transform scale-95 opacity-0 transition-all duration-300 ease-out">
        
        <button id="closeModal" class="absolute top-4 left-4 text-gray-400 hover:text-gray-800 text-3xl font-bold transition-transform hover:rotate-90 duration-300">&times;</button>
        
        <h3 class="text-3xl font-extrabold mb-6 text-center text-primary-dark border-b-2 pb-3 border-accent">Confirm Your Booking</h3>
        
        <div class="grid md:grid-cols-2 modal-grid-layout">
            
            <div class="md:pr-4 pb-4 md:pb-0">
                <h4 class="text-xl font-bold mb-3 text-primary-dark">Select Payment Method</h4>
                
                <div id="payment-logos" class="mb-5 grid grid-cols-3 gap-3">
                    
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
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5e/Visa_Inc._logo.svg/1280px-Visa_Inc._logo.svg.png" alt="Visa" class="h-8 w-12 md:h-10 md:w-16">
                    </label>

                </div>
                
                <div class="mt-4 p-4 border-t-4 border-red-500 bg-red-50 rounded-lg shadow-md">
                    <p class="text-base font-bold text-red-700 flex items-center mb-2">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                        Cancellation Policy
                    </p>
                    <ul class="text-sm text-gray-600 ml-7 list-disc space-y-1">
                        <li>**Strict:** Full refund for cancellations made within 48 hours of booking, if the check-in date is at least 14 days away.</li>
                        <li>50% refund for cancellations made at least 7 days before check-in. **No refund** thereafter.</li>
                        <li>Changing dates is subject to host approval and availability.</li>
                        <li>Bookings made within 7 days of check-in are non-refundable.</li>
                    </ul>
                </div>
            </div>

            <div class="md:pl-4">
                <h4 class="text-xl font-bold mb-3 text-primary-dark">Reservation Summary</h4>
                <div class="space-y-4 p-5 bg-secondary-light rounded-lg border border-secondary-light shadow-inner">
                    <div class="flex justify-between items-center border-b border-gray-200 pb-2">
                        <span class="font-semibold text-gray-700">Transaction ID:</span>
                        <span id="modalTransactionId" class="font-bold text-red-500"></span>
                    </div>

                    <div class="flex justify-between items-center border-b border-gray-200 pb-2">
                        <span class="font-semibold text-gray-700">Check-in Date:</span>
                        <span id="modalCheckIn" class="font-bold text-primary-dark"></span>
                    </div>
                    <div class="flex justify-between items-center border-b border-gray-200 pb-2">
                        <span class="font-semibold text-gray-700">Check-out Date:</span>
                        <span id="modalCheckOut" class="font-bold text-primary-dark"></span>
                    </div>
                    <div class="flex justify-between items-center border-b border-gray-200 pb-2">
                        <span class="font-semibold text-gray-700">Nights:</span>
                        <span id="modalNights" class="font-bold text-primary-dark"></span>
                    </div>
                    <div class="flex justify-between items-center pt-2">
                        <span class="font-semibold text-gray-700">Price per night:</span>
                        <span class="font-extrabold text-green-700 text-lg">₱<span id="modalPricePerNight">2,500</span></span>
                    </div>
                </div>
                
                <div class="flex justify-between items-center bg-primary-dark text-white p-4 rounded-lg mt-4 shadow-lg">
                    <span class="text-xl font-bold">Total Payable:</span>
                    <span class="text-3xl font-extrabold text-total-price">₱<span id="modalTotalPrice">0.00</span></span>
                </div>
            </div>

        </div>
        <div class="mt-8 text-center">
            <button type="button" id="proceedToPayment" class="bg-accent text-white py-3 px-12 rounded-lg font-bold text-lg shadow-xl hover:bg-accent/90 transition-all duration-300 transform hover:scale-105">
                Proceed to Payment
            </button>
        </div>

    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    let selectedDates = []; // Global array to store dates from Flatpickr
    const PRICE_PER_NIGHT = 2500; // Define the price per night

    // Function to generate a random alphanumeric ID
    function generateTransactionId(length = 10) {
        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        let result = '';
        for (let i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() * characters.length));
        }
        return 'TXN-' + result;
    }

    // Initialize flatpickr as date range picker
    flatpickr("#dateRange", {
        mode: "range",
        dateFormat: "Y-m-d",
        minDate: "today",
        onChange: function(dates, dateStr, instance) {
            selectedDates = dates; // Store the selected dates
        }
    });

    // Guest dropdown toggle - unchanged
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

    // Adults plus / minus - unchanged
    const adultsInput = document.getElementById("adults");
    document.getElementById("plusAdults").addEventListener("click", (e) => {
        e.stopPropagation();
        if (adultsInput.value < 10) adultsInput.value = parseInt(adultsInput.value) + 1;
        updateGuestSummary();
    });
    document.getElementById("minusAdults").addEventListener("click", (e) => {
        e.stopPropagation();
        if (adultsInput.value > 1) adultsInput.value = parseInt(adultsInput.value) - 1;
        updateGuestSummary();
    });

    // Kids plus / minus - unchanged
    const kidsInput = document.getElementById("kids");
    document.getElementById("plusKids").addEventListener("click", (e) => {
        e.stopPropagation();
        if (kidsInput.value < 10) kidsInput.value = parseInt(kidsInput.value) + 1;
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

    // Helper function to format currency - unchanged
    function formatCurrency(amount) {
        return new Intl.NumberFormat('en-PH', { style: 'decimal' }).format(amount);
    }

    // Function to show/hide the modal - unchanged
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
        }, { once: true });
    }

    // Book button review (shows the modal) - unchanged logic
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
        
        const totalPrice = diffDays * PRICE_PER_NIGHT;

        // Populate Modal
        modalTransactionId.textContent = generateTransactionId(); 
        modalCheckIn.textContent = checkInDate.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
        modalCheckOut.textContent = checkOutDate.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
        modalNights.textContent = `${diffDays} night${diffDays > 1 ? 's' : ''}`;
        
        modalPricePerNight.textContent = formatCurrency(PRICE_PER_NIGHT);
        modalTotalPrice.textContent = formatCurrency(totalPrice);
        
        showModal(); 
    });
    
    // Close Modal event listeners - unchanged
    closeModalBtn.addEventListener("click", hideModal);
    bookingModal.addEventListener('click', (e) => {
        if (e.target === bookingModal) {
            hideModal();
        }
    });

    // Handle Proceed to Payment button click - unchanged logic
    proceedToPaymentBtn.addEventListener('click', () => {
        const selectedPayment = document.querySelector('input[name="paymentMethod"]:checked').value;
        const totalAmount = modalTotalPrice.textContent; 
        const transactionId = modalTransactionId.textContent;
        
        alert(`Proceeding to payment.\nTransaction ID: ${transactionId}\nTotal Amount: ₱${totalAmount}\nMethod: ${selectedPayment.toUpperCase()}`);
        hideModal(); 
    });

    // Close dropdown when clicking outside - unchanged
    document.addEventListener("click", function(e) {
      if (!guestBtn.contains(e.target) && !guestDropdown.contains(e.target) && !modalContent.contains(e.target)) {
        guestDropdown.classList.add("hidden");
      }
    });
    
    // Set initial price per night on load - unchanged
    document.getElementById("modalPricePerNight").textContent = formatCurrency(PRICE_PER_NIGHT);

    // NEW: Payment Option Click Handler (Logo Selection)
    document.querySelectorAll('.payment-logo-option').forEach(label => {
        label.addEventListener('click', (event) => {
            // Remove 'selected' class from all options
            document.querySelectorAll('.payment-logo-option').forEach(opt => {
                opt.classList.remove('selected');
            });

            // Add 'selected' class to the clicked label
            const currentLabel = event.currentTarget;
            currentLabel.classList.add('selected');
            
            // Manually check the hidden radio button
            const radioInput = currentLabel.querySelector('input[type="radio"]');
            if (radioInput) {
                radioInput.checked = true;
            }
        });
    });

    // Set initial style for the default checked radio button
    // This is run once on script load
    const initiallyCheckedRadio = document.querySelector('input[name="paymentMethod"]:checked');
    if (initiallyCheckedRadio) {
        initiallyCheckedRadio.closest('.payment-logo-option').classList.add('selected');
    }

</script>
</body>
</html>