<?php
// Include connection file
require_once 'connection.php';

// Fetch student details from the database
$sql = "SELECT name, email FROM student";
$result = $conn->query($sql);

// Check if any students found
if ($result->num_rows > 0) {
    // Display the details of all students
    echo "<h2>Student Details:</h2>";
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>Name: " . $row['name'] . " - Email: " . $row['email'] . " <button onclick='viewResume(\"" . $row['email'] . "\")'>View Resume</button></li>";
    }
    echo "</ul>";
} else {
    echo "<p>No student details found.</p>";
}

// Close connection
$conn->close();
?>
