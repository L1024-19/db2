<?php
// Put this code at the top of any "protected" page that we create

// Start first
session_start();
if (isset($_SESSION['user_id'])) {
    // Grab user data from the database using the user_id
    // Let them access the "logged in only" pages
    $myconnection = mysqli_connect('localhost', 'root', '', 'db2')
    or die ('Could not connect: ' . mysqli_error($myconnection));
    $delete = "DELETE FROM enroll WHERE mentee_id = '{$_SESSION['user_id']}')";
    mysqli_query($myconnection, $delete);

    mysqli_close($myconnection);
    header('Location: StudentDashboard.php');
}
else {
    // Redirect them to the login page
    header("Location: Homepage.html");
}
?>
