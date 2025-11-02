<!DOCTYPE html>
<html lang="en">
<?php include APPPATH . 'views/components/head.php'; ?>

<body class="bg-cream-light">
    <?php include APPPATH . 'views/components/header.php'; ?>

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="fixed bg-white shadow-lg w-64 h-full overflow-y-auto">
            <div class="p-6">
                <h2 class="mb-2 font-bold text-ocean-dark text-xl">ADMIN PANEL</h2>
                <p class="text-gray-500 text-sm">Management Console</p>
            </div>

            <nav class="px-4 pb-6">
                <div class="mb-6">
                    <p class="mb-2 px-4 font-semibold text-gray-400 text-xs uppercase tracking-wider">Dashboard</p>
                    <a href="<?= site_url('admin/dashboard') ?>"
                        class="flex items-center hover:bg-gray-50 px-4 py-3 rounded-lg text-gray-700 transition-colors">
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

                    <!-- ✅ Active Users link -->
                    <a href="<?= site_url('test/user') ?>"
                        class="flex items-center bg-sky-light px-4 py-3 rounded-lg text-ocean-dark transition-colors">
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
                <h1 class="mb-2 font-bold text-ocean-dark text-3xl">User Management</h1>
                <p class="text-gray-600">Manage and monitor all registered users in the system.</p>
            </div>

            <!-- Error Handling -->
            <?php if (is_string($listOfUser)): ?>
                <div class="bg-sky-light shadow-sm p-6 border-sky-dark border-l-4 rounded-xl">
                    <p class="text-ocean-dark"><?= esc($listOfUser) ?></p>
                </div>
            <?php else: ?>
                <!-- User Table Card -->
                <div class="bg-white shadow-sm hover:shadow-md rounded-xl overflow-hidden transition-shadow">
                    <div class="p-6 border-gray-100 border-b">
                        <h2 class="font-bold text-ocean-dark text-xl text-center">User List</h2>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full min-w-[640px]">
                            <thead class="bg-sky-light border-b">
                                <tr>
                                    <th class="p-4 font-semibold text-ocean-dark text-sm text-center">ID</th>
                                    <th class="p-4 font-semibold text-ocean-dark text-sm text-center">Name</th>
                                    <th class="p-4 font-semibold text-ocean-dark text-sm text-center">Email</th>
                                    <th class="p-4 font-semibold text-ocean-dark text-sm text-center">Gender</th>
                                    <th class="p-4 font-semibold text-ocean-dark text-sm text-center">Type</th>
                                    <th class="p-4 font-semibold text-ocean-dark text-sm text-center">Status</th>
                                    <th class="p-4 font-semibold text-ocean-dark text-sm text-center">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php if (empty($listOfUser)) : ?>
                                    <tr>
                                        <td class="p-4 text-gray-500 text-center" colspan="7">No users found</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($listOfUser as $user): ?>
                                        <tr class="hover:bg-cream border-gray-100 border-b transition-colors">
                                            <td class="p-4 text-ocean-dark text-center"><?= esc($user->id) ?></td>
                                            <td class="p-4 font-medium text-ocean-dark text-center">
                                                <?= esc($user->first_name . ' ' . ($user->middle_name ?? '') . ' ' . $user->last_name) ?>
                                            </td>
                                            <td class="p-4 text-gray-600 text-center"><?= esc($user->email) ?></td>
                                            <td class="p-4 text-gray-600 text-center"><?= esc($user->gender ?? 'N/A') ?></td>
                                            <td class="p-4 text-center">
                                                <span class="bg-ocean shadow-lg px-3 py-1.5 rounded-full font-bold text-white text-xs uppercase tracking-wide" style="box-shadow: 0 0 15px rgba(100, 127, 188, 0.6), 0 0 25px rgba(100, 127, 188, 0.4);">
                                                    <?= esc($user->type) ?>
                                                </span>
                                            </td>
                                            <td class="p-4 text-center">
                                                <?php if ($user->account_status == 1): ?>
                                                    <span class="bg-mint-dark shadow-lg px-3 py-1.5 rounded-full font-bold text-white text-xs uppercase tracking-wide animate-pulse" style="box-shadow: 0 0 20px rgba(139, 196, 187, 0.8), 0 0 30px rgba(139, 196, 187, 0.5), 0 0 40px rgba(139, 196, 187, 0.3);">
                                                        ✓ Active
                                                    </span>
                                                <?php else: ?>
                                                    <span class="bg-sky-dark shadow-lg px-3 py-1.5 rounded-full font-bold text-white text-xs uppercase tracking-wide" style="box-shadow: 0 0 15px rgba(112, 146, 184, 0.6), 0 0 25px rgba(112, 146, 184, 0.4);">
                                                        ✗ Inactive
                                                    </span>
                                                <?php endif; ?>
                                            </td>

                                            <!-- ACTION BUTTONS -->
                                            <td class="p-4">
                                                <div class="flex justify-center gap-2">
                                                    <!-- View -->
                                                    <a class="bg-ocean hover:bg-ocean-dark px-3 py-2 rounded text-white text-sm transition-colors duration-200"
                                                        href="<?= site_url('test/view/' . $user->id) ?>">View</a>

                                                    <!-- Edit -->
                                                    <a class="bg-mint-dark hover:bg-mint px-3 py-2 rounded text-white text-sm transition-colors duration-200"
                                                        href="<?= site_url('test/update/' . $user->id) ?>">Edit</a>

                                                    <!-- Delete -->
                                                    <a class="bg-sky-dark hover:bg-sky px-3 py-2 rounded text-white text-sm transition-colors duration-200"
                                                        href="<?= site_url('test/delete/' . $user->id) ?>">Delete</a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>
        </main>
    </div>

</body>

</html>