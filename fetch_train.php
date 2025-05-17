<?php
// Database connection
$host = "localhost";
$username = "root";
$password = "riya2104";
$dbname = "train_schedule";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch train data based on user input
$from = $_GET['from'];
$to = $_GET['to'];
$date = $_GET['date'];

$sql = "SELECT train_name, train_number, departure_time, duration, arrival_time, days, classes 
        FROM trains 
        WHERE from_station = '$from' AND to_station = '$to' AND date = '$date'";

$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}

$trains = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $trains[] = $row;
    }
}

echo json_encode($trains);
?>
