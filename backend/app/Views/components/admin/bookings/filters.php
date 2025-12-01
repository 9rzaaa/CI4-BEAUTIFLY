<div class="bg-white shadow-sm mb-6 p-6 rounded-lg">
    <div class="gap-4 grid grid-cols-1 md:grid-cols-4">
        <!-- Search Input -->
        <div>
            <label class="block mb-2 font-medium text-gray-700 text-sm">Search</label>
            <input type="text"
                id="searchInput"
                placeholder="Search by user or property..."
                class="px-4 py-2 border border-gray-300 focus:border-transparent rounded-lg focus:ring-2 focus:ring-blue-500 w-full">
        </div>

        <!-- Status Filter -->
        <div>
            <label class="block mb-2 font-medium text-gray-700 text-sm">Status</label>
            <select id="statusFilter"
                class="px-4 py-2 border border-gray-300 focus:border-transparent rounded-lg focus:ring-2 focus:ring-blue-500 w-full">
                <option value="">All Statuses</option>
                <option value="pending">Pending</option>
                <option value="confirmed">Confirmed</option>
                <option value="cancelled">Cancelled</option>
                <option value="completed">Completed</option>
                <option value="rejected">Rejected</option>
            </select>
        </div>

        <!-- Date From -->
        <div>
            <label class="block mb-2 font-medium text-gray-700 text-sm">Date From</label>
            <input type="date"
                id="dateFrom"
                class="px-4 py-2 border border-gray-300 focus:border-transparent rounded-lg focus:ring-2 focus:ring-blue-500 w-full">
        </div>

        <!-- Date To -->
        <div>
            <label class="block mb-2 font-medium text-gray-700 text-sm">Date To</label>
            <input type="date"
                id="dateTo"
                class="px-4 py-2 border border-gray-300 focus:border-transparent rounded-lg focus:ring-2 focus:ring-blue-500 w-full">
        </div>
    </div>

    <!-- Filter Actions -->
    <div class="flex justify-end gap-2 mt-4">
        <button onclick="resetFilters()"
            class="bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg text-gray-700">
            Reset
        </button>
        <button onclick="applyFilters()"
            class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg text-white">
            Apply Filters
        </button>
    </div>
</div>