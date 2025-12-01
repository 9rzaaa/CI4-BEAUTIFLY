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
