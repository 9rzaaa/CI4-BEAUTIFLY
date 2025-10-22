<!DOCTYPE html>
<html lang="en">

<?= view('components/head') ?>

<body class="bg-primary text-gray-900">

    <!-- Decorative Top Bar -->
    <div class="bg-accent h-3"></div>

    <!-- Header -->
    <?= view('components/header', ['active' => 'Login']) ?>


    <!-- Login Section with Background -->
    <section class="flex justify-center items-center py-20 min-h-screen login-container">
        <div class="mx-auto px-6 w-full max-w-md login-content">
            <!-- Login Form -->
            <div class="space-y-8 text-center">
                <h2 class="font-bold text-secondary text-5xl md:text-6xl">Log In</h2>

                <form action="<?= base_url('auth/login') ?>" method="post" class="space-y-6">
                    <?= csrf_field() ?>

                    <?php if (session()->getFlashdata('errors')): ?>
                        <div class="bg-red-100 p-4 rounded-md text-red-700 text-sm text-left">
                            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                <p><?= esc($error) ?></p>
                            <?php endforeach ?>
                        </div>
                    <?php endif; ?>

                    <input
                        type="email"
                        name="email"
                        placeholder="Email or Username"
                        value="<?= old('email') ?>"
                        class="bg-transparent placeholder-opacity-70 focus:ring-opacity-50 px-6 py-4 border-2 border-secondary rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary w-full font-light text-secondary text-lg placeholder-secondary">

                    <input
                        type="password"
                        name="password"
                        placeholder="Password"
                        class="bg-transparent placeholder-opacity-70 focus:ring-opacity-50 px-6 py-4 border-2 border-secondary rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary w-full font-light text-secondary text-lg placeholder-secondary">

                    <p class="font-light text-secondary text-lg">
                        Don't have an account?
                        <a href="/signup" class="font-semibold text-secondary hover:text-accent underline transition-colors">
                            Sign up
                        </a>
                    </p>

                    <button
                        type="submit"
                        class="bg-secondary hover:bg-primary px-8 py-3 border-2 border-secondary rounded-lg w-auto font-bold text-white text-base tracking-wide transition-all">
                        Log In
                    </button>
                </form>

            </div>
        </div>
    </section>

    <!-- Footer -->
    <?= view('components/footer') ?>

</body>

</html>