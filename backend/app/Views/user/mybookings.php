<?php
$active = 'My Bookings';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings - EASY&CO</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#73AF6F',
                        accent: '#4A5F8F',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50">
    <?php echo view('components/header'); ?>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">My Bookings</h1>
            <p class="text-gray-600">View and manage your resort reservations</p>
        </div>

        <!-- Filter Tabs -->
        <div class="mb-6">
            <div class="flex flex-wrap gap-3">
                <button class="filter-tab active px-6 py-2.5 rounded-lg font-medium transition-all duration-200" data-filter="all">
                    All Bookings
                </button>
                <button class="filter-tab px-6 py-2.5 rounded-lg font-medium transition-all duration-200" data-filter="upcoming">
                    Upcoming
                </button>
                <button class="filter-tab px-6 py-2.5 rounded-lg font-medium transition-all duration-200" data-filter="completed">
                    Completed
                </button>
                <button class="filter-tab px-6 py-2.5 rounded-lg font-medium transition-all duration-200" data-filter="cancelled">
                    Cancelled
                </button>
            </div>
        </div>

        <!-- Bookings Container -->
        <div id="bookingsContainer">
            <!-- Loading State -->
            <div id="loadingState" class="text-center py-12">
                <div class="inline-block animate-spin rounded-full h-12 w-12 border-b-2 border-primary"></div>
                <p class="mt-4 text-gray-600">Loading your bookings...</p>
            </div>

            <!-- Empty State -->
            <div id="emptyState" class="hidden text-center py-16">
                <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <h3 class="mt-4 text-xl font-semibold text-gray-700">No bookings found</h3>
                <p class="mt-2 text-gray-500">You haven't made any bookings yet.</p>
                <a href="/booking" class="inline-block mt-6 bg-primary hover:bg-primary/90 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                    Book Now
                </a>
            </div>

            <!-- Bookings Grid -->
            <div id="bookingsGrid" class="hidden grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Booking cards will be dynamically inserted here -->
            </div>
        </div>
    </main>

    <!-- Booking Details Modal -->
    <div id="detailsModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div id="modalContent">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>

    <style>
        .filter-tab {
            background-color: white;
            color: #4B5563;
            border: 2px solid #E5E7EB;
        }
        
        .filter-tab:hover {
            border-color: #73AF6F;
            color: #73AF6F;
        }
        
        .filter-tab.active {
            background-color: #73AF6F;
            color: white;
            border-color: #73AF6F;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.375rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.025em;
        }

        .status-upcoming {
            background-color: #DBEAFE;
            color: #1E40AF;
        }

        .status-completed {
            background-color: #D1FAE5;
            color: #065F46;
        }

        .status-cancelled {
            background-color: #FEE2E2;
            color: #991B1B;
        }

        .status-pending {
            background-color: #FEF3C7;
            color: #92400E;
        }

        .booking-card {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .booking-card:hover {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .booking-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
    </style>
     <script>
        const API_BASE = '<?= base_url() ?>';
        let currentFilter = 'all';
        let bookingsData = [];


        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            loadBookings();


            // Add filter tab listeners
            document.querySelectorAll('.filter-tab').forEach(tab => {
                tab.addEventListener('click', function() {
                    document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                    currentFilter = this.dataset.filter;
                    loadBookings();
                });
            });


            // Close modal when clicking outside
            document.getElementById('detailsModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeModal();
                }
            });
        });


        async function loadBookings() {
            try {
                document.getElementById('loadingState').classList.remove('hidden');
                document.getElementById('bookingsGrid').classList.add('hidden');
                document.getElementById('emptyState').classList.add('hidden');


                const response = await fetch(`${API_BASE}/api/bookings/user?filter=${currentFilter}`);
                const data = await response.json();


                if (!data.success) {
                    throw new Error(data.error || 'Failed to load bookings');
                }


                bookingsData = data.bookings;
                document.getElementById('loadingState').classList.add('hidden');


                if (bookingsData.length === 0) {
                    document.getElementById('emptyState').classList.remove('hidden');
                } else {
                    document.getElementById('bookingsGrid').classList.remove('hidden');
                    renderBookings(bookingsData);
                }
            } catch (error) {
                console.error('Error loading bookings:', error);
                document.getElementById('loadingState').classList.add('hidden');
                alert('Failed to load bookings. Please try again.');
            }
        }


        function renderBookings(bookings) {
            const grid = document.getElementById('bookingsGrid');
           
            grid.innerHTML = bookings.map(booking => `
                <div class="booking-card" data-status="${booking.status}">
                    <img src="${booking.course_image}" alt="${booking.course_name}" class="booking-image">
                   
                    <div class="p-5">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="text-lg font-bold text-gray-800">${booking.course_name}</h3>
                            <span class="status-badge status-${booking.status}">${booking.status}</span>
                        </div>
                       
                        <div class="space-y-2 mb-4">
                            <div class="flex items-center text-gray-600 text-sm">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                ${formatDate(booking.booking_date)} - ${formatDate(booking.check_out)}
                            </div>
                           
                            <div class="flex items-center text-gray-600 text-sm">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                ${booking.adults} Adult${booking.adults > 1 ? 's' : ''} ${booking.kids > 0 ? '+ ' + booking.kids + ' Kid' + (booking.kids > 1 ? 's' : '') : ''}
                            </div>


                            <div class="flex items-center text-gray-600 text-sm">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                                ${booking.nights} Night${booking.nights > 1 ? 's' : ''}
                            </div>
                        </div>
                       
                        <div class="border-t pt-4 flex justify-between items-center">
                            <div>
                                <p class="text-xs text-gray-500">Booking Ref</p>
                                <p class="text-sm font-semibold text-gray-700">${booking.booking_reference}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-gray-500">Total</p>
                                <p class="text-lg font-bold text-primary">${booking.total_amount}</p>
                            </div>
                        </div>
                       
                        <div class="mt-4 flex gap-2">
                            <button onclick="viewBookingDetails(${booking.id})" class="flex-1 bg-accent hover:bg-accent/90 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                View Details
                            </button>
                            ${booking.status === 'upcoming' ? `
                                <button onclick="confirmCancelBooking(${booking.id})" class="px-4 py-2 border-2 border-red-500 text-red-500 hover:bg-red-50 rounded-lg text-sm font-medium transition-colors">
                                    Cancel
                                </button>
                            ` : ''}
                        </div>
                    </div>
                </div>
            `).join('');
        }


        async function viewBookingDetails(bookingId) {
            try {
                const response = await fetch(`${API_BASE}/api/bookings/${bookingId}`);
                const data = await response.json();


                if (!data.success) {
                    throw new Error(data.error || 'Failed to load booking details');
                }


                const booking = data.booking;
               
                document.getElementById('modalContent').innerHTML = `
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-6">
                            <h2 class="text-2xl font-bold text-gray-800">Booking Details</h2>
                            <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>


                        <img src="${booking.property_image}" alt="${booking.property_name}" class="w-full h-64 object-cover rounded-lg mb-6">


                        <div class="space-y-4">
                            <div>
                                <h3 class="text-xl font-bold text-gray-800">${booking.property_name}</h3>
                                <p class="text-gray-600">${booking.property_location || ''}</p>
                            </div>


                            <div class="grid grid-cols-2 gap-4 p-4 bg-gray-50 rounded-lg">
                                <div>
                                    <p class="text-sm text-gray-500">Check-in</p>
                                    <p class="font-semibold">${booking.check_in_formatted}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Check-out</p>
                                    <p class="font-semibold">${booking.check_out_formatted}</p>
                                </div>
                            </div>


                            <div class="grid grid-cols-3 gap-4">
                                <div class="text-center p-3 bg-blue-50 rounded-lg">
                                    <p class="text-sm text-gray-600">Nights</p>
                                    <p class="text-xl font-bold text-blue-600">${booking.nights}</p>
                                </div>
                                <div class="text-center p-3 bg-green-50 rounded-lg">
                                    <p class="text-sm text-gray-600">Adults</p>
                                    <p class="text-xl font-bold text-green-600">${booking.adults}</p>
                                </div>
                                <div class="text-center p-3 bg-purple-50 rounded-lg">
                                    <p class="text-sm text-gray-600">Kids</p>
                                    <p class="text-xl font-bold text-purple-600">${booking.kids}</p>
                                </div>
                            </div>


                            <div class="border-t pt-4">
                                <h4 class="font-semibold mb-2">Price Breakdown</h4>
                                <div class="space-y-2 text-sm">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">${booking.price_per_night} x ${booking.nights} nights</span>
                                        <span>${booking.price_per_night}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Cleaning fee</span>
                                        <span>${booking.cleaning_fee}</span>
                                    </div>
                                    <div class="flex justify-between font-bold text-lg border-t pt-2">
                                        <span>Total</span>
                                        <span class="text-primary">${booking.total_price}</span>
                                    </div>
                                </div>
                            </div>


                            <div class="grid grid-cols-2 gap-4 p-4 bg-gray-50 rounded-lg">
                                <div>
                                    <p class="text-sm text-gray-500">Booking Reference</p>
                                    <p class="font-semibold">${booking.booking_reference}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Status</p>
                                    <span class="status-badge status-${booking.status}">${booking.status}</span>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Payment Method</p>
                                    <p class="font-semibold">${booking.payment_method}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Payment Status</p>
                                    <p class="font-semibold capitalize">${booking.payment_status}</p>
                                </div>
                            </div>


                            ${booking.special_requests && booking.special_requests !== 'None' ? `
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">Special Requests</p>
                                    <p class="text-gray-700">${booking.special_requests}</p>
                                </div>
                            ` : ''}


                            <div class="text-xs text-gray-500 pt-2 border-t">
                                Booked on ${booking.created_at}
                            </div>
                        </div>


                        ${booking.status === 'upcoming' ? `
                            <div class="mt-6 flex gap-3">
                                <button onclick="closeModal()" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-3 rounded-lg font-medium transition-colors">
                                    Close
                                </button>
                                <button onclick="confirmCancelBooking(${booking.id})" class="flex-1 bg-red-500 hover:bg-red-600 text-white px-4 py-3 rounded-lg font-medium transition-colors">
                                    Cancel Booking
                                </button>
                            </div>
                        ` : `
                            <div class="mt-6">
                                <button onclick="closeModal()" class="w-full bg-primary hover:bg-primary/90 text-white px-4 py-3 rounded-lg font-medium transition-colors">
                                    Close
                                </button>
                            </div>
                        `}
                    </div>
                `;


                document.getElementById('detailsModal').classList.remove('hidden');
            } catch (error) {
                console.error('Error loading booking details:', error);
                alert('Failed to load booking details. Please try again.');
            }
        }


        function closeModal() {
            document.getElementById('detailsModal').classList.add('hidden');
        }


        async function confirmCancelBooking(bookingId) {
            if (!confirm('Are you sure you want to cancel this booking?\n\nCancellation Policy:\n• Full refund within 48 hours of booking\n• 50% refund if cancelled 7+ days before check-in\n• No refund within 7 days of check-in')) {
                return;
            }


            try {
                const response = await fetch(`${API_BASE}/api/bookings/${bookingId}/cancel`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                });


                const data = await response.json();


                if (!data.success) {
                    alert('Error: ' + (data.error || 'Failed to cancel booking'));
                    return;
                }


                // Show refund information
                if (data.refund_amount > 0) {
                    alert(`Booking cancelled successfully!\n\nRefund: ${data.refund_percentage}% (₱${data.refund_amount.toFixed(2)})\n${data.message}`);
                } else {
                    alert(`Booking cancelled.\n\n${data.message}`);
                }


                closeModal();
                loadBookings(); // Reload bookings list
            } catch (error) {
                console.error('Error cancelling booking:', error);
                alert('Failed to cancel booking. Please try again.');
            }
        }


        function formatDate(dateString) {
            const options = { year: 'numeric', month: 'short', day: 'numeric' };
            return new Date(dateString).toLocaleDateString('en-US', options);
        }
    </script>


</body>
</html>


