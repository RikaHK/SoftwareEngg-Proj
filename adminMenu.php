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
    <title>User Menu</title>
</head>
<body>
    <div class="menu-icon">&#9776;</div>
    <div class="menu">
        <ul>
            <li><a href="admin_view_student_details.html">View Student Details</a></li>
            <li><a href="admin_view_participating_organization.html">View Participating Organization</a></li>
            <li><a href="admin_announce_job_fair_days.html">Announce Job Fair Days</a></li>
            <li><a href="admin_schedule_interview.html">Schedule Interview of Approved Students</a></li>
            <li><a href="admin_allocate_rooms.html">Allocate Rooms to Organizations</a></li>
        </ul>
    </div>
    
    <h1>Welcome to the User Menu</h1>
    <p>Welcome, <?php echo $user['name']; ?>!</p>
    <p>Your details:</p>
    <ul>
        <li>Name: <?php echo $user['name']; ?></li>
        <li>Email: <?php echo $user['email']; ?></li>
    </ul>
    <!-- Add other menu content here -->
    
    <script>
        // Get user's name from URL query parameter
        const urlParams = new URLSearchParams(window.location.search);
        const name = urlParams.get('name');

        // Display welcome message with user's name
        const welcomeMessage = document.createElement('h1');
        welcomeMessage.textContent = `Welcome, ${name}!`;
        document.body.insertBefore(welcomeMessage, document.body.firstChild);
        
        // Toggle menu
        const menuIcon = document.querySelector('.menu-icon');
        const menu = document.querySelector('.menu');
        menuIcon.addEventListener('click', function() {
            menu.style.left = menu.style.left === '0px' ? '-200px' : '0px';
        });
    </script>
</body>
</html>
