<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - EASY&CO</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4B7447',
                        secondary: '#7CA982',
                        accent: '#D4A373',
                        light: '#F4F1DE',
                    },
                }
            }
        }
    </script>

    <style>
        body,
        p,
        a,
        li,
        span,
        div,
        input,
        button {
            font-family: 'Lato', sans-serif !important;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Playfair Display', serif !important;
        }

        body {
            background-image: url('/assets/img/garden-bg.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
    </style>
</head>

<body class="relative bg-white/70 backdrop-blur-sm min-h-screen">

    <!-- Decorative Top Bar -->
    <div class="bg-accent h-3"></div>

    <!-- HEADER -->
    <?= view('components/header') ?>

    <!-- HERO SECTION -->
    <section class="relative w-full h-64 md:h-96 lg:h-[450px]">
        <img src="/assets/img/booking.webp" 
             class="w-full h-full object-cover" 
             alt="About EASY&CO">
        <div class="absolute inset-0 bg-black/40"></div>

        <div class="absolute inset-0 flex items-center justify-center">
            <h1 class="text-white text-5xl md:text-6xl font-bold drop-shadow-lg">About Us</h1>
        </div>
    </section>

    <!-- CONTENT WRAPPER -->
        <main class="max-w-5xl mx-auto px-6 mt-12 relative z-10">

 <!-- INTRO SECTION -->
<section class="text-center mb-16">
    <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4">
        Our Story
    </h2>
    <p class="text-gray-700 leading-relaxed max-w-4xl mx-auto text-lg text-justify">
        EASY&CO was created with a simple vision — to bring the serenity of nature into modern condo living. Rooted in comfort, elegance, and sustainability, our space is designed to feel like a peaceful garden sanctuary in the heart of the city. What began as a dream of blending greenery with everyday living has grown into a curated experience where guests can breathe, unwind, and reconnect. Every corner of our home is thoughtfully crafted to offer calmness in a world that rarely slows down — from warm natural textures and soft earthy tones, to relaxing spaces designed for genuine comfort. EASY&CO is more than a stay; it’s a lifestyle inspired by nature, shaped by intention, and made for those who seek beauty in simplicity.
    </p>
</section>


            <!-- TIMELINE SECTION -->
            <section class="mb-16">
                <h3 class="text-2xl font-bold text-primary mb-8 text-center">Journey Through the Years</h3>

                <div class="relative border-l-4 border-primary space-y-10 pl-6">

                    <div>
                        <h4 class="text-xl font-bold text-primary">2020 - The Idea Was Born</h4>
                        <p class="text-gray-700">
                            The founders envisioned a green-inspired condo experience that blends nature with modern living.
                        </p>
                    </div>

                    <div>
                        <h4 class="text-xl font-bold text-primary">2021 - Designing the Spaces</h4>
                        <p class="text-gray-700">
                            Interior designers, architects, and gardeners came together to shape a unique garden-centric theme.
                        </p>
                    </div>

                    <div>
                        <h4 class="text-xl font-bold text-primary">2023 - Soft Launch</h4>
                        <p class="text-gray-700">
                            EASY&CO opened its doors to its first guests and residents.
                        </p>
                    </div>

                    <div>
                        <h4 class="text-xl font-bold text-primary">2025 - Expansion & Digital Upgrade</h4>
                        <p class="text-gray-700">
                            EASY&CO introduced online bookings, redesigned branding, and modern digital services.
                        </p>
                    </div>

                </div>
            </section>

<!-- PHOTO GALLERY -->
<section class="mb-16">
    <h3 class="text-2xl font-bold text-primary mb-8 text-center">A Glimpse of EASY&CO</h3>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        <div class="overflow-hidden rounded-xl shadow hover:scale-105 transition-transform duration-300">
            <img src="/assets/img/room4.jpg" class="w-full h-52 object-cover">
        </div>

        <div class="overflow-hidden rounded-xl shadow hover:scale-105 transition-transform duration-300">
            <img src="/assets/img/kitchen.jpeg" class="w-full h-52 object-cover">
        </div>

        <div class="overflow-hidden rounded-xl shadow hover:scale-105 transition-transform duration-300">
            <img src="/assets/img/livingroom.jpg" class="w-full h-52 object-cover">
        </div>

        <div class="overflow-hidden rounded-xl shadow hover:scale-105 transition-transform duration-300">
            <img src="/assets/img/toilet.jpg" class="w-full h-52 object-cover">
        </div>

        <div class="overflow-hidden rounded-xl shadow hover:scale-105 transition-transform duration-300">
            <img src="/assets/img/booking.webp" class="w-full h-52 object-cover">
        </div>

        <div class="overflow-hidden rounded-xl shadow hover:scale-105 transition-transform duration-300">
            <img src="/assets/img/garden-bg.jpg" class="w-full h-52 object-cover">
        </div>
    </div>
</section>

            <!-- STAFF SECTION -->
            <section class="mb-10">
                <h3 class="text-2xl font-bold text-primary mb-8 text-center">Meet Our Team</h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-10 text-center">

                    <div>
                        <img src="/assets/img/staff1.jpg" class="w-40 h-40 mx-auto rounded-full object-cover shadow">
                        <h4 class="text-xl font-bold text-primary mt-4">Daniel Ling</h4>
                        <p class="text-gray-700">Founder & Creative Director</p>
                    </div>

                    <div>
                        <img src="/assets/img/staff2.jpg" class="w-40 h-40 mx-auto rounded-full object-cover shadow">
                        <h4 class="text-xl font-bold text-primary mt-4">Amilia Danielle</h4>
                        <p class="text-gray-700">Operations Manager</p>
                    </div>

                    <div>
                        <img src="/assets/img/staff3.jpg" class="w-40 h-40 mx-auto rounded-full object-cover shadow">
                        <h4 class="text-xl font-bold text-primary mt-4">Hilary Ashley</h4>
                        <p class="text-gray-700">Guest Services Lead</p>
                    </div>

                </div>

            </section>

        </div>
    </main>

    <!-- FOOTER -->
    <?= view('components/footer') ?>

</body>
</html>
