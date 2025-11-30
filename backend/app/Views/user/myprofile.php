<?= view('components/head', ['title' => 'My Profile']) ?>
<?= view('components/header') ?>

<section class="max-w-3xl mx-auto mt-10 px-4 pb-16"> 
    <div class="bg-white p-6 rounded-xl shadow-lg border border-[var(--garden-green)]">

        <h2 class="text-2xl font-bold text-[var(--garden-dark)] mb-6">
            Edit Your Profile 🌿
        </h2>

        <!-- SUCCESS / ERROR MESSAGE -->
        <?php if(session()->getFlashdata('success')): ?>
            <div class="p-3 mb-4 bg-green-100 text-green-800 rounded">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if(session()->getFlashdata('error')): ?>
            <div class="p-3 mb-4 bg-red-100 text-red-800 rounded">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <!-- PROFILE INFO FORM -->
        <form action="/profile/update" method="post" class="space-y-4">

            <div>
                <label class="text-sm font-semibold text-[var(--garden-brown)]">First Name</label>
                <input type="text" name="first_name" value="<?= esc($user['first_name']) ?>"
                       class="w-full p-3 border rounded focus:ring-2 focus:ring-[var(--garden-green)]" required>
            </div>

            <div>
                <label class="text-sm font-semibold text-[var(--garden-brown)]">Middle Name (optional)</label>
                <input type="text" name="middle_name" value="<?= esc($user['middle_name']) ?>"
                       class="w-full p-3 border rounded focus:ring-2 focus:ring-[var(--garden-green)]">
            </div>

            <div>
                <label class="text-sm font-semibold text-[var(--garden-brown)]">Last Name</label>
                <input type="text" name="last_name" value="<?= esc($user['last_name']) ?>"
                       class="w-full p-3 border rounded focus:ring-2 focus:ring-[var(--garden-green)]" required>
            </div>

            <div>
                <label class="text-sm font-semibold text-[var(--garden-brown)]">Email</label>
                <input type="email" name="email" value="<?= esc($user['email']) ?>"
                       class="w-full p-3 border rounded bg-gray-100 cursor-not-allowed" readonly>
            </div>

            <hr class="my-6">

            <h3 class="text-xl font-semibold text-[var(--garden-dark)]">Change Password</h3>

            <div>
                <label class="text-sm font-semibold text-[var(--garden-brown)]">Old Password</label>
                <input type="password" name="old_password"
                       class="w-full p-3 border rounded focus:ring-2 focus:ring-[var(--garden-green)]">
            </div>

            <div>
                <label class="text-sm font-semibold text-[var(--garden-brown)]">New Password</label>
                <input type="password" name="new_password"
                       class="w-full p-3 border rounded focus:ring-2 focus:ring-[var(--garden-green)]">
            </div>

            <div>
                <label class="text-sm font-semibold text-[var(--garden-brown)]">Confirm New Password</label>
                <input type="password" name="confirm_password"
                       class="w-full p-3 border rounded focus:ring-2 focus:ring-[var(--garden-green)]">
            </div>

            <div class="text-right pt-4">
                <button class="bg-green-600 text-white px-6 py-2 rounded shadow-md hover:bg-green-700 transition">
                    Save Changes
                </button>
            </div>

        </form>
    </div>
</section>

<?= view('components/footer') ?>
