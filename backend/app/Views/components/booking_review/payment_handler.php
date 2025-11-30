<script>
    // QR Modal Generator
    function showQRModal(paymentMethod) {
        return new Promise((resolve, reject) => {
            const modalHTML = `
                <div id="qrModal" class="z-50 fixed inset-0 flex justify-center items-center bg-black bg-opacity-70" style="animation: fadeIn 0.3s;">
                    <div class="relative bg-white mx-4 p-8 rounded-2xl w-full max-w-md text-center" style="animation: slideUp 0.3s;">
                        <button id="closeQrModal" class="top-4 right-4 absolute font-bold text-gray-400 hover:text-gray-700 text-3xl leading-none transition-colors" title="Cancel Payment">&times;</button>
                        
                        <h3 class="mb-4 font-bold text-2xl" style="color: #2F5233;">Scan to Pay</h3>
                        <p class="mb-6 text-gray-600">Scan this QR code using your ${getPaymentLabel(paymentMethod)} app</p>
                       
                        <div class="bg-gray-100 mb-6 p-6 rounded-xl">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=DUMMY_${paymentMethod.toUpperCase()}_PAYMENT"
                                 alt="QR Code" class="mx-auto w-64 h-64">
                        </div>
                       
                        <div class="mb-4">
                            <div class="inline-flex justify-center items-center mb-2 rounded-full w-20 h-20 font-bold text-white text-2xl" style="background-color: #73AF6F;">
                                <span id="qrTimer">40</span>
                            </div>
                            <p class="text-gray-500 text-sm">Seconds remaining</p>
                        </div>
                       
                        <button id="qrDoneButton" 
                            class="bg-accent hover:bg-accent/90 shadow-lg px-8 py-3 rounded-lg w-full font-bold text-white text-lg hover:scale-105 transition-all"
                            style="background-color: #73AF6F;">
                            I've Completed Payment
                        </button>
                       
                        <p class="mt-4 text-gray-400 text-xs">Payment will auto-verify in <span id="qrTimer2">40</span>s</p>
                    </div>
                </div>
                <style>
                    @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
                    @keyframes slideUp { from { transform: translateY(50px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
                </style>
            `;

            document.body.insertAdjacentHTML('beforeend', modalHTML);

            let timeLeft = 40;
            const countdown = setInterval(() => {
                timeLeft--;
                document.getElementById('qrTimer').textContent = timeLeft;
                document.getElementById('qrTimer2').textContent = timeLeft;

                if (timeLeft <= 0) {
                    clearInterval(countdown);
                    document.getElementById('qrModal').remove();
                    resolve(true);
                }
            }, 1000);

            document.getElementById('closeQrModal').addEventListener('click', () => {
                clearInterval(countdown);
                document.getElementById('qrModal').remove();
                reject(new Error('Payment cancelled by user'));
            });

            document.getElementById('qrDoneButton').addEventListener('click', () => {
                clearInterval(countdown);
                document.getElementById('qrModal').remove();
                resolve(true);
            });
        });
    }

    function getPaymentLabel(method) {
        const labels = {
            gcash: 'GCash',
            paymaya: 'Maya',
            qrph: 'QR Ph'
        };
        return labels[method] || method;
    }

    // Main payment handler
    document.getElementById('proceedToPayment').addEventListener('click', async (e) => {
        const btn = e.currentTarget;
        const selectedPayment = document.querySelector('input[name="paymentMethod"]:checked');

        if (!selectedPayment) {
            alert('Please select a payment method.');
            return;
        }

        const paymentMethod = selectedPayment.value;
        const specialRequests = document.getElementById('specialRequests')?.value.trim() || null;

        const submissionData = {
            check_in: bookingData.checkIn,
            check_out: bookingData.checkOut,
            adults: bookingData.adults,
            kids: bookingData.kids,
            transaction_id: bookingData.transactionId,
            total_amount: parseFloat(bookingData.totalPrice.replace(/,/g, '')),
            payment_method: paymentMethod,
            special_requests: specialRequests
        };

        btn.disabled = true;
        btn.textContent = 'Processing...';

        try {
            const paymentConfirmed = await showQRModal(paymentMethod);

            if (!paymentConfirmed) {
                throw new Error('Payment was not confirmed');
            }

            btn.textContent = 'Creating Booking...';
            const bookingResponse = await fetch('/booking/create', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(submissionData)
            });

            const bookingResult = await bookingResponse.json();
            if (!bookingResponse.ok || !bookingResult.success) {
                throw new Error(bookingResult.error || 'Booking creation failed');
            }

            btn.textContent = 'Processing Payment...';
            const paymentResponse = await fetch('/payment/process', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    booking_id: bookingResult.booking_id,
                    payment_method: paymentMethod
                })
            });

            const paymentResult = await paymentResponse.json();
            if (!paymentResponse.ok || !paymentResult.success) {
                throw new Error(paymentResult.error || 'Payment processing failed');
            }

            window.location.href = `/booking/success?id=${bookingResult.booking_id}&transaction_id=${paymentResult.transaction_id}&total=${paymentResult.amount}`;

        } catch (error) {
            console.error('Error:', error);

            if (error.message !== 'Payment cancelled by user') {
                alert(`Error: ${error.message}\n\nPlease try again or contact support.`);
            }

            btn.disabled = false;
            btn.textContent = 'Proceed to Payment';
        }
    });
</script>