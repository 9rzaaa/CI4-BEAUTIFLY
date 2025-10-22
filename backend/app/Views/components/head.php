<!-- head.php -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'EASY&CO - Luxury Condo Accommodation') ?></title>
    <meta name="description" content="<?= esc($description ?? 'Experience luxury living at EASY&CO. Modern condo accommodation in the heart of the city.') ?>">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

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

    <!-- Global JavaScript for Loading & Features -->
    <script src="/assets/js/global.js" defer></script>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/assets/logo/favicon.png">

    <!-- Preconnect to CDNs -->
    <link rel="preconnect" href="https://cdn.tailwindcss.com">

    <style>
        body,
        p,
        a,
        li,
        span,
        div {
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

        .login-container {
            background-image: url('/assets/img/loginbg.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
        }

        .login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
        }

        .login-content {
            position: relative;
            z-index: 10;
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

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #91ADC8;
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #5C7996;
        }

        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Animation utilities */
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

        /* Image loading placeholder */
        img {
            transition: opacity 0.3s ease;
        }

        img[data-src] {
            min-height: 200px;
        }
    </style>
</head>