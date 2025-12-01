<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'EASY&CO - Luxury Condo Accommodation') ?></title>
    <meta name="description" content="<?= esc($description ?? 'Experience luxury living at EASY&CO. Modern condo accommodation in the heart of the city.') ?>">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">

    <!-- Tailwind Extended Config (merged both color systems) -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'ocean': {
                            'dark': '#4A5F8F',
                            'DEFAULT': '#647FBC',
                            'light': '#9BA9CC',
                        },
                        'sky': {
                            'dark': '#7092B8',
                            'DEFAULT': '#91ADC8',
                            'light': '#C8D7E8',
                        },
                        'mint': {
                            'dark': '#8BC4BB',
                            'DEFAULT': '#AED6CF',
                            'light': '#D6EBE7',
                        },
                        'cream': {
                            'dark': '#F5F8C4',
                            'DEFAULT': '#FAFDD6',
                            'light': '#FDFEED',
                        },

                        /* Current Color System (active design) */
                        primary: '#4B7447',
                        secondary: '#ffffffff',
                        accent: '#D4A373',
                        light: '#F4F1DE',

                        /* Backward Compatibility Colors */
                        legacy_primary: '#647FBC',
                        legacy_secondary: '#91ADC8',
                        legacy_accent: '#AED6CF',
                        legacy_light: '#FAFDD6'
                    },
                }
            }
        }
    </script>

    <!-- Global JavaScript -->
    <script src="/assets/js/global.js" defer></script>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/assets/logo/favicon.png">

    <style>
        /* Global Fonts */
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

        /* Background Image for General Pages */
        body {
            background-image: url('/assets/img/bookingbg.jpg');
            background-size: 205%;
            background-position: center;
            background-attachment: scroll;
        }

        /* Login/Signup Backgrounds */
        .login-container,
        .signup-container {
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
        }

        .login-container {
            background-image: url('/assets/img/booking.webp');
        }

        .signup-container {
            background-image: url('/assets/img/booking.webp');
        }

        .login-container::before,
        .signup-container::before {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
        }

        .login-content,
        .signup-content {
            position: relative;
            z-index: 10;
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #F4F1DE;
        }

        ::-webkit-scrollbar-thumb {
            background: #4B7447;
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #3F613C;
        }

        /* Smooth Scroll */
        html {
            scroll-behavior: smooth;
        }

        /* Fade-in Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.6s ease-out;
        }

        /* Image Loading */
        img {
            transition: opacity 0.3s ease;
        }

        img[data-src] {
            min-height: 200px;
        }

        /* Custom styling for booked dates */
        .flatpickr-day.booked-date {
            background-color: #4B7447 !important;
            color: #7CA982 !important;
            cursor: not-allowed !important;
            text-decoration: line-through;
        }

        .flatpickr-day.booked-date:hover {
            background-color: #A3C1A1 !important;
        }

        /* Styles for booking review */
        .bg-accent {
            background-color: #73AF6F;
        }

        .text-accent {
            color: #73AF6F;
        }

        .bg-primary-dark {
            background-color: #2F5233;
        }

        .bg-secondary-light {
            background-color: #F8F4E3;
        }

        .payment-logo-option {
            width: 100%;
            height: 100px;
            padding: 10px;
            border: 2px solid #E0DBCF;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            justify-content: center;
            align-items: center;
            background: white;
            flex-direction: column;
            text-align: center;
        }

        .payment-logo-option:hover {
            border-color: #73AF6F;
        }

        .payment-logo-option.selected {
            border-color: #2F5233;
            box-shadow: 0 0 0 3px rgba(47, 82, 51, 0.4);
        }

        .payment-logo-option img {
            width: 80%;
            max-height: 40px;
            object-fit: contain;
            margin-bottom: 4px;
        }

        .payment-logo-option input[type="radio"] {
            display: none;
        }

        .btn-pulse:hover {
            animation: pulse-shadow 1.5s infinite;
        }

        @keyframes pulse-shadow {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(115, 175, 111, 0.7);
            }

            50% {
                box-shadow: 0 0 0 15px rgba(115, 175, 111, 0);
            }
        }
    </style>
</head>