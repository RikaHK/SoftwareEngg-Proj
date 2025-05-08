<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Include connection file
    require_once 'connection.php';

    // Retrieve POST data
    $companyName = $_POST['companyName'];
    $room = $_POST['room'];

    // Check if a row already exists for the company name
    $checkSql = "SELECT * FROM interviewschedule WHERE organizationname = ?";
    $stmt = $conn->prepare($checkSql);

    if ($stmt) {
        // Bind parameters and execute query
        $stmt->bind_param("s", $companyName);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Update allocated room for existing rows
            $updateSql = "UPDATE interviewschedule SET allocatedroom = ? WHERE organizationname = ?";
            $stmtUpdate = $conn->prepare($updateSql);

            if ($stmtUpdate) {
                // Bind parameters and execute update query
                $stmtUpdate->bind_param("ss", $room, $companyName);
                if ($stmtUpdate->execute()) {
                    echo "Room allocated successfully for $companyName.";
                } else {
                    echo "Error allocating room for $companyName: " . $stmtUpdate->error;
                }
                // Close update statement
                $stmtUpdate->close();
            } else {
                // Statement preparation failed for update
                echo "Update statement preparation failed: " . $conn->error;
            }
        } else {
            echo "No rows found for $companyName.";
        }

        // Close select statement
        $stmt->close();
    } else {
        // Statement preparation failed for select
        echo "Select statement preparation failed: " . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>
