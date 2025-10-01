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
        body,
        p,
        a,
        li,
        span,
        div {
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
    </style>
</head>
</head>

<body class="bg-primary text-gray-900">

    <!-- Decorative Top Bar -->
    <div class="bg-accent h-3"></div>

    <!-- Header -->
    <header class="bg-primary">
        <div class="flex justify-between items-center mx-auto py-8 pr-6 pl-2 max-w-7xl">
            <!-- Logo Section -->
            <a href="/" class="flex items-center space-x-4">
                <img src="/assets/logo/logo.png" alt="EASY&CO Logo" class="w-auto h-20">
            </a>

            <!-- Navigation -->
            <nav class="hidden md:flex space-x-12">
                <a href="#home" class="text-white hover:text-accent text-lg tracking-wide transition-colors">
                    HOME
                </a>
                <a href="#about" class="text-white hover:text-accent text-lg tracking-wide transition-colors">
                    ABOUT US
                </a>
                <a href="#login" class="text-white hover:text-accent text-lg tracking-wide transition-colors">
                    LOGIN
                </a>
            </nav>

            <!-- Mobile Menu Button -->
            <button class="md:hidden text-white">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </header>

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
    <footer class="bg-light py-16 text-gray-600">
        <div class="mx-auto px-6 max-w-7xl">
            <!-- Social Media Icons -->
            <div class="flex justify-center items-center gap-6 mb-12">
                <a href="https://facebook.com/easyco_condo" target="_blank" class="hover:opacity-70 transition-opacity">
                    <svg class="w-12 h-12 text-[#C8A998]" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                    </svg>
                </a>
                <a href="https://instagram.com/easyco_condo" target="_blank" class="hover:opacity-70 transition-opacity">
                    <svg class="w-12 h-12 text-[#C8A998]" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                    </svg>
                </a>
            </div>

            <!-- Footer Links -->
            <div class="flex sm:flex-row flex-col justify-center items-center gap-8 mb-12 text-center">
                <a href="#covid-policy" class="font-semibold text-gray-800 hover:text-primary text-sm tracking-widest transition-colors">
                    COVID-19 POLICY
                </a>
                <a href="#terms" class="font-semibold text-gray-800 hover:text-primary text-sm tracking-widest transition-colors">
                    TERMS & CONDITIONS
                </a>
                <a href="#privacy" class="font-semibold text-gray-800 hover:text-primary text-sm tracking-widest transition-colors">
                    PRIVACY POLICY
                </a>
                <a href="#contact" class="font-semibold text-gray-800 hover:text-primary text-sm tracking-widest transition-colors">
                    CONTACT
                </a>
            </div>

            <!-- Copyright -->
            <div class="space-y-2 text-center">
                <p class="text-gray-500 text-sm tracking-wide">
                    COPYRIGHT 2025 EASY&CO. ALL RIGHTS RESERVED.
                </p>
                <p class="text-gray-500 text-xs tracking-wide">
                    WEBSITE BY DANIEL LING
                </p>
            </div>

            <!-- Acknowledgment -->
            <div class="mx-auto mt-12 max-w-5xl text-center">
                <p class="text-gray-400 text-xs leading-relaxed tracking-wide">
                    WE ACKNOWLEDGE THAT EASY&CO IS LOCATED IN METRO MANILA. WE PAY OUR RESPECTS TO THE LOCAL COMMUNITY AND THEIR ELDERS, PAST, PRESENT AND EMERGING.
                </p>
            </div>
        </div>
    </footer>

</body>

</html>