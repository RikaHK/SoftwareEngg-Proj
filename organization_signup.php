<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Include connection file
    require_once 'connection.php';

    // Retrieve POST data
    $name = $_POST['name'];
    $field = $_POST['field']; // New field
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the password contains at least one digit and one special character
    if (!preg_match('/\d/', $password) || !preg_match('/[!@#$%^&*()_+\-=\[\]{};\'\\:"|,.<>\/?]/', $password)) {
        echo '<script>alert("Password must contain at least one digit and one special character!");</script>';
        exit;
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL query using prepared statement
    $sql = "INSERT INTO organization (name, field, email, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind parameters and execute query
        $stmt->bind_param("ssss", $name, $field, $email, $hashedPassword);
        if ($stmt->execute()) {
            // Registration success
            echo '<script>alert("Registration successful");</script>';
            header('Location: index.html');
            exit;
        } else {
            // Registration failed
            echo '<script>alert("Registration failed: ' . $conn->error . '");</script>';
            echo "Error inserting data: " . $conn->error;
        }

        // Close statement
        $stmt->close();
    } else {
        // Statement preparation failed
        echo '<script>alert("Statement preparation failed: ' . $conn->error . '");</script>';
        echo "Statement preparation failed: " . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>
