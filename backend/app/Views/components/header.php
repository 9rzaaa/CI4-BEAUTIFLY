<!-- header.php -->
<header class="bg-primary">
    <div class="flex justify-between items-center mx-auto py-4 pr-6 pl-2 max-w-7xl">
        <!-- Logo Section -->
        <a href="/" class="flex items-center space-x-4">
            <img src="/assets/logo/logo.png" alt="EASY&CO Logo" class="w-auto h-16">
        </a>

        <!-- Navigation -->
        <nav class="hidden md:flex space-x-12">
            <a href="/" class="text-white hover:text-accent text-lg tracking-wide transition-colors <?= ($active ?? '') === 'Home' ? 'underline' : '' ?>">
                HOME
            </a>
            <a href="/about" class="text-white hover:text-accent text-lg tracking-wide transition-colors <?= ($active ?? '') === 'About' ? 'underline' : '' ?>">
                ABOUT US
            </a>
            <a href="/login" class="text-white hover:text-accent text-lg tracking-wide transition-colors <?= ($active ?? '') === 'Login' ? 'underline' : '' ?>">
                LOGIN
            </a>
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
        <a href="/" class="block hover:bg-accent px-4 py-2 text-white">HOME</a>
        <a href="/about" class="block hover:bg-accent px-4 py-2 text-white">ABOUT US</a>
        <a href="/login" class="block hover:bg-accent px-4 py-2 text-white">LOGIN</a>
    </div>

    <script>
        // Toggle mobile menu
        const btn = document.getElementById('mobileMenuBtn');
        const menu = document.getElementById('mobileMenu');
        btn.addEventListener('click', () => menu.classList.toggle('hidden'));
    </script>
</header>