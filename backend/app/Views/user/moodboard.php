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
                        primary: '#4B7447',   // Forest Green
                        secondary: '#7CA982', // Soft Green
                        accent: '#D4A373',    // Earthy Terracotta
                        light: '#F4F1DE',     // Soft Cream
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
            background-image: url('/assets/img/garden-bg.jpg'); /* Replace with your garden image */
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
    </style>
</head>

<body class="bg-light bg-opacity-80">

    <!-- Decorative Top Bar -->
    <div class="bg-accent h-3"></div>

    <!-- Header -->
    <?= view('components/header') ?>

    <!-- Main Content -->
    <main class="mx-auto px-6 py-16 max-w-7xl">

        <div class="mb-12">
            <h1 class="mb-2 font-bold text-gray-800 text-5xl">Mood board</h1>
            <p class="text-gray-600 text-xl">Visual identity samples for EASY&CO (Garden-Inspired Luxury Condo)</p>
        </div>

        <!-- COLOR SYSTEM SECTION -->
        <section class="mb-16">
            <h2 class="mb-4 font-bold text-gray-800 text-3xl">Color system</h2>
            <p class="mb-8 text-gray-600 text-lg">Garden-inspired colors with earthy and natural accents. Preview and hex codes shown below.</p>

            <div class="gap-6 grid md:grid-cols-2 lg:grid-cols-4">
                <!-- Primary Green -->
                <div>
                    <div class="mb-3 rounded-xl w-full h-20" style="background-color: #2F4F2F;"></div>
                    <div class="bg-primary mb-3 rounded-xl w-full h-20"></div>
                    <div class="mb-4 rounded-xl w-full h-20" style="background-color: #7CA982;"></div>
                    <h3 class="mb-2 font-bold text-gray-800 text-xl">Forest Green (Main accent)</h3>
                    <p class="text-gray-600 text-sm">#2F4F2F — #4B7447 — #7CA982</p>
                </div>

                <!-- Soft Green -->
                <div>
                    <div class="mb-3 rounded-xl w-full h-20" style="background-color: #A3C1A1;"></div>
                    <div class="bg-secondary mb-3 rounded-xl w-full h-20"></div>
                    <div class="mb-4 rounded-xl w-full h-20" style="background-color: #CDE3C1;"></div>
                    <h3 class="mb-2 font-bold text-gray-800 text-xl">Soft Green (Secondary)</h3>
                    <p class="text-gray-600 text-sm">#A3C1A1 — #7CA982 — #CDE3C1</p>
                </div>

                <!-- Terracotta Accent -->
                <div>
                    <div class="mb-3 rounded-xl w-full h-20" style="background-color: #C18F6A;"></div>
                    <div class="bg-accent mb-3 rounded-xl w-full h-20"></div>
                    <div class="mb-4 rounded-xl w-full h-20" style="background-color: #E5C4A1;"></div>
                    <h3 class="mb-2 font-bold text-gray-800 text-xl">Terracotta (Highlight)</h3>
                    <p class="text-gray-600 text-sm">#C18F6A — #D4A373 — #E5C4A1</p>
                </div>

                <!-- Light Cream -->
                <div>
                    <div class="mb-3 rounded-xl w-full h-20" style="background-color: #F0ECE3;"></div>
                    <div class="bg-light mb-3 rounded-xl w-full h-20"></div>
                    <div class="mb-4 rounded-xl w-full h-20" style="background-color: #FAFDF7;"></div>
                    <h3 class="mb-2 font-bold text-gray-800 text-xl">Cream (Background)</h3>
                    <p class="text-gray-600 text-sm">#F0ECE3 — #F4F1DE — #FAFDF7</p>
                </div>
            </div>
        </section>

        <!-- TYPOGRAPHY, BUTTONS, CARDS, LOGOS remain unchanged -->
        <!-- Buttons -->
        <section class="mb-16">
            <h2 class="mb-8 font-bold text-gray-800 text-3xl">Button Set</h2>
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
    <?= view('components/footer') ?>

</footer>
</body>
</html>