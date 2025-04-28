<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Include connection file
    require_once 'connection.php';

    // Retrieve company name from the form
    $companyName = $_POST['companyName'];

    // Prepare SQL query to fetch student proposals for the company
    $sql = "SELECT studentemail FROM studentssubmittedproposal WHERE companyname = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind parameters and execute query
        $stmt->bind_param("s", $companyName);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if any proposals found
        if ($result->num_rows > 0) {
            // Display the emails of students who submitted proposals
            echo "<div id='proposalsList'><ul>";
            while ($row = $result->fetch_assoc()) {
                echo "<li>" . $row['studentemail'] . " - <button onclick='viewResume(\"" . $row['studentemail'] . "\")'>View Resume</button></li>";
            }
            echo "</ul></div>";
        } else {
            echo "<p>No proposals found for $companyName.</p>";
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
