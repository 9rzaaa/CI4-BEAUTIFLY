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

/* Make the background scroll with the content */
body {
    background-image: url('/assets/img/bookingbg.jpg');
    background-size: 200s%;
    background-position: center;
    background-attachment: scroll; /* change fixed -> scroll */
}
</style>


</head>

<body class="relative bg-white/70 min-h-screen">

    <!-- Decorative Top Bar -->
    <div class="bg-accent h-3"></div>

    <!-- HEADER -->
    <?= view('components/header') ?>

    <!-- HERO + OUR STORY SECTION -->
    <section class="relative w-full min-h-[600px] lg:min-h-[700px] bg-primary text-white flex items-center justify-center">
        <!-- Background image -->
        <img src="../assets/img/booking.webp" class="absolute inset-0 w-full h-full object-cover" alt="Our Story Background">
        <div class="absolute inset-0 bg-black/50"></div>

        <!-- Content -->
        <div class="relative max-w-5xl mx-auto px-6 md:px-12 text-center">
            <h1 class="text-5xl md:text-6xl font-bold mb-6 drop-shadow-lg">Our Story</h1>

            <p class="text-lg md:text-xl leading-relaxed max-w-4xl mx-auto">
                EASY&CO was created with a simple vision — to bring the serenity of nature into modern condo living. 
                Rooted in comfort, elegance, and sustainability, our space is designed to feel like a peaceful garden 
                sanctuary in the heart of the city. What began as a dream of blending greenery with everyday living 
                has grown into a curated experience where guests can breathe, unwind, and reconnect. Every corner 
                of our home is thoughtfully crafted to offer calmness in a world that rarely slows down — from warm 
                natural textures and soft earthy tones, to relaxing spaces designed for genuine comfort. EASY&CO is 
                more than a stay; it’s a lifestyle inspired by nature, shaped by intention, and made for those who 
                seek beauty in simplicity.
            </p>
        </div>
    </section>

    <!-- CONTENT WRAPPER -->
        <main class="max-w-5xl mx-auto px-6 mt-12 relative z-10">

<div class="px-6 md:px-20 lg:px-32 py-20">

<!-- MODERN TIMELINE SECTION -->
<section class="mb-20 relative max-w-5xl mx-auto px-6">
    <h3 class="text-3xl md:text-4xl font-bold text-primary mb-12 text-center">
        Journey Through the Years
    </h3>

    <div class="relative before:absolute before:top-0 before:left-1/2 before:w-1 before:h-full before:bg-primary/30 before:-translate-x-1/2">
        <!-- Timeline Item 1 -->
        <div class="mb-12 flex flex-col md:flex-row items-center md:justify-between">
            <div class="md:w-5/12 md:text-right md:pr-8">
                <h4 class="text-xl font-bold text-primary mb-2">2020 - The Idea Was Born</h4>
                <p class="text-gray-700">
                    The founders envisioned a green-inspired condo experience blending nature with modern living.
                </p>
            </div>
            <div class="flex items-center justify-center w-10 h-10 bg-primary rounded-full text-white text-lg font-bold">
                1
            </div>
            <div class="md:w-5/12 md:text-left md:pl-8 hidden md:block"></div>
        </div>

        <!-- Timeline Item 2 -->
        <div class="mb-12 flex flex-col md:flex-row items-center md:justify-between">
            <div class="md:w-5/12 md:text-right md:pr-8 hidden md:block"></div>
            <div class="flex items-center justify-center w-10 h-10 bg-primary rounded-full text-white text-lg font-bold">
                2
            </div>
            <div class="md:w-5/12 md:text-left md:pl-8">
                <h4 class="text-xl font-bold text-primary mb-2">2021 - Designing the Space</h4>
                <p class="text-gray-700">
                    Interior designers, architects, and plant stylists collaborated to shape the signature garden-centric aesthetic.
                </p>
            </div>
        </div>

        <!-- Timeline Item 3 -->
        <div class="mb-12 flex flex-col md:flex-row items-center md:justify-between">
            <div class="md:w-5/12 md:text-right md:pr-8">
                <h4 class="text-xl font-bold text-primary mb-2">2023 - Soft Launch</h4>
                <p class="text-gray-700">
                    EASY&CO welcomed its first guests, offering a peaceful escape in the heart of the city.
                </p>
            </div>
            <div class="flex items-center justify-center w-10 h-10 bg-primary rounded-full text-white text-lg font-bold">
                3
            </div>
            <div class="md:w-5/12 md:text-left md:pl-8 hidden md:block"></div>
        </div>

        <!-- Timeline Item 4 -->
        <div class="flex flex-col md:flex-row items-center md:justify-between">
            <div class="md:w-5/12 md:text-right md:pr-8 hidden md:block"></div>
            <div class="flex items-center justify-center w-10 h-10 bg-primary rounded-full text-white text-lg font-bold">
                4
            </div>
            <div class="md:w-5/12 md:text-left md:pl-8">
                <h4 class="text-xl font-bold text-primary mb-2">2025 - Expansion & Digital Upgrade</h4>
                <p class="text-gray-700">
                    The brand introduced online bookings, refreshed branding, and upgraded guest experience features.
                </p>
            </div>
        </div>
    </div>
</section>


<!-- PHOTO GALLERY SECTION -->
<section class="mb-20 relative">

    <h3 class="text-2xl font-bold text-primary mb-6 text-center">
        A Glimpse of EASY&CO
    </h3>

    <div class="relative w-full flex items-center justify-center">

        <!-- LEFT ARROW -->
        <button id="galleryLeft"
            class="absolute -left-16 top-1/2 -translate-y-1/2 bg-primary text-white p-5 rounded-full shadow-lg hover:bg-primary/80 transition z-20">
            ❮
        </button>

        <!-- SCROLL CONTAINER -->
        <div id="galleryScroller" class="flex space-x-6 overflow-x-auto scroll-smooth snap-x snap-mandatory pb-4 no-scrollbar">

            <div class="flex-shrink-0 w-[700px] aspect-video rounded-2xl overflow-hidden snap-center hover:scale-105 transition-transform duration-300">
                <img src="/assets/img/garden.jpg" class="w-full h-full object-cover">
            </div>

            <div class="flex-shrink-0 w-[700px] aspect-video rounded-2xl overflow-hidden snap-center hover:scale-105 transition-transform duration-300">
                <img src="/assets/img/garden1.jpg" class="w-full h-full object-cover">
            </div>

            <div class="flex-shrink-0 w-[700px] aspect-video rounded-2xl overflow-hidden snap-center hover:scale-105 transition-transform duration-300">
                <img src="/assets/img/garden2.webp" class="w-full h-full object-cover">
            </div>

            <div class="flex-shrink-0 w-[700px] aspect-video rounded-2xl overflow-hidden snap-center hover:scale-105 transition-transform duration-300">
                <img src="/assets/img/garden3.webp" class="w-full h-full object-cover">
            </div>

            <div class="flex-shrink-0 w-[700px] aspect-video rounded-2xl overflow-hidden snap-center hover:scale-105 transition-transform duration-300">
                <img src="/assets/img/garden4.webp" class="w-full h-full object-cover">
            </div>

            <div class="flex-shrink-0 w-[700px] aspect-video rounded-2xl overflow-hidden snap-center hover:scale-105 transition-transform duration-300">
                <img src="/assets/img/garden5.jpg" class="w-full h-full object-cover">
            </div>

        </div>

        <!-- RIGHT ARROW -->
        <button id="galleryRight"
            class="absolute -right-16 top-1/2 -translate-y-1/2 bg-primary text-white p-5 rounded-full shadow-lg hover:bg-primary/80 transition z-20">
            ❯
        </button>

    </div>
</section>



<!-- REMOVE SCROLLBAR -->
<style>
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>

<!-- SCROLL BUTTON JS -->
<script>
const scroller = document.getElementById('galleryScroller');
const leftBtn = document.getElementById('galleryLeft');
const rightBtn = document.getElementById('galleryRight');

// Duplicate the gallery items to allow infinite scroll effect
const items = Array.from(scroller.children);
items.forEach(item => scroller.appendChild(item.cloneNode(true)));

const scrollAmount = scroller.clientWidth / 2; // scroll by half container = 2 items

rightBtn.addEventListener('click', () => {
    if (scroller.scrollLeft + scroller.clientWidth >= scroller.scrollWidth / 2) {
        scroller.scrollLeft = 0;
    } else {
        scroller.scrollBy({ left: scrollAmount, behavior: 'smooth' });
    }
});

leftBtn.addEventListener('click', () => {
    if (scroller.scrollLeft <= 0) {
        scroller.scrollLeft = scroller.scrollWidth / 2;
    } else {
        scroller.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
    }
});
</script>


</div>

    </main>

    <!-- FOOTER -->
    <?= view('components/footer') ?>

</body>
</html>
