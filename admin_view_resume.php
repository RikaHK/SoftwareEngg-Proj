<?php
// Include connection file
require_once 'connection.php';

// Retrieve email from query parameters
$email = $_GET['email'];

// Fetch resume details from the database for the specified email
$sql = "SELECT fullname, email, field, phone, language, experties, skills, about FROM studentresumedetails WHERE email = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    // Bind parameters and execute query
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if any resume details found
    if ($result->num_rows > 0) {
        // Display the resume details
        $row = $result->fetch_assoc();
        echo "<h2>Resume Details for " . $row['fullname'] . ":</h2>";
        echo "<ul>";
        echo "<li>Full Name: " . $row['fullname'] . "</li>";
        echo "<li>Email: " . $row['email'] . "</li>";
        echo "<li>Field: " . $row['field'] . "</li>";
        echo "<li>Phone: " . $row['phone'] . "</li>";
        echo "<li>Language: " . $row['language'] . "</li>";
        echo "<li>Expertise: " . $row['experties'] . "</li>";
        echo "<li>Skills: " . $row['skills'] . "</li>";
        echo "<li>About: " . $row['about'] . "</li>";
        echo "</ul>";
    } else {
        echo "<p>No resume details found for this email.</p>";
    }
} else {
    // Error handling for statement preparation
    echo "Error: " . $conn->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
