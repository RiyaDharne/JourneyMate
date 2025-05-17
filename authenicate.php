<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authenticate User - JourneyMate</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            text-align: center;
        }

        /* Header */
        .header {
            background: linear-gradient(to right, #ff5733, #ff914d);
            color: white;
            padding: 15px;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            position: relative;
            width: 100%;
        }
        .header i {
            position: absolute;
            left: 15px;
            top: 15px;
            font-size: 20px;
            cursor: pointer;
        }

        /* Authentication Box */
        .auth-container {
            max-width: 95%;
            background: white;
            margin: 20px auto;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }

        .auth-message {
            font-size: 16px;
            color: green;
            margin-bottom: 15px;
        }

        /* Reverify Button */
        .reverify-btn {
            background: #e63946;
            color: white;
            padding: 15px;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
        }
        .reverify-btn:hover {
            background: #d62828;
        }

        /* Advertisement */
        .ad-banner {
            margin-top: 20px;
            text-align: center;
        }
        .ad-banner img {
            width: 100%;
            max-width: 350px;
            border-radius: 5px;
            display: block;
            margin: 0 auto;
        }

        /* Bottom Navigation */
        .footer-nav {
            display: flex;
            justify-content: space-around;
            background: white;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
            border-top: 1px solid #ddd;
        }
        .nav-btn {
            text-align: center;
            flex: 1;
            font-size: 14px;
            color: gray;
            background: none;
            border: none;
            padding: 10px 0;
            cursor: pointer;
        }
        .nav-btn i {
            display: block;
            font-size: 18px;
            margin-bottom: 2px;
        }
        .nav-btn.active {
            color: #ff5733;
        }

    </style>
</head>
<body>

    <!-- Header -->
    <div class="header">
        <i class="fas fa-arrow-left" onclick="goBack()"></i>
        AUTHENTICATE USER
    </div>

    <!-- Authentication Message -->
    <div class="auth-container">
        <div class="auth-message">
            Your profile details are successfully authenticated with Aadhaar.
        </div>

        <!-- Reverify Aadhaar Button -->
        <button class="reverify-btn" onclick="alert('Reverify Aadhaar process initiated!')">
            REVERIFY YOUR AADHAAR
        </button>

        <!-- Advertisement -->
        <div class="ad-banner">
            <img src="C:\xampp\htdocs\JourneyMate-new (2)\JourneyMate-new\JourneyMate\JourneyMate\ad banner.jpeg" alt="Ad Banner">
        </div>
    </div>

    <!-- Bottom Navigation -->
    <div class="footer-nav">
        <button class="nav-btn" onclick="navigate('index.php')">
            <i class="fas fa-home"></i>
            <span>Home</span>
        </button>
        <button class="nav-btn active" onclick="navigate('myaccount.php')">
            <i class="fas fa-user"></i>
            <span>Account</span>
        </button>
        <button class="nav-btn">
            <i class="fas fa-shopping-cart"></i>
            <span><a href="https://www.amazon.in/">Shop</a></span>
        </button>
        <button class="nav-btn" onclick="navigate('transaction.php')">
            <i class="fas fa-money-check-alt"></i>
            <span>Transaction</span>
        </button>
        <button class="nav-btn" onclick="navigate('more.php')">
            <i class="fas fa-ellipsis-h"></i>
            <span>More</span>
        </button>
    </div>

    <!-- JavaScript -->
    <script>
        function navigate(page) {
            window.location.href = page;
        }

        function goBack() {
            window.history.back();
        }
    </script>

</body>
</html>
