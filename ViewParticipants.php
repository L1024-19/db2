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

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Participants List</title>
</head>
<body>
    <h2>Mentor</h2>
    <?php
    // Grab user data from the database using the user_id
    // Let them access the "logged in only" pages
    $myconnection = mysqli_connect('localhost', 'root', '', 'db2') 
    or die ('Could not connect: ' . mysqli_error($myconnection));

    $mentorsquery = "SELECT mentor_id from enroll2 WHERE meet_id = '{$_GET['key']}'";
    $mentorsinfoquery = "SELECT name, email from users WHERE id IN (".$mentorsquery.")";
    $mentorsinforesult = mysqli_query($myconnection, $mentorsinfoquery)
    or die ('Query failed: ' . mysqli_error($myconnection));
    while ($mentorsinfo = mysqli_fetch_array($mentorsinforesult, MYSQLI_ASSOC)) {    
        echo("Name:&nbsp;".$mentorsinfo["name"]."&nbsp;&nbsp;Email:&nbsp;".$mentorsinfo["email"]."<br>");
    }

    mysqli_close($myconnection);
    ?>
    <h2>Mentee</h2>
    <?php
    // Grab user data from the database using the user_id
    // Let them access the "logged in only" pages
    $myconnection = mysqli_connect('localhost', 'root', '', 'db2') 
    or die ('Could not connect: ' . mysqli_error($myconnection));

    $menteesquery = "SELECT mentee_id from enroll WHERE meet_id = '{$_GET['key']}'";
    $menteesinfoquery = "SELECT name, email from users WHERE id IN (".$menteesquery.")";
    $menteesinforesult = mysqli_query($myconnection, $menteesinfoquery)
    or die ('Query failed: ' . mysqli_error($myconnection));
    while ($menteesinfo = mysqli_fetch_array($menteesinforesult, MYSQLI_ASSOC)) {    
        echo("Name:&nbsp;".$menteesinfo["name"]."&nbsp;&nbsp;Email:&nbsp;".$menteesinfo["email"]."<br>");
    }

    mysqli_close($myconnection);
    ?>
</body>