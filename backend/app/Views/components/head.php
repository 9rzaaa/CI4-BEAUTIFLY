<!-- head.php -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EASY&CO - Luxury Condo Accommodation</title>

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
    </style>
</head>