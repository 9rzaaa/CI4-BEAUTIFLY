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
                        // Ocean Blue (Main accent) - Dark to Light
                        'ocean': {
                            'dark': '#4A5F8F',
                            'DEFAULT': '#647FBC',
                            'light': '#9BA9CC',
                        },
                        // Sky Blue (Subtle warmth) - Dark to Light
                        'sky': {
                            'dark': '#7092B8',
                            'DEFAULT': '#91ADC8',
                            'light': '#C8D7E8',
                        },
                        // Mint Green (Highlight) - Dark to Light
                        'mint': {
                            'dark': '#8BC4BB',
                            'DEFAULT': '#AED6CF',
                            'light': '#D6EBE7',
                        },
                        // Cream (Background) - Dark to Light
                        'cream': {
                            'dark': '#F5F8C4',
                            'DEFAULT': '#FAFDD6',
                            'light': '#FDFEED',
                        },
                        // Legacy color mappings (for backward compatibility)
                        primary: '#647FBC', // Ocean Blue DEFAULT
                        secondary: '#91ADC8', // Sky Blue DEFAULT
                        accent: '#AED6CF', // Mint Green DEFAULT
                        light: '#FAFDD6', // Cream DEFAULT
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

        /* Custom scrollbar using color system */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #FDFEED;
            /* Cream light */
        }

        ::-webkit-scrollbar-thumb {
            background: #91ADC8;
            /* Sky blue */
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #7092B8;
            /* Sky blue dark */
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