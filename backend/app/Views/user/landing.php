<!DOCTYPE html>
<html lang="en">

<?= view('components/head') ?>

<body class="text-gray-900">

    <!-- Decorative Top Bar -->
    <div class="bg-accent h-3"></div>

    <!-- Header -->
    <?= view('components/header', ['active' => 'Home']) ?>

<!-- Hero Section -->
<section class="relative text-white text-center h-screen flex items-center">
    
    <!-- Background Image -->
    <div class="absolute inset-0 w-full h-full">
        <img src="/assets/img/landingbg.webp" 
             class="w-full h-full object-cover" 
             alt="Luxury Condo Background">
    </div>

    <!-- Dark Overlay -->
    <div class="absolute inset-0 bg-black/50"></div>

    <!-- Content -->
    <div class="relative mx-auto px-6 max-w-7xl">
        <h2 class="mb-6 font-bold text-white text-6xl md:text-7xl leading-tight tracking-tight">
            LUXURY CONDO
        </h2>
        <h3 class="mb-16 font-bold text-white text-6xl md:text-7xl leading-tight tracking-tight">
            ACCOMMODATION
        </h3>

        <?php
        $session = session();
        $user = $session->get('user');
        $firstName = $user['first_name'] ?? '';
        ?>

        <p class="mb-16 text-white text-2xl font-light tracking-wide">
            <?php if (!empty($firstName)): ?>
                Welcome back, <?= esc($firstName) ?>! Relax and unwind at EASY&CO
            <?php else: ?>
                Relax and unwind at EASY&CO
            <?php endif; ?>
        </p>

        <!-- CTA Button -->
        <?= view('components/buttons/button_primary', ['href' => '/booking', 'label' => 'BOOK NOW']) ?>
    </div>
</section>


    <!-- About Section -->
    <?= view('components/landing/about') ?>

    <!-- Info Cards Section -->
    <?= view('components/cards/cards') ?>

    <!-- Image Gallery Section -->
    <?= view('components/landing/gallery') ?>

    <!-- Call to Action Section -->
    <?= view('components/cta', [
        'heading' => "WE CAN'T WAIT TO SEE YOU.",
        'sub' => "123 Aurora boulevard, Quezon City",
        'map_href' => "#map",
        'map_label' => "SEE ON MAP",
        'primary' => ['href' => '#book', 'label' => 'BOOK NOW'],
        'secondary' => ['href' => '#contact', 'label' => 'CONTACT US']
    ]) ?>


    <!-- Image Gallery Section -->
    <?= view('components/landing/ig') ?>



    <!-- Footer -->
    <?= view('components/footer') ?>

</body>
</html>
