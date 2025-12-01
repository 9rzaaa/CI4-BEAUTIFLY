<!DOCTYPE html>
<html lang="en">
<?php include APPPATH . 'views/components/head.php'; ?>

<body class="bg-[var(--garden-light)]">
    <?php include APPPATH . 'views/components/header.php'; ?>

    <div class="flex min-h-screen">
        <!-- Sidebar - Updated to use view() with active parameter -->
        <?= view('components/admin/sidebar', ['active' => 'dashboard']) ?>

        <!-- Main Content -->
        <main class="flex-1 ml-64 p-8">
            <div class="mb-8">
                <h1 class="mb-2 font-bold text-[var(--garden-dark)] text-3xl">Dashboard Overview</h1>
                <p class="text-[var(--garden-dark)]/70">
                    Welcome back! Here's what's happening with your properties.
                </p>
            </div>

            <!-- Stats Cards -->
            <?php include APPPATH . 'views/components/admin/stats_card.php'; ?>

        </main>
    </div>

</body>

</html>