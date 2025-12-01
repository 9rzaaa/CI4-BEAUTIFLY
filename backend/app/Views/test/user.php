<!-- File: app/Views/test/user.php -->
<!DOCTYPE html>
<html lang="en">

<?php include APPPATH . 'views/components/head.php'; ?>

<body class="bg-green-50">
    <?php include APPPATH . 'views/components/header.php'; ?>

    <div class="flex min-h-screen">
        <!-- Sidebar - Now consolidated -->
        <?= view('components/admin/sidebar', ['active' => 'users']) ?>

        <main class="flex-1 ml-64 p-8">
            <!-- Page Header - Kept separate (reusable) -->
            <?= view('components/admin/page_header', [
                'title' => 'User Management',
                'description' => 'Manage and monitor all registered users in the system.',
                'buttonText' => 'Add New User',
                'buttonAction' => 'openModal()'
            ]) ?>

            <!-- Flash Messages - Kept separate (reusable) -->
            <?= view('components/admin/flash_messages') ?>

            <!-- User Table or Info Box -->
            <?php if (is_string($listOfUser)): ?>
                <!-- Info Box - Kept separate (reusable) -->
                <?= view('components/admin/info_box', [
                    'message' => $listOfUser
                ]) ?>
            <?php else: ?>
                <!-- User Table - Now consolidated -->
                <?= view('components/admin/users/user_table', [
                    'users' => $listOfUser
                ]) ?>
            <?php endif; ?>
        </main>
    </div>

    <!-- User Modals - Now consolidated (includes scripts) -->
    <?= view('components/admin/users/user_modals') ?>

</body>

</html>