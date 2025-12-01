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

                <form class="space-y-6">
                    <!-- Email/Username Input -->
                    <input
                        type="text"
                        placeholder="Email or Username"
                        class="bg-transparent placeholder-opacity-70 focus:ring-opacity-50 px-6 py-4 border-2 border-secondary rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary w-full font-light text-secondary text-lg placeholder-secondary">

                    <!-- Password Input -->
                    <input
                        type="password"
                        placeholder="Password"
                        class="bg-transparent placeholder-opacity-70 focus:ring-opacity-50 px-6 py-4 border-2 border-secondary rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary w-full font-light text-secondary text-lg placeholder-secondary">

                    <!-- Sign Up Link -->
                    <p class="font-light text-secondary text-lg">
                        Don't have an account?
                        <a href="/signup" class="font-semibold text-secondary hover:text-accent underline transition-colors">
                            Sign up
                        </a>
                    </p>

                    <!-- Login Button -->
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