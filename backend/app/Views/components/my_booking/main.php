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
