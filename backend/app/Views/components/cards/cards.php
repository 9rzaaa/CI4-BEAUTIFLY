<!-- cards.php -->
<?php
$cards = [
    [
        'title' => 'AMENITIES',
        'text' => 'Experience modern living with high-speed WiFi, smart TV, air conditioning, and a fully equipped kitchen. Everything you need for a comfortable stay.',
        'link' => '#amenities',
        'link_text' => 'VIEW AMENITIES'
    ],
    [
        'title' => 'GALLERY',
        'text' => 'Every corner of the condo has been designed with your comfort and relaxation in mind. View our collection of images to discover more.',
        'link' => '#gallery',
        'link_text' => 'SEE PHOTOS'
    ],
    [
        'title' => 'SPECIAL DEALS',
        'text' => 'Exciting offers are coming soon! Follow us on social media or check back here for the latest updates and promotions.',
        'link' => '#pricing',
        'link_text' => 'SEE PRICING'
    ],
];
?>

<section class="bg-light py-20">
    <div class="mx-auto px-6 max-w-7xl">
        <div class="gap-8 grid md:grid-cols-3">
            <?php foreach ($cards as $card): ?>
                <?php
                // Make the variables available for the partial
                $title = $card['title'];
                $text = $card['text'];
                $link = $card['link'];
                $link_text = $card['link_text'];

                include 'card-item.php';
                ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>