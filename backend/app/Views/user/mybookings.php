<?php
$active = 'My Bookings';
?>
<!DOCTYPE html>
<html lang="en">
<?= view('components/head') ?>

<body class="bg-gray-50">
    <?php echo view('components/header'); ?>


    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8 max-w-7xl">
<!-- Page Header -->
<div class="mb-8 text-center">
    <h1 class="text-4xl font-bold text-green-700 mb-2 drop-shadow-[0_2px_2px_rgba(0,0,0,0.25)]">
        My Bookings
    </h1>
</div>

        <!-- Stats Summary -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-lg p-4 shadow-sm">
                <p class="text-sm text-gray-500">Total Bookings</p>
                <p class="text-2xl font-bold text-gray-800"><?= $totalBookings ?></p>
            </div>
            <div class="bg-blue-50 rounded-lg p-4 shadow-sm">
                <p class="text-sm text-blue-600">Pending</p>
                <p class="text-2xl font-bold text-blue-700"><?= $pendingCount ?></p>
            </div>
            <div class="bg-green-50 rounded-lg p-4 shadow-sm">
                <p class="text-sm text-green-600">Upcoming</p>
                <p class="text-2xl font-bold text-green-700"><?= $upcomingCount ?></p>
            </div>
            <div class="bg-gray-50 rounded-lg p-4 shadow-sm">
                <p class="text-sm text-gray-600">Completed</p>
                <p class="text-2xl font-bold text-gray-700"><?= $completedCount ?></p>
            </div>
        </div>


<!-- Filter Tabs -->
<div class="mb-6">
    <div class="flex flex-wrap gap-3 justify-center">
        <button class="filter-tab active" data-filter="all">
            All Bookings (<?= $totalBookings ?>)
        </button>
        <button class="filter-tab" data-filter="pending">
            Pending (<?= $pendingCount ?>)
        </button>
        <button class="filter-tab" data-filter="upcoming">
            Upcoming (<?= $upcomingCount ?>)
        </button>
        <button class="filter-tab" data-filter="completed">
            Completed (<?= $completedCount ?>)
        </button>
        <button class="filter-tab" data-filter="cancelled">
            Cancelled (<?= $cancelledCount ?>)
        </button>
    </div>
</div>



        <!-- Bookings Container -->
        <?php if (empty($bookings)): ?>
            <!-- Empty State -->
            <div class="text-center py-16">
                <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <h3 class="mt-4 text-xl font-semibold text-gray-700">No bookings found</h3>
                <p class="mt-2 text-gray-500">You haven't made any bookings yet.</p>
                <a href="<?= base_url('booking') ?>" class="inline-block mt-6 bg-primary hover:bg-primary/90 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                    Book Now
                </a>
            </div>
        <?php else: ?>
            <!-- Bookings Grid -->
            <div id="bookingsGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($bookings as $booking): ?>
                    <div class="booking-card" data-status="<?= $booking['status'] ?>">
                        <div class="booking-image-container">
                            <div class="booking-image bg-gradient-to-br from-primary/20 to-accent/20 flex items-center justify-center">
                                <svg class="w-20 h-20 text-primary/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                            </div>
                        </div>
                       
                        <div class="p-5">
                            <div class="flex justify-between items-start mb-3">
                                <h3 class="text-lg font-bold text-gray-800"><?= esc($booking['property_title']) ?></h3>
                                <span class="status-badge status-<?= $booking['status'] ?>"><?= $booking['status_badge'] ?></span>
                            </div>
                           
                            <div class="space-y-2 mb-4">
                                <div class="flex items-center text-gray-600 text-sm">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <?= $booking['check_in_formatted'] ?> - <?= $booking['check_out_formatted'] ?>
                                </div>
                               
                                <div class="flex items-center text-gray-600 text-sm">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <?= $booking['adults'] ?> Adult<?= $booking['adults'] > 1 ? 's' : '' ?><?= $booking['kids'] > 0 ? ' + ' . $booking['kids'] . ' Kid' . ($booking['kids'] > 1 ? 's' : '') : '' ?>
                                </div>


                                <div class="flex items-center text-gray-600 text-sm">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                                    </svg>
                                    <?= $booking['number_of_nights'] ?> Night<?= $booking['number_of_nights'] > 1 ? 's' : '' ?>
                                </div>
                            </div>
                           
                            <div class="border-t pt-4 flex justify-between items-center">
                                <div>
                                    <p class="text-xs text-gray-500">Transaction ID</p>
                                    <p class="text-sm font-semibold text-gray-700"><?= esc($booking['transaction_id']) ?></p>
                                </div>
                                <div class="text-right">
                                    <p class="text-xs text-gray-500">Total</p>
                                    <p class="text-lg font-bold text-primary"><?= $booking['total_price_formatted'] ?></p>
                                </div>
                            </div>
                           
                            <div class="mt-4 flex gap-2">
                                <a href="<?= base_url('bookings/view/' . $booking['id']) ?>" class="flex-1 bg-primary hover:bg-accent/90 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors text-center">
                                    View Details
                                </a>
                                <?php if ($booking['can_cancel']): ?>
                                    <button onclick="confirmCancelBooking(<?= $booking['id'] ?>)" class="px-4 py-2 border-2 border-red-500 text-red-500 hover:bg-red-50 rounded-lg text-sm font-medium transition-colors">
                                        Cancel
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>


    <?php echo view('components/footer'); ?>


 <style>
    /* FILTER TABS */
    .filter-tab {
        background-color: white;
        color: #4F5D44; /* earthy gray-green */
        border: 2px solid #DCEED1; /* light leaf */
        padding: 0.625rem 1.5rem;
        border-radius: 0.5rem;
        font-weight: 500;
        transition: all 0.2s;
        cursor: pointer;
    }

    .filter-tab:hover {
        border-color: #6DA34D; /* primary green */
        color: #2E5A32; /* darker garden green */
    }

    .filter-tab.active {
        background-color: #6DA34D; /* garden green */
        color: white;
        border-color: #6DA34D;
    }

    /* STATUS BADGES */
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

    /* Upcoming – soft leaf green */
    .status-upcoming {
        background-color: #DCEED1;
        color: #2E5A32;
    }

    /* Completed – darker healthy green */
    .status-completed {
        background-color: #A3B18A;
        color: #1F3F1C;
    }

    /* Cancelled – soft garden rose */
    .status-cancelled {
        background-color: #F3D8D0;
        color: #8C3B2E;
    }

    /* Pending – natural wheat yellow */
    .status-pending {
        background-color: #FFF4CC;
        color: #8C6239;
    }

    /* Confirmed – soft mint */
    .status-confirmed {
        background-color: #DCEED1;
        color: #2E5A32;
    }

    /* BOOKING CARDS */
    .booking-card {
        background: white;
        border-radius: 1rem;
        box-shadow: 0 1px 3px 0 rgba(46, 90, 50, 0.15); /* natural green shadow */
        transition: all 0.3s ease;
        overflow: hidden;
        border: 1px solid #DCEED1; /* soft garden border */
    }

    .booking-card:hover {
        box-shadow: 0 10px 25px -5px rgba(46, 90, 50, 0.2);
        transform: translateY(-2px);
    }

    /* BOOKING IMAGE */
    .booking-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .booking-image-container {
        width: 100%;
        height: 200px;
        overflow: hidden;
        background: linear-gradient(to bottom right, #DCEED1, #A3B18A); /* garden gradient */
    }
</style>

        <script>
        const BASE_URL = '<?= base_url() ?>';
        let currentFilter = 'all';

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            // Add filter tab listeners
            document.querySelectorAll('.filter-tab').forEach(tab => {
                tab.addEventListener('click', function() {
                    document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                    currentFilter = this.dataset.filter;
                    filterBookings();
                });
            });
        });

        function filterBookings() {
            const allCards = document.querySelectorAll('.booking-card');
            
            allCards.forEach(card => {
                const status = card.dataset.status;
                
                if (currentFilter === 'all') {
                    card.style.display = 'block';
                } else if (currentFilter === status) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });

            // Check if any cards are visible
            const visibleCards = Array.from(allCards).filter(card => card.style.display !== 'none');
            
            if (visibleCards.length === 0 && currentFilter !== 'all') {
                // Show a message if no bookings in this category
                const grid = document.getElementById('bookingsGrid');
                const message = document.createElement('div');
                message.className = 'col-span-full text-center py-12 text-gray-500';
                message.innerHTML = `
                    <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <p class="text-lg">No ${currentFilter} bookings</p>
                `;
                message.id = 'no-bookings-message';
                
                // Remove previous message if exists
                const existingMessage = document.getElementById('no-bookings-message');
                if (existingMessage) {
                    existingMessage.remove();
                }
                
                grid.appendChild(message);
            } else {
                // Remove the no bookings message if it exists
                const message = document.getElementById('no-bookings-message');
                if (message) {
                    message.remove();
                }
            }
        }

        async function confirmCancelBooking(bookingId) {
            if (!confirm('Are you sure you want to cancel this booking?\n\nNote: Cancellation policies apply based on your booking terms.')) {
                return;
            }

            try {
                const response = await fetch(`${BASE_URL}/bookings/cancel/${bookingId}`, {
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

                alert(data.message || 'Booking cancelled successfully!');
                
                // Reload the page to show updated status
                window.location.reload();
            } catch (error) {
                console.error('Error cancelling booking:', error);
                alert('Failed to cancel booking. Please try again.');
            }
        }
    </script>
</body>
</html>
