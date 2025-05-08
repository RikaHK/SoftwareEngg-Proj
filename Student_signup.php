<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Include connection file
    require_once 'connection.php';

    // Retrieve and sanitize POST data
    $name = trim($_POST['name']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Check password format
    if (
        strlen($password) < 6 ||
        !preg_match('/\d/', $password) ||
        !preg_match('/[!@#$%^&*()_+\-=\[\]{};\'\\:"|,.<>\/?]/', $password)
    ) {
        echo '<script>alert("Password must be at least 6 characters long and include at least one digit and one special character."); window.history.back();</script>';
        exit;
    }

    // Check if username or email already exists
    $checkSql = "SELECT username, email FROM student WHERE username = ? OR email = ?";
    $checkStmt = $conn->prepare($checkSql);
    if ($checkStmt) {
        $checkStmt->bind_param("ss", $username, $email);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows > 0) {
            echo '<script>alert("Username or email already exists. Please choose a different one."); window.history.back();</script>';
            $checkStmt->close();
            $conn->close();
            exit;
        }
        $checkStmt->close();
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL query using prepared statement
    $sql = "INSERT INTO student (name, username, email, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssss", $name, $username, $email, $hashedPassword);
        if ($stmt->execute()) {
            echo '<script>alert("Registration successful! Redirecting to homepage..."); window.location.href = "index.html";</script>';
            exit;
        } else {
            echo '<script>alert("Error: ' . $conn->error . '"); window.history.back();</script>';
        }
        $stmt->close();
    } else {
        echo '<script>alert("Statement preparation failed: ' . $conn->error . '"); window.history.back();</script>';
    }

    $conn->close();
}
?>
