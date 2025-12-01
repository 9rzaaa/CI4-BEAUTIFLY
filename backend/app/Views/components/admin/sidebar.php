<!-- File: app/Views/components/admin/sidebar.php -->
<?php
/**
 * Consolidated Sidebar Component
 * Combines: sidebar.php, sidebar_section.php, sidebar_link.php
 */

// Icon definitions
$icons = [
    'dashboard' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6',
    'users' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1z',
    'calendar' => 'M8 7V3m8 4V3m-9 8h10M5 21h14',
    'payment' => 'M2 7h20v10H2V7zm2 2v6h16V9H4zm3 4h4m-4-2h6'
];

// Helper function to render a sidebar link
function renderSidebarLink($link, $icons, $active)
{
    $isActive = ($link['active'] ?? '') === $active;
    $activeClass = $isActive
        ? 'bg-lime-700 text-white'
        : 'hover:bg-lime-100 text-green-900';

    $iconPath = $icons[$link['icon']] ?? '';

    echo "<a href='" . esc($link['url']) . "' 
             class='flex items-center {$activeClass} px-4 py-3 rounded-lg transition-colors'>
            <svg class='mr-3 w-5 h-5' fill='none' stroke='currentColor' viewBox='0 0 24 24'>
                <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='{$iconPath}'/>
            </svg>
            <span class='font-medium'>" . esc($link['label']) . "</span>
          </a>";
}

// Helper function to render a sidebar section
function renderSidebarSection($title, $links, $icons, $active)
{
    echo "<div class='mb-6'>
            <p class='mb-2 px-4 font-semibold text-green-700 text-xs uppercase tracking-wider'>"
        . esc($title) .
        "</p>";

    foreach ($links as $link) {
        renderSidebarLink($link, $icons, $active);
    }

    echo "</div>";
}

// Get active page
$activePage = $active ?? '';
?>

<aside class="fixed bg-white shadow-lg w-64 h-full overflow-y-auto">
    <!-- Header -->
    <div class="p-6">
        <h2 class="mb-2 font-bold text-green-900 text-xl">ADMIN PANEL</h2>
        <p class="text-green-600 text-sm">Management Console</p>
    </div>

    <!-- Navigation -->
    <nav class="px-4 pb-6">
        <?php
        // Dashboard Section
        renderSidebarSection('Dashboard', [
            [
                'url' => site_url('admin/dashboard'),
                'label' => 'Dashboard',
                'icon' => 'dashboard',
                'active' => 'dashboard'
            ]
        ], $icons, $activePage);

        // Management Section
        renderSidebarSection('Management', [
            [
                'url' => site_url('test/user'),
                'label' => 'Users',
                'icon' => 'users',
                'active' => 'users'
            ],
            [
                'url' => site_url('admin/bookings'),
                'label' => 'Bookings',
                'icon' => 'calendar',
                'active' => 'bookings'
            ],
            [
                'url' => '#',
                'label' => 'Payments',
                'icon' => 'payment',
                'active' => 'payments'
            ]
        ], $icons, $activePage);
        ?>
    </nav>
</aside>