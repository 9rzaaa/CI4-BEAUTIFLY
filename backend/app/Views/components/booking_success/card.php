<main class="py-16">
<div class="mx-auto px-4 max-w-4xl">

    <div class="bg-white shadow-2xl p-8 md:p-12 rounded-2xl text-center fade-in">

        <!-- Checkmark -->
        <div class="mb-6 success-checkmark">
            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none" />
                <path class="checkmark-check" fill="none" stroke-width="3" stroke-linecap="round" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
            </svg>
        </div>

        <h1 class="mb-3 font-extrabold text-primary-dark text-4xl md:text-5xl">Booking Confirmed! 🎉</h1>
        <p class="mb-2 text-gray-600 text-lg">Your reservation has been successfully confirmed.</p>
        <p class="mb-8 text-gray-500">A confirmation email has been sent to your registered email address.</p>

        <!-- Transaction ID -->
        <div class="inline-block bg-accent/10 mb-8 px-6 py-3 border-2 border-accent rounded-lg">
            <p class="mb-1 text-gray-600 text-sm">Transaction ID</p>
            <p class="font-bold text-accent text-2xl"><?= esc($transaction_id) ?></p>
        </div>
