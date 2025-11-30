statscard

<div class="gap-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 mb-8">
    <?php
    $stats = [
        [
            'title' => 'All Earnings',
            'value' => '$12,000',
            'icon' => '💰',
            'subtitle' => '10% increase on profit'
        ],
        [
            'title' => 'Active Bookings',
            'value' => '57',
            'icon' => '📅',
            'subtitle' => '28% task performance'
        ],
        [
            'title' => 'Total Users',
            'value' => '250+',
            'icon' => '👤',
            'subtitle' => '10k new registrations'
        ],
        [
            'title' => 'Monthly Growth',
            'value' => '24%',
            'icon' => '📈',
            'subtitle' => '1k growth this month'
        ]
    ];

    foreach ($stats as $stat):
    ?>
        <div class="bg-white shadow-sm hover:shadow-md p-6 rounded-xl transition-shadow">
            <div class="flex justify-between mb-4">

                <div>
                    <p class="text-[var(--garden-brown)] text-sm"><?= $stat['title'] ?></p>

                    <!-- Value -->
                    <h3 class="font-bold text-[var(--garden-green)] text-3xl">
                        <?= $stat['value'] ?>
                    </h3>
                </div>

                <!-- Icon Container -->
                <div class="p-3 rounded-full bg-[var(--garden-green)] bg-opacity-20 text-[var(--garden-dark)]">
                    <?= $stat['icon'] ?>
                </div>
            </div>

            <!-- Subtitle Banner -->
            <div class="p-2 rounded-lg bg-[var(--garden-green)] bg-opacity-10 text-[var(--garden-dark)] text-sm">
                <?= $stat['subtitle'] ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>

