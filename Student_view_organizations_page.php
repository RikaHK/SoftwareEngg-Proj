<?php
// Include connection file
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the field name from the form
    $field = $_POST['field'];

    // Prepare SQL query to retrieve participating organizations in the specified field
    $sql = "SELECT name FROM organization WHERE field = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind parameters and execute query
        $stmt->bind_param("s", $field);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if any organizations found
        if ($result->num_rows > 0) {
            // Display the names of participating organizations with a "Submit Proposal" option
            echo "<h2>Participating Organizations in $field:</h2>";
            echo "<ul>";
            while ($row = $result->fetch_assoc()) {
                echo "<li>" . $row['name'] . " <button onclick=\"submitProposal('$row[name]', '$field')\">Submit Proposal</button></li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No participating organizations found in $field.</p>";
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
