            <div class="space-y-8 w-full">
                <div>
                    <h4 class="mb-3 font-bold text-primary-dark text-xl">Reservation Summary</h4>
                    <div class="space-y-4 bg-secondary-light shadow-inner p-5 border rounded-lg">
                        <div class="flex justify-between pb-2 border-b">
                            <span class="font-semibold">Transaction ID:</span>
                            <span id="modalTransactionId" class="font-bold text-red-500"></span>
                        </div>
                        <div class="flex justify-between pb-2 border-b">
                            <span class="font-semibold">Check-in Date:</span>
                            <span id="modalCheckIn" class="font-bold text-primary-dark"></span>
                        </div>
                        <div class="flex justify-between pb-2 border-b">
                            <span class="font-semibold">Check-out Date:</span>
                            <span id="modalCheckOut" class="font-bold text-primary-dark"></span>
                        </div>
                        <div class="flex justify-between pb-2 border-b">
                            <span class="font-semibold">Nights:</span>
                            <span id="modalNights" class="font-bold text-primary-dark"></span>
                        </div>
                        <div class="flex justify-between pb-2 border-b">
                            <span class="font-semibold">Guests:</span>
                            <span id="modalGuests" class="font-bold text-primary-dark"></span>
                        </div>
                        <div class="flex justify-between pb-2 border-b">
                            <span class="font-semibold">Price per night:</span>
                            <span class="font-extrabold text-green-700 text-lg">₱<span id="modalPricePerNight"></span></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-semibold">Cleaning Fee:</span>
                            <span class="font-extrabold text-green-700 text-lg">₱<span id="modalCleaningFee"></span></span>
                        </div>
                    </div>
                </div>

                <div class="flex justify-between bg-primary-dark shadow-xl mt-4 p-5 rounded-lg text-white">
                    <span class="font-bold text-xl">Total Payable:</span>
                    <span class="font-extrabold text-3xl">₱<span id="modalTotalPrice"></span></span>
                </div>