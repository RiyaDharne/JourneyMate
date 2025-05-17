<?php
session_start();
include "db.php"; 

// Assume user is logged in
$username = $_SESSION['username'] ?? 'ABCD';  // Default user for testing

// Fetch user details
$sql = "SELECT * FROM user WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
if (!$user) die("User not found.");

// Aadhaar verification logic
$aadhaar_status = "Not Verified";
if (!empty($user['aadhaar_id'])) {
    $aadhaar_status = "Verified";
}

// Update Aadhaar number
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_aadhaar'])) {
    $aadhaar_id = $_POST['aadhaar_id'];
    $stmt = $conn->prepare("UPDATE user SET aadhaar_id=? WHERE username=?");
    $stmt->bind_param("ss", $aadhaar_id, $username);
    if ($stmt->execute()) {
        echo "<script>alert('Aadhaar updated successfully!'); window.location.reload();</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aadhaar Verification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h3 class="text-center">Aadhaar Verification</h3>
    
    <div class="card p-3">
        <p><strong>Name:</strong> <?= $user['first_name'] . ' ' . $user['middle_name'] . ' ' . $user['last_name']; ?></p>
        <p><strong>Date of Birth:</strong> <?= $user['date_of_birth']; ?></p>
        <p><strong>Aadhaar Status:</strong> 
            <?= $aadhaar_status == "Verified" ? '<span class="text-success">✔ Verified</span>' : '<span class="text-danger">❌ Not Verified</span>'; ?>
        </p>
        
        <form method="POST">
            <label>Enter Aadhaar ID</label>
            <input type="text" class="form-control" name="aadhaar_id" required>
            <button type="submit" name="update_aadhaar" class="btn btn-primary mt-2">Update Aadhaar</button>
        </form>
    </div>
</div>
</body>
</html>
