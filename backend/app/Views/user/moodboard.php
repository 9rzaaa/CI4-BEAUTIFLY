<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brand Mood Board - EASY&CO</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
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
    </style>
</head>

<body class="bg-gray-50">

    <!-- Decorative Top Bar -->
    <div class="bg-accent h-3"></div>

    <!-- Header -->
    <header class="bg-primary">
        <div class="flex justify-between items-center mx-auto py-4 pr-6 pl-2 max-w-7xl">
            <a href="/" class="flex items-center space-x-4">
                <img src="/assets/logo/logo.png" alt="EASY&CO Logo" class="w-auto h-16">
            </a>

            <nav class="hidden md:flex space-x-12">
                <a href="index.php" class="text-white hover:text-accent text-lg tracking-wide transition-colors">HOME</a>
                <a href="#about" class="text-white hover:text-accent text-lg tracking-wide transition-colors">ABOUT US</a>
                <a href="login.php" class="text-white hover:text-accent text-lg tracking-wide transition-colors">LOGIN</a>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="mx-auto px-6 py-16 max-w-7xl">
        <div class="mb-12">
            <h1 class="mb-2 font-bold text-gray-800 text-5xl">Mood board</h1>
            <p class="text-gray-600 text-xl">Visual identity samples for EASY&CO (Luxury Condo Accommodation)</p>
        </div>

        <!-- COLOR SYSTEM SECTION -->
        <section class="mb-16">
            <h2 class="mb-4 font-bold text-gray-800 text-3xl">Color system</h2>
            <p class="mb-8 text-gray-600 text-lg">Four main colors with three vibrance levels (dark → light). Preview and hex codes shown below.</p>

            <div class="gap-6 grid md:grid-cols-2 lg:grid-cols-4">
                <!-- Primary Blue -->
                <div>
                    <div class="mb-3 rounded-xl w-full h-20" style="background-color: #4A5F8F;"></div>
                    <div class="bg-primary mb-3 rounded-xl w-full h-20"></div>
                    <div class="mb-4 rounded-xl w-full h-20" style="background-color: #9BA9CC;"></div>
                    <h3 class="mb-2 font-bold text-gray-800 text-xl">Ocean Blue (Main accent)</h3>
                    <p class="text-gray-600 text-sm">#4A5F8F — #647FBC — #9BA9CC</p>
                </div>

                <!-- Secondary Blue -->
                <div>
                    <div class="mb-3 rounded-xl w-full h-20" style="background-color: #7092B8;"></div>
                    <div class="bg-secondary mb-3 rounded-xl w-full h-20"></div>
                    <div class="mb-4 rounded-xl w-full h-20" style="background-color: #C8D7E8;"></div>
                    <h3 class="mb-2 font-bold text-gray-800 text-xl">Sky Blue (Subtle warmth)</h3>
                    <p class="text-gray-600 text-sm">#7092B8 — #91ADC8 — #C8D7E8</p>
                </div>

                <!-- Accent Mint -->
                <div>
                    <div class="mb-3 rounded-xl w-full h-20" style="background-color: #8BC4BB;"></div>
                    <div class="bg-accent mb-3 rounded-xl w-full h-20"></div>
                    <div class="mb-4 rounded-xl w-full h-20" style="background-color: #D6EBE7;"></div>
                    <h3 class="mb-2 font-bold text-gray-800 text-xl">Mint Green (Highlight)</h3>
                    <p class="text-gray-600 text-sm">#8BC4BB — #AED6CF — #D6EBE7</p>
                </div>

                <!-- Light Cream -->
                <div>
                    <div class="mb-3 rounded-xl w-full h-20" style="background-color: #F5F8C4;"></div>
                    <div class="bg-light mb-3 rounded-xl w-full h-20"></div>
                    <div class="mb-4 rounded-xl w-full h-20" style="background-color: #FDFEED;"></div>
                    <h3 class="mb-2 font-bold text-gray-800 text-xl">Cream (Background)</h3>
                    <p class="text-gray-600 text-sm">#F5F8C4 — #FAFDD6 — #FDFEED</p>
                </div>
            </div>
        </section>

        <!-- TYPOGRAPHY SECTION -->
        <section class="mb-16">
            <h2 class="mb-8 font-bold text-gray-800 text-3xl">Typography</h2>

            <div class="gap-12 grid md:grid-cols-2">
                <!-- Heading Font -->
                <div>
                    <p class="mb-4 text-gray-600 text-sm">Heading font</p>
                    <h3 class="mb-6 font-bold text-gray-800 text-4xl" style="font-family: 'Playfair Display', serif !important;">
                        Playfair Display — Heading example
                    </h3>
                    <div class="space-y-2">
                        <p class="font-bold text-2xl" style="font-family: 'Playfair Display', serif !important;">ABCDEFGHIJKLMNOPQRSTUVWXYZ</p>
                        <p class="font-bold text-2xl" style="font-family: 'Playfair Display', serif !important;">abcdefghijklmnopqrstuvwxyz</p>
                        <p class="font-bold text-2xl" style="font-family: 'Playfair Display', serif !important;">0123456789</p>
                    </div>
                </div>

                <!-- Body Font -->
                <div>
                    <p class="mb-4 text-gray-600 text-sm">Body font</p>
                    <h3 class="mb-6 font-normal text-gray-800 text-xl">
                        Lato — Body text example that demonstrates readable copy for longer paragraphs.
                    </h3>
                    <div class="space-y-2">
                        <p class="text-xl">ABCDEFGHIJKLMNOPQRSTUVWXYZ</p>
                        <p class="text-xl">abcdefghijklmnopqrstuvwxyz</p>
                        <p class="text-xl">0123456789</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- BUTTONS SECTION (Horizontal Layout) -->
        <section class="mb-16">
            <h2 class="mb-8 font-bold text-gray-800 text-3xl">Button Set</h2>

            <!-- Light Mode Buttons -->
            <div class="bg-white shadow-lg mb-8 p-8 rounded-lg">
                <p class="mb-6 font-semibold text-gray-700 text-lg">Light Mode</p>
                <div class="gap-4 grid grid-cols-2 md:grid-cols-4">
                    <div class="text-center">
                        <button class="bg-primary hover:bg-opacity-90 mb-3 px-6 py-3 rounded-lg w-full font-semibold text-white transition-all">
                            Book Now
                        </button>
                        <p class="text-gray-600 text-sm">Primary</p>
                    </div>
                    <div class="text-center">
                        <button class="bg-secondary hover:bg-opacity-90 mb-3 px-6 py-3 rounded-lg w-full font-semibold text-white transition-all">
                            Learn More
                        </button>
                        <p class="text-gray-600 text-sm">Secondary</p>
                    </div>
                    <div class="text-center">
                        <button class="bg-white hover:bg-primary mb-3 px-6 py-3 border-2 border-primary rounded-lg w-full font-semibold text-primary hover:text-white transition-all">
                            Contact Us
                        </button>
                        <p class="text-gray-600 text-sm">Border</p>
                    </div>
                    <div class="text-center">
                        <button disabled class="bg-gray-300 mb-3 px-6 py-3 rounded-lg w-full font-semibold text-gray-500 cursor-not-allowed">
                            Unavailable
                        </button>
                        <p class="text-gray-600 text-sm">Disabled</p>
                    </div>
                </div>
            </div>

            <!-- Dark Mode Buttons -->
            <div class="bg-gray-900 shadow-lg p-8 rounded-lg">
                <p class="mb-6 font-semibold text-white text-lg">Dark Mode</p>
                <div class="gap-4 grid grid-cols-2 md:grid-cols-4">
                    <div class="text-center">
                        <button class="bg-primary hover:bg-opacity-90 mb-3 px-6 py-3 rounded-lg w-full font-semibold text-white transition-all">
                            Book Now
                        </button>
                        <p class="text-gray-400 text-sm">Primary</p>
                    </div>
                    <div class="text-center">
                        <button class="bg-secondary hover:bg-opacity-90 mb-3 px-6 py-3 rounded-lg w-full font-semibold text-white transition-all">
                            Learn More
                        </button>
                        <p class="text-gray-400 text-sm">Secondary</p>
                    </div>
                    <div class="text-center">
                        <button class="bg-transparent hover:bg-primary mb-3 px-6 py-3 border-2 border-accent hover:border-primary rounded-lg w-full font-semibold text-accent hover:text-white transition-all">
                            Contact Us
                        </button>
                        <p class="text-gray-400 text-sm">Border</p>
                    </div>
                    <div class="text-center">
                        <button disabled class="bg-gray-700 mb-3 px-6 py-3 rounded-lg w-full font-semibold text-gray-500 cursor-not-allowed">
                            Unavailable
                        </button>
                        <p class="text-gray-400 text-sm">Disabled</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CARD SET SECTION (Wider Rectangular) -->
        <section class="mb-16">
            <h2 class="mb-8 font-bold text-gray-800 text-3xl">Card Set</h2>

            <div class="gap-6 grid md:grid-cols-3">
                <!-- Card 1 - Amenities -->
                <div class="bg-amber-50 hover:shadow-lg p-8 border-2 border-gray-300 rounded-2xl transition-shadow">
                    <h3 class="mb-3 font-bold text-gray-900 text-2xl">Amenities</h3>
                    <p class="mb-6 text-gray-600 text-base leading-relaxed">Enjoy high-speed WiFi, smart TVs, air-conditioned rooms, board games, microphone karaoke, premium bedding, access to pool, and 24/7 security for your ultimate convenience and comfort.</p>
                    <a href="#" class="inline-flex items-center font-semibold text-blue-600 hover:text-blue-700 text-base transition-colors">
                        View All Amenities <span class="ml-2">→</span>
                    </a>
                </div>

                <!-- Card 2 - Gallery -->
                <div class="bg-amber-50 hover:shadow-lg p-8 border-2 border-gray-300 rounded-2xl transition-shadow">
                    <h3 class="mb-3 font-bold text-gray-900 text-2xl">Gallery</h3>
                    <p class="mb-6 text-gray-600 text-base leading-relaxed">Browse through our collection of stunning photos showcasing luxurious interiors, breathtaking views, and premium facilities that make EASY&CO your home away from home.</p>
                    <a href="#" class="inline-flex items-center font-semibold text-blue-600 hover:text-blue-700 text-base transition-colors">
                        Explore Gallery <span class="ml-2">→</span>
                    </a>
                </div>

                <!-- Card 3 - Special Deals -->
                <div class="bg-amber-50 hover:shadow-lg p-8 border-2 border-gray-300 rounded-2xl transition-shadow">
                    <h3 class="mb-3 font-bold text-gray-900 text-2xl">Special Deals</h3>
                    <p class="mb-6 text-gray-600 text-base leading-relaxed">Take advantage of our exclusive promotions and seasonal offers. Save up to 30% on extended stays and enjoy complimentary services with our special packages.</p>
                    <a href="#" class="inline-flex items-center font-semibold text-blue-600 hover:text-blue-700 text-base transition-colors">
                        See Current Deals <span class="ml-2">→</span>
                    </a>
                </div>
            </div>
        </section>

        <!-- LOGOS SECTION -->
        <section class="mb-16">
            <h2 class="mb-8 font-bold text-gray-800 text-3xl">Logos</h2>

            <div class="gap-8 grid md:grid-cols-2">
                <!-- Circle Logo -->
                <div class="bg-white shadow-lg p-8 rounded-lg">
                    <div class="flex justify-center items-center bg-white mx-auto mb-4 border-4 border-transparent rounded-full w-48 h-48 overflow-hidden">
                        <img src="/assets/logo/logobg.png" alt="E&CO Circle Logo" class="w-full h-full object-cover scale-110">
                    </div>
                    <p class="font-semibold text-gray-600 text-center">Circle Format</p>
                </div>

                <!-- Square Logo -->
                <div class="bg-white shadow-lg p-8 rounded-lg">
                    <div class="flex justify-center items-center mx-auto mb-4 rounded-lg w-48 h-48 overflow-hidden">
                        <img src="/assets/logo/logobg.png" alt="E&CO Square Logo" class="w-full h-full object-contain">
                    </div>
                    <p class="font-semibold text-gray-600 text-center">Square Format</p>
                </div>
            </div>
        </section>

    </main>

    <!-- Footer -->
    <footer class="bg-light py-16 text-gray-600">
        <div class="mx-auto px-6 max-w-7xl">
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

            <div class="flex sm:flex-row flex-col justify-center items-center gap-8 mb-12 text-center">
                <a href="#covid-policy" class="font-semibold text-gray-800 hover:text-primary text-sm tracking-widest transition-colors">COVID-19 POLICY</a>
                <a href="#terms" class="font-semibold text-gray-800 hover:text-primary text-sm tracking-widest transition-colors">TERMS & CONDITIONS</a>
                <a href="#privacy" class="font-semibold text-gray-800 hover:text-primary text-sm tracking-widest transition-colors">PRIVACY POLICY</a>
                <a href="#contact" class="font-semibold text-gray-800 hover:text-primary text-sm tracking-widest transition-colors">CONTACT</a>
            </div>

            <div class="space-y-2 text-center">
                <p class="text-gray-500 text-sm tracking-wide">COPYRIGHT 2025 EASY&CO. ALL RIGHTS RESERVED.</p>
                <p class="text-gray-500 text-xs tracking-wide">WEBSITE BY DANIEL LING</p>
            </div>

            <div class="mx-auto mt-12 max-w-5xl text-center">
                <p class="text-gray-400 text-xs leading-relaxed tracking-wide">
                    WE ACKNOWLEDGE THAT EASY&CO IS LOCATED IN METRO MANILA. WE PAY OUR RESPECTS TO THE LOCAL COMMUNITY AND THEIR ELDERS, PAST, PRESENT AND EMERGING.
                </p>
            </div>
        </div>
    </footer>

</body>

</html>