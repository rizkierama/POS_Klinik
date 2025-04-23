<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Inventory POS Klinik Azizi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to right, #4facfe, #00f2fe);
            color: #ffffff;
        }
        .container {
            text-align: center;
            background: rgba(0, 0, 0, 0.6);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }
        h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }
        p {
            font-size: 1.2rem;
            margin-bottom: 30px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 1rem;
            color: #ffffff;
            background: #00c6ff;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s ease;
        }
        .btn:hover {
            background: #005bea;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="" alt="">
        <h1>Web Inventory POS Klinik Azizi</h1>
        <p>Selamat datang di sistem manajemen inventori klinik. Login untuk melanjutkan.</p>
        <a href="{{ route('login') }}" class="btn">Login</a>
    </div>
</body>
</html>
