<!DOCTYPE html>
<html lang="en">

<?= view('components/head') ?>

<body class="bg-primary text-gray-900">

    <!-- Decorative Top Bar -->
    <div class="bg-accent h-3"></div>

    <!-- Header -->
    <?= view('components/header', ['active' => 'Login']) ?>

    <!-- Sign Up Section with Background -->
    <section class="flex justify-center items-center py-20 min-h-screen signup-container">
        <div class="mx-auto px-6 w-full max-w-md signup-content">
            <!-- Sign Up Form -->
            <div class="space-y-8 text-center">
                <h2 class="font-bold text-secondary text-5xl md:text-6xl">Sign Up</h2>

                <!-- Display Flash Messages -->
                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="bg-red-500 bg-opacity-20 border-2 border-red-500 text-red-200 px-4 py-3 rounded-lg text-left">
                        <ul class="list-disc list-inside space-y-1">
                            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="bg-red-500 bg-opacity-20 border-2 border-red-500 text-red-200 px-4 py-3 rounded-lg">
                        <?= esc(session()->getFlashdata('error')) ?>
                    </div>
                <?php endif; ?>

                <form id="signupForm" action="<?= base_url('auth/signup') ?>" method="POST" class="space-y-6">
                    <?= csrf_field() ?>

                    <!-- First Name Input -->
                    <input
                        type="text"
                        name="first_name"
                        id="first_name"
                        placeholder="First Name"
                        value="<?= old('first_name') ?>"
                        required
                        class="bg-transparent placeholder-opacity-70 focus:ring-opacity-50 px-6 py-4 border-2 border-secondary rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary w-full font-light text-secondary text-lg placeholder-secondary">

                    <!-- Middle Name (Optional) -->
                    <input
                        type="text"
                        name="middle_name"
                        id="middle_name"
                        placeholder="Middle Name (Optional)"
                        value="<?= old('middle_name') ?>"
                        class="bg-transparent placeholder-opacity-70 focus:ring-opacity-50 px-6 py-4 border-2 border-secondary rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary w-full font-light text-secondary text-lg placeholder-secondary">

                    <!-- Last Name Input -->
                    <input
                        type="text"
                        name="last_name"
                        id="last_name"
                        placeholder="Last Name"
                        value="<?= old('last_name') ?>"
                        required
                        class="bg-transparent placeholder-opacity-70 focus:ring-opacity-50 px-6 py-4 border-2 border-secondary rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary w-full font-light text-secondary text-lg placeholder-secondary">

                    <!-- Email Input -->
                    <input
                        type="email"
                        name="email"
                        id="email"
                        placeholder="Email"
                        value="<?= old('email') ?>"
                        required
                        class="bg-transparent placeholder-opacity-70 focus:ring-opacity-50 px-6 py-4 border-2 border-secondary rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary w-full font-light text-secondary text-lg placeholder-secondary">

                    <!-- Password Input -->
                    <div class="space-y-3">
                        <input
                            type="password"
                            name="password"
                            id="password"
                            placeholder="Password"
                            required
                            class="bg-transparent placeholder-opacity-70 focus:ring-opacity-50 px-6 py-4 border-2 border-secondary rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary w-full font-light text-secondary text-lg placeholder-secondary">
                        
                        <!-- Password Requirements -->
                        <div class="bg-white bg-opacity-10 backdrop-blur-sm px-4 py-3 rounded-lg text-left space-y-2">
                            <div id="req-length" class="flex items-center gap-2 text-secondary text-sm">
                                <span class="indicator">○</span>
                                <span>At least 6 characters</span>
                            </div>
                            <div id="req-capital" class="flex items-center gap-2 text-secondary text-sm">
                                <span class="indicator">○</span>
                                <span>At least 1 capital letter (recommended)</span>
                            </div>
                            <div id="req-number" class="flex items-center gap-2 text-secondary text-sm">
                                <span class="indicator">○</span>
                                <span>At least 1 number (recommended)</span>
                            </div>
                            <div id="req-special" class="flex items-center gap-2 text-secondary text-sm">
                                <span class="indicator">○</span>
                                <span>At least 1 special character (recommended)</span>
                            </div>
                        </div>
                    </div>

                    <!-- Confirm Password Input -->
                    <div class="space-y-2">
                        <input
                            type="password"
                            name="confirm_password"
                            id="confirmPassword"
                            placeholder="Confirm Password"
                            required
                            class="bg-transparent placeholder-opacity-70 focus:ring-opacity-50 px-6 py-4 border-2 border-secondary rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary w-full font-light text-secondary text-lg placeholder-secondary">
                        
                        <!-- Password Match Indicator -->
                        <div id="password-match" class="text-secondary text-sm text-left px-2 hidden">
                            <span class="indicator">○</span>
                            <span class="message"></span>
                        </div>
                    </div>

                    <!-- Login Link -->
                    <p class="font-light text-secondary text-lg">
                        Already have an account?
                        <a href="<?= base_url('login') ?>" class="font-semibold text-secondary hover:text-accent underline transition-colors">
                            Log in
                        </a>
                    </p>

                    <!-- Sign Up Button -->
                    <button
                        type="submit"
                        id="submitBtn"
                        disabled
                        class="bg-secondary hover:bg-primary px-8 py-3 border-2 border-secondary rounded-lg w-auto font-bold text-green text-base tracking-wide transition-all disabled:opacity-50 disabled:cursor-not-allowed">
                        Sign Up
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?= view('components/footer') ?>

    <script>
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirmPassword');
        const submitBtn = document.getElementById('submitBtn');
        const signupForm = document.getElementById('signupForm');

        // Password requirements (adjusted to match backend: min 6 chars)
        const requirements = {
            length: { element: document.getElementById('req-length'), test: (pwd) => pwd.length >= 6 },
            capital: { element: document.getElementById('req-capital'), test: (pwd) => /[A-Z]/.test(pwd) },
            number: { element: document.getElementById('req-number'), test: (pwd) => /[0-9]/.test(pwd) },
            special: { element: document.getElementById('req-special'), test: (pwd) => /[!@#$%^&*]/.test(pwd) }
        };

        const passwordMatchDiv = document.getElementById('password-match');

        function updateRequirement(reqElement, met, isEmpty) {
            const indicator = reqElement.querySelector('.indicator');
            if (isEmpty) {
                indicator.textContent = '○';
                indicator.style.color = '#91ADC8';
                reqElement.style.color = '#91ADC8';
            } else if (met) {
                indicator.textContent = '✓';
                indicator.style.color = '#4ade80';
                reqElement.style.color = '#4ade80';
            } else {
                indicator.textContent = '○';
                indicator.style.color = '#91ADC8';
                reqElement.style.color = '#91ADC8';
            }
        }

        function validatePassword() {
            const pwd = password.value;
            const isEmpty = pwd === '';
            
            // Only length is required (min 6), others are recommended
            const lengthMet = requirements.length.test(pwd);
            updateRequirement(requirements.length.element, lengthMet, isEmpty);
            
            // Update recommended requirements
            updateRequirement(requirements.capital.element, requirements.capital.test(pwd), isEmpty);
            updateRequirement(requirements.number.element, requirements.number.test(pwd), isEmpty);
            updateRequirement(requirements.special.element, requirements.special.test(pwd), isEmpty);

            return lengthMet && !isEmpty;
        }

        function checkPasswordMatch() {
            const pwd = password.value;
            const confirmPwd = confirmPassword.value;

            if (confirmPwd === '') {
                passwordMatchDiv.classList.add('hidden');
                return false;
            }

            passwordMatchDiv.classList.remove('hidden');
            const indicator = passwordMatchDiv.querySelector('.indicator');
            const message = passwordMatchDiv.querySelector('.message');

            if (pwd === confirmPwd) {
                indicator.textContent = '✓';
                indicator.style.color = '#4ade80';
                message.textContent = 'Passwords match';
                message.style.color = '#4ade80';
                return true;
            } else {
                indicator.textContent = '✗';
                indicator.style.color = '#f87171';
                message.textContent = 'Passwords do not match';
                message.style.color = '#f87171';
                return false;
            }
        }

        function updateSubmitButton() {
            const passwordValid = validatePassword();
            const passwordsMatch = checkPasswordMatch();
            const email = document.getElementById('email').value;
            const firstName = document.getElementById('first_name').value;
            const lastName = document.getElementById('last_name').value;

            if (passwordValid && passwordsMatch && email && firstName && lastName) {
                submitBtn.disabled = false;
            } else {
                submitBtn.disabled = true;
            }
        }

        password.addEventListener('input', updateSubmitButton);
        confirmPassword.addEventListener('input', updateSubmitButton);
        document.getElementById('email').addEventListener('input', updateSubmitButton);
        document.getElementById('first_name').addEventListener('input', updateSubmitButton);
        document.getElementById('last_name').addEventListener('input', updateSubmitButton);

        signupForm.addEventListener('submit', function(e) {
            if (!validatePassword() || !checkPasswordMatch()) {
                e.preventDefault();
                alert('Please ensure password is at least 6 characters and passwords match.');
            }
        });
    </script>

</body>

</html>