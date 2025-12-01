<div class="bg-white shadow-sm rounded-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <!-- Table Header -->
            <thead class="bg-gray-50 border-gray-200 border-b">
                <tr>
                    <th class="px-6 py-3 font-medium text-gray-500 text-xs text-left uppercase tracking-wider">
                        Booking ID
                    </th>
                    <th class="px-6 py-3 font-medium text-gray-500 text-xs text-left uppercase tracking-wider">
                        User
                    </th>
                    <th class="px-6 py-3 font-medium text-gray-500 text-xs text-left uppercase tracking-wider">
                        Property
                    </th>
                    <th class="px-6 py-3 font-medium text-gray-500 text-xs text-left uppercase tracking-wider">
                        Check-in
                    </th>
                    <th class="px-6 py-3 font-medium text-gray-500 text-xs text-left uppercase tracking-wider">
                        Check-out
                    </th>
                    <th class="px-6 py-3 font-medium text-gray-500 text-xs text-left uppercase tracking-wider">
                        Guests
                    </th>
                    <th class="px-6 py-3 font-medium text-gray-500 text-xs text-left uppercase tracking-wider">
                        Total
                    </th>
                    <th class="px-6 py-3 font-medium text-gray-500 text-xs text-left uppercase tracking-wider">
                        Status
                    </th>
                    <th class="px-6 py-3 font-medium text-gray-500 text-xs text-left uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>

            <!-- Table Body (Populated by JavaScript) -->
            <tbody id="bookingsTableBody" class="bg-white divide-y divide-gray-200">
                <tr>
                    <td colspan="9" class="px-6 py-8 text-gray-500 text-center">
                        Loading bookings...
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="flex justify-between items-center bg-gray-50 px-6 py-4 border-gray-200 border-t">
        <div class="text-gray-700 text-sm">
            Showing <span id="showingFrom">0</span> to <span id="showingTo">0</span>
            of <span id="totalRecords">0</span> results
        </div>
        <div class="flex gap-2" id="paginationControls"></div>
    </div>
</div>