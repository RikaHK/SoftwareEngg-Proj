<?php
// Include connection file
require_once 'connection.php';

// Fetch job fair dates from the database
$sql = "SELECT startdate, enddate, starttime, endtime FROM jobfairdates";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Display the job fair dates
    while ($row = $result->fetch_assoc()) {
        echo "<p><strong>Start Date:</strong> " . $row['startdate'] . "</p>";
        echo "<p><strong>End Date:</strong> " . $row['enddate'] . "</p>";
        echo "<p><strong>Start Time:</strong> " . $row['starttime'] . "</p>";
        echo "<p><strong>End Time:</strong> " . $row['endtime'] . "</p>";
    }
} else {
    echo "<p>No job fair dates available.</p>";
}

// Close connection
$conn->close();
?>
