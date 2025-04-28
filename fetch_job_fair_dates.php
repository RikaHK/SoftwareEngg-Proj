<?php
// Include connection file
require_once 'connection.php';

// Query to fetch job fair dates
$sql = "SELECT * FROM jobfairdates";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Display job fair dates
    echo "<h2>Job Fair Dates at FAST University:</h2>";
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>Start Date: " . $row['startdate'] . ", End Date: " . $row['enddate'] . ", Start Time: " . $row['starttime'] . ", End Time: " . $row['endtime'] . "</li>";
    }
    echo "</ul>";
} else {
    echo "<p>No job fair dates found.</p>";
}

// Close connection
$conn->close();
?>
