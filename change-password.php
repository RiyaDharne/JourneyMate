<?php
session_start();
include 'db.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if new password matches confirmation
    if ($new_password !== $confirm_password) {
        header("Location: change_password.php?error=Passwords do not match");
        exit();
    }

    // Hash the new password
    $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
    
    // Update query
    $query = "UPDATE user SET password = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $hashed_password, $user_id);

    if ($stmt->execute()) {
        header("Location: myaccount.php?password_changed=1");
    } else {
        header("Location: change_password.php?error=Password change failed");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password | JourneyMate</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #ffffff;
            font-family: Arial, sans-serif;
        }
        .header {
            background: linear-gradient(to right, #ff7f50, #ffaf7a);
            color: white;
            padding: 10px;
            text-align: center;
            font-weight: bold;
            font-size: 18px;
            position: relative;
        }
        .back-button {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            cursor: pointer;
            color: white;
        }
        .save-button {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 16px;
            cursor: pointer;
            color: white;
        }
        .container {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
        }
        .form-group {
            position: relative;
            margin-bottom: 20px;
        }
        .form-control {
            border: none;
            border-bottom: 1px solid gray;
            border-radius: 0;
            box-shadow: none;
            padding-left: 0;
            font-size: 16px;
        }
        .form-control:focus {
            border-bottom: 2px solid #ff7f50;
            outline: none;
            box-shadow: none;
        }
        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: gray;
        }
        .info-text {
            font-size: 12px;
            color: gray;
            font-style: italic;
        }
        .advertisement {
            width: 100%;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="header">
    <span class="back-button"><i class="fa fa-arrow-left"></i></span>
    CHANGE PASSWORD
    <span class="save-button">Save</span>
</div>

<div class="container">
    <form action="change_password.php" method="POST">
        <div class="form-group">
            <input type="password" name="old_password" class="form-control" placeholder="Old Password" required>
            <i class="fa fa-eye toggle-password" onclick="togglePassword(this)"></i>
        </div>
        <div class="form-group">
            <input type="password" name="new_password" class="form-control" placeholder="New Password" required>
            <i class="fa fa-eye toggle-password" onclick="togglePassword(this)"></i>
        </div>
        <div class="info-text">
            (8 to 15 characters long, with at least one capital character, one special character, one small character, and one numeric digit)
        </div>
        <div class="form-group">
            <input type="password" name="confirm_password" class="form-control" placeholder="Confirm New Password" required>
            <i class="fa fa-eye toggle-password" onclick="togglePassword(this)"></i>
        </div>
        <img src="advertisement.png" alt="Advertisement" class="advertisement">
    </form>
</div>

<script>
    function togglePassword(icon) {
        let input = icon.previousElementSibling;
        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            input.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }
</script>

</body>
</html>
