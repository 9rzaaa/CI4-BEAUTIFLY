<?= view('components/head') ?>
<?= view('components/header') ?>

<?= view('components/booking_review/container') ?>
    <?= view('components/booking_review/body') ?>
            <div class="gap-10 grid grid-cols-1 lg:grid-cols-2">

    <div><?= view('components/booking_review/summary') ?></div>
        <div><?= view('components/booking_review/req') ?></div>

        <?= view('components/booking_review/policies') ?>
        <?= view('components/booking_review/payment') ?>
    </div>
</div>
<?= view('components/booking_review/button') ?>
<?= view('components/footer') ?>
<?= view('components/booking_review/bookingrev') ?>

