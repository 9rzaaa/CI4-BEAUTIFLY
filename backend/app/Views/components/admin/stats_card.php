<div class="gap-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 mb-8">
    <?php
    $stats = [
        [
            'title' => 'All Earnings',
            'value' => '$12,000',
            'icon' => '💰',
            'color' => 'yellow',
            'subtitle' => '10% increase on profit'
        ],
        [
            'title' => 'Active Bookings',
            'value' => '57',
            'icon' => '📅',
            'color' => 'red',
            'subtitle' => '28% task performance'
        ],
        [
            'title' => 'Total Users',
            'value' => '250+',
            'icon' => '👤',
            'color' => 'green',
            'subtitle' => '10k new registrations'
        ],
        [
            'title' => 'Monthly Growth',
            'value' => '24%',
            'icon' => '📈',
            'color' => 'blue',
            'subtitle' => '1k growth this month'
        ]
    ];

    foreach ($stats as $stat):
    ?>
        <div class="bg-white shadow-sm hover:shadow-md p-6 rounded-xl transition-shadow">
            <div class="flex justify-between mb-4">
                <div>
                    <p class="text-gray-600 text-sm"><?= $stat['title'] ?></p>
                    <h3 class="font-bold text-<?= $stat['color'] ?>-600 text-3xl"><?= $stat['value'] ?></h3>
                </div>
                <div class="bg-<?= $stat['color'] ?>-100 p-3 rounded-full">
                    <?= $stat['icon'] ?>
                </div>
            </div>
            <div class="bg-<?= $stat['color'] ?>-50 p-2 rounded-lg text-<?= $stat['color'] ?>-700 text-sm">
                <?= $stat['subtitle'] ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>