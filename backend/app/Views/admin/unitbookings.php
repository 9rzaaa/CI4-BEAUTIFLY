<!DOCTYPE html>
<html lang="en">
<?php include APPPATH . 'Views/components/head.php'; ?>
<!-- File: app/Views/admin/unitbookings.php -->

<body class="bg-gray-50">
    <?php include APPPATH . 'Views/components/header.php'; ?>

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <?php include APPPATH . 'Views/components/admin/sidebar.php'; ?>

        <!-- Main Content -->
        <main class="flex-1 ml-64 p-8">
            <div class="mb-8">
                <h1 class="mb-2 font-bold text-gray-800 text-3xl">Booking Management</h1>
                <p class="text-gray-600">View and manage all property bookings</p>
            </div>

            <!-- Filters and Search -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                        <input type="text" id="searchInput" placeholder="Search by user or property..." 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select id="statusFilter" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">All Statuses</option>
                            <option value="pending">Pending</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="cancelled">Cancelled</option>
                            <option value="completed">Completed</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Date From</label>
                        <input type="date" id="dateFrom" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Date To</label>
                        <input type="date" id="dateTo" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                </div>
                <div class="flex justify-end mt-4 gap-2">
                    <button onclick="resetFilters()" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">
                        Reset
                    </button>
                    <button onclick="applyFilters()" class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                        Apply Filters
                    </button>
                </div>
            </div>

            <!-- Bookings Table -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Booking ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Property</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check-in</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check-out</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Guests</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="bookingsTableBody" class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td colspan="9" class="px-6 py-8 text-center text-gray-500">
                                    Loading bookings...
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
    
                <!-- Pagination -->
                <div class="bg-gray-50 px-6 py-4 flex items-center justify-between border-t border-gray-200">
                    <div class="text-sm text-gray-700">
                        Showing <span id="showingFrom">0</span> to <span id="showingTo">0</span> of <span id="totalRecords">0</span> results
                    </div>
                    <div class="flex gap-2" id="paginationControls">
                        <!-- Pagination buttons loaded here -->
                    </div>
                </div>
            </div>
        </main>
    </div>

        <!-- Edit Booking Modal -->
    <div id="editModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-lg bg-white">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-900">Edit Booking</h3>
                <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <form id="editBookingForm">
                <input type="hidden" id="editBookingId">
                
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Check-in Date</label>
                        <input type="date" id="editCheckinDate" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Check-out Date</label>
                        <input type="date" id="editCheckoutDate" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Adults</label>
                        <input type="number" id="editAdults" min="1" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kids</label>
                        <input type="number" id="editKids" min="0" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select id="editStatus" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="pending">Pending</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="cancelled">Cancelled</option>
                            <option value="completed">Completed</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Special Requests</label>
                    <textarea id="editSpecialRequests" rows="3"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                </div>

                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeEditModal()" 
                            class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- View Details Modal -->
    <div id="viewModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-full max-w-3xl shadow-lg rounded-lg bg-white">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-900">Booking Details</h3>
                <button onclick="closeViewModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <div id="bookingDetailsContent" class="space-y-4">
                <!-- Dynamic content loaded here -->
            </div>
        </div>
    </div>

       <script>
        const baseUrl = '<?= base_url() ?>';
        let currentPage = 1;
        let totalPages = 1;
        const perPage = 10;

        // Load bookings on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadBookings();
        });

        // Load bookings with filters
        function loadBookings(page = 1) {
            currentPage = page;
            const search = document.getElementById('searchInput').value;
            const status = document.getElementById('statusFilter').value;
            const dateFrom = document.getElementById('dateFrom').value;
            const dateTo = document.getElementById('dateTo').value;

            const params = new URLSearchParams({
                page: page,
                per_page: perPage,
                search: search,
                status: status,
                date_from: dateFrom,
                date_to: dateTo
            });

            fetch(`${baseUrl}/admin/bookings/list?${params}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        renderBookings(data.bookings);
                        renderPagination(data.pagination);
                    } else {
                        showNotification('Error loading bookings', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Error loading bookings', 'error');
                });
        }
                function renderBookings(bookings) {
            const tbody = document.getElementById('bookingsTableBody');
           
            if (bookings.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="9" class="px-6 py-8 text-center text-gray-500">
                            No bookings found
                        </td>
                    </tr>
                `;
                return;
            }

            tbody.innerHTML = bookings.map(booking => `
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        #${booking.id}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">${booking.user_name || 'N/A'}</div>
                        <div class="text-sm text-gray-500">${booking.user_email || 'N/A'}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm font-medium text-gray-900">${booking.property_name || 'N/A'}</div>
                        <div class="text-sm text-gray-500">${booking.property_location || 'N/A'}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        ${booking.check_in}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        ${booking.check_out}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        ${booking.guests} (${booking.adults}A + ${booking.kids}K)
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        $${parseFloat(booking.total_price).toFixed(2)}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        ${getStatusBadge(booking.status)}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex gap-2">
                            <button onclick="viewBooking(${booking.id})"
                                    class="text-blue-600 hover:text-blue-900" title="View">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                            <button onclick="editBooking(${booking.id})"
                                    class="text-green-600 hover:text-green-900" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                            <button onclick="deleteBooking(${booking.id})"
                                    class="text-red-600 hover:text-red-900" title="Delete">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
            `).join('');
        }


        function getStatusBadge(status) {
            const badges = {
                pending: '<span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>',
                confirmed: '<span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Confirmed</span>',
                cancelled: '<span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Cancelled</span>',
                completed: '<span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Completed</span>',
                rejected: '<span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Rejected</span>'
            };
            return badges[status] || status;
        }


        function renderPagination(pagination) {
            document.getElementById('showingFrom').textContent = pagination.from || 0;
            document.getElementById('showingTo').textContent = pagination.to || 0;
            document.getElementById('totalRecords').textContent = pagination.total || 0;
           
            totalPages = pagination.total_pages || 1;
            const controls = document.getElementById('paginationControls');
           
            let html = '';
           
            // Previous button
            html += `<button onclick="loadBookings(${currentPage - 1})"
                            ${currentPage === 1 ? 'disabled' : ''}
                            class="px-3 py-1 rounded border ${currentPage === 1 ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'bg-white text-gray-700 hover:bg-gray-50'}">
                        Previous
                    </button>`;
           
            // Page numbers
            for (let i = 1; i <= totalPages; i++) {
                if (i === 1 || i === totalPages || (i >= currentPage - 1 && i <= currentPage + 1)) {
                    html += `<button onclick="loadBookings(${i})"
                                    class="px-3 py-1 rounded border ${i === currentPage ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50'}">
                                ${i}
                            </button>`;
                } else if (i === currentPage - 2 || i === currentPage + 2) {
                    html += '<span class="px-2">...</span>';
                }
            }
           
            // Next button
            html += `<button onclick="loadBookings(${currentPage + 1})"
                            ${currentPage === totalPages ? 'disabled' : ''}
                            class="px-3 py-1 rounded border ${currentPage === totalPages ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'bg-white text-gray-700 hover:bg-gray-50'}">
                        Next
                    </button>`;
           
            controls.innerHTML = html;
        }
    
        function applyFilters() {
            loadBookings(1);
        }

        function resetFilters() {
            document.getElementById('searchInput').value = '';
            document.getElementById('statusFilter').value = '';
            document.getElementById('dateFrom').value = '';
            document.getElementById('dateTo').value = '';
            loadBookings(1);
        }

        function viewBooking(id) {
            fetch(`${baseUrl}/admin/bookings/view/${id}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showBookingDetails(data.booking);
                    } else {
                        showNotification('Error loading booking details', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Error loading booking details', 'error');
                });
        }
         function showBookingDetails(booking) {
            const content = document.getElementById('bookingDetailsContent');
            content.innerHTML = `
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <h4 class="font-semibold text-gray-700 mb-2">Booking Information</h4>
                        <div class="space-y-2 text-sm">
                            <p><span class="font-medium">Booking ID:</span> #${booking.id}</p>
                            <p><span class="font-medium">Status:</span> ${getStatusBadge(booking.status)}</p>
                            <p><span class="font-medium">Payment Status:</span> ${booking.payment_status || 'N/A'}</p>
                            <p><span class="font-medium">Created:</span> ${booking.created_at}</p>
                        </div>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-700 mb-2">Guest Information</h4>
                        <div class="space-y-2 text-sm">
                            <p><span class="font-medium">Name:</span> ${booking.user_name || 'N/A'}</p>
                            <p><span class="font-medium">Email:</span> ${booking.user_email || 'N/A'}</p>
                            <p><span class="font-medium">Phone:</span> ${booking.user_phone || 'N/A'}</p>
                        </div>
                    </div>
                </div>
               
                <div class="border-t pt-4">
                    <h4 class="font-semibold text-gray-700 mb-2">Property Details</h4>
                    <div class="space-y-2 text-sm">
                        <p><span class="font-medium">Property:</span> ${booking.property_name || 'N/A'}</p>
                        <p><span class="font-medium">Location:</span> ${booking.property_location || 'N/A'}</p>
                    </div>
                </div>
               
                <div class="border-t pt-4">
                    <h4 class="font-semibold text-gray-700 mb-2">Stay Details</h4>
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <p><span class="font-medium">Check-in:</span> ${booking.check_in}</p>
                            <p><span class="font-medium">Check-out:</span> ${booking.check_out}</p>
                        </div>
                        <div>
                            <p><span class="font-medium">Adults:</span> ${booking.adults}</p>
                            <p><span class="font-medium">Kids:</span> ${booking.kids}</p>
                            <p><span class="font-medium">Nights:</span> ${booking.number_of_nights}</p>
                        </div>
                    </div>
                </div>
               
                <div class="border-t pt-4">
                    <h4 class="font-semibold text-gray-700 mb-2">Payment</h4>
                    <div class="space-y-2 text-sm">
                        <p><span class="font-medium">Price per Night:</span> $${parseFloat(booking.price_per_night).toFixed(2)}</p>
                        <p><span class="font-medium">Cleaning Fee:</span> $${parseFloat(booking.cleaning_fee).toFixed(2)}</p>
                        <p><span class="font-medium">Total Amount:</span> $${parseFloat(booking.total_price).toFixed(2)}</p>
                        <p><span class="font-medium">Payment Method:</span> ${booking.payment_method || 'N/A'}</p>
                        ${booking.transaction_id ? `<p><span class="font-medium">Transaction ID:</span> ${booking.transaction_id}</p>` : ''}
                    </div>
                </div>
               
                ${booking.special_requests ? `
                <div class="border-t pt-4">
                    <h4 class="font-semibold text-gray-700 mb-2">Special Requests</h4>
                    <p class="text-sm text-gray-600">${booking.special_requests}</p>
                </div>
                ` : ''}
            `;
           
            document.getElementById('viewModal').classList.remove('hidden');
        }

        function closeViewModal() {
            document.getElementById('viewModal').classList.add('hidden');
        }


        function editBooking(id) {
            fetch(`${baseUrl}/admin/bookings/view/${id}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        populateEditForm(data.booking);
                    } else {
                        showNotification('Error loading booking', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Error loading booking', 'error');
                });
        }
    </script>    
</body>
</html>