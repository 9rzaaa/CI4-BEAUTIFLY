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