<?php
session_start(); // Start session to store user data

// Function to redirect with message
function redirectWithError($errorMsg) {
    $_SESSION['error'] = $errorMsg;
    header('Location: login.html');
    exit;
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Include connection file
    require_once 'connection.php';

    // Retrieve POST data
    $email = $_POST['email'];
    $password = $_POST['password'];
    $userType = $_POST['userType'];

    // Prepare SQL query based on user type
    $sql = "";
    switch ($userType) {
        case 'admin':
            $sql = "SELECT * FROM admin WHERE email = ?";
            break;
        case 'student':
            $sql = "SELECT * FROM student WHERE email = ?";
            break;
        case 'organizer':
            $sql = "SELECT * FROM organization WHERE email = ?";
            break;
        default:
            // Invalid user type
            redirectWithError("Invalid user type.");
    }

    // Prepare and execute SQL query using prepared statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists and verify password
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // For admin, password is not encrypted
        if ($userType === 'admin' && $password === $user['password']) {
            $_SESSION['user'] = $user;
            header('Location: adminMenu.html?name=' . urlencode($user['name']));
            exit;
        }
        // For student and organizer, verify encrypted password
        elseif (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            if ($userType === 'student') {
                header('Location: studentMenu.html?name=' . urlencode($user['name']));
            } else {
                header('Location: organizerMenu.html?name=' . urlencode($user['name']));
            }
            exit;
        } else {
            // Incorrect password
            redirectWithError("Incorrect password.");
        }
    } else {
        // User not found
        redirectWithError("User not found.");
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
