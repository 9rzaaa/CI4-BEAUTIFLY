<div id="editModal"
    class="hidden z-50 fixed inset-0 bg-gray-600 bg-opacity-50 w-full h-full overflow-y-auto">
    <div class="top-20 relative bg-white shadow-lg mx-auto p-5 border rounded-lg w-full max-w-2xl">
        <!-- Modal Header -->
        <div class="flex justify-between items-center mb-4">
            <h3 class="font-bold text-gray-900 text-xl">Edit Booking</h3>
            <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Edit Form -->
        <form id="editBookingForm">
            <input type="hidden" id="editBookingId">

            <!-- Check-in/Check-out Dates -->
            <div class="gap-4 grid grid-cols-2 mb-4">
                <div>
                    <label class="block mb-2 font-medium text-gray-700 text-sm">Check-in Date</label>
                    <input type="date"
                        id="editCheckinDate"
                        required
                        class="px-4 py-2 border border-gray-300 focus:border-transparent rounded-lg focus:ring-2 focus:ring-blue-500 w-full">
                </div>
                <div>
                    <label class="block mb-2 font-medium text-gray-700 text-sm">Check-out Date</label>
                    <input type="date"
                        id="editCheckoutDate"
                        required
                        class="px-4 py-2 border border-gray-300 focus:border-transparent rounded-lg focus:ring-2 focus:ring-blue-500 w-full">
                </div>
            </div>

            <!-- Adults/Kids/Status -->
            <div class="gap-4 grid grid-cols-3 mb-4">
                <div>
                    <label class="block mb-2 font-medium text-gray-700 text-sm">Adults</label>
                    <input type="number"
                        id="editAdults"
                        min="1"
                        required
                        class="px-4 py-2 border border-gray-300 focus:border-transparent rounded-lg focus:ring-2 focus:ring-blue-500 w-full">
                </div>
                <div>
                    <label class="block mb-2 font-medium text-gray-700 text-sm">Kids</label>
                    <input type="number"
                        id="editKids"
                        min="0"
                        required
                        class="px-4 py-2 border border-gray-300 focus:border-transparent rounded-lg focus:ring-2 focus:ring-blue-500 w-full">
                </div>
                <div>
                    <label class="block mb-2 font-medium text-gray-700 text-sm">Status</label>
                    <select id="editStatus"
                        required
                        class="px-4 py-2 border border-gray-300 focus:border-transparent rounded-lg focus:ring-2 focus:ring-blue-500 w-full">
                        <option value="pending">Pending</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="cancelled">Cancelled</option>
                        <option value="completed">Completed</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>
            </div>

            <!-- Special Requests -->
            <div class="mb-4">
                <label class="block mb-2 font-medium text-gray-700 text-sm">Special Requests</label>
                <textarea id="editSpecialRequests"
                    rows="3"
                    class="px-4 py-2 border border-gray-300 focus:border-transparent rounded-lg focus:ring-2 focus:ring-blue-500 w-full"></textarea>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end gap-2">
                <button type="button"
                    onclick="closeEditModal()"
                    class="bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg text-gray-700">
                    Cancel
                </button>
                <button type="submit"
                    id="saveChangesBtn"
                    class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg text-white">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>