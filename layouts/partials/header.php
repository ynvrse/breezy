<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Haloo</title>

    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="/assets/lucide-icons.min.js"></script>


    <style>
        /* Custom styles for file input */
        .file-input-container {
            position: relative;
            display: flex;
            align-items: center;
            border: 2px dashed #0d6efd;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .file-input-container:hover {
            background-color: #f0f8ff;
        }

        .file-input-container input[type="file"] {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .file-icon {
            font-size: 2rem;
            margin-right: 2rem;
            color: #0d6efd;
        }
    </style>
</head>

<body class="bg-box">