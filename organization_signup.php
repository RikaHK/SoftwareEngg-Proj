<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Include the database connection
    require_once 'connection.php';

    // Retrieve and sanitize inputs
    $name = trim($_POST['name']);
    $field = trim($_POST['field']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Validate password strength (must contain digit, uppercase, special character, min 6 chars)
    if (
        strlen($password) < 6 ||
        !preg_match('/\d/', $password) ||
        !preg_match('/[A-Z]/', $password) ||
        !preg_match('/[!@#$%^&*()_+\-=\[\]{};\'\\:"|,.<>\/?]/', $password)
    ) {
        echo '<script>alert("Password must be at least 6 characters long and include an uppercase letter, a digit, and a special character."); window.history.back();</script>';
        exit;
    }

    // Check if email already exists
    $checkSql = "SELECT email FROM organization WHERE email = ?";
    $checkStmt = $conn->prepare($checkSql);
    if ($checkStmt) {
        $checkStmt->bind_param("s", $email);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows > 0) {
            echo '<script>alert("An organization with this email already exists."); window.history.back();</script>';
            exit;
        }
        $checkStmt->close();
    }

    // Hash the password securely
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert new organization
    $sql = "INSERT INTO organization (name, field, email, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssss", $name, $field, $email, $hashedPassword);
        if ($stmt->execute()) {
            // Use JavaScript redirect with alert
            echo '<script>alert("Registration successful! Redirecting to homepage..."); window.location.href = "index.html";</script>';
            exit;
        } else {
            echo '<script>alert("Registration failed. Please try again later."); window.history.back();</script>';
        }
        $stmt->close();
    } else {
        echo '<script>alert("Database error: Failed to prepare statement."); window.history.back();</script>';
    }

    $conn->close();
}
?>
