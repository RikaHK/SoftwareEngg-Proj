<?php
// Include connection file
require_once 'connection.php';

// Fetch organization details from the database
$sql = "SELECT name, field, email FROM organization";
$result = $conn->query($sql);

// Check if any organizations found
if ($result->num_rows > 0) {
    // Display the details of all organizations
    echo "<h2>Participating Organization Details:</h2>";
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>Name: " . $row['name'] . " - Field: " . $row['field'] . " - Email: " . $row['email'] . "</li>";
    }
    echo "</ul>";
} else {
    echo "<p>No participating organization details found.</p>";
}

// Close connection
$conn->close();
?>
