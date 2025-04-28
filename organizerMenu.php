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
    <title>Organizer Menu</title>
</head>
<body>
    <div id="menu">
        <ul>
            <li><a href="view_participating_organizations.html">View Participating Organizations</a></li>
            <li><a href="Organization_View_student_proposals.html">View and Approve Student Proposals</a></li>
            <li><a href="Organization_see_job_fair_days.html">Job Fair Dates</a></li>
            <li><a href="Organizartion_see__allocate_rooms.html">Allocate Room</a></li>
            <li><a href="Organization_start_interview.html">Start Interview</a></li>
        </ul>
    </div>
    <h1>Welcome to the Organizer Menu</h1>
    <h2 id="welcomeMessage">Welcome, <?php echo $user['name']; ?>!</h2>
    <div id="menuToggle">&#9776;</div>
    <!-- Your menu content goes here -->
</body>
</html>
