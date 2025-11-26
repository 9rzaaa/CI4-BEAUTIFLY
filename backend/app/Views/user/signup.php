<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - EASY&CO</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#647FBC',
                        secondary: '#91ADC8',
                        accent: '#AED6CF',
                        light: '#FAFDD6',
                    },
                }
            }
        }
    </script>

    <style>
        body,
        p,
        a,
        li,
        span,
        div,
        input,
        button {
            font-family: 'Lato', sans-serif !important;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Playfair Display', serif !important;
        }

        .signup-container {
            background-image: url('/assets/img/signupbg.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
        }

        .signup-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
        }

        .signup-content {
            position: relative;
            z-index: 10;
        }
    </style>
</head>

<body class="bg-primary text-gray-900">

    <!-- Decorative Top Bar -->
    <div class="bg-accent h-3"></div>

    <!-- Header -->
    <header class="bg-primary">
        <div class="flex justify-between items-center mx-auto py-4 pr-6 pl-2 max-w-7xl">
            <!-- Logo Section -->
            <a href="/" class="flex items-center space-x-4">
                <img src="/assets/logo/logo.png" alt="EASY&CO Logo" class="w-auto h-16">
            </a>

            <!-- Navigation -->
            <nav class="hidden md:flex space-x-12">
                <a href="/" class="text-white hover:text-accent text-lg tracking-wide transition-colors">
                    HOME
                </a>
                <a href="/about" class="text-white hover:text-accent text-lg tracking-wide transition-colors">
                    ABOUT US
                </a>
                <a href="/login" class="text-white hover:text-accent text-lg tracking-wide transition-colors">
                    LOGIN
                </a>
            </nav>

            <!-- Mobile Menu Button -->
            <button class="md:hidden text-white">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </header>

    <!-- Sign Up Section with Background -->
    <section class="flex justify-center items-center py-20 min-h-screen signup-container">
        <div class="mx-auto px-6 w-full max-w-md signup-content">
            <!-- Sign Up Form -->
            <div class="space-y-8 text-center">
                <h2 class="font-bold text-secondary text-5xl md:text-6xl">Sign Up</h2>

                <form id="signupForm" action="process_signup.php" method="POST" class="space-y-6">
                    <!-- Email Input -->
                    <input
                        type="email"
                        name="email"
                        id="email"
                        placeholder="Email"
                        required
                        class="bg-transparent placeholder-opacity-70 focus:ring-opacity-50 px-6 py-4 border-2 border-secondary rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary w-full font-light text-secondary text-lg placeholder-secondary">

                    <!-- Username Input -->
                    <input
                        type="text"
                        name="username"
                        id="username"
                        placeholder="Username"
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
                                <span>At least 8 characters</span>
                            </div>
                            <div id="req-capital" class="flex items-center gap-2 text-secondary text-sm">
                                <span class="indicator">○</span>
                                <span>At least 1 capital letter</span>
                            </div>
                            <div id="req-number" class="flex items-center gap-2 text-secondary text-sm">
                                <span class="indicator">○</span>
                                <span>At least 1 number</span>
                            </div>
                            <div id="req-special" class="flex items-center gap-2 text-secondary text-sm">
                                <span class="indicator">○</span>
                                <span>At least 1 special character (!@#$%^&*)</span>
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
                        <a href="login.php" class="font-semibold text-secondary hover:text-accent underline transition-colors">
                            Log in
                        </a>
                    </p>

                    <!-- Sign Up Button -->
                    <button
                        type="submit"
                        id="submitBtn"
                        disabled
                        class="bg-secondary hover:bg-primary px-8 py-3 border-2 border-secondary rounded-lg w-auto font-bold text-white text-base tracking-wide transition-all disabled:opacity-50 disabled:cursor-not-allowed">
                        Sign Up
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-light py-16 text-gray-600">
        <div class="mx-auto px-6 max-w-7xl">
            <!-- Social Media Icons -->
            <div class="flex justify-center items-center gap-6 mb-12">
                <a href="https://facebook.com/easyco_condo" target="_blank" class="hover:opacity-70 transition-opacity">
                    <svg class="w-12 h-12 text-[#C8A998]" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                    </svg>
                </a>
                <a href="https://instagram.com/easyco_condo" target="_blank" class="hover:opacity-70 transition-opacity">
                    <svg class="w-12 h-12 text-[#C8A998]" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                    </svg>
                </a>
            </div>

            <!-- Footer Links -->
            <div class="flex sm:flex-row flex-col justify-center items-center gap-8 mb-12 text-center">
                <a href="#covid-policy" class="font-semibold text-gray-800 hover:text-primary text-sm tracking-widest transition-colors">
                    COVID-19 POLICY
                </a>
                <a href="#terms" class="font-semibold text-gray-800 hover:text-primary text-sm tracking-widest transition-colors">
                    TERMS & CONDITIONS
                </a>
                <a href="#privacy" class="font-semibold text-gray-800 hover:text-primary text-sm tracking-widest transition-colors">
                    PRIVACY POLICY
                </a>
                <a href="#contact" class="font-semibold text-gray-800 hover:text-primary text-sm tracking-widest transition-colors">
                    CONTACT
                </a>
            </div>

            <!-- Copyright -->
            <div class="space-y-2 text-center">
                <p class="text-gray-500 text-sm tracking-wide">
                    COPYRIGHT 2025 EASY&CO. ALL RIGHTS RESERVED.
                </p>
                <p class="text-gray-500 text-xs tracking-wide">
                    WEBSITE BY DANIEL LING
                </p>
            </div>

            <!-- Acknowledgment -->
            <div class="mx-auto mt-12 max-w-5xl text-center">
                <p class="text-gray-400 text-xs leading-relaxed tracking-wide">
                    WE ACKNOWLEDGE THAT EASY&CO IS LOCATED IN METRO MANILA. WE PAY OUR RESPECTS TO THE LOCAL COMMUNITY AND THEIR ELDERS, PAST, PRESENT AND EMERGING.
                </p>
            </div>
        </div>
    </footer>

    <script>
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirmPassword');
        const submitBtn = document.getElementById('submitBtn');
        const signupForm = document.getElementById('signupForm');

        // Password requirements
        const requirements = {
            length: { element: document.getElementById('req-length'), test: (pwd) => pwd.length >= 8 },
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
                indicator.textContent = '✗';
                indicator.style.color = '#f87171';
                reqElement.style.color = '#91ADC8';
            }
        }

        function validatePassword() {
            const pwd = password.value;
            const isEmpty = pwd === '';
            let allMet = true;

            for (const key in requirements) {
                const req = requirements[key];
                const met = req.test(pwd);
                updateRequirement(req.element, met, isEmpty);
                if (!met) allMet = false;
            }

            return allMet && !isEmpty;
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
            const username = document.getElementById('username').value;

            if (passwordValid && passwordsMatch && email && username) {
                submitBtn.disabled = false;
            } else {
                submitBtn.disabled = true;
            }
        }

        password.addEventListener('input', updateSubmitButton);
        confirmPassword.addEventListener('input', updateSubmitButton);
        document.getElementById('email').addEventListener('input', updateSubmitButton);
        document.getElementById('username').addEventListener('input', updateSubmitButton);

        signupForm.addEventListener('submit', function(e) {
            if (!validatePassword() || !checkPasswordMatch()) {
                e.preventDefault();
                alert('Please meet all password requirements and ensure passwords match.');
            }
        });
    </script>

</body>

</html>