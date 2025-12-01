<?php
$active = 'My Bookings';
?>
<!DOCTYPE html>
<html lang="en">
<?= view('components/head') ?>

<body class="bg-gray-50">
    
    <?php echo view('components/header'); ?>


    <?= view('components/my_booking/main') ?>


    <?= view('components/my_booking/filter') ?>


    <?= view('components/my_booking/container') ?>


    <?php echo view('components/footer'); ?>

     <?= view('components/my_booking/style') ?>

     <?= view('components/my_booking/mybooking') ?>

</body>
</html>
