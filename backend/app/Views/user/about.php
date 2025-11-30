<!DOCTYPE html>
<html lang="en">

<?= view('components/head') ?>

<body class="relative bg-white/70 min-h-screen">

    <!-- Decorative Top Bar -->
    <div class="bg-accent h-3"></div>

    <!-- HEADER -->
    <?= view('components/header', ['active' => 'About']) ?>

    <?= view('components/about/story') ?>

    <!-- CONTENT WRAPPER -->
    <main class="z-10 relative mx-auto mt-12 px-6 max-w-5xl">

        <div class="px-6 md:px-20 lg:px-32 py-20">

        <?= view('components/about/timeline') ?>

        <?= view('components/about/gallery') ?>
        
        <?= view('components/about/team') ?>


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
             <script src="components/about/about.js" defer></script>


        </div>

    </main>

    <!-- FOOTER -->
    <?= view('components/footer') ?>

</body>

</html>
