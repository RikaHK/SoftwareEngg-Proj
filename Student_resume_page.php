<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Include connection file
    require_once 'connection.php';

    // Retrieve POST data
    $fullName = $_POST['fullName'];
    $email = $_POST['email']; // New email variable
    $fieldOfStudy = $_POST['fieldOfStudy'];
    $phoneNumber = $_POST['phoneNumber'];
    $language = $_POST['language'];
    $experties = $_POST['experties'];
    $currentSemester = $_POST['currentSemester'];
    $skills = $_POST['skills'];
    $about = $_POST['about'];

    // Perform validation
    if (empty($fullName) || empty($email) || empty($phoneNumber)) {
        echo '<script>alert("Full Name, Email, and Phone Number are required.");</script>';
        echo '<script>window.location.href = "student_resume_page.html";</script>';
        exit;
    }
    // You can add more validation checks here...

    // Check if the fullname and email already exist
    $sql_check = "SELECT * FROM studentresumedetails WHERE fullname = ? AND email = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("ss", $fullName, $email);
    $stmt_check->execute();
    $result = $stmt_check->get_result();

    if ($result->num_rows > 0) {
        // User with the same fullname and email already exists
        echo '<script>alert("User with the same fullname and email already exists.");</script>';
        echo '<script>window.location.href = "studentMenu.html";</script>';
        exit;
    } else {
        // Prepare SQL query using prepared statement
        $sql_insert = "INSERT INTO studentresumedetails (fullname, email, field, phone, language, experties, currentsemester, skills, about) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param("sssssssss", $fullName, $email, $fieldOfStudy, $phoneNumber, $language, $experties, $currentSemester, $skills, $about);

        // Execute query
        if ($stmt_insert->execute()) {
            // Registration success
            echo '<script>alert("Your details are saved successfully.");</script>';
            echo '<script>window.location.href = "studentMenu.html";</script>';
            exit;
        } else {
            // Registration failed
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close statement
        $stmt_insert->close();
    }

    // Close statement
    $stmt_check->close();
    
    // Close connection
    $conn->close();
}
?>
