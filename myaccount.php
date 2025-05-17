<?php
session_start();
include 'db.php'; // Database connection file

$query = "SELECT first_name, middle_name, last_name, email FROM user WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $user_id);
$stmt->execute();
$stmt->bind_result($first_name, $middle_name, $last_name, $email);
$stmt->fetch();
$stmt->close();

// Combine names into full name
$full_name = trim("$first_name $middle_name $last_name");

// Set a default profile picture
$profile_pic = 'default-profile.png'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JourneyMate - My Account</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            background: white;
            margin: 20px auto;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .profile {
            display: flex;
            align-items: center;
            padding: 15px;
            background: white;
            border-bottom: 1px solid #ddd;
        }
        .profile img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 10px;
        }
        .profile h3 {
            margin: 0;
            font-size: 18px;
        }
        .profile p {
            margin: 2px 0;
            color: gray;
            font-size: 14px;
        }

        .menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .menu li {
            border-bottom: 1px solid #ddd;
        }
        .menu li a {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            text-decoration: none;
            color: black;
            font-size: 16px;
        }
        .menu li a i {
            width: 25px;
            font-size: 18px;
            margin-right: 10px;
            color: gray;
        }
        .menu li a:hover {
            background: #f0f0f0;
        }

        .dropdown-content {
            display: none;
            padding-left: 30px;
            background: #f9f9f9;
        }
        .dropdown-content a {
            font-size: 15px;
            padding: 10px 15px;
            display: block;
        }

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
            color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="profile">
            <img src="https://i.pravatar.cc/100?img=3" alt="Profile">
            <div>
                <h3><?php echo htmlspecialchars($full_name); ?></h3>
                <p><?php echo htmlspecialchars($email); ?></p>
            </div>
        </div>

        <ul class="menu">
            <li><a href="profile.php"><i class="fas fa-user"></i> <span>My Profile</span></a></li>

            <li>
                <a href="javascript:void(0);" onclick="toggleDropdown('ewallet-dropdown')">
                    <i class="fas fa-wallet"></i> <span>IRCTC eWallet</span> <i class="fas fa-chevron-down"></i>
                </a>
                <div class="dropdown-content" id="ewallet-dropdown">
                    <a href="about-us.php">About</a>
                    <a href="#">User Guide</a>
                    <a href="#">Deposit History</a>
                    <a href="transaction.php">Transactions</a>
                    <a href="refund.html">Refund Status</a>
                    <a href="#">Account Statement</a>
                </div>
            </li>

            <li><a href="mymasterlist.php"><i class="fas fa-list-alt"></i> <span>My Master List</span></a></li>

            <li>
                <a href="javascript:void(0);" onclick="toggleDropdown('loyalty-dropdown')">
                    <i class="fas fa-award"></i> <span>Loyalty</span> <i class="fas fa-chevron-down"></i>
                </a>
                <div class="dropdown-content" id="loyalty-dropdown">
                    <a href="#">IRCTC SBI Credit Card</a>
                    <a href="#">IRCTC BOB Credit Card</a>
                    <a href="#">IRCTC RBL Credit Card</a>
                    <a href="#">Add Loyalty Account</a>
                </div>
            </li>
            <li><a href="authenicate.php"><i class="fas fa-lock"></i> <span>Authenticate User</span></a></li>
            <li><a href="change-password.php"><i class="fas fa-key"></i> <span>Change Password</span></a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a></li>
        </ul>
    </div>

    <script>
        function toggleDropdown(id) {
            var dropdown = document.getElementById(id);
            dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
        }
    </script>

</body>
</html>
