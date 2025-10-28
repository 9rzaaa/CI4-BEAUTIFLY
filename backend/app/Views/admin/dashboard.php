<!-- views/admin/dashboard.php -->
<!DOCTYPE html>
<html lang="en">
<?php include APPPATH . 'views/components/head.php'; ?>

<body class="bg-gray-50">
    <?php include APPPATH . 'views/components/header.php'; ?>

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="fixed bg-white shadow-lg w-64 h-full overflow-y-auto">
            <div class="p-6">
                <h2 class="mb-2 font-bold text-primary text-xl">ADMIN PANEL</h2>
                <p class="text-gray-500 text-sm">Management Console</p>
            </div>

            <nav class="px-4 pb-6">
                <div class="mb-6">
                    <p class="mb-2 px-4 font-semibold text-gray-400 text-xs uppercase tracking-wider">Dashboard</p>
                    <a href="#" class="flex items-center bg-blue-50 px-4 py-3 rounded-lg text-primary transition-colors">
                        <svg class="mr-3 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                        <span class="font-medium">Dashboard</span>
                    </a>
                </div>

                <div class="mb-6">
                    <p class="mb-2 px-4 font-semibold text-gray-400 text-xs uppercase tracking-wider">Management</p>
                    <a href="#" class="flex items-center hover:bg-gray-50 px-4 py-3 rounded-lg text-gray-700">
                        <svg class="mr-3 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1z"></path>
                        </svg>
                        <span class="font-medium">Users</span>
                    </a>
                    <a href="#" class="flex items-center hover:bg-gray-50 px-4 py-3 rounded-lg text-gray-700">
                        <svg class="mr-3 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14"></path>
                        </svg>
                        <span class="font-medium">Bookings</span>
                    </a>
                </div>

                <div>
                    <p class="mb-2 px-4 font-semibold text-gray-400 text-xs uppercase tracking-wider">Reports</p>
                    <a href="#" class="flex items-center hover:bg-gray-50 px-4 py-3 rounded-lg text-gray-700">
                        <svg class="mr-3 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5v8h4zM15 21v-8h4v8z"></path>
                        </svg>
                        <span class="font-medium">Analytics</span>
                    </a>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 ml-64 p-8">
            <div class="mb-8">
                <h1 class="mb-2 font-bold text-gray-800 text-3xl">Dashboard Overview</h1>
                <p class="text-gray-600">Welcome back! Here's what's happening with your properties.</p>
            </div>

            <!-- Stats Cards -->
            <div class="gap-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 mb-8">
                <div class="bg-white shadow-sm hover:shadow-md p-6 rounded-xl transition-shadow">
                    <div class="flex justify-between mb-4">
                        <div>
                            <p class="text-gray-600 text-sm">All Earnings</p>
                            <h3 class="font-bold text-yellow-600 text-3xl">$12,000</h3>
                        </div>
                        <div class="bg-yellow-100 p-3 rounded-full">
                            💰
                        </div>
                    </div>
                    <div class="bg-yellow-50 p-2 rounded-lg text-yellow-700 text-sm">10% increase on profit</div>
                </div>

                <div class="bg-white shadow-sm hover:shadow-md p-6 rounded-xl transition-shadow">
                    <div class="flex justify-between mb-4">
                        <div>
                            <p class="text-gray-600 text-sm">Active Bookings</p>
                            <h3 class="font-bold text-red-600 text-3xl">57</h3>
                        </div>
                        <div class="bg-red-100 p-3 rounded-full">📅</div>
                    </div>
                    <div class="bg-red-50 p-2 rounded-lg text-red-700 text-sm">28% task performance</div>
                </div>

                <div class="bg-white shadow-sm hover:shadow-md p-6 rounded-xl transition-shadow">
                    <div class="flex justify-between mb-4">
                        <div>
                            <p class="text-gray-600 text-sm">Total Users</p>
                            <h3 class="font-bold text-green-600 text-3xl">250+</h3>
                        </div>
                        <div class="bg-green-100 p-3 rounded-full">👤</div>
                    </div>
                    <div class="bg-green-50 p-2 rounded-lg text-green-700 text-sm">10k new registrations</div>
                </div>

                <div class="bg-white shadow-sm hover:shadow-md p-6 rounded-xl transition-shadow">
                    <div class="flex justify-between mb-4">
                        <div>
                            <p class="text-gray-600 text-sm">Monthly Growth</p>
                            <h3 class="font-bold text-blue-600 text-3xl">24%</h3>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-full">📈</div>
                    </div>
                    <div class="bg-blue-50 p-2 rounded-lg text-blue-700 text-sm">1k growth this month</div>
                </div>
            </div>

            <!-- Chart + Table Section -->
            <div class="bg-white shadow-sm p-6 rounded-xl">
                <h3 class="mb-4 font-bold text-gray-800 text-xl">Recent Bookings</h3>
                <table class="w-full text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 font-semibold text-gray-600 text-left">Guest</th>
                            <th class="px-4 py-3 font-semibold text-gray-600 text-left">Property</th>
                            <th class="px-4 py-3 font-semibold text-gray-600 text-left">Check-in</th>
                            <th class="px-4 py-3 font-semibold text-gray-600 text-left">Check-out</th>
                            <th class="px-4 py-3 font-semibold text-gray-600 text-left">Status</th>
                            <th class="px-4 py-3 font-semibold text-gray-600 text-left">Amount</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">John Doe</td>
                            <td class="px-4 py-3">Cozy Apartment</td>
                            <td class="px-4 py-3">Oct 15, 2025</td>
                            <td class="px-4 py-3">Oct 18, 2025</td>
                            <td class="px-4 py-3"><span
                                    class="bg-blue-100 px-2 py-1 rounded-full text-blue-800 text-xs">Confirmed</span>
                            </td>
                            <td class="px-4 py-3">$250</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">Jane Smith</td>
                            <td class="px-4 py-3">Seaside Villa</td>
                            <td class="px-4 py-3">Oct 10, 2025</td>
                            <td class="px-4 py-3">Oct 12, 2025</td>
                            <td class="px-4 py-3"><span
                                    class="bg-yellow-100 px-2 py-1 rounded-full text-yellow-800 text-xs">Pending</span>
                            </td>
                            <td class="px-4 py-3">$400</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

</body>

</html>