<aside class="fixed bg-white shadow-lg w-64 h-full overflow-y-auto">
    <div class="p-6">
        <h2 class="mb-2 font-bold text-primary text-xl">ADMIN PANEL</h2>
        <p class="text-gray-500 text-sm">Management Console</p>
    </div>

    <?php
    // Get current URI to determine active page
    $uri = service('uri');
    $segment1 = $uri->getSegment(1); // 'admin'
    $segment2 = $uri->getSegment(2); // 'dashboard' or 'bookings'
    ?>

    <nav class="px-4 pb-6">
        <div class="mb-6">
            <p class="mb-2 px-4 font-semibold text-gray-400 text-xs uppercase tracking-wider">Dashboard</p>
            <a href="<?= site_url('admin/dashboard') ?>"
                class="flex items-center px-4 py-3 rounded-lg transition-colors <?= ($segment2 === 'dashboard' || $segment2 === null) ? 'bg-blue-50 text-primary' : 'hover:bg-gray-50 text-gray-700' ?>">
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

            <a href="<?= site_url('test/user') ?>"
                class="flex items-center px-4 py-3 rounded-lg transition-colors <?= ($segment1 === 'test' && $segment2 === 'user') ? 'bg-blue-50 text-primary' : 'hover:bg-gray-50 text-gray-700' ?>">
                <svg class="mr-3 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1z"></path>
                </svg>
                <span class="font-medium">Users</span>
            </a>

            <a href="<?= site_url('admin/bookings') ?>"
                class="flex items-center px-4 py-3 rounded-lg transition-colors <?= ($segment2 === 'bookings') ? 'bg-blue-50 text-primary' : 'hover:bg-gray-50 text-gray-700' ?>">
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