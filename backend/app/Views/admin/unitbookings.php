<!DOCTYPE html>
<html lang="en">
<?php include APPPATH . 'Views/components/head.php'; ?>

<body class="bg-gray-50">
    <?php include APPPATH . 'Views/components/header.php'; ?>

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <?= view('components/admin/sidebar', ['active' => 'bookings']) ?>

        <!-- Main Content -->
        <main class="flex-1 ml-64 p-8">
            <!-- Page Header -->
            <?= view('components/admin/page_header', [
                'title' => 'Booking Management',
                'description' => 'View and manage all property bookings'
            ]) ?>

            <!-- Filters -->
            <?= view('components/admin/bookings/filters') ?>

            <!-- Bookings Table -->
            <?= view('components/admin/bookings/bookings_table') ?>
        </main>
    </div>

    <!-- Modals -->
    <?= view('components/admin/bookings/edit_modal') ?>
    <?= view('components/admin/bookings/view_modal') ?>

    <!-- Scripts -->
    <?= view('components/admin/bookings/bookings_scripts') ?>
</body>

</html>