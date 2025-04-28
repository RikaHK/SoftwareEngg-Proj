<?php
require_once 'connection.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $startTime = $_POST['startTime'];
    $endTime = $_POST['endTime'];

    // Prepare SQL statement to delete existing row and insert new row for job fair dates
    $deleteSql = "DELETE FROM jobfairdates";
    $insertSql = "INSERT INTO jobfairdates (startdate, enddate, starttime, endtime) VALUES (?, ?, ?, ?)";

    // Start a transaction
    $conn->begin_transaction();

    try {
        // Delete existing row
        $deleteStmt = $conn->prepare($deleteSql);
        if (!$deleteStmt->execute()) {
            throw new Exception("Error deleting existing job fair dates: " . $conn->error);
        }

        // Insert new row
        $insertStmt = $conn->prepare($insertSql);
        if (!$insertStmt->bind_param("ssss", $startDate, $endDate, $startTime, $endTime) || !$insertStmt->execute()) {
            throw new Exception("Error inserting new job fair dates: " . $conn->error);
        }

        // Commit transaction
        $conn->commit();
        echo "Job fair dates announced successfully.";
    } catch (Exception $e) {
        // Rollback transaction on error
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }

    // Close statements
    $deleteStmt->close();
    $insertStmt->close();

    // Close connection
    $conn->close();
}
?>
