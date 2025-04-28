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
            $stmt = $conn->prepare($updateSql);

            if ($stmt) {
                // Bind parameters and execute query
                $stmt->bind_param("ss", $room, $companyName);
                if ($stmt->execute()) {
                    echo "Room allocated successfully for $companyName.";
                } else {
                    echo "Error allocating room for $companyName: " . $conn->error;
                }

                // Close statement
                $stmt->close();
            } else {
                // Statement preparation failed
                echo "Statement preparation failed: " . $conn->error;
            }
        } else {
            echo "No rows found for $companyName.";
        }
    } else {
        // Statement preparation failed
        echo "Statement preparation failed: " . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>
