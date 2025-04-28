<?php
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $companyName = $_POST['companyName'];

    $sql = "SELECT studentemail, organizationname FROM organizerproposaldecision WHERE status = 'approved' AND organizationname = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", $companyName);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<h2 style='color: white;'>Approved Interviews for $companyName:</h2>";
            echo "<ul>";
            while ($row = $result->fetch_assoc()) {
                echo "<li style='color: white;'>Email: " . $row['studentemail'] . ", Organization: " . $row['organizationname'] . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p style='color: white;'>No approved interviews found for $companyName.</p>";
        }
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
