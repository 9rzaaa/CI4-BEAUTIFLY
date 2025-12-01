<!DOCTYPE html>
<html lang="en">

<?= view('components/head') ?>


<body class="bg-light bg-opacity-80">

    <!-- Decorative Top Bar -->
    <div class="bg-accent h-3"></div>

    <!-- Header -->
    <?= view('components/header') ?>

        <!-- COLOR SYSTEM SECTION -->
    <?= view('components/moodboard/main') ?>


        <!-- TYPOGRAPHY, BUTTONS, CARDS, LOGOS remain unchanged -->
        <!-- Buttons -->
    <?= view('components/moodboard/buttons') ?>


        <!-- CARD SET SECTION (Wider Rectangular) -->
    <?= view('components/moodboard/card') ?>


        <!-- LOGOS SECTION -->
    <?= view('components/moodboard/logos') ?>


    </main>

    <!-- Footer -->
    <?= view('components/footer') ?>

</footer>
</body>
</html>