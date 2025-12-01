<!-- components/cta.php -->
<section class="bg-light py-20 text-center">
    <div class="mx-auto px-6 max-w-4xl">
        <!-- CTA Heading -->
        <h2 class="mb-8 font-bold text-black text-5xl md:text-6xl tracking-tight">
            <?= $heading ?>
        </h2>

        <!-- CTA Subheading -->
        <p class="mb-8 text-gray-800 text-xl">
            <?= $sub ?>
        </p>

        <!-- Map Button -->
        <?= view('components/buttons/button_map', [
            'href' => $map_href ?? '#map',
            'label' => $map_label ?? 'SEE ON MAP'
        ]) ?>

        <!-- Action Buttons: Primary & Secondary -->
        <div class="flex sm:flex-row flex-col justify-center items-center gap-4 mt-8">
            <?= view('components/buttons/button_primary', [
                'href' => $primary['href'],
                'label' => $primary['label']
            ]) ?>

            <?= view('components/buttons/button_secondary', [
                'href' => $secondary['href'],
                'label' => $secondary['label']
            ]) ?>
        </div>
    </div>
</section>