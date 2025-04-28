<?php
// Include connection file
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve email from the form
    $email = $_POST['email'];

    // Fetch anonymous reviews from the database
    $sql = "SELECT reviews FROM organizationreviews WHERE studentemail = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Display the anonymous reviews
        echo "<h2>Anonymous Reviews for You</h2>";
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li>" . $row['reviews'] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No anonymous reviews found for this email.</p>";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
