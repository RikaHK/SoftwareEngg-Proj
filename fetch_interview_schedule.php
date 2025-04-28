<?php
// Include connection file
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the organization name from the form
    $organizationName = $_POST['organizationName'];

    // Prepare SQL query to fetch interview schedule
    $sql = "SELECT studentemail, interviewslot FROM interviewschedule WHERE organizationname = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind parameters and execute query
        $stmt->bind_param("s", $organizationName);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if any interview schedule found
        if ($result->num_rows > 0) {
            // Display the interview schedule
            echo "<h2>Interview Schedule for $organizationName:</h2>";
            echo "<ul>";
            while ($row = $result->fetch_assoc()) {
                echo "<li>Email: " . $row['studentemail'] . ", Interview Slot: " . $row['interviewslot'] . " ";
                echo "<button onclick='takeInterview(\"" . $row['studentemail'] . "\", \"" . $row['interviewslot'] . "\")'>Take Interview</button></li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No interview schedule found for $organizationName.</p>";
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
<script>
    function takeInterview(studentEmail, interviewSlot) {
        var reviews = prompt("Enter your reviews for the interview:");

        if (reviews !== null) {
            // AJAX request to remove interview schedule and insert reviews
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "take_interview.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Display success message or handle further actions
                        alert(xhr.responseText);
                    } else {
                        console.error("Error taking interview: " + xhr.status);
                    }
                }
            };
            xhr.send("studentEmail=" + studentEmail + "&interviewSlot=" + interviewSlot + "&reviews=" + reviews);
        }
    }
</script>
