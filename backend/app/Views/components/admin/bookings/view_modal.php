<div id="viewModal"
    class="hidden z-50 fixed inset-0 bg-gray-600 bg-opacity-50 w-full h-full overflow-y-auto">
    <div class="top-20 relative bg-white shadow-lg mx-auto p-5 border rounded-lg w-full max-w-3xl">
        <!-- Modal Header -->
        <div class="flex justify-between items-center mb-4">
            <h3 class="font-bold text-gray-900 text-xl">Booking Details</h3>
            <button onclick="closeViewModal()" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Modal Content (Populated by JavaScript) -->
        <div id="bookingDetailsContent" class="space-y-4"></div>
    </div>
</div>