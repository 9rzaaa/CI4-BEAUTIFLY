<!-- SUCCESS / ERROR MESSAGE -->
<?php if(session()->getFlashdata('success')): ?>
    <div class="p-3 mb-4 bg-green-100 text-green-800 rounded">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<?php if(session()->getFlashdata('error')): ?>
    <div class="p-3 mb-4 bg-red-100 text-red-800 rounded">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>
