<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.html');
    exit;
}
$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Student Resume</title>
</head>
<body>
    <h1>Student Resume Details</h1>

    <?php
    // Include connection file
    require_once 'connection.php';

    // Retrieve email from URL query parameter
    $email = $_GET['email'];

    // Prepare SQL query to fetch student details
    $sql = "SELECT * FROM studentresumedetails WHERE email = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind parameters and execute query
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if any details found
        if ($result->num_rows > 0) {
            // Display the details of the student
            echo "<ul>";
            while ($row = $result->fetch_assoc()) {
                echo "<li><strong>Full Name:</strong> " . $row['fullname'] . "</li>";
                echo "<li><strong>Email:</strong> " . $row['email'] . "</li>";
                echo "<li><strong>Field:</strong> " . $row['field'] . "</li>";
                echo "<li><strong>Phone:</strong> " . $row['phone'] . "</li>";
                echo "<li><strong>Language:</strong> " . $row['language'] . "</li>";
                echo "<li><strong>Expertise:</strong> " . $row['experties'] . "</li>";
                echo "<li><strong>Current Semester:</strong> " . $row['currentsemester'] . "</li>";
                echo "<li><strong>Skills:</strong> " . $row['skills'] . "</li>";
                echo "<li><strong>About:</strong> " . $row['about'] . "</li>";
            }
            echo "</ul>";

            // Add buttons to accept or reject the resume
            echo "<form action='submit_decision.php' method='post'>";
            echo "<input type='hidden' name='studentEmail' value='$email'>";
            echo "<input type='hidden' name='organizationName' value='" . $user['name'] . "'>";
            echo "<button type='submit' name='status' value='approved'>Accept</button>";
            echo "<button type='submit' name='status' value='rejected'>Reject</button>";
            echo "</form>";
        } else {
            echo "<p>No resume details found for this email.</p>";
        }
    } else {
        // Error handling for statement preparation
        echo "Error: " . $conn->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
    ?>

    <button onclick="goBack()">Go Back</button>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
