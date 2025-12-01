<!DOCTYPE html>
<html lang="en">

<?= view('components/head') ?>

<body class="bg-gray-50">
    <!-- Decorative Top Bar -->
    <div class="bg-accent h-3"></div>

    <!-- Header -->
    <?= view('components/header') ?>

    <!-- Main Content -->
    <main class="mx-auto px-6 py-16 max-w-7xl">
        <div class="mb-8">
            <h1 class="mb-2 font-bold text-gray-900 text-4xl">Road map</h1>
            <p class="text-gray-600 text-lg">High-level plan and status for upcoming features.</p>
        </div>

        <!-- Kanban Board -->
        <div class="gap-4 grid grid-cols-1 md:grid-cols-4">
            <!-- IDEA Column -->
            <div class="bg-white p-4 rounded-lg">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="font-bold text-gray-700 text-sm uppercase">IDEA <span class="ml-2 text-gray-400">0</span></h2>
                </div>
                <div class="space-y-3 min-h-[200px]">
                    <!-- Empty -->
                </div>
            </div>

            <!-- PLANNED Column -->
            <div class="bg-white p-4 rounded-lg">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="font-bold text-gray-700 text-sm uppercase">PLANNED <span class="ml-2 text-gray-400">1</span></h2>
                </div>
                <div class="space-y-3">
                    <!-- Review System Card -->
                    <div class="bg-white hover:shadow-md p-3 border-2 border-gray-200 rounded-lg transition-shadow">
                        <p class="mb-1 text-gray-400 text-xs">Roadmap 1.04</p>
                        <h3 class="mb-2 font-semibold text-gray-900 text-sm">Review & Rating System</h3>
                        <p class="mb-3 text-gray-600 text-xs">Guest reviews: submit ratings, write feedback, view past reviews, display average rating</p>
                        <div class="flex items-center gap-2 text-gray-500 text-xs">
                            <span class="text-blue-500">●</span>
                            <span>Medium Priority</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- IN PROGRESS Column -->
            <div class="bg-white p-4 rounded-lg">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="font-bold text-gray-700 text-sm uppercase">IN PROGRESS <span class="ml-2 text-gray-400">1</span></h2>
                </div>
                <div class="space-y-3">
                    <!-- Condo Unit Management Card -->
                    <div class="bg-white hover:shadow-md p-3 border-2 border-gray-200 rounded-lg transition-shadow">
                        <p class="mb-1 text-gray-400 text-xs">Roadmap 1.02</p>
                        <h3 class="mb-2 font-semibold text-gray-900 text-sm">Condo Unit Management</h3>
                        <p class="mb-3 text-gray-600 text-xs">Update unit details, pricing, photos, amenities, and availability calendar</p>
                        <div class="flex items-center gap-2 text-gray-500 text-xs">
                            <span class="text-orange-500">●</span>
                            <span>High Priority</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- COMPLETE Column -->
            <div class="bg-white p-4 rounded-lg">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="font-bold text-gray-700 text-sm uppercase">COMPLETE <span class="ml-2 text-gray-400">2</span></h2>
                </div>
                <div class="space-y-3">
                    <!-- Users CRUD Card -->
                    <div class="bg-white hover:shadow-md p-3 border-2 border-green-200 rounded-lg transition-shadow">
                        <p class="mb-1 text-gray-400 text-xs">Roadmap 1.01</p>
                        <h3 class="mb-2 font-semibold text-gray-900 text-sm">Users CRUD</h3>
                        <p class="mb-3 text-gray-600 text-xs">User management: registration, profile updates, admin user list, account deletion</p>
                        <div class="flex items-center gap-2 text-gray-500 text-xs">
                            <span class="text-green-500">✓</span>
                            <span>Completed</span>
                        </div>
                    </div>

                    <!-- Booking System Card -->
                    <div class="bg-white hover:shadow-md p-3 border-2 border-green-200 rounded-lg transition-shadow">
                        <p class="mb-1 text-gray-400 text-xs">Roadmap 1.03</p>
                        <h3 class="mb-2 font-semibold text-gray-900 text-sm">Booking System</h3>
                        <p class="mb-3 text-gray-600 text-xs">Booking management: create requests, view bookings, update dates, confirm/cancel bookings</p>
                        <div class="flex items-center gap-2 text-gray-500 text-xs">
                            <span class="text-green-500">✓</span>
                            <span>Completed</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?= view('components/footer') ?>

</body>

</html>