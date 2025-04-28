<?php
// Include connection file
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve parameters from the request
    $studentEmail = $_POST['studentEmail'];
    $interviewSlot = $_POST['interviewSlot'];
    $reviews = $_POST['reviews'];

    // Prepare SQL query to remove interview schedule
    $sqlDelete = "DELETE FROM interviewschedule WHERE studentemail = ? AND interviewslot = ?";
    $stmtDelete = $conn->prepare($sqlDelete);

    if ($stmtDelete) {
        // Bind parameters and execute query
        $stmtDelete->bind_param("ss", $studentEmail, $interviewSlot);
        $stmtDelete->execute();

        // Check if the deletion was successful
        if ($stmtDelete->affected_rows > 0) {
            // Prepare SQL query to insert reviews into organizationreviews table
            $sqlInsert = "INSERT INTO organizationreviews (studentemail, reviews) VALUES (?, ?)";
            $stmtInsert = $conn->prepare($sqlInsert);

            if ($stmtInsert) {
                // Bind parameters and execute query
                $stmtInsert->bind_param("ss", $studentEmail, $reviews);
                $stmtInsert->execute();

                // Check if the insertion was successful
                if ($stmtInsert->affected_rows > 0) {
                    echo "Interview taken successfully and reviews added.";
                } else {
                    echo "Failed to add reviews.";
                }
            } else {
                echo "Error: " . $conn->error;
            }
        } else {
            echo "Failed to remove interview schedule.";
        }

        // Close statement
        $stmtDelete->close();
    } else {
        echo "Error: " . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>
