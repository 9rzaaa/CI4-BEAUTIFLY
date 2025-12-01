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