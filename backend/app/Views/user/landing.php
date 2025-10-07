<!DOCTYPE html>
<html lang="en">

<?= view('components/head') ?>

<body class="bg-primary text-gray-900">

    <!-- Decorative Top Bar -->
    <div class="bg-accent h-3"></div>

    <!-- Header -->
    <?= view('components/header', ['active' => 'Home']) ?>

    <!-- Hero Section -->
    <section class="relative bg-primary text-white text-center">
        <div class="mx-auto px-6 py-32 max-w-7xl">
            <h2 class="mb-6 font-bold text-white text-6xl md:text-7xl leading-tight tracking-tight">
                LUXURY CONDO
            </h2>
            <h3 class="mb-16 font-bold text-white text-6xl md:text-7xl leading-tight tracking-tight">
                ACCOMMODATION
            </h3>

            <p class="mb-16 font-light text-white text-2xl tracking-wide">
                Relax and unwind at EASY&CO
            </p>

            <!-- CTA Button -->
            <?= view('components/buttons/button_primary', ['href' => '/booking', 'label' => 'BOOK NOW']) ?>
        </div>
    </section>

    <!-- Showcase Image Section -->
    <section class="bg-light py-16">
        <div class="mx-auto px-6 max-w-6xl">
            <div class="relative shadow-2xl rounded-2xl overflow-hidden">
                <!-- Placeholder for your condo image -->
                <img src="/assets/img/condo.jpg" alt="EASY&CO Luxury Condo Interior" class="w-full h-auto object-cover">

            </div>
        </div>
    </section>

    <!-- About Section - Two Column Layout -->
    <section class="bg-light py-20">
        <div class="mx-auto px-6 max-w-7xl">
            <div class="items-center gap-12 grid md:grid-cols-2">
                <!-- Left Content -->
                <div class="space-y-6">
                    <h2 class="font-bold text-black text-5xl tracking-tight">THE CONDO</h2>

                    <p class="text-gray-800 text-lg leading-relaxed">
                        Located in the heart of the city, EASY&CO offers a perfect blend of modern luxury and comfort.
                        Our newly renovated condo provides everything you need for an unforgettable stay.
                    </p>

                    <p class="text-gray-800 text-lg leading-relaxed">
                        Featuring contemporary design with high-end amenities, a fully equipped kitchen, and stylish
                        living spaces, our condo is designed to make you feel at home. Whether you're here for business
                        or leisure, every detail has been carefully considered for your comfort and convenience.
                    </p>
                </div>

                <!-- Right Image -->
                <div class="relative shadow-xl rounded-2xl overflow-hidden">
                    <img src="/assets/img/room.jpg" alt="EASY&CO Condo Interior" class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </section>

    <!-- Info Cards Section -->
    <?= view('components/cards') ?>


    <!-- Image Gallery Section -->
    <section class="bg-light py-12 pb-20">
        <div class="mx-auto px-6 max-w-7xl">
            <div class="gap-6 grid md:grid-cols-3">
                <!-- Image 1 -->
                <div class="relative shadow-lg hover:shadow-2xl rounded-xl overflow-hidden transition-shadow duration-300">
                    <img src="/assets/img/room1.jpg" alt="EASY&CO Condo View 1" class="w-full h-full object-cover">
                </div>

                <!-- Image 2 -->
                <div class="relative shadow-lg hover:shadow-2xl rounded-xl overflow-hidden transition-shadow duration-300">
                    <img src="/assets/img/room2.jpg" alt="EASY&CO Condo View 2" class="w-full h-full object-cover">
                </div>

                <!-- Image 3 -->
                <div class="relative shadow-lg hover:shadow-2xl rounded-xl overflow-hidden transition-shadow duration-300">
                    <img src="/assets/img/room3.jpg" alt="EASY&CO Condo View 3" class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <?= view('components/cta', [
        'heading' => "WE CAN'T WAIT TO SEE YOU.",
        'sub' => "123 Main Street, City Center, Metro Manila",
        'map_href' => "#map",
        'map_label' => "SEE ON MAP",
        'primary' => ['href' => '#book', 'label' => 'BOOK NOW'],
        'secondary' => ['href' => '#contact', 'label' => 'CONTACT US']
    ]) ?>

    <!-- Instagram Section -->
    <section class="bg-light py-16">
        <div class="mx-auto px-6 max-w-7xl">
            <div class="flex md:flex-row flex-col justify-between items-center mb-8">
                <h3 class="mb-4 md:mb-0 font-bold text-black text-4xl tracking-tight">
                    RECENTLY ON INSTAGRAM
                </h3>
                <a href="https://instagram.com/easyco_condo" target="_blank" class="inline-flex items-center font-semibold text-[#C8A998] hover:text-primary text-lg transition-colors">
                    FOLLOW @EASYCO_CONDO <span class="ml-2">→</span>
                </a>
            </div>
    </section>

    <!-- Footer -->
    <?= view('components/footer') ?>


</body>

</html>