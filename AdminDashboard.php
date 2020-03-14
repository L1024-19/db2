<?php
// Put this code at the top of any "protected" page that we create

// Start first
session_start();

if (isset($_SESSION['user_id'])) {
    // Grab user data from the database using the user_id
    // Let them access the "logged in only" pages
}
else {
    // Redirect them to the login page
    header("Location: Homepage.html");
}
?>

<div>
    <a href='AdminAddMentors.php'>Add Mentors</a><br>
    <a href='AdminAddMaterials.php'>Add Materials</a><br>
    <a href='Logout.php'>Logout</a>
<div>