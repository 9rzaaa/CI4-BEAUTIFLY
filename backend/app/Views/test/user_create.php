<!-- app/Views/test/user_create.php -->
<form action="<?= site_url('crud-testing/create') ?>" method="post" class="space-y-4">
    <?= csrf_field() ?>

    <div class="gap-4 grid grid-cols-1 md:grid-cols-2">
        <!-- First Name -->
        <div>
            <label class="block mb-2 font-semibold text-ocean-dark text-sm">First Name *</label>
            <input
                type="text"
                name="first_name"
                placeholder="Enter first name"
                value="<?= old('first_name') ?>"
                required
                class="px-4 py-3 border-2 border-sky focus:border-ocean rounded-lg focus:outline-none w-full text-gray-700 transition-colors">
        </div>

        <!-- Middle Name -->
        <div>
            <label class="block mb-2 font-semibold text-ocean-dark text-sm">Middle Name</label>
            <input
                type="text"
                name="middle_name"
                placeholder="Enter middle name (optional)"
                value="<?= old('middle_name') ?>"
                class="px-4 py-3 border-2 border-sky focus:border-ocean rounded-lg focus:outline-none w-full text-gray-700 transition-colors">
        </div>
    </div>

    <!-- Last Name -->
    <div>
        <label class="block mb-2 font-semibold text-ocean-dark text-sm">Last Name *</label>
        <input
            type="text"
            name="last_name"
            placeholder="Enter last name"
            value="<?= old('last_name') ?>"
            required
            class="px-4 py-3 border-2 border-sky focus:border-ocean rounded-lg focus:outline-none w-full text-gray-700 transition-colors">
    </div>

    <!-- Email -->
    <div>
        <label class="block mb-2 font-semibold text-ocean-dark text-sm">Email *</label>
        <input
            type="email"
            name="email"
            placeholder="Enter email address"
            value="<?= old('email') ?>"
            required
            class="px-4 py-3 border-2 border-sky focus:border-ocean rounded-lg focus:outline-none w-full text-gray-700 transition-colors">
    </div>

    <div class="gap-4 grid grid-cols-1 md:grid-cols-2">
        <!-- Password -->
        <div>
            <label class="block mb-2 font-semibold text-ocean-dark text-sm">Password *</label>
            <input
                type="password"
                name="password"
                placeholder="Enter password"
                required
                class="px-4 py-3 border-2 border-sky focus:border-ocean rounded-lg focus:outline-none w-full text-gray-700 transition-colors">
        </div>

        <!-- Confirm Password -->
        <div>
            <label class="block mb-2 font-semibold text-ocean-dark text-sm">Confirm Password *</label>
            <input
                type="password"
                name="confirm_password"
                placeholder="Confirm password"
                required
                class="px-4 py-3 border-2 border-sky focus:border-ocean rounded-lg focus:outline-none w-full text-gray-700 transition-colors">
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex justify-center gap-3 pt-4">
        <button
            type="submit"
            class="bg-mint-dark hover:bg-mint shadow-lg px-8 py-3 rounded-lg font-bold text-white transition-colors duration-200">
            Create User
        </button>
        <button
            type="button"
            onclick="window.location.href='<?= site_url('test/user') ?>'"
            class="bg-gray-500 hover:bg-gray-600 px-8 py-3 rounded-lg font-bold text-white transition-colors duration-200">
            Cancel
        </button>

    </div>
</form>