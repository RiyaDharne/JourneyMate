<?php
$host = "127.0.0.1";
$user = "root";  
$pass = "";       
$dbname = "train_db";

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch last transaction with payment details
$sql = "SELECT t.*, p.amount, p.payment_method, p.payment_status 
        FROM ticket t 
        LEFT JOIN payment p ON t.ticket_no = p.ticket_no 
        ORDER BY t.ticket_no DESC LIMIT 1";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Format date properly
    $formatted_date = ($row['date'] == '0000-00-00' || empty($row['date'])) ? "Not Available" : date("d M Y", strtotime($row['date']));

    echo "<style>
            body { font-family: 'Poppins', sans-serif; background: #F2F6FC; margin: 0; padding: 0; }
            .container { width: 90%; max-width: 500px; margin: 40px auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0px 4px 10px rgba(0,0,0,0.1); }
            .title { text-align: center; color: #0052cc; font-size: 22px; font-weight: bold; }
            .info-box { background: #f8f9fa; padding: 10px 15px; margin: 8px 0; border-radius: 5px; display: flex; justify-content: space-between; font-size: 16px; }
            .label { font-weight: bold; color: #555; }
            .value { color: #222; }
            .payment { background: #dff6e0; color: #1d7a27; font-weight: bold; }
          </style>";

    echo "<div class='container'>";
    echo "<div class='title'>Last Transaction</div>";
    echo "<div class='info-box'><span class='label'>Ticket No:</span><span class='value'>" . $row['ticket_no'] . "</span></div>";
    echo "<div class='info-box'><span class='label'>Status:</span><span class='value'>" . ucfirst($row['status']) . "</span></div>";
    echo "<div class='info-box'><span class='label'>Date:</span><span class='value'>" . $formatted_date . "</span></div>";
    echo "<div class='info-box'><span class='label'>Phone:</span><span class='value'>" . $row['phno'] . "</span></div>";
    echo "<div class='info-box'><span class='label'>Email:</span><span class='value'>" . $row['email'] . "</span></div>";
    echo "<div class='info-box'><span class='label'>Train No:</span><span class='value'>" . $row['train_no'] . "</span></div>";
    echo "<div class='info-box'><span class='label'>Station No:</span><span class='value'>" . $row['station_no'] . "</span></div>";
    echo "<div class='info-box'><span class='label'>Username:</span><span class='value'>" . $row['username'] . "</span></div>";

    // Payment details
    echo "<div class='info-box payment'><span class='label'>Payment Amount:</span><span class='value'>₹" . ($row['amount'] ?? '1080') . "</span></div>";
    echo "<div class='info-box'><span class='label'>Payment Method:</span><span class='value'>" . ($row['payment_method'] ?? 'Debit Card') . "</span></div>";
    echo "<div class='info-box'><span class='label'>Payment Status:</span><span class='value'>" . ($row['payment_status'] ?? 'Active') . "</span></div>";

    echo "</div>";
} else {
    echo "<p style='text-align: center; color: red;'>No transactions found.</p>";
}

// Close connection
$conn->close();
?>
