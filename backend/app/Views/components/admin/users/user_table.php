<!-- File: app/Views/components/admin/users/user_table.php -->
<?php
/**
 * Consolidated User Table Component
 * Combines: user_table.php, table_header.php, table_body.php, 
 *           table_row.php, type_badge.php, status_badge.php, action_buttons.php
 */
?>

<div class="bg-white shadow-sm hover:shadow-md rounded-xl overflow-hidden transition-shadow">
    <!-- Table Header -->
    <div class="p-6 border-gray-100 border-b">
        <h2 class="font-bold text-green-900 text-xl text-center">User List</h2>
    </div>

    <!-- Table Content -->
    <div class="overflow-x-auto">
        <table class="w-full min-w-[640px]">
            <!-- Table Headers -->
            <thead class="bg-lime-100 border-b">
                <tr>
                    <th class="p-4 font-semibold text-green-900 text-sm text-center">ID</th>
                    <th class="p-4 font-semibold text-green-900 text-sm text-center">Name</th>
                    <th class="p-4 font-semibold text-green-900 text-sm text-center">Email</th>
                    <th class="p-4 font-semibold text-green-900 text-sm text-center">Gender</th>
                    <th class="p-4 font-semibold text-green-900 text-sm text-center">Type</th>
                    <th class="p-4 font-semibold text-green-900 text-sm text-center">Status</th>
                    <th class="p-4 font-semibold text-green-900 text-sm text-center">Actions</th>
                </tr>
            </thead>

            <!-- Table Body -->
            <tbody>
                <?php if (empty($users)): ?>
                    <tr>
                        <td class="p-4 text-green-600 text-center" colspan="7">
                            No users found
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($users as $user): ?>
                        <tr class="hover:bg-lime-50 border-gray-100 border-b transition-colors">
                            <!-- ID -->
                            <td class="p-4 text-green-900 text-center">
                                <?= esc($user->id) ?>
                            </td>

                            <!-- Name -->
                            <td class="p-4 font-medium text-green-900 text-center">
                                <?= esc($user->first_name . ' ' .
                                    ($user->middle_name ?? '') . ' ' .
                                    $user->last_name) ?>
                            </td>

                            <!-- Email -->
                            <td class="p-4 text-green-700 text-center">
                                <?= esc($user->email) ?>
                            </td>

                            <!-- Gender -->
                            <td class="p-4 text-green-700 text-center">
                                <?= esc($user->gender ?? 'N/A') ?>
                            </td>

                            <!-- Type Badge -->
                            <td class="p-4 text-center">
                                <span class="bg-lime-700 shadow-lg px-3 py-1.5 rounded-full font-bold text-white text-xs uppercase tracking-wide"
                                    style="box-shadow: 0 0 15px rgba(100, 127, 188, 0.6), 
                                             0 0 25px rgba(100, 127, 188, 0.4);">
                                    <?= esc($user->type) ?>
                                </span>
                            </td>

                            <!-- Status Badge -->
                            <td class="p-4 text-center">
                                <?php if ($user->account_status == 1): ?>
                                    <span class="bg-lime-600 shadow-lg px-3 py-1.5 rounded-full font-bold text-white text-xs uppercase tracking-wide animate-pulse"
                                        style="box-shadow: 0 0 20px rgba(139, 196, 187, 0.8), 
                                                 0 0 30px rgba(139, 196, 187, 0.5), 
                                                 0 0 40px rgba(139, 196, 187, 0.3);">
                                        ✓ Active
                                    </span>
                                <?php else: ?>
                                    <span class="bg-green-700 shadow-lg px-3 py-1.5 rounded-full font-bold text-white text-xs uppercase tracking-wide"
                                        style="box-shadow: 0 0 15px rgba(112, 146, 184, 0.6), 
                                                 0 0 25px rgba(112, 146, 184, 0.4);">
                                        ✗ Inactive
                                    </span>
                                <?php endif; ?>
                            </td>

                            <!-- Action Buttons -->
                            <td class="p-4">
                                <div class="flex justify-center gap-2">
                                    <!-- Edit Button -->
                                    <button
                                        onclick='openEditModal(<?= json_encode([
                                                                    "id" => $user->id,
                                                                    "first_name" => $user->first_name,
                                                                    "middle_name" => $user->middle_name,
                                                                    "last_name" => $user->last_name,
                                                                    "email" => $user->email
                                                                ]) ?>)'
                                        class="bg-primary hover:bg-lime-700 px-3 py-2 rounded text-white text-sm transition-colors duration-200">
                                        Edit
                                    </button>

                                    <!-- Delete Button -->
                                    <form
                                        action="<?= site_url('crud-testing/delete/' . $user->id) ?>"
                                        method="post"
                                        class="inline"
                                        onsubmit="return confirm('Are you sure you want to delete <?= esc($user->first_name . ' ' . $user->last_name) ?>?\n\nThis action cannot be undone.');">
                                        <?= csrf_field() ?>
                                        <button
                                            type="submit"
                                            class="bg-red-700 hover:bg-red-800 px-3 py-2 rounded text-white text-sm transition-colors duration-200">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>