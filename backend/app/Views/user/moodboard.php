<!DOCTYPE html>
<html lang="en">

<?= view('components/head') ?>

<body class="bg-gray-50">

    <!-- Decorative Top Bar -->
    <div class="bg-accent h-3"></div>

    <!-- Header -->
    <?= view('components/header') ?>

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
    <?= view('components/footer') ?>

</body>

</html>