<!DOCTYPE html>
<html lang="en">

<?= view('components/head') ?>

<body class="bg-primary text-gray-900">

    <!-- Decorative Top Bar -->
    <div class="bg-accent h-3"></div>

    <!-- Header -->
    <?= view('components/header', ['active' => 'Login']) ?>

    <!-- Sign Up Section with Background -->
    <section class="flex justify-center items-center py-20 min-h-screen signup-container">
        <div class="mx-auto px-6 w-full max-w-md signup-content">
            <!-- Sign Up Form -->
            <div class="space-y-8 text-center">
                <h2 class="font-bold text-secondary text-5xl md:text-6xl">Sign Up</h2>

                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="bg-red-100 p-4 rounded-md text-red-700 text-sm text-left">
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <p><?= esc($error) ?></p>
                        <?php endforeach ?>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('auth/signup') ?>" method="post" class="space-y-6">
                    <?= csrf_field() ?>

                    <!-- First Name -->
                    <input
                        type="text"
                        name="first_name"
                        placeholder="First Name"
                        required
                        class="bg-transparent placeholder-opacity-70 focus:ring-opacity-50 px-6 py-4 border-2 border-secondary rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary w-full font-light text-secondary text-lg placeholder-secondary">

                    <!-- Middle Name -->
                    <input
                        type="text"
                        name="middle_name"
                        placeholder="Middle Name (optional)"
                        class="bg-transparent placeholder-opacity-70 focus:ring-opacity-50 px-6 py-4 border-2 border-secondary rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary w-full font-light text-secondary text-lg placeholder-secondary">

                    <!-- Last Name -->
                    <input
                        type="text"
                        name="last_name"
                        placeholder="Last Name"
                        required
                        class="bg-transparent placeholder-opacity-70 focus:ring-opacity-50 px-6 py-4 border-2 border-secondary rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary w-full font-light text-secondary text-lg placeholder-secondary">

                    <!-- Email -->
                    <input
                        type="email"
                        name="email"
                        placeholder="Email"
                        required
                        class="bg-transparent placeholder-opacity-70 focus:ring-opacity-50 px-6 py-4 border-2 border-secondary rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary w-full font-light text-secondary text-lg placeholder-secondary">

                    <!-- Password -->
                    <input
                        type="password"
                        name="password"
                        placeholder="Password"
                        required
                        class="bg-transparent placeholder-opacity-70 focus:ring-opacity-50 px-6 py-4 border-2 border-secondary rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary w-full font-light text-secondary text-lg placeholder-secondary">

                    <!-- Confirm Password -->
                    <input
                        type="password"
                        name="confirm_password"
                        placeholder="Confirm Password"
                        required
                        class="bg-transparent placeholder-opacity-70 focus:ring-opacity-50 px-6 py-4 border-2 border-secondary rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary w-full font-light text-secondary text-lg placeholder-secondary">

                    <!-- Login Link -->
                    <p class="font-light text-secondary text-lg">
                        Already have an account?
                        <a href="login.php" class="font-semibold text-secondary hover:text-accent underline transition-colors">
                            Log in
                        </a>
                    </p>

                    <!-- Sign Up Button -->
                    <button
                        type="submit"
                        class="bg-secondary hover:bg-primary px-8 py-3 border-2 border-secondary rounded-lg w-auto font-bold text-white text-base tracking-wide transition-all">
                        Sign Up
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?= view('components/footer') ?>

</body>

</html>