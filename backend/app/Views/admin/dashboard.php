<!DOCTYPE html>
<html lang="en">
<?php include APPPATH . 'views/components/head.php'; ?>

<body class="bg-gray-50">
    <?php include APPPATH . 'views/components/header.php'; ?>

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <?php include APPPATH . 'views/components/admin/sidebar.php'; ?>

        <!-- Main Content -->
        <main class="flex-1 ml-64 p-8">
            <div class="mb-8">
                <h1 class="mb-2 font-bold text-gray-800 text-3xl">Dashboard Overview</h1>
                <p class="text-gray-600">Welcome back! Here's what's happening with your properties.</p>
            </div>

            <!-- Stats Cards -->
            <?php include APPPATH . 'views/components/admin/stats_card.php'; ?>

        </main>
    </div>

</body>

</html>