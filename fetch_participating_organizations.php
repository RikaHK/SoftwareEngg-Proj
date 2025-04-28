<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Include connection file
    require_once 'connection.php';

    // Prepare SQL query to retrieve participating organizations
    $sql = "SELECT name FROM organization";
    $result = $conn->query($sql);

    // Check if any organizations found
    if ($result->num_rows > 0) {
        // Display the names of participating organizations
        echo "<h2>Participating Organizations:</h2>";
        echo "<div id='organizationsList'><ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li>" . $row['name'] . "</li>";
        }
        echo "</ul></div>";
    } else {
        echo "<p>No participating organizations found.</p>";
    }

    // Close connection
    $conn->close();
}
?>
