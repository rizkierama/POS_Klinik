<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Inventory POS Klinik Azizi</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #00c6ff, #0072ff);
            overflow: hidden;
            color: #ffffff;
        }
        .container {
            text-align: center;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 50px;
            border-radius: 15px;
            box-shadow: 0px 8px 32px 0px rgba(31, 38, 135, 0.37);
            width: 90%;
            max-width: 400px;
            animation: fadeIn 1s ease-out;
        }
        h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            font-weight: 600;
        }
        p {
            font-size: 1.1rem;
            margin-bottom: 30px;
            color: #e0e0e0;
        }
        .btn {
            display: inline-block;
            padding: 12px 25px;
            font-size: 1rem;
            color: #ffffff;
            background: #0072ff;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: bold;
        }
        .btn:hover {
            background: #00c6ff;
            transform: scale(1.05);
        }
        img {
            width: 80px;
            margin-bottom: 20px;
            animation: float 3s ease-in-out infinite;
        }
        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(-20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <img src="{{ asset('images/logo.png') }}" alt="Logo Klinik Azizi">
        <h1>Web Inventory POS</h1>
        <p>Selamat datang di sistem manajemen inventori Klinik Azizi.<br>Silakan login untuk melanjutkan.</p>
        <a href="{{ route('login') }}" class="btn">Login</a>
    </div>
</body>
</html>
