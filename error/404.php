<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Page Not Found</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Nunito', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #f4f6f8;
            color: #333;
        }

        .container {
            text-align: center;
            padding: 20px;
        }

        .error-code {
            font-size: 10rem;
            font-weight: 600;
            color: #ff6b6b;
            animation: pop 1s ease;
        }

        .message {
            font-size: 1.5rem;
            color: #888;
            margin-bottom: 20px;
        }

        .description {
            font-size: 1.2rem;
            color: #555;
            margin-bottom: 40px;
        }

        .back-button {
            display: inline-block;
            padding: 10px 25px;
            color: white;
            background-color: #ff6b6b;
            border-radius: 25px;
            text-decoration: none;
            font-size: 1rem;
            font-weight: 600;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #ff4949;
        }

        @keyframes pop {
            0% {
                transform: scale(0.5);
                opacity: 0;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        @media (max-width: 600px) {
            .error-code {
                font-size: 6rem;
            }

            .message,
            .description {
                font-size: 1rem;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="error-code">404</div>
        <p class="message">Oops! Page Not Found</p>
        <p class="description">The page you are looking for might have been removed, had its name changed, or is
            temporarily unavailable.</p>
        <a href="<?= isAuth() ? '/dashboard' : '/home' ?>" class="back-button">Go Back Home</a>
    </div>

</body>

</html>