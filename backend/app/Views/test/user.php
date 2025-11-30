<!DOCTYPE html>
<html lang="en">
<?php include APPPATH . 'views/components/head.php'; ?>

<body class="bg-green-50"> <?php include APPPATH . 'views/components/header.php'; ?>

    <div class="flex min-h-screen">
        <aside class="fixed bg-white shadow-lg w-64 h-full overflow-y-auto">
            <div class="p-6">
                <h2 class="mb-2 font-bold text-green-900 text-xl">ADMIN PANEL</h2> <p class="text-green-600 text-sm">Management Console</p> </div>

            <nav class="px-4 pb-6">
                <div class="mb-6">
                    <p class="mb-2 px-4 font-semibold text-green-700 text-xs uppercase tracking-wider">Dashboard</p> <a href="<?= site_url('admin/dashboard') ?>"
                        class="flex items-center hover:bg-lime-100 px-4 py-3 rounded-lg text-green-900 transition-colors"> <svg class="mr-3 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                        <span class="font-medium">Dashboard</span>
                    </a>
                </div>

                <div class="mb-6">
                    <p class="mb-2 px-4 font-semibold text-green-700 text-xs uppercase tracking-wider">Management</p> <a href="<?= site_url('test/user') ?>"
                        class="flex items-center bg-lime-700 px-4 py-3 rounded-lg text-white transition-colors"> <svg class="mr-3 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1z"></path>
                        </svg>
                        <span class="font-medium">Users</span>
                    </a>

                    <a href="#" class="flex items-center hover:bg-lime-100 px-4 py-3 rounded-lg text-green-900"> <svg class="mr-3 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14"></path>
                        </svg>
                        <span class="font-medium">Bookings</span>
                    </a>
                </div>

                <div>
                    <p class="mb-2 px-4 font-semibold text-green-700 text-xs uppercase tracking-wider">Reports</p> <a href="#" class="flex items-center hover:bg-lime-100 px-4 py-3 rounded-lg text-green-900"> <svg class="mr-3 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5v8h4zM15 21v-8h4v8z"></path>
                        </svg>
                        <span class="font-medium">Analytics</span>
                    </a>
                </div>
            </nav>
        </aside>

        <main class="flex-1 ml-64 p-8">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="mb-2 font-bold text-green-900 text-3xl">User Management</h1> <p class="text-green-700">Manage and monitor all registered users in the system.</p> </div>
                <button onclick="openModal()" class="flex items-center gap-2 bg-primary hover:bg-lime-700 shadow-lg px-6 py-3 rounded-lg font-semibold text-white transition-colors duration-200"> <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add New User
                </button>
            </div>

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="bg-red-100 mb-6 p-4 border-red-700 border-l-4 rounded-lg"> <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <p class="text-red-700"><?= esc($error) ?></p>
                    <?php endforeach ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="bg-lime-50 mb-6 p-4 border-lime-600 border-l-4 rounded-lg"> <p class="font-medium text-lime-700"><?= esc(session()->getFlashdata('success')) ?></p> </div>
            <?php endif; ?>

            <?php if (is_string($listOfUser)): ?>
                <div class="bg-lime-100 shadow-sm p-6 border-lime-700 border-l-4 rounded-xl"> <p class="text-green-900"><?= esc($listOfUser) ?></p> </div>
            <?php else: ?>
                <div class="bg-white shadow-sm hover:shadow-md rounded-xl overflow-hidden transition-shadow">
                    <div class="p-6 border-gray-100 border-b">
                        <h2 class="font-bold text-green-900 text-xl text-center">User List</h2> </div>

                    <div class="overflow-x-auto">
                        <table class="w-full min-w-[640px]">
                            <thead class="bg-lime-100 border-b"> <tr>
                                    <th class="p-4 font-semibold text-green-900 text-sm text-center">ID</th> <th class="p-4 font-semibold text-green-900 text-sm text-center">Name</th> <th class="p-4 font-semibold text-green-900 text-sm text-center">Email</th> <th class="p-4 font-semibold text-green-900 text-sm text-center">Gender</th> <th class="p-4 font-semibold text-green-900 text-sm text-center">Type</th> <th class="p-4 font-semibold text-green-900 text-sm text-center">Status</th> <th class="p-4 font-semibold text-green-900 text-sm text-center">Actions</th> </tr>
                            </thead>

                            <tbody>
                                <?php if (empty($listOfUser)) : ?>
                                    <tr>
                                        <td class="p-4 text-green-600 text-center" colspan="7">No users found</td> </tr>
                                <?php else: ?>
                                    <?php foreach ($listOfUser as $user): ?>
                                        <tr class="hover:bg-lime-50 border-gray-100 border-b transition-colors"> <td class="p-4 text-green-900 text-center"><?= esc($user->id) ?></td> <td class="p-4 font-medium text-green-900 text-center"> <?= esc($user->first_name . ' ' . ($user->middle_name ?? '') . ' ' . $user->last_name) ?>
                                            </td>
                                            <td class="p-4 text-green-700 text-center"><?= esc($user->email) ?></td> <td class="p-4 text-green-700 text-center"><?= esc($user->gender ?? 'N/A') ?></td> <td class="p-4 text-center">
                                                <span class="bg-lime-700 shadow-lg px-3 py-1.5 rounded-full font-bold text-white text-xs uppercase tracking-wide" style="box-shadow: 0 0 15px rgba(100, 127, 188, 0.6), 0 0 25px rgba(100, 127, 188, 0.4);"> <?= esc($user->type) ?>
                                                </span>
                                            </td>
                                            <td class="p-4 text-center">
                                                <?php if ($user->account_status == 1): ?>
                                                    <span class="bg-lime-600 shadow-lg px-3 py-1.5 rounded-full font-bold text-white text-xs uppercase tracking-wide animate-pulse" style="box-shadow: 0 0 20px rgba(139, 196, 187, 0.8), 0 0 30px rgba(139, 196, 187, 0.5), 0 0 40px rgba(139, 196, 187, 0.3);"> ✓ Active
                                                    </span>
                                                <?php else: ?>
                                                    <span class="bg-green-700 shadow-lg px-3 py-1.5 rounded-full font-bold text-white text-xs uppercase tracking-wide" style="box-shadow: 0 0 15px rgba(112, 146, 184, 0.6), 0 0 25px rgba(112, 146, 184, 0.4);"> ✗ Inactive
                                                    </span>
                                                <?php endif; ?>
                                            </td>

                                            <td class="p-4">
                                                <div class="flex justify-center gap-2">

                                                    <button
                                                        onclick='openEditModal(<?= json_encode([
                                                                                    "id" => $user->id,
                                                                                    "first_name" => $user->first_name,
                                                                                    "middle_name" => $user->middle_name,
                                                                                    "last_name" => $user->last_name,
                                                                                    "email" => $user->email
                                                                                ]) ?>)'
                                                        class="bg-primary hover:bg-lime-700 px-3 py-2 rounded text-white text-sm transition-colors duration-200"> Edit
                                                    </button>

                                                    <form action="<?= site_url('crud-testing/delete/' . $user->id) ?>"
                                                        method="post"
                                                        class="inline"
                                                        onsubmit="return confirmDelete('<?= esc($user->first_name . ' ' . $user->last_name) ?>');">
                                                        <?= csrf_field() ?>
                                                        <button type="submit"
                                                            class="bg-red-700 hover:bg-red-800 px-3 py-2 rounded text-white text-sm transition-colors duration-200"> Delete
                                                        </button>
                                                    </form>

                                                    <script>
                                                        function confirmDelete(userName) {
                                                            return confirm(`Are you sure you want to delete ${userName}?\n\nThis action cannot be undone.`);
                                                        }
                                                    </script>
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

    <div id="createUserModal" class="hidden z-50 fixed inset-0 flex justify-center items-center bg-black bg-opacity-50 p-4">
        <div class="bg-white shadow-2xl rounded-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center bg-lime-700 p-6 rounded-t-2xl"> <h2 class="font-bold text-white text-2xl">Create New User</h2>
                <button onclick="closeModal()" class="text-white hover:text-green-50 transition-colors"> <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <div class="p-8">
                <?php include APPPATH . 'views/test/user_create.php'; ?>
            </div>
        </div>
    </div>

    <div id="editUserModal" class="hidden z-50 fixed inset-0 flex justify-center items-center bg-black bg-opacity-50 p-4">
        <div class="bg-white shadow-2xl rounded-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center bg-lime-700 p-6 rounded-t-2xl"> <h2 class="font-bold text-white text-2xl">Edit User</h2>
                <button onclick="closeEditModal()" class="text-white hover:text-green-50 transition-colors"> <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <div class="p-8">
                <form id="editUserForm" method="post" class="space-y-4">
                    <?= csrf_field() ?>

                    <div class="gap-4 grid grid-cols-1 md:grid-cols-2">
                        <div>
                            <label class="block mb-2 font-semibold text-green-900 text-sm">First Name *</label> <input
                                type="text"
                                id="edit_first_name"
                                name="first_name"
                                placeholder="Enter first name"
                                required
                                class="px-4 py-3 border-2 border-lime-200 focus:border-lime-700 rounded-lg focus:outline-none w-full text-green-700 transition-colors"> </div>

                        <div>
                            <label class="block mb-2 font-semibold text-green-900 text-sm">Middle Name</label> <input
                                type="text"
                                id="edit_middle_name"
                                name="middle_name"
                                placeholder="Enter middle name (optional)"
                                class="px-4 py-3 border-2 border-lime-200 focus:border-lime-700 rounded-lg focus:outline-none w-full text-green-700 transition-colors"> </div>
                    </div>

                    <div>
                        <label class="block mb-2 font-semibold text-green-900 text-sm">Last Name *</label> <input
                            type="text"
                            id="edit_last_name"
                            name="last_name"
                            placeholder="Enter last name"
                            required
                            class="px-4 py-3 border-2 border-lime-200 focus:border-lime-700 rounded-lg focus:outline-none w-full text-green-700 transition-colors"> </div>

                    <div>
                        <label class="block mb-2 font-semibold text-green-900 text-sm">Email *</label> <input
                            type="email"
                            id="edit_email"
                            name="email"
                            placeholder="Enter email address"
                            required
                            class="px-4 py-3 border-2 border-lime-200 focus:border-lime-700 rounded-lg focus:outline-none w-full text-green-700 transition-colors"> </div>

                    <div class="gap-4 grid grid-cols-1 md:grid-cols-2">
                        <div>
                            <label class="block mb-2 font-semibold text-green-900 text-sm">Password</label> <input
                                type="password"
                                id="edit_password"
                                name="password"
                                placeholder="Leave blank to keep current password"
                                class="px-4 py-3 border-2 border-lime-200 focus:border-lime-700 rounded-lg focus:outline-none w-full text-green-700 transition-colors"> </div>

                        <div>
                            <label class="block mb-2 font-semibold text-green-900 text-sm">Confirm Password</label> <input
                                type="password"
                                id="edit_confirm_password"
                                name="confirm_password"
                                placeholder="Confirm new password"
                                class="px-4 py-3 border-2 border-lime-200 focus:border-lime-700 rounded-lg focus:outline-none w-full text-green-700 transition-colors"> </div>
                    </div>

                    <div class="flex justify-center gap-3 pt-4">
                        <button
                            type="submit"
                            class="bg-lime-600 hover:bg-lime-700 shadow-lg px-8 py-3 rounded-lg font-bold text-white transition-colors duration-200"> Update User
                        </button>
                        <button
                            type="button"
                            onclick="closeEditModal()"
                            class="bg-lime-700 hover:bg-lime-800 px-8 py-3 rounded-lg font-bold text-white transition-colors duration-200"> Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Create User Modal Functions
        function openModal() {
            document.getElementById('createUserModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('createUserModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Edit User Modal Functions
        function openEditModal(user) {
            console.log('Opening edit modal for user:', user); // DEBUG

            // Set form action with user ID
            const formAction = '<?= site_url('crud-testing/update/') ?>' + user.id;
            document.getElementById('editUserForm').action = formAction;

            console.log('Form action set to:', formAction); // DEBUG

            // Populate form fields
            document.getElementById('edit_first_name').value = user.first_name || '';
            document.getElementById('edit_middle_name').value = user.middle_name || '';
            document.getElementById('edit_last_name').value = user.last_name || '';
            document.getElementById('edit_email').value = user.email || '';

            // Clear password fields
            document.getElementById('edit_password').value = '';
            document.getElementById('edit_confirm_password').value = '';

            console.log('Form populated with:', { // DEBUG
                first_name: user.first_name,
                middle_name: user.middle_name,
                last_name: user.last_name,
                email: user.email
            });

            // Show modal
            document.getElementById('editUserModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeEditModal() {
            document.getElementById('editUserModal').classList.add('hidden');
            document.body.style.overflow = 'auto';

            // Clear form
            document.getElementById('editUserForm').reset();
        }

        // Add form submit listener to debug
        document.getElementById('editUserForm').addEventListener('submit', function(e) {
            console.log('Form submitting to:', this.action); // DEBUG
            console.log('Form data:', new FormData(this)); // DEBUG

            // Log all form values
            const formData = new FormData(this);
            for (let [key, value] of formData.entries()) {
                console.log(key + ':', value);
            }
        });

        // Close modals when clicking outside
        document.getElementById('createUserModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        document.getElementById('editUserModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditModal();
            }
        });

        // Close modals with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
                closeEditModal();
            }
        });
    </script>

</body>

</html>
