<?php
// Include connection file
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the form
    $studentEmail = $_POST['studentEmail'];
    $field = $_POST['field'];
    $companyName = $_POST['companyName'];

    // Check if the proposal already exists
    $sql_check = "SELECT * FROM StudentsSubmittedProposal WHERE studentemail = ? AND companyname = ?";
    $stmt_check = $conn->prepare($sql_check);

    if ($stmt_check) {
        // Bind parameters and execute query
        $stmt_check->bind_param("ss", $studentEmail, $companyName);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($result_check->num_rows > 0) {
            // Proposal already exists
            $response["success"] = false;
            $response["message"] = "You have already submitted a proposal for this company.";
        } else {
            // Prepare SQL query to insert proposal into the StudentsSubmittedProposal table
            $sql_insert = "INSERT INTO StudentsSubmittedProposal (studentemail, field, companyname) VALUES (?, ?, ?)";
            $stmt_insert = $conn->prepare($sql_insert);

            if ($stmt_insert) {
                // Bind parameters and execute query
                $stmt_insert->bind_param("sss", $studentEmail, $field, $companyName);
                if ($stmt_insert->execute()) {
                    // Proposal submission success
                    $response["success"] = true;
                    $response["message"] = "Proposal submitted successfully.";
                } else {
                    // Proposal submission failed
                    $response["success"] = false;
                    $response["message"] = "Error submitting proposal: " . $conn->error;
                }
                $stmt_insert->close();
            } else {
                // Error handling for statement preparation
                $response["success"] = false;
                $response["message"] = "Statement preparation failed: " . $conn->error;
            }
        }
        $stmt_check->close();
    } else {
        // Error handling for statement preparation
        $response["success"] = false;
        $response["message"] = "Statement preparation failed: " . $conn->error;
    }

    // Close connection
    $conn->close();

    // Set response header and echo JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
