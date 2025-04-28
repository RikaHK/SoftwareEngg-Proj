<?php
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $companyName = $_POST['companyName'];

    // Delete existing interview slots for the company
    $sqlDelete = "DELETE FROM interviewschedule WHERE organizationname = ?";
    $stmtDelete = $conn->prepare($sqlDelete);
    $stmtDelete->bind_param("s", $companyName);
    $stmtDelete->execute();
    $stmtDelete->close();

    // Retrieve approved interviews for the company
    $sqlSelect = "SELECT studentemail FROM organizerproposaldecision WHERE status = 'approved' AND organizationname = ?";
    $stmtSelect = $conn->prepare($sqlSelect);
    $stmtSelect->bind_param("s", $companyName);
    $stmtSelect->execute();
    $result = $stmtSelect->get_result();

    // Generate and insert unique interview slots for each student
    $interviewSlots = generateInterviewSlots();
    while ($row = $result->fetch_assoc()) {
        $studentEmail = $row['studentemail'];

        // Check if interview is already scheduled for this student and company
        $sqlCheck = "SELECT * FROM interviewschedule WHERE studentemail = ? AND organizationname = ?";
        $stmtCheck = $conn->prepare($sqlCheck);
        $stmtCheck->bind_param("ss", $studentEmail, $companyName);
        $stmtCheck->execute();
        $resultCheck = $stmtCheck->get_result();

        if ($resultCheck->num_rows > 0) {
            // Interview already scheduled for this student and company
            echo "Interview already scheduled for $studentEmail and $companyName.<br>";
        } else {
            // Insert interview slot
            $interviewSlot = array_pop($interviewSlots);

            $sqlInsert = "INSERT INTO interviewschedule (studentemail, organizationname, interviewslot) VALUES (?, ?, ?)";
            $stmtInsert = $conn->prepare($sqlInsert);
            $stmtInsert->bind_param("sss", $studentEmail, $companyName, $interviewSlot);
            $stmtInsert->execute();
            $stmtInsert->close();
        }

        $stmtCheck->close();
    }

    $stmtSelect->close();
    $conn->close();

    echo "Interviews scheduled successfully.";
}

function generateInterviewSlots() {
    $slots = [];
    $start = strtotime('09:00:00');
    $end = strtotime('17:00:00');
    $interval = 5 * 60; // 5 minutes interval

    for ($time = $start; $time < $end; $time += $interval) {
        $slot = date('H:i', $time);
        $slots[] = $slot;
    }

    shuffle($slots); // Shuffle to generate unique slots
    return $slots;
}
?>
