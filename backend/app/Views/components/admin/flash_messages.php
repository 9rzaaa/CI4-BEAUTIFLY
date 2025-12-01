<?php if (session()->getFlashdata('errors')): ?>
    <div class="bg-red-100 mb-6 p-4 border-red-700 border-l-4 rounded-lg">
        <?php foreach (session()->getFlashdata('errors') as $error): ?>
            <p class="text-red-700"><?= esc($error) ?></p>
        <?php endforeach ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="bg-lime-50 mb-6 p-4 border-lime-600 border-l-4 rounded-lg">
        <p class="font-medium text-lime-700"><?= esc(session()->getFlashdata('success')) ?></p>
    </div>
<?php endif; ?>