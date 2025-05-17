<?php
session_start();
include 'db.php';

// Fetch user details from database
$query = "SELECT first_name, last_name, gender, date_of_birth, aadhaar_id, aadhaar_status 
          FROM user WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($first_name, $last_name, $gender, $dob, $aadhaar_id, $aadhaar_status);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Master List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="master-list">
        <h2>MASTER LIST</h2>
        <p><strong><?= strtoupper($first_name . " " . $last_name) ?></strong></p>
        <p><?= $gender ?>, Date of Birth: <?= date("d-M-Y", strtotime($dob)) ?></p>
        <p>Aadhaar ID: <?= $aadhaar_id ? "XXXX-XXXX-" . substr($aadhaar_id, -4) : "Not Provided" ?></p>

        <h3>Verification Status:</h3>
        <?php if ($aadhaar_status == "Verified") { ?>
            <p style="color: green;">✅ Verified - Passenger is Aadhaar verified.</p>
        <?php } elseif ($aadhaar_status == "Pending") { ?>
            <p style="color: orange;">⌛ Pending - Aadhaar verification is in progress.</p>
        <?php } else { ?>
            <p style="color: red;">❌ Not Verified - Passenger is not Aadhaar verified.</p>
        <?php } ?>
    </div>
</body>
</html>
