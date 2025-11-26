<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EASY&CO - Luxury Condo Accommodation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#647FBC',
                        secondary: '#91ADC8',
                        accent: '#AED6CF',
                        light: '#FAFDD6',
                    },
                }
            }
        }
    </script>

<style>
    /* Fonts */
    body, p, a, li, span, div { font-family: 'Lato', sans-serif !important; }
    h1,h2,h3,h4,h5,h6 { font-family: 'Playfair Display', serif !important; }

    /* Fullscreen background image layer */
    .site-bg {
      position: fixed;
      inset: 0;                      /* top:0; right:0; bottom:0; left:0; */
      background-image: url('/assets/img/landingbg.webp');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      z-index: -2;
      will-change: transform;
      /* optional: use transform to create a new compositing layer for smoother scrolling */
      transform: translateZ(0);
    }

    /* Dark overlay (adjust alpha for stronger/weaker darkness) */
    .site-overlay {
      position: fixed;
      inset: 0;
      background-color: rgba(0,0,0,0.45); /* change .45 -> .6 for darker */
      z-index: -1;
      pointer-events: none;
    }

    /* Make header and hero transparent so background shows through */
    header.transparent { background: transparent; }
    section.hero { background: transparent; }

    /* If you want readable text inside sections that currently use bg-light, keep as is.
       To make those sections slightly translucent instead, you can use:
       .bg-light/90 (Tailwind) or a custom rgba background. */
  </style>
</head>
</head>

<body class="text-gray-900" >


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
                Relax and unwind at Easy & Co
            </p>

            <!-- CTA Button -->
            <a href="#book" class="inline-block bg-accent hover:bg-secondary shadow-lg px-16 py-5 font-bold text-black text-sm tracking-widest hover:scale-105 transition-all duration-300 transform">
                BOOK NOW
            </a>
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
    <section class="bg-light py-20">
        <div class="mx-auto px-6 max-w-7xl">
            <div class="gap-8 grid md:grid-cols-3">
                <!-- Amenities Card -->
                <div class="space-y-6">
                    <h3 class="font-bold text-black text-4xl tracking-tight">AMENITIES</h3>
                    <p class="text-gray-800 text-lg leading-relaxed">
                        Experience modern living with high-speed WiFi, smart TV, air conditioning, and a fully equipped kitchen.
                        Everything you need for a comfortable stay.
                    </p>
                    <a href="#amenities" class="inline-flex items-center font-semibold text-[#C8A998] hover:text-primary transition-colors">
                        VIEW AMENITIES <span class="ml-2">→</span>
                    </a>
                </div>

                <!-- Gallery Card -->
                <div class="space-y-6">
                    <h3 class="font-bold text-black text-4xl tracking-tight">GALLERY</h3>
                    <p class="text-gray-800 text-lg leading-relaxed">
                        Every corner of the condo has been designed with your comfort and relaxation in mind.
                        View our collection of images to discover more.
                    </p>
                    <a href="#gallery" class="inline-flex items-center font-semibold text-[#C8A998] hover:text-primary transition-colors">
                        SEE PHOTOS <span class="ml-2">→</span>
                    </a>
                </div>

                <!-- Special Deals Card -->
                <div class="space-y-6">
                    <h3 class="font-bold text-black text-4xl tracking-tight">SPECIAL DEALS</h3>
                    <p class="text-gray-800 text-lg leading-relaxed">
                        Exciting offers are coming soon! Follow us on social media or check back here for the latest
                        updates and promotions.
                    </p>
                    <a href="#pricing" class="inline-flex items-center font-semibold text-[#C8A998] hover:text-primary transition-colors">
                        SEE PRICING <span class="ml-2">→</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

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
    <section class="bg-light py-20 text-center">
        <div class="mx-auto px-6 max-w-4xl">
            <h2 class="mb-8 font-bold text-black text-5xl md:text-6xl tracking-tight">
                WE CAN'T WAIT TO SEE YOU.
            </h2>

            <p class="mb-8 text-gray-800 text-xl">
                123 Main Street, City Center, Metro Manila
            </p>

            <a href="#map" class="inline-flex items-center mb-12 font-semibold text-[#C8A998] hover:text-primary text-lg transition-colors">
                SEE ON MAP <span class="ml-2">→</span>
            </a>

            <!-- Action Buttons -->
            <div class="flex sm:flex-row flex-col justify-center items-center gap-4 mt-8">
                <a href="#book" class="bg-accent hover:bg-secondary px-12 py-4 font-bold text-black text-sm tracking-widest hover:scale-105 transition-all duration-300 transform">
                    BOOK NOW
                </a>
                <a href="#contact" class="bg-white hover:bg-gray-50 px-12 py-4 border-2 border-accent font-bold text-black text-sm tracking-widest transition-all duration-300">
                    CONTACT US
                </a>
            </div>
        </div>
    </section>

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