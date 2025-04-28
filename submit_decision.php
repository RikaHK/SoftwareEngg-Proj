<?php
// Include connection file
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from form
    $studentEmail = $_POST['studentEmail'];
    $organizationName = $_POST['organizationName'];
    $status = $_POST['status'];

    // Check if the decision already exists in the organizerproposaldecision table
    $sql_check = "SELECT * FROM organizerproposaldecision WHERE studentemail = ? AND organizationname = ?";
    $stmt_check = $conn->prepare($sql_check);
    if ($stmt_check) {
        $stmt_check->bind_param("ss", $studentEmail, $organizationName);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        // If the decision already exists, display a message and exit
        if ($result_check->num_rows > 0) {
            echo "You have already made a decision regarding this proposal.";
            exit;
        }
    }

    // Prepare SQL query to insert decision into the organizerproposaldecision table
    $sql_insert = "INSERT INTO organizerproposaldecision (studentemail, organizationname, status) VALUES (?, ?, ?)";
    $stmt_insert = $conn->prepare($sql_insert);

    if ($stmt_insert) {
        // Bind parameters and execute query
        $stmt_insert->bind_param("sss", $studentEmail, $organizationName, $status);
        if ($stmt_insert->execute()) {
            // Decision submitted successfully
            echo "Decision submitted successfully.";

            // Redirect back to Organization_View_student_proposals.html after a brief delay
            echo "<script>setTimeout(function(){ window.location.href = 'Organization_View_student_proposals.html'; }, 2000);</script>";
        } else {
            // Submission failed
            echo "Error submitting decision: " . $conn->error;
        }
    } else {
        // Error handling for statement preparation
        echo "Error: " . $conn->error;
    }

    // Close statements and connection
    $stmt_insert->close();
    $stmt_check->close();
    $conn->close();
}
?>
