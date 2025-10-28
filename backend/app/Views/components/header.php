<!-- components/header.php -->
<?php
$session = session();
$user = $session->get('user');
$isLoggedIn = !empty($user);
$firstName = $user['first_name'] ?? '';
$displayName = $user['display_name'] ?? '';
$email = $user['email'] ?? '';

// Check if user is admin
$isAdmin = ($user['type'] ?? '') === 'admin';
?>

<header class="bg-primary">
    <div class="flex justify-between items-center mx-auto py-4 pr-6 pl-2 max-w-7xl">
        <!-- Logo Section -->
        <a href="/" class="flex items-center space-x-4">
            <img src="/assets/logo/logo.png" alt="EASY&CO Logo" class="w-auto h-16">
        </a>

        <!-- Desktop Navigation -->
        <nav class="hidden md:flex items-center space-x-12">
            <?php if (!$isAdmin): ?>
                <a href="/" class="text-white hover:text-accent text-lg tracking-wide transition-colors <?= ($active ?? '') === 'Home' ? 'underline' : '' ?>">
                    HOME
                </a>
                <a href="/about" class="text-white hover:text-accent text-lg tracking-wide transition-colors <?= ($active ?? '') === 'About' ? 'underline' : '' ?>">
                    ABOUT US
                </a>
            <?php endif; ?>

            <!-- Auth Section for Desktop -->
            <?php if ($isLoggedIn): ?>
                <!-- User Dropdown with Hover -->
                <div class="group relative">
                    <button class="flex items-center space-x-2 bg-white/10 hover:bg-white/20 backdrop-blur-sm px-4 py-2.5 border border-white/20 hover:border-white/40 rounded-xl transition-all duration-300">
                        <!-- User Icon with Gradient -->
                        <div class="flex justify-center items-center bg-gradient-to-br from-accent to-accent/80 shadow-lg rounded-full w-8 h-8">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <span class="font-semibold text-white text-base"><?= esc($firstName) ?></span>
                        <svg class="w-4 h-4 text-white/80 group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <!-- Dropdown Menu with Modern Design -->
                    <div class="invisible group-hover:visible right-0 z-50 absolute bg-gray-900/95 opacity-0 group-hover:opacity-100 shadow-2xl backdrop-blur-xl mt-2 border border-white/10 rounded-xl w-56 overflow-hidden transition-all translate-y-2 group-hover:translate-y-0 duration-300 transform" style="background-color: #4A5F8F;">
                        <!-- User Info with Gradient Background -->
                        <div class="bg-gradient-to-br from-primary to-primary/80 px-3 py-2.5 border-white/10 border-b">
                            <div class="flex items-center space-x-2">
                                <div class="flex justify-center items-center bg-white/20 rounded-full w-8 h-8">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-semibold text-white text-xs truncate"><?= esc($displayName) ?></p>
                                    <p class="text-white/70 text-xs truncate"><?= esc($email) ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Menu Items -->
                        <div class="py-1.5">
                            <a href="/profile" class="group/item flex items-center hover:bg-white/10 mx-1.5 px-2.5 py-2 rounded-lg text-white text-xs transition-all duration-200">
                                <div class="flex justify-center items-center bg-blue-500/20 group-hover/item:bg-blue-500/30 mr-2 rounded-lg w-7 h-7 transition-colors">
                                    <svg class="w-3.5 h-3.5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <span class="font-medium">My Profile</span>
                            </a>
                            <a href="/bookings" class="group/item flex items-center hover:bg-white/10 mx-1.5 px-2.5 py-2 rounded-lg text-white text-xs transition-all duration-200">
                                <div class="flex justify-center items-center bg-purple-500/20 group-hover/item:bg-purple-500/30 mr-2 rounded-lg w-7 h-7 transition-colors">
                                    <svg class="w-3.5 h-3.5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <span class="font-medium">My Bookings</span>
                            </a>

                            <div class="mx-3 my-1.5 border-white/10 border-t"></div>

                            <a href="/auth/logout" class="group/item flex items-center hover:bg-red-500/20 mx-1.5 px-2.5 py-2 rounded-lg text-red-400 text-xs transition-all duration-200">
                                <div class="flex justify-center items-center bg-red-500/20 group-hover/item:bg-red-500/30 mr-2 rounded-lg w-7 h-7 transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                </div>
                                <span class="font-medium">Logout</span>
                            </a>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <!-- Login Link -->
                <a href="/login" class="text-white hover:text-accent text-lg tracking-wide transition-colors <?= ($active ?? '') === 'Login' ? 'underline' : '' ?>">
                    LOGIN
                </a>
            <?php endif; ?>
        </nav>

        <!-- Mobile Menu Button -->
        <button class="md:hidden text-white" id="mobileMenuBtn">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <!-- Mobile Menu (hidden by default) -->
    <div class="hidden md:hidden bg-primary" id="mobileMenu">
        <?php if (!$isAdmin): ?>
            <a href="/" class="block hover:bg-accent px-4 py-2 text-white">HOME</a>
            <a href="/about" class="block hover:bg-accent px-4 py-2 text-white">ABOUT US</a>
        <?php endif; ?>

        <?php if ($isLoggedIn): ?>
            <!-- Mobile User Section -->
            <div class="px-4 py-3 border-white/20 border-t">
                <div class="flex items-center space-x-3 mb-3">
                    <div class="flex justify-center items-center bg-accent rounded-full w-10 h-10">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-white text-sm"><?= esc($displayName) ?></p>
                        <p class="text-white/70 text-xs"><?= esc($email) ?></p>
                    </div>
                </div>
                <a href="/profile" class="flex items-center hover:bg-white/10 px-3 py-2 rounded-lg text-white text-sm transition-colors">
                    <svg class="mr-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    My Profile
                </a>
                <a href="/bookings" class="flex items-center hover:bg-white/10 px-3 py-2 rounded-lg text-white text-sm transition-colors">
                    <svg class="mr-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    My Bookings
                </a>
                <a href="/auth/logout" class="flex items-center bg-red-500/20 hover:bg-red-500/30 mt-2 px-3 py-2 rounded-lg text-red-400 text-sm transition-colors">
                    <svg class="mr-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    Logout
                </a>
            </div>
        <?php else: ?>
            <a href="/login" class="block hover:bg-accent px-4 py-2 text-white">LOGIN</a>
        <?php endif; ?>
    </div>

    <script>
        // Toggle mobile menu
        const btn = document.getElementById('mobileMenuBtn');
        const menu = document.getElementById('mobileMenu');
        if (btn && menu) {
            btn.addEventListener('click', () => menu.classList.toggle('hidden'));
        }
    </script>
</header>