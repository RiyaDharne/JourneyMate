<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $train_number = $_POST['train_number'];
    $start_point = $_POST['start_point'];
    $destination_point = $_POST['destination_point'];
    $journey_date = $_POST['journey_date'];
    $class_name = $_POST['class_name'];

    // Fetch current available seats
    $sql = "SELECT available_seats, booked_seats FROM classseats WHERE train_number = ? AND start_point = ? AND destination_point = ? AND journey_date = ? AND class_name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issss", $train_number, $start_point, $destination_point, $journey_date, $class_name);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['available_seats'] > 0) {
            // Update booked and available seats
            $new_available_seats = $row['available_seats'] - 1;
            $new_booked_seats = $row['booked_seats'] + 1;

            $update_sql = "UPDATE classseats SET available_seats = ?, booked_seats = ? WHERE train_number = ? AND start_point = ? AND destination_point = ? AND journey_date = ? AND class_name = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("iiisssss", $new_available_seats, $new_booked_seats, $train_number, $start_point, $destination_point, $journey_date, $class_name);
            $update_stmt->execute();

            echo "Ticket booked successfully!";
        } else {
            echo "No available seats!";
        }
    } else {
        echo "Train not found!";
    }
}
?>