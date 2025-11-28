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
            background-size: 205%;
            background-position: center;
            background-attachment: scroll;
            /* change fixed -> scroll */
        }
    </style>


</head>

<body class="relative bg-white/70 min-h-screen">

    <!-- Decorative Top Bar -->
    <div class="bg-accent h-3"></div>

    <!-- HEADER -->
    <?= view('components/header', ['active' => 'About']) ?>

    <!-- HERO + OUR STORY SECTION -->
    <section class="relative flex justify-center items-center bg-primary w-full min-h-[600px] lg:min-h-[700px] text-white">
        <!-- Background image -->
        <img src="../assets/img/booking.webp" class="absolute inset-0 w-full h-full object-cover" alt="Our Story Background">
        <div class="absolute inset-0 bg-black/50"></div>

        <!-- Content -->
        <div class="relative mx-auto px-6 md:px-12 max-w-5xl text-center">
            <h1 class="drop-shadow-lg mb-6 font-bold text-5xl md:text-6xl">Our Story</h1>

            <p class="mx-auto max-w-4xl text-lg md:text-xl leading-relaxed">
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
    <main class="z-10 relative mx-auto mt-12 px-6 max-w-5xl">

        <div class="px-6 md:px-20 lg:px-32 py-20">

            <!-- MODERN TIMELINE SECTION -->
            <section class="relative mx-auto mb-20 px-6 max-w-5xl">
                <h3 class="mb-12 font-bold text-primary text-3xl md:text-4xl text-center">
                    Journey Through the Years
                </h3>

                <div class="before:top-0 before:left-1/2 before:absolute relative before:bg-primary/30 before:w-1 before:h-full before:-translate-x-1/2">
                    <!-- Timeline Item 1 -->
                    <div class="flex md:flex-row flex-col md:justify-between items-center mb-12">
                        <div class="md:pr-8 md:w-5/12 md:text-right">
                            <h4 class="mb-2 font-bold text-primary text-xl">2020 - The Idea Was Born</h4>
                            <p class="text-gray-700">
                                The founders envisioned a green-inspired condo experience blending nature with modern living.
                            </p>
                        </div>
                        <div class="flex justify-center items-center bg-primary rounded-full w-10 h-10 font-bold text-white text-lg">
                            1
                        </div>
                        <div class="hidden md:block md:pl-8 md:w-5/12 md:text-left"></div>
                    </div>

                    <!-- Timeline Item 2 -->
                    <div class="flex md:flex-row flex-col md:justify-between items-center mb-12">
                        <div class="hidden md:block md:pr-8 md:w-5/12 md:text-right"></div>
                        <div class="flex justify-center items-center bg-primary rounded-full w-10 h-10 font-bold text-white text-lg">
                            2
                        </div>
                        <div class="md:pl-8 md:w-5/12 md:text-left">
                            <h4 class="mb-2 font-bold text-primary text-xl">2021 - Designing the Space</h4>
                            <p class="text-gray-700">
                                Interior designers, architects, and plant stylists collaborated to shape the signature garden-centric aesthetic.
                            </p>
                        </div>
                    </div>

                    <!-- Timeline Item 3 -->
                    <div class="flex md:flex-row flex-col md:justify-between items-center mb-12">
                        <div class="md:pr-8 md:w-5/12 md:text-right">
                            <h4 class="mb-2 font-bold text-primary text-xl">2023 - Soft Launch</h4>
                            <p class="text-gray-700">
                                EASY&CO welcomed its first guests, offering a peaceful escape in the heart of the city.
                            </p>
                        </div>
                        <div class="flex justify-center items-center bg-primary rounded-full w-10 h-10 font-bold text-white text-lg">
                            3
                        </div>
                        <div class="hidden md:block md:pl-8 md:w-5/12 md:text-left"></div>
                    </div>

                    <!-- Timeline Item 4 -->
                    <div class="flex md:flex-row flex-col md:justify-between items-center">
                        <div class="hidden md:block md:pr-8 md:w-5/12 md:text-right"></div>
                        <div class="flex justify-center items-center bg-primary rounded-full w-10 h-10 font-bold text-white text-lg">
                            4
                        </div>
                        <div class="md:pl-8 md:w-5/12 md:text-left">
                            <h4 class="mb-2 font-bold text-primary text-xl">2025 - Expansion & Digital Upgrade</h4>
                            <p class="text-gray-700">
                                The brand introduced online bookings, refreshed branding, and upgraded guest experience features.
                            </p>
                        </div>
                    </div>
                </div>
            </section>


            <!-- PHOTO GALLERY SECTION -->
            <section class="relative mb-20">

                <h3 class="mb-6 font-bold text-primary text-2xl text-center">
                    A Glimpse of EASY&CO
                </h3>

                <div class="relative flex justify-center items-center w-full">

                    <!-- LEFT ARROW -->
                    <button id="galleryLeft"
                        class="top-1/2 -left-16 z-20 absolute bg-primary hover:bg-primary/80 shadow-lg p-5 rounded-full text-white transition -translate-y-1/2">
                        ❮
                    </button>

                    <!-- SCROLL CONTAINER -->
                    <div id="galleryScroller" class="flex space-x-6 pb-4 overflow-x-auto scroll-smooth snap-mandatory snap-x no-scrollbar">

                        <div class="flex-shrink-0 rounded-2xl w-[700px] aspect-video overflow-hidden hover:scale-105 transition-transform duration-300 snap-center">
                            <img src="/assets/img/garden.jpg" class="w-full h-full object-cover">
                        </div>

                        <div class="flex-shrink-0 rounded-2xl w-[700px] aspect-video overflow-hidden hover:scale-105 transition-transform duration-300 snap-center">
                            <img src="/assets/img/garden1.jpg" class="w-full h-full object-cover">
                        </div>

                        <div class="flex-shrink-0 rounded-2xl w-[700px] aspect-video overflow-hidden hover:scale-105 transition-transform duration-300 snap-center">
                            <img src="/assets/img/garden2.webp" class="w-full h-full object-cover">
                        </div>

                        <div class="flex-shrink-0 rounded-2xl w-[700px] aspect-video overflow-hidden hover:scale-105 transition-transform duration-300 snap-center">
                            <img src="/assets/img/garden3.webp" class="w-full h-full object-cover">
                        </div>

                        <div class="flex-shrink-0 rounded-2xl w-[700px] aspect-video overflow-hidden hover:scale-105 transition-transform duration-300 snap-center">
                            <img src="/assets/img/garden4.webp" class="w-full h-full object-cover">
                        </div>

                        <div class="flex-shrink-0 rounded-2xl w-[700px] aspect-video overflow-hidden hover:scale-105 transition-transform duration-300 snap-center">
                            <img src="/assets/img/garden5.jpg" class="w-full h-full object-cover">
                        </div>

                    </div>

                    <!-- RIGHT ARROW -->
                    <button id="galleryRight"
                        class="top-1/2 -right-16 z-20 absolute bg-primary hover:bg-primary/80 shadow-lg p-5 rounded-full text-white transition -translate-y-1/2">
                        ❯
                    </button>

                </div>
            </section>



            <!-- REMOVE SCROLLBAR -->
            <style>
                .no-scrollbar::-webkit-scrollbar {
                    display: none;
                }

                .no-scrollbar {
                    -ms-overflow-style: none;
                    scrollbar-width: none;
                }
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
                        scroller.scrollBy({
                            left: scrollAmount,
                            behavior: 'smooth'
                        });
                    }
                });

                leftBtn.addEventListener('click', () => {
                    if (scroller.scrollLeft <= 0) {
                        scroller.scrollLeft = scroller.scrollWidth / 2;
                    } else {
                        scroller.scrollBy({
                            left: -scrollAmount,
                            behavior: 'smooth'
                        });
                    }
                });
            </script>


        </div>

    </main>

    <!-- FOOTER -->
    <?= view('components/footer') ?>

</body>

</html>
