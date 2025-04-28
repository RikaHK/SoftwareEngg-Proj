<?php
// Include connection file
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the organization name from the form
    $organizationName = $_POST['organizationName'];

    // Prepare SQL query to fetch allocated room
    $sql = "SELECT allocatedroom FROM interviewschedule WHERE organizationname = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind parameters and execute query
        $stmt->bind_param("s", $organizationName);
        $stmt->execute();
        $stmt->bind_result($allocatedRoom);

        // Check if allocated room found
        if ($stmt->fetch()) {
            // Display the allocated room
            echo "<h2>Allocated Room for $organizationName:</h2>";
            echo "<p>$allocatedRoom</p>";
        } else {
            echo "<p>No allocated room found for $organizationName.</p>";
        }
    } else {
        // Error handling for statement preparation
        echo "Error: " . $conn->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
