<?php
// Include connection file
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve email from the form
    $email = $_POST['email'];

    // Fetch scheduled interviews from the database
    $sql = "SELECT * FROM interviewschedule WHERE studentemail = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Display the scheduled interviews
        echo "<h2>Scheduled Interviews</h2>";
        while ($row = $result->fetch_assoc()) {
            echo "<p><strong>Interview Slot:</strong> " . $row['interviewslot'] . "</p>";
            echo "<p><strong>Organization Name:</strong> " . $row['organizationname'] . "</p>";
            echo "<p><strong>Allocated Room:</strong> " . $row['allocatedroom'] . "</p>";
        }
    } else {
        echo "<p>No scheduled interviews found for this email.</p>";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
