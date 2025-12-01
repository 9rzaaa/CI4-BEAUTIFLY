<div class="mt-8">
    <h4 class="mb-2 font-bold text-primary-dark text-xl">Select Payment Method</h4>
    <div id="payment-logos" class="gap-3 grid grid-cols-3">
        <?php
        $paymentMethods = [
            ['value' => 'gcash', 'img' => '/assets/img/gcash.png', 'label' => 'GCash (Recommended)', 'selected' => true],
            ['value' => 'paymaya', 'img' => '/assets/img/paymaya.png', 'label' => 'Maya (PayMaya)', 'selected' => false],
            ['value' => 'qrph', 'img' => '/assets/img/qrph.png', 'label' => 'QR Ph', 'selected' => false],
        ];

        foreach ($paymentMethods as $method): ?>
            <label class="payment-logo-option <?= $method['selected'] ? 'selected' : '' ?>" data-value="<?= $method['value'] ?>">
                <input type="radio" name="paymentMethod" value="<?= $method['value'] ?>" <?= $method['selected'] ? 'checked' : '' ?>>
                <img src="<?= $method['img'] ?>" alt="<?= ucfirst($method['value']) ?> Logo">
                <span class="font-semibold text-primary-dark text-xs"><?= $method['label'] ?></span>
            </label>
        <?php endforeach; ?>
    </div>
</div>