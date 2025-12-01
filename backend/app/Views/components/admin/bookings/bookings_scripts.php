<script>
    const baseUrl = '<?= base_url() ?>';
    let currentPage = 1;
    let totalPages = 1;
    const perPage = 10;

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', () => {
        loadBookings();
    });

    // Load bookings from API
    function loadBookings(page = 1) {
        currentPage = page;
        const params = new URLSearchParams({
            page: page,
            per_page: perPage,
            search: document.getElementById('searchInput').value,
            status: document.getElementById('statusFilter').value,
            date_from: document.getElementById('dateFrom').value,
            date_to: document.getElementById('dateTo').value
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

    // Render bookings table rows
    function renderBookings(bookings) {
        const tbody = document.getElementById('bookingsTableBody');

        if (bookings.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="9" class="px-6 py-8 text-gray-500 text-center">
                        No bookings found
                    </td>
                </tr>
            `;
            return;
        }

        tbody.innerHTML = bookings.map(booking => `
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 font-medium text-gray-900 text-sm whitespace-nowrap">
                    #${booking.id}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="font-medium text-gray-900 text-sm">${booking.user_name || 'N/A'}</div>
                    <div class="text-gray-500 text-sm">${booking.user_email || 'N/A'}</div>
                </td>
                <td class="px-6 py-4">
                    <div class="font-medium text-gray-900 text-sm">${booking.property_name || 'N/A'}</div>
                    <div class="text-gray-500 text-sm">${booking.property_location || 'N/A'}</div>
                </td>
                <td class="px-6 py-4 text-gray-900 text-sm whitespace-nowrap">
                    ${booking.check_in}
                </td>
                <td class="px-6 py-4 text-gray-900 text-sm whitespace-nowrap">
                    ${booking.check_out}
                </td>
                <td class="px-6 py-4 text-gray-900 text-sm whitespace-nowrap">
                    ${booking.guests} (${booking.adults}A + ${booking.kids}K)
                </td>
                <td class="px-6 py-4 font-medium text-gray-900 text-sm whitespace-nowrap">
                    $${booking.total_price_formatted}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    ${booking.status_badge}
                </td>
                <td class="px-6 py-4 font-medium text-sm whitespace-nowrap">
                    <div class="flex gap-2">
                        <button onclick="viewBooking(${booking.id})"
                                class="text-blue-600 hover:text-blue-900" title="View">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </button>
                        <button onclick="editBooking(${booking.id})"
                                class="text-green-600 hover:text-green-900" title="Edit">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </button>
                        <button onclick="deleteBooking(${booking.id})"
                                class="text-red-600 hover:text-red-900" title="Delete">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </div>
                </td>
            </tr>
        `).join('');
    }

    // Render pagination controls
    function renderPagination(pagination) {
        document.getElementById('showingFrom').textContent = pagination.from || 0;
        document.getElementById('showingTo').textContent = pagination.to || 0;
        document.getElementById('totalRecords').textContent = pagination.total || 0;

        totalPages = pagination.total_pages || 1;
        const controls = document.getElementById('paginationControls');

        let html = '';

        html += `<button onclick="loadBookings(${currentPage - 1})"
                        ${currentPage === 1 ? 'disabled' : ''}
                        class="px-3 py-1 rounded border ${currentPage === 1 ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'bg-white text-gray-700 hover:bg-gray-50'}">
                    Previous
                </button>`;

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

        html += `<button onclick="loadBookings(${currentPage + 1})"
                        ${currentPage === totalPages ? 'disabled' : ''}
                        class="px-3 py-1 rounded border ${currentPage === totalPages ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'bg-white text-gray-700 hover:bg-gray-50'}">
                    Next
                </button>`;

        controls.innerHTML = html;
    }

    // Filter functions
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

    // View booking details
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
            <div class="gap-4 grid grid-cols-2">
                <div>
                    <h4 class="mb-2 font-semibold text-gray-700">Booking Information</h4>
                    <div class="space-y-2 text-sm">
                        <p><span class="font-medium">Booking ID:</span> #${booking.id}</p>
                        <p><span class="font-medium">Status:</span> ${booking.status_badge}</p>
                        <p><span class="font-medium">Payment Status:</span> ${booking.payment_status || 'N/A'}</p>
                        <p><span class="font-medium">Created:</span> ${booking.created_at}</p>
                    </div>
                </div>
                <div>
                    <h4 class="mb-2 font-semibold text-gray-700">Guest Information</h4>
                    <div class="space-y-2 text-sm">
                        <p><span class="font-medium">Name:</span> ${booking.user_name || 'N/A'}</p>
                        <p><span class="font-medium">Email:</span> ${booking.user_email || 'N/A'}</p>
                    </div>
                </div>
            </div>
           
            <div class="pt-4 border-t">
                <h4 class="mb-2 font-semibold text-gray-700">Property Details</h4>
                <div class="space-y-2 text-sm">
                    <p><span class="font-medium">Property:</span> ${booking.property_name || 'N/A'}</p>
                    <p><span class="font-medium">Location:</span> ${booking.property_location || 'N/A'}</p>
                </div>
            </div>
           
            <div class="pt-4 border-t">
                <h4 class="mb-2 font-semibold text-gray-700">Stay Details</h4>
                <div class="gap-4 grid grid-cols-2 text-sm">
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
           
            <div class="pt-4 border-t">
                <h4 class="mb-2 font-semibold text-gray-700">Payment</h4>
                <div class="space-y-2 text-sm">
                    <p><span class="font-medium">Price per Night:</span> $${booking.price_per_night_formatted}</p>
                    <p><span class="font-medium">Cleaning Fee:</span> $${booking.cleaning_fee_formatted}</p>
                    <p><span class="font-medium">Total Amount:</span> $${booking.total_price_formatted}</p>
                    <p><span class="font-medium">Payment Method:</span> ${booking.payment_method || 'N/A'}</p>
                    ${booking.transaction_id ? `<p><span class="font-medium">Transaction ID:</span> ${booking.transaction_id}</p>` : ''}
                </div>
            </div>
           
            ${booking.special_requests ? `
            <div class="pt-4 border-t">
                <h4 class="mb-2 font-semibold text-gray-700">Special Requests</h4>
                <p class="text-gray-600 text-sm">${booking.special_requests}</p>
            </div>
            ` : ''}
        `;

        document.getElementById('viewModal').classList.remove('hidden');
    }

    function closeViewModal() {
        document.getElementById('viewModal').classList.add('hidden');
    }

    // Edit booking
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

    function populateEditForm(booking) {
        document.getElementById('editBookingId').value = booking.id;
        document.getElementById('editCheckinDate').value = booking.check_in;
        document.getElementById('editCheckoutDate').value = booking.check_out;
        document.getElementById('editAdults').value = booking.adults;
        document.getElementById('editKids').value = booking.kids;
        document.getElementById('editStatus').value = booking.status;
        document.getElementById('editSpecialRequests').value = booking.special_requests || '';

        document.getElementById('editModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
        document.getElementById('editBookingForm').reset();
    }

    // Handle edit form submission
    document.getElementById('editBookingForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const saveBtn = document.getElementById('saveChangesBtn');
        const originalText = saveBtn.textContent;

        saveBtn.disabled = true;
        saveBtn.textContent = 'Processing...';
        saveBtn.classList.add('opacity-50', 'cursor-not-allowed');

        const formData = {
            id: document.getElementById('editBookingId').value,
            check_in: document.getElementById('editCheckinDate').value,
            check_out: document.getElementById('editCheckoutDate').value,
            adults: document.getElementById('editAdults').value,
            kids: document.getElementById('editKids').value,
            status: document.getElementById('editStatus').value,
            special_requests: document.getElementById('editSpecialRequests').value
        };

        fetch(`${baseUrl}/admin/bookings/update`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('Booking updated successfully', 'success');
                    closeEditModal();
                    loadBookings(currentPage);
                } else {
                    showNotification(data.message || 'Error updating booking', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Error updating booking', 'error');
            })
            .finally(() => {
                saveBtn.disabled = false;
                saveBtn.textContent = originalText;
                saveBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            });
    });

    // Delete booking
    function deleteBooking(id) {
        if (!confirm('Are you sure you want to delete this booking? This action cannot be undone.')) {
            return;
        }

        fetch(`${baseUrl}/admin/bookings/delete/${id}`, {
                method: 'DELETE'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('Booking deleted successfully', 'success');
                    loadBookings(currentPage);
                } else {
                    showNotification(data.message || 'Error deleting booking', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Error deleting booking', 'error');
            });
    }

    // Notification helper
    function showNotification(message, type = 'info') {
        alert(message);
    }
</script>