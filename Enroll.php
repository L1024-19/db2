<?php
// Put this code at the top of any "protected" page that we create

// Start first
session_start();
if (isset($_SESSION['user_id'])) {
    // Grab user data from the database using the user_id
    // Let them access the "logged in only" pages
    $myconnection = mysqli_connect('localhost', 'root', '', 'db2') 
    or die ('Could not connect: ' . mysqli_error($myconnection));
    $insert = "INSERT INTO enroll (meet_id, mentee_id) VALUES (?, ?)";

    $insertstmt = $myconnection->prepare($insert);
    $insertstmt->bind_param("ii", $_GET['key'], $_SESSION['user_id']);
    
    if(!$insertstmt->execute()) {
        echo(mysqli_error($myconnection));
    }

    mysqli_close($myconnection);
    header('Location: StudentSection.php');
}
else {
    // Redirect them to the login page
    header("Location: Homepage.html");
}
?>