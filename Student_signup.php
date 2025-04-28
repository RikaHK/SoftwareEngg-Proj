<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Include connection file
    require_once 'connection.php';

    // Retrieve POST data
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check password format
    if (!preg_match('/\d/', $password) || !preg_match('/[!@#$%^&*()_+\-=\[\]{};\'\\:"|,.<>\/?]/', $password)) {
        // Password does not meet the requirements
        echo "Error: Password must contain at least one digit and one special character!";
        exit; // Stop further execution
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL query using prepared statement
    $sql = "INSERT INTO test.student (name, username, email, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("ssss", $name, $username, $email, $hashedPassword);

    // Execute query
    if ($stmt->execute()) {
        // Registration success
        echo "Data inserted successfully.";
        // Redirect to homepage
        header('Location: index.html');
        exit; // Ensure no further code execution after redirection
    } else {
        // Registration failed
        echo "Error inserting data: " . $conn->error;
    }

    // Close statement
    $stmt->close();
    
    // Close connection
    $conn->close();
}
?>
