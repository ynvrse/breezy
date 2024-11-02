<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 Forbidden</title>
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
            background-color: #f8f9fc;
            color: #333;
        }

        .container {
            text-align: center;
            padding: 20px;
        }

        .error-code {
            font-size: 8rem;
            font-weight: 600;
            color: #f0a500;
            animation: fadeIn 1s ease-in;
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
            background-color: #f0a500;
            border-radius: 25px;
            text-decoration: none;
            font-size: 1rem;
            font-weight: 600;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #d08b00;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 600px) {
            .error-code {
                font-size: 5rem;
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
        <div class="error-code">403</div>
        <p class="message">Access Denied</p>
        <p class="description">You do not have permission to view this page.</p>
        <a href="/auth/login" class="back-button">Go Login</a>
    </div>

</body>

</html>