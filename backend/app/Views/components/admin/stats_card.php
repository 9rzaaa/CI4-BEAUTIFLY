<div class="gap-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 mb-8">
    <?php foreach ($stats as $stat): ?>
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
                <div class="bg-[var(--garden-green)] bg-opacity-20 p-3 rounded-full text-[var(--garden-dark)]">
                    <?= $stat['icon'] ?>
                </div>
            </div>

            <!-- Subtitle Banner with Trend Indicator -->
            <div class="flex justify-between items-center bg-[var(--garden-green)] bg-opacity-10 p-2 rounded-lg text-[var(--garden-dark)] text-sm">
                <span><?= $stat['subtitle'] ?></span>

                <?php if (isset($stat['trend']) && $stat['trend'] !== 'neutral'): ?>
                    <span class="ml-2">
                        <?php if ($stat['trend'] === 'up'): ?>
                            <svg class="inline w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        <?php else: ?>
                            <svg class="inline w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        <?php endif; ?>
                    </span>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>