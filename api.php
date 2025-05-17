<?php
// Database connection
$host = "localhost";
$username = "root";
$password = "";
$dbname = "train_schedule";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $action = $_GET['action'];

    switch ($action) {
        case 'bookTicket':
            // Logic for booking a ticket
            $from = $_GET['from'];
            $to = $_GET['to'];
            $date = $_GET['date'];
            $class = $_GET['class'];
            // Add booking logic here (e.g., insert into bookings table)
            echo json_encode(["status" => "success", "message" => "Ticket booked successfully"]);
            break;

        case 'fetchTrains':
            // Logic for fetching train details
            $from = $_GET['from'];
            $to = $_GET['to'];
            $date = $_GET['date'];
            // Fetch train details based on the criteria
            $sql = "SELECT * FROM trains WHERE from_station = '$from' AND to_station = '$to' AND date = '$date'";
            $result = $conn->query($sql);
            $trains = [];
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $trains[] = $row;
                }
                echo json_encode($trains);
            } else {
                echo json_encode(["status" => "error", "message" => "No trains found"]);
            }
            break;

        case 'myBookings':
            echo json_encode(["status" => "success", "message" => "My Bookings API called"]);
            break;

        case 'pnrEnquiry':
            echo json_encode(["status" => "success", "message" => "PNR Enquiry API called"]);
            break;

        default:
            echo json_encode(["status" => "error", "message" => "Invalid action"]);
            break;
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
}
?>
