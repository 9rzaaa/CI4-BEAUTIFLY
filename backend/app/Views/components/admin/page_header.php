<div class="flex justify-between items-center mb-8">
    <div>
        <h1 class="mb-2 font-bold text-green-900 text-3xl">
            <?= esc($title) ?>
        </h1>
        <p class="text-green-700"><?= esc($description) ?></p>
    </div>

    <?php if (isset($buttonText)): ?>
        <button
            onclick="<?= esc($buttonAction ?? '') ?>"
            class="flex items-center gap-2 bg-primary hover:bg-lime-700 shadow-lg px-6 py-3 rounded-lg font-semibold text-white transition-colors duration-200">
            <svg
                class="w-5 h-5"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 4v16m8-8H4" />
            </svg>
            <?= esc($buttonText) ?>
        </button>
    <?php endif; ?>
</div>